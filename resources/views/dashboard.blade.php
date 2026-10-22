<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-extrabold text-pink-950 tracking-tight">
                    Student Dashboard ✨
                </h2>
                <p class="text-xs text-pink-700/80 mt-0.5 font-medium">Welcome to your central resource and reservation portal.</p>
            </div>
            <a href="{{ route('reservations.create') }}" class="px-4 py-2.5 bg-gradient-to-r from-pink-400 via-rose-400 to-purple-400 hover:from-pink-500 hover:to-purple-500 text-white rounded-2xl text-xs font-bold transition shadow-md shadow-pink-300/40 flex items-center space-x-1.5">
                <span>+ Reserve Resource</span>
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-pink-100/60 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- USER WELCOME PROFILE CARD -->
            <div class="bg-white/90 p-6 rounded-3xl border border-pink-200 shadow-xl shadow-pink-500/5 backdrop-blur-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-pink-400 via-rose-400 to-purple-400 flex items-center justify-center text-white font-extrabold text-xl shadow-lg shadow-pink-300/50 ring-4 ring-pink-50">
                        {{ strtoupper(substr(Auth::user()->name ?? 'G', 0, 2)) }}
                    </div>
                    <div class="space-y-0.5">
                        <div class="flex items-center space-x-2">
                            <h3 class="text-lg font-bold text-pink-950">{{ Auth::user()->name ?? 'Student User' }}[cite: 4]</h3>
                            <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-pink-100 text-pink-700 uppercase tracking-wider border border-pink-200">Active Now[cite: 4]</span>
                        </div>
                        <p class="text-xs text-pink-700/80">{{ Auth::user()->email ?? 'student@email.com' }} &bull; <span class="capitalize font-semibold">{{ Auth::user()->role ?? 'Student' }}[cite: 4]</span></p>
                    </div>
                </div>

                <div class="flex items-center space-x-3 w-full md:w-auto justify-end border-t md:border-t-0 border-pink-100 pt-4 md:pt-0">
                    <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-pink-50 hover:bg-pink-100 text-pink-800 rounded-xl text-xs font-bold border border-pink-200 transition">
                        Edit Profile[cite: 4]
                    </a>
                    <a href="{{ route('reservations.create') }}" class="px-4 py-2 bg-gradient-to-r from-pink-400 to-rose-400 hover:from-pink-500 hover:to-rose-500 text-white rounded-xl text-xs font-bold transition shadow-md shadow-pink-200">
                        + Reserve Resource[cite: 4]
                    </a>
                </div>
            </div>

            <!-- MY RECENT RESERVATIONS -->
            <div class="bg-white/90 p-6 rounded-3xl border border-pink-200 shadow-xl shadow-pink-500/5 backdrop-blur-xl space-y-4">
                <div class="flex justify-between items-center pb-3 border-b border-pink-100">
                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 rounded-full bg-pink-500 animate-pulse"></span>
                        <h3 class="font-extrabold text-base text-pink-950">My Recent Reservations[cite: 4]</h3>
                    </div>
                    <a href="{{ route('reservations.index') }}" class="text-xs font-bold text-pink-600 hover:text-pink-700 hover:underline">
                        View All &rarr;
                    </a>
                </div>

                @if(isset($myReservations) && $myReservations->count() > 0)
                    <div class="space-y-3">
                        @foreach($myReservations->take(3) as $res)
                            @php
                                $itemTitle = $res->facility?->name ?? $res->equipment?->name ?? 'Resource';
                                $scheduleFormatted = \Carbon\Carbon::parse($res->start_time)->format('M d, Y g:i A') . ' → ' . \Carbon\Carbon::parse($res->end_time)->format('g:i A');
                            @endphp
                            <div class="p-4 rounded-2xl bg-pink-50/50 border border-pink-100 flex justify-between items-center transition hover:bg-pink-50">
                                <div class="space-y-1">
                                    <div class="flex items-center space-x-2">
                                        @if($res->facility_id)
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-pink-100 text-pink-700">Facility</span>
                                        @endif
                                        @if($res->equipment_id)
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-purple-100 text-purple-700">Equipment</span>
                                        @endif
                                    </div>
                                    <h4 class="font-bold text-pink-950 text-sm">{{ $itemTitle }}</h4>
                                    <p class="text-xs text-pink-800/70"><span class="font-semibold">Schedule:</span> {{ $scheduleFormatted }}</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-bold rounded-full border uppercase tracking-wider
                                    {{ $res->status === 'approved' ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : '' }}
                                    {{ $res->status === 'pending' ? 'bg-amber-100 text-amber-800 border-amber-200' : '' }}
                                    {{ $res->status === 'rejected' ? 'bg-rose-100 text-rose-800 border-rose-200' : '' }}
                                    {{ $res->status === 'cancelled' ? 'bg-stone-100 text-stone-700 border-stone-200' : '' }}">
                                    {{ ucfirst($res->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-8 text-center">
                        <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-pink-100 flex items-center justify-center text-pink-500 font-bold">🌸</div>
                        <p class="text-sm font-semibold text-pink-950">You have no active reservations yet[cite: 4].</p>
                        <p class="text-xs text-pink-700/70 mt-1">Explore available facilities and equipment below to make a booking!</p>
                    </div>
                @endif
            </div>

            <!-- FACILITIES AND EQUIPMENT GRIDS -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Available Facilities -->
                <div class="bg-white/90 p-6 rounded-3xl border border-pink-200 shadow-xl shadow-pink-500/5 backdrop-blur-xl space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b border-pink-100">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-rose-400"></span>
                            <h3 class="font-extrabold text-base text-pink-950">Available Facilities & Rooms[cite: 4]</h3>
                        </div>
                        <a href="{{ route('reservations.create') }}" class="text-xs font-bold text-pink-600 hover:underline">View All</a>
                    </div>
                    
                    <div class="space-y-3">
                        @if(isset($facilities) && $facilities->count() > 0)
                            @foreach($facilities->take(3) as $facility)
                                <div class="p-4 rounded-2xl bg-pink-50/40 border border-pink-100 hover:border-pink-200 transition space-y-2">
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-bold text-pink-950 text-sm">{{ $facility->name }}[cite: 4]</h4>
                                        <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">Available[cite: 4]</span>
                                    </div>
                                    <p class="text-xs text-pink-800/70 line-clamp-2">{{ $facility->description }}[cite: 4]</p>
                                </div>
                            @endforeach
                        @else
                            <div class="p-4 rounded-2xl bg-pink-50/40 border border-pink-100 space-y-2">
                                <div class="flex justify-between items-start">
                                    <h4 class="font-bold text-pink-950 text-sm">Outdoor Student Pavilion[cite: 4]</h4>
                                    <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">Available[cite: 4]</span>
                                </div>
                                <p class="text-xs text-pink-800/70">Open-air campus pavilion equipped with study benches and natural surroundings for collaborative learning[cite: 4].</p>
                            </div>
                            <div class="p-4 rounded-2xl bg-pink-50/40 border border-pink-100 space-y-2">
                                <div class="flex justify-between items-start">
                                    <h4 class="font-bold text-pink-950 text-sm">Computer Laboratory 3[cite: 4]</h4>
                                    <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">Available[cite: 4]</span>
                                </div>
                                <p class="text-xs text-pink-800/70">Equipped with 40 high-performance workstations, fiber internet, and dual-display developer environments[cite: 4].</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Available Equipment -->
                <div class="bg-white/90 p-6 rounded-3xl border border-pink-200 shadow-xl shadow-pink-500/5 backdrop-blur-xl space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b border-pink-100">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                            <h3 class="font-extrabold text-base text-pink-950">Available Equipment[cite: 4]</h3>
                        </div>
                        <a href="{{ route('reservations.create') }}" class="text-xs font-bold text-pink-600 hover:underline">View All</a>
                    </div>
                    
                    <div class="space-y-3">
                        @if(isset($equipmentList) && $equipmentList->count() > 0)
                            @foreach($equipmentList->take(3) as $item)
                                <div class="p-4 rounded-2xl bg-pink-50/40 border border-pink-100 hover:border-pink-200 transition space-y-1.5">
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-bold text-pink-950 text-sm">{{ $item->name }}[cite: 4]</h4>
                                        <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">Available[cite: 4]</span>
                                    </div>
                                    <p class="text-xs font-semibold text-pink-600">Stock: {{ $item->quantity }} units available[cite: 4]</p>
                                    <p class="text-xs text-pink-800/70 line-clamp-1">{{ $item->description }}[cite: 4]</p>
                                </div>
                            @endforeach
                        @else
                            <div class="p-4 rounded-2xl bg-pink-50/40 border border-pink-100 space-y-1.5">
                                <div class="flex justify-between items-start">
                                    <h4 class="font-bold text-pink-950 text-sm">Epson Multimedia Projector[cite: 4]</h4>
                                    <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">Available[cite: 4]</span>
                                </div>
                                <p class="text-xs font-semibold text-pink-600">Stock: 12 / 12 units available[cite: 4]</p>
                                <p class="text-xs text-pink-800/70">Portable classroom projector with HDMI, wireless casting, and wide-angle projection lens[cite: 4].</p>
                            </div>
                            <div class="p-4 rounded-2xl bg-pink-50/40 border border-pink-100 space-y-1.5">
                                <div class="flex justify-between items-start">
                                    <h4 class="font-bold text-pink-950 text-sm">High Speed Pocket WiFi LTE Modem[cite: 4]</h4>
                                    <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">Available[cite: 4]</span>
                                </div>
                                <p class="text-xs font-semibold text-pink-600">Stock: 30 / 30 units available[cite: 4]</p>
                                <p class="text-xs text-pink-800/70">Portable cellular hotspot router providing high-speed mobile internet connectivity across campus[cite: 4].</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>