<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Decline Request & Add Reason</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <p class="mb-4 text-gray-700">You are declining the reservation request by <strong>{{ $reservation->user->name }}</strong>.</p>
                
                <form action="{{ route('reservations.update-status', $reservation) }}" method="POST">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="rejected">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Reason for Declining (Required)</label>
                        <textarea name="rejection_reason" rows="4" required class="w-full border-gray-300 rounded-md shadow-sm p-2" placeholder="Explain why this request is being rejected..."></textarea>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('dashboard') }}" class="bg-gray-300 px-4 py-2 rounded-md text-sm">Cancel</a>
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md text-sm">Submit & Send Notice</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>