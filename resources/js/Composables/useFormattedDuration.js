import moment from 'moment/moment.js'

export const formattedDuration = (duration) =>moment.utc(duration*1000).format('mm:ss')

