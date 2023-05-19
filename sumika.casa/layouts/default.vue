<template>
  <div>
    <TheHeader />
    <main class="l-main">
      <Nuxt />
    </main>
    <TheFooter />
  </div>
</template>

<script>
  export default {
    methods: {
      getBodyClass() {
        for (const matchedRoute of this.$route.matched) {
          const bodyClass =
            matchedRoute.components.default.options.computed?.bodyClass?.call(this)
          if (bodyClass) {
            return bodyClass
          }
        }
        return ""
      },
    },

    head() {
      const bodyClass = this.getBodyClass()
      return {
        bodyAttrs: {
          class: bodyClass,
        },
      }
    },
  }
</script>

<style lang="scss">
.l-main {
}
</style>
