<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Facilities & Equipment') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- FACILITIES SECTION -->
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Facility</h3>
                    <form action="{{ route('admin.facilities.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Facility Name</label>
                            <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" rows="2" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add Facility</button>
                    </form>

                    <hr class="my-6">

                    <h3 class="text-md font-medium text-gray-900 mb-3">Existing Facilities</h3>
                    <ul class="divide-y divide-gray-200">
                        @forelse($facilities as $facility)
                            <li class="py-3 flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $facility->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $facility->description }}</p>
                                </div>
                                <form action="{{ route('admin.facilities.destroy', $facility) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Remove</button>
                                </form>
                            </li>
                        @empty
                            <p class="text-sm text-gray-500">No facilities registered.</p>
                        @endforelse
                    </ul>
                </div>

                <!-- EQUIPMENT SECTION -->
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Equipment</h3>
                    <form action="{{ route('admin.equipment.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Equipment Name</label>
                            <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" rows="2" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add Equipment</button>
                    </form>

                    <hr class="my-6">

                    <h3 class="text-md font-medium text-gray-900 mb-3">Existing Equipment</h3>
                    <ul class="divide-y divide-gray-200">
                        @forelse($equipment as $item)
                            <li class="py-3 flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $item->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $item->description }}</p>
                                </div>
                                <form action="{{ route('admin.equipment.destroy', $item) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Remove</button>
                                </form>
                            </li>
                        @empty
                            <p class="text-sm text-gray-500">No equipment registered.</p>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>