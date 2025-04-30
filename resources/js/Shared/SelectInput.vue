<template>
  <div :class="$attrs.class">
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <v-select :multiple="multiple" :id="id" ref="test" v-model="selected" :options="options" :label="optionLabel" v-bind="{ ...$attrs, class: null }" class="form-input" :class="error ? 'border-red-500':''">
      <slot />
    </v-select>
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>
<style>
.vs__selected-options {
  border: none;
  border-radius: unset;
}
.vs__dropdown-toggle {
  border: none;
  border-radius: unset;
  padding: 0;
}

.vs__search {
  border: 0;
  margin: 0;
}
</style>

<script>
import { v4 as uuid } from 'uuid'
import vSelect from 'vue-select'

export default {
  components: { vSelect },
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `select-input-${uuid()}`
      },
    },
    multiple: {
      type: Boolean,
      default() {
        return false
      },
    },
    options: Object,
    error: String,
    label: String,
    optionLabel: String,
    modelValue: [Object, String],
  },
  emits: ['update:modelValue'],
  data() {
    return {
      selected: this.modelValue,
      isNumber: false,
    }
  },
  mounted() {
    console.log(this.$refs.test)
  },
  watch: {
    modelValue(value) {
      this.selected = value
    },
    selected(selected) {
      this.$emit('update:modelValue', selected)
    },
  },
  methods: {

    focus() {
      this.$refs.input.focus()
    },
    select() {
      this.$refs.input.select()
    },
  },
}
</script>
