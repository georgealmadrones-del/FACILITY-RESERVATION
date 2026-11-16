<x-app-layout>
    <div x-data="reservationDashboard()" class="min-h-screen bg-[#0F0E47] text-white font-['Inter',sans-serif] flex relative overflow-x-hidden">
        <!-- Ambient Background Glows -->
        <div class="absolute -top-32 -left-32 w-[35rem] h-[35rem] bg-[#505081]/15 rounded-full blur-[140px] pointer-events-none"></div>
        <div class="absolute top-[40%] -right-32 w-[30rem] h-[30rem] bg-[#272757]/30 rounded-full blur-[120px] pointer-events-none"></div>

        <!-- Left Navigation Sidebar -->
        <aside class="w-64 border-r border-[#505081]/40 bg-[#272757]/90 backdrop-blur-xl min-h-screen p-6 flex flex-col justify-between hidden md:flex sticky top-0 z-40">
            <div class="space-y-8">
                <!-- Brand Header -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('images/reserva.jpg') }}" alt="RESERVA Logo" class="w-9 h-9 rounded-xl object-cover border border-[#505081]/50 shadow-md shadow-[#0F0E47]" onerror="this.src='{{ asset('reserva.jpg') }}';">
                    <div>
                        <span class="font-extrabold text-base tracking-tight text-white block leading-none">RESERVA</span>
                        <span class="text-[9px] font-semibold text-[#8686AC] uppercase tracking-widest block mt-1">RESOURCE SYSTEM</span>
                    </div>
                </a>

                <!-- Workspace Menu -->
                <div class="space-y-6">
                    <div>
                        <span class="text-[10px] font-bold text-[#8686AC] uppercase tracking-widest block mb-3">WORKSPACE</span>
                        <nav class="space-y-1">
                            <button @click="currentView = 'overview'" :class="currentView === 'overview' ? 'bg-[#0F0E47] text-white border-[#505081]' : 'text-[#8686AC] hover:text-white hover:bg-[#0F0E47]/60 border-transparent'" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                                <svg class="w-4 h-4 text-[#8686AC]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Overview</span>
                            </button>
                            <button @click="currentView = 'new-reservation'; bookingStep = 1;" :class="currentView === 'new-reservation' ? 'bg-[#0F0E47] text-white border-[#505081]' : 'text-[#8686AC] hover:text-white hover:bg-[#0F0E47]/60 border-transparent'" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl border transition text-xs font-semibold">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-[#8686AC]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                    <span>New reservation</span>
                                </div>
                                <span class="text-[10px] bg-[#505081]/40 text-[#8686AC] px-1.5 py-0.5 rounded font-mono">+</span>
                            </button>
                            <button @click="currentView = 'availability-calendar'" :class="currentView === 'availability-calendar' ? 'bg-[#0F0E47] text-white border-[#505081]' : 'text-[#8686AC] hover:text-white hover:bg-[#0F0E47]/60 border-transparent'" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border transition text-xs font-semibold">
                                <svg class="w-4 h-4 text-[#8686AC]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Availability Calendar</span>
                            </button>
                            <button @click="currentView = 'profile'; profileTab = 'overview';" :class="currentView === 'profile' ? 'bg-[#0F0E47] text-white border-[#505081]' : 'text-[#8686AC] hover:text-white hover:bg-[#0F0E47]/60 border-transparent'" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                                <svg class="w-4 h-4 text-[#8686AC]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>My profile</span>
                            </button>
                        </nav>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-[#8686AC] uppercase tracking-widest block mb-3">MANAGE</span>
                        <nav class="space-y-1">
                            <button @click="currentView = 'profile'; profileTab = 'history';" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-[#8686AC] hover:text-white hover:bg-[#0F0E47]/60 border border-transparent transition text-xs font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Reservation history</span>
                            </button>
                            <a href="#" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-[#8686AC] hover:text-white hover:bg-[#0F0E47]/60 transition text-xs font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Help & policies</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Sidebar Footer -->
            <div class="pt-6 border-t border-[#505081]/40 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-xl bg-[#0F0E47] border border-[#505081]/50 flex items-center justify-center font-bold text-xs text-[#8686AC]">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                    </div>
                    <div class="overflow-hidden">
                        <span class="font-bold text-xs text-white truncate block">{{ Auth::user()->name ?? 'User Name' }}</span>
                        <span class="text-[10px] text-[#8686AC] truncate block">{{ Auth::user()->role ?? 'Student' }}</span>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Sign out" class="text-[#8686AC] hover:text-rose-400 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Dashboard Viewport -->
        <div class="flex-grow flex flex-col min-h-screen">
            <!-- Top App Bar -->
            <header class="h-20 border-b border-[#505081]/40 bg-[#272757]/80 backdrop-blur-md px-6 lg:px-10 flex items-center justify-between sticky top-0 z-30">
                <div class="w-full max-w-md relative">
                    <svg class="w-4 h-4 absolute left-3.5 top-3.5 text-[#8686AC]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" x-model="searchQuery" placeholder="Search rooms, labs, or equipment..." class="w-full bg-[#0F0E47]/90 border border-[#505081]/40 rounded-xl pl-10 pr-12 py-2.5 text-xs text-zinc-100 focus:outline-none focus:border-[#8686AC] transition placeholder-[#8686AC]/60">
                    <span class="absolute right-3 top-3 text-[10px] font-mono text-[#8686AC] bg-[#272757] px-1.5 py-0.5 rounded border border-[#505081]/40">HK</span>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="hidden md:flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-[#0F0E47] border border-[#505081]/40 text-xs text-zinc-300 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-[#8686AC] animate-pulse"></span>
                        <span class="font-medium">System operational</span>
                        <span class="text-[#505081]">|</span>
                        <span class="text-[#8686AC] font-bold">12 active slots</span>
                    </div>

                    <!-- Notification Bell & Dropdown -->
                    <div class="relative" @click.away="notificationsOpen = false">
                        <button @click="notificationsOpen = !notificationsOpen" class="w-10 h-10 rounded-xl bg-[#0F0E47] hover:bg-[#505081]/30 border border-[#505081]/40 text-zinc-300 flex items-center justify-center transition relative">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                            <template x-if="unreadNotifications > 0">
                                <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-[#8686AC] animate-pulse"></span>
                            </template>
                        </button>
                        <div x-show="notificationsOpen" class="absolute right-0 mt-3 w-80 bg-[#272757] border border-[#505081]/50 rounded-2xl shadow-2xl p-4 space-y-3 z-50" style="display: none;">
                            <div class="flex items-center justify-between pb-2 border-b border-[#505081]/30">
                                <span class="text-xs font-bold text-white">Notifications</span>
                                <button @click="unreadNotifications = 0" class="text-[10px] text-[#8686AC] hover:underline">Mark all read</button>
                            </div>
                            <div class="space-y-2 max-h-64 overflow-y-auto pr-1">
                                <template x-for="n in notifications" :key="n.id">
                                    <div class="p-2.5 rounded-xl hover:border-[#505081] transition bg-[#0F0E47]/60 border border-[#505081]/30 space-y-1">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-bold text-white" x-text="n.title"></span>
                                            <span class="text-[9px] text-[#8686AC]" x-text="n.time"></span>
                                        </div>
                                        <p class="text-[11px] text-[#8686AC] leading-tight" x-text="n.message"></p>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <a href="{{ url('/') }}" target="_blank" class="text-xs text-zinc-300 hover:text-white transition bg-[#0F0E47] hover:bg-[#505081]/30 px-3.5 py-2 rounded-xl border border-[#505081]/40 flex items-center space-x-1.5 shadow-sm">
                        <span>View Portal</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </header>

            <!-- ==================== VIEW 1: OVERVIEW DASHBOARD ==================== -->
            <main x-show="currentView === 'overview'" class="flex-grow p-6 lg:p-10 space-y-10">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-[#8686AC] uppercase tracking-widest block">{{ strtoupper(date('l, F j')) }}</span>
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                            Good day, {{ explode(' ', Auth::user()->name ?? 'User')[0] }}.
                        </h1>
                        <p class="text-xs text-[#8686AC]">Here is what is happening with your campus resources today.</p>
                    </div>
                    <button @click="currentView = 'new-reservation'; bookingStep = 1;" class="px-6 py-3 bg-[#505081] hover:bg-[#636399] text-white font-bold text-xs rounded-xl transition shadow-lg shadow-[#0F0E47]/50 flex items-center space-x-2 shrink-0">
                        <span class="text-base font-extrabold leading-none">+</span>
                        <span>New reservation</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-5 bg-[#272757]/90 backdrop-blur-xl p-6 rounded-3xl border border-[#505081]/40 shadow-xl flex items-center justify-between relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-[#505081]/20 rounded-full blur-2xl pointer-events-none"></div>
                        <div class="flex items-center space-x-4 relative z-10">
                            <div class="w-14 h-14 rounded-2xl bg-[#0F0E47] border border-[#505081]/50 flex items-center justify-center font-extrabold text-lg text-[#8686AC] shadow-inner">
                                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                            </div>
                            <div>
                                <div class="flex items-center space-x-2">
                                    <h3 class="text-base font-bold text-white">{{ Auth::user()->name ?? 'User Name' }}</h3>
                                    <span class="px-2 py-0.5 text-[9px] font-bold rounded bg-[#505081]/30 text-[#8686AC] border border-[#505081]/60 uppercase">ACTIVE</span>
                                </div>
                                <p class="text-xs text-[#8686AC] mt-0.5">{{ Auth::user()->role ?? 'Student' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-[#272757]/90 backdrop-blur-xl p-5 rounded-3xl border border-[#505081]/40 shadow-xl flex flex-col justify-between">
                            <span class="text-[10px] font-bold text-[#8686AC] uppercase tracking-wider block">TOTAL REQUESTS</span>
                            <div class="mt-2">
                                <span class="text-3xl font-extrabold text-white" x-text="recentReservations.length">0</span>
                                <span class="text-[10px] text-[#8686AC] block mt-0.5">Database active records</span>
                            </div>
                        </div>
                        <div class="bg-[#272757]/90 backdrop-blur-xl p-5 rounded-3xl border border-[#505081]/40 shadow-xl flex flex-col justify-between">
                            <span class="text-[10px] font-bold text-[#8686AC] uppercase tracking-wider block">APPROVAL RATE</span>
                            <div class="mt-2">
                                <span class="text-3xl font-extrabold text-white">96%</span>
                                <span class="text-[10px] text-[#8686AC] font-semibold block mt-0.5">Last 12 months</span>
                            </div>
                        </div>
                        <div class="bg-[#272757]/90 backdrop-blur-xl p-5 rounded-3xl border border-[#505081]/40 shadow-xl flex flex-col justify-between space-y-2">
                            <span class="text-[10px] font-bold text-[#8686AC] uppercase tracking-wider block">QUICK ACTIONS</span>
                            <div class="space-y-1.5">
                                <button @click="currentView = 'profile'; profileTab = 'overview';" class="w-full py-1.5 px-3 bg-[#0F0E47] hover:bg-[#505081]/40 text-zinc-200 text-[11px] font-semibold rounded-xl border border-[#505081]/40 transition block text-center">
                                    View profile
                                </button>
                                <button @click="currentView = 'availability-calendar'" class="w-full py-1.5 px-3 bg-[#0F0E47] hover:bg-[#505081]/40 text-zinc-200 text-[11px] font-semibold rounded-xl border border-[#505081]/40 transition block text-center">
                                    Check availability
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Real-Time Recent Reservations Table -->
                <section class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-extrabold text-white">My recent reservations</h3>
                            <p class="text-xs text-[#8686AC]">Click any reservation to view full details, cancel, or return items.</p>
                        </div>
                        <button @click="currentView = 'profile'; profileTab = 'history';" class="text-xs font-bold text-[#8686AC] hover:text-white transition flex items-center space-x-1">
                            <span>View all history</span>
                            <span>&rarr;</span>
                        </button>
                    </div>
                    <div class="bg-[#272757]/90 backdrop-blur-xl rounded-3xl border border-[#505081]/40 overflow-hidden shadow-xl">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-[#505081]/40 text-[10px] font-bold text-[#8686AC] uppercase tracking-wider bg-[#0F0E47]/40">
                                        <th class="py-4 px-6">RESOURCE</th>
                                        <th class="py-4 px-6">DATE & TIME</th>
                                        <th class="py-4 px-6 text-right">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#505081]/30 text-xs">
                                    <template x-for="item in recentReservations" :key="item.id">
                                        <tr @click="selectedReservation = item; detailsModalOpen = true;" class="hover:bg-[#0F0E47]/40 transition cursor-pointer">
                                            <td class="py-4 px-6">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-9 h-9 rounded-xl bg-[#0F0E47] border border-[#505081]/40 flex items-center justify-center text-zinc-300">
                                                        <svg class="w-4 h-4 text-[#8686AC]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                                    </div>
                                                    <div>
                                                        <span class="font-bold text-white block" x-text="item.resource_name"></span>
                                                        <span class="text-[10px] text-[#8686AC] capitalize" x-text="item.resource_type"></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-zinc-300 font-medium" x-text="item.start_time + ' - ' + item.end_time"></td>
                                            <td class="py-4 px-6 text-right">
                                                <span class="px-3 py-1 text-[10px] font-bold rounded-full border shadow-sm" :class="{
                                                    'bg-[#505081]/30 text-[#8686AC] border-[#505081]': item.status === 'approved' || item.status === 'returned',
                                                    'bg-amber-950/50 text-amber-300 border-amber-800/50': item.status === 'pending',
                                                    'bg-rose-950/50 text-rose-300 border-rose-800/50': item.status === 'cancelled'
                                                }" x-text="item.status.toUpperCase()"></span>
                                            </td>
                                        </tr>
                                    </template>
                                    <template x-if="recentReservations.length === 0">
                                        <tr>
                                            <td colspan="3" class="py-8 text-center text-[#8686AC] text-xs">No reservations found. Create your first request!</td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </main>

            <!-- ==================== VIEW 2: NEW RESERVATION WORKSPACE ==================== -->
            <main x-show="currentView === 'new-reservation'" class="flex-grow p-6 lg:p-10 space-y-8" style="display: none;">
                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="resource_type" x-model="resourceType">
                    <input type="hidden" name="resource_name" x-model="resourceType === 'facility' ? selectedFacility : selectedEquipment">
                    <input type="hidden" name="category" x-model="resourceType === 'facility' ? 'rooms' : 'equipment'">
                    <input type="hidden" name="start_time" x-model="selectedDate + ' 10:00:00'">
                    <input type="hidden" name="end_time" x-model="selectedDate + ' 12:00:00'">
                    <input type="hidden" name="quantity" x-model="resourceType === 'facility' ? expectedAttendees : equipmentQuantity">

                    <div class="flex items-center justify-between border-b border-[#505081]/40 pb-6">
                        <div class="space-y-1">
                            <span class="text-[10px] font-bold text-[#8686AC] uppercase tracking-widest block">NEW REQUEST</span>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Make a reservation</h2>
                            <p class="text-xs text-[#8686AC]">Choose a resource and submit directly to your database.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mt-6">
                        <div class="lg:col-span-8 bg-[#272757]/90 backdrop-blur-xl p-6 sm:p-8 rounded-3xl border border-[#505081]/40 shadow-2xl space-y-8">
                            <!-- Step 1: Resource Picker -->
                            <div class="space-y-6">
                                <h3 class="text-base font-extrabold text-white">What do you need?</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <button type="button" @click="resourceType = 'facility'" :class="resourceType === 'facility' ? 'border-[#505081] bg-[#0F0E47] ring-1 ring-[#505081]/50' : 'border-[#505081]/30 bg-[#0F0E47]/40'" class="p-4 rounded-2xl border text-left transition flex items-center justify-between">
                                        <span class="text-xs font-bold text-white">Facility</span>
                                    </button>
                                    <button type="button" @click="resourceType = 'equipment'" :class="resourceType === 'equipment' ? 'border-[#505081] bg-[#0F0E47] ring-1 ring-[#505081]/50' : 'border-[#505081]/30 bg-[#0F0E47]/40'" class="p-4 rounded-2xl border text-left transition flex items-center justify-between">
                                        <span class="text-xs font-bold text-white">Equipment</span>
                                    </button>
                                </div>

                                <template x-if="resourceType === 'facility'">
                                    <div>
                                        <label class="block text-xs font-semibold text-[#8686AC] mb-1.5">Select facility</label>
                                        <select x-model="selectedFacility" class="w-full bg-[#0F0E47] border border-[#505081]/40 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-[#8686AC]">
                                            <option value="Audio-Visual Room (AVR 2) Main Building">Audio-Visual Room (AVR 2) Main Building</option>
                                            <option value="Computer Laboratory 3 (ComLab)">Computer Laboratory 3 (ComLab)</option>
                                            <option value="University Covered Court">University Covered Court</option>
                                        </select>
                                    </div>
                                </template>

                                <template x-if="resourceType === 'equipment'">
                                    <div>
                                        <label class="block text-xs font-semibold text-[#8686AC] mb-1.5">Select equipment</label>
                                        <select x-model="selectedEquipment" class="w-full bg-[#0F0E47] border border-[#505081]/40 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-[#8686AC]">
                                            <option value="Epson Multimedia Classroom Projector">Epson Multimedia Classroom Projector</option>
                                            <option value="Sony Mirrorless Vlogging Camera Kit">Sony Mirrorless Vlogging Camera Kit</option>
                                            <option value="Wireless Microphone Set (Dual Handheld)">Wireless Microphone Set (Dual Handheld)</option>
                                        </select>
                                    </div>
                                </template>
                            </div>

                            <!-- Step 2: Dynamic Calendar Picker -->
                            <div class="space-y-6 pt-6 border-t border-[#505081]/40">
                                <h3 class="text-base font-extrabold text-white">When do you need it?</h3>
                                <div class="bg-[#0F0E47]/50 p-5 rounded-2xl border border-[#505081]/40 max-w-md">
                                    <!-- Month Header with Arrows -->
                                    <div class="flex items-center justify-between mb-4">
                                        <button type="button" @click="prevMonth()" class="text-[#8686AC] hover:text-white px-2.5 py-1 bg-[#272757] rounded-lg border border-[#505081]/40">&larr;</button>
                                        <span class="text-xs font-extrabold text-white" x-text="monthName + ' ' + currentYear"></span>
                                        <button type="button" @click="nextMonth()" class="text-[#8686AC] hover:text-white px-2.5 py-1 bg-[#272757] rounded-lg border border-[#505081]/40">&rarr;</button>
                                    </div>
                                    <!-- Days Grid -->
                                    <div class="grid grid-cols-7 gap-1 text-center text-[11px] text-[#8686AC] font-semibold mb-2">
                                        <span>Su</span><span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span>
                                    </div>
                                    <div class="grid grid-cols-7 gap-1 text-center text-xs">
                                        <template x-for="i in firstDayIndex">
                                            <div></div>
                                        </template>
                                        <template x-for="day in daysInMonth" :key="day">
                                            <button type="button" @click="selectDate(day)" :class="selectedDay === day ? 'bg-[#505081] text-white font-extrabold shadow-md border border-white/20' : 'bg-[#272757] text-zinc-300 hover:bg-[#505081]/30 border border-[#505081]/20'" class="h-8 rounded-lg flex items-center justify-center transition" x-text="day"></button>
                                        </template>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-[#8686AC] mb-1.5">Purpose / Reason for reservation</label>
                                    <textarea name="purpose" x-model="purposeReason" rows="3" placeholder="e.g., Thesis defense presentation, faculty meeting..." class="w-full bg-[#0F0E47] border border-[#505081]/40 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-[#8686AC]" required></textarea>
                                </div>
                            </div>

                            <div class="pt-6 border-t border-[#505081]/40 flex justify-end">
                                <button type="submit" class="bg-[#505081] hover:bg-[#636399] text-white px-6 py-3 rounded-xl text-xs font-bold transition shadow-lg shadow-[#0F0E47]/50">
                                    Submit Request &rarr;
                                </button>
                            </div>
                        </div>

                        <div class="lg:col-span-4 bg-[#272757]/90 backdrop-blur-xl p-6 sm:p-8 rounded-3xl border border-[#505081]/40 shadow-2xl space-y-6">
                            <span class="text-[10px] font-bold text-[#8686AC] uppercase tracking-wider block">SUMMARY</span>
                            <h4 class="text-base font-extrabold text-white" x-text="resourceType === 'facility' ? selectedFacility : selectedEquipment"></h4>
                            <div class="space-y-2 text-xs text-zinc-300 pt-2 border-t border-[#505081]/30">
                                <p><strong>Date:</strong> <span x-text="selectedDate"></span></p>
                                <p><strong>Time:</strong> 10:00 AM - 12:00 PM</p>
                            </div>
                            <p class="text-[11px] text-[#8686AC]">Your reservation will be saved immediately to the database for custodian approval.</p>
                        </div>
                    </div>
                </form>
            </main>

            <!-- ==================== VIEW 3: AVAILABILITY CALENDAR & CATALOG ==================== -->
            <main x-show="currentView === 'availability-calendar'" class="flex-grow p-6 lg:p-10 space-y-8" style="display: none;">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-[#505081]/40 pb-6">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-[#8686AC] uppercase tracking-widest block">MASTER DIRECTORY</span>
                        <h2 class="text-3xl font-extrabold text-white tracking-tight">Campus Availability Calendar</h2>
                        <p class="text-xs text-[#8686AC]">Real-time inventory stock overview across all rooms and equipment.</p>
                    </div>
                </div>

                <!-- Category Filtering Tabs -->
                <div class="flex space-x-2 border-b border-[#505081]/40 pb-3 overflow-x-auto text-xs font-bold">
                    <button @click="activeTab = 'all'" :class="activeTab === 'all' ? 'bg-[#505081] text-white border border-[#505081]' : 'text-[#8686AC] hover:text-white bg-[#272757] border border-[#505081]/30'" class="px-4 py-2 rounded-xl transition">All Resources</button>
                    <button @click="activeTab = 'rooms'" :class="activeTab === 'rooms' ? 'bg-[#505081] text-white border border-[#505081]' : 'text-[#8686AC] hover:text-white bg-[#272757] border border-[#505081]/30'" class="px-4 py-2 rounded-xl transition">Rooms & Halls</button>
                    <button @click="activeTab = 'labs'" :class="activeTab === 'labs' ? 'bg-[#505081] text-white border border-[#505081]' : 'text-[#8686AC] hover:text-white bg-[#272757] border border-[#505081]/30'" class="px-4 py-2 rounded-xl transition">Laboratories</button>
                    <button @click="activeTab = 'equipment'" :class="activeTab === 'equipment' ? 'bg-[#505081] text-white border border-[#505081]' : 'text-[#8686AC] hover:text-white bg-[#272757] border border-[#505081]/30'" class="px-4 py-2 rounded-xl transition">Technical Equipment</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <template x-for="item in filteredResources" :key="item.id">
                        <div class="bg-[#272757]/90 backdrop-blur-xl rounded-3xl border border-[#505081]/40 hover:border-[#8686AC] transition overflow-hidden shadow-xl flex flex-col justify-between group">
                            <div class="relative h-44 w-full border-b border-[#505081]/40 bg-[#0F0E47]">
                                <img :src="item.image" :alt="item.name" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-85" onerror="this.src='https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=600&q=80'">
                                <div class="absolute top-3 right-3">
                                    <span class="px-2.5 py-1 text-[9px] font-bold rounded-full border shadow-sm backdrop-blur-md" :class="item.statusClass" x-text="item.status"></span>
                                </div>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <span class="text-[10px] font-bold text-[#8686AC] uppercase tracking-widest block" x-text="item.type"></span>
                                    <h3 class="text-base font-bold text-white mt-0.5 group-hover:text-[#8686AC] transition" x-text="item.name"></h3>
                                    <p class="text-xs text-[#8686AC] mt-1" x-text="item.capacity"></p>
                                </div>
                            </div>
                            <div class="p-6 pt-0 space-y-4">
                                <button @click="currentView = 'new-reservation'; bookingStep = 1;" class="w-full py-2.5 bg-[#505081] hover:bg-[#636399] text-white text-xs font-bold rounded-xl transition block text-center shadow-lg">
                                    Book This Resource &rarr;
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </main>

            <!-- ==================== VIEW 4: MY PROFILE & HISTORY ==================== -->
            <main x-show="currentView === 'profile'" class="flex-grow p-6 lg:p-10 space-y-8" style="display: none;">
                <div class="bg-[#272757]/90 backdrop-blur-xl p-6 sm:p-8 rounded-3xl border border-[#505081]/40 shadow-2xl flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="flex items-center space-x-5">
                        <div class="w-16 h-16 rounded-2xl bg-[#0F0E47] flex items-center justify-center font-extrabold border border-[#505081]/50 text-xl text-[#8686AC]">
                            {{ strtoupper(substr(Auth::user()->name ?? 'JD', 0, 2)) }}
                        </div>
                        <div class="space-y-1">
                            <h1 class="text-2xl font-extrabold text-white tracking-tight">{{ Auth::user()->name ?? 'Juan Dela Cruz' }}</h1>
                            <p class="text-xs text-[#8686AC]">{{ Auth::user()->email ?? 'jdelacruz@csu.edu.ph' }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex space-x-6 border-b border-[#505081]/40 text-xs font-bold">
                    <button @click="profileTab = 'overview'" :class="profileTab === 'overview' ? 'text-[#8686AC] border-b-2 border-[#8686AC] pb-3 -mb-px' : 'text-[#8686AC]/60 hover:text-white pb-3'" class="transition">Overview</button>
                    <button @click="profileTab = 'history'" :class="profileTab === 'history' ? 'text-[#8686AC] border-b-2 border-[#8686AC] pb-3 -mb-px' : 'text-[#8686AC]/60 hover:text-white pb-3'" class="transition">Reservation history</button>
                </div>

                <!-- Profile Overview Tab -->
                <div x-show="profileTab === 'overview'" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-6 bg-[#272757] p-6 rounded-3xl border border-[#505081]/40 space-y-4">
                        <h3 class="text-sm font-extrabold text-white">Academic Information</h3>
                        <p class="text-xs text-zinc-300">Name: {{ Auth::user()->name ?? '' }}</p>
                        <p class="text-xs text-zinc-300">Email: {{ Auth::user()->email ?? '' }}</p>
                    </div>
                    <div class="lg:col-span-6 bg-[#272757] p-6 rounded-3xl border border-[#505081]/40 space-y-4">
                        <h3 class="text-sm font-extrabold text-white">Total Requests</h3>
                        <p class="text-3xl font-extrabold text-[#8686AC]" x-text="recentReservations.length"></p>
                    </div>
                </div>

                <!-- Reservation History Tab -->
                <div x-show="profileTab === 'history'" class="space-y-6" style="display: none;">
                    <h3 class="text-lg font-extrabold text-white">Full Reservation History</h3>
                    <div class="bg-[#272757] rounded-3xl border border-[#505081]/40 overflow-hidden shadow-xl">
                        <div class="divide-y divide-[#505081]/30">
                            <template x-for="item in recentReservations" :key="item.id">
                                <div @click="selectedReservation = item; detailsModalOpen = true;" class="p-5 flex items-center justify-between hover:bg-[#0F0E47]/40 transition cursor-pointer">
                                    <div>
                                        <h4 class="text-sm font-bold text-white" x-text="item.resource_name"></h4>
                                        <p class="text-xs text-[#8686AC] mt-0.5" x-text="item.resource_type + ' + ' + item.purpose"></p>
                                    </div>
                                    <div class="flex items-center space-x-6">
                                        <span class="text-xs text-zinc-300 font-medium" x-text="item.start_time"></span>
                                        <span class="px-3 py-1 text-[10px] font-bold rounded-full border" :class="{
                                            'bg-[#505081]/30 text-[#8686AC] border-[#505081]': item.status === 'approved' || item.status === 'returned',
                                            'bg-amber-950/50 text-amber-300 border-amber-800/50': item.status === 'pending',
                                            'bg-rose-950/50 text-rose-300 border-rose-800/50': item.status === 'cancelled'
                                        }" x-text="item.status.toUpperCase()"></span>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- ==================== RESERVATION DETAILS & ACTIONS MODAL ==================== -->
        <div x-show="detailsModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4" style="display: none;">
            <div @click.away="detailsModalOpen = false" class="bg-[#272757] border border-[#505081]/50 w-full max-w-lg rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl relative">
                <div class="flex justify-between items-center border-b border-[#505081]/40 pb-4">
                    <div>
                        <span class="text-[10px] font-bold text-[#8686AC] uppercase tracking-widest">REQUEST DETAILS</span>
                        <h3 class="text-lg font-extrabold text-white mt-0.5" x-text="selectedReservation?.resource_name"></h3>
                    </div>
                    <button @click="detailsModalOpen = false" class="text-zinc-400 hover:text-white font-bold">&times;</button>
                </div>
                <div class="space-y-4 text-xs">
                    <div class="grid grid-cols-2 gap-4 bg-[#0F0E47]/60 p-4 rounded-2xl border border-[#505081]/40">
                        <div>
                            <span class="text-[10px] font-bold text-[#8686AC] uppercase">STATUS</span>
                            <p class="font-bold mt-0.5 uppercase" :class="{
                                'text-[#8686AC]': selectedReservation?.status === 'approved' || selectedReservation?.status === 'returned',
                                'text-amber-300': selectedReservation?.status === 'pending',
                                'text-rose-300': selectedReservation?.status === 'cancelled'
                            }" x-text="selectedReservation?.status"></p>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-[#8686AC] uppercase">TYPE</span>
                            <p class="text-zinc-200 font-semibold mt-0.5 capitalize" x-text="selectedReservation?.resource_type"></p>
                        </div>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-[#8686AC] uppercase">PURPOSE</span>
                        <p class="text-zinc-300 bg-[#0F0E47]/90 p-3 rounded-xl border border-[#505081]/40 mt-0.5" x-text="selectedReservation?.purpose"></p>
                    </div>
                </div>
                <div class="pt-4 border-t border-[#505081]/40 flex items-center justify-between">
                    <button @click="detailsModalOpen = false" class="px-4 py-2 bg-[#0F0E47] hover:bg-[#505081]/40 text-zinc-300 text-xs font-bold rounded-xl transition border border-[#505081]/40">
                        Close
                    </button>
                    <div class="flex items-center space-x-3">
                        <!-- Return Unit Button -->
                        <template x-if="selectedReservation?.status === 'approved' && selectedReservation?.resource_type === 'equipment'">
                            <form :action="'/reservations/' + selectedReservation?.id + '/return'" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-[#505081] hover:bg-[#636399] text-white text-xs font-bold rounded-xl transition shadow-lg">
                                    Return Unit
                                </button>
                            </form>
                        </template>
                        <!-- Cancel Request Button -->
                        <template x-if="selectedReservation?.status === 'pending' || selectedReservation?.status === 'approved'">
                            <form :action="'/reservations/' + selectedReservation?.id + '/cancel'" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-rose-950 text-rose-300 border border-rose-800 hover:bg-rose-900 text-xs font-bold rounded-xl transition">
                                    Cancel Request
                                </button>
                            </form>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine.js Component Script Definition -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('reservationDashboard', () => ({
                activeTab: 'all',
                searchQuery: '',
                currentView: 'overview',
                profileTab: 'overview',
                notificationsOpen: false,
                unreadNotifications: 3,
                bookingStep: 1,
                resourceType: 'facility',
                selectedFacility: 'Audio-Visual Room (AVR 2) Main Building',
                selectedEquipment: 'Epson Multimedia Classroom Projector',
                expectedAttendees: 30,
                equipmentQuantity: 1,
                selectedDate: 'May 27, 2026',
                selectedTimeSlot: '10:00 AM - 12:00 PM',
                purposeReason: '',
                // Dynamic Calendar State
                currentMonth: new Date().getMonth(),
                currentYear: new Date().getFullYear(),
                selectedDay: 27,
                get monthName() {
                    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                    return months[this.currentMonth];
                },
                get daysInMonth() {
                    return new Date(this.currentYear, this.currentMonth + 1, 0).getDate();
                },
                get firstDayIndex() {
                    return new Date(this.currentYear, this.currentMonth, 1).getDay();
                },
                prevMonth() {
                    if (this.currentMonth === 0) {
                        this.currentMonth = 11;
                        this.currentYear--;
                    } else {
                        this.currentMonth--;
                    }
                },
                nextMonth() {
                    if (this.currentMonth === 11) {
                        this.currentMonth = 0;
                        this.currentYear++;
                    } else {
                        this.currentMonth++;
                    }
                },
                selectDate(day) {
                    this.selectedDay = day;
                    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                    this.selectedDate = `${months[this.currentMonth]} ${day}, ${this.currentYear}`;
                },
                detailsModalOpen: false,
                selectedReservation: null,
                recentReservations: @json($reservations),
                notifications: [
                    { id: 1, title: 'Reservation Approved', message: 'Your request for Audio-Visual Room (AVR 2) has been approved.', time: '10m ago' },
                    { id: 2, title: 'Booking Reminder', message: 'Upcoming reservation scheduled for May 27.', time: '1h ago' },
                    { id: 3, title: 'Pending Review', message: 'Your equipment request is currently under review.', time: '3h ago' }
                ],
                resources: [
                    { id: 'f1', name: 'Audio-Visual Room (AVR 2) Main Building', category: 'rooms', type: 'Facility', capacity: 'Air-conditioned room equipped with a wide...', availableSlots: 4, status: 'AVAILABLE', statusClass: 'bg-[#505081]/30 text-[#8686AC] border-[#505081]', schedule: 'Fully open for reservation', image: '/images/Audio-Visual.jpg' },
                    { id: 'f2', name: 'Computer Laboratory 3 (ComLab)', category: 'labs', type: 'Laboratory', capacity: 'Fully air-conditioned computer hub with 4...', availableSlots: 15, status: 'AVAILABLE', statusClass: 'bg-[#505081]/30 text-[#8686AC] border-[#505081]', schedule: 'Open after 03:00 PM', image: '/images/Computer_lab3.jpg' },
                    { id: 'f3', name: 'University Covered Court', category: 'rooms', type: 'Facility', capacity: 'Semi-open multipurpose coliseum style co..', availableSlots: 2, status: 'LIMITED', statusClass: 'bg-amber-950/50 text-amber-300 border-amber-800/50', schedule: 'Reserved: 01:00 PM - 03:00 PM', image: '/images/Covered_court.jpg' },
                    { id: 'f4', name: 'Student Council Conference Room', category: 'rooms', type: 'Facility', capacity: 'Collaborative discussion space furnished...', availableSlots: 0, status: 'UNAVAILABLE', statusClass: 'bg-rose-950/50 text-rose-300 border-rose-800/50', schedule: 'Fully booked today', image: '/images/Student_Council_Conference_Room.jpg' },
                    { id: 'f5', name: 'Speech Laboratory', category: 'labs', type: 'Laboratory', capacity: 'Air-conditioned language and audio trainin...', availableSlots: 8, status: 'AVAILABLE', statusClass: 'bg-[#505081]/30 text-[#8686AC] border-[#505081]', schedule: 'Fully open for reservation', image: '/images/Speech_Laboratory.jpg' },
                    { id: 'f6', name: 'Engineering Physics Laboratory', category: 'labs', type: 'Laboratory', capacity: 'Equipped with heavy-duty workbenches, ...', availableSlots: 10, status: 'AVAILABLE', statusClass: 'bg-[#505081]/30 text-[#8686AC] border-[#505081]', schedule: 'Fully open for reservation', image: '/images/Engineering_Physics_Laboratory.jpg' },
                    { id: 'f7', name: 'HRM / Culinary Kitchen Studio', category: 'rooms', type: 'Facility', capacity: 'Commercial-grade kitchen facility featurin...', availableSlots: 3, status: 'AVAILABLE', statusClass: 'bg-[#505081]/30 text-[#8686AC] border-[#505081]', schedule: '1 unit available', image: '/images/Culinary_Kitchen_Studio.jpg' },
                    { id: 'f8', name: 'Outdoor Student Pavilion / Gazebo', category: 'rooms', type: 'Facility', capacity: 'Shaded open-air study hub with concrete...', availableSlots: 12, status: 'AVAILABLE', statusClass: 'bg-[#505081]/30 text-[#8686AC] border-[#505081]', schedule: 'Fully open for reservation', image: '/images/Outdoor_Student_Pavilion.jpg' },
                    { id: 'e1', name: 'Epson Multimedia Classroom Projector', category: 'equipment', type: 'Equipment', capacity: '10 units stock High-lumen portable LCD', availableSlots: 5, status: 'AVAILABLE', statusClass: 'bg-[#505081]/30 text-[#8686AC] border-[#505081]', schedule: 'Stock available', image: '/images/Epson_Multimedia.jpg' },
                    { id: 'e2', name: 'Sony Mirrorless Vlogging Camera Kit', category: 'equipment', type: 'Equipment', capacity: '5 units stock Digital camera kit', availableSlots: 3, status: 'AVAILABLE', statusClass: 'bg-[#505081]/30 text-[#8686AC] border-[#505081]', schedule: 'Stock available', image: '/images/Sony_Mirrorless_Vlogging_Camera_Kit.jpg' },
                    { id: 'e3', name: 'Wireless Microphone Set (Dual Handheld)', category: 'equipment', type: 'Equipment', capacity: '8 units stock VHF/UHF dual wireless', availableSlots: 4, status: 'AVAILABLE', statusClass: 'bg-[#505081]/30 text-[#8686AC] border-[#505081]', schedule: 'Stock available', image: '/images/Wireless_Microphone_Set.jpg' },
                    { id: 'e4', name: 'Heavy-Duty Extension Cord (5-Meter)', category: 'equipment', type: 'Equipment', capacity: '15 units stock Thick-insulated 5-way', availableSlots: 10, status: 'AVAILABLE', statusClass: 'bg-[#505081]/30 text-[#8686AC] border-[#505081]', schedule: 'Stock available', image: '/images/Heavy_Duty_Extension_Cord.jpg' },
                    { id: 'e5', name: 'Arduino & Raspberry Pi STEM Kit', category: 'equipment', type: 'Equipment', capacity: '12 units stock Complete hardware', availableSlots: 8, status: 'AVAILABLE', statusClass: 'bg-[#505081]/30 text-[#8686AC] border-[#505081]', schedule: 'Stock available', image: '/images/Arduino_Raspberry_Pi_STEM_Kit.jpg' },
                    { id: 'e6', name: 'Portable PA System with Wireless Mic', category: 'equipment', type: 'Equipment', capacity: '6 units stock Rechargeable mobile sound', availableSlots: 2, status: 'AVAILABLE', statusClass: 'bg-[#505081]/30 text-[#8686AC] border-[#505081]', schedule: 'Stock available', image: '/images/Portable_PA_System_with_Wireless_Mic.jpg' },
                    { id: 'e7', name: 'Compound Monocular Microscope Set', category: 'equipment', type: 'Equipment', capacity: '20 units stock High-magnification', availableSlots: 15, status: 'AVAILABLE', statusClass: 'bg-[#505081]/30 text-[#8686AC] border-[#505081]', schedule: 'Stock available', image: '/images/Compound_Monocular_Microscope_Set.jpg' },
                    { id: 'e8', name: 'High-Speed Pocket Wi-Fi / LTE Modem', category: 'equipment', type: 'Equipment', capacity: '10 units stock Portable wireless router', availableSlots: 6, status: 'AVAILABLE', statusClass: 'bg-[#505081]/30 text-[#8686AC] border-[#505081]', schedule: 'Stock available', image: '/images/High_Speed_Pocket_WiFi_LTE_Modem.jpg' },
                    { id: 'e9', name: 'Whiteboard Marker & Eraser Bulk Set', category: 'equipment', type: 'Equipment', capacity: '25 units stock Set of assorted color dry', availableSlots: 20, status: 'AVAILABLE', statusClass: 'bg-[#505081]/30 text-[#8686AC] border-[#505081]', schedule: 'Stock available', image: '/images/Whiteboard_Marker_Eraser_Bulk_Set.jpg' }
                ],
                get filteredResources() {
                    return this.resources.filter(item => {
                        let matchesCategory = (this.activeTab === 'all' || item.category === this.activeTab);
                        let matchesSearch = this.searchQuery === '' || item.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || item.capacity.toLowerCase().includes(this.searchQuery.toLowerCase());
                        return matchesCategory && matchesSearch;
                    });
                }
            }));
        });
    </script>
</x-app-layout>