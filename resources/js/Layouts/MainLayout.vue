<script setup>
import NavItem from '@/Components/NavItem.vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import UploadModal from '@/Components/UploadModal.vue'
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'

let showUploadModal = ref(false)
</script>

<template>
  <div class="antialiased bg-background-surface font-brand font-light bg-neutral-900 min-h-screen">
    <div class="flex flex-row">
      <!-- Main wrapper -->
      <div class="flex flex-col basis-full mb-10">
        <!-- content area -->
        <header class="flex h-20 flex-row justify-between mt-5 mx-8">
          <!-- Header -->
          <div class="self-center">
            <ApplicationLogo />
          </div>
          <nav class="basis-1/6 self-center bg-brand-secondary-700 rounded-md">
            <ul class="flex justify-around gap-8 sm:gap-2">
              <li><Link :href="route('dashboard')"><NavItem link="dashboard">Dashboard </NavItem></Link></li>
              <li><Link :href="route('settings')"><NavItem link="settings" class="text-gray-200">Settings</NavItem></Link></li>
              <li><NavItem @click="showUploadModal = true">Upload</NavItem></li>
            </ul>
          </nav>
        </header>
      </div>
    </div>
    <section id="content">
      <slot />
    </section>
  </div>
  <UploadModal v-if="showUploadModal" @close="showUploadModal = false" />
</template>
