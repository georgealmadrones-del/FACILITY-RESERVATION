<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ auth()->user()?->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(auth()->user()?->role === 'admin')
                        <!-- Admin Navigation Links -->
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Command Center') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.reservations.index')" :active="request()->routeIs('admin.reservations.*')">
                            {{ __('Manage Reservations') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.*')">
                            {{ __('Reports') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.resources.index')" :active="request()->routeIs('admin.resources.*')">
                            {{ __('Resources') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                            {{ __('Users') }}
                        </x-nav-link>
                    @else
                        <!-- Regular User / Student Navigation Links -->
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('reservations.availability')" :active="request()->routeIs('reservations.availability')">
                            {{ __('Availability Calendar') }}
                        </x-nav-link>
                        <x-nav-link :href="route('reservations.create')" :active="request()->routeIs('reservations.create')">
                            {{ __('New Booking') }}
                        </x-nav-link>
                        <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">
                            {{ __('My Reservations') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right Header Actions -->
            <div class="flex items-center space-x-2 sm:space-x-3">
                
                <!-- Real-Time Notification Bell Dropdown (Visible on Mobile & Desktop for non-admins) -->
                @if(auth()->user()?->role !== 'admin')
                    <x-dropdown align="right" width="80">
                        <x-slot name="trigger">
                            <button class="relative p-2 text-gray-500 hover:text-gray-700 focus:outline-none transition rounded-full hover:bg-gray-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                
                                @if(auth()->user()?->unreadNotifications->count() > 0)
                                    <span class="absolute top-1 right-1 flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 text-[9px] text-white justify-center items-center font-bold">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </span>
                                    </span>
                                @endif
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-80 max-h-96 overflow-y-auto">
                                <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                                    <span class="text-xs font-bold text-gray-700 uppercase tracking-wider">Notifications</span>
                                    @if(auth()->user()?->unreadNotifications->count() > 0)
                                        <form action="{{ route('notifications.read') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-xs text-blue-600 hover:underline font-semibold">Mark all as read</button>
                                        </form>
                                    @endif
                                </div>

                                @forelse(auth()->user()?->notifications()->take(5)->get() as $notification)
                                    <div class="p-3 border-b border-gray-100 hover:bg-gray-50 transition text-xs {{ $notification->read_at ? 'opacity-60' : 'bg-blue-50/50' }}">
                                        <p class="font-bold text-gray-900">{{ $notification->data['title'] ?? 'Reservation Update' }}</p>
                                        <p class="text-gray-600 mt-0.5">{{ $notification->data['message'] ?? '' }}</p>
                                        <span class="text-[10px] text-gray-400 mt-1 block">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                @empty
                                    <div class="p-4 text-center text-xs text-gray-500">
                                        No notifications yet.
                                    </div>
                                @endforelse
                            </div>
                        </x-slot>
                    </x-dropdown>
                @endif

                <!-- Settings Dropdown (Desktop Only) -->
                <div class="hidden sm:flex sm:items-center sm:ms-2">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()?->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication Logout Form -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none transition">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger Menu Button -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            @if(auth()->user()?->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Command Center') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.reservations.index')" :active="request()->routeIs('admin.reservations.*')">
                    {{ __('Manage Reservations') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.*')">
                    {{ __('Reports') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.resources.index')" :active="request()->routeIs('admin.resources.*')">
                    {{ __('Resources') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                    {{ __('Users') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('reservations.availability')" :active="request()->routeIs('reservations.availability')">
                    {{ __('Availability Calendar') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('reservations.create')" :active="request()->routeIs('reservations.create')">
                    {{ __('New Booking') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">
                    {{ __('My Reservations') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 flex items-center justify-between">
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()?->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()?->email }}</div>
                </div>
                @if(auth()->user()?->role !== 'admin' && auth()->user()?->unreadNotifications->count() > 0)
                    <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                        {{ auth()->user()->unreadNotifications->count() }} new
                    </span>
                @endif
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication Logout Form (Mobile) -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left block ps-3 pe-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none transition">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>