<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Google Font: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased bg-stone-50/80 text-stone-900 selection:bg-stone-900 selection:text-white">
        <!-- Subtle Background Glow -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-40 -left-40 w-[600px] h-[600px] bg-stone-200/50 rounded-full blur-[140px]"></div>
            <div class="absolute top-1/2 -right-40 w-[500px] h-[500px] bg-slate-200/40 rounded-full blur-[140px]"></div>
        </div>

        <div class="relative z-10 min-h-screen">
            {{ $slot }}
        </div>
    </body>
</html>