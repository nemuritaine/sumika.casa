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
            <div class="p-archiveAside__clear">
              <p>クリア</p>
            </div>
          </div>
          <div class="p-archiveAside__menu">
            <div class="p-archiveAsideMenu">
              <div class="p-archiveAsideMenu__heading">
                <div class="p-archiveAsideMenu__title">
                  <p>カテゴリー</p>
                </div>
              </div>
              <div class="p-archiveAsideMenu__body">
                <ul class="p-archiveAsideMenu__item">
                  <li class="p-archiveAsideMenuItem">
                    <input type="checkbox" id="category-all" @change="selectAll('category', $event.target.checked)">
                    <label for="category-all">すべて</label>
                  </li>
                  <li v-for="category in categories" :key="category.id" class="p-archiveAsideMenuItem">
                    <input type="checkbox" :id="'category-' + category.id" :value="category.id" v-model="selectedCategories">
                    <label :for="'category-' + category.id">{{ category.name }}</label>
                  </li>
                </ul>
              </div>
            </div>
            <div class="p-archiveAsideMenu is-accordion">
              <div class="p-archiveAsideMenu__heading" @click="asideAccordion">
                <div class="p-archiveAsideMenu__title">
                  <p>タグ</p>
                </div>
                <div class="p-archiveAsideMenu__icon">
                  <span></span>
                  <span></span>
                </div>
              </div>
              <div class="p-archiveAsideMenu__body">
                <ul class="p-archiveAsideMenu__item">
                  <li class="p-archiveAsideMenuItem">
                    <input type="checkbox" id="tag-all" @change="selectAll('tag', $event.target.checked)">
                    <label for="tag-all">すべて</label>
                  </li>
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
      <article class="p-archive__article" @scroll.passive="handleScroll">
        <ul class="p-articleIndex__item">
          <li v-for="article in articles" :key="article.id" class="p-articleIndexItem">
            <nuxt-link :to="`/article/${article.id}`">
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
      <div class="p-archive__sort">
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

    data () {
      return {
        categories: [],
        tags: [],
        articles: [],
        selectedCategories: [],
        selectedTags: [],
        currentPage: 1,
        perPage: 20,
        isLoading: false,
        isLastPage: false,

        sidebarStyle: {},
        lastScrollTop: 0,
        scrollDirection: null,
        fixedScrollTop: null,
        fixedScrollBottom: null,
      }
    },

    computed: {

      bodyClass () {
        return 'p-articleIndex p-archive'
      }
    },

    mounted () {

      if (window.innerWidth <= 1024) {
        gsap.set('.p-archive__aside', { autoAlpha: 0 })
        this.initAsideAccordions()
      }
      
      window.addEventListener('scroll', () => {
        this.handleScroll()
        this.asideSticky()
      })

      window.addEventListener('resize', () => {
        this.handleResize()
      })
    },

    beforeDestroy () {
      window.removeEventListener('scroll', this.handleScroll)
      window.removeEventListener('scroll', this.asideSticky)
    },

    watch: {
      selectedCategories: {
        handler() {
          this.resetPagination()
          this.fetchArticles(this.currentPage)
        },
        deep: true,
      },
      selectedTags: {
        handler() {
          this.resetPagination()
          this.fetchArticles(this.currentPage)
        },
        deep: true,
      },
    },

    async asyncData({ $axios }) {
      try {
        const responseCategories = await $axios.get(`${process.env.VUE_APP_API_URL}/custom/v0/categories`)
        const responseTags = await $axios.get(`${process.env.VUE_APP_API_URL}/custom/v0/tags`)
        const responseArticles = await $axios.get(`${process.env.VUE_APP_API_URL}/custom/v0/posts`, {
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
        try {
          const response = await this.$axios.get(`https://sumika.artche.jp/cms/wp-json/custom/v0/posts`, {
            params: {
              per_page: this.perPage,
              page: page,
              categories: this.selectedCategories,
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
      },

      async handleScroll () {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop
        const windowHeight = window.innerHeight
        const documentHeight = document.documentElement.scrollHeight

        if (scrollTop + windowHeight >= documentHeight - 100) {
          this.currentPage += 1;
          await this.fetchArticles(this.currentPage)
        }
      },

      selectAll (type, checked) {
        if (type === 'category') {
          if (checked) {
            this.selectedCategories = this.categories.map(category => category.id)
          } else {
            this.selectedCategories = []
          }
        } else if (type === 'tag') {
          if (checked) {
            this.selectedTags = this.tags.map(tag => tag.id)
          } else {
            this.selectedTags = []
          }
        }
      },

      handleResize () {
        const asideAccordionMenu = document.querySelectorAll('.p-archiveAsideMenu.is-accordion')

        if (window.innerWidth <= 1024) {
          gsap.to('.p-archive__aside', { autoAlpha: 0 })
          asideAccordionMenu.forEach((menu) => {
            const asideAccordionMenuBody = menu.querySelector('.p-archiveAsideMenu__body')
            const asideAccordionMenuIcon = menu.querySelectorAll('.p-archiveAsideMenu__icon span')
            gsap.set(asideAccordionMenuBody, { height: 0, autoAlpha: 0 })
            gsap.set(asideAccordionMenuIcon[1], { rotate: -90, duration: 0.3 }, '<')
          })
        } else {
          gsap.to('.p-archive__aside', { autoAlpha: 1 })
          asideAccordionMenu.forEach((menu) => {
            const asideAccordionMenuBody = menu.querySelector('.p-archiveAsideMenu__body')
            gsap.set(asideAccordionMenuBody, { height: 'auto', autoAlpha: 1 })
          })
        }
      },

      animateAside () {

        if (window.innerWidth <= 1024) {
          gsap.to('.p-archive__aside', { autoAlpha: 1 })
        }
      },

      hideAside () {
        if (window.innerWidth <= 1024) {
          gsap.to('.p-archive__aside', { autoAlpha: 0 })
        }
      },

      initAsideAccordions () {
        const asideAccordionMenu = document.querySelectorAll('.p-archiveAsideMenu.is-accordion .p-archiveAsideMenu__body')
        asideAccordionMenu.forEach((menu) => {
          gsap.set(menu, { height: 0, autoAlpha: 0 })
        })
      },

      asideAccordion (event) {

        if (window.innerWidth <= 1024) {
          const tl = gsap.timeline()
          const target = event.currentTarget
          const contentElement = target.nextElementSibling
          const iconElement = target.querySelectorAll('.p-archiveAsideMenu__icon span')

          if (gsap.getProperty(contentElement, 'autoAlpha') == 0) {
            tl.to(contentElement, { height: 'auto', autoAlpha: 1, duration: 0.3 })
              .to(iconElement[1], { rotate: 0, duration: 0.3 }, '<')
          } else {
            tl.to(contentElement, { height: 0, autoAlpha: 0, duration: 0.3 })
              .to(iconElement[1], { rotate: -90, duration: 0.3 }, '<')
          }
        }
      },

      vwEquivalent (pxValueAt1280) {
        const referenceViewportWidth = 1280
        let currentViewportWidth = window.innerWidth
        let currentPxValue = (pxValueAt1280 * currentViewportWidth) / referenceViewportWidth
        return currentPxValue
      },

      asideSticky () {

        if (window.innerWidth >= 1025) {
          let scrollTop = window.pageYOffset || document.documentElement.scrollTop // スクロール量
          const wrapper = document.querySelector('.p-archive__aside')
          let sidebar = document.querySelector('.p-archiveAside')
          let sidebarHeight = sidebar.clientHeight 
          let sidebarTop = sidebar.getBoundingClientRect().top  // スクロール量に対してサイドバーの相対位置
          let sidebarBottom = sidebar.getBoundingClientRect().bottom // スクロール量に対してサイドバーの相対位置
          let article = document.querySelector('.p-archive__article')
          let articleTop = article.getBoundingClientRect().top  // ビューポートに対してアーティクルの相対位置
          let articleBottom = article.getBoundingClientRect().bottom  // ビューポートに対してアーティクルの相対位置
          let absoluteArticleTop = scrollTop + articleTop // ページ全体に対してアーティクルの絶対位置

          wrapper.style.height = `${sidebarHeight}px`
          
          if (scrollTop > this.lastScrollTop) {
            // console.log('下にスクロールしています')

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
              console.log('下スクロール：サイドバーの最下部までスクロールしていません')

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
          this.sidebarStyle = null
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
        margin-top: vw(20);
        row-gap: vw(8);
      }
    }

    &__title {
      display: -webkit-box;
      -webkit-box-orient: vertical;
      -webkit-line-clamp: 3;
      overflow: hidden;

      p {
        @include font(14, 21, 0, 700);
        
        @include responsive(xs, min) {
          @include font(16, 24);
        }
      
        @include responsive(md, min) {
          @include vwfont(1280, 16);
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