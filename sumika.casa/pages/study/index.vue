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
                    <input type="checkbox" :id="'category-' + category.id" :value="category.cat_slug" v-model="selectedCategories">
                    <label :for="'category-' + category.id">{{ category.cat_name }}</label>
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
        <div class="p-studyIndex__item">
          <nuxt-link :to="`/study/${study.id}`" v-for="study in studies" :key="study.id" class="p-studyIndexItem">
            <span class="p-studyIndexItem__number">
              <span>{{ study.order }}</span>
            </span>
            <span class="p-studyIndexItem__title">
              <span>{{ study.title }}</span>
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

    data() {
      return {
        studies: [],
        categories: [],
        selectedCategories: [],
        currentPage: 1,
        perPage: 20,
        isLoading: false,
        isLastPage: false,
      }
    },

    computed: {

      bodyClass () {
        return 'p-studyIndex p-archive'
      }
    },

    mounted() {
      window.addEventListener('scroll', this.handleScroll)
      window.addEventListener('resize', this.handleResize)

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
          this.fetchStudies(this.currentPage)
        },
        deep: true,
      },
    },

    async asyncData({ $axios }) {
      try {
        const responseCategories = await $axios.get(`${process.env.VUE_APP_API_URL}/custom/v0/study_cat`)
        const responseStudies = await $axios.get(`${process.env.VUE_APP_API_URL}/custom/v0/studies`, {
          params: {
            per_page: 20,
            page: 1,
          },
        })

        return {
          categories: responseCategories.data,
          studies: responseStudies.data,
        }
      } catch (error) {
        console.error(error)
        return {
          categories: [],
          studies: [],
        }
      }
    },

    methods: {

      resetPagination () {
        this.currentPage = 1
        this.isLastPage = false
      },

      async fetchStudies (page) {
        try {
          const response = await this.$axios.get(`https://sumika.artche.jp/cms/wp-json/custom/v0/studies`, {
            params: {
              per_page: this.perPage,
              page: page,
              categories: this.selectedCategories,
            },
          })

          if (page === 1) {
            this.studies = response.data
          } else {
            this.studies = this.studies.concat(response.data)
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
          await this.fetchStudies(this.currentPage)
        }
      },

      selectAll (type, checked) {
        if (type === 'category') {
          if (checked) {
            this.selectedCategories = this.categories.map(category => category.id)
          } else {
            this.selectedCategories = []
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
    },
  }
</script>

<style lang="scss" scoped>

  .p-studyIndex {

    &__item {
      display: flex;
      flex-wrap: wrap;
      column-gap: per(24, 832);
      row-gap: rem(24);
    }
  }

  .p-studyIndexItem {
    $item: &;
    position: relative;
    display: inline-block;
    color: color(white);
    display: flex;
    overflow-x: scroll;

    @include hover {
    }

    &__number {
      @include Wandeln;
      display: flex;
      justify-content: center;
      align-items: center;
      color: color(beige);
      background-color: color(main);
      border-radius: rem(6) 0 0 rem(6);
      padding-top: rem(5);
      width: 40px;
      height: 40px;

      @include responsive(sm, min) {
        width: 32px;
        height: 32px;
      }

      @include responsive(md, min) {
        width: vw(40);
        height: vw(40);
        padding-top: vw(5);
        border-radius: vw(6) 0 0 vw(6);
      }

      span {
        @include font(24, 33, -60);

        @include responsive(md, min) {
          @include vwfont(1280, 24, 33, -60);
        }
      }
    }

    // .p-studyIndexItem__title
    &__title {
      color: color(main);
      border-radius: 0 rem(6) rem(6) 0;
      display: flex;
      align-items: center;
      background-color: color(beige);
      height: rem(40);
      padding-right: 8px;
      padding-left: 8px;
      
      @include responsive(sm, min) {
        padding-right: 6.4px;
        padding-left: 6.4px;
        height: rem(32);
      }

      @include responsive(md, min) {
        padding-right: vw(8);
        padding-left: vw(8);
        height: vw(40);
      }

      span {
        @include font(16, 24, 40, 500);
        white-space: nowrap;
    
        @include responsive(md, min) {
          @include vwfont(1280, 16, 24, 40, 500);
        }
      }
    }
  }

</style>