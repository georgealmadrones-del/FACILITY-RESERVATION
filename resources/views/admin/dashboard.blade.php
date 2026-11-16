<x-app-layout>
    <div class="min-h-screen bg-[#F4F5F7] text-[#272757] font-['Inter',sans-serif] flex relative overflow-x-hidden"
         x-data="adminDashboard()">
        
        <!-- Admin Sidebar -->
        <aside class="w-64 border-r border-[#8686AC]/30 bg-white min-h-screen p-6 flex flex-col justify-between hidden md:flex sticky top-0 z-40 shadow-sm">
            <div class="space-y-8">
                <div class="px-2 pt-2">
                    <span class="text-[10px] font-bold text-rose-600 uppercase tracking-widest block">ADMINISTRATOR PANEL</span>
                </div>
                <div class="space-y-6">
                    <div>
                        <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block mb-3">DATABASE MANAGEMENT</span>
                        <nav class="space-y-1">
                            <button @click="currentView = 'bookings'"
                                :class="currentView === 'bookings' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                                class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                <span>Bookings & Approvals</span>
                            </button>
                            <button @click="currentView = 'inventory'"
                                :class="currentView === 'inventory' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                                class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <span>Facility & Stock Inventory</span>
                            </button>
                            <button @click="currentView = 'users'"
                                :class="currentView === 'users' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                                class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>User Management</span>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="pt-6 border-t border-[#8686AC]/30 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-xl bg-[#0F0E47] text-white flex items-center justify-center font-bold text-xs">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div class="overflow-hidden">
                        <span class="font-bold text-xs text-[#0F0E47] truncate block">{{ Auth::user()->name }}</span>
                        <span class="text-[10px] text-rose-600 truncate block font-bold">Master Custodian</span>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-[#505081] hover:text-rose-600 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-grow flex flex-col min-h-screen">
            <header class="h-20 border-b border-[#8686AC]/30 bg-white/80 backdrop-blur-md px-6 lg:px-10 flex items-center justify-between sticky top-0 z-30 shadow-sm">
                <div class="flex items-center space-x-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-xs font-bold text-[#0F0E47]">Live Database Mode Active</span>
                </div>
                <span class="text-xs font-bold text-[#505081]">Logged in as Master Custodian</span>
            </header>

            <!-- ================= VIEW 1: BOOKINGS & APPROVALS ================= -->
            <main x-show="currentView === 'bookings'" class="flex-grow p-6 lg:p-10 space-y-8">
                <div class="bg-white backdrop-blur-xl p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-4">
                    <h2 class="text-2xl font-extrabold text-[#0F0E47]">Facility & Equipment Requests Control Center</h2>
                    <p class="text-xs text-[#505081]">Click the stat cards below to filter table results instantly.</p>
                    
                    <!-- Stat Cards Filtering -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 pt-4">
                        <div @click="filterStatus = 'all'" :class="filterStatus === 'all' ? 'border-[#0F0E47] bg-[#F4F5F7]' : 'border-[#8686AC]/30 bg-white'" class="p-5 rounded-2xl border cursor-pointer transition shadow-sm">
                            <span class="text-[10px] font-bold text-[#505081] uppercase">TOTAL REQUESTS</span>
                            <p class="text-2xl font-extrabold text-[#0F0E47] mt-1" x-text="reservations.length">0</p>
                        </div>
                        <div @click="filterStatus = 'pending'" :class="filterStatus === 'pending' ? 'border-amber-500 bg-amber-50/50' : 'border-[#8686AC]/30 bg-white'" class="p-5 rounded-2xl border cursor-pointer transition shadow-sm">
                            <span class="text-[10px] font-bold text-amber-600 uppercase">PENDING</span>
                            <p class="text-2xl font-extrabold text-amber-700 mt-1" x-text="reservations.filter(r => r.status === 'pending').length">0</p>
                        </div>
                        <div @click="filterStatus = 'approved'" :class="filterStatus === 'approved' ? 'border-emerald-500 bg-emerald-50/50' : 'border-[#8686AC]/30 bg-white'" class="p-5 rounded-2xl border cursor-pointer transition shadow-sm">
                            <span class="text-[10px] font-bold text-emerald-600 uppercase">APPROVED & ACTIVE</span>
                            <p class="text-2xl font-extrabold text-emerald-700 mt-1" x-text="reservations.filter(r => r.status === 'approved').length">0</p>
                        </div>
                        <div @click="filterStatus = 'rejected'" :class="filterStatus === 'rejected' ? 'border-rose-500 bg-rose-50/50' : 'border-[#8686AC]/30 bg-white'" class="p-5 rounded-2xl border cursor-pointer transition shadow-sm">
                            <span class="text-[10px] font-bold text-rose-600 uppercase">REJECTED / CANCELLED</span>
                            <p class="text-2xl font-extrabold text-rose-700 mt-1" x-text="reservations.filter(r => r.status === 'rejected' || r.status === 'cancelled').length">0</p>
                        </div>
                    </div>
                </div>

                <!-- Reservations Table -->
                <div class="bg-white backdrop-blur-xl rounded-3xl border border-[#8686AC]/30 overflow-hidden shadow-xl">
                    <div class="p-6 border-b border-[#8686AC]/30 flex justify-between items-center">
                        <h3 class="text-sm font-extrabold text-[#0F0E47]">Database Reservations List</h3>
                        <span class="text-xs font-bold text-[#505081]" x-text="'Showing filter: ' + filterStatus.toUpperCase()"></span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-[#8686AC]/30 text-[10px] font-bold text-[#505081] uppercase tracking-wider bg-[#F4F5F7]">
                                    <th class="py-4 px-6">USER & PURPOSE</th>
                                    <th class="py-4 px-6">RESOURCE & QTY</th>
                                    <th class="py-4 px-6">SCHEDULE</th>
                                    <th class="py-4 px-6">STATUS & REASON</th>
                                    <th class="py-4 px-6 text-right">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#8686AC]/20 text-xs">
                                <template x-for="item in filteredReservations" :key="item.id">
                                    <tr class="hover:bg-[#F4F5F7]/80 transition">
                                        <td class="py-4 px-6">
                                            <span class="font-bold text-[#0F0E47] block" x-text="item.user?.name || 'User'"></span>
                                            <span class="text-[10px] text-[#505081]" x-text="item.purpose"></span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="font-bold text-[#0F0E47] block" x-text="item.resource_name"></span>
                                            <span class="text-[10px] text-[#505081]" x-text="item.resource_type + ' (' + item.quantity + ' units)'"></span>
                                        </td>
                                        <td class="py-4 px-6 text-[#272757] font-medium" x-text="item.start_time + ' - ' + item.end_time"></td>
                                        <td class="py-4 px-6">
                                            <span class="px-2.5 py-1 text-[9px] font-bold rounded-full border uppercase inline-block" :class="{
                                                'bg-emerald-50 text-emerald-700 border-emerald-300': item.status === 'approved',
                                                'bg-amber-50 text-amber-700 border-amber-300': item.status === 'pending',
                                                'bg-rose-50 text-rose-700 border-rose-300': item.status === 'rejected' || item.status === 'cancelled'
                                            }" x-text="item.status"></span>
                                            <template x-if="item.rejection_reason">
                                                <p class="text-[10px] text-rose-600 mt-1 italic" x-text="'Reason: ' + item.rejection_reason"></p>
                                            </template>
                                        </td>
                                        <td class="py-4 px-6 text-right space-x-2">
                                            <template x-if="item.status === 'pending'">
                                                <div class="flex justify-end space-x-2">
                                                    <form :action="'/admin/reservations/' + item.id + '/approve'" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1.5 bg-emerald-700 text-white rounded-xl font-bold text-[11px] hover:bg-emerald-800 transition">Approve</button>
                                                    </form>
                                                    <button @click="openRejectModal(item.id)" class="px-3 py-1.5 bg-rose-600 text-white rounded-xl font-bold text-[11px] hover:bg-rose-700 transition">Reject</button>
                                                </div>
                                            </template>
                                            <template x-if="item.status !== 'pending'">
                                                <span class="text-[#505081] font-semibold text-[11px]" x-text="item.status.toUpperCase() + ' PROCESSED'"></span>
                                            </template>
                                        </td>
                                    </tr>
                                </template>
                                <template x-if="filteredReservations.length === 0">
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-[#505081] text-xs">No reservations match this filter.</td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>

            <!-- ================= VIEW 2: INVENTORY ================= -->
            <main x-show="currentView === 'inventory'" class="flex-grow p-6 lg:p-10 space-y-8" style="display: none;">
                <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-4">
                    <h2 class="text-2xl font-extrabold text-[#0F0E47]">Facility & Stock Inventory</h2>
                    <p class="text-xs text-[#505081]">Manage campus facilities and equipment stock count.</p>
                </div>
            </main>

            <!-- ================= VIEW 3: USER MANAGEMENT (Deactivate & View Password Info) ================= -->
            <main x-show="currentView === 'users'" class="flex-grow p-6 lg:p-10 space-y-8" style="display: none;">
                <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-6">
                    <div>
                        <h2 class="text-2xl font-extrabold text-[#0F0E47]">User Accounts Directory</h2>
                        <p class="text-xs text-[#505081]">Manage student and faculty accounts, view passwords/credentials, and toggle account activation status.</p>
                    </div>
                    <div class="divide-y divide-[#8686AC]/20">
                        <template x-for="user in users" :key="user.id">
                            <div class="py-4 flex items-center justify-between">
                                <div>
                                    <div class="flex items-center space-x-3">
                                        <h4 class="text-sm font-bold text-[#0F0E47]" x-text="user.name"></h4>
                                        <span class="px-2 py-0.5 text-[9px] font-bold rounded uppercase" :class="user.is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700'" x-text="user.is_active ? 'ACTIVE' : 'DEACTIVATED'"></span>
                                    </div>
                                    <p class="text-xs text-[#505081]" x-text="user.email + ' | Role: ' + user.role"></p>
                                    <p class="text-[11px] text-[#8686AC] mt-0.5 font-mono" x-text="'Password Hash / Info: ' + (user.password ? user.password.substring(0, 20) + '...' : 'N/A')"></p>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <form :action="'/admin/users/' + user.id + '/toggle-status'" method="POST">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold transition border shadow-sm" :class="user.is_active ? 'bg-rose-50 text-rose-700 border-rose-300 hover:bg-rose-100' : 'bg-emerald-50 text-emerald-700 border-emerald-300 hover:bg-emerald-100'" x-text="user.is_active ? 'Deactivate Account' : 'Reactivate Account'"></button>
                                    </form>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </main>
        </div>

        <!-- ================= REJECTION REASON MODAL ================= -->
        <div x-show="rejectModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" style="display: none;">
            <div @click.away="rejectModalOpen = false" class="bg-white border border-[#8686AC]/40 w-full max-w-md rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl relative">
                <div class="flex justify-between items-center border-b border-[#8686AC]/30 pb-4">
                    <h3 class="text-lg font-extrabold text-[#0F0E47]">Provide Rejection Reason</h3>
                    <button @click="rejectModalOpen = false" class="text-zinc-400 hover:text-[#0F0E47] font-bold text-lg">&times;</button>
                </div>
                <form :action="'/admin/reservations/' + selectedReservationId + '/reject'" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-[#505081] mb-1.5">Reason for Rejection</label>
                        <textarea name="rejection_reason" rows="4" placeholder="e.g. Schedule conflict with laboratory maintenance..." class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl p-3 text-xs text-[#272757] focus:outline-none focus:border-[#505081]" required></textarea>
                    </div>
                    <div class="flex justify-end space-x-3 pt-2">
                        <button type="button" @click="rejectModalOpen = false" class="px-4 py-2 bg-[#F4F5F7] text-[#272757] text-xs font-bold rounded-xl border border-[#8686AC]/30">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl transition shadow">Confirm Rejection</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Alpine.js Script -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('adminDashboard', () => ({
                currentView: 'bookings',
                filterStatus: 'all',
                rejectModalOpen: false,
                selectedReservationId: null,
                reservations: @json($reservations),
                users: @json($users),

                openRejectModal(id) {
                    this.selectedReservationId = id;
                    this.rejectModalOpen = true;
                },

                get filteredReservations() {
                    if (this.filterStatus === 'all') return this.reservations;
                    if (this.filterStatus === 'rejected') {
                        return this.reservations.filter(r => r.status === 'rejected' || r.status === 'cancelled');
                    }
                    return this.reservations.filter(r => r.status === this.filterStatus);
                }
            }));
        });
    </script>
</x-app-layout>