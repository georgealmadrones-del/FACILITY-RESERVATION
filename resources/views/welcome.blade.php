<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark" x-data="{ 
    openModal: false, 
    activeResource: {}, 
    searchQuery: '',
    countAvailable: 0,
    countBookings: 0,
    countApproval: 0,
    animateCounters() {
        let duration = 1000;
        let start = null;
        let step = (timestamp) => {
            if (!start) start = timestamp;
            let progress = Math.min((timestamp - start) / duration, 1);
            this.countAvailable = Math.floor(progress * 42);
            this.countBookings = Math.floor(progress * 18);
            this.countApproval = Math.floor(progress * 94);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    },
    resources: [
        { name: 'Auditorium Hall', type: 'Facility', status: 'Available Today', capacity: '150 persons', desc: 'Spacious presentation hall equipped with surround sound, dual projection screens, and tiered seating for major events.', icon: 'building' },
        { name: 'Mac Laboratory', type: 'Facility', status: 'Available Today', capacity: '40 workstations', desc: 'High-performance workstations configured for media production, coding bootcamps, and digital interface prototyping.', icon: 'cpu' },
        { name: 'Sony Cinema Kit', type: 'Equipment', status: '4 Kits Ready', capacity: 'Stock: 4 units', desc: 'Professional 4K mirrorless camera body, prime lenses, stabilizer gimbal, and shotgun mic for student creators.', icon: 'camera' }
    ],
    get filteredResources() {
        if (this.searchQuery === '') return this.resources;
        return this.resources.filter(r => r.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || r.type.toLowerCase().includes(this.searchQuery.toLowerCase()));
    }
}" x-init="animateCounters()">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RESERVA — Facility & Equipment Reservation Hub</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Scripts & Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #09090B; color: #FAFAFA; }
    </style>
</head>
<body class="bg-[#09090B] text-zinc-100 antialiased selection:bg-zinc-800 selection:text-white min-h-screen flex flex-col justify-between">

    <!-- Top Navigation Bar -->
    <header class="w-full border-b border-[#27272A] bg-[#09090B]/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                <img src="{{ asset('reserva.jpg') }}" alt="RESERVA Logo" class="w-10 h-10 rounded-xl object-cover border border-zinc-700 shadow-md group-hover:border-zinc-500 transition" onerror="this.src='{{ asset('images/reserva.jpg') }}';">
                <div>
                    <span class="font-extrabold text-base tracking-tight text-white block leading-none">RESERVA</span>
                    <span class="text-[10px] font-semibold text-zinc-400 uppercase tracking-widest block mt-1">RESOURCE HUB</span>
                </div>
            </a>

            <!-- Nav Links -->
            <nav class="hidden md:flex items-center space-x-8 text-xs font-semibold text-zinc-400">
                <a href="#what-to-reserve" class="hover:text-white transition">What you can reserve</a>
                <a href="#core-features" class="hover:text-white transition">Core features</a>
                <a href="#how-it-works" class="hover:text-white transition">User tutorial</a>
            </nav>

            <!-- Auth Actions -->
            <div class="flex items-center space-x-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 text-xs font-bold text-white bg-zinc-800 hover:bg-zinc-700 rounded-xl border border-zinc-700 transition shadow-sm">
                            Dashboard &rarr;
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 text-xs font-bold text-zinc-300 hover:text-white hover:bg-zinc-900 rounded-xl transition">
                            Sign in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2.5 text-xs font-bold text-zinc-950 bg-zinc-100 hover:bg-white rounded-xl transition shadow-lg flex items-center space-x-1.5">
                                <span>Access portal</span>
                                <span class="text-zinc-950 font-bold">&rarr;</span>
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <!-- Main Hero & Feature Sections -->
    <main class="flex-grow">
        
        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-6 py-16 lg:py-24 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-8">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-zinc-900 border border-zinc-800 text-[11px] font-semibold text-zinc-300">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>ENTERPRISE RESOURCE PLATFORM</span>
                </div>

                <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white leading-[1.08]">
                    Campus resources, ready when you are.
                </h1>

                <p class="text-sm sm:text-base text-zinc-400 max-w-xl leading-relaxed">
                    Streamline facility scheduling, laboratory reservations, and technical equipment borrowing all in one clean, dependable platform.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="{{ route('register') }}" class="px-6.5 py-3.5 bg-emerald-500 hover:bg-emerald-400 text-zinc-950 font-bold text-xs rounded-xl transition shadow-xl flex items-center space-x-2">
                        <span>Start a reservation</span>
                        <span>&rarr;</span>
                    </a>
                    <a href="#how-it-works" class="px-6.5 py-3.5 bg-zinc-900 hover:bg-zinc-800 text-zinc-200 font-bold text-xs rounded-xl border border-zinc-800 transition">
                        See how it works
                    </a>
                </div>

                <p class="text-[11px] text-zinc-500 font-medium pt-2">
                    ⚡ <span class="text-zinc-300 font-bold">1,240+</span> successful reservations processed this term
                </p>
            </div>

            <!-- Live View Card (Right Column) -->
            <div class="lg:col-span-5">
                <div class="bg-[#18181B] p-6 sm:p-8 rounded-3xl border border-[#27272A] shadow-2xl space-y-6">
                    <div class="flex justify-between items-center border-b border-[#27272A] pb-4">
                        <div>
                            <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block">Live Campus View</span>
                            <h3 class="text-base font-bold text-white mt-0.5">Resource availability</h3>
                        </div>
                        <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-950 text-emerald-400 border border-emerald-800 flex items-center space-x-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>SYSTEM ONLINE</span>
                        </span>
                    </div>

                    <!-- Fast Animated Counters -->
                    <div class="grid grid-cols-3 gap-3">
                        <div class="bg-zinc-900/60 p-3.5 rounded-2xl border border-zinc-800/80">
                            <span class="text-[10px] text-zinc-500 font-medium block">Available now</span>
                            <span class="text-2xl font-extrabold text-white mt-1 block" x-text="countAvailable">0</span>
                            <span class="text-[9px] text-zinc-500 block">resources</span>
                        </div>
                        <div class="bg-zinc-900/60 p-3.5 rounded-2xl border border-zinc-800/80">
                            <span class="text-[10px] text-zinc-500 font-medium block">Today's bookings</span>
                            <span class="text-2xl font-extrabold text-white mt-1 block" x-text="countBookings">0</span>
                            <span class="text-[9px] text-zinc-500 block">confirmed</span>
                        </div>
                        <div class="bg-zinc-900/60 p-3.5 rounded-2xl border border-zinc-800/80">
                            <span class="text-[10px] text-zinc-500 font-medium block">Approval rate</span>
                            <span class="text-2xl font-extrabold text-white mt-1 block"><span x-text="countApproval">0</span>%</span>
                            <span class="text-[9px] text-emerald-400 font-semibold block">on time</span>
                        </div>
                    </div>

                    <!-- Mini Live Activity Feed -->
                    <div class="space-y-2 pt-2">
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Today's Activity Feed</span>
                        
                        <div class="p-3 bg-zinc-900/40 rounded-xl border border-zinc-800/60 flex items-center justify-between text-xs hover:border-zinc-700 transition cursor-pointer">
                            <div class="flex items-center space-x-2.5">
                                <div class="w-7 h-7 rounded-lg bg-zinc-800 flex items-center justify-center text-zinc-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </div>
                                <div>
                                    <span class="font-bold text-zinc-200 block">Multimedia Room 201</span>
                                    <span class="text-[10px] text-zinc-500">10:00 AM – 12:00 PM</span>
                                </div>
                            </div>
                            <span class="px-2 py-0.5 text-[9px] font-bold rounded bg-emerald-950 text-emerald-400 border border-emerald-900">Open</span>
                        </div>

                        <div class="p-3 bg-zinc-900/40 rounded-xl border border-zinc-800/60 flex items-center justify-between text-xs hover:border-zinc-700 transition cursor-pointer">
                            <div class="flex items-center space-x-2.5">
                                <div class="w-7 h-7 rounded-lg bg-zinc-800 flex items-center justify-center text-zinc-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <span class="font-bold text-zinc-200 block">CAD Laboratory</span>
                                    <span class="text-[10px] text-zinc-500">01:00 PM – 03:00 PM</span>
                                </div>
                            </div>
                            <span class="px-2 py-0.5 text-[9px] font-bold rounded bg-emerald-950 text-emerald-400 border border-emerald-900">Open</span>
                        </div>
                    </div>

                    <a href="{{ route('login') }}" class="w-full py-3 bg-zinc-900 hover:bg-zinc-800 text-zinc-200 font-bold text-xs rounded-xl border border-zinc-800 transition block text-center shadow-inner">
                        Sign In to Access Booking &rarr;
                    </a>
                </div>
            </div>
        </section>

        <!-- What You Can Reserve Section -->
        <section id="what-to-reserve" class="max-w-7xl mx-auto px-6 py-20 border-t border-[#27272A]">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4">
                <div>
                    <span class="text-xs font-bold text-zinc-500 uppercase tracking-widest block">RESOURCE DIRECTORY</span>
                    <h2 class="text-3xl font-extrabold text-white mt-1">Everything your work requires.</h2>
                    <p class="text-sm text-zinc-400 mt-2">From presentation spaces to production equipment, click any item to preview details.</p>
                </div>
                <!-- Interactive Search Filter -->
                <div class="w-full md:w-72">
                    <input type="text" x-model="searchQuery" placeholder="Filter resources..." class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-2.5 text-xs text-zinc-200 focus:outline-none focus:border-zinc-600 transition placeholder-zinc-600">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <template x-for="item in filteredResources" :key="item.name">
                    <div @click="activeResource = item; openModal = true" class="bg-[#18181B] p-6 sm:p-8 rounded-3xl border border-[#27272A] hover:border-zinc-500 transition cursor-pointer group space-y-6 flex flex-col justify-between shadow-lg">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-2xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-200 shadow-inner group-hover:scale-105 transition">
                                <template x-if="item.icon === 'building'">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </template>
                                <template x-if="item.icon === 'cpu'">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </template>
                                <template x-if="item.icon === 'camera'">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </template>
                            </div>
                            <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-950 text-emerald-400 border border-emerald-800" x-text="item.status"></span>
                            <h3 class="text-lg font-bold text-white group-hover:text-emerald-400 transition" x-text="item.name"></h3>
                            <p class="text-xs text-zinc-400 leading-relaxed" x-text="item.desc"></p>
                        </div>
                        <div class="pt-4 border-t border-[#27272A] flex justify-between items-center text-xs">
                            <span class="text-zinc-500 font-medium" x-text="item.capacity"></span>
                            <span class="font-bold text-white group-hover:translate-x-1 transition">&rarr; Quick View</span>
                        </div>
                    </div>
                </template>
            </div>
        </section>

        <!-- Core Features Section -->
        <section id="core-features" class="max-w-7xl mx-auto px-6 py-20 border-t border-[#27272A]">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="text-xs font-bold text-zinc-500 uppercase tracking-widest block">BUILT FOR EFFICIENCY</span>
                <h2 class="text-3xl font-extrabold text-white">Simple at every step.</h2>
                <p class="text-sm text-zinc-400">Less time coordinating. More time creating, teaching, and learning.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3 hover:border-zinc-500 transition">
                    <div class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h4 class="font-bold text-sm text-white">One place to reserve</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed">Browse rooms, labs, and equipment with real-time availability calendars.</p>
                </div>
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3 hover:border-zinc-500 transition">
                    <div class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h4 class="font-bold text-sm text-white">Live availability</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed">See what is free right now, check stock levels, and avoid scheduling conflicts.</p>
                </div>
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3 hover:border-zinc-500 transition">
                    <div class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h4 class="font-bold text-sm text-white">Clear approvals</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed">Track every request from pending to approved with real-time status badges.</p>
                </div>
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3 hover:border-zinc-500 transition">
                    <div class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <h4 class="font-bold text-sm text-white">Faster handovers</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed">Quick check-in and check-out logs so gear gets where it needs to be on time.</p>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section id="how-it-works" class="max-w-7xl mx-auto px-6 py-20 border-t border-[#27272A]">
            <div class="mb-12">
                <span class="text-xs font-bold text-zinc-500 uppercase tracking-widest block">HOW IT WORKS</span>
                <h2 class="text-3xl font-extrabold text-white mt-1">From search to secured in five simple steps.</h2>
                <p class="text-sm text-zinc-400 mt-2">A transparent process designed to keep users and administrators perfectly aligned.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-2 hover:border-zinc-500 transition">
                    <span class="text-xs font-extrabold text-zinc-600 block">01</span>
                    <h4 class="font-bold text-sm text-white">Sign in</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed">Log in with your verified user or administrative account credentials.</p>
                </div>
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-2 hover:border-zinc-500 transition">
                    <span class="text-xs font-extrabold text-zinc-600 block">02</span>
                    <h4 class="font-bold text-sm text-white">Choose</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed">Select the specific room, lab, or equipment kit you need.</p>
                </div>
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-2 hover:border-zinc-500 transition">
                    <span class="text-xs font-extrabold text-zinc-600 block">03</span>
                    <h4 class="font-bold text-sm text-white">Schedule</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed">Pick your exact time slots, purpose, and attendee count.</p>
                </div>
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-2 hover:border-zinc-500 transition">
                    <span class="text-xs font-extrabold text-zinc-600 block">04</span>
                    <h4 class="font-bold text-sm text-white">Submit</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed">Send your request straight to the facility manager.</p>
                </div>
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-2 hover:border-zinc-500 transition">
                    <span class="text-xs font-extrabold text-zinc-600 block">05</span>
                    <h4 class="font-bold text-sm text-white">Get approved</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed">Receive instant confirmation and pick up your resource.</p>
                </div>
            </div>
        </section>

        <!-- Call to Action Banner -->
        <section class="max-w-7xl mx-auto px-6 py-16">
            <div class="bg-gradient-to-r from-[#18181B] to-zinc-900 border border-[#27272A] rounded-3xl p-8 sm:p-12 flex flex-col sm:flex-row justify-between items-center gap-6 shadow-2xl">
                <div class="space-y-2 text-center sm:text-left">
                    <span class="text-xs font-bold text-zinc-500 uppercase tracking-wider">READY TO GET STARTED?</span>
                    <h3 class="text-2xl font-extrabold text-white">Your next reservation is a few clicks away.</h3>
                </div>
                <a href="{{ route('register') }}" class="px-8 py-3.5 bg-emerald-500 hover:bg-emerald-400 text-zinc-950 font-bold text-xs rounded-xl transition shadow-xl shrink-0">
                    Open RESERVA &rarr;
                </a>
            </div>
        </section>

    </main>

    <!-- INTERACTIVE RESOURCE PREVIEW MODAL -->
    <div x-show="openModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-80 flex items-center justify-center p-4 backdrop-blur-sm" 
         style="display: none;"
         @keydown.escape.window="openModal = false">
        
        <div @click.away="openModal = false" 
             class="bg-[#18181B] rounded-3xl max-w-md w-full overflow-hidden shadow-2xl transform transition-all border border-[#27272A] text-zinc-100 p-6 space-y-6">
            
            <div class="flex justify-between items-center border-b border-[#27272A] pb-4">
                <span class="px-3 py-1 text-xs font-bold bg-zinc-800 text-zinc-200 rounded-full border border-zinc-700" x-text="activeResource.type"></span>
                <button @click="openModal = false" class="text-zinc-400 hover:text-white font-bold text-sm bg-zinc-900 p-2 rounded-full border border-zinc-800">✕</button>
            </div>

            <div class="space-y-3">
                <h3 class="text-xl font-extrabold text-white" x-text="activeResource.name"></h3>
                <p class="text-xs text-zinc-400 leading-relaxed" x-text="activeResource.desc"></p>
                <p class="text-xs font-semibold text-emerald-400" x-text="activeResource.capacity"></p>
            </div>

            <div class="pt-4 border-t border-[#27272A] flex justify-end space-x-3">
                <button @click="openModal = false" class="bg-zinc-800 hover:bg-zinc-700 text-zinc-300 px-4 py-2.5 rounded-xl text-xs font-bold transition">Close</button>
                <a href="{{ route('login') }}" class="bg-emerald-500 hover:bg-emerald-400 text-zinc-950 px-5 py-2.5 rounded-xl text-xs font-bold transition shadow-md">Book Resource &rarr;</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="border-t border-[#27272A] bg-[#09090B] py-12 text-xs text-zinc-500">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center gap-6">
            <div class="flex items-center space-x-3">
                <div class="w-7 h-7 rounded-lg bg-zinc-800 border border-zinc-700 flex items-center justify-center text-white font-bold text-xs">R</div>
                <div>
                    <span class="font-bold text-zinc-300">RESERVA</span> &bull; Facility & Equipment Booking System
                </div>
            </div>
            <div class="flex items-center space-x-6">
                <a href="#" class="hover:text-zinc-300 transition">Help center</a>
                <a href="#" class="hover:text-zinc-300 transition">Reservation policy</a>
                <a href="#" class="hover:text-zinc-300 transition">Terms of use</a>
            </div>
            <p>&copy; {{ date('Y') }} RESERVA Platform. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>