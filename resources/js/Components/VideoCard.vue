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

const relativeTime = computed(
  () => moment(props.slip.created_at).fromNow(),
)
</script>

<template>
  <div class="bg-white bg-opacity-10 flex relative rounded-lg z-0 aspect-video shadow-md overflow-hidden" @mouseover="hoverEffect = true" @mouseleave="hoverEffect = false">
    <div class="absolute z-2 w-full flex flex-col justify-between h-full">
      <div class="flex justify-between mt-2 px-2">
        <div class="flex flex-col text-gray-200 rounded-lg text-center text-sm">
          <p class="bg-[rgba(5,128,197,0.6)] rounded-lg">Public</p>
          <p class="bg-[rgba(5,128,197,0.6)] rounded-lg px-2 mt-2">200 Views</p>
        </div>
        <div>
          <p class="text-gray-200">00:00</p>
        </div>
      </div>
      <div class="w-full flex justify-center">
        <div class="bg-[rgba(5,128,197,0.6)] rounded-full w-9 h-9 flex items-center justify-center">
          <Play color="white" />
        </div>
      </div>
      <div class="bg-black opacity-80 flex justify-between text-opacity-100 text-white px-4 py-2">
        <div>
          <Link :href="route('slip', slip.id)">
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
            <li class="bg-brand-primary-600 rounded-full w-10 h-10 flex items-center justify-center self-center cursor-pointer transition-all hover:text-status-warning-500 mr-2">
              <Settings color="white" width="25" height="25" />
            </li>
            <li class="px-1 bg-brand-primary-600 rounded-full w-10 h-10 flex items-center justify-center self-center cursor-pointer transition-all hover:bg-brand-primary-700 mr-2">
              <Download color="white" width="25" height="25" />
            </li>
            <li class="px-1 bg-brand-primary-600 rounded-full w-10 h-10 flex items-center justify-center self-center cursor-pointer transition-all hover:text-status-success-600">
              <Trash color="white" width="25" height="25" />
            </li>
          </ul>
        </div>
      </div>
    </div>
    <img :class="{ 'scale-[1.1]': hoverEffect }" class="rounded-lg object-cover h-full w-full transition-all duration-500 ease-in-out -z-[1]" src="/img/thumbnail.jpg" alt="racing thumbnail" />
  </div>
</template>
