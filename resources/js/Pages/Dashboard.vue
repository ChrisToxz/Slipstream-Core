<script setup>
import {Head, usePage} from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'
import VideoCard from '@/Components/Dashboard/VideoCard.vue'
import {computed, ref} from 'vue'
import useSlipSockets from '@/Composables/useSlipSockets.js'
import {useInfiniteScrolling} from '@/Composables/useInfiniteScrolling.js'
import Loading from '@/Components/UI/Loading.vue'

const slips = ref(computed(() => usePage().props.slips))
const { loadMoreIntersect, isFetching } = useInfiniteScrolling(slips)
useSlipSockets()
</script>

<template>
  <Head title="Dashboard" />
  <MainLayout>
    <div class="w-full flex justify-center">
      <div class="w-[calc(100%-3rem)] grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-7">
        <VideoCard v-for="slip in slips.data" :key="slip.token" :slip="slip" />
      </div>
    </div>
    <span ref="loadMoreIntersect" />
    <div class="flex items-center justify-center p-8">
      <div v-if="isFetching">
        <Loading />
        <span class="sr-only">Loading more...</span>
      </div>
    </div>
  </MainLayout>
</template>
<style>
</style>
