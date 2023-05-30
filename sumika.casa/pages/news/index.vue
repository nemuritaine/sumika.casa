<template>
  <div class="p-archive__inner">
    <div class="p-archive__wrapper">
      <aside class="p-archive__aside">
        <div class="p-archiveAside">
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
                    <input type="checkbox" id="category-all" @change="selectAll('category', $event.target.checked)">
                    <label for="category-all">すべて</label>
                  </li>
                  <li v-for="category in categories" :key="category.id" class="p-archiveAsideMenuItem">
                    <input type="checkbox" :id="'category-' + category.id" :value="category.cat_slug" v-model="selectedCategories">
                    <label :for="'category-' + category.id">{{ category.cat_name }}</label>
                  </li>
                </ul>
              </div>
            </div>
            <!-- <div class="p-archiveAsideMenu">
              <div class="p-archiveAsideMenu__heading">
                <p>いつごろ</p>
              </div>
              <ul class="p-archiveAsideMenu__item">
                <li class="p-archiveAsideMenuItem">
                  <input type="checkbox" id="year-all" @change="selectAll('year', $event.target.checked)">
                  <label for="year-all">すべて</label>
                </li>
                <li v-for="year in years" :key="year.id" class="p-archiveAsideMenuItem">
                  <input type="checkbox" :id="'year-' + year.id" :value="year.cat_slug" v-model="selectedYears">
                  <label :for="'year-' + year.id">{{ year.cat_name }}</label>
                </li>
              </ul>
            </div> -->
          </div>
          <div class="p-archiveAside__button">
            <div class="p-archiveAsideButton" @click="hideAside">
              <p>検索する</p>
            </div>
          </div>
        </div>
      </aside>
      <article class="p-archive__article" @scroll.passive="handleScroll">
        <ul class="p-newsIndex__item">
          <li class="p-newsIndexItem" v-for="news in news" :key="news.id">
            <nuxt-link
              v-if="news.icon === 'arrow'"
              :to="`/news/${news.id}`"
              class="p-newsIndexItem__link"
            >
              <span class="p-newsIndexItem__heading">
                <span class="p-newsIndexItem__date">
                  <time>{{ news.time }}</time>
                </span>
                <span class="p-newsIndexItem__category">{{ news.category_slug }}</span>
              </span>
              <span class="p-newsIndexItem__main">
                <span class="p-newsIndexItem__title">
                  <p>{{ news.title }}</p>
                </span>
                <span class="p-newsIndexItem__icon">
                  <span :class="`p-newsIndexItemIcon--${news.icon}`">
                    <svg>
                      <use xlink:href="@/static/assets/images/common/graphics.svg#ico_arrowRight"></use>
                    </svg>
                  </span>
                  <span class="p-newsIndexItemIcon--frame">
                    <svg>
                      <use xlink:href="@/static/assets/images/common/graphics.svg#ico_frame"></use>
                    </svg>
                  </span>
                </span>
              </span>
            </nuxt-link>
            <div
              v-else-if="news.icon === 'expansion'"
              class="p-newsIndexItem__link is-accordion"
              @click="newsAccordion"
            >
              <div class="p-newsIndexItem__heading">
                <div class="p-newsIndexItem__date">
                  <time>{{ news.time }}</time>
                </div>
                <span class="p-newsIndexItem__category">{{ news.category_slug }}</span>
              </div>
              <div class="p-newsIndexItem__main">
                <div class="p-newsIndexItem__title">
                  <p>{{ news.title }}</p>
                </div>
                <div class="p-newsIndexItem__icon">
                  <span :class="`p-newsIndexItemIcon--${news.icon}`">
                    <span class="p-newsIndexItemIcon__line"></span>
                    <span class="p-newsIndexItemIcon__line"></span>
                  </span>
                  <span class="p-newsIndexItemIcon--frame">
                    <svg>
                      <use xlink:href="@/static/assets/images/common/graphics.svg#ico_frame"></use>
                    </svg>
                  </span>
                </div>
              </div>
              <div class="p-newsIndexItem__text">
                <div class="p-newsIndexItemText" v-html="news.content"></div>
              </div>
            </div>
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

    data() {
      return {
        news: [],
        categories: [],
        years: [],
        selectedCategories: [],
        selectedYears: [],
        currentPage: 1,
        perPage: 20,
        isLoading: false,
        isLastPage: false,
      }
    },

    computed: {

      bodyClass () {
        return 'p-newsIndex p-archive'
      }
    },

    mounted() {
      window.addEventListener('scroll', this.handleScroll)
      window.addEventListener('resize', this.handleResize)
      this.initNewsAccordions()

      if (window.innerWidth <= 1024) {
        gsap.set('.p-archive__aside', { autoAlpha: 0 })
        this.initAsideAccordions()
      }
    },

    beforeDestroy() {
      window.removeEventListener('scroll', this.handleScroll)
    },

    watch: {
      selectedCategories: {
        handler() {
          this.resetPagination()
          this.fetchNews(this.currentPage)
        },
        deep: true,
      },
      selectedYears: {
        handler() {
          this.resetPagination()
          this.fetchNews(this.currentPage)
        },
        deep: true,
      },
    },

    async asyncData({ $axios, app }) {
      try {
        // const responseYears = await $axios.get(`${app.$url}/custom/v0/news_year`)
        const responseCategories = await $axios.get(`${app.$url}/custom/v0/news_cat`)
        const responseNews = await $axios.get(`${app.$url}/custom/v0/news`, {
          params: {
            per_page: 20,
            page: 1,
          },
        })

        return {
          // years: responseYears.data,
          categories: responseCategories.data,
          news: responseNews.data,
        }
      } catch (error) {
        console.error(error)
        return {
          years: [],
          categories: [],
          news: [],
        }
      }
    },

    methods: {

      resetPagination() {
        this.currentPage = 1
        this.isLastPage = false
      },

      async fetchNews (page) {
        try {
          const response = await this.$axios.get(`${this.$nuxt.$url}/custom/v0/news`, {
            params: {
              per_page: this.perPage,
              page: page,
              categories: this.selectedCategories,
              // years: this.selectedYears,
            },
          })

          if (page === 1) {
            this.news = response.data
          } else {
            this.news = this.news.concat(response.data)
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
        const articleElement = document.querySelector('.p-archive__article')
        const articleHeight = articleElement.scrollHeight

        if (scrollTop + windowHeight >= articleHeight - 300) {
          this.currentPage += 1
          await this.fetchNews(this.currentPage)
        }
      },

      selectAll (type, checked) {
        if (type === 'category') {
          if (checked) {
            this.selectedCategories = this.categories.map(category => category.cat_slug)
          } else {
            this.selectedCategories = []
          }
        }
      },

      clearAll () {
        this.selectedCategories = []
        this.selectedYears = []
      },

      initNewsAccordions () {
        const newsAccordionElements = document.querySelectorAll('.p-newsIndexItem__link.is-accordion .p-newsIndexItem__text')
        newsAccordionElements.forEach((element) => {
          gsap.set(element, { height: 0, autoAlpha: 0 })
        })
      },

      newsAccordion (event) {
        const tl = gsap.timeline()
        const target = event.currentTarget
        const contentElement = target.querySelector('.p-newsIndexItem__text')
        const iconElement = target.querySelectorAll('.p-newsIndexItemIcon__line')

        if (gsap.getProperty(contentElement, 'autoAlpha') == 0) {
          tl.to(contentElement, { height: 'auto', autoAlpha: 1, duration: 0.3 })
            .to(iconElement[1], { rotate: 0, duration: 0.3 }, '<')
        } else {
          tl.to(contentElement, { height: 0, autoAlpha: 0, duration: 0.3 })
            .to(iconElement[1], { rotate: 90, duration: 0.3 }, '<')
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
    },
  }
</script>

<style lang="scss" scoped>

  .p-newsIndex {

    &__item {
    }
  }

  .p-newsIndexItem {
    border-bottom: 1px solid color(lightgray);
    
    &__link {
      display: block;
      cursor: pointer;
      padding-top: rem(18);
      padding-bottom: rem(18);
  
      @include responsive(md, min) {
        padding-top: vw(27);
        padding-bottom: vw(24);
      }
    }

    &__heading {
      display: flex;
      align-items: center;
      @include Optima;
    }

    &__date {
      color: color(grayish);

      time {
        @include font(12, 15, 0);
        display: block;

        @include responsive(md, min) {
          @include vwfont(1280, 12, 15, 0);
        }
      }

    }

    &__main {
      display: block;
      position: relative;
      margin-top: rem(8);

      @include responsive(sm, min) {
        margin-top: rem(6.4);
      }

      @include responsive(md, min) {
        margin-top: vw(8);
      }
    }

    &__title {
      display: block;
      padding-right: 57px;

      @include responsive(md, min) {
        padding-right: vw(80);
      }

      p {
        @include font(14, 22, 40);

        @include responsive(md, min) {
          @include vwfont(1280, 14);
        }
      }
    }

    &__icon {
      position: absolute;
      right: 0;
      top: rem(-5);
      width: 40px;
      height: 30px;
      display: block;

      @include responsive(md, min) {
        width: vw(40);
        height: vw(30);
        top: vw(-5);
      }
    }

    &__category {
      @include font(10, 15, 0, 500);
      color: color(grayish);
      display: flex;
      align-items: center;
      text-transform: uppercase;

      &:before {
        content: '';
        display: block;
        width: 2px;
        height: 14px;
        border-radius: 1px;
        margin-right: 14px;
        margin-left: 14px;
        background-color: color(lightgray);
        
        @include responsive(md, min) {
          width: vw(2);
          height: vw(14);
          border-radius: vw(1);
          margin-right: vw(14);
          margin-left: vw(14);
        }
      }
      
      @include responsive(md, min) {
        @include vwfont(1280, 12, 16, 0);
      }
    }

    &__text {
      height: 0;
      overflow: hidden;
    }
  }

  .p-newsIndexItemText {
    margin-top: rem(20);
    padding-right: 57px;

    @include responsive(md, min) {
      padding-right: vw(80);
    }
  }

  .p-newsIndexItemIcon {
    $this: &;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    
    &--expansion {
      @extend .p-newsIndexItemIcon;
      
    }
    
    &--arrow {
      @extend .p-newsIndexItemIcon;
      color: color(main);

      svg {
        display: block;
        width: 15px;
        height: 12px;
        
        @include responsive(sm, min) {
          width: 12px;
          height: 10px;
        }
        
        @include responsive(md, min) {
          width: vw(15);
          height: vw(12);
        }
      }
    }

    &--frame {
      color: color(main);
      
      svg {
        display: block;
        width: 40px;
        height: 30px;
        
        @include responsive(md, min) {
          width: vw(40);
          height: vw(30);
        }
      }
    }

    &__line {
      background-color: color(main);
      display: block;
      position: absolute;
      top: 50%;
      left: 50%;
      
      &:nth-of-type(1) {
        width: 12px;
        height: 1px;
        border-radius: 0.5px;
        transform: translate(-50%, -50%);

        @include responsive(sm, min) {
          width: 9.59px;
          height: 0.8px;
          border-radius: 0.4px;
        }

        @include responsive(md, min) {
          width: vw(12);
          height: vw(1);
          border-radius: vw(0.5);
        }
      }

      &:nth-of-type(2) {
        width: 12px;
        height: 2px;
        border-radius: 1px;
        transform: translate(-50%, -50%) rotate(-90deg);

        @include responsive(sm, min) {
          width: 9.59px;
          height: 1.59px;
          border-radius: 0.795px;
        }

        @include responsive(md, min) {
          width: vw(12);
          height: vw(2);
          border-radius: vw(1);
        }
      }
    }
  }

</style>