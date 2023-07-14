<script setup>
import {Head, router, usePage} from '@inertiajs/vue3'
import {useSnackbar, Vue3Snackbar} from 'vue3-snackbar'
import MainLayout from '@/Layouts/MainLayout.vue'
import VideoCard from '@/Components/Dashboard/VideoCard.vue'
import {onMounted, reactive, ref} from 'vue'

const snackbar = useSnackbar()

const props = defineProps({
  slips: Object,
})

let allSlips = reactive({data: props.slips.data})
const initUrl = usePage().url
const loadMoreIntersect = ref(null)
function loadMoreSlips() {
  if (props.slips.next_page_url === null) {
    return
  }
  router.get(props.slips.next_page_url, {}, {
    preserveState: true,
    preserveScroll: true,
    only: ['slips'],
    onSuccess: (page) => {
      allSlips.data = [...allSlips.data, ...page.props.slips.data]
      window.history.replaceState({}, '' , initUrl)
    },
  })
}

onMounted(() => {
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        loadMoreSlips()
      }
    })
  }, {
    rootMargin: '-100px 0px 0px 0px',
  })
  observer.observe(loadMoreIntersect.value)
})
/* Websockets
    TODO: Move to composable
 */
window.Echo.channel('ss').listen('SlipProcessFinished', (e) => {
  router.reload({
    preserveState: true,
    only:['slips'],
    onSuccess: (page) => {
      allSlips.data = page.props.slips.data
    },
  })
  if(!e.failed){
    snackbar.add({
      type:'success',
      text: 'Slip successfully processed',
    })
  }else{
    snackbar.add({
      type:'error',
      text: 'Processing failed for ' + e.slip.title,
    })
  }
})

window.Echo.channel('ss').listen('SlipUploaded', (e) => {
  router.reload({
    preserveState: true,
    only: ['slips'],
    onSuccess: (page) => {
      allSlips.data = page.props.slips.data
    },
  })
})
</script>

<template>
  <Head title="Dashboard" />
  <MainLayout>
    <div class="w-full flex justify-center">
      <div class="w-[calc(100%-3rem)] grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-7">
        <VideoCard v-for="slip in allSlips.data" :key="slip.token" :slip="slip" />
      </div>
    </div>
    <span ref="loadMoreIntersect" />
  </MainLayout>
  <vue3-snackbar top right />
</template>
<style>
</style>
