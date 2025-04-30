<template>
  <div class="border rounded border-gray-200 bg-white">
    <div class="py-3 px-4 border-b flex justify-between items-center" v-if="this.$slots.title">
      <h2 class="text-lg font-medium text-gray-700">
        <slot name="title"></slot>
      </h2>
    </div>
    <div class="p-4 text-gray-600">
      <slot name="content">
        Card Inhalt
      </slot>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Card',
}
</script>
