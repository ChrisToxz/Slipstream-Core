<script setup>
import Layout from '@/Layouts/InstallLayout.vue'
import PrimaryButton from '@/Components/UI/PrimaryButton.vue'
import {ref} from 'vue'
import PrimaryTextInput from '@/Components/UI/PrimaryTextInput.vue'
import {useForm} from '@inertiajs/vue3'


const nextStep = ref(false)
const toggle = () => {
  nextStep.value = true
}


const form = useForm({
  name: null,
  username: null,
  password: null,
  password_confirmation: null,
})
</script>

<template>
  <Layout>
    <div class="flex min-h-screen items-center justify-center p-12">
      <form action="">
        <div class="rounded-3xl">
          <div class="rounded-[calc(1.5rem-1px)] px-10 p-12 bg-neutral-800">
            <div>
              <h1 class="text-xl font-semibold text-white">Welcome to Slipstream!</h1>
            </div>

            <div v-if="!nextStep">
              <div class="mt-8 space-y-8">
                <p class="text-sm tracking-wide text-gray-300">Thank you for starting using Slipstream. Before you can start we have to finalize a short installation wizard</p>
                <PrimaryButton type="button" @click="toggle()">Lets start!</PrimaryButton>
              </div>
            </div>

            <div v-if="nextStep">
              <div class="mt-8 space-y-8">
                <p class="text-md text-gray-300">Lets setup a user account!</p>
                <div class="mt-5 space-y-8">
                  <form @submit.prevent="form.post(route('install.store'))">
                    <div class="space-y-6">
                      <div>
                        <PrimaryTextInput v-model="form.name" class="w-full" placeholder="Display name" />
                        <p v-if="form.errors.name" class="text-red-500 font-extrabold">{{ form.errors.name }}</p>
                      </div>
                      <div>
                        <PrimaryTextInput v-model="form.username" class="w-full" placeholder="Username" />
                        <p v-if="form.errors.username" class="text-red-500 font-extrabold">{{ form.errors.username }}</p>
                      </div>
                      <div>
                        <PrimaryTextInput v-model="form.password" class="w-full" placeholder="Password" type="password" />
                        <p v-if="form.errors.password" class="text-red-500 font-extrabold">{{ form.errors.password }}</p>
                      </div>
                      <div>
                        <PrimaryTextInput v-model="form.password_confirmation" class="w-full" placeholder="Password repeat" type="password" />
                        <p v-if="form.errors.password_confirmation" class="text-red-500 font-extrabold">{{ form.errors.password }}</p>
                      </div>
                      <PrimaryButton type="submit">Create account</PrimaryButton>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </Layout>
</template>
<style>
</style>
