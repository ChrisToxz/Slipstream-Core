<script setup>
import {router} from '@inertiajs/vue3'
import WarningButton from '@/Components/UI/WarningButton.vue'
import PrimaryButton from '@/Components/UI/PrimaryButton.vue'

const props = defineProps({
  slip: Object,
})
const emit = defineEmits(['close'])

const deleteSlip = () => {
  router.delete(`/slips/${props.slip.token}`, {
    onSuccess: () => {
      $snackbar.add({
        type:'success',
        text: 'Slip successfully removed!',
      })
    },

    onError: (error) => {
      $snackbar.add({
        type: 'error',
        text: error.message,
      })
    },
    onFinish: () => closeModal(),
  })
}

const closeModal = () => {
  // form.reset()
  emit('close')
}

</script>

<template>
  <div class="backdrop-blur-sm w-full h-full absolute top-0 left-0">
    <div class="flex flex-col absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 bg-[rgba(0,0,0,0.8)] rounded-2xl w-3/4">
      <div class="m-2">
        <p class="text-gray-200">Are you sure?</p>
        <p class="text-gray-200">{{ slip.title }} will be <span class="text-red-600">permanently deleted</span>.</p>
        <div class="flex text-gray-200 mt-6 justify-around">
          <div class="w-1/4">
            <WarningButton @click="deleteSlip">Delete</WarningButton>
          </div>
          <div class="w-1/4">
            <PrimaryButton @click="closeModal">Cancel</PrimaryButton>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
