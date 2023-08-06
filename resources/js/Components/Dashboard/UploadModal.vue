<script setup>
import {ref} from 'vue'
import {router, useForm} from '@inertiajs/vue3'
import PrimaryButton from '@/Components/UI/PrimaryButton.vue'
import WarningButton from '@/Components/UI/WarningButton.vue'
import Download from '~icons/teenyicons/download-outline'
import Back from '~icons/material-symbols/arrow-back'
import PrimaryTextInput from '@/Components/UI/PrimaryTextInput.vue'
import PrimaryTextarea from '@/Components/UI/PrimaryTextarea.vue'
import PrimarySelect from '@/Components/UI/PrimarySelect.vue'
import ProgressBar from '@/Components/UI/ProgressBar.vue'

const emit = defineEmits(['close'])


const form = useForm({
  title: null,
  description: null,
  type: 'Original',
  file: null,
  originalFileName: null,
})

let isValidFile = ref(false)
let isUploading = ref(false)

let fileDisplay = ref('')
let fileName = ref()

let percentage = ref(null)
let rate = ref(null)
let estimated = ref(0)

const validTypes = ['video/mp4','video/mpeg']

const getUploadedFile = (e) => {
  // init
  form.clearErrors()

  // set file
  const file = e.target.files[0]

  // Validate File
  // TODO: More client side validation to avoid unnecessary file uploads
  if(validTypes.includes(file.type)){
    isValidFile.value = true
    form.file = file
  }else{
    form.setError('file', `MIME type: ${file.type} not supported (yet)`)
    resetUpload()
    return
  }

  fileDisplay.value = URL.createObjectURL(file)

  router.post(route('slips.tempupload'), {file: form.file},{
    onBefore: () => {
      isUploading.value = true
      fileName.value = file.name
      form.originalFileName = file.name
    },
    onProgress: progress => {
      percentage.value = progress.percentage
      rate.value = (progress.rate / 1000000).toFixed(2)
      estimated.value = (progress.estimated ?? 0).toFixed(2)

    },
    onSuccess: (res) => {
      form.file = res.props.data.tmpPath
    },
    onFinish: () => {
      isUploading.value = false
    },
    onError: (res) => {
      form.setError('file', res.file)
      resetUpload()
    },
  })
}

const resetUpload = () => {
  isUploading.value = false
  form.reset()
}

const saveMedia = () => {
  form.transform((data) => (
    {
      ...data,
      title: data.title ?? fileName.value,
    }))
    .post('/slips', {
      onSuccess: () => closeModal(),
    })
}

const closeModal = () => {
  form.reset()
  emit('close')
}

</script>

<template>
  <div class="backdrop-blur-md w-full h-full absolute top-0 left-0">
    <div class="flex flex-col overflow-x-hidden justify-center items-center absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 bg-neutral-800 rounded-2xl w-1/2">
      <div class="w-3/4">
        <!-- Input -->
        <div v-if="!isUploading && !form.file">
          <Back color="white" width="25" height="25" class="absolute top-4 left-4 cursor-pointer" @click="closeModal()" />
          <div class="my-20 flex justify-center items-center flex-col mx-32">
            <label for="file" class="flex flex-col items-center justify-center mb-4 text-center text-white w-32 cursor-pointer">
              <Download color="white" width="50" height="50" />
              Choose a file or drag it here.
            </label>
            <input id="file" type="file" class="hidden" @input="$event => getUploadedFile($event)" />
            <!--            <p v-if="error && error.file" class="text-red-500 text-center p-2 font-extrabold">{{ error.file }}</p>-->
            <p v-if="form.errors.file" class="text-red-500 text-center p-2 font-extrabold"> {{ form.errors.file }}</p>
          </div>
        </div>

        <!-- Finished uploading -->
        <div v-if="form.file">
          <div v-if="isUploading" class="w-full">
            <ProgressBar :percentage="percentage" class="mt-2" />
            <div class="flex w-full justify-between text-white">
              <p>{{ rate }} MB/s</p>
              <p>{{ percentage }}%</p>
              <p>{{ estimated }}s left</p>
            </div>
            <p class="text-orange-500 text-center font-bold">Server-side validation not finished yet</p>
          </div>
          <div v-if="!isUploading && !form.errors.file" class="text-green-500 text-center font-bold mt-2">File have been validated by the server!</div>

          <div class="my-3">
            <div class="mb-4">
              <h1 class="text-4xl font-light text-white">
                Save your media
              </h1>
            </div>
            <div class="grid grid-cols-2 gap-8 text-white">
              <!-- Upload Inputs -->
              <div>
                <div class="my-3">
                  <label class="mb-2" for="title">Title</label>
                  <!--                <input v-model="form.title" type="text" />-->
                  <PrimaryTextInput id="title" v-model="form.title" :placeholder="fileName" />
                  <p class="text-sm font-italic pt-1 text-gray-500">Keep blank to use original filename</p>
                  <p v-if="form.errors.title" class="text-red-500 font-extrabold">{{ form.errors.title }}</p>
                </div>

                <label class="mb-2" for="description">Description</label>
                <PrimaryTextarea id="description" v-model="form.description" rows="1" placeholder="Description..." />
                <p v-if="form.errors.description" class="text-red-500 font-extrabold">{{ form.errors.description }}</p>


                <div class="mb-2">
                  <label for="type">Type</label>
                  <PrimarySelect id="type" v-model="form.type" name="type" autocomplete="off">
                    <option value="Original">None (Original file)</option>
                    <option value="X264">Optimized for web (x264)</option>
                    <option value="HLS">Optimized for streaming (x264 & HLS)</option>
                  </PrimarySelect>
                  <p class="text-sm font-italic pt-1 text-gray-500">Click here for more information about processing</p>
                  <div v-if="form.errors.type" class="text-red-500 font-extrabold">{{ form.errors.type }}</div>
                </div>
              </div>

              <div class="flex justify-center items-center">
                <div class="rounded-md overflow-hidden">
                  <video :src="fileDisplay" controls autoplay muted />
                </div>
              </div>
            </div>
          </div>

          <div class="pt-4 mb-4 text-white flex lg:w-1/2">
            <div class="w-1/3">
              <PrimaryButton
                class="bg-blue-500 rounded-lg p-2 mr-2"
                :disabled="isUploading"
                @click="isUploading ? null : saveMedia()"
              >
                {{ isUploading ? 'Please wait' : 'Save media' }}
              </PrimaryButton>
            </div>
            <div class="w-1/3 ml-6">
              <WarningButton @click="closeModal()">Cancel</WarningButton>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
