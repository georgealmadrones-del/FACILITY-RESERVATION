<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold tracking-tight text-[#0F0E47]">Create account</h2>
        <p class="text-xs text-[#505081] mt-1">Get started with your campus resource bookings.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-medium text-[#505081] uppercase tracking-wider mb-1">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full px-4 py-2.5 rounded-xl bg-[#F4F5F7] border border-[#8686AC]/40 text-[#272757] placeholder-[#8686AC]/70 focus:outline-none focus:border-[#505081] transition text-sm"
                placeholder="Juan Dela Cruz">
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-500" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-medium text-[#505081] uppercase tracking-wider mb-1">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="w-full px-4 py-2.5 rounded-xl bg-[#F4F5F7] border border-[#8686AC]/40 text-[#272757] placeholder-[#8686AC]/70 focus:outline-none focus:border-[#505081] transition text-sm"
                placeholder="name@domain.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-medium text-[#505081] uppercase tracking-wider mb-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full px-4 py-2.5 rounded-xl bg-[#F4F5F7] border border-[#8686AC]/40 text-[#272757] placeholder-[#8686AC]/70 focus:outline-none focus:border-[#505081] transition text-sm"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-medium text-[#505081] uppercase tracking-wider mb-1">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full px-4 py-2.5 rounded-xl bg-[#F4F5F7] border border-[#8686AC]/40 text-[#272757] placeholder-[#8686AC]/70 focus:outline-none focus:border-[#505081] transition text-sm"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-500" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full py-3 px-4 rounded-xl bg-[#272757] hover:bg-[#505081] text-white font-medium text-sm transition shadow-md flex items-center justify-center gap-2">
                Create account
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </div>

        <!-- Login link -->
        <div class="text-center pt-3 border-t border-[#8686AC]/20 mt-4">
            <p class="text-xs text-[#505081]">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-[#272757] font-semibold hover:underline ml-1">Sign in</a>
            </p>
        </div>
    </form>
</x-guest-layout>