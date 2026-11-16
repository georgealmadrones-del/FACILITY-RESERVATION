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
                        <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block mb-3">DATABASE MANAGEMENT</span>
                        <nav class="space-y-1">
                            <button @click="adminTab = 'approvals'" :class="adminTab === 'approvals' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                                <span>Bookings & Approvals</span>
                            </button>
                            <button @click="adminTab = 'inventory'" :class="adminTab === 'inventory' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                                <span>Facility & Stock Inventory</span>
                            </button>
                            <button @click="adminTab = 'users'" :class="adminTab === 'users' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                                <span>User Management</span>
                            </button>
                            <button @click="adminTab = 'reports'" :class="adminTab === 'reports' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                                <span>Reports & Audit Logs</span>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Sidebar Footer -->
            <div class="pt-6 border-t border-[#8686AC]/30 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-xl bg-[#0F0E47] flex items-center justify-center font-bold text-xs text-white">AD</div>
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
                <span class="px-3 py-1 bg-rose-50 text-rose-700 border border-rose-300 rounded-full text-xs font-bold">Live Database Mode Active</span>
                <span class="text-xs font-semibold text-[#505081]">Logged in as Master Custodian</span>
            </header>

            <main class="flex-grow p-6 lg:p-10 space-y-8">
                
                <!-- ==================== TAB 1: BOOKINGS & APPROVALS ==================== -->
                <div x-show="adminTab === 'approvals'" class="space-y-8">
                    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl flex justify-between items-center">
                        <div>
                            <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block">CONTROL CENTER</span>
                            <h1 class="text-3xl font-extrabold text-[#0F0E47] tracking-tight mt-1">Facility & Equipment Requests</h1>
                            <p class="text-xs text-[#505081]">Real-time database reservations awaiting review.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl">
                            <span class="text-[10px] font-bold text-[#505081] uppercase tracking-wider block">TOTAL REQUESTS</span>
                            <h3 class="text-3xl font-extrabold text-[#0F0E47] mt-2">{{ count($reservations) }}</h3>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl">
                            <span class="text-[10px] font-bold text-amber-600 uppercase tracking-wider block">PENDING</span>
                            <h3 class="text-3xl font-extrabold text-[#0F0E47] mt-2">{{ $reservations->where('status', 'pending')->count() }}</h3>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl">
                            <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider block">APPROVED</span>
                            <h3 class="text-3xl font-extrabold text-[#0F0E47] mt-2">{{ $reservations->where('status', 'approved')->count() }}</h3>
                        </div>
                    </div>

                    <section class="space-y-4">
                        <h3 class="text-lg font-extrabold text-[#0F0E47]">All Database Reservations</h3>
                        <div class="bg-white rounded-3xl border border-[#8686AC]/30 overflow-hidden shadow-xl">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-[#8686AC]/30 text-[10px] font-bold text-[#505081] uppercase bg-[#F4F5F7]">
                                        <th class="py-4 px-6">User</th>
                                        <th class="py-4 px-6">Resource</th>
                                        <th class="py-4 px-6">Date & Purpose</th>
                                        <th class="py-4 px-6">Status</th>
                                        <th class="py-4 px-6 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#8686AC]/20 text-xs">
                                    @forelse($reservations as $item)
                                        <tr class="hover:bg-[#F4F5F7]/80 transition">
                                            <td class="py-4 px-6 font-bold text-[#0F0E47]">{{ $item->user->name ?? 'User #' . $item->user_id }}</td>
                                            <td class="py-4 px-6"><span class="font-bold text-[#0F0E47] block">{{ $item->resource_name }}</span><span class="text-[10px] text-[#505081]">Qty: {{ $item->quantity }}</span></td>
                                            <td class="py-4 px-6"><span class="block">{{ $item->start_time }}</span><span class="text-[10px] text-[#505081]">{{ $item->purpose }}</span></td>
                                            <td class="py-4 px-6"><span class="px-3 py-1 text-[10px] font-bold rounded-full border">{{ strtoupper($item->status) }}</span></td>
                                            <td class="py-4 px-6 text-right space-x-2">
                                                @if($item->status === 'pending')
                                                    <form action="{{ route('admin.reservations.approve', $item->id) }}" method="POST" class="inline">@csrf<button type="submit" class="px-3 py-1.5 bg-emerald-700 text-white font-bold rounded-xl">Approve</button></form>
                                                    <form action="{{ route('admin.reservations.reject', $item->id) }}" method="POST" class="inline">@csrf<button type="submit" class="px-3 py-1.5 bg-rose-50 text-rose-700 border border-rose-300 rounded-xl">Reject</button></form>
                                                @else
                                                    <span class="text-[11px] text-[#505081] font-semibold">Processed</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="py-8 text-center text-[#505081] text-xs">No database reservations found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>

                <!-- ==================== TAB 2: INVENTORY & STOCK MANAGEMENT ==================== -->
                <div x-show="adminTab === 'inventory'" class="space-y-8" style="display: none;">
                    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl flex justify-between items-center">
                        <div>
                            <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block">DATABASE INVENTORY</span>
                            <h1 class="text-3xl font-extrabold text-[#0F0E47] tracking-tight mt-1">Manage Facilities & Equipment</h1>
                            <p class="text-xs text-[#505081]">Add, edit, or remove items from the live database tables.</p>
                        </div>
                    </div>

                    <!-- Add Facility Form -->
                    <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-4">
                        <h3 class="text-base font-extrabold text-[#0F0E47]">Add New Facility / Room</h3>
                        <form action="{{ route('admin.facilities.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                            @csrf
                            <input type="text" name="name" placeholder="Facility Name" required class="rounded-xl border-[#8686AC]/30 text-xs">
                            <input type="number" name="capacity" placeholder="Capacity" required class="rounded-xl border-[#8686AC]/30 text-xs">
                            <select name="status" class="rounded-xl border-[#8686AC]/30 text-xs">
                                <option value="Available">Available</option>
                                <option value="Maintenance">Maintenance</option>
                            </select>
                            <button type="submit" class="bg-[#0F0E47] text-white font-bold rounded-xl text-xs py-2">Add Facility</button>
                        </form>
                    </div>

                    <!-- Facilities List -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($facilities as $facility)
                            <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl flex justify-between items-center">
                                <div>
                                    <h3 class="text-base font-bold text-[#0F0E47]">{{ $facility->name }}</h3>
                                    <p class="text-xs text-[#505081]">Capacity: {{ $facility->capacity }} | Status: {{ $facility->status }}</p>
                                </div>
                                <form action="{{ route('admin.facilities.delete', $facility->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-800 text-xs font-bold">Delete</button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add Equipment Form -->
                    <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-4 mt-8">
                        <h3 class="text-base font-extrabold text-[#0F0E47]">Add New Equipment</h3>
                        <form action="{{ route('admin.equipment.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-5 gap-4">
                            @csrf
                            <input type="text" name="name" placeholder="Equipment Name" required class="rounded-xl border-[#8686AC]/30 text-xs">
                            <input type="number" name="quantity" placeholder="Stock Qty" required class="rounded-xl border-[#8686AC]/30 text-xs">
                            <input type="text" name="category" placeholder="Category" required class="rounded-xl border-[#8686AC]/30 text-xs">
                            <select name="status" class="rounded-xl border-[#8686AC]/30 text-xs">
                                <option value="Available">Available</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                            <button type="submit" class="bg-[#0F0E47] text-white font-bold rounded-xl text-xs py-2">Add Equipment</button>
                        </form>
                    </div>

                    <!-- Equipment List -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($equipment as $item)
                            <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl flex justify-between items-center">
                                <div>
                                    <h3 class="text-base font-bold text-[#0F0E47]">{{ $item->name }}</h3>
                                    <p class="text-xs text-[#505081]">Stock: {{ $item->quantity }} | Category: {{ $item->category }}</p>
                                </div>
                                <form action="{{ route('admin.equipment.delete', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-800 text-xs font-bold">Delete</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- ==================== TAB 3: USER MANAGEMENT ==================== -->
                <div x-show="adminTab === 'users'" class="space-y-8" style="display: none;">
                    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl flex justify-between items-center">
                        <div>
                            <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block">DATABASE USERS</span>
                            <h1 class="text-3xl font-extrabold text-[#0F0E47] tracking-tight mt-1">User Accounts Directory</h1>
                            <p class="text-xs text-[#505081]">Manage registered students and faculty accounts.</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-4">
                        @foreach($users as $usr)
                            <div class="flex items-center justify-between border-b border-[#8686AC]/20 pb-4">
                                <div>
                                    <h3 class="text-sm font-extrabold text-[#0F0E47]">{{ $usr->name }}</h3>
                                    <p class="text-xs text-[#505081]">{{ $usr->email }}</p>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-300 rounded-full text-[10px] font-bold uppercase">{{ $usr->role ?? 'user' }}</span>
                                    @if($usr->email !== 'admin@email.com')
                                        <form action="{{ route('admin.users.toggle', $usr->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-700 border border-rose-300 text-[10px] font-bold rounded-xl">Toggle Status</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- ==================== TAB 4: REPORTS ==================== -->
                <div x-show="adminTab === 'reports'" class="space-y-8" style="display: none;">
                    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl flex justify-between items-center">
                        <div>
                            <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block">ANALYTICS</span>
                            <h1 class="text-3xl font-extrabold text-[#0F0E47] tracking-tight mt-1">System Reports</h1>
                        </div>
                        <button onclick="window.print()" class="px-5 py-2.5 bg-[#0F0E47] text-white text-xs font-bold rounded-xl">Print Report</button>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('adminDashboard', () => ({ adminTab: 'approvals' }));
        });
    </script>
</x-app-layout>