<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import {Head, useForm} from '@inertiajs/vue3'
import PrimaryTextInput from '@/Components/UI/PrimaryTextInput.vue'
import PrimaryButton from '@/Components/UI/PrimaryButton.vue'

const form = useForm({
  username: null,
  password: null,
})

const login = () => {
  form.post(route('login'))}
</script>

<template>
  <Head title="Dashboard" />
  <MainLayout>
    <form @submit.prevent="login">
      <div class="flex min-h-screen items-center justify-center">
        <div class="max-w-sm rounded-3xl bg-gradient-to-b p-px from-brand-primary-700 to-transparent">
          <div class="rounded-[calc(1.5rem-1px)] p-12 bg-neutral-800">
            <div>
              <h1 class="text-xl font-semibold text-white text-center">Login</h1>
            </div>

            <div class="mt-5 space-y-8">
              <div v-if="$page.props.message" class="flex items-center space-x-4 text-green-500 justify-center">
                {{ $page.props.message }}
              </div>
              <div class="space-y-6">
                <PrimaryTextInput v-model="form.username" class="w-full" placeholder="Username" />
                <p v-if="form.errors.username" class="text-red-500 font-extrabold">{{ form.errors.username }}</p>
                <PrimaryTextInput v-model="form.password" class="w-full" placeholder="Password" type="password" />
                <p v-if="form.errors.password" class="text-red-500 font-extrabold">{{ form.errors.password }}</p>
              </div>

              <primary-button>Login</primary-button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </MainLayout>
</template>

<style scoped>

</style>
