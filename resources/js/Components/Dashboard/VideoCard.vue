<script setup>
import { Link } from '@inertiajs/vue3'
import {computed, ref} from 'vue'
import Settings from '~icons/ic/baseline-video-settings'
import Download from '~icons/ion/download'
import Trash from '~icons/mdi/trash'
import Play from '~icons/ion/play'
import moment from 'moment'

const hoverEffect = ref(false)

const props = defineProps({
  slip: Object,
})

// Create Timestamp
const relativeTime = computed(
  () => moment(props.slip.created_at).fromNow(),
)

const percentage = ref(0)

window.Echo.channel(`slip.${props.slip.token}`).listen('SlipProcessUpdate', (e) => {
  percentage.value = e.percentage
})

console.log(percentage.value) // pending, finished

</script>

<template>
  <!-- Main Wrapper -->
  <div class="bg-white bg-opacity-10 flex relative rounded-lg z-0 aspect-video shadow-md overflow-hidden transition-all duration-500 ease-in-out" @mouseover="hoverEffect = true" @mouseleave="hoverEffect = false">
    <div v-if="props.slip.status === 'finished'" class="absolute z-2 w-full flex flex-col justify-between h-full">
      <div class="flex justify-between mt-2 px-2">
        <!-- Top Left Icons -->
        <div class="flex flex-col text-gray-200 rounded-lg text-center text-sm">
          <p class="bg-[rgba(5,128,197,0.6)] rounded-lg">Public</p>
          <p class="bg-[rgba(5,128,197,0.6)] rounded-lg px-2 mt-2">200 Views</p>
        </div>
        <div>
          <!--            Just for testing sake! -->
          <div class="bg-red-500 rounded-lg px-2 text-gray-200 text-sm">
            <p class="text-center">
              Debug:
            </p>
            {{ percentage }} % - {{ slip.status }}
          </div>
        </div>

        <!-- TimeStamp -->
        <div>
          <p class="text-gray-200">00:00</p>
        </div>
      </div>
      <!-- Play Button -->
      <div class="w-full flex justify-center">
        <Link :href="route('slip', slip.token)">
          <div class="bg-[rgba(5,128,197,0.6)] rounded-full w-9 h-9 flex items-center justify-center">
            <Play color="white" />
          </div>
        </Link>
      </div>
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
              <Trash color="white" width="25" height="25" />
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div v-if="props.slip.status === 'pending'" class="z-2 absolute w-full h-full bg-[rgba(0,0,0,0.6)] flex flex-col justify-between items-center">
      <div class="w-full h-1 rounded-lg bg-gray-700 overflow-hidden shadow-md relative">
        <div :style="{width: `${percentage}%`}" class="h-full bg-gradient-to-r from-brand-primary-500 via-brand-primary-600 to-brand-primary-700 animate-gradient shadow-lg relative transition-all duration-500 ease-in-out">
          <div class="absolute w-full h-full bg-blue-700 opacity-50 animate-pulse" />
        </div>
      </div>
      <p class="text-gray-200 pt-2">{{ percentage }}%</p>
      <p class="text-gray-200 pb-2">Uploading {{ slip.title }}</p>
    </div>
    <!-- Thumbnail -->
    <img :class="{ 'scale-[1.1]': hoverEffect }" class="rounded-lg object-cover h-full w-full transition-all duration-500 ease-in-out -z-[1]" :src="slip.thumb" alt="racing thumbnail" />
  </div>
</template>

<style scoped>
@keyframes gradient {
    0% {
        background-position: 200% 0;
    }
    100% {
        background-position: -200% 0;
    }
}

.animate-gradient {
    background-size: 200% 100%;
    animation: gradient 1.5s linear infinite;
}
</style>
