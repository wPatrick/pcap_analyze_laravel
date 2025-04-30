<template>
  <div class="flex ">
    <nav class="flex min-h-screen flex-col flex-shrink-0 w-96 border-r border-gray-200 bg-white">

      <Link :href="route('process.pcaps', process.id)" class="bg-blue-50 bg-opacity-50 p-6 border-b border-gray-200 cursor-pointer hover:bg-gray-100">
        <p class="font-medium">Mitschnitte</p>
        <ul class="mt-2 text-sm text-gray-500 ">
          <li>Pcaps hochladen</li>
          <li>Übersicht über Analyse Status</li>
        </ul>
      </Link>
      <Link :href="route('process.devices', process.id)" class="bg-blue-50 bg-opacity-50 p-6 border-b border-gray-200 cursor-pointer hover:bg-gray-100">
        <p class="font-medium">Geräte</p>
        <ul class="mt-2 text-sm text-gray-500 ">
          <li>Geräte erstellen</li>
          <li>IPs zuordnen</li>
        </ul>
      </Link>
      <Link :href="route('process.settings', process.id)" class="bg-blue-50 bg-opacity-50 p-6 border-b border-gray-200 cursor-pointer hover:bg-gray-100">
        <p class="font-medium">Einstellungen</p>
        <ul class="mt-2 text-sm text-gray-500 ">
          <li>Welche Geräte sollen gegenüber gestellt werden</li>
        </ul>
      </Link>
      <Link :href="route('process.auswertung', process.id)" class="bg-blue-50 bg-opacity-50 p-6 border-b border-gray-200 cursor-pointer hover:bg-gray-100">
        <p class="font-medium">Auswertung</p>
        <ul class="mt-2 text-sm text-gray-500 ">
          <li>Übersicht über die Auswertung</li>
          <li>Export</li>
        </ul>
      </Link>
      <a class="bg-blue-50 bg-opacity-50 p-6 border-b border-gray-200 cursor-pointer hover:bg-gray-100">
        <p class="font-medium">Fragenkatalog</p>
        <ul class="mt-2 text-sm text-gray-500 ">
          <li>Fragenkatalog digitalisieren</li>
          <li>!!! Todo !!! </li>
        </ul>
      </a>
      <a class="bg-blue-50 bg-opacity-50 p-6 border-b border-gray-200 cursor-pointer hover:bg-gray-100">
        <p class="font-medium">Dokumentenupload</p>
        <ul class="mt-2 text-sm text-gray-500 ">
          <li>Dokumentenupload</li>
          <li>Dokumentenviewer</li>
          <li>!!! Todo !!! </li>
        </ul>
      </a>
    </nav>
    <div class="flex-1 p-4">
      <slot />
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
  name: 'PLayout',
  components: {
    Link
  },
  props: {
    process: { id: 1},
  },

  data() {

  },
  computed: {

  },
  methods: {

  },
}
</script>

<style scoped>

</style>
