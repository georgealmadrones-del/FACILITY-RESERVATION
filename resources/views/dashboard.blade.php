<x-app-layout>
<div class="h-screen bg-[#F4F5F7] text-[#272757] font-['Inter',sans-serif] flex overflow-hidden" x-data="reservationDashboard()" x-init="init()">
    <!-- Mobile Menu Backdrop -->
    <div x-show="mobileMenuOpen" @click="mobileMenuOpen = false"
         class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm md:hidden"
         style="display: none;"></div>

    <!-- Left Sidebar -->
    <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
           class="fixed inset-y-0 left-0 z-50 w-64 shrink-0 border-r border-[#8686AC]/30 bg-white h-full p-6 flex flex-col justify-between transform transition-transform duration-300 md:translate-x-0 md:static md:z-40 shadow-2xl md:shadow-sm overflow-y-auto">
        <div class="space-y-8">
            <div class="flex items-center justify-between px-2 pt-2">
                <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block">Menu</span>
                <button type="button" @click="mobileMenuOpen = false"
                        class="md:hidden text-[#505081] hover:text-[#0F0E47] font-bold text-lg">&times;</button>
            </div>

            <div class="space-y-6">
                <div>
                    <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block mb-3">Main</span>
                    <nav class="space-y-1">
                        <button type="button" @click="currentView = 'overview'; mobileMenuOpen = false;"
                                :class="currentView === 'overview' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                                class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                            <svg class="w-4 h-4 text-current" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            <span>Home</span>
                        </button>

                        <button type="button" @click="currentView = 'new-reservation'; bookingStep = 1; syncTimeToNowIfToday(); mobileMenuOpen = false;"
                                :class="currentView === 'new-reservation' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                                class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl border transition text-xs font-semibold">
                            <div class="flex items-center space-x-3">
                                <svg class="w-4 h-4 text-current" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                <span>Book a room or item</span>
                            </div>
                            <span class="text-[10px] bg-[#8686AC]/20 px-1.5 py-0.5 rounded font-mono">+</span>
                        </button>

                        <button type="button" @click="currentView = 'availability-calendar'; syncLiveDashboardData(); mobileMenuOpen = false;"
                                :class="currentView === 'availability-calendar' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                                class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border transition text-xs font-semibold">
                            <svg class="w-4 h-4 text-current" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>Schedule &amp; Rooms</span>
                        </button>

                        <button type="button" @click="currentView = 'profile'; profileTab = 'overview'; mobileMenuOpen = false;"
                                :class="currentView === 'profile' && profileTab === 'overview' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                                class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                            <svg class="w-4 h-4 text-current" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <span>My profile</span>
                        </button>
                    </nav>
                </div>

                <div>
                    <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block mb-3">More</span>
                    <nav class="space-y-1">
                        <button type="button" @click="currentView = 'profile'; profileTab = 'history'; mobileMenuOpen = false;"
                                :class="currentView === 'profile' && profileTab === 'history' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                                class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Past bookings</span>
                        </button>

                        <button type="button" @click="currentView = 'support-chat'; mobileMenuOpen = false; fetchMessages();"
                                :class="currentView === 'support-chat' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                                class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border transition text-xs font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                            <span>Ask admin</span>
                        </button>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Sidebar Footer -->
        <div class="pt-6 border-t border-[#8686AC]/30 flex items-center justify-between">
            <div @click="currentView = 'profile'; profileTab = 'overview'; mobileMenuOpen = false;"
                 class="flex items-center space-x-3 min-w-0 cursor-pointer group">
                <div class="w-8 h-8 shrink-0 rounded-xl bg-[#F4F5F7] border border-[#8686AC]/40 flex items-center justify-center font-bold text-xs text-[#0F0E47] overflow-hidden">
                    @if(Auth::user()->avatar_url ?? false)
                        <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name ?? 'User' }}" class="w-full h-full object-cover">
                    @elseif(Auth::user()->profile_photo ?? false)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name ?? 'User' }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                    @endif
                </div>
                <div class="overflow-hidden">
                    <span class="font-bold text-xs text-[#0F0E47] group-hover:underline truncate block">{{ Auth::user()->name ?? 'User' }}</span>
                    <span class="text-[10px] text-[#505081] truncate block capitalize">{{ Auth::user()->role ?? 'Student' }}</span>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" title="Log out" class="text-[#505081] hover:text-rose-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Dashboard Viewport -->
    <div class="flex-1 flex flex-col h-full min-w-0 overflow-hidden">
        <!-- Top Bar -->
        <header class="h-20 shrink-0 border-b border-[#8686AC]/30 bg-white/80 backdrop-blur-md px-4 lg:px-10 flex items-center justify-between z-30 shadow-sm">
            <div class="flex items-center space-x-3 w-full max-w-md">
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden w-10 h-10 rounded-xl bg-[#F4F5F7] hover:bg-[#8686AC]/20 border border-[#8686AC]/30 text-[#272757] flex items-center justify-center transition focus:outline-none shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Search Bar with Live Dropdown & Real-Time Availability -->
                <div class="relative w-full" @click.away="searchDropdownOpen = false">
                    <svg class="w-4 h-4 absolute left-3.5 top-3.5 text-[#505081] pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text"
                           x-model="searchQuery"
                           @focus="searchDropdownOpen = true"
                           @input="searchDropdownOpen = true"
                           @keydown.enter.prevent="submitTopSearch()"
                           placeholder="Find a room, lab, or projector..."
                           class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl pl-10 pr-10 py-2.5 text-xs text-[#272757] focus:outline-none focus:border-[#0F0E47] transition placeholder-[#505081]/60">
                    <button type="button"
                            x-show="searchQuery.trim().length > 0"
                            @click="searchQuery = ''; searchDropdownOpen = false;"
                            class="absolute right-3 top-2.5 text-xs font-bold text-[#505081] hover:text-[#0F0E47] px-1.5"
                            aria-label="Clear search">&times;</button>

                    <div x-show="searchDropdownOpen && searchQuery.trim().length > 0"
                         class="fixed sm:absolute left-3 right-3 sm:left-0 sm:right-0 top-20 sm:top-full mt-1 sm:mt-2 bg-white border border-[#8686AC]/40 rounded-2xl shadow-2xl overflow-hidden z-50"
                         style="display: none;">
                        <div class="max-h-72 overflow-y-auto divide-y divide-[#8686AC]/20">
                            <template x-for="item in quickSearchResults" :key="item.id">
                                <button type="button"
                                        @click="pickSearchResult(item)"
                                        class="w-full px-4 py-3 text-left hover:bg-[#F4F5F7] transition flex items-center justify-between gap-3">
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            <p class="text-xs font-bold text-[#0F0E47] truncate" x-text="item.name"></p>
                                            <span class="px-1.5 py-0.5 text-[9px] font-bold rounded border shrink-0"
                                                  :class="getLiveAvailability(item).badgeClass"
                                                  x-text="getLiveAvailability(item).label"></span>
                                        </div>
                                        <p class="text-[10px] text-[#505081] truncate" x-text="getLiveAvailability(item).detail"></p>
                                    </div>
                                    <span class="text-[10px] font-bold text-[#0F0E47] bg-[#F4F5F7] border border-[#8686AC]/30 px-2.5 py-1 rounded-lg shrink-0">
                                        Select &rarr;
                                    </span>
                                </button>
                            </template>
                            <template x-if="quickSearchResults.length === 0">
                                <div class="px-4 py-5 text-center text-xs text-[#505081]">
                                    Nothing matched "<span class="font-bold text-[#0F0E47]" x-text="searchQuery"></span>".
                                </div>
                            </template>
                        </div>
                        <button type="button"
                                @click="submitTopSearch()"
                                class="w-full px-4 py-2.5 bg-[#F4F5F7] hover:bg-[#8686AC]/20 border-t border-[#8686AC]/30 text-[11px] font-bold text-[#0F0E47] flex items-center justify-between">
                            <span>See all matches in Schedule &amp; Rooms</span>
                            <span>&rarr;</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <div class="hidden md:flex items-center space-x-2 rounded-full bg-[#F4F5F7] border border-[#8686AC]/30 text-xs px-3.5 py-1.5 text-[#272757] shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="font-medium">Online &bull; <span x-text="currentTimeHHMM"></span></span>
                </div>

                <!-- Notification Bell -->
                <div class="relative" @click.away="notificationsOpen = false">
                    <button type="button" @click="notificationsOpen = !notificationsOpen; refreshStudentAlerts();"
                            class="w-10 h-10 rounded-xl bg-[#F4F5F7] hover:bg-[#8686AC]/20 border border-[#8686AC]/30 text-[#272757] flex items-center justify-center transition relative"
                            aria-label="Notifications">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0.538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <template x-if="unreadStudentAlertCount > 0">
                            <span class="absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1 rounded-full bg-rose-600 text-white text-[10px] font-extrabold flex items-center justify-center shadow"
                                  x-text="unreadStudentAlertCount"></span>
                        </template>
                    </button>

                    <div x-show="notificationsOpen"
                         class="fixed sm:absolute right-3 sm:right-0 left-3 sm:left-auto top-20 sm:top-auto mt-1 sm:mt-3 sm:w-88 bg-white border border-[#8686AC]/40 rounded-2xl shadow-2xl p-4 space-y-3 z-50"
                         style="display: none;">
                        <div class="flex items-center justify-between pb-2 border-b border-[#8686AC]/30">
                            <span class="text-xs font-bold text-[#0F0E47]">Alerts</span>
                            <button type="button" @click="markAllStudentAlertsRead()" class="text-[10px] font-bold text-[#505081] hover:text-[#0F0E47] underline">
                                Clear unread
                            </button>
                        </div>
                        <div class="space-y-2 max-h-72 overflow-y-auto rounded-xl bg-[#F4F5F7] p-1.5">
                            <template x-for="alert in studentAlerts" :key="alert.id">
                                <button type="button"
                                        @click="handleStudentAlertClick(alert)"
                                        class="w-full text-left p-2.5 rounded-xl bg-white hover:bg-[#F4F5F7]/80 border border-[#8686AC]/30 transition space-y-1 block">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="text-[11px] font-bold text-[#0F0E47] truncate" x-text="alert.title"></span>
                                        <span class="px-1.5 py-0.5 text-[9px] font-bold rounded uppercase shrink-0"
                                              :class="alert.type === 'reminder'
                                                  ? 'bg-rose-50 text-rose-700 border border-rose-300'
                                                  : (alert.type === 'chat'
                                                      ? 'bg-emerald-50 text-emerald-700 border border-emerald-300'
                                                      : 'bg-sky-50 text-sky-700 border border-sky-300')"
                                              x-text="alert.badge"></span>
                                    </div>
                                    <p class="text-[11px] text-[#505081] leading-snug" x-text="alert.detail"></p>
                                </button>
                            </template>
                            <template x-if="studentAlerts.length === 0">
                                <p class="text-xs text-center text-[#505081] py-4">Nothing new right now.</p>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Scrollable Content Container -->
        <div class="flex-1 overflow-y-auto">
            @if(session('success'))
                <div class="mx-6 lg:mx-10 mt-6 bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-2xl text-xs font-bold">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mx-6 lg:mx-10 mt-6 bg-rose-50 border border-rose-300 text-rose-800 px-4 py-3 rounded-2xl text-xs font-bold space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Return Reminder Banner -->
            <template x-if="overdueEquipmentReservations.length > 0">
                <div class="mx-6 lg:mx-10 mt-6 bg-amber-50 border border-amber-300 text-amber-950 px-5 py-4 rounded-2xl shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="space-y-0.5 text-xs">
                        <p class="font-extrabold text-amber-900">
                            Heads up: <span x-text="overdueEquipmentReservations.length"></span> borrowed item(s) are past their end time.
                        </p>
                        <p class="text-[11px] text-amber-800">
                            Tap an item to open and return it:
                            <template x-for="(item, idx) in overdueEquipmentReservations" :key="item.id">
                                <span>
                                    <button type="button"
                                            @click="selectedReservation = item; detailsModalOpen = true;"
                                            class="underline font-bold hover:text-amber-950" x-text="item.resource_name"></button><span x-show="idx < overdueEquipmentReservations.length - 1">, </span>
                                </span>
                            </template>
                        </p>
                    </div>
                </div>
            </template>

            <!-- VIEW 1: HOME -->
            <main x-show="currentView === 'overview'" class="p-6 lg:p-10 space-y-10">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-[#505081] uppercase tracking-widest block">{{ strtoupper(date('l, F j')) }}</span>
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-[#0F0E47] tracking-tight">
                            Hey {{ explode(' ', Auth::user()->name ?? 'there')[0] }},
                        </h1>
                        <p class="text-xs text-[#505081]">Check your room and equipment requests below.</p>
                    </div>
                    <button type="button" @click="currentView = 'new-reservation'; bookingStep = 1; syncTimeToNowIfToday();"
                            class="px-6 py-3 bg-[#0F0E47] hover:bg-[#505081] text-white font-bold text-xs rounded-xl transition shadow-lg flex items-center space-x-2 shrink-0">
                        <span class="text-base font-extrabold leading-none">+</span>
                        <span>Book a room or item</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <!-- Profile Card -->
                    <div @click="currentView = 'profile'; profileTab = 'overview';"
                         class="lg:col-span-5 bg-white backdrop-blur-xl p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl flex items-center justify-between relative overflow-hidden cursor-pointer hover:border-[#0F0E47] transition">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-[#8686AC]/10 rounded-full blur-2xl pointer-events-none"></div>
                        <div class="flex items-center space-x-4 relative z-10">
                            <div class="w-14 h-14 rounded-2xl bg-[#F4F5F7] border border-[#8686AC]/40 flex items-center justify-center font-extrabold text-lg text-[#0F0E47] shadow-inner overflow-hidden">
                                @if(Auth::user()->avatar_url ?? false)
                                    <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name ?? 'User' }}" class="w-full h-full object-cover">
                                @elseif(Auth::user()->profile_photo ?? false)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name ?? 'User' }}" class="w-full h-full object-cover">
                                @else
                                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                                @endif
                            </div>
                            <div>
                                <div class="flex items-center space-x-2">
                                    <h3 class="text-base font-bold text-[#0F0E47]">{{ Auth::user()->name ?? 'User' }}</h3>
                                    <span class="px-2 py-0.5 text-[9px] font-bold rounded bg-[#0F0E47] text-white uppercase">ACTIVE</span>
                                </div>
                                <p class="text-xs text-[#505081] mt-0.5 capitalize">{{ Auth::user()->role ?? 'Student' }}</p>
                            </div>
                        </div>
                        <span class="text-xs text-[#505081] font-bold">&rarr;</span>
                    </div>

                    <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div @click="currentView = 'profile'; profileTab = 'history';"
                             class="bg-white backdrop-blur-xl p-5 rounded-3xl border border-[#8686AC]/30 shadow-xl flex flex-col justify-between cursor-pointer hover:border-[#0F0E47] transition">
                            <span class="text-[10px] font-bold text-[#505081] uppercase tracking-wider block">MY BOOKINGS</span>
                            <div class="mt-2">
                                <span class="text-3xl font-extrabold text-[#0F0E47]" x-text="recentReservations.length">0</span>
                                <span class="text-[10px] text-[#505081] block mt-0.5">Total requests made</span>
                            </div>
                        </div>

                        <div class="bg-white backdrop-blur-xl p-5 rounded-3xl border border-[#8686AC]/30 shadow-xl flex flex-col justify-between">
                            <span class="text-[10px] font-bold text-[#505081] uppercase tracking-wider block">APPROVED</span>
                            <div class="mt-2">
                                <span class="text-3xl font-extrabold text-[#0F0E47]" x-text="approvalRateText">0%</span>
                                <span class="text-[10px] text-emerald-600 font-semibold block mt-0.5">Approval share</span>
                            </div>
                        </div>

                        <div class="bg-white backdrop-blur-xl p-5 rounded-3xl border border-[#8686AC]/30 shadow-xl flex flex-col justify-between space-y-2">
                            <span class="text-[10px] font-bold text-[#505081] uppercase tracking-wider block">SHORTCUTS</span>
                            <div class="space-y-1.5">
                                <button type="button" @click="currentView = 'profile'; profileTab = 'overview';" class="w-full py-1.5 px-3 bg-[#F4F5F7] hover:bg-[#8686AC]/20 text-[#272757] text-[11px] font-semibold rounded-xl border border-[#8686AC]/30 transition block text-center">
                                    Edit profile
                                </button>
                                <button type="button" @click="currentView = 'support-chat'; fetchMessages();" class="w-full py-1.5 px-3 bg-[#F4F5F7] hover:bg-[#8686AC]/20 text-[#272757] text-[11px] font-semibold rounded-xl border border-[#8686AC]/30 transition block text-center">
                                    Message admin
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Bookings Table -->
                <section class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-extrabold text-[#0F0E47]">Recent bookings</h3>
                            <p class="text-xs text-[#505081]">Tap any row to check status, cancel pending requests, or return approved equipment.</p>
                        </div>
                        <button type="button" @click="currentView = 'profile'; profileTab = 'history';" class="text-xs font-bold text-[#505081] hover:text-[#0F0E47] transition flex items-center space-x-1">
                            <span>See all</span>
                            <span>&rarr;</span>
                        </button>
                    </div>

                    <div class="bg-white backdrop-blur-xl rounded-3xl border border-[#8686AC]/30 overflow-hidden shadow-xl">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-[#8686AC]/30 text-[10px] font-bold text-[#505081] uppercase tracking-wider bg-[#F4F5F7]">
                                        <th class="py-4 px-6">ITEM / ROOM</th>
                                        <th class="py-4 px-6">WHEN</th>
                                        <th class="py-4 px-6 text-right">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#8686AC]/20 text-xs">
                                    <template x-for="item in recentReservations" :key="item.id">
                                        <tr @click="selectedReservation = item; detailsModalOpen = true;" class="hover:bg-[#F4F5F7]/80 transition cursor-pointer">
                                            <td class="py-4 px-6">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-9 h-9 rounded-xl bg-[#F4F5F7] border border-[#8686AC]/30 flex items-center justify-center text-[#0F0E47]">
                                                        <svg class="w-4 h-4 text-[#505081]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                                    </div>
                                                    <div>
                                                        <div class="flex items-center gap-2 flex-wrap">
                                                            <span class="font-bold text-[#0F0E47]" x-text="item.resource_name"></span>
                                                            <template x-if="isOverdueEquipment(item)">
                                                                <span class="px-2 py-0.5 text-[9px] font-extrabold rounded-full bg-rose-50 text-rose-700 border border-rose-300 uppercase">Return Due</span>
                                                            </template>
                                                        </div>
                                                        <span class="text-[10px] text-[#505081] capitalize" x-text="item.resource_type"></span>
                                                        <template x-if="item.rejection_reason">
                                                            <p class="text-[10px] text-rose-600 mt-0.5 italic" x-text="'Note: ' + item.rejection_reason"></p>
                                                        </template>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-[#272757] font-medium" x-text="(item.start_time || '') + ' to ' + (item.end_time || '')"></td>
                                            <td class="py-4 px-6 text-right">
                                                <span class="px-3 py-1 text-[10px] font-bold rounded-full border shadow-sm"
                                                      :class="{
                                                          'bg-emerald-50 text-emerald-700 border-emerald-300': ['approved', 'returned'].includes((item.status || '').toLowerCase()),
                                                          'bg-amber-50 text-amber-700 border-amber-300': (item.status || '').toLowerCase() === 'pending',
                                                          'bg-rose-50 text-rose-700 border-rose-300': ['rejected', 'cancelled'].includes((item.status || '').toLowerCase())
                                                      }"
                                                      x-text="(item.status || '').toUpperCase()"></span>
                                            </td>
                                        </tr>
                                    </template>
                                    <template x-if="recentReservations.length === 0">
                                        <tr>
                                            <td colspan="3" class="py-8 text-center text-[#505081] text-xs">No bookings yet. Click "Book a room or item" to start.</td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </main>

            <!-- VIEW 2: NEW RESERVATION -->
            <main x-show="currentView === 'new-reservation'" class="p-6 lg:p-10 space-y-8" style="display: none;">
                <form action="{{ route('reservations.store') }}" method="POST" @submit="validateBeforeSubmit($event)">
                    @csrf
                    <input type="hidden" name="resource_type" :value="resourceType">
                    <input type="hidden" name="resource_name" :value="resourceType === 'facility' ? selectedFacility : selectedEquipment">
                    <input type="hidden" name="category" :value="resourceType === 'facility' ? 'rooms' : 'equipment'">
                    <input type="hidden" name="start_time" :value="formattedDate + ' ' + startTime + ':00'">
                    <input type="hidden" name="end_time" :value="formattedDate + ' ' + endTime + ':00'">
                    <input type="hidden" name="quantity" :value="resourceType === 'facility' ? expectedAttendees : equipmentQuantity">

                    <div class="flex items-center justify-between border-b border-[#8686AC]/30 pb-6">
                        <div class="space-y-1">
                            <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block">Booking Form</span>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0F0E47] tracking-tight">Book a room or item</h2>
                            <p class="text-xs text-[#505081]">Pick your date, time, and count before sending your request.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mt-6">
                        <div class="lg:col-span-8 bg-white backdrop-blur-xl p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-2xl space-y-8">
                            <div class="space-y-6">
                                <div class="flex items-center justify-between gap-3">
                                    <h3 class="text-base font-extrabold text-[#0F0E47]">What are you booking?</h3>
                                    <button type="button"
                                            @click="resourceType = resourceType === 'facility' ? 'equipment' : 'facility'"
                                            class="px-4 py-2 rounded-xl border border-[#8686AC]/40 bg-[#F4F5F7] hover:bg-[#0F0E47] text-[#0F0E47] hover:text-white text-xs font-bold transition shadow-sm flex items-center gap-2">
                                        <span x-text="resourceType === 'facility' ? 'Rooms & Labs' : 'Equipment'"></span>
                                        <span class="text-[10px] px-2 py-0.5 rounded-md bg-white/80 text-[#0F0E47] font-extrabold">Switch</span>
                                    </button>
                                </div>

                                <template x-if="resourceType === 'facility'">
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-xs font-semibold text-[#505081] mb-1.5">Room or Lab</label>
                                            <select x-model="selectedFacility" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-3 text-xs text-[#272757] focus:outline-none focus:border-[#505081]">
                                                @foreach ($facilities ?? [] as $facility)
                                                    @php
                                                        $cap = $facility->capacity ?? $facility->max_capacity ?? $facility->seats ?? $facility->pax ?? null;
                                                    @endphp
                                                    <option value="{{ $facility->name }}">{{ $facility->name }} ({{ $cap ? 'Max ' . $cap . ' people' : 'Capacity not set' }} &bull; {{ ucfirst($facility->status ?? 'available') }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-[#505081] mb-1.5">
                                                How many people? (Limit: <span x-text="currentFacilityCapacity || 'Not set'"></span>)
                                            </label>
                                            <input type="number" x-model.number="expectedAttendees" min="1"
                                                   :max="currentFacilityCapacity > 0 ? currentFacilityCapacity : null"
                                                   class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]">
                                        </div>
                                    </div>
                                </template>

                                <template x-if="resourceType === 'equipment'">
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-xs font-semibold text-[#505081] mb-1.5">Equipment</label>
                                            <select x-model="selectedEquipment" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-3 text-xs text-[#272757] focus:outline-none focus:border-[#505081]">
                                                @foreach ($equipment ?? [] as $item)
                                                    <option value="{{ $item->name }}">{{ $item->name }} ({{ $item->total_stock }} total &bull; {{ ucfirst($item->status ?? 'available') }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-[#505081] mb-1.5">
                                                How many units? (<span x-text="currentAvailableEquipmentStock"></span> left for this slot, <span x-text="currentEquipmentStock"></span> total)
                                            </label>
                                            <input type="number" x-model.number="equipmentQuantity" min="1"
                                                   :max="Math.max(1, currentAvailableEquipmentStock)"
                                                   class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]">
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <div class="space-y-6 pt-6 border-t border-[#8686AC]/30">
                                <div class="flex items-center justify-between gap-2 flex-wrap">
                                    <h3 class="text-base font-extrabold text-[#0F0E47]">Date &amp; Time</h3>
                                    <span class="text-[11px] font-bold text-[#505081]">Now: <span x-text="currentTimeHHMM"></span></span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                                    <div class="bg-[#F4F5F7] p-5 rounded-2xl border border-[#8686AC]/30">
                                        <div class="flex items-center justify-between mb-4">
                                            <button type="button" @click="prevMonth()" :disabled="!canGoPrevMonth"
                                                    :class="!canGoPrevMonth ? 'opacity-40 cursor-not-allowed' : 'hover:text-[#0F0E47]'"
                                                    class="text-[#505081] px-2.5 py-1 bg-white rounded-lg border border-[#8686AC]/40">&larr;</button>
                                            <span class="text-xs font-extrabold text-[#0F0E47]" x-text="monthName + ' ' + currentYear"></span>
                                            <button type="button" @click="nextMonth()"
                                                    class="text-[#505081] hover:text-[#0F0E47] px-2.5 py-1 bg-white rounded-lg border border-[#8686AC]/40">&rarr;</button>
                                        </div>
                                        <div class="grid grid-cols-7 gap-1 text-center text-[11px] text-[#505081] font-semibold mb-2">
                                            <span>Su</span><span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span>
                                        </div>
                                        <div class="grid grid-cols-7 gap-1 text-center text-xs">
                                            <template x-for="i in firstDayIndex" :key="'empty-' + i">
                                                <div></div>
                                            </template>
                                            <template x-for="day in daysInMonth" :key="day">
                                                <button type="button" @click="selectDate(day)" :disabled="isPastDay(day)"
                                                        :class="isPastDay(day)
                                                            ? 'bg-zinc-200/60 text-zinc-400 cursor-not-allowed line-through'
                                                            : (selectedDay === day && currentMonth === activeCalendarMonth && currentYear === activeCalendarYear
                                                                ? 'bg-[#0F0E47] text-white font-extrabold shadow-md'
                                                                : 'bg-white text-[#272757] hover:bg-[#8686AC]/20 border border-[#8686AC]/30')"
                                                        class="h-8 rounded-lg flex items-center justify-center transition" x-text="day"></button>
                                            </template>
                                        </div>
                                    </div>

                                    <div class="space-y-4 bg-[#F4F5F7] p-5 rounded-2xl border border-[#8686AC]/30 h-full flex flex-col justify-between">
                                        <div class="space-y-3">
                                            <span class="text-[10px] font-bold text-[#0F0E47] uppercase tracking-widest block mb-3">Time</span>
                                            <div>
                                                <label class="block text-[11px] font-semibold text-[#505081] mb-1">Start</label>
                                                <input type="time" x-model="startTime" @change="formError = ''"
                                                       :min="formattedDate === todayISO ? currentTimeHHMM : '00:00'"
                                                       max="19:59"
                                                       class="w-full bg-white border border-[#8686AC]/40 rounded-xl px-3 py-2 text-xs text-[#272757] focus:outline-none focus:border-[#505081]" required>
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-semibold text-[#505081] mb-1">End</label>
                                                <input type="time" x-model="endTime" @change="formError = ''"
                                                       :min="startTime || '00:00'"
                                                       max="20:00"
                                                       class="w-full bg-white border border-[#8686AC]/40 rounded-xl px-3 py-2 text-xs text-[#272757] focus:outline-none focus:border-[#505081]" required>
                                            </div>
                                        </div>
                                        <p class="text-[11px] text-[#505081] pt-2">Picked date: <strong class="text-[#0F0E47]" x-text="selectedDate"></strong></p>
                                    </div>
                                </div>

                                <template x-if="conflictingBookings.length > 0">
                                    <div class="p-4 rounded-2xl bg-amber-50 border border-amber-300 text-xs text-amber-900 space-y-1">
                                        <p class="font-bold">Other bookings on <span x-text="formattedDate"></span>:</p>
                                        <template x-for="b in conflictingBookings" :key="b.id">
                                            <p class="text-[11px]" x-text="b.resource_name + ' (' + extractTimeHHMM(b.start_time) + '-' + extractTimeHHMM(b.end_time) + ') [' + b.status + ' • Qty: ' + (b.quantity || 1) + ']'"></p>
                                        </template>
                                    </div>
                                </template>

                                <p x-show="formError" class="text-xs font-bold text-rose-600" x-text="formError"></p>

                                <div>
                                    <label class="block text-xs font-semibold text-[#505081] mb-1.5">What is it for?</label>
                                    <textarea name="purpose" placeholder="e.g. Group study, class film shoot, org meeting..." x-model="purposeReason" rows="3"
                                              class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-3 text-xs text-[#272757] focus:outline-none focus:border-[#505081]" required></textarea>
                                </div>
                            </div>

                            <div class="pt-6 border-t border-[#8686AC]/30 flex justify-end">
                                <button type="submit" class="bg-[#0F0E47] hover:bg-[#272757] text-white px-6 py-3 rounded-xl text-xs font-bold transition shadow-lg">
                                    Send request &rarr;
                                </button>
                            </div>
                        </div>

                        <!-- Summary Card -->
                        <div class="lg:col-span-4 bg-white backdrop-blur-xl p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-2xl space-y-6">
                            <span class="text-[10px] font-bold text-[#505081] uppercase tracking-wider block">Details</span>
                            <h4 class="text-base font-extrabold text-[#0F0E47]" x-text="resourceType === 'facility' ? selectedFacility : selectedEquipment"></h4>
                            <div class="space-y-2 text-xs text-[#272757] pt-2 border-t border-[#8686AC]/30">
                                <p><strong>Date:</strong> <span x-text="selectedDate"></span></p>
                                <p><strong>Time:</strong> <span x-text="startTime + ' to ' + endTime"></span></p>
                                <p><strong>Count:</strong>
                                    <span x-text="resourceType === 'facility'
                                        ? expectedAttendees + ' / ' + (currentFacilityCapacity > 0 ? currentFacilityCapacity + ' people' : 'people')
                                        : equipmentQuantity + ' / ' + currentAvailableEquipmentStock + ' left'"></span>
                                </p>
                            </div>
                            <p class="text-[11px] text-[#505081]">The admin will review your request.</p>
                        </div>
                    </div>
                </form>
            </main>

            <!-- VIEW 3: SCHEDULE & ROOMS (LIVE AVAILABILITY) -->
            <main x-show="currentView === 'availability-calendar'" class="p-6 lg:p-10 space-y-8" style="display: none;">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-[#8686AC]/30 pb-6">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block">Live Check</span>
                        <h2 class="text-3xl font-extrabold text-[#0F0E47] tracking-tight">Schedule &amp; Rooms</h2>
                        <p class="text-xs text-[#505081]">Check live status—available, under maintenance, or already booked for your time slot.</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <label class="text-xs font-bold text-[#505081]">Date:</label>
                        <input type="date" x-model="availabilityFilterDate" :min="todayISO"
                               class="bg-white border border-[#8686AC]/40 rounded-xl px-3 py-2 text-xs font-bold text-[#0F0E47]">
                        <input type="time" x-model="availabilityFilterStart"
                               :min="availabilityFilterDate === todayISO ? currentTimeHHMM : '00:00'"
                               max="19:59"
                               class="bg-white border border-[#8686AC]/40 rounded-xl px-2.5 py-2 text-xs font-bold text-[#0F0E47]">
                        <span class="text-xs text-[#505081] font-bold">-</span>
                        <input type="time" x-model="availabilityFilterEnd"
                               :min="availabilityFilterStart || '00:00'"
                               max="20:00"
                               class="bg-white border border-[#8686AC]/40 rounded-xl px-2.5 py-2 text-xs font-bold text-[#0F0E47]">
                    </div>
                </div>

                <div class="bg-white rounded-3xl border border-[#8686AC]/30 p-6 shadow-xl space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-extrabold text-[#0F0E47]">Taken on <span x-text="availabilityFilterDate"></span> (<span x-text="availabilityFilterStart + '-' + availabilityFilterEnd"></span>)</h3>
                        <span class="text-[11px] font-bold text-[#505081]" x-text="bookedSlotsForDate.length + ' overlapping booking(s)'"></span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="border-b border-[#8686AC]/30 text-[10px] font-bold text-[#505081] uppercase bg-[#F4F5F7]">
                                    <th class="py-3 px-4">Item / Room</th>
                                    <th class="py-3 px-4">Time</th>
                                    <th class="py-3 px-4">Count</th>
                                    <th class="py-3 px-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#8686AC]/20">
                                <template x-for="slot in bookedSlotsForDate" :key="slot.id">
                                    <tr>
                                        <td class="py-3 px-4 font-bold text-[#0F0E47]" x-text="slot.resource_name"></td>
                                        <td class="py-3 px-4" x-text="extractTimeHHMM(slot.start_time) + '-' + extractTimeHHMM(slot.end_time)"></td>
                                        <td class="py-3 px-4" x-text="(slot.quantity || 1) + ((slot.resource_type || '').toLowerCase() === 'equipment' ? ' unit(s)' : ' people')"></td>
                                        <td class="py-3 px-4">
                                            <span class="px-2.5 py-1 text-[9px] font-bold rounded-full border uppercase"
                                                  :class="{
                                                      'bg-emerald-50 text-emerald-700 border-emerald-300': (slot.status || '').toLowerCase() === 'approved',
                                                      'bg-amber-50 text-amber-700 border-amber-300': (slot.status || '').toLowerCase() === 'pending',
                                                      'bg-rose-50 text-rose-700 border-rose-300': ['rejected', 'cancelled'].includes((slot.status || '').toLowerCase())
                                                  }"
                                                  x-text="slot.status"></span>
                                        </td>
                                    </tr>
                                </template>
                                <template x-if="bookedSlotsForDate.length === 0">
                                    <tr>
                                        <td colspan="4" class="py-6 text-center text-[#505081]">No overlapping bookings in this time slot.</td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex space-x-2 border-b border-[#8686AC]/30 pb-3 overflow-x-auto text-xs font-bold">
                    <button type="button" @click="activeTab = 'all'"
                            :class="activeTab === 'all' ? 'bg-[#0F0E47] text-white border border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] bg-white border border-[#8686AC]/30'"
                            class="px-4 py-2 rounded-xl transition">Everything</button>
                    <button type="button" @click="activeTab = 'rooms'"
                            :class="activeTab === 'rooms' ? 'bg-[#0F0E47] text-white border border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] bg-white border border-[#8686AC]/30'"
                            class="px-4 py-2 rounded-xl transition">Rooms</button>
                    <button type="button" @click="activeTab = 'labs'"
                            :class="activeTab === 'labs' ? 'bg-[#0F0E47] text-white border border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] bg-white border border-[#8686AC]/30'"
                            class="px-4 py-2 rounded-xl transition">Labs</button>
                    <button type="button" @click="activeTab = 'equipment'"
                            :class="activeTab === 'equipment' ? 'bg-[#0F0E47] text-white border border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] bg-white border border-[#8686AC]/30'"
                            class="px-4 py-2 rounded-xl transition">Equipment</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <template x-for="item in filteredResources" :key="item.id">
                        <div class="bg-white backdrop-blur-xl rounded-3xl border border-[#8686AC]/30 hover:border-[#505081] transition overflow-hidden shadow-xl flex flex-col justify-between group">
                            <div class="relative h-44 w-full border-b border-[#8686AC]/30 bg-[#F4F5F7]">
                                <img :src="item.image" :alt="item.name"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-90"
                                     onerror="this.src='https://images.unsplash.com/photo-1497366216548-37520693626c?auto=format&fit=crop&w=600&q=80'">
                                <div class="absolute top-3 right-3">
                                    <span class="px-2.5 py-1 text-[9px] font-bold rounded-full border shadow-sm backdrop-blur-md"
                                          :class="getLiveAvailability(item).badgeClass"
                                          x-text="getLiveAvailability(item).label"></span>
                                </div>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block" x-text="item.type"></span>
                                    <h3 class="text-base font-bold text-[#0F0E47] mt-0.5 group-hover:text-[#505081] transition" x-text="item.name"></h3>
                                    <p class="text-xs text-[#505081] mt-1 font-semibold" x-text="getLiveAvailability(item).detail"></p>
                                </div>
                            </div>
                            <div class="p-6 pt-0 space-y-4">
                                <button type="button"
                                        :disabled="!getLiveAvailability(item).bookable"
                                        @click="if (getLiveAvailability(item).bookable) { selectResourceForBooking(item); currentView = 'new-reservation'; bookingStep = 1; syncTimeToNowIfToday(); }"
                                        :class="getLiveAvailability(item).bookable
                                            ? 'bg-[#0F0E47] hover:bg-[#272757] text-white cursor-pointer'
                                            : 'bg-zinc-200 text-zinc-500 cursor-not-allowed'"
                                        class="w-full py-2.5 text-xs font-bold rounded-xl transition block text-center shadow-lg"
                                        x-text="getLiveAvailability(item).bookable ? 'Book this →' : getLiveAvailability(item).disabledText"></button>
                            </div>
                        </div>
                    </template>
                </div>
            </main>

            <!-- VIEW 4: MY PROFILE -->
            <main x-show="currentView === 'profile'" class="p-6 lg:p-10 space-y-8" style="display: none;">
                <div class="bg-white backdrop-blur-xl p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-2xl flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="flex items-center space-x-5">
                        <div class="w-16 h-16 rounded-2xl bg-[#F4F5F7] border border-[#8686AC]/40 flex items-center justify-center font-extrabold text-xl text-[#0F0E47] overflow-hidden shadow-inner">
                            @if(Auth::user()->avatar_url ?? false)
                                <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name ?? 'User' }}" class="w-full h-full object-cover">
                            @elseif(Auth::user()->profile_photo ?? false)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name ?? 'User' }}" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr(Auth::user()->name ?? 'JD', 0, 2)) }}
                            @endif
                        </div>
                        <div class="space-y-1">
                            <h1 class="text-2xl font-extrabold text-[#0F0E47] tracking-tight">{{ Auth::user()->name ?? 'User' }}</h1>
                            <p class="text-xs text-[#505081]">{{ Auth::user()->email ?? '' }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex space-x-6 border-b border-[#8686AC]/30 text-xs font-bold">
                    <button type="button" @click="profileTab = 'overview'"
                            :class="profileTab === 'overview' ? 'text-[#0F0E47] border-b-2 border-[#0F0E47] pb-3 -mb-px' : 'text-[#505081] hover:text-[#0F0E47] pb-3'"
                            class="transition">Account &amp; Password</button>
                    <button type="button" @click="profileTab = 'history'"
                            :class="profileTab === 'history' ? 'text-[#0F0E47] border-b-2 border-[#0F0E47] pb-3 -mb-px' : 'text-[#505081] hover:text-[#0F0E47] pb-3'"
                            class="transition">Past bookings &amp; Returns</button>
                </div>

                <div x-show="profileTab === 'overview'" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-6 space-y-6">
                        <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 space-y-6 shadow-sm">
                            <h3 class="text-sm font-extrabold text-[#0F0E47]">Profile details</h3>
                            <form action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                @method('patch')
                                <div>
                                    <label class="block text-xs font-semibold text-[#505081] mb-1">Name</label>
                                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-[#505081] mb-1">Email</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-[#505081] mb-1">Photo</label>
                                    <input type="file" name="profile_photo" accept="image/*" class="w-full text-xs text-[#505081] file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#0F0E47] file:text-white hover:file:bg-[#272757]">
                                </div>
                                <button type="submit" class="px-5 py-2.5 bg-[#0F0E47] hover:bg-[#272757] text-white text-xs font-bold rounded-xl transition shadow">
                                    Save changes
                                </button>
                            </form>
                        </div>

                        <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 space-y-6 shadow-sm">
                            <h3 class="text-sm font-extrabold text-[#0F0E47]">Change password</h3>
                            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                                @csrf
                                @method('put')
                                <div>
                                    <label class="block text-xs font-semibold text-[#505081] mb-1">Old password</label>
                                    <input type="password" name="current_password" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-[#505081] mb-1">New password</label>
                                    <input type="password" name="password" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-[#505081] mb-1">Repeat new password</label>
                                    <input type="password" name="password_confirmation" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                                </div>
                                <button type="submit" class="px-5 py-2.5 bg-[#0F0E47] hover:bg-[#272757] text-white text-xs font-bold rounded-xl transition shadow">
                                    Update password
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="lg:col-span-6 space-y-6">
                        <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 space-y-4 shadow-sm">
                            <h3 class="text-sm font-extrabold text-[#0F0E47]">Bookings count</h3>
                            <p class="text-3xl font-extrabold text-[#0F0E47]" x-text="recentReservations.length"></p>
                            <p class="text-xs text-[#505081]">All your room and equipment requests in one place.</p>
                        </div>
                    </div>
                </div>

                <!-- Past Bookings Tab -->
                <div x-show="profileTab === 'history'" class="space-y-6" style="display: none;">
                    <h3 class="text-lg font-extrabold text-[#0F0E47]">All bookings</h3>
                    <p class="text-xs text-[#505081]">Click a booking to cancel a pending request or return approved equipment.</p>
                    <div class="bg-white rounded-3xl border border-[#8686AC]/30 overflow-hidden shadow-xl">
                        <div class="divide-y divide-[#8686AC]/20">
                            <template x-for="item in recentReservations" :key="item.id">
                                <div @click="selectedReservation = item; detailsModalOpen = true;" class="p-5 flex items-center justify-between hover:bg-[#F4F5F7] transition cursor-pointer">
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <h4 class="text-sm font-bold text-[#0F0E47]" x-text="item.resource_name"></h4>
                                            <template x-if="isOverdueEquipment(item)">
                                                <span class="px-2 py-0.5 text-[9px] font-extrabold rounded-full bg-rose-50 text-rose-700 border border-rose-300 uppercase">Return Due</span>
                                            </template>
                                        </div>
                                        <p class="text-xs text-[#505081] mt-0.5" x-text="(item.resource_type || '') + (item.purpose ? ' • ' + item.purpose : '')"></p>
                                        <template x-if="item.rejection_reason">
                                            <p class="text-[11px] text-rose-600 mt-1 italic" x-text="'Note: ' + item.rejection_reason"></p>
                                        </template>
                                    </div>
                                    <div class="flex items-center space-x-6">
                                        <span class="text-xs text-[#272757] font-medium" x-text="item.start_time"></span>
                                        <span class="px-3 py-1 text-[10px] font-bold rounded-full border"
                                              :class="{
                                                  'bg-emerald-50 text-emerald-700 border-emerald-300': ['approved', 'returned'].includes((item.status || '').toLowerCase()),
                                                  'bg-amber-50 text-amber-700 border-amber-300': (item.status || '').toLowerCase() === 'pending',
                                                  'bg-rose-50 text-rose-700 border-rose-300': ['cancelled', 'rejected'].includes((item.status || '').toLowerCase())
                                              }"
                                              x-text="(item.status || '').toUpperCase()"></span>
                                    </div>
                                </div>
                            </template>
                            <template x-if="recentReservations.length === 0">
                                <div class="p-8 text-center text-xs text-[#505081]">No past bookings yet.</div>
                            </template>
                        </div>
                    </div>
                </div>
            </main>

            <!-- VIEW 5: ASK ADMIN (PC-VISIBLE CHAT BAR) -->
            <main x-show="currentView === 'support-chat'" class="p-3 sm:p-5 lg:px-8 lg:py-6 flex flex-col gap-3 sm:gap-4" style="display: none;">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 border-b border-[#8686AC]/30 pb-3 shrink-0">
                    <div class="space-y-0.5">
                        <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block">Office Chat</span>
                        <h2 class="text-xl sm:text-2xl font-extrabold text-[#0F0E47] tracking-tight">Ask admin</h2>
                        <p class="hidden sm:block text-xs text-[#505081]">Send a note to the admin or check return updates.</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-300 shrink-0">
                        Live
                    </span>
                </div>

                <div class="bg-white rounded-3xl border border-[#8686AC]/30 shadow-xl overflow-hidden flex flex-col h-[calc(100vh-14.5rem)] min-h-[340px]">
                    <div id="user-chat-feed" class="flex-1 min-h-0 p-3 sm:p-5 overflow-y-auto space-y-2.5 bg-[#F4F5F7]/50">
                        <template x-for="msg in chatMessages" :key="msg.id">
                            <div>
                                <template x-if="msg.is_system">
                                    <div class="mx-auto max-w-xl my-1.5 px-3.5 py-2 rounded-2xl bg-amber-50 border border-amber-300 text-amber-900 text-xs text-center font-medium">
                                        <span class="font-bold uppercase text-[10px] tracking-wider block mb-0.5">Return Notice</span>
                                        <span x-text="msg.message"></span>
                                    </div>
                                </template>
                                <template x-if="!msg.is_system">
                                    <div class="flex flex-col" :class="msg.sender_id === currentUserId ? 'items-end' : 'items-start'">
                                        <div class="max-w-[85%] sm:max-w-md px-3.5 py-2 sm:py-2.5 rounded-2xl text-xs shadow-sm"
                                             :class="msg.sender_id === currentUserId
                                                 ? 'bg-[#0F0E47] text-white rounded-br-sm'
                                                 : 'bg-white text-[#272757] border border-[#8686AC]/30 rounded-bl-sm'">
                                            <div class="text-[10px] font-bold opacity-75 mb-0.5" x-text="msg.sender?.name || 'User'"></div>
                                            <p class="leading-relaxed whitespace-pre-line" x-text="msg.message"></p>
                                        </div>
                                        <span class="text-[9px] text-[#505081] mt-0.5 px-1"
                                              x-text="msg.created_at ? new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'}) : ''"></span>
                                    </div>
                                </template>
                            </div>
                        </template>
                        <template x-if="chatMessages.length === 0">
                            <div class="h-full flex items-center justify-center text-xs text-[#505081]">
                                No messages yet. Write below to start.
                            </div>
                        </template>
                    </div>

                    <form @submit.prevent="sendMessage()" class="p-2.5 sm:p-3.5 border-t border-[#8686AC]/30 bg-white flex items-center gap-2 shrink-0">
                        <input type="text" x-model="newChatMessage" :disabled="sendingMessage"
                               placeholder="Write a message..."
                               class="flex-1 min-w-0 bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-3.5 py-2 text-xs text-[#272757] focus:outline-none focus:border-[#0F0E47]" required>
                        <button type="submit" :disabled="sendingMessage || !newChatMessage.trim()"
                                class="px-4 sm:px-5 py-2 bg-[#0F0E47] hover:bg-[#272757] disabled:opacity-50 text-white text-xs font-bold rounded-xl transition shadow shrink-0">
                            Send
                        </button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <!-- BOOKING DETAILS MODAL -->
    <div x-show="detailsModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" style="display: none;">
        <div @click.away="detailsModalOpen = false" class="bg-white border border-[#8686AC]/40 w-full max-w-lg rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl relative">
            <div class="flex justify-between items-center border-b border-[#8686AC]/30 pb-4">
                <div>
                    <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest">Booking Info</span>
                    <h3 class="text-lg font-extrabold text-[#0F0E47] mt-0.5" x-text="selectedReservation?.resource_name"></h3>
                </div>
                <button type="button" @click="detailsModalOpen = false" class="text-zinc-400 hover:text-[#0F0E47] font-bold text-lg">&times;</button>
            </div>

            <div class="space-y-4 text-xs">
                <div class="grid grid-cols-2 gap-4 bg-[#F4F5F7] p-4 rounded-2xl border border-[#8686AC]/30">
                    <div>
                        <span class="text-[10px] font-bold text-[#505081] uppercase">Status</span>
                        <p class="font-bold mt-0.5 uppercase"
                           :class="{
                               'text-emerald-700': ['approved', 'returned'].includes((selectedReservation?.status || '').toLowerCase()),
                               'text-amber-700': (selectedReservation?.status || '').toLowerCase() === 'pending',
                               'text-rose-700': ['cancelled', 'rejected'].includes((selectedReservation?.status || '').toLowerCase())
                           }"
                           x-text="selectedReservation?.status"></p>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-[#505081] uppercase">Kind</span>
                        <p class="text-[#272757] font-semibold mt-0.5 capitalize" x-text="selectedReservation?.resource_type"></p>
                    </div>
                </div>

                <div class="bg-[#F4F5F7] p-4 rounded-2xl border border-[#8686AC]/30 space-y-1">
                    <span class="text-[10px] font-bold text-[#505081] uppercase">Schedule</span>
                    <p class="text-[#272757] font-medium" x-text="(selectedReservation?.start_time || '') + ' to ' + (selectedReservation?.end_time || '')"></p>
                </div>

                <template x-if="selectedReservation && isOverdueEquipment(selectedReservation)">
                    <div class="bg-rose-50 border border-rose-300 text-rose-900 p-3.5 rounded-2xl text-[11px] font-semibold">
                        This borrowed item is past its end time. Please return it below.
                    </div>
                </template>

                <div>
                    <span class="text-[10px] font-bold text-[#505081] uppercase">Reason</span>
                    <p class="text-[#272757] bg-[#F4F5F7] p-3 rounded-xl border border-[#8686AC]/30 mt-0.5" x-text="selectedReservation?.purpose"></p>
                </div>

                <template x-if="(selectedReservation?.status || '').toLowerCase() === 'rejected' || selectedReservation?.rejection_reason">
                    <div>
                        <span class="text-[10px] font-bold text-rose-600 uppercase">Declined Note</span>
                        <p class="text-rose-700 bg-rose-50 p-3 rounded-xl border border-rose-200 mt-0.5" x-text="selectedReservation?.rejection_reason || 'No note given.'"></p>
                    </div>
                </template>
            </div>

            <div class="pt-4 border-t border-[#8686AC]/30 flex items-center justify-between gap-3">
                <div class="flex items-center space-x-2">
                    <template x-if="selectedReservation && (selectedReservation.status || '').toLowerCase() === 'pending'">
                        <form :action="'/reservations/' + selectedReservation.id + '/cancel'" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl transition">Cancel request</button>
                        </form>
                    </template>
                    <template x-if="selectedReservation && canReturnApprovedEquipment(selectedReservation)">
                        <form :action="'/reservations/' + selectedReservation.id + '/return'" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition shadow">Mark returned</button>
                        </form>
                    </template>
                </div>
                <button type="button" @click="detailsModalOpen = false"
                        class="px-4 py-2 bg-[#F4F5F7] hover:bg-[#8686AC]/20 text-[#272757] text-xs font-bold rounded-xl transition border border-[#8686AC]/30">
                    Done
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('reservationDashboard', () => {
        const pad = n => String(n).padStart(2, '0');
        const getNowParts = () => {
            const d = new Date();
            return {
                dateISO: `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}`,
                timeHHMM: `${pad(d.getHours())}:${pad(d.getMinutes())}`,
                month: d.getMonth(),
                year: d.getFullYear(),
                day: d.getDate()
            };
        };
        const getFacilityCap = (f) => {
            const val = f?.capacity ?? f?.max_capacity ?? f?.seats ?? f?.pax ?? 0;
            const num = Number(val);
            return Number.isFinite(num) && num > 0 ? num : 0;
        };
        const initialNow = getNowParts();
        const MAX_BOOKING_END = '20:00';
        const MAX_BOOKING_START = '19:59';
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const facilitiesList = @json($facilities ?? []);
        const equipmentList = @json($equipment ?? []);

        return {
            activeTab: 'all',
            searchQuery: '',
            searchDropdownOpen: false,
            currentView: 'overview',
            profileTab: 'overview',
            notificationsOpen: false,
            mobileMenuOpen: false,
            bookingStep: 1,
            formError: '',
            todayISO: initialNow.dateISO,
            currentTimeHHMM: initialNow.timeHHMM,
            availabilityFilterDate: initialNow.dateISO,
            availabilityFilterStart: initialNow.timeHHMM < MAX_BOOKING_START ? initialNow.timeHHMM : '08:00',
            availabilityFilterEnd: MAX_BOOKING_END,
            resourceType: 'facility',
            selectedFacility: facilitiesList[0]?.name || '',
            selectedEquipment: equipmentList[0]?.name || '',
            expectedAttendees: 1,
            equipmentQuantity: 1,
            activeCalendarMonth: initialNow.month,
            activeCalendarYear: initialNow.year,
            currentMonth: initialNow.month,
            currentYear: initialNow.year,
            selectedDay: initialNow.day,
            selectedDate: `${months[initialNow.month]} ${initialNow.day}, ${initialNow.year}`,
            startTime: initialNow.timeHHMM < MAX_BOOKING_START ? initialNow.timeHHMM : '08:00',
            endTime: MAX_BOOKING_END,
            purposeReason: '',
            detailsModalOpen: false,
            selectedReservation: null,
            recentReservations: @json($reservations ?? []),
            rawNotifications: @json($notifications ?? []),
            facilitiesData: facilitiesList,
            equipmentData: equipmentList,
            currentUserId: {{ Auth::id() ?? 'null' }},
            chatMessages: [],
            newChatMessage: '',
            sendingMessage: false,
            pollTimer: null,
            clockTimer: null,
            readStudentAlertIds: [],
            studentAlerts: [],

            get resources() {
                return [
                    ...this.facilitiesData.map(facility => ({
                        id: 'f-' + facility.id,
                        name: facility.name || '',
                        kind: 'facility',
                        category: String(facility.name || '').toLowerCase().includes('lab') ? 'labs' : 'rooms',
                        type: 'Room / Lab',
                        capacityNumber: getFacilityCap(facility),
                        rawStatus: String(facility.status || 'available').toLowerCase(),
                        image: facility.image ? '/' + String(facility.image).replace(/^\/+/, '') : ''
                    })),
                    ...this.equipmentData.map(item => ({
                        id: 'e-' + item.id,
                        name: item.name || '',
                        kind: 'equipment',
                        category: 'equipment',
                        type: 'Equipment',
                        stockNumber: Number(item.total_stock ?? 0),
                        rawStatus: String(item.status || 'available').toLowerCase(),
                        image: item.image ? '/' + String(item.image).replace(/^\/+/, '') : ''
                    }))
                ];
            },

            init() {
                try {
                    const saved = JSON.parse(localStorage.getItem('student_read_alerts') || '[]');
                    this.readStudentAlertIds = Array.isArray(saved) ? saved : [];
                } catch (e) {
                    this.readStudentAlertIds = [];
                }
                this.refreshClock();
                this.syncTimeToNowIfToday();
                this.refreshStudentAlerts();
                this.fetchMessages();
                this.syncLiveDashboardData();

                this.clockTimer = setInterval(() => {
                    this.refreshClock();
                }, 15000);

                this.pollTimer = setInterval(() => {
                    this.fetchMessages();
                    this.refreshStudentAlerts();
                    this.syncLiveDashboardData();
                }, 4000);
            },

            refreshClock() {
                const p = getNowParts();
                this.todayISO = p.dateISO;
                this.currentTimeHHMM = p.timeHHMM;
                this.activeCalendarMonth = p.month;
                this.activeCalendarYear = p.year;
            },

            addMinutesToHHMM(hhmm, minsToAdd) {
                const [h, m] = String(hhmm || '08:00').split(':').map(Number);
                const total = Math.min(20 * 60, (h || 0) * 60 + (m || 0) + minsToAdd);
                return `${pad(Math.floor(total / 60))}:${pad(total % 60)}`;
            },

            syncTimeToNowIfToday() {
                this.refreshClock();
                if (this.formattedDate === this.todayISO && this.startTime < this.currentTimeHHMM) {
                    if (this.currentTimeHHMM < MAX_BOOKING_END) {
                        this.startTime = this.currentTimeHHMM;
                        const suggestedEnd = this.addMinutesToHHMM(this.startTime, 120);
                        this.endTime = suggestedEnd <= MAX_BOOKING_END ? suggestedEnd : MAX_BOOKING_END;
                    }
                }
                if (this.endTime > MAX_BOOKING_END) {
                    this.endTime = MAX_BOOKING_END;
                }
            },

            async syncLiveDashboardData() {
                try {
                    const url = new URL(window.location.href);
                    url.searchParams.set('live_sync', '1');
                    const res = await fetch(url.toString(), {
                        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json, text/html' }
                    });
                    if (!res.ok) return;
                    const ct = res.headers.get('content-type') || '';
                    if (ct.includes('application/json')) {
                        const payload = await res.json();
                        if (Array.isArray(payload.reservations)) this.recentReservations = payload.reservations;
                        if (Array.isArray(payload.facilities)) this.facilitiesData = payload.facilities;
                        if (Array.isArray(payload.equipment)) this.equipmentData = payload.equipment;
                        return;
                    }
                    const html = await res.text();
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    const scripts = Array.from(doc.querySelectorAll('script'));
                    for (const s of scripts) {
                        const txt = s.textContent || '';
                        if (txt.includes('recentReservations:') && txt.includes('facilitiesData:')) {
                            const resMatch = txt.match(/recentReservations:\s*(\[[\s\S]*?\]),\s*rawNotifications:/);
                            const facMatch = txt.match(/facilitiesData:\s*(\[[\s\S]*?\]),\s*equipmentData:/);
                            const eqMatch = txt.match(/equipmentData:\s*(\[[\s\S]*?\]),\s*currentUserId:/);
                            if (resMatch) this.recentReservations = JSON.parse(resMatch[1]);
                            if (facMatch) this.facilitiesData = JSON.parse(facMatch[1]);
                            if (eqMatch) this.equipmentData = JSON.parse(eqMatch[1]);
                            break;
                        }
                    }
                } catch (e) {}
            },

            extractDateISO(dtStr) {
                if (!dtStr) return '';
                const s = String(dtStr).trim();
                const isoMatch = s.match(/(\d{4}-\d{2}-\d{2})/);
                if (isoMatch) return isoMatch[1];
                const parsed = new Date(s);
                if (!Number.isNaN(parsed.getTime())) {
                    return `${parsed.getFullYear()}-${pad(parsed.getMonth() + 1)}-${pad(parsed.getDate())}`;
                }
                return '';
            },

            extractTimeHHMM(dtStr) {
                if (!dtStr) return '';
                const s = String(dtStr).trim();
                const m24 = s.match(/(?:T|\s|^)(\d{1,2}:\d{2})(?::\d{2})?(?:\s*(AM|PM))?$/i);
                if (m24) {
                    let [hh, mm] = m24[1].split(':').map(Number);
                    const mer = (m24[2] || '').toUpperCase();
                    if (mer === 'PM' && hh < 12) hh += 12;
                    if (mer === 'AM' && hh === 12) hh = 0;
                    return `${pad(hh)}:${pad(mm)}`;
                }
                const mAny = s.match(/(\d{2}:\d{2})/);
                return mAny ? mAny[1] : '';
            },

            sameName(a, b) {
                return String(a || '').trim().toLowerCase() === String(b || '').trim().toLowerCase();
            },

            overlapsWindow(booking, dateStr, startHHMM, endHHMM) {
                if (!booking || !dateStr) return false;
                const status = String(booking.status || '').trim().toLowerCase();
                if (['rejected', 'cancelled', 'returned'].includes(status)) return false;
                const bookingDate = this.extractDateISO(booking.start_time) || this.extractDateISO(booking.end_time);
                if (bookingDate !== dateStr) return false;
                const bStart = this.extractTimeHHMM(booking.start_time);
                const bEnd = this.extractTimeHHMM(booking.end_time) || bStart;
                if (!bStart || !startHHMM || !endHHMM) return true;
                return bStart < endHHMM && bEnd > startHHMM;
            },

            getLiveAvailability(item) {
                const dateStr = this.currentView === 'new-reservation' ? this.formattedDate : this.availabilityFilterDate;
                const startHHMM = this.currentView === 'new-reservation' ? this.startTime : this.availabilityFilterStart;
                const endHHMM = this.currentView === 'new-reservation' ? this.endTime : this.availabilityFilterEnd;

                if (['maintenance', 'unavailable'].includes(item.rawStatus)) {
                    return {
                        label: 'MAINTENANCE',
                        badgeClass: 'bg-amber-50 text-amber-800 border-amber-300',
                        detail: item.kind === 'facility'
                            ? `Under maintenance • ${item.capacityNumber > 0 ? 'Max ' + item.capacityNumber + ' people' : 'Capacity not set'}`
                            : `Under maintenance • ${item.stockNumber} units`,
                        bookable: false,
                        disabledText: 'Under maintenance'
                    };
                }

                const overlapping = (this.recentReservations || []).filter(r =>
                    this.sameName(r.resource_name, item.name) &&
                    this.overlapsWindow(r, dateStr, startHHMM, endHHMM)
                );

                if (item.kind === 'facility') {
                    const capText = item.capacityNumber > 0 ? `Up to ${item.capacityNumber} people` : 'Capacity not set';
                    if (overlapping.length > 0) {
                        const slotText = overlapping.map(b =>
                            `${this.extractTimeHHMM(b.start_time)}-${this.extractTimeHHMM(b.end_time)} (${b.status})`
                        ).join(', ');
                        return {
                            label: 'BOOKED',
                            badgeClass: 'bg-rose-50 text-rose-700 border-rose-300',
                            detail: `Booked on ${dateStr}: ${slotText} • ${capText}`,
                            bookable: false,
                            disabledText: 'Already booked'
                        };
                    }
                    return {
                        label: 'AVAILABLE',
                        badgeClass: 'bg-emerald-50 text-emerald-700 border-emerald-300',
                        detail: `Open on ${dateStr} (${startHHMM}-${endHHMM}) • ${capText}`,
                        bookable: true,
                        disabledText: 'Book this'
                    };
                }

                const reservedUnits = overlapping.reduce((sum, b) => sum + Number(b.quantity || 1), 0);
                const leftUnits = Math.max(0, Number(item.stockNumber || 0) - reservedUnits);
                if (leftUnits <= 0) {
                    return {
                        label: 'BOOKED OUT',
                        badgeClass: 'bg-rose-50 text-rose-700 border-rose-300',
                        detail: `0 of ${item.stockNumber} left on ${dateStr} (${startHHMM}-${endHHMM}) • ${reservedUnits} booked`,
                        bookable: false,
                        disabledText: 'None left'
                    };
                }
                return {
                    label: reservedUnits > 0 ? 'LIMITED' : 'AVAILABLE',
                    badgeClass: reservedUnits > 0
                        ? 'bg-sky-50 text-sky-800 border-sky-300'
                        : 'bg-emerald-50 text-emerald-700 border-emerald-300',
                    detail: `${leftUnits} of ${item.stockNumber} left on ${dateStr} (${startHHMM}-${endHHMM})` + (reservedUnits > 0 ? ` • ${reservedUnits} booked` : ''),
                    bookable: true,
                    disabledText: 'Book this'
                };
            },

            parseScheduleDate(dateTimeStr) {
                if (!dateTimeStr) return null;
                const normalized = String(dateTimeStr).trim().replace(' ', 'T');
                const parsed = new Date(normalized);
                return Number.isNaN(parsed.getTime()) ? null : parsed;
            },

            canReturnApprovedEquipment(item) {
                if (!item) return false;
                const isEq = (item.resource_type || '').toLowerCase() === 'equipment';
                const isApproved = (item.status || '').toLowerCase() === 'approved';
                return isEq && isApproved;
            },

            isOverdueEquipment(item) {
                if (!this.canReturnApprovedEquipment(item)) return false;
                const endDt = this.parseScheduleDate(item.end_time) || this.parseScheduleDate(item.start_time);
                if (!endDt) return false;
                return Date.now() > endDt.getTime();
            },

            get overdueEquipmentReservations() {
                return (this.recentReservations || []).filter(r => this.isOverdueEquipment(r));
            },

            refreshStudentAlerts() {
                const alerts = [];
                this.overdueEquipmentReservations.forEach(item => {
                    alerts.push({
                        id: 'return-reminder-' + item.id,
                        type: 'reminder',
                        badge: 'Return Due',
                        title: 'Return ' + item.resource_name,
                        detail: 'End time was ' + (item.end_time || item.start_time) + '. Tap to return it.',
                        reservationId: item.id
                    });
                });

                (this.rawNotifications || []).forEach(n => {
                    alerts.push({
                        id: 'db-notif-' + n.id,
                        type: 'status',
                        badge: 'Update',
                        title: n.data?.title || 'Booking Update',
                        detail: n.data?.message || n.message || 'Your booking status changed.',
                        targetView: 'overview'
                    });
                });

                const latestOtherMsg = [...(this.chatMessages || [])]
                    .reverse()
                    .find(m => !m.is_system && Number(m.sender_id) !== Number(this.currentUserId));
                if (latestOtherMsg) {
                    alerts.push({
                        id: 'chat-reply-' + latestOtherMsg.id,
                        type: 'chat',
                        badge: 'Reply',
                        title: (latestOtherMsg.sender?.name || 'Admin') + ' messaged you',
                        detail: latestOtherMsg.message,
                        targetView: 'support-chat'
                    });
                }

                this.studentAlerts = alerts.slice(0, 12);
            },

            get unreadStudentAlertCount() {
                return this.studentAlerts.filter(a => !this.readStudentAlertIds.includes(a.id)).length;
            },

            markAllStudentAlertsRead() {
                const ids = this.studentAlerts.map(a => a.id);
                this.readStudentAlertIds = Array.from(new Set([...this.readStudentAlertIds, ...ids]));
                try {
                    localStorage.setItem('student_read_alerts', JSON.stringify(this.readStudentAlertIds));
                } catch (e) {}
            },

            handleStudentAlertClick(alert) {
                if (!this.readStudentAlertIds.includes(alert.id)) {
                    this.readStudentAlertIds.push(alert.id);
                    try {
                        localStorage.setItem('student_read_alerts', JSON.stringify(this.readStudentAlertIds));
                    } catch (e) {}
                }
                this.notificationsOpen = false;
                if (alert.reservationId) {
                    const match = (this.recentReservations || []).find(r => r.id === alert.reservationId);
                    if (match) {
                        this.selectedReservation = match;
                        this.detailsModalOpen = true;
                        return;
                    }
                }
                if (alert.targetView) {
                    this.currentView = alert.targetView;
                    if (alert.targetView === 'support-chat') {
                        this.fetchMessages();
                    }
                }
            },

            async fetchMessages() {
                try {
                    const res = await fetch('{{ route('chat.index') }}', {
                        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                    });
                    if (!res.ok) return;
                    const data = await res.json();
                    const prevLen = this.chatMessages.length;
                    this.chatMessages = Array.isArray(data) ? data : [];
                    this.refreshStudentAlerts();
                    if (this.chatMessages.length !== prevLen) {
                        this.$nextTick(() => {
                            const feed = document.getElementById('user-chat-feed');
                            if (feed) feed.scrollTop = feed.scrollHeight;
                        });
                    }
                } catch (e) {
                    console.error('Chat polling error:', e);
                }
            },

            async sendMessage() {
                const text = this.newChatMessage.trim();
                if (!text || this.sendingMessage) return;
                this.sendingMessage = true;
                try {
                    const res = await fetch('{{ route('chat.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ message: text })
                    });
                    if (res.ok) {
                        const created = await res.json();
                        this.chatMessages.push(created);
                        this.newChatMessage = '';
                        this.$nextTick(() => {
                            const feed = document.getElementById('user-chat-feed');
                            if (feed) feed.scrollTop = feed.scrollHeight;
                        });
                    }
                } catch (e) {
                    console.error('Send message error:', e);
                } finally {
                    this.sendingMessage = false;
                }
            },

            get formattedDate() {
                return `${this.currentYear}-${pad(this.currentMonth + 1)}-${pad(this.selectedDay)}`;
            },

            get canGoPrevMonth() {
                return !(this.currentYear === this.activeCalendarYear && this.currentMonth <= this.activeCalendarMonth) && this.currentYear >= this.activeCalendarYear;
            },

            get monthName() {
                return months[this.currentMonth];
            },

            get daysInMonth() {
                return new Date(this.currentYear, this.currentMonth + 1, 0).getDate();
            },

            get firstDayIndex() {
                return new Date(this.currentYear, this.currentMonth, 1).getDay();
            },

            isPastDay(day) {
                const candidateISO = `${this.currentYear}-${pad(this.currentMonth + 1)}-${pad(day)}`;
                return candidateISO < this.todayISO;
            },

            prevMonth() {
                if (!this.canGoPrevMonth) return;
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
                if (this.isPastDay(day)) return;
                this.selectedDay = day;
                this.selectedDate = `${months[this.currentMonth]} ${day}, ${this.currentYear}`;
                this.formError = '';
                this.syncTimeToNowIfToday();
            },

            get currentFacilityCapacity() {
                const fac = this.facilitiesData.find(f => this.sameName(f.name, this.selectedFacility));
                return fac ? getFacilityCap(fac) : 0;
            },

            get currentEquipmentStock() {
                const eq = this.equipmentData.find(e => this.sameName(e.name, this.selectedEquipment));
                return eq && eq.total_stock ? Number(eq.total_stock) : 0;
            },

            get currentAvailableEquipmentStock() {
                const overlapping = (this.recentReservations || []).filter(r =>
                    this.sameName(r.resource_name, this.selectedEquipment) &&
                    this.overlapsWindow(r, this.formattedDate, this.startTime, this.endTime)
                );
                const reserved = overlapping.reduce((sum, b) => sum + Number(b.quantity || 1), 0);
                return Math.max(0, this.currentEquipmentStock - reserved);
            },

            get conflictingBookings() {
                const targetName = this.resourceType === 'facility' ? this.selectedFacility : this.selectedEquipment;
                return (this.recentReservations || []).filter(r =>
                    !['rejected', 'cancelled', 'returned'].includes((r.status || '').toLowerCase()) &&
                    this.sameName(r.resource_name, targetName) &&
                    this.extractDateISO(r.start_time) === this.formattedDate
                );
            },

            get bookedSlotsForDate() {
                return (this.recentReservations || []).filter(r =>
                    this.overlapsWindow(r, this.availabilityFilterDate, this.availabilityFilterStart, this.availabilityFilterEnd)
                );
            },

            get approvalRateText() {
                if (!this.recentReservations.length) return '0%';
                const approvedCount = this.recentReservations.filter(r =>
                    ['approved', 'returned'].includes((r.status || '').toLowerCase())
                ).length;
                return Math.round((approvedCount / this.recentReservations.length) * 100) + '%';
            },

            selectResourceForBooking(item) {
                if (item.kind === 'facility') {
                    this.resourceType = 'facility';
                    this.selectedFacility = item.name;
                } else {
                    this.resourceType = 'equipment';
                    this.selectedEquipment = item.name;
                }
            },

            validateBeforeSubmit(event) {
                this.refreshClock();
                this.formError = '';
                if (this.formattedDate < this.todayISO) {
                    event.preventDefault();
                    this.formError = 'Pick today or a future date.';
                    return;
                }
                if (this.formattedDate === this.todayISO && this.startTime < this.currentTimeHHMM) {
                    event.preventDefault();
                    this.formError = `Start time (${this.startTime}) has already passed today. Current time is ${this.currentTimeHHMM}.`;
                    return;
                }
                if (this.startTime >= MAX_BOOKING_END) {
                    event.preventDefault();
                    this.formError = 'Cannot book starting at or past 8:00 PM (20:00).';
                    return;
                }
                if (this.endTime > MAX_BOOKING_END) {
                    event.preventDefault();
                    this.formError = 'Bookings cannot go past 8:00 PM (20:00).';
                    return;
                }
                if (this.endTime <= this.startTime) {
                    event.preventDefault();
                    this.formError = 'End time needs to be after start time.';
                    return;
                }
                if (this.resourceType === 'facility' && this.currentFacilityCapacity > 0 && Number(this.expectedAttendees) > this.currentFacilityCapacity) {
                    event.preventDefault();
                    this.formError = `Too many people for this room (max ${this.currentFacilityCapacity}).`;
                    return;
                }
                if (this.resourceType === 'equipment') {
                    if (this.currentAvailableEquipmentStock <= 0) {
                        event.preventDefault();
                        this.formError = 'No units left for this date and time slot.';
                        return;
                    }
                    if (Number(this.equipmentQuantity) > this.currentAvailableEquipmentStock) {
                        event.preventDefault();
                        this.formError = `Only ${this.currentAvailableEquipmentStock} unit(s) available for this time slot.`;
                        return;
                    }
                }
            },

            get quickSearchResults() {
                const q = this.searchQuery.trim().toLowerCase();
                if (!q) return [];
                return this.resources
                    .filter(item => item.name.toLowerCase().includes(q) || item.type.toLowerCase().includes(q))
                    .slice(0, 6);
            },

            pickSearchResult(item) {
                this.selectResourceForBooking(item);
                this.searchDropdownOpen = false;
                this.mobileMenuOpen = false;
                this.currentView = 'new-reservation';
                this.bookingStep = 1;
                this.syncTimeToNowIfToday();
            },

            submitTopSearch() {
                this.searchDropdownOpen = false;
                this.mobileMenuOpen = false;
                this.activeTab = 'all';
                this.currentView = 'availability-calendar';
            },

            get filteredResources() {
                const q = this.searchQuery.trim().toLowerCase();
                return this.resources.filter(item => {
                    const matchesCategory = this.activeTab === 'all' || item.category === this.activeTab;
                    const matchesSearch = !q || item.name.toLowerCase().includes(q) || item.type.toLowerCase().includes(q);
                    return matchesCategory && matchesSearch;
                });
            }
        };
    });
});
</script>
</x-app-layout>