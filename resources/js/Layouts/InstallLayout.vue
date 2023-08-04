<script setup>
import ApplicationLogo from '@/Components/UI/ApplicationLogo.vue'
import {Vue3Snackbar} from 'vue3-snackbar'
</script>

<template>
  <div class="bg-neutral-900 min-h-screen">
    <div class="flex">
      <!-- Main wrapper -->
      <div class="flex flex-col basis-full mb-10">
        <!-- Header -->
        <header class="flex h-20 justify-between mt-5 mx-8">
          <div class="self-center">
            <ApplicationLogo />
          </div>
          <!-- Navigation -->
          <nav class="self-center bg-brand-secondary-700 rounded-md">
            <div>
              <ul class="flex justify-around p-2 text-gray-300">
                <li>Installation</li>
              </ul>
            </div>
          </nav>
        </header>
      </div>
    </div>
    <!-- Content -->
    <section id="content">
      <slot />
    </section>
  </div>
  <vue3-snackbar top right />
</template>

