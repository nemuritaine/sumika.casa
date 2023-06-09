<template>
  <footer class="l-footer">
    <div class="l-footer__inner">
      <div class="l-footer__wrapper">
        <div class="l-footer__sns">
          <div class="l-footerSns">
            <a href="https://www.instagram.com/sumika.casa/" class="l-footerSns__link" target="_blank">
              <svg class="l-footerSns__icon--instagram">
                <use xlink:href="@/static/assets/images/common/graphics.svg#ico_instagram"></use>
              </svg>
              <div class="l-footerSns__text">Instagram</div>
            </a>
          </div>
          <div class="l-footerSns">
            <a href="https://www.tiktok.com/@sumika.casa/" class="l-footerSns__link" target="_blank">
              <svg class="l-footerSns__icon--tiktok">
                <use xlink:href="@/static/assets/images/common/graphics.svg#ico_tiktok"></use>
              </svg>
              <div class="l-footerSns__text">Tiktok</div>
            </a>
          </div>
        </div>
        <div class="l-footer__copyright">
          <div class="l-footerCopyright">Copyright © Sumika, Inc. All Rights Reserved</div>
        </div>
        <div class="l-footer__pageTop">
          <a href="#__nuxt" class="l-footerPageTop">
            <div class="l-footerPageTop__text">Page top</div>
            <svg class="l-footerPageTop__icon">
              <use xlink:href="@/static/assets/images/common/graphics.svg#ico_arrowTop"></use>
            </svg>
          </a>
        </div>
      </div>
    </div>
    <div class="l-footer__menu">
      <nav class="l-footerMenu">
        <ul class="l-footerMenu__item">
          <li class="l-footerMenuItem">
            <a href="/" class="l-footerMenuItem__link">
              <span class="l-footerMenuItem__icon --home">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                  <polygon class="st0" points="3 23 25 3 47 23 47 47 33 47 33 33 17 33 17 47 3 47 3 23"/>
                </svg>
              </span>
              <span class="l-footerMenuItem__text">ホーム</span>
            </a>
          </li>
          <li class="l-footerMenuItem">
            <a href="/element" class="l-footerMenuItem__link">
              <span class="l-footerMenuItem__icon --search">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                  <circle class="st0" cx="21.5" cy="21.5" r="17.5"/>
                  <line class="st0" x1="34" y1="34" x2="47" y2="47"/>
                </svg>
              </span>
              <span class="l-footerMenuItem__text">アイテム</span>
            </a>
          </li>
          <li class="l-footerMenuItem">
            <a href="/post" class="l-footerMenuItem__link">
              <span class="l-footerMenuItem__icon --article">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                  <rect class="st0" x="13" y="3" width="31" height="37"/>
                  <polyline class="st0" points="6 9 6 47 40 47"/>
                  <line class="st0" x1="18" y1="10" x2="39" y2="10"/>
                  <line class="st0" x1="18" y1="17" x2="39" y2="17"/>
                  <line class="st0" x1="18" y1="24" x2="39" y2="24"/>
                </svg>
              </span>
              <span class="l-footerMenuItem__text">お部屋紹介</span>
            </a>
          </li>
          <li class="l-footerMenuItem">
            <span class="l-footerMenuItem__link">
            <!-- <a href="/study" class="l-footerMenuItem__link"> -->
              <span class="l-footerMenuItem__icon --compass">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                  <circle class="st0" cx="25" cy="25" r="22"/>
                  <path class="fi0" d="m19.45,19.45l-6.93,18.03,18.03-6.93,6.93-18.03-18.03,6.93Zm5.55,8.55c-1.65,0-3-1.35-3-3s1.35-3,3-3,3,1.35,3,3-1.35,3-3,3Z"/>
                </svg>
              </span>
              <span class="l-footerMenuItem__text">勉強（準備中）</span>
            </span>
            <!-- </a> -->
          </li>
          <li class="l-footerMenuItem">
            <a href="/news" class="l-footerMenuItem__link">
              <span class="l-footerMenuItem__icon --bell">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                  <path class="st0" d="m15,38h20s-2,9-10,9-10-9-10-9Z"/>
                  <path class="st0" d="m41,15s-3-12-16-12S9,15,9,15l-4,23h40l-4-23Z"/>
                </svg>
              </span>
              <span class="l-footerMenuItem__text">ニュース</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </footer>
</template>

<style lang="scss">
  // .l-footer
  .l-footer {
    width: 100%;
    overflow: hidden;
    
    @include responsive(sm, max) {
      height: rem(46);
    }

    @include responsive(sm, min) {
      background-color: color(main);
      padding-top: vw(60);
      padding-bottom: vw(40);
    }

    &__inner {
      display: none;

      @include responsive(sm, min) {
        display: block;
        @include inner(lg);
      }
    }

    // .l-footer__body
    &__wrapper {
      position: relative;
    }

    &__sns {
      display: flex;
      align-items: center;
    }

    &__copyright {
      margin-top: rem(14);
    }

    &__pageTop {
      position: absolute;
      right: 0;
      bottom: 0;
    }

    &__menu {
      display: block;
      position: fixed;
      bottom: 0;
      width: 100%;
      z-index: 900;

      @include responsive(sm, min) {
        display: none;
      }
    }
  }

  .l-footerSns {
    $this: &;
    color: color(white);

    & + #{$this} {
      margin-left: vw(24);
    }

    &__link {
      display: flex;
      align-items: center;
    }
    
    &__text {
      @include Optima;
      @include vwfont(1280, 12, 18, 20);
      margin-left: vw(6);
    }

    &__icon {

      &--instagram {
        @extend .l-footerSns__icon;
        width: vw(18);
        height: vw(18);
      }

      &--tiktok {
        @extend .l-footerSns__icon;
        width: vw(15.43);
        height: vw(18);
      }
    }
  }

  // .l-footerCopyright
  .l-footerCopyright {
    @include font(10, 21, 0, 500);
    color: color(white);
    
    @include responsive(md, min) {
      @include Optima;
      @include vwfont(1280, 10, 15, 0, 500);
      margin-top: vw(15);
    }
  }

  .l-footerPageTop {
    color: color(white);
    display: flex;
    align-items: center;

    &__text {
      @include vwfont(1280, 12, 20, 0);
      @include Optima;
    }

    &__icon {
      width: vw(10.74);
      height: vw(12);
      margin-left: vw(5);
    }
  }

  .l-footerMenu {
    border-top: 2px solid color(main);
    background-color: color(bg);

    &__item {
      display: flex;
    }
  }

  .l-footerMenuItem {
    $this: &;
    width: calc(100% / 5);
    color: color(main);
    padding-top: rem(7);
    padding-bottom: rem(5);

    &.is-active {
      
      #{$this}__icon {

        &.--home {

          svg {
            fill: color(main);
          }
        }

        &.--search {

          svg {
            stroke-width: 7;
          }
        }

        &.--article {
        }

        &.--qualification {
        }

        &.--bell {
        }
      }
    }
    
    &__link {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    &__icon {
      display: flex;
      justify-content: center;

      svg {
        height: 20px;
        width: 20px;
        display: block;
        stroke: color(main);
        fill: none;

        .st0 {
          stroke-width: 4;
        }

        .fi0 {
          fill: color(main);
        }
      }

      &.--home {
      }

      &.--search {
      }

      &.--article {
      }

      &.--compass {
      }

      &.--bell {
      }
    }

    &__text {
      @include font(10, 10, 0, 500);
      margin-top: rem(3);
    }
  }
</style>