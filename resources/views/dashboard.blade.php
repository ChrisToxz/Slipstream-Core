<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard</title>
        <link href="css/app.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="antialiased bg-background-surface">
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
        
        <div class="flex"><!-- Main wrapper -->
            <div class="flex w-16 h-screen bg-gray-900 mr-5"> <!-- Sidebar -->
                <ul>
                    <li>
                        <span>X</span>
                    </li>
                    <li>
                        <span>X</span>
                    </li>
                    <li>
                        <span>X</span>
                    </li>
                </ul>
            </div><!-- End Sidebar -->
 
            
            <header class="flex h-20 flex-row justify-between bg-gray-800 w-screen pr-10 mt-5"><!-- Header -->
                <div class="self-center"><img src="media/logo.png" alt=""></div>
                <nav class="bg-slate-400 rounded-full self-center font-display text-lg text-gray-200">
                    <ul class="flex flex-row">
                        <li class="p-2">Dashboard</li>
                        <li class="p-2">Settings</li>
                        <li class="p-2">Logout</li>
                    </ul>
                </nav>
            </header> <!-- End Header -->

            

            {{-- <div><!-- Main -->
                <div><!-- Video Card -->

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

                    <div><!-- Media -->
                        video file
                    </div>

                </div><!-- End Video Card -->
            </div><!-- End Main -->

            <div><!-- footer -->
                <footer>
                    <div>
                        Version Nr
                    </div>
                </footer>
            </div><!-- End Footer --> --}}

        </div>
    </body>
</html>
