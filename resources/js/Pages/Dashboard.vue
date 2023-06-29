<script setup>
import { Head } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'
import VideoCard from '@/Components/VideoCard.vue'

const props = defineProps({
  slips: Object,
})
console.log(props.slips)
</script>

<template>
  <Head title="Dashboard" />
  <MainLayout class="relative">
    <div class="w-full flex justify-center">
      <div class="w-[calc(100%-3rem)] grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-7">
          <VideoCard v-for="slip in slips" :key="slip" :slip="slip" />
      </div>
    </div>
  </MainLayout>
</template>

<style>
</style>
