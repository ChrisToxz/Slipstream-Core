<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from "@/Layouts/MainLayout.vue";
import VideoCard from "@/Components/VideoCard.vue";

</script>

<template>
    <Head title="Dashboard" />
    <MainLayout>
        <div class="w-full flex justify-center">
            <div class="w-[calc(100%-20px)] ml-[10px] grid grid-cols-3 gap-7">
                <VideoCard />
                <VideoCard />
                <VideoCard />
                <VideoCard />
            </div>
        </div>
    </MainLayout>
</template>

<style>
</style>
