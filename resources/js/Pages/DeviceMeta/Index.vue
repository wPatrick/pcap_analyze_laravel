<template>
  <div class="p-4">
    <div class="max-w-3xl border rounded border-gray-200 bg-white">
      <div class="py-3 px-4 border-b flex justify-between items-center">
        <h2 class="text-lg font-medium text-gray-700">Verfügbare Geräte</h2>
        <button class="btn-indigo btn-sm">
          <div class="flex">
            <Icon name="PlusCircleIcon" class="w-4 h-4" />
            <Link :href="route('deviceMeta.create')" class="ml-2">Gerät hinzufügen</Link>
          </div>
        </button>
      </div>
      <div class="p-4 text-gray-600">
        <table class="form-table">
          <thead>
            <tr>
              <th class="hide-mobile">ID</th>
              <th>Name</th>
              <th class="hide-mobile">Hersteller</th>
              <th class="hide-mobile">Gerätetyp</th>
              <th class="hide-mobile">Anzahl</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="device in devices" :key="device.id" class="cursor-pointer" @click="visit(device.id)">
              <td class="hide-mobile">{{ device.id }}</td>
              <td>
                <span class="hidden lg:inline-block">
                  {{ device.name }}
                </span>
                <dl class="lg:hidden">
                  <dt>Name</dt>
                  <dd>{{ device.name }}</dd>
                  <dt>Hersteller</dt>
                  <dd>{{ device.manufacturer.name }}</dd>
                  <dt>Gerätetyp</dt>
                  <dd>{{ device.device_type.name }}</dd>
                  <dt>Anzahl</dt>
                  <dd>{{ device.quantity }}</dd>
                </dl>
              </td>
              <td class="hide-mobile">{{ device.manufacturer.name }}</td>
              <td class="hide-mobile">{{ device.device_type.name }}</td>
              <td class="hide-mobile">{{ device.quantity }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import {Inertia} from '@inertiajs/inertia'
import Icon from '@/Shared/Icon'
import { Link } from '@inertiajs/inertia-vue3'
import route from "ziggy";

export default {
  name: 'DeviceMetaIndex',
  components: {Icon, Link},
  layout: Layout,
  props: {
    devices: Object,
  },
  methods: {
    visit: id =>  {
      Inertia.visit(route('deviceMeta.edit', id))
    },
  },

}
</script>

<style scoped>

</style>
