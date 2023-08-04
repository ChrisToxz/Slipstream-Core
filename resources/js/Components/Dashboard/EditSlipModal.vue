<script setup>
import WarningButton from '@/Components/UI/WarningButton.vue'
import PrimaryButton from '@/Components/UI/PrimaryButton.vue'
import PrimaryTextInput from '@/Components/UI/PrimaryTextInput.vue'
import PrimaryTextarea from '@/Components/UI/PrimaryTextarea.vue'
import {useForm} from '@inertiajs/vue3'
import {ref} from 'vue'
import AxiosFormError from '@/Components/UI/AxiosFormError.vue'

const emit = defineEmits(['close', 'data'])

const props = defineProps({
  slip: Object,
})

const form = useForm({
  title: props.slip.title,
  description: props.slip.description,
  type: props.slip.type,
})

const errors = ref({})

const updateSlip = () => {
  axios.put('/slips/' + props.slip.token, {title: form.title, description: form.description, type: form.type})
    .then(response => {
      $snackbar.add({
        type: 'success',
        text: 'Slip have been updated successfully!',
      })
      emit('data', response.data)
      emit('close')
    },
    ).catch((error) => {
      errors.value = error.response.data.errors
    })
}

const closeModal = () => {
  emit('close')
}
</script>

<template>
  <div class="backdrop-blur-sm w-full h-full fixed top-0 left-0 z-10">
    <div class="flex flex-col absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 bg-[rgba(0,0,0,0.8)] rounded-2xl w-3/4">
      <div class="my-4 mx-20">
        <p class="text-gray-200 text-center text-xl">Editing {{ slip.title }}</p>

        <label class="text-gray-200">Title</label>
        <PrimaryTextInput v-model="form.title" />
        <AxiosFormError :errors="errors.title" />


        <label class="text-gray-200">Description</label>
        <PrimaryTextarea v-model="form.description" />
        <p v-if="form.errors.description" class="text-red-500 font-extrabold">{{ form.errors.description }}</p>
        <AxiosFormError :errors="errors.description" />

        <div class="flex text-gray-200 mt-6 justify-around">
          <div class="w-1/4">
            <PrimaryButton @click="updateSlip">Save Changes</PrimaryButton>
          </div>
          <div class="w-1/4">
            <WarningButton @click="closeModal">Cancel</WarningButton>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
