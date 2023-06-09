<template>
  <div>
    <header id="header" class="l-header" ref="header">
      <div class="l-header__inner">
        <div class="l-header__wrapper">
          <div class="l-header__navigation">
            <nav class="l-headerNavigation">
              <ul class="l-headerNavigation__item">
                <li v-for="item in items" :key="item.id" class="l-headerNavigationItem">
                  <span v-if="item.url === ''" class="l-headerNavigationItem__link">
                    <span class="l-headerNavigationItem__text">{{ item.name }}</span>
                    <span class="l-headerNavigationItem__icon">
                      <span class="l-headerNavigationIcon--arrow">
                        <svg>
                          <use xlink:href="@/static/assets/images/common/graphics.svg#ico_arrowBottom"></use>
                        </svg>
                      </span>
                      <span class="l-headerNavigationIcon--frame">
                        <svg>
                          <use xlink:href="@/static/assets/images/common/graphics.svg#ico_frame"></use>
                        </svg>
                      </span>
                    </span>
                  </span>
                  <a v-else class="l-headerNavigationItem__link" :href="item.url" :target="item.target && '_blank'">
                    <span class="l-headerNavigationItem__text">{{ item.name }}</span>
                    <span class="l-headerNavigationItem__icon">
                      <span class="l-headerNavigationIcon--arrow">
                        <svg>
                          <use xlink:href="@/static/assets/images/common/graphics.svg#ico_arrowBottom"></use>
                        </svg>
                      </span>
                      <span class="l-headerNavigationIcon--frame">
                        <svg>
                          <use xlink:href="@/static/assets/images/common/graphics.svg#ico_frame"></use>
                        </svg>
                      </span>
                    </span>
                  </a>
                </li>
              </ul>
              <div class="l-headerNavigation__sns">
                <div class="l-headerNavigationSns">
                  <div class="l-headerNavigationSns__title">SNS</div>
                  <ul class="l-headerNavigationSns__item">
                    <li class="l-headerNavigationSnsItem">
                      <a class="l-headerNavigationSnsItem__link" href="https://instagram.com/sumika.casa/" target="_blank">
                        <span class="l-headerNavigationSnsItem__icon">
                          <span class="l-headerNavigationSnsItemIcon--instagram">
                            <svg>
                              <use xlink:href="@/static/assets/images/common/graphics.svg#ico_instagram"></use>
                            </svg>
                          </span>
                          <span class="l-headerNavigationIcon--frame">
                            <svg>
                              <use xlink:href="@/static/assets/images/common/graphics.svg#ico_frame"></use>
                            </svg>
                          </span>
                        </span>
                      </a>
                    </li>
                    <li class="l-headerNavigationSnsItem">
                      <a class="l-headerNavigationSnsItem__link" href="https://www.tiktok.com/@sumika.casa/" target="_blank">
                        <span class="l-headerNavigationSnsItem__icon">
                          <span class="l-headerNavigationSnsItemIcon--tiktok">
                            <svg>
                              <use :xlink:href="iconPaths.tiktok"></use>
                            </svg>
                          </span>
                          <span class="l-headerNavigationIcon--frame">
                            <svg>
                              <use :xlink:href="iconPaths.frame"></use>
                            </svg>
                          </span>
                        </span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
          <div class="l-header__logo">
            <a href="/">SUMIKA.CASA</a>
          </div>
          <div class="l-header__copy">
            <h1 class="l-headerCopy">知りたいがすぐに見つかる暮らしのデータベース</h1>
            <!-- <h1 class="l-headerCopy">知りたいがすぐに見つかるインテリア情報サイト</h1> -->
          </div>
        </div>
        <div class="l-header__menu">
          <nav class="l-headerMenu">
            <ul class="l-headerMenu__item">
              <li v-for="style in itemStyles" :key="style.id" class="l-headerMenuItem">
                <a :href="`/element?styles=${style.cat_slug}`">{{ style.cat_name }}</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </header>
    <div ref="dummyHeader" class="l-header__dummy"></div>
  </div>
</template>

<script>

  import { throttle } from 'lodash'
  import { gsap } from 'gsap'

  export default {
    
    computed: {

      iconPaths () {
        return {
          frame: require('@/static/assets/images/common/graphics.svg') + '#ico_frame',
          tiktok: require('@/static/assets/images/common/graphics.svg') + '#ico_tiktok',
        };
      },
    },

    data () {
      return {

        items: [
          {
            id: 0,
            name: 'TOP',
            url: '/'
          },
          {
            id: 1,
            name: 'ELEMENT',
            url: '/element'
          },
          {
            id: 2,
            name: 'ARTICLE',
            url: '/post'
          },
          {
            id: 3,
            name: 'STADY',
            url: ''
          },
          {
            id: 4,
            name: 'NEWS&EVENT',
            url: '/news'
          },
          {
            id: 5,
            name: 'STORE',
            url: '', // https://store.sumika.casa/
            target: true
          }
        ],
        itemStyles: [],
        lastScrollPosition: 0,
        isAnimating: false,
        scrollThreshold: 100,
      }
    },

    async fetch () {
      try {
        const responseItemStyles = await this.$axios.get(`${this.$nuxt.$url}/custom/v0/element_style`)
        this.itemStyles = responseItemStyles.data
      } catch (error) {
        console.log(error)
      }
    },

    created () {
      this.throttledHandleScroll = throttle(this.handleScroll, 500)
      this.throttledUpdateDummyHeaderHeight = throttle(this.updateDummyHeaderHeight, 500)
      this.throttledCheckWindowSize = throttle(this.checkWindowSize, 500)
    },

    mounted () {
      this.checkWindowSize()
      window.addEventListener('resize', this.throttledCheckWindowSize)
    },

    beforeDestroy () {
      window.removeEventListener('resize', this.throttledCheckWindowSize)
    },

    methods: {

      handleScroll () {
        const currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop
    
        // ページの最下部に達したかどうかを確認
        const isBottom = (window.innerHeight + window.scrollY) >= document.body.offsetHeight;

        if (Math.abs(currentScrollPosition - this.lastScrollPosition) < this.scrollThreshold || isBottom) {
          return
        }

        if (this.isAnimating) {
          return
        }

        this.isAnimating = true
        let animation
        if (currentScrollPosition < this.lastScrollPosition) {
          animation = gsap.to(this.$refs.header, { top: '0', duration: 0.4 })
        } else {
          animation = gsap.to(this.$refs.header, { top: `-${this.$refs.header.offsetHeight}px`, duration: 0.3 })
        }

        animation.then(() => {
          this.isAnimating = false
          this.lastScrollPosition = currentScrollPosition
        })
      },

      updateDummyHeaderHeight () {

        this.$refs.dummyHeader.style.height = `${this.$refs.header.offsetHeight}px`
      },

      resetStyles () {

        this.$refs.header.style.position = ''
        this.$refs.header.style.top = ''
        this.$refs.header.style.width = ''
        this.$refs.header.style.zIndex = ''
        this.$refs.dummyHeader.style.height = ''
      },

      initializeStylesForMobile () {
        this.$refs.header.style.position = 'fixed'
        this.$refs.header.style.top = '0'
        this.$refs.header.style.width = '100%'
        this.$refs.header.style.zIndex = '10000'
        this.$refs.dummyHeader.style.height = `${this.$refs.header.offsetHeight}px`
      },

      checkWindowSize () {

        if (window.innerWidth >= 769) {
          this.resetStyles()
          window.removeEventListener('scroll', this.throttledHandleScroll)
          window.removeEventListener('resize', this.throttledUpdateDummyHeaderHeight)
        } else {
          this.initializeStylesForMobile()
          window.addEventListener('scroll', this.throttledHandleScroll)
          window.addEventListener('resize', this.throttledUpdateDummyHeaderHeight)
        }
      },
    },
  }
</script>

<style lang="scss" scope>
  // .l-header
  .l-header {
    border-top: 1px solid color(main);
    color: color(main);
    background-color: color(bg);

    @include responsive(md, min) {
      border-width: vw(1);
    }

    &__wrapper {

      @include responsive(sm, max) {
        display: flex;
        padding-right: 10px;
        padding-left: 12px;
        padding-bottom: rem(1);
        border-bottom: 2px solid color(main);
        justify-content: space-between;
        align-items: center;
        height: rem(50);
      }
    }

    // .l-header__navigation
    &__navigation {
      display: flex;
      position: relative;
      z-index: 1000;

      @include responsive(sm, max) {
        order: 2;
      }
    }

    &__logo {

      @include responsive(sm, max) {
        order: 1;
      }

      // .l-header__logo a
      a {
        display: block;
        @include Wandeln;
        @include font(34, 34, -40);
        height: rem(25);
        text-align: center;
        
        @include responsive(sm, min) {
          @include font(90, 100);
          position: relative;
          height: rem(79);
          bottom: rem(2);
          pointer-events: none;
        }

        @include responsive(md, min) {
          @include vwfont(1280, 120, 120);
          height: vw(105);
          padding-top: vw(3);
          bottom: 0;
        }
      }
    }

    &__copy {
      display: none;

      @include responsive(sm, min) {
        display: block;
      }
    }

    &__menu {
      border-bottom: 2px solid color(main);
      
      @include responsive(sm, min) {
        display: none;
      }
    }

    &__dummy {
      background-color: color(bg);
    }
  }

  // .l-headerCopy
  .l-headerCopy {
    @include font(14, 21, -30, 700);
    text-align: center;
    border-top: 2px solid color(main);
    border-bottom: 2px solid color(main);
    padding-top: rem(4);
    padding-bottom: rem(2);
    
    @include responsive(md, min) {
      @include vwfont(1280, 18, 30, 0);
      padding-top: vw(2);
      padding-bottom: vw(2);
      border-width: vw(2);
    }
  }

  // .l-headerNavigation
  .l-headerNavigation {
    $this: &;
    display: flex;
    align-items: center;
    width: 100%;

    @include responsive(md, max) {
      overflow-x: scroll;
      overflow-y: hidden;
    }
    
    @include responsive(sm, min) {
      border-bottom: 2px solid color(main);
    }

    @include responsive(md, min) {
      border-width: vw(2);
    }

    // .l-headerNavigation__item
    &__item {
      display: none;
      
      @include responsive(sm, min) {
        display: flex;
      }
    }

    // .l-headerNavigation__sns
    &__sns {
      display: flex;
      align-items: center;
      height: 100%;
      
      @include responsive(sm, min) {
        border-left: 1px solid color(main);
        padding-left: 5px;
        padding-right: 8px;
      }

      @include responsive(md, min) {
        padding-left: vw(6);
        padding-right: vw(9);
      }
    }
  }

  // .l-headerNavigationIcon
  .l-headerNavigationIcon {
    display: flex;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    // .l-headerNavigationIcon--frame
    &--frame {
      display: flex;
      position: relative;
      
      // .l-headerNavigationIcon--frame svg
      svg {
        display: flex;
        width: 43px;
        height: 33px;
        
        @include responsive(sm, min) {
          width: 35px;
          height: 27px;
        }

        @include responsive(md, min) {
          width: vw(43);
          height: vw(33);
        }
      }
    }

    &--arrow {
      @extend .l-headerNavigationIcon;
      z-index: 1;
      
      svg {
        width: 15px;
        height: 18px;
        transition: fill 0.3s ease;

        @include responsive(md, min) {
          width: vw(18);
          height: vw(22);
        }
      }
    }
  }

  // .l-headerNavigationItem
  .l-headerNavigationItem {
    @include Wandeln;
    $this: &;
    display: flex;
    align-items: center;
    
    // .l-headerNavigationItem:first-child
    &:first-child {
      
      #{$this}__link {
        padding-left: 8px;

        @include responsive(md, min) {
          padding-left: vw(8);
        }
      }
    }
    
    // .l-headerNavigationItem:not(:first-child)
    &:not(:first-child) {
      border-left: 1px solid color(main);

      #{$this}__link {
        padding-left: 7px;

        @include responsive(md, min) {
          padding-left: vw(8);
        }
      }
    }
    
    // .l-headerNavigationItem__link
    &__link {
      padding-right: 8px;
      display: flex;
      justify-content: center;
      align-items: center;

      @include responsive(md, min) {
        padding-right: vw(9);
      }

      &[target="_blank"] {

        .l-headerNavigationIcon--arrow {
          
          svg {
            transform: rotate(-135deg);
          }
        }
      }
    }

    a {

      @include hover {

      }
    }

    // .l-headerNavigationItem__text
    &__text {
      @include font(32, 32, -20);
      padding-top: rem(5);
      display: block;
      
      @include responsive(md, min) {
        padding-top: vw(7);
        @include vwfont(1280, 40, 40, -40);
      }
    }

    // .l-headerNavigationItem__icon
    &__icon {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-left: 3.2px;
      padding-top: rem(1);
      position: relative;

      @include responsive(md, min) {
        margin-left: vw(4);
        padding-top: vw(1);
      }
    }
  }

  .l-headerNavigationSns {
    display: flex;

    &__title {
      display: none;
      
      @include responsive(sm, min) {
        @include Wandeln;
        @include font(32, 32, -20);
        display: block;
        padding-top: rem(5);
        margin-right: 4.8px;
      }

      @include responsive(md, min) {
        @include vwfont(1280, 40, 40, -30);
        padding-top: vw(7);
        margin-right: vw(6);
      }
    }

    // .l-headerNavigationSns__item
    &__item {
      display: flex;
      align-items: center;
    }
  }

  // .l-headerNavigationSnsItem
  .l-headerNavigationSnsItem {
    padding-top: rem(1);

    @include responsive(md, min) {
      padding-top: vw(1);
    }

    // .l-headerNavigationSnsItem:not(:first-child)
    &:not(:first-child) {
      margin-left: 5px;
      @include responsive(md, min) {
        margin-left: vw(5);
      }
    }

    &__link {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    // .l-headerNavigationSnsItem__icon
    &__icon {
      display: flex;
      align-items: center;
      justify-content: center;
      padding-top: rem(1);
      position: relative;

      @include responsive(md, min) {
        padding-top: vw(1);
      }
    }
  }

  // .l-headerNavigationSnsItemIcon
  .l-headerNavigationSnsItemIcon {
    display: flex;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    &--instagram {
      @extend .l-headerNavigationSnsItemIcon;
      
      svg {
        width: 15px;
        height: 15px;

        @include responsive(md, min) {
          width: vw(15);
          height: vw(15);
        }
      }
    }

    &--tiktok {
      @extend .l-headerNavigationSnsItemIcon;

      
      svg {
        width: 12.86px;
        height: 15px;

        @include responsive(md, min) {
          width: vw(13);
          height: vw(15);
        }
      }
    }
  }

  .l-headerMenu {
    padding: rem(8) 0;

    // .l-headerMenu__item
    &__item {
      white-space: nowrap;
      overflow-x: scroll;
      padding: 0 10px;
      -ms-overflow-style: none;
      scrollbar-width: none;

      &::-webkit-scrollbar{
        display:none;
      }
    }
  }

  .l-headerMenuItem {
    display: inline-block;
    
    &:not(:first-of-type) {
      margin-left: 10px;
    }

    // .l-headerMenuItem a
    a {
      @include font(13, 13, 0);
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 6px;
      background-color: color(beige);
      padding: rem(6) 10px;
    }
  }
</style>