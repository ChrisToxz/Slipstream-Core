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

                <div class="grid gap-8 self-center mx-8 mt-12 grid-cols-3"><!-- Videocards -->

                    <x-videocard />
                    <x-videocard />
                    <x-videocard />
                    <x-videocard />
                    <x-videocard />
                    <x-videocard />
                    <x-videocard />
                    <x-videocard />
                    <x-videocard />

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
