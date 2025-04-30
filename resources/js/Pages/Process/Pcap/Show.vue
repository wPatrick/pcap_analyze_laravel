<template>
  <div>

    <div class="cursor-pointer rounded border border-gray-200 bg-white" @dragover.prevent @drop.prevent>
      <input ref="file" class="hidden" type="file" multiple @input="dragFile($event.target.files)" />
      <div @drop="dragFile($event.dataTransfer.files)">
        <div class="bg-gray-50 hover:bg-gray-100 p-12 text-uppercase border border-dashed text-center" @click="$refs.file.click()" >
          Datei per Drag & Drop einfügen oder Klicken zum hochladen
        </div>
      </div>
    </div>
    <div class="flex gap-2 my-2">
      <button class="btn-indigo" :disabled="selected.length === 0" @click="analyzePcap">Analyse starten</button>
      <button class="btn-danger" :disabled="selected.length === 0" @click="deletePcap" >Löschen</button>
    </div>
    <div class="rounded border border-gray-200 bg-white">
      <table class="w-full whitespace-nowrap">
        <thead>
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6 text-uppercase"><input type="checkbox" v-model="selectAll" /></th>
          <th class="pb-4 pt-6 px-6 text-uppercase">Name</th>
          <th class="pb-4 pt-6 px-6 text-uppercase">Größe</th>
          <th class="pb-4 pt-6 px-6 text-uppercase">Analysestatus</th>
          <th class="pb-4 pt-6 px-6 text-uppercase">Zuletzt aktualisiert</th>
        </tr>
        </thead>
        <tbody>
        <template v-if="uploadFiles.length > 0 ">
          <tr v-for="file in uploadFiles">
            <td class="pb-4 pt-6 px-6 text-uppercase border-t">{{ file.file.size}}</td>
            <td class="pb-4 pt-6 px-6 text-uppercase border-t">{{ file.file.name }}</td>
            <td class="pb-4 pt-6 px-6 text-uppercase border-t"></td>
            <td class="pb-4 pt-6 px-6 text-uppercase border-t">
              <div class="bg-gray-200 rounded mt-5" v-if="file.progress">
                <div class="bg-green-400 rounded p-1 text-center text-white text-sm transition" :style="`width: ${file.progress.percentage}%; transition: width 2s;`">
                  {{ file.progress.percentage }}%
                </div>
              </div>
            </td>
          </tr>
        </template>
        <template v-if="pcaps.length">
          <tr v-for="pcap in pcaps" :key="pcap.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="pb-4 pt-6 px-6 text-uppercase border-t">
              <input type="checkbox" ref="checkbox" v-model="selected" :value="pcap.id"/>
            </td>
            <td class="pb-4 pt-6 px-6 text-uppercase border-t">
              <a class="hover:underline hover:text-indigo-500" :href="route('pcap.download', pcap.id)">{{ pcap.name }}</a>
            </td>
            <td class="pb-4 pt-6 px-6 text-uppercase border-t">{{ prettySize(pcap.size) }}</td>
            <td class="pb-4 pt-6 px-6 text-uppercase border-t">
              <button type="button" class="btn-danger" v-if="pcap.analyzed == null">Nicht analysiert</button>
              <button type="button" class="btn-green" v-if="pcap.analyzed == true">Analysiert</button>
              <button v-if="pcap.analyzed === false" class="btn-indigo flex flex-row">
                <div class="btn-spinner mr-2" />Analyse gestartet
              </button>
            </td>
            <td class="pb-4 pt-6 px-6 text-uppercase border-t">
              {{ pcap.updated_at}}
            </td>
          </tr>
        </template>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script lang="ts">
import Layout from '@/Shared/Layout.vue'
import ProcessLayout from '@/Pages/Process/Layout.vue'
import {Link} from '@inertiajs/inertia-vue3'
import Table from '@/Shared/Table.vue'
import {reactive, ref, toRefs, watch} from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import fileSize from "filesize";
import { Inertia } from '@inertiajs/inertia'
import {CustomWindow} from '@/custom-window'
import Echo from "laravel-echo";
import route from 'ziggy-js'

declare let window: CustomWindow;

export default {
  components: {
    Link, Table
  },
  layout: [ Layout, ProcessLayout ],
  props: {
    devices: null,
    pcaps: null,
    process: null,
  },
  setup(props) {
    window.Echo.channel('pcap').listen('.PcapAnalyzed', () => {
      Inertia.reload({
        preserveState: true,
        preserveScroll: true,
        only: ['pcaps'],
      })
    })
    const uploadFiles = reactive([])
    let selected = ref([])
    const selectAll = ref(false)

    watch(selectAll, (currentValue, oldValue) => {
      if(!currentValue) selected.value = []
      else selected.value = props.pcaps.map(pcap => pcap.id)
    })

    const dragFile =  async(files)  => {
      for (let i = 0; i < files.length; i++) {
        let file = files.item(i)
        let fileForm = useForm('foo' + i, {file: file})
        uploadFiles.push(fileForm)
      }
      function upload(uploadFiles) {
        let length = uploadFiles.length
        if (length > 0) {
          let uploadFile = uploadFiles[length-1];
          uploadFile.post(route('process.pcapUpload', props.process.id), {
            onSuccess: () => {
              uploadFiles.pop()
              upload(uploadFiles)
            }
          })
        }
      }
      upload(uploadFiles)
    }

    function prettySize(size) {
      return fileSize(size)
    }

    function analyzePcap() {
      if(selected.value.length > 0) {
        Inertia.post(route('pcap.analyze', selected.value[selected.value.length -1]), {},{
          onSuccess: (page) => {
            console.log("success post")
            selected.value.pop()
            analyzePcap()
          },
          preserveState: true,
          preserveScroll: true
        })
      }
    }
    function deletePcap() {
      if(selected.value.length > 0) {
        Inertia.delete(route('pcap.destroy', selected.value[selected.value.length -1]), {
          onSuccess: () => {
            selected.value.pop()
            deletePcap()
          }
        })
      }
    }

    return {
      uploadFiles, dragFile, prettySize, selected, selectAll, deletePcap, analyzePcap
    }
  },
}


</script>

<style scoped>

</style>
