<x-guest-layout>
    <div class="min-h-screen flex">
        
        <!-- Left Hero Section -->
        <div class="hidden lg:flex lg:w-1/2 p-12 flex-col justify-between relative border-r border-slate-800/60 bg-slate-900/40 backdrop-blur-xl">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center text-white font-extrabold text-xl shadow-lg shadow-blue-500/30 ring-1 ring-white/20">
                    F
                </div>
                <span class="text-white font-bold text-lg tracking-tight">Facility & Resource Hub</span>
            </div>

            <div class="space-y-6 max-w-lg">
                <div class="inline-flex items-center space-x-2 px-3 py-1.5 text-xs font-semibold bg-blue-500/10 text-blue-400 rounded-full border border-blue-500/20 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                    <span>Smart Campus Operations</span>
                </div>
                
                <h1 class="text-4xl font-extrabold text-white tracking-tight leading-[1.15]">
                    Seamless resource booking designed for modern teams.
                </h1>
                
                <p class="text-slate-400 text-sm leading-relaxed">
                    Check real-time facility availability, request equipment in seconds, and track approval workflows with zero friction.
                </p>

                <!-- Glass Stat Cards -->
                <div class="grid grid-cols-2 gap-4 pt-4">
                    <div class="p-4 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-md">
                        <p class="text-2xl font-bold text-white">100%</p>
                        <p class="text-xs text-slate-400 mt-1">Automated Conflicts & Stock Tracking</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-md">
                        <p class="text-2xl font-bold text-white">Live</p>
                        <p class="text-xs text-slate-400 mt-1">Real-time Approval Updates</p>
                    </div>
                </div>
            </div>

            <div class="text-xs text-slate-500">
                &copy; {{ date('Y') }} Facility Reservation System. Built for speed and simplicity.
            </div>
        </div>

        <!-- Right Form Panel -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 lg:p-16">
            <div class="w-full max-w-md space-y-8 bg-slate-900/60 p-8 sm:p-10 rounded-3xl border border-slate-800/80 shadow-2xl backdrop-blur-2xl">
                
                <!-- Header -->
                <div class="space-y-2">
                    <div class="lg:hidden flex items-center space-x-2.5 mb-6">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center text-white font-bold text-base shadow-md">F</div>
                        <span class="text-white font-bold text-base">Facility Hub</span>
                    </div>
                    <h2 class="text-2xl font-bold tracking-tight text-white">Welcome back</h2>
                    <p class="text-xs text-slate-400">Sign in to manage your reservations and view live availability.</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-300">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                                class="w-full pl-11 pr-4 py-3 bg-slate-950/80 border border-slate-800 rounded-xl text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200"
                                placeholder="name@domain.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-400" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-2" x-data="{ show: false }">
                        <div class="flex justify-between items-center">
                            <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-300">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-medium text-blue-400 hover:text-blue-300 transition">Forgot?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </span>
                            <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                                class="w-full pl-11 pr-12 py-3 bg-slate-950/80 border border-slate-800 rounded-xl text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200"
                                placeholder="••••••••">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-500 hover:text-slate-300 transition">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-400" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="flex items-center space-x-2 cursor-pointer">
                            <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 bg-slate-950 border-slate-800 rounded text-blue-600 focus:ring-blue-500 focus:ring-offset-slate-900">
                            <span class="text-xs text-slate-400">Remember session</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3.5 px-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/25 transition-all duration-200 transform active:scale-[0.99] text-sm">
                        Sign In
                    </button>

                    <!-- Register Link -->
                    @if (Route::has('register'))
                        <p class="text-center text-xs text-slate-400 pt-2">
                            Need an account? 
                            <a href="{{ route('register') }}" class="font-semibold text-blue-400 hover:text-blue-300 hover:underline">Create one here</a>
                        </p>
                    @endif
                </form>

            </div>
        </div>

    </div>
</x-guest-layout>