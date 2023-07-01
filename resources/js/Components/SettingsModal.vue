<script setup>
import {ref} from 'vue'

const visitors = ref(true)

const toggleVisitors = () => {
  visitors.value =!visitors.value
}

const emit = defineEmits(['close'])
const closeModal = () => {
  emit('close')
}
</script>

<template>
  <div class="text-white px4 absolute top-0 right-0 flex justify-end w-1/2 lg:w-1/3">
    <div class="p-8 w-full min-h-screen bg-neutral-900">
      <h1 class="text-4xl p-4 leading-6 font-light text-brand-primary-500">
        Settings
      </h1>

      <!-- Main Content -->
      <div class="px-4 flex justify-between gap-12 border-l border-neutral-800">
        <div class="flex flex-col">
          <!-- col 1 -->

          <div class="mb-8">
            <label class="font-light pb-2" for="siteTitle">
              Site Title
            </label>
            <input id="siteTitle" class="w-full bg-brand-secondary-700 border border-black focus:border-brand-primary-600 focus:ring-transparent" type="text" />
            <sub class="text-brand-primary-500 text-sm">The name your guests will see</sub>
          </div>

          <div class="mb-8 flex items-center">
            <label class="switch">
              <input id="visitors" v-model="visitors" type="checkbox" @click="toggleVisitors" />
              <div class="slider round" />
            </label>
            <p class="ml-6">
              Visitors can see video info
            </p>
          </div>

          <p>HLS streaming bitrates (in kb/s)</p>

          <div class="my-8 flex justify-between">
            <div class="flex flex-col w-5/12 mr-2">
              <input id="360" class="w-full bg-brand-secondary-700 border border-black focus:border-brand-primary-600 focus:ring-transparent" type="text" />
              <label class="font-light pb-2 text-brand-primary-500" for="360">
                360p
              </label>
            </div>

            <div class="flex flex-col w-5/12 ml-2">
              <input id="720" class="w-full bg-brand-secondary-700 border border-black focus:border-brand-primary-600 focus:ring-transparent" type="text" />
              <label class="font-light pb-2 text-brand-primary-500" for="720">
                720p
              </label>
            </div>
          </div>

          <div class="mb-8 flex justify-between">
            <div class="flex flex-col w-5/12 mr-2">
              <input id="1080" class="w-full bg-brand-secondary-700 border border-black focus:border-brand-primary-600 focus:ring-transparent" type="text" />
              <label class="font-light pb-2 text-brand-primary-500" for="1080">
                1080p
              </label>
            </div>

            <div class="flex flex-col w-5/12 ml-2">
              <input id="720" class="w-full bg-brand-secondary-700 border border-black focus:border-brand-primary-600 focus:ring-transparent" type="text" />
              <label class="font-light pb-2 text-brand-primary-500" for="720">
                720p
              </label>
            </div>
          </div>

          <div class="mb-8 flex justify-between">
            <div class="flex flex-col w-5/12 mr-2">
              <input id="2160" class="w-full bg-brand-secondary-700 border border-black focus:border-brand-primary-600 focus:ring-transparent" type="text" />
              <label class="font-light pb-2 text-brand-primary-500" for="2160">
                2160p
              </label>
            </div>

            <div class="flex flex-col w-5/12 ml-2" />
          </div>
        </div>
      </div>
      <div class="mx-4 flex justify-between">
        <button class="bg-brand-primary-600 py-2 w-32 rounded-lg hover:bg-brand-primary-700">
          Save Changes
        </button>
        <button class="bg-red-800 py-2 w-32 rounded-lg hover:bg-red-900" @click="closeModal">
          Cancel
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>
body {
    text-align: center;
    background: #51C3A0;
    padding: 50px
}
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

.switch input {
    display: none;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #101010;
    -webkit-transition: 0.4s;
    transition: 0.4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: #883535;
    -webkit-transition: 0.4s;
    transition: 0.4s;
}

.switch input:checked + .slider:before {
    background-color: #245030;
}

.switch input:focus + .slider {
    box-shadow: 0 0 1px #101010;
}

.switch input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
}

.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}
</style>
