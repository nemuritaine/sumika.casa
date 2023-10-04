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
                <div class="p-archiveAsideMenu__price">
                  <div class="p-archiveAsideMenuPrice">
                    <div class="p-archiveAsideMenuPrice__slider">
                      <VueSlider
                        v-model="sliderValue"
                        @change="updatePrice"
                        :min="0"
                        :max="1"
                        :dotSize="dynamicDotSize"
                        :interval="0.01"
                        tooltip="none"
                      />
                    </div>
                    <div class="p-archiveAsideMenu__reset">
                      <p @click="selectAll('price')">選択をクリア</p>
                    </div>
                    <div class="p-archiveAsideMenuPrice__range">
                      <input
                        name="priceMin"
                        type="text"
                        placeholder="下限なし"
                        inputmode="numeric"
                        class=""
                        :value="formatCurrency(priceMin)"
                        @focus="clearFormatting"
                        @input="enforceNumericInput"
                        @blur="updateInputPrice(0, $event)"
                        @keydown.enter="$event.target.blur()"
                      >
                      <span>-</span>
                      <input
                        name="priceMax"
                        type="text"
                        placeholder="上限なし"
                        inputmode="numeric"
                        class=""
                        :value="formatCurrency(priceMax)"
                        @focus="clearFormatting"
                        @input="enforceNumericInput"
                        @blur="updateInputPrice(1, $event)"
                        @keydown.enter="$event.target.blur()"
                      >
                    </div>
                  </div>
                </div>
                
                <!-- <ul class="p-archiveAsideMenu__item --checkbox">
                  <li v-for="price in details.price" :key="price.id" class="p-archiveAsideMenuItem">
                    <input type="checkbox" :id="'price-' + price.id" :value="price.cat_slug" v-model="selectedPrices">
                    <label :for="'price-' + price.id">{{ price.cat_name }}</label>
                  </li>
                </ul> -->
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
                <div class="p-archiveAsideMenu__reset">
                  <p @click="selectAll('class')">選択をクリア</p>
                </div>
                <div class="p-archiveAsideMenu__category">
                  <div v-for="classes in details.organizedClasses" :key="classes.id" class="p-archiveAsideMenuCategory">
                    <div class="p-archiveAsideMenuCategory__parent" @click="asideAccordion">
                      <input
                        type="checkbox" 
                        :id="'classes-' + classes.id" 
                        :value="classes.cat_slug" 
                        v-model="parentClassesChecked[classes.cat_slug]" 
                        @change="onParentChecked(classes)"
                      >
                      <label :for="'classes-' + classes.id">
                        <div class="p-archiveAsideMenuCategory__image">
                          <img :src="classes.thumbnail_url" alt="" width="" height="" />
                        </div>
                        <div class="p-archiveAsideMenuCategory__title">
                          <p>{{ classes.cat_name }}</p>
                        </div>
                      </label>
                    </div>
                    <div class="p-archiveAsideMenuCategory__child">
                      <div v-for="child in classes.children" :key="child.id">
                        <input
                          type="checkbox" 
                          :id="'classes-' + child.id" 
                          :value="child.cat_slug" 
                          v-model="selectedClasses" 
                        > 
                        <label :for="'classes-' + child.id">
                          <div class="p-archiveAsideMenuCategory__image">
                            <img :src="child.thumbnail_url" alt="" width="" height="" />
                          </div>
                          <div class="p-archiveAsideMenuCategory__title">
                            <p>{{ child.cat_name }}</p>
                          </div>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
                <div class="p-archiveAsideMenu__reset">
                  <p @click="selectAll('style')">選択をクリア</p>
                </div>
                <ul class="p-archiveAsideMenu__item --button">
                  <li v-for="style in details.style" :key="style.id" class="p-archiveAsideMenuItem">
                    <input type="checkbox" :id="'style-' + style.id" :value="style.cat_slug" v-model="selectedStyles">
                    <label :for="'style-' + style.id">{{ style.cat_name }}</label>
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
                <div class="p-archiveAsideMenu__input">
                  <input
                    type="text"
                    @input="handleInput"
                    @focus="increaseFontSize"
                    @blur="resetFontSize"
                    placeholder="ブランドをさがす"
                  />
                </div>
                <div class="p-archiveAsideMenu__reset">
                  <p @click="selectAll('brand')">選択をクリア</p>
                </div>
                <ul v-if="searchBrands.length" class="p-archiveAsideMenu__brand">
                  <li v-for="brand in searchBrands" :key="brand.id" class="p-archiveAsideMenuBrand">
                    <label :for="'brand-' + brand.id">
                      <input type="checkbox" :id="'brand-' + brand.id" :value="brand.cat_slug" v-model="selectedBrands">
                      <div class="p-archiveAsideMenuBrand__heading">
                        <span>{{ brand.name }}</span>
                        <span>{{ brand.name_jp }}</span>
                      </div>
                    </label>
                  </li>
                </ul>
                <ul v-else class="p-archiveAsideMenu__brand">
                  <li v-for="brand in details.brand" :key="brand.id" class="p-archiveAsideMenuBrand">
                    <label :for="'brand-' + brand.id">
                      <input type="checkbox" :id="'brand-' + brand.id" :value="brand.cat_slug" v-model="selectedBrands">
                      <div class="p-archiveAsideMenuBrand__heading">
                        <span>{{ brand.cat_name }}</span>
                        <span>{{ brand.name_jp }}</span>
                      </div>
                    </label>
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
      <article class="p-archive__article" ref="archiveArticle">
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
        <div class="p-elementIndex__item" ref="archiveItem" @scroll.passive="handleScroll">
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
  import { debounce } from 'lodash'

  export default {

    head () {
      const defaultHead = this.$nuxt.$options.head
      const title = `家具一覧 | ${defaultHead.title}`

      return {
        title,
        meta: [
          { hid: 'og:title', property: 'og:title', content: title },
          { hid: 'og:url', property: 'og:url', content: `${process.env.BASE_URL}element` },
        ],
      }
    },

    data () {
      return {
        windowWidth: 0,
        details: [],
        elements: [],
        parentClassesChecked: {},
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
        searchBrands: [], // ブランド検索時に使用
        sliderValue: [0, 1]
      }
    },

    async asyncData ({ $axios, query, app }) {

      try {
        const responseDetails = await $axios.get(`${app.$url}/custom/v0/element_detail`)
        const responseElements = await $axios.get(`${app.$url}/custom/v0/elements`, {
          params: {
            per_page: 20,
            page: 1,
          },
        })

        // クラスのデータの整理
        const organizedClasses = responseDetails.data.class.filter(item => item.parent === 0).map(parent => {
          return {
            ...parent,
            children: responseDetails.data.class.filter(child => child.parent === parent.id)
          }
        })

        return {
          details: responseDetails.data,
          details: {
            ...responseDetails.data,
            class: undefined, // details.classを取り除く
            organizedClasses, // 整理されたクラスデータ
          },
          elements: responseElements.data,
        }
      } catch (error) {
        console.error(error)
        return {
          details: {
            style: [],
            price: [],
            price_range: [],
            organizedClasses: [],
            brand: []
          },
          elements: [],
        }
      }
    },

    computed: {

      bodyClass() {
        return 'p-elementIndex p-archive'
      },

      // サイドバー：値段で記事ソートする下限を100の位で四捨五入して計算
      priceMin() {
        const price = this.scale(this.sliderValue[0])
        return Math.round(price / 100) * 100
      },
      // サイドバー：値段で記事ソートする上限を100の位で四捨五入して計算
      priceMax() {
        const price = this.scale(this.sliderValue[1])
        return Math.round(price / 100) * 100
      },

      scale() {
        const { min_price, percentile_25, percentile_50, percentile_75, max_price } = this.details.price_range
        const domain = [0, 0.25, 0.5, 0.75, 1]
        const range = [Number(min_price), Number(percentile_25), Number(percentile_50), Number(percentile_75), Number(max_price)]
        // 非線形スケールを作成
        return value => {
          if (value <= domain[1]) {
            return this.linearScale(value, domain[0], domain[1], range[0], range[1])
          } else if (value <= domain[2]) {
            return this.linearScale(value, domain[1], domain[2], range[1], range[2])
          } else if (value <= domain[3]) {
            return this.linearScale(value, domain[2], domain[3], range[2], range[3])
          } else {
            return this.linearScale(value, domain[3], domain[4], range[3], range[4])
          }
        }
      },

      // サイドバー：値段で記事ソートするスライドボタンの大きさ変更
      dynamicDotSize() {
        if (this.windowWidth >= 1025) {
          return this.vwEquivalent(18)
        } else if (this.windowWidth <= 768) {
          return 20
        } else {
          return 14
        }
      },
    },

    created () {
      if (process.client) {
        this.likedInit()
      }
    },

    mounted () {
      // サーバーサイドでは利用できないため
      this.windowWidth = window.innerWidth

      this.boundAsideSticky = this.asideSticky.bind(this)
      this.updateSelectionsFromURL()
      this.initAsideAccordions() // アサイド：マウント時のアコーディオンをデフォルトで隠す
      if (!process.client) {
        this.likedInit()
      }
      this.sortOpacityResize()

      this.onResize = () => {
        this.windowWidth = window.innerWidth
        this.sortOpacityResize()
        this.boundAsideSticky()
        this.dynamicDotSize
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
      selectedPrices: { // 消すコード
        handler: 'handleSelectionChange',
        deep: true,
      },
      selectedStyles: {
        handler: 'handleSelectionChange',
        deep: true,
      }
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
              min_price: this.priceMin,
              max_price: this.priceMax,
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
        const articleElement = this.$refs.archiveItem
        const articleHeight = articleElement.scrollHeight

        if (scrollTop + windowHeight >= articleHeight - 300) {
          this.currentPage += 1
          if (this.initialSortFetch) { // 初回取得フラグがtrueならfalseにする
            this.initialSortFetch = false
          }
          await this.fetchElements(this.currentPage)
        }
      },

      // ソートボタン：画面サイズが769px以下または1024px以上の時に非表示にする
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

      selectAll (type) {
        if (type === 'class') {
          this.selectedClasses = []
          this.parentClassesChecked = []
          this.closeAllAccordions()
        } else if (type === 'brand') {
          this.selectedBrands = []
        } else if (type === 'price') {
          this.sliderValue = [0, 1] // 元々のコードはthis.selectedPrices = []
        } else if (type === 'style') {
          this.selectedStyles = []
        }
      },

      // サイドバー：スマホ時の検索ボックスにあるクリアボタンを押すと全てクリアに
      clearAll () {
        this.selectedStyles = []
        this.selectedClasses = []
        this.parentClassesChecked = []
        this.closeAllAccordions()
        this.selectedBrands = []
        this.sliderValue = [0, 1] // 元々のコードはthis.selectedPrices = []
      },
      
      // サイドバー：絞り込みをクリックした際にアサイドを表示する
      animateAside () {
        if (window.innerWidth <= 1024) {
          gsap.to('.p-archive__aside', {
            autoAlpha: 1,
            duration: 0.2,
            onComplete: () => {
              document.body.style.overflow = 'hidden' // スクロールを無効にする
            }
          })
        }
      },

      // アサイド：検索するをクリックした際にアサイドを隠す
      hideAside () {
        if (window.innerWidth <= 1024) {
          gsap.to('.p-archive__aside', {
            autoAlpha: 0,
            duration: 0.2,
            onComplete: () => {
              document.body.style.overflow = '' // スクロールを有効にする
            }
          })
        }
      },

      // アサイド：マウント時のアコーディオンをデフォルトで隠す
      initAsideAccordions () {
        // const asideAccordionMenu = document.querySelectorAll('.p-archiveAsideMenu.is-accordion .p-archiveAsideMenu__body')
        // asideAccordionMenu.forEach((menu) => {
        //   gsap.set(menu, { height: 0, autoAlpha: 0 })
        // })

        const asideAccordionMenuCategory = document.querySelectorAll('.p-archiveAsideMenuCategory__child')
        asideAccordionMenuCategory.forEach((menu) => {
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
              // iconElementが存在し、その中に2番目の要素がある場合のみ、アニメーションを追加
              if (iconElement && iconElement[1]) {
                tl.to(iconElement[1], { rotate: 0, duration: 0.3 }, '<')
              }
            } else {
              tl.to(contentElement, { height: 0, autoAlpha: 0, duration: 0.3, onComplete: resolve })
              // iconElementが存在し、その中に2番目の要素がある場合のみ、アニメーションを追加
              if (iconElement && iconElement[1]) {
                tl.to(iconElement[1], { rotate: -90, duration: 0.3 }, '<')
              }
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

      // 画面幅1280pxを基準にしてpxをwvに変換
      vwEquivalent (pxValueAt1280) {
        const referenceViewportWidth = 1280
        let currentViewportWidth = window.innerWidth
        let currentPxValue = (pxValueAt1280 * currentViewportWidth) / referenceViewportWidth
        return currentPxValue
      },

      // アサイド：スクロールに応じてアサイドを追従
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

      handleInput(event) {
        const inputValue = event.target.value
        this.searchForBrand(inputValue)
      },

      async searchForBrand(query) {
        if (query) {
          const response = await this.$axios.$get(`${this.$nuxt.$url}/custom/v0/element_brand`, {
            params: {
              search: query,
            },
          })
          this.searchBrands = response
        } else {
          this.searchBrands = []
        }
      },

      // スケールした値を0~1の値に戻す
      scaleInverse(value) {
        const { min_price, percentile_25, percentile_50, percentile_75, max_price } = this.details.price_range
        if (value < percentile_25) {
          const range = percentile_25 - min_price
          return (value - min_price) / (4 * range)
        } else if (value < percentile_50) {
          const range = percentile_50 - percentile_25
          return 0.25 + (value - percentile_25) / (4 * range)
        } else if (value < percentile_75) {
          const range = percentile_75 - percentile_50
          return 0.5 + (value - percentile_50) / (4 * range)
        } else {
          const range = max_price - percentile_75
          return 0.75 + (value - percentile_75) / (4 * range)
        }
      },

      linearScale(value, domainMin, domainMax, rangeMin, rangeMax) {
        const factor = (value - domainMin) / (domainMax - domainMin)
        return rangeMin + factor * (rangeMax - rangeMin)
      },

      // サイドバー：値段での記事ソートフォーカスが外れた時
      updateInputPrice(index, value) {
        this.resetFontSize(value) // スマホでのズームを防ぐ
        const numericValue = Number(value.target.value.replace(/\D/g, '')) // 入力値から非数字の文字を削除し、数値に変換します
        const { max_price } = this.details.price_range // 最大値を取得します
        let newSliderValue
        if (numericValue <= 100) { // 入力値が100以下の場合、最大値を設定します
          newSliderValue = index === 0 ? 0 : 1  // indexが0の場合は最小値を0に、1の場合は最大値に設定します
        }
        else if (numericValue > max_price) { // 入力値が最大値を超える場合、処理を終了します
          newSliderValue = 1
        }
        else { // それ以外の場合、入力値を使用します
          newSliderValue = this.scaleInverse(numericValue) // スケールした値を0~1の値に戻す
        }
        this.sliderValue.splice(index, 1, newSliderValue) // スライドの位置を正確な場所に移動させる
        this.updatePrice()
      },

      updatePrice: debounce(function() {
        this.handleSelectionChange()
      }, 300), // 300ミリ秒のデバウンス時間を設定

      // サイドバー：値段での記事ソート時に日本円表記に変換
      formatCurrency(value) {
        return new Intl.NumberFormat('ja-JP').format(value) + '円'
      },

      // サイドバー：値段での記事ソートフォーカス時に数字以外の文字を削除
      clearFormatting(event) {
        this.increaseFontSize(event) // スマホでのズームを防ぐ
        const value = event.target.value.replace(/[,\円]/g, '')
        event.target.value = value
      },

      // サイドバー：値段での記事ソート入力時に全角の数字を半角に変換
      convertToHalfWidth(str) {
        return str.replace(/[０-９]/g, function(s) {
          return String.fromCharCode(s.charCodeAt(0) - 0xFEE0)
        })
      },

      // サイドバー：値段での記事ソート入力時に数字以外の文字を削除
      enforceNumericInput(event) {
        let value = event.target.value
        value = this.convertToHalfWidth(value) // 全角を半角に変換
        value = value.replace(/\D/g, '') // 数字以外の文字を削除
        event.target.value = value
      },

      // サイドバー：値段での記事ソート入力時にスマホでのズームを防ぐ
      increaseFontSize(event) {
        if (window.innerWidth <= 768) { 
          event.target.style.fontSize = '16px'
        }
      },

      // サイドバー：値段での記事ソート入力時にスマホでのズームを防ぐ
      resetFontSize(event) {
        if (window.innerWidth <= 768) { 
          event.target.style.fontSize = ''
        }
      },

      // サイドバー：親カテゴリーがチェックされたら子カテゴリーも全てチェックする
      onParentChecked(parent) {
        if (this.parentClassesChecked[parent.cat_slug]) {
          // 親がチェックされたら、子もチェックする
          if (parent.children && parent.children.length > 0) {
            // 子要素が存在する場合は子要素のcat_slugを追加
            parent.children.forEach(child => {
              if (!this.selectedClasses.includes(child.cat_slug)) {
                this.selectedClasses.push(child.cat_slug)
              }
            })
          } else {
            // 子要素が存在しない場合は親要素自体のcat_slugを追加
            if (!this.selectedClasses.includes(parent.cat_slug)) {
              this.selectedClasses.push(parent.cat_slug)
            }
          }
        } else {
          // 親のチェックが外されたら、子のチェックも外す
          if (parent.children && parent.children.length > 0) {
            // 子要素が存在する場合は子要素のcat_slugを取り除く
            parent.children.forEach(child => {
              const index = this.selectedClasses.indexOf(child.cat_slug)
              if (index !== -1) {
                this.selectedClasses.splice(index, 1)
              }
            })
          } else {
            // 子要素が存在しない場合は親要素自体のcat_slugを取り除く
            const index = this.selectedClasses.indexOf(parent.cat_slug)
            if (index !== -1) {
              this.selectedClasses.splice(index, 1)
            }
          }
        }
      },

      // サイドバー：カテゴリーのすべてのアコーディオンを閉じる
      closeAllAccordions() {
        const allAccordionContents = document.querySelectorAll('.p-archiveAsideMenuCategory__child')
        gsap.to(allAccordionContents, { height: 0, autoAlpha: 0, duration: 0.3 })
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
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;

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