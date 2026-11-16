<x-app-layout>
<div class="min-h-screen bg-[#F4F5F7] text-[#272757] font-['Inter',sans-serif] flex relative overflow-x-hidden" x-data="adminDashboard()">
    <!-- Admin Sidebar -->
    <aside class="w-64 border-r border-[#8686AC]/30 bg-white min-h-screen p-6 hidden md:flex flex-col justify-between sticky top-0 z-40 shadow-sm">
        <div class="space-y-8">
            <div class="px-2 pt-2">
                <span class="text-[10px] font-bold text-rose-600 uppercase tracking-widest block">Admin Portal</span>
            </div>
            <div class="space-y-6">
                <nav class="space-y-1">
                    <button @click="currentView = 'bookings'"
                        :class="currentView === 'bookings' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                        class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        <span>Bookings</span>
                    </button>
                    <button @click="currentView = 'inventory'"
                        :class="currentView === 'inventory' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                        class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        <span>Inventory & Stocks</span>
                    </button>
                    <button @click="currentView = 'users'"
                        :class="currentView === 'users' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                        class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span>Users</span>
                    </button>
                    <button @click="currentView = 'reports'"
                        :class="currentView === 'reports' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'"
                        class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Reports</span>
                    </button>
                </nav>
            </div>
        </div>
        <div class="pt-6 border-t border-[#8686AC]/30 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-xl bg-[#0F0E47] text-white flex items-center justify-center font-bold text-xs">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="overflow-hidden">
                    <span class="font-bold text-xs text-[#0F0E47] truncate block">{{ Auth::user()->name }}</span>
                    <span class="text-[10px] text-rose-600 truncate block font-bold">Custodian</span>
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
                <span class="text-xs font-bold text-[#0F0E47]">Connected</span>
            </div>
            <span class="text-xs font-bold text-[#505081]">Master Custodian</span>
        </header>

        <!-- ================= VIEW 1: BOOKINGS ================= -->
        <main x-show="currentView === 'bookings'" class="flex-grow p-6 lg:p-10 space-y-8">
            <div class="bg-white backdrop-blur-xl p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-4">
                <h2 class="text-2xl font-extrabold text-[#0F0E47]">Requests & Bookings</h2>
                <p class="text-xs text-[#505081]">Click cards to filter requests.</p>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 pt-2">
                    <div @click="filterStatus = 'all'" :class="filterStatus === 'all' ? 'border-[#0F0E47] bg-[#F4F5F7]' : 'border-[#8686AC]/30 bg-white'" class="p-4 rounded-2xl border cursor-pointer transition shadow-sm">
                        <span class="text-[10px] font-bold text-[#505081] uppercase">Total</span>
                        <p class="text-2xl font-extrabold text-[#0F0E47] mt-1" x-text="reservations.length">0</p>
                    </div>
                    <div @click="filterStatus = 'pending'" :class="filterStatus === 'pending' ? 'border-amber-500 bg-amber-50/50' : 'border-[#8686AC]/30 bg-white'" class="p-4 rounded-2xl border cursor-pointer transition shadow-sm">
                        <span class="text-[10px] font-bold text-amber-600 uppercase">Pending</span>
                        <p class="text-2xl font-extrabold text-amber-700 mt-1" x-text="reservations.filter(r => r.status === 'pending').length">0</p>
                    </div>
                    <div @click="filterStatus = 'approved'" :class="filterStatus === 'approved' ? 'border-emerald-500 bg-emerald-50/50' : 'border-[#8686AC]/30 bg-white'" class="p-4 rounded-2xl border cursor-pointer transition shadow-sm">
                        <span class="text-[10px] font-bold text-emerald-600 uppercase">Approved</span>
                        <p class="text-2xl font-extrabold text-emerald-700 mt-1" x-text="reservations.filter(r => r.status === 'approved').length">0</p>
                    </div>
                    <div @click="filterStatus = 'rejected'" :class="filterStatus === 'rejected' ? 'border-rose-500 bg-rose-50/50' : 'border-[#8686AC]/30 bg-white'" class="p-4 rounded-2xl border cursor-pointer transition shadow-sm">
                        <span class="text-[10px] font-bold text-rose-600 uppercase">Rejected / Cancelled</span>
                        <p class="text-2xl font-extrabold text-rose-700 mt-1" x-text="reservations.filter(r => r.status === 'rejected' || r.status === 'cancelled').length">0</p>
                    </div>
                </div>
            </div>

            <div class="bg-white backdrop-blur-xl rounded-3xl border border-[#8686AC]/30 overflow-hidden shadow-xl">
                <div class="p-6 border-b border-[#8686AC]/30 flex justify-between items-center">
                    <h3 class="text-sm font-extrabold text-[#0F0E47]">Reservation List</h3>
                    <span class="text-xs font-bold text-[#505081]" x-text="'Filter: ' + filterStatus.toUpperCase()"></span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-[#8686AC]/30 text-[10px] font-bold text-[#505081] uppercase tracking-wider bg-[#F4F5F7]">
                                <th class="py-4 px-6">User & Purpose</th>
                                <th class="py-4 px-6">Resource & Qty</th>
                                <th class="py-4 px-6">Schedule</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6 text-right">Action</th>
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
                                        <span class="text-[10px] text-[#505081]" x-text="item.resource_type + ' (' + item.quantity + ')'"></span>
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
                                    <td class="py-4 px-6 text-right">
                                        <template x-if="item.status === 'pending'">
                                            <div class="flex items-center justify-end space-x-2">
                                                <form :action="'/admin/reservations/' + item.id + '/approve'" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="px-3 py-1.5 bg-emerald-700 text-white rounded-xl font-bold text-[11px] hover:bg-emerald-800 transition">Approve</button>
                                                </form>
                                                <button @click="openRejectModal(item.id)" class="px-3 py-1.5 bg-rose-600 text-white rounded-xl font-bold text-[11px] hover:bg-rose-700 transition">Reject</button>
                                            </div>
                                        </template>
                                        <template x-if="item.status !== 'pending'">
                                            <span class="text-[#505081] font-semibold text-[11px]" x-text="item.status.toUpperCase()"></span>
                                        </template>
                                    </td>
                                </tr>
                            </template>
                            <template x-if="filteredReservations.length === 0">
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-[#505081] text-xs">No reservations found.</td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <!-- ================= VIEW 2: INVENTORY ================= -->
        <main x-show="currentView === 'inventory'" class="flex-grow p-6 lg:p-10 space-y-8" style="display: none;">
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-2">
                <h2 class="text-2xl font-extrabold text-[#0F0E47]">Facility & Stock Inventory</h2>
                <p class="text-xs text-[#505081]">Add, edit, or remove rooms and equipment stocks.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Add Facility -->
                <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-4">
                    <h3 class="text-sm font-extrabold text-[#0F0E47]">Add Facility</h3>
                    <form action="{{ route('admin.facilities.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-[#505081] mb-1">Name</label>
                            <input type="text" name="name" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#505081] mb-1">Capacity</label>
                            <input type="number" name="capacity" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#505081] mb-1">Status</label>
                            <select name="status" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]">
                                <option value="available">Available</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                        </div>
                        <button type="submit" class="px-5 py-2.5 bg-[#0F0E47] hover:bg-[#272757] text-white text-xs font-bold rounded-xl transition shadow">Save Facility</button>
                    </form>
                </div>
                <!-- Add Equipment -->
                <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-4">
                    <h3 class="text-sm font-extrabold text-[#0F0E47]">Add Equipment Stock</h3>
                    <form action="{{ route('admin.equipment.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-[#505081] mb-1">Name</label>
                            <input type="text" name="name" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#505081] mb-1">Quantity</label>
                            <input type="number" name="total_stock" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#505081] mb-1">Status</label>
                            <select name="status" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]">
                                <option value="available">Available</option>
                                <option value="unavailable">Unavailable</option>
                            </select>
                        </div>
                        <button type="submit" class="px-5 py-2.5 bg-[#0F0E47] hover:bg-[#272757] text-white text-xs font-bold rounded-xl transition shadow">Save Equipment</button>
                    </form>
                </div>
            </div>

            <!-- Facilities Table -->
            <div class="bg-white backdrop-blur-xl rounded-3xl border border-[#8686AC]/30 overflow-hidden shadow-xl p-6 space-y-4">
                <h3 class="text-base font-extrabold text-[#0F0E47]">Facilities List</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-[#8686AC]/30 text-[10px] font-bold text-[#505081] uppercase bg-[#F4F5F7]">
                                <th class="py-3 px-4">Name</th>
                                <th class="py-3 px-4">Capacity</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#8686AC]/20">
                            <template x-for="fac in facilities" :key="fac.id">
                                <tr class="hover:bg-[#F4F5F7]/50">
                                    <td class="py-3 px-4 font-bold text-[#0F0E47]" x-text="fac.name"></td>
                                    <td class="py-3 px-4" x-text="fac.capacity + ' Persons'"></td>
                                    <td class="py-3 px-4 uppercase font-semibold" x-text="fac.status"></td>
                                    <td class="py-3 px-4 text-right space-x-2">
                                        <button @click="openEditFacility(fac)" class="px-3 py-1 bg-sky-50 text-sky-700 border border-sky-300 rounded-lg font-bold hover:bg-sky-100">Edit</button>
                                        <form :action="'/admin/facilities/' + fac.id" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Delete facility?')" class="px-3 py-1 bg-rose-50 text-rose-700 border border-rose-300 rounded-lg font-bold hover:bg-rose-100">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Equipment Table -->
            <div class="bg-white backdrop-blur-xl rounded-3xl border border-[#8686AC]/30 overflow-hidden shadow-xl p-6 space-y-4">
                <h3 class="text-base font-extrabold text-[#0F0E47]">Equipment List</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-[#8686AC]/30 text-[10px] font-bold text-[#505081] uppercase bg-[#F4F5F7]">
                                <th class="py-3 px-4">Name</th>
                                <th class="py-3 px-4">Total Stock</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#8686AC]/20">
                            <template x-for="eq in equipment" :key="eq.id">
                                <tr class="hover:bg-[#F4F5F7]/50">
                                    <td class="py-3 px-4 font-bold text-[#0F0E47]" x-text="eq.name"></td>
                                    <td class="py-3 px-4" x-text="eq.total_stock + ' Units'"></td>
                                    <td class="py-3 px-4 uppercase font-semibold" x-text="eq.status"></td>
                                    <td class="py-3 px-4 text-right space-x-2">
                                        <button @click="openEditEquipment(eq)" class="px-3 py-1 bg-sky-50 text-sky-700 border border-sky-300 rounded-lg font-bold hover:bg-sky-100">Edit</button>
                                        <form :action="'/admin/equipment/' + eq.id" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Delete equipment?')" class="px-3 py-1 bg-rose-50 text-rose-700 border border-rose-300 rounded-lg font-bold hover:bg-rose-100">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <!-- ================= VIEW 3: USERS ================= -->
        <main x-show="currentView === 'users'" class="flex-grow p-6 lg:p-10 space-y-8" style="display: none;">
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-6">
                <div>
                    <h2 class="text-2xl font-extrabold text-[#0F0E47]">User Accounts</h2>
                    <p class="text-xs text-[#505081]">Manage activation status for student and faculty accounts.</p>
                </div>
                <div class="divide-y divide-[#8686AC]/20">
                    <template x-for="user in users" :key="user.id">
                        <div class="py-4 flex items-center justify-between">
                            <div class="space-y-1">
                                <div class="flex items-center space-x-3">
                                    <h4 class="text-sm font-bold text-[#0F0E47]" x-text="user.name"></h4>
                                    <span class="px-2 py-0.5 text-[9px] font-bold rounded uppercase" :class="user.is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700'" x-text="user.is_active ? 'Active' : 'Deactivated'"></span>
                                </div>
                                <p class="text-xs text-[#505081]" x-text="user.email + ' | Role: ' + user.role"></p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <form :action="'/admin/users/' + user.id + '/toggle-status'" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold transition border shadow-sm" :class="user.is_active ? 'bg-rose-50 text-rose-700 border-rose-300 hover:bg-rose-100' : 'bg-emerald-50 text-emerald-700 border-emerald-300 hover:bg-emerald-100'" x-text="user.is_active ? 'Deactivate' : 'Reactivate'"></button>
                                </form>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </main>

        <!-- ================= VIEW 4: REPORTS ================= -->
        <main x-show="currentView === 'reports'" class="flex-grow p-6 lg:p-10 space-y-8" style="display: none;">
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-extrabold text-[#0F0E47]">Reports</h2>
                        <p class="text-xs text-[#505081]">Export reservation logs and records.</p>
                    </div>
                    <a href="{{ route('admin.reports.pdf') }}" class="px-5 py-2.5 bg-[#0F0E47] text-white text-xs font-bold rounded-xl shadow-lg hover:bg-[#272757] transition">Export PDF</a>
                </div>
                <div class="bg-[#F4F5F7] p-4 rounded-2xl border border-[#8686AC]/30 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-bold text-[#505081] uppercase">Total Logs</span>
                        <p class="text-xl font-extrabold text-[#0F0E47]" x-text="reservations.length"></p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- REJECT MODAL -->
    <div x-show="rejectModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" style="display: none;">
        <div @click.away="rejectModalOpen = false" class="bg-white border border-[#8686AC]/40 w-full max-w-md rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl relative">
            <div class="flex justify-between items-center border-b border-[#8686AC]/30 pb-4">
                <h3 class="text-lg font-extrabold text-[#0F0E47]">Rejection Reason</h3>
                <button @click="rejectModalOpen = false" class="text-zinc-400 hover:text-[#0F0E47] font-bold text-lg">&times;</button>
            </div>
            <form :action="'/admin/reservations/' + selectedReservationId + '/reject'" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                <div>
                    <label class="block text-xs font-semibold text-[#505081] mb-1.5">Reason</label>
                    <textarea name="rejection_reason" rows="4" placeholder="e.g. Schedule conflict..." class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl p-3 text-xs text-[#272757] focus:outline-none focus:border-[#505081]" required></textarea>
                </div>
                <div class="flex justify-end space-x-3 pt-2">
                    <button type="button" @click="rejectModalOpen = false" class="px-4 py-2 bg-[#F4F5F7] text-[#272757] text-xs font-bold rounded-xl border border-[#8686AC]/30">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl shadow transition">Confirm Rejection</button>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT FACILITY MODAL -->
    <div x-show="editFacilityModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" style="display: none;">
        <div @click.away="editFacilityModal = false" class="bg-white border border-[#8686AC]/40 w-full max-w-md rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl relative">
            <div class="flex justify-between items-center border-b border-[#8686AC]/30 pb-4">
                <h3 class="text-lg font-extrabold text-[#0F0E47]">Edit Facility</h3>
                <button @click="editFacilityModal = false" class="text-zinc-400 hover:text-[#0F0E47] font-bold text-lg">&times;</button>
            </div>
            <form :action="'/admin/facilities/' + formFacility.id" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-semibold text-[#505081] mb-1">Name</label>
                    <input type="text" name="name" x-model="formFacility.name" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#505081] mb-1">Capacity</label>
                    <input type="number" name="capacity" x-model="formFacility.capacity" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
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

    <!-- EDIT EQUIPMENT MODAL -->
    <div x-show="editEquipmentModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" style="display: none;">
        <div @click.away="editEquipmentModal = false" class="bg-white border border-[#8686AC]/40 w-full max-w-md rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl relative">
            <div class="flex justify-between items-center border-b border-[#8686AC]/30 pb-4">
                <h3 class="text-lg font-extrabold text-[#0F0E47]">Edit Equipment Stock</h3>
                <button @click="editEquipmentModal = false" class="text-zinc-400 hover:text-[#0F0E47] font-bold text-lg">&times;</button>
            </div>
            <form :action="'/admin/equipment/' + formEquipment.id" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-semibold text-[#505081] mb-1">Name</label>
                    <input type="text" name="name" x-model="formEquipment.name" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#505081] mb-1">Total Stock</label>
                    <input type="number" name="total_stock" x-model="formEquipment.total_stock" class="w-full bg-[#F4F5F7] border border-[#8686AC]/40 rounded-xl px-4 py-2.5 text-xs text-[#272757]" required>
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
        facilities: @json($facilities),
        equipment: @json($equipment),
        editFacilityModal: false,
        formFacility: {},
        editEquipmentModal: false,
        formEquipment: {},
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
                return this.reservations.filter(r => r.status === 'rejected' || r.status === 'cancelled');
            }
            return this.reservations.filter(r => r.status === this.filterStatus);
        }
    }));
});
</script>
</x-app-layout>