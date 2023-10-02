import axios from 'axios'

export default {
  // Target: https://go.nuxtjs.dev/config-target
  target: 'static',
  
  loading: false, // 非同期通信の際に表示されるプログレスバーを非表示

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    htmlAttrs: {
      lang: 'ja',
    },
    title: 'インテリアと暮らしのデータベース',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { name: 'format-detection', content: 'telephone=no' },
      { hid: 'description', name: 'description', content: '住み家は「暮らしを楽しむ」際に役立つインテリアの情報を「発信」「シェア」しているデータベースサイトです。' },
      { hid: 'og:title', property: 'og:title', content: 'インテリアと暮らしのデータベース' },
      { hid: 'og:type', property: 'og:type', content: 'website' },
      { hid: 'og:url', property: 'og:url', content: `${process.env.BASE_URL}` },
      { hid: 'og:image', property: 'og:image', content: `${process.env.BASE_URL}assets/images/common/ogp_default.jpg` },
      { hid: 'og:site_name', property: 'og:site_name', content: 'SUMIKA.CASA' },
      { hid: 'og:description', property: 'og:description', content: '住み家は「暮らしを楽しむ」際に役立つインテリアの情報を「発信」「シェア」しているデータベースサイトです。' },
      { hid: 'og:locale', property: 'og:locale', content: 'ja_JP' },
      { name: 'twitter:card', content: 'summary_large_image' },
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: `${process.env.BASE_URL}favicon.ico` },
      { rel: 'icon', type: 'image/png', sizes: '32x32', href: `${process.env.BASE_URL}favicon-32x32.png` },
      { rel: 'apple-touch-icon', sizes: '180x180', href: `${process.env.BASE_URL}apple-icon-180x180.png` },
      { rel: 'icon', type: 'image/png', sizes: '192x192', href: `${process.env.BASE_URL}android-icon-192x192.png` }
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
    '@nuxtjs/sitemap'
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

  sitemap: {
    hostname: 'https://sumika.casa',
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
          return `/${name}/${post.id}`
        })
      }

      const routes = []
      for (const endpoint of endpoints) {
        const result = await fetchRouteData(endpoint.endpoint, endpoint.name)
        routes.push(...result)
      }
      return routes
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
