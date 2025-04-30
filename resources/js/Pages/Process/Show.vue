<template>
  <div>
    <div class="w-full mb-2">
      <a :href="route('process.auswertung.download', process.id)" class="btn-indigo w-full mb-2 block text-center">
        Download Auswertung
      </a>
    </div>
    <div class="flex flex-row gap-2" />
  </div>
  <Tabs v-model="tabs" :tabs="tabs">
    <template v-for="(devices, key) in ips" #[getSlotName(key)]>
      <table class="w-full table-fixed">
        <thead>
          <tr class="text-left font-bold">
            <th class="w-2/12 pb-4 pt-6 px-6 text-uppercase">Name</th>
            <th class="w-2/12 pb-4 pt-6 px-6 text-uppercase">IP</th>
            <th class="w-1/12 pb-4 pt-6 px-6 text-uppercase">Port / Protokoll</th>
            <th class="w-2/12 pb-4 pt-6 px-6 text-uppercase">
              <span class="text-indigo-500">SNI</span> / <span class="text-green-500">Dns</span>
            </th>
            <th class="w-3/12 pb-4 pt-6 px-6 text-uppercase">ASN</th>
          </tr>
        </thead>
        <tr v-for="device in devices" :class="device.is_eu ? '': 'bg-red-500'" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class=" pb-4 pt-6 px-6 text-uppercase border-t break-all">{{ device.name}}</td>

          <td class=" pb-4 pt-6 px-6 text-uppercase border-t break-all">
            <div class="flex flex-col">
              <div v-if="key==='Unbekannt'">{{ device.ip_src }}</div>
              <div>{{ device.ip_dst }}</div>
            </div>
          </td>
          <td class=" pb-4 pt-6 px-6 text-uppercase border-t break-all">
            <div class="flex flex-col">
              <div>{{ device.protocol }}</div>
              <div>{{ device.port }}</div>
            </div>
          </td>
          <td class=" pb-4 pt-6 px-6 text-uppercase border-t break-all">
            <span class="text-indigo-500">{{ device.sni }}</span>
            <div class="flex flex-col flex-grow-0 break-all" v-for="dns in device.dns">
              <span v-if="!device.sni || device.sni.length === 0" class="text-green-500">{{ dns }}</span>
            </div>
          </td>
          <td class=" pb-4 pt-6 px-6 text-uppercase border-t break-all">{{ device.asn }}</td>
        </tr>
      </table>
    </template>
  </Tabs>
</template>

<script>
import Layout from '@/Shared/Layout'
import ProcessLayout from '@/Pages/Process/Layout'
import {Link} from '@inertiajs/inertia-vue3'
import ConfirmModal from '@/Shared/Modals/ConfirmModal'
import CreateDevice from '@/Pages/Process/Devices/Create'
import Uploader from 'vue-simple-uploader'
import { useForm } from '@inertiajs/inertia-vue3'
import axios from 'axios'
import Tabs from '@/Shared/Tabs'
import {Inertia} from '@inertiajs/inertia'
import route from "ziggy-js";

export default {
  name: 'Show.vue',
  components: {
    Link, ConfirmModal, CreateDevice, Uploader, Tabs,
  },
  layout: [ Layout, ProcessLayout ],
  props: {
    pcaps: null,
    process: null,
    ips: Object,
    unknownIps: Object,
  },

  data() {
    return {
      createModalIsOpen: false,
      deviceCreate: false,
      File: [],
      progress: null,
      FileList: [],
      tabs: [

      ],
    }
  },
  computed: {
    unfinishedFiles() {
      return this.File.filter(f=>f.progress !== 100)
    },
  },
  mounted() {

    if (location.hash === 'createModal') {
      this.createModalIsOpen = true
    }

    let i = 0
    for(const [key, value] of Object.entries(this.ips)) {
      let current = i++ === 0
      let tab = { name: key, href: '#'+encodeURIComponent(key), current: current }
      this.tabs.push(tab)

    }

  },
  methods: {
    getSlotName(name) {
      return '#'+encodeURIComponent(name)
    },
    confirm() {

    },

    uploadFile(file) {
      const formData = new FormData()
      formData.append('file', file)
      const fileObject = {lastModified: file.lastModified, name: file.name, size: file.size, progress: 0}
      this.File.push(fileObject)
      axios.post(route('processes.pcapUpload', this.process.id), formData, {
        onUploadProgress: progressEvent => {
          fileObject.progress = Math.round((progressEvent.loaded * 100) / progressEvent.total)
        },
      }).then(response => {
        this.pcaps.push(response.data)
      })

    },
    dragFile(e) {
      for(let i =0; i< e.dataTransfer.files.length;i++) {
        let file = e.dataTransfer.files.item(i)
        let fileExist = false
        for(let i = 0; i<this.unfinishedFiles.length;i++) {
          let lFile = this.File[i]
          if(lFile.lastModified === file.lastModified && lFile.name === file.name && lFile.size === file.size) {
            fileExist = true
            break
          }
        }
        if(!fileExist){
          this.uploadFile(file)
        }
      }
    },
  },
}
</script>

<style scoped>

</style>
