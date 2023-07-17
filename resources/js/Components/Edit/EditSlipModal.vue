<script setup>
import WarningButton from '@/Components/Reusable/WarningButton.vue'
import PrimaryButton from '@/Components/Reusable/PrimaryButton.vue'
import PrimaryTextInput from '@/Components/Reusable/PrimaryTextInput.vue'
import PrimaryTextarea from '@/Components/Reusable/PrimaryTextarea.vue'
import PrimarySelect from '@/Components/Reusable/PrimarySelect.vue'
import {useForm} from '@inertiajs/vue3'

const emit = defineEmits(['close'])

const props = defineProps({
  slip: Object,
})

const form = useForm({
  title: props.slip.title,
  description: props.slip.description,
  type: props.slip.type,
})

const updateSlip = () => {
  form.put('/slips/' + props.slip.token, {
    onSuccess: () => closeModal(),
  })
  closeModal()
}

const closeModal = () => {
  // form.reset()
  emit('close')
}
</script>

<template>
  <div class="backdrop-blur-sm w-full h-full absolute top-0 left-0">
    <div class="flex flex-col absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 bg-[rgba(0,0,0,0.8)] rounded-2xl w-3/4">
      <div class="my-4 mx-20">
        <p class="text-gray-200 text-center text-xl">Editing {{ slip.title }}</p>

        <label class="text-gray-200">Title</label>
        <PrimaryTextInput v-model="form.title" />
        <p v-if="form.errors.title" class="text-red-500 font-extrabold">{{ form.errors.title }}</p>

        <label class="text-gray-200">Description</label>
        <PrimaryTextarea v-model="form.description" />
        <p v-if="form.errors.description" class="text-red-500 font-extrabold">{{ form.errors.description }}</p>

        <label class="text-gray-200">Type</label>
        <PrimarySelect v-model="form.type">
          <option value="1">None (Original file)</option>
          <option value="2">Optimized for web (264)</option>
          <option value="3">Optimized for streaming (x264/HLS)</option>
        </PrimarySelect>
        <div v-if="form.errors.type" class="text-red-500 font-extrabold">{{ form.errors.type }}</div>

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
