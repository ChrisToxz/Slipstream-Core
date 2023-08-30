<script setup>
defineProps({
  modelValue: String,
})
defineEmits(['update:modelValue'])
</script>

<template>
  <input
    class="w-full rounded-md bg-neutral-800 border border-neutral-600 text-white text-opacity-50 focus:border-brand-primary-400 focus:border-opacity-90 focus:ring-0 shadow-[66666690_0_0_2px] hover:shadow-[#66666690_0_0_4px] focus:shadow-[#00A4FF90_0_0_4px] hover:focus:shadow-[#00A4FF_0_0_4px] transition-all duration-100" type="text"
    :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
  />
</template>
