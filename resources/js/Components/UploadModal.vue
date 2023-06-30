<script setup>
import Download from '~icons/teenyicons/download-outline'
import Back from '~icons/material-symbols/arrow-back'
import {ref} from 'vue'
import {useForm} from '@inertiajs/vue3'

const emit = defineEmits(['close'])


const form = useForm({
  title: null,
  description: null,
  type: 1,
  file: null,
})

let isValidFile = ref(null)
let fileDisplay = ref('')
let isUploading = ref(false)

const validTypes = ['video/mp4','video/mpeg']

const getUploadedFile = (e) => {
  isUploading.value = true //?

  form.file = e.target.files[0]

  // Validate File
  if(validTypes.includes(form.file['type'])){
    isValidFile.value = true
  }else{
    isValidFile.value = false
    isUploading.value = false
  }

  fileDisplay.value = URL.createObjectURL(e.target.files[0])
  isUploading.value = false
}


const saveMedia = () => {
  form.post('/slips', {
    onSuccess: () => closeModal(),
  })
  // error.value.title = null
  // error.value.description = null
  // error.value.type = null
  // error.value.file = null
  //
  // if (!form.title) {
  //   error.value.title = 'Please enter a title'
  // }
  // if (!form.description) {
  //   error.value.description = 'Please enter a description'
  // }
  // if (!form.type) {
  //   error.value.type = 'Please specify type'
  // }
  //
  // if (Object.values(error.value).every(v => v === null)) {
  //   router.post('/slips', form, {
  //     forceFormData: true,
  //     onError: errors => {
  //       errors && errors.title ? error.value.title = errors.title : ''
  //       errors && errors.description ? error.value.description = errors.description : ''
  //       errors && errors.type ? error.value.type = errors.type : ''
  //       errors && errors.file ? error.value.file = errors.file : ''
  //     },
  //     onSuccess: () => {
  //       closeModal()
  //     },
  //   })
  // }
}

const closeModal = () => {
  form.reset()
  emit('close')
}

</script>

<template>
  <div class="backdrop-blur-md w-full h-full absolute top-0 left-0">
    <div class="flex justify-center items-center absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 bg-gray-800 rounded-2xl">
      <div class="w-3/4">
        <!-- Input -->
        <div v-if="!fileDisplay && isUploading === false">
          <Back color="white" width="25" height="25" class="absolute top-4 left-4 cursor-pointer" @click="closeModal()" />
          <div class="my-20 flex justify-center items-center flex-col mx-32">
            <label for="file" class="flex flex-col items-center justify-center mb-4 text-center text-white w-32 cursor-pointer">
              <Download color="white" width="50" height="50" />
              Choose a file or drag it here.
            </label>
            <input id="file" type="file" class="hidden" @input="$event => getUploadedFile($event)" />
            <p v-if="error && error.file" class="text-red-500 text-center p-2 font-extrabold">{{ error.file }}</p>
            <p v-if="!fileDisplay && isValidFile === false" class="text-red-500 text-center p-2 font-extrabold">File not accepted</p>
          </div>
        </div>
        <!-- File Preparing -->
        <div v-if="isUploading" class="text-white mx-32 my-32 flex justify-center items-center">
          Preparing...
        </div>
        <!-- Finished uploading -->
        <div v-if="fileDisplay && isValidFile === true && isUploading === false">
          <div class="my-4">
            <div class="mb-4">
              <h1 class="text-4xl font-light text-white">
                Save your media
              </h1>
            </div>
            <div class="grid grid-cols-2 gap-8 text-white">
              <!-- Upload Inputs -->
              <div>
                <label class="mb-2" for="title">Title</label>
                <input id="title" v-model="form.title" class="w-full bg-gray-700 border-0" type="text" />
                <div v-if="form.errors.title" class="text-red-500 font-extrabold">{{ form.errors.title }}</div>


                <label class="mb-2" for="description">Description</label>
                <textarea id="description" v-model="form.description" rows="1" placeholder="Description..." class="w-full bg-gray-700" />
                <div v-if="form.errors.description" class="text-red-500 font-extrabold">{{ form.errors.description }}</div>


                <div class="mb-2">
                  <label for="type">Type</label>
                  <select id="type" v-model="form.type" name="type" autocomplete="off" class="w-full bg-gray-700">
                    <option value="1">None (Original file)</option>
                    <option value="2">Optimized for web (264)</option>
                    <option value="3">Optimized for streaming (x264/HLS)</option>
                  </select>
                  <div v-if="form.errors.type" class="text-red-500 font-extrabold">{{ form.errors.type }}</div>
                </div>
              </div>

              <div class="flex justify-center items-center">
                <div class="rounded-md overflow-hidden">
                  <video :src="fileDisplay" controls autoplay muted />
                  <div v-if="form.errors.file" class="text-red-600">
                    {{ form.errors.file }}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="pt-4 mb-4 text-white">
            <button class="bg-blue-500 rounded-lg p-2 mr-2" @click="saveMedia()">Save media</button>
            <button class="bg-red-800 rounded-lg p-2" @click="closeModal()">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
