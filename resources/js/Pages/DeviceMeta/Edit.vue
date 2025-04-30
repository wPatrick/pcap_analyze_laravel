<template>
  <div class="p-4">
    <div class="flex flex-row w-full">
      <div class="w-2/4 border rounded border-gray-200 bg-white">
        <div class="py-3 px-4 border-b flex justify-between items-center">
          <h2 class="text-lg font-medium text-gray-700">Gerät bearbeiten</h2>
        </div>
        <div class="p-4 text-gray-600">
          <slot />
        </div>
      </div>
      <div class="w-2/4 border rounded border-gray-200 bg-white">
        Geräte
      </div>
    </div>


    </div>
</template>

<script>
export default {
  name: 'EditDeviceMeta',
}
</script>

<style scoped>

</style>
