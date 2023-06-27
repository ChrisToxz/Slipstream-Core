<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import VideoPreview from '@/Components/VideoPreview.vue'
import UploadSettings from '@/Components/UploadSettings.vue'
</script>

<template>
  <MainLayout>
    <div class="flex">
      <VideoPreview />
      <UploadSettings />
    </div>
  </MainLayout>
</template>
