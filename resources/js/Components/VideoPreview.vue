<script setup>
import { ref, reactive } from 'vue'
import Play from '~icons/ion/play'

const form = reactive({
  text: null,
  file: null,
})

let isValidFile = ref(null)
let fileDisplay = ref('')
let title = ref('')
let description = ref('')
let type = ref('')
let error = ref({
  text: null,
  file: null,
})

let isPlaying = ref(false)

const getUploadedFile = (e) => {
  form.file = e.target.files[0]
  let extension = form.file.name.substring(form.file.name.lastIndexOf('.') + 1)

  if (extension == 'mp4') {
    isValidFile.value = true
  } else {
    isValidFile.value = false
    return
  }

  fileDisplay.value = URL.createObjectURL(e.target.files[0])
}

const playVideo = () => {
  this.$refs.videoPlayer.play()
}

const handlePlay = () => {
  this.isPlaying = true
}

const handlePause = () => {
  this.isPlaying = false
}
</script>

<template>
  <div v-if="!fileDisplay" class="w-[710px] h-full ml-[130px] flex flex-col justify-center items-center pt-10">
    <label for="file" class="text-gray-200">
      Select From Computer
    </label>
    <input
      id="file"
      type="file"
      class="hidden"
      @input="$event => getUploadedFile($event)"
    />
    <p v-if="error && error.file">
      {{ error.file }}
    </p>
    <p v-if="!fileDisplay && isValidFile === false">
      File not accepted
    </p>
  </div>


  <div v-if="fileDisplay && isValidFile === true" class="w-[710px] ml-[130px] flex flex-col justify-center relative pt-10">
    <div class="w-full relative">
      <div v-show="!isPlaying" class="bg-[rgba(5,128,197,0.6)] rounded-full w-[38px] h-[38px] flex items-center justify-center absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" @click="playVideo">
        <Play color="white" />
      </div>
      <div class="w-full h-[462px]">
        <video ref="videoPlayer" controls class="w-full rounded-lg" :src="fileDisplay" @play="handlePlay" @pause="handlePause" />
      </div>
    </div>
    <div class="w-full h-[26px] bg-[#0a0a0a] rounded-2xl mt-4 flex justify-center items-center">
      <div class="bg-[#363636] w-[693px] h-[10px] rounded-2xl">
        <div class="slider w-1/3 h-full rounded-2xl flex justify-end">
          <div class="bg-[#53aee0] w-[10px] h-full rounded-full" />
          <div />
        </div>
      </div>
    </div>
    <div class="mb-10 mt-1 w-full flex justify-between text-gray-200">
      <p>00:00</p>
      <p>00:00</p>
    </div>
  </div>
</template>

<style scoped>
    .slider {
    background: linear-gradient(184deg, #386D8B 0%, #1A3646 100%);
    }
</style>
