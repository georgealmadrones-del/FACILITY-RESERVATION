<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management Command Center') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">System Users</h3>
                    
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('admin.users.index') }}" class="flex space-x-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or email..." class="border-gray-300 rounded-md shadow-sm text-sm p-2">
                        <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">Search</button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Status / Presence</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Joined Date</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    
                                    <!-- Status / Presence Indicator -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($user->status === 'inactive')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Inactive
                                            </span>
                                        @elseif($user->last_seen_at && \Carbon\Carbon::parse($user->last_seen_at)->gt(now()->subMinutes(5)))
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <span class="w-2 h-2 mr-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                                Active Now
                                            </span>
                                        @elseif($user->last_seen_at)
                                            <span class="text-xs text-gray-500">
                                                Last seen {{ \Carbon\Carbon::parse($user->last_seen_at)->diffForHumans() }}
                                            </span>
                                        @else
                                            <span class="text-xs text-gray-400 italic">Never logged in</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Edit</a>
                                        
                                        @if(auth()->id() !== $user->id)
                                            <!-- Toggle Status Form -->
                                            <form action="{{ route('admin.users.status', $user) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')

                                                @if($user->status === 'inactive')
                                                    <button type="submit" class="text-green-600 hover:text-green-900 font-semibold bg-transparent border-none cursor-pointer p-0">
                                                        Activate
                                                    </button>
                                                @else
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold bg-transparent border-none cursor-pointer p-0" onclick="return confirm('Are you sure you want to deactivate this user?');">
                                                        Deactivate
                                                    </button>
                                                @endif
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $users->withQueryString()->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>