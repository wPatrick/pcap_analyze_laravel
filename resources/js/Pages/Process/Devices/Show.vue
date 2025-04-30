<template>
  <div>
    <div class="bg-white rounded border border-gray-200 divide-y">
      <table :class="['min-w-full divide-y divide-gray-200']">
        <thead>
        <tr>
          <th class="text-sm font-semibold text-gray-900 px-3 py-3 text-left">#</th>
          <th class="text-sm font-semibold text-gray-900 px-3 py-3 text-left">Name</th>
          <th class="text-sm font-semibold text-gray-900 px-3 py-3 text-left">Seriennummer</th>
          <th class="text-sm font-semibold text-gray-900 px-3 py-3 text-left">MAC</th>
          <th class="text-sm font-semibold text-gray-900 px-3 py-3 text-left">IP</th>
          <th class="text-sm font-semibold text-gray-900 px-3 py-3 text-left"></th>
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
    <Card class="mt-4">
      <template #title>
        Gerät hinzufügen
      </template>
      <template #content>
        <text-input v-model="deviceSearchForm"/>
        <div class="flex">

        </div>
      </template>
    </Card>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import ProcessLayout from '@/Pages/Process/Layout'
import TextInput from '@/Shared/TextInput'
import route from 'ziggy'
import { useForm } from '@inertiajs/inertia-vue3'
import Card from '@/Shared/Card'
import {watch, ref, reactive} from 'vue'
import _throttle from 'lodash/throttle'
import {Inertia} from '@inertiajs/inertia'

export default {
  components: {Card, TextInput },
  layout: [ Layout, ProcessLayout ],
  props: {
    process: Object,
    devices: Object,
    searchDevices: Object,
  },
  data() {
    return {

    }
  },
  setup(props) {
    let form = useForm(props.devices)
    let deviceSearchForm = ref()



    watch(deviceSearchForm, _throttle(function(newValue) {
      Inertia.get(route('process.devices', props.process.id), deviceSearchForm, {
        preserveScroll: true,
        preserveState: true
      })

    }, 250))




    return { form, deviceSearchForm }
  },
}
</script>

<style scoped>

</style>
