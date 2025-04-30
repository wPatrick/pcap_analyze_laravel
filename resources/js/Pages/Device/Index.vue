<template>
  <div class="p-4">
    <div class="max-w-3xl border rounded border-gray-200 bg-white">
      <div class="py-3 px-4 border-b flex justify-between items-center">
        <h2 class="text-lg font-medium text-gray-700">Geräteübersicht</h2>
      </div>
      <div class="p-4 text-gray-600">
        <Table @selected="visit" :options="options" :rows="devices"></Table>
      </div>
    </div>
  </div>
</template>

<script>
import {Inertia} from '@inertiajs/inertia'
import Layout from '@/Shared/Layout'
import route from "ziggy";
import Table from "../../Shared/Table.vue";

export default {
  name: 'DeviceIndex',
  props: {
    devices: Object
  },
  components: {Table},
  layout: Layout,
  setup(props) {
    function visit(model) {
      Inertia.visit(route('device.edit', model.id))
    }
    const options = [
      { value: 'id', label: 'ID'},
      { value: 'device_meta.name', label: 'Name' },
      { value: 'device_meta.manufacturer.name', label: 'Hersteller' },
      { value: 'device_meta.device_type.name', label: 'Gerätetyp' },
      { value: 'number', label:'Nummer'},
      { value: 'serial', label:'Seriennummer'},
      { value: 'mac', label:'Mac'},
    ]
    return { visit, options }
  }

}
</script>

<style scoped>

</style>
