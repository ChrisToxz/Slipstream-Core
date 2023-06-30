<script setup>
import { ref } from 'vue'
import NavItem from '@/Components/NavItem.vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import UploadModal from '@/Components/UploadModal.vue'
import SettingsModal from '@/Components/SettingsModal.vue'

let showUploadModal = ref(false)
let showSettingsModal = ref(false)
</script>

<template>
  <div class="antialiased bg-neutral-900 min-h-screen">
    <div class="flex">
      <!-- Main wrapper -->
      <div class="flex flex-col basis-full mb-10">
        <!-- Header -->
        <header class="flex h-20 justify-between mt-5 mx-8">
          <div class="self-center">
            <ApplicationLogo />
          </div>
          <!-- Navigation -->
          <nav class="basis-1/6 self-center bg-brand-secondary-700 rounded-md">
            <ul class="flex justify-around gap-8 sm:gap-2">
              <li><NavItem link="dashboard">Dashboard </NavItem></li>
              <li><NavItem @click="showSettingsModal = true">Settings</NavItem></li>
              <li><NavItem @click="showUploadModal = true">Upload</NavItem></li>
            </ul>
          </nav>
        </header>
      </div>
    </div>
    <!-- Content -->
    <section id="content">
      <slot />
    </section>
  </div>
  <UploadModal v-if="showUploadModal" @close="showUploadModal = false" />
  <SettingsModal v-if="showSettingsModal" @close="showSettingsModal = false" />
</template>
