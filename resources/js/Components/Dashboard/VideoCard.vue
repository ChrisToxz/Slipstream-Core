<script setup>
import {Link} from '@inertiajs/vue3'
import {computed, ref} from 'vue'
import DeleteSlipModal from '@/Components/Dashboard/DeleteSlipDialog.vue'
import EditSlipModal from '@/Components/Dashboard/EditSlipModal.vue'
import ProgressBar from '@/Components/UI/ProgressBar.vue'

import {formattedDuration, relativeTime} from '@/Composables/useTimeManipulation.js'
import iconType from '@/Composables/useIconType.js'

import Settings from '~icons/ic/baseline-video-settings'
import Download from '~icons/ion/download'
import Trash from '~icons/mdi/trash'

const hoverEffect = ref(false)
const hover = ref(false)

const showEditSlip = ref(false)
const showDeleteDialog = ref(false)

const props = defineProps({
  slip: Object,
})

const slipProps = ref(null)

let slip = ref(computed(() => slipProps.value ? slipProps.value : props.slip))
const updateSlipsProps = (slip) => {
  slipProps.value = slip
}

const created_at = relativeTime(props.slip.created_at)
const duration = computed(() => {
  return formattedDuration(props.slip.mediable.duration)
})
const icon = computed(() => {
  return iconType(props.slip.mediable.type)
})

const percentage = ref(0)
const status = ref(null)

window.Echo.channel(`slip.${slip.value.token}`).listen('SlipProcessUpdate', (e) => {
  percentage.value = e.percentage
  status.value = e.status
})

</script>

<template>
  <!-- Main Wrapper -->
  <div class="bg-white bg-opacity-10 flex relative rounded-lg z-0 aspect-video shadow-md overflow-hidden transition-all duration-500 ease-in-out" @mouseover="hoverEffect = true" @mouseleave="hoverEffect = false">
    <div v-if="slip.status === 'finished'" class="absolute z-2 w-full flex flex-col justify-between h-full">
      <div class="flex justify-between mt-2 px-2">
        <!-- Top Left Icons -->
        <div class="flex flex-row text-gray-200 rounded-lg text-center text-sm gap-3">
          <p v-tooltip="{content: 'Duration', placement:'bottom'}" class="bg-neutral-950 bg-opacity-75 rounded-lg p-1 text-gray-200 text-sm">
            {{ duration }}
          </p>
        </div>
        <!-- TimeStamp -->
        <div class="flex flex-row gap-3">
          <div>
            <p v-tooltip="{content: 'Resolution', placement:'bottom'}" class="bg-neutral-950 bg-opacity-75 rounded-lg p-1 text-gray-200 text-sm">
              {{ slip.mediable.height }}p
            </p>
          </div>
          <div>
            <div class="bg-neutral-950 bg-opacity-75 rounded-lg p-1 text-gray-200">
              <icon v-tooltip="{content: 'Type', placement:'bottom'}" />
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
            Created {{ created_at }}
          </p>
        </div>
        <div class="flex self-center h-5/6">
          <ul class="flex text-3xl">
            <li v-tooltip="'Edit'" class="rounded-full w-10 h-10 flex items-center justify-center self-center cursor-pointer transition-all hover:bg-brand-primary-500 mr-2" @click="showEditSlip = true">
              <Settings color="white" width="25" height="25" />
            </li>
            <li v-tooltip="'Download'" class="px-1 rounded-full w-10 h-10 flex items-center justify-center self-center cursor-pointer transition-all hover:bg-brand-primary-500 mr-2">
              <Download color="white" width="25" height="25" />
            </li>
            <li v-tooltip="'Delete'" class="px-1 rounded-full w-10 h-10 flex items-center justify-center self-center cursor-pointer transition-all hover:bg-brand-primary-500" @click="showDeleteDialog = true">
              <Trash color="white" width="25" height="25" />
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div v-if="slip.status != 'finished'" class="z-2 absolute w-full h-full bg-[rgba(0,0,0,0.6)] flex flex-col justify-between items-center">
      <ProgressBar :percentage="percentage" />
      <p class="text-gray-200 pt-2">{{ percentage }}%</p>
      <p class="text-gray-200 pb-2">{{ status ?? slip.status }} - {{ slip.title }}</p>
    </div>
    <span
      @mouseover="hover = true"
      @mouseleave="hover = false"
    >
      <!-- Thumbnail -->
      <img class="rounded-lg object-cover h-full w-full transition-all duration-500 ease-in-out -z-[1]" :src="slip.thumb" alt="racing thumbnail" />
      <!--      <video v-if="hoverEffect" ref="video" class="`transition-all duration-200 rounded-lg object-cover h-full w-full transition-all duration-500 ease-in-out -z-[1]" :src="slip.mediable.path" controls autoplay />-->
      <DeleteSlipModal v-if="showDeleteDialog" :slip="slip" @close="showDeleteDialog = false" />
    </span>
  </div>
  <EditSlipModal v-if="showEditSlip" :slip="slip" @close="showEditSlip = false" @data="updateSlipsProps($event)" />
</template>
