<template>
  <div :class="$attrs.class">
    <label class="checkbox" :for="id">
      <input :id="id" :name="name" :checked="(modelValue == value)" :value="value" type="radio" @input="$emit('update:modelValue', $event.target.value)" />
      <span>{{ label }}</span>
    </label>
  </div>
</template>

<script>
import {v4 as uuid} from 'uuid'

export default {
  name: 'RadioInput',
  props: {
    name: String,
    value: String,
    id: {
      type: String,
      default() {
        return `radio-input-${uuid()}`
      },
    },
    label: {
      type: String,
      required: true,
    },
    error: String,
    modelValue: String,
  },
  emits: ['update:modelValue'],
  data() {
    return {
      picked: null,
    }
  },
}
</script>

<style scoped>

</style>
