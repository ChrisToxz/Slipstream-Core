<script setup>
const props = defineProps({
  percentage: Number,
})
</script>

<template>
  <div class="w-full h-1 rounded-lg bg-gray-700 overflow-hidden shadow-md relative">
    <div :style="{width: `${percentage}%`}" class="h-full bg-gradient-to-r from-brand-primary-500 via-brand-primary-600 to-brand-primary-700 animate-gradient shadow-lg relative transition-all duration-500 ease-in-out rounded-lg">
      <div class="absolute w-full h-full bg-blue-700 opacity-50 animate-pulse rounded-lg" />
    </div>
  </div>
</template>

<style scoped>
@keyframes gradient {
    0% {
        background-position: 200% 0;
    }
    100% {
        background-position: -200% 0;
    }
}

.animate-gradient {
    background-size: 200% 100%;
    animation: gradient 1.5s linear infinite;
}
</style>
