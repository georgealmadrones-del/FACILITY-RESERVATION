<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RESERVA — CATC Facility Hub</title>
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
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-zinc-700 to-zinc-900 border border-zinc-700 flex items-center justify-center shadow-md">
                    <span class="font-extrabold text-white text-sm tracking-tighter">R</span>
                </div>
                <div>
                    <span class="font-extrabold text-base tracking-tight text-white block leading-none">RESERVA</span>
                    <span class="text-[10px] font-semibold text-zinc-400 uppercase tracking-widest block mt-1">CATC FACILITY HUB</span>
                </div>
            </div>

            <!-- Nav Links -->
            <nav class="hidden md:flex items-center space-x-8 text-xs font-semibold text-zinc-400">
                <a href="#what-to-reserve" class="hover:text-white transition">What you can reserve</a>
                <a href="#core-features" class="hover:text-white transition">Core features</a>
                <a href="#how-it-works" class="hover:text-white transition">User tutorial</a>
            </nav>

            <!-- Auth Actions -->
            <div class="flex items-center space-x-3">
                @Route::has('login')
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
                    <span>OFFICIAL CATC RESOURCE PLATFORM</span>
                </div>

                <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white leading-[1.08]">
                    Campus resources, ready when you are.
                </h1>

                <p class="text-sm sm:text-base text-zinc-400 max-w-xl leading-relaxed">
                    Reserve facilities, laboratories, and technical equipment across Computer Arts and Technical College—all in one clear, dependable place.
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
                    ⚡ <span class="text-zinc-300 font-bold">1,240+</span> successful campus reservations this term
                </p>
            </div>

            <!-- Live Campus View Card (Right Column) -->
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

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-3 gap-3">
                        <div class="bg-zinc-900/60 p-3.5 rounded-2xl border border-zinc-800/80">
                            <span class="text-[10px] text-zinc-500 font-medium block">Available now</span>
                            <span class="text-xl font-extrabold text-white mt-1 block">42</span>
                            <span class="text-[9px] text-zinc-500 block">resources</span>
                        </div>
                        <div class="bg-zinc-900/60 p-3.5 rounded-2xl border border-zinc-800/80">
                            <span class="text-[10px] text-zinc-500 font-medium block">Today's bookings</span>
                            <span class="text-xl font-extrabold text-white mt-1 block">18</span>
                            <span class="text-[9px] text-zinc-500 block">confirmed</span>
                        </div>
                        <div class="bg-zinc-900/60 p-3.5 rounded-2xl border border-zinc-800/80">
                            <span class="text-[10px] text-zinc-500 font-medium block">Approval rate</span>
                            <span class="text-xl font-extrabold text-white mt-1 block">94%</span>
                            <span class="text-[9px] text-emerald-400 font-semibold block">on time</span>
                        </div>
                    </div>

                    <!-- Mini Live Activity Feed -->
                    <div class="space-y-2 pt-2">
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Today, May 24</span>
                        
                        <div class="p-3 bg-zinc-900/40 rounded-xl border border-zinc-800/60 flex items-center justify-between text-xs">
                            <div class="flex items-center space-x-2.5">
                                <div class="w-7 h-7 rounded-lg bg-zinc-800 flex items-center justify-center text-zinc-400 text-xs">🏛️</div>
                                <div>
                                    <span class="font-bold text-zinc-200 block">Multimedia Room 201</span>
                                    <span class="text-[10px] text-zinc-500">10:00 AM – 12:00 PM</span>
                                </div>
                            </div>
                            <span class="px-2 py-0.5 text-[9px] font-bold rounded bg-emerald-950 text-emerald-400 border border-emerald-900">Open</span>
                        </div>

                        <div class="p-3 bg-zinc-900/40 rounded-xl border border-zinc-800/60 flex items-center justify-between text-xs">
                            <div class="flex items-center space-x-2.5">
                                <div class="w-7 h-7 rounded-lg bg-zinc-800 flex items-center justify-center text-zinc-400 text-xs">💻</div>
                                <div>
                                    <span class="font-bold text-zinc-200 block">CAD Laboratory</span>
                                    <span class="text-[10px] text-zinc-500">01:00 PM – 03:00 PM</span>
                                </div>
                            </div>
                            <span class="px-2 py-0.5 text-[9px] font-bold rounded bg-emerald-950 text-emerald-400 border border-emerald-900">Open</span>
                        </div>

                        <div class="p-3 bg-zinc-900/40 rounded-xl border border-zinc-800/60 flex items-center justify-between text-xs">
                            <div class="flex items-center space-x-2.5">
                                <div class="w-7 h-7 rounded-lg bg-zinc-800 flex items-center justify-center text-zinc-400 text-xs">📷</div>
                                <div>
                                    <span class="font-bold text-zinc-200 block">Photography Kit A</span>
                                    <span class="text-[10px] text-zinc-500">04:30 PM pickup</span>
                                </div>
                            </div>
                            <span class="px-2 py-0.5 text-[9px] font-bold rounded bg-amber-950 text-amber-400 border border-amber-900">Booked</span>
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
            <div class="mb-12">
                <span class="text-xs font-bold text-zinc-500 uppercase tracking-widest block">RESOURCE DIRECTORY</span>
                <h2 class="text-3xl font-extrabold text-white mt-1">Everything your work requires.</h2>
                <p class="text-sm text-zinc-400 mt-2">From presentation spaces to production equipment, RESERVA makes every shared campus resource easy to find.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-[#18181B] p-6 sm:p-8 rounded-3xl border border-[#27272A] hover:border-zinc-500 transition space-y-6 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-200 text-lg shadow-inner">🏛️</div>
                        <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-950 text-emerald-400 border border-emerald-800">AVAILABLE TODAY</span>
                        <h3 class="text-lg font-bold text-white">Auditorium Hall</h3>
                        <p class="text-xs text-zinc-400 leading-relaxed">Spacious presentation hall equipped with surround sound, dual projection screens, and tiered seating for major events.</p>
                    </div>
                    <div class="pt-4 border-t border-[#27272A] flex justify-between items-center text-xs">
                        <span class="text-zinc-500 font-medium">Capacity: 150 persons</span>
                        <a href="{{ route('login') }}" class="font-bold text-white hover:text-emerald-400 transition">&rarr; Reserve</a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-[#18181B] p-6 sm:p-8 rounded-3xl border border-[#27272A] hover:border-zinc-500 transition space-y-6 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-200 text-lg shadow-inner">💻</div>
                        <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-950 text-emerald-400 border border-emerald-800">AVAILABLE TODAY</span>
                        <h3 class="text-lg font-bold text-white">Mac Laboratory</h3>
                        <p class="text-xs text-zinc-400 leading-relaxed">High-performance workstations configured for media production, coding bootcamps, and digital interface prototyping.</p>
                    </div>
                    <div class="pt-4 border-t border-[#27272A] flex justify-between items-center text-xs">
                        <span class="text-zinc-500 font-medium">Capacity: 40 workstations</span>
                        <a href="{{ route('login') }}" class="font-bold text-white hover:text-emerald-400 transition">&rarr; Reserve</a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-[#18181B] p-6 sm:p-8 rounded-3xl border border-[#27272A] hover:border-zinc-500 transition space-y-6 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-200 text-lg shadow-inner">📷</div>
                        <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-950 text-emerald-400 border border-emerald-800">AVAILABLE TODAY</span>
                        <h3 class="text-lg font-bold text-white">Sony Cinema Kit</h3>
                        <p class="text-xs text-zinc-400 leading-relaxed">Professional 4K mirrorless camera body, prime lenses, stabilizer gimbal, and shotgun mic for student creators.</p>
                    </div>
                    <div class="pt-4 border-t border-[#27272A] flex justify-between items-center text-xs">
                        <span class="text-zinc-500 font-medium">Stock: 4 kits ready</span>
                        <a href="{{ route('login') }}" class="font-bold text-white hover:text-emerald-400 transition">&rarr; Reserve</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Core Features Section -->
        <section id="core-features" class="max-w-7xl mx-auto px-6 py-20 border-t border-[#27272A]">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="text-xs font-bold text-zinc-500 uppercase tracking-widest block">BUILT FOR BETTER CAMPUS DAYS</span>
                <h2 class="text-3xl font-extrabold text-white">Simple at every step.</h2>
                <p class="text-sm text-zinc-400">Less time coordinating. More time creating, teaching, and learning.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-300">🏛️</div>
                    <h4 class="font-bold text-sm text-white">One place to reserve</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed">Browse rooms, labs, and equipment true inventory with real-time availability calendars.</p>
                </div>
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-300">⚡</div>
                    <h4 class="font-bold text-sm text-white">Live availability</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed">See what is free right now, check stock levels, and avoid booking conflicts automatically.</p>
                </div>
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-300">🛡️</div>
                    <h4 class="font-bold text-sm text-white">Clear approvals</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed">Track every request from pending to approved with real-time status badges.</p>
                </div>
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-300">📦</div>
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
                <p class="text-sm text-zinc-400 mt-2">A transparent process designed to keep students, faculty, and custodians aligned.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-2">
                    <span class="text-xs font-extrabold text-zinc-600 block">01</span>
                    <h4 class="font-bold text-sm text-white">Sign in</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed">Log in with your official CATC student or faculty account.</p>
                </div>
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-2">
                    <span class="text-xs font-extrabold text-zinc-600 block">02</span>
                    <h4 class="font-bold text-sm text-white">Choose</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed">Select the specific room, lab, or equipment kit you need.</p>
                </div>
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-2">
                    <span class="text-xs font-extrabold text-zinc-600 block">03</span>
                    <h4 class="font-bold text-sm text-white">Schedule</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed">Pick your exact time slots, purpose, and attendee count.</p>
                </div>
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-2">
                    <span class="text-xs font-extrabold text-zinc-600 block">04</span>
                    <h4 class="font-bold text-sm text-white">Submit</h4>
                    <p class="text-xs text-zinc-400 leading-relaxed">Send your request straight to the facility manager.</p>
                </div>
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] space-y-2">
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
                    <h3 class="text-2xl font-extrabold text-white">Your next campus resource is a few clicks away.</h3>
                </div>
                <a href="{{ route('register') }}" class="px-8 py-3.5 bg-emerald-500 hover:bg-emerald-400 text-zinc-950 font-bold text-xs rounded-xl transition shadow-xl shrink-0">
                    Open RESERVA &rarr;
                </a>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="border-t border-[#27272A] bg-[#09090B] py-12 text-xs text-zinc-500">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center gap-6">
            <div class="flex items-center space-x-3">
                <div class="w-7 h-7 rounded-lg bg-zinc-800 border border-zinc-700 flex items-center justify-center text-white font-bold text-xs">R</div>
                <div>
                    <span class="font-bold text-zinc-300">RESERVA</span> &bull; Computer Arts and Technical College
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