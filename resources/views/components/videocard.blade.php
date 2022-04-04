<div>
    <div class="flex relative z-0 aspect-video shadow-md transition-all duration-300 delay-75 hover:scale-[0.99]"><!-- Video Card -->
        <div class="absolute z-2 w-full flex flex-col justify-end h-full"><!-- video overlay -->
            <div class="bg-black opacity-80 flex justify-between rounded-b-lg text-opacity-100 text-white px-4 py-2"><!-- Video Information -->
                <div>
                    <p class="text-lg">
                        <b>Super F1 Cup Short vid</b>
                    </p>
                    <p class="text-sm text-de">
                       Epic short vid about a dope F1 race Car.
                    </p>
                </div>
                <div class="flex self-center h-5/6">
                    <ul class="flex text-3xl">
                        <li class="px-1 self-center cursor-pointer transition-all hover:text-status-warning-500"><i class='bx bxs-edit-alt'></i></li>
                        <li class="px-1 self-center cursor-pointer transition-all hover:text-brand-primary-500"><i class='bx bx-cloud-download'></i></li>
                        <li class="px-1 self-center cursor-pointer transition-all hover:text-status-success-500"><i class='bx bxs-copy-alt'></i></li>
                    </ul>
                </div>
            </div>
            <div class="flex order-first h-full p-4 justify-between"><!-- badges -->
                <div class="p-2 h-fit bg-black opacity-80 rounded-lg text-white text-opacity-100">
                    <span class="align-middle"><i class='bx bx-world'></i></span>
                    <span class="text-sm font-bold">HLS</span>
                </div>

                <div class="p-2 h-fit bg-black opacity-80 rounded-lg text-white text-opacity-100">
                    <span class="align-middle"><i class='bx bx-film'></i></span>
                    <span class="text-sm font-bold">1080P</span>
                </div>

            </div>
        </div>
        <div ><!-- Media -->
            <img class="rounded-lg" src="{{ $message }}" alt="">
        </div>
    </div><!-- End Video Card -->
</div>
