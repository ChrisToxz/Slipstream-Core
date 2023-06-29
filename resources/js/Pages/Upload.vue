<script setup>
import { Head } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'

import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: null,
  avatar: null,
})

if(form.avater){
  alert('file selected')
}

function submit() {
  form.post('/users')
}

</script>

<template>
  <Head title="Upload" />

  <MainLayout>
    <form @submit.prevent="submit">
      <input v-model="form.name" type="text" />
      <input type="file" @input="form.avatar = $event.target.files[0]" />
      <progress v-if="form.progress" :value="form.progress.percentage" max="100">
        {{ form.progress.percentage }}%
      </progress>
      <button type="submit">Submit</button>
    </form>
  </MainLayout>
</template>
