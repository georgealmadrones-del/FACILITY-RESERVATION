<x-app-layout>
    <div x-data="{
        activeTab: 'all',
        searchQuery: '',
        currentMonth: 'May 2026',
        resources: [
            { 
                id: 1, 
                name: 'Multimedia Room 201', 
                category: 'rooms', 
                type: 'Facility', 
                capacity: '30 people · 2nd Floor', 
                schedule: 'Fully open for reservation', 
                status: 'AVAILABLE', 
                statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800',
                image: 'https://images.unsplash.com/photo-1517502884422-41eaead166d4?auto=format&fit=crop&w=600&q=80'
            },
            { 
                id: 2, 
                name: 'Auditorium Hall', 
                category: 'rooms', 
                type: 'Facility', 
                capacity: '180 people · Main Bldg.', 
                schedule: 'Reserved: 01:00 PM - 03:00 PM', 
                status: 'LIMITED', 
                statusClass: 'bg-amber-950 text-amber-400 border-amber-800',
                image: 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&w=600&q=80'
            },
            { 
                id: 3, 
                name: 'Conference Room A', 
                category: 'rooms', 
                type: 'Facility', 
                capacity: '12 people · Admin Wing', 
                schedule: 'Fully booked today', 
                status: 'UNAVAILABLE', 
                statusClass: 'bg-rose-950 text-rose-400 border-rose-800',
                image: 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=600&q=80'
            },
            { 
                id: 4, 
                name: 'Mac Workstation Lab', 
                category: 'labs', 
                type: 'Laboratory', 
                capacity: '40 seats · 3rd Floor', 
                schedule: 'Open after 03:00 PM', 
                status: 'AVAILABLE', 
                statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800',
                image: 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=600&q=80'
            },
            { 
                id: 5, 
                name: 'CAD Engineering Lab', 
                category: 'labs', 
                type: 'Laboratory', 
                capacity: '24 seats · 3rd Floor', 
                schedule: 'Fully open for reservation', 
                status: 'AVAILABLE', 
                statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800',
                image: 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=600&q=80'
            },
            { 
                id: 6, 
                name: 'Lighting Kit Pro', 
                category: 'equipment', 
                type: 'Equipment', 
                capacity: '2 units stock · Tech Locker', 
                schedule: '1 unit available', 
                status: 'AVAILABLE', 
                statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800',
                image: 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=600&q=80'
            },
            { 
                id: 7, 
                name: 'Sony Cinema Kit A', 
                category: 'equipment', 
                type: 'Equipment', 
                capacity: '1 kit · Media Locker', 
                schedule: 'Fully open for reservation', 
                status: 'AVAILABLE', 
                statusClass: 'bg-emerald-950 text-emerald-400 border-emerald-800',
                image: 'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?auto=format&fit=crop&w=600&q=80'
            }
        ],
        get filteredCatalog() {
            return this.resources.filter(item => {
                let matchesCategory = (this.activeTab === 'all' || item.category === this.activeTab);
                let matchesSearch = this.searchQuery === '' || item.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || item.capacity.toLowerCase().includes(this.searchQuery.toLowerCase());
                return matchesCategory && matchesSearch;
            });
        }
    }" class="min-h-screen bg-[#09090B] text-zinc-100 font-['Plus_Jakarta_Sans',sans-serif] flex relative overflow-x-hidden">

        <!-- Ambient Glows -->
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
                            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-zinc-400 hover:text-white hover:bg-zinc-900/60 border border-transparent transition text-xs font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Overview</span>
                            </a>
                            <a href="{{ route('dashboard') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-zinc-400 hover:text-white hover:bg-zinc-900/60 transition text-xs font-semibold">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                    <span>New reservation</span>
                                </div>
                                <span class="text-[10px] bg-zinc-800 text-zinc-400 px-1.5 py-0.5 rounded font-mono">+</span>
                            </a>
                            <a href="{{ route('availability') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl bg-zinc-900 text-white border border-zinc-800 text-xs font-bold shadow-sm">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
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

        <!-- Main Viewport -->
        <div class="flex-grow flex flex-col min-h-screen">
            
            <header class="h-20 border-b border-[#27272A] bg-[#09090B]/80 backdrop-blur-md px-6 lg:px-10 flex items-center justify-between sticky top-0 z-30">
                <div class="w-full max-w-md relative">
                    <svg class="w-4 h-4 absolute left-3.5 top-3.5 text-zinc-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" x-model="searchQuery" placeholder="Search campus catalog..." class="w-full bg-zinc-900/90 border border-zinc-800 rounded-xl pl-10 pr-12 py-2.5 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 transition placeholder-zinc-500">
                    <span class="absolute right-3 top-3 text-[10px] font-mono text-zinc-500 bg-zinc-800/80 px-1.5 py-0.5 rounded border border-zinc-700/50">⌘K</span>
                </div>

                <div class="flex items-center space-x-4">
                    <span class="hidden sm:flex items-center space-x-1.5 px-3.5 py-1.5 rounded-full bg-emerald-950/80 text-emerald-400 border border-emerald-800/60 text-xs font-bold shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>LIVE AVAILABILITY</span>
                    </span>
                </div>
            </header>

            <main class="flex-grow p-6 lg:p-10 space-y-8">
                
                <!-- Page Header -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-[#27272A] pb-6">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest block">MASTER DIRECTORY</span>
                        <h1 class="text-3xl font-extrabold text-white tracking-tight">Campus Availability Calendar</h1>
                        <p class="text-xs text-zinc-400">Real-time scheduling and status overview across all rooms, labs, and equipment.</p>
                    </div>

                    <div class="bg-zinc-900 border border-zinc-800 px-4 py-2 rounded-xl text-xs font-bold text-zinc-300 flex items-center space-x-2">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span x-text="currentMonth"></span>
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

                <!-- Availability Catalog Grid with Image Previews -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <template x-for="item in filteredCatalog" :key="item.id">
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
                                <a href="{{ route('dashboard') }}" class="w-full py-2.5 bg-emerald-500 hover:bg-emerald-400 text-zinc-950 text-xs font-bold rounded-xl transition block text-center shadow-lg shadow-emerald-950/40">
                                    Book This Resource &rarr;
                                </a>
                            </div>

                        </div>
                    </template>
                </div>

            </main>
        </div>

    </div>
</x-app-layout>