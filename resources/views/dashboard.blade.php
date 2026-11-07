<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#09090B] min-h-screen text-zinc-100" x-data="{ openModal: false, selectedItem: {} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- User Header Card (Clickable Profile) -->
            <a href="{{ route('profile.edit') }}" class="block group">
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] shadow-xl group-hover:border-zinc-500 transition-all duration-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-800 border border-zinc-700 text-zinc-100 font-bold flex items-center justify-center text-lg shadow-inner group-hover:border-zinc-600 transition">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div>
                            <div class="flex items-center space-x-2">
                                <h3 class="text-lg font-bold text-white group-hover:text-zinc-200 transition">{{ Auth::user()->name }}</h3>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-950 text-emerald-400 border border-emerald-800 flex items-center space-x-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse mr-1"></span>
                                    Active Now
                                </span>
                            </div>
                            <p class="text-xs text-zinc-400">{{ Auth::user()->email }} • <span class="capitalize font-medium text-zinc-300">{{ Auth::user()->role }}</span></p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        <span class="px-4 py-2 text-xs font-bold text-zinc-200 bg-zinc-800 group-hover:bg-zinc-700 rounded-xl border border-zinc-700 transition shadow-sm">
                            Edit Profile &rarr;
                        </span>
                        <a href="{{ route('reservations.create') }}" @click.stop class="px-4 py-2 text-xs font-bold text-white bg-zinc-100 hover:bg-white text-zinc-950 rounded-xl transition shadow-md">
                            + Reserve Resource
                        </a>
                    </div>
                </div>
            </a>

            <!-- My Reservations Section (With Working Cancellation Form) -->
            <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] shadow-xl">
                <div class="flex justify-between items-center mb-4 pb-3 border-b border-[#27272A]">
                    <h3 class="text-base font-bold text-white flex items-center">
                        <span class="bg-purple-500 w-2 h-5 rounded-full mr-2"></span>
                        My Recent Reservations
                    </h3>
                    <a href="{{ route('reservations.index') }}" class="text-xs font-medium text-zinc-400 hover:text-white transition">View All</a>
                </div>

                <div class="space-y-3">
                    @isset($myReservations)
                        @forelse($myReservations as $reservation)
                            <div class="p-4 rounded-xl border border-[#27272A] flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 bg-[#09090B]/50 hover:border-zinc-700 transition">
                                <div>
                                    <div class="flex items-center space-x-2">
                                        <h4 class="font-semibold text-sm text-zinc-100">
                                            {{ $reservation->facility->name ?? $reservation->equipment->name ?? 'Resource' }}
                                        </h4>
                                        <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase rounded-full 
                                            {{ $reservation->status === 'approved' ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : ($reservation->status === 'pending' ? 'bg-amber-950 text-amber-400 border border-amber-800' : 'bg-red-950 text-red-400 border border-red-800') }}">
                                            {{ $reservation->status }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-zinc-400 mt-1">
                                        🕒 {{ $reservation->start_time }} to {{ $reservation->end_time }}
                                        @if($reservation->quantity)
                                            • Qty: {{ $reservation->quantity }}
                                        @endif
                                    </p>
                                </div>

                                <!-- Cancellation Form using the correct route -->
                                @if(in_array($reservation->status, ['pending', 'approved']))
                                    <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-3.5 py-1.5 bg-red-950/50 hover:bg-red-900/50 text-red-400 rounded-lg text-xs font-semibold transition border border-red-900">
                                            Cancel Reservation
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @empty
                            <p class="text-xs text-zinc-500 text-center py-6">You have no active reservations yet.</p>
                        @endforelse
                    @endisset
                </div>
            </div>

            <!-- Two Column Catalogs -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- FACILITIES COLUMN -->
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] shadow-xl">
                    <div class="flex justify-between items-center mb-4 pb-3 border-b border-[#27272A]">
                        <h3 class="text-base font-bold text-white flex items-center">
                            <span class="bg-blue-500 w-2 h-5 rounded-full mr-2"></span>
                            Available Facilities & Rooms
                        </h3>
                        <a href="{{ route('reservations.availability') }}" class="text-xs font-medium text-zinc-400 hover:text-white transition">View All</a>
                    </div>

                    <div class="space-y-3">
                        @isset($facilities)
                            @foreach($facilities as $facility)
                                @php
                                    $imgUrl = $facility->image 
                                        ? (str_starts_with($facility->image, 'http') ? $facility->image : asset('storage/' . $facility->image)) 
                                        : 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=600&auto=format&fit=crop&q=80';
                                @endphp

                                <div class="p-4 rounded-xl border border-[#27272A] hover:border-zinc-500 hover:bg-zinc-900/45 transition cursor-pointer group"
                                     @click="selectedItem = { 
                                         name: $el.dataset.name, 
                                         desc: $el.dataset.desc, 
                                         type: $el.dataset.type, 
                                         stock: $el.dataset.stock, 
                                         image: $el.dataset.image 
                                     } ; openModal = true"
                                     data-name="{{ $facility->name }}"
                                     data-desc="{{ $facility->description ?? 'No description provided.' }}"
                                     data-type="Facility"
                                     data-stock="Capacity: {{ $facility->capacity ?? 30 }} Persons"
                                     data-image="{{ $imgUrl }}">
                                    
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-semibold text-sm text-zinc-100 group-hover:text-white transition">{{ $facility->name }}</h4>
                                        <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-950 text-emerald-400 border border-emerald-800">
                                            {{ ucfirst($facility->status) }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-zinc-400 mt-1">Capacity: <span class="font-semibold text-zinc-200">{{ $facility->capacity ?? 30 }} Persons</span></p>
                                    <p class="text-xs text-zinc-500 line-clamp-2 mt-1">{{ $facility->description }}</p>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>

                <!-- EQUIPMENT COLUMN -->
                <div class="bg-[#18181B] p-6 rounded-2xl border border-[#27272A] shadow-xl">
                    <div class="flex justify-between items-center mb-4 pb-3 border-b border-[#27272A]">
                        <h3 class="text-base font-bold text-white flex items-center">
                            <span class="bg-indigo-500 w-2 h-5 rounded-full mr-2"></span>
                            Available Equipment
                        </h3>
                        <a href="{{ route('reservations.availability') }}" class="text-xs font-medium text-zinc-400 hover:text-white transition">View All</a>
                    </div>

                    <div class="space-y-3">
                        @isset($equipment)
                            @foreach($equipment as $item)
                                @php
                                    $itemImgUrl = $item->image 
                                        ? (str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image)) 
                                        : 'https://images.unsplash.com/photo-1535223289827-42f1e9919769?w=600&auto=format&fit=crop&q=80';
                                    
                                    $availableUnits = $item->live_available_stock ?? $item->total_stock;
                                @endphp

                                <div class="p-4 rounded-xl border border-[#27272A] hover:border-zinc-500 hover:bg-zinc-900/45 transition cursor-pointer group"
                                     @click="selectedItem = { 
                                         name: $el.dataset.name, 
                                         desc: $el.dataset.desc, 
                                         type: $el.dataset.type, 
                                         stock: $el.dataset.stock, 
                                         image: $el.dataset.image 
                                     } ; openModal = true"
                                     data-name="{{ $item->name }}"
                                     data-desc="{{ $item->description ?? 'No description provided.' }}"
                                     data-type="Equipment"
                                     data-stock="{{ $availableUnits }} / {{ $item->total_stock }} available"
                                     data-image="{{ $itemImgUrl }}">
                                    
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-semibold text-sm text-zinc-100 group-hover:text-white transition">{{ $item->name }}</h4>
                                        <span class="px-2.5 py-0.5 text-[10px] font-bold {{ $availableUnits > 0 ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : 'bg-red-950 text-red-400 border border-red-900' }} rounded-full">
                                            {{ $availableUnits > 0 ? 'Available' : 'Out of Stock' }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-zinc-400 mt-1">
                                        Stock: <span class="font-semibold text-zinc-200">{{ $availableUnits }} / {{ $item->total_stock }} units available</span>
                                    </p>
                                    <p class="text-xs text-zinc-500 line-clamp-2 mt-0.5">{{ $item->description }}</p>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>

            </div>

        </div>

        <!-- INTERACTIVE PREVIEW MODAL -->
        <div x-show="openModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-80 flex items-center justify-center p-4 backdrop-blur-sm" 
             style="display: none;"
             @keydown.escape.window="openModal = false">
            
            <div @click.away="openModal = false" 
                 class="bg-[#18181B] rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl transform transition-all border border-[#27272A] text-zinc-100">
                
                <div class="relative h-64 bg-zinc-900">
                    <img :src="selectedItem.image" :alt="selectedItem.name" class="w-full h-full object-cover">
                    <button @click="openModal = false" class="absolute top-4 right-4 bg-black bg-opacity-70 text-white rounded-full p-2.5 hover:bg-opacity-90 transition duration-150 border border-zinc-700">
                        ✕
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="px-3 py-1 text-xs font-bold bg-zinc-800 text-zinc-200 rounded-full border border-zinc-700 shadow-inner" x-text="selectedItem.type"></span>
                        <span class="text-xs font-semibold text-zinc-400 bg-zinc-900 px-3 py-1 rounded-lg border border-zinc-800" x-text="selectedItem.stock"></span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-white tracking-tight" x-text="selectedItem.name"></h3>
                    <p class="text-sm text-zinc-400 leading-relaxed whitespace-pre-line" x-text="selectedItem.desc"></p>
                    
                    <div class="flex justify-end pt-4 border-t border-[#27272A]">
                        <button @click="openModal = false" class="bg-zinc-800 hover:bg-zinc-700 text-zinc-200 px-5 py-2.5 rounded-xl text-xs font-bold transition border border-zinc-700 shadow-inner">
                            Close Preview
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>