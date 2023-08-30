<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import PrimaryTextInput from '@/Components/UI/PrimaryTextInput.vue'
import PrimaryButton from '@/Components/UI/PrimaryButton.vue'
import ApplicationLogo from '@/Components/UI/ApplicationLogo.vue'

const form = useForm({
    username: null,
    password: null,
})
</script>


<template>
    <Head title="Dashboard" />
    <header class="flex h-20 mt-5 mx-8 min-h-fit">
        <ApplicationLogo />
    </header>
    <img src="/img/login-background.png" class="fixed inset-0 m-auto w-full h-full object-cover -z-10" />
    <div class="absolute inset-0 overflow-hidden">
        <form @mousedown="mouseDown" id="form-container"
            class="absolute opacity-90 m-auto inset-0 px-20 max-md:px-12 max-sm:8 max-w-[95%] py-12 bg-neutral-900 w-96 max-md:w-80 max-sm:w-72 h-fit gap-y-12 flex flex-col items-center rounded-lg"
            @submit.prevent="() => form.post(route('login'))">
            <h1 class="text-4xl font-semibold text-white text-center">Login</h1>
            <div class="space-y-4">
                <p v-if="$page.props.message" class="text-center text-green-500 font-medium">{{ $page.props.message }}</p>
                <p v-else-if="form.errors.username" class="text-center text-red-500 font-medium">{{ form.errors.username }}</p>
                <p v-else-if="form.errors.password" class="text-center text-red-500 font-medium">{{ form.errors.password }}</p>
                <PrimaryTextInput v-model="form.username" placeholder="Username" />
                <PrimaryTextInput v-model="form.password" placeholder="Password" type="password" />
            </div>
            <primary-button>Login</primary-button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isDragging: false,
            startX: 0,
            startY: 0,
            translateX: 0,
            translateY: 0,
            el: null,
        }
    },
    methods: {
        mouseDown(e) {
            if (e.target.closest("input") || e.target.closest("p") || e.target.closest("button")) return
            this.el = e.target.closest('#form-container')
            this.isDragging = true
            this.startX = e.clientX - this.translateX
            this.startY = e.clientY - this.translateY
            addEventListener('mousemove', this.mouseMove)
            addEventListener('mouseup', this.mouseUp, { once: true })
            document.body.style.cursor = 'grabbing'
            document.body.style.userSelect = 'none'
            document.body.style.overflow = 'hidden'
        },
        mouseMove(e) {
            if (!this.isDragging) return
            let x = e.clientX - this.startX
            let y = e.clientY - this.startY
            this.el.style.transform = `translate(${x}px, ${y}px)`
        },
        mouseUp() {
            removeEventListener('mousemove', this.mouseMove)
            this.isDragging = false
            this.translateX = Number(this.el.style.transform.split(',')[0].split('(')[1].replace('px', ''))
            this.translateY = Number(this.el.style.transform.split(',')[1].replace('px)', ''))
            this.startX = undefined
            this.startY = undefined
            this.el = undefined
            document.body.style.cursor = 'default'
            document.body.style.userSelect = 'auto'
            document.body.style.overflow = 'auto'
        },
    },
}
</script>
