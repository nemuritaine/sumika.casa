<template>
  <div :class="`c-button--${modifier}`">
    <span v-if="ja" class="c-buttonTextJa">{{ ja }}</span>
    <span v-if="en" class="c-buttonTextEn">{{ en }}</span>
    <span v-if="icon" class="c-buttonIcon">
      <span class="c-buttonIconCircle">
        <svg>
          <use :xlink:href="`/assets/images/common/graphics.svg#ico_button_${ icon }`"></use>
        </svg>
      </span>
    </span>
  </div>
</template>

<script setup lang="ts">
  const props = defineProps<{
    modifier?: string, // ?なのでrequired: falseと同じ
    ja?: string,
    en?: string,
    icon?: string
  }>()
</script>

<style lang="scss">
  .c-button {
    $this: &;

    // .c-button--primary
    &--primary {
      background-color: color(assort);
      color: color(white);
      max-width: 320px;
      width: 100%;
      padding-left: calc(11px + rem(64));
      padding-right: rem(64);
      height: rem(84);
      border-radius: rem(42);
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;

      // .c-button--primary .c-buttonTextJa
      #{$this}TextJa {
        
      }

      // .c-button--primary .c-buttonIcon
      #{$this}Icon {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        display: flex;
        align-items: center;
        justify-content: center;
        width: rem(64);
        height: rem(64);
        border-radius: 50%;
        background-color: color(main);
        color: color(main);

        // .c-button--primary .c-buttonIcon::before
        &Circle {
          display: flex;
          align-items: center;
          justify-content: center;
          width: rem(48);
          height: rem(48);
          background-color: color(white);
          border: rem(6) solid color(assort);
          border-radius: 50%;
        }

        // .c-button--primary .c-buttonIcon svg
        svg {
          position: relative;
          width: rem(32);
          height: rem(32);
          z-index: 20;
        }
      }
    }
    &--secondary {

    }

    // .c-button--tertiary
    &--tertiary {
      padding-bottom: rem(41);
      position: relative;
      display: inline-block;

      // .c-button--tertiary .c-buttonIcon
      #{$this}Icon {
        color: color(main);
        background-color: color(main);
        width: rem(140);
        height: rem(140);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;

        // .c-button--tertiary .c-buttonIconCircle
        &Circle {
          background-color: color(white);
          display: flex;
          justify-content: center;
          align-items: center;
          width: rem(96);
          height: rem(96);
          border-radius: 50%;
          border: rem(8) solid color(assort);
        }

        // .c-button--tertiary .c-buttonIcon svg
        svg {
          position: relative;
          width: rem(32);
          height: rem(32);
          z-index: 20;
        }
      }

      // .c-button--tertiary .c-buttonTextJa
      #{$this}TextJa {
        display: inline-block;
        @include font(16, 24, 40, 700);
        color: color(white);
        position: absolute;
        text-align: center;
        margin-top: rem(16);
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        white-space: nowrap;
        padding-bottom: rem(2);

        // .c-button--tertiary .c-buttonTextJa::before
        &::before {
          content: '';
          display: block;
          position: absolute;
          width: 100%;
          height: rem(2);
          border-radius: rem(1);
          background-color: color(white);
          bottom: 0;
          left: 50%;
          transform: translateX(-50%);
        }
      }
    }
  }
</style>