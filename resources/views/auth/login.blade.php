<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-4 sm:pt-0 bg-gray-100 px-4 sm:px-6">
        <!-- Logo / Brand Header -->
        <div class="mb-4 text-center">
            <a href="/">
                <x-application-logo class="w-12 h-12 fill-current text-indigo-600 mx-auto" />
            </a>
            <h2 class="mt-2 text-xl font-bold text-gray-900 tracking-tight">Facility Reservation System</h2>
            <p class="text-xs text-gray-500 mt-0.5">Sign in to manage your bookings and resources</p>
        </div>

        <!-- Card Container -->
        <div class="w-full sm:max-w-md bg-white shadow-md sm:rounded-xl px-5 py-6 sm:p-8 border border-gray-100">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email Address')" class="text-xs font-semibold text-gray-700 uppercase tracking-wider" />
                    <x-text-input id="email" class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="enter your email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between">
                        <x-input-label for="password" :value="__('Password')" class="text-xs font-semibold text-gray-700 uppercase tracking-wider" />
                        @if (Route::has('password.request'))
                            <a class="text-xs text-indigo-600 hover:text-indigo-500 font-medium" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <x-text-input id="password" class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" placeholder="••••••••" />

                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Log in to Account') }}
                    </button>
                </div>

                <!-- Register Redirect -->
                <div class="text-center pt-3 border-t border-gray-100 mt-4">
                    <p class="text-xs text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-500 font-semibold ml-1">Register here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>