@extends('layouts.app')

@section('content')
            <div class="flex justify-center w-16 h-screen bg-background-secondary"> <!-- Sidebar -->
                <ul class="flex flex-col h-1/3 mt-32">
                    <li class="bg-background-tertiary w-10 h-10 mb-1 rounded-full flex justify-center items-center">
                        <span>-</span>
                    </li>
                    <li class="bg-background-tertiary w-10 h-10 mb-1 rounded-full flex justify-center items-center">
                        <span>-</span>
                    </li>
                    <li class="bg-background-tertiary w-10 h-10 mb-1 rounded-full flex justify-center items-center">
                        <span>-</span>
                    </li>
                    <li class="bg-background-tertiary w-10 h-10 mb-1 rounded-full flex justify-center items-center">
                        <span>-</span>
                    </li>
                    <li class="bg-background-tertiary w-10 h-10 mb-1 rounded-full flex justify-center items-center">
                        <span>-</span>
                    </li>
                </ul>
            </div><!-- End Sidebar -->

            <div class="flex flex-col basis-full"><!-- content area -->

                <header class="flex h-20 flex-row justify-between mt-5 mx-8"><!-- Header -->
                    <div class="self-center"><img src="media/logo.png" alt=""></div>
                    <nav class="basis-1/6 bg-background-secondary rounded-md self-center text-base text-gray-200 py-2">
                        <ul class="flex flex-row justify-around">
                            <li class="transition-all cursor-pointer hover:text-brand-primary-500">Dashboard</li>
                            <li class="transition-all cursor-pointer hover:text-brand-primary-500">Settings</li>
                            <li class="transition-all cursor-pointer hover:text-brand-primary-500">Logout</li>
                        </ul>
                    </nav>
                </header> <!-- End Header -->

                <div class="grid gap-8 w-11/12 self-center mx-8 mt-12 lg:grid-cols-3 md:grid-cols-2"><!-- Videocards -->

                    <div class="flex relative z-0 aspect-video shadow-md transition-all duration-300 delay-75 hover:scale-105"><!-- Video Card -->
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
                                        <li class="px-1 self-center cursor-pointer transition-all hover:text-status-error-500"><i class='bx bxs-trash'></i></li>
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
                            <img class="rounded-lg" src="media/stock1.jpg" alt="">
                        </div>
                    </div><!-- End Video Card -->

                </div><!-- end Videocards -->
            </div><!-- End Main -->

                {{-- <div><!-- footer -->
                    <footer>
                        <div>
                            Version Nr
                        </div>
                    </footer>
                </div><!-- End Footer --> --}}

@endsection
