<template>
  <div>
    <Head title="Pcap Erstellen" />
    <div class="bg-white rounded-md shadow p-6">
      <label class="form-label" for="oblid">OBL ID:</label>
      <Select id="oblid" :options="oblids" @search="setSearchValue" @input="submit" />

    </div>
  </div>
</template>

<script>
import {Head} from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import { useForm } from '@inertiajs/inertia-vue3'
import Select from 'vue-select'

export default {
  components: {
    Head, Select,
  },
  layout: Layout,
  props: {
    oblids: Object,
  },
  setup () {
    const form = useForm({
      oblid: null,
    })

    return { form }
  },
  data() {
    return {
      filelist: [],
    }
  },
  methods: {
    setSearchValue(search) {
      this.form.oblid = search
    },
    submit() {
      this.form.get('/pcaps/create', {preserveState: true})
    },
    drop(event) {
      event.preventDefault()
      this.$refs.file.files = event.dataTransfer.files
      this.onChange() // Trigger the onChange event manually
    },
    onChange() {
      this.filelist = [...this.$refs.file.files]
    },
    remove(i) {
      this.filelist.splice(i, 1)
    },
  },

}
</script>
