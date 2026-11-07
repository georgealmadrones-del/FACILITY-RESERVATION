<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - CATC Resource Hub</title>

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
                    <div class="w-10 h-10 rounded-xl bg-zinc-100 text-black flex items-center justify-center font-bold text-lg shadow-sm">
                        ⚡
                    </div>
                    <div>
                        <span class="font-extrabold text-base tracking-tight text-white block leading-tight">CATC Resource Hub</span>
                        <span class="text-[10px] text-zinc-400 font-semibold tracking-wider uppercase">Computer Arts & Technical College</span>
                    </div>
                </div>

                <!-- Nav Links -->
                <div class="hidden md:flex items-center space-x-8 text-sm font-semibold text-zinc-400">
                    <a href="#facilities" class="hover:text-white transition">Facilities & Equipment</a>
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

                    <!-- Right Interactive Resource Preview Card -->
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
                                <a href="{{ route('login') }}" class="block p-3.5 rounded-2xl bg-[#09090B] border border-[#27272A] hover:border-zinc-500 transition group">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-xs font-bold text-white group-hover:text-zinc-200">Rooms & Halls</p>
                                            <p class="text-[11px] text-zinc-500">Audio-Visual Room, Lecture Halls, Student Lounge</p>
                                        </div>
                                        <span class="px-2 py-1 text-[10px] font-bold rounded-full bg-emerald-950 text-emerald-400 border border-emerald-800">Available &rarr;</span>
                                    </div>
                                </a>

                                <!-- Laboratories -->
                                <a href="{{ route('login') }}" class="block p-3.5 rounded-2xl bg-[#09090B] border border-[#27272A] hover:border-zinc-500 transition group">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-xs font-bold text-white group-hover:text-zinc-200">Computer Laboratories</p>
                                            <p class="text-[11px] text-zinc-500">Lab 1, Lab 2, Network & Coding Workstations</p>
                                        </div>
                                        <span class="px-2 py-1 text-[10px] font-bold rounded-full bg-emerald-950 text-emerald-400 border border-emerald-800">Available &rarr;</span>
                                    </div>
                                </a>

                                <!-- Equipment -->
                                <a href="{{ route('login') }}" class="block p-3.5 rounded-2xl bg-[#09090B] border border-[#27272A] hover:border-zinc-500 transition group">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-xs font-bold text-white group-hover:text-zinc-200">Technical Equipment</p>
                                            <p class="text-[11px] text-zinc-500">Projectors, DSLR Kits, Pocket WiFis</p>
                                        </div>
                                        <span class="px-2 py-1 text-[10px] font-bold rounded-full bg-amber-950 text-amber-400 border border-amber-800">Check Stock &rarr;</span>
                                    </div>
                                </a>
                            </div>

                            <div class="pt-1">
                                <a href="{{ route('login') }}" class="block text-center w-full py-3 bg-zinc-100 hover:bg-white text-black text-xs font-bold rounded-xl transition">
                                    Reserve Now &rarr;
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
                    <div class="bg-[#18181B] p-8 rounded-3xl border border-[#27272A] space-y-4 shadow-sm hover:border-zinc-500 transition">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-800 flex items-center justify-center text-white font-bold text-lg">📅</div>
                        <h3 class="font-bold text-lg text-white">Facility & Equipment Booking</h3>
                        <p class="text-xs text-zinc-400 leading-relaxed">Browse classrooms, computer laboratories, and technical gear with real-time calendars. Request item bundles alongside your space reservation.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-[#18181B] p-8 rounded-3xl border border-[#27272A] space-y-4 shadow-sm hover:border-zinc-500 transition">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-800 flex items-center justify-center text-white font-bold text-lg">⚡</div>
                        <h3 class="font-bold text-lg text-white">Administrative Approvals</h3>
                        <p class="text-xs text-zinc-400 leading-relaxed">Streamlined multi-level approval workflows with live status tracking — from submission through department sign-off to final confirmation.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-[#18181B] p-8 rounded-3xl border border-[#27272A] space-y-4 shadow-sm hover:border-zinc-500 transition">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-800 flex items-center justify-center text-white font-bold text-lg">🎓</div>
                        <h3 class="font-bold text-lg text-white">Campus Event Logistics</h3>
                        <p class="text-xs text-zinc-400 leading-relaxed">Official tracking and documentation support for student organizations, tech symposiums, faculty lectures, and institutional functions.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-[#18181B] p-8 rounded-3xl border border-[#27272A] space-y-4 shadow-sm hover:border-zinc-500 transition">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-800 flex items-center justify-center text-white font-bold text-lg">🔔</div>
                        <h3 class="font-bold text-lg text-white">Smart Notifications</h3>
                        <p class="text-xs text-zinc-400 leading-relaxed">Real-time alerts on approvals, rejections, reminders, and campus announcements delivered directly to your dashboard.</p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="bg-[#18181B] p-8 rounded-3xl border border-[#27272A] space-y-4 shadow-sm hover:border-zinc-500 transition">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-800 flex items-center justify-center text-white font-bold text-lg">🛡️</div>
                        <h3 class="font-bold text-lg text-white">QR Verification</h3>
                        <p class="text-xs text-zinc-400 leading-relaxed">Every approved reservation generates a secure QR-coded permit for on-site check-in and verification by property custodians.</p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="bg-[#18181B] p-8 rounded-3xl border border-[#27272A] space-y-4 shadow-sm hover:border-zinc-500 transition">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-800 flex items-center justify-center text-white font-bold text-lg">🔑</div>
                        <h3 class="font-bold text-lg text-white">Institutional SSO Login</h3>
                        <p class="text-xs text-zinc-400 leading-relaxed">Sign in securely using your official CATC student credentials via the institutional portal — no separate account creation required.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- TUTORIAL SECTION -->
        <section id="tutorial" class="py-20 bg-[#18181B]/40 border-t border-[#27272A]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-12">
                <div class="text-center space-y-3 max-w-2xl mx-auto">
                    <span class="text-xs font-bold uppercase tracking-widest text-zinc-400">User Tutorial</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white">From Login to Confirmed in Five Steps</h2>
                    <p class="text-sm text-zinc-400">Follow this simple guide to reserve any CATC facility or equipment unit.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <!-- Step 1 -->
                    <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3">
                        <span class="w-8 h-8 rounded-xl bg-zinc-100 text-black flex items-center justify-center text-xs font-bold">1</span>
                        <h4 class="font-bold text-sm text-white">Log In</h4>
                        <p class="text-xs text-zinc-400">Sign in with your CATC university credentials. No separate sign-up needed.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3">
                        <span class="w-8 h-8 rounded-xl bg-zinc-100 text-black flex items-center justify-center text-xs font-bold">2</span>
                        <h4 class="font-bold text-sm text-white">Complete Profile</h4>
                        <p class="text-xs text-zinc-400">Fill in your course, organization, and year level — done just once on first login.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3">
                        <span class="w-8 h-8 rounded-xl bg-zinc-100 text-black flex items-center justify-center text-xs font-bold">3</span>
                        <h4 class="font-bold text-sm text-white">Pick a Facility</h4>
                        <p class="text-xs text-zinc-400">Browse available spaces and equipment by date and time using the real-time calendar.</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3">
                        <span class="w-8 h-8 rounded-xl bg-zinc-100 text-black flex items-center justify-center text-xs font-bold">4</span>
                        <h4 class="font-bold text-sm text-white">Submit Request</h4>
                        <p class="text-xs text-zinc-400">Fill in event details, attach required documents, and submit for multi-level approval.</p>
                    </div>

                    <!-- Step 5 -->
                    <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3">
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
                    <div class="w-8 h-8 rounded-lg bg-zinc-100 text-black flex items-center justify-center font-bold text-xs">⚡</div>
                    <div>
                        <span class="font-bold text-sm text-white block">CATC Resource Hub</span>
                        <span class="text-[10px] text-zinc-500">Computer Arts & Technical College</span>
                    </div>
                </div>
                <div class="text-xs text-zinc-500">
                    &copy; {{ date('Y') }} Computer Arts and Technical College (CATC). All rights reserved.
                </div>
            </div>
        </footer>

    </body>
</html>