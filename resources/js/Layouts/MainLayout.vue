<script setup>
import {ref} from 'vue'
import NavItem from '@/Components/UI/NavItem.vue'
import ApplicationLogo from '@/Components/UI/ApplicationLogo.vue'
import UploadModal from '@/Components/Dashboard/UploadModal.vue'
import {Vue3Snackbar} from 'vue3-snackbar'
import SettingsModal from '@/Components/Settings/SettingsModal.vue'
import {Link, usePage} from '@inertiajs/vue3'

let showUploadModal = ref(false)
let showSettingsModal = ref(false)

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
            <div v-if="usePage().props.auth.user">
              <ul class="flex justify-around gap-8 sm:gap-2">
                <li><NavItem class="text-gray-300">Welcome, {{ $page.props.auth.user.name }}</NavItem></li>
                <li><NavItem link="dashboard" class="text-brand-primary-500" as="button">Dashboard </NavItem></li>
                <li><NavItem class="text-gray-200 hover:text-gray-400" as="button" @click="showSettingsModal = true">Settings</NavItem></li>
                <li><NavItem class="text-gray-200 hover:text-gray-400" @click="showUploadModal = true">Upload</NavItem></li>
                <li><NavItem class="text-gray-200 hover:text-gray-400"><Link :href="route('logout')" method="POST" as="button">Logout</Link></NavItem></li>
              </ul>
            </div>
            <div v-else>
              <NavItem><Link :href="route('login')" class="text-gray-200 hover:text-gray-400">Login</Link></NavItem>
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
