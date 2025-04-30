<template>
  <div>
    <form autocomplete="off">
      <div class="grid grid-cols-1 gap-4 mb-4 mt-4">
        <div class="flex flex-row">
          <text-input v-model="form.name" class="flex-grow" min="0" label="Name" :error="form.errors.name" />
          <text-input v-model="form.obl_id" type="number" step="1" class="ml-4" label="OBL Nummer" :error="form.errors.obl_id" />
        </div>
        <text-input v-model="form.typ" label="Typ" :error="form.errors.typ" />
        <div>
          <label class="form-label" for="deviceType">Gerätetyp</label>
          <div class="flex">
            <select-input id="deviceType" v-model="deviceType" :options="deviceTypes" class="flex-1" option-label="name" :error="form.errors.device_type_id" />
            <button type="button" class="btn-indigo py-0 ml-8" @click="$inertia.visit('deviceType.create')">Erstellen</button>
          </div>
        </div>
        <div>
          <label class="form-label" for="manufacturer">Hersteller</label>
          <div class="flex">
            <select-input id="manufacturer" v-model="manufacturer" :options="manufacturers" class="flex-1" option-label="name" :error="form.errors.manufacturer_id" />
            <button type="button" class="btn-indigo py-0 ml-8" @click="$inertia.visit('manufacturer.create')">Erstellen</button>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-4 ">
          <text-input v-model="form.date_of_receipt" type="date" label="Eingangsdatum" :error="form.errors.date_of_receipt" />
          <text-input v-model="form.date_of_issue" type="date" label="Ausgangsdatum" :error="form.errors.date_of_issue" />
        </div>
        <text-input v-model="form.quantity" type="number" step="1" min="1" label="Anzahl der Geräte" :error="form.errors.quantity" />
      </div>

      <div class="grid grid-cols-1 gap-4 mb-4 mt-4">
        <textarea-input v-model="form.misc" label="Sonstige Bemerkung / Informationen zum Gerät" :error="form.errors.misc" />
      </div>
      <div class="flex justify-end">
        <button type="button" class="btn-indigo" @click="submit">
          Speichern
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import Create from '@/Pages/DeviceMeta/Create'
import Edit from '@/Pages/DeviceMeta/Edit'
import TextInput from '@/Shared/TextInput'
import {useForm} from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextareaInput from '@/Shared/TextareaInput'
import SelectInput from '@/Shared/SelectInput'
import useLayout from '@/lib/FormLayout'
import route from 'ziggy'

export default {
  name: 'DeviceMetaForm',
  components: {SelectInput, TextareaInput, TextInput},
  layout: (h, page) => useLayout(h, page, Layout, Create, Edit),
  props: {
    method: {
      type: String,
      required: true,
    },
    deviceMeta: {
      type: Object,
      default: () => {
        return {
          name: undefined,
          quantity: undefined,
          typ: undefined,
          device_type_id: undefined,
          manufacturer_id: undefined,
          date_of_receipt: undefined,
          date_of_issue: undefined,
          misc: undefined,
          obl_id: undefined,
        }
      }
    },
    deviceType: Object,
    manufacturer: Object,
    manufacturers: Object,
    deviceTypes: Object,
  },
  setup(props) {

    const form = useForm(props.deviceMeta)

    function submit() {
      if(props.deviceMeta.id === undefined) {
        form.post(route('deviceMeta.store'))
      } else {
        form.patch(route('deviceMeta.update', props.deviceMeta.id))
      }
    }

    return {
      form, submit
    }
  },
  watch: {
    deviceType(value) {
        this.form.device_type_id = value?.id
    },
    manufacturer(value) {
        this.form.manufacturer_id = value?.id
    },
  },
}
</script>

