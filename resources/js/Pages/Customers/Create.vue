<template>
  <div className="p-4">
    <div className="max-w-3xl border rounded border-gray-200 bg-white">
      <div className="py-3 px-4 border-b flex justify-between items-center">
        <h2 className="text-lg font-medium text-gray-700">Kunde erstellen</h2>
      </div>
      <div className="p-4 text-gray-600">
        <slot/>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Create.vue',
}
</script>

<style scoped>

</style>
