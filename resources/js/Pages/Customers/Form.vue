<template>
  <div>
    <form autocomplete="off">
      <div class="grid grid-cols-2 gap-4 mb-4 mt-4">
        <text-input v-model="form.name" label="Name" :error="form.errors.name" />
        <text-input v-model="form.short_name" label="Kürzel" :error="form.errors.short_name" />
      </div>
      <div class="grid grid-cols-1 gap-4 mb-4">
        <text-input v-model="form.street" label="Adresse" :error="form.errors.street" />
      </div>
      <div class="grid grid-cols-2 gap-4 mb-4">
        <text-input v-model="form.zip" label="Plz" :error="form.errors.zip" />
        <text-input v-model="form.city" label="Stadt" :error="form.errors.city" />
        <text-input v-model="form.phone" label="Telefon" :error="form.errors.phone" />
        <text-input v-model="form.email" label="E-Mail" :error="form.errors.email" />
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
import { useForm } from '@inertiajs/inertia-vue3'
import TextInput from '@/Shared/TextInput'
import Layout from '@/Shared/Layout'
import Edit from '@/Pages/Customers/Edit'
import Create from '@/Pages/Customers/Create'
import useLayout from '@/lib/FormLayout'
import route from 'ziggy'

export default {
  name: 'CustomerForm',
  components: {TextInput},
  props: {
    customer: {
      type: Object,
      default: function() {
        return {
          name: null,
          short_name: null,
          street: null,
          city: null,
          zip: null,
          phone: null,
          email: null,
        }
      },
    },
    method: String,
  },
  layout: (h, page) => useLayout(h, page, Layout, Create, Edit),
  setup(props) {

    const form = useForm(props.customer)

    function submit() {
      if(props.customer.id === undefined) {
        form.post(route('customer.store'))
      } else {
        form.patch(route('customer.update', props.customer.id))
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
