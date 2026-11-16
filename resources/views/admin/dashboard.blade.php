<x-app-layout>
    <div class="min-h-screen bg-[#F4F5F7] text-[#272757] font-['Inter',sans-serif] p-6 lg:p-10">
        <div class="max-w-7xl mx-auto space-y-8">
            
            <!-- Admin Header Banner -->
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl flex justify-between items-center">
                <div>
                    <span class="text-[10px] font-bold text-[#505081] uppercase tracking-widest block">ADMINISTRATOR PORTAL</span>
                    <h1 class="text-3xl font-extrabold text-[#0F0E47] tracking-tight mt-1">Admin Control Center</h1>
                    <p class="text-xs text-[#505081]">Manage campus facility requests, approve bookings, and monitor inventory.</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-rose-50 text-rose-700 border border-rose-300 hover:bg-rose-100 text-xs font-bold rounded-xl transition">
                        Sign Out
                    </button>
                </form>
            </div>

            <!-- Admin Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl">
                    <span class="text-[10px] font-bold text-[#505081] uppercase tracking-wider block">PENDING REQUESTS</span>
                    <h3 class="text-3xl font-extrabold text-[#0F0E47] mt-2">3</h3>
                    <p class="text-xs text-[#505081] mt-1">Require your approval</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl">
                    <span class="text-[10px] font-bold text-[#505081] uppercase tracking-wider block">ACTIVE BOOKINGS</span>
                    <h3 class="text-3xl font-extrabold text-[#0F0E47] mt-2">12</h3>
                    <p class="text-xs text-[#505081] mt-1">Currently checked out / in use</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-[#8686AC]/30 shadow-xl">
                    <span class="text-[10px] font-bold text-[#505081] uppercase tracking-wider block">TOTAL SYSTEM USERS</span>
                    <h3 class="text-3xl font-extrabold text-[#0F0E47] mt-2">24</h3>
                    <p class="text-xs text-[#505081] mt-1">Registered faculty & students</p>
                </div>
            </div>

            <!-- Quick Management Panel -->
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#8686AC]/30 shadow-xl space-y-4">
                <h3 class="text-lg font-extrabold text-[#0F0E47]">Quick Management</h3>
                <p class="text-xs text-[#505081]">Review incoming reservation requests or manage resource stock availability.</p>
                
                <div class="flex gap-4 pt-2">
                    <a href="#" class="px-5 py-2.5 bg-[#0F0E47] hover:bg-[#272757] text-white text-xs font-bold rounded-xl transition shadow">
                        Manage Facility Requests
                    </a>
                    <a href="#" class="px-5 py-2.5 bg-[#F4F5F7] hover:bg-[#8686AC]/20 text-[#272757] border border-[#8686AC]/30 text-xs font-bold rounded-xl transition">
                        View Inventory Stock
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>