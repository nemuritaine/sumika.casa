export default function ({ $axios }) {
  $axios.defaults.timeout = 10000; // 10 seconds
}