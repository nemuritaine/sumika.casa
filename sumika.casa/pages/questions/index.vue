<template>
  <div class="p-like__inner">
    <div class="p-like__wrapper" v-if="swipedLikeCount < 10">
      <div class="p-like__progressbar">
        <ul>
          <li :class="{ 'is-active': swipedLikeCount > 0 }"></li>
          <li :class="{ 'is-active': swipedLikeCount > 1 }"></li>
          <li :class="{ 'is-active': swipedLikeCount > 2 }"></li>
          <li :class="{ 'is-active': swipedLikeCount > 3 }"></li>
          <li :class="{ 'is-active': swipedLikeCount > 4 }"></li>
          <li :class="{ 'is-active': swipedLikeCount > 5 }"></li>
          <li :class="{ 'is-active': swipedLikeCount > 6 }"></li>
          <li :class="{ 'is-active': swipedLikeCount > 7 }"></li>
          <li :class="{ 'is-active': swipedLikeCount > 8 }"></li>
          <li :class="{ 'is-active': swipedLikeCount > 9 }"></li>
        </ul>
      </div>
      <header class="p-like__header">
        <div class="p-likeHeader">
          <div class="p-likeHeader__title">
            <h1>インテリアコーディネートのパーソナライズ診断</h1>
          </div>
          <div class="p-likeHeader__subtitle">
            <span>What</span>
            <span>like</span>
            <span>?</span>
          </div>
        </div>
      </header>
      <main class="p-like__main">
        <article class="p-like__article">
          <div class="p-like__card" v-if="elements.length > 0" ref="likeCards">
            <div
              v-for="(element, index) in elements" 
              :key="element.id"
              class="p-likeCard"
              :style="cardStyle(index)"
              :class="{ 'is-active': index === currentCardIndex }"
              @mousedown="handleMouseDown"
              @mousemove="handleMouseMove"
              @mouseup="handleMouseUp"
              @touchstart="handleTouchStart"
              @touchmove="handleTouchMove"
              @touchend="handleTouchEnd"
            >
              <div class="p-likeCard__image">
                <img :src="element.image_src" alt="" width="" height="" @dragstart.prevent="preventImageDrag">
              </div>
              <div class="p-likeCard__heading">
                <div class="p-likeCard__brand">
                  <p>{{ element.brand }}</p>
                </div>
                <div class="p-likeCard__information" @click="toggleDetails">
                  <div class="p-likeCardInformation">
                    <span>i</span>
                  </div>
                </div>
              </div>
              <div v-if="isExpanded && currentDetailIndex === index" class="p-likeCard__details">
                <div class="p-likeCard__title">
                  <p>{{ element.title }}</p>
                </div>
                <!-- <ul class="p-likeCard__style">
                  <li v-for="style in element.style" :key="style.id">
                    <span :value="style.id">{{ style.name }}</span>
                  </li>
                </ul> -->
                <dl v-if="element.price" class="p-likeCard__price">
                  <dt>値段</dt>
                  <dd>{{ element.price }}円</dd>
                </dl>
                <dl v-if="element.size" class="p-likeCard__size">
                  <dt>サイズ</dt>
                  <dd v-html="element.size"></dd>
                </dl>
                <div class="p-likeCard__coordination" v-if="element.coordination_data && element.coordination_data.length > 0">
                  <div class="p-likeCardCoordination">
                    <div class="p-likeCardCoordination__title">
                      <p>コーディネートのアイデア</p>
                    </div>
                    <ul class="p-likeCardCoordination__card">
                      <li class="p-likeCardCoordinationCard" v-for="coordination in element.coordination_data" :key="coordination.id">
                        <a class="p-likeCardCoordinationCard__link" :href="`/element/${coordination.id}`" target="_blank" rel="noopener noreferrer">
                          <span class="p-likeCardCoordinationCard__image">
                            <img :src="coordination.thumbnail" alt="" width="" height="">
                          </span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </article>
      </main>
      <footer class="p-like__button" ref="likeButtons">
        <ul class="p-likeButton" v-if="elements.length > 0">
          <li class="p-likeButton__return" ref="returnButton">
            <button @click="returnToPreviousSlide">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                <path d="m27.17,45.88c-10.69,1.19-19.89-6.55-21.05-16.71-.13-1.16.82-2.17,1.99-2.17h6.07c.95,0,1.79.66,1.95,1.59.77,4.29,4.58,7.53,9.12,7.41s8.6-4.04,8.74-8.74c.14-5.08-3.95-9.26-9-9.26V8c11.19,0,20.15,9.73,18.88,21.17-.97,8.7-8,15.74-16.71,16.71Z"/>
                <path d="m21.73,23.45l-10.7-8.92c-.96-.8-.96-2.27,0-3.07L21.73,2.55c1.3-1.08,3.27-.16,3.27,1.53v17.83c0,1.69-1.97,2.62-3.27,1.53Z"/>
              </svg>
            </button>
          </li>
          <li class="p-likeButton__norp">
            <button @click="animateNorp">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                <path d="M33.5,25l13.3-13.3c0.8-0.8,0.8-2,0-2.8l-5.7-5.7c-0.8-0.8-2-0.8-2.8,0L25,16.5L11.7,3.2
                  c-0.8-0.8-2-0.8-2.8,0L3.2,8.8c-0.8,0.8-0.8,2,0,2.8L16.5,25L3.2,38.3c-0.8,0.8-0.8,2,0,2.8l5.7,5.7c0.8,0.8,2,0.8,2.8,0L25,33.5
                  l13.3,13.3c0.8,0.8,2,0.8,2.8,0l5.7-5.7c0.8-0.8,0.8-2,0-2.8L33.5,25z"/>
              </svg>
            </button>
          </li>
          <li class="p-likeButton__window">
            <a :href="`/element/${currentCardElementId}`" target="_blank" rel="noopener noreferrer">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                <path d="m37.91,44.97l-12.91-8.47-12.91,8.47c-1.33.87-3.09-.08-3.09-1.67V7c0-1.1.89-2,2-2h28.01c1.1,0,2,.89,2,2v36.31c0,1.59-1.76,2.54-3.09,1.67Z"/>
              </svg>
            </a>
          </li>
          <li class="p-likeButton__like">
            <button @click="animateLike">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                <path d="m45.03,7.81c-2.62-2.62-6.1-4.09-9.78-4.09s-7.16,1.43-9.78,4.05l-.45.45-.45-.45c-2.62-2.62-6.1-4.05-9.78-4.05s-7.12,1.43-9.74,4.05c-2.62,2.62-4.05,6.1-4.05,9.78s1.43,7.16,4.05,9.78l18.25,18.25c.45.45,1.06.7,1.72.7s1.27-.25,1.72-.7l18.21-18.21c2.62-2.62,4.05-6.1,4.05-9.78s-1.43-7.16-4.05-9.78h.08Z"/>
              </svg>
            </button>
          </li>
          <li class="p-likeButton__shuffle" ref="shuffleButton">
            <button @click="shuffleCurrentCard">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                <path d="m31.5,20.9V3.1c0-1.7,1.98-2.62,3.28-1.54l10.69,8.9c.96.8.96,2.27,0,3.07l-10.69,8.9c-1.3,1.09-3.28.16-3.28-1.54Z"/>
                <path d="m15.23,48.45l-10.7-8.92c-.96-.8-.96-2.27,0-3.07l10.7-8.92c1.3-1.08,3.27-.16,3.27,1.53v17.83c0,1.69-1.97,2.62-3.27,1.53Z"/>
                <path d="m11,25h-5.99c-1.11,0-2-.9-2-2v-1c0-8.28,6.72-15,15-15h14v10h-14c-2.76,0-5,2.24-5,5v1c0,1.11-.9,2-2,2Z"/>
                <path d="m32,43h-14v-10h14c2.76,0,5-2.24,5-5v-1c0-1.1.9-2,2-2h6c1.1,0,2,.9,2,2v1c0,8.28-6.72,15-15,15Z"/>
              </svg>
            </button>
          </li>
        </ul>
      </footer>
    </div>
    <div class="p-like__result" v-if="swipedLikeCount === 10">
      <div class="p-likeResult">
        <div v-if="isFetching">
          <!-- お部屋を取得中... -->
        </div>
        <div v-else-if="posts.length === 0">
          {{ topTags.join(', ') }}のお部屋は存在しません。
          <ul class="p-likeResult__data">
            <li v-for="(value, key) in sortedSwipedLikeStyles" :key="key">
              {{ key }}: {{ value }}
            </li>
          </ul>
        </div>
        <div v-if="posts.length > 0" class="splide" ref="resultSlider">
          <div class="p-likeResult__card splide__track">
            <div class="p-likeResult__card splide__list">
              <div v-for="post in posts" :key="post.id" class="p-likeResultCard splide__slide">
                <div class="p-likeResultCard__image">
                  <img :src="post.image_src" width="" height="" alt="">
                </div>
                <!-- <ul class="p-likeResultCard__tag">
                  <li v-for="tag in post.tags" :key="tag.id">
                    <span :value="tag.id">{{ tag.slug }}</span>
                  </li>
                </ul> -->
                <div class="p-likeResultCard__profile">
                  <div class="p-likeResultCard__name">
                    <p>
                      <a :href="`${post.url}`" target="_blank" rel="noopener noreferrer">
                        <span v-html="wrapSpecialCharacters(post.name)"></span>
                        <span class="is-apostrophe">'</span>
                        <span>s</span>
                      </a>
                    </p>
                    <p>
                      <a :href="`${post.url}`" target="_blank" rel="noopener noreferrer">
                        <span>ROOM</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12.5 12.5">
                          <line x1="12" y1=".5" x2=".36" y2="12.14"/>
                          <polyline points="0 .5 12 .5 12 12.5"/>
                        </svg>
                      </a>
                    </p>
                  </div>
                  <div class="p-likeResultCard__link">
                    <a :href="`${post.url}`" target="_blank" rel="noopener noreferrer">{{ post.sns }}</a>
                  </div>
                </div>
                <div class="p-likeResultCard__button">
                  <a :href="`/post/${post.id}`">
                    <span></span>
                  </a>
                </div>
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

  export default {

    layout: 'empty',

    head () {
      const title = 'インテリアコーディネートのパーソナライズ診断'

      return {
        title,
        meta: [
          { hid: 'og:title', property: 'og:title', content: title },
          { hid: 'og:url', property: 'og:url', content: `${process.env.BASE_URL}questions` },
        ],
      }
    },

    data () {
      return {
        isLoading: false,
        swipedLikeCards: [],
        swipedNorpCards: [],
        swipedLikeStyles: {},
        elements: [],
        posts: [],
        startX: 0,
        startY: 0,
        isDragging: false,
        transforms: {},
        transform: '',
        diffX: 0,
        diffY: 0,
        currentCardIndex: 0,
        swipedLikeCount: 0,
        swipedNorpCount: 0,
        swipedLikeStyles: {},
        isFetching: false,
        settingId: [],
        baseBoxShadow: '',
        boxShadowColorCurrent: ' rgba(86, 88, 83, 0.1)',
        boxShadowColorOther: ' rgba(86, 88, 83, 0)',
        isExpanded: false, // カードの拡大表示制御
        originalCardRect: null,
        currentDetailIndex: null, // 詳細情報の表示制御
        isProcessingLike: false, // like処理中フラグ
      }
    },

    // async asyncData ({ $axios, query, app }) {
    //   const settingId = query.id ? query.id.split(',') : []
    //   let params = {
    //     id: settingId.length > 0 ? settingId : undefined
    //   }
    //   if (!params.id) {
    //     params.order = 'rand'
    //   }

    //   try {
    //     const responseElements = await $axios.get(`${app.$url}/custom/v0/questions`, { params })
    //     return {
    //       elements: responseElements.data,
    //     }
    //   } catch (error) {
    //     console.error(error)
    //     return {
    //       elements: [],
    //     }
    //   }
    // },

    computed: {

      bodyClass() {
        return 'p-like'
      },

      currentCardElementId() {
        // elements配列が存在し、currentCardIndexが有効な範囲内であるかを確認
        if (this.elements.length > this.currentCardIndex) {
          return this.elements[this.currentCardIndex].id
        }
        return null
      },

      sortedSwipedLikeStyles() {
        return Object.entries(this.swipedLikeStyles)
          .sort((a, b) => b[1] - a[1])  // この行を変更
          .reduce((acc, [key, value]) => {
            acc[key] = value
            return acc
          }, {})
      },

      topTags() {
        return this.getTopTwoStyles()
      }
    },

    created () {
      if (process.client) {
      }
    },

    mounted () {
      document.addEventListener('touchmove', this.preventTouchMove, { passive: false })
      this.preventDoubleTapZoom()
      this.fetchNewElements()
      this.setBoxShadowBase() // boxShadowを定義
      window.addEventListener('resize', this.setBoxShadowBase)
    },

    beforeDestroy () {
      document.removeEventListener('touchmove', this.preventTouchMove)
      window.removeEventListener('resize', this.setBoxShadowBase)
    },

    watch: {

      async swipedLikeCount(newVal) {
        if (newVal === 10) {
          await this.fetchPostsByTopTags()
        }
      },
      
      posts: {
        immediate: true,
        deep: true,
        handler(newPosts) {
          if (newPosts.length > 0) {
            this.$nextTick(() => {
              this.initializeSplide()
            })
          }
        }
      },
    },

    methods: {

      // async likePost(postId) {

      //   // 処理中なら何もしない
      //   if (this.isProcessingLike) return
      //   this.isProcessingLike = true // フラグを立てる

      //   const storageKey = 'liked_posts'
      //   let likedPosts
        
      //   // いいね済みか確認
      //   if (process.client) {
      //     const canUseCookies = navigator.cookieEnabled // Cookieが利用可能か確認
      //     if (canUseCookies) {
      //       likedPosts = this.$cookies.get(storageKey) || []
      //     } else {
      //       likedPosts = JSON.parse(window.localStorage.getItem(storageKey)) || []
      //     }
      //     const hasLiked = likedPosts.includes(postId)
      //     if(hasLiked) return // 既にいいね済みだったら関数を終了する
      //   }

      //   try {
      //     await this.$axios.$post(`${this.$nuxt.$url}/likes/change/${postId}`, {
      //       unlike: '0',
      //     })
      //     if (process.client) {
      //       const canUseCookies = navigator.cookieEnabled
      //       if (canUseCookies) {
      //         // Cookieが利用可能な場合、like情報をCookieに保存
      //         likedPosts.push(postId) // 情報をCookieに保存
      //         this.$cookies.set(storageKey, likedPosts)
      //       } else {
      //         // Cookieが利用不可能な場合、like情報をローカルストレージに保存
      //         likedPosts.push(postId) // 情報をローカルストレージに保存
      //         window.localStorage.setItem(storageKey, JSON.stringify(likedPosts))
      //       }
      //     }
      //   } catch (error) {
      //     console.error('Error liking post:', error)
      //   } finally {
      //     this.isProcessingLike = false // フラグを下す
      //     console.log('finish like')
      //   }
      // },

      // async removeLikePost(postId) {

      //   // 処理中なら何もしない
      //   if (this.isProcessingLike) return
      //   this.isProcessingLike = true // フラグを立てる

      //   const storageKey = 'liked_posts'
      //   let likedPosts
        
      //   // いいね済みか確認
      //   if (process.client) {
      //     const canUseCookies = navigator.cookieEnabled // Cookieが利用可能か確認
      //     if (canUseCookies) {
      //       likedPosts = this.$cookies.get(storageKey) || []
      //     } else {
      //       likedPosts = JSON.parse(window.localStorage.getItem(storageKey)) || []
      //     }
      //     const hasLiked = likedPosts.includes(postId)
      //     if(!hasLiked) return // いいねしていなかったら関数を終了する
      //   }

      //   try {
      //     await this.$axios.$post(`${this.$nuxt.$url}/likes/change/${postId}`, {
      //       unlike: '1',
      //     })
      //     if (process.client) {
      //       const canUseCookies = navigator.cookieEnabled
      //       if (canUseCookies) {
      //         // Cookieが利用可能な場合、Cookieから情報を削除
      //         likedPosts = likedPosts.filter(id => id !== postId) // Cookieから情報を削除
      //         this.$cookies.set(storageKey, likedPosts)
      //       } else {
      //         // Cookieが利用不可能な場合、ローカルストレージから情報を削除
      //         likedPosts = likedPosts.filter(id => id !== postId) // ローカルストレージから情報を削除
      //         window.localStorage.setItem(storageKey, JSON.stringify(likedPosts))
      //       }
      //     }
      //   } catch (error) {
      //     console.error('Error liking post:', error)
      //   } finally {
      //     this.isProcessingLike = false // フラグを下す
      //     console.log('finish remove like')
      //   }
      // },

      toggleDetails() {
        return new Promise(resolve => {
          this.isExpanded = !this.isExpanded // 詳細の表示・非表示をトグル
          const returnButton = this.$refs.returnButton
          const shuffleButton = this.$refs.shuffleButton

          const card = this.$refs.likeCards.children[this.currentCardIndex]

          if (this.isExpanded) {
            document.body.style.overflow = 'hidden'
            this.currentDetailIndex = this.currentCardIndex // カードの詳細を表示する際に現在のインデックスを保存
            
            gsap.to([returnButton, shuffleButton], { // ボタンを非表示に
              opacity: 0,
              visibility: "hidden",
              duration: 0.3 // フェードアウトの期間
            })

            const rect = card.getBoundingClientRect() // ここで初期位置とサイズを取得
            this.originalCardRect = rect
            gsap.set(card, { // まずカードを初期位置に固定
              overflow: "",
              position: "fixed",
              top: rect.top + "px",
              left: rect.left + "px",
              width: rect.width + "px",
              height: rect.height + "px",
              translateX: "",
              paddingTop: this.vh(50, 568),
              paddingBottom: this.vh(24, 568),
              boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorCurrent}`,
            })
            gsap.to(card, { // カードのサイズを画面いっぱいにする
              overflow: "scroll",
              borderRadius: 0,
              width: window.innerWidth >= 481 ? this.vh(320, 568) : "100vw",
              height: "100svh",
              top: 0,
              left: "50%",
              translateX: "-50%",
              duration: 0.3,
              paddingTop: this.vh(48, 568),
              paddingBottom: 0, // 90+余白20 this.vh(110, 568)
              boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorOther}`,
            })

          } else {
            this.currentDetailIndex = null // カードの詳細を非表示にする際にリセット

            gsap.to([returnButton, shuffleButton], { // ボタンを表示
              opacity: 1,
              visibility: "visible",
              duration: 0.3
            })

            gsap.to(card, { // 保存しておいた値を使用してカードのサイズと位置を元に戻す
              borderRadius: window.innerWidth >= 481 ? this.vh(10, 568) : this.rem(10),
              overflow: "",
              translateX: "",
              top: this.originalCardRect.top + "px",
              left: this.originalCardRect.left + "px",
              width: this.originalCardRect.width + "px",
              height: this.originalCardRect.height + "px",
              translateX: "",
              paddingTop: this.vh(50, 568),
              paddingBottom: this.vh(24, 568),
              duration: 0.3,
              boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorCurrent}`,
              onComplete: () => {
                gsap.set(card, {
                  borderRadius: window.innerWidth >= 481 ? this.vh(10, 568) : this.rem(10),
                  overflow: "",
                  position: "relative",
                  top: "",
                  left: "",
                  width: window.innerWidth >= 481 ? this.vh(300, 568) : "100%",
                  translateX: "",
                  paddingTop: this.vh(50, 568),
                  paddingBottom: this.vh(24, 568),
                  height: ""
                })
                document.body.style.overflow = 'auto'
                resolve() // ここでPromiseを解決
              }
            })
          }
        })
      },

      vh(px, base = 720) {
        return (px / base) * 100 + 'svh'
      },

      rem(px, base = 16) {
        return `${px / base}rem`
      },

      setBoxShadowBase() {
        if (process.client) { // ブラウザ上で発火する（サーバーサイドで発火しない）
          const screenWidth = window.innerWidth
          if (screenWidth >= 481) {
            this.baseBoxShadow = `${this.vh(2, 568)} ${this.vh(2, 568)} ${this.vh(30, 568)}`
          } else {
            this.baseBoxShadow = `2px 2px 30px`
          }
        }
      },

      async fetchNewElements() {
        const settingId = this.$route.query.id ? this.$route.query.id.split(',') : []
        let params = {
          id: settingId.length > 0 ? settingId : undefined
        }
        if (!params.id) {
          params.order = 'rand'
        }
        try {
          const responseElements = await this.$axios.get(`${this.$url}/custom/v0/questions`, { params })
          this.elements = responseElements.data
        } catch (error) {
          console.error(error)
        }
      },

      wrapSpecialCharacters(text) {
        return text.replace(/(\d+)/g, '<span class="is-different">$1</span>')
      },

      initializeSplide () {
        const splide = new Splide(this.$refs.resultSlider, {
          perPage: 1,
          speed: 800,
          type: 'fade',
          rewind: true,
          gap: null,
          autoplay: true,
          interval: 5000,
          pauseOnHover: false,
          arrows: false,
          pagination: false,
        }).mount()
      },

      handleSwipe() {
        this.diffX = 0
        this.diffY = 0
        if (this.currentCardIndex < this.elements.length - 1) {
          this.currentCardIndex++
        } else {
          // すべてのカードがスワイプされた後の処理（例: 新しいカードデータの取得）
        }
      },

      cardStyle(index) {
        this.setBoxShadowBase()
        const cardId = this.elements[index].id
        const cardTransform = this.transforms[cardId] || ''

        if (index === this.currentCardIndex) {
          return {
            zIndex: 1000 - index,
            transform: `${cardTransform} scale(1)`,
            boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorCurrent}`,
          }
        } else {
          return {
            zIndex: 1000 - index,
            transform: `${cardTransform} scale(0.95)`,
            boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorOther}`,
          }
        }
      },

      getTopTwoStyles() {

        if (Object.keys(this.swipedLikeStyles).length === 0) {
          return []
        }

        const sortedStyles = Object.entries(this.swipedLikeStyles).sort((a, b) => b[1] - a[1])
        const firstPlaceScore = sortedStyles[0][1]
        const firstPlaceGroup = sortedStyles.filter(entry => entry[1] === firstPlaceScore)

        let selectedStyles = []

        if (firstPlaceGroup.length >= 2) {
          // 1位が2つ以上ある場合、その中からランダムに2つ選ぶ
          selectedStyles = firstPlaceGroup.sort(() => 0.5 - Math.random()).slice(0, 2).map(entry => entry[0])
        } else if (sortedStyles.length > 1) {
          // 1位が1つで、2位が存在する場合
          const secondPlaceScore = sortedStyles[1][1]
          const secondPlaceGroup = sortedStyles.filter(entry => entry[1] === secondPlaceScore)
          selectedStyles.push(firstPlaceGroup[0][0])

          // 2位が複数ある場合、その中からランダムに1つ選ぶ
          selectedStyles.push(secondPlaceGroup.sort(() => 0.5 - Math.random())[0][0])
        } else {
          // 1位のみ存在する場合
          selectedStyles.push(firstPlaceGroup[0][0])
        }

        return selectedStyles
      },

      // Like Button
      async animateLike() {
        if (this.isLoading) return
        this.isLoading = true

        if (this.isExpanded) {
          await this.toggleDetails() // 拡大されていれば元に戻す
        }

        this.swipedLikeCount++
        // インテリアスタイルの得点を計算
        const currentStyles = this.elements[this.currentCardIndex].style
        for (let style of currentStyles) {
          if (this.swipedLikeStyles[style.slug]) {
            this.swipedLikeStyles[style.slug]++
          } else {
            this.swipedLikeStyles[style.slug] = 1
          }
        }
        
        // 次のカードのアニメーションを開始
        if (this.currentCardIndex + 1 < this.elements.length) {
          const nextCardElement = this.$refs.likeCards.children[this.currentCardIndex + 1]
          gsap.set(nextCardElement, {
            scale: 0.95,
            boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorOther}`,
            x: 0,
            y: 0,
            rotation: 0,
          })
          gsap.to(nextCardElement, {
            duration: 0.5,
            scale: 1,
            boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorCurrent}`,
            x: 0,
            y: 0,
            rotation: 0,
          })
        }

        // アニメーションの開始位置を設定
        gsap.set(this.$refs.likeCards.children[this.currentCardIndex], {
          x: this.diffX,
          y: this.diffY,
          scale: 1,
          boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorCurrent}`,
          rotation: this.diffX / 10
        })
        // カードのアニメーション
        const viewportHeight = window.innerHeight // デバイスの高さを取得
        const cardWidth = viewportHeight * (9 / 16) // アスペクト比からカードの横幅を計算
        this.diffX = cardWidth
        const rotation = this.diffX / 10 // カードの傾きによる横の変位を計算
        const halfCardWidth = cardWidth / 2
        const hypotenuse = halfCardWidth / Math.cos(Math.abs(rotation) * (Math.PI / 180))
        const xOffsetFromRotation = hypotenuse - halfCardWidth
        this.diffX += xOffsetFromRotation + 100
        // この初期のdiffXを使用して回転を計算
        gsap.to(this.$refs.likeCards.children[this.currentCardIndex], {
          duration: 0.5,
          x: this.diffX,
          y: this.diffY,
          scale: 1,
          boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorOther}`,
          rotation: rotation,
          onComplete: () => {
            /*
              gsapは非同期処理のためthis.handleSwipe()の方が早く処理される
              その場合this.currentCardIndexが更新されてしまうのでバグる原因になる
              this.transforms[this.elements[this.currentCardIndex].id] =
                `translate(${this.diffX}px, ${this.diffY}px) rotate(${this.diffX / 10}deg)`
            */
          }
        })
          
        this.swipedLikeCards.push(this.elements[this.currentCardIndex].id)
        this.handleSwipe()

        // パラメータが存在しなければカードを差し替える
        const { query } = this.$nuxt.context
        if (!query.id) {
          const topStyles = this.getTopTwoStyles()
          const excludedIds = this.elements.map(element => element.id)
          try {
            const responseElements = await this.$axios.get(`${this.$url}/custom/v0/elements`, {
              params: {
                per_page: 1,
                order: 'rand',
                styles: topStyles,  // ソート材料としてstylesパラメータに渡す
                excluded_ids: excludedIds.join(",")
              },
            })
            this.elements.splice(this.currentCardIndex + 2, 0, ...responseElements.data)  // 現在の1個後に追加する
            // this.elements.pop() // 不要になった最後のカードを取り除く
          } catch (error) {
            console.error(error)
          }
        }

        this.isLoading = false
      },

      // Norp Button
      async animateNorp() {
        if (this.isLoading) return
        this.isLoading = true

        if (this.isExpanded) {
          await this.toggleDetails() // 拡大されていれば元に戻す
        }

        const currentStyles = this.elements[this.currentCardIndex].style
        for (let style of currentStyles) {
          if (this.swipedLikeStyles[style.slug]) {
            this.swipedLikeStyles[style.slug]--
          } else {
            this.swipedLikeStyles[style.slug] = -1
          }
        }

        // 次のカードのアニメーションを開始
        if (this.currentCardIndex + 1 < this.elements.length) {
          const nextCardElement = this.$refs.likeCards.children[this.currentCardIndex + 1]
          
          gsap.set(nextCardElement, {
            scale: 0.95,
            boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorOther}`,
            x: 0,
            y: 0,
            rotation: 0,
          })
          gsap.to(nextCardElement, {
            duration: 0.5,
            scale: 1,
            boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorCurrent}`,
            x: 0,
            y: 0,
            rotation: 0,
          })
        }

        // アニメーションの開始位置を設定
        gsap.set(this.$refs.likeCards.children[this.currentCardIndex], {
          x: this.diffX,
          y: this.diffY,
          scale: 1,
          boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorCurrent}`,
          rotation: this.diffX / 10
        })
        // カードのアニメーション
        const viewportHeight = window.innerHeight // デバイスの高さを取得
        const cardWidth = viewportHeight * (9 / 16) // アスペクト比からカードの横幅を計算
        this.diffX = -cardWidth
        const rotation = this.diffX / 10 // カードの傾きによる横の変位を計算
        const halfCardWidth = cardWidth / 2
        const hypotenuse = halfCardWidth / Math.cos(Math.abs(rotation) * (Math.PI / 180))
        const xOffsetFromRotation = hypotenuse - halfCardWidth
        this.diffX -= xOffsetFromRotation + 100
        gsap.to(this.$refs.likeCards.children[this.currentCardIndex], {
          duration: 0.5,
          x: this.diffX,
          y: this.diffY,
          scale: 1,
          boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorOther}`,
          rotation: rotation,
          onComplete: () => {
            /*
              gsapは非同期処理のためthis.handleSwipe()の方が早く処理される
              その場合this.currentCardIndexが更新されてしまうのでバグる原因になる
              this.transforms[this.elements[this.currentCardIndex].id] =
                `translate(${this.diffX}px, ${this.diffY}px) rotate(${this.diffX / 10}deg)`
            */
          }
        })
          
        this.swipedNorpCount++
        this.swipedNorpCards.push(this.elements[this.currentCardIndex].id)
        this.handleSwipe()

        // パラメータが存在しなければカードを差し替える
        const { query } = this.$nuxt.context
        if (!query.id) {
          // swipedLikeStylesから上位2つのstyle.idを取得
          const topStyles = this.getTopTwoStyles()
          const excludedIds = this.elements.map(element => element.id)
          try {
            const responseElements = await this.$axios.get(`${this.$url}/custom/v0/elements`, {
              params: {
                per_page: 1,
                order: 'rand',
                styles: topStyles,  // ソート材料としてstylesパラメータに渡す
                excluded_ids: excludedIds.join(",")
              },
            })
            this.elements.push(...responseElements.data) // 配列の最後に追加する
          } catch (error) {
            console.error(error)
          }
        }

        this.isLoading = false
      },

      // Return Button
      async returnToPreviousSlide() {
        if (this.isLoading) return
        this.isLoading = true

        const { query } = this.$nuxt.context // 判定の際に使用するためパラメータ取得

        if (this.currentCardIndex > 0) { // 最初のスライドでない場合のみ動作

          // 現在のカレントをアニメーションさせる
          gsap.set(this.$refs.likeCards.children[this.currentCardIndex], {
            x: 0,
            y: 0,
            scale: 1,
            rotation: 0,
            boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorCurrent}`,
          })
          gsap.to(this.$refs.likeCards.children[this.currentCardIndex], {
            duration: 0.5,
            x: 0,
            y: 0,
            scale: 0.95,
            rotation: 0,
            boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorOther}`,
          })

          this.currentCardIndex-- // インデックスを1つ減少させる

          // カレントの位置に戻す
          gsap.to(this.$refs.likeCards.children[this.currentCardIndex], {
            duration: 0.5,
            x: 0,
            y: 0,
            scale: 1,
            rotation: 0,
            boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorCurrent}`,
          })

          // swipedLikeされたカードか判定
          const lastSwipedLikeCardId = this.swipedLikeCards[this.swipedLikeCards.length - 1]
          if (lastSwipedLikeCardId === this.elements[this.currentCardIndex].id) {
            
            // swipedLikeStylesをデクリメント
            const currentStyles = this.elements[this.currentCardIndex].style

            for (let style of currentStyles) {
              if (this.swipedLikeStyles[style.slug]) {
                this.swipedLikeStyles[style.slug]--
                if (this.swipedLikeStyles[style.slug] === 0) {
                  delete this.swipedLikeStyles[style.slug]
                }
              }
            }

            // swipedLikeCountをデクリメント
            this.swipedLikeCount--
            this.swipedLikeCards.pop()  // ここで配列から要素を削除

            // パラメータが存在しなければカードを差し替える
            if (!query.id) {
              this.elements.splice(this.currentCardIndex + 2, 1) // animateLikeで追加されたカードを取り除く
            }
          }

          // swipedNorpされたカードか判定
          const lastSwipedNorpCardId = this.swipedNorpCards[this.swipedNorpCards.length - 1]
          if (lastSwipedNorpCardId === this.elements[this.currentCardIndex].id) {

            // swipedNorpCountをデクリメント
            this.swipedNorpCount--
            this.swipedNorpCards.pop()  // ここで配列から要素を削除

            // パラメータが存在しなければカードを差し替える
            if (!query.id) {
              this.elements.pop() // animateNorpで追加されたカードを取り除く
            }
          }
        }

        this.isLoading = false
      },

      // Shuffle Button
      async shuffleCurrentCard() {
        if (this.isLoading) return
        this.isLoading = true

        let currentCard = this.$el.querySelector('.p-likeCard.is-active')
        let cardImage = currentCard.querySelector('.p-likeCard__image')
        let cardTitle = currentCard.querySelector('.p-likeCard__brand')
        let cardInfo = currentCard.querySelector('.p-likeCard__information')

        // 現在のカードがフェードアウトするのを待つ
        await gsap.to([cardImage, cardTitle, cardInfo], {
          opacity: 0,
          duration: 0.2
        })
        
        const excludedIds = this.elements.map(element => element.id)
        try {
          const responseElement = await this.$axios.get(`${this.$url}/custom/v0/elements`, {
            params: {
              per_page: 1,
              order: 'rand',
              excluded_ids: excludedIds
            },
          })
          
          // 現在のカードを更新する
          this.$set(this.elements, this.currentCardIndex, responseElement.data[0])

          // カード情報の更新が完了するのを待つ
          await this.$nextTick()

          currentCard = this.$el.querySelector('.p-likeCard.is-active')
          cardImage = currentCard.querySelector('.p-likeCard__image')
          cardTitle = currentCard.querySelector('.p-likeCard__brand')
          cardInfo = currentCard.querySelector('.p-likeCard__information')
          await gsap.fromTo([cardImage, cardTitle, cardInfo], {
            opacity: 0,
          }, {
            opacity: 1,
            duration: 0.2
          })

        } catch (error) {
          console.error(error)
        }

        this.isLoading = false
      },

      // Smart Phone
      handleTouchStart(e) {
        if (this.isExpanded) return
        this.isDragging = true
        this.startX = e.touches[0].clientX
        this.startY = e.touches[0].clientY
      },
      handleTouchMove(e) {
        if (this.isExpanded) return
        if (!this.isDragging) return

        let diffX = e.touches[0].clientX - this.startX
        let diffY = e.touches[0].clientY - this.startY

        this.$set(this.transforms, this.elements[this.currentCardIndex].id, `translate(${diffX}px, ${diffY}px) rotate(${diffX / 10}deg)`)

        // 次のカードのscaleを変更
        const nextCardIndex = this.currentCardIndex + 1
        if (nextCardIndex < this.elements.length) {
          const scaleValue = 0.95 + Math.abs(diffX) * 0.0005
          const boxShadowOpacity = Math.min(Math.abs(diffX) * 0.001, 0.1)  // スワイプ量に応じて0から0.1の間で変動
          const boxShadowValue = `${this.baseBoxShadow} rgba(86, 88, 83, ${boxShadowOpacity})`

          gsap.to(this.$refs.likeCards.children[nextCardIndex], {
            scale: Math.min(scaleValue, 1), // scaleValueが1を超えないようにする
            boxShadow: boxShadowValue
          })
        }

        // buttonの色を変更
        let scalePercentage = Math.abs(diffX) / 70
        if (diffX > 0) { // 右にスワイプしている場合
          let rValue = 231 * scalePercentage
          let gValue = 76 * scalePercentage
          let bValue = 60 * scalePercentage
          gsap.to(".p-likeButton__like path", {
            fill: `rgb(${Math.min(rValue, 231)},${Math.min(gValue, 76)},${Math.min(bValue, 60)})`,
            duration: 0.3
          });
          gsap.to(".p-likeButton__norp path", {
            fill: "#282A26",
            duration: 0.3
          });
        } else if (diffX < 0) { // 左にスワイプしている場合
          let rValue = 52 * scalePercentage
          let gValue = 152 * scalePercentage
          let bValue = 219 * scalePercentage
          gsap.to(".p-likeButton__norp path", {
            fill: `rgb(${Math.min(rValue, 52)},${Math.min(gValue, 152)},${Math.min(bValue, 219)})`,
            duration: 0.3
          })
          gsap.to(".p-likeButton__like path", {
            fill: "#282A26",
            duration: 0.3
          })
        }
      },
      handleTouchEnd(e) {
        if (this.isExpanded) return
        this.isDragging = false

        // touchendイベントにはtouchesプロパティがないので、changedTouchesを使用
        this.diffX = e.changedTouches[0].clientX - this.startX
        this.diffY = e.changedTouches[0].clientY - this.startY

        if (Math.abs(this.diffX) > 70) {
          let direction = this.diffX > 0 ? 'right' : 'left'
          if (direction === 'right') {
            this.animateLike()
          } else if (direction === 'left') {
            this.animateNorp()
          }
        } else {
          // アニメーションの状態を初期化
          gsap.set(this.$refs.likeCards.children[this.currentCardIndex], {
            x: this.diffX,
            y: this.diffY,
            rotation: this.diffX / 10
          })

          // 元の位置に戻る
          gsap.to(this.$refs.likeCards.children[this.currentCardIndex], {
            duration: 0.3,
            x: 0,
            y: 0,
            rotation: 0,
          })
        }

        // SVGの色を元に戻す
        gsap.to(".p-likeButton__like path", {
          fill: "#282A26",
          duration: 0.5
        })
        gsap.to(".p-likeButton__norp path", {
          fill: "#282A26",
          duration: 0.5
        })
      },

      // PC
      handleMouseDown(e) {
        if (this.isExpanded) return
        this.isDragging = true
        this.startX = e.clientX
        this.startY = e.clientY

        // windowにmousemoveとmouseupイベントを追加
        window.addEventListener('mousemove', this.handleMouseMove)
        window.addEventListener('mouseup', this.handleMouseUp)

        // console.log('ドラッグ開始')
      },
      handleMouseMove(e) {
        if (this.isExpanded) return
        if (!this.isDragging) return
        
        this.diffX = e.clientX - this.startX
        this.diffY = e.clientY - this.startY
        
        this.$set(this.transforms, this.elements[this.currentCardIndex].id, `translate(${this.diffX}px, ${this.diffY}px) rotate(${this.diffX / 10}deg)`)

        // 次のカードがある場合
        const nextCardIndex = this.currentCardIndex + 1
        if (nextCardIndex < this.elements.length) {
          const scaleValue = 0.95 + Math.abs(this.diffX) * 0.0005 // 次のカードのscaleを変更
          const boxShadowOpacity = Math.min(Math.abs(this.diffX) * 0.001, 0.1)  // スワイプ量に応じて0から0.1の間で変動
          const boxShadowValue = `${this.baseBoxShadow} rgba(86, 88, 83, ${boxShadowOpacity})`

          gsap.to(this.$refs.likeCards.children[nextCardIndex], {
            scale: Math.min(scaleValue, 1), // scaleValueが1を超えないようにする
            boxShadow: boxShadowValue
          })
        }

        // buttonの色を変更
        let scalePercentage = Math.abs(this.diffX) / 70
        if (this.diffX > 0) { // 右にスワイプしている場合
          let rValue = 231 * scalePercentage
          let gValue = 76 * scalePercentage
          let bValue = 60 * scalePercentage
          gsap.to(".p-likeButton__like path", {
            fill: `rgb(${Math.min(rValue, 231)},${Math.min(gValue, 76)},${Math.min(bValue, 60)})`,
            duration: 0.3
          });
          gsap.to(".p-likeButton__norp path", {
            fill: "#282A26",
            duration: 0.3
          });
        } else if (this.diffX < 0) { // 左にスワイプしている場合
          let rValue = 52 * scalePercentage
          let gValue = 152 * scalePercentage
          let bValue = 219 * scalePercentage
          gsap.to(".p-likeButton__norp path", {
            fill: `rgb(${Math.min(rValue, 52)},${Math.min(gValue, 152)},${Math.min(bValue, 219)})`,
            duration: 0.3
          })
          gsap.to(".p-likeButton__like path", {
            fill: "#282A26",
            duration: 0.3
          })
        }

        // console.log('ドラッグ中')
      },
      handleMouseUp(e) {
        if (this.isExpanded) return
        this.isDragging = false

        this.diffX = e.clientX - this.startX
        this.diffY = e.clientY - this.startY

        if (Math.abs(this.diffX) > 70) {
          let direction = this.diffX > 0 ? 'right' : 'left'
          if (direction === 'right') {
            this.animateLike()
          } else if (direction === 'left') {
            this.animateNorp()
          }
        } else {
          // アニメーションの状態を初期化
          gsap.set(this.$refs.likeCards.children[this.currentCardIndex], {
            x: this.diffX,
            y: this.diffY,
            rotation: this.diffX / 10,
            scale: 1,
            boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorCurrent}`,
          })
          // 元の位置に戻る
          gsap.to(this.$refs.likeCards.children[this.currentCardIndex], {
            duration: 0.3,
            x: 0,
            y: 0,
            rotation: 0,
            scale: 1,
            boxShadow: `${this.baseBoxShadow} ${this.boxShadowColorCurrent}`,
          })
        }

        // SVGの色を元に戻す
        gsap.to(".p-likeButton__like path", {
          fill: "#282A26",
          duration: 0.5
        })
        gsap.to(".p-likeButton__norp path", {
          fill: "#282A26",
          duration: 0.5
        })
        
        // イベントリスナーを削除
        window.removeEventListener('mousemove', this.handleMouseMove)
        window.removeEventListener('mouseup', this.handleMouseUp)

        // console.log('ドラッグ終了')
      },

      preventImageDrag(e) {
        e.preventDefault()
      },

      // 結果出力
      async fetchPostsByTopTags() {
        this.isFetching = true
        const topTags = this.getTopTwoStyles()
        let allPosts = []

        const addUniquePosts = (posts) => {
          for (let post of posts) {
            // すでにallPostsに同じIDの記事が存在しない場合のみ追加
            if (!allPosts.some(existingPost => existingPost.id === post.id)) {
              allPosts.push(post)
            }
          }
        }

        // まず2つのタグを同時に使用して記事を探す
        let responsePosts = await this.fetchPostsByTags(topTags)
        if (responsePosts && responsePosts.length > 0) {
          addUniquePosts(responsePosts)
        }

        // 1つ目のタグだけで記事を探す
        responsePosts = await this.fetchPostsByTags([topTags[0]])
        if (responsePosts && responsePosts.length > 0) {
          addUniquePosts(responsePosts)
        }

        // もし2つ目のタグが存在すれば、2つ目のタグだけで記事を探す
        if (topTags.length > 1) {
          responsePosts = await this.fetchPostsByTags([topTags[1]])
          if (responsePosts && responsePosts.length > 0) {
            addUniquePosts(responsePosts)
          }
        }

        this.posts = allPosts
        this.isFetching = false
        console.log(topTags)
      },

      async fetchPostsByTags(tags) {
        try {
          const response = await this.$axios.get(`${this.$url}/custom/v0/posts`, {
            params: {
              per_page: 1,
              order: 'rand',
              tags_slug: tags,
            },
          })
          return response.data
        } catch (error) {
          console.error(error)
          return null
        }
      },

      preventTouchMove(e) {
        if (!this.isExpanded) {
          e.preventDefault()
        }
      },

      preventDoubleTapZoom() {
        let lastTouchEnd = 0
        document.addEventListener('touchend', (event) => {
          const now = new Date().getTime()
          if (now - lastTouchEnd <= 300) {
            event.preventDefault()
          }
          lastTouchEnd = now
        }, false)
      },
    },
  }
</script>

<style lang="scss" scoped>

  .p-like {
  
    &__inner {
      display: grid;
      place-items: center;
    }

    &__wrapper {
      background-color: color(bg);
      overflow: hidden;
      width: 100%;
      height: 100svh;
      
      @include responsive(xs, min) {
        aspect-ratio: 9 / 16;
        width: vh(320, 568);
      }
    }

    &__result {

      @include responsive(xs, max) {
        width: 100vw;
      }
      
      @include responsive(xs, min) {
        height: 100svh;
        aspect-ratio: 9 / 16;
      }
    }

    // .p-like__progressbar
    &__progressbar {
      display: grid;
      place-items: center;
      padding-top: vh(10, 568);

      // .p-like__progressbar ul
      ul {
        width: per(300, 320);
        display: grid;
        grid-template-columns: repeat(10, 1fr);
        gap: 2px;

        @include responsive(xs, min) {
          gap: vh(2, 568);
          width: vh(300, 568);
        }

        // .p-like__progressbar ul li
        li {
          width: 100%;
          height: vh(2, 568);
          border-radius: vh(2, 568);
          background-color: color(white);
          transition:  background-color 0.3s ease;

          &.is-active {
            background-color: color(text);
          }
        }
      }
    }

    // .p-like__header
    &__header {
      margin-top: vh(34, 568);
    }

    // .p-like__main
    &__main {
      margin-top: vh(8, 568);
    }

    &__article {
      width: per(300, 320);
      margin-right: auto;
      margin-left: auto;
      
      @include responsive(xs, min) {
        aspect-ratio: 300 / 344;
      }
    }

    // .p-like__card
    &__card {
      display: grid;
      place-items: center;
      grid-template-columns: 100%;

      @include responsive(xs, min) {
        width: vh(300, 568);
      }
    }

    &__button {
      // margin-top: vh(16, 568);
      // padding-bottom: vh(25, 568);
      position: absolute;
      z-index: 1;
      bottom: vh(28, 568);
      left: 50%;
      transform: translateX(-50%);
      z-index: 1001;
      pointer-events: none;
    }
  }

  .p-likeHeader {
    text-align: center;
    
    // .p-likeHeader__title
    &__title {

      h1 {
        text-align: center;
        @include vhfont(568, 8, 12, 80);
      }
    }

    // .p-likeHeader__subtitle
    &__subtitle {
      margin-top: vh(9, 568);

      span {
        @include Wandeln;
        @include vhfont(568, 50, 50, -40);
      }
    }
  }

  .p-likeCard {
    user-select: none;
    grid-column: 1/2;
    grid-row: 1/2;
    border-radius: rem(10);
    padding-top: vh(50, 568);
    padding-left: per(20, 300);
    padding-right: per(20, 300);
    padding-bottom: vh(24, 568);
    background-color: color(white);
    width: 100%;
    box-shadow: 2px 2px 30px rgba(86, 88, 83, 0);
    
    @include responsive(xs, min) {
      aspect-ratio: 300 / 344;
      border-radius: vh(10, 568);
      padding-left: vh(20, 568);
      padding-right: vh(20, 568);
      width: vh(300, 568);
      box-shadow: vh(2, 568) vh(2, 568) vh(30, 568) rgba(86, 88, 83, 0);
    }
    
    &__image {
      display: grid;
      place-items: center;
      position: relative;
      z-index: 1;

      img {
        width: vh(198, 568);
        height: vh(198, 568);
        object-fit: contain;
      }
    }

    // .p-likeCard__heading
    &__heading {
      margin-top: vh(34, 568);
      display: flex;
      align-items: flex-end;
      padding-right: vh(42);
      height: vh(40, 568);
      width: 100%;
      position: relative;
    }

    // .p-likeCard__brand
    &__brand {
      
      // .p-likeCard__brand p
      p {
        @include Alokary;
        @include vhfont(568, 19, 38, 140);
        // overflow: hidden;
        // text-overflow: ellipsis;
        // white-space: nowrap;
      }
    }

    // .p-likeCard__information
    &__information {
      display: grid;
      place-items: center;
      padding: vh(12, 568);
      cursor: pointer;
      position: absolute;
      right: per(-12, 300);
      bottom: vh(-8, 568);

      @include responsive(xs, min) {
        right: vh(-12, 568);
      }
    }

    &__title {

      p {
        @include vhfont(568, 13, 20, 40, 700);
      }
    }

    // .p-likeCard__price
    &__price {
      display: flex;
      margin-top: vh(24, 568);
      padding-bottom: vh(11, 568);
      border-bottom: 1px solid color(smoke);

      dt {
        @include vhfont(568, 11, 17, 40, 700);
        width: per(30, 100);
      }

      dd {
        @include vhfont(568, 11, 17, 40);
        width: per(70, 100);
      }
    }

    &__size {
      margin-top: vh(11, 568);
      padding-bottom: vh(11, 568);
      border-bottom: vh(1, 568) solid color(smoke);
      display: flex;

      dt {
        @include vhfont(568, 11, 17, 40, 700);
        width: per(30, 100);
      }

      dd {
        @include vhfont(568, 11, 17, 40);
        width: per(70, 100);
      }
    }

    &__style {
      display: flex;
      align-items: center;
      column-gap: 6px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      margin-top: vh(16, 568);

      @include responsive(xs, min) {
        column-gap: vh(6, 568);
      }

      li {
        display: flex;
        align-items: center;
        justify-content: center;
        height: vh(18, 568);
        padding-right: 6px;
        padding-left: 6px;
        border-radius: rem(3);
        background-color: color(bg);

        @include responsive(xs, min) {
          padding-right: vh(6, 568);
          padding-left: vh(6, 568);
          border-radius: vh(3, 568);
        }

        span {
          @include vhfont(568, 10, 15, 100, 700);
        }
      }
    }

    &__details {
      margin-top: vh(8, 568);
    }

    &__coordination {
      margin-top: vh(24, 568);
      margin-bottom: vh(100, 568);
    }
  }

  .p-likeCardCoordination {

    // .p-likeCardCoordination__card
    &__card {
      overflow: scroll;
      white-space: nowrap;
      margin-top: vh(10, 568);

      @include responsive(xs, min) {
      }
    }

    &__title {
      
      p {
        @include vhfont(568, 11, 17, 40, 700);
      }
    }
  }

  .p-likeCardInformation {
    display: grid;
    place-items: center;
    border-width: vh(1, 568);
    width: vh(18, 568);
    height: vh(18, 568);
    border: 1px solid color(text);
    border-radius: 50%;

    span {
      @include vhfont(568, 10, 15, 0);
    }
  }

  .p-likeCardCoordinationCard {
    display: inline-block;
    width: vh(70, 568);
    height: vh(70, 568);
    border-radius: vh(10, 568);
    border: 1px solid color(smoke);
    
    &:not(:last-child) {
      margin-right: vh(10, 568);
    }

    &__image {
      display: grid;
      place-items: center;
      width: 100%;
      height: 100%;

      img {
        width: vh(40, 568);
        height: vh(40, 568);
        object-fit: contain;
      }
    }
  }

  .p-likeButton {
    display: flex;
    justify-content: center;
    align-items: center;
    column-gap: vh(11, 568);

    @include responsive(xs, min) {
    }

    li {
      background-color: color(white);
      border-radius: 50%;
      box-shadow: 2px 2px 20px rgba(86, 88, 83, 0.1);

      @include responsive(xs, min) {
        box-shadow: vh(2, 568) vh(2, 568) vh(20, 568) rgba(86, 88, 83, 0.1);
      }

      &:nth-of-type(even) {
        // width: 50px;
        // height: 50px;
        width: vh(50, 568);
        height: vh(50, 568);

        @include responsive(xs, min) {
        }
      }

      &:nth-of-type(odd) {
        // width: 40px;
        // height: 40px;
        width: vh(40, 568);
        height: vh(40, 568);
        
        @include responsive(xs, min) {
        }
      }

    }
    
    a,
    button {
      width: 100%;
      height: 100%;
      cursor: pointer;
      display: grid;
      place-items: center;
      pointer-events: auto;

      svg {
        width: vh(22, 568);
        height: vh(22, 568);
      }
    }
  }

  .p-likeResult {
    visibility: visible;

    // .p-likeResult__data
    &__data {
    }

    &__card {
      height: 100svh;
      width: 100%;

      @include responsive(xs, min) {
        aspect-ratio: 9 / 16;
      }
    }
  }

  .p-likeResultCard {
    position: relative;
    display: flex;

    &:before {
      content: '';
      display: block;
      width: 100%;
      height: vh(340, 568);
      position: absolute;
      left: 0;
      bottom: 0;
      z-index: 2;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0));
    }

    &__image {
      width: 100%;
      height: 100%;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1;

      img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
    }

    &__tag {
      position: absolute;
      z-index: 10;
    }

    &__profile {
      position: relative;
      z-index: 10;
      color: color(white);
      width: 100%;
      margin-top: auto;
      margin-bottom: vh(100, 568);
      padding-left: per(20, 320);
      padding-right: per(20, 320);

      @include responsive(xs, min) {
        padding-left: vh(20, 568);
        padding-right: vh(20, 568);
      }
    }
    
    &__name {
      @include Alokary;
      @include font(26, 50, 100);

      @include responsive(xs, min) {
        @include vhfont(568, 26);
      }

      p {
        display: block;
      }

      :deep(.is-different) {
        @include Wandeln;
        @include font(44, 0, -30);
        margin-left: -2px;

        @include responsive(xs, min) {
          @include vhfont(568, 44);
          margin-left: vh(-2);
        }
      }
      
      .is-apostrophe {
        font-family: "游ゴシック体", YuGothic, "游ゴシック Medium", "Yu Gothic Medium", "游ゴシック", "Yu Gothic", "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", "Hiragino Sans", Meiryo, sans-serif;
        margin-left: -7px;
        margin-right: -7px;
        @include font(30, 0, 0);
        position: relative;
        top: rem(-4);

        @include responsive(xs, min) {
          margin-left: vh(-7, 568);
          margin-right: vh(-7, 568);
          @include vhfont(568, 30);
          top: vh(-4, 568);
        }
      }

      svg {
        width: 12px;
        height: 12px;
        position: relative;
        top: rem(-17);
        margin-left: 4px;
        opacity: 0.7;
        stroke-miterlimit: 10;
        fill: none;
        stroke: color(white);

        @include responsive(xs, min) {
          width: vh(12, 568);
          height: vh(12, 568);
          top: vh(-17, 568);
          margin-left: vh(4, 568);
        }
      }
    }

    &__link {
      margin-top: rem(14);

      @include responsive(xs, min) {
        margin-top: vh(14, 568);
      }

      a {
        @include font(12, 18, 40, 700);

        @include responsive(xs, min) {
          @include vhfont(568, 12);
        }
      }
    }

    &__button {
      position: absolute;
      z-index: 10;
      bottom: 46px;
      right: 32px;

      @include responsive(xs, min) {
        bottom: vh(46, 568);
        right: vh(32, 568);
      }

      a {
        display: grid;
        place-items: center;
        width: 60px;
        height: 60px;
        background-color: rgba(255, 255, 255, 0.4);
        border-radius: 50%;

        @include responsive(xs, min) {
          width: vh(60, 568);
          height: vh(60, 568);
        }
      }

      span {
        display: block;
        position: absolute;
        border-top-left-radius: 30%;
        transform: rotate(0deg) skewY(30deg) scaleX(.86666) translate(-50%, -50%);
        width: 6px;
        height: 6px;
        background: color(white);
        top: 50%;
        left: calc(50% - 1.5px);

        @include responsive(xs, min) {
          width: vh(6, 568);
          height: vh(6, 568);
        }

        &:before,
        &:after {
          content: '';
          position: absolute;
          width: 6px;
          height: 6px;
          background: color(white);

          @include responsive(xs, min) {
            width: vh(6, 568);
            height: vh(6, 568);
          }
        }
        
        &:before {
          border-top-right-radius: 30%;
          transform: skewX(-45deg) translateX(50%);
        }
    
        &:after {
          border-bottom-left-radius: 30%;
          transform: skewY(-45deg) translateY(50%);
        }
      }
    }
  }
</style>