<x-guest-layout>
    <div class="min-h-screen flex">
        
        <!-- Left Visual Side -->
        <div class="hidden lg:flex lg:w-1/2 p-12 flex-col justify-between relative border-r border-stone-200/80 bg-white/60 backdrop-blur-md">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 rounded-xl bg-stone-900 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                    F
                </div>
                <span class="text-stone-900 font-semibold text-base tracking-tight">Resource Hub</span>
            </div>

            <div class="space-y-6 max-w-md">
                <div class="inline-flex items-center space-x-2 px-3 py-1 text-xs font-medium bg-stone-100 text-stone-700 rounded-full border border-stone-200">
                    <span>Account Setup</span>
                </div>
                
                <h1 class="text-3xl font-bold text-stone-900 tracking-tight leading-snug">
                    Create an account to begin booking.
                </h1>
                
                <p class="text-stone-500 text-sm leading-relaxed font-normal">
                    Get full access to room availability calendars, submit item requests, and monitor your request status directly.
                </p>
            </div>

            <div class="text-xs text-stone-400 font-normal">
                &copy; {{ date('Y') }} Facility Reservation System.
            </div>
        </div>

        <!-- Right Form Side -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 lg:p-16">
            <div class="w-full max-w-md space-y-6 bg-white p-8 sm:p-10 rounded-2xl border border-stone-200 shadow-sm">
                
                <!-- Header -->
                <div class="space-y-1.5">
                    <div class="lg:hidden flex items-center space-x-2.5 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-stone-900 flex items-center justify-center text-white font-bold text-xs">F</div>
                        <span class="text-stone-900 font-bold text-sm">Resource Hub</span>
                    </div>
                    <h2 class="text-2xl font-bold tracking-tight text-stone-900">Create an account</h2>
                    <p class="text-xs text-stone-500">Enter your details below to register.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Full Name -->
                    <div class="space-y-1.5">
                        <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-stone-600">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            class="w-full px-3.5 py-2.5 bg-stone-50/50 border border-stone-200 rounded-xl text-sm text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-stone-900 focus:bg-white transition-all duration-150"
                            placeholder="Alex Morgan">
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-rose-600" />
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-stone-600">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            class="w-full px-3.5 py-2.5 bg-stone-50/50 border border-stone-200 rounded-xl text-sm text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-stone-900 focus:bg-white transition-all duration-150"
                            placeholder="alex@domain.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-rose-600" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-1.5" x-data="{ show: false }">
                        <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-stone-600">Password</label>
                        <div class="relative">
                            <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="new-password"
                                class="w-full pl-3.5 pr-10 py-2.5 bg-stone-50/50 border border-stone-200 rounded-xl text-sm text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-stone-900 focus:bg-white transition-all duration-150"
                                placeholder="••••••••">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-stone-400 hover:text-stone-600 transition">
                                <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" style="display: none;" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-rose-600" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-stone-600">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="w-full px-3.5 py-2.5 bg-stone-50/50 border border-stone-200 rounded-xl text-sm text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-stone-900 focus:bg-white transition-all duration-150"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-rose-600" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3 px-4 bg-stone-900 hover:bg-stone-800 text-white font-medium rounded-xl shadow-sm transition-all duration-150 active:scale-[0.99] text-sm mt-2">
                        Create Account
                    </button>

                    <!-- Login Link -->
                    <p class="text-center text-xs text-stone-500 pt-2 font-normal">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-semibold text-stone-900 hover:underline">Sign in instead</a>
                    </p>
                </form>

            </div>
        </div>

    </div>
</x-guest-layout>