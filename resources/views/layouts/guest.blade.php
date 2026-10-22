<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Google Fonts: Plus Jakarta Sans -->
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
    <body class="antialiased bg-rose-50/50 text-slate-800 selection:bg-pink-300 selection:text-pink-950">
        <!-- Ambient Girly Pastel Mesh Orbs -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-32 -left-32 w-[550px] h-[550px] bg-pink-200/60 rounded-full blur-[120px]"></div>
            <div class="absolute top-1/3 right-0 w-[500px] h-[500px] bg-purple-200/50 rounded-full blur-[130px]"></div>
            <div class="absolute -bottom-32 left-1/3 w-[600px] h-[600px] bg-rose-200/60 rounded-full blur-[140px]"></div>
        </div>

        <div class="relative z-10 min-h-screen">
            {{ $slot }}
        </div>
    </body>
</html>