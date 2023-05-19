<template>
  <div class="p-single__inner">
    <div class="p-single__wrapper">
      <article class="p-single__article">
        <section class="p-newsDetailFacade">
          <div class="p-newsDetailFacade__date">
            <time v-bind:datetime="post.modified">{{ post.date }}</time>
          </div>
          <div class="p-newsDetailFacade__title">
            <h1>{{ post.title }}</h1>
          </div>
          <div v-if="post.category" class="p-newsDetailFacade__category">
            <a href="">{{ post.category }}</a>
          </div>
        </section>
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

    async asyncData(context) {
      const post = await context.$axios.$get(`https://sumika.artche.jp/cms/wp-json/custom/v0/single_news?id=${context.params.id}`)
      return {
        post
      }
    },

    computed: {
      bodyClass () {
        return 'p-newsDetail p-single'
      }
    },
  }
</script>


<style lang="scss" scoped>
.p-newsDetailFacade {
    
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
          @include font(28);
        }

        @include responsive(md, min) {
          @include vwfont(1280, 28);
        }
      }
    }

    // .p-newsDetailFacade__category
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
          @include font(68);
        }

        @include responsive(md, min) {
          @include vwfont(1280, 68);
        }
      }
    }
  }
</style>