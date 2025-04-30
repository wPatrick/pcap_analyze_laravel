<template>
  <div class="rounded border border-gray-200 bg-white p-4">
    <label class="text-sm font-bold">Welche Geräte sollen miteinander verglichen werden</label>
    <div class="flex flex-row mt-4">
      <div class="w-1/6 mr-5">
        <SimpleSelect v-model="newDeviceA" :options="devices" :selected="selectedDeviceA" placeholder="TEst" />
      </div>
      <div class="w-1/6">
        <SimpleSelect v-model="newDeviceB" :options="devices" :selected="selectedDeviceB" placeholder="TEst" />
      </div>
      <div class="flex items-center justify-center bg-gray-100 border border-gray-200 rounded ml-2 text-gray-400 hover:text-gray-600 cursor-pointer" @click="addDevice()">
        <div class="p-2 flex flex-row">
          <PlusSmIcon class="w-4" /> Hinzufügen
        </div>
      </div>
    </div>
    <template v-for="(setting, index) in compareDevices">
      <div class="flex flex-row mt-4">
        <div class="w-1/6 mr-5">
          <SimpleSelect v-model="compareDevices[index].device_a" :options="devices" :selected="selectedDeviceA" placeholder="TEst" />
        </div>
        <div class="w-1/6">
          <SimpleSelect v-model="compareDevices[index].device_b" :options="devices" :selected="selectedDeviceB" placeholder="TEst" />
        </div>
      </div>
    </template>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import ProcessLayout from '@/Pages/Process/Layout'
import { PlusCircleIcon, PlusSmIcon, MinusSmIcon } from  '@heroicons/vue/outline'

import { TrashIcon } from '@heroicons/vue/outline'
import TextInput from '@/Shared/TextInput'
import throttle from 'lodash/throttle'
import { Link } from '@inertiajs/inertia-vue3'
import SimpleSelect from '@/Shared/SimpleSelect'
import {ref} from 'vue'

export default {
  name: 'ProcessSettings',
  components: {TextInput, PlusCircleIcon, TrashIcon, Link, PlusSmIcon, MinusSmIcon, SimpleSelect },
  layout: [ Layout, ProcessLayout ],
  props: {
    process: Object,
    compareDevices: Object,
    devices: Object,
  },
  data() {
    return {
      newDeviceA: null,
      newDeviceB: null,
    }
  },
  computed: {
    selectedDeviceA() {
      if(this.devices.length > 0) {
        return this.devices[0]
      }
      return ref(0)
    },
    selectedDeviceB() {
      if(this.devices.length > 0) {
        return this.devices[0]
      }
      return ref(0)
    },
  },
  watch: {
  },
  mounted() {
    this.newDeviceA = this.selectedDeviceA
    this.newDeviceB = this.selectedDeviceB
  },
  methods: {
    addDevice() {
      let form = this.$inertia.form({ deviceA: this.newDeviceA, deviceB: this.newDeviceB })
      this.$inertia.post(route('process.settings.store', this.process.id), form)
    },
  },
}
</script>


<style scoped>

</style>
