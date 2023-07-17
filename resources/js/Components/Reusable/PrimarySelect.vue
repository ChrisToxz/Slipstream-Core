<script setup>
const props = defineProps({
  modelValue: String,
})
</script>

<template>
  <select
    class="w-full bg-brand-secondary-700 text-gray-200 focus:ring-0 focus:border-brand-primary-500"
    :value="modelValue"
    @change="$emit('update:modelValue', $event.target.value)"
  >
    <slot />
  </select>
</template>
