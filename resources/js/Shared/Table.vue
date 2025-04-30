<template>
  <table class="form-table">
    <thead>
      <tr class="text-left font-bold">
        <th v-for="option in options">{{ option.label }}</th>
      </tr>
    </thead>
    <tbody v-if="rows !== null">
      <tr v-for="row in rows.data">
        <td v-for="option in options" class="cursor-pointer" @click="select(row)">
          {{ getRowLabel(row, option.value) }}</td>
      </tr>
    </tbody>
  </table>

  <pagination class="mt-5 flex justify-end" :links="rows.links" />
</template>

<script lang="ts">

import Pagination from "./Pagination.vue";
import { defineComponent } from 'vue'
import _ from 'lodash'

interface OptionInterface  {
  value: string,
  label: string,
}

export default defineComponent({
  components: { Pagination },
  props: {
    options: {
      type: Object as () => Array<OptionInterface>
    },
    rows: Object,
  },
  emits: ['selected'],
  setup() {
    return { }
  },
  methods: {
    select(row: never) {
      this.$emit("selected", row)
    },
    getRowLabel(row, optionValue) {
      return _.get(row, optionValue)
    }
  }
})





</script>



