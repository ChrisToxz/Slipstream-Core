<script setup>
const props = defineProps({
  modelValue: String,
})
</script>

<template>
  <input
    class="w-full rounded-md bg-brand-secondary-700 border border-black text-gray-200 focus:border-brand-primary-500 focus:ring-0" type="text"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
</template>
