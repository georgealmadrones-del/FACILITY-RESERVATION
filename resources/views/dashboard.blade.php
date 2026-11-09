<x-app-layout>
    <div x-data="{
        activeTab: 'rooms',
        searchQuery: '',
        showBookingModal: false,
        bookingStep: 1,
        resourceType: 'facility',
        selectedFacility: 'Auditorium Hall',
        selectedEquipment: 'Lighting Kit Pro',
        expectedAttendees: 12,
        equipmentQuantity: 2,
        selectedDate: 'May 27, 2025',
        startTime: '01:00 PM',
        endTime: '03:00 PM',
        purposeReason: '',
        resources: [
            { id: 1, name: 'Multimedia Room 201', category: 'rooms', type: 'Facility', capacity: '30 people · 2nd Floor', availableSlots: 4, status: 'AVAILABLE', icon: 'building' },
            { id: 2, name: 'Auditorium Hall', category: 'rooms', type: 'Facility', capacity: '180 people · Main Bldg.', availableSlots: 2, status: 'AVAILABLE', icon: 'building' },
            { id: 3, name: 'Conference Room A', category: 'rooms', type: 'Facility', capacity: '12 people · Admin Wing', availableSlots: 0, status: 'LIMITED', icon: 'building' },
            { id: 4, name: 'Mac Workstation Lab', category: 'labs', type: 'Laboratory', capacity: '40 seats · 3rd Floor', availableSlots: 15, status: 'AVAILABLE', icon: 'cpu' },
            { id: 5, name: 'CAD Engineering Lab', category: 'labs', type: 'Laboratory', capacity: '24 seats · 3rd Floor', availableSlots: 8, status: 'AVAILABLE', icon: 'cpu' },
            { id: 6, name: 'Lighting Kit Pro', category: 'equipment', type: 'Equipment', capacity: '2 units stock', availableSlots: 3, status: 'AVAILABLE', icon: 'camera' },
            { id: 7, name: 'Sony Cinema Kit A', category: 'equipment', type: 'Equipment', capacity: '1 kit · Tech Locker', availableSlots: 3, status: 'AVAILABLE', icon: 'camera' }
        ],
        recentReservations: [
            { id: 'RES-8921', resource: 'Multimedia Room 201', type: 'Room · 30 capacity', datetime: 'May 24, 2026 | 10:00 AM - 12:00 PM', status: 'APPROVED', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800' },
            { id: 'RES-8922', resource: 'Lighting Kit Pro', type: 'Equipment · 2 units', datetime: 'May 27, 2026 | 08:30 AM - 05:00 PM', status: 'PENDING', statusClass: 'bg-amber-950 text-amber-400 border-amber-800' },
            { id: 'RES-8919', resource: 'CAD Laboratory', type: 'Laboratory · 24 seats', datetime: 'May 18, 2026 | 01:00 PM - 03:00 PM', status: 'CANCELLED', statusClass: 'bg-rose-950 text-rose-400 border-rose-800' }
        ],
        get filteredResources() {
            return this.resources.filter(item => {
                let matchesCategory = (this.activeTab === 'all' || item.category === this.activeTab);
                let matchesSearch = this.searchQuery === '' || item.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || item.capacity.toLowerCase().includes(this.searchQuery.toLowerCase());
                return matchesCategory && matchesSearch;
            });
        }
    }" class="min-h-screen bg-[#09090B] text-zinc-100 font-['Plus_Jakarta_Sans',sans-serif] flex relative overflow-x-hidden">

        <!-- Ambient Emerald Background Glows -->
        <div class="absolute -top-32 -left-32 w-[35rem] h-[35rem] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
        <div class="absolute top-[40%] -right-32 w-[30rem] h-[30rem] bg-emerald-900/10 rounded-full blur-[120px] pointer-events-none"></div>

        <!-- Left Navigation Sidebar -->
        <aside class="w-64 border-r border-[#27272A] bg-[#09090B]/90 backdrop-blur-xl min-h-screen p-6 flex flex-col justify-between hidden md:flex sticky top-0 z-40">
            <div class="space-y-8">
                <!-- Brand Header -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('images/reserva.jpg') }}" alt="RESERVA Logo" class="w-9 h-9 rounded-xl object-cover border border-emerald-500/30 shadow-md shadow-emerald-950/50" onerror="this.src='{{ asset('reserva.jpg') }}';">
                    <div>
                        <span class="font-extrabold text-base tracking-tight text-white block leading-none">RESERVA</span>
                        <span class="text-[9px] font-semibold text-zinc-500 uppercase tracking-widest block mt-1">RESOURCE SYSTEM</span>
                    </div>
                </a>

                <!-- Workspace Menu -->
                <div class="space-y-6">
                    <div>
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest block mb-3">WORKSPACE</span>
                        <nav class="space-y-1">
                            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl bg-zinc-900 text-white border border-zinc-800 text-xs font-bold shadow-sm">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Overview</span>
                            </a>
                            <button @click="showBookingModal = true; bookingStep = 1;" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-zinc-400 hover:text-white hover:bg-zinc-900/60 transition text-xs font-semibold">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                    <span>New reservation</span>
                                </div>
                                <span class="text-[10px] bg-zinc-800 text-zinc-400 px-1.5 py-0.5 rounded font-mono">+</span>
                            </button>
                            <a href="#" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-zinc-400 hover:text-white hover:bg-zinc-900/60 transition text-xs font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Availability Calendar</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-zinc-400 hover:text-white hover:bg-zinc-900/60 transition text-xs font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>My profile</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest block mb-3">MANAGE</span>
                        <nav class="space-y-1">
                            <a href="#" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-zinc-400 hover:text-white hover:bg-zinc-900/60 transition text-xs font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Reservation history</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-zinc-400 hover:text-white hover:bg-zinc-900/60 transition text-xs font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Help & policies</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Profile Sidebar Footer Widget -->
            <div class="pt-6 border-t border-[#27272A] flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-xl bg-zinc-800 border border-zinc-700 flex items-center justify-center font-bold text-xs text-emerald-400">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                    </div>
                    <div class="overflow-hidden">
                        <span class="font-bold text-xs text-white truncate block">{{ Auth::user()->name ?? 'User Name' }}</span>
                        <span class="text-[10px] text-zinc-500 truncate block">{{ Auth::user()->role ?? 'Student' }}</span>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Sign out" class="text-zinc-500 hover:text-rose-400 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Dashboard Viewport -->
        <div class="flex-grow flex flex-col min-h-screen">
            
            <!-- Top App Bar Search & Global Indicators -->
            <header class="h-20 border-b border-[#27272A] bg-[#09090B]/80 backdrop-blur-md px-6 lg:px-10 flex items-center justify-between sticky top-0 z-30">
                <div class="w-full max-w-md relative">
                    <svg class="w-4 h-4 absolute left-3.5 top-3.5 text-zinc-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" x-model="searchQuery" placeholder="Search resources, rooms, equipment..." class="w-full bg-zinc-900/90 border border-zinc-800 rounded-xl pl-10 pr-12 py-2.5 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 transition placeholder-zinc-500">
                    <span class="absolute right-3 top-3 text-[10px] font-mono text-zinc-500 bg-zinc-800/80 px-1.5 py-0.5 rounded border border-zinc-700/50">⌘K</span>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Notification / System Status Bar -->
                    <div class="hidden md:flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-zinc-900 border border-zinc-800 text-xs text-zinc-300 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="font-medium">System operational</span>
                        <span class="text-zinc-600">|</span>
                        <span class="text-emerald-400 font-bold">12 active slots</span>
                    </div>

                    <a href="{{ url('/') }}" target="_blank" class="text-xs text-zinc-300 hover:text-white transition bg-zinc-900 hover:bg-zinc-800 px-3.5 py-2 rounded-xl border border-zinc-800 flex items-center space-x-1.5 shadow-sm">
                        <span>View Portal</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </header>

            <!-- Main Workspace Canvas -->
            <main class="flex-grow p-6 lg:p-10 space-y-10">
                
                <!-- Welcome & Summary Header Block -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-500 uppercase tracking-widest block">{{ strtoupper(date('l, F j')) }}</span>
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                            Good day, {{ explode(' ', Auth::user()->name ?? 'User')[0] }}.
                        </h1>
                        <p class="text-xs text-zinc-400">Here is what is happening with your campus resources today.</p>
                    </div>

                    <button @click="showBookingModal = true; bookingStep = 1;" class="px-6 py-3 bg-emerald-500 hover:bg-emerald-400 text-zinc-950 font-bold text-xs rounded-xl transition shadow-lg shadow-emerald-950/40 flex items-center space-x-2 shrink-0">
                        <span class="text-base font-extrabold leading-none">+</span>
                        <span>New reservation</span>
                    </button>
                </div>

                <!-- User Profile & Quick Metrics Row -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <!-- User Profile Card -->
                    <div class="lg:col-span-5 bg-[#121215]/90 backdrop-blur-xl p-6 rounded-3xl border border-[#27272A] shadow-xl flex items-center justify-between relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl pointer-events-none"></div>
                        
                        <div class="flex items-center space-x-4 relative z-10">
                            <div class="w-14 h-14 rounded-2xl bg-zinc-900 border border-zinc-800 flex items-center justify-center font-extrabold text-lg text-emerald-400 shadow-inner">
                                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                            </div>
                            <div>
                                <div class="flex items-center space-x-2">
                                    <h3 class="text-base font-bold text-white">{{ Auth::user()->name ?? 'User Name' }}</h3>
                                    <span class="px-2 py-0.5 text-[9px] font-bold rounded bg-emerald-950 text-emerald-400 border border-emerald-900 uppercase">ACTIVE</span>
                                </div>
                                <p class="text-xs text-zinc-400 mt-0.5">{{ Auth::user()->role ?? 'Student' }} Account</p>
                                <span class="text-[10px] text-zinc-500 mt-1 block font-mono">ID: {{ Auth::user()->id ?? '1001' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Metric Stats Grid -->
                    <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-[#121215]/90 backdrop-blur-xl p-5 rounded-3xl border border-[#27272A] shadow-xl flex flex-col justify-between">
                            <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block">ACTIVE BOOKINGS</span>
                            <div class="mt-2">
                                <span class="text-3xl font-extrabold text-white">02</span>
                                <span class="text-[10px] text-zinc-400 block mt-0.5">1 upcoming today</span>
                            </div>
                        </div>

                        <div class="bg-[#121215]/90 backdrop-blur-xl p-5 rounded-3xl border border-[#27272A] shadow-xl flex flex-col justify-between">
                            <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block">APPROVAL RATE</span>
                            <div class="mt-2">
                                <span class="text-3xl font-extrabold text-white">96%</span>
                                <span class="text-[10px] text-emerald-400 font-semibold block mt-0.5">Last 12 months</span>
                            </div>
                        </div>

                        <div class="bg-[#121215]/90 backdrop-blur-xl p-5 rounded-3xl border border-[#27272A] shadow-xl flex flex-col justify-between space-y-2">
                            <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block">QUICK ACTIONS</span>
                            <div class="space-y-1.5">
                                <a href="#" class="w-full py-1.5 px-3 bg-zinc-900 hover:bg-zinc-800 text-zinc-200 text-[11px] font-semibold rounded-xl border border-zinc-800 transition block text-center">
                                    View profile
                                </a>
                                <button @click="showBookingModal = true; bookingStep = 1;" class="w-full py-1.5 px-3 bg-zinc-900 hover:bg-zinc-800 text-zinc-200 text-[11px] font-semibold rounded-xl border border-zinc-800 transition block text-center">
                                    Check availability
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Reservations Table Section -->
                <section class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-extrabold text-white">My recent reservations</h3>
                            <p class="text-xs text-zinc-400">Track current requests and recent activity.</p>
                        </div>
                        <a href="#" class="text-xs font-bold text-zinc-400 hover:text-white transition flex items-center space-x-1">
                            <span>View all history</span>
                            <span>&rarr;</span>
                        </a>
                    </div>

                    <div class="bg-[#121215]/90 backdrop-blur-xl rounded-3xl border border-[#27272A] overflow-hidden shadow-xl">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-[#27272A] text-[10px] font-bold text-zinc-500 uppercase tracking-wider bg-zinc-900/40">
                                        <th class="py-4 px-6">RESOURCE</th>
                                        <th class="py-4 px-6">DATE & TIME</th>
                                        <th class="py-4 px-6 text-right">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#27272A] text-xs">
                                    <template x-for="item in recentReservations" :key="item.id">
                                        <tr class="hover:bg-zinc-900/40 transition cursor-pointer">
                                            <td class="py-4 px-6">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-9 h-9 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-300">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                                    </div>
                                                    <div>
                                                        <span class="font-bold text-white block" x-text="item.resource"></span>
                                                        <span class="text-[10px] text-zinc-500" x-text="item.type"></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-zinc-300 font-medium" x-text="item.datetime"></td>
                                            <td class="py-4 px-6 text-right">
                                                <span class="px-3 py-1 text-[10px] font-bold rounded-full border shadow-sm" :class="item.statusClass" x-text="item.status"></span>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Explore Resource Availability Grid Section -->
                <section class="space-y-6 pt-4">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
                        <div>
                            <h3 class="text-lg font-extrabold text-white">Explore availability</h3>
                            <p class="text-xs text-zinc-400 mt-0.5">Live status across campus resources.</p>
                        </div>
                        <span class="text-[10px] font-semibold text-emerald-400 flex items-center space-x-1.5 bg-zinc-900 px-3 py-1.5 rounded-full border border-zinc-800">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>Updated just now</span>
                        </span>
                    </div>

                    <!-- Category Tab Controls -->
                    <div class="flex space-x-2 border-b border-[#27272A] pb-3 overflow-x-auto text-xs font-bold">
                        <button @click="activeTab = 'rooms'" :class="activeTab === 'rooms' ? 'bg-zinc-800 text-white border-zinc-700' : 'text-zinc-400 hover:text-white'" class="px-4 py-2 rounded-xl border border-transparent transition flex items-center space-x-2">
                            <span>Rooms & Halls</span>
                            <span class="px-1.5 py-0.5 text-[9px] rounded bg-zinc-900 text-zinc-400">3</span>
                        </button>
                        <button @click="activeTab = 'labs'" :class="activeTab === 'labs' ? 'bg-zinc-800 text-white border-zinc-700' : 'text-zinc-400 hover:text-white'" class="px-4 py-2 rounded-xl border border-transparent transition flex items-center space-x-2">
                            <span>Computer Laboratories</span>
                            <span class="px-1.5 py-0.5 text-[9px] rounded bg-zinc-900 text-zinc-400">2</span>
                        </button>
                        <button @click="activeTab = 'equipment'" :class="activeTab === 'equipment' ? 'bg-zinc-800 text-white border-zinc-700' : 'text-zinc-400 hover:text-white'" class="px-4 py-2 rounded-xl border border-transparent transition flex items-center space-x-2">
                            <span>Technical Equipment</span>
                            <span class="px-1.5 py-0.5 text-[9px] rounded bg-zinc-900 text-zinc-400">2</span>
                        </button>
                    </div>

                    <!-- Grid Cards Container -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <template x-for="item in filteredResources" :key="item.id">
                            <div class="bg-[#121215]/90 backdrop-blur-xl p-6 rounded-3xl border border-[#27272A] hover:border-emerald-500/50 transition space-y-5 flex flex-col justify-between shadow-xl group">
                                <div class="space-y-4">
                                    <div class="flex justify-between items-start">
                                        <div class="w-11 h-11 rounded-2xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-300 group-hover:scale-105 group-hover:border-emerald-500/40 transition">
                                            <template x-if="item.icon === 'building'">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                            </template>
                                            <template x-if="item.icon === 'cpu'">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                            </template>
                                            <template x-if="item.icon === 'camera'">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            </template>
                                        </div>
                                        <span class="px-2.5 py-1 text-[9px] font-bold rounded-full bg-emerald-950 text-emerald-400 border border-emerald-800" x-text="item.status"></span>
                                    </div>
                                    <div>
                                        <h4 class="text-base font-bold text-white group-hover:text-emerald-400 transition" x-text="item.name"></h4>
                                        <p class="text-xs text-zinc-400 mt-1" x-text="item.capacity"></p>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-[#27272A] flex justify-between items-center text-xs">
                                    <span class="text-zinc-500 font-medium" x-text="item.availableSlots + ' slots available today'"></span>
                                    <button @click="showBookingModal = true; bookingStep = 1;" class="font-bold text-emerald-400 hover:text-emerald-300 transition flex items-center space-x-1">
                                        <span>Reserve</span>
                                        <span class="group-hover:translate-x-1 transition">&rarr;</span>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </section>

            </main>
        </div>

        <!-- FIGMA-INSPIRED MULTI-STEP RESERVATION MODAL -->
        <div x-show="showBookingModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-80 flex items-center justify-center p-4 backdrop-blur-sm" 
             style="display: none;"
             @keydown.escape.window="showBookingModal = false">
            
            <div @click.away="showBookingModal = false" 
                 class="bg-[#121215] rounded-3xl max-w-5xl w-full overflow-hidden shadow-2xl transform transition-all border border-[#27272A] text-zinc-100 flex flex-col lg:flex-row">
                
                <!-- Left Form Section (Steps) -->
                <div class="flex-grow p-6 sm:p-10 space-y-8 border-b lg:border-b-0 lg:border-r border-[#27272A]">
                    
                    <!-- Header & Step Pills -->
                    <div class="flex justify-between items-center border-b border-[#27272A] pb-6">
                        <div>
                            <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-wider block">NEW REQUEST</span>
                            <h3 class="text-2xl font-extrabold text-white mt-0.5">Make a reservation</h3>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold" :class="bookingStep >= 1 ? 'bg-emerald-500 text-zinc-950' : 'bg-zinc-800 text-zinc-400'">1</span>
                            <span class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold" :class="bookingStep >= 2 ? 'bg-emerald-500 text-zinc-950' : 'bg-zinc-800 text-zinc-400'">2</span>
                            <span class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold" :class="bookingStep >= 3 ? 'bg-emerald-500 text-zinc-950' : 'bg-zinc-800 text-zinc-400'">3</span>
                        </div>
                    </div>

                    <!-- STEP 1: What do you need? -->
                    <div x-show="bookingStep === 1" class="space-y-6">
                        <div>
                            <h4 class="text-sm font-extrabold text-white">What do you need?</h4>
                            <p class="text-xs text-zinc-400 mt-0.5">Select resource type and specific item.</p>
                        </div>

                        <!-- Facility / Equipment toggle pills -->
                        <div class="grid grid-cols-2 gap-4">
                            <button type="button" @click="resourceType = 'facility'" :class="resourceType === 'facility' ? 'border-emerald-500 bg-zinc-900/90 shadow-lg shadow-emerald-950/20' : 'border-zinc-800 bg-zinc-900/40'" class="p-4 rounded-2xl border text-left transition flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-xl bg-zinc-800 flex items-center justify-center text-zinc-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    </div>
                                    <span class="text-xs font-bold text-white">Facility</span>
                                </div>
                                <span class="w-4 h-4 rounded-full border border-zinc-600 flex items-center justify-center" :class="resourceType === 'facility' ? 'border-emerald-500 bg-emerald-500' : ''">
                                    <span x-show="resourceType === 'facility'" class="w-1.5 h-1.5 rounded-full bg-zinc-950"></span>
                                </span>
                            </button>

                            <button type="button" @click="resourceType = 'equipment'" :class="resourceType === 'equipment' ? 'border-emerald-500 bg-zinc-900/90 shadow-lg shadow-emerald-950/20' : 'border-zinc-800 bg-zinc-900/40'" class="p-4 rounded-2xl border text-left transition flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-xl bg-zinc-800 flex items-center justify-center text-zinc-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                    <span class="text-xs font-bold text-white">Equipment</span>
                                </div>
                                <span class="w-4 h-4 rounded-full border border-zinc-600 flex items-center justify-center" :class="resourceType === 'equipment' ? 'border-emerald-500 bg-emerald-500' : ''">
                                    <span x-show="resourceType === 'equipment'" class="w-1.5 h-1.5 rounded-full bg-zinc-950"></span>
                                </span>
                            </button>
                        </div>

                        <!-- Select Facility or Equipment Dropdown & Quantity / Attendees -->
                        <div class="space-y-4">
                            <template x-if="resourceType === 'facility'">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Select facility</label>
                                        <select x-model="selectedFacility" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 transition">
                                            <option value="Auditorium Hall">Auditorium Hall (180 people)</option>
                                            <option value="Multimedia Room 201">Multimedia Room 201 (30 people)</option>
                                            <option value="Conference Room A">Conference Room A (12 people)</option>
                                            <option value="Mac Workstation Lab">Mac Workstation Lab (40 seats)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Expected attendees</label>
                                        <div class="flex items-center space-x-3 bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-2.5">
                                            <input type="number" x-model="expectedAttendees" min="1" max="180" class="w-full bg-transparent text-xs text-white focus:outline-none">
                                            <div class="flex items-center space-x-1">
                                                <button type="button" @click="if(expectedAttendees > 1) expectedAttendees--" class="w-7 h-7 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-white font-bold flex items-center justify-center">-</button>
                                                <button type="button" @click="expectedAttendees++" class="w-7 h-7 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-white font-bold flex items-center justify-center">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <template x-if="resourceType === 'equipment'">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Select equipment</label>
                                        <select x-model="selectedEquipment" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 transition">
                                            <option value="Lighting Kit Pro">Lighting Kit Pro (2 units stock)</option>
                                            <option value="Sony Cinema Kit A">Sony Cinema Kit A (1 kit)</option>
                                            <option value="Epson Multimedia Projector">Epson Multimedia Projector (5 units stock)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Quantity needed</label>
                                        <div class="flex items-center space-x-3 bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-2.5">
                                            <input type="number" x-model="equipmentQuantity" min="1" max="5" class="w-full bg-transparent text-xs text-white focus:outline-none">
                                            <div class="flex items-center space-x-1">
                                                <button type="button" @click="if(equipmentQuantity > 1) equipmentQuantity--" class="w-7 h-7 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-white font-bold flex items-center justify-center">-</button>
                                                <button type="button" @click="equipmentQuantity++" class="w-7 h-7 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-white font-bold flex items-center justify-center">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Reason / Purpose Bar -->
                        <div>
                            <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Purpose / Reason for reservation</label>
                            <textarea x-model="purposeReason" rows="2" placeholder="e.g., Thesis defense presentation, faculty meeting, video project..." class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 transition placeholder-zinc-600" required></textarea>
                        </div>
                    </div>

                    <!-- STEP 2: When do you need it? (Custom Start & End Time) -->
                    <div x-show="bookingStep === 2" class="space-y-6" style="display: none;">
                        <div>
                            <h4 class="text-sm font-extrabold text-white">When do you need it?</h4>
                            <p class="text-xs text-zinc-400 mt-0.5">Choose your date and exact start/end times.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Reservation date</label>
                                <input type="date" x-model="selectedDate" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Start time</label>
                                <select x-model="startTime" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 transition">
                                    <option value="08:00 AM">08:00 AM</option>
                                    <option value="10:00 AM">10:00 AM</option>
                                    <option value="01:00 PM">01:00 PM</option>
                                    <option value="03:00 PM">03:00 PM</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Finish time</label>
                                <select x-model="endTime" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 transition">
                                    <option value="10:00 AM">10:00 AM</option>
                                    <option value="12:00 PM">12:00 PM</option>
                                    <option value="03:00 PM">03:00 PM</option>
                                    <option value="05:00 PM">05:00 PM</option>
                                </select>
                            </div>
                        </div>

                        <div class="p-4 bg-zinc-900/60 rounded-2xl border border-zinc-800 flex items-center justify-between">
                            <div class="flex items-center space-x-2 text-xs text-emerald-400">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span class="font-bold">Slot is fully available for selected time</span>
                            </div>
                            <span class="text-[10px] text-zinc-500 font-mono">Instant approval</span>
                        </div>
                    </div>

                    <!-- STEP 3: Review & Submit -->
                    <div x-show="bookingStep === 3" class="space-y-6" style="display: none;">
                        <div class="text-center space-y-3 py-6">
                            <div class="w-12 h-12 rounded-full bg-emerald-500/20 border border-emerald-500/40 text-emerald-400 flex items-center justify-center mx-auto">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-wider block">REQUEST READY</span>
                                <h4 class="text-xl font-extrabold text-white mt-1">Everything looks good.</h4>
                                <p class="text-xs text-zinc-400 mt-1 max-w-sm mx-auto">Your reservation request is ready to submit. You will receive an update after custodian review.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer Navigation Buttons -->
                    <div class="pt-4 border-t border-[#27272A] flex justify-between items-center">
                        <button type="button" @click="if(bookingStep > 1) bookingStep--; else showBookingModal = false;" class="bg-zinc-800 hover:bg-zinc-700 text-zinc-300 px-5 py-2.5 rounded-xl text-xs font-bold transition">
                            <span x-text="bookingStep === 1 ? 'Cancel' : 'Back'"></span>
                        </button>
                        
                        <template x-if="bookingStep < 3">
                            <button type="button" @click="bookingStep++" class="bg-emerald-500 hover:bg-emerald-400 text-zinc-950 px-6 py-2.5 rounded-xl text-xs font-bold transition shadow-lg shadow-emerald-950/40">
                                Next step &rarr;
                            </button>
                        </template>
                        <template x-if="bookingStep === 3">
                            <button type="button" @click="alert('Reservation submitted successfully!'); showBookingModal = false; bookingStep = 1;" class="bg-emerald-500 hover:bg-emerald-400 text-zinc-950 px-6 py-2.5 rounded-xl text-xs font-bold transition shadow-lg shadow-emerald-950/40">
                                Submit request &rarr;
                            </button>
                        </template>
                    </div>

                </div>

                <!-- Right Sidebar Summary Column (Figma Style) -->
                <div class="w-full lg:w-80 bg-zinc-950/60 p-6 sm:p-8 flex flex-col justify-between space-y-6">
                    <div class="space-y-6">
                        <div>
                            <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block">RESERVATION SUMMARY</span>
                            <h4 class="text-sm font-extrabold text-white mt-1" x-text="resourceType === 'facility' ? selectedFacility : selectedEquipment"></h4>
                        </div>

                        <div class="space-y-4 text-xs pt-4 border-t border-zinc-800/80">
                            <div class="flex justify-between">
                                <span class="text-zinc-500">Type</span>
                                <span class="font-bold text-zinc-200 capitalize" x-text="resourceType"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-zinc-500">Date</span>
                                <span class="font-bold text-zinc-200" x-text="selectedDate"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-zinc-500">Time</span>
                                <span class="font-bold text-emerald-400" x-text="startTime + ' - ' + endTime"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-zinc-500" x-text="resourceType === 'facility' ? 'Attendees' : 'Quantity'"></span>
                                <span class="font-bold text-zinc-200" x-text="resourceType === 'facility' ? expectedAttendees + ' persons' : equipmentQuantity + ' units'"></span>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-zinc-900 border border-zinc-800 space-y-2">
                        <div class="flex items-center space-x-2 text-[11px] font-bold text-emerald-400">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>SLOT AVAILABLE</span>
                        </div>
                        <p class="text-[10px] text-zinc-400 leading-relaxed">This resource is available for your selected date and time.</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>