<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard</title>
        <link href="css/app.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="antialiased bg-background-surface font-brand font-light">
        @if (Route::has('login'))
            <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                            @endif
                        @endauth
                    </div>
            </div>
        @endif
        
        <div class="flex flex-row"><!-- Main wrapper -->

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
                    <nav class="basis-1/6 bg-background-secondary rounded-md self-center font-display text-base text-gray-200 py-2">
                        <ul class="flex flex-row justify-around">
                            <li class="">Dashboard</li>
                            <li class="">Settings</li>
                            <li class="">Logout</li>
                        </ul>
                    </nav>
                </header> <!-- End Header -->

                <div class="flex px-16"><!-- Videocards -->
                    <div class="bg-green-600 flex basis-1/3 relative z-0"><!-- Video Card -->
                        <div class="absolute z-2"><!-- video overlay -->
                            <div><!-- Video Information -->
                                <div>
                                    <p>
                                        Video info
                                    </p>
                                </div>
                                <div>
                                    <ul>
                                        <li>btn1</li>
                                        <li>btn2</li>
                                        <li>btn3</li>
                                        <li>btn4</li>
                                    </ul>
                                </div>
                            </div>

                            <div><!-- badges -->
                                <div>
                                    <span>Icon</span>
                                    <p>1080P</p>
                                </div>
                            </div>
                        </div>

                        <div class=""><!-- Media -->
                            <img class="aspect-video" src="media/stock1.jpg" alt="">
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

        </div>
    </body>
</html>
