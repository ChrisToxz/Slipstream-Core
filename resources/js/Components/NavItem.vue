<script setup>
import {Link, usePage} from '@inertiajs/vue3'
const props = defineProps({ link: String })

const navItemClass = (route) => {
  route === 'dashboard' ? route = '' : route
  return usePage().url === '/' + route ? 'text-[#0580c5]' : 'text-gray-200'
}

</script>

<template>
  <Link :href="route(link)">
    <p
      class="
        text-base
        py-2
        px-4
        transition-all
        cursor-pointer
        hover:text-brand-red-500
        "
      :class="navItemClass(link)"
    >
      <slot />
    </p>
  </Link>
</template>
