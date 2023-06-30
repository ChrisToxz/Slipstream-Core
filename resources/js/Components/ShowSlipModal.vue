<script setup>
import useCanvas from '@/Composables/useCanvas.js'

// Ambilight
let { canvas, video } = useCanvas()

const props = defineProps({
  slip: Object,
})

</script>

<template>
  <!-- Main Wrapper -->
  <div class="w-full h-full absolute top-0 left-0">
    <!-- Video Wrapper -->
    <div class="w-4/6 flex flex-col justify-center items-center absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 rounded-2xl">
      <video ref="video" class="w-full rounded-xl" controls src="/video/test.mp4" />
    </div>
  </div>
  <!-- Abilight Background -->
  <canvas ref="canvas" class="w-full h-screen rounded-md absolute blur-lg transform scale-2 z-[-1] opacity-60" />
  <div class="w-full h-screen absolute bg-black z-[-2]" />
</template>
