<script setup>
import {Head, router} from '@inertiajs/vue3'
import {useSnackbar, Vue3Snackbar} from 'vue3-snackbar'
import MainLayout from '@/Layouts/MainLayout.vue'
import VideoCard from '@/Components/Dashboard/VideoCard.vue'

const props = defineProps({
  slips: Object,
})

const snackbar = useSnackbar()

window.Echo.channel('ss').listen('SlipProcessFinished', () => {
  router.reload(route('dashboard'), {
    preserveState: true,
    only:['slips'],
  })
  snackbar.add({
    type:'success',
    text: 'Slip successfully uploaded',
  })
})
</script>

<template>
  <Head title="Dashboard" />
  <MainLayout class="relative">
    <div class="w-full flex justify-center">
      <div class="w-[calc(100%-3rem)] grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-7">
        <VideoCard v-for="slip in slips" :key="slip.token" :slip="slip" />
      </div>
    </div>
  </MainLayout>
  <vue3-snackbar top right />
</template>
<style>
</style>
