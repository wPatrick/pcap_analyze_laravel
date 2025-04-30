<template>
  <div class="p-4">
    <div class="max-w-3xl border rounded border-gray-200 bg-white">
      <div class="py-3 px-4 border-b flex justify-between items-center">
        <h2 class="text-lg font-medium text-gray-700">Herstellerübersicht</h2>
        <button class="btn-indigo btn-sm">
          <div class="flex">
            <Icon name="PlusCircleIcon" class="w-4 h-4" />
            <Link :href="store_url" class="ml-2">Hersteller hinzufügen</Link>
          </div>
        </button>
      </div>
      <div class="p-4 text-gray-600">
        <Table @selected="visit" :options="options" :rows="manufacturers"></Table>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Layout from '../../Shared/Layout.vue'
import { Inertia } from '@inertiajs/inertia'
import { Link } from '@inertiajs/inertia-vue3'
import Table from "../../Shared/Table.vue";
import {defineComponent} from "vue";
import Icon from "../../Shared/Icon.vue";
import route from 'ziggy';

export default defineComponent({
  name: 'ManufacturerIndex',
  components: {Icon, Table, Link},
  layout: Layout,
  props: {
    manufacturers: Object,
  },
  data() {
    return {
      store_url: route('manufacturer.create'),
      options: [
        { value: 'id', label: 'ID'},
        { value: 'name', label:'Name'},
      ]
    }
  },
  methods: {
    visit(model: any) {
      Inertia.visit(route('manufacturer.edit', model.id))
    }
  }
})


</script>

<style scoped>

</style>
