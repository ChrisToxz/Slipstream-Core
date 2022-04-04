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
            </div>

            <div class="flex flex-col basis-full mb-10"><!-- content area -->

                <header class="flex h-20 flex-row justify-between mt-5 mx-8"><!-- Header -->
                    <div class="self-center"><img src="media/logo.png" alt=""></div>
                    <nav class="basis-1/6 bg-background-secondary rounded-md self-center text-base text-gray-200 py-2">
                        <ul class="flex flex-row justify-around">
                            <li class="transition-all cursor-pointer hover:text-brand-primary-500">Dashboard</li>
                            <li class="transition-all cursor-pointer hover:text-brand-primary-500">Settings</li>
                            <li class="transition-all cursor-pointer hover:text-brand-primary-500">Logout</li>
                        </ul>
                    </nav>
                </header>

                <div class="grid gap-8 self-center mx-20 mt-8 grid-cols-3"><!-- Videocards -->
                    <x-videocard message="media/stock1.jpg" />
                    <x-videocard message="media/stock2.jpg" />
                    <x-videocard message="media/stock3.jpg" />
                    <x-videocard message="media/stock4.jpg" />
                    <x-videocard message="media/stock5.jpg" />
                    <x-videocard message="media/stock6.jpg" />
                </div>

                {{-- <div class="mx-20 mt-10"><!-- playlists -->
                    <div class="text-xl font-medium mb-2 text-white">Playlists</div>
                    <div class="grid grid-cols-6 gap-4">
                        <div class="aspect-video"><img class="rounded-md" src="media/stock3.jpg" alt=""></div>
                        <div class="aspect-video"><img class="rounded-md" src="media/stock1.jpg" alt=""></div>
                        <div class="aspect-video"><img class="rounded-md" src="media/stock4.jpg" alt=""></div>
                        <div class="aspect-video"><img class="rounded-md" src="media/stock2.jpg" alt=""></div>
                        <div class="aspect-video"><img class="rounded-md" src="media/stock6.jpg" alt=""></div>
                        <div class="aspect-video"><img class="rounded-md" src="media/stock5.jpg" alt=""></div>
                    </div>
                </div> --}}

            </div>

                {{-- <div><!-- footer -->
                    <footer>
                        <div>
                            Version Nr
                        </div>
                    </footer>
                </div><!-- End Footer --> --}}

@endsection
