<x-app-layout>
    <div class="min-h-screen bg-[#F4F5F7] text-[#272757] font-['Inter',sans-serif] flex relative overflow-x-hidden">
        
        <!-- Admin Left Sidebar -->
        <aside class="w-64 border-r border-[#8686AC]/30 bg-white min-h-screen p-6 flex flex-col justify-between hidden md:flex sticky top-0 z-40 shadow-sm">
            <div class="space-y-8">
                <div class="px-2 pt-2">
                    <span class="text-[10px] font-bold text-rose-600 uppercase tracking-widest block">ADMINISTRATOR PANEL</span>
                </div>

                <div class="space-y-6">
                    <div>
                        <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block mb-3">MANAGEMENT</span>
                        <nav class="space-y-1">
                            <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl bg-[#0F0E47] text-white border border-[#0F0E47] text-xs font-bold transition shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>All Bookings & Approvals</span>
                            </a>
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
                        <span class="text-[10px] text-rose-600 truncate block font-semibold">Admin Access</span>
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
                    <span class="px-3 py-1 bg-rose-50 text-rose-700 border border-rose-300 rounded-full text-xs font-bold">Admin Mode Active</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-xs font-semibold text-[#505081]">Logged in as Master Custodian</span>
                </div>
            </header>

            <main class="flex-grow p-6 lg:p-10 space-y-8">
                <!-- Top Banner -->
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
                                                <span class="text-[10px] text-[#505081] capitalize">{{ $item->resource_type }}</span>
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
                                                    <span class="text-[11px] text-[#505081] font-semibold">No action needed</span>
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
            </main>
        </div>
    </div>
</x-app-layout>