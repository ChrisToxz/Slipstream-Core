<script setup>
import { Link } from '@inertiajs/vue3'
import {computed, ref} from 'vue'
import moment from 'moment'
import DeleteSlipModal from '@/Components/Dashboard/DeleteSlipModal.vue'

import ProgressBar from '@/Components/Reusable/ProgressBar.vue'

import Settings from '~icons/ic/baseline-video-settings'
import Download from '~icons/ion/download'
import Trash from '~icons/mdi/trash'

import OriginalType from '~icons/mdi/video'
import OptimizedType from '~icons/ph/video'
import StreamableType from '~icons/solar/play-stream-bold'

const hoverEffect = ref(false)
const hover = ref(false)
let showDeleteModal = ref(false)

const props = defineProps({
  slip: Object,
})

// Create Timestamp
const relativeTime = computed(
  () => moment(props.slip.created_at).fromNow(),
)

// const formattedDuration = computed(
//   () => moment.utc(props.slip.mediable.duration * 1000).format('mm:ss'),
// )

const formattedDuration = computed(
  () =>moment.utc(props.slip.mediable.duration*1000).format('mm:ss'),
)

const percentage = ref(0)
const status = ref('Preparing...')

window.Echo.channel(`slip.${props.slip.token}`).listen('SlipProcessUpdate', (e) => {
  percentage.value = e.percentage
  status.value = e.status
})

const TypeIcon = computed(() => {

  switch (props.slip.mediable.type) {
  case 1:
    return OriginalType
  case 2:
    return OptimizedType
  case 3:
    return StreamableType
  default:
    return OriginalType
  }
})

</script>

<template>
  <!-- Main Wrapper -->
  <div class="bg-white bg-opacity-10 flex relative rounded-lg z-0 aspect-video shadow-md overflow-hidden transition-all duration-500 ease-in-out" @mouseover="hoverEffect = true" @mouseleave="hoverEffect = false">
    <div v-if="props.slip.status === 'finished'" class="absolute z-2 w-full flex flex-col justify-between h-full">
      <div class="flex justify-between mt-2 px-2">
        <!-- Top Left Icons -->
        <div class="flex flex-row text-gray-200 rounded-lg text-center text-sm gap-3" />
        <!-- TimeStamp -->
        <div class="flex flex-row gap-3">
          <div>
            <p class="bg-neutral-950 bg-opacity-75 rounded-lg p-1 text-gray-200 text-sm">
              {{ formattedDuration }}
            </p>
          </div>
          <div>
            <p class="bg-neutral-950 bg-opacity-75 rounded-lg p-1 text-gray-200 text-sm">
              {{ slip.mediable.height }}p
            </p>
          </div>
          <div>
            <div class="bg-neutral-950 bg-opacity-75 rounded-lg p-1 text-gray-200">
              <TypeIcon />
            </div>
          </div>
        </div>
      </div>
      <!-- Play Button -->
      <div class="w-full flex justify-center" />
      <!-- Card Footer -->
      <div class="bg-black opacity-80 flex justify-between text-opacity-100 text-white px-4 py-2">
        <div>
          <Link :href="route('slip', slip.token)">
            <p class="text-lg">
              {{ slip.title }}
            </p>
          </Link>
          <p class="text-sm text-de text-brand-primary-400">
            {{ slip.description }}
          </p>
          <p class="text-sm text-gray-500">
            Created {{ relativeTime }}
          </p>
        </div>
        <div class="flex self-center h-5/6">
          <ul class="flex text-3xl">
            <li class="bg-brand-primary-600 rounded-full w-10 h-10 flex items-center justify-center self-center cursor-pointer transition-all hover:bg-brand-primary-700 mr-2">
              <Settings color="white" width="25" height="25" />
            </li>
            <li class="px-1 bg-brand-primary-600 rounded-full w-10 h-10 flex items-center justify-center self-center cursor-pointer transition-all hover:bg-brand-primary-700 mr-2">
              <Download color="white" width="25" height="25" />
            </li>
            <li class="px-1 bg-brand-primary-600 rounded-full w-10 h-10 flex items-center justify-center self-center cursor-pointer transition-all hover:bg-brand-primary-700">
              <Trash color="white" width="25" height="25" @click="showDeleteModal = true" />
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div v-if="props.slip.status != 'finished'" class="z-2 absolute w-full h-full bg-[rgba(0,0,0,0.6)] flex flex-col justify-between items-center">
      <ProgressBar :percentage="percentage" />
      <p class="text-gray-200 pt-2">{{ percentage }}%</p>
      <p class="text-gray-200 pb-2">{{ status }} - {{ slip.title }}</p>
    </div>
    <span
      @mouseover="hover = true"
      @mouseleave="hover = false"
    >
      <!-- Thumbnail -->
      <img class="rounded-lg object-cover h-full w-full transition-all duration-500 ease-in-out -z-[1]" :src="slip.thumb" alt="racing thumbnail" />
      <!--      <video v-if="hoverEffect" ref="video" class="`transition-all duration-200 rounded-lg object-cover h-full w-full transition-all duration-500 ease-in-out -z-[1]" :src="slip.mediable.path" controls autoplay />-->
      <DeleteSlipModal v-if="showDeleteModal" :slip="slip" @close="showDeleteModal = false" />
    </span>
  </div>
</template>
