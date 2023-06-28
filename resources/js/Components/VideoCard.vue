<script setup>
import { Link } from '@inertiajs/vue3'
import Settings from '~icons/ic/baseline-video-settings'
import Download from '~icons/ion/download'
import Trash from '~icons/mdi/trash'
import Play from '~icons/ion/play'
import {computed} from 'vue'
import moment from 'moment'

const props = defineProps({
  slip: Object,
})

const relativeTime = computed(
  () => moment(props.slip.created_at).fromNow(),
)
</script>

<template>
  <div class="bg-white bg-opacity-10 flex relative rounded-lg z-0 aspect-video shadow-md transition-all duration-300 hover:scale-[0.99] overflow-auto">
    <div class="absolute z-2 w-full flex flex-col justify-between h-full">
      <div class="w-[calc(100%-20px)] ml-[10px] flex justify-between mt-2">
        <div class="flex flex-row gap-2 text-gray-200 rounded-lg text-center text-sm">
          <p class="bg-[rgba(5,128,197,0.6)] rounded-lg p-1 px-2">Public</p>
          <p class="bg-[rgba(5,128,197,0.6)] rounded-lg p-1 px-2">200 Views</p>
        </div>
        <div>
          <p class="text-gray-200">00:00</p>
        </div>
      </div>
      <div class="w-full flex justify-center">
        <div class="bg-[rgba(5,128,197,0.6)] rounded-full w-[38px] h-[38px] flex items-center justify-center">
          <Play color="white" />
        </div>
      </div>
      <div class="bg-black opacity-80 flex justify-between text-opacity-100 text-white px-4 py-2">
        <div>
          <Link href="/">
            <p class="text-lg">
              {{ slip.title }}
            </p>
          </Link>
          <p class="text-sm text-de text-[#56B0E4]">
            {{ slip.description }}
          </p>
          <p class="text-sm text-gray-500">
            Created {{ relativeTime }}
          </p>
        </div>
        <div class="flex self-center h-5/6">
          <ul class="flex text-3xl">
            <li class="bg-[#0580c5] rounded-full w-[40px] h-[40px] flex items-center justify-center self-center cursor-pointer transition-all hover:text-status-warning-500 mr-2">
              <Settings color="white" width="25" height="25" />
            </li>
            <li class="px-1 bg-[#0580c5] rounded-full w-[40px] h-[40px] flex items-center justify-center self-center cursor-pointer transition-all hover:text-brand-primary-500 mr-2">
              <Download color="white" width="25" height="25" />
            </li>
            <li class="px-1 bg-[#0580c5] rounded-full w-[40px] h-[40px] flex items-center justify-center self-center cursor-pointer transition-all hover:text-status-success-500">
              <Trash color="white" width="25" height="25" />
            </li>
          </ul>
        </div>
      </div>
    </div>
    <img class="rounded-lg object-cover h-full w-full" src="/img/thumbnail.jpg" alt="racing thumbnail" />
  </div>
</template>
