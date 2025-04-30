<template>
  <div>
    <div class="flex-grow flex flex-col">
      <nav class="flex-1 space-y-1" aria-label="Sidebar">
        <template v-for="item in menu.items" :key="item.title">
          <template v-if="item.children.length === 0">
            <Link :href="item.path" :class="[item.is_active ? 'text-white' : 'text-indigo-300 ', 'group w-full flex items-center pl-2 py-2 text-sm font-medium hover:text-white active:text-white']">
              <Icon :name="item.icon" :class="[item.is_active ? 'text-white' : 'text-indigo-300 ', 'mr-3 flex-shrink-0 h-6 w-6 group-hover:text-white']" aria-hidden="true" />
              {{ item.title }}
            </Link>
          </template>
          <template v-else>
            <Disclosure v-slot="{ open }" :defaultOpen="item.is_active">
              <DisclosureButton>
                <Link :href="item.path" :class="[item.is_active ? 'text-white' : 'text-indigo-300 ', 'group w-full flex items-center pl-2 py-2 text-sm font-medium hover:text-white active:text-white']">
                  <Icon :name="item.icon" :class="[item.is_active ? 'text-white' : 'text-indigo-300 ', 'mr-3 flex-shrink-0 h-6 w-6 group-hover:text-white']" aria-hidden="true" />
                  {{ item.title }}
                  <Icon name="ChevronRightIcon" :class="[open ? 'transform rotate-90' : '', 'ml-3 flex-shrink-0 h-5 w-5 transform group-hover:text-white transition-colors ease-in-out duration-150']" />
                </Link>
              </DisclosureButton>
              <DisclosurePanel>
                <Link v-for="subItem in item.children" :href="subItem.path" :class="[subItem.is_active ? 'text-white' : 'text-indigo-300 ', 'group w-full flex items-center pl-11 py-2 text-sm font-medium hover:text-white active:text-white']">
                  {{ subItem.title }}
                </Link>
              </DisclosurePanel>
            </Disclosure>
          </template>
        </template>
      </nav>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
import Icon from '@/Shared/Icon'


export default {
  components: {
    DisclosurePanel,
    Disclosure,
    DisclosureButton,
    Icon,
    Link,
  },
  props: {
    menu: Object,
  },
}
</script>
