<x-app-layout>
<div class="min-h-screen bg-[#F4F5F7] text-[#272757] font-['Inter',sans-serif] flex relative overflow-x-hidden" x-data="adminDashboard()">

    <!-- Admin Sidebar -->
    <aside class="w-64 border-r border-[#8686AC]/30 bg-white min-h-screen p-6 hidden md:flex flex-col justify-between sticky top-0 z-40 shadow-sm">
        <div class="space-y-8">
            <div class="px-2 pt-2">
                <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block">ADMIN PORTAL</span>
                <h2 class="text-base font-extrabold text-[#0F0E47] mt-1">Master Custodian</h2>
            </div>
            <div class="space-y-6">
                <nav class="space-y-1">
                    <button @click="currentView = 'bookings'" :class="currentView === 'bookings' ? 'bg-[#0F0E47] text-white border-[#0F0E47]' : 'text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] border-transparent'" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl border text-xs font-bold transition shadow-sm">
                        <svg class="w-4 h-4 text-current" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>Bookings</span>
                    </button>
                    <a href="#" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] transition text-xs font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/></svg>
                        <span>Inventory & Stocks</span>
                    </a>
                    <a href="#" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] transition text-xs font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span>Users</span>
                    </a>
                    <a href="#" class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-[#505081] hover:text-[#0F0E47] hover:bg-[#F4F5F7] transition text-xs font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        <span>Reports</span>
                    </a>
                </nav>
            </div>
        </div>
        <div class="pt-6 border-t border-[#8686AC]/30">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-xs font-bold text-rose-600 hover:text-rose-700 transition">Sign Out</button>
            </form>
        </div>
    </aside>

    <!-- Main Viewport -->
    <main class="flex-grow p-6 lg:p-10 space-y-8">
        <div class="flex justify-between items-center bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-sm">
            <div class="flex items-center space-x-3">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-bold text-[#0F0E47]">Connected to Live Database</span>
            </div>
            <span class="text-xs font-bold text-[#505081]">Master Custodian Portal</span>
        </div>

        <!-- Stats Overview Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-1">
                <span class="text-[10px] font-bold text-[#505081] uppercase tracking-wider">TOTAL</span>
                <p class="text-3xl font-extrabold text-[#0F0E47]" x-text="reservations.length">0</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-1">
                <span class="text-[10px] font-bold text-amber-600 uppercase tracking-wider">PENDING</span>
                <p class="text-3xl font-extrabold text-[#0F0E47]" x-text="reservations.filter(r => r.status.toLowerCase() === 'pending').length">0</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-1">
                <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider">APPROVED</span>
                <p class="text-3xl font-extrabold text-[#0F0E47]" x-text="reservations.filter(r => r.status.toLowerCase() === 'approved').length">0</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-1">
                <span class="text-[10px] font-bold text-rose-600 uppercase tracking-wider">REJECTED / CANCELLED</span>
                <p class="text-3xl font-extrabold text-[#0F0E47]" x-text="reservations.filter(r => ['rejected', 'cancelled'].includes(r.status.toLowerCase())).length">0</p>
            </div>
        </div>

        <!-- Reservation List Section -->
        <div class="bg-white rounded-3xl border border-[#8686AC]/30 overflow-hidden shadow-xl space-y-4 p-6">
            <div class="flex justify-between items-center pb-4 border-b border-[#8686AC]/30">
                <div>
                    <h3 class="text-lg font-extrabold text-[#0F0E47]">Requests & Bookings</h3>
                    <p class="text-xs text-[#505081]">Review incoming student and faculty booking requests.</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#8686AC]/30 text-[10px] font-bold text-[#505081] uppercase tracking-wider bg-[#F4F5F7]">
                            <th class="py-4 px-6">USER & PURPOSE</th>
                            <th class="py-4 px-6">RESOURCE & QTY</th>
                            <th class="py-4 px-6">SCHEDULE</th>
                            <th class="py-4 px-6">STATUS</th>
                            <th class="py-4 px-6 text-right">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#8686AC]/20 text-xs">
                        <template x-for="item in reservations" :key="item.id">
                            <tr class="hover:bg-[#F4F5F7]/80 transition">
                                <td class="py-4 px-6">
                                    <span class="font-bold text-[#0F0E47] block" x-text="item.user?.name || 'User'"></span>
                                    <span class="text-[11px] text-[#505081]" x-text="item.purpose"></span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-bold text-[#0F0E47] block" x-text="item.resource_name"></span>
                                    <span class="text-[10px] text-[#505081] capitalize" x-text="item.resource_type + ' (' + item.quantity + ')'"></span>
                                </td>
                                <td class="py-4 px-6 text-[#272757] font-medium" x-text="item.start_time + ' - ' + item.end_time"></td>
                                <td class="py-4 px-6">
                                    <span class="px-3 py-1 text-[10px] font-bold rounded-full border shadow-sm uppercase" :class="{
                                        'bg-emerald-50 text-emerald-700 border-emerald-300': item.status.toLowerCase() === 'approved',
                                        'bg-amber-50 text-amber-700 border-amber-300': item.status.toLowerCase() === 'pending',
                                        'bg-rose-50 text-rose-700 border-rose-300': ['rejected', 'cancelled'].includes(item.status.toLowerCase())
                                    }" x-text="item.status"></span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <template x-if="item.status.toLowerCase() === 'pending'">
                                        <div class="flex items-center justify-end space-x-2">
                                            <!-- Approve Button -->
                                            <form :action="'/admin/reservations/' + item.id + '/approve'" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-[10px] font-bold rounded-xl shadow transition">
                                                    Approve
                                                </button>
                                            </form>

                                            <!-- Reject Button with Reason Prompt -->
                                            <button type="button" @click="
                                                let reason = prompt('Enter reason for rejection:');
                                                if (reason) {
                                                    let form = document.createElement('form');
                                                    form.method = 'POST';
                                                    form.action = '/admin/reservations/' + item.id + '/reject';
                                                    
                                                    let csrf = document.createElement('input');
                                                    csrf.type = 'hidden';
                                                    csrf.name = '_token';
                                                    csrf.value = '{{ csrf_token() }}';
                                                    form.appendChild(csrf);

                                                    let method = document.createElement('input');
                                                    method.type = 'hidden';
                                                    method.name = '_method';
                                                    method.value = 'PATCH';
                                                    form.appendChild(method);

                                                    let reasonInput = document.createElement('input');
                                                    reasonInput.type = 'hidden';
                                                    reasonInput.name = 'rejection_reason';
                                                    reasonInput.value = reason;
                                                    form.appendChild(reasonInput);

                                                    document.body.appendChild(form);
                                                    form.submit();
                                                }
                                            " class="px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-[10px] font-bold rounded-xl shadow transition">
                                                Reject
                                            </button>
                                        </div>
                                    </template>
                                    <template x-if="item.status.toLowerCase() !== 'pending'">
                                        <span class="text-xs font-bold uppercase text-[#505081]" x-text="item.status"></span>
                                    </template>
                                </td>
                            </tr>
                        </template>
                        <template x-if="reservations.length === 0">
                            <tr>
                                <td colspan="5" class="py-8 text-center text-[#505081] text-xs">No reservation requests found.</td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('adminDashboard', () => ({
        currentView: 'bookings',
        reservations: @json($reservations ?? [])
    }));
});
</script>
</x-app-layout>