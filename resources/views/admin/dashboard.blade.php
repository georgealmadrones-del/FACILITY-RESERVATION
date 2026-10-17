<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Command Center') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Clickable Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <a href="{{ route('admin.reports.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 hover:border-blue-400 hover:shadow-md transition block group">
                    <div class="text-xs font-semibold text-gray-500 uppercase group-hover:text-blue-600 transition">Total Bookings</div>
                    <div class="text-3xl font-bold text-gray-900 mt-2">{{ $totalBookings }}</div>
                </a>
                <a href="{{ route('admin.reports.index', ['status' => 'approved']) }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 hover:border-green-400 hover:shadow-md transition block group">
                    <div class="text-xs font-semibold text-gray-500 uppercase group-hover:text-green-600 transition">Approved</div>
                    <div class="text-3xl font-bold text-green-600 mt-2">{{ $approvedCount }}</div>
                </a>
                <a href="{{ route('admin.reports.index', ['status' => 'pending']) }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 hover:border-yellow-400 hover:shadow-md transition block group">
                    <div class="text-xs font-semibold text-gray-500 uppercase group-hover:text-yellow-600 transition">Pending Review</div>
                    <div class="text-3xl font-bold text-yellow-600 mt-2">{{ $pendingCount }}</div>
                </a>
                <a href="{{ route('admin.reports.index', ['status' => 'rejected']) }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 hover:border-red-400 hover:shadow-md transition block group">
                    <div class="text-xs font-semibold text-gray-500 uppercase group-hover:text-red-600 transition">Rejected</div>
                    <div class="text-3xl font-bold text-red-600 mt-2">{{ $rejectedCount }}</div>
                </a>
            </div>

            <!-- Recent Requests Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Recent Requests Awaiting Review</h3>
                    <a href="{{ route('admin.reservations.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-900">View All &rarr;</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Item</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Start Time</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($reservations as $res)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $res->user?->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        {{ $res->facility?->name ?? $res->equipment?->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $res->start_time }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $res->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $res->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $res->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ ucfirst($res->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        @if($res->status === 'pending')
                                            <!-- Approve Button -->
                                            <form action="{{ route('admin.reservations.update-status', $res) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="text-green-600 hover:text-green-900 font-semibold text-xs bg-green-50 px-2 py-1 rounded border border-green-200">Approve</button>
                                            </form>

                                            <!-- Trigger Rejection Modal -->
                                            <button type="button" onclick="openRejectModal('{{ route('admin.reservations.update-status', $res) }}')" class="text-red-600 hover:text-red-900 font-semibold text-xs bg-red-50 px-2 py-1 rounded border border-red-200">
                                                Reject
                                            </button>
                                        @else
                                            <a href="{{ route('admin.reservations.show', $res) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold text-xs">View</a>
                                            <span class="text-gray-400 text-xs ml-1">Processed</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No recent reservation requests found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Rejection Reason Modal -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-96 border border-gray-100">
            <h3 class="text-base font-bold mb-3 text-gray-900">Reason for Rejection</h3>
            <form id="rejectForm" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="rejected">
                <textarea name="rejection_reason" rows="3" required placeholder="Enter why this request is declined..." class="w-full text-xs border-gray-300 rounded-md shadow-sm mb-4 p-2.5 focus:ring-red-500 focus:border-red-500"></textarea>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeRejectModal()" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-md text-xs font-semibold">Cancel</button>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-xs font-semibold shadow-sm">Confirm Rejection</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRejectModal(actionUrl) {
            const form = document.getElementById('rejectForm');
            form.action = actionUrl;
            document.getElementById('rejectModal').classList.remove('hidden');
        }
        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</x-app-layout>