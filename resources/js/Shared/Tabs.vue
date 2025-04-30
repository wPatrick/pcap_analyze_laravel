<template>
  <div class="block border-gray-200 border bg-white">
    <div class="border-gray-200">
      <nav class="relative flex divide-x" aria-label="Tabs">
        <a v-for="(tab, index) in tabs" :key="tab.name" :href="tab.href" :class="[tab.href===currentTab ? '':'bg-gray-100 border-b', index === tabs.length -1 ? 'flex-grow':'']" class="p-4" :aria-current="tab.current ? 'page' : undefined">
          <span>{{ tab.name }}</span>
          <span aria-hidden="true" />
        </a>
      </nav>
    </div>
    <template v-for="(tab) in tabs" :key="tab.href">
      <div v-if="currentTab === tab.href">
        <slot :name="tab.href" />
      </div>
    </template>
  </div>
</template>

<script>
import { computed, defineEmits, defineProps } from 'vue'

export default {
  props: {
    'modelValue': Object
  },

  emits: ['update.modelValue'],

  setup(props, { emit }) {
    const tabs = computed({
      get: () => props.modelValue,
      set: (value) => emit('update.modelValue', value),
    })
    return {
      tabs,
    }
  },
  data() {
    return {
      currentTab: null,
    }
  },
  mounted: function() {
    window.onhashchange = this.tabChange
    if(window.location.hash)  this.setCurrentTab(window.location.hash)
    else {
      for(const element of this.tabs) {
        if(element.current === true) {
          this.setCurrentTab(element.href)
        }
      }
    }

  },
  methods: {
    tabChange: function() {
      this.setCurrentTab(window.location.hash)
    },
    setCurrentTab: function(tab) {
      this.currentTab = tab
    },
  },
}
</script>
