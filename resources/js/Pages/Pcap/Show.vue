<template>
  <div>
    <Head title="Dashboard" />


    <main class="min-w-0 flex-1 lg:flex gap-8">
      <!-- Primary column -->
      <section aria-labelledby="primary-heading" class="min-w-0 flex-1 h-full overflow-hidden flex flex-col lg:order-last space-x-4">
        <a :href="route('pcaps.download', pcap.id)" class="w-full ml-2 btn btn-indigo mb-3 ">
          Download als xlsx
        </a>

        <div class="bg-white g-white rounded-md shadow">

          <div v-if="page==='tcp'">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    IP SRC
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    IP DST
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    PORT
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Land
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Europa
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="(port) in pcap.tcp">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ pcap.ip_connections[port.ip].src }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ pcap.ip_connections[port.ip].dst }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ port.port }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ pcap.ip_connections[port.ip].country }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ pcap.ip_connections[port.ip].is_eu }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div v-if="page==='udp'">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  IP SRC
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  IP DST
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  DST PORT
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Land
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Europa
                </th>
              </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="(port) in pcap.udp">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ pcap.ip_connections[port.ip].src }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ pcap.ip_connections[port.ip].dst }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ port.dstPort }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ pcap.ip_connections[port.ip].country }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ pcap.ip_connections[port.ip].is_eu }}</td>
              </tr>
              </tbody>
            </table>
          </div>

          <div v-if="page==='dns'">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    IP Client
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    DNS Server
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Addresse
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Host
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <template v-for="(dns) in pcap.dns">
                  <tr>
                    <td class="px-6 py-3 text-sm text-gray-500">{{ dns.src }}</td>
                    <td class="px-6 py-3 text-sm text-gray-500">{{ dns.dst }}</td>
                    <td class="px-6 py-3 text-sm text-gray-500"><span class="break-all">{{ dns.name }}</span></td>
                    <td class="px-6 py-3 text-sm text-gray-500"><div v-for="address in dns.address">{{ address }}</div></td>
                  </tr>
                </template>
              </tbody>
            </table>
          </div>
          <div v-if="page==='ip'">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    SRC
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    DST
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Land
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Europa
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="ip_connection in pcap.ip_connections">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ ip_connection.src }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ ip_connection.dst }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ ip_connection.country }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ ip_connection.is_eu }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div v-if="page==='devices'">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    SRC
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    DST
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="(eth) in pcap.eth_connections">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ eth.src }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ eth.dst }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div v-if="page==='http'">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    SRC
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    DST
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    HOST
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    URI
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Land
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Europa
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="(http) in pcap.http" class="hover:bg-gray-50 cursor-pointer">
                  <td class="px-6 py-4 text-sm text-gray-500">{{ pcap.ip_connections[http.ip].src }}</td>
                  <td class="px-6 py-4 text-sm text-gray-500">{{ pcap.ip_connections[http.ip].dst }}</td>
                  <td class="px-6 py-4 text-sm text-gray-500">{{ http.host }}</td>
                  <td class="px-6 py-3 text-sm text-gray-500">
                    <div v-for="uri in http.uri"><span class="break-all">{{ uri }}</span></div>
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-500">{{ pcap.ip_connections[http.ip].country }}</td>
                  <td class="px-6 py-4 text-sm text-gray-500">{{ pcap.ip_connections[http.ip].is_eu }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div v-if="page==='tls'">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    SRC
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    DST
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Port
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    SDI
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Land
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Europa
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="(tls) in pcap.tls">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ tls.src }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ tls.dst }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ tls.port }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ tls.sni }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ tls.country }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ tls.is_eu }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- Secondary column (hidden on smaller screens) -->
      <aside class="hidden lg:block lg:flex-shrink-0 lg:order-first">
        <div class="bg-white g-white rounded-md shadow">
          <div class="w-64 mx-auto">
            <nav class="space-y-1" aria-label="Sidebar">
              <a class="cursor-pointer text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium " :class="page==='tcp' ? 'bg-gray-100' : ''" @click="page='tcp'">
                <span class="truncate">
                  TCP
                </span>
              </a>
              <a class="cursor-pointer text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium " :class="page==='udp' ? 'bg-gray-100' : ''" @click="page='udp'">
                <span class="truncate">
                  UDP
                </span>
              </a>

              <a class="cursor-pointer text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium" :class="page==='dns' ? 'bg-gray-100' : ''" @click="page='dns'">
                <span class="truncate">
                  DNS
                </span>
              </a>

              <a class="cursor-pointer text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium rounded-md" :class="page==='ip' ? 'bg-gray-100' : ''" @click="page='ip'">
                <span class="truncate">
                  IP Verbindungen
                </span>
              </a>

              <a class="cursor-pointer text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium rounded-md" :class="page==='devices' ? 'bg-gray-100' : ''" @click="page='devices'">
                <span class="truncate">
                  Geräte
                </span>
              </a>
              <a class="cursor-pointer text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium rounded-md" :class="page==='http' ? 'bg-gray-100' : ''" @click="page='http'">
                <span class="truncate">
                  HTTP
                </span>
              </a>
              <a class="cursor-pointer text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium rounded-md" :class="page==='tls' ? 'bg-gray-100' : ''" @click="page='tls'">
                <span class="truncate">
                  TLS
                </span>
              </a>
            </nav>
          </div>
        </div>
      </aside>
    </main>
  </div>
</template>

<script>
import {Head} from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import { useForm } from '@inertiajs/inertia-vue3'
import {Link} from '@inertiajs/inertia-vue3'

export default {
  components: {
    Head, Link,
  },
  layout: Layout,
  props: {
    filters: Object,
    pcap: Object,
    people: Object,
  },
  setup () {
    const form = useForm({
    })

    function submit() {
    }

    return { form, submit }
  },

  data() {
    return {
      page: 'tcp',

      ip_columns: [
        {
          field: 'src',
          title: 'Src',
        },
        {
          field: 'dst',
          name: 'Dst',
        }],
    }
  },
}
</script>
