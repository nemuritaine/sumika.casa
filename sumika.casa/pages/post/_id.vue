<template>
  <div class="p-single__inner">
    <div class="p-single__wrapper">
      <article class="p-single__article">
        <section class="p-articleDetailFacade">
          <div class="p-articleDetailFacade__date">
            <time v-bind:datetime="post.modified">{{ post.date }}</time>
          </div>
          <div class="p-articleDetailFacade__title">
            <h1>{{ post.title }}</h1>
          </div>
          <div v-if="post.excerpt" class="p-articleDetailFacade__summary">
            <p>{{ post.excerpt }}</p>
          </div>
          <div v-if="post.category" class="p-articleDetailFacade__category">
            <span>{{ post.category }}</span>
          </div>
        </section>
        <div class="p-articleDetailFacade__eyecatch">
          <picture>
            <img v-bind:src="post.thumbnail" v-bind:alt="post.title">
          </picture>
        </div>
        <div class="p-editor" v-html="post.content"></div>
        <div v-for="(block, key) in post.genesis_custom_blocks" :key="key">
          {{ block }}
        </div>
      </article>
      <aside class="p-single__aside"></aside>
    </div>
  </div>
</template>

<script>

  export default {

    head () {
      const defaultHead = this.$nuxt.$options.head
      const title = this.post.title || defaultHead.title
      const description = this.post.excerpt || defaultHead.meta.find(meta => meta.hid === 'description').content
      const image = this.post.thumbnail || defaultHead.meta.find(meta => meta.hid === 'og:image').content

      return {
        title,
        meta: [
          { hid: 'description', name: 'description', content: description },
          { hid: 'og:title', property: 'og:title', content: title },
          { hid: 'og:description', property: 'og:description', content: description },
          { hid: 'og:url', property: 'og:url', content: `${process.env.BASE_URL}post/${this.post.ID}` },
          { hid: 'og:image', property: 'og:image', content: image },
        ],
      }
    },

    async asyncData({ app, params, payload, $axios }) {

      if (payload) {

        // generate時に取得したデータを使用
        return {
          post: payload.currentPost,
        }

      } else {
        
        // クライアントサイドでレンダリングされる場合はAPIからデータを取得
        const post = await $axios.$get(`${app.$url}/custom/v0/post?id=${params.id}`)
        return {
          post
        }
      }
    },

    computed: {
      
      bodyClass () {
        return 'p-articleDetail p-single'
      }
    },

    methods: {

      roomtourHoverAnimation () {
        const roomTours = document.querySelectorAll('.p-editorRoomtour')

        roomTours.forEach(roomTour => {

          roomTour.addEventListener('mouseover', (event) => {
            event.stopPropagation()
            roomTour.classList.add('is-active')
          })

          roomTour.addEventListener('mouseout', (event) => {
            event.stopPropagation()
            roomTour.classList.remove('is-active')
          })
        })
      },
    },

    mounted () {
      this.roomtourHoverAnimation()
    },
  }
</script>

<style lang="scss" scoped>

  .p-articleDetailFacade {
    
    &__date {
      
      time {
        display: block;
        color: #727171;
        line-height: 14px;
        font-size: 10px;
      }
    }

    &__title {
      margin-top: rem(14);
      
      h1 {
        @include font(24, 39.6, 40, 600);
        @include YuMincho;

        @include responsive(sm, min) {
          @include font(28, 46.2, 40, 600);
        }

        @include responsive(md, min) {
          @include vwfont(1280, 28, 46.2, 40, 600);
        }
      }
    }

    &__summary {
      margin-top: rem(20);

      @include responsive(md, min) {
        margin-top: vw(20);
      }

      p {
        @include font(16, 32, 0);

        @include responsive(md, min) {
          @include vwfont(1280, 16, 32, 0);
        }
      }
    }

    &__eyecatch {
      border-radius: rem(6);
      overflow: hidden;

      @include responsive(md, min) {
        border-radius: vw(6);
      }

      img {
        width: 100%;
      }
    }

    // .p-articleDetailFacade__category
    &__category {
      margin-top: rem(30);
      margin-bottom: rem(-11);

      @include responsive(sm, min) {
        margin-bottom: rem(-17);
      }

      @include responsive(md, min) {
        margin-top: vw(30);
        margin-bottom: vw(-17);
      }

      span {
        text-transform: uppercase;
        font-family: 'Wandeln';
        color: #dddddd;
        display: inline-block;
        @include font(42, 42, 0);

        @include responsive(sm, min) {
          @include font(68, 68, 0);
        }

        @include responsive(md, min) {
          @include vwfont(1280, 68, 68, 0);
        }
      }
    }
  }
</style>