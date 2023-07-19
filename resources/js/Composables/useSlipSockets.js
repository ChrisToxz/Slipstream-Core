import {router} from '@inertiajs/vue3'

// TODO: Check if can work without snackbar and add toastr logic in

const useSlipSockets = (snackbar) => {
  window.Echo.channel('ss').listen('SlipProcessFinished', (e) => {
    router.reload({
      preserveState: true,
      only: ['slips'],
      onSuccess: (page) => {
        //I had to move this to success, so toastr doesn't appear double
        if (!e.failed) {
          $snackbar.add({
            type: 'success',
            text: 'Slip successfully processed',
          })
        } else {
          $snackbar.add({
            type: 'error',
            text: 'Processing failed for ' + e.slip.title,
          })
        }
      },
    })
  })
}

export default useSlipSockets
