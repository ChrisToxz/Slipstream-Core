<script setup>
import { Link } from '@inertiajs/vue3';
import Settings from '~icons/ic/baseline-video-settings';
import Download from '~icons/ion/download';
import Trash from '~icons/mdi/trash';
</script>

<template>
    <div class="bg-white bg-opacity-10 flex relative rounded-lg z-0 aspect-video shadow-md transition-all duration-300 delay-75 hover:scale-[0.99] overflow-auto">
        <div class="absolute z-2 w-full flex flex-col justify-between h-full">
            <div class="w-[calc(100%-20px)] ml-[10px] flex justify-between">
                <div class="flex flex-col text-gray-200 rounded-lg text-center">
                    <p class="bg-[#0580c5] rounded-lg">Public</p>
                    <p class="bg-[#0580c5] rounded-lg">200 Views</p>
                </div>
                <div>
                    <p class="text-gray-200">00:00</p>
                </div>
            </div>
            <div></div>
            <div class="bg-black opacity-80 flex justify-between text-opacity-100 text-white px-4 py-2">
                <div>
                    <Link href="/">
                        <p class="text-lg">
                            Example Title
                        </p>
                    </Link>
                    <p class="text-sm text-de text-[#56B0E4]">
                        Lorem ipsum dolor sit...
                    </p>
                    <p class="text-sm text-gray-500">
                        Date: 6/26/32
                    </p>
                </div>
                <div class="flex self-center h-5/6">

                    <ul class="flex text-3xl">
                        <li class="bg-[#0580c5] rounded-full w-[40px] h-[40px] flex items-center justify-center self-center cursor-pointer transition-all hover:text-status-warning-500 mr-2">
                            <Settings color="white" width="25" height="25"  />
                        </li>
                        <li class="px-1 bg-[#0580c5] rounded-full w-[40px] h-[40px] flex items-center justify-center self-center cursor-pointer transition-all hover:text-brand-primary-500 mr-2">
                            <Download color="white" width="25" height="25" />
                        </li>
                        <li class="px-1 bg-[#0580c5] rounded-full w-[40px] h-[40px] flex items-center justify-center self-center cursor-pointer transition-all hover:text-status-success-500">
                            <Trash color="white" width="25" height="25" />
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <img class="rounded-lg object-cover h-full w-full" src="/img/thumbnail.jpg" alt="racing thumbnail" />
    </div>
</template>