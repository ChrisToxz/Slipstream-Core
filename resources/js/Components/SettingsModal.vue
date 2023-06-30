<script setup>

const emit = defineEmits(['close'])
const closeModal = () => {
  emit('close')
}
</script>

<template>
  <div class="text-white px4 absolute top-0 flex justify-end">
    <div class="p-8 w-1/2 bg-neutral-900">
      <div class="p-4">
        <h1 class="text-4xl leading-6 font-light text-brand-primary-500">
          Settings
        </h1>
      </div>

      <!-- Main Content -->
      <div class="px-4 flex justify-between gap-12">
        <div class="flex flex-col basis-1/6">
          <!-- col 1 -->

          <div class="mb-8">
            <label class="font-light pb-2" for="siteTitle">
              Site Title
            </label>
            <input id="siteTitle" class="w-full" type="text" />
            <sub class="text-neutral-400">The name your guests will see</sub>
          </div>

          <div class="mb-8">
            <label class="font-light pb-2" for="visible">
              Guests Can View Slip Info
            </label>
            <input id="visible" class="w-full" type="checkbox" />
            <sub class="text-neutral-400">Upload date, size, amount of views, etc.</sub>
          </div>

          <div class="mb-8 flex">
            <label class="font-light pb-2" for="360">
              360p
            </label>
            <input id="360" class="w-1/2" type="text" />
            <label class="font-light pb-2" for="720">
              720p
            </label>
            <input id="720" class="w-1/2" type="text" />
          </div>

          <div class="mb-8 flex">
            <label class="font-light pb-2" for="1080">
              1080p
            </label>
            <input id="1080" class="w-1/2" type="text" />
            <label class="font-light pb-2" for="1440">
              1440p
            </label>
            <input id="1440" class="w-1/2" type="text" />
          </div>

          <div class="mb-8 flex">
            <label for="2160" class="font-light pb-2">
              2160p
            </label>
            <input id="2160" class="w-1/2" type="text" />
          </div>
        </div>

        <div class="flex-col w-2/5">
          <!-- col 2 -->
          <div class="mb-6">
            <label for="none" class="font-light pb-2">None</label>
            <input id="none" type="text" class="w-full" />
            <sub class="text-neutral-400">The None of your media</sub>
          </div>

          <div class="mb-6">
            <label for="none2" class="font-light pb-2">None</label>
            <input id="none2" type="text" class="w-full" />
            <sub class="text-neutral-400">The None of your media</sub>
          </div>

          <div class="mb-6">
            <label for="none3" class="font-light pb-2">None</label>
            <input id="none3" type="text" class="w-full" />
            <sub class="text-neutral-400">The None of your media</sub>
          </div>

          <div class="mb-6">
            <label for="none4" class="font-light pb-2">None</label>
            <input id="none4" type="text" class="w-full" />
            <sub class="text-neutral-400">The None of your media</sub>
          </div>
        </div>
      </div>
      <div class="mx-4 flex justify-between">
        <button>
          Save Changes
        </button>
        <button @click="closeModal">
          Cancel
        </button>
      </div>
    </div>
  </div>
</template>
