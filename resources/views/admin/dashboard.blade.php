<x-app-layout>
<div class="h-screen bg-[#F4F5F7] text-[#272757] font-['Inter',sans-serif] flex overflow-hidden" x-data="adminDashboard()" x-init="init()">
    <!-- Mobile Sidebar Backdrop -->
    <div x-show="mobileMenuOpen"
         @click="mobileMenuOpen = false"
         class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm md:hidden"
         style="display: none;"></div>

    <!-- Admin Sidebar -->
    <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
           class="fixed inset-y-0 left-0 z-50 w-64 shrink-0 border-r border-[#8686AC]/30 bg-white h-full p-6 flex flex-col justify-between transform transition-transform duration-300 ease-in-out md:static md:z-40 shadow-2xl md:shadow-sm overflow-y-auto">
        <div class="space-y-8">
            <div class="flex items-center justify-between px-2 pt-2">
                <span class="text-[10px] font-bold text-rose-600 uppercase tracking-widest block">Admin</span>
                <button type="button"
                        @click="mobileMenuOpen = false"
                        class="md:hidden text-[#505081] hover:text-[#0F0E47] font-bold text-lg leading-none"
                        aria-label="Close menu">&times;</button>
            </div>

            <div class="space-y-6">
                <nav class="space-y-1">
                    <button type="button" @click.prevent="currentView = 'bookings'; mobileMenuOpen = false; syncAdminReservations();"
                            :class="currentView === 'bookings' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                            class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        <span>Bookings</span>
                    </button>

                    <button type="button" @click.prevent="currentView = 'inventory'; mobileMenuOpen = false;"
                            :class="currentView === 'inventory' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                            class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        <span>Rooms &amp; Gear</span>
                    </button>

                    <button type="button" @click.prevent="currentView = 'users'; mobileMenuOpen = false;"
                            :class="currentView === 'users' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                            class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span>People</span>
                    </button>

                    <button type="button" @click.prevent="currentView = 'messages'; mobileMenuOpen = false; fetchThreads(); fetchAdminMessages();"
                            :class="currentView === 'messages' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                            class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                            <span>Messages</span>
                        </div>
                        <template x-if="unreadChatCount > 0">
                            <span class="px-1.5 py-0.5 text-[10px] font-extrabold rounded-full bg-rose-600 text-white" x-text="unreadChatCount"></span>
                        </template>
                    </button>

                    <button type="button" @click.prevent="currentView = 'reports'; mobileMenuOpen = false;"
                            :class="currentView === 'reports' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                            class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Logs &amp; PDF</span>
                    </button>
                </nav>
            </div>
        </div>

        <!-- Admin Profile Footer -->
        <div class="pt-6 border-t border-[#8686AC]/30 flex items-center justify-between gap-2">
            <button type="button"
                    @click="adminProfileModalOpen = true; mobileMenuOpen = false;"
                    title="Change admin profile photo"
                    class="flex items-center space-x-3 min-w-0 text-left group">
                <div class="w-8 h-8 shrink-0 rounded-xl bg-[#0F0E47] text-white flex items-center justify-center font-bold text-xs overflow-hidden border border-[#8686AC]/40">
                    @if(Auth::user()->avatar_url ?? false)
                        <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name ?? 'Admin' }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}
                    @endif
                </div>
                <div class="overflow-hidden">
                    <span class="font-bold text-xs text-[#0F0E47] group-hover:underline truncate block">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <span class="text-[10px] text-rose-600 truncate block font-bold">Edit photo</span>
                </div>
            </button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" title="Log out" class="text-[#505081] hover:text-rose-600 transition shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col h-full min-w-0 overflow-hidden">
        <header class="h-20 shrink-0 border-b border-[#8686AC]/30 bg-white/80 backdrop-blur-md px-4 sm:px-6 lg:px-10 flex items-center justify-between gap-3 z-30 shadow-sm">
            <div class="flex items-center space-x-3 min-w-0">
                <button type="button"
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden w-10 h-10 rounded-xl bg-[#F4F5F7] hover:bg-[#8686AC]/20 border border-[#8686AC]/30 text-[#272757] flex items-center justify-center transition focus:outline-none shrink-0"
                        aria-label="Toggle navigation menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div class="flex items-center space-x-2.5 truncate">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse shrink-0"></span>
                    <span class="text-xs font-bold text-[#0F0E47] truncate">Connected</span>
                </div>
            </div>

            <div class="flex items-center space-x-3 sm:space-x-4 shrink-0">
                <button type="button"
                        @click="adminProfileModalOpen = true"
                        class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#F4F5F7] hover:bg-[#8686AC]/20 border border-[#8686AC]/30 text-xs font-bold text-[#0F0E47] transition">
                    <span class="w-5 h-5 rounded-full overflow-hidden bg-[#0F0E47] text-white flex items-center justify-center text-[9px]">
                        @if(Auth::user()->avatar_url ?? false)
                            <img src="{{ Auth::user()->avatar_url }}" alt="Admin" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                        @endif
                    </span>
                    <span>Admin Desk</span>
                </button>

                <!-- Notification Bell -->
                <div class="relative" @click.away="notificationsOpen = false">
                    <button type="button"
                            @click="notificationsOpen = !notificationsOpen; if (notificationsOpen) refreshAdminAlerts();"
                            class="w-10 h-10 rounded-xl bg-[#F4F5F7] hover:bg-[#8686AC]/20 border border-[#8686AC]/30 text-[#272757] flex items-center justify-center transition relative"
                            aria-label="Notifications">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0.538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <template x-if="unreadAlertCount > 0">
                            <span class="absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1 rounded-full bg-rose-600 text-white text-[10px] font-extrabold flex items-center justify-center shadow"
                                  x-text="unreadAlertCount"></span>
                        </template>
                    </button>

                    <div x-show="notificationsOpen"
                         class="fixed sm:absolute right-3 sm:right-0 left-3 sm:left-auto top-20 sm:top-auto mt-1 sm:mt-3 sm:w-88 bg-white border border-[#8686AC]/40 rounded-2xl shadow-2xl p-4 space-y-3 z-50"
                         style="display: none;">
                        <div class="flex items-center justify-between pb-2 border-b border-[#8686AC]/30">
                            <span class="text-xs font-bold text-[#0F0E47]">Alerts</span>
                            <button type="button"
                                    @click="markAllAlertsRead()"
                                    class="text-[10px] font-bold text-[#505081] hover:text-[#0F0E47] underline">
                                Clear unread
                            </button>
                        </div>
                        <div class="space-y-2 max-h-72 overflow-y-auto rounded-xl bg-[#F4F5F7] p-1.5">
                            <template x-for="alert in adminAlerts" :key="alert.id">
                                <button type="button"
                                        @click="handleAlertClick(alert)"
                                        class="w-full text-left p-2.5 rounded-xl bg-white hover:bg-[#F4F5F7]/80 border border-[#8686AC]/30 transition space-y-1 block">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="text-[11px] font-bold text-[#0F0E47] truncate" x-text="alert.title"></span>
                                        <span class="px-1.5 py-0.5 text-[9px] font-bold rounded uppercase shrink-0"
                                              :class="alert.type === 'return'
                                                  ? 'bg-sky-50 text-sky-800 border border-sky-300'
                                                  : (alert.type === 'booking'
                                                      ? 'bg-amber-50 text-amber-800 border border-amber-300'
                                                      : 'bg-emerald-50 text-emerald-800 border border-emerald-300')"
                                              x-text="alert.badge"></span>
                                    </div>
                                    <p class="text-[11px] text-[#505081] leading-snug" x-text="alert.detail"></p>
                                </button>
                            </template>
                            <template x-if="adminAlerts.length === 0">
                                <p class="text-xs text-center text-[#505081] py-5">Nothing new right now.</p>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto">
            @if(session('success'))
                <div class="mx-4 sm:mx-6 lg:mx-10 mt-6 bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-2xl text-xs font-bold">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mx-4 sm:mx-6 lg:mx-10 mt-6 bg-rose-50 border border-rose-300 text-rose-800 px-4 py-3 rounded-2xl text-xs font-bold space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- VIEW 1: BOOKINGS -->
            <main x-show="currentView === 'bookings'" class="p-4 sm:p-6 lg:p-10 space-y-8">
                <div class="bg-white backdrop-blur-xl p-5 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-4">
                    <h2 class="text-xl sm:text-2xl font-extrabold text-[#0F0E47]">Bookings</h2>
                    <p class="text-xs text-[#505081]">Tap a box to filter requests. Returned equipment and rooms are marked RETURNED.</p>

                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 sm:gap-4 pt-2">
                        <div @click="filterStatus = 'all'"
                             :class="filterStatus === 'all' ? 'border-[#0F0E47] bg-[#F4F5F7]' : 'border-[#8686AC]/30 bg-white'"
                             class="p-4 rounded-2xl border cursor-pointer transition shadow-sm">
                            <span class="text-[10px] font-bold text-[#505081] uppercase">All</span>
                            <p class="text-2xl font-extrabold text-[#0F0E47] mt-1" x-text="reservations.length">0</p>
                        </div>

                        <div @click="filterStatus = 'pending'"
                             :class="filterStatus === 'pending' ? 'border-amber-500 bg-amber-50/50' : 'border-[#8686AC]/30 bg-white'"
                             class="p-4 rounded-2xl border cursor-pointer transition shadow-sm">
                            <span class="text-[10px] font-bold text-amber-600 uppercase">Waiting</span>
                            <p class="text-2xl font-extrabold text-amber-700 mt-1" x-text="reservations.filter(r => (r.status || '').toLowerCase() === 'pending').length">0</p>
                        </div>

                        <div @click="filterStatus = 'approved'"
                             :class="filterStatus === 'approved' ? 'border-emerald-500 bg-emerald-50/50' : 'border-[#8686AC]/30 bg-white'"
                             class="p-4 rounded-2xl border cursor-pointer transition shadow-sm">
                            <span class="text-[10px] font-bold text-emerald-600 uppercase">Approved</span>
                            <p class="text-2xl font-extrabold text-emerald-700 mt-1" x-text="reservations.filter(r => (r.status || '').toLowerCase() === 'approved').length">0</p>
                        </div>

                        <div @click="filterStatus = 'returned'"
                             :class="filterStatus === 'returned' ? 'border-sky-500 bg-sky-50/50' : 'border-[#8686AC]/30 bg-white'"
                             class="p-4 rounded-2xl border cursor-pointer transition shadow-sm">
                            <span class="text-[10px] font-bold text-sky-600 uppercase">Returned</span>
                            <p class="text-2xl font-extrabold text-sky-700 mt-1" x-text="reservations.filter(r => (r.status || '').toLowerCase() === 'returned').length">0</p>
                        </div>

                        <div @click="filterStatus = 'rejected'"
                             :class="filterStatus === 'rejected' ? 'border-rose-500 bg-rose-50/50' : 'border-[#8686AC]/30 bg-white'"
                             class="p-4 rounded-2xl border cursor-pointer transition shadow-sm col-span-2 sm:col-span-1">
                            <span class="text-[10px] font-bold text-rose-600 uppercase">Declined / Cancelled</span>
                            <p class="text-2xl font-extrabold text-rose-700 mt-1" x-text="reservations.filter(r => ['rejected', 'cancelled'].includes((r.status || '').toLowerCase())).length">0</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white backdrop-blur-xl rounded-3xl border border-[#8686AC]/30 overflow-hidden shadow-xl">
                    <div class="p-5 sm:p-6 border-b border-[#8686AC]/30 flex justify-between items-center">
                        <h3 class="text-sm font-extrabold text-[#0F0E47]">Requests</h3>
                        <span class="text-xs font-bold text-[#505081]" x-text="filterStatus.toUpperCase()"></span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[640px]">
                            <thead>
                                <tr class="border-b border-[#8686AC]/30 text-[10px] font-bold text-[#505081] uppercase tracking-wider bg-[#F4F5F7]">
                                    <th class="py-4 px-5">Student / Faculty</th>
                                    <th class="py-4 px-5">Item / Room</th>
                                    <th class="py-4 px-5">When</th>
                                    <th class="py-4 px-5">Status</th>
                                    <th class="py-4 px-5 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#8686AC]/20 text-xs">
                                <template x-for="item in filteredReservations" :key="item.id">
                                    <tr class="hover:bg-[#F4F5F7]/80 transition">
                                        <td class="py-4 px-5">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 flex items-center justify-center text-[#0F0E47] overflow-hidden rounded-full bg-[#F4F5F7] border border-[#8686AC]/40 font-bold text-[10px] shrink-0">
                                                    <template x-if="getUserAvatar(item.user)">
                                                        <img :src="getUserAvatar(item.user)" :alt="item.user?.name || 'User'" class="w-full h-full object-cover">
                                                    </template>
                                                    <template x-if="!getUserAvatar(item.user)">
                                                        <span x-text="initials(item.user?.name || 'U')"></span>
                                                    </template>
                                                </div>
                                                <div class="min-w-0">
                                                    <span class="font-bold text-[#0F0E47] block truncate" x-text="item.user?.name || 'User'"></span>
                                                    <span class="text-[10px] text-[#505081] block truncate" x-text="item.purpose"></span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="py-4 px-5">
                                            <span class="font-bold text-[#0F0E47] block" x-text="item.resource_name"></span>
                                            <span class="text-[10px] text-[#505081]" x-text="(item.resource_type || '') + ' (' + (item.quantity || 1) + ')'"></span>
                                        </td>

                                        <td class="py-4 px-5 text-[#272757] font-medium" x-text="(item.start_time || '') + ' to ' + (item.end_time || '')"></td>

                                        <td class="py-4 px-5">
                                            <span class="px-2.5 py-1 text-[9px] font-bold rounded-full border uppercase inline-block"
                                                  :class="{
                                                      'bg-sky-50 text-sky-700 border-sky-300': (item.status || '').toLowerCase() === 'returned',
                                                      'bg-emerald-50 text-emerald-700 border-emerald-300': (item.status || '').toLowerCase() === 'approved',
                                                      'bg-amber-50 text-amber-700 border-amber-300': (item.status || '').toLowerCase() === 'pending',
                                                      'bg-rose-50 text-rose-700 border-rose-300': ['rejected', 'cancelled'].includes((item.status || '').toLowerCase())
                                                  }"
                                                  x-text="item.status"></span>
                                            <template x-if="item.rejection_reason">
                                                <p class="text-[10px] text-rose-600 mt-1 italic" x-text="'Note: ' + item.rejection_reason"></p>
                                            </template>
                                        </td>

                                        <td class="py-4 px-5 text-right">
                                            <template x-if="(item.status || '').toLowerCase() === 'pending'">
                                                <div class="flex items-center justify-end space-x-2">
                                                    <form :action="'/admin/reservations/' + item.id + '/approve'" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1.5 bg-emerald-700 text-white rounded-xl font-bold text-[11px] hover:bg-emerald-800 transition">Approve</button>
                                                    </form>
                                                    <button type="button"
                                                            @click="openRejectModal(item.id)"
                                                            class="px-3 py-1.5 bg-rose-600 text-white rounded-xl font-bold text-[11px] hover:bg-rose-700 transition">Decline</button>
                                                </div>
                                            </template>
                                            <template x-if="(item.status || '').toLowerCase() !== 'pending'">
                                                <span class="font-bold text-[11px]"
                                                      :class="(item.status || '').toLowerCase() === 'returned' ? 'text-sky-700' : 'text-[#505081]'"
                                                      x-text="(item.status || '').toUpperCase()"></span>
                                            </template>
                                        </td>
                                    </tr>
                                </template>
                                <template x-if="filteredReservations.length === 0">
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-[#505081] text-xs">Nothing here yet.</td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>

            <!-- VIEW 2: ROOMS & GEAR -->
            <main x-show="currentView === 'inventory'" class="p-4 sm:p-6 lg:p-10 space-y-8" style="display: none;">
                <div class="bg-white p-5 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-2">
                    <h2 class="text-xl sm:text-2xl font-extrabold text-[#0F0E47]">Rooms &amp; Gear</h2>
                    <p class="text-xs text-[#505081]">Add, edit, or remove rooms and equipment counts.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                    <div class="bg-white p-5 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-4">
                        <h3 class="text-sm font-extrabold text-[#0F0E47]">New room or lab</h3>
                        <form action="{{ route('admin.facilities.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-semibold text-[#505081] mb-1">Room name</label>
                                <input type="text" name="name" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-[#505081] mb-1">Max people</label>
                                <input type="number" name="capacity" min="1" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-[#505081] mb-1">Status</label>
                                <select name="status" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]">
                                    <option value="available">Available</option>
                                    <option value="maintenance">Maintenance</option>
                                </select>
                            </div>
                            <button type="submit" class="px-5 py-2.5 bg-[#0F0E47] hover:bg-[#272757] text-white text-xs font-bold rounded-xl transition shadow">Add room</button>
                        </form>
                    </div>

                    <div class="bg-white p-5 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-4">
                        <h3 class="text-sm font-extrabold text-[#0F0E47]">New equipment</h3>
                        <form action="{{ route('admin.equipment.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-semibold text-[#505081] mb-1">Item name</label>
                                <input type="text" name="name" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-[#505081] mb-1">How many units</label>
                                <input type="number" name="total_stock" min="1" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-[#505081] mb-1">Status</label>
                                <select name="status" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]">
                                    <option value="available">Available</option>
                                    <option value="unavailable">Unavailable</option>
                                </select>
                            </div>
                            <button type="submit" class="px-5 py-2.5 bg-[#0F0E47] hover:bg-[#272757] text-white text-xs font-bold rounded-xl transition shadow">Add item</button>
                        </form>
                    </div>
                </div>

                <div class="bg-white backdrop-blur-xl rounded-3xl border border-[#8686AC]/30 overflow-hidden shadow-xl p-5 sm:p-6 space-y-4">
                    <h3 class="text-base font-extrabold text-[#0F0E47]">Rooms &amp; Labs</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs min-w-[480px]">
                            <thead>
                                <tr class="border-b border-[#8686AC]/30 text-[10px] font-bold text-[#505081] uppercase bg-[#F4F5F7]">
                                    <th class="py-3 px-4">Name</th>
                                    <th class="py-3 px-4">Limit</th>
                                    <th class="py-3 px-4">Status</th>
                                    <th class="py-3 px-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#8686AC]/20">
                                <template x-for="fac in facilities" :key="fac.id">
                                    <tr class="hover:bg-[#F4F5F7]/50">
                                        <td class="py-3 px-4 font-bold text-[#0F0E47]" x-text="fac.name"></td>
                                        <td class="py-3 px-4" x-text="(fac.capacity ?? 0) + ' people'"></td>
                                        <td class="py-3 px-4 uppercase font-semibold" x-text="fac.status"></td>
                                        <td class="py-3 px-4 text-right space-x-2 whitespace-nowrap">
                                            <button type="button"
                                                    @click="openEditFacility(fac)"
                                                    class="px-3 py-1 bg-sky-50 text-sky-700 border border-sky-300 rounded-lg font-bold hover:bg-sky-100">Edit</button>
                                            <form :action="'/admin/facilities/' + fac.id" method="POST" class="inline" onsubmit="return confirm('Remove this room?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-700 border border-rose-300 rounded-lg font-bold hover:bg-rose-100">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white backdrop-blur-xl rounded-3xl border border-[#8686AC]/30 overflow-hidden shadow-xl p-5 sm:p-6 space-y-4">
                    <h3 class="text-base font-extrabold text-[#0F0E47]">Equipment</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs min-w-[480px]">
                            <thead>
                                <tr class="border-b border-[#8686AC]/30 text-[10px] font-bold text-[#505081] uppercase bg-[#F4F5F7]">
                                    <th class="py-3 px-4">Name</th>
                                    <th class="py-3 px-4">Count</th>
                                    <th class="py-3 px-4">Status</th>
                                    <th class="py-3 px-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#8686AC]/20">
                                <template x-for="eq in equipment" :key="eq.id">
                                    <tr class="hover:bg-[#F4F5F7]/50">
                                        <td class="py-3 px-4 font-bold text-[#0F0E47]" x-text="eq.name"></td>
                                        <td class="py-3 px-4" x-text="(eq.total_stock ?? 0) + ' units'"></td>
                                        <td class="py-3 px-4 uppercase font-semibold" x-text="eq.status"></td>
                                        <td class="py-3 px-4 text-right space-x-2 whitespace-nowrap">
                                            <button type="button"
                                                    @click="openEditEquipment(eq)"
                                                    class="px-3 py-1 bg-sky-50 text-sky-700 border border-sky-300 rounded-lg font-bold hover:bg-sky-100">Edit</button>
                                            <form :action="'/admin/equipment/' + eq.id" method="POST" class="inline" onsubmit="return confirm('Remove this item?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-700 border border-rose-300 rounded-lg font-bold hover:bg-rose-100">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>

            <!-- VIEW 3: PEOPLE -->
            <main x-show="currentView === 'users'" class="p-4 sm:p-6 lg:p-10 space-y-8" style="display: none;">
                <div class="bg-white p-5 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-6">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-extrabold text-[#0F0E47]">People</h2>
                        <p class="text-xs text-[#505081]">View user photos or deactivate and reactivate student and faculty accounts.</p>
                    </div>

                    <div class="divide-y divide-[#8686AC]/20">
                        <template x-for="user in users" :key="user.id">
                            <div class="py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div class="flex items-center space-x-3.5 min-w-0">
                                    <button type="button"
                                            @click="if (getUserAvatar(user)) { previewPhotoUrl = getUserAvatar(user); previewPhotoTitle = user.name; }"
                                            class="w-11 h-11 rounded-2xl bg-[#F4F5F7] border border-[#8686AC]/40 flex items-center justify-center font-extrabold text-xs text-[#0F0E47] overflow-hidden shrink-0">
                                        <template x-if="getUserAvatar(user)">
                                            <img :src="getUserAvatar(user)" :alt="user.name" class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!getUserAvatar(user)">
                                            <span x-text="initials(user.name)"></span>
                                        </template>
                                    </button>
                                    <div class="space-y-1 min-w-0">
                                        <div class="flex items-center space-x-2.5 flex-wrap">
                                            <h4 class="text-sm font-bold text-[#0F0E47] truncate" x-text="user.name"></h4>
                                            <span class="px-2 py-0.5 text-[9px] font-bold rounded uppercase shrink-0"
                                                  :class="user.is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700'"
                                                  x-text="user.is_active ? 'Active' : 'Inactive'"></span>
                                        </div>
                                        <p class="text-xs text-[#505081] truncate" x-text="user.email + ' • ' + (user.role || 'user')"></p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3 shrink-0">
                                    <form :action="'/admin/users/' + user.id + '/toggle-status'" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="px-4 py-2 rounded-xl text-xs font-bold transition border shadow-sm"
                                                :class="user.is_active ? 'bg-rose-50 text-rose-700 border-rose-300 hover:bg-rose-100' : 'bg-emerald-50 text-emerald-700 border-emerald-300 hover:bg-emerald-100'"
                                                x-text="user.is_active ? 'Deactivate' : 'Reactivate'"></button>
                                    </form>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </main>

            <!-- VIEW 4: MESSAGES -->
            <main x-show="currentView === 'messages'" class="p-3 sm:p-5 lg:px-8 lg:py-6 flex flex-col gap-3 sm:gap-4" style="display: none;">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 border-b border-[#8686AC]/30 pb-3 shrink-0">
                    <div class="space-y-0.5">
                        <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block">Chats</span>
                        <h2 class="text-xl sm:text-2xl font-extrabold text-[#0F0E47] tracking-tight">Messages</h2>
                        <p class="hidden sm:block text-xs text-[#505081]">Reply to students or check return notes.</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-300 shrink-0">
                        Live
                    </span>
                </div>

                <div class="h-[calc(100vh-14.5rem)] min-h-[340px] grid grid-cols-1 lg:grid-cols-12 bg-white rounded-3xl border border-[#8686AC]/30 shadow-xl overflow-hidden">
                    <div class="lg:col-span-4 border-b lg:border-b-0 lg:border-r border-[#8686AC]/30 max-h-28 sm:max-h-36 lg:max-h-full overflow-y-auto divide-y divide-[#8686AC]/20 bg-[#F4F5F7]/40 shrink-0">
                        <template x-for="thread in threads" :key="thread.id">
                            <button type="button"
                                    @click="selectThread(thread.id)"
                                    :class="activeThreadUserId === thread.id ? 'bg-[#0F0E47] text-white' : 'hover:bg-white text-[#272757]'"
                                    class="w-full px-3.5 py-2 sm:p-4 text-left transition flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full border border-[#8686AC]/30 bg-white text-[#0F0E47] flex items-center justify-center font-bold text-[10px] overflow-hidden shrink-0">
                                    <template x-if="getThreadAvatar(thread)">
                                        <img :src="getThreadAvatar(thread)" :alt="thread.name" class="w-full h-full object-cover">
                                    </template>
                                    <template x-if="!getThreadAvatar(thread)">
                                        <span x-text="initials(thread.name)"></span>
                                    </template>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="text-xs font-bold truncate" x-text="thread.name"></span>
                                        <span class="text-[9px] opacity-75 shrink-0" x-text="thread.last_time || ''"></span>
                                    </div>
                                    <p class="text-[11px] truncate opacity-80" x-text="thread.last_message || 'No messages yet'"></p>
                                </div>
                            </button>
                        </template>
                        <template x-if="threads.length === 0">
                            <div class="p-3 text-xs text-center text-[#505081]">No chats yet.</div>
                        </template>
                    </div>

                    <div class="lg:col-span-8 flex-1 flex flex-col min-h-0">
                        <div class="px-4 py-2 sm:px-6 sm:py-3 border-b border-[#8686AC]/30 bg-white flex items-center justify-between shrink-0">
                            <div class="flex items-center gap-3 min-w-0">
                                <template x-if="selectedThread">
                                    <div class="w-8 h-8 rounded-full border border-[#8686AC]/30 bg-[#F4F5F7] text-[#0F0E47] flex items-center justify-center font-bold text-[10px] overflow-hidden shrink-0">
                                        <template x-if="getThreadAvatar(selectedThread)">
                                            <img :src="getThreadAvatar(selectedThread)" :alt="selectedThread.name" class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!getThreadAvatar(selectedThread)">
                                            <span x-text="initials(selectedThread.name)"></span>
                                        </template>
                                    </div>
                                </template>
                                <div class="min-w-0">
                                    <h3 class="text-xs sm:text-sm font-extrabold text-[#0F0E47] truncate" x-text="selectedThread?.name || 'Pick a chat'"></h3>
                                    <p class="hidden sm:block text-[10px] text-[#505081] truncate" x-text="selectedThread?.email || ''"></p>
                                </div>
                            </div>
                        </div>

                        <div id="admin-chat-feed" class="flex-1 min-h-0 p-3 sm:p-5 overflow-y-auto space-y-2.5 bg-[#F4F5F7]/50">
                            <template x-for="msg in threadMessages" :key="msg.id">
                                <div>
                                    <template x-if="msg.is_system">
                                        <div class="mx-auto max-w-xl my-1.5 px-3.5 py-2 rounded-2xl bg-sky-50 border border-sky-300 text-sky-900 text-xs text-center font-medium">
                                            <span class="font-bold uppercase text-[10px] tracking-wider block mb-0.5">Return Notice</span>
                                            <span x-text="msg.message"></span>
                                        </div>
                                    </template>
                                    <template x-if="!msg.is_system">
                                        <div class="flex items-end gap-2" :class="msg.sender_id === currentUserId ? 'justify-end' : 'justify-start'">
                                            <template x-if="msg.sender_id !== currentUserId">
                                                <div class="w-7 h-7 rounded-full border border-[#8686AC]/30 bg-white text-[#0F0E47] flex items-center justify-center font-bold text-[9px] overflow-hidden shrink-0">
                                                    <template x-if="getUserAvatar(msg.sender) || getThreadAvatar(selectedThread)">
                                                        <img :src="getUserAvatar(msg.sender) || getThreadAvatar(selectedThread)" :alt="msg.sender?.name || 'User'" class="w-full h-full object-cover">
                                                    </template>
                                                    <template x-if="!(getUserAvatar(msg.sender) || getThreadAvatar(selectedThread))">
                                                        <span x-text="initials(msg.sender?.name || 'U')"></span>
                                                    </template>
                                                </div>
                                            </template>
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
                                        </div>
                                    </template>
                                </div>
                            </template>
                            <template x-if="!activeThreadUserId">
                                <div class="h-full flex items-center justify-center text-xs text-[#505081]">
                                    Pick someone on the left to open their chat.
                                </div>
                            </template>
                        </div>

                        <form @submit.prevent="sendAdminMessage()" class="p-2.5 sm:p-3.5 border-t border-[#8686AC]/30 bg-white flex items-center gap-2 shrink-0">
                            <input type="text" x-model="newAdminMessage" :disabled="!activeThreadUserId || sendingMessage"
                                   placeholder="Write a reply..."
                                   class="flex-1 min-w-0 bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-3.5 py-2 text-xs text-[#272757] focus:outline-none focus:border-[#0F0E47]">
                            <button type="submit" :disabled="!activeThreadUserId || sendingMessage || !newAdminMessage.trim()"
                                    class="px-4 sm:px-5 py-2 bg-[#0F0E47] hover:bg-[#272757] disabled:opacity-50 text-white text-xs font-bold rounded-xl transition shadow shrink-0">
                                Send
                            </button>
                        </form>
                    </div>
                </div>
            </main>

            <!-- VIEW 5: LOGS & PDF -->
            <main x-show="currentView === 'reports'" class="p-4 sm:p-6 lg:p-10 space-y-8" style="display: none;">
                <div class="bg-white p-5 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                        <div>
                            <h2 class="text-xl sm:text-2xl font-extrabold text-[#0F0E47]">Logs &amp; PDF</h2>
                            <p class="text-xs text-[#505081]">Download a PDF copy of all booking records.</p>
                        </div>
                        <a href="{{ route('admin.reports.pdf') }}"
                           class="px-5 py-2.5 bg-[#0F0E47] text-white text-xs font-bold rounded-xl shadow-lg hover:bg-[#272757] transition">Download PDF</a>
                    </div>
                    <div class="bg-[#F4F5F7] p-4 rounded-2xl border border-[#8686AC]/30 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-bold text-[#505081] uppercase">Total records</span>
                            <p class="text-xl font-extrabold text-[#0F0E47]" x-text="reservations.length"></p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- ADMIN PROFILE MODAL -->
    <div x-show="adminProfileModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" style="display: none;">
        <div @click.away="adminProfileModalOpen = false" class="bg-white border border-[#8686AC]/40 w-full max-w-md rounded-3xl p-5 sm:p-8 space-y-6 shadow-2xl relative">
            <div class="flex justify-between items-center border-b border-[#8686AC]/30 pb-4">
                <h3 class="text-lg font-extrabold text-[#0F0E47]">Admin profile</h3>
                <button type="button" @click="adminProfileModalOpen = false" class="text-zinc-400 hover:text-[#0F0E47] font-bold text-lg">&times;</button>
            </div>
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-[#F4F5F7] border border-[#8686AC]/40 flex items-center justify-center font-extrabold text-base text-[#0F0E47] overflow-hidden shrink-0">
                        <template x-if="adminPhotoPreview">
                            <img :src="adminPhotoPreview" alt="Preview" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!adminPhotoPreview">
                            <span>{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}</span>
                        </template>
                    </div>
                    <div class="flex-1 min-w-0">
                        <label class="block text-xs font-semibold text-[#505081] mb-1">Profile photo</label>
                        <input type="file" name="profile_photo" accept="image/png,image/jpeg,image/webp" @change="previewAdminPhoto($event)"
                               class="w-full text-xs text-[#505081] file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#0F0E47] file:text-white hover:file:bg-[#272757]">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#505081] mb-1">Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#505081] mb-1">Email</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                </div>
                <div class="flex justify-end space-x-3 pt-2">
                    <button type="button" @click="adminProfileModalOpen = false" class="px-4 py-2 bg-[#F4F5F7] text-[#272757] text-xs font-bold rounded-xl border border-[#8686AC]/30">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-[#0F0E47] hover:bg-[#272757] text-white text-xs font-bold rounded-xl transition shadow">Save profile</button>
                </div>
            </form>
        </div>
    </div>

    <!-- PHOTO LIGHTBOX -->
    <div x-show="previewPhotoUrl" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm p-4" style="display: none;">
        <div @click.away="previewPhotoUrl = null" class="bg-white rounded-3xl p-4 max-w-sm w-full space-y-3 shadow-2xl">
            <div class="flex items-center justify-between">
                <span class="text-xs font-extrabold text-[#0F0E47]" x-text="previewPhotoTitle"></span>
                <button type="button" @click="previewPhotoUrl = null" class="text-zinc-500 hover:text-[#0F0E47] font-bold text-lg">&times;</button>
            </div>
            <img :src="previewPhotoUrl" :alt="previewPhotoTitle" class="w-full h-72 object-cover rounded-2xl border border-[#8686AC]/30">
        </div>
    </div>

    <!-- DECLINE MODAL -->
    <div x-show="rejectModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" style="display: none;">
        <div @click.away="rejectModalOpen = false" class="bg-white border border-[#8686AC]/40 w-full max-w-md rounded-3xl p-5 sm:p-8 space-y-6 shadow-2xl relative">
            <div class="flex justify-between items-center border-b border-[#8686AC]/30 pb-4">
                <h3 class="text-lg font-extrabold text-[#0F0E47]">Why decline?</h3>
                <button type="button" @click="rejectModalOpen = false" class="text-zinc-400 hover:text-[#0F0E47] font-bold text-lg">&times;</button>
            </div>
            <form :action="'/admin/reservations/' + selectedReservationId + '/reject'" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-[#505081] mb-1.5">Note for the requester</label>
                    <textarea name="rejection_reason" rows="4" placeholder="e.g. Room already taken at that hour..."
                              class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl p-3 text-xs text-[#272757] focus:outline-none focus:border-[#505081]" required></textarea>
                </div>
                <div class="flex justify-end space-x-3 pt-2">
                    <button type="button" @click="rejectModalOpen = false" class="px-4 py-2 bg-[#F4F5F7] text-[#272757] text-xs font-bold rounded-xl border border-[#8686AC]/30">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl shadow transition">Decline request</button>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT ROOM MODAL -->
    <div x-show="editFacilityModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" style="display: none;">
        <div @click.away="editFacilityModal = false" class="bg-white border border-[#8686AC]/40 w-full max-w-md rounded-3xl p-5 sm:p-8 space-y-6 shadow-2xl relative">
            <div class="flex justify-between items-center border-b border-[#8686AC]/30 pb-4">
                <h3 class="text-lg font-extrabold text-[#0F0E47]">Edit room</h3>
                <button type="button" @click="editFacilityModal = false" class="text-zinc-400 hover:text-[#0F0E47] font-bold text-lg">&times;</button>
            </div>
            <form :action="'/admin/facilities/' + formFacility.id" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-semibold text-[#505081] mb-1">Room name</label>
                    <input type="text" name="name" x-model="formFacility.name" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#505081] mb-1">Max people</label>
                    <input type="number" name="capacity" min="1" x-model="formFacility.capacity" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#505081] mb-1">Status</label>
                    <select name="status" x-model="formFacility.status" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]">
                        <option value="available">Available</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-3 pt-2">
                    <button type="button" @click="editFacilityModal = false" class="px-4 py-2 bg-[#F4F5F7] text-[#272757] text-xs font-bold rounded-xl border border-[#8686AC]/30">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-[#0F0E47] hover:bg-[#272757] text-white text-xs font-bold rounded-xl transition shadow">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT GEAR MODAL -->
    <div x-show="editEquipmentModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" style="display: none;">
        <div @click.away="editEquipmentModal = false" class="bg-white border border-[#8686AC]/40 w-full max-w-md rounded-3xl p-5 sm:p-8 space-y-6 shadow-2xl relative">
            <div class="flex justify-between items-center border-b border-[#8686AC]/30 pb-4">
                <h3 class="text-lg font-extrabold text-[#0F0E47]">Edit equipment</h3>
                <button type="button" @click="editEquipmentModal = false" class="text-zinc-400 hover:text-[#0F0E47] font-bold text-lg">&times;</button>
            </div>
            <form :action="'/admin/equipment/' + formEquipment.id" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-semibold text-[#505081] mb-1">Item name</label>
                    <input type="text" name="name" x-model="formEquipment.name" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#505081] mb-1">How many units</label>
                    <input type="number" name="total_stock" min="1" x-model="formEquipment.total_stock" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#505081] mb-1">Status</label>
                    <select name="status" x-model="formEquipment.status" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]">
                        <option value="available">Available</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-3 pt-2">
                    <button type="button" @click="editEquipmentModal = false" class="px-4 py-2 bg-[#F4F5F7] text-[#272757] text-xs font-bold rounded-xl border border-[#8686AC]/30">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-[#0F0E47] hover:bg-[#272757] text-white text-xs font-bold rounded-xl transition shadow">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('adminDashboard', () => ({
        currentView: 'bookings',
        filterStatus: 'all',
        mobileMenuOpen: false,
        notificationsOpen: false,
        adminProfileModalOpen: false,
        previewPhotoUrl: null,
        previewPhotoTitle: '',
        adminPhotoPreview: @json(Auth::user()->avatar_url ?? null),
        rejectModalOpen: false,
        selectedReservationId: null,
        reservations: @json($reservations ?? []),
        users: @json($users ?? []),
        facilities: @json($facilities ?? []),
        equipment: @json($equipment ?? []),
        editFacilityModal: false,
        formFacility: {},
        editEquipmentModal: false,
        formEquipment: {},
        currentUserId: {{ Auth::id() ?? 'null' }},
        threads: [],
        activeThreadUserId: null,
        threadMessages: [],
        newAdminMessage: '',
        sendingMessage: false,
        pollTimer: null,
        readAlertIds: [],
        adminAlerts: [],

        init() {
            try {
                const parsed = JSON.parse(localStorage.getItem('admin_read_alerts') || '[]');
                this.readAlertIds = Array.isArray(parsed) ? parsed : [];
            } catch (e) {
                this.readAlertIds = [];
            }
            this.refreshAdminAlerts();
            this.fetchThreads();
            this.syncAdminReservations();

            this.pollTimer = setInterval(() => {
                this.fetchThreads();
                this.refreshAdminAlerts();
                this.syncAdminReservations();
                if (this.currentView === 'messages' && this.activeThreadUserId) {
                    this.fetchAdminMessages();
                }
            }, 3000);
        },

        async syncAdminReservations() {
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
                    if (Array.isArray(payload.reservations)) this.reservations = payload.reservations;
                    if (Array.isArray(payload.facilities)) this.facilities = payload.facilities;
                    if (Array.isArray(payload.equipment)) this.equipment = payload.equipment;
                    return;
                }
                const html = await res.text();
                const doc = new DOMParser().parseFromString(html, 'text/html');
                const scripts = Array.from(doc.querySelectorAll('script'));
                for (const s of scripts) {
                    const txt = s.textContent || '';
                    if (txt.includes('reservations:') && txt.includes('facilities:')) {
                        const resMatch = txt.match(/reservations:\s*(\[[\s\S]*?\]),\s*users:/);
                        const facMatch = txt.match(/facilities:\s*(\[[\s\S]*?\]),\s*equipment:/);
                        const eqMatch = txt.match(/equipment:\s*(\[[\s\S]*?\]),\s*editFacilityModal:/);
                        if (resMatch) this.reservations = JSON.parse(resMatch[1]);
                        if (facMatch) this.facilities = JSON.parse(facMatch[1]);
                        if (eqMatch) this.equipment = JSON.parse(eqMatch[1]);
                        break;
                    }
                }
            } catch (e) {}
        },

        initials(name) {
            const parts = String(name || 'U').trim().split(/\s+/);
            return parts.length >= 2
                ? (parts[0][0] + parts[1][0]).toUpperCase()
                : String(name || 'U').slice(0, 2).toUpperCase();
        },

        resolvePhotoSrc(val) {
            if (!val || typeof val !== 'string') return null;
            const s = val.trim();
            if (!s) return null;
            if (s.startsWith('data:image/') || s.startsWith('http://') || s.startsWith('https://') || s.startsWith('/')) {
                return s;
            }
            return '/storage/' + s.replace(/^\/+/, '');
        },

        getUserAvatar(userObj) {
            if (!userObj) return null;
            if (userObj.avatar_url) return this.resolvePhotoSrc(userObj.avatar_url);
            if (userObj.profile_photo) return this.resolvePhotoSrc(userObj.profile_photo);
            const matched = (this.users || []).find(u => Number(u.id) === Number(userObj.id));
            return matched ? (this.resolvePhotoSrc(matched.avatar_url) || this.resolvePhotoSrc(matched.profile_photo)) : null;
        },

        getThreadAvatar(thread) {
            if (!thread) return null;
            if (thread.avatar_url) return this.resolvePhotoSrc(thread.avatar_url);
            if (thread.profile_photo) return this.resolvePhotoSrc(thread.profile_photo);
            const matched = (this.users || []).find(u => Number(u.id) === Number(thread.id));
            return matched ? (this.resolvePhotoSrc(matched.avatar_url) || this.resolvePhotoSrc(matched.profile_photo)) : null;
        },

        previewAdminPhoto(event) {
            const file = event.target.files?.[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                this.adminPhotoPreview = e.target.result;
            };
            reader.readAsDataURL(file);
        },

        refreshAdminAlerts() {
            const alerts = [];

            (this.reservations || [])
                .filter(r => (r.status || '').toLowerCase() === 'returned')
                .forEach(r => {
                    alerts.push({
                        id: 'returned-' + r.id,
                        type: 'return',
                        badge: 'Returned',
                        title: (r.user?.name || 'User') + ' returned ' + (r.resource_name || 'Item'),
                        detail: (r.resource_type || 'item') + ' • Qty: ' + (r.quantity || 1),
                        targetView: 'bookings',
                        filter: 'returned'
                    });
                });

            (this.reservations || [])
                .filter(r => (r.status || '').toLowerCase() === 'pending')
                .forEach(r => {
                    alerts.push({
                        id: 'booking-' + r.id,
                        type: 'booking',
                        badge: 'Waiting',
                        title: (r.user?.name || 'User') + ' • ' + (r.resource_name || 'Item'),
                        detail: (r.quantity || 1) + ' for ' + (r.start_time || 'selected time'),
                        targetView: 'bookings',
                        filter: 'pending'
                    });
                });

            (this.threads || []).forEach(t => {
                if (!t.last_message) return;
                const isReturn = Boolean(t.last_is_system);
                alerts.push({
                    id: 'thread-' + t.id + '-' + encodeURIComponent(t.last_message).slice(-24),
                    type: isReturn ? 'return' : 'chat',
                    badge: isReturn ? 'Returned' : 'Chat',
                    title: t.name + (t.last_time ? ' • ' + t.last_time : ''),
                    detail: t.last_message,
                    targetView: 'messages',
                    userId: t.id
                });
            });

            this.adminAlerts = alerts.slice(0, 12);
        },

        get unreadAlertCount() {
            return this.adminAlerts.filter(a => !this.readAlertIds.includes(a.id)).length;
        },

        get unreadChatCount() {
            return this.adminAlerts.filter(a => (a.type === 'chat' || a.type === 'return') && !this.readAlertIds.includes(a.id)).length;
        },

        markAllAlertsRead() {
            const allIds = this.adminAlerts.map(a => a.id);
            this.readAlertIds = Array.from(new Set([...this.readAlertIds, ...allIds]));
            try {
                localStorage.setItem('admin_read_alerts', JSON.stringify(this.readAlertIds));
            } catch (e) {}
        },

        handleAlertClick(alert) {
            if (!this.readAlertIds.includes(alert.id)) {
                this.readAlertIds.push(alert.id);
                try {
                    localStorage.setItem('admin_read_alerts', JSON.stringify(this.readAlertIds));
                } catch (e) {}
            }
            this.notificationsOpen = false;
            this.mobileMenuOpen = false;
            if (alert.targetView === 'bookings') {
                this.currentView = 'bookings';
                if (alert.filter) this.filterStatus = alert.filter;
            } else if (alert.targetView === 'messages') {
                this.currentView = 'messages';
                if (alert.userId) {
                    this.selectThread(alert.userId);
                } else {
                    this.fetchThreads();
                }
            }
        },

        get selectedThread() {
            return this.threads.find(t => t.id === this.activeThreadUserId) || null;
        },

        async fetchThreads() {
            try {
                const res = await fetch('{{ route('chat.threads') }}', {
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                });
                if (!res.ok) return;
                const data = await res.json();
                this.threads = Array.isArray(data) ? data : [];
                if (!this.activeThreadUserId && this.threads.length > 0) {
                    this.activeThreadUserId = this.threads[0].id;
                }
                this.fetchAdminMessages();
                this.refreshAdminAlerts();
            } catch (e) {
                console.error('Threads fetch error:', e);
            }
        },

        selectThread(userId) {
            this.activeThreadUserId = userId;
            this.fetchAdminMessages();
        },

        async fetchAdminMessages() {
            if (!this.activeThreadUserId) return;
            try {
                const url = '{{ route('chat.index') }}?user_id=' + encodeURIComponent(this.activeThreadUserId);
                const res = await fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                });
                if (!res.ok) return;
                const data = await res.json();
                const prevLen = this.threadMessages.length;
                this.threadMessages = Array.isArray(data) ? data : [];
                if (this.threadMessages.length !== prevLen) {
                    this.$nextTick(() => {
                        const feed = document.getElementById('admin-chat-feed');
                        if (feed) feed.scrollTop = feed.scrollHeight;
                    });
                }
            } catch (e) {
                console.error('Admin messages poll error:', e);
            }
        },

        async sendAdminMessage() {
            const text = this.newAdminMessage.trim();
            if (!text || !this.activeThreadUserId || this.sendingMessage) return;
            this.sendingMessage = true;
            try {
                const res = await fetch('{{ route('chat.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        user_id: this.activeThreadUserId,
                        message: text
                    })
                });
                if (res.ok) {
                    const created = await res.json();
                    this.threadMessages.push(created);
                    this.newAdminMessage = '';
                    this.fetchThreads();
                    this.$nextTick(() => {
                        const feed = document.getElementById('admin-chat-feed');
                        if (feed) feed.scrollTop = feed.scrollHeight;
                    });
                }
            } catch (e) {
                console.error('Admin send error:', e);
            } finally {
                this.sendingMessage = false;
            }
        },

        openRejectModal(id) {
            this.selectedReservationId = id;
            this.rejectModalOpen = true;
        },

        openEditFacility(fac) {
            this.formFacility = { ...fac };
            this.editFacilityModal = true;
        },

        openEditEquipment(eq) {
            this.formEquipment = { ...eq };
            this.editEquipmentModal = true;
        },

        get filteredReservations() {
            if (this.filterStatus === 'all') return this.reservations;
            if (this.filterStatus === 'rejected') {
                return this.reservations.filter(r => ['rejected', 'cancelled'].includes((r.status || '').toLowerCase()));
            }
            return this.reservations.filter(r => (r.status || '').toLowerCase() === this.filterStatus);
        }
    }));
});
</script>
</x-app-layout>