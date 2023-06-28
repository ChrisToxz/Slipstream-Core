<script setup>
import Play from '~icons/ion/play'
</script>

<template>
  <div class="w-[710px] ml-[130px] flex flex-col justify-center relative pt-10">
    <div class="w-full relative">
      <div class="bg-[rgba(5,128,197,0.6)] rounded-full w-[38px] h-[38px] flex items-center justify-center absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
        <Play color="white" />
      </div>
      <div class="w-full h-[462px]">
        <img class="w-full rounded-lg" src="/img/thumbnail.jpg" alt="thumbnail" />
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
