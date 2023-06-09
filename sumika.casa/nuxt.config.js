import axios from 'axios'

export default {
  // Target: https://go.nuxtjs.dev/config-target
  target: 'static',

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    htmlAttrs: {
      lang: 'ja',
    },
    title: 'インテリアと暮らしのデータベース | sumika.casa',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { name: 'format-detection', content: 'telephone=no' },
      { hid: 'description', name: 'description', content: '住み家は「暮らしを楽しむ」際に役立つインテリアの情報を「発信」「シェア」しているサイトです。' },
      { hid: 'og:title', property: 'og:title', content: 'インテリアと暮らしのデータベース | sumika.casa' },
      { hid: 'og:type', property: 'og:type', content: 'website' },
      { hid: 'og:url', property: 'og:url', content: 'https://sumika.casa/' },
      { hid: 'og:image', property: 'og:image', content: 'https://sumika.casa/assets/common/ogp_default.jpg' },
      { hid: 'og:site_name', property: 'og:site_name', content: 'インテリアと暮らしのデータベース | sumika.casa' },
      { hid: 'og:description', property: 'og:description', content: '住み家は「暮らしを楽しむ」際に役立つインテリアの情報を「発信」「シェア」しているサイトです。' },
      { hid: 'og:locale', property: 'og:locale', content: 'ja_JP' },
      { name: 'twitter:card', content: 'summary_large_image' },
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
      { rel: 'icon', type: 'image/png', sizes: '32x32', href: '/favicon-32x32.png' },
      { rel: 'apple-touch-icon', sizes: '180x180', href: '/apple-icon-180x180.png' },
      { rel: 'icon', type: 'image/png', sizes: '192x192', href: '/android-icon-192x192.png' }
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
    '@nuxtjs/pwa',
    '@nuxtjs/google-gtag',
  ],

  'google-gtag': {
    id: 'G-RSQDQPRELF',
    debug: true, // これをtrueに設定すると、デバッグモードで動作します
  },

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    // Workaround to avoid enforcing hard-coded localhost:3000: https://github.com/nuxt-community/axios-module/issues/308
    baseURL: process.env.BASE_API_URL
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    // publicPath: process.env.NODE_ENV === 'production' ? '/' : '/_nuxt/',
  },

  filenames: {
    app: () => '[name].js',
    chunk: () => '[name].js',
  },

  pwa: {
    manifest: {
      lang: 'ja',
    },
  },

  generate: {
    fallback: true,
    interval: 0, // 100

    routes: async () => {

      const endpoints = [
        { endpoint: 'posts', name: 'post' },
        { endpoint: 'elements', name: 'element' },
        { endpoint: 'newses', name: 'news' },
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

      const routes = []
      for (const endpoint of endpoints) {
        const result = await fetchRouteData(endpoint.endpoint, endpoint.name)
        routes.push(...result)
      }
      return routes
    }
  },
}
