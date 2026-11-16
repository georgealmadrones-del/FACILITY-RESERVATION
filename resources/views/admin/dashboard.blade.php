<x-app-layout>
    <div x-data="adminDashboard()" class="min-h-screen bg-[#F4F5F7] text-[#272757] font-['Inter',sans-serif] flex relative overflow-x-hidden">
        
        <!-- Admin Left Sidebar -->
        <aside class="w-64 border-r border-[#8686AC]/30 bg-white min-h-screen p-6 flex flex-col justify-between hidden md:flex sticky top-0 z-40 shadow-sm">
            <div class="space-y-8">
                <div class="px-2 pt-2">
                    <span class="text-[10px] font-bold text-rose-600 uppercase tracking-widest block">ADMINISTRATOR PANEL</span>
                </div>

                <div class="space-y-6">
                    <div>
                        <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block mb-3">SCOPE MANAGEMENT</span>
                        <nav class="space-y-1">
                            <button @click="adminTab = 'approvals'" :class="adminTab === 'approvals' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                                <svg class="w-4 h-4 text-current" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                <span>Bookings & Approvals</span>
                            </button>
                            <button @click="adminTab = 'inventory'" :class="adminTab === 'inventory' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                                <svg class="w-4 h-4 text-current" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <span>Facility & Stock Inventory</span>
                            </button>
                            <button @click="adminTab = 'users'" :class="adminTab === 'users' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                                <svg class="w-4 h-4 text-current" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>User Management</span>
                            </button>
                            <button @click="adminTab = 'reports'" :class="adminTab === 'reports' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                                <svg class="w-4 h-4 text-current" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span>Reports & Audit Logs</span>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Sidebar Footer -->
            <div class="pt-6 border-t border-[#8686AC]/30 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-xl bg-[#0F0E47] flex items-center justify-center font-bold text-xs text-white">
                        AD
                    </div>
                    <div class="overflow-hidden">
                        <span class="font-bold text-xs text-[#0F0E47] truncate block">System Administrator</span>
                        <span class="text-[10px] text-rose-600 truncate block font-semibold">Master Custodian</span>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Sign out" class="text-[#505081] hover:text-rose-600 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Admin Viewport -->
        <div class="flex-grow flex flex-col min-h-screen">
            <header class="h-20 border-b border-[#8686AC]/30 bg-white/80 backdrop-blur-md px-6 lg:px-10 flex items-center justify-between sticky top-0 z-30 shadow-sm">
                <div class="flex items-center space-x-3">
                    <span class="px-3 py-1 bg-rose-50 text-rose-700 border border-rose-300 rounded-full text-xs font-bold">Admin Panel Active</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-xs font-semibold text-[#505081]">Logged in as Master Custodian</span>
                </div>
            </header>

            <main class="flex-grow p-6 lg:p-10 space-y-8">
                
                <!-- ==================== TAB 1: BOOKINGS & APPROVALS ==================== -->
                <div x-show="adminTab === 'approvals'" class="space-y-8">
                    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl flex justify-between items-center">
                        <div>
                            <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block">CONTROL CENTER</span>
                            <h1 class="text-3xl font-extrabold text-[#0F0E47] tracking-tight mt-1">Facility & Equipment Requests</h1>
                            <p class="text-xs text-[#505081]">Review incoming reservation bookings submitted by students and faculty across the campus.</p>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl">
                            <span class="text-[10px] font-bold text-[#505081] uppercase tracking-wider block">TOTAL SYSTEM REQUESTS</span>
                            <h3 class="text-3xl font-extrabold text-[#0F0E47] mt-2">{{ count($reservations) }}</h3>
                            <p class="text-xs text-[#505081] mt-1">All recorded database entries</p>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl">
                            <span class="text-[10px] font-bold text-amber-600 uppercase tracking-wider block">PENDING APPROVALS</span>
                            <h3 class="text-3xl font-extrabold text-[#0F0E47] mt-2">
                                {{ $reservations->where('status', 'pending')->count() }}
                            </h3>
                            <p class="text-xs text-[#505081] mt-1">Awaiting admin review</p>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl">
                            <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider block">APPROVED & ACTIVE</span>
                            <h3 class="text-3xl font-extrabold text-[#0F0E47] mt-2">
                                {{ $reservations->where('status', 'approved')->count() }}
                            </h3>
                            <p class="text-xs text-[#505081] mt-1">Currently active bookings</p>
                        </div>
                    </div>

                    <!-- All Reservations Table -->
                    <section class="space-y-4">
                        <h3 class="text-lg font-extrabold text-[#0F0E47]">All User Reservation Requests</h3>
                        <div class="bg-white backdrop-blur-xl rounded-3xl border border-[#8686AC]/30 overflow-hidden shadow-xl">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="border-b border-[#8686AC]/30 text-[10px] font-bold text-[#505081] uppercase tracking-wider bg-[#F4F5F7]">
                                            <th class="py-4 px-6">USER / BOOKED BY</th>
                                            <th class="py-4 px-6">RESOURCE</th>
                                            <th class="py-4 px-6">DATE & PURPOSE</th>
                                            <th class="py-4 px-6">STATUS</th>
                                            <th class="py-4 px-6 text-right">ADMIN ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-[#8686AC]/20 text-xs">
                                        @forelse($reservations as $item)
                                            <tr class="hover:bg-[#F4F5F7]/80 transition">
                                                <td class="py-4 px-6 font-bold text-[#0F0E47]">
                                                    {{ $item->user->name ?? 'User #' . $item->user_id }}
                                                </td>
                                                <td class="py-4 px-6">
                                                    <span class="font-bold text-[#0F0E47] block">{{ $item->resource_name }}</span>
                                                    <span class="text-[10px] text-[#505081] capitalize">{{ $item->resource_type }} (Qty: {{ $item->quantity }})</span>
                                                </td>
                                                <td class="py-4 px-6">
                                                    <span class="font-medium text-[#272757] block">{{ $item->start_time }}</span>
                                                    <span class="text-[10px] text-[#505081]">{{ $item->purpose }}</span>
                                                </td>
                                                <td class="py-4 px-6">
                                                    <span class="px-3 py-1 text-[10px] font-bold rounded-full border shadow-sm" :class="{
                                                        'bg-emerald-50 text-emerald-700 border-emerald-300': '{{ $item->status }}' === 'approved' || '{{ $item->status }}' === 'returned',
                                                        'bg-amber-50 text-amber-700 border-amber-300': '{{ $item->status }}' === 'pending',
                                                        'bg-rose-50 text-rose-700 border-rose-300': '{{ $item->status }}' === 'cancelled'
                                                    }">{{ strtoupper($item->status) }}</span>
                                                </td>
                                                <td class="py-4 px-6 text-right space-x-2">
                                                    @if($item->status === 'pending')
                                                        <form action="{{ route('admin.reservations.approve', $item->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="px-3 py-1.5 bg-emerald-700 hover:bg-emerald-800 text-white font-bold rounded-xl transition shadow">
                                                                Approve
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.reservations.reject', $item->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="px-3 py-1.5 bg-rose-50 text-rose-700 border border-rose-300 hover:bg-rose-100 font-bold rounded-xl transition">
                                                                Reject
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="text-[11px] text-[#505081] font-semibold">Processed</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="py-8 text-center text-[#505081] text-xs">No reservations submitted in the database yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- ==================== TAB 2: INVENTORY & STOCK MANAGEMENT ==================== -->
                <div x-show="adminTab === 'inventory'" class="space-y-8" style="display: none;">
                    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl flex justify-between items-center">
                        <div>
                            <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block">STOCK & CAPACITY MONITOR</span>
                            <h1 class="text-3xl font-extrabold text-[#0F0E47] tracking-tight mt-1">Facility & Equipment Inventory</h1>
                            <p class="text-xs text-[#505081]">Real-time campus stock overview and max capacities across all rooms and gear.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-3">
                            <span class="text-[10px] font-bold text-[#505081] uppercase block">ROOM / FACILITY</span>
                            <h3 class="text-base font-bold text-[#0F0E47]">Audio-Visual Room (AVR 2)</h3>
                            <p class="text-xs text-emerald-700 font-semibold">Capacity: 50 Persons | Status: Available</p>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-3">
                            <span class="text-[10px] font-bold text-[#505081] uppercase block">ROOM / FACILITY</span>
                            <h3 class="text-base font-bold text-[#0F0E47]">Computer Laboratory 3 (ComLab)</h3>
                            <p class="text-xs text-emerald-700 font-semibold">Capacity: 40 Workstations | Status: Available</p>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-3">
                            <span class="text-[10px] font-bold text-[#505081] uppercase block">EQUIPMENT STOCK</span>
                            <h3 class="text-base font-bold text-[#0F0E47]">Epson Multimedia Projector</h3>
                            <p class="text-xs text-emerald-700 font-semibold">Stock Available: 10 Units</p>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-3">
                            <span class="text-[10px] font-bold text-[#505081] uppercase block">EQUIPMENT STOCK</span>
                            <h3 class="text-base font-bold text-[#0F0E47]">Sony Mirrorless Camera Kit</h3>
                            <p class="text-xs text-emerald-700 font-semibold">Stock Available: 5 Units</p>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-3">
                            <span class="text-[10px] font-bold text-[#505081] uppercase block">EQUIPMENT STOCK</span>
                            <h3 class="text-base font-bold text-[#0F0E47]">Wireless Microphone Set</h3>
                            <p class="text-xs text-emerald-700 font-semibold">Stock Available: 8 Units</p>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-3">
                            <span class="text-[10px] font-bold text-[#505081] uppercase block">ROOM / FACILITY</span>
                            <h3 class="text-base font-bold text-[#0F0E47]">University Covered Court</h3>
                            <p class="text-xs text-amber-700 font-semibold">Capacity: 500 Persons | Status: Limited</p>
                        </div>
                    </div>
                </div>

                <!-- ==================== TAB 3: USER MANAGEMENT ==================== -->
                <div x-show="adminTab === 'users'" class="space-y-8" style="display: none;">
                    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl flex justify-between items-center">
                        <div>
                            <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block">ACCOUNTS DIRECTORY</span>
                            <h1 class="text-3xl font-extrabold text-[#0F0E47] tracking-tight mt-1">User Management</h1>
                            <p class="text-xs text-[#505081]">Registered faculty and student accounts interacting with the reservation portal.</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-4">
                        <div class="flex items-center justify-between border-b border-[#8686AC]/30 pb-4">
                            <div>
                                <h3 class="text-sm font-extrabold text-[#0F0E47]">System Administrator</h3>
                                <p class="text-xs text-[#505081]">admin@email.com</p>
                            </div>
                            <span class="px-3 py-1 bg-rose-50 text-rose-700 border border-rose-300 rounded-full text-[10px] font-bold">ADMIN ROLE</span>
                        </div>
                        <div class="flex items-center justify-between pb-2">
                            <div>
                                <h3 class="text-sm font-extrabold text-[#0F0E47]">Prof. Robert Faculty</h3>
                                <p class="text-xs text-[#505081]">faculty@csu.edu.ph</p>
                            </div>
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-300 rounded-full text-[10px] font-bold">FACULTY</span>
                        </div>
                    </div>
                </div>

                <!-- ==================== TAB 4: REPORTS & AUDIT LOGS ==================== -->
                <div x-show="adminTab === 'reports'" class="space-y-8" style="display: none;">
                    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl flex justify-between items-center">
                        <div>
                            <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block">ANALYTICS & AUDIT</span>
                            <h1 class="text-3xl font-extrabold text-[#0F0E47] tracking-tight mt-1">System Reports & Logs</h1>
                            <p class="text-xs text-[#505081]">Exportable reservation summaries and system activity reports.</p>
                        </div>
                        <button onclick="window.print()" class="px-5 py-2.5 bg-[#0F0E47] hover:bg-[#272757] text-white text-xs font-bold rounded-xl transition shadow">
                            Print / Export PDF Report
                        </button>
                    </div>

                    <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-4">
                        <h3 class="text-base font-extrabold text-[#0F0E47]">Reservation Status Breakdown</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                            <div class="bg-[#F4F5F7] p-4 rounded-2xl border border-[#8686AC]/30">
                                <span class="font-bold text-[#505081] block">Total Bookings</span>
                                <span class="text-2xl font-extrabold text-[#0F0E47] mt-1 block">{{ count($reservations) }}</span>
                            </div>
                            <div class="bg-[#F4F5F7] p-4 rounded-2xl border border-[#8686AC]/30">
                                <span class="font-bold text-amber-700 block">Pending Review</span>
                                <span class="text-2xl font-extrabold text-amber-700 mt-1 block">{{ $reservations->where('status', 'pending')->count() }}</span>
                            </div>
                            <div class="bg-[#F4F5F7] p-4 rounded-2xl border border-[#8686AC]/30">
                                <span class="font-bold text-emerald-700 block">Successfully Approved</span>
                                <span class="text-2xl font-extrabold text-emerald-700 mt-1 block">{{ $reservations->where('status', 'approved')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- Alpine.js Admin Dashboard State -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('adminDashboard', () => ({
                adminTab: 'approvals'
            }));
        });
    </script>
</x-app-layout>