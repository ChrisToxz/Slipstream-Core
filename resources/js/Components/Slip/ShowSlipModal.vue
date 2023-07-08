<script setup>
import Hls from 'hls.js'
import plyr from 'plyr'
import 'plyr/dist/plyr.css'
import {onMounted, ref} from 'vue'

const props = defineProps({
  slip: Object,
})
const video = ref(null)
const src = props.slip.mediable.path



const defaultOptions = {
  captions: { autoplay: true, active: true, update: true, language: 'en'},
}

onMounted(() => {

  if (!Hls.isSupported() || props.slip.mediable.type != 3) {
    console.log('HLS is not supported')
    new plyr(video.value, defaultOptions)
  } else if (Hls.isSupported()) {
    const hls = new Hls()
    hls.loadSource(src)
    hls.attachMedia(video)

    hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {
      const availableQualities = hls.levels.map((l) => l.height)
      availableQualities.unshift(0) //prepend 0 to quality array
      defaultOptions.quality = {
        default: 0, //Default - AUTO
        options: availableQualities,
        forced: true,
        onChange: (e) => updateQuality(e),
      }
      hls.on(Hls.Events.LEVEL_SWITCHED, function (event, data) {
        var span = document.querySelector('.plyr__menu__container [data-plyr=\'quality\'][value=\'0\'] span')
        if (hls.autoLevelEnabled) {
          span.innerHTML = `AUTO (${hls.levels[data.level].height}p)`
        } else {
          span.innerHTML = 'AUTO'
        }
      })
      new plyr(video.value, defaultOptions)
    })
    hls.attachMedia(video.value)
    window.hls = hls

    function updateQuality(newQuality) {
      if (newQuality === 0) {
        window.hls.currentLevel = -1 //Enable AUTO quality if option.value = 0
        console.log('Auto quality selection')
      } else {
        window.hls.levels.forEach((level, levelIndex) => {
          if (level.height === newQuality) {
            console.log('Found quality match with ' + newQuality)
            window.hls.currentLevel = levelIndex
          }
        })
      }
    }
  }
})
</script>
<template>
  <video id="player" ref="video" playsinline webkit-playsinline controls :src="slip.mediable.path" />
</template>
