<script setup>
const props = defineProps({
  modelValue: String,
})
</script>

<template>
  <textarea
    class="w-full bg-brand-secondary-700 border-black text-gray-200 focus:ring-0 focus:border-brand-primary-500"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
</template>
