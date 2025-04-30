<template>
  <div>
    <confirm-modal v-model="modelValue" @confirm="confirm">
      <template #DialogTitle>Gerät erstellen</template>
      <template #DialogText>
        <form>
          <TextInput v-model="form.name" class="pb-8 w-full " label="Name" :error="this.errors.name" />
          <TextInput id="device-ip" v-model="form.ip_address" class="pb-8 w-full" label="IP" :error="this.errors.ip_address"/>
        </form>
      </template>
      <template #ConfirmationText>Gerät erstellen</template>
    </confirm-modal>
  </div>
</template>

<script>

import TextInput from '@/Shared/TextInput'
import {Head, Link} from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'
import ConfirmModal from '@/Shared/Modals/ConfirmModal'
import { usePage } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'

export default {
  name: 'CreateDevice',
  components: {
    TextInput,
    ConfirmModal,
  },
  props: {
    modelValue: null,
    processesId: null,
  },
  setup() {
    const errors = computed(() => usePage().props.value.errors)
    return { errors }
  },
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        ip_address: null,
        process_id: this.processesId,
      }),
      showDevicesCreate: false,
      confirmed: null,
    }
  },
  methods: {

    confirm(confirmed) {
      if(confirmed) {
        this.$data.confirmed = confirmed
        this.form.submit("post", route('processesDevices.store'), {
          onSuccess:  () => {
            this.$emit('confirm', true)
            this.$emit('update:modelValue', false)
          },
        })
      } else {
        this.$data.confirmed = confirmed
        this.$emit('update:modelValue', this.confirmed)
      }
    },
  },
}
</script>

<style scoped>

</style>
