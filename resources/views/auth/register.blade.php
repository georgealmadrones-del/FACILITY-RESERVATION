<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-4 sm:pt-0 bg-gray-100 px-4 sm:px-6">
        <!-- Logo / Brand Header -->
        <div class="mb-4 text-center">
            <a href="/">
                <x-application-logo class="w-12 h-12 fill-current text-indigo-600 mx-auto" />
            </a>
            <h2 class="mt-2 text-xl font-bold text-gray-900 tracking-tight">Create an Account</h2>
            <p class="text-xs text-gray-500 mt-0.5">Register to start reserving facilities and equipment</p>
        </div>

        <!-- Card Container -->
        <div class="w-full sm:max-w-md bg-white shadow-md sm:rounded-xl px-5 py-6 sm:p-8 border border-gray-100">
            <form method="POST" action="{{ route('register') }}" class="space-y-3">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Full Name')" class="text-xs font-semibold text-gray-700 uppercase tracking-wider" />
                    <x-text-input id="name" class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your full name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email Address')" class="text-xs font-semibold text-gray-700 uppercase tracking-wider" />
                    <x-text-input id="email" class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter your email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-xs font-semibold text-gray-700 uppercase tracking-wider" />
                    <x-text-input id="password" class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-xs font-semibold text-gray-700 uppercase tracking-wider" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                    type="password"
                                    name="password_confirmation"
                                    required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs" />
                </div>

                <!-- Submit Button & Login Link -->
                <div class="pt-3">
                    <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Register Account') }}
                    </button>
                </div>

                <div class="text-center pt-2 border-t border-gray-100 mt-3">
                    <p class="text-xs text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500 font-semibold ml-1">Log in here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>