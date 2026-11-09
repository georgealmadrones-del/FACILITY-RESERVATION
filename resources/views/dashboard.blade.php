<x-app-layout>
    <div x-data="{
        activeTab: 'all',
        searchQuery: '',
        currentView: 'overview',
        bookingStep: 1,
        resourceType: 'facility',
        selectedFacility: 'Audio-Visual Room (AVR 2) - Main Building',
        selectedEquipment: 'Epson Multimedia Classroom Projector',
        expectedAttendees: 30,
        equipmentQuantity: 1,
        selectedDate: 'May 27, 2026',
        selectedTimeSlot: '10:00 AM - 12:00 PM',
        purposeReason: '',
        resources: [
            { id: 'f1', name: 'Audio-Visual Room (AVR 2) - Main Building', category: 'rooms', type: 'Facility', capacity: 'Air-conditioned room equipped with a wide...', availableSlots: 4, status: 'AVAILABLE', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800', schedule: 'Fully open for reservation', image: '/images/Audio-Visual.jpg' },
            { id: 'f2', name: 'Computer Laboratory 3 (ComLab)', category: 'labs', type: 'Laboratory', capacity: 'Fully air-conditioned computer hub with 4...', availableSlots: 15, status: 'AVAILABLE', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800', schedule: 'Open after 03:00 PM', image: '/images/Computer_lab3.jpg' },
            { id: 'f3', name: 'University Covered Court', category: 'rooms', type: 'Facility', capacity: 'Semi-open multipurpose coliseum style co...', availableSlots: 2, status: 'LIMITED', statusClass: 'bg-amber-950 text-amber-400 border-amber-800', schedule: 'Reserved: 01:00 PM - 03:00 PM', image: '/images/Covered_court.jpg' },
            { id: 'f4', name: 'Student Council Conference Room', category: 'rooms', type: 'Facility', capacity: 'Collaborative discussion space furnished ...', availableSlots: 0, status: 'UNAVAILABLE', statusClass: 'bg-rose-950 text-rose-400 border-rose-800', schedule: 'Fully booked today', image: '/images/Student_Council_Conference_Room.jpg' },
            { id: 'f5', name: 'Speech Laboratory', category: 'labs', type: 'Laboratory', capacity: 'Air-conditioned language and audio trainin...', availableSlots: 8, status: 'AVAILABLE', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800', schedule: 'Fully open for reservation', image: '/images/Speech_Laboratory.jpg' },
            { id: 'f6', name: 'Engineering Physics Laboratory', category: 'labs', type: 'Laboratory', capacity: 'Equipped with heavy-duty workbenches, ...', availableSlots: 10, status: 'AVAILABLE', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800', schedule: 'Fully open for reservation', image: '/images/Engineering_Physics_Laboratory.jpg' },
            { id: 'f7', name: 'HRM / Culinary Kitchen Studio', category: 'rooms', type: 'Facility', capacity: 'Commercial-grade kitchen facility featurin...', availableSlots: 3, status: 'AVAILABLE', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800', schedule: '1 unit available', image: '/images/Culinary_Kitchen_Studio.jpg' },
            { id: 'f8', name: 'Outdoor Student Pavilion / Gazebo', category: 'rooms', type: 'Facility', capacity: 'Shaded open-air study hub with concrete...', availableSlots: 12, status: 'AVAILABLE', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800', schedule: 'Fully open for reservation', image: '/images/Outdoor_Student_Pavilion.jpg' },
            
            { id: 'e1', name: 'Epson Multimedia Classroom Projector', category: 'equipment', type: 'Equipment', capacity: '10 units stock · High-lumen portable LCD', availableSlots: 5, status: 'AVAILABLE', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800', schedule: 'Stock available', image: '/images/Epson_Multimedia.jpg' },
            { id: 'e2', name: 'Sony Mirrorless Vlogging Camera Kit', category: 'equipment', type: 'Equipment', capacity: '5 units stock · Digital camera kit', availableSlots: 3, status: 'AVAILABLE', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800', schedule: 'Stock available', image: '/images/Sony_Mirrorless_Vlogging_Camera_Kit.jpg' },
            { id: 'e3', name: 'Wireless Microphone Set (Dual Handheld)', category: 'equipment', type: 'Equipment', capacity: '8 units stock · VHF/UHF dual wireless', availableSlots: 4, status: 'AVAILABLE', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800', schedule: 'Stock available', image: '/images/Wireless_Microphone_Set.jpg' },
            { id: 'e4', name: 'Heavy-Duty Extension Cord (5-Meter)', category: 'equipment', type: 'Equipment', capacity: '15 units stock · Thick-insulated 5-way', availableSlots: 10, status: 'AVAILABLE', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800', schedule: 'Stock available', image: '/images/Heavy_Duty_Extension_Cord.jpg' },
            { id: 'e5', name: 'Arduino & Raspberry Pi STEM Kit', category: 'equipment', type: 'Equipment', capacity: '12 units stock · Complete hardware', availableSlots: 8, status: 'AVAILABLE', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800', schedule: 'Stock available', image: '/images/Arduino_Raspberry_Pi_STEM_Kit.jpg' },
            { id: 'e6', name: 'Portable PA System with Wireless Mic', category: 'equipment', type: 'Equipment', capacity: '6 units stock · Rechargeable mobile sound', availableSlots: 2, status: 'AVAILABLE', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800', schedule: 'Stock available', image: '/images/Portable_PA_System_with_Wireless_Mic.jpg' },
            { id: 'e7', name: 'Compound Monocular Microscope Set', category: 'equipment', type: 'Equipment', capacity: '20 units stock · High-magnification', availableSlots: 15, status: 'AVAILABLE', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800', schedule: 'Stock available', image: '/images/Compound_Monocular_Microscope_Set.jpg' },
            { id: 'e8', name: 'High-Speed Pocket Wi-Fi / LTE Modem', category: 'equipment', type: 'Equipment', capacity: '10 units stock · Portable wireless router', availableSlots: 6, status: 'AVAILABLE', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800', schedule: 'Stock available', image: '/images/High_Speed_Pocket_WiFi_LTE_Modem.jpg' },
            { id: 'e9', name: 'Whiteboard Marker & Eraser Bulk Set', category: 'equipment', type: 'Equipment', capacity: '25 units stock · Set of assorted color dry', availableSlots: 20, status: 'AVAILABLE', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800', schedule: 'Stock available', image: '/images/Whiteboard_Marker_Eraser_Bulk_Set.jpg' }
        ],
        recentReservations: [
            { id: 'RES-8921', resource: 'Audio-Visual Room (AVR 2)', type: 'Facility · Main Bldg', datetime: 'May 24, 2026 | 10:00 AM - 12:00 PM', status: 'APPROVED', statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800' },
            { id: 'RES-8922', resource: 'Sony Mirrorless Vlogging Camera Kit', type: 'Equipment · 1 kit', datetime: 'May 27, 2026 | 08:30 AM - 05:00 PM', status: 'PENDING', statusClass: 'bg-amber-950 text-amber-400 border-amber-800' },
            { id: 'RES-8919', resource: 'Computer Laboratory 3', type: 'Laboratory · ComLab', datetime: 'May 18, 2026 | 01:00 PM - 03:00 PM', status: 'CANCELLED', statusClass: 'bg-rose-950 text-rose-400 border-rose-800' }
        ],
        get filteredResources() {
            return this.resources.filter(item => {
                let matchesCategory = (this.activeTab === 'all' || item.category === this.activeTab);
                let matchesSearch = this.searchQuery === '' || item.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || item.capacity.toLowerCase().includes(this.searchQuery.toLowerCase());
                return matchesCategory && matchesSearch;
            });
        }
    }" class="min-h-screen bg-[#09090B] text-zinc-100 font-['Plus_Jakarta_Sans',sans-serif] flex relative overflow-x-hidden">

        <!-- Ambient Background Glows -->
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
                            <button @click="currentView = 'overview'" :class="currentView === 'overview' ? 'bg-zinc-900 text-white border-zinc-800' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/60 border-transparent'" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Overview</span>
                            </button>
                            <button @click="currentView = 'new-reservation'; bookingStep = 1;" :class="currentView === 'new-reservation' ? 'bg-zinc-900 text-white border-zinc-800' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/60 border-transparent'" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl border transition text-xs font-semibold">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                    <span>New reservation</span>
                                </div>
                                <span class="text-[10px] bg-zinc-800 text-emerald-400 px-1.5 py-0.5 rounded font-mono">+</span>
                            </button>
                            <button @click="currentView = 'availability-calendar'" :class="currentView === 'availability-calendar' ? 'bg-zinc-900 text-white border-zinc-800' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/60 border-transparent'" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border transition text-xs font-semibold">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Availability Calendar</span>
                            </button>
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
                    <input type="text" x-model="searchQuery" placeholder="Search rooms, labs, or equipment..." class="w-full bg-zinc-900/90 border border-zinc-800 rounded-xl pl-10 pr-12 py-2.5 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 transition placeholder-zinc-500">
                    <span class="absolute right-3 top-3 text-[10px] font-mono text-zinc-500 bg-zinc-800/80 px-1.5 py-0.5 rounded border border-zinc-700/50">⌘K</span>
                </div>

                <div class="flex items-center space-x-4">
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

            <!-- ==================== VIEW 1: OVERVIEW DASHBOARD ==================== -->
            <main x-show="currentView === 'overview'" class="flex-grow p-6 lg:p-10 space-y-10">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-500 uppercase tracking-widest block">{{ strtoupper(date('l, F j')) }}</span>
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                            Good day, {{ explode(' ', Auth::user()->name ?? 'User')[0] }}.
                        </h1>
                        <p class="text-xs text-zinc-400">Here is what is happening with your campus resources today.</p>
                    </div>

                    <button @click="currentView = 'new-reservation'; bookingStep = 1;" class="px-6 py-3 bg-emerald-500 hover:bg-emerald-400 text-zinc-950 font-bold text-xs rounded-xl transition shadow-lg shadow-emerald-950/40 flex items-center space-x-2 shrink-0">
                        <span class="text-base font-extrabold leading-none">+</span>
                        <span>New reservation</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
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
                                <button @click="currentView = 'availability-calendar'" class="w-full py-1.5 px-3 bg-zinc-900 hover:bg-zinc-800 text-zinc-200 text-[11px] font-semibold rounded-xl border border-zinc-800 transition block text-center">
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
            </main>


            <!-- ==================== VIEW 2: NEW RESERVATION WORKSPACE ==================== -->
            <main x-show="currentView === 'new-reservation'" class="flex-grow p-6 lg:p-10 space-y-8" style="display: none;">
                
                <div class="flex items-center justify-between border-b border-[#27272A] pb-6">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-wider block">NEW REQUEST</span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Make a reservation</h2>
                        <p class="text-xs text-zinc-400">Choose a resource and find a time that works for you.</p>
                    </div>

                    <!-- Step Indicator Pills -->
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center space-x-2">
                            <span class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-extrabold shadow-md transition" :class="bookingStep >= 1 ? 'bg-emerald-500 text-zinc-950 shadow-emerald-950/50' : 'bg-zinc-800 text-zinc-400'">1</span>
                            <span class="text-xs font-semibold text-zinc-400 hidden sm:inline">What</span>
                        </div>
                        <div class="w-8 h-0.5 bg-zinc-800"></div>
                        <div class="flex items-center space-x-2">
                            <span class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-extrabold shadow-md transition" :class="bookingStep >= 2 ? 'bg-emerald-500 text-zinc-950 shadow-emerald-950/50' : 'bg-zinc-800 text-zinc-400'">2</span>
                            <span class="text-xs font-semibold text-zinc-400 hidden sm:inline">When</span>
                        </div>
                        <div class="w-8 h-0.5 bg-zinc-800"></div>
                        <div class="flex items-center space-x-2">
                            <span class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-extrabold shadow-md transition" :class="bookingStep >= 3 ? 'bg-emerald-500 text-zinc-950 shadow-emerald-950/50' : 'bg-zinc-800 text-zinc-400'">3</span>
                            <span class="text-xs font-semibold text-zinc-400 hidden sm:inline">Review</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left Form Section -->
                    <div class="lg:col-span-8 bg-[#121215]/90 backdrop-blur-xl p-6 sm:p-8 rounded-3xl border border-[#27272A] shadow-2xl space-y-8">
                        
                        <!-- STEP 1: What do you need? -->
                        <div x-show="bookingStep === 1" class="space-y-6">
                            <div>
                                <h3 class="text-base font-extrabold text-white">What do you need?</h3>
                                <p class="text-xs text-zinc-400 mt-0.5">Select resource type and specific item.</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <button type="button" @click="resourceType = 'facility'" :class="resourceType === 'facility' ? 'border-emerald-500 bg-zinc-900 shadow-lg shadow-emerald-950/30 ring-1 ring-emerald-500/50' : 'border-zinc-800 bg-zinc-900/40'" class="p-4 rounded-2xl border text-left transition flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-xl bg-zinc-800 flex items-center justify-center text-zinc-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        </div>
                                        <span class="text-xs font-bold text-white">Facility</span>
                                    </div>
                                    <span class="w-4 h-4 rounded-full border border-zinc-600 flex items-center justify-center" :class="resourceType === 'facility' ? 'border-emerald-500 bg-emerald-500' : ''">
                                        <span x-show="resourceType === 'facility'" class="w-1.5 h-1.5 rounded-full bg-zinc-950"></span>
                                    </span>
                                </button>

                                <button type="button" @click="resourceType = 'equipment'" :class="resourceType === 'equipment' ? 'border-emerald-500 bg-zinc-900 shadow-lg shadow-emerald-950/30 ring-1 ring-emerald-500/50' : 'border-zinc-800 bg-zinc-900/40'" class="p-4 rounded-2xl border text-left transition flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-xl bg-zinc-800 flex items-center justify-center text-zinc-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </div>
                                        <span class="text-xs font-bold text-white">Equipment</span>
                                    </div>
                                    <span class="w-4 h-4 rounded-full border border-zinc-600 flex items-center justify-center" :class="resourceType === 'equipment' ? 'border-emerald-500 bg-emerald-500' : ''">
                                        <span x-show="resourceType === 'equipment'" class="w-1.5 h-1.5 rounded-full bg-zinc-950"></span>
                                    </span>
                                </button>
                            </div>

                            <div class="space-y-4">
                                <template x-if="resourceType === 'facility'">
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Select facility</label>
                                            <select x-model="selectedFacility" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 transition">
                                                <option value="Audio-Visual Room (AVR 2) - Main Building">Audio-Visual Room (AVR 2) - Main Building</option>
                                                <option value="Computer Laboratory 3 (ComLab)">Computer Laboratory 3 (ComLab)</option>
                                                <option value="University Covered Court">University Covered Court</option>
                                                <option value="Student Council Conference Room">Student Council Conference Room</option>
                                                <option value="Speech Laboratory">Speech Laboratory</option>
                                                <option value="Engineering Physics Laboratory">Engineering Physics Laboratory</option>
                                                <option value="HRM / Culinary Kitchen Studio">HRM / Culinary Kitchen Studio</option>
                                                <option value="Outdoor Student Pavilion / Gazebo">Outdoor Student Pavilion / Gazebo</option>
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
                                                <option value="Epson Multimedia Classroom Projector">Epson Multimedia Classroom Projector (10 stock)</option>
                                                <option value="Sony Mirrorless Vlogging Camera Kit">Sony Mirrorless Vlogging Camera Kit (5 stock)</option>
                                                <option value="Wireless Microphone Set (Dual Handheld)">Wireless Microphone Set (Dual Handheld) (8 stock)</option>
                                                <option value="Heavy-Duty Extension Cord (5-Meter)">Heavy-Duty Extension Cord (5-Meter) (15 stock)</option>
                                                <option value="Arduino & Raspberry Pi STEM Kit">Arduino & Raspberry Pi STEM Kit (12 stock)</option>
                                                <option value="Portable PA System with Wireless Mic">Portable PA System with Wireless Mic (6 stock)</option>
                                                <option value="Compound Monocular Microscope Set">Compound Monocular Microscope Set (20 stock)</option>
                                                <option value="High-Speed Pocket Wi-Fi / LTE Modem">High-Speed Pocket Wi-Fi / LTE Modem (10 stock)</option>
                                                <option value="Whiteboard Marker & Eraser Bulk Set">Whiteboard Marker & Eraser Bulk Set (25 stock)</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Quantity needed</label>
                                            <div class="flex items-center space-x-3 bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-2.5">
                                                <input type="number" x-model="equipmentQuantity" min="1" max="10" class="w-full bg-transparent text-xs text-white focus:outline-none">
                                                <div class="flex items-center space-x-1">
                                                    <button type="button" @click="if(equipmentQuantity > 1) equipmentQuantity--" class="w-7 h-7 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-white font-bold flex items-center justify-center">-</button>
                                                    <button type="button" @click="equipmentQuantity++" class="w-7 h-7 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-white font-bold flex items-center justify-center">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Purpose / Reason for reservation</label>
                                <textarea x-model="purposeReason" rows="3" placeholder="e.g., Thesis defense presentation, faculty meeting, video project..." class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 transition placeholder-zinc-600" required></textarea>
                            </div>
                        </div>

                        <!-- STEP 2: When do you need it? (Visual Calendar & Time Slots) -->
                        <div x-show="bookingStep === 2" class="space-y-6" style="display: none;">
                            <div>
                                <h3 class="text-base font-extrabold text-white">When do you need it?</h3>
                                <p class="text-xs text-zinc-400 mt-0.5">Choose an available date and start time.</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                                <!-- Visual Calendar Box -->
                                <div class="md:col-span-7 bg-zinc-900/90 border border-zinc-800 rounded-2xl p-5 space-y-4">
                                    <div class="flex justify-between items-center">
                                        <button type="button" class="text-zinc-400 hover:text-white">&larr;</button>
                                        <span class="text-xs font-extrabold text-white">May 2026</span>
                                        <button type="button" class="text-zinc-400 hover:text-white">&rarr;</button>
                                    </div>

                                    <div class="grid grid-cols-7 text-center text-[10px] font-bold text-zinc-500">
                                        <span>Su</span><span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span>
                                    </div>

                                    <div class="grid grid-cols-7 gap-2 text-center text-xs font-semibold">
                                        <template x-for="day in 31">
                                            <button type="button" 
                                                @click="selectedDate = 'May ' + day + ', 2026'"
                                                class="py-2 rounded-xl transition flex flex-col items-center justify-center"
                                                :class="selectedDate === ('May ' + day + ', 2026') ? 'bg-emerald-500 text-zinc-950 font-extrabold shadow-lg shadow-emerald-950/50' : 'text-zinc-300 hover:bg-zinc-800'">
                                                <span x-text="day"></span>
                                                <span class="w-1 h-1 rounded-full mt-1" :class="day === 27 ? 'bg-emerald-400' : (day % 3 === 0 ? 'bg-amber-400' : 'bg-zinc-600')"></span>
                                            </button>
                                        </template>
                                    </div>

                                    <div class="flex items-center justify-center space-x-6 pt-3 border-t border-zinc-800 text-[10px] text-zinc-400">
                                        <div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-emerald-400"></span><span>Available</span></div>
                                        <div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-amber-400"></span><span>Limited</span></div>
                                        <div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-zinc-600"></span><span>Unavailable</span></div>
                                    </div>
                                </div>

                                <!-- Time Slots Picker Box -->
                                <div class="md:col-span-5 bg-zinc-900/90 border border-zinc-800 rounded-2xl p-5 space-y-3">
                                    <div class="flex items-center space-x-2 text-xs font-bold text-zinc-400 pb-2 border-b border-zinc-800">
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span x-text="selectedDate"></span>
                                    </div>

                                    <div class="space-y-2">
                                        <template x-for="slot in ['08:00 AM - 10:00 AM', '10:00 AM - 12:00 PM', '01:00 PM - 03:00 PM', '03:00 PM - 05:00 PM']">
                                            <button type="button" 
                                                @click="selectedTimeSlot = slot"
                                                class="w-full p-3 rounded-xl border text-left transition flex items-center justify-between text-xs font-semibold"
                                                :class="selectedTimeSlot === slot ? 'border-emerald-500 bg-emerald-500/10 text-white' : 'border-zinc-800 bg-zinc-950/50 text-zinc-400 hover:border-zinc-700'">
                                                <span x-text="slot"></span>
                                                <span class="text-[10px] font-bold" :class="selectedTimeSlot === slot ? 'text-emerald-400' : 'text-zinc-500'" x-text="selectedTimeSlot === slot ? 'Selected' : 'Available'"></span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- STEP 3: Review & Submit -->
                        <div x-show="bookingStep === 3" class="space-y-6 text-center py-8" style="display: none;">
                            <div class="w-14 h-14 rounded-full bg-emerald-500/20 border border-emerald-500/40 text-emerald-400 flex items-center justify-center mx-auto">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div class="space-y-2 max-w-md mx-auto">
                                <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-wider block">REQUEST READY</span>
                                <h3 class="text-xl font-extrabold text-white">Everything looks good.</h3>
                                <p class="text-xs text-zinc-400 leading-relaxed">Your reservation request is ready to submit. You will receive an update after custodian review.</p>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="pt-6 border-t border-[#27272A] flex justify-between items-center">
                            <button type="button" @click="if(bookingStep > 1) bookingStep--; else currentView = 'overview';" class="bg-zinc-800 hover:bg-zinc-700 text-zinc-300 px-5 py-2.5 rounded-xl text-xs font-bold transition">
                                <span x-text="bookingStep === 1 ? 'Cancel' : 'Back'"></span>
                            </button>
                            
                            <template x-if="bookingStep < 3">
                                <button type="button" @click="bookingStep++" class="bg-emerald-500 hover:bg-emerald-400 text-zinc-950 px-6 py-2.5 rounded-xl text-xs font-bold transition shadow-lg shadow-emerald-950/40">
                                    Next step &rarr;
                                </button>
                            </template>
                            <template x-if="bookingStep === 3">
                                <button type="button" @click="alert('Reservation submitted successfully!'); currentView = 'overview'; bookingStep = 1;" class="bg-emerald-500 hover:bg-emerald-400 text-zinc-950 px-6 py-2.5 rounded-xl text-xs font-bold transition shadow-lg shadow-emerald-950/40">
                                    Submit request &rarr;
                                </button>
                            </template>
                        </div>

                    </div>

                    <!-- Right Sidebar Reservation Summary -->
                    <div class="lg:col-span-4 bg-[#121215]/90 backdrop-blur-xl p-6 sm:p-8 rounded-3xl border border-[#27272A] shadow-2xl space-y-6">
                        <div class="space-y-6">
                            <div>
                                <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block">RESERVATION SUMMARY</span>
                                <h4 class="text-base font-extrabold text-white mt-1" x-text="resourceType === 'facility' ? selectedFacility : selectedEquipment"></h4>
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
                                    <span class="font-bold text-emerald-400" x-text="selectedTimeSlot"></span>
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

            </main>


            <!-- ==================== VIEW 3: AVAILABILITY CALENDAR & CATALOG DIRECTORY ==================== -->
            <main x-show="currentView === 'availability-calendar'" class="flex-grow p-6 lg:p-10 space-y-8" style="display: none;">
                
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-[#27272A] pb-6">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest block">MASTER DIRECTORY</span>
                        <h2 class="text-3xl font-extrabold text-white tracking-tight">Campus Availability Calendar</h2>
                        <p class="text-xs text-zinc-400">Real-time scheduling and status overview across all rooms, labs, and equipment.</p>
                    </div>

                    <div class="bg-zinc-900 border border-zinc-800 px-4 py-2 rounded-xl text-xs font-bold text-zinc-300 flex items-center space-x-2">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>May 2026</span>
                    </div>
                </div>

                <!-- Category Filtering Tabs -->
                <div class="flex space-x-2 border-b border-[#27272A] pb-3 overflow-x-auto text-xs font-bold">
                    <button @click="activeTab = 'all'" :class="activeTab === 'all' ? 'bg-zinc-800 text-white border-zinc-700' : 'text-zinc-400 hover:text-white'" class="px-4 py-2 rounded-xl border border-transparent transition">
                        All Resources
                    </button>
                    <button @click="activeTab = 'rooms'" :class="activeTab === 'rooms' ? 'bg-zinc-800 text-white border-zinc-700' : 'text-zinc-400 hover:text-white'" class="px-4 py-2 rounded-xl border border-transparent transition">
                        Rooms & Halls
                    </button>
                    <button @click="activeTab = 'labs'" :class="activeTab === 'labs' ? 'bg-zinc-800 text-white border-zinc-700' : 'text-zinc-400 hover:text-white'" class="px-4 py-2 rounded-xl border border-transparent transition">
                        Computer Laboratories
                    </button>
                    <button @click="activeTab = 'equipment'" :class="activeTab === 'equipment' ? 'bg-zinc-800 text-white border-zinc-700' : 'text-zinc-400 hover:text-white'" class="px-4 py-2 rounded-xl border border-transparent transition">
                        Technical Equipment
                    </button>
                </div>

                <!-- Availability Catalog Grid with Database Photos -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <template x-for="item in filteredResources" :key="item.id">
                        <div class="bg-[#121215]/90 backdrop-blur-xl rounded-3xl border border-[#27272A] hover:border-emerald-500/50 transition overflow-hidden shadow-xl flex flex-col justify-between group">
                            
                            <!-- Image Header Preview -->
                            <div class="relative h-44 w-full overflow-hidden bg-zinc-900 border-b border-[#27272A]">
                                <img :src="item.image" :alt="item.name" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-85">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#121215] via-transparent to-transparent"></div>
                                <div class="absolute top-3 right-3">
                                    <span class="px-2.5 py-1 text-[9px] font-bold rounded-full border shadow-sm backdrop-blur-md" :class="item.statusClass" x-text="item.status"></span>
                                </div>
                            </div>

                            <!-- Content Details -->
                            <div class="p-6 space-y-4">
                                <div>
                                    <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest block" x-text="item.type"></span>
                                    <h3 class="text-base font-bold text-white mt-0.5 group-hover:text-emerald-400 transition" x-text="item.name"></h3>
                                    <p class="text-xs text-zinc-400 mt-1" x-text="item.capacity"></p>
                                </div>
                            </div>

                            <!-- Footer Schedule & Action -->
                            <div class="p-6 pt-0 space-y-4">
                                <div class="flex items-center space-x-2 text-xs bg-zinc-900/80 px-3 py-2 rounded-xl border border-zinc-800/80">
                                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                    <span class="text-zinc-300 font-medium truncate" x-text="item.schedule"></span>
                                </div>
                                <button @click="currentView = 'new-reservation'; bookingStep = 1;" class="w-full py-2.5 bg-emerald-500 hover:bg-emerald-400 text-zinc-950 text-xs font-bold rounded-xl transition block text-center shadow-lg shadow-emerald-950/40">
                                    Book This Resource &rarr;
                                </button>
                            </div>

                        </div>
                    </template>
                </div>

            </main>

        </div>

    </div>
</x-app-layout>