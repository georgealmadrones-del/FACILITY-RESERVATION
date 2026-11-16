<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-xs text-[#505081]" :status="session('status')" />

    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold tracking-tight text-[#0F0E47]">Welcome back</h2>
        <p class="text-xs text-[#505081] mt-1">Sign in to manage your facility & equipment bookings.</p>
    </div>

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

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1">
                <label for="password" class="block text-xs font-medium text-[#505081] uppercase tracking-wider">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-[#505081] hover:text-[#0F0E47] transition" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-4 py-2.5 rounded-xl bg-[#F4F5F7] border border-[#8686AC]/40 text-[#272757] placeholder-[#8686AC]/70 focus:outline-none focus:border-[#505081] transition text-sm"
                placeholder="••••••••">
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
                Sign in to portal
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