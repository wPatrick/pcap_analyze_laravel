<template>
  <div class="p-4">
    <div class="max-w-3xl border rounded border-gray-200 bg-white">
      <div class="py-3 px-4 border-b flex justify-between items-center">
        <h2 class="text-lg font-medium text-gray-700">Gerätetyp erstellen</h2>
      </div>
      <div class="p-4 text-gray-600">
        <slot />
      </div>
    </div>
  </div>
</template>

<script lang="ts">
export default {
  name: 'CreateDeviceType',
}
</script>
