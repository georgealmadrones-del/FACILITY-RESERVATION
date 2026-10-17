<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Reservation Activity & System Reports') }}
            </h2>
            <div class="flex space-x-2 print:hidden">
                <!-- Download PDF Button -->
                <a href="{{ route('admin.reports.pdf', request()->all()) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium shadow flex items-center">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Download PDF
                </a>
                <!-- Print Button -->
                <button onclick="window.print()" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium shadow">
                    Print Report
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Filters Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 print:hidden">
                <form method="GET" action="{{ route('admin.reports.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Filter</label>
                        <select name="status" class="w-full border-gray-300 rounded-md shadow-sm text-sm p-2">
                            <option value="">All Statuses</option>
                            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full border-gray-300 rounded-md shadow-sm text-sm p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full border-gray-300 rounded-md shadow-sm text-sm p-2">
                    </div>

                    <div class="flex space-x-2">
                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">Filter</button>
                        <a href="{{ route('admin.reports.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Summary Metrics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-xs text-gray-500 uppercase font-semibold">Filtered Total</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalFiltered }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-xs text-green-600 uppercase font-semibold">Approved</p>
                    <p class="text-2xl font-bold text-green-700">{{ $approvedCount }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-xs text-yellow-600 uppercase font-semibold">Pending</p>
                    <p class="text-2xl font-bold text-yellow-700">{{ $pendingCount }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-xs text-red-600 uppercase font-semibold">Rejected</p>
                    <p class="text-2xl font-bold text-red-700">{{ $rejectedCount }}</p>
                </div>
            </div>

            <!-- Report Data Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Requester</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Resource Item</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Start Time</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">End Time</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($reservations as $res)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $res->user->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $res->facility->name ?? $res->equipment->name ?? 'N/A' }}
                                        @if($res->quantity > 1) (Qty: {{ $res->quantity }}) @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $res->start_time }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $res->end_time }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $res->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $res->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $res->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ ucfirst($res->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No reservation records match your filter criteria.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 print:hidden">
                    {{ $reservations->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>