<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <p
    class="
        text-base
        py-2
        px-4
        transition-all
        cursor-pointer
        hover:text-brand-red-500
    "
  >
    <slot />
  </p>
</template>
