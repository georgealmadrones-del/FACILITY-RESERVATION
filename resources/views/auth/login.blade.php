<x-guest-layout>
    <div class="min-h-screen flex">
        
        <!-- Left Visual Side Card -->
        <div class="hidden lg:flex lg:w-1/2 p-12 flex-col justify-between relative border-r border-rose-100 bg-white/40 backdrop-blur-xl">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-pink-400 via-rose-400 to-purple-400 flex items-center justify-center text-white font-extrabold text-xl shadow-lg shadow-pink-200 ring-4 ring-white/80">
                    ✨
                </div>
                <span class="text-rose-950 font-bold text-lg tracking-tight">Resource Portal</span>
            </div>

            <div class="space-y-6 max-w-lg">
                <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 text-xs font-semibold bg-pink-100/80 text-pink-700 rounded-full border border-pink-200/60 shadow-sm backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-pink-500 animate-pulse"></span>
                    <span>Campus Facility Hub</span>
                </div>
                
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight leading-[1.2]">
                    Reserve your spaces & equipment with ease.
                </h1>
                
                <p class="text-slate-600 text-sm leading-relaxed font-medium">
                    Check real-time availability, submit requests in a single tap, and keep track of all your approvals in one cute dashboard. 
                </p>

                <!-- Mini Stat Cards -->
                <div class="grid grid-cols-2 gap-4 pt-2">
                    <div class="p-4 rounded-2xl bg-white/70 border border-rose-100/80 shadow-sm backdrop-blur-md">
                        <p class="text-2xl font-bold text-pink-600">100%</p>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Live Stock & Room Availability</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-white/70 border border-rose-100/80 shadow-sm backdrop-blur-md">
                        <p class="text-2xl font-bold text-purple-600">Fast</p>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Instant Status Updates</p>
                    </div>
                </div>
            </div>

            <div class="text-xs text-slate-400 font-medium">
                &copy; {{ date('Y') }} Facility Reservation System
            </div>
        </div>

        <!-- Right Form Card -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 lg:p-16">
            <div class="w-full max-w-md space-y-8 bg-white/80 p-8 sm:p-10 rounded-3xl border border-rose-100 shadow-xl shadow-pink-500/5 backdrop-blur-2xl">
                
                <!-- Header -->
                <div class="space-y-2">
                    <div class="lg:hidden flex items-center space-x-2.5 mb-6">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-pink-400 to-purple-400 flex items-center justify-center text-white font-bold text-base shadow-sm">✨</div>
                        <span class="text-slate-900 font-bold text-base">Resource Hub</span>
                    </div>
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Welcome Back 💕</h2>
                    <p class="text-xs text-slate-500">Sign in to view your bookings and manage your requests.</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-pink-900/70">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-rose-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                                class="w-full pl-11 pr-4 py-3 bg-rose-50/40 border border-rose-200/80 rounded-2xl text-sm text-slate-800 placeholder-rose-300 focus:outline-none focus:ring-2 focus:ring-pink-400/50 focus:bg-white focus:border-pink-300 transition-all duration-200"
                                placeholder="hello@domain.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-rose-500" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-2" x-data="{ show: false }">
                        <div class="flex justify-between items-center">
                            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-pink-900/70">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-semibold text-pink-600 hover:text-pink-500 transition">Forgot?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-rose-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </span>
                            <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                                class="w-full pl-11 pr-12 py-3 bg-rose-50/40 border border-rose-200/80 rounded-2xl text-sm text-slate-800 placeholder-rose-300 focus:outline-none focus:ring-2 focus:ring-pink-400/50 focus:bg-white focus:border-pink-300 transition-all duration-200"
                                placeholder="••••••••">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-rose-300 hover:text-pink-500 transition">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-rose-500" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="flex items-center space-x-2 cursor-pointer">
                            <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-pink-500 border-rose-200 rounded-lg focus:ring-pink-300">
                            <span class="text-xs text-slate-500 font-medium">Remember me</span>
                        </label>
                    </div>

                    <!-- Gradient Button -->
                    <button type="submit" class="w-full py-3.5 px-4 bg-gradient-to-r from-pink-400 via-rose-400 to-purple-400 hover:from-pink-500 hover:to-purple-500 text-white font-bold rounded-2xl shadow-lg shadow-pink-400/25 transition-all duration-200 transform active:scale-[0.99] text-sm">
                        Sign In🌸
                    </button>

                    <!-- Register Link -->
                    @if (Route::has('register'))
                        <p class="text-center text-xs text-slate-500 pt-2 font-medium">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="font-bold text-pink-600 hover:underline">Create account</a>
                        </p>
                    @endif
                </form>

            </div>
        </div>

    </div>
</x-guest-layout>