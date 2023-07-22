import axios from 'axios'
import {onMounted, onUnmounted, ref} from 'vue'


const isFetching = ref(false)
const loadMoreIntersect = ref(null)
export const useInfiniteScrolling = (slips) => {
  const fetchSlips = async () => {
    const next_url = slips.value.next_page_url

    if (!next_url) return

    isFetching.value = true
    await axios.get(next_url)
      .then((response) => {
        slips.value.data.push(...response.data.data)
        slips.value.next_page_url = response.data.next_page_url
        console.log(slips.value.meta)
        isFetching.value = false
      })
  }

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        fetchSlips()
      }
    })
  }, {
    rootMargin: '-100px 0px 0px 0px',
  })
  onMounted(() => observer.observe(loadMoreIntersect.value))

  onUnmounted(() => observer.disconnect())

  return {loadMoreIntersect, isFetching}
}


