<script setup>
import {nextTick, onMounted, ref} from 'vue'
import PrimaryTextInput from '@/Components/UI/PrimaryTextInput.vue'
import PrimaryButton from '@/Components/UI/PrimaryButton.vue'
import WarningButton from '@/Components/UI/WarningButton.vue'
import ToggleSwitch from '@/Components/UI/ToggleSwitch.vue'
import {useForm} from '@inertiajs/vue3'
import axios from 'axios'
import StorageInformation from '@/Components/Settings/Components/StorageInformation.vue'

const visitors = ref(true)
const emit = defineEmits(['close'])

const updateVisitors = (value) => {
  visitors.value = value

  // Testing purposes
  nextTick(() => {
    console.log(visitors.value)
  })
}


const form = useForm({
  site_name: null,
  streaming_bitrates: {
    360: null,
    480: null,
    720: null,
    1080: null,
    1440: null,
    2160: null,
  },
})

onMounted(() => {
  axios.get(route('settings.index')).then(response => {
    Object.assign(form, response.data)
  })
})

const submit = () => {
  form.post(route('settings.store'), {
    onSuccess: () => {
      $snackbar.add({
        type:'success',
        text: 'Settings are saved successfully',
      })
      closeModal()
    },
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
            <PrimaryTextInput id="siteTitle" v-model="form.site_name" />
            <sub class="text-brand-primary-500 text-sm">The name your guests will see</sub>
          </div>

          <div class="mb-8 flex items-center">
            <ToggleSwitch @toggle="updateVisitors" />
            <p class="ml-6">
              Visitors can see video info
            </p>
          </div>

          <p>HLS streaming bitrates (in kb/s)</p>

          <div class="my-8 flex justify-between gap-2">
            <div class="flex flex-col w-2/6">
              <PrimaryTextInput id="360" v-model="form.streaming_bitrates[360]" />
              <label class="font-light pb-2 text-brand-primary-500" for="360">
                360p
              </label>
            </div>

            <div class="flex flex-col w-2/6">
              <PrimaryTextInput id="480" v-model="form.streaming_bitrates[480]" />
              <label class="font-light pb-2 text-brand-primary-500" for="480">
                480p
              </label>
            </div>

            <div class="flex flex-col w-2/6">
              <PrimaryTextInput id="720" v-model="form.streaming_bitrates[720]" />
              <label class="font-light pb-2 text-brand-primary-500" for="720">
                720p
              </label>
            </div>
          </div>

          <div class="mb-3 flex justify-between gap-2">
            <div class="flex flex-col w-2/6">
              <PrimaryTextInput id="1080" v-model="form.streaming_bitrates[1080]" />
              <label class="font-light pb-2 text-brand-primary-500" for="1080">
                1080p
              </label>
            </div>

            <div class="flex flex-col w-2/6">
              <PrimaryTextInput id="1440" v-model="form.streaming_bitrates[1440]" />
              <label class="font-light pb-2 text-brand-primary-500" for="1440">
                1440p
              </label>
            </div>

            <div class="flex flex-col w-2/6">
              <PrimaryTextInput id="2160" v-model="form.streaming_bitrates[2160]" />
              <label class="font-light pb-2 text-brand-primary-500" for="2160">
                2160p
              </label>
            </div>
          </div>

          <StorageInformation />

          <div class="m-4 flex justify-between">
            <div class="w-32">
              <PrimaryButton @click="submit()">
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
    </div>
  </div>
</template>
