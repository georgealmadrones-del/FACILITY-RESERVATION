<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-slate-50 via-gray-100 to-blue-50 px-4">
        
        <!-- Logo / Brand Header -->
        <div class="mb-6 text-center">
            <a href="/" class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-indigo-600 shadow-lg shadow-indigo-200 text-white mb-3 hover:scale-105 transition">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </a>
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Welcome Back</h2>
            <p class="text-sm text-gray-500 mt-1">Sign in to manage your campus bookings and resources</p>
        </div>

        <!-- Card Container -->
        <div class="w-full sm:max-w-md bg-white/80 backdrop-blur-xl shadow-xl shadow-slate-200/50 border border-slate-100 rounded-3xl px-8 py-8">
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                            class="w-full pl-10 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition" 
                            placeholder="name@email.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider">Password</label>
                        @if (Route::has('password.request'))
                            <a class="text-xs font-medium text-indigo-600 hover:text-indigo-500 transition" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </span>
                        <input id="password" type="password" name="password" required autocomplete="current-password" 
                            class="w-full pl-10 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition" 
                            placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 w-4 h-4">
                        <span class="ml-2 text-xs text-gray-600 font-medium">Remember me on this device</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-lg shadow-indigo-600/20 focus:outline-none focus:ring-4 focus:ring-indigo-600/20 transition-all duration-200 active:scale-[0.98]">
                    Sign in to Account
                </button>

                <!-- Registration Prompt -->
                <div class="text-center pt-2">
                    <p class="text-xs text-gray-500">
                        Don't have an account yet? 
                        <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 transition ml-1">Create account</a>
                    </p>
                </div>
            </form>
        </div>
        
        <div class="mt-8 text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} Facility & Equipment Reservation System. All rights reserved.
        </div>
    </div>
</x-guest-layout>