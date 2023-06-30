import {onMounted, ref} from 'vue'

export default function useCanvas() {
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
  return { canvas, video }
}
