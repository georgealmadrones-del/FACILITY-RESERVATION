<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ openModal: false, selectedItem: {} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- User Header Card -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center text-lg shadow-inner">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <h3 class="text-lg font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                            <span class="px-2 py-0.5 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Active Now</span>
                        </div>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }} • <span class="capitalize font-medium text-blue-600">{{ Auth::user()->role }}</span></p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('profile.edit') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                        Edit Profile
                    </a>
                    <a href="{{ route('reservations.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition shadow-sm">
                        + Reserve Resource
                    </a>
                </div>
            </div>

            <!-- Two Column Catalogs -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- FACILITIES COLUMN -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <div class="flex justify-between items-center mb-4 pb-2 border-b border-gray-100">
                        <h3 class="text-base font-bold text-gray-900 flex items-center">
                            <span class="bg-blue-600 text-white w-2 h-5 rounded-full mr-2"></span>
                            Available Facilities & Rooms
                        </h3>
                        <a href="{{ route('reservations.availability') }}" class="text-xs font-medium text-blue-600 hover:underline">View All</a>
                    </div>

                    <div class="space-y-3">
                        @isset($facilities)
                            @foreach($facilities as $facility)
                                @php
                                    $imgUrl = $facility->image 
                                        ? (str_starts_with($facility->image, 'http') ? $facility->image : asset('storage/' . $facility->image)) 
                                        : 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=600&auto=format&fit=crop&q=80';
                                @endphp

                                <div class="p-4 rounded-lg border border-gray-100 hover:border-blue-300 hover:bg-blue-50/30 transition cursor-pointer group"
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
                                     data-stock="N/A (Room)"
                                     data-image="{{ $imgUrl }}">
                                    
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-semibold text-sm text-gray-900 group-hover:text-blue-600 transition">{{ $facility->name }}</h4>
                                        <span class="px-2 py-0.5 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                            {{ ucfirst($facility->status) }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-500 line-clamp-2 mt-1">{{ $facility->description }}</p>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>

                <!-- EQUIPMENT COLUMN -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <div class="flex justify-between items-center mb-4 pb-2 border-b border-gray-100">
                        <h3 class="text-base font-bold text-gray-900 flex items-center">
                            <span class="bg-indigo-600 text-white w-2 h-5 rounded-full mr-2"></span>
                            Available Equipment
                        </h3>
                        <a href="{{ route('reservations.availability') }}" class="text-xs font-medium text-indigo-600 hover:underline">View All</a>
                    </div>

                    <div class="space-y-3">
                        @isset($equipment)
                            @foreach($equipment as $item)
                                @php
                                    $itemImgUrl = $item->image 
                                        ? (str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image)) 
                                        : 'https://images.unsplash.com/photo-1535223289827-42f1e9919769?w=600&auto=format&fit=crop&q=80';
                                    
                                    // Use calculated live available stock (fallback to total_stock if null)
                                    $availableUnits = $item->live_available_stock ?? $item->total_stock;
                                @endphp

                                <div class="p-4 rounded-lg border border-gray-100 hover:border-indigo-300 hover:bg-indigo-50/30 transition cursor-pointer group"
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
                                        <h4 class="font-semibold text-sm text-gray-900 group-hover:text-indigo-600 transition">{{ $item->name }}</h4>
                                        <span class="px-2 py-0.5 text-xs font-semibold {{ $availableUnits > 0 ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} rounded-full">
                                            {{ $availableUnits > 0 ? 'Available' : 'Out of Stock' }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-indigo-600 font-medium mt-1">
                                        Stock: {{ $availableUnits }} / {{ $item->total_stock }} units available
                                    </p>
                                    <p class="text-xs text-gray-500 line-clamp-2 mt-0.5">{{ $item->description }}</p>
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
             class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-70 flex items-center justify-center p-4" 
             style="display: none;"
             @keydown.escape.window="openModal = false">
            
            <div @click.away="openModal = false" 
                 class="bg-white rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl transform transition-all border border-gray-100">
                
                <div class="relative h-64 bg-gray-100">
                    <img :src="selectedItem.image" :alt="selectedItem.name" class="w-full h-full object-cover">
                    <button @click="openModal = false" class="absolute top-4 right-4 bg-black bg-opacity-60 text-white rounded-full p-2 hover:bg-opacity-80 transition duration-150">
                        ✕
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full shadow-inner" x-text="selectedItem.type"></span>
                        <span class="text-sm font-medium text-gray-500" x-text="selectedItem.stock"></span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 leading-tight" x-text="selectedItem.name"></h3>
                    <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line" x-text="selectedItem.desc"></p>
                    
                    <div class="flex justify-end pt-4 border-t border-gray-100">
                        <button @click="openModal = false" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-5 py-2.5 rounded-lg text-sm font-semibold transition shadow-inner">
                            Close Preview
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>