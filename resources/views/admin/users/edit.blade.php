<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User: ') . $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-lg mx-auto border border-gray-100">
                
                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">System Role</label>
                        <select name="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2">
                            <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                            <option value="faculty" {{ $user->role === 'faculty' ? 'selected' : '' }}>Faculty</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-2 pt-4">
                        <a href="{{ route('admin.users.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">Cancel</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">Update User</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>