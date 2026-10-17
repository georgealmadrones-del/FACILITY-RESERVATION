<x-guest-layout>
    <!-- System Branding Header -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">
            Facility Reservation System
        </h2>
        <p class="text-sm text-gray-600 mt-1">
            Sign in to manage your bookings and resources
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
            <input id="email" 
                   style="width: 100%; padding: 0.75rem 1rem; border-radius: 0.5rem; border: 1px solid #d1d5db; font-size: 1rem; outline: none; background-color: #ffffff;"
                   type="email" 
                   name="email" 
                   :value="old('email')" 
                   required 
                   autofocus 
                   autocomplete="username" 
                   placeholder="enter your email/name" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password with Eye Toggle Inside -->
        <div x-data="{ showPassword: false }">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>

            <div style="position: relative;">
                <input id="password" 
                       style="width: 100%; padding: 0.75rem 3rem 0.75rem 1rem; border-radius: 0.5rem; border: 1px solid #d1d5db; font-size: 1rem; outline: none; background-color: #ffffff;"
                       :type="showPassword ? 'text' : 'password'" 
                       name="password" 
                       required 
                       maxlength="9"
                       autocomplete="current-password" 
                       placeholder="••••••••" />

                <button type="button" 
                        @click="showPassword = !showPassword" 
                        style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: transparent; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; padding: 0; color: #9ca3af;"
                        class="focus:outline-none hover:text-gray-600">
                    
                    <svg x-show="!showPassword" style="width: 1.35rem; height: 1.35rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <svg x-show="showPassword" style="width: 1.35rem; height: 1.35rem; display: none;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.027 10.027 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password Links -->
        <div class="flex items-center justify-between text-sm">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 w-4 h-4" name="remember">
                <span class="ms-2 text-gray-600 font-medium">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="font-medium text-indigo-600 hover:text-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" style="width: 100%; padding: 0.75rem 1rem; border-radius: 0.5rem; background-color: #4f46e5; color: #ffffff; font-weight: 600; font-size: 1rem; border: none; cursor: pointer; transition: background-color 0.2s;" class="hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                {{ __('Log in to Account') }}
            </button>
        </div>
        
        <!-- Link to Register -->
        <div class="text-center text-sm pt-2">
            <span class="text-gray-600">Don't have an account?</span>
            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 ml-1">Register here</a>
        </div>
    </form>
</x-guest-layout>