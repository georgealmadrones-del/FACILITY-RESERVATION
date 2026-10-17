<x-app-layout>
    <!-- Hide default desktop header on mobile to save vertical screen space -->
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 leading-tight">
                {{ __('Campus Catalog') }}
            </h2>
            <span class="text-xs bg-blue-100 text-blue-700 font-semibold px-2.5 py-1 rounded-full">
                Live Availability
            </span>
        </div>
    </x-slot>

    <div class="py-4 pb-20 sm:py-12" x-data="{ openModal: false, selectedItem: {}, activeTab: 'all' }">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 space-y-6">

            <!-- Casual Mobile Greeting & Banner -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-5 text-white shadow-md">
                <h3 class="text-lg font-bold">Mabuhay, {{ Auth::user()?->name }}! 👋</h3>
                <p class="text-xs text-blue-100 mt-1 leading-relaxed">
                    Need a room or equipment for your group study or project? Tap any item below to view full details and book instantly.
                </p>
            </div>

            <!-- Quick Filter Pills (App-like navigation) -->
            <div class="flex space-x-2 overflow-x-auto pb-2 scrollbar-none">
                <button @click="activeTab = 'all'" :class="activeTab === 'all' ? 'bg-gray-900 text-white' : 'bg-white text-gray-600 border border-gray-200'" class="px-4 py-2 rounded-full text-xs font-semibold whitespace-nowrap shadow-sm transition">
                    ✨ All Resources
                </button>
                <button @click="activeTab = 'facilities'" :class="activeTab === 'facilities' ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 border border-gray-200'" class="px-4 py-2 rounded-full text-xs font-semibold whitespace-nowrap shadow-sm transition">
                    🏛️ Facilities & Rooms
                </button>
                <button @click="activeTab = 'equipment'" :class="activeTab === 'equipment' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-600 border border-gray-200'" class="px-4 py-2 rounded-full text-xs font-semibold whitespace-nowrap shadow-sm transition">
                    💻 Equipment & Devices
                </button>
            </div>

            <!-- SCHOOL FACILITIES SECTION -->
            <div x-show="activeTab === 'all' || activeTab === 'facilities'" class="space-y-4">
                <div class="flex items-center justify-between px-1">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider flex items-center">
                        <span class="w-2 h-2 rounded-full bg-blue-600 mr-2"></span> Facilities & Rooms
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($facilities as $facility)
                        @php
                            $imgUrl = $facility->image 
                                ? (str_starts_with($facility->image, 'http') ? $facility->image : asset($facility->image)) 
                                : 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=600&auto=format&fit=crop&q=80';
                        @endphp
                        
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between active:scale-[0.99] transition">
                            <div class="cursor-pointer group flex-1" 
                                 @click="selectedItem = { name: $el.dataset.name, desc: $el.dataset.desc, type: $el.dataset.type, stock: $el.dataset.stock, image: $el.dataset.image } ; openModal = true"
                                 data-name="{{ $facility->name }}"
                                 data-desc="{{ $facility->description ?? 'No description provided.' }}"
                                 data-type="Facility Room"
                                 data-stock="Available for Booking"
                                 data-image="{{ $imgUrl }}">
                                
                                <div class="relative h-40 bg-gray-100 overflow-hidden">
                                    <img src="{{ $imgUrl }}" alt="{{ $facility->name }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                                    <span class="absolute top-3 right-3 px-2 py-0.5 text-[10px] font-bold text-green-800 bg-green-100/90 backdrop-blur rounded-full shadow-sm">
                                        {{ ucfirst($facility->status) }}
                                    </span>
                                    <h4 class="absolute bottom-3 left-3 right-3 font-bold text-white text-sm leading-snug drop-shadow">
                                        {{ $facility->name }}
                                    </h4>
                                </div>

                                <div class="p-4 space-y-3">
                                    <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                                        {{ $facility->description ?? 'Tap to view room specifications and schedule.' }}
                                    </p>
                                    
                                    <!-- Schedule pill -->
                                    <div class="bg-gray-50 rounded-xl p-2.5 border border-gray-100 text-[11px]">
                                        <span class="font-semibold text-gray-600 block mb-1">📅 Next Schedule:</span>
                                        @if($facility->reservations->count() > 0)
                                            <span class="text-amber-700 font-medium">Reserved: {{ \Carbon\Carbon::parse($facility->reservations->first()->start_time)->format('M d, g:i A') }}</span>
                                        @else
                                            <span class="text-green-600 font-medium">✨ Fully open for reservation</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 pt-0">
                                <a href="{{ route('reservations.create', ['facility_id' => $facility->id]) }}" class="w-full block text-center bg-gray-900 active:bg-blue-700 hover:bg-blue-600 text-white text-xs font-bold py-2.5 rounded-xl transition shadow-sm">
                                    Book This Room ➔
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- EQUIPMENT & DEVICES SECTION -->
            <div x-show="activeTab === 'all' || activeTab === 'equipment'" class="space-y-4 pt-2">
                <div class="flex items-center justify-between px-1">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider flex items-center">
                        <span class="w-2 h-2 rounded-full bg-indigo-600 mr-2"></span> Equipment & Devices
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($equipment as $item)
                        @php
                            $itemImgUrl = $item->image 
                                ? (str_starts_with($item->image, 'http') ? $item->image : asset($item->image)) 
                                : 'https://images.unsplash.com/photo-1535223289827-42f1e9919769?w=600&auto=format&fit=crop&q=80';
                        @endphp

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between active:scale-[0.99] transition">
                            <div class="cursor-pointer group flex-1" 
                                 @click="selectedItem = { name: $el.dataset.name, desc: $el.dataset.desc, type: $el.dataset.type, stock: $el.dataset.stock, image: $el.dataset.image } ; openModal = true"
                                 data-name="{{ $item->name }}"
                                 data-desc="{{ $item->description ?? 'No description provided.' }}"
                                 data-type="Equipment Unit"
                                 data-stock="{{ $item->total_stock }} Units Available"
                                 data-image="{{ $itemImgUrl }}">
                                 
                                <div class="relative h-40 bg-gray-100 overflow-hidden">
                                    <img src="{{ $itemImgUrl }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                                    <span class="absolute top-3 right-3 px-2 py-0.5 text-[10px] font-bold text-green-800 bg-green-100/90 backdrop-blur rounded-full shadow-sm">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                    <h4 class="absolute bottom-3 left-3 right-3 font-bold text-white text-sm leading-snug drop-shadow">
                                        {{ $item->name }}
                                    </h4>
                                </div>

                                <div class="p-4 space-y-3">
                                    <div class="flex justify-between items-center text-xs">
                                        <span class="text-gray-500">Stock Pool:</span>
                                        <span class="font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md">{{ $item->total_stock }} units</span>
                                    </div>
                                    <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                                        {{ $item->description ?? 'Tap to view specs and availability.' }}
                                    </p>
                                    
                                    <div class="bg-gray-50 rounded-xl p-2.5 border border-gray-100 text-[11px]">
                                        <span class="font-semibold text-gray-600 block mb-1">📅 Next Schedule:</span>
                                        @if($item->reservations->count() > 0)
                                            <span class="text-amber-700 font-medium">Reserved: {{ \Carbon\Carbon::parse($item->reservations->first()->start_time)->format('M d, g:i A') }}</span>
                                        @else
                                            <span class="text-green-600 font-medium">✨ Ready for checkout</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 pt-0">
                                <a href="{{ route('reservations.create', ['equipment_id' => $item->id]) }}" class="w-full block text-center bg-gray-900 active:bg-indigo-700 hover:bg-indigo-600 text-white text-xs font-bold py-2.5 rounded-xl transition shadow-sm">
                                    Request Equipment ➔
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        <!-- MODERN SLIDE-UP BOTTOM SHEET MODAL (Mobile Friendly) -->
        <div x-show="openModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 bg-gray-900/60 backdrop-blur-sm flex items-end sm:items-center justify-center p-0 sm:p-4" 
             style="display: none;"
             @keydown.escape.window="openModal = false">
            
            <div @click.away="openModal = false" 
                 class="bg-white rounded-t-3xl sm:rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl transform transition-all max-h-[90vh] flex flex-col">
                
                <!-- Modal Header Image -->
                <div class="relative h-56 bg-gray-100 shrink-0">
                    <img :src="selectedItem.image" :alt="selectedItem.name" class="w-full h-full object-cover">
                    <button @click="openModal = false" class="absolute top-4 right-4 bg-black/60 text-white rounded-full p-2 hover:bg-black/80 transition">
                        ✕
                    </button>
                </div>

                <!-- Modal Body Content -->
                <div class="p-6 space-y-4 overflow-y-auto">
                    <div class="flex justify-between items-center">
                        <span class="px-3 py-1 text-xs font-bold bg-blue-50 text-blue-700 rounded-full" x-text="selectedItem.type"></span>
                        <span class="text-xs font-bold text-gray-500 bg-gray-100 px-3 py-1 rounded-full" x-text="selectedItem.stock"></span>
                    </div>
                    
                    <h3 class="text-lg font-extrabold text-gray-900 leading-snug" x-text="selectedItem.name"></h3>
                    <p class="text-xs text-gray-600 leading-relaxed whitespace-pre-line bg-gray-50 p-4 rounded-2xl border border-gray-100" x-text="selectedItem.desc"></p>
                    
                    <div class="pt-2">
                        <button @click="openModal = false" class="w-full bg-gray-900 hover:bg-black text-white py-3 rounded-xl text-xs font-bold transition shadow-sm">
                            Got it, close preview
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>