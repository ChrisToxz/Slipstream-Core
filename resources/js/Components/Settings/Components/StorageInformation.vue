<script setup>

import SecondaryButton from '@/Components/UI/SecondaryButton.vue'
import PrimaryButton from '@/Components/UI/PrimaryButton.vue'
import {ref} from 'vue'
import axios from 'axios'
import {humanReadableSize} from '@/Composables/useHumanReadableSize.js'


const isFetching = ref(false)
const storageInfo = ref(null)

const getStorageInfo = () => {
  isFetching.value = true
  axios.get(route('settings.storage')).then(response => {
    storageInfo.value = response.data
    isFetching.value = false
  })
}

const clearTmpFolder = () => {
  axios.post(route('settings.clear-tmp')).then(response => {
    $snackbar.add({
      type:'success',
      text: 'Temporary folder is cleared successfully',
    })
    getStorageInfo()
  })
}
</script>

<template>
  <div class="">
    <div class="text-2xl">Storage information</div>
    <div v-if="storageInfo" class="p-2 flex-row">
      <p class="font-bold text-2xl">Disk</p>
      <p>Disk size: {{ humanReadableSize(storageInfo.disk.total) }}</p>
      <p>Free space on disk: {{ humanReadableSize(storageInfo.disk.free) }}</p>
      <p>Disk usage: {{ humanReadableSize(storageInfo.disk.used) }}</p>

      <div class="pt-2">
        <p class="font-bold text-2xl">Slipstream</p>
        <p>Currently used by Slips: {{ humanReadableSize(storageInfo.slips) }}</p>
        <p>Currently used by tmp folder: {{ humanReadableSize(storageInfo.tmp) }}</p>
      </div>
      <div>
        <div class="mb-1 text-base font-medium text-white text-center">Total disk usage {{ storageInfo.disk.percentage }}%</div>
        <div class="w-full bg-gray-200 rounded-full h-1.5 mb-4 dark:bg-gray-700">
          <div class="bg-blue-600 h-1.5 rounded-full dark:bg-blue-500" :style="`width: ${storageInfo.disk.percentage}%`" />
        </div>
        <div class="mb-1 text-base font-medium text-white text-center">{{ storageInfo.disk.slips_share }} % is in use by Slipstream</div>
        <div class="w-full bg-gray-200 rounded-full h-1.5 mb-4 dark:bg-gray-700">
          <div class="bg-blue-600 h-1.5 rounded-full dark:bg-blue-500" :style="`width: ${storageInfo.disk.slips_share}%`" />
        </div>
      </div>
    </div>
    <div class="flex flex-row gap-5 p-2">
      <div>
        <PrimaryButton class="text-sm px-2 flex items-center justify-center" @click="getStorageInfo()">
          <div v-if="isFetching" class="h-5 w-5 border-t-transparent border-solid animate-spin rounded-full border-white border-4 mr-2" />
          <div class="">
            <template v-if="!storageInfo">Get storage information</template>
            <template v-else-if="storageInfo && !isFetching">Refresh</template>
            <template v-else>Refreshing</template>
          </div>
        </PrimaryButton>
      </div>
      <div v-if="storageInfo">
        <!--                  Should be in a 'advanced settings' sector. Commonly there should be no files remaining in tmp -->
        <SecondaryButton class="text-sm px-2" @click="clearTmpFolder()">
          Clear tmp folder
        </SecondaryButton>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
