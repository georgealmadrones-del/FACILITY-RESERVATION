<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-xs text-[#505081]" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-medium text-[#505081] uppercase tracking-wider mb-1">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full px-4 py-2.5 rounded-xl bg-[#F4F5F7] border border-[#8686AC]/40 text-[#272757] placeholder-[#8686AC]/70 focus:outline-none focus:border-[#505081] transition text-sm"
                placeholder="name@domain.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500" />
        </div>

        <!-- Password with Eye Toggle -->
        <div x-data="{ show: false }">
            <div class="flex items-center justify-between mb-1">
                <label for="password" class="block text-xs font-medium text-[#505081] uppercase tracking-wider">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-[#505081] hover:text-[#0F0E47] transition" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <div class="relative">
                <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                    class="w-full pl-4 pr-11 py-2.5 rounded-xl bg-[#F4F5F7] border border-[#8686AC]/40 text-[#272757] placeholder-[#8686AC]/70 focus:outline-none focus:border-[#505081] transition text-sm"
                    placeholder="••••••••">
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#8686AC] hover:text-[#272757] focus:outline-none">
                    <!-- Eye Open -->
                    <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <!-- Eye Off -->
                    <svg x-show="show" style="display: none;" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between text-xs py-1">
            <label for="remember_me" class="flex items-center gap-2 cursor-pointer text-[#505081]">
                <input id="remember_me" type="checkbox" name="remember" class="rounded bg-[#F4F5F7] border-[#8686AC] text-[#272757] focus:ring-0">
                <span>Remember me on this device</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full py-3 px-4 rounded-xl bg-[#272757] hover:bg-[#505081] text-white font-medium text-sm transition shadow-md flex items-center justify-center gap-2">
                Sign in
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </div>

        <!-- Register link -->
        @if (Route::has('register'))
            <div class="text-center pt-3 border-t border-[#8686AC]/20 mt-4">
                <p class="text-xs text-[#505081]">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-[#272757] font-semibold hover:underline ml-1">Create account</a>
                </p>
            </div>
        @endif
    </form>
</x-guest-layout>