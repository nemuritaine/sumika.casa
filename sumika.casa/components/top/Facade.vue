<template>
  <div class="p-topFacade">
    <div class="p-topFacade__wrapper">
      <div class="p-topFacade__carousel">
        <Visual />
      </div>
      <div class="p-topFacade__news">
        <div class="p-topFacadeNews">
          <div class="p-topFacadeNews__title">News & Event</div>
          <div class="p-topFacadeNews__item">
            <div class="p-topFacadeNewsItem">
              <p>{{ news[0].title }}</p>
            </div>
            <div class="p-topFacadeNewsItem">
              <p>{{ news[0].title }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import Visual from '~/components/top/Visual.vue' 

  export default {
    components: {
      Visual,
    },

    data () {

      return {
        news: [],
      }
    },

    async fetch () {
      try {
        const responseNews = await this.$axios.get(`https://sumika.artche.jp/cms/wp-json/custom/v0/news`)
        this.news = responseNews.data
      } catch (error) {
        console.log(error)
      }
    }
  }
</script>

<style lang="scss" scoped>
  .p-topFacade {
    background-color: color(bg);

    // .p-topFacade__wrapper
    &__wrapper {
      aspect-ratio: 375 / 526;
      overflow: hidden;
      position: relative;

      @include responsive(sm, min) {
        aspect-ratio: 1280 / 520;
      }
    }

    // .p-topFacade__carousel
    &__carousel {
      overflow: hidden;

      @include responsive(md, min) {
      
      }
    }
    
    &__news {
      display: none;
      position: absolute;
      bottom: vw(40);
      right: vw(40);

      @include responsive(sm, min) {
        display: block;
      }
    }
  }
  .p-topFacadeNews {

    &__title {
      @include Optima;
      @include vwfont(1280, 16, 24, 0);
      text-align: right;
      color: color(darkgray);
    }

    &__item {
      margin-top: vw(6);
      background-color: color(white);
      width: vw(280);
      height: vw(56);
      display: block;
      position: relative;
      white-space: nowrap;
      z-index: 10;
      overflow: hidden;
      border-radius: 6px;
      box-shadow: 0px 10px 20px rgba(17, 17, 17, 0.05);
    }
  }

  .p-topFacadeNewsItem {
    display: inline-flex;
    align-items: center;
    height: 100%;
    color: #565853;
    
    &:nth-of-type(1) {
      animation: infiniteAnimation 40s -20s linear infinite;
    }
    
    &:nth-of-type(2) {
      animation: infiniteAnimationClone 40s linear infinite;
    }
    
    p {
      @include font(14, 28, 40, 700);
      padding-left: 10px;

      @include responsive(md, min) {
        @include vwfont(1280, 14);
        padding-left: vw(10);
      }
    }
  }
</style>