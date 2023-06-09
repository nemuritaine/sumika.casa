require('dotenv').config()
const fs = require('fs')
const path = require('path')
const axios = require('axios')

// 前回のビルド時のタイムスタンプを取得する関数
const getLastBuildTimestamps = () => {
  const filePath = path.resolve(__dirname, 'last-build-timestamps.json')
  if (fs.existsSync(filePath)) {
    const data = fs.readFileSync(filePath, 'utf-8')
    return JSON.parse(data)
  } else {
    return {}
  }
}

// タイムスタンプを保存する関数
const setLastBuildTimestamps = (timestamps) => {
  const filePath = path.resolve(__dirname, 'last-build-timestamps.json')
  fs.writeFileSync(filePath, JSON.stringify(timestamps, null, 2))
}

const updateConfig = async () => {

  // 前回のビルド時のタイムスタンプを取得
  const lastBuildTimestamps = getLastBuildTimestamps()
  let excludePaths = []
  let routesPaths = []

  
  // Vueファイルのタイムスタンプを確認
  const vueFilePaths = ['/element', '/news', '/post', '/study', '/']
  for (const filePath of vueFilePaths) {
    const fullPath = path.resolve(__dirname, `pages${filePath}/index.vue`)
    const fileStats = fs.statSync(fullPath)
    const lastModified = Math.floor(fileStats.mtimeMs)
    const lastBuildTimestamp = lastBuildTimestamps[filePath] || 0
    if (lastModified <= lastBuildTimestamp) {
      const excludePath = `${filePath}`
      excludePaths.push(excludePath)
    }
    lastBuildTimestamps[filePath] = lastModified
  }


  // APIからタイムスタンプを取得
  const response = await axios.get(`${process.env.VUE_APP_API_URL}/custom/v0/timestamp`)
  const postTimestamps = response.data

  // APIのデータと前回のタイムスタンプを比較
  for (const postTimestamp of postTimestamps) {
    // 前回のタイムスタンプを取得
    const lastBuildTimestamp = lastBuildTimestamps[`/${postTimestamp.type}/${postTimestamp.id}`] || 0
    // WPのタイムスタンプを"-"とスペースと":"を取り除いて数値に変換
    const cleanedTimestamp = Number(postTimestamp.last_modified.replace(/[- :]/g, ""))
    // 前回のタイムスタンプがWPのタイムスタンプ以上の数値だった場合にビルド対象から取り除く
    if (lastBuildTimestamp >= cleanedTimestamp) {
      const excludePath = `/${postTimestamp.type}/${postTimestamp.id}`
      excludePaths.push(excludePath)
    } else {
      const routesPath = `/${postTimestamp.type}/${postTimestamp.id}`
      routesPaths.push(routesPath)
      excludePaths = excludePaths.filter(value => value !== `/${postTimestamp.type}`)
    }
    // 現在の最新のタイムスタンプを保存
    lastBuildTimestamps[`/${postTimestamp.type}/${postTimestamp.id}`] = cleanedTimestamp
  }


  // 前回のタイムスタンプを更新
  setLastBuildTimestamps(lastBuildTimestamps)


  // Nuxtの設定ファイルを更新
  const config = await import('./nuxt.config.mjs')
  config.default.generate.exclude = excludePaths
  config.default.generate.routes = routesPaths

  // 更新した設定をnuxt.config.mjsに書き戻す
  fs.writeFileSync('./nuxt.config.mjs', `export default ${JSON.stringify(config.default, null, 2)}`)
}

updateConfig()