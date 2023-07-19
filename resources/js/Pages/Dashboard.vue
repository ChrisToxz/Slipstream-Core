<script setup>
import {Head, usePage} from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'
import VideoCard from '@/Components/Dashboard/VideoCard.vue'
import {computed, ref} from 'vue'
import {useSnackbar} from 'vue3-snackbar'
import useSlipSockets from '@/Composables/useSlipSockets.js'
import {useInfiniteScrolling} from '@/Composables/useInfiniteScrolling.js'
import Loading from '@/Components/Loading.vue'

const snackbar = useSnackbar()
const slips = ref(computed(() => usePage().props.slips))

// TODO: Refactor
function test(v){
  const existingIndex = slips.value.data.findIndex(slip => slip.id === v.id)

  if (existingIndex !== -1) {
    // Update existing slip
    slips.value.data.splice(existingIndex, 1, v)
  } else {
    // Add new slip
    slips.value.data.push(v)
  }
}

const { loadMoreIntersect, isFetching } = useInfiniteScrolling(slips)

useSlipSockets(snackbar)
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
  <vue3-snackbar top right />
</template>
<style>
</style>
