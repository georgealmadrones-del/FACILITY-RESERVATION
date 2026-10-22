<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center p-6 sm:p-12">
        
        <!-- Brand Header -->
        <div class="flex items-center space-x-3 mb-8">
            <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-pink-400 via-rose-400 to-purple-400 flex items-center justify-center text-white font-extrabold text-xl shadow-lg shadow-pink-300/50 ring-4 ring-white/80">
                ✨
            </div>
            <span class="font-extrabold text-2xl tracking-tight text-pink-950">Resource Hub</span>
        </div>

        <!-- Center Card -->
        <div class="w-full max-w-md space-y-6 bg-white/90 p-8 sm:p-10 rounded-3xl border border-pink-200 shadow-xl shadow-pink-500/10 backdrop-blur-xl">
            
            <!-- Header Text -->
            <div class="text-center space-y-1">
                <h2 class="text-3xl font-extrabold tracking-tight text-pink-950">Create Account 💖</h2>
                <p class="text-xs text-pink-700/80">Fill in your information below to register.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Full Name -->
                <div class="space-y-1.5">
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-pink-900/80">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                        class="w-full px-3.5 py-2.5 bg-pink-50/60 border border-pink-200 rounded-2xl text-sm text-pink-950 placeholder-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:bg-white transition-all duration-150"
                        placeholder="Sofia Rose">
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-rose-600" />
                </div>

                <!-- Email Address -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-pink-900/80">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                        class="w-full px-3.5 py-2.5 bg-pink-50/60 border border-pink-200 rounded-2xl text-sm text-pink-950 placeholder-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:bg-white transition-all duration-150"
                        placeholder="sofia@domain.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-rose-600" />
                </div>

                <!-- Password -->
                <div class="space-y-1.5" x-data="{ show: false }">
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-pink-900/80">Password</label>
                    <div class="relative">
                        <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="new-password"
                            class="w-full pl-3.5 pr-10 py-2.5 bg-pink-50/60 border border-pink-200 rounded-2xl text-sm text-pink-950 placeholder-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:bg-white transition-all duration-150"
                            placeholder="••••••••">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-pink-400 hover:text-pink-600 transition">
                            <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="show" style="display: none;" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-rose-600" />
                </div>

                <!-- Confirm Password -->
                <div class="space-y-1.5">
                    <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-pink-900/80">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="w-full px-3.5 py-2.5 bg-pink-50/60 border border-pink-200 rounded-2xl text-sm text-pink-950 placeholder-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:bg-white transition-all duration-150"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-rose-600" />
                </div>

                <!-- Gradient Button -->
                <button type="submit" class="w-full py-3.5 px-4 bg-gradient-to-r from-pink-400 via-rose-400 to-purple-400 hover:from-pink-500 hover:to-purple-500 text-white font-bold rounded-2xl shadow-lg shadow-pink-400/30 transition-all duration-150 active:scale-[0.99] text-sm mt-2">
                    Create Account ✨
                </button>

                <!-- Login Link -->
                <p class="text-center text-xs text-pink-800/80 pt-2 font-medium">
                    Already registered? 
                    <a href="{{ route('login') }}" class="font-bold text-pink-600 hover:underline">Sign in here</a>
                </p>
            </form>

        </div>

        <p class="text-xs text-pink-800/60 mt-8 text-center font-medium">
            &copy; {{ date('Y') }} Facility Reservation System
        </p>

    </div>
</x-guest-layout>