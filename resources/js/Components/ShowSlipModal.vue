<script setup>
import Back from '~icons/material-symbols/arrow-back'
import Settings from '~icons/material-symbols/settings'

const emit = defineEmits(['close'])
const closeModal = () => {
  emit('close')
}
</script>

<template>
  <div class="backdrop-blur-md w-full h-full absolute top-0 left-0">
    <div class="w-3/4 flex flex-col justify-center items-center absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 bg-neutral-900 rounded-2xl">
      <div class="w-full flex justify-between mt-4">
        <Back color="white" width="25" height="25" class="cursor-pointer ml-2" @click="closeModal()" />
        <h1 class="text-gray-200 text-xl">Slip Title</h1>
        <Settings color="white" width="25" height="25" class="cursor-pointer mr-2" />
      </div>
      <video class="w-full mt-4 rounded-xl" controls src="" />
    </div>
    <canvas id="decoyVideo" class="decoy" />
  </div>
</template>
