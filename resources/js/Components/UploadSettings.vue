<script setup>

</script>

<template>
  <div class="ml-[100px] flex flex-col text-gray-200 h-full justify-center w-[380px]">
    <label class="text-gray-200" for="title">Title</label>
    <input id="title" class="bg-[#1A1A1A] border-[#0580c5] rounded-lg" type="text" />
    <label class="mt-4" for="description">Description</label>
    <textarea id="description" class="h-[300px] bg-[#1A1A1A] border-[#0580c5] rounded-lg" />
    <label class="mt-4" for="type">Type</label>
    <select id="type" class="bg-[#1A1A1A] border-[#0580c5] rounded-lg">
      <option value="1">None (Original File)</option>
      <option value="2">Optimized for web (x264)</option>
      <option value="3">Optimized for streaming (x264/HLS)</option>
    </select>
    <div class="flex mt-4 justify-between">
      <button class="bg-[#0580c5] py-2 px-6 rounded-lg transform hover:-translate-y-1 hover:bg-[#035e91] transition-all duration-200">Submit</button>
      <button class="bg-red-800 py-2 px-6 rounded-lg transform hover:-translate-y-1 hover:bg-red-900 transition-all duration-200">Cancel</button>
    </div>
  </div>
</template>
