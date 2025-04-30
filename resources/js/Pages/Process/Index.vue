<template>
  <div class="p-4">
    <Head title="Dashboard" />
    <h1 class="mb-8 text-3xl font-bold">Vorgänge im System</h1>
    <h2>{{ route('customer.create')}}</h2>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>

      <Link class="btn-indigo" href="/process/create">
        <span>Vorgang</span>
        <span class="hidden md:inline">&nbsp;erstellen</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">ID</th>
            <th class="pb-4 pt-6 px-6">Name</th>
            <th class="pb-4 pt-6 px-6">OBL Id</th>
            <th class="pb-4 pt-6 px-6">Stage</th>
            <th class="pb-4 pt-6 px-6">Datum</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="item in process.data" :key="process.id"
            class="hover:bg-gray-100 focus-within:bg-gray-100 cursor-pointer"
            @click="showProcess(item.id)"
          >
            <td class="border-t">
              <span class="flex items-center px-6 py-4 focus:text-indigo-500">
                {{ item.id }}
              </span>
            </td>
            <td class="border-t">
              <span class="flex items-center px-6 py-4 focus:text-indigo-500">
                {{ item.name }}
              </span>
            </td>
            <td class="border-t">
              <span class="flex items-center px-6 py-4 focus:text-indigo-500">
                {{ item.obl_id }}
              </span>
            </td>
            <td class="border-t">
              <span class="flex items-center px-6 py-4 focus:text-indigo-500">
                {{ item.stage }}
              </span>
            </td>
            <td class="border-t">
              <span class="flex items-center px-6 py-4 focus:text-indigo-500">
                {{ item.created_at }}
              </span>
            </td>
          </tr>
          <tr v-if="process.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">Keine Vorgänge im System vorhanden</td>
          </tr>
        </tbody>
      </table>
    </div>
    <pagination class="mt-6" :links="process.links" />
  </div>
</template>

<script>
import {Head} from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import Icon from '@/Shared/Icon'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'
import ConfirmModal from '@/Shared/Modals/ConfirmModal'
import TextInput from '@/Shared/TextInput'
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'
import {Link} from '@inertiajs/inertia-vue3'
import route from "@/ziggy"
export default {
  components: {
    TextInput,
    Head, Icon, Pagination, SearchFilter, ConfirmModal, Link,
  },
  layout: Layout,
  props: {
    process: Object,
    filters: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/process', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    showProcess(id) {
      console.log(route("process.show", { process: id}))

    },
  },
}
</script>
