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
            <div class="p-archiveAsideMenu is-accordion">
              <div class="p-archiveAsideMenu__heading" @click="asideAccordion">
                <div class="p-archiveAsideMenu__title">
                  <p>スタイル</p>
                </div>
                <div class="p-archiveAsideMenu__icon">
                  <span></span>
                  <span></span>
                </div>
              </div>
              <div class="p-archiveAsideMenu__body">
                <ul class="p-archiveAsideMenu__item">
                  <li class="p-archiveAsideMenuItem">
                    <input type="checkbox" id="style-all" @change="selectAll('style', $event.target.checked)">
                    <label for="style-all">すべて</label>
                  </li>
                  <li v-for="style in styles" :key="style.id" class="p-archiveAsideMenuItem">
                    <input type="checkbox" :id="'style-' + style.id" :value="style.cat_slug" v-model="selectedStyles">
                    <label :for="'style-' + style.id">{{ style.cat_name }}</label>
                  </li>
                </ul>
              </div>
            </div>
            <div class="p-archiveAsideMenu is-accordion">
              <div class="p-archiveAsideMenu__heading" @click="asideAccordion">
                <div class="p-archiveAsideMenu__title">
                  <p>カテゴリー</p>
                </div>
                <div class="p-archiveAsideMenu__icon">
                  <span></span>
                  <span></span>
                </div>
              </div>
              <div class="p-archiveAsideMenu__body">
                <ul class="p-archiveAsideMenu__item">
                  <li class="p-archiveAsideMenuItem">
                    <input type="checkbox" id="classes-all" @change="selectAll('class', $event.target.checked)">
                    <label for="classes-all">すべて</label>
                  </li>
                  <li v-for="classes in classes" :key="classes.id" class="p-archiveAsideMenuItem">
                    <input type="checkbox" :id="'classes-' + classes.id" :value="classes.cat_slug" v-model="selectedClasses">
                    <label :for="'classes-' + classes.id">{{ classes.cat_name }}</label>
                  </li>
                </ul>
              </div>
            </div>
            <div class="p-archiveAsideMenu is-accordion">
              <div class="p-archiveAsideMenu__heading" @click="asideAccordion">
                <div class="p-archiveAsideMenu__title">
                  <p>ブランド</p>
                </div>
                <div class="p-archiveAsideMenu__icon">
                  <span></span>
                  <span></span>
                </div>
              </div>
              <div class="p-archiveAsideMenu__body">
                <ul class="p-archiveAsideMenu__item">
                  <li class="p-archiveAsideMenuItem">
                    <input type="checkbox" id="brand-all" @change="selectAll('brand', $event.target.checked)">
                    <label for="brand-all">すべて</label>
                  </li>
                  <li v-for="brand in brands" :key="brand.id" class="p-archiveAsideMenuItem">
                    <input type="checkbox" :id="'brand-' + brand.id" :value="brand.cat_slug" v-model="selectedBrands">
                    <label :for="'brand-' + brand.id">{{ brand.cat_name }}</label>
                  </li>
                </ul>
              </div>
            </div>
            <div class="p-archiveAsideMenu is-accordion">
              <div class="p-archiveAsideMenu__heading" @click="asideAccordion">
                <div class="p-archiveAsideMenu__title">
                  <p>値段</p>
                </div>
                <div class="p-archiveAsideMenu__icon">
                  <span></span>
                  <span></span>
                </div>
              </div>
              <div class="p-archiveAsideMenu__body">
                <ul class="p-archiveAsideMenu__item">
                  <li class="p-archiveAsideMenuItem">
                    <input type="checkbox" id="price-all" @change="selectAll('price', $event.target.checked)">
                    <label for="price-all">すべて</label>
                  </li>
                  <li v-for="price in prices" :key="price.id" class="p-archiveAsideMenuItem">
                    <input type="checkbox" :id="'price-' + price.id" :value="price.cat_slug" v-model="selectedPrices">
                    <label :for="'price-' + price.id">{{ price.cat_name }}</label>
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
        <div class="p-elementIndex__item">
          <nuxt-link :to="`/element/${element.id}`" v-for="element in elements" :key="element.id" class="p-elementIndexItem">
            <span class="p-elementIndexItem__detail">
              <span class="p-elementIndexItem__title">{{ element.brand }}</span>
              <span class="p-elementIndexItem__price">{{ element.price }}</span>
            </span>
            <span class="p-elementIndexItem__like">
              <span class="p-elementIndexItemLike__icon">
                <svg>
                  <use xlink:href="@/static/assets/images/common/graphics.svg#ico_heart"></use>
                </svg>
              </span>
              <span class="p-elementIndexItemLike__text">23</span>
            </span>
            <span class="p-elementIndexItem__image">
              <img :src="element.image_src" alt="" width="" height="">
            </span>
          </nuxt-link>
        </div>
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
        elements: [],
        classes: [],
        brands: [],
        prices: [],
        styles: [],
        selectedClasses: [],
        selectedBrands: [],
        selectedPrices: [],
        selectedStyles: [],
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
      }
    },

    computed: {

      bodyClass () {
        return 'p-elementIndex p-archive'
      }
    },

    mounted () {
      this.boundAsideSticky = this.asideSticky.bind(this)
      this.updateSelectionsFromURL()
      this.initAsideAccordions()

      window.addEventListener('scroll', () => {
        this.handleScroll()
        
        if (window.innerWidth >= 1025) {
          this.boundAsideSticky()
        }
      })

      window.addEventListener('resize', () => {
        this.boundAsideSticky()
      })
      
      if (window.innerWidth <= 1024) {
        gsap.set('.p-archive__aside', { autoAlpha: 0 })
      }
    },

    beforeDestroy () {
      ['handleScroll', 'boundAsideSticky'].forEach((handler) => {
        window.removeEventListener('scroll', this[handler])
      })
      window.removeEventListener('resize', this.boundAsideSticky)
    },

    watch: {
      selectedClasses: {
        handler() {
          this.resetPagination()
          this.fetchElements(this.currentPage)
        },
        deep: true,
      },
      selectedBrands: {
        handler() {
          this.resetPagination()
          this.fetchElements(this.currentPage)
        },
        deep: true,
      },
      selectedPrices: {
        handler() {
          this.resetPagination()
          this.fetchElements(this.currentPage)
        },
        deep: true,
      },
      selectedStyles: {
        handler() {
          this.resetPagination()
          this.fetchElements(this.currentPage)
        },
        deep: true,
      },
    },

    async asyncData ({ $axios, query, app }) {
      try {
        const responseClasses = await $axios.get(`${app.$url}/custom/v0/element_class`)
        const responseBrands = await $axios.get(`${app.$url}/custom/v0/element_brand`)
        const responsePrices = await $axios.get(`${app.$url}/custom/v0/element_price`)
        const responseStyles = await $axios.get(`${app.$url}/custom/v0/element_style`)
        const responseElements = await $axios.get(`${app.$url}/custom/v0/elements`, {
          params: {
            per_page: 20,
            page: 1,
          },
        })

        return {
          classes: responseClasses.data,
          brands: responseBrands.data,
          prices: responsePrices.data,
          styles: responseStyles.data,
          elements: responseElements.data,
        }
      } catch (error) {
        console.error(error)
        return {
          classes: [],
          brands: [],
          prices: [],
          styles: [],
          elements: [],
        }
      }
    },

    methods: {

      resetPagination () {
        this.currentPage = 1
        this.isLastPage = false
      },

      async fetchElements (page) {
        try {
          const response = await this.$axios.get(`${this.$nuxt.$url}/custom/v0/elements`, {
            params: {
              per_page: this.perPage,
              page: page,
              classes: this.selectedClasses,
              brands: this.selectedBrands,
              prices: this.selectedPrices,
              styles: this.selectedStyles,
            },
          })

          if (page === 1) {
            this.elements = response.data
          } else {
            this.elements = this.elements.concat(response.data)
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
          await this.fetchElements(this.currentPage)
        }
      },

      selectAll (type, checked) {
        if (type === 'class') {
          if (checked) {
            this.selectedClasses = this.classes.map(classes => classes.id)
          } else {
            this.selectedClasses = []
          }
        } else if (type === 'brand') {
          if (checked) {
            this.selectedBrands = this.brands.map(brand => brand.id)
          } else {
            this.selectedBrands = []
          }
        } else if (type === 'price') {
          if (checked) {
            this.selectedPrices = this.prices.map(price => price.id)
          } else {
            this.selectedPrices = []
          }
        } else if (type === 'style') {
          if (checked) {
            this.selectedStyles = this.styles.map(style => style.id)
          } else {
            this.selectedStyles = []
          }
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
      },

      updateSelectionsFromURL () {
        const { query } = this.$nuxt.context

        if (query.classes) this.selectedClasses = query.classes.split(',')
        if (query.brands) this.selectedBrands = query.brands.split(',')
        if (query.prices) this.selectedPrices = query.prices.split(',')
        if (query.styles) this.selectedStyles = query.styles.split(',')

        this.selectItems('style', this.selectedStyles)
        this.selectItems('class', this.selectedClasses)
        this.selectItems('brand', this.selectedBrands)
        this.selectItems('price', this.selectedPrices)
      },

      selectItems (type, items) {
        items.forEach(item => {
          const checkbox = this.$el.querySelector(`#${type}-${item}`)
          if (checkbox) checkbox.checked = true
        })
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

  .p-elementIndex {

    // .p-elementIndex__item
    &__item {
      display: flex;
      flex-wrap: wrap;
      column-gap: per(15, 335);
      row-gap: rem(15);

      @include responsive(sm, min) {
        column-gap: per(20, 832);
        row-gap: rem(20);
      }
    }
  }

  .p-elementIndexItem {
    width: per(160, 335);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    background-color: color(white);
    border-radius: rem(10);
    aspect-ratio: 194 / 228.75;
    padding-top: rem(14);

    @include responsive(sm, min) {
      width: per(193, 832);
    }

    @include responsive(md, min) {
      padding-top: vw(14);
    }

    // .p-elementIndexItem__detail
    &__detail {
      width: 100%;
      position: absolute;
      top: 0;
      left: 0;
      padding-top: rem(12);
      padding-right: 16px;
      padding-left: 16px;
      z-index: 2;
      
      @include responsive(sm, min) {
        padding-right: 17px;
        padding-left: 17px;
      }

      @include responsive(md, min) {
        padding-top: rem(12);
        padding-right: vw(17);
        padding-left: vw(17);
      }
    }

    &__like {
      position: absolute;
      bottom: rem(15);
      left: 16px;
      display: flex;
      align-items: center;

      @include responsive(md, min) {
        left: 17px;
      }

      @include responsive(md, min) {
        left: vw(17);
      }
    }

    // .p-topElementItem__image
    &__image {
      display: flex;
      align-items: center;
      justify-content: center;
      width: per(125, 200);
      margin-right: auto;
      margin-left: auto;
      
      // .p-topElementItem__image img
      img {
        object-fit: contain;
        width: 100%;
        aspect-ratio: 200 / 200;
      }
    }

    // .p-topElementItem__title
    &__title {
      @include Alokary;
      @include font(12, 24, 140);
      display: block;

      @include responsive(md, min) {
        @include vwfont(1280, 12);
      }
    }

    // .p-elementIndexItem__price
    &__price {
      @include Wandeln;
      @include font(12, 18, 0);
      display: block;

      @include responsive(md, min) {
        @include vwfont(1280, 12);
      }
    }
  }

  .p-elementIndexItemLike {
    display: flex;
    align-items: center;

    &__icon {
      display: flex;
      color: color(main);
      
      svg {
        width: 11.34px;
        height: 10px;

        @include responsive(md, min) {
          width: vw(11.34);
          height: vw(10);
        }
      }
    }

    &__text {
      @include Optima;
      @include font(10, 12, -100);
      color: color(main);
      margin-left: 3.66px;
      
      @include responsive(md, min) {
        @include vwfont(1280, 10, 12, -100);
        margin-left: vw(4);
      }
    }
  }

</style>