<template>
  <div>
    <TopFacade />

    <div id="element" class="p-topElement">
      <div class="p-topElement__inner">
        <div class="p-topElement__heading">
          <div class="p-topElement__title">
            <div class="p-topElementTitle">
              <div class="p-topElementTitle__text">Element</div>
              <div class="p-topElementTitle__number">
                <div class="p-topElementTitleNumber">
                  <div class="p-topElementTitleNumber__brackets">(</div>
                  <div class="p-topElementTitleNumber__text">{{ counts.element }}</div>
                  <div class="p-topElementTitleNumber__brackets">)</div>
                </div>
              </div>
            </div>
          </div>
          <div class="p-topElement__text">
            <p class="p-topElementText">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
          </div>
        </div>
        <div class="p-topElement__slider splide">
          <div class="p-topElementSlider__heading">
            <div class="p-topElementSlider__sort">
              <div class="c-sort">
                <div class="c-sort__title">
                  <div class="c-sortTitle">アイテムを絞り込む</div>
                </div>
                <div class="c-sort__type">
                  <div class="c-sortType">
                    <div class="c-sortType__title">種類</div>
                    <div class="c-sortType__selector">
                      <div class="c-sortTypeSelector">
                        <select name="category" v-model="selectedItemCategory">
                          <option value="">すべて</option>
                          <option v-for="item in itemClasses" :key="item.id" :value="`${item.cat_slug}`">{{ item.cat_name }}</option>
                        </select>
                        <div class="c-sortTypeSelector__icon">
                          <div class="c-sortTypeSelectorIcon"></div>
                          <div class="c-sortTypeSelectorIcon"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="c-sortType">
                    <div class="c-sortType__title">ブランド</div>
                    <div class="c-sortType__selector">
                      <div class="c-sortTypeSelector">
                        <select name="brand" v-model="selectedItemBrand">
                          <option value="">すべて</option>
                          <option v-for="brand in itemBrands" :key="brand.id" :value="`${brand.cat_slug}`">{{ brand.cat_name }}</option>
                        </select>
                        <div class="c-sortTypeSelector__icon">
                          <div class="c-sortTypeSelectorIcon"></div>
                          <div class="c-sortTypeSelectorIcon"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="c-sortType">
                    <div class="c-sortType__title">値段</div>
                    <div class="c-sortType__selector">
                      <div class="c-sortTypeSelector">
                        <select name="price" v-model="selectedItemPrice">
                          <option value="">すべて</option>
                          <option v-for="price in itemPrices" :key="price.id" :value="`${price.cat_slug}`">{{ price.cat_name }}</option>
                        </select>
                        <div class="c-sortTypeSelector__icon">
                          <div class="c-sortTypeSelectorIcon"></div>
                          <div class="c-sortTypeSelectorIcon"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="p-topElementSlider__controller">
              <div class="p-topElementSlider__line">
                <span></span>
              </div>
              <div class="c-controller">
                <div class="c-controller__counter">
                  <span class="c-controllerCounter --current">{{ elementCurrentSlideNumber.toString().padStart(2, '0') }}</span>
                  <span class="c-controllerCounter --total">{{ elementTotalSlides.toString().padStart(2, '0') }}</span>
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
          <div class="p-topElementSlider splide__track">
            <ul class="p-topElementSlider__card splide__list">
              <li class="p-topElementSliderCard splide__slide" v-for="item in items" :key="item.id">
                <a class="p-topElementSliderCard__link" :href="`/element/${item.id}`">
                  <span class="p-topElementSliderCard__detail">
                    <span class="p-topElementSliderCard__title">{{ item.brand }}</span>
                    <span class="p-topElementSliderCard__price">{{ item.price }}</span>
                  </span>
                  <span class="p-topElementSliderCard__like">
                    <span class="p-topElementSliderCardLike__icon">
                      <svg>
                        <use xlink:href="@/static/assets/images/common/graphics.svg#ico_heart"></use>
                      </svg>
                    </span>
                    <span class="p-topElementSliderCardLike__text">23</span>
                  </span>
                  <span class="p-topElementSliderCard__image">
                    <img :src="item.image_src" alt="" width="" height="">
                  </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="p-topElement__button">
          <div class="p-topButton">
            <a class="p-topButton__link" href="/element">
              <span class="p-topButton__text">
                <span>VIEW ALL</span>
              </span>
              <span class="p-topButton__icon">
                <svg>
                  <use xlink:href="@/static/assets/images/common/graphics.svg#ico_arrowRight"></use>
                </svg>
              </span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div id="reading" class="p-topColumn">
      <div class="p-topColumn__inner">
        <div class="p-topColumn__title">
          <div class="p-topColumnTitle">
            <div class="p-topColumnTitle__text">Article</div>
            <div class="p-topColumnTitle__number">
              <div class="p-topColumnTitleNumber">
                <div class="p-topColumnTitleNumber__brackets">(</div>
                <div class="p-topColumnTitleNumber__text">{{ counts.post }}</div>
                <div class="p-topColumnTitleNumber__brackets">)</div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="p-topColumn__slider splide">
          <div class="p-topColumn__heading">
            <div class="p-topColumn__text">
              <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
            </div>
            <div class="p-topColumn__controller">
              <div class="c-controller">
                <div class="c-controller__counter">
                  <span class="c-controllerCounter --current">{{ articleCurrentSlideNumber.toString().padStart(2, '0') }}</span>
                  <span class="c-controllerCounter --total">{{ articleTotalSlides.toString().padStart(2, '0') }}</span>
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
          <div class="p-topColumnSlider splide__track">
            <div class="p-topColumn__article splide__list">
              <div class="splide__slide p-topColumnArticle" v-for="article in articles" :key="article.id">
                <a :href="`/article/${article.id}`" class="p-topColumnArticle__link">
                  <div class="p-topColumnArticle__image">
                    <img :src="article.image_src" alt="" width="" height="">
                  </div>
                  <div class="p-topColumnArticle__detail">
                    <ul class="p-topColumnArticle__tag" v-if="article.tags && article.tags.length">
                      <li v-for="(tag, index) in article.tags" :key="tag.term_id">{{ tag.name }}</li>
                    </ul>
                    <p class="p-topColumnArticle__title">{{ article.title }}</p>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="p-topColumn__button">
          <div class="p-topButton">
            <div class="p-topButton__line"></div>
            <a class="p-topButton__link" href="/article">
              <span class="p-topButton__text">
                <span>VIEW ALL</span>
              </span>
              <span class="p-topButton__icon">
                <svg>
                  <use xlink:href="@/static/assets/images/common/graphics.svg#ico_arrowRight"></use>
                </svg>
              </span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div id="study" class="p-topStudy">
      <div class="p-topStudy__inner">
        <div class="p-topStudy__heading">
          <div class="p-topStudy__title">
            <div class="p-topStudyTitle">
              <div class="p-topStudyTitle__text">Study</div>
              <div class="p-topStudyTitle__number">
                <div class="p-topStudyTitleNumber">
                  <div class="p-topStudyTitleNumber__brackets">(</div>
                  <div class="p-topStudyTitleNumber__text">{{ counts.study }}</div>
                  <div class="p-topStudyTitleNumber__brackets">)</div>
                </div>
              </div>
            </div>
          </div>
          <div class="p-topStudy__text">
            <p class="p-topStudyText">インテリア資格試験の勉強に役立つ情報トテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
          </div>
        </div>
        <div class="p-topStudy__sort">
          <div class="c-sort">
            <div class="c-sort__title">
              <div class="c-sortTitle">科目を絞り込む</div>
            </div>
            <div class="c-sort__type">
              <div class="c-sortType">
                <div class="c-sortType__title">科目</div>
                <div class="c-sortType__selector">
                  <div class="c-sortTypeSelector --border">
                    <select name="category" v-model="selectedStudyCategory">
                      <option value="">すべて</option>
                      <option v-for="category in studyCategories" :key="category.id" :value="`${category.cat_slug}`">{{ category.cat_name }}</option>
                    </select>
                    <div class="c-sortTypeSelector__icon">
                      <div class="c-sortTypeSelectorIcon"></div>
                      <div class="c-sortTypeSelectorIcon"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="p-topStudy__article">
          <div class="p-topStudyArticle">
            <ul class="p-topStudyArticle__item">
              <li v-for="study in studies" :key="study.id" class="p-topStudyArticleItem">
                <span class="p-topStudyArticleItem__link">
                <!-- <a :href="`/study/${study.id}`" class="p-topStudyArticleItem__link"> -->
                  <span class="p-topStudyArticleItem__number">
                    <span class="p-topStudyArticleItemNumber">{{ study.order }}</span>
                  </span>
                  <span class="p-topStudyArticleItem__title">
                    <span class="p-topStudyArticleItemTitle">{{ study.title }}</span>
                  </span>
                </span>
                <!-- </a> -->
              </li>
            </ul>
            <ul class="p-topStudyArticle__item">
              <li v-for="study in studies" :key="study.id" class="p-topStudyArticleItem">
                <span class="p-topStudyArticleItem__link">
                <!-- <a :href="`/study/${study.id}`" class="p-topStudyArticleItem__link"> -->
                  <span class="p-topStudyArticleItem__number">
                    <span class="p-topStudyArticleItemNumber">{{ study.order }}</span>
                  </span>
                  <span class="p-topStudyArticleItem__title">
                    <span class="p-topStudyArticleItemTitle">{{ study.title }}</span>
                  </span>
                </span>
                <!-- </a> -->
              </li>
            </ul>
          </div>
        </div>
        <div class="p-topStudy__button">
          <div class="p-topButton">
            <div class="p-topButton__line"></div>
            <span class="p-topButton__link">
            <!-- <a class="p-topButton__link" href="/study"> -->
              <span class="p-topButton__text">
                <span>VIEW ALL</span>
              </span>
              <span class="p-topButton__icon">
                <svg>
                  <use xlink:href="@/static/assets/images/common/graphics.svg#ico_arrowRight"></use>
                </svg>
              </span>
            </span>
            <!-- </a> -->
          </div>
        </div>
      </div>
    </div>
    
    <div id="news" class="p-topNews">
      <div class="p-topNews__inner">
        <div class="p-topNews__wrapper">
          <div class="p-topNews__title">
            <div class="p-topNewsTitle">
              <div class="p-topNewsTitle__en">
                <span class="p-topNewsTitleEn">News&<br class="u-device__min--sm">Event</span>
              </div>
              <div class="p-topNewsTitle__ja">
                <p class="p-topNewsTitleJa">お知らせとイベント</p>
              </div>
            </div>
          </div>
          <div class="p-topNews__body">
            <ul class="p-topNews__item">
              <li v-for="item in news" :key="item.id" class="p-topNewsItem">
                <a
                  v-if="item.icon === 'arrow'"
                  :href="`/news/${item.id}`"
                  class="p-topNewsItem__link"
                >
                  <span class="p-topNewsItem__heading">
                    <span class="p-topNewsItem__date">
                      <time>{{ item.time }}</time>
                    </span>
                    <span class="p-topNewsItem__category">{{ item.category_slug }}</span>
                  </span>
                  <div class="p-topNewsItem__main">
                    <p class="p-topNewsItem__title">{{ item.title }}</p>
                    <span class="p-topNewsItem__icon">
                      <span :class="`p-topNewsItemIcon--${item.icon}`">
                        <svg>
                          <use xlink:href="@/static/assets/images/common/graphics.svg#ico_arrowRight"></use>
                        </svg>
                      </span>
                      <span class="p-topNewsItemIcon--frame">
                        <svg>
                          <use xlink:href="@/static/assets/images/common/graphics.svg#ico_frame"></use>
                        </svg>
                      </span>
                    </span>
                  </div>
                </a>
                <div
                  v-else-if="item.icon === 'expansion'"
                  class="p-topNewsItem__link is-accordion"
                  @click="newsAccordion"
                >
                  <span class="p-topNewsItem__heading">
                    <span class="p-topNewsItem__date">
                      <time>{{ item.time }}</time>
                    </span>
                    <span class="p-topNewsItem__category">{{ item.category_slug }}</span>
                  </span>
                  <div class="p-topNewsItem__main">
                    <p class="p-topNewsItem__title">{{ item.title }}</p>
                    <span class="p-topNewsItem__icon">
                      <span :class="`p-topNewsItemIcon--${item.icon}`">
                        <span class="p-topNewsItemIcon__line"></span>
                        <span class="p-topNewsItemIcon__line"></span>
                      </span>
                      <span class="p-topNewsItemIcon--frame">
                        <svg>
                          <use xlink:href="@/static/assets/images/common/graphics.svg#ico_frame"></use>
                        </svg>
                      </span>
                    </span>
                  </div>
                  <div v-if="item.icon === 'expansion'" class="p-topNewsItem__text">
                    <div class="p-topNewsItemText" v-html="item.content"></div>
                  </div>
                </div>
              </li>
            </ul>
            <div class="p-topNews__button">
              <div class="p-topButton">
                <a class="p-topButton__link" href="/news">
                  <span class="p-topButton__text">
                    <span>VIEW ALL</span>
                  </span>
                  <span class="p-topButton__icon">
                    <svg>
                      <use xlink:href="@/static/assets/images/common/graphics.svg#ico_arrowRight"></use>
                    </svg>
                  </span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { gsap } from 'gsap'
  import Splide from '@splidejs/splide'
  import '@splidejs/splide/dist/css/splide.min.css'
  // import '@splidejs/splide/dist/css/themes/splide-default.min.css'

  export default {
    name: 'IndexPage',

    data () {
      return {
        items: [],
        itemClasses: [],
        itemPrices: [],
        articles: [],
        studies: [],
        studyCategories: [],
        news: [],
        counts: [],
        selectedStudyCategory: '',
        selectedItemCategory: '',
        selectedItemBrand: '',
        selectedItemPrice: '',
        articleCurrentSlideNumber: 0,
        articleTotalSlides: 0,
        elementCurrentSlideNumber: 0,
        elementTotalSlides: 0,
      }
    },

    async asyncData({ $axios }) {
      try {
        const responseArticles = await $axios.get(`${process.env.VUE_APP_API_URL}/custom/v0/posts`)
        const responseNews = await $axios.get(`${process.env.VUE_APP_API_URL}/custom/v0/news`)
        const responseStudies = await $axios.get(`${process.env.VUE_APP_API_URL}/custom/v0/studies`)
        const responseStudyCategories = await $axios.get(`${process.env.VUE_APP_API_URL}/custom/v0/study_cat`)
        const responseItems = await $axios.get(`${process.env.VUE_APP_API_URL}/custom/v0/elements`)
        const responseItemClasses = await $axios.get(`${process.env.VUE_APP_API_URL}/custom/v0/element_class`)
        const responseItemPrices = await $axios.get(`${process.env.VUE_APP_API_URL}/custom/v0/element_price`)
        const responseItembrands = await $axios.get(`${process.env.VUE_APP_API_URL}/custom/v0/element_brand`)
        const responsePostsCounts = await $axios.$get(`${process.env.VUE_APP_API_URL}/custom/v0/counts`)
        
        return {
          articles: responseArticles.data,
          news: responseNews.data,
          studies: responseStudies.data,
          studyCategories: responseStudyCategories.data,
          items: responseItems.data,
          itemClasses: responseItemClasses.data,
          itemPrices: responseItemPrices.data,
          itemBrands: responseItembrands.data,
          counts: responsePostsCounts,
        }
        
      } catch (error) {
        
        return {
          articles: [],
          news: [],
          studies: [],
          studyCategories: [],
          items: [],
          itemClasses: [],
          itemPrices: [],
          itemBrands: [],
          counts: [],
        }
      }
    },

    watch: {
      async selectedStudyCategory () {
        await this.fetchStudies()
      },
      async selectedItemCategory () {
        await this.fetchItems()
      },
      async selectedItemBrand () {
        await this.fetchItems()
      },
      async selectedItemPrice () {
        await this.fetchItems()
      },
    },

    mounted () {
      this.initNewsAccordions()

      if (process.client) {
        const splideArtileItem = document.querySelector('.p-topColumn__slider')
        const splideElementItem = document.querySelector('.p-topElement__slider')
        splideArtileItem.style.visibility = 'visible'
        splideElementItem.style.visibility = 'visible'

        if (window.innerWidth >= 768) {
          this.initializeElementSplide()
          this.initializeArticleSplide()
        }

        window.addEventListener('resize', () => {
          
          if (window.innerWidth < 768) {
            this.destroyElementSplide()
            this.destroyArticleSplide()
          } else {
            this.initializeElementSplide()
            this.initializeArticleSplide()
          }
        })
      }
    },

    methods: {
      async fetchStudies () {
        try {
          const responseStudies = await this.$axios.get(`https://sumika.artche.jp/cms/wp-json/custom/v0/studies`, {
            params: {
              'categories[]': this.selectedStudyCategory,
            },
          })
          this.studies = responseStudies.data
        } catch (error) {
          console.log(error)
          this.studies = []
        }
      },

      async fetchItems () {
        try {
          let url = `https://sumika.artche.jp/cms/wp-json/custom/v0/elements`
          const queryParams = [
            { key: "classes", value: this.selectedItemCategory },
            { key: "brands", value: this.selectedItemBrand },
            { key: "prices", value: this.selectedItemPrice },
          ]
            .filter((param) => param.value)
            .map((param) => `${param.key}[]=${param.value}`)
            .join("&")

          url = queryParams ? `${url}?${queryParams}` : url
          const responseItems = await this.$axios.get(url)
          this.items = responseItems.data
        } catch (error) {
          console.log(error)
          this.items = []
        }
      },

      initNewsAccordions () {
        const newsAccordionElements = document.querySelectorAll('.p-topNewsItem__link.is-accordion .p-topNewsItem__text')
        newsAccordionElements.forEach((element) => {
          gsap.set(element, { height: 0, autoAlpha: 0 })
        })
      },

      newsAccordion (event) {
        const tl = gsap.timeline()
        const target = event.currentTarget
        const contentElement = target.querySelector('.p-topNewsItem__text')
        const iconElement = target.querySelectorAll('.p-topNewsItemIcon__line')

        if (gsap.getProperty(contentElement, 'autoAlpha') == 0) {
          tl.to(contentElement, { height: 'auto', autoAlpha: 1, duration: 0.3 })
            .to(iconElement[1], { rotate: 0, duration: 0.3 }, '<')
        } else {
          tl.to(contentElement, { height: 0, autoAlpha: 0, duration: 0.3 })
            .to(iconElement[1], { rotate: 90, duration: 0.3 }, '<')
        }
      },

      initializeArticleSplide () {
        const slidesPerPage = 4
        const splide = new Splide('.p-topColumn__slider', {
          type: 'slide',
          perPage: 4,
          autoWidth: true,
          width: null,
          gap: '2.34375vw',
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
          this.articleCurrentSlideNumber = Math.floor(splide.index / slidesPerPage) + 1
          this.articleTotalSlides = Math.ceil(splide.length / slidesPerPage)
        })

        splide.emit('moved')
      },

      destroyArticleSplide () {
        const splide = document.querySelector('.p-topColumn__slider')

        if (splide && splide.splide) {
          splide.splide.destroy()
        }
      },

      initializeElementSplide () {
        const slidesPerPage = 5
        const splide = new Splide('.p-topElement__slider', {
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
          this.elementCurrentSlideNumber = Math.ceil(splide.index / slidesPerPage) + 1
          this.elementTotalSlides = Math.ceil(splide.length / slidesPerPage)
        })

        splide.emit('moved')
      },

      destroyElementSplide () {
        const splide = document.querySelector('.p-topElement__slider')

        if (splide && splide.splide) {
          splide.splide.destroy()
        }
      },
    },

    computed: {

      bodyClass () {
        return 'p-indexPage'
      }
    },
  }
</script>

<style lang="scss" scoped>

  .p-topButton {
    display: flex;
    align-items: center;
    justify-content: space-between;

    &__line {
      width: calc(100% - 162px);
      height: rem(1);
      background-color: color(smoke);

      @include responsive(sm, min) {
        width: calc(100% - 208px);
      }

      @include responsive(md, min) {
        width: calc(100% - vw(208));
        height: vw(1);
      }
    }

    &__link {
      display: inline-flex;
      align-items: center;
      justify-content: space-between;
      width: 140px;

      @include responsive(sm, min) {
        width: 180px;
      }

      @include responsive(md, min) {
        width: vw(180);
      }
    }

    &__text {

      span {
        @include Optima;
        @include font(15, 15, 0);

        @include responsive(sm, min) {
          @include font(16);
        }

        @include responsive(md, min) {
          @include vwfont(1280, 16);
        }
      }
    }

    &__icon {

      svg {
        display: block;
        width: 14px;
        height: 12px;

        @include responsive(md, min) {
          width: vw(14);
          height: vw(12);
        }
      }
    }
  }

  // .p-topElement
  .p-topElement {
    padding-top: rem(72);
    padding-bottom: rem(72);
    overflow: hidden;
    background-color: color(bg);

    @include responsive(md, min) {
      padding-top: vw(120);
      padding-bottom: vw(120);
    }

    &__inner {
      @include inner(lg);
    }

    // .p-topElement__heading
    &__heading {
      column-gap: vw(90);
      
      @include responsive(sm, min) {
        display: flex;
        align-items: flex-end;
      }
    }

    &__text {
      
      @include responsive(sm, max) {
        margin-top: rem(32);
      }

      @include responsive(md, min) {
        margin-bottom: vw(5);
        width: vw(560);
      }
    }

    // .p-topElement__slider
    &__slider {
      // overflow-y: hidden;
      white-space: nowrap;
      margin-top: rem(60);
    }

    &__button {
      margin-top: rem(36);
      display: flex;
      justify-content: flex-end;

      @include responsive(sm, min) {
        margin-top: rem(60);
      }

      @include responsive(md, min) {
        margin-top: vw(60);
      }
    }
  }

  .p-topElementTitle {
    position: relative;
    display: inline-block;

    &__text {
      @include Alokary;
      @include font(20, 30, 100);
      color: color(main);

      @include responsive(md, min) {
        @include vwfont(1280, 36, 72, 100);
      }
    }

    &__number {
      position: absolute;
      width: 100%;
      right: -100%;
      top: 0;
    }
  }
  
  .p-topElementTitleNumber {
    @include Optima;
    @include font(10, 10, -60);
    display: flex;

    @include responsive(md, min) {
      @include vwfont(1280, 11, 11, -60);
    }

    &__brackets {
      position: relative;
      bottom: rem(0.5);
    }

    // .p-topElementTitleNumber__text
    &__text {
      margin-right: 1px;
      margin-left: 1px;

      @include responsive(md, min) {
        margin-right: vw(2);
        margin-left: vw(2);
      }
    }
  }

  .p-topElementText {
    @include font(13, 23.4, 40);

    @include responsive(md, min) {
      @include vwfont(1280, 14);
    }
  }

  .p-topElementSlider {
    margin-top: rem(32);

    @include responsive(sm, max) {
      overflow: visible;
    }

    @include responsive(md, min) {
      margin-top: vw(32);
    }

    // .p-topElementSlider__card
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

    // .p-topElementSlider__heading
    &__heading {
    }

    &__line {
      width: calc(100% - 200px);

      span {
        display: block;
        width: 100%;
        height: rem(1);
        background-color: color(smoke);
      }
    }

    &__sort {
      width: 100%;
    }

    // .p-topElementSlider__controller
    &__controller {
      display: none;

      @include responsive(sm, min) {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: rem(6);
      }

      @include responsive(md, min) {
        margin-top: vw(6);
      }
    }
  }

  // .p-topElementSliderCard
  .p-topElementSliderCard {
    width: per(160, 335);
    display: inline-block;
    white-space: normal;
    vertical-align: top;

    @include responsive(sm, min) {
      width: per(208, 1120);
    }

    @include responsive(md, min) {
      width: vw(208);
    }

    // .p-topElementItem:not(:first-child)
    &:not(:first-child) {
      
      @include responsive(sm, max) {
        margin-left: per(15, 335);
      }

      // @include responsive(md, min) {
      //   margin-left: vw(20);
      // }
    }

    // .p-topElementItem__link
    &__link {
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      background-color: color(white);
      border-radius: rem(10);
      aspect-ratio: 194 / 228.75;
      padding-top: rem(14);

      @include responsive(md, min) {
        padding-top: vw(14);
      }
    }

    // .p-topElementSliderCard__detail
    &__detail {
      width: 100%;
      position: absolute;
      top: 0;
      left: 0;
      padding-top: rem(12);
      padding-right: 16px;
      padding-left: 16px;

      @include responsive(md, min) {
        padding-top: rem(14);
        padding-right: 17px;
        padding-left: 17px;
      }
      
      @include responsive(md, min) {
        padding-top: vw(14);
        padding-right: vw(17);
        padding-left: vw(17);
      }
    }

    &__like {
      position: absolute;
      bottom: rem(15);
      left: 17px;
      display: flex;
      align-items: center;

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

    &__price {
      @include Wandeln;
      @include font(12, 18, 0);
      display: block;

      @include responsive(md, min) {
        @include vwfont(1280, 12);
      }
    }
  }

  .p-topElementSliderCardLike {
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


  // .p-topColumn
  .p-topColumn {
    overflow: hidden;
    padding-top: rem(72);
    
    @include responsive(md, min) {
      padding-top: vw(120);
    }

    // .p-topColumn__inner
    &__inner {
      @include inner(md);
    }

    // .p-topColumn__header
    &__heading {
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      margin-top: rem(32);

      @include responsive(md, min) {
        margin-top: vw(16);
      }
    }

    &__controller {
      display: none;

      @include responsive(sm, min) {
        display: block;
      }
    }

    // .p-topColumn__text
    &__text {

      @include responsive(sm, min) {
        max-width: per(560, 923);
      }

      @include responsive(md, min) {
        max-width: vw(560);
      }
      
      p {
        @include font(13, 23.4, 40, 500);

        @include responsive(sm, min) {
          @include font(14);
        }
        
        @include responsive(md, min) {
          @include vwfont(1280, 14);
        }
      }
    }

    // .p-topColumn__article
    &__article {
      
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

    &__button {
      margin-top: rem(36);

      @include responsive(sm, min) {
        margin-top: rem(60);
      }

      @include responsive(md, min) {
        margin-top: vw(60);
      }
    }
  }

  .p-topColumnTitle {
    position: relative;
    display: inline-block;

    // .p-topColumnTitle__text
    &__text {
      @include Alokary;
      @include font(20, 30, 100);

      @include responsive(md, min) {
        @include vwfont(1280, 36, 72, 100);
      }
    }

    &__number {
      position: absolute;
      width: 100%;
      right: -100%;
      top: 0;
      color: color(main);
    }
  }
  
  .p-topColumnTitleNumber {
    @include Optima;
    @include font(10, 10, -60);
    display: flex;

    @include responsive(md, min) {
      @include vwfont(1280, 11, 11, -60);
    }

    &__brackets {
      position: relative;
      bottom: rem(0.5);
    }

    // .p-topColumnTitleNumber__text
    &__text {
      margin-right: 1px;
      margin-left: 1px;

      @include responsive(md, min) {
        margin-right: vw(2);
        margin-left: vw(2);
      }
    }
  }

  // .p-topColumnArticle
  .p-topColumnArticle {
    width: per(160, 335);
    display: inline-block;
    white-space: normal;
    vertical-align: top;

    @include responsive(sm, min) {
      width: per(213, 923);
    }

    @include responsive(md, min) {
      width: vw(237);
    }

    &:not(:first-of-type) {
      
      @include responsive(sm, max) {
        margin-left: per(15, 335);
      }

      // @include responsive(md, min) {
      //   margin-left: vw(30);
      // }
    }
    
    // .p-topColumnArticle__link
    &__link {
      display: block;
      width: 100%;
      height: 100%;
    }

    // .p-topColumnArticle__image
    &__image {
      aspect-ratio: 236.83 / 287.5;
      border-radius: rem(6);
      overflow: hidden;

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

    // .p-topColumnArticle__title
    &__title {
      @include font(14, 23, 0, 700);
      display: -webkit-box;
      -webkit-box-orient: vertical;
      -webkit-line-clamp: 3;
      overflow: hidden;
      
      @include responsive(md, min) {
        @include vwfont(1280, 14);
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

  .p-topColumnSlider {
    margin-top: rem(32);

    @include responsive(sm, max) {
      overflow: visible;
    }
    
    @include responsive(md, min) {
      margin-top: vw(40);
    }
  }


  // .p-topStudy
  .p-topStudy {
    margin-top: rem(72);
    overflow: hidden;
    
    @include responsive(md, min) {
      margin-top: vw(120);
    }

    &__inner {
      @include inner(md);
    }

    // .p-topStudy__heading
    &__heading {

      @include responsive(sm, min) {
        display: flex;
        align-items: flex-end;
        column-gap: vw(65);
      }
    }

    &__text {
      @include responsive(sm, max) {
        margin-top: rem(32);
      }

      @include responsive(md, min) {
        max-width: vw(560);
        margin-bottom: vw(8);
      }
    }

    // .p-topStudy__articles
    &__article {
      margin-top: rem(32);
      
      @include responsive(md, min) {
        margin-top: vw(36);
      }
    }

    &__sort {
      margin-top: rem(24);

      @include responsive(md, min) {
        margin-top: vw(40);
      }
    }

    &__button {
      margin-top: rem(36);

      @include responsive(sm, min) {
        margin-top: rem(60);
      }

      @include responsive(md, min) {
        margin-top: vw(60);
      }
    }
  }

  .p-topStudyTitle {
    position: relative;
    display: inline-block;

    &__text {
      @include Alokary;
      @include font(20, 30, 100);
      color: color(main);

      @include responsive(md, min) {
        @include vwfont(1280, 36, 72, 100);
      }
    }

    &__number {
      position: absolute;
      width: 100%;
      right: -100%;
      top: 0;
    }
  }

  .p-topStudyText {
    @include font(13, 23.4, 40, 500);
    
    @include responsive(md, min) {
      @include vwfont(1280, 14);
    }
  }
  
  .p-topStudyTitleNumber {
    @include Optima;
    @include font(10, 10, -60);
    display: flex;

    @include responsive(md, min) {
      @include vwfont(1280, 11, 11, -60);
    }

    &__brackets {
      position: relative;
      bottom: rem(0.5);
    }

    // .p-topStudyTitleNumber__text
    &__text {
      margin-right: 1px;
      margin-left: 1px;

      @include responsive(md, min) {
        margin-right: vw(2);
        margin-left: vw(2);
      }
    }
  }
  
  // .p-topStudyArticle
  .p-topStudyArticle {
    white-space: nowrap;
    position: relative;
    height: rem(40);

    @include responsive(sm, min) {
      height: 32px;
    }

    @include responsive(md, min) {
      height: vw(40);
    }

    // .p-topStudy__articles:not(:first-child)
    &:not(:first-child) {
      margin-top: rem(20);

      @include responsive(sm, min) {
        margin-top: rem(16);
      }

      @include responsive(md, min) {
        margin-top: vw(20);
      }
    }

    &__item {
      display: inline-block;
  
      // .p-topStudyArticle:nth-child(1)
      &:nth-child(1) {
        animation: infiniteAnimation 200s -100s linear infinite;
      }
  
      // .p-topStudyArticle:nth-child(2)
      &:nth-child(2) {
        animation: infiniteAnimationClone 200s linear infinite;
      }
    }
  }

  // .p-topStudyArticleItem
  .p-topStudyArticleItem {
    $item: &;
    position: relative;
    display: inline-block;
    margin-left: 20px;

    @include responsive(sm, min) {
      margin-left: 16px;
    }

    @include responsive(md, min) {
      margin-left: vw(20);
    }

    // .p-topStudyArticleItem__link
    &__link {
      color: color(white);
      display: flex;

      // .p-topStudyArticleItemLink:hover
      @include hover {
        
      }
    }

    // .p-topStudyArticleItem__number
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
    }

    // .p-topStudyArticleItem__title
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
    }
  }

  .p-topStudyArticleItemNumber {
    @include font(22, 33, -60);

    @include responsive(md, min) {
      @include vwfont(1280, 22, 33, -60);
    }
  }

  .p-topStudyArticleItemTitle {
    @include font(16, 24, 40);
    
    @include responsive(md, min) {
      @include vwfont(1280, 16);
    }
  }


  // .p-topNews
  .p-topNews {
    background-color: color(bg);
    margin-top: rem(72);
    padding-top: rem(72);
    padding-bottom: rem(72);

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

    &__body {

      @include responsive(sm, max) {
        margin-top: rem(14);
      }

      @include responsive(sm, min) {
        width: per(680, 1000);
      }
    }

    &__button {
      margin-top: rem(36);
      display: flex;
      justify-content: flex-end;

      @include responsive(sm, min) {
        margin-top: rem(60);
      }

      @include responsive(md, min) {
        margin-top: vw(60);
      }
    }
  }

  .p-topNewsTitle {

    &__en {

    }

    &__ja {
      margin-top: vw(14);
    }
  }

  .p-topNewsTitleEn {
    @include Alokary;
    color: color(main);
    @include font(20, 30, 100);
    
    @include responsive(md, min) {
      @include vwfont(1280, 36, 56, 100);
    }
  }

  .p-topNewsTitleJa {
    @include font(14, 26, 40, 500);
    
    @include responsive(md, min) {
      @include vwfont(1280, 14);
    }
  }

  // .p-topNewsItem
  .p-topNewsItem {
    border-bottom: 1px solid color(lightgray);

    @include responsive(md, min) {
      border-width: vw(1);
    }
    
    // .p-topNewsItem__link
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

    // .p-topNewsItem__date
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

    // .p-topNewsItem__title
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

    // .p-topNewsItem__category
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

  .p-topNewsItemText {
    margin-top: rem(20);
    padding-right: 57px;

    @include responsive(md, min) {
      padding-right: vw(80);
    }
  }

  .p-topNewsItemIcon {
    $this: &;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    &--expansion {
      @extend .p-topNewsItemIcon;
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

    // .p-topNewsItemIcon--arrow
    &--arrow {
      @extend .p-topNewsItemIcon;
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