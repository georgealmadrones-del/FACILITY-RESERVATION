<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Student Record Management') }}
            </h2>
            <!-- Trigger Add Modal Button -->
            <button @click="openAddModal = true" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition shadow-sm">
                + Add Student
            </button>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ openAddModal: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg text-sm shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-lg text-sm shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Search & Sort Bar -->
            <div class="bg-white p-4 shadow-sm sm:rounded-lg mb-6 flex flex-col sm:flex-row justify-between gap-4 items-center border border-gray-100">
                <form method="GET" action="{{ route('students.index') }}" class="flex w-full sm:w-auto gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name..." class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg text-sm shadow-sm w-full sm:w-64">
                    <button type="submit" class="px-4 py-2 bg-gray-800 text-white text-sm rounded-lg hover:bg-gray-700 transition">Search</button>
                </form>

                <div class="flex gap-2 w-full sm:w-auto justify-end text-sm">
                    <span class="self-center text-gray-500">Sort by:</span>
                    <a href="{{ route('students.index', ['sort_by' => 'student_id', 'search' => request('search')]) }}" class="px-3 py-1.5 border rounded-lg hover:bg-gray-50 {{ request('sort_by') == 'student_id' ? 'bg-gray-100 font-semibold' : '' }}">ID</a>
                    <a href="{{ route('students.index', ['sort_by' => 'name', 'search' => request('search')]) }}" class="px-3 py-1.5 border rounded-lg hover:bg-gray-50 {{ request('sort_by') == 'name' ? 'bg-gray-100 font-semibold' : '' }}">Name</a>
                    <a href="{{ route('students.index', ['sort_by' => 'gpa', 'search' => request('search')]) }}" class="px-3 py-1.5 border rounded-lg hover:bg-gray-50 {{ request('sort_by') == 'gpa' ? 'bg-gray-100 font-semibold' : '' }}">GPA</a>
                </div>
            </div>

            <!-- Student Data Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                    <thead class="bg-gray-50 text-gray-500 uppercase font-medium">
                        <tr>
                            <th class="px-6 py-3">Student ID</th>
                            <th class="px-6 py-3">Full Name</th>
                            <th class="px-6 py-3">GPA</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($students as $student)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $student->student_id }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $student->name }}</td>
                                <td class="px-6 py-4 text-gray-700 font-mono">{{ number_format($student->gpa, 2) }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <!-- Edit Button -->
                                    <button @click="$dispatch('edit-student', { id: '{{ $student->student_id }}', name: '{{ $student->name }}', gpa: '{{ $student->gpa }}' })" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</button>

                                    <!-- Delete Form -->
                                    <form action="{{ route('students.destroy', $student->student_id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to remove this record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-900 font-medium">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-400">No student records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Add Student Modal Overlay -->
            <div x-show="openAddModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm" style="display: none;">
                <div @click.outside="openAddModal = false" class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Add New Student</h3>
                    
                    <form action="{{ route('students.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Student ID</label>
                            <input type="text" name="student_id" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="name" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">GPA (1.00 - 5.00)</label>
                            <input type="number" step="0.01" min="1.00" max="5.00" name="gpa" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        </div>

                        <div class="flex justify-end gap-2 pt-4">
                            <button type="button" @click="openAddModal = false" class="px-4 py-2 border rounded-lg text-sm text-gray-600 hover:bg-gray-50">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">Save Student</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Edit Student Modal Overlay -->
            <div x-data="{ openEditModal: false, editId: '', editName: '', editGpa: '' }" 
                 @edit-student.window="openEditModal = true; editId = $event.detail.id; editName = $event.detail.name; editGpa = $event.detail.gpa;" 
                 x-show="openEditModal" 
                 class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm" 
                 style="display: none;">
                <div @click.outside="openEditModal = false" class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Student Record</h3>
                    
                    <form :action="'/students/' + editId" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Student ID</label>
                            <input type="text" name="student_id" x-model="editId" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="name" x-model="editName" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">GPA (1.00 - 5.00)</label>
                            <input type="number" step="0.01" min="1.00" max="5.00" name="gpa" x-model="editGpa" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        </div>

                        <div class="flex justify-end gap-2 pt-4">
                            <button type="button" @click="openEditModal = false" class="px-4 py-2 border rounded-lg text-sm text-gray-600 hover:bg-gray-50">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">Update Student</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>