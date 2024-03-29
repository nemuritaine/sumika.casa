<template>
  <div class="p-archive__inner">
    <div class="p-archive__wrapper">
      <aside class="p-archive__aside">
        <div class="p-archiveAside" :style="sidebarStyle">
          <div class="p-archiveAside__heading">
            <div class="p-archiveAside__close" @click="hideAside">
              <svg>
                <use xlink:href="@/static/assets/images/common/graphics.svg#ico_close"></use>
              </svg>
            </div>
            <div class="p-archiveAside__title">
              <p>絞り込み</p>
            </div>
            <div class="p-archiveAside__clear" @click="clearAll">
              <p>クリア</p>
            </div>
          </div>
          <div class="p-archiveAside__menu">
            <div class="p-archiveAsideMenu">
              <div class="p-archiveAsideMenu__heading">
                <div class="p-archiveAsideMenu__title">
                  <p>タグ</p>
                </div>
                <div class="p-archiveAsideMenu__icon">
                  <span></span>
                  <span></span>
                </div>
              </div>
              <div class="p-archiveAsideMenu__body">
                <div class="p-archiveAsideMenu__reset">
                  <p @click="selectAll('tag')">選択をクリア</p>
                </div>
                <ul class="p-archiveAsideMenu__item --button">
                  <li v-for="tag in tags" :key="tag.id" class="p-archiveAsideMenuItem">
                    <input type="checkbox" :id="'tag-' + tag.id" :value="tag.id" v-model="selectedTags">
                    <label :for="'tag-' + tag.id">{{ tag.name }}</label>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="p-archiveAside__button">
            <div class="p-archiveAsideButton" @click="hideAside">
              <p>検索する</p>
            </div>
          </div>
        </div>
      </aside>
      <article class="p-archive__article" ref="archiveArticle" @scroll.passive="handleScroll">
        <ul class="p-articleIndex__item">
          <li v-for="article in articles" :key="article.id" class="p-articleIndexItem">
            <nuxt-link :to="`/post/${article.id}`">
              <div class="p-articleIndexItem__image">
                <img :src="article.image_src" alt="" width="" height="">
              </div>
              <div class="p-articleIndexItem__detail">
                <ul class="p-articleIndexItem__tag" v-if="article.tags && article.tags.length">
                  <li v-for="(tag, index) in article.tags" :key="tag.term_id">{{ tag.name }}</li>
                </ul>
                <div class="p-articleIndexItem__title">
                  <p>{{ article.title }}</p>
                </div>
              </div>
            </nuxt-link>
          </li>
        </ul>
      </article>
      <div class="p-archive__sort" ref="archiveSort">
        <div class="p-archiveSort" @click="animateAside">
          <div class="p-archiveSort__icon">
            <svg>
              <use xlink:href="@/static/assets/images/common/graphics.svg#ico_sort"></use>
            </svg>
          </div>
          <div class="p-archiveSort__text">
            <p>絞り込み</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { gsap } from 'gsap'

  export default {

    head () {
      const defaultHead = this.$nuxt.$options.head
      const title = `お部屋一覧 | ${defaultHead.title}`

      return {
        title,
        meta: [
          { hid: 'og:title', property: 'og:title', content: title },
          { hid: 'og:url', property: 'og:url', content: `${process.env.BASE_URL}post` },
        ],
      }
    },

    data () {
      return {
        categories: [],
        tags: [],
        articles: [],
        selectedTags: [],
        currentPage: 1,
        perPage: 20,
        isLoading: false,
        isLastPage: false,
        // start aside stiky
        sidebarStyle: {},
        lastScrollTop: 0,
        scrollDirection: null,
        fixedScrollTop: null,
        fixedScrollBottom: null,
        // end aside stiky
        isFetching: false,
      }
    },

    computed: {

      bodyClass () {
        return 'p-articleIndex p-archive'
      }
    },

    mounted () {
      this.boundAsideSticky = this.asideSticky.bind(this)
      this.initAsideAccordions()

      this.sortOpacityResize()
      window.addEventListener('resize', this.sortOpacityResize)
      window.addEventListener('scroll', this.sortOpacityScroll)

      window.addEventListener('scroll', this.handleScroll)
      window.addEventListener('scroll', () => {
        
        if (window.innerWidth >= 1025) {
          this.boundAsideSticky()
        }
      })
      window.addEventListener('resize', this.boundAsideSticky)
      

      if (window.innerWidth <= 1024) {
        gsap.set('.p-archive__aside', { autoAlpha: 0 })
      }
    },

    beforeDestroy () {
      window.removeEventListener('scroll', this.handleScroll)
      window.removeEventListener('scroll', this.boundAsideSticky)
      window.removeEventListener('resize', this.boundAsideSticky)
      window.removeEventListener('resize', this.sortOpacityResize)
      window.removeEventListener('scroll', this.sortOpacityScroll)
    },

    watch: {
      selectedTags: {
        handler() {
          this.resetPagination()
          this.fetchArticles(this.currentPage)
        },
        deep: true,
      },
    },

    async asyncData({ $axios, app }) {
      try {
        const responseCategories = await $axios.get(`${app.$url}/custom/v0/categories`)
        const responseTags = await $axios.get(`${app.$url}/custom/v0/tags`)
        const responseArticles = await $axios.get(`${app.$url}/custom/v0/posts`, {
          params: {
            per_page: 20,
            page: 1,
          },
        })

        return {
          categories: responseCategories.data,
          tags: responseTags.data,
          articles: responseArticles.data,
        }
      } catch (error) {
        console.error(error)
        return {
          categories: [],
          tags: [],
          articles: [],
        }
      }
    },

    methods: {

      resetPagination () {
        this.currentPage = 1
        this.isLastPage = false
      },

      async fetchArticles (page) {
        this.isFetching = true
        
        try {
          const response = await this.$axios.get(`${this.$nuxt.$url}/custom/v0/posts`, {
            params: {
              per_page: this.perPage,
              page: page,
              tags: this.selectedTags,
            },
          })

          if (page === 1) {
            this.articles = response.data
          } else {
            this.articles = this.articles.concat(response.data)
          }

          if (response.data.length < this.perPage) {
            this.isLastPage = true
          } else {
            this.isLastPage = false
          }
        } catch (error) {
          console.error(error)
        } finally {
          this.isLoading = false
        }

        this.isFetching = false
      },

      async handleScroll () {

        if (this.isFetching) {  // isFetchingがtrueならfetch中と判断し処理を抜ける
          return
        }

        const scrollTop = window.pageYOffset || document.documentElement.scrollTop
        const windowHeight = window.innerHeight
        const articleElement = this.$refs.archiveArticle
        const articleHeight = articleElement.scrollHeight

        if (scrollTop + windowHeight >= articleHeight - 300) {
          this.currentPage += 1
          await this.fetchArticles(this.currentPage)
        }
      },

      sortOpacityResize () {

        if (window.innerWidth <= 769 || window.innerWidth >= 1024) {
          this.$refs.archiveSort.style.opacity = ''
          this.$refs.archiveSort.style.visibility = ''
        }
      },

      sortOpacityScroll () {

        if (window.innerWidth >= 769 && window.innerWidth <= 1024) {
          const scrollPosition = window.scrollY || window.pageYOffset || document.documentElement.scrollTop
          const articleBottom = this.$refs.archiveArticle.getBoundingClientRect().bottom + window.pageYOffset
          const threshold = articleBottom - window.innerHeight

          if (scrollPosition >= threshold) {
            gsap.to(this.$refs.archiveSort, { autoAlpha: 0 })
          } else {
            gsap.to(this.$refs.archiveSort, { autoAlpha: 1 })
          }
        }
      },

      selectAll (type) {
        if (type === 'tag') {
          this.selectedTags = []
        }
      },

      clearAll () {
        this.selectedTags = []
      },

      // アサイド：絞り込みをクリックした際にアサイドを表示する
      animateAside () {
        if (window.innerWidth <= 1024) {
          gsap.to('.p-archive__aside', {
            autoAlpha: 1,
            duration: 0.2,
            onComplete: () => {
              document.body.style.overflow = 'hidden' // スクロールを無効にする
            }
          })
        }
      },

      // アサイド：検索するをクリックした際にアサイドを隠す
      hideAside () {
        if (window.innerWidth <= 1024) {
          gsap.to('.p-archive__aside', {
            autoAlpha: 0,
            duration: 0.2,
            onComplete: () => {
              document.body.style.overflow = '' // スクロールを有効にする
            }
          })
        }
      },

      initAsideAccordions () {
        const asideAccordionMenu = document.querySelectorAll('.p-archiveAsideMenu.is-accordion .p-archiveAsideMenu__body')
        asideAccordionMenu.forEach((menu) => {
          gsap.set(menu, { height: 0, autoAlpha: 0 })
        })
      },

      asideAccordion (event) {

        const tl = gsap.timeline()
        const target = event.currentTarget
        const contentElement = target.nextElementSibling
        const iconElement = target.querySelectorAll('.p-archiveAsideMenu__icon span')
        const wrapper = document.querySelector('.p-archive__aside')
        const sidebar = document.querySelector('.p-archiveAside')
        let sidebarHeight = null
        let article = document.querySelector('.p-archive__article')
        let articleBottom = article.getBoundingClientRect().bottom  // ビューポートに対してアーティクルの相対位置
        let self = this

        async function processAccordion () {

          const firstProcess = new Promise((resolve) => {

            if (gsap.getProperty(contentElement, 'autoAlpha') == 0) {
              tl.to(contentElement, { height: 'auto', autoAlpha: 1, duration: 0.3, onComplete: resolve })
                .to(iconElement[1], { rotate: 0, duration: 0.3 }, '<')
            } else {
              tl.to(contentElement, { height: 0, autoAlpha: 0, duration: 0.3, onComplete: resolve })
                .to(iconElement[1], { rotate: -90, duration: 0.3 }, '<')
            }
          })

          firstProcess.then(() => {

            sidebarHeight = sidebar.clientHeight

            if (window.innerWidth >= 1025) {
              wrapper.style.height = `${sidebarHeight}px`
            }

            if (
              window.innerWidth >= 1025 &&
              window.innerHeight >= articleBottom &&
              sidebar.clientHeight >= window.innerHeight
            ) {
              // console.log('アーティクルの最下部よりもスクロールしています')

              self.sidebarStyle = {
                position: 'fixed',
                bottom: `${window.innerHeight - articleBottom}px`,
              }
            }
          })
        }

        processAccordion()
      },

      vwEquivalent (pxValueAt1280) {
        const referenceViewportWidth = 1280
        let currentViewportWidth = window.innerWidth
        let currentPxValue = (pxValueAt1280 * currentViewportWidth) / referenceViewportWidth
        return currentPxValue
      },

      asideSticky () {
        const wrapper = document.querySelector('.p-archive__aside')
        const sidebar = document.querySelector('.p-archiveAside')

        if (!wrapper || !sidebar) {
          return
        }

        let wrapperWidth = wrapper.clientWidth

        if (window.innerWidth >= 1025) {
          let scrollTop = window.pageYOffset || document.documentElement.scrollTop // スクロール量
          let sidebarHeight = sidebar.clientHeight
          let sidebarTop = sidebar.getBoundingClientRect().top  // スクロール量に対してサイドバーの相対位置
          let sidebarBottom = sidebar.getBoundingClientRect().bottom // スクロール量に対してサイドバーの相対位置
          let article = document.querySelector('.p-archive__article')
          let articleTop = article.getBoundingClientRect().top  // ビューポートに対してアーティクルの相対位置
          let articleBottom = article.getBoundingClientRect().bottom  // ビューポートに対してアーティクルの相対位置
          let absoluteArticleTop = scrollTop + articleTop // ページ全体に対してアーティクルの絶対位置

          wrapper.style.height = `${sidebarHeight}px`
          sidebar.style.width = `${wrapperWidth}px`
          gsap.to('.p-archive__aside', { autoAlpha: 1 })
          
          if (scrollTop > this.lastScrollTop) {
            // console.log('下にスクロールしています')

            if (sidebarHeight <= window.innerHeight) {

              if (articleTop >= this.vwEquivalent(40)) {
                // console.log('下スクロール：アーティクルの最上部よりもスクロールしています')

                this.sidebarStyle = {
                  position: 'fixed',
                  top: `${articleTop}px`,
                  bottom: 'auto',
                }
              } else {
                this.sidebarStyle = {
                  position: 'fixed',
                  top: `${this.vwEquivalent(40)}px`,
                }
              }
              return
            }

            if (this.scrollDirection === 'up') {

              if (0 >= scrollTop - absoluteArticleTop) {
                // console.log('スクロール量がアーティクルの最上部以上')
                this.fixedScrollBottom = 0
              } else if (sidebar.style.position === 'fixed') {
                // console.log('アーティクルの最上部からのスクロール量')
                this.fixedScrollBottom = scrollTop - absoluteArticleTop + this.vwEquivalent(40)
              } else {
                this.fixedScrollBottom = this.fixedScrollTop
              }
            }

            if (window.innerHeight >= articleBottom) {
              // console.log('アーティクルの最下部よりもスクロールしています')

              this.sidebarStyle = {
                position: 'fixed',
                bottom: `${window.innerHeight - articleBottom}px`,
              }

            } else if (window.innerHeight >= sidebarBottom + this.vwEquivalent(40)) {
              // console.log('サイドバーの最下部よりもスクロールしています')

              this.sidebarStyle = {
                position: 'fixed',
                bottom: `${this.vwEquivalent(40)}px`,
              }
              
            } else {
              // console.log('下スクロール：サイドバーの最下部までスクロールしていません')

              this.sidebarStyle = {
                position: 'relative',
                top: `${this.fixedScrollBottom}px`,
              }
            }

            this.scrollDirection = 'down'

          } else {

            // console.log('上にスクロールしています')
            if (this.scrollDirection === 'down') {

              if (0 >= articleBottom - window.innerHeight) {
                // console.log('記事最下部よりも下')
                this.fixedScrollTop = scrollTop - absoluteArticleTop - (sidebarHeight - window.innerHeight) + (articleBottom - window.innerHeight)

              } else if (sidebar.style.position === 'fixed') {
                // console.log('記事最下部よりも上')
                this.fixedScrollTop = scrollTop - absoluteArticleTop - (sidebarHeight - window.innerHeight) - this.vwEquivalent(40)
              } else {
                this.fixedScrollTop = this.fixedScrollBottom
              }
            }

            if (articleTop >= 0) {
              // console.log('上スクロール：アーティクルの最上部よりもスクロールしています')

              this.sidebarStyle = {
                position: 'fixed',
                top: `${articleTop}px`,
                bottom: 'auto',
              }

            } else if (sidebarTop >= this.vwEquivalent(40)) {

              // console.log('サイドバーの最上部よりもスクロールしています')
              this.sidebarStyle = {
                position: 'fixed',
                top: `${this.vwEquivalent(40)}px`,
              }

            } else {
              // console.log('上スクロール：サイドバーの最上部までスクロールしていません')

              if (scrollTop - absoluteArticleTop >= -1 * (window.innerHeight - sidebarHeight)) {
                this.sidebarStyle = {
                  position: 'relative',
                  top: `${this.fixedScrollTop}px`,
                }
              }
            }

            this.scrollDirection = 'up'
          }

          this.lastScrollTop = scrollTop <= 0 ? 0 : scrollTop
        } else {
          gsap.to('.p-archive__aside', { autoAlpha: 0 })
          sidebar.style.width = '100%'
          this.sidebarStyle = null
          wrapper.style.height = null
        }
      }
    },
  }
</script>

<style lang="scss" scoped>
  .p-articleIndex {

    &__item {
      display: flex;
      flex-wrap: wrap;
      column-gap: per(15, 335);
      row-gap: rem(30);

      @include responsive(sm, min) {
        column-gap: per(24, 832);
        row-gap: rem(50);
      }
    }
  }

  .p-articleIndexItem {
    width: per(160, 335);
    
    @include responsive(sm, min) {
      width: per(190, 832);
    }

    &__image {
      aspect-ratio: 190 / 237.5;
      border-radius: rem(6);
      overflow: hidden;

      @include responsive(md, min) {
        border-radius: vw(6);
      }

      // .p-topColumnArticle__image img
      img {
        object-fit: cover;
        height: 100%;
        width: 100%;
      }
    }

    &__detail {
      display: flex;
      flex-direction: column;
      margin-top: rem(16);
      row-gap: rem(8);

      @include responsive(md, min) {
        margin-top: vw(18);
        row-gap: vw(8);
      }
    }

    // .p-articleIndexItem__title
    &__title {
      display: -webkit-box;
      -webkit-box-orient: vertical;
      -webkit-line-clamp: 3;
      overflow: hidden;

      p {
        @include font(14, 22.4, 0);
        
        @include responsive(md, min) {
          @include vwfont(1280, 14);
        }
      }
    }

    &__tag {
      display: flex;
      flex-wrap: wrap;
      column-gap: 8px;
      max-height: 20px;
      overflow: hidden;
      
      @include responsive(md, min) {
        max-height: vw(20);
        column-gap: vw(8);
      }
      
      li {
        @include font(10, 15, 0);
        background-color: color(smoke);
        padding-top: rem(3);
        padding-right: 6px;
        padding-bottom: rem(2);
        padding-left: 6px;
        border-radius: rem(2);
        
        @include responsive(md, min) {
          @include vwfont(1280, 10);
          padding-top: vw(3);
          padding-right: vw(6);
          padding-bottom: vw(2);
          padding-left: vw(6);
          border-radius: vw(2);
        }
      }
    }
  }
</style>