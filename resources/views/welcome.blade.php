<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Facility & Equipment Reservation</title>

        <!-- Google Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
        </style>
    </head>
    <body class="antialiased bg-[#09090B] text-zinc-100 selection:bg-zinc-100 selection:text-black">

        <!-- TOP NAVIGATION BAR -->
        <nav class="sticky top-0 z-50 bg-[#09090B]/80 backdrop-blur-md border-b border-[#27272A]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 h-20 flex justify-between items-center">
                <!-- Logo & Name -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-zinc-100 text-black flex items-center justify-center font-bold text-lg shadow-sm">
                        ⚡
                    </div>
                    <span class="font-extrabold text-xl tracking-tight text-white">Resource Hub</span>
                </div>

                <!-- Nav Links -->
                <div class="hidden md:flex items-center space-x-8 text-sm font-semibold text-zinc-400">
                    <a href="#facilities" class="hover:text-white transition">Facilities</a>
                    <a href="#guidelines" class="hover:text-white transition">Guidelines</a>
                </div>

                <!-- Auth Actions -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-zinc-100 hover:bg-white text-black rounded-xl text-xs font-bold transition shadow-sm">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 bg-zinc-100 hover:bg-white text-black rounded-xl text-xs font-bold transition shadow-sm">
                            Sign In to Portal
                        </a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- HERO SECTION -->
        <section class="relative overflow-hidden pt-16 pb-20 lg:pt-24 lg:pb-28">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    
                    <!-- Left Hero Copy -->
                    <div class="lg:col-span-7 space-y-6">
                        <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 text-xs font-bold bg-[#18181B] text-zinc-300 rounded-full border border-[#27272A]">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>PROPERTY & FACILITY RESERVATION SYSTEM</span>
                        </div>
                        
                        <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white leading-[1.15]">
                            Property and Facility Reservation System
                        </h1>
                        
                        <p class="text-base text-zinc-400 max-w-xl font-normal leading-relaxed">
                            Reserve with Confidence, Organize with Ease. Streamline campus facility scheduling and equipment borrowing through an intelligent unified platform[cite: 6].
                        </p>

                        <div class="flex flex-wrap items-center gap-4 pt-2">
                            <a href="{{ route('login') }}" class="px-6 py-3.5 bg-zinc-100 hover:bg-white text-black font-bold rounded-2xl shadow-lg transition text-sm">
                                Sign In to Portal
                            </a>
                            <a href="{{ route('register') }}" class="px-6 py-3.5 bg-[#18181B] hover:bg-[#27272A] text-zinc-100 font-bold rounded-2xl border border-[#27272A] transition text-sm">
                                Create Account
                            </a>
                        </div>
                    </div>

                    <!-- Right Interactive Preview Card -->
                    <div class="lg:col-span-5">
                        <div class="bg-[#18181B] p-6 sm:p-8 rounded-3xl border border-[#27272A] shadow-2xl relative">
                            <div class="border-b border-[#27272A] pb-4 space-y-1">
                                <h3 class="font-bold text-lg text-white">What can you reserve?</h3>
                                <p class="text-xs text-zinc-400">Facilities, equipment & specialized rooms[cite: 6]</p>
                            </div>

                            <div class="space-y-3 pt-4">
                                <div class="p-3.5 rounded-2xl bg-[#09090B] border border-[#27272A] flex justify-between items-center">
                                    <div>
                                        <p class="text-xs font-bold text-white">Rooms & Halls</p>
                                        <p class="text-[11px] text-zinc-500">Auditorium, AVR, Conference Room</p>
                                    </div>
                                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-950 text-emerald-400 border border-emerald-800">Available</span>
                                </div>

                                <div class="p-3.5 rounded-2xl bg-[#09090B] border border-[#27272A] flex justify-between items-center">
                                    <div>
                                        <p class="text-xs font-bold text-white">Laboratories</p>
                                        <p class="text-[11px] text-zinc-500">Computer Labs, Speech Lab</p>
                                    </div>
                                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-950 text-emerald-400 border border-emerald-800">Available</span>
                                </div>

                                <div class="p-3.5 rounded-2xl bg-[#09090B] border border-[#27272A] flex justify-between items-center">
                                    <div>
                                        <p class="text-xs font-bold text-white">Equipment</p>
                                        <p class="text-[11px] text-zinc-500">Projectors, Pocket WiFi, Camera Kits</p>
                                    </div>
                                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-amber-950 text-amber-400 border border-amber-800">Check Stock</span>
                                </div>

                                <div class="pt-2">
                                    <a href="{{ route('login') }}" class="block text-center w-full py-3 bg-zinc-100 hover:bg-white text-black text-xs font-bold rounded-xl transition">
                                        Explore All Resources &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- STATS BAR -->
        <section class="border-y border-[#27272A] bg-[#18181B]/50 py-12">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div class="space-y-1">
                        <p class="text-4xl font-extrabold text-white">15+</p>
                        <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Campus Facilities</p>
                    </div>
                    <div class="space-y-1 border-y md:border-y-0 md:border-x border-[#27272A] py-6 md:py-0">
                        <p class="text-4xl font-extrabold text-white">50+</p>
                        <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Equipment Units</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-4xl font-extrabold text-white">Main Campus</p>
                        <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Active Portal Hub</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="bg-[#09090B] text-zinc-400 py-12 border-t border-[#27272A]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-lg bg-zinc-100 text-black flex items-center justify-center font-bold text-xs">⚡</div>
                    <span class="font-bold text-sm text-white">Resource Hub</span>
                </div>
                <div class="text-xs text-zinc-500">
                    &copy; {{ date('Y') }} Facility Reservation System. All rights reserved.
                </div>
            </div>
        </footer>

    </body>
</html>