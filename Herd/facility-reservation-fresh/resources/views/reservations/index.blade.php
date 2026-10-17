<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Reservation History') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ openModal: false, selectedRes: {} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- My Booking Requests Section -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-6 pb-3 border-b border-gray-100">
                    <div>
                        <h3 class="text-base font-bold text-gray-900">All Your Booking Requests</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Click any request to view details or manage status.</p>
                    </div>
                    <a href="{{ route('reservations.create') }}" class="px-4 py-2 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition shadow-sm">
                        + New Booking
                    </a>
                </div>

                @if(isset($reservations) && $reservations->count() > 0)
                    <div class="space-y-4">
                        @foreach($reservations as $res)
                            @php
                                $itemTitle = $res->facility?->name ?? $res->equipment?->name ?? 'Resource';
                                $itemType = ($res->facility_id ? 'Facility ' : '') . ($res->equipment_id ? 'Equipment' : '');
                                $scheduleFormatted = \Carbon\Carbon::parse($res->start_time)->format('M d, Y g:i A') . ' → ' . \Carbon\Carbon::parse($res->end_time)->format('g:i A');
                            @endphp

                            <div class="p-4 rounded-xl border border-gray-200 hover:border-blue-400 transition cursor-pointer bg-white flex justify-between items-center group"
                                 @click="selectedRes = {
                                     id: '{{ $res->id }}',
                                     title: '{{ addslashes($itemTitle) }}',
                                     type: '{{ trim($itemType) }}',
                                     schedule: '{{ $scheduleFormatted }}',
                                     purpose: '{{ addslashes($res->purpose) }}',
                                     equipmentName: '{{ addslashes($res->equipment?->name ?? '') }}',
                                     quantity: '{{ $res->quantity }}',
                                     status: '{{ ucfirst($res->status) }}',
                                     rawStatus: '{{ $res->status }}',
                                     rejectionReason: '{{ addslashes($res->rejection_reason ?? '') }}'
                                 }; openModal = true">

                                <div class="space-y-1">
                                    <div class="flex items-center space-x-2">
                                        @if($res->facility_id)
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-blue-100 text-blue-800">Facility</span>
                                        @endif
                                        @if($res->equipment_id)
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-indigo-100 text-indigo-800">Equipment</span>
                                        @endif
                                    </div>
                                    <h4 class="font-bold text-gray-900 text-sm group-hover:text-blue-600 transition">{{ $itemTitle }}</h4>
                                    <p class="text-xs text-gray-500"><span class="font-semibold">Schedule:</span> {{ $scheduleFormatted }}</p>
                                </div>

                                <div class="flex flex-col items-end space-y-1">
                                    <span class="px-2.5 py-0.5 text-xs font-bold rounded-full border
                                        {{ $res->status === 'approved' ? 'bg-green-100 text-green-800 border-green-200' : '' }}
                                        {{ $res->status === 'pending' ? 'bg-amber-100 text-amber-800 border-amber-200' : '' }}
                                        {{ $res->status === 'rejected' ? 'bg-red-100 text-red-800 border-red-200' : '' }}
                                        {{ $res->status === 'cancelled' ? 'bg-gray-100 text-gray-800 border-gray-200' : '' }}">
                                        {{ ucfirst($res->status) }}
                                    </span>
                                    <span class="text-[11px] text-blue-600 font-medium hover:underline">View Details &rarr;</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 border-2 border-dashed border-gray-200 rounded-xl">
                        <h3 class="mt-2 text-sm font-bold text-gray-900">No reservations found</h3>
                    </div>
                @endif
            </div>

        </div>

        <!-- DETAILS & REJECTION MODAL -->
        <div x-show="openModal" 
             class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-70 flex items-center justify-center p-4" 
             style="display: none;"
             @keydown.escape.window="openModal = false">
            
            <div @click.away="openModal = false" class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl space-y-4 border border-gray-100">
                <div class="flex justify-between items-start border-b border-gray-100 pb-3">
                    <div>
                        <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-blue-100 text-blue-800 uppercase tracking-wide" x-text="selectedRes.type"></span>
                        <h3 class="text-lg font-bold text-gray-900 mt-1" x-text="selectedRes.title"></h3>
                    </div>
                    <button @click="openModal = false" class="text-gray-400 hover:text-gray-600 font-bold text-lg">✕</button>
                </div>

                <div class="space-y-3 text-xs text-gray-700">
                    <div>
                        <span class="font-semibold text-gray-900">Schedule:</span>
                        <p class="text-gray-600 text-sm mt-0.5" x-text="selectedRes.schedule"></p>
                    </div>

                    <div>
                        <span class="font-semibold text-gray-900">Purpose:</span>
                        <p class="text-gray-600 bg-gray-50 p-2.5 rounded-xl border border-gray-100 mt-0.5" x-text="selectedRes.purpose"></p>
                    </div>

                    <template x-if="selectedRes.equipmentName">
                        <div>
                            <span class="font-semibold text-gray-900">Requested Equipment:</span>
                            <p class="text-indigo-600 font-medium mt-0.5" x-text="selectedRes.equipmentName + ' (' + selectedRes.quantity + ' units)'"></p>
                        </div>
                    </template>

                    <div>
                        <span class="font-semibold text-gray-900">Status:</span>
                        <p class="capitalize font-bold text-sm mt-0.5" :class="{
                            'text-amber-600': selectedRes.rawStatus === 'pending',
                            'text-green-600': selectedRes.rawStatus === 'approved',
                            'text-red-600': selectedRes.rawStatus === 'rejected',
                            'text-gray-600': selectedRes.rawStatus === 'cancelled'
                        }" x-text="selectedRes.status"></p>
                    </div>

                    <!-- ADMIN REJECTION REASON DISPLAY -->
                    <template x-if="selectedRes.rawStatus === 'rejected' && selectedRes.rejectionReason">
                        <div class="bg-red-50 p-3.5 rounded-xl border border-red-200 text-red-800 space-y-1">
                            <span class="font-bold text-xs uppercase tracking-wide flex items-center">
                                <svg class="w-4 h-4 mr-1 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                Reason for Rejection:
                            </span>
                            <p class="text-xs text-red-700 leading-relaxed" x-text="selectedRes.rejectionReason"></p>
                        </div>
                    </template>
                </div>

                <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                    <button @click="openModal = false" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-xl text-xs font-semibold transition">
                        Close
                    </button>

                    <template x-if="selectedRes.rawStatus !== 'cancelled'">
                        <form :action="'{{ url('reservations') }}/' + selectedRes.id + '/status'" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="cancelled">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl text-xs font-semibold shadow-sm transition">
                                Cancel Reservation
                            </button>
                        </form>
                    </template>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>