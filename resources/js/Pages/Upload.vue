<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import VideoPreview from '@/Components/VideoPreview.vue'
import UploadSettings from '@/Components/UploadSettings.vue'
</script>

<template>
  <MainLayout>
    <div id="settings" class="flex w-full bg-[#1C1C1C] rounded-md">
      <VideoPreview />
      <UploadSettings />
    </div>
  </MainLayout>
</template>
