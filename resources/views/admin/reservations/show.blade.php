<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Reservation Request Details') }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 space-y-6">
                
                <!-- Status & Header Info -->
                <div class="flex justify-between items-center border-b pb-4">
                    <div>
                        <span class="text-sm text-gray-500">Request ID: #{{ $reservation->id }}</span>
                        <h3 class="text-lg font-bold text-gray-800">
                            {{ $reservation->facility->name ?? $reservation->equipment->name ?? 'N/A' }}
                        </h3>
                    </div>
                    <div>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full 
                            {{ $reservation->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $reservation->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $reservation->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </div>
                </div>

                <!-- Requester & Booking Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-4 rounded-lg">
                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Requester Information</h4>
                        <p class="text-sm font-medium text-gray-900">{{ $reservation->user->name ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-600">{{ $reservation->user->email ?? 'N/A' }}</p>
                        <span class="inline-block mt-1 px-2 py-0.5 text-xs font-semibold bg-blue-100 text-blue-800 rounded">
                            {{ ucfirst($reservation->user->role ?? 'User') }}
                        </span>
                    </div>

                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Schedule & Timing</h4>
                        <p class="text-sm text-gray-700"><span class="font-semibold">Start:</span> {{ $reservation->start_time }}</p>
                        <p class="text-sm text-gray-700"><span class="font-semibold">End:</span> {{ $reservation->end_time ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-700 mt-1"><span class="font-semibold">Submitted:</span> {{ $reservation->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <!-- Purpose of Reservation -->
                <div>
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Purpose of Reservation</h4>
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded text-sm text-blue-900 font-medium">
                        {{ $reservation->purpose ?? 'No specific purpose provided by the requester.' }}
                    </div>
                </div>

                <!-- Rejection Reason (If Applicable) -->
                @if($reservation->status === 'rejected' && $reservation->rejection_reason)
                    <div>
                        <h4 class="text-xs font-semibold text-red-500 uppercase tracking-wider mb-2">Admin Rejection Reason</h4>
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded text-sm text-red-900">
                            {{ $reservation->rejection_reason }}
                        </div>
                    </div>
                @endif

                <!-- Action Buttons (If Pending) -->
                @if($reservation->status === 'pending')
                    <div class="flex justify-end space-x-4 border-t pt-4">
                        <form action="{{ route('admin.reservations.update-status', $reservation) }}" method="POST" class="inline">
                            @csrf 
                            @method('PATCH')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-semibold transition">
                                Approve Request
                            </button>
                        </form>
                        <button type="button" onclick="openRejectModal()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-semibold transition">
                            Reject Request
                        </button>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- Rejection Reason Modal -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h3 class="text-lg font-bold mb-4 text-gray-800">Reason for Rejection</h3>
            <form action="{{ route('admin.reservations.update-status', $reservation) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="rejected">
                <textarea name="rejection_reason" rows="3" required placeholder="Enter why this request is declined..." class="w-full border-gray-300 rounded-md shadow-sm mb-4 p-2 focus:ring-red-500 focus:border-red-500"></textarea>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeRejectModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm">Cancel</button>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm">Decline Request</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }
        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</x-app-layout>