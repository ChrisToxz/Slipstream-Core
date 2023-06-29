<script setup>
import { Head } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'
import VideoPreview from '@/Components/VideoPreview.vue'
import UploadSettings from '@/Components/UploadSettings.vue'
</script>

<template>
  <Head title="Upload" />

  <MainLayout>
    <div class="grid grid-cols-2 w-full min-h-calc-screen-140 pt-140px bg-[#1C1C1C] rounded-md">
      <VideoPreview />
      <UploadSettings />
    </div>
  </MainLayout>
</template>
