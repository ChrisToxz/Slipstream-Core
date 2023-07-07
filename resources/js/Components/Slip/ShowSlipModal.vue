<script setup>

import {ref} from 'vue'
import Plyr from 'plyr'
import Hls from 'hls.js'

const props = defineProps({
  slip: Object,
})

const source = props.slip.mediable.path
const video = ref(null)
const defaultOptions = {}
const videosource = ref(null)

console.log('Source: %s',source)
console.log( 'Type: %d', props.slip.mediable.type)

if (!Hls.isSupported() || props.slip.mediable.type != 3) {
  console.log('HLS is not supported')
  videosource.value = source
  new Plyr(video, defaultOptions)
} else {
  console.log('HLS is supported! :)')
  // For more Hls.js options, see https://github.com/dailymotion/hls.js
  console.log('Setting up HLS and load source')
  const hls = new Hls()
  hls.loadSource(source)

  // From the m3u8 playlist, hls parses the manifest and returns
  // all available video qualities. This is important, in this approach,
  // we will have one source on the Plyr player.
  hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {

    // Transform available levels into an array of integers (height values).
    const availableQualities = hls.levels.map(l => l.height)
    availableQualities.unshift(0) //prepend 0 to quality array

    // Add new qualities to option
    defaultOptions.quality = {
      default: 0, //Default - AUTO
      options: availableQualities,
      forced: true,
      onChange: e => updateQuality(e) }

    // Add Auto Label
    defaultOptions.i18n = {
      qualityLabel: {
        0: 'Auto' } }



    hls.on(Hls.Events.LEVEL_SWITCHED, function (event, data) {
      var span = document.querySelector('.plyr__menu__container [data-plyr=\'quality\'][value=\'0\'] span')
      if (hls.autoLevelEnabled) {
        span.innerHTML = `AUTO (${hls.levels[data.level].height}p)`
      } else {
        span.innerHTML = 'AUTO'
      }
    })

    // Initialize new Plyr player with quality options
    new Plyr(video, defaultOptions)
  })

  hls.attachMedia(video)
  window.hls = hls
}

function updateQuality(newQuality) {
  if (newQuality === 0) {
    window.hls.currentLevel = -1 //Enable AUTO quality if option.value = 0
  } else {
    window.hls.levels.forEach((level, levelIndex) => {
      if (level.height === newQuality) {
        console.log('Found quality match with ' + newQuality)
        window.hls.currentLevel = levelIndex
      }
    })
  }
}

</script>

<template>
  <!-- Main Wrapper -->
  <div class="w-full h-full absolute top-0 left-0">
    <!-- Video Wrapper -->
    <div class="w-4/6 flex flex-col justify-center items-center absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 rounded-2xl">
      <!--      <video ref="video" class="w-full rounded-xl" controls :src="slip.mediable.path" />-->
      <div class="ambient-player">
        <canvas id="decoyVideo" class="decoy" />
        <video id="mainVideo" ref="player" controls crossorigin playsinline :src="videosource" />
      </div>
    </div>
  </div>
  <!-- Abilight Background -->
  <canvas ref="canvas" class="w-full h-screen rounded-md absolute blur-lg transform scale-2 z-[-1] opacity-60" />
  <div class="w-full h-screen absolute bg-black z-[-2]" />
</template>
<style scoped>
</style>
