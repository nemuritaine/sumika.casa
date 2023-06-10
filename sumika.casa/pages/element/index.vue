<template>
  <div class="p-archive__inner">
    <div class="p-archive__wrapper">
      <aside class="p-archive__aside" ref="archiveAside">
        <div class="p-archiveAside" ref="archiveSidebar" :style="sidebarStyle">
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
                  <p>スタイル</p>
                </div>
                <div class="p-archiveAsideMenu__icon">
                  <span></span>
                  <span></span>
                </div>
              </div>
              <div class="p-archiveAsideMenu__body">
                <ul class="p-archiveAsideMenu__item --button">
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
                <ul class="p-archiveAsideMenu__item --button">
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
                <ul class="p-archiveAsideMenu__item --checkbox">
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
                <ul class="p-archiveAsideMenu__item --checkbox">
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
      <article class="p-archive__article" ref="archiveArticle" @scroll.passive="handleScroll">
        <div class="p-archive__order">
          <div class="p-archiveOrder__like">
            <div class="p-archiveOrderLike">
              <input type="checkbox" id="like-item" v-model="onlyLikedItems">
              <label for="like-item">いいねのみ表示</label>
            </div>
          </div>
          <div class="c-sort">
            <div class="c-sort__title">
              <div class="c-sortTitle">並び替え</div>
            </div>
            <div class="c-sort__type">
              <div class="c-sortType">
                <div class="c-sortType__selector">
                  <div class="c-sortTypeSelector">
                    <select name="style" v-model="selectedSortOrder">
                      <option value="date_desc">新しい順</option>
                      <option value="likes_desc">いいね順</option>
                      <option value="price_desc">価格が高い順</option>
                      <option value="price_asc">価格が低い順</option>
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
        <div class="p-elementIndex__item">
          <li v-for="element in elements" :key="element.id" class="p-elementIndexItem">
            <nuxt-link :to="`/element/${element.id}`" class="p-elementIndexItem__link">
              <span class="p-elementIndexItem__detail">
                <span class="p-elementIndexItem__title">{{ element.brand }}</span>
                <span class="p-elementIndexItem__price">{{ element.price }}</span>
              </span>
              <span class="p-elementIndexItem__image">
                <img :src="element.image_src" alt="" width="" height="">
              </span>
            </nuxt-link>
            <span class="p-elementIndexItem__like">
              <button
                :class="element.isLiked ? 'p-elementIndexItemLike is-liked' : 'p-elementIndexItemLike'"
                @click="likePost(element.id)"
              >
                <span class="p-elementIndexItemLike__icon">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                    <path d="m45.03,7.81c-2.62-2.62-6.1-4.09-9.78-4.09s-7.16,1.43-9.78,4.05l-.45.45-.45-.45c-2.62-2.62-6.1-4.05-9.78-4.05s-7.12,1.43-9.74,4.05c-2.62,2.62-4.05,6.1-4.05,9.78s1.43,7.16,4.05,9.78l18.25,18.25c.45.45,1.06.7,1.72.7s1.27-.25,1.72-.7l18.21-18.21c2.62-2.62,4.05-6.1,4.05-9.78s-1.43-7.16-4.05-9.78h.08Z"/>
                    <path d="m45.03,7.81c-2.62-2.62-6.1-4.09-9.78-4.09s-7.16,1.43-9.78,4.05l-.45.45-.45-.45c-2.62-2.62-6.1-4.05-9.78-4.05s-7.12,1.43-9.74,4.05c-2.62,2.62-4.05,6.1-4.05,9.78s1.43,7.16,4.05,9.78l18.25,18.25c.45.45,1.06.7,1.72.7s1.27-.25,1.72-.7l18.21-18.21c2.62-2.62,4.05-6.1,4.05-9.78s-1.43-7.16-4.05-9.78h.08Zm-18.29,5.69l2.25-2.25c1.68-1.68,3.93-2.62,6.3-2.62s4.62.94,6.3,2.62c1.68,1.68,2.62,3.93,2.62,6.3s-.94,4.62-2.62,6.3l-16.49,16.49L8.53,23.81c-1.68-1.68-2.62-3.93-2.62-6.3s.94-4.62,2.58-6.3c1.68-1.68,3.93-2.62,6.3-2.62s4.62.94,6.3,2.62l2.21,2.21c.94.9,2.46.94,3.44.04v.04Z"/>
                  </svg>
                </span>
                <!-- <span class="p-elementIndexItemLike__text">{{ element.likes_count }}</span> -->
                <span class="p-elementIndexItemLike__text">{{ element.likes_count }}</span>
              </button>
            </span>
          </li>
        </div>
      </article>
      <div class="p-archive__sort" ref="archiveSort">
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
        currentPage: 2,
        perPage: 10,
        initialSortFetch: true, // 初回取得フラグを追加
        isLoading: false,
        isLastPage: false,
        // start aside stiky
        sidebarStyle: {},
        lastScrollTop: 0,
        scrollDirection: null,
        fixedScrollTop: null,
        fixedScrollBottom: null,
        // end aside stiky
        isFetching: false,
        isProcessingLike: false, // like処理中フラグ
        selectedSortOrder: 'date_desc', // 並び替え
        onlyLikedItems: false, // いいねのみ表示
      }
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

    computed: {

      bodyClass () {
        return 'p-elementIndex p-archive'
      }
    },

    created () {
      if (process.client) {
        this.likedInit()
      }
    },

    mounted () {
      this.boundAsideSticky = this.asideSticky.bind(this)
      this.updateSelectionsFromURL()
      this.initAsideAccordions()
      if (!process.client) {
        this.likedInit()
      }
      this.sortOpacityResize()

      this.onResize = () => {
        this.sortOpacityResize()
        this.boundAsideSticky()
      }

      this.onScroll = () => {
        this.sortOpacityScroll()
        this.handleScroll()
        if (window.innerWidth >= 1025) {
          this.boundAsideSticky()
        }
      }

      window.addEventListener('resize', this.onResize)
      window.addEventListener('scroll', this.onScroll)
      
      if (window.innerWidth <= 1024) {
        gsap.set('.p-archive__aside', { autoAlpha: 0 })
      }
    },

    beforeDestroy () {
      window.removeEventListener('resize', this.onResize)
      window.removeEventListener('scroll', this.onScroll)
    },

    watch: {
      onlyLikedItems: {
        handler: 'handleSelectionChange',
        deep: true,
      },
      selectedSortOrder: {
        handler: 'handleSelectionChange',
        deep: true,
      },
      selectedClasses: {
        handler: 'handleSelectionChange',
        deep: true,
      },
      selectedBrands: {
        handler: 'handleSelectionChange',
        deep: true,
      },
      selectedPrices: {
        handler: 'handleSelectionChange',
        deep: true,
      },
      selectedStyles: {
        handler: 'handleSelectionChange',
        deep: true,
      },
    },

    methods: {

      handleSelectionChange () {
        this.resetPagination()
        this.fetchElements(this.currentPage)
      },

      resetPagination () {
        this.currentPage = 1
        this.isLastPage = false
        this.initialSortFetch = true // ページネーションがリセットされるたびに初回取得フラグをtrueにする
      },

      async likePost (postId) {

        // 処理中なら何もしない
        if (this.isProcessingLike) return
        this.isProcessingLike = true // フラグを立てる

        const storageKey = 'liked_posts'
        let likedPosts
        
        // Cookieが利用可能か確認
        const canUseCookies = navigator.cookieEnabled

        let hasLiked
        if (process.client) {
          hasLiked = this.hasUserLiked(postId)
        } else {
          hasLiked = false
        }

        const isUnlike = hasLiked ? true : false

        // ポストを探す
        let post = this.elements.find(item => item.id === postId)
        if (!post) return

        // オプティミスティックUI更新：サーバーレスポンスを待たずにUIを更新
        post.isLiked = !isUnlike
        post.likes_count = post.isLiked ? post.likes_count + 1 : post.likes_count - 1

        try {

          const response = await this.$axios.$post(`${this.$nuxt.$url}/likes/change/${postId}`, {
            unlike: isUnlike ? '1' : '0',
          })

          // サーバーからのレスポンスを元に、最終的な値を更新
          if (response.data && response.data.likes_count !== undefined) {
            post.likes_count = response.data.likes_count
          }

          if (canUseCookies) {
            
            // Cookieが利用可能な場合、like情報をCookieに保存
            likedPosts = this.$cookies.get(storageKey) || []

            if (isUnlike) {

              // Unlikeの場合、Cookieから情報を削除
              likedPosts = likedPosts.filter(id => id !== postId)

            } else {

              // Likeの場合、情報をCookieに保存
              likedPosts.push(postId)
            }

            this.$cookies.set(storageKey, likedPosts)

          } else {

            // Cookieが利用不可能な場合、like情報をローカルストレージに保存
            likedPosts = JSON.parse(window.localStorage.getItem(storageKey)) || []
            
            if (isUnlike) {

              // Unlikeの場合、ローカルストレージから情報を削除
              likedPosts = likedPosts.filter(id => id !== postId)

            } else {

              // Likeの場合、情報をローカルストレージに保存
              likedPosts.push(postId)
            }

            window.localStorage.setItem(storageKey, JSON.stringify(likedPosts))
          }

        } catch (error) {
          // エラー発生時はUIを元に戻す
          post.isLiked = isUnlike
          post.likes_count = post.isLiked ? post.likes_count + 1 : post.likes_count - 1
          console.error('Error liking post:', error)
        } finally {
          this.isProcessingLike = false // フラグを下す
        }
      },

      async fetchLikesCount () {

        try {
          const response = await this.$axios.$get(`${this.$nuxt.$url}/likes/fetch_all`)
          const likesCount = response.data

          this.elements.forEach(item => {
            item.likes_count = likesCount[item.id] ? likesCount[item.id] : 0
          })
        } catch (error) {
          console.error('Error fetching all likes count:', error)
        }
      },

      hasUserLiked (postId) {

        const storageKey = 'liked_posts'
        const canUseCookies = navigator.cookieEnabled

        let likedPosts

        if (canUseCookies) {
          likedPosts = this.$cookies.get(storageKey) || []
        } else {
          likedPosts = JSON.parse(window.localStorage.getItem(storageKey)) || []
        }

        return likedPosts.includes(postId)
      },

      likedInit () {

        this.fetchLikesCount()
        this.elements.forEach(item => {
          item.isLiked = this.hasUserLiked(item.id)
        })
      },

      async fetchElements (page) {
        this.isFetching = true
        this.isLoading = true

        if (this.isLastPage) {
          return
        }

        // いいねした投稿のIDを取得
        const storageKey = 'liked_posts'
        const canUseCookies = navigator.cookieEnabled
        let likedPosts
        if (canUseCookies) {
          likedPosts = this.$cookies.get(storageKey) || []
        } else {
          likedPosts = JSON.parse(window.localStorage.getItem(storageKey)) || []
        }

        try {
          const response = await this.$axios.get(`${this.$nuxt.$url}/custom/v0/elements`, {
            params: {
              per_page: this.initialSortFetch ? 20 : this.perPage, // 初回取得フラグがtrueなら20件、そうでなければ10件取得
              page: page,
              sort: this.selectedSortOrder,
              classes: this.selectedClasses,
              brands: this.selectedBrands,
              prices: this.selectedPrices,
              styles: this.selectedStyles,
              liked_ids: this.onlyLikedItems ? likedPosts : undefined, // onlyLikedItemsがtrueの場合、いいねした投稿のIDをパラメータに含める
            },
          })

          let fetchedElements = response.data

          // fetchElementsしたアイテムのlike済みを定義する
          fetchedElements.forEach(item => {
            item.isLiked = this.hasUserLiked(item.id)
          })

          if (page === 1) {
            this.elements = fetchedElements
          } else {
            this.elements = this.elements.concat(fetchedElements)
          }

          if (response.data.length < this.perPage) {
            this.isLastPage = true
          } else {
            this.isLastPage = false
          }

          if (this.initialSortFetch) { // 初回取得フラグがtrueならfalseにする
            this.initialSortFetch = false
            this.currentPage = 2
          }

        } catch (error) {
          console.error(error)

        } finally {
          this.isLoading = false
        }

        this.isFetching = false
      },

      async handleScroll () {

        if (this.isFetching) {  // isFetchingがtrueならfetch中と判断し処理を抜ける
          return
        }

        const scrollTop = window.pageYOffset || document.documentElement.scrollTop
        const windowHeight = window.innerHeight
        const articleElement = this.$refs.archiveArticle
        const articleHeight = articleElement.scrollHeight

        if (scrollTop + windowHeight >= articleHeight - 300) {
          this.currentPage += 1
          if (this.initialSortFetch) { // 初回取得フラグがtrueならfalseにする
            this.initialSortFetch = false
          }
          await this.fetchElements(this.currentPage)
        }
      },

      sortOpacityResize () {

        if (window.innerWidth <= 769 || window.innerWidth >= 1024) {
          this.$refs.archiveSort.style.opacity = ''
          this.$refs.archiveSort.style.visibility = ''
        }
      },

      sortOpacityScroll () {

        if (window.innerWidth >= 769 && window.innerWidth <= 1024) {
          const scrollPosition = window.scrollY || window.pageYOffset || document.documentElement.scrollTop
          const articleBottom = this.$refs.archiveArticle.getBoundingClientRect().bottom + window.pageYOffset
          const threshold = articleBottom - window.innerHeight

          if (scrollPosition >= threshold) {
            gsap.to(this.$refs.archiveSort, { autoAlpha: 0 })
          } else {
            gsap.to(this.$refs.archiveSort, { autoAlpha: 1 })
          }
        }
      },

      selectAll (type, checked) {
        
        if (type === 'class') {
          if (checked) {
            this.selectedClasses = this.classes.map(classes => classes.cat_slug)
          } else {
            this.selectedClasses = []
          }
        } else if (type === 'brand') {
          if (checked) {
            this.selectedBrands = this.brands.map(brand => brand.cat_slug)
          } else {
            this.selectedBrands = []
          }
        } else if (type === 'price') {
          if (checked) {
            this.selectedPrices = this.prices.map(price => price.cat_slug)
          } else {
            this.selectedPrices = []
          }
        } else if (type === 'style') {
          if (checked) {
            this.selectedStyles = this.styles.map(style => style.cat_slug)
          } else {
            this.selectedStyles = []
          }
        }
      },

      clearAll () {
        this.selectedStyles = []
        this.selectedClasses = []
        this.selectedBrands = []
        this.selectedPrices = []
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
        const wrapper = document.querySelector('.p-archive__aside')
        const sidebar = document.querySelector('.p-archiveAside')
        let sidebarHeight = null
        let article = document.querySelector('.p-archive__article')
        let articleBottom = article.getBoundingClientRect().bottom  // ビューポートに対してアーティクルの相対位置
        let self = this

        async function processAccordion () {

          const firstProcess = new Promise((resolve) => {

            if (gsap.getProperty(contentElement, 'autoAlpha') == 0) {
              tl.to(contentElement, { height: 'auto', autoAlpha: 1, duration: 0.3, onComplete: resolve })
                .to(iconElement[1], { rotate: 0, duration: 0.3 }, '<')
            } else {
              tl.to(contentElement, { height: 0, autoAlpha: 0, duration: 0.3, onComplete: resolve })
                .to(iconElement[1], { rotate: -90, duration: 0.3 }, '<')
            }
          })

          firstProcess.then(() => {

            sidebarHeight = sidebar.clientHeight

            if (window.innerWidth >= 1025) {
              wrapper.style.height = `${sidebarHeight}px`
            }

            if (
              window.innerWidth >= 1025 &&
              window.innerHeight >= articleBottom &&
              sidebar.clientHeight >= window.innerHeight
            ) {
              // console.log('アーティクルの最下部よりもスクロールしています')

              self.sidebarStyle = {
                position: 'fixed',
                bottom: `${window.innerHeight - articleBottom}px`,
              }
            }
          })
        }

        processAccordion()
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
        const wrapper = this.$refs.archiveAside
        const sidebar = this.$refs.archiveSidebar

        if (!wrapper || !sidebar) {
          return
        }

        let wrapperWidth = wrapper.clientWidth

        if (window.innerWidth >= 1025) {
          let scrollTop = window.pageYOffset || document.documentElement.scrollTop // スクロール量
          let sidebarHeight = sidebar.clientHeight
          let sidebarTop = sidebar.getBoundingClientRect().top  // スクロール量に対してサイドバーの相対位置
          let sidebarBottom = sidebar.getBoundingClientRect().bottom // スクロール量に対してサイドバーの相対位置
          let article = this.$refs.archiveArticle
          let articleTop = article.getBoundingClientRect().top  // ビューポートに対してアーティクルの相対位置
          let articleBottom = article.getBoundingClientRect().bottom  // ビューポートに対してアーティクルの相対位置
          let absoluteArticleTop = scrollTop + articleTop // ページ全体に対してアーティクルの絶対位置

          wrapper.style.height = `${sidebarHeight}px`
          sidebar.style.width = `${wrapperWidth}px`
          gsap.to(wrapper, { autoAlpha: 1 })
          
          if (scrollTop > this.lastScrollTop) {
            // console.log('下にスクロールしています')

            if (sidebarHeight <= window.innerHeight) {

              if (articleTop >= this.vwEquivalent(40)) {
                // console.log('下スクロール：アーティクルの最上部よりもスクロールしています')

                this.sidebarStyle = {
                  position: 'fixed',
                  top: `${articleTop}px`,
                  bottom: 'auto',
                }
              } else {
                this.sidebarStyle = {
                  position: 'fixed',
                  top: `${this.vwEquivalent(40)}px`,
                }
              }
              return
            }

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
          gsap.to(wrapper, { autoAlpha: 0 })
          sidebar.style.width = '100%'
          this.sidebarStyle = null
          wrapper.style.height = null
        }
      },
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
      margin-top: rem(22);

      @include responsive(sm, min) {
        column-gap: per(20, 832);
        row-gap: rem(20);
        margin-top: rem(24);
      }

      @include responsive(md, min) {
        margin-top: vw(24);
      }
    }
  }

  .p-elementIndexItem {
    width: per(160, 335);
    position: relative;
    
    @include responsive(sm, min) {
      width: per(193, 832);
    }
    
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
      user-select: none;
      
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

    // .p-elementIndexItem__like
    &__like {
      position: absolute;
      bottom: 0;
      left: 0;
      z-index: 10;
    }

    // .p-elementIndexItem__image
    &__image {
      display: flex;
      align-items: center;
      justify-content: center;
      width: per(125, 200);
      margin-right: auto;
      margin-left: auto;
      position: relative;
      z-index: 2;
      
      // .p-elementIndexItem__image img
      img {
        user-select: none;
        object-fit: contain;
        width: 100%;
        aspect-ratio: 200 / 200;
      }
    }

    // .p-elementIndexItem__title
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
    $this: &;
    display: flex;
    align-items: center;
    padding: rem(15) 15px;

    @include responsive(md, min) {
      padding: vw(15);
    }

    @include hover {

      #{$this}__icon {
        color: color(darkgray);
      }

      #{$this}__text {
        color: color(darkgray);
      }
    }

    &.is-liked {

      #{$this}__icon {
        color: color(main);

        svg {
          
          path {
    
            &:nth-of-type(1) {
              display: none;
            }
          }
        }
      }

      #{$this}__text {
        color: color(main);
      }
    }

    // .p-elementIndexItemLike__icon
    &__icon {
      display: flex;
      color: color(beige);
      transition: color 0.3s ease;
          
      svg {
        width: 11px;
        height: 11px;

        @include responsive(md, min) {
          width: vw(11);
          height: vw(11);
        }

        path {

          &:nth-of-type(1) {
            display: block;
          }
        }
      }
    }

    // .p-elementIndexItemLike__text
    &__text {
      @include Optima;
      @include font(10, 12, -100);
      color: color(beige);
      margin-left: 3px;
      transition: color 0.3s ease;
      
      @include responsive(md, min) {
        @include vwfont(1280, 10);
        margin-left: vw(3);
      }
    }
  }

</style>