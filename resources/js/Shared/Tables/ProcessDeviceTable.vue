<template>
  <div>
    <table :class="['min-w-full divide-y divide-gray-200']">
      <thead>
      <tr>
        <th class="text-sm font-semibold text-gray-900 px-3 py-3 text-left">#</th>
        <th class="text-sm font-semibold text-gray-900 px-3 py-3 text-left">Name</th>
        <th class="text-sm font-semibold text-gray-900 px-3 py-3 text-left">Seriennummer</th>
        <th class="text-sm font-semibold text-gray-900 px-3 py-3 text-left">MAC</th>
        <th class="text-sm font-semibold text-gray-900 px-3 py-3 text-left">IP</th>
      </tr>
      </thead>
      <tbody :class="['divide-y divide-gray-200']">
      <template v-for="device in devices">
        <tr :class="[device.active ? 'bg-gray-50':'']" >
          <td class="px-3 py-2 text-sm font-medium text-gray-900">
            {{ device.pivot.obl_ext }}
          </td>
          <td class="px-3 py-2 text-sm font-medium text-gray-900">
            <text-input :small="true" v-model="device.name" />
          </td>
          <td class="px-3 py-2 text-sm font-medium text-gray-900">
            <text-input :small="true" v-model="device.mac" />
          </td>
          <td class="px-3 py-2 text-sm font-medium text-gray-900">
            <text-input :small="true" v-model="device.serial"  />
          </td>
          <td class="px-3 py-2 text-sm font-medium text-gray-900">
            <text-input :small="true" v-model="device.pivot.ip"  />
          </td>
        </tr>
      </template>
      </tbody>
    </table>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import CheckboxInput from '@/Shared/CheckboxInput'

export default {
  name: 'ProcessDeviceTable',
  components: {TextInput, CheckboxInput},
  props: {
    devices: Object,
  },
  layout: Layout,
  computed: {

  },
  setup(props) {

  }

}
</script>

<style scoped>

</style>
