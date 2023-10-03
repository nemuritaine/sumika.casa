export default {
  "target": "static",
  "loading": false,
  "head": {
    "htmlAttrs": {
      "lang": "ja"
    },
    "title": "インテリアと暮らしのデータベース",
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
        "content": "住み家は「暮らしを楽しむ」際に役立つインテリアの情報を「発信」「シェア」しているデータベースサイトです。"
      },
      {
        "hid": "og:title",
        "property": "og:title",
        "content": "インテリアと暮らしのデータベース"
      },
      {
        "hid": "og:type",
        "property": "og:type",
        "content": "website"
      },
      {
        "hid": "og:url",
        "property": "og:url",
        "content": "https://sumika.casa"
      },
      {
        "hid": "og:image",
        "property": "og:image",
        "content": "https://sumika.casa/assets/images/common/ogp_default.jpg"
      },
      {
        "hid": "og:site_name",
        "property": "og:site_name",
        "content": "SUMIKA.CASA"
      },
      {
        "hid": "og:description",
        "property": "og:description",
        "content": "住み家は「暮らしを楽しむ」際に役立つインテリアの情報を「発信」「シェア」しているデータベースサイトです。"
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
        "href": "https://sumika.casa/favicon.ico"
      },
      {
        "rel": "icon",
        "type": "image/png",
        "sizes": "32x32",
        "href": "https://sumika.casa/favicon-32x32.png"
      },
      {
        "rel": "apple-touch-icon",
        "sizes": "180x180",
        "href": "https://sumika.casa/apple-icon-180x180.png"
      },
      {
        "rel": "icon",
        "type": "image/png",
        "sizes": "192x192",
        "href": "https://sumika.casa/android-icon-192x192.png"
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
    "~/plugins/api.js",
    {
      "src": "~/plugins/vue-slider.js",
      "mode": "client"
    }
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
    "@nuxtjs/pwa",
    "@nuxtjs/google-gtag",
    "@nuxtjs/sitemap"
  ],
  "google-gtag": {
    "id": "G-RSQDQPRELF",
    "debug": true
  },
  "axios": {},
  "build": {},
  "filenames": {
    "app": "[name].js",
    "chunk": "[name].js"
  },
  "pwa": {
    "manifest": {
      "lang": "ja"
    }
  },
  "sitemap": {
    "exclude": [
      "/study"
    ],
    "hostname": "https://sumika.casa",
    "routes": [
      {
        "route": "/post/7045"
      },
      {
        "route": "/post/6860"
      },
      {
        "route": "/post/541"
      },
      {
        "route": "/post/725"
      },
      {
        "route": "/post/793"
      },
      {
        "route": "/post/1566"
      },
      {
        "route": "/post/1638"
      },
      {
        "route": "/post/849"
      },
      {
        "route": "/post/1139"
      },
      {
        "route": "/post/1154"
      },
      {
        "route": "/post/1204"
      },
      {
        "route": "/post/1246"
      },
      {
        "route": "/post/1299"
      },
      {
        "route": "/post/1391"
      },
      {
        "route": "/post/1238"
      },
      {
        "route": "/post/1374"
      },
      {
        "route": "/post/1487"
      },
      {
        "route": "/post/1530"
      },
      {
        "route": "/post/1552"
      },
      {
        "route": "/post/876"
      },
      {
        "route": "/post/927"
      },
      {
        "route": "/post/949"
      },
      {
        "route": "/post/961"
      },
      {
        "route": "/post/994"
      },
      {
        "route": "/post/1028"
      },
      {
        "route": "/post/1123"
      },
      {
        "route": "/post/1089"
      },
      {
        "route": "/element/7241"
      },
      {
        "route": "/element/7239"
      },
      {
        "route": "/element/7237"
      },
      {
        "route": "/element/7235"
      },
      {
        "route": "/element/7232"
      },
      {
        "route": "/element/7230"
      },
      {
        "route": "/element/7228"
      },
      {
        "route": "/element/7226"
      },
      {
        "route": "/element/7224"
      },
      {
        "route": "/element/7222"
      },
      {
        "route": "/element/7220"
      },
      {
        "route": "/element/7218"
      },
      {
        "route": "/element/7216"
      },
      {
        "route": "/element/7213"
      },
      {
        "route": "/element/7211"
      },
      {
        "route": "/element/7208"
      },
      {
        "route": "/element/7205"
      },
      {
        "route": "/element/7203"
      },
      {
        "route": "/element/7201"
      },
      {
        "route": "/element/7199"
      },
      {
        "route": "/element/7197"
      },
      {
        "route": "/element/7195"
      },
      {
        "route": "/element/7193"
      },
      {
        "route": "/element/7191"
      },
      {
        "route": "/element/7189"
      },
      {
        "route": "/element/7187"
      },
      {
        "route": "/element/7185"
      },
      {
        "route": "/element/7183"
      },
      {
        "route": "/element/7181"
      },
      {
        "route": "/element/7178"
      },
      {
        "route": "/element/7176"
      },
      {
        "route": "/element/7173"
      },
      {
        "route": "/element/7171"
      },
      {
        "route": "/element/7169"
      },
      {
        "route": "/element/7167"
      },
      {
        "route": "/element/7165"
      },
      {
        "route": "/element/7163"
      },
      {
        "route": "/element/7160"
      },
      {
        "route": "/element/7157"
      },
      {
        "route": "/element/7154"
      },
      {
        "route": "/element/7151"
      },
      {
        "route": "/element/7148"
      },
      {
        "route": "/element/7145"
      },
      {
        "route": "/element/7142"
      },
      {
        "route": "/element/7140"
      },
      {
        "route": "/element/7137"
      },
      {
        "route": "/element/7135"
      },
      {
        "route": "/element/7133"
      },
      {
        "route": "/element/7131"
      },
      {
        "route": "/element/7129"
      },
      {
        "route": "/element/7127"
      },
      {
        "route": "/element/7125"
      },
      {
        "route": "/element/7119"
      },
      {
        "route": "/element/7114"
      },
      {
        "route": "/element/7108"
      },
      {
        "route": "/element/7105"
      },
      {
        "route": "/element/7101"
      },
      {
        "route": "/element/7098"
      },
      {
        "route": "/element/7096"
      },
      {
        "route": "/element/7093"
      },
      {
        "route": "/element/7090"
      },
      {
        "route": "/element/7088"
      },
      {
        "route": "/element/7080"
      },
      {
        "route": "/element/7077"
      },
      {
        "route": "/element/7036"
      },
      {
        "route": "/element/7034"
      },
      {
        "route": "/element/7029"
      },
      {
        "route": "/element/7026"
      },
      {
        "route": "/element/7023"
      },
      {
        "route": "/element/7021"
      },
      {
        "route": "/element/7019"
      },
      {
        "route": "/element/7016"
      },
      {
        "route": "/element/7014"
      },
      {
        "route": "/element/7012"
      },
      {
        "route": "/element/7010"
      },
      {
        "route": "/element/7007"
      },
      {
        "route": "/element/7004"
      },
      {
        "route": "/element/7000"
      },
      {
        "route": "/element/6996"
      },
      {
        "route": "/element/6993"
      },
      {
        "route": "/element/6989"
      },
      {
        "route": "/element/6987"
      },
      {
        "route": "/element/6984"
      },
      {
        "route": "/element/6871"
      },
      {
        "route": "/element/6869"
      },
      {
        "route": "/element/6867"
      },
      {
        "route": "/element/6865"
      },
      {
        "route": "/element/6863"
      },
      {
        "route": "/element/6858"
      },
      {
        "route": "/element/6856"
      },
      {
        "route": "/element/6854"
      },
      {
        "route": "/element/6852"
      },
      {
        "route": "/element/6850"
      },
      {
        "route": "/element/6848"
      },
      {
        "route": "/element/6846"
      },
      {
        "route": "/element/6844"
      },
      {
        "route": "/element/6842"
      },
      {
        "route": "/element/6840"
      },
      {
        "route": "/element/6838"
      },
      {
        "route": "/element/6835"
      },
      {
        "route": "/element/6833"
      },
      {
        "route": "/element/6831"
      },
      {
        "route": "/element/6829"
      },
      {
        "route": "/element/6826"
      },
      {
        "route": "/element/6824"
      },
      {
        "route": "/element/6822"
      },
      {
        "route": "/element/6819"
      },
      {
        "route": "/element/6816"
      },
      {
        "route": "/element/6814"
      },
      {
        "route": "/element/6812"
      },
      {
        "route": "/element/6809"
      },
      {
        "route": "/element/6807"
      },
      {
        "route": "/element/6802"
      },
      {
        "route": "/element/6800"
      },
      {
        "route": "/element/6796"
      },
      {
        "route": "/element/6794"
      },
      {
        "route": "/element/6792"
      },
      {
        "route": "/element/6789"
      },
      {
        "route": "/element/6787"
      },
      {
        "route": "/element/6785"
      },
      {
        "route": "/element/6783"
      },
      {
        "route": "/element/6780"
      },
      {
        "route": "/element/6777"
      },
      {
        "route": "/element/6774"
      },
      {
        "route": "/element/6772"
      },
      {
        "route": "/element/6769"
      },
      {
        "route": "/element/6767"
      },
      {
        "route": "/element/6765"
      },
      {
        "route": "/element/6762"
      },
      {
        "route": "/element/6760"
      },
      {
        "route": "/element/6758"
      },
      {
        "route": "/element/6756"
      },
      {
        "route": "/element/6754"
      },
      {
        "route": "/element/6752"
      },
      {
        "route": "/element/6750"
      },
      {
        "route": "/element/6748"
      },
      {
        "route": "/element/6746"
      },
      {
        "route": "/element/6743"
      },
      {
        "route": "/element/6740"
      },
      {
        "route": "/element/6737"
      },
      {
        "route": "/element/6735"
      },
      {
        "route": "/element/6733"
      },
      {
        "route": "/element/6731"
      },
      {
        "route": "/element/6728"
      },
      {
        "route": "/element/6725"
      },
      {
        "route": "/element/6723"
      },
      {
        "route": "/element/6720"
      },
      {
        "route": "/element/6718"
      },
      {
        "route": "/element/6715"
      },
      {
        "route": "/element/6713"
      },
      {
        "route": "/element/6711"
      },
      {
        "route": "/element/6709"
      },
      {
        "route": "/element/6707"
      },
      {
        "route": "/element/6705"
      },
      {
        "route": "/element/6703"
      },
      {
        "route": "/element/6701"
      },
      {
        "route": "/element/6698"
      },
      {
        "route": "/element/6695"
      },
      {
        "route": "/element/6692"
      },
      {
        "route": "/element/6690"
      },
      {
        "route": "/element/6688"
      },
      {
        "route": "/element/6686"
      },
      {
        "route": "/element/6683"
      },
      {
        "route": "/element/6679"
      },
      {
        "route": "/element/6676"
      },
      {
        "route": "/element/6672"
      },
      {
        "route": "/element/6669"
      },
      {
        "route": "/element/6666"
      },
      {
        "route": "/element/6663"
      },
      {
        "route": "/element/6661"
      },
      {
        "route": "/element/6659"
      },
      {
        "route": "/element/6657"
      },
      {
        "route": "/element/6654"
      },
      {
        "route": "/element/6652"
      },
      {
        "route": "/element/6650"
      },
      {
        "route": "/element/6647"
      },
      {
        "route": "/element/6645"
      },
      {
        "route": "/element/6642"
      },
      {
        "route": "/element/6640"
      },
      {
        "route": "/element/6638"
      },
      {
        "route": "/element/6635"
      },
      {
        "route": "/element/6633"
      },
      {
        "route": "/element/6630"
      },
      {
        "route": "/element/6628"
      },
      {
        "route": "/element/6624"
      },
      {
        "route": "/element/6622"
      },
      {
        "route": "/element/6620"
      },
      {
        "route": "/element/6618"
      },
      {
        "route": "/element/6616"
      },
      {
        "route": "/element/6614"
      },
      {
        "route": "/element/6612"
      },
      {
        "route": "/element/6609"
      },
      {
        "route": "/element/6607"
      },
      {
        "route": "/element/6605"
      },
      {
        "route": "/element/6603"
      },
      {
        "route": "/element/6600"
      },
      {
        "route": "/element/6597"
      },
      {
        "route": "/element/6595"
      },
      {
        "route": "/element/6593"
      },
      {
        "route": "/element/6588"
      },
      {
        "route": "/element/6586"
      },
      {
        "route": "/element/6584"
      },
      {
        "route": "/element/6582"
      },
      {
        "route": "/element/6580"
      },
      {
        "route": "/element/6578"
      },
      {
        "route": "/element/6575"
      },
      {
        "route": "/element/6573"
      },
      {
        "route": "/element/6570"
      },
      {
        "route": "/element/6566"
      },
      {
        "route": "/element/6564"
      },
      {
        "route": "/element/6562"
      },
      {
        "route": "/element/6560"
      },
      {
        "route": "/element/6558"
      },
      {
        "route": "/element/6556"
      },
      {
        "route": "/element/6553"
      },
      {
        "route": "/element/6551"
      },
      {
        "route": "/element/6548"
      },
      {
        "route": "/element/6546"
      },
      {
        "route": "/element/6543"
      },
      {
        "route": "/element/6541"
      },
      {
        "route": "/element/6538"
      },
      {
        "route": "/element/6535"
      },
      {
        "route": "/element/6532"
      },
      {
        "route": "/element/6529"
      },
      {
        "route": "/element/6526"
      },
      {
        "route": "/element/6523"
      },
      {
        "route": "/element/6520"
      },
      {
        "route": "/element/6517"
      },
      {
        "route": "/element/6514"
      },
      {
        "route": "/element/6512"
      },
      {
        "route": "/element/6510"
      },
      {
        "route": "/element/6508"
      },
      {
        "route": "/element/6506"
      },
      {
        "route": "/element/6504"
      },
      {
        "route": "/element/6502"
      },
      {
        "route": "/element/6500"
      },
      {
        "route": "/element/6497"
      },
      {
        "route": "/element/6495"
      },
      {
        "route": "/element/6493"
      },
      {
        "route": "/element/6491"
      },
      {
        "route": "/element/6489"
      },
      {
        "route": "/element/6487"
      },
      {
        "route": "/element/6483"
      },
      {
        "route": "/element/6481"
      },
      {
        "route": "/element/6479"
      },
      {
        "route": "/element/6477"
      },
      {
        "route": "/element/6475"
      },
      {
        "route": "/element/6473"
      },
      {
        "route": "/element/6471"
      },
      {
        "route": "/element/6469"
      },
      {
        "route": "/element/6467"
      },
      {
        "route": "/element/6465"
      },
      {
        "route": "/element/6463"
      },
      {
        "route": "/element/6460"
      },
      {
        "route": "/element/6458"
      },
      {
        "route": "/element/6456"
      },
      {
        "route": "/element/6454"
      },
      {
        "route": "/element/6452"
      },
      {
        "route": "/element/6450"
      },
      {
        "route": "/element/6448"
      },
      {
        "route": "/element/6446"
      },
      {
        "route": "/element/6444"
      },
      {
        "route": "/element/6442"
      },
      {
        "route": "/element/6440"
      },
      {
        "route": "/element/6436"
      },
      {
        "route": "/element/6434"
      },
      {
        "route": "/element/6430"
      },
      {
        "route": "/element/6427"
      },
      {
        "route": "/element/6425"
      },
      {
        "route": "/element/6422"
      },
      {
        "route": "/element/6420"
      },
      {
        "route": "/element/6418"
      },
      {
        "route": "/element/6416"
      },
      {
        "route": "/element/6414"
      },
      {
        "route": "/element/6412"
      },
      {
        "route": "/element/6410"
      },
      {
        "route": "/element/6408"
      },
      {
        "route": "/element/6406"
      },
      {
        "route": "/element/6404"
      },
      {
        "route": "/element/6402"
      },
      {
        "route": "/element/6400"
      },
      {
        "route": "/element/6398"
      },
      {
        "route": "/element/6396"
      },
      {
        "route": "/element/6394"
      },
      {
        "route": "/element/6392"
      },
      {
        "route": "/element/6390"
      },
      {
        "route": "/element/6388"
      },
      {
        "route": "/element/6385"
      },
      {
        "route": "/element/6383"
      },
      {
        "route": "/element/6380"
      },
      {
        "route": "/element/6378"
      },
      {
        "route": "/element/6376"
      },
      {
        "route": "/element/6373"
      },
      {
        "route": "/element/6371"
      },
      {
        "route": "/element/6368"
      },
      {
        "route": "/element/6365"
      },
      {
        "route": "/element/6363"
      },
      {
        "route": "/element/6361"
      },
      {
        "route": "/element/6359"
      },
      {
        "route": "/element/6357"
      },
      {
        "route": "/element/6355"
      },
      {
        "route": "/element/6353"
      },
      {
        "route": "/element/6351"
      },
      {
        "route": "/element/6349"
      },
      {
        "route": "/element/6347"
      },
      {
        "route": "/element/6344"
      },
      {
        "route": "/element/6342"
      },
      {
        "route": "/element/6340"
      },
      {
        "route": "/element/6338"
      },
      {
        "route": "/element/6335"
      },
      {
        "route": "/element/6333"
      },
      {
        "route": "/element/6331"
      },
      {
        "route": "/element/6329"
      },
      {
        "route": "/element/6327"
      },
      {
        "route": "/element/6325"
      },
      {
        "route": "/element/6322"
      },
      {
        "route": "/element/6320"
      },
      {
        "route": "/element/6318"
      },
      {
        "route": "/element/6316"
      },
      {
        "route": "/element/6314"
      },
      {
        "route": "/element/6311"
      },
      {
        "route": "/element/6309"
      },
      {
        "route": "/element/6307"
      },
      {
        "route": "/element/6305"
      },
      {
        "route": "/element/6303"
      },
      {
        "route": "/element/6301"
      },
      {
        "route": "/element/6289"
      },
      {
        "route": "/element/6287"
      },
      {
        "route": "/element/6285"
      },
      {
        "route": "/element/6283"
      },
      {
        "route": "/element/6281"
      },
      {
        "route": "/element/6279"
      },
      {
        "route": "/element/6277"
      },
      {
        "route": "/element/6275"
      },
      {
        "route": "/element/6273"
      },
      {
        "route": "/element/6271"
      },
      {
        "route": "/element/6269"
      },
      {
        "route": "/element/6267"
      },
      {
        "route": "/element/6265"
      },
      {
        "route": "/element/6263"
      },
      {
        "route": "/element/6261"
      },
      {
        "route": "/element/6259"
      },
      {
        "route": "/element/6256"
      },
      {
        "route": "/element/6254"
      },
      {
        "route": "/element/6252"
      },
      {
        "route": "/element/6250"
      },
      {
        "route": "/element/6248"
      },
      {
        "route": "/element/6246"
      },
      {
        "route": "/element/6244"
      },
      {
        "route": "/element/6242"
      },
      {
        "route": "/element/6240"
      },
      {
        "route": "/element/6238"
      },
      {
        "route": "/element/6236"
      },
      {
        "route": "/element/6234"
      },
      {
        "route": "/element/6232"
      },
      {
        "route": "/element/6229"
      },
      {
        "route": "/element/6227"
      },
      {
        "route": "/element/6224"
      },
      {
        "route": "/element/6222"
      },
      {
        "route": "/element/6220"
      },
      {
        "route": "/element/6218"
      },
      {
        "route": "/element/6216"
      },
      {
        "route": "/element/6214"
      },
      {
        "route": "/element/6212"
      },
      {
        "route": "/element/6210"
      },
      {
        "route": "/element/6208"
      },
      {
        "route": "/element/6206"
      },
      {
        "route": "/element/6204"
      },
      {
        "route": "/element/6202"
      },
      {
        "route": "/element/6200"
      },
      {
        "route": "/element/6197"
      },
      {
        "route": "/element/6195"
      },
      {
        "route": "/element/6193"
      },
      {
        "route": "/element/6191"
      },
      {
        "route": "/element/6188"
      },
      {
        "route": "/element/6186"
      },
      {
        "route": "/element/6184"
      },
      {
        "route": "/element/6182"
      },
      {
        "route": "/element/6180"
      },
      {
        "route": "/element/6176"
      },
      {
        "route": "/element/6173"
      },
      {
        "route": "/element/6170"
      },
      {
        "route": "/element/6168"
      },
      {
        "route": "/element/6166"
      },
      {
        "route": "/element/6164"
      },
      {
        "route": "/element/6162"
      },
      {
        "route": "/element/6160"
      },
      {
        "route": "/element/6158"
      },
      {
        "route": "/element/6153"
      },
      {
        "route": "/element/6151"
      },
      {
        "route": "/element/6149"
      },
      {
        "route": "/element/6147"
      },
      {
        "route": "/element/6145"
      },
      {
        "route": "/element/6143"
      },
      {
        "route": "/element/6141"
      },
      {
        "route": "/element/6139"
      },
      {
        "route": "/element/6137"
      },
      {
        "route": "/element/6135"
      },
      {
        "route": "/element/6133"
      },
      {
        "route": "/element/6131"
      },
      {
        "route": "/element/6129"
      },
      {
        "route": "/element/6127"
      },
      {
        "route": "/element/6124"
      },
      {
        "route": "/element/6121"
      },
      {
        "route": "/element/6118"
      },
      {
        "route": "/element/6116"
      },
      {
        "route": "/element/6114"
      },
      {
        "route": "/element/6112"
      },
      {
        "route": "/element/6110"
      },
      {
        "route": "/element/6106"
      },
      {
        "route": "/element/6104"
      },
      {
        "route": "/element/6101"
      },
      {
        "route": "/element/6096"
      },
      {
        "route": "/element/6094"
      },
      {
        "route": "/element/6092"
      },
      {
        "route": "/element/6089"
      },
      {
        "route": "/element/6087"
      },
      {
        "route": "/element/6085"
      },
      {
        "route": "/element/6082"
      },
      {
        "route": "/element/6080"
      },
      {
        "route": "/element/6075"
      },
      {
        "route": "/element/6073"
      },
      {
        "route": "/element/6071"
      },
      {
        "route": "/element/6069"
      },
      {
        "route": "/element/6067"
      },
      {
        "route": "/element/6065"
      },
      {
        "route": "/element/6063"
      },
      {
        "route": "/element/6061"
      },
      {
        "route": "/element/6059"
      },
      {
        "route": "/element/6057"
      },
      {
        "route": "/element/6055"
      },
      {
        "route": "/element/6052"
      },
      {
        "route": "/element/6050"
      },
      {
        "route": "/element/6048"
      },
      {
        "route": "/element/6046"
      },
      {
        "route": "/element/6044"
      },
      {
        "route": "/element/6042"
      },
      {
        "route": "/element/6039"
      },
      {
        "route": "/element/6037"
      },
      {
        "route": "/element/6035"
      },
      {
        "route": "/element/6033"
      },
      {
        "route": "/element/6031"
      },
      {
        "route": "/element/6028"
      },
      {
        "route": "/element/6026"
      },
      {
        "route": "/element/6024"
      },
      {
        "route": "/element/6022"
      },
      {
        "route": "/element/6020"
      },
      {
        "route": "/element/6017"
      },
      {
        "route": "/element/6015"
      },
      {
        "route": "/element/6013"
      },
      {
        "route": "/element/6011"
      },
      {
        "route": "/element/6009"
      },
      {
        "route": "/element/6004"
      },
      {
        "route": "/element/6002"
      },
      {
        "route": "/element/6000"
      },
      {
        "route": "/element/5998"
      },
      {
        "route": "/element/5989"
      },
      {
        "route": "/element/5987"
      },
      {
        "route": "/element/5985"
      },
      {
        "route": "/element/5983"
      },
      {
        "route": "/element/5981"
      },
      {
        "route": "/element/5979"
      },
      {
        "route": "/element/5976"
      },
      {
        "route": "/element/5974"
      },
      {
        "route": "/element/5964"
      },
      {
        "route": "/element/5962"
      },
      {
        "route": "/element/5960"
      },
      {
        "route": "/element/5958"
      },
      {
        "route": "/element/5956"
      },
      {
        "route": "/element/5954"
      },
      {
        "route": "/element/5952"
      },
      {
        "route": "/element/5950"
      },
      {
        "route": "/element/5948"
      },
      {
        "route": "/element/5946"
      },
      {
        "route": "/element/5944"
      },
      {
        "route": "/element/5942"
      },
      {
        "route": "/element/5940"
      },
      {
        "route": "/element/5937"
      },
      {
        "route": "/element/5935"
      },
      {
        "route": "/element/5933"
      },
      {
        "route": "/element/5931"
      },
      {
        "route": "/element/5929"
      },
      {
        "route": "/element/5927"
      },
      {
        "route": "/element/5925"
      },
      {
        "route": "/element/5922"
      },
      {
        "route": "/element/5920"
      },
      {
        "route": "/element/5918"
      },
      {
        "route": "/element/5916"
      },
      {
        "route": "/element/5914"
      },
      {
        "route": "/element/5912"
      },
      {
        "route": "/element/5910"
      },
      {
        "route": "/element/5908"
      },
      {
        "route": "/element/5906"
      },
      {
        "route": "/element/5904"
      },
      {
        "route": "/element/5902"
      },
      {
        "route": "/element/5900"
      },
      {
        "route": "/element/5896"
      },
      {
        "route": "/element/5894"
      },
      {
        "route": "/element/5891"
      },
      {
        "route": "/element/5889"
      },
      {
        "route": "/element/5887"
      },
      {
        "route": "/element/5885"
      },
      {
        "route": "/element/5883"
      },
      {
        "route": "/element/5881"
      },
      {
        "route": "/element/5879"
      },
      {
        "route": "/element/5877"
      },
      {
        "route": "/element/5875"
      },
      {
        "route": "/element/5873"
      },
      {
        "route": "/element/5871"
      },
      {
        "route": "/element/5869"
      },
      {
        "route": "/element/5866"
      },
      {
        "route": "/element/5864"
      },
      {
        "route": "/element/5862"
      },
      {
        "route": "/element/5860"
      },
      {
        "route": "/element/5858"
      },
      {
        "route": "/element/5856"
      },
      {
        "route": "/element/5853"
      },
      {
        "route": "/element/5851"
      },
      {
        "route": "/element/5849"
      },
      {
        "route": "/element/5847"
      },
      {
        "route": "/element/5845"
      },
      {
        "route": "/element/5843"
      },
      {
        "route": "/element/5840"
      },
      {
        "route": "/element/5838"
      },
      {
        "route": "/element/5836"
      },
      {
        "route": "/element/5834"
      },
      {
        "route": "/element/5832"
      },
      {
        "route": "/element/5830"
      },
      {
        "route": "/element/5828"
      },
      {
        "route": "/element/5825"
      },
      {
        "route": "/element/5823"
      },
      {
        "route": "/element/5821"
      },
      {
        "route": "/element/5819"
      },
      {
        "route": "/element/5817"
      },
      {
        "route": "/element/5815"
      },
      {
        "route": "/element/5812"
      },
      {
        "route": "/element/5811"
      },
      {
        "route": "/element/5809"
      },
      {
        "route": "/element/5807"
      },
      {
        "route": "/element/5805"
      },
      {
        "route": "/element/5803"
      },
      {
        "route": "/element/5800"
      },
      {
        "route": "/element/5798"
      },
      {
        "route": "/element/5796"
      },
      {
        "route": "/element/5794"
      },
      {
        "route": "/element/5792"
      },
      {
        "route": "/element/5790"
      },
      {
        "route": "/element/5788"
      },
      {
        "route": "/element/5786"
      },
      {
        "route": "/element/5784"
      },
      {
        "route": "/element/5782"
      },
      {
        "route": "/element/5780"
      },
      {
        "route": "/element/5778"
      },
      {
        "route": "/element/5776"
      },
      {
        "route": "/element/5774"
      },
      {
        "route": "/element/5772"
      },
      {
        "route": "/element/5770"
      },
      {
        "route": "/element/5767"
      },
      {
        "route": "/element/5765"
      },
      {
        "route": "/element/5762"
      },
      {
        "route": "/element/5760"
      },
      {
        "route": "/element/5758"
      },
      {
        "route": "/element/5756"
      },
      {
        "route": "/element/5753"
      },
      {
        "route": "/element/5751"
      },
      {
        "route": "/element/5749"
      },
      {
        "route": "/element/5747"
      },
      {
        "route": "/element/5743"
      },
      {
        "route": "/element/5741"
      },
      {
        "route": "/element/5739"
      },
      {
        "route": "/element/5737"
      },
      {
        "route": "/element/5735"
      },
      {
        "route": "/element/5731"
      },
      {
        "route": "/element/5729"
      },
      {
        "route": "/element/5727"
      },
      {
        "route": "/element/5725"
      },
      {
        "route": "/element/5723"
      },
      {
        "route": "/element/5721"
      },
      {
        "route": "/element/5719"
      },
      {
        "route": "/element/5717"
      },
      {
        "route": "/element/5715"
      },
      {
        "route": "/element/5713"
      },
      {
        "route": "/element/5711"
      },
      {
        "route": "/element/5709"
      },
      {
        "route": "/element/5707"
      },
      {
        "route": "/element/5705"
      },
      {
        "route": "/element/5703"
      },
      {
        "route": "/element/5701"
      },
      {
        "route": "/element/5699"
      },
      {
        "route": "/element/5697"
      },
      {
        "route": "/element/5693"
      },
      {
        "route": "/element/5691"
      },
      {
        "route": "/element/5689"
      },
      {
        "route": "/element/5687"
      },
      {
        "route": "/element/5685"
      },
      {
        "route": "/element/5683"
      },
      {
        "route": "/element/5681"
      },
      {
        "route": "/element/5679"
      },
      {
        "route": "/element/5677"
      },
      {
        "route": "/element/5673"
      },
      {
        "route": "/element/5671"
      },
      {
        "route": "/element/5669"
      },
      {
        "route": "/element/5667"
      },
      {
        "route": "/element/5665"
      },
      {
        "route": "/element/5663"
      },
      {
        "route": "/element/5660"
      },
      {
        "route": "/element/5658"
      },
      {
        "route": "/element/5656"
      },
      {
        "route": "/element/5654"
      },
      {
        "route": "/element/5650"
      },
      {
        "route": "/element/5648"
      },
      {
        "route": "/element/5646"
      },
      {
        "route": "/element/5644"
      },
      {
        "route": "/element/5640"
      },
      {
        "route": "/element/5638"
      },
      {
        "route": "/element/5636"
      },
      {
        "route": "/element/5629"
      },
      {
        "route": "/element/5627"
      },
      {
        "route": "/element/5623"
      },
      {
        "route": "/element/5618"
      },
      {
        "route": "/element/5616"
      },
      {
        "route": "/element/5614"
      },
      {
        "route": "/element/5612"
      },
      {
        "route": "/element/5610"
      },
      {
        "route": "/element/5607"
      },
      {
        "route": "/element/5602"
      },
      {
        "route": "/element/5600"
      },
      {
        "route": "/element/5598"
      },
      {
        "route": "/element/5596"
      },
      {
        "route": "/element/5594"
      },
      {
        "route": "/element/5592"
      },
      {
        "route": "/element/5590"
      },
      {
        "route": "/element/5588"
      },
      {
        "route": "/element/5586"
      },
      {
        "route": "/element/5584"
      },
      {
        "route": "/element/5582"
      },
      {
        "route": "/element/5580"
      },
      {
        "route": "/element/5578"
      },
      {
        "route": "/element/5576"
      },
      {
        "route": "/element/5574"
      },
      {
        "route": "/element/5572"
      },
      {
        "route": "/element/5570"
      },
      {
        "route": "/element/5568"
      },
      {
        "route": "/element/5566"
      },
      {
        "route": "/element/5564"
      },
      {
        "route": "/element/5562"
      },
      {
        "route": "/element/5560"
      },
      {
        "route": "/element/5556"
      },
      {
        "route": "/element/5554"
      },
      {
        "route": "/element/5552"
      },
      {
        "route": "/element/5550"
      },
      {
        "route": "/element/5548"
      },
      {
        "route": "/element/5546"
      },
      {
        "route": "/element/5543"
      },
      {
        "route": "/element/5540"
      },
      {
        "route": "/element/5538"
      },
      {
        "route": "/element/5536"
      },
      {
        "route": "/element/5534"
      },
      {
        "route": "/element/5532"
      },
      {
        "route": "/element/5530"
      },
      {
        "route": "/element/5528"
      },
      {
        "route": "/element/5526"
      },
      {
        "route": "/element/5524"
      },
      {
        "route": "/element/5522"
      },
      {
        "route": "/element/5519"
      },
      {
        "route": "/element/5517"
      },
      {
        "route": "/element/5515"
      },
      {
        "route": "/element/5513"
      },
      {
        "route": "/element/5511"
      },
      {
        "route": "/element/5509"
      },
      {
        "route": "/element/5507"
      },
      {
        "route": "/element/5504"
      },
      {
        "route": "/element/5502"
      },
      {
        "route": "/element/5500"
      },
      {
        "route": "/element/5498"
      },
      {
        "route": "/element/5496"
      },
      {
        "route": "/element/5494"
      },
      {
        "route": "/element/5492"
      },
      {
        "route": "/element/5490"
      },
      {
        "route": "/element/5138"
      },
      {
        "route": "/element/5135"
      },
      {
        "route": "/element/5132"
      },
      {
        "route": "/element/5130"
      },
      {
        "route": "/element/5127"
      },
      {
        "route": "/element/5125"
      },
      {
        "route": "/element/5122"
      },
      {
        "route": "/element/5118"
      },
      {
        "route": "/element/5116"
      },
      {
        "route": "/element/5114"
      },
      {
        "route": "/element/5111"
      },
      {
        "route": "/element/5105"
      },
      {
        "route": "/element/5102"
      },
      {
        "route": "/element/5099"
      },
      {
        "route": "/element/5097"
      },
      {
        "route": "/element/5095"
      },
      {
        "route": "/element/5093"
      },
      {
        "route": "/element/5090"
      },
      {
        "route": "/element/5088"
      },
      {
        "route": "/element/5083"
      },
      {
        "route": "/element/5007"
      },
      {
        "route": "/element/5005"
      },
      {
        "route": "/element/5003"
      },
      {
        "route": "/element/5001"
      },
      {
        "route": "/element/4999"
      },
      {
        "route": "/element/4997"
      },
      {
        "route": "/element/4995"
      },
      {
        "route": "/element/4993"
      },
      {
        "route": "/element/4989"
      },
      {
        "route": "/element/4987"
      },
      {
        "route": "/element/4985"
      },
      {
        "route": "/element/4983"
      },
      {
        "route": "/element/4981"
      },
      {
        "route": "/element/4979"
      },
      {
        "route": "/element/4975"
      },
      {
        "route": "/element/4973"
      },
      {
        "route": "/element/4969"
      },
      {
        "route": "/element/4966"
      },
      {
        "route": "/element/4964"
      },
      {
        "route": "/element/4957"
      },
      {
        "route": "/element/4952"
      },
      {
        "route": "/element/4948"
      },
      {
        "route": "/element/4518"
      },
      {
        "route": "/element/4516"
      },
      {
        "route": "/element/4514"
      },
      {
        "route": "/element/4512"
      },
      {
        "route": "/element/4510"
      },
      {
        "route": "/element/4508"
      },
      {
        "route": "/element/4506"
      },
      {
        "route": "/element/4504"
      },
      {
        "route": "/element/4501"
      },
      {
        "route": "/element/4499"
      },
      {
        "route": "/element/4497"
      },
      {
        "route": "/element/4495"
      },
      {
        "route": "/element/4493"
      },
      {
        "route": "/element/4402"
      },
      {
        "route": "/element/4400"
      },
      {
        "route": "/element/4398"
      },
      {
        "route": "/news/4412"
      }
    ]
  },
  "generate": {
    "fallback": true,
    "interval": 0,
    "routes": [],
    "exclude": [
      "/element",
      "/questions",
      "/news",
      "/post",
      "/study",
      "/",
      "/element/7241",
      "/element/7239",
      "/element/7237",
      "/element/7235",
      "/element/7232",
      "/element/7230",
      "/element/7228",
      "/element/7226",
      "/element/7224",
      "/element/7222",
      "/element/7220",
      "/element/7218",
      "/element/7216",
      "/element/7213",
      "/element/7211",
      "/element/7208",
      "/element/7205",
      "/element/7203",
      "/element/7201",
      "/element/7199",
      "/element/7197",
      "/element/7195",
      "/element/7193",
      "/element/7191",
      "/element/7189",
      "/element/7187",
      "/element/7185",
      "/element/7183",
      "/element/7181",
      "/element/7178",
      "/element/7176",
      "/element/7173",
      "/element/7171",
      "/element/7169",
      "/element/7167",
      "/element/7165",
      "/element/7163",
      "/element/7160",
      "/element/7157",
      "/element/7154",
      "/element/7151",
      "/element/7148",
      "/element/7145",
      "/element/7142",
      "/element/7140",
      "/element/7137",
      "/element/7135",
      "/element/7133",
      "/element/7131",
      "/element/7129",
      "/element/7127",
      "/element/7125",
      "/element/7119",
      "/element/7114",
      "/element/7108",
      "/element/7105",
      "/element/7101",
      "/element/7098",
      "/element/7096",
      "/element/7093",
      "/element/7090",
      "/element/7088",
      "/element/7080",
      "/element/7077",
      "/element/7036",
      "/element/7034",
      "/element/7029",
      "/element/7026",
      "/element/7023",
      "/element/7021",
      "/element/7019",
      "/element/7016",
      "/element/7014",
      "/element/7012",
      "/element/7010",
      "/element/7007",
      "/element/7004",
      "/element/7000",
      "/element/6996",
      "/element/6993",
      "/element/6989",
      "/element/6987",
      "/element/6984",
      "/element/6871",
      "/element/6869",
      "/element/6867",
      "/element/6865",
      "/element/6863",
      "/element/6858",
      "/element/6856",
      "/element/6854",
      "/element/6852",
      "/element/6850",
      "/element/6848",
      "/element/6846",
      "/element/6844",
      "/element/6842",
      "/element/6840",
      "/element/6838",
      "/element/6835",
      "/element/6833",
      "/element/6831",
      "/element/6829",
      "/element/6826",
      "/element/6824",
      "/element/6822",
      "/element/6819",
      "/element/6816",
      "/element/6814",
      "/element/6812",
      "/element/6809",
      "/element/6807",
      "/element/6802",
      "/element/6800",
      "/element/6796",
      "/element/6794",
      "/element/6792",
      "/element/6789",
      "/element/6787",
      "/element/6785",
      "/element/6783",
      "/element/6780",
      "/element/6777",
      "/element/6774",
      "/element/6772",
      "/element/6769",
      "/element/6767",
      "/element/6765",
      "/element/6762",
      "/element/6760",
      "/element/6758",
      "/element/6756",
      "/element/6754",
      "/element/6752",
      "/element/6750",
      "/element/6748",
      "/element/6746",
      "/element/6743",
      "/element/6740",
      "/element/6737",
      "/element/6735",
      "/element/6733",
      "/element/6731",
      "/element/6728",
      "/element/6725",
      "/element/6723",
      "/element/6720",
      "/element/6718",
      "/element/6715",
      "/element/6713",
      "/element/6711",
      "/element/6709",
      "/element/6707",
      "/element/6705",
      "/element/6703",
      "/element/6701",
      "/element/6698",
      "/element/6695",
      "/element/6692",
      "/element/6690",
      "/element/6688",
      "/element/6686",
      "/element/6683",
      "/element/6679",
      "/element/6676",
      "/element/6672",
      "/element/6669",
      "/element/6666",
      "/element/6663",
      "/element/6661",
      "/element/6659",
      "/element/6657",
      "/element/6654",
      "/element/6652",
      "/element/6650",
      "/element/6647",
      "/element/6645",
      "/element/6642",
      "/element/6640",
      "/element/6638",
      "/element/6635",
      "/element/6633",
      "/element/6630",
      "/element/6628",
      "/element/6624",
      "/element/6622",
      "/element/6620",
      "/element/6618",
      "/element/6616",
      "/element/6614",
      "/element/6612",
      "/element/6609",
      "/element/6607",
      "/element/6605",
      "/element/6603",
      "/element/6600",
      "/element/6597",
      "/element/6595",
      "/element/6593",
      "/element/6588",
      "/element/6586",
      "/element/6584",
      "/element/6582",
      "/element/6580",
      "/element/6578",
      "/element/6575",
      "/element/6573",
      "/element/6570",
      "/element/6566",
      "/element/6564",
      "/element/6562",
      "/element/6560",
      "/element/6558",
      "/element/6556",
      "/element/6553",
      "/element/6551",
      "/element/6548",
      "/element/6546",
      "/element/6543",
      "/element/6541",
      "/element/6538",
      "/element/6535",
      "/element/6532",
      "/element/6529",
      "/element/6526",
      "/element/6523",
      "/element/6520",
      "/element/6517",
      "/element/6514",
      "/element/6512",
      "/element/6510",
      "/element/6508",
      "/element/6506",
      "/element/6504",
      "/element/6502",
      "/element/6500",
      "/element/6497",
      "/element/6495",
      "/element/6493",
      "/element/6491",
      "/element/6489",
      "/element/6487",
      "/element/6483",
      "/element/6481",
      "/element/6479",
      "/element/6477",
      "/element/6475",
      "/element/6473",
      "/element/6471",
      "/element/6469",
      "/element/6467",
      "/element/6465",
      "/element/6463",
      "/element/6460",
      "/element/6458",
      "/element/6456",
      "/element/6454",
      "/element/6452",
      "/element/6450",
      "/element/6448",
      "/element/6446",
      "/element/6444",
      "/element/6442",
      "/element/6440",
      "/element/6436",
      "/element/6434",
      "/element/6430",
      "/element/6427",
      "/element/6425",
      "/element/6422",
      "/element/6420",
      "/element/6418",
      "/element/6416",
      "/element/6414",
      "/element/6412",
      "/element/6410",
      "/element/6408",
      "/element/6406",
      "/element/6404",
      "/element/6402",
      "/element/6400",
      "/element/6398",
      "/element/6396",
      "/element/6394",
      "/element/6392",
      "/element/6390",
      "/element/6388",
      "/element/6385",
      "/element/6383",
      "/element/6380",
      "/element/6378",
      "/element/6376",
      "/element/6373",
      "/element/6371",
      "/element/6368",
      "/element/6365",
      "/element/6363",
      "/element/6361",
      "/element/6359",
      "/element/6357",
      "/element/6355",
      "/element/6353",
      "/element/6351",
      "/element/6349",
      "/element/6347",
      "/element/6344",
      "/element/6342",
      "/element/6340",
      "/element/6338",
      "/element/6335",
      "/element/6333",
      "/element/6331",
      "/element/6329",
      "/element/6327",
      "/element/6325",
      "/element/6322",
      "/element/6320",
      "/element/6318",
      "/element/6316",
      "/element/6314",
      "/element/6311",
      "/element/6309",
      "/element/6307",
      "/element/6305",
      "/element/6303",
      "/element/6301",
      "/element/6289",
      "/element/6287",
      "/element/6285",
      "/element/6283",
      "/element/6281",
      "/element/6279",
      "/element/6277",
      "/element/6275",
      "/element/6273",
      "/element/6271",
      "/element/6269",
      "/element/6267",
      "/element/6265",
      "/element/6263",
      "/element/6261",
      "/element/6259",
      "/element/6256",
      "/element/6254",
      "/element/6252",
      "/element/6250",
      "/element/6248",
      "/element/6246",
      "/element/6244",
      "/element/6242",
      "/element/6240",
      "/element/6238",
      "/element/6236",
      "/element/6234",
      "/element/6232",
      "/element/6229",
      "/element/6227",
      "/element/6224",
      "/element/6222",
      "/element/6220",
      "/element/6218",
      "/element/6216",
      "/element/6214",
      "/element/6212",
      "/element/6210",
      "/element/6208",
      "/element/6206",
      "/element/6204",
      "/element/6202",
      "/element/6200",
      "/element/6197",
      "/element/6195",
      "/element/6193",
      "/element/6191",
      "/element/6188",
      "/element/6186",
      "/element/6184",
      "/element/6182",
      "/element/6180",
      "/element/6176",
      "/element/6173",
      "/element/6170",
      "/element/6168",
      "/element/6166",
      "/element/6164",
      "/element/6162",
      "/element/6160",
      "/element/6158",
      "/element/6153",
      "/element/6151",
      "/element/6149",
      "/element/6147",
      "/element/6145",
      "/element/6143",
      "/element/6141",
      "/element/6139",
      "/element/6137",
      "/element/6135",
      "/element/6133",
      "/element/6131",
      "/element/6129",
      "/element/6127",
      "/element/6124",
      "/element/6121",
      "/element/6118",
      "/element/6116",
      "/element/6114",
      "/element/6112",
      "/element/6110",
      "/element/6106",
      "/element/6104",
      "/element/6101",
      "/element/6096",
      "/element/6094",
      "/element/6092",
      "/element/6089",
      "/element/6087",
      "/element/6085",
      "/element/6082",
      "/element/6080",
      "/element/6075",
      "/element/6073",
      "/element/6071",
      "/element/6069",
      "/element/6067",
      "/element/6065",
      "/element/6063",
      "/element/6061",
      "/element/6059",
      "/element/6057",
      "/element/6055",
      "/element/6052",
      "/element/6050",
      "/element/6048",
      "/element/6046",
      "/element/6044",
      "/element/6042",
      "/element/6039",
      "/element/6037",
      "/element/6035",
      "/element/6033",
      "/element/6031",
      "/element/6028",
      "/element/6026",
      "/element/6024",
      "/element/6022",
      "/element/6020",
      "/element/6017",
      "/element/6015",
      "/element/6013",
      "/element/6011",
      "/element/6009",
      "/element/6004",
      "/element/6002",
      "/element/6000",
      "/element/5998",
      "/element/5989",
      "/element/5987",
      "/element/5985",
      "/element/5983",
      "/element/5981",
      "/element/5979",
      "/element/5976",
      "/element/5974",
      "/element/5964",
      "/element/5962",
      "/element/5960",
      "/element/5958",
      "/element/5956",
      "/element/5954",
      "/element/5952",
      "/element/5950",
      "/element/5948",
      "/element/5946",
      "/element/5944",
      "/element/5942",
      "/element/5940",
      "/element/5937",
      "/element/5935",
      "/element/5933",
      "/element/5931",
      "/element/5929",
      "/element/5927",
      "/element/5925",
      "/element/5922",
      "/element/5920",
      "/element/5918",
      "/element/5916",
      "/element/5914",
      "/element/5912",
      "/element/5910",
      "/element/5908",
      "/element/5906",
      "/element/5904",
      "/element/5902",
      "/element/5900",
      "/element/5896",
      "/element/5894",
      "/element/5891",
      "/element/5889",
      "/element/5887",
      "/element/5885",
      "/element/5883",
      "/element/5881",
      "/element/5879",
      "/element/5877",
      "/element/5875",
      "/element/5873",
      "/element/5871",
      "/element/5869",
      "/element/5866",
      "/element/5864",
      "/element/5862",
      "/element/5860",
      "/element/5858",
      "/element/5856",
      "/element/5853",
      "/element/5851",
      "/element/5849",
      "/element/5847",
      "/element/5845",
      "/element/5843",
      "/element/5840",
      "/element/5838",
      "/element/5836",
      "/element/5834",
      "/element/5832",
      "/element/5830",
      "/element/5828",
      "/element/5825",
      "/element/5823",
      "/element/5821",
      "/element/5819",
      "/element/5817",
      "/element/5815",
      "/element/5812",
      "/element/5811",
      "/element/5809",
      "/element/5807",
      "/element/5805",
      "/element/5803",
      "/element/5800",
      "/element/5798",
      "/element/5796",
      "/element/5794",
      "/element/5792",
      "/element/5790",
      "/element/5788",
      "/element/5786",
      "/element/5784",
      "/element/5782",
      "/element/5780",
      "/element/5778",
      "/element/5776",
      "/element/5774",
      "/element/5772",
      "/element/5770",
      "/element/5767",
      "/element/5765",
      "/element/5762",
      "/element/5760",
      "/element/5758",
      "/element/5756",
      "/element/5753",
      "/element/5751",
      "/element/5749",
      "/element/5747",
      "/element/5743",
      "/element/5741",
      "/element/5739",
      "/element/5737",
      "/element/5735",
      "/element/5731",
      "/element/5729",
      "/element/5727",
      "/element/5725",
      "/element/5723",
      "/element/5721",
      "/element/5719",
      "/element/5717",
      "/element/5715",
      "/element/5713",
      "/element/5711",
      "/element/5709",
      "/element/5707",
      "/element/5705",
      "/element/5703",
      "/element/5701",
      "/element/5699",
      "/element/5697",
      "/element/5693",
      "/element/5691",
      "/element/5689",
      "/element/5687",
      "/element/5685",
      "/element/5683",
      "/element/5681",
      "/element/5679",
      "/element/5677",
      "/element/5673",
      "/element/5671",
      "/element/5669",
      "/element/5667",
      "/element/5665",
      "/element/5663",
      "/element/5660",
      "/element/5658",
      "/element/5656",
      "/element/5654",
      "/element/5650",
      "/element/5648",
      "/element/5646",
      "/element/5644",
      "/element/5640",
      "/element/5638",
      "/element/5636",
      "/element/5629",
      "/element/5627",
      "/element/5623",
      "/element/5618",
      "/element/5616",
      "/element/5614",
      "/element/5612",
      "/element/5610",
      "/element/5607",
      "/element/5602",
      "/element/5600",
      "/element/5598",
      "/element/5596",
      "/element/5594",
      "/element/5592",
      "/element/5590",
      "/element/5588",
      "/element/5586",
      "/element/5584",
      "/element/5582",
      "/element/5580",
      "/element/5578",
      "/element/5576",
      "/element/5574",
      "/element/5572",
      "/element/5570",
      "/element/5568",
      "/element/5566",
      "/element/5564",
      "/element/5562",
      "/element/5560",
      "/element/5556",
      "/element/5554",
      "/element/5552",
      "/element/5550",
      "/element/5548",
      "/element/5546",
      "/element/5543",
      "/element/5540",
      "/element/5538",
      "/element/5536",
      "/element/5534",
      "/element/5532",
      "/element/5530",
      "/element/5528",
      "/element/5526",
      "/element/5524",
      "/element/5522",
      "/element/5519",
      "/element/5517",
      "/element/5515",
      "/element/5513",
      "/element/5511",
      "/element/5509",
      "/element/5507",
      "/element/5504",
      "/element/5502",
      "/element/5500",
      "/element/5498",
      "/element/5496",
      "/element/5494",
      "/element/5492",
      "/element/5490",
      "/element/5138",
      "/element/5135",
      "/element/5132",
      "/element/5130",
      "/element/5127",
      "/element/5125",
      "/element/5122",
      "/element/5118",
      "/element/5116",
      "/element/5114",
      "/element/5111",
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
      "/post/7045",
      "/post/6860",
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
      "/post/849",
      "/post/793",
      "/post/725",
      "/post/541",
      "/post/201",
      "/post/131",
      "/post/86",
      "/post/82",
      "/post/78",
      "/post/66",
      "/post/44",
      "/post/27",
      "/post/1123",
      "/post/1089",
      "/post/1028",
      "/post/994",
      "/post/961",
      "/post/949",
      "/post/927",
      "/post/876"
    ]
  }
}