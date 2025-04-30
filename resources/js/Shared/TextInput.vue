<template>
  <div :class="$attrs.class">
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <input :id="id" @keypress="checkNumber"  ref="input" v-bind="{ ...$attrs, class: null }" class="form-input disabled:bg-gray-100" :class="[small ? 'p-1 text-sm focus:ring-2':'', { error: error }]" :type="type" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
    <div v-if="error" class="form-error">
      {{ error }}
    </div>
  </div>
</template>

<script>
import { v4 as uuid } from 'uuid'

export default {
  inheritAttrs: false,
  props: {
    id: {
      type: [String],
      default() {
        return `text-input-${uuid()}`
      },
    },
    small: {
      type: Boolean,
      default() {
        return false
      },
    },
    type: {
      type: String,
      default: 'text',
    },
    error: String,
    label: String,
    modelValue: [ String, Number ],
  },
  emits: ['update:modelValue'],
  methods: {
    checkNumber(evt) {
      if(this.type==='number') {
        let charCode = (evt.which) ? evt.which : evt.keyCode
        if ((charCode >= 48 && charCode <= 57) || charCode === 46) {
          return true
        } else {
          evt.preventDefault()
        }
      }
    },
    focus() {
      this.$refs.input.focus()
    },
    select() {
      this.$refs.input.select()
    },
    setSelectionRange(start, end) {
      this.$refs.input.setSelectionRange(start, end)
    },
  },
}
</script>
