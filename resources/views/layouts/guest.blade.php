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
    <body class="font-sans antialiased bg-[#F4F5F7] text-[#272757] min-h-screen flex flex-col justify-center items-center px-4">
        
        <div class="w-full sm:max-w-md px-6 py-8 bg-white border border-[#8686AC]/30 shadow-xl overflow-hidden sm:rounded-2xl">
            {{ $slot }}
        </div>

    </body>
</html>