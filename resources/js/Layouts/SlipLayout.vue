<script setup>
import ApplicationLogo from '@/Components/UI/ApplicationLogo.vue'
</script>

<template>
  <!-- Header -->
  <header class="fixed w-full bg-gradient-to-t from-transparent to-neutral-800">
    <div class="p-4">
      <ApplicationLogo />
    </div>
  </header>
  <!-- Content -->
  <section id="view_slip">
    <slot />
  </section>
  <!-- Footer -->
  <footer class="fixed bottom-0 w-full py-2 flex align-center justify-end bg-gradient-to-b from-transparent to-neutral-800">
    <a href="https://github.com/ChrisToxz/Slipstream-Core" target="_blank">
      <p class="text-white">Powered By</p>
      <ApplicationLogo class="w-40 mr-4" />
    </a>
  </footer>
</template>
