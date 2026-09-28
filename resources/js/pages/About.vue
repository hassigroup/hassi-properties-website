<script setup lang="ts">
defineProps<{ company: string }>()
</script>

<template>
  <div class="p-8">
    <h1 class="text-3xl font-bold">About {{ company }}</h1>
    <p class="mt-4 text-gray-600">This page is rendered by Vue, fed by Laravel.</p>
  </div>
</template>