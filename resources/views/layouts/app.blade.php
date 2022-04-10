<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="css/app.css" rel="stylesheet">
    @livewireStyles
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



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
        @yield('content')
    </div>

    @flasher_render <!-- this render all flasher notifications. -->
    @flasher_livewire_render <!-- this render livewire notifications only. -->
    @livewireScripts
    @livewire('livewire-ui-modal')
    <script src="./js/app.js"></script>
<script>
    // dragover
    $("html").on("dragover", function(e) {
        Livewire.emit('openModal', 'media.upload')
        e.preventDefault();
        e.stopPropagation();
        $("#dropmessage").text("Drag it to here!");
        console.log('drag to here');
    });

</script>
</body>
</html>
