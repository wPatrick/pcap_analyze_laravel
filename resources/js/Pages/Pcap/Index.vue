<template>
  <div>
    <Head title="Dashboard" />
    <h1 class="mb-8 text-3xl font-bold">Pcaps</h1>

    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset" />

      <div class="flex items-center justify-between">
        <Link href="pcaps/create" type="button" class="btn-indigo">Pcap Hochladen</Link>
      </div>
    </div>

    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6 uppercase">obl id</th>
            <th class="pb-4 pt-6 px-6 uppercase">Name</th>
            <th class="pb-4 pt-6 px-6 uppercase">File</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="pcap in pcaps" :key="pcap.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td><span class="flex items-center px-6 py-4 focus:text-indigo-500">{{ pcap.oblid }}</span></td>
            <td><span class="flex items-center px-6 py-4 focus:text-indigo-500">{{ pcap.name }}</span></td>
            <td>
              <div class="flex flex-row px-6">
                <Link class="btn btn-indigo" :href="route('pcap.analyze', pcap.id)" method="POST" as="button">Analyse starten</Link>
                <Link class="ml-2 btn btn-indigo" :href="route('pcap.show', pcap.id)">Details anzeigen</Link>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import {Head} from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import Icon from '@/Shared/Icon'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'
import { useForm } from '@inertiajs/inertia-vue3'
import {Link} from '@inertiajs/inertia-vue3'

export default {
  components: {
    Head,  SearchFilter, Link,
  },
  layout: Layout,
  props: {
    filters: Object,
    pcaps: Object,
  },
  setup () {
    const form = useForm({
      pcapfile: null,
    })

    function submit() {
      form.post('/pcaps')
    }

    return { form, submit }
  },
  data() {
    return {
      pages: [
        {'name': 'test', 'href': 'foo'},
      ],
    }
  },

}
</script>
