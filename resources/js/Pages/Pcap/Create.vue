<template>
  <div>
    <Head title="Pcap Erstellen" />
    <div class="max-w-3xl bg-white rounded-md shadow ">
      <section class="px-8 pt-8">
        <label class="form-label" for="oblid">OBL ID:</label>
        <Select id="oblid" v-model="uploadForm.oblid" class="w-full form-input " :options="oblids" @search="setSearchValue" @input="submit" />
        <div v-if="uploadForm.errors" class="form-error">{{ uploadForm.errors.oblid }}</div>
      </section>
      <section id="file-upload" class="px-8 pb-4">
        <table class="min-w-full divide-y divide-gray-200 mt-3">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Name
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Status
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr />
            <tr v-for="file in uploadForm.filelist">
              <td class="px-6 py-4 break-all">{{ file.name }}</td>
              <td class="px-6 py-4  ">{{ uploadForm.processing }}</td>
            </tr>
            <td colspan="2">
              <div class="w-full rounded border border-dashed border-gray-500 flex justify-center items-center p-8 hover:bg-gray-200 cursor-pointer" @click="$refs.file.click()" @drop="drop">
                <span>Hier PCAP json Dateien hineinziehen oder klicken</span>
                <input
                  id="assetsFieldHandle" ref="file" type="file" multiple name="fields[assetsFieldHandle][]" class="w-px h-px opacity-0 overflow-hidden absolute" accept=".pcap,.pcapng,.json" @change="onChange"
                />
              </div>
            </td>
          </tbody>
        </table>
      </section>
      <section class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
        <button class="flex items-center btn-indigo" @click="upload">
          Dateien hochladen
          <div v-if="uploadForm.processing" class="btn-spinner mr-2" />
        </button>
      </section>
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

    const uploadForm = useForm({
      oblid: null,
      filelist: [],
    })

    return { form, uploadForm }
  },
  data() {
    return {

    }
  },
  methods: {
    upload() {
      this.uploadForm.post('/pcaps', {preserveState: true})
    },
    setSearchValue(search) {
      this.form.oblid = search
    },
    submit() {
      this.form.get('/pcaps/create', {preserveState: true})
    },
    drop(event) {
      event.preventDefault()
      this.$refs.file.files.append = event.dataTransfer.files
      this.onChange() // Trigger the onChange event manually
    },
    onChange() {
      this.uploadForm.filelist = [...this.$refs.file.files]
    },
    remove(i) {
      this.uploadForm.filelist.splice(i, 1)
    },
  },

}
</script>
