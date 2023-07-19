import moment from 'moment/moment.js'

// const relativeTime = computed(
//   () => moment(slip.value.created_at).fromNow(),
// )


export const relativeTime = (time) => {
  return moment(time).fromNow()}
