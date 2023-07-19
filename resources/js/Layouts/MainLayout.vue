<script setup>
import {ref} from 'vue'
import NavItem from '@/Components/Reusable/NavItem.vue'
import ApplicationLogo from '@/Components/Reusable/ApplicationLogo.vue'
import UploadModal from '@/Components/Upload/UploadModal.vue'
import {Vue3Snackbar} from 'vue3-snackbar'
import SettingsModal from '@/Components/Settings/SettingsModal.vue'

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
              <li><NavItem link="dashboard" class="text-brand-primary-500">Dashboard </NavItem></li>
              <li><NavItem class="text-gray-200 hover:text-gray-400" @click="showSettingsModal = true">Settings</NavItem></li>
              <li><NavItem class="text-gray-200 hover:text-gray-400" @click="showUploadModal = true">Upload</NavItem></li>
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
  <transition name="modal">
    <SettingsModal v-if="showSettingsModal" @close="showSettingsModal = false" />
  </transition>
  <vue3-snackbar top right />
</template>

<style scoped>
.modal-enter-from {
    transform: translateX(100%);
}

.modal-enter-active {
    transition: all 0.3s ease-out;
}

.modal-enter-to {
    transform: translateX(0);
}

.modal-leave-active {
    transition: all 0.3s ease-out;
}

.modal-leave-from {
    transform: translateX(0);
}

.modal-leave-to {
    transform: translateX(100%);
}
</style>
