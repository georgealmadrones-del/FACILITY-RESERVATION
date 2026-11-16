<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Facility & Equipment Booking') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#0F0E47] text-white min-h-screen flex flex-col justify-center items-center">
        
        <div class="w-full sm:max-w-md px-6 py-8 bg-[#272757] border border-[#505081]/50 shadow-2xl overflow-hidden sm:rounded-2xl">
            <!-- Brand / Header -->
            <div class="text-center mb-6">
                <a href="/" class="text-xl font-bold tracking-tight text-white inline-flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-[#8686AC]"></span>
                    CampusReserve
                </a>
            </div>

            {{ $slot }}
        </div>

    </body>
</html>