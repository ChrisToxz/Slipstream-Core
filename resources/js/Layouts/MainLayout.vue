<script setup>
import NavItem from '@/Components/NavItem.vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Head, Link } from '@inertiajs/vue3'

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
              <li><NavItem class="text-[#0580c5]">Dashboard </NavItem></li>
              <li><NavItem class="text-gray-200">Settings</NavItem></li>
              <button class="text-gray-200"><NavItem>Upload</NavItem></button>
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
