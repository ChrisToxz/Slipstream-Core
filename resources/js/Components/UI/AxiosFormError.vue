<script setup>
const props = defineProps({
  errors: String,
})
</script>

<template>
  <p v-for="message in errors" :key="message" class="text-red-500 font-extrabold">{{ message }}</p>
</template>
