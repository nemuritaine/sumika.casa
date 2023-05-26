export default ({ app }, inject) => {
  inject('url', process.env.VUE_APP_API_URL)
}