<script setup>
import NavItem from '@/Components/NavItem.vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link, usePage } from '@inertiajs/vue3'

console.log(usePage().url)

const navItemClass = (route) => {
  return usePage().url === '/' + route ? 'text-[#0580c5]' : 'text-gray-200'
}
</script>

<template>
  <div class="antialiased bg-background-surface font-brand font-light bg-neutral-900">
    <div class="flex flex-row">
      <!-- Main wrapper -->
      <div class="flex flex-col basis-full mb-10">
        <!-- content area -->
        <header class="flex h-20 flex-row justify-between mt-5 mx-8">
          <!-- Header -->
          <div class="self-center">
            <ApplicationLogo />
          </div>
          <nav class="basis-1/6 self-center bg-background-secondary rounded-md">
            <ul class="flex justify-around gap-8 sm:gap-2">
              <li><Link href="/"><NavItem :class="navItemClass('')">Dashboard </NavItem></Link></li>
              <li><NavItem class="text-gray-200">Settings</NavItem></li>
              <li><Link :href="route('upload')"><NavItem :class="navItemClass('upload')">Upload</NavItem></Link></li>
            </ul>
          </nav>
        </header>
      </div>
    </div>
  </div>
  <section id="content" class="min-h-calc-screen-140 bg-neutral-900">
    <slot />
  </section>
</template>
