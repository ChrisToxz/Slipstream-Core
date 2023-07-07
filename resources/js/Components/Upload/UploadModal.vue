<script setup>
import {ref} from 'vue'
import {router, useForm} from '@inertiajs/vue3'
import PrimaryButton from '@/Components/Reusable/PrimaryButton.vue'
import WarningButton from '@/Components/Reusable/WarningButton.vue'
import Download from '~icons/teenyicons/download-outline'
import Back from '~icons/material-symbols/arrow-back'
import PrimaryTextInput from '@/Components/Reusable/PrimaryTextInput.vue'
import PrimaryTextarea from '@/Components/Reusable/PrimaryTextarea.vue'
import PrimarySelect from '@/Components/Reusable/PrimarySelect.vue'
import ProgressBar from '@/Components/Reusable/ProgressBar.vue'

const emit = defineEmits(['close'])


const form = useForm({
  title: null,
  description: null,
  type: 1,
  file: null,
  originalFileName: null,
})

let isValidFile = ref(null)
let fileDisplay = ref('')
let isUploading = ref(false)
let percentage = ref(null)
let rate = ref(null)
let estimated = ref(null)

const validTypes = ['video/mp4','video/mpeg']

const getUploadedFile = (e) => {
  form.file = e.target.files[0]
  // Validate File
  if(validTypes.includes(form.file['type'])){
    isValidFile.value = true
  }else{
    isValidFile.value = false
  }

  fileDisplay.value = URL.createObjectURL(e.target.files[0])


  router.post(route('slips.tempupload'), {file: form.file},{
    onStart: () => {
      isUploading.value = true
    },
    onProgress: progress => {
      console.log(progress)
      percentage.value = progress.percentage
      rate.value = (progress.rate / 1000000).toFixed(2)
      estimated.value = progress.estimated.toFixed(2)
    },
    onSuccess: (res) => {
      isUploading.value = false
      form.file             = res.props.data.tmpPath
      form.originalFileName = res.props.data.originalFileName
    },

  })

}

const saveMedia = () => {
  form.post('/slips', {
    onSuccess: () => closeModal(),
  })
}

const closeModal = () => {
  // form.reset()
  emit('close')
}

console.log(percentage.value)
percentage.value = 50

</script>

<template>
  <div class="backdrop-blur-md w-full h-full absolute top-0 left-0">
    <div class="flex flex-col overflow-x-hidden justify-center items-center absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 bg-neutral-900 rounded-2xl w-1/2">
      <div v-if="isUploading === true" class="w-full">
        <ProgressBar :percentage="percentage" />
        <div class="flex w-full justify-between text-white">
          <p>{{ rate }} mb/s</p>
          <p>{{ percentage }}%</p>
          <p>{{ estimated }} seconds left</p>
        </div>
      </div>
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
        <!--        &lt;!&ndash; File Preparing &ndash;&gt;-->
        <!--        <div v-if="isUploading" class="text-white mx-32 my-32 flex justify-center items-center">-->
        <!--          Preparing...-->
        <!--        </div>-->
        <!-- Finished uploading -->
        <div v-if="fileDisplay && isValidFile === true">
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
                <!--                <input v-model="form.title" type="text" />-->
                <PrimaryTextInput id="title" v-model="form.title" />
                <p v-if="form.errors.title" class="text-red-500 font-extrabold">{{ form.errors.title }}</p>


                <label class="mb-2" for="description">Description</label>
                <PrimaryTextarea id="description" :v-model="form.description" rows="1" placeholder="Description..." />
                <p v-if="form.errors.description" class="text-red-500 font-extrabold">{{ form.errors.description }}</p>


                <div class="mb-2">
                  <label for="type">Type</label>
                  <PrimarySelect id="type" v-model="form.type" name="type" autocomplete="off">
                    <option value="1">None (Original file)</option>
                    <option value="2">Optimized for web (264)</option>
                    <option value="3">Optimized for streaming (x264/HLS)</option>
                  </PrimarySelect>
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
