<script setup>
import SlipLayout from '@/Layouts/SlipLayout.vue'
import ShowSlipModal from '@/Components/Slip/VideoPlayer.vue'

const props = defineProps({
  slip: Object,
})
</script>

<template>
  <SlipLayout>
    <ShowSlipModal :slip="slip" />
  </SlipLayout>
</template>
