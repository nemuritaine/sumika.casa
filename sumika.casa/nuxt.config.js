import axios from 'axios'

export default {
  // Target: https://go.nuxtjs.dev/config-target
  target: 'static',

  mode: 'universal',

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: '知りたいがすぐ見つかるインテリア情報サイト | Sumika.casa',
    htmlAttrs: {
      lang: 'ja'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { name: 'format-detection', content: 'telephone=no' },
      { hid: 'description', name: 'description', content: 'ディスクリプション' },
      { hid: 'og:title', property: 'og:title', content: '知りたいがすぐ見つかるインテリア情報サイト | Sumika.casa' },
      { hid: 'og:type', property: 'og:type', content: 'website' },
      { hid: 'og:url', property: 'og:url', content: 'https://sumika.casa/' },
      { hid: 'og:image', property: 'og:image', content: 'https://sumika.casa/share.png' },
      { hid: 'og:site_name', property: 'og:site_name', content: '知りたいがすぐ見つかるインテリア情報サイト | Sumika.casa' },
      { hid: 'og:description', property: 'og:description', content: 'ディスクリプション' },
      { hid: 'og:locale', property: 'og:locale', content: 'ja_JP' },
      { name: 'twitter:card', content: 'summary_large_image' },
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    '~/assets/scss/_foundation.scss'
  ],

  styleResources: {
    scss: '@/assets/scss/_global.scss'
  },

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '~/plugins/api.js',
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/typescript
    '@nuxt/typescript-build',
    '@nuxtjs/style-resources',
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    '@nuxtjs/dotenv',
    'cookie-universal-nuxt',
  ],

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    // Workaround to avoid enforcing hard-coded localhost:3000: https://github.com/nuxt-community/axios-module/issues/308
    baseURL: process.env.BASE_API_URL
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    // publicPath: process.env.NODE_ENV === 'production' ? '/' : '/_nuxt/',
  },

  generate: {
    fallback: true,
    interval: 100,
    routes: async () => {
      const endpoints = [
        { endpoint: 'posts', name: 'article' },
        { endpoint: 'elements', name: 'element' },
        { endpoint: 'news', name: 'news' },
        { endpoint: 'studies', name: 'study' },
      ]
      const fetchRouteData = async (endpoint, name) => {
        const response = await axios.get(`${process.env.VUE_APP_API_URL}/custom/v0/${endpoint}`, { params: {} })
        return response.data.map((post) => {
          return {
            route: `/${name}/${post.id}`,
            payload: {
              posts: response.data,
              currentPost: post,
            }
          }
        })
      }
      const routes = await Promise.all(
        endpoints.map((endpoint) => {
          return fetchRouteData(endpoint.endpoint, endpoint.name)
        })
      )
      return routes.flat()
    }
  },
}
