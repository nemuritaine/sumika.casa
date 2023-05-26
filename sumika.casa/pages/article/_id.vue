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
            <a href="">{{ post.category }}</a>
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
  import { gsap } from 'gsap'
  const tl = gsap.timeline()

  export default {

    async asyncData ({ app, params, $axios }) {

      const post = await $axios.$get(`${app.$url}/custom/v0/single_article?id=${params.id}`)
      return {
        post
      }
    },

    computed: {
      bodyClass () {
        return 'p-articleDetail p-single'
      }
    },

    mounted () {
      this.roomtourHoverAnimation()
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
      }
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

      a {
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