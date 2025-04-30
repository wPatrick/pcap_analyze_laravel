<template>
  <div>
    <form autocomplete="off">
      <div class="grid grid-cols-1 gap-4 mb-4">
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

<script>
import Create from './Create.vue'
import Edit from './Edit.vue'
import TextInput from "../../Shared/TextInput.vue";
import Layout from "../../Shared/Layout.vue";
import {useForm} from '@inertiajs/inertia-vue3'
import useLayout from '../../lib/FormLayout.js'
import route from 'ziggy'

export default {
  name: 'ManufacturerForm',
  components: {TextInput},
  layout: (h, page) => useLayout(h, page, Layout, Create, Edit),
  props: {
    method: {
      type: String,
      required: true,
    },
    manufacturer: {
      type: Object,
      default: function() {
        return {
          id: undefined,
          name: undefined,
        }
      },
    },
  },
  setup(props) {

    const form = useForm(props.manufacturer)

    function submit() {
      if(props.manufacturer.id === undefined) {
        form.post(route('manufacturer.store'))
      } else {
        form.patch(route('manufacturer.update', props.manufacturer.id))
      }
    }

    return {
      form, submit
    }
  },

}
</script>

<style scoped>

</style>
