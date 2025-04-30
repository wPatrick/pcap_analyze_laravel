<template>
  <div class="p-4">
    <div class="max-w-3xl border rounded border-gray-200 bg-white">
      <div class="py-3 px-4 border-b flex justify-between items-center">
        <h2 class="text-lg font-medium text-gray-700">Kundenübersicht</h2>
        <button class="btn-indigo btn-sm">
          <div class="flex">
            <Icon name="PlusCircleIcon" class="w-4 h-4" />
            <Link :href="store_url" class="ml-2">Kunde hinzufügen</Link>
          </div>
        </button>
      </div>
      <div class="p-4 text-gray-600">
        <Table @selected="visit" :options="options" :rows="customers"></Table>
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

interface CustomersItems extends Array<Object>{}

export default defineComponent({
  name: 'CustomersIndex',
  components: {Icon, Table, Link},
  layout: Layout,
  props: {
    customers: {
      type: Object as () => CustomersItems
    },
  },
  data() {
    return {
      store_url: route('customer.create'),
      options: [
        { value: 'id', label: 'ID'},
        { value: 'name', label:'Name'},
        { value: 'city', label:'Straße'},
        { value: 'zip', label:'Plz'},
        { value: 'street', label:'Straße'},
        { value: 'phone', label:'Telefon'},
        { value: 'email', label:'E-Mail'}
      ]
    }
  },
  methods: {
    visit(model: any) {
      Inertia.visit(route('customer.edit', model.id))
    }
  }
})


</script>

<style scoped>

</style>
