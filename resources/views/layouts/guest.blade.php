<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Google Fonts: Plus Jakarta Sans & Playfair Display for Editorial Library Vibe -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
            .font-serif-title {
                font-family: 'Playfair Display', serif;
            }
        </style>
    </head>
    <body class="antialiased bg-[#FBF8F3] text-[#2C221E] selection:bg-[#8C6D58] selection:text-white">
        <!-- Ambient Warm Library Glow -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-40 -left-40 w-[600px] h-[600px] bg-[#EADCC9]/50 rounded-full blur-[140px]"></div>
            <div class="absolute top-1/2 -right-40 w-[500px] h-[500px] bg-[#D9C3B0]/40 rounded-full blur-[140px]"></div>
        </div>

        <div class="relative z-10 min-h-screen">
            {{ $slot }}
        </div>
    </body>
</html>