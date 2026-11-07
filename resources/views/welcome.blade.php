<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - RESERVA | CATC</title>

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
        <nav class="sticky top-0 z-50 bg-[#09090B]/90 backdrop-blur-md border-b border-[#27272A]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 h-20 flex justify-between items-center">
                <!-- Logo & Name -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/reserva.jpg') }}" alt="RESERVA Logo" class="w-10 h-10 rounded-xl object-cover border border-[#27272A]">
                    <div>
                        <span class="font-extrabold text-base tracking-tight text-white block leading-tight">RESERVA</span>
                        <span class="text-[10px] text-zinc-400 font-semibold tracking-wider uppercase">CATC Facility Hub</span>
                    </div>
                </div>

                <!-- Nav Links -->
                <div class="hidden md:flex items-center space-x-8 text-sm font-semibold text-zinc-400">
                    <a href="#facilities" class="hover:text-white transition">What You Can Reserve</a>
                    <a href="#features" class="hover:text-white transition">Core Features</a>
                    <a href="#tutorial" class="hover:text-white transition">User Tutorial</a>
                </div>

                <!-- Auth Actions -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-zinc-100 hover:bg-white text-black rounded-xl text-xs font-bold transition shadow-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 bg-zinc-100 hover:bg-white text-black rounded-xl text-xs font-bold transition shadow-sm">
                            Sign In
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
                            <span>COMPUTER ARTS & TECHNICAL COLLEGE (CATC)</span>
                        </div>
                        
                        <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white leading-[1.15]">
                            Property and Facility Reservation System
                        </h1>
                        
                        <p class="text-base text-zinc-400 max-w-xl font-normal leading-relaxed">
                            Reserve with Confidence, Organize with Ease. Streamline campus facility scheduling, computer labs, and technical equipment borrowing in one unified platform.
                        </p>

                        <div class="flex flex-wrap items-center gap-4 pt-2">
                            <a href="{{ route('login') }}" class="px-6 py-3.5 bg-zinc-100 hover:bg-white text-black font-bold rounded-2xl shadow-lg transition text-sm">
                                Sign In to Portal
                            </a>
                            <a href="#tutorial" class="px-6 py-3.5 bg-[#18181B] hover:bg-[#27272A] text-zinc-100 font-bold rounded-2xl border border-[#27272A] transition text-sm">
                                View User Tutorial
                            </a>
                        </div>
                    </div>

                    <!-- Right Clickable Resource Preview Card -->
                    <div class="lg:col-span-5" id="facilities">
                        <div class="bg-[#18181B] p-6 sm:p-8 rounded-3xl border border-[#27272A] shadow-2xl relative space-y-4">
                            <div class="border-b border-[#27272A] pb-4 flex justify-between items-center">
                                <div>
                                    <h3 class="font-bold text-lg text-white">What can you reserve?</h3>
                                    <p class="text-xs text-zinc-400">CATC campus spaces & technical gear</p>
                                </div>
                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-950 text-emerald-400 border border-emerald-800 animate-pulse">Live</span>
                            </div>

                            <div class="space-y-3">
                                <!-- Rooms & Halls -->
                                <div class="p-3.5 rounded-2xl bg-[#09090B] border border-[#27272A] hover:border-zinc-500 transition cursor-pointer">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-xs font-bold text-white">Rooms & Halls</p>
                                            <p class="text-[11px] text-zinc-500">Audio-Visual Room, Lecture Halls, Student Lounge</p>
                                        </div>
                                        <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-950/80 text-emerald-400 border border-emerald-800/80">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                            <span>Available</span>
                                        </span>
                                    </div>
                                </div>

                                <!-- Laboratories -->
                                <div class="p-3.5 rounded-2xl bg-[#09090B] border border-[#27272A] hover:border-zinc-500 transition cursor-pointer">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-xs font-bold text-white">Computer Laboratories</p>
                                            <p class="text-[11px] text-zinc-500">Lab 1, Lab 2, Network & Coding Workstations</p>
                                        </div>
                                        <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-950/80 text-emerald-400 border border-emerald-800/80">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                            <span>Available</span>
                                        </span>
                                    </div>
                                </div>

                                <!-- Equipment -->
                                <div class="p-3.5 rounded-2xl bg-[#09090B] border border-[#27272A] hover:border-zinc-500 transition cursor-pointer">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-xs font-bold text-white">Technical Equipment</p>
                                            <p class="text-[11px] text-zinc-500">Projectors, DSLR Kits, Pocket WiFis</p>
                                        </div>
                                        <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-950/80 text-emerald-400 border border-emerald-800/80">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                            <span>Check Stock</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-1">
                                <a href="{{ route('login') }}" class="block text-center w-full py-3 bg-zinc-100 hover:bg-white text-black text-xs font-bold rounded-xl transition">
                                    Sign In to Access Booking &rarr;
                                </a>
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
                        <p class="text-4xl font-extrabold text-white">12+</p>
                        <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Campus Facilities & Labs</p>
                    </div>
                    <div class="space-y-1 border-y md:border-y-0 md:border-x border-[#27272A] py-6 md:py-0">
                        <p class="text-4xl font-extrabold text-white">50+</p>
                        <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Technical Equipment Units</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-4xl font-extrabold text-white">CATC</p>
                        <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Main Campus Portal</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CORE FEATURES SECTION -->
        <section id="features" class="py-20">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-12">
                <div class="text-center space-y-3 max-w-2xl mx-auto">
                    <span class="text-xs font-bold uppercase tracking-widest text-zinc-400">Core Features</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white">Designed Around CATC Student Workflow</h2>
                    <p class="text-sm text-zinc-400">From booking a computer workstation to tracking equipment logistics — handled seamlessly end-to-end.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-[#18181B] p-8 rounded-3xl border border-[#27272A] space-y-4 shadow-sm hover:border-zinc-500 transition cursor-pointer">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-800 flex items-center justify-center text-zinc-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="font-bold text-lg text-white">Facility & Equipment Booking</h3>
                        <p class="text-xs text-zinc-400 leading-relaxed">Browse classrooms, computer laboratories, and technical gear with real-time calendars. Request item bundles alongside your space reservation.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-[#18181B] p-8 rounded-3xl border border-[#27272A] space-y-4 shadow-sm hover:border-zinc-500 transition cursor-pointer">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-800 flex items-center justify-center text-zinc-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="font-bold text-lg text-white">Administrative Approvals</h3>
                        <p class="text-xs text-zinc-400 leading-relaxed">Streamlined multi-level approval workflows with live status tracking — from submission through department sign-off to final confirmation.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-[#18181B] p-8 rounded-3xl border border-[#27272A] space-y-4 shadow-sm hover:border-zinc-500 transition cursor-pointer">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-800 flex items-center justify-center text-zinc-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <h3 class="font-bold text-lg text-white">Campus Event Logistics</h3>
                        <p class="text-xs text-zinc-400 leading-relaxed">Official tracking and documentation support for student organizations, tech symposiums, faculty lectures, and institutional functions.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-[#18181B] p-8 rounded-3xl border border-[#27272A] space-y-4 shadow-sm hover:border-zinc-500 transition cursor-pointer">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-800 flex items-center justify-center text-zinc-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </div>
                        <h3 class="font-bold text-lg text-white">Smart Notifications</h3>
                        <p class="text-xs text-zinc-400 leading-relaxed">Real-time alerts on approvals, rejections, reminders, and campus announcements delivered directly to your dashboard.</p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="bg-[#18181B] p-8 rounded-3xl border border-[#27272A] space-y-4 shadow-sm hover:border-zinc-500 transition cursor-pointer">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-800 flex items-center justify-center text-zinc-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                        </div>
                        <h3 class="font-bold text-lg text-white">QR Verification</h3>
                        <p class="text-xs text-zinc-400 leading-relaxed">Every approved reservation generates a secure QR-coded permit for on-site check-in and verification by property custodians.</p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="bg-[#18181B] p-8 rounded-3xl border border-[#27272A] space-y-4 shadow-sm hover:border-zinc-500 transition cursor-pointer">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-800 flex items-center justify-center text-zinc-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        </div>
                        <h3 class="font-bold text-lg text-white">Institutional SSO Login</h3>
                        <p class="text-xs text-zinc-400 leading-relaxed">Sign in securely using your official CATC student credentials via the institutional portal — no separate account creation required.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- USER TUTORIAL SECTION -->
        <section id="tutorial" class="py-20 bg-[#18181B]/40 border-t border-[#27272A]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-12">
                <div class="text-center space-y-3 max-w-2xl mx-auto">
                    <span class="text-xs font-bold uppercase tracking-widest text-zinc-400">User Tutorial</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white">From Login to Confirmed in Five Steps</h2>
                    <p class="text-sm text-zinc-400">Follow this simple guide to reserve any CATC facility or equipment unit.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <!-- Step 1 -->
                    <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3 hover:border-zinc-500 transition cursor-pointer">
                        <span class="w-8 h-8 rounded-xl bg-zinc-100 text-black flex items-center justify-center text-xs font-bold">1</span>
                        <h4 class="font-bold text-sm text-white">Log In</h4>
                        <p class="text-xs text-zinc-400">Sign in with your CATC university credentials. No separate sign-up needed.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3 hover:border-zinc-500 transition cursor-pointer">
                        <span class="w-8 h-8 rounded-xl bg-zinc-100 text-black flex items-center justify-center text-xs font-bold">2</span>
                        <h4 class="font-bold text-sm text-white">Complete Profile</h4>
                        <p class="text-xs text-zinc-400">Fill in your course, organization, and year level — done just once on first login.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3 hover:border-zinc-500 transition cursor-pointer">
                        <span class="w-8 h-8 rounded-xl bg-zinc-100 text-black flex items-center justify-center text-xs font-bold">3</span>
                        <h4 class="font-bold text-sm text-white">Pick a Facility</h4>
                        <p class="text-xs text-zinc-400">Browse available spaces and equipment by date and time using the real-time calendar.</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3 hover:border-zinc-500 transition cursor-pointer">
                        <span class="w-8 h-8 rounded-xl bg-zinc-100 text-black flex items-center justify-center text-xs font-bold">4</span>
                        <h4 class="font-bold text-sm text-white">Submit Request</h4>
                        <p class="text-xs text-zinc-400">Fill in event details, attach required documents, and submit for multi-level approval.</p>
                    </div>

                    <!-- Step 5 -->
                    <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3 hover:border-zinc-500 transition cursor-pointer">
                        <span class="w-8 h-8 rounded-xl bg-zinc-100 text-black flex items-center justify-center text-xs font-bold">5</span>
                        <h4 class="font-bold text-sm text-white">Get Confirmed</h4>
                        <p class="text-xs text-zinc-400">Track status at every stage and present your QR-coded permit on the day of use.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="bg-[#09090B] text-zinc-400 py-12 border-t border-[#27272A]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/reserva.jpg') }}" alt="RESERVA Logo" class="w-8 h-8 rounded-lg object-cover border border-[#27272A]">
                    <div>
                        <span class="font-bold text-sm text-white block">RESERVA Hub</span>
                        <span class="text-[10px] text-zinc-500">Computer Arts & Technical College</span>
                    </div>
                </div>
                <div class="text-xs text-zinc-500">
                    &copy; {{ date('Y') }} Computer Arts and Technical College (RESERVA). All rights reserved.
                </div>
            </div>
        </footer>

    </body>
</html>