<template>
  <div>
    <div class="flex flex-row flex-grow-0 mb-16 xl:mb-0">
      <div class="w-full xl:w-1/2">
        <div class="p-4">
          <Card>
            <template #title>Auftraggeber / Kunde auswählen:</template>
            <template #content>
              <div class="flex flex-col md:flex-row gap-4">
                <select-input :error="form.errors.customer_id" id="selectCustomer" v-model="customer" class="flex-1" :options="customers" option-label="name" :filterable="false" @search="(text, loading) => search('customers', text, loading)" />
                <button class="btn-indigo" @click="this.$inertia.visit(route('customer.create'))">
                  Erstellen
                </button>
              </div>
            </template>
          </Card>


          <Card class="mt-4">
            <template #title>Prüfling:</template>
            <template #content>
              <div class="flex flex-col md:flex-row gap-4">
                <select-input :error="form.errors.device_meta_id" id="selectedDevice" v-model="deviceMeta" class="flex-1" :options="deviceMetas" option-label="name" :filterable="false" @search="(text, loading) => search('devices', text, loading)" />
                <button class="btn-indigo" @click="this.$inertia.visit(route('deviceMeta.create'))">
                  Erstellen
                </button>
              </div>
              <div v-if="deviceMeta">
                <h2 class="text-lg font-medium text-gray-700 mt-4">
                  Wähle die zu testenden Prüflinge aus
                </h2>
                <table :class="['min-w-full divide-y divide-gray-200', form.errors.devices ? 'border border-red-500': '']">
                  <thead>
                  <tr>
                    <th class="text-sm font-semibold text-gray-900 px-1 py-3 text-left"></th>
                    <th class="text-sm font-semibold text-gray-900 py-3 text-left">#</th>
                    <th class="text-sm font-semibold text-gray-900 px-3 py-3 text-left">MAC</th>
                    <th class="text-sm font-semibold text-gray-900 px-3 py-3 text-left">Seriennummer</th>
                  </tr>
                  </thead>
                  <tbody :class="['divide-y divide-gray-200']">
                  <template v-for="device in deviceList" :key="deviceMeta" >
                    <tr :class="[device.active ? 'bg-gray-50':'']" >
                      <td class="pl-3 py-2 text-sm font-medium text-gray-900 relative">
                        <div v-if="device.active" class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600"></div>
                        <checkbox-input @input="toggleDevice(device)"></checkbox-input>
                      </td>
                      <td class="py-2 text-sm font-medium text-gray-900">
                        {{ device.letter }}
                      </td>
                      <td class="px-3 py-2 text-sm font-medium text-gray-900">
                        <text-input :small="true" v-model="device.mac" :disabled="!device.active"/>
                      </td>
                      <td class="px-3 py-2 text-sm font-medium text-gray-900">
                        <text-input :small="true" v-model="device.serial" :disabled="!device.active" />
                      </td>
                    </tr>
                  </template>
                  </tbody>
                </table>
                <div v-if="form.errors.devices" class="form-error">{{form.errors.devices}}</div>
              </div>

            </template>
          </Card>


          <Card class="mt-4">
            <template #title>Art des Prüflings:</template>
            <template #content>
                <div :class="[form.errors.stage ? 'border border-red-500 p-2':'','flex flex-col md:flex-row gap-4 items-center']">
                  <radio-input  v-model="form.stage" name="art" value="pro" label="Prototyp / PRO" />
                  <radio-input  v-model="form.stage" name="art" value="nul" label="Nullserie / NUL" />
                  <div class="flex flex-col md:flex-row gap-4 items-center">
                    <radio-input v-model="form.stage" name="art" value="ser" label="Serienfertigung / SER" />
                    <text-input v-model="form.stage_text" :disabled="form.stage !== 'ser'" />
                  </div>
                </div>
              <span class="form-error" v-if="form.errors.stage">{{ form.errors.stage }}</span>

            </template>
          </Card>

          <Card class="mt-4 w-full fixed bottom-0 left-0 md:static ">
            <template #content>
              <div class="flex flex-row-reverse">
                <button class="btn-indigo" @click="submit">
                  Erstellen
                </button>
              </div>
            </template>
          </Card>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import RadioInput from '@/Shared/RadioInput'
import SimpleSelect from '@/Shared/SimpleSelect'
import { useForm } from '@inertiajs/inertia-vue3'
import route from 'ziggy'
import Icon from '@/Shared/Icon'
import {computed, ref, toRefs, watch} from 'vue'
import CheckboxInput from '@/Shared/CheckboxInput'
import Card from '@/Shared/Card'

export default {
  components: {
    CheckboxInput, Card,
    SimpleSelect, Icon,
    SelectInput,  TextInput, RadioInput,
  },
  layout: Layout,
  computed: {
    deviceList() {
      if(this.deviceMeta === undefined || this.deviceMeta === null) return []
      return this.deviceMeta.devices.map(device => Object.assign(device, { active: this.checkActive(device)}))
    }
  },
  props: {
    process: {
      type: Object,
      default: function () {
        return {
          id: undefined,
          name: undefined,
          customer_id: undefined,
          device_meta_id: undefined,
          stage: undefined,
          stage_text: undefined,
          devices: undefined
        }
      },
    },
    deviceMetas: Object,
    customers: Object,
  },
  remember: ['redirectTo'],
  setup(props) {
    const form = useForm(props.process)

    function visit(model) {
      Inertia.visit(route('device.edit', model.id))
    }

    function submit() {
      if(props.process.id === undefined) {
        form.post(route('process.store'))
      } else {
        form.patch(route('process.update', props.process.id))
      }
    }

    function checkActive(device) {
      if(form.devices === undefined) return false;
      for(const[key, value] of Object.entries(form.devices)) {
        if(value.id === device.id) return true
      }
      return false
    }

    function toggleDevice(device) {
      if(form.devices === undefined) form.devices = []
      device.active = !device.active
      if(form.devices.includes(device)) {
        form.devices.splice(form.devices.indexOf(device), 1)
      } else {
        form.devices.push(device)
      }
    }

    const deviceMeta = ref()
    const customer  = ref()

    watch(deviceMeta, (newDeviceMeta) => {
      form.device_meta_id = newDeviceMeta?.id
    })

    watch(customer, (newCustomer) => {
      form.customer_id = newCustomer?.id
    })

    return {
      form, submit, checkActive, toggleDevice, deviceMeta, customer
    }
  },
}
</script>
