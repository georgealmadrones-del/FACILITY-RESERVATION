<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Resource Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
                
                <div class="mb-6 pb-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">Reservation Request Form</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Book campus facilities, equipment, or bundle them together for your academic activities.</p>
                </div>

                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-xs text-red-600 space-y-1">
                        <p class="font-bold">Please correct the following errors:</p>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('reservations.store') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Facility Selection -->
                        <div>
                            <label for="facility_id" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Facility / Room <span class="text-gray-400 font-normal">(Optional if booking equipment)</span>
                            </label>
                            <select name="facility_id" id="facility_id" class="w-full text-xs border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm p-3">
                                <option value="">Select Facility (None)</option>
                                @foreach($facilities as $facility)
                                    <option value="{{ $facility->id }}" {{ old('facility_id') == $facility->id ? 'selected' : '' }}>
                                        {{ $facility->name }} (Capacity: {{ $facility->capacity }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Equipment Selection -->
                        <div>
                            <label for="equipment_id" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Equipment & Devices <span class="text-gray-400 font-normal">(Optional if booking room)</span>
                            </label>
                            <select name="equipment_id" id="equipment_id" onchange="toggleQuantityField()" class="w-full text-xs border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm p-3">
                                <option value="">Select Equipment (None)</option>
                                @foreach($equipment as $item)
                                    <option value="{{ $item->id }}" {{ old('equipment_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} (Available Stock: {{ $item->total_stock }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Dynamic Quantity Field (Controlled by Vanilla JS) -->
                    <div id="quantity_wrapper" class="p-4 bg-indigo-50/50 border border-indigo-100 rounded-xl" style="display: none;">
                        <label for="quantity" class="block text-xs font-bold text-indigo-900 uppercase tracking-wider mb-2">
                            Requested Quantity <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="quantity" id="quantity" min="1" value="{{ old('quantity', 1) }}" 
                               class="w-full md:w-1/3 text-xs border-indigo-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm p-3 bg-white">
                        <p class="text-[11px] text-indigo-600 mt-1.5">Specify how many units of this equipment you wish to borrow.</p>
                    </div>

                    <!-- Date & Time Range -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_time" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Start Date & Time <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" name="start_time" id="start_time" value="{{ old('start_time') }}" required
                                   class="w-full text-xs border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm p-3">
                        </div>

                        <div>
                            <label for="end_time" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                End Date & Time <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" name="end_time" id="end_time" value="{{ old('end_time') }}" required
                                   class="w-full text-xs border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm p-3">
                        </div>
                    </div>

                    <!-- Purpose -->
                    <div>
                        <label for="purpose" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Purpose of Reservation <span class="text-red-500">*</span>
                        </label>
                        <textarea name="purpose" id="purpose" rows="4" required placeholder="State your activity purpose, class subject, or project details..."
                                  class="w-full text-xs border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm p-3">{{ old('purpose') }}</textarea>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('reservations.index') }}" class="px-5 py-2.5 text-xs font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-sm transition">
                            Submit Request
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- JavaScript to toggle the quantity field -->
    <script>
        function toggleQuantityField() {
            const select = document.getElementById('equipment_id');
            const wrapper = document.getElementById('quantity_wrapper');
            
            if (select.value !== "") {
                wrapper.style.display = 'block';
            } else {
                wrapper.style.display = 'none';
            }
        }

        // Run on page load in case validation failed and old() value exists
        document.addEventListener('DOMContentLoaded', function() {
            toggleQuantityField();
        });
    </script>
</x-app-layout>