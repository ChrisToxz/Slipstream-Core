<script setup>
import {ref, nextTick} from 'vue'
import PrimaryTextInput from '@/Components/Reusable/PrimaryTextInput.vue'
import PrimaryButton from '@/Components/Reusable/PrimaryButton.vue'
import WarningButton from '@/Components/Reusable/WarningButton.vue'
import ToggleSwitch from '@/Components/Reusable/ToggleSwitch.vue'

const visitors = ref(true)
const emit = defineEmits(['close'])

const updateVisitors = (value) => {
  visitors.value = value

  // Testing purposes
  nextTick(() => {
    console.log(visitors.value)
  })
}

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
          <!-- Inputs -->
          <div class="mb-8">
            <label class="font-light pb-2" for="siteTitle">
              Site Title
            </label>
            <PrimaryTextInput id="siteTitle" />
            <sub class="text-brand-primary-500 text-sm">The name your guests will see</sub>
          </div>

          <div class="mb-8 flex items-center">
            <ToggleSwitch @toggle="updateVisitors" />
            <p class="ml-6">
              Visitors can see video info
            </p>
          </div>

          <p>HLS streaming bitrates (in kb/s)</p>

          <div class="my-8 flex justify-between">
            <div class="flex flex-col w-5/12 mr-2">
              <PrimaryTextInput id="360" />
              <label class="font-light pb-2 text-brand-primary-500" for="360">
                360p
              </label>
            </div>

            <div class="flex flex-col w-5/12 ml-2">
              <PrimaryTextInput id="720" />
              <label class="font-light pb-2 text-brand-primary-500" for="720">
                720p
              </label>
            </div>
          </div>

          <div class="mb-8 flex justify-between">
            <div class="flex flex-col w-5/12 mr-2">
              <PrimaryTextInput id="1080" />
              <label class="font-light pb-2 text-brand-primary-500" for="1080">
                1080p
              </label>
            </div>

            <div class="flex flex-col w-5/12 ml-2">
              <PrimaryTextInput id="1440" />
              <label class="font-light pb-2 text-brand-primary-500" for="1440">
                1440p
              </label>
            </div>
          </div>

          <div class="mb-8 flex justify-between">
            <div class="flex flex-col w-5/12 mr-2">
              <PrimaryTextInput id="2160" />
              <label class="font-light pb-2 text-brand-primary-500" for="2160">
                2160p
              </label>
            </div>

            <div class="flex flex-col w-5/12 ml-2" />
          </div>
        </div>
      </div>
      <div class="mx-4 flex justify-between">
        <div class="w-32">
          <PrimaryButton>
            Save Changes
          </PrimaryButton>
        </div>
        <div class="w-32">
          <WarningButton @click="closeModal">
            Cancel
          </WarningButton>
        </div>
      </div>
    </div>
  </div>
</template>
