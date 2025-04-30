<template>
  <div>
    <form autocomplete="off">
      <div class="grid grid-cols-1 gap-4 mb-4 mt-4">
        <text-input v-model="form.name" label="Name" :error="form.errors.name" />
      </div>
      <div class="flex justify-end">
        <button type="button" class="btn-indigo" @click="submit">
          Speichern
        </button>
      </div>
    </form>
  </div>
</template>

<script lang="ts">
import Create from '@/Pages/DeviceType/Create.vue'
import Edit from '@/Pages/DeviceType/Edit.vue'
import TextInput from '@/Shared/TextInput.vue'
import Layout from '@/Shared/Layout.vue'
import {useForm} from '@inertiajs/inertia-vue3'
import useLayout from '@/lib/FormLayout'
import route from 'ziggy'
import { defineComponent } from 'vue'

const DeviceTypeForm = defineComponent({
    name: 'DeviceTypeForm',
    components: {TextInput},
    layout: (h, page) => useLayout(h, page, Layout, Create, Edit),
    props: {
        method: {
            type: String,
            required: true,
        },
        deviceType: {
          type: Object,
          default: () => {
            return {
              id: undefined,
              name: undefined,
            }
          }
        },
        redirect: {
            type: String,
            default: null,
        },
    },

    setup(props) {
      const form = useForm(props.deviceType)
      function submit() {
        if(props.deviceType.id === undefined) {
          form.post(route('deviceType.store'))
        } else {
          form.patch(route('deviceType.update', props.deviceType.id))
        }
      }
      return {
        form, submit
      }
    },
})

export default DeviceTypeForm
</script>
