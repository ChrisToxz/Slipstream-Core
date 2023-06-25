<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from "@/Layouts/MainLayout.vue";

</script>

<template>
    <Head title="Dashboard" />
    <MainLayout>
        <div class="flex flex-col basis-full mb-10"> <!-- content area -->
            <header class="flex h-20 flex-row justify-between mt-5 mx-8"><!-- Header -->
                <div class="self-center"><img src="img/logo.png" alt=""></div>
                <nav class="basis-1/6 bg-background-secondary rounded-md self-center text-base text-gray-200 py-2 px-4">
                    <ul class="flex justify-around gap-8 sm:gap-2">
                        <li class="transition-all cursor-pointer hover:text-brand-red-500">Dashboard </li>
                        <li class="transition-all cursor-pointer hover:text-brand-primary-500">Settings</li>
                        <button>Upload</button>
                    </ul>
                </nav>
            </header>
        </div>
    </MainLayout>
</template>

<style>
</style>
