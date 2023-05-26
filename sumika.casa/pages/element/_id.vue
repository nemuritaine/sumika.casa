<template>
  <article class="p-elementDetail">
    <section class="p-elementDetailFacade">
      <div class="p-elementDetailFacade__inner">
        <div class="p-elementDetailFacade__wrapper">
          <div class="p-elementDetailFacade__heading">
            <div class="p-elementDetailFacade__brand">
              <span>{{ post.brand }}</span>
            </div>
            <div class="p-elementDetailFacade__title">
              <p>{{ post.title }}</p>
            </div>
          </div>
          <div class="p-elementDetailFacade__image">
            <div class="p-elementDetailFacadeImage">
              <img :src="post.thumbnail" alt="" width="" height="">
            </div>
          </div>
          <dl class="p-elementDetailFacade__detail">
            <dt>サイズ</dt>
            <dd></dd>
            <dt>値段</dt>
            <dd>JPY {{ post.price }}</dd>
          </dl>
          <div class="p-elementDetailFacade__button">
            <a :href="post.affiliate">詳しくみる</a>
          </div>
        </div>
      </div>
    </section>
    <section class="p-elementDetailRoom" v-if="post.room_data && post.room_data.length > 0">
      <div class="p-elementDetailRoom__inner">
        <div class="p-elementDetailRoom__title">
          <p>このアイテムを使ったお部屋</p>
        </div>
        <div class="p-elementDetailRoom__item">
          <div v-for="room in post.room_data" :key="room.id" class="p-elementDetailRoomItem">
            <a :href="`/article/${room.id}`" class="p-elementDetailRoomItem__link">
              <div class="p-elementDetailRoomItem__image">
                <img :src="room.thumbnail" alt="" width="" height="">
              </div>
              <div class="p-elementDetailRoomItem__detail">
                <div class="p-elementDetailRoomItem__title">
                  <span>room</span>
                </div>
                <div class="p-elementDetailRoomItem__text">
                  <h3>{{ room.title }}</h3>
                </div>
                <ul class="p-elementDetailRoomItem__tag">
                  <li v-for="(tag, index) in room.tags" :key="tag.term_id">#{{ tag.name }}</li>
                </ul>
                <div class="p-elementDetailRoomItem__button">
                  <p>お部屋を見る</p>
                  <svg>
                    <use xlink:href="@/static/assets/images/common/graphics.svg#ico_arrowRight"></use>
                  </svg>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
    <section class="p-elementDetailCarousel">
      <div class="p-elementDetailCarousel__inner">
        <div v-for="carousel in post.carousel_data" :key="carousel.taxonomy_slug" class="p-elementDetailCarousel__wrapper" ref="elementDetailCarousel__wrapper">
          <div class="p-elementDetailCarousel__item">
            <a
              v-for="post in carousel.posts"
              :key="post.ID"
              :href="`/element/${post.ID}`"
              class="p-elementDetailCarouselItem"
            >
              <div class="p-elementDetailCarouselItem__image">
                <img :src="post.thumbnail" :alt="post.title" />
              </div>
              <div class="p-elementDetailCarouselItem__title">
                <span>{{ carousel.taxonomy_slug }}</span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
    <section class="p-elementDetailCoordination" v-if="post.coordination_data && post.coordination_data.length > 0">
      <div class="p-elementDetailCoordination__inner">
        <div class="p-elementDetailCoordination__carousel splide">
          <div class="p-elementDetailCoordination__heading">
            <div class="p-elementDetailCoordination__title">
              <p>このアイテムを使った組み合わせ</p>
            </div>
            <div class="p-elementDetailCoordination__controller">
              <div class="c-controller">
                <div class="c-controller__counter">
                  <span class="c-controllerCounter --current">{{ coordinationCurrentSlideNumber.toString().padStart(2, '0') }}</span>
                  <span class="c-controllerCounter --total">{{ coordinationTotalSlides.toString().padStart(2, '0') }}</span>
                </div>
                <div class="c-controller__navigation splide__arrows">
                  <div class="c-controllerNavigation --prev splide__arrow--prev">
                    <div class="c-controllerNavigation__icon">
                      <svg class="c-controllerNavigationIcon --arrow">
                        <use xlink:href="@/static/assets/images/common/graphics.svg#ico_arrowRight"></use>
                      </svg>
                      <svg class="c-controllerNavigationIcon --frame">
                        <use xlink:href="@/static/assets/images/common/graphics.svg#ico_frame"></use>
                      </svg>
                    </div>
                  </div>
                  <div class="c-controllerNavigation --next splide__arrow--next">
                    <div class="c-controllerNavigation__icon">
                      <svg class="c-controllerNavigationIcon --arrow">
                        <use xlink:href="@/static/assets/images/common/graphics.svg#ico_arrowRight"></use>
                      </svg>
                      <svg class="c-controllerNavigationIcon --frame">
                        <use xlink:href="@/static/assets/images/common/graphics.svg#ico_frame"></use>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="p-elementDetailCoordinationCarousel splide__track">
            <ul class="p-elementDetailCoordinationCarousel__card splide__list">
              <li class="c-elementCard splide__slide" v-for="coordination in post.coordination_data" :key="coordination.id">
                <a class="c-elementCard__link" :href="`/element/${coordination.id}`">
                  <span class="c-elementCard__detail">
                    <span class="c-elementCard__title">{{ coordination.brand }}</span>
                    <span class="c-elementCard__price">{{ coordination.price }}</span>
                  </span>
                  <span class="c-elementCard__like">
                    <span class="c-elementCardLike__icon">
                      <svg>
                        <use xlink:href="@/static/assets/images/common/graphics.svg#ico_heart"></use>
                      </svg>
                    </span>
                    <span class="c-elementCardLike__text">23</span>
                  </span>
                  <span class="c-elementCard__image">
                    <img :src="coordination.thumbnail" alt="" width="" height="">
                  </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section class="p-elementDetailRelation" v-if="post.relation_data && post.relation_data.length > 0">
      <div class="p-elementDetailRelation__inner">
        <div class="p-elementDetailRelation__copy">
          <span>Always</span>
          <span>looking</span>
          <span>for</span>
          <span>innovative</span>
          <span>and</span>
          <span>unique</span>
          <span>solutions</span>
        </div>
        <div class="p-elementDetailRelation__carousel splide">
          <div class="p-elementDetailRelation__heading">
            <div class="p-elementDetailRelation__title">
              <p>関連するアイテム</p>
            </div>
            <div class="p-elementDetailRelation__controller">
              <div class="c-controller">
                <div class="c-controller__counter">
                  <span class="c-controllerCounter --current">{{ relationCurrentSlideNumber.toString().padStart(2, '0') }}</span>
                  <span class="c-controllerCounter --total">{{ relationTotalSlides.toString().padStart(2, '0') }}</span>
                </div>
                <div class="c-controller__navigation splide__arrows">
                  <div class="c-controllerNavigation --prev splide__arrow--prev">
                    <div class="c-controllerNavigation__icon">
                      <svg class="c-controllerNavigationIcon --arrow">
                        <use xlink:href="@/static/assets/images/common/graphics.svg#ico_arrowRight"></use>
                      </svg>
                      <svg class="c-controllerNavigationIcon --frame">
                        <use xlink:href="@/static/assets/images/common/graphics.svg#ico_frame"></use>
                      </svg>
                    </div>
                  </div>
                  <div class="c-controllerNavigation --next splide__arrow--next">
                    <div class="c-controllerNavigation__icon">
                      <svg class="c-controllerNavigationIcon --arrow">
                        <use xlink:href="@/static/assets/images/common/graphics.svg#ico_arrowRight"></use>
                      </svg>
                      <svg class="c-controllerNavigationIcon --frame">
                        <use xlink:href="@/static/assets/images/common/graphics.svg#ico_frame"></use>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="p-elementDetailRelationCarousel splide__track">
            <ul class="p-elementDetailRelationCarousel__card splide__list">
              <li class="c-elementCard splide__slide" v-for="relation in post.relation_data" :key="relation.id">
                <a class="c-elementCard__link" :href="`/element/${relation.id}`">
                  <span class="c-elementCard__detail">
                    <span class="c-elementCard__title">{{ relation.brand }}</span>
                    <span class="c-elementCard__price">{{ relation.price }}</span>
                  </span>
                  <span class="c-elementCard__like">
                    <span class="c-elementCardLike__icon">
                      <svg>
                        <use xlink:href="@/static/assets/images/common/graphics.svg#ico_heart"></use>
                      </svg>
                    </span>
                    <span class="c-elementCardLike__text">23</span>
                  </span>
                  <span class="c-elementCard__image">
                    <img :src="relation.thumbnail" alt="" width="" height="">
                  </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <div class="p-elementDetailNews">
      <div class="p-elementDetailNews__inner">
        <div class="p-elementDetailNews__wrapper">
          <div class="p-elementDetailNews__title">
            <div class="p-elementDetailNewsTitle">
              <div class="p-elementDetailNewsTitle__en">
                <span class="p-elementDetailNewsTitleEn">News&<br class="u-device__min--sm">Event</span>
              </div>
              <div class="p-elementDetailNewsTitle__ja">
                <p class="p-elementDetailNewsTitleJa">お知らせとイベント</p>
              </div>
            </div>
          </div>
          <ul class="p-elementDetailNews__item">
            <li v-for="item in news" :key="item.id" class="p-elementDetailNewsItem">
              <a
                v-if="item.icon === 'arrow'"
                :href="`/news/${item.id}`"
                class="p-elementDetailNewsItem__link"
              >
                <span class="p-elementDetailNewsItem__heading">
                  <span class="p-elementDetailNewsItem__date">
                    <time>{{ item.time }}</time>
                  </span>
                  <span class="p-elementDetailNewsItem__category">{{ item.category_slug }}</span>
                </span>
                <div class="p-elementDetailNewsItem__main">
                  <p class="p-elementDetailNewsItem__title">{{ item.title }}</p>
                  <span class="p-elementDetailNewsItem__icon">
                    <span :class="`p-elementDetailNewsItemIcon--${item.icon}`">
                      <svg>
                        <use xlink:href="@/static/assets/images/common/graphics.svg#ico_arrowRight"></use>
                      </svg>
                    </span>
                    <span class="p-elementDetailNewsItemIcon--frame">
                      <svg>
                        <use xlink:href="@/static/assets/images/common/graphics.svg#ico_frame"></use>
                      </svg>
                    </span>
                  </span>
                </div>
              </a>
              <div
                v-else-if="item.icon === 'expansion'"
                class="p-elementDetailNewsItem__link is-accordion"
                @click="newsAccordion"
              >
                <span class="p-elementDetailNewsItem__heading">
                  <span class="p-elementDetailNewsItem__date">
                    <time>{{ item.time }}</time>
                  </span>
                  <span class="p-elementDetailNewsItem__category">{{ item.category_slug }}</span>
                </span>
                <div class="p-elementDetailNewsItem__main">
                  <p class="p-elementDetailNewsItem__title">{{ item.title }}</p>
                  <span class="p-elementDetailNewsItem__icon">
                    <span :class="`p-elementDetailNewsItemIcon--${item.icon}`">
                      <span class="p-elementDetailNewsItemIcon__line"></span>
                      <span class="p-elementDetailNewsItemIcon__line"></span>
                    </span>
                    <span class="p-elementDetailNewsItemIcon--frame">
                      <svg>
                        <use xlink:href="@/static/assets/images/common/graphics.svg#ico_frame"></use>
                      </svg>
                    </span>
                  </span>
                </div>
                <div v-if="item.icon === 'expansion'" class="p-elementDetailNewsItem__text">
                  <div class="p-elementDetailNewsItemText" v-html="item.content"></div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </article>
</template>

<script>
  import { gsap } from 'gsap'
  import Splide from '@splidejs/splide'
  import '@splidejs/splide/dist/css/splide.min.css'
  // import '@splidejs/splide/dist/css/themes/splide-default.min.css'

  export default {

    data() {
      return {
        news: [],
        coordinationCurrentSlideNumber: 0,
        coordinationTotalSlides: 0,
        relationCurrentSlideNumber: 0,
        relationTotalSlides: 0,
      }
    },

    async asyncData({ app, params, $axios }) {
      
      try {
        const responsePost = await $axios.$get(`${app.$url}/custom/v0/single_element?id=${params.id}`)
        const responseNews = await $axios.get(`${app.$url}/custom/v0/news`)
        return {
          post: responsePost,
          news: responseNews.data,
        }
      } catch (error) {
        return {
          post: [],
          news: [],
        }
      }
    },

    methods: {

      initNewsAccordions () {
        const newsAccordionElements = document.querySelectorAll('.p-elementDetailNewsItem__link.is-accordion .p-elementDetailNewsItem__text')
        newsAccordionElements.forEach((element) => {
          gsap.set(element, { height: 0, autoAlpha: 0 })
        })
      },

      newsAccordion (event) {
        const tl = gsap.timeline()
        const target = event.currentTarget
        const contentElement = target.querySelector('.p-elementDetailNewsItem__text')
        const iconElement = target.querySelectorAll('.p-elementDetailNewsItemIcon__line')

        if (gsap.getProperty(contentElement, 'autoAlpha') == 0) {
          tl.to(contentElement, { height: 'auto', autoAlpha: 1, duration: 0.3 })
            .to(iconElement[1], { rotate: 0, duration: 0.3 }, '<')
        } else {
          tl.to(contentElement, { height: 0, autoAlpha: 0, duration: 0.3 })
            .to(iconElement[1], { rotate: 90, duration: 0.3 }, '<')
        }
      },

      initializeCoordinationSplide () {
        const slidesPerPage = 5
        const splide = new Splide('.p-elementDetailCoordination__carousel', {
          type: 'slide',
          perPage: 5,
          autoWidth: true,
          width: null,
          gap: '1.5625vw',
          autoplay: false,
          interval: 2000,
          pauseOnHover: false,
          arrows: true,
          pagination: false,
          breakpoints: {
            767: {
              gap: null,
            },
          }
        }).mount()

        splide.on('moved', () => {
          this.coordinationCurrentSlideNumber = Math.ceil(splide.index / slidesPerPage) + 1
          this.coordinationTotalSlides = Math.ceil(splide.length / slidesPerPage)
        })

        splide.emit('moved')
      },

      destroyCoordinationSplide () {
        const splide = document.querySelector('.p-elementDetailCoordination__carousel')

        if (splide && splide.splide) {
          splide.splide.destroy()
        }
      },

      initializeRelationSplide () {
        const slidesPerPage = 5
        const splide = new Splide('.p-elementDetailRelation__carousel', {
          type: 'slide',
          perPage: 5,
          autoWidth: true,
          width: null,
          gap: '1.5625vw',
          autoplay: false,
          interval: 2000,
          pauseOnHover: false,
          arrows: true,
          pagination: false,
          breakpoints: {
            767: {
              gap: null,
            },
          }
        }).mount()

        splide.on('moved', () => {
          this.relationCurrentSlideNumber = Math.ceil(splide.index / slidesPerPage) + 1
          this.relationTotalSlides = Math.ceil(splide.length / slidesPerPage)
        })

        splide.emit('moved')
      },

      destroyRelationSplide () {
        const splide = document.querySelector('.p-elementDetailRelation__carousel')

        if (splide && splide.splide) {
          splide.splide.destroy()
        }
      },

      initCarousel () {
        const elements = this.$refs.elementDetailCarousel__wrapper

        async function processElements(elements) {

          const firstProcess = new Promise((resolve) => {
            elements.forEach(el => {
              el.appendChild(el.querySelector('.p-elementDetailCarousel__item').cloneNode(true))
            })
            resolve()
          })

          firstProcess.then(() => {
            elements.forEach(el => {
              el.classList.add('is-active')
            })
          })
        }
        processElements(elements)
      }
    },

    mounted () {
      this.initCarousel()
      this.initNewsAccordions()

      const splideCoordinationItem = document.querySelector('.p-elementDetailCoordination__carousel')
      const splideRelationItem = document.querySelector('.p-elementDetailRelation__carousel')
      
      if (splideCoordinationItem) {
        splideCoordinationItem.style.visibility = 'visible'
      }

      if (splideRelationItem) {
        splideRelationItem.style.visibility = 'visible'
      }

      if (window.innerWidth >= 768) {

        if (splideCoordinationItem) {
          this.initializeCoordinationSplide()
        }

        if (splideRelationItem) {
          this.initializeRelationSplide()
        }
      }

      window.addEventListener('resize', () => {
        
        if (window.innerWidth <= 768) {

          if (splideCoordinationItem) {
            this.destroyCoordinationSplide()
          }
          
          if (splideRelationItem) {
            this.destroyRelationSplide()
          }
        } else {

          if (splideCoordinationItem) {
            this.initializeCoordinationSplide()
          }

          if (splideRelationItem) {
            this.initializeRelationSplide()
          }
        }
      })
    },

    computed: {

      bodyClass () {
        return 'p-elementDetail'
      }
    },
  }
</script>


<style lang="scss" scoped>

.p-elementDetailFacade {

  &__inner {
    @include inner(lg);
  }
  
  &__wrapper {
    position: relative;

    @include responsive(sm, max) {
      display: flex;
      flex-direction: column;
    }
  }

  &__heading {
    display: contents;
    
    @include responsive(sm, min) {
      display: block;
      position: absolute;
      bottom: rem(16);
      left: 0;
    }

    @include responsive(md, min) {
      bottom: vw(16);
    }
  }

  &__detail {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
    
    @include responsive(sm, max) {
      order: 4;
      margin-top: rem(8);
    }
    
    @include responsive(sm, min) {
      width: 240px;
      position: absolute;
      top: rem(60);
    }

    @include responsive(md, min) {
      width: vw(240);
      top: vw(60);
    }

    dt {
      @include font(14, 21, 40, 700);
      width: per(120, 240);
      border-bottom: 1px solid #D9D9D9;
      padding-top: rem(12);
      padding-bottom: rem(12);

      @include responsive(md, min) {
        @include vwfont(1280, 14);
        border-bottom: vw(1) solid #D9D9D9;
        padding-top: vw(12);
        padding-bottom: vw(12);
      }
    }

    dd {
      @include font(14, 21, 40);
      width: per(120, 240);
      border-bottom: 1px solid #D9D9D9;
      padding-top: rem(12);
      padding-bottom: rem(12);

      @include responsive(md, min) {
        @include vwfont(1280, 14);
        border-bottom: vw(1) solid #D9D9D9;
        padding-top: vw(12);
        padding-bottom: vw(12);
      }
    }
  }

  &__brand {

    @include responsive(sm, max) {
      order: 1;
    }

    span {
      display: block;
      @include Wandeln;
      @include font(64, 60, -40);
      
      @include responsive(sm, max) {
        text-align: center;
      }
      
      @include responsive(sm, min) {
        @include font(96, 76.8);
      }

      @include responsive(md, min) {
        @include vwfont(1280, 96);
      }
    }
  }

  &__title {
    margin-top: rem(115);
    
    @include responsive(sm, max) {
      order: 3;
    }
    
    @include responsive(sm, min) {
      margin-top: rem(4);
      padding-left: 3px;
    }

    @include responsive(md, min) {
      margin-top: vw(4);
      padding-left: vw(3);
    }

    p {
      @include font(16, 24, 40, 700);

      @include responsive(sm, min) {
        @include font(18);
      }

      @include responsive(md, min) {
        @include vwfont(1280, 18);
      }
    }
  }

  &__image {
    display: flex;
    justify-content: center;
    position: relative;
    z-index: 1;
    pointer-events: none;

    @include responsive(sm, max) {
      order: 2;
      margin-top: rem(16);
    }
  }

  &__button {
    position: fixed;
    bottom: rem(67);
    z-index: 10;
    
    @include responsive(sm, max) {
      left: 20px;
      width: calc(100% - 40px);
    }
    
    @include responsive(sm, min) {
      position: absolute;
      bottom: rem(16);
      right: 0;
      z-index: 2;
    }

    @include responsive(md, min) {
      bottom: vw(16);
    }

    a {
      display: flex;
      justify-content: center;
      align-items: center;
      @include font(16, 24, 40, 700);
      color: color(white);
      background-color: color(main);
      height: rem(54);
      border-radius: rem(6);
      width: 100%;
      
      @include responsive(sm, min) {
        width: 180px;
      }

      @include responsive(md, min) {
        border-radius: vw(6);
        width: vw(180);
        height: vw(54);
        @include vwfont(1280, 16);
      }
    }
  }
}

.p-elementDetailFacadeImage {
  width: vw(220, 335);
  height: vw(220, 335);
  
  @include responsive(sm, min) {
    width: 440px;
    height: 440px;
  }

  @include responsive(md, min) {
    width: vw(440);
    height: vw(440);
  }

  img {
    width: 100%;
    height: 100%;
    object-fit: contain;
  }
}

.p-elementDetailRoom {
  margin-top: rem(80);

  @include responsive(sm, min) {
    margin-top: rem(120);
  }

  @include responsive(md, min) {
    margin-top: vw(120);
  }
  
  &__inner {
    @include inner(md);
  }

  &__title {

    p {
      @include font(14, 21, 40, 700);
    
      @include responsive(md, min) {
        @include vwfont(1280, 14);
      }
    }
  }

  &__item {
    margin-top: rem(16);

    @include responsive(md, min) {
      margin-top: vw(16);
    }
  }
}

.p-elementDetailRoomItem {
  border-top: 1px solid #D9D9D9;
  padding-top: rem(16);
  
  @include responsive(sm, min) {
    padding-top: rem(20);
  }

  @include responsive(md, min) {
    padding-top: vw(20);
  }
  
  &:not(:first-of-type) {
    margin-top: rem(48);
    
    @include responsive(sm, min) {
      margin-top: rem(40);
    }

    @include responsive(md, min) {
      margin-top: vw(40);
    }
  }

  &__link {
    
    @include responsive(sm, min) {
      display: flex;
      column-gap: per(40, 1040);
    }
  }

  // .p-elementDetailRoomItem__image
  &__image {
    aspect-ratio: 600 / 370;
    overflow: hidden;
    border-radius: rem(6);
    
    @include responsive(sm, min) {
      width: per(600, 1040);
    }

    @include responsive(md, min) {
      border-radius: vw(6);
    }

    // .p-elementDetailRoomItem__image img
    img {
      object-fit: cover;
      height: 100%;
      width: 100%;
    }
  }

  &__detail {
    padding-top: rem(20);
    position: relative;
    
    @include responsive(sm, min) {
      padding-top: rem(16);
      width: per(400, 1040);
    }

    @include responsive(md, min) {
      padding-top: vw(16);
    }
  }

  &__title {

    span {
      display: block;
      @include Alokary;
      @include font(24, 36, 100);

      @include responsive(sm, min) {
        @include font(32, 48);
      }

      @include responsive(md, min) {
        @include vwfont(1280, 32);
      }
    }
  }

  // .p-elementDetailRoomItem__text
  &__text {
    margin-top: rem(16);

    @include responsive(md, min) {
      margin-top: vw(16);
    }

    h3 {
      @include font(14, 25.2, 0, 400);

      @include responsive(md, min) {
        @include vwfont(1280, 14);
      }
    }
  }

  // .p-elementDetailRoomItem__tag
  &__tag {
    display: flex;
    column-gap: 16px;
    margin-top: rem(12);

    @include responsive(md, min) {
      column-gap: vw(16);
      margin-top: vw(12);
    }

    li {
      @include font(13, 18, 0);

      @include responsive(md, min) {
        @include vwfont(1280, 13);
      }
    }
  }

  // .p-elementDetailRoomItem__button
  &__button {
    color: color(main);
    width: 160px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: rem(8);
    padding-right: 2px;
    padding-left: 2px;
    border-bottom: 1px solid color(main);

    @include responsive(sm, max) {
      margin-top: rem(36);
    }
    
    @include responsive(sm, min) {
      width: 200px;
      position: absolute;
      bottom: 0;
    }

    @include responsive(md, min) {
      width: vw(200);
      padding-bottom: vw(8);
      padding-right: vw(2);
      padding-left: vw(2);
      border-bottom: vw(1) solid color(main);
    }

    p {
      @include font(14, 21, 40, 700);

      @include responsive(md, min) {
        @include vwfont(1280, 14);
      }
    }

    svg {
      display: block;
      width: 16px;
      height: 13px;

      @include responsive(sm, min) {
        width: 20px;
        height: 16px;
      }

      @include responsive(md, min) {
        width: vw(20);
        height: vw(16);
      }
    }
  }
}


.p-elementDetailCarousel {
  $this: &;
  margin-top: rem(80);

  @include responsive(sm, min) {
    margin-top: rem(120);
  }

  @include responsive(md, min) {
    margin-top: vw(120);
  }
  
  &__inner {
    padding-right: 20px;
    padding-left: 20px;

    @include responsive(sm, min) {
      padding-right: 40px;
      padding-left: 40px;
    }

    @include responsive(md, min) {
      padding-right: vw(40);
      padding-left: vw(40);
    }
  }

  &__wrapper {
    white-space: nowrap;
    border-bottom: 1px solid #D9D9D9;
    padding-top: rem(12);
    padding-bottom: rem(12);
    display: inline-flex;

    @include responsive(sm, min) {
      padding-top: rem(14);
      padding-bottom: rem(14);
    }
    
    @include responsive(md, min) {
      border-bottom: vw(1) solid #D9D9D9;
      padding-top: vw(14);
      padding-bottom: vw(14);
    }

    &:first-child {
      border-top: 1px solid #D9D9D9;

      @include responsive(md, min) {
        border-top: vw(1) solid #D9D9D9;
      }
    }

    &.is-active {

      &:nth-of-type(odd) {
  
        #{$this}__item {
  
          &:nth-of-type(1) {
            animation: infiniteAnimation 40s -20s linear infinite reverse;
          }
          
          &:nth-of-type(2) {
            animation: infiniteAnimationClone 40s linear infinite reverse;
          }
        }
      }
  
      &:nth-of-type(even) {
  
        #{$this}__item {
          &:nth-of-type(1) {
            animation: infiniteAnimation 40s -20s linear infinite;
          }
          
          &:nth-of-type(2) {
            animation: infiniteAnimationClone 40s linear infinite;
          }
        }
      }
    }
  }

  // .p-elementDetailCarousel__item
  &__item {
    white-space: nowrap;
    display: inline-flex;
    flex: 0 0 auto;
  }
}

.p-elementDetailCarouselItem {
  display: inline-flex;
  align-items: center;
  flex: 0 0 auto;

  &__image {

    img {
      width: 100%;
      height: 100%;
      max-width: 50px;
      max-height: 50px;
      object-fit: contain;

      @include responsive(sm, min) {
        max-width: 78px;
        max-height: 78px;
      }

      @include responsive(md, min) {
        max-width: vw(78);
        max-height: vw(78);
      }
    }
  }

  // .p-elementDetailCarouselItem__title
  &__title {
    padding-left: 12px;
    padding-right: 12px;

    @include responsive(sm, min) {
      padding-left: 18px;
      padding-right: 16px;
    }

    @include responsive(md, min) {
      padding-left: vw(18);
      padding-right: vw(16);
    }

    span {
      display: block;
      position: relative;
      top: rem(4);
      @include Wandeln;
      @include font(48, 48, 0);

      @include responsive(sm, min) {
        top: rem(6);
        @include font(64, 64, 0);
      }

      @include responsive(md, min) {
        top: vw(6);
        @include vwfont(1280, 64);
      }
    }
  }
}


.p-elementDetailCoordination {
  margin-top: rem(80);
  
  @include responsive(sm, min) {
    margin-top: rem(120);
  }

  @include responsive(md, min) {
    margin-top: vw(120);
  }

  &__inner {
    @include inner(md);
  }

  &__heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  &__title {

    p {
      @include font(14, 21, 40, 700);
  
      @include responsive(md, min) {
        @include vwfont(1280, 14);
      }
    }
  }

  &__controller {
    display: none;

    @include responsive(sm, min) {
      display: flex;
      align-items: center;
    }
  }
}

.p-elementDetailCoordinationCarousel {
  margin-top: rem(16);
  
  @include responsive(sm, max) {
    overflow: visible;
  }

  @include responsive(md, min) {
    margin-top: vw(16);
  }

  // .p-elementDetailCoordinationCarousel__card
  &__card {
    
    @include responsive(sm, max) {
      white-space: nowrap;
      overflow-x: scroll;
      -ms-overflow-style: none;
      scrollbar-width: none;
      width: calc(100% + 40px);
      margin-left: -20px !important;
      padding-left: 20px !important;
      padding-right: 20px !important;
    }

    &::-webkit-scrollbar {

      @include responsive(sm, max) {
        display: none;
      }
    }
  }
}


.p-elementDetailRelation {
  margin-top: rem(80);

  @include responsive(sm, min) {
    margin-top: rem(120);
  }

  @include responsive(md, min) {
    margin-top: vw(120);
  }

  &__inner {
    @include inner(md);
  }

  &__copy {
    text-align: center;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    column-gap: 8px;
    
    @include responsive(sm, min) {
      column-gap: 16px;
    }

    @include responsive(md, min) {
      column-gap: vw(16);
    }

    span {
      @include Wandeln;
      @include font(48, 48, 0);

      @include responsive(sm, min) {
        @include font(64, 70, 0);
      }

      @include responsive(md, min) {
        @include vwfont(1280, 64);
      }
    }
  }

  &__heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: rem(80);
    
    @include responsive(sm, min) {
      margin-top: rem(120);
    }

    @include responsive(md, min) {
      margin-top: vw(120);
    }
  }

  &__title {

    p {
      @include font(14, 21, 40, 700);
  
      @include responsive(md, min) {
        @include vwfont(1280, 14);
      }
    }
  }

  &__controller {
    display: none;

    @include responsive(sm, min) {
      display: flex;
      align-items: center;
    }
  }
}

.p-elementDetailRelationCarousel {
  margin-top: rem(16);

  @include responsive(sm, max) {
    overflow: visible;
  }

  @include responsive(md, min) {
    margin-top: vw(16);
  }

  &__card {

    @include responsive(sm, max) {
      white-space: nowrap;
      overflow-x: scroll;
      -ms-overflow-style: none;
      scrollbar-width: none;
      width: calc(100% + 40px);
      margin-left: -20px !important;
      padding-left: 20px !important;
      padding-right: 20px !important;
    }

    &::-webkit-scrollbar {

      @include responsive(sm, max) {
        display: none;
      }
    }
  }
}

.p-elementDetailNews {
  background-color: color(white);
  margin-top: rem(72);
  padding-top: rem(72);
  padding-bottom: rem(140);

  @include responsive(md, min) {
    margin-top: vw(120);
    padding-top: vw(100);
    padding-bottom: vw(100);
  }

  &__inner {
    @include inner(md);
  }

  &__wrapper {
    
    @include responsive(sm, min) {
      display: flex;
      padding-left: per(40, 1040);
      column-gap: per(80, 1000);
    }
  }

  &__title {
    
    @include responsive(sm, min) {
      width: per(240, 1000);
    }
  }

  &__item {

    @include responsive(sm, max) {
      margin-top: rem(14);
    }

    @include responsive(sm, min) {
      width: per(680, 1000);
    }
  }
}

.p-elementDetailNewsTitle {

  &__en {

  }

  &__ja {
    margin-top: vw(14);
  }
}

.p-elementDetailNewsTitleEn {
  @include Alokary;
  color: color(main);
  @include font(20, 30, 100);
  
  @include responsive(md, min) {
    @include vwfont(1280, 36, 56, 100);
  }
}

.p-elementDetailNewsTitleJa {
  @include font(14, 26, 40, 500);
  
  @include responsive(md, min) {
    @include vwfont(1280, 14);
  }
}

// p-elementDetailNewsItem
.p-elementDetailNewsItem {
  border-bottom: 1px solid color(lightgray);
  
  // p-elementDetailNewsItem__link
  &__link {
    display: block;
    padding-top: rem(18);
    padding-bottom: rem(18);
    cursor: pointer;

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

  // .p-elementDetailNewsItem__date
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
    position: relative;
    margin-top: rem(8);

    @include responsive(sm, min) {
      margin-top: rem(6.4);
    }

    @include responsive(md, min) {
      margin-top: vw(8);
    }
  }

  // .p-elementDetailNewsItem__title
  &__title {
    @include font(14, 22, 40);
    padding-right: 57px;

    @include responsive(sm, min) {
    }

    @include responsive(md, min) {
      @include vwfont(1280, 14);
      padding-right: vw(80);
    }
  }

  &__icon {
    position: absolute;
    right: 0;
    top: rem(-5);
    width: 40px;
    height: 30px;
    
    @include responsive(md, min) {
      width: vw(40);
      height: vw(30);
      top: vw(-5);
    }
  }

  // .p-elementDetailNewsItem__category
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

.p-elementDetailNewsItemText {
  margin-top: rem(20);
  padding-right: 57px;

  @include responsive(md, min) {
    padding-right: vw(80);
  }
}

.p-elementDetailNewsItemIcon {
  $this: &;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);

  &--expansion {
    @extend .p-elementDetailNewsItemIcon;
    width: 12px;
    height: 12px;

    @include responsive(sm, min) {
      width: 10px;
      height: 10px;
    }

    @include responsive(md, min) {
      width: vw(12);
      height: vw(12);
    }
  }

  // .p-elementDetailNewsItemIcon--arrow
  &--arrow {
    @extend .p-elementDetailNewsItemIcon;
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
    display: block;
    color: color(main);
    
    svg {
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
        width: 10px;
        height: 1px;
        border-radius: 0.5px;
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
        width: 10px;
        height: 2px;
        border-radius: 1px;
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