<script setup>
import { onMounted, ref } from 'vue'

const props = defineProps({
  slip: Object,
})

let canvas = ref(null)
let video = ref(null)

onMounted(() => {
  let ctx = canvas.value.getContext('2d')

  setCanvasDimension()
  paintStaticVideo()

  video.value.addEventListener('play', function () {
    let video = this; //cache
    (function loop() {
      if (!video.paused && !video.ended) {
        ctx.drawImage(video, 0, 0, video.offsetWidth, video.offsetHeight)
        setTimeout(loop, 1000 / 30) // drawing at 30fps
      }
    })()
  })

  video.value.addEventListener('seeked', () => {
    paintStaticVideo()
  })

  window.addEventListener('resize', () => {
    setCanvasDimension()
    if (video.value.paused) {
      paintStaticVideo()
    }
  })
})

function setCanvasDimension() {
  canvas.value.height = video.value.offsetHeight
  canvas.value.width = video.value.offsetWidth
}

function paintStaticVideo() {
  let ctx = canvas.value.getContext('2d')
  ctx.drawImage(video.value, 0, 0, video.value.offsetWidth, video.value.offsetHeight)
}

</script>

<template>
  <div class="w-full h-full absolute top-0 left-0">
    <div class="w-4/6 flex flex-col justify-center items-center absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 rounded-2xl">
      <video id="mainVideo" ref="video" class="w-full rounded-xl" controls src="/video/test.mp4" />
    </div>
  </div>
  <canvas id="decoyVideo" ref="canvas" class="w-full h-screen rounded-md absolute blur-lg transform scale-2 z-[-1] opacity-60" />
  <div class="w-full h-screen absolute bg-black z-[-2]" />
</template>

<style scoped>

</style>
