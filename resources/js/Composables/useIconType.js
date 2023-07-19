import OriginalType from '~icons/mdi/video'
import OptimizedType from '~icons/ph/video'
import StreamableType from '~icons/solar/play-stream-bold'

const iconType = (type) => {
  switch (type) {
  case 1:
    return OriginalType
  case 2:
    return OptimizedType
  case 3:
    return StreamableType
  default:
    return OriginalType
  }
}

export default iconType
