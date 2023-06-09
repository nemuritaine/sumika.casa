export default {
  "target": "static",
  "head": {
    "title": "知りたいがすぐ見つかるインテリア情報サイト | Sumika.casa",
    "htmlAttrs": {
      "lang": "ja"
    },
    "meta": [
      {
        "charset": "utf-8"
      },
      {
        "name": "viewport",
        "content": "width=device-width, initial-scale=1"
      },
      {
        "name": "format-detection",
        "content": "telephone=no"
      },
      {
        "hid": "description",
        "name": "description",
        "content": "ディスクリプション"
      },
      {
        "hid": "og:title",
        "property": "og:title",
        "content": "知りたいがすぐ見つかるインテリア情報サイト | Sumika.casa"
      },
      {
        "hid": "og:type",
        "property": "og:type",
        "content": "website"
      },
      {
        "hid": "og:url",
        "property": "og:url",
        "content": "https://sumika.casa/"
      },
      {
        "hid": "og:image",
        "property": "og:image",
        "content": "https://sumika.casa/share.png"
      },
      {
        "hid": "og:site_name",
        "property": "og:site_name",
        "content": "知りたいがすぐ見つかるインテリア情報サイト | Sumika.casa"
      },
      {
        "hid": "og:description",
        "property": "og:description",
        "content": "ディスクリプション"
      },
      {
        "hid": "og:locale",
        "property": "og:locale",
        "content": "ja_JP"
      },
      {
        "name": "twitter:card",
        "content": "summary_large_image"
      }
    ],
    "link": [
      {
        "rel": "icon",
        "type": "image/x-icon",
        "href": "/favicon.ico"
      }
    ]
  },
  "css": [
    "~/assets/scss/_foundation.scss"
  ],
  "styleResources": {
    "scss": "@/assets/scss/_global.scss"
  },
  "plugins": [
    "~/plugins/api.js"
  ],
  "components": true,
  "buildModules": [
    "@nuxt/typescript-build",
    "@nuxtjs/style-resources"
  ],
  "modules": [
    "@nuxtjs/axios",
    "@nuxtjs/dotenv",
    "cookie-universal-nuxt",
    "@nuxtjs/pwa"
  ],
  "axios": {},
  "build": {},
  "filenames": {
    "app": "[name].js",
    "chunk": "[name].js"
  },
  "pwa": {
    "manifest": false
  },
  "generate": {
    "fallback": true,
    "interval": 0,
    "exclude": [
      "/news",
      "/post",
      "/study",
      "/",
      "/element/5138",
      "/element/5135",
      "/element/5132",
      "/element/5130",
      "/element/5127",
      "/element/5125",
      "/element/5122",
      "/element/5120",
      "/element/5118",
      "/element/5116",
      "/element/5114",
      "/element/5111",
      "/element/5109",
      "/element/5105",
      "/element/5102",
      "/element/5099",
      "/element/5097",
      "/element/5095",
      "/element/5093",
      "/element/5090",
      "/element/5088",
      "/element/5083",
      "/element/5007",
      "/element/5005",
      "/element/5003",
      "/element/5001",
      "/element/4999",
      "/element/4997",
      "/element/4995",
      "/element/4993",
      "/element/4989",
      "/element/4987",
      "/element/4985",
      "/element/4983",
      "/element/4981",
      "/element/4979",
      "/element/4975",
      "/element/4973",
      "/element/4969",
      "/element/4966",
      "/element/4964",
      "/element/4957",
      "/element/4952",
      "/element/4948",
      "/element/4520",
      "/element/4518",
      "/element/4516",
      "/element/4514",
      "/element/4512",
      "/element/4510",
      "/element/4508",
      "/element/4506",
      "/element/4504",
      "/element/4501",
      "/element/4499",
      "/element/4497",
      "/element/4495",
      "/element/4493",
      "/element/4402",
      "/element/4400",
      "/element/4398",
      "/news/4412",
      "/study/4427",
      "/study/4429",
      "/study/4431",
      "/study/4433",
      "/study/4435",
      "/study/4437",
      "/study/4439",
      "/study/4442",
      "/study/4444",
      "/study/4446",
      "/study/4448",
      "/study/4450",
      "/study/4452",
      "/study/4454",
      "/study/4456",
      "/study/4458",
      "/study/4460",
      "/study/4462",
      "/study/4464",
      "/study/4466",
      "/study/4468",
      "/study/4470",
      "/study/4425",
      "/post/1638",
      "/post/1597",
      "/post/1566",
      "/post/1552",
      "/post/1530",
      "/post/1487",
      "/post/1391",
      "/post/1374",
      "/post/1299",
      "/post/1246",
      "/post/1238",
      "/post/1204",
      "/post/1154",
      "/post/1139",
      "/post/1123",
      "/post/1089",
      "/post/1028",
      "/post/994",
      "/post/961",
      "/post/949",
      "/post/927",
      "/post/876",
      "/post/849",
      "/post/793",
      "/post/725",
      "/post/541",
      "/post/44",
      "/post/82",
      "/post/66",
      "/post/201",
      "/post/131",
      "/post/86",
      "/post/78",
      "/post/27"
    ],
    "routes": []
  }
}