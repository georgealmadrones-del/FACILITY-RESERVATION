<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-extrabold text-pink-950 tracking-tight">
                    Create New Reservation ✨
                </h2>
                <p class="text-xs text-pink-700/80 mt-0.5 font-medium">Select a room or equipment and pick your schedule.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-pink-50 hover:bg-pink-100 text-pink-800 rounded-2xl text-xs font-bold border border-pink-200 transition">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-pink-100/60 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white/90 p-8 rounded-3xl border border-pink-200 shadow-xl shadow-pink-500/5 backdrop-blur-xl">
                
                <form method="POST" action="{{ route('reservations.store') }}" class="space-y-6">
                    @csrf

                    <!-- Resource Selection Type -->
                    <div class="space-y-2" x-data="{ type: 'facility' }">
                        <label class="block text-xs font-bold uppercase tracking-wider text-pink-900/80">Resource Type</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label @click="type = 'facility'" class="flex items-center justify-center p-4 rounded-2xl border cursor-pointer transition" :class="type === 'facility' ? 'bg-pink-100/70 border-pink-300 text-pink-950 font-bold shadow-sm' : 'bg-pink-50/40 border-pink-200 text-pink-800/70'">
                                <input type="radio" name="resource_type" value="facility" x-model="type" class="hidden">
                                <span>🏢 Facility / Room</span>
                            </label>
                            <label @click="type = 'equipment'" class="flex items-center justify-center p-4 rounded-2xl border cursor-pointer transition" :class="type === 'equipment' ? 'bg-purple-100/70 border-purple-300 text-purple-950 font-bold shadow-sm' : 'bg-pink-50/40 border-pink-200 text-pink-800/70'">
                                <input type="radio" name="resource_type" value="equipment" x-model="type" class="hidden">
                                <span>💻 Equipment Unit</span>
                            </label>
                        </div>

                        <!-- Facility Dropdown -->
                        <div x-show="type === 'facility'" class="space-y-1.5 pt-2">
                            <label for="facility_id" class="block text-xs font-bold uppercase tracking-wider text-pink-900/80">Select Facility</label>
                            <select name="facility_id" id="facility_id" class="w-full px-4 py-3 bg-pink-50/60 border border-pink-200 rounded-2xl text-sm text-pink-950 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:bg-white transition">
                                <option value="">-- Choose a Facility --</option>
                                @if(isset($facilities))
                                    @foreach($facilities as $facility)
                                        <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Equipment Dropdown -->
                        <div x-show="type === 'equipment'" style="display: none;" class="space-y-1.5 pt-2">
                            <label for="equipment_id" class="block text-xs font-bold uppercase tracking-wider text-pink-900/80">Select Equipment</label>
                            <select name="equipment_id" id="equipment_id" class="w-full px-4 py-3 bg-pink-50/60 border border-pink-200 rounded-2xl text-sm text-pink-950 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:bg-white transition">
                                <option value="">-- Choose Equipment --</option>
                                @if(isset($equipmentList))
                                    @foreach($equipmentList as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} (Available: {{ $item->quantity }})</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- Quantity (for Equipment) -->
                    <div class="space-y-1.5">
                        <label for="quantity" class="block text-xs font-bold uppercase tracking-wider text-pink-900/80">Quantity</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" class="w-full px-4 py-3 bg-pink-50/60 border border-pink-200 rounded-2xl text-sm text-pink-950 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:bg-white transition">
                        <x-input-error :messages="$errors->get('quantity')" class="mt-1 text-xs text-rose-600" />
                    </div>

                    <!-- Start Time -->
                    <div class="space-y-1.5">
                        <label for="start_time" class="block text-xs font-bold uppercase tracking-wider text-pink-900/80">Start Date & Time</label>
                        <input type="datetime-local" name="start_time" id="start_time" required class="w-full px-4 py-3 bg-pink-50/60 border border-pink-200 rounded-2xl text-sm text-pink-950 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:bg-white transition">
                        <x-input-error :messages="$errors->get('start_time')" class="mt-1 text-xs text-rose-600" />
                    </div>

                    <!-- End Time -->
                    <div class="space-y-1.5">
                        <label for="end_time" class="block text-xs font-bold uppercase tracking-wider text-pink-900/80">End Date & Time</label>
                        <input type="datetime-local" name="end_time" id="end_time" required class="w-full px-4 py-3 bg-pink-50/60 border border-pink-200 rounded-2xl text-sm text-pink-950 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:bg-white transition">
                        <x-input-error :messages="$errors->get('end_time')" class="mt-1 text-xs text-rose-600" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3.5 px-4 bg-gradient-to-r from-pink-400 via-rose-400 to-purple-400 hover:from-pink-500 hover:to-purple-500 text-white font-bold rounded-2xl shadow-lg shadow-pink-400/30 transition-all active:scale-[0.99] text-sm mt-4">
                        Submit Reservation Request 🌸
                    </button>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>