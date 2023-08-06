<script setup>
import Hls from 'hls.js'
import plyr from 'plyr'
import 'plyr/dist/plyr.css'
import {isRef, onMounted, ref} from 'vue'


const props = defineProps({
  slip: Object,
})
const video = ref(null)
const src = ref(props.slip.mediable.path)

const defaultOptions = {
  autoplay: true,
  //TODO: Remove before release
  debug: true,
  captions: { active: true, update: true, language: 'en'},
  controls: [
    'play-large', // The large play button in the center
    'restart', // Restart playback
    'rewind', // Rewind by the seek time (default 10 seconds)
    'play', // Play/pause playback
    'fast-forward', // Fast forward by the seek time (default 10 seconds)
    'progress', // The progress bar and scrubber for playback and buffering
    'current-time', // The current time of playback
    'duration', // The full duration of the media
    'mute', // Toggle mute
    'volume', // Volume control
    'captions', // Toggle captions
    'settings', // Settings menu
    'pip', // Picture-in-picture (currently Safari only)
    'airplay', // Airplay (currently Safari only)
    'fullscreen', // Toggle fullscreen
  ],
  // Not working
  tooltip:{ controls: true, seek: true },
}

onMounted(() => {

  if (!Hls.isSupported() || props.slip.mediable.type != 3) {
    console.log('%cHLS not supported, loading video!', 'color:green')

    const player = new plyr(video.value, defaultOptions)
    player.source = {
      type: 'video',
      title: 'Example title',
      sources: [
        {
          src: src.value,
        },
      ],
    }

  } else if (Hls.isSupported()) {
    console.log('%cHLS Supported, setting it up!', 'color:green')
    const hls = new Hls()
    hls.loadSource(isRef(src)? src.value : src)
    hls.attachMedia(video)

    hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {
      const availableQualities = hls.levels.map((l) => l.height)
      availableQualities.unshift(0) //prepend 0 to quality array
      console.log('%cQualities found: %s', 'color:green', availableQualities)
      defaultOptions.quality = {
        default: 0, //Default - AUTO
        options: availableQualities,
        forced: true,
        onChange: (e) => {
          console.log(e)
          updateQuality(e)},
      }
      defaultOptions.i18n = {
        qualityLabel: {
          0: 'Auto',
        },
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
      console.log(newQuality)
      if (newQuality === 0) {
        window.hls.currentLevel = -1 //Enable AUTO quality if option.value = 0
        console.log('%cAuto quality selection', 'color:green')
      } else {
        window.hls.levels.forEach((level, levelIndex) => {
          if (level.height === newQuality) {
            console.log('%cFound quality match with ' + newQuality,'color:green')
            window.hls.currentLevel = levelIndex
          }
        })
      }
    }
  }
})
</script>


<template>
  <!-- Main Wrapper -->
  <div class="w-full h-full absolute top-0 left-0">
    <!-- Video Wrapper -->
    <div class="w-4/6 flex flex-col justify-center items-center absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 rounded-2xl">
      <!--      <video ref="video" class="w-full rounded-xl" controls :src="slip.mediable.path" />-->
      <video id="player" ref="video" />
      <div class="ambient-player">
        <canvas id="decoyVideo" class="decoy" />
      </div>
    </div>
  </div>
  <!-- Abilight Background -->
  <canvas ref="canvas" class="w-full h-screen rounded-md absolute blur-lg transform scale-2 z-[-1] opacity-60" />
  <div class="w-full h-screen absolute bg-black z-[-2]" />
</template>
<style scoped>
</style>
