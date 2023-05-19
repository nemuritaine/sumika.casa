<template>
  <div :class="`c-sticker${ name }`">
    <a :class="`c-sticker${ name }__link`" :href="`${ href }`" :target="`${ target }`">
      <img :src="`/assets/images/sticker/${ name }.svg`" :alt="`${ name }`" :width="`${ width }`" :height="`${ height }`">
    </a>
  </div>
</template>

<script setup lang="ts">
  const props = defineProps<{
    name?: string, // ?なのでrequired: falseと同じ
    href?: string,
    width?: string,
    height?: string,
    target?: string
  }>()
</script>