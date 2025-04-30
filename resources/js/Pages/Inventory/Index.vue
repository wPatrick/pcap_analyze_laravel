<template>
  <div>
    <Head title="Dashboard" />
    <h1 class="mb-8 text-3xl font-bold">Warenverwaltung</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>
      <Link class="btn-indigo" href="/organizations/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;Organization</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">ID</th>
            <th class="pb-4 pt-6 px-6">Hersteller</th>
            <th class="pb-4 pt-6 px-6">SerienNr.</th>
            <th class="pb-4 pt-6 px-6">Typ</th>
            <th class="pb-4 pt-6 px-6" colspan="2">Erstellt am</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="item in inventory.data" :key="inventory.id"
            class="hover:bg-gray-100 focus-within:bg-gray-100"
          >
            <td class="border-t">
              <span class="flex items-center px-6 py-4 focus:text-indigo-500">
                OBL {{ item.id }}
              </span>
            </td>
            <td class="border-t">
              <span class="flex items-center px-6 py-4 focus:text-indigo-500">
                {{ item.manufacturer }}
              </span>
            </td>
            <td class="border-t">
              <span class="flex items-center px-6 py-4 focus:text-indigo-500">
                {{ item.seriennummer }}
              </span>
            </td>
            <td class="border-t">
              <span class="flex items-center px-6 py-4 focus:text-indigo-500">
                {{ item.typ }}
              </span>
            </td>
            <td class="border-t">
              <span class="flex items-center px-6 py-4 focus:text-indigo-500">
                {{ item.created_at }}
              </span>
            </td>
            <td class="w-px border-t">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </td>

          </tr>
          <tr v-if="inventory.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">Keine Einträge im Warenlager vorhanden</td>
          </tr>
        </tbody>
      </table>

    </div>
    <pagination class="mt-6" :links="inventory.links" />

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

export default {
  components: {
    Head, Icon, Pagination, SearchFilter
  },
  layout: Layout,
  props: {
    inventory: Object,
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
        this.$inertia.get('/inventory', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },

}
</script>
