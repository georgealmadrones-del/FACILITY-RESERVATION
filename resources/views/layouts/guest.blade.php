<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased bg-slate-950 text-slate-100 selection:bg-blue-500 selection:text-white">
        <!-- Ambient Mesh Background Lights -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-40 -left-40 w-[600px] h-[600px] bg-blue-600/15 rounded-full blur-[140px]"></div>
            <div class="absolute top-1/2 right-0 w-[500px] h-[500px] bg-indigo-600/15 rounded-full blur-[140px]"></div>
            <div class="absolute -bottom-40 left-1/3 w-[600px] h-[600px] bg-sky-600/10 rounded-full blur-[140px]"></div>
        </div>

        <div class="relative z-10 min-h-screen">
            {{ $slot }}
        </div>
    </body>
</html>