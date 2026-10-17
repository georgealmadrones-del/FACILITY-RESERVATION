<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resource Management Hub (Facilities & Equipment)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- ================= FACILITY MANAGEMENT SECTION ================= -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-6 border-b pb-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">🏫 Facility Management</h3>
                        <p class="text-xs text-gray-500">Manage classrooms, laboratories, conference rooms, and campus spaces.</p>
                    </div>
                </div>

                <!-- Add Facility Form -->
                <form action="{{ route('admin.facilities.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8 bg-gray-50 p-4 rounded-lg border">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Facility Name</label>
                        <input type="text" name="name" placeholder="e.g., Computer Laboratory 1" required class="w-full border-gray-300 rounded-md shadow-sm text-sm p-2">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full border-gray-300 rounded-md shadow-sm text-sm p-2">
                            <option value="available">Available</option>
                            <option value="maintenance">Under Maintenance</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Description / Location</label>
                        <input type="text" name="description" placeholder="e.g., Building A, 2nd Floor" class="w-full border-gray-300 rounded-md shadow-sm text-sm p-2">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-gray-800 hover:bg-gray-700 text-white py-2 rounded-md text-sm font-medium">Add Facility</button>
                    </div>
                </form>

                <!-- Facilities Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($facilities as $facility)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $facility->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $facility->description ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $facility->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($facility->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <form action="{{ route('admin.facilities.destroy', $facility) }}" method="POST" class="inline" onsubmit="return confirm('Delete this facility?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No facilities found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ================= EQUIPMENT MANAGEMENT SECTION ================= -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-6 border-b pb-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">💻 Equipment Management</h3>
                        <p class="text-xs text-gray-500">Manage laptops, projectors, cameras, microphones, speakers, and inventory stock quantities.</p>
                    </div>
                </div>

                <!-- Add Equipment Form -->
                <form action="{{ route('admin.equipment.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8 bg-gray-50 p-4 rounded-lg border">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Equipment Name</label>
                        <input type="text" name="name" placeholder="e.g., HD Projector" required class="w-full border-gray-300 rounded-md shadow-sm text-sm p-2">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Total Stock Qty</label>
                        <input type="number" name="total_stock" min="1" value="5" required class="w-full border-gray-300 rounded-md shadow-sm text-sm p-2">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full border-gray-300 rounded-md shadow-sm text-sm p-2">
                            <option value="available">Available</option>
                            <option value="maintenance">Under Maintenance</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Description / Specs</label>
                        <input type="text" name="description" placeholder="e.g., HDMI compatible" class="w-full border-gray-300 rounded-md shadow-sm text-sm p-2">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-gray-800 hover:bg-gray-700 text-white py-2 rounded-md text-sm font-medium">Add Equipment</button>
                    </div>
                </form>

                <!-- Equipment Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Total Stock</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($equipment as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-bold">{{ $item->total_stock }} units</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $item->description ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $item->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <form action="{{ route('admin.equipment.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Delete this equipment item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No equipment items found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>