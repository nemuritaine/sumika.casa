<template>
  <div class="p-showcase" data-count="1">
    <div class="p-showcase__item">
      <div class="p-showcaseItem" data-size="m" data-pos="1" data-type="sidetable">
        <a href="">
          <p class="p-showcaseItem__image">
            <span>
              <img :data-normal="`${BASE_URL}sidetable/img__sidetable011.png`" alt="" src="">
            </span>
          </p>
        </a>
      </div>
      <div class="p-showcaseItem is-animation" data-size="m" data-pos="2" data-type="chair">
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}chair/img__chair006.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}chair/img__chair001.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}clock/img__clock001.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}cushion/img__cushion001.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
      </div>
      <div class="p-showcaseItem" data-size="s" data-pos="3" data-type="clock">
        <a href="">
          <p class="p-showcaseItem__image">
            <span>
              <img :data-normal="`${BASE_URL}lighting/img__lighting001.png`" alt="" src="">
            </span>
          </p>
        </a>
      </div>
      <div class="p-showcaseItem is-animation" data-size="s" data-pos="4" data-type="vase">
        <div v-for="item in vases" :key="item.id" class="p-showcaseItem__animation">
          <a :href="`/element/${item.id}`">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="item.image_src" :alt="item.title" src="">
              </span>
            </p>
          </a>
        </div>
      </div>
      <div class="p-showcaseItem" data-size="m" data-pos="5" data-type="mirror">
        <a href="">
          <p class="p-showcaseItem__image">
            <span>
              <img :data-normal="`${BASE_URL}mirror/img__mirror002.png`" alt="" src="">
            </span>
          </p>
        </a>
      </div>
      <div class="p-showcaseItem is-animation" data-size="l" data-pos="6" data-type="sofa">
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}vase/img__vase001.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}clock/img__clock002.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}sidetable/img__sidetable001.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}clock/img__clock003.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
      </div>
      <div class="p-showcaseItem is-animation" data-size="m" data-pos="7" data-type="ceilinglighting">
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}clock/img__clock004.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}clock/img__clock005.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}clock/img__clock006.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}clock/img__clock007.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
      </div>
      <div class="p-showcaseItem" data-size="s" data-pos="8" data-type="lowtable">
        <a href="">
          <p class="p-showcaseItem__image">
            <span>
              <img :data-normal="`${BASE_URL}clock/img__clock008.png`" alt="" src="">
            </span>
          </p>
        </a>
      </div>
      <div class="p-showcaseItem" data-size="m" data-pos="9" data-type="carpet">
        <a href="">
          <p class="p-showcaseItem__image">
            <span>
              <img :data-normal="`${BASE_URL}clock/img__clock009.png`" alt="" src="">
            </span>
          </p>
        </a>
      </div>
      <div class="p-showcaseItem is-animation" data-size="m" data-pos="10" data-type="table">
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}clock/img__clock010.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}clock/img__clock011.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}clock/img__clock012.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}clock/img__clock013.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
      </div>
      <div class="p-showcaseItem" data-size="m" data-pos="11" data-type="lowtable">
        <a href="">
          <p class="p-showcaseItem__image">
            <span>
              <img :data-normal="`${BASE_URL}clock/img__clock014.png`" alt="" src="">
            </span>
          </p>
        </a>
      </div>
      <div class="p-showcaseItem" data-size="m" data-pos="12" data-type="mirror">
        <a href="">
          <p class="p-showcaseItem__image">
            <span>
              <img :data-normal="`${BASE_URL}clock/img__clock015.png`" alt="" src="">
            </span>
          </p>
        </a>
      </div>
      <div class="p-showcaseItem" data-size="s" data-pos="13" data-type="light">
        <a href="">
          <p class="p-showcaseItem__image">
            <span>
              <img :data-normal="`${BASE_URL}sofa/img__sofa001.png`" alt="" src="">
            </span>
          </p>
        </a>
      </div>
      <div class="p-showcaseItem is-animation" data-size="s" data-pos="14" data-type="stool">
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}mirror/img__mirror003.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}mirror/img__mirror003.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}chair/img__chair002.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}lighting/img__lighting002.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
      </div>
      <div class="p-showcaseItem" data-size="l" data-pos="15" data-type="sofa">
        <a href="">
          <p class="p-showcaseItem__image">
            <span>
              <img :data-normal="`${BASE_URL}sidetable/img__sidetable003.png`" alt="" src="">
            </span>
          </p>
        </a>
      </div>
      <div class="p-showcaseItem" data-size="m" data-pos="16" data-type="stool">
        <a href="">
          <p class="p-showcaseItem__image">
            <span>
              <img :data-normal="`${BASE_URL}sidetable/img__sidetable004.png`" alt="" src="">
            </span>
          </p>
        </a>
      </div>
      <div class="p-showcaseItem" data-size="m" data-pos="17" data-type="refrigerator">
        <a href="">
          <p class="p-showcaseItem__image">
            <span>
              <img :data-normal="`${BASE_URL}mirror/img__mirror004.png`" alt="" src="">
            </span>
          </p>
        </a>
      </div>
      <div class="p-showcaseItem is-animation" data-size="l" data-pos="18" data-type="cushion">
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}sidetable/img__sidetable005.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}sidetable/img__sidetable006.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}sidetable/img__sidetable007.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}sidetable/img__sidetable008.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
      </div>
      <div class="p-showcaseItem is-animation" data-size="l" data-pos="19" data-type="stool">
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}sidetable/img__sidetable008.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}mirror/img__mirror005.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}sidetable/img__sidetable009.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
        <div class="p-showcaseItem__animation">
          <a href="">
            <p class="p-showcaseItem__image">
              <span>
                <img :data-normal="`${BASE_URL}sidetable/img__sidetable010.png`" alt="" src="">
              </span>
            </p>
          </a>
        </div>
      </div>
      <div class="p-showcaseItem" data-size="s" data-pos="20" data-type="lowtable">
        <a href="">
          <p class="p-showcaseItem__image">
            <span>
              <img :data-normal="`${BASE_URL}rug/img__rug001.png`" alt="" src="">
            </span>
          </p>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'
  export default {
    data: () => ({
      BASE_URL: 'https://sumika.casa/assets/images/element/',
      vases: [],
      asyncImage: false,
      asyncIntro: false,
    }),

    async asyncData() {
      // await axios.get(`https://sumika.artche.jp/cms/wp-json/custom/v0/elements?category=vase`)
      //   .then((response) => {
      //     if (response.status != 200) {
      //       // console.log(response.statusText)
      //       exit
      //     }
      //     this.vases = response.data
      //   })
      //   .catch((error) => {
      //     console.log(error)
      //   })
    },


    beforeCreate () {
      axios.get(`https://sumika.artche.jp/cms/wp-json/custom/v0/elements?category=vase&number=2`)
        .then((response) => {
          if (response.status != 200) {
            exit
          }
          this.vases = response.data
        })
        .catch((error) => {
        })
    },

    create() {
      this.init()
    },

    updated () {
      this.init()
    },

    methods: {

      closest (el, targetClass) {
        for (let item = el; item; item = item.parentElement) {
          if (item.classList.contains(targetClass)) {
            return item
          }
        }
      },

      init () {
        this.main()
        const el = document.querySelector('.p-showcase')

        // 要素の複製する
        el.appendChild(el.querySelector('.p-showcase__item').cloneNode(true))

        this.firstTimeImageLoad()
        this.intro()
        this.asyncImageLoad()
      },

      // メイン処理を呼び出し
      imageProgress (instance, image) {
        this.asyncImage = true
      },

      // 読み込み時に画像を一部読み込み
      firstTimeImageLoad () {
        const item = document.querySelectorAll('.p-showcaseItem')

        if (window.innerWidth > 767) { // FVの画像一部を初期読み込みする
          for (let num = 0; 10 > num; num++) {
            const image = item[num].querySelector('.p-showcaseItem__image img')
            image.setAttribute('src', image.getAttribute('data-normal'))
          }
        } else {
          for (let num = 0; 6 > num; num++) {
            const image = item[num].querySelector('.p-showcaseItem__image img')
            image.setAttribute('src', image.getAttribute('data-normal'))
          }
        }
      },

      // 画面内に入った画像を読み込む
      asyncImageLoad () {
        const item = [].slice.call(document.querySelectorAll('.p-showcaseItem .p-showcaseItem__image img'))
        
        const options = {
          root: null,
          rootMargin: '100px',
          threshold: 0
        }

        const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) { // 画面内に入った時に処理開始
              entry.target.setAttribute('src', entry.target.getAttribute('data-normal'))
              const image = this.closest(entry.target, 'p-showcaseItem__image')
              image.classList.add('-loaded')
              observer.unobserve(entry.target) // 一度発火した後監視を止める
            }
          })
        }, options)

        item.forEach(el => {
          observer.observe(el)
        })
      },

      // イントロ処理
      intro () {
        const intr = document.querySelector('.p-intro')
        if (!intr === null) {
          this.asyncIntro = true
          this.asyncImage && this.main()
        }
      },

      // 指定秒数ごとにカウンターの値を変更
      counterChange () {
        let number = 2
        const el = document.querySelector('.p-showcase')

        el.setAttribute('data-count', '1')
        setInterval(() => {
          if (number > 4) {
            number = 1
          } else {
            el.setAttribute('data-count', number.toString())
            number++
          }
        }, 5000)
      },

      // 画像にclassを付与
      imageAddClass () {
        const item = [].slice.call(document.querySelectorAll('.p-showcaseItem'))
        const options = {
          root: null,
          rootMargin: '0px',
          threshold: 0
        }

        const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) { // 画面内に入った時に処理開始
              entry.target.classList.add('-inv')
              observer.unobserve(entry.target) // 一度発火した後監視を止める
            }
          })
        }, options)
        
        item.forEach(el => {
          observer.observe(el)
        })
      },

      // メイン処理
      main () {
        const el = document.querySelector('.p-showcase')
        el.classList.add('is-init')
        this.imageAddClass()
        this.counterChange()
      }
    }
  }

</script>

<style lang="scss" scoped>

  @keyframes pcScroll {

    0% {
      transform: translateY(100%);
    }

    100% {
      transform: translateY(-100%);
    }
  }

  @keyframes pcScrollClone {

    0% {
      transform: translateY(0);
    }

    100% {
      transform: translateY(-200%);
    }
  }

  /* Top Style
  ----------------------------------------------------------------------- */
  .p-showcase {
    transition: opacity 0.3s ease;
    // position: relative;
    aspect-ratio: 375 / 526;
    overflow: hidden;

    @include responsive(sm, min) {
      aspect-ratio: 1280 / 520;
    }

    &__item {
      will-change: transform;
      aspect-ratio: 375 / 1052;

      @include responsive(sm, min) {
        aspect-ratio: 1280 / 1040;
      }

      &:nth-of-type(1) {
        -webkit-animation: pcScroll linear 40s -20s infinite;
        animation: pcScroll linear 40s -20s infinite;
      }

      &:nth-of-type(2) {
        -webkit-animation: pcScrollClone linear 40s infinite;
        animation: pcScrollClone linear 40s infinite;
      }
    }
    
    &[data-count="0"] .p-showcaseItem__animation:nth-child(1) a {
      transition-delay: 0s !important;
      transform: scale(1);
      z-index: 10;
    }

    &[data-count="1"] .p-showcaseItem__animation {

      &:nth-child(4) a {
        transition-delay: 0s !important;
      }

      &:nth-child(1) a {
        transition-delay: 0.48s !important;
        transform: scale(1);
        z-index: 10;
      }
    }
  }

  /* Init
  ----------------------------------------------------------------------- */
  .p-showcase {

    &.is-init {
      opacity: 1;
      
      // Anim Item（画像切替商品 ※PCのみ）
      .p-showcaseItem {

        a {
          opacity: 1;
          transform: scale(1);
        }

        &__animation {
          position: absolute;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;

          a {
            position: relative;
            transform: scale(0);
          }
        }
      }

      &[data-count="1"] {

        .p-showcaseItem {

          &[data-pos="2"] {

            .p-showcaseItem__animation {

              &:nth-child(1) a {
                transition-delay: 0.58s !important;
              }

              &:nth-child(4) a {
                transition-delay: 0.1s !important;
              }
            }
          }

          &[data-pos="6"] {
            .p-showcaseItem__animation {

              &:nth-child(4) a {
                transition-delay: 0.2s !important;
              }

              &:nth-child(1) a {
                transition-delay: 0.68s !important;
              }
            }
          }

          &[data-pos="7"] {
            .p-showcaseItem__animation {
              &:nth-child(4) a {
                transition-delay: 0.3s !important;
              }
              &:nth-child(1) a {
                transition-delay: 0.78s !important;
              }
            }
          }

          &[data-pos="10"] {
            .p-showcaseItem__animation {
              &:nth-child(4) a {
                transition-delay: 0.4s !important;
              }
              &:nth-child(1) a {
                transition-delay: 0.88s !important;
              }
            }
          }

          &[data-pos="14"] {
            .p-showcaseItem__animation {
              &:nth-child(4) a {
                transition-delay: 0.5s !important;
              }
              &:nth-child(1) a {
                transition-delay: 0.98s !important;
              }
            }
          }

          &[data-pos="18"] {
            .p-showcaseItem__animation {
              &:nth-child(4) a {
                transition-delay: 0.6s !important;
              }
              &:nth-child(1) a {
                transition-delay: 1.08s !important;
              }
            }
          }

          &[data-pos="19"] {
            .p-showcaseItem__animation {
              &:nth-child(4) a {
                transition-delay: 0.7s !important;
              }
              &:nth-child(1) a {
                transition-delay: 1.18s !important;
              }
            }
          }
        }
      }

      &[data-count="2"] {

        .p-showcaseItem {

          &__animation {

            &:nth-child(1) a {
              transition-delay: 0s !important;
            }

            &:nth-child(2) a {
              transition-delay: 0.48s !important;
              transform: scale(1);
              z-index: 10;
            }
          }

          &[data-pos="2"] {
            .p-showcaseItem__animation {
              &:nth-child(1) a {
                transition-delay: 0.1s !important;
              }
              &:nth-child(2) a {
                transition-delay: 0.58s !important;
              }
            }
          }

          &[data-pos="6"] {
            .p-showcaseItem__animation {
              &:nth-child(1) a {
                transition-delay: 0.2s !important;
              }
              &:nth-child(2) a {
                transition-delay: 0.68s !important;
              }
            }
          }

          &[data-pos="7"] {
            .p-showcaseItem__animation {
              &:nth-child(1) a {
                transition-delay: 0.3s !important;
              }
              &:nth-child(2) a {
                transition-delay: 0.78s !important;
              }
            }
          }

          &[data-pos="10"] {
            .p-showcaseItem__animation {
              &:nth-child(1) a {
                transition-delay: 0.4s !important;
              }
              &:nth-child(2) a {
                transition-delay: 0.88s !important;
              }
            }
          }

          &[data-pos="14"] {
            .p-showcaseItem__animation {
              &:nth-child(1) a {
                transition-delay: 0.5s !important;
              }
              &:nth-child(2) a {
                transition-delay: 0.98s !important;
              }
            }
          }

          &[data-pos="18"] {
            .p-showcaseItem__animation {
              &:nth-child(1) a {
                transition-delay: 0.6s !important;
              }
              &:nth-child(2) a {
                transition-delay: 1.08s !important;
              }
            }
          }

          &[data-pos="19"] {
            .p-showcaseItem__animation {
              &:nth-child(1) a {
                transition-delay: 0.7s !important;
              }
              &:nth-child(2) a {
                transition-delay: 1.18s !important;
              }
            }
          }
        }
      }

      &[data-count="3"] {

        .p-showcaseItem {

          &__animation {

            &:nth-child(2) a {
              transition-delay: 0s !important;
            }

            &:nth-child(3) a {
              transition-delay: 0.48s !important;
              transform: scale(1);
              z-index: 10;
            }
          }

          &[data-pos="2"] {
            .p-showcaseItem__animation {
              &:nth-child(2) a {
                transition-delay: 0.1s !important;
              }
              &:nth-child(3) a {
                transition-delay: 0.58s !important;
              }
            }
          }

          &[data-pos="6"] {
            .p-showcaseItem__animation {
              &:nth-child(2) a {
                transition-delay: 0.2s !important;
              }
              &:nth-child(3) a {
                transition-delay: 0.68s !important;
              }
            }
          }

          &[data-pos="7"] {
            .p-showcaseItem__animation {
              &:nth-child(2) a {
                transition-delay: 0.3s !important;
              }
              &:nth-child(3) a {
                transition-delay: 0.78s !important;
              }
            }
          }

          &[data-pos="10"] {
            .p-showcaseItem__animation {
              &:nth-child(2) a {
                transition-delay: 0.4s !important;
              }
              &:nth-child(3) a {
                transition-delay: 0.88s !important;
              }
            }
          }

          &[data-pos="14"] {
            .p-showcaseItem__animation {
              &:nth-child(2) a {
                transition-delay: 0.5s !important;
              }
              &:nth-child(3) a {
                transition-delay: 0.98s !important;
              }
            }
          }

          &[data-pos="18"] {
            .p-showcaseItem__animation {
              &:nth-child(2) a {
                transition-delay: 0.6s !important;
              }
              &:nth-child(3) a {
                transition-delay: 1.08s !important;
              }
            }
          }

          &[data-pos="19"] {
            .p-showcaseItem__animation {
              &:nth-child(2) a {
                transition-delay: 0.7s !important;
              }
              &:nth-child(3) a {
                transition-delay: 1.18s !important;
              }
            }
          }
        }
      }

      &[data-count="4"] {

        .p-showcaseItem {

          &__animation {

            &:nth-child(3) a {
              transition-delay: 0s !important;
            }

            &:nth-child(4) a {
              transition-delay: 0.48s !important;
              transform: scale(1);
              z-index: 10;
            }
          }

          &[data-pos="2"] {

            .p-showcaseItem__animation {

              &:nth-child(3) a {
                transition-delay: 0.1s !important;
              }

              &:nth-child(4) a {
                transition-delay: 0.58s !important;
              }
            }
          }

          &[data-pos="6"] {

            .p-showcaseItem__animation {

              &:nth-child(3) a {
                transition-delay: 0.2s !important;
              }

              &:nth-child(4) a {
                transition-delay: 0.68s !important;
              }
            }
          }

          &[data-pos="7"] {

            .p-showcaseItem__animation {

              &:nth-child(3) a {
                transition-delay: 0.3s !important;
              }

              &:nth-child(4) a {
                transition-delay: 0.78s !important;
              }
            }
          }

          &[data-pos="10"] {

            .p-showcaseItem__animation {

              &:nth-child(3) a {
                transition-delay: 0.4s !important;
              }
              
              &:nth-child(4) a {
                transition-delay: 0.88s !important;
              }
            }
          }

          &[data-pos="14"] {

            .p-showcaseItem__animation {

              &:nth-child(3) a {
                transition-delay: 0.5s !important;
              }

              &:nth-child(4) a {
                transition-delay: 0.98s !important;
              }
            }
          }

          &[data-pos="18"] {

            .p-showcaseItem__animation {

              &:nth-child(3) a {
                transition-delay: 0.6s !important;
              }

              &:nth-child(4) a {
                transition-delay: 1.08s !important;
              }
            }
          }

          &[data-pos="19"] {

            .p-showcaseItem__animation {

              &:nth-child(3) a {
                transition-delay: 0.7s !important;
              }

              &:nth-child(4) a {
                transition-delay: 1.18s !important;
              }
            }
          }
        }
      }
    }
  }

  /* Item Type
  ----------------------------------------------------------------------- */
  .p-showcaseItem {

    &[data-type="sofa"] {
      left: calc(50vw - 7.32vw);
      top: calc(48vh - 7.32vw);
      width: 53.33vw;
      
      @include responsive(sm, min) {
        left: calc(50vw - 15.37vw);
        top: calc(48vh - 15.37vw);
        width: 30.75vw;
      }
    }

    &[data-type="ceilinglighting"] {
      left: calc(50vw - 8.78vw);
      top: calc(48vh - 7.32vw);
      width: 64vw;

      @include responsive(sm, min) {
        left: calc(50vw - 15.37vw);
        top: calc(48vh - 10.25vw);
        width: 30.75vw;
      }
    }

    &[data-type="stool"] {
      left: calc(50vw - 7.32vw);
      top: calc(48vh - 3.66vw);
      width: 53.33vw;

      @include responsive(sm, min) {
        left: calc(50vw - 15.37vw);
        top: calc(48vh - 7.69vw);
        width: 30.75vw;
      }
    }

    &[data-type="chair"] {
      left: calc(50vw - 7.32vw);
      top: calc(48vh - 10.98vw);
      width: 53.33vw;

      @include responsive(sm, min) {
        left: calc(50vw - 7.69vw);
        top: calc(48vh - 11.53vw);
        width: 15.37vw;
      }
    }

    &[data-type="lowtable"] {
      left: calc(50vw - 7.32vw);
      top: calc(48vh - 10.98vw);
      width: 53.33vw;

      @include responsive(sm, min) {
        left: calc(50vw - 7.69vw);
        top: calc(48vh - 11.53vw);
        width: 15.37vw;
      }
    }

    &[data-type="mirror"] {
      left: calc(50vw - 8.78vw);
      top: calc(48vh - 8.78vw);
      width: 64vw;

      @include responsive(sm, min) {
        left: calc(50vw - 15.37vw);
        top: calc(48vh - 15.37vw);
        width: 30.75vw;
      }
    }

    &[data-type="light"] {
      left: calc(50vw - 7.32vw);
      top: calc(48vh - 7.32vw);
      width: 53.33vw;

      @include responsive(sm, min) {
        left: calc(50vw - 15.37vw);
        top: calc(48vh - 15.37vw);
        width: 30.75vw;
      }
    }

    &[data-type="refrigerator"] {
      left: calc(50vw - 8.78vw);
      top: calc(48vh - 7.32vw);
      width: 64vw;

      @include responsive(sm, min) {
        left: calc(50vw - 15.37vw);
        top: calc(48vh - 10.25vw);
        width: 30.75vw;
      }
    }

    &[data-type="carpet"] {
      left: calc(50vw - 7.32vw);
      top: calc(48vh - 10.98vw);
      width: 53.33vw;

      @include responsive(sm, min) {
        left: calc(50vw - 7.69vw);
        top: calc(48vh - 11.53vw);
        width: 15.37vw;
      }
    }

    &[data-type="vase"] {
      left: calc(50vw - 7.32vw);
      top: calc(48vh - 7.32vw);
      width: 53.33vw;

      @include responsive(sm, min) {
        left: calc(50vw - 15.37vw);
        top: calc(48vh - 15.37vw);
        width: 30.75vw;
      }
    }

    &[data-type="clock"] {
      left: calc(50vw - 7.32vw);
      top: calc(48vh - 10.98vw);
      width: 53.33vw;

      @include responsive(sm, min) {
        left: calc(50vw - 7.69vw);
        top: calc(48vh - 11.53vw);
        width: 15.37vw;
      }
    }

    &[data-type="cushion"] {
      left: calc(50vw - 7.32vw);
      top: calc(48vh - 7.32vw);
      width: 53.33vw;
      
      @include responsive(sm, min) {
        left: calc(50vw - 15.37vw);
        top: calc(48vh - 15.37vw);
        width: 30.75vw;
      }
    }

    &[data-type="sidetable"] {
      left: calc(50vw - 7.32vw);
      top: calc(48vh - 7.32vw);
      width: 53.33vw;

      @include responsive(sm, min) {
        left: calc(50vw - 15.37vw);
        top: calc(48vh - 15.37vw);
        width: 30.75vw;
      }
    }

    &[data-type="table"] {
      left: calc(50vw - 7.32vw);
      top: calc(48vh - 10.98vw);
      width: 53.33vw;

      @include responsive(sm, min) {
        left: calc(50vw - 7.69vw);
        top: calc(48vh - 11.53vw);
        width: 15.37vw;
      }
    }
  }

  /* Item Base Style
  ----------------------------------------------------------------------- */
  .p-showcaseItem {
    text-align: center;
    position: absolute;

    @include responsive(sm, min) {
      text-align: center;
      -webkit-backface-visibility: hidden;
      backface-visibility: hidden;
    }

    a {
      display: block;
      transform: scale(0);
      transition:
        opacity 0.6s cubic-bezier(0.645, 0.045, 0.355, 1),
        transform 0.6s cubic-bezier(0.645, 0.045, 0.355, 1);
    }

    &.-inv a {
      opacity: 1;
      transform: scale(1);
    }

    &__image {
      width: 100%;
      height: 100%;
      opacity: 0;
      transition:
        transform 0.4s cubic-bezier(0.645, 0.045, 0.355, 1),
        opacity 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);

      &.-loaded {
        opacity: 1;
      }

      img {
        width: 100%;
        height: 100%;
        position: relative;

        @include responsive(sm, min) {
          transition: transform 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);
        }
      }

      span {
        display: block;
        position: relative;

        @include responsive(sm, min) {
          transition: transform 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);
        }
        
        @include hover {
          transform: scale(1.2);
        }
      }
    }

    // Item Size
    &[data-type="sofa"] {

      &[data-size="l"] {
        width: 58.24vw;
        height: 58.24vw;
        
        @include responsive(sm, min) {
          width: 19.03vw;
          height: 19.03vw;
        }
      }

      &[data-size="m"] {
        width: 35.84vw;
        height: 35.84vw;

        @include responsive(sm, min) {
          width: 11.71vw;
          height: 11.71vw;
        }
      }

      &[data-size="s"] {
        width: 22.4vw;
        height: 22.4vw;

        @include responsive(sm, min) {
          width: 7.32vw;
          height: 7.32vw;
        }
      }
    }

    &[data-type="ceilinglighting"] {

      &[data-size="l"] {
        width: 58.24vw;
        height: 38.83vw;

        @include responsive(sm, min) {
          width: 28.55vw;
          height: 19.03vw;
        }
      }
      
      &[data-size="m"] {
        width: 35.84vw;
        height: 23.89vw;

        @include responsive(sm, min) {
          width: 17.57vw;
          height: 11.71vw;
        }
      }
      
      &[data-size="s"] {
        width: 22.4vw;
        height: 14.93vw;

        @include responsive(sm, min) {
          width: 10.98vw;
          height: 7.32vw;
        }
      }
    }

    &[data-type="stool"] {

      &[data-size="l"] {
        width: 58.24vw;
        height: 29.12vw;

        @include responsive(sm, min) {
          width: 19.03vw;
          height: 9.52vw;
        }
      }

      &[data-size="m"] {
        width: 35.84vw;
        height: 17.92vw;

        @include responsive(sm, min) {
          width: 11.71vw;
          height: 5.86vw;
        }
      }

      &[data-size="s"] {
        width: 22.4vw;
        height: 11.2vw;

        @include responsive(sm, min) {
          width: 7.32vw;
          height: 3.66vw;
        }
      }
    }

    &[data-type="chair"] {

      &[data-size="l"] {
        width: 29.12vw;
        height: 43.68vw;

        @include responsive(sm, min) {
          width: 19.03vw;
          height: 28.55vw;
        }
      }

      &[data-size="m"] {
        width: 17.92vw;
        height: 26.88vw;

        @include responsive(sm, min) {
          width: 11.71vw;
          height: 17.57vw;
        }
      }

      &[data-size="s"] {
        width: 11.2vw;
        height: 16.8vw;
        
        @include responsive(sm, min) {
          width: 7.32vw;
          height: 10.98vw;
        }
      }
    }

    &[data-type="lowtable"] {

      &[data-size="l"] {
        width: 29.12vw;
        height: 43.68vw;

        @include responsive(sm, min) {
          width: 19.03vw;
          height: 28.55vw;
        }
      }

      &[data-size="m"] {
        width: 17.92vw;
        height: 26.88vw;

        @include responsive(sm, min) {
          width: 11.71vw;
          height: 17.57vw;
        }
      }

      &[data-size="s"] {
        width: 11.2vw;
        height: 16.8vw;

        @include responsive(sm, min) {
          width: 7.32vw;
          height: 10.98vw;
        }
      }
    }

    &[data-type="light"] {

      &[data-size="l"] {
        width: 58.24vw;
        height: 58.24vw;
        
        @include responsive(sm, min) {
          width: 19.03vw;
          height: 19.03vw;
        }
      }

      &[data-size="m"] {
        width: 35.84vw;
        height: 35.84vw;

        @include responsive(sm, min) {
          width: 11.71vw;
          height: 11.71vw;
        }
      }

      &[data-size="s"] {
        width: 22.4vw;
        height: 22.4vw;

        @include responsive(sm, min) {
          width: 7.32vw;
          height: 7.32vw;
        }
      }
    }

    &[data-type="mirror"] {

      &[data-size="l"] {
        width: 58.24vw;
        height: 58.24vw;

        @include responsive(sm, min) {
          width: 19.03vw;
          height: 19.03vw;
        }
      }

      &[data-size="m"] {
        width: 35.84vw;
        height: 35.84vw;
        
        @include responsive(sm, min) {
          width: 11.71vw;
          height: 11.71vw;
        }
      }

      &[data-size="s"] {
        width: 22.4vw;
        height: 22.4vw;

        @include responsive(sm, min) {
          width: 7.32vw;
          height: 7.32vw;
        }
      }
    }

    &[data-type="refrigerator"] {

      &[data-size="l"] {
        width: 58.24vw;
        height: 58.24vw;

        @include responsive(sm, min) {
          width: 19.03vw;
          height: 19.03vw;
        }
      }

      &[data-size="m"] {
        width: 35.84vw;
        height: 35.84vw;

        @include responsive(sm, min) {
          width: 11.71vw;
          height: 11.71vw;
        }
      }

      &[data-size="s"] {
        width: 22.4vw;
        height: 22.4vw;

        @include responsive(sm, min) {
          width: 7.32vw;
          height: 7.32vw;
        }
      }
    }

    &[data-type="carpet"] {

      &[data-size="l"] {
        width: 29.12vw;
        height: 43.68vw;

        @include responsive(sm, min) {
          width: 19.03vw;
          height: 28.55vw;
        }
      }

      &[data-size="m"] {
        width: 17.92vw;
        height: 26.88vw;

        @include responsive(sm, min) {
          width: 11.71vw;
          height: 17.57vw;
        }
      }

      &[data-size="s"] {
        width: 11.2vw;
        height: 16.8vw;

        @include responsive(sm, min) {
          width: 7.32vw;
          height: 10.98vw;
        }
      }
    }

    &[data-type="vase"] {

      &[data-size="l"] {
        width: 58.24vw;
        height: 58.24vw;

        @include responsive(sm, min) {
          width: 19.03vw;
          height: 19.03vw;
        }
      }

      &[data-size="m"] {
        width: 35.84vw;
        height: 35.84vw;

        @include responsive(sm, min) {
          width: 11.71vw;
          height: 11.71vw;
        }
      }

      &[data-size="s"] {
        width: 22.4vw;
        height: 22.4vw;

        @include responsive(sm, min) {
          width: 7.32vw;
          height: 7.32vw;
        }
      }
    }

    &[data-type="clock"] {

      &[data-size="l"] {
        width: 29.12vw;
        height: 43.68vw;

        @include responsive(sm, min) {
          width: 19.03vw;
          height: 28.55vw;
        }
      }

      &[data-size="m"] {
        width: 17.92vw;
        height: 26.88vw;

        @include responsive(sm, min) {
          width: 11.71vw;
          height: 17.57vw;
        }
      }

      &[data-size="s"] {
        width: 11.2vw;
        height: 16.8vw;

        @include responsive(sm, min) {
          width: 7.32vw;
          height: 10.98vw;
        }
      }
    }

    &[data-type="cushion"] {

      &[data-size="l"] {
        width: 58.24vw;
        height: 58.24vw;

        @include responsive(sm, min) {
          width: 19.03vw;
          height: 19.03vw;
        }
      }

      &[data-size="m"] {
        width: 35.84vw;
        height: 35.84vw;

        @include responsive(sm, min) {
          width: 11.71vw;
          height: 11.71vw;
        }
      }

      &[data-size="s"] {
        width: 22.4vw;
        height: 22.4vw;

        @include responsive(sm, min) {
          width: 7.32vw;
          height: 7.32vw;
        }
      }
    }

    &[data-type="sidetable"] {

      &[data-size="l"] {
        width: 58.24vw;
        height: 58.24vw;

        @include responsive(sm, min) {
          width: 19.03vw;
          height: 19.03vw;
        }
      }

      &[data-size="m"] {
        width: 35.84vw;
        height: 35.84vw;

        @include responsive(sm, min) {
          width: 11.71vw;
          height: 11.71vw;
        }
      }

      &[data-size="s"] {
        width: 22.4vw;
        height: 22.4vw;

        @include responsive(sm, min) {
          width: 7.32vw;
          height: 7.32vw;
        }
      }
    }

    &[data-type="table"] {

      &[data-size="l"] {
        width: 29.12vw;
        height: 43.68vw;
        
        @include responsive(sm, min) {
          width: 19.03vw;
          height: 28.55vw;
        }
      }

      &[data-size="m"] {
        width: 17.92vw;
        height: 26.88vw;

        @include responsive(sm, min) {
          width: 11.71vw;
          height: 17.57vw;
        }
      }

      &[data-size="s"] {
        width: 11.2vw;
        height: 16.8vw;

        @include responsive(sm, min) {
          width: 7.32vw;
          height: 10.98vw;
        }
      }
    }

    // Item Style（商品ごとのスタイル微調整）
    &[data-type="sofa"] .p-showcaseItem__image {
      transform: translateX(-6.13vw);
      
      @include responsive(sm, min) {
        transform: translateX(-1.68vw);
      }
    }

    &[data-type="ceilinglighting"] .p-showcaseItem__image {
      transform: translateX(-4.8vw);
      
      @include responsive(sm, min) {
        transform: translateX(-1.68vw);
      }
    }

    &[data-type="stool"] .p-showcaseItem__image {
      transform: translateX(-2.67vw);
      
      @include responsive(sm, min) {
        transform: translateX(-0.73vw);
      }
    }
  }

  /* Item Position
  ----------------------------------------------------------------------- */
  .p-showcaseItem {

    &[data-pos="1"] {
      left: 10.67vw;
      top: 10.67vw;
      
      @include responsive(sm, min) {
        left: 45.02vw;
        top: 9.52vw;
      }
    }

    &[data-pos="2"] {
      left: 73.33vw;
      top: 56vw;

      @include responsive(sm, min) {
        left: 78.7vw;
        top: 8.42vw;
      }
    }

    &[data-pos="3"] {
      left: 60.27vw;
      top: 117.33vw;

      @include responsive(sm, min) {
        left: 2.34vw;
        top: 10.98vw;
      }
    }

    &[data-pos="4"] {
      left: 12.27vw;
      top: 109.33vw;

      @include responsive(sm, min) {
        left: 62.96vw;
        top: 16.47vw;
      }
    }

    &[data-pos="5"] {
      left: 56vw;
      top: 171.73vw;

      @include responsive(sm, min) {
        left: 94.44vw;
        top: 18.67vw;
      }
    }

    &[data-pos="6"] {
      left: 8vw;
      top: 213.33vw;

      @include responsive(sm, min) {
        left: 12.81vw;
        top: 18.67vw;
      }
    }

    &[data-pos="7"] {
      left: 53.33vw;
      top: 280vw;

      @include responsive(sm, min) {
        left: 71.74vw;
        top: 30.38vw;
      }
    }

    &[data-pos="8"] {
      left: 5.33vw;
      top: 282.4vw;

      @include responsive(sm, min) {
        left: 62.96vw;
        top: 31.11vw;
      }
    }

    &[data-pos="9"] {
      left: 53.33vw;
      top: 333.33vw;

      @include responsive(sm, min) {
        left: -3.29vw;
        top: 34.04vw;
      }
    }

    &[data-pos="10"] {
      left: -2.67vw;
      top: 373.87vw;

      @include responsive(sm, min) {
        left: 35.14vw;
        top: 37.7vw;
      }
    }

    &[data-pos="11"] {
      left: 72vw;
      top: 410.67vw;

      @include responsive(sm, min) {
        left: 21.96vw;
        top: 43.19vw;
      }
    }

    &[data-pos="12"] {
      left: 10.67vw;
      top: 445.33vw;

      @include responsive(sm, min) {
        left: 72.11vw;
        top: 45.02vw;
      }
    }

    &[data-pos="13"] {
      left: 58.67vw;
      top: 456vw;

      @include responsive(sm, min) {
        left: 47.95vw;
        top: 46.49vw;
      }
    }

    &[data-pos="14"] {
      left: 16vw;
      top: 498.67vw;

      @include responsive(sm, min) {
        left: 8.05vw;
        top: 46.85vw;
      }
    }

    &[data-pos="15"] {
      left: 64vw;
      top: 557.33vw;

      @include responsive(sm, min) {
        left: 90.41vw;
        top: 40.85vw;
      }
    }

    &[data-pos="16"] {
      left: 2.67vw;
      top: 576vw;

      @include responsive(sm, min) {
        left: -1.46vw;
        top: 53.07vw;
      }
    }

    &[data-pos="17"] {
      left: 32vw;
      top: 634.67vw;
      
      @include responsive(sm, min) {
        left: 2.93vw;
        top: 68.43vw;
      }
    }

    &[data-pos="18"] {
      left: 10.67vw;
      top: 677.33vw;

      @include responsive(sm, min) {
        left: 54.9vw;
        top: 51.57vw;
      }
    }

    &[data-pos="19"] {
      left: 53.33vw;
      top: 690.67vw;

      @include responsive(sm, min) {
        left: 14.28vw;
        top: 54.35vw;
      }
    }

    &[data-pos="20"] {
      
      @include responsive(sm, min) {
        left: 77.96vw;
        top: 69.38vw;
      }
    }
  }

  /* Item Transigion Delay
  ----------------------------------------------------------------------- */
  .p-showcaseItem {

    &:nth-child(1) a {

      @include responsive(sm, min) {
        transition-delay: 0.02s;
      }
    }

    &:nth-child(2) a {
      transition-delay: 0.12s;

      @include responsive(sm, min) {
        transition-delay: 0.04s;
      }
    }

    &:nth-child(3) a {
      transition-delay: 0.18s;
      
      @include responsive(sm, min) {
        transition-delay: 0.06s;
      }
    }

    &:nth-child(4) a {
      transition-delay: 0.24s;

      @include responsive(sm, min) {
        transition-delay: 0.08s;
      }
    }

    &:nth-child(5) a {
      transition-delay: 0.3s;

      @include responsive(sm, min) {
        transition-delay: 0.1s;
      }
    }

    &:nth-child(6) a {
      @include responsive(sm, min) {
        transition-delay: 0.12s;
      }
    }

    &:nth-child(7) a {
      @include responsive(sm, min) {
        transition-delay: 0.14s;
      }
    }

    &:nth-child(8) a {
      @include responsive(sm, min) {
        transition-delay: 0.16s;
      }
    }

    &:nth-child(9) a {
      @include responsive(sm, min) {
        transition-delay: 0.18s;
      }
    }

    &:nth-child(10) a {
      @include responsive(sm, min) {
        transition-delay: 0.2s;
      }
    }

    &:nth-child(11) a {
      @include responsive(sm, min) {
        transition-delay: 0.22s;
      }
    }

    &:nth-child(12) a {
      @include responsive(sm, min) {
        transition-delay: 0.24s;
      }
    }

    &:nth-child(13) a {
      @include responsive(sm, min) {
        transition-delay: 0.26s;
      }
    }

    &:nth-child(14) a {
      @include responsive(sm, min) {
        transition-delay: 0.28s;
      }
    }

    &:nth-child(15) a {
      @include responsive(sm, min) {
        transition-delay: 0.3s;
      }
    }

    &:nth-child(16) a {
      @include responsive(sm, min) {
        transition-delay: 0.32s;
      }
    }

    &:nth-child(17) a {
      @include responsive(sm, min) {
        transition-delay: 0.34s;
      }
    }

    &:nth-child(18) a {
      @include responsive(sm, min) {
        transition-delay: 0.36s;
      }
    }

    &:nth-child(19) a {
      @include responsive(sm, min) {
        transition-delay: 0.38s;
      }
    }

    &:nth-child(20) a {
      @include responsive(sm, min) {
        transition-delay: 0.4s;
      }
    }
  }
</style>
