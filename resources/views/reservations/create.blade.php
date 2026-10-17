<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Check Availability & Reserve Resource') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 border border-gray-100">
                
                <form action="{{ route('reservations.store') }}" method="POST" x-data="{ submitting: false }" @submit="submitting = true">
                    @csrf

                    <!-- Facility Selection -->
                    <div class="mb-6">
                        <label for="facility_id" class="block text-sm font-medium text-gray-700">Facility / Room (Optional if booking Equipment)</label>
                        <select name="facility_id" id="facility_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Select Facility (None)</option>
                            @foreach($facilities as $facility)
                                <option value="{{ $facility->id }}" {{ old('facility_id') == $facility->id ? 'selected' : '' }}>
                                    {{ $facility->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('facility_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Equipment Selection -->
                    <div class="mb-6">
                        <label for="equipment_id" class="block text-sm font-medium text-gray-700">Equipment & Devices (Optional if booking Facility)</label>
                        <select name="equipment_id" id="equipment_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Select Equipment (None)</option>
                            @foreach($equipment as $item)
                                <option value="{{ $item->id }}" {{ old('equipment_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }} (Available Stock: {{ $item->total_stock }} units)
                                </option>
                            @endforeach
                        </select>
                        @error('equipment_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Quantity Input (Conditional via JS) -->
                    <div class="mb-6">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity (Required when booking Equipment)</label>
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 0) }}" min="0" max="100" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <p class="text-xs text-gray-500 mt-1">Specify how many units you wish to borrow. Defaults to 0 if no equipment is selected.</p>
                        @error('quantity')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Start Date & Time -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700">Start Date & Time</label>
                            <input type="datetime-local" name="start_time" id="start_time" value="{{ old('start_time') }}" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            @error('start_time')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- End Date & Time -->
                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700">End Date & Time</label>
                            <input type="datetime-local" name="end_time" id="end_time" value="{{ old('end_time') }}" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            @error('end_time')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Purpose of Reservation -->
                    <div class="mb-6">
                        <label for="purpose" class="block text-sm font-medium text-gray-700">Purpose of Reservation</label>
                        <textarea name="purpose" id="purpose" rows="4" placeholder="State your activity purpose, class subject, or project details..." class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('purpose') }}</textarea>
                        @error('purpose')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('dashboard') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-md text-sm font-medium transition">
                            Cancel
                        </a>
                        <button type="submit" 
                                :disabled="submitting" 
                                :class="{ 'opacity-50 cursor-not-allowed': submitting }"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium shadow-sm transition">
                            <span x-show="!submitting">Submit Request</span>
                            <span x-show="submitting">Submitting...</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle conditional quantity validation -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const equipmentSelect = document.getElementById('equipment_id');
            const quantityInput = document.getElementById('quantity');

            function updateQuantityRequirement() {
                if (equipmentSelect.value === "") {
                    // No equipment selected: remove requirement and allow 0
                    quantityInput.removeAttribute('required');
                    quantityInput.min = 0;
                    if (quantityInput.value === "" || parseInt(quantityInput.value) < 1) {
                        quantityInput.value = 0;
                    }
                } else {
                    // Equipment selected: enforce requirement and min of 1
                    quantityInput.setAttribute('required', 'required');
                    quantityInput.min = 1;
                    if (quantityInput.value === "" || parseInt(quantityInput.value) < 1) {
                        quantityInput.value = 1;
                    }
                }
            }

            equipmentSelect.addEventListener('change', updateQuantityRequirement);
            updateQuantityRequirement(); // Run on load
        });
    </script>
</x-app-layout>