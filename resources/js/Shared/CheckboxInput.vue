<template>
  <div :class="$attrs.class">
    <label :for="id">
      <input :id="id" :name="name"  :value="value" :checked="checked" @input="$emit('update:modelValue', $event.target.value)" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6 cursor-pointer" type="checkbox" value="" id="flexCheckDefault">
      <span>{{ label }}</span>
    </label>
  </div>
</template>

<script>
import {v4 as uuid} from 'uuid'

export default {
  name: 'CheckboxInput',
  props: {
    id: {
      type: [String],
      default() {
        return `text-input-${uuid()}`
      },
    },
    checked: {
      type: [Boolean],
      default() {
        return false
      },
    },
    label: String,
    name: String,
    value: String,
  },
  emits: ['update:modelValue'],
}
</script>

<style scoped>

</style>
