<?php

<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 px-4 sm:px-6">
        <!-- Logo / Brand Header -->
        <div class="mb-6 text-center">
            <a href="/">
                <x-application-logo class="w-14 h-14 fill-current text-indigo-600 mx-auto" />
            </a>
            <h2 class="mt-3 text-2xl font-bold text-gray-900 tracking-tight">Facility Reservation System</h2>
            <p class="text-sm text-gray-500 mt-1">Sign in to manage your bookings and resources</p>
        </div>

        <!-- Card Container -->
        <div class="w-full sm:max-w-md bg-white shadow-xl sm:rounded-2xl px-6 py-8 sm:px-10 border border-gray-100">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" id="login-form" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Email Address</label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username" 
                           placeholder="enter your email"
                           class="block w-full text-sm rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm py-2.5 px-3.5 text-gray-900 placeholder-gray-400" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                </div>

                <!-- Password with Toggle Eye Icon -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Password</label>
                        @if (Route::has('password.request'))
                            <a class="text-xs text-indigo-600 hover:text-indigo-500 font-medium" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="relative">
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="current-password" 
                               placeholder="••••••••" 
                               class="block w-full text-sm rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm py-2.5 pr-11 pl-3.5 text-gray-900 placeholder-gray-400" />
                        
                        <!-- Visible Toggle Button -->
                        <button type="button" 
                                onclick="togglePasswordVisibility()" 
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-500 hover:text-indigo-600 focus:outline-none cursor-pointer z-10"
                                title="Toggle Password Visibility">
                            <!-- Eye Open Icon -->
                            <svg id="eye-open" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <!-- Eye Closed Icon -->
                            <svg id="eye-closed" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.07 10.07 0 014.392-5.18m2.592-1.558A9.97 9.97 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m-9.61-9.61l10.606 10.606" />
                            </svg>
                        </button>
                    </div>

                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 h-4 w-4">
                        <span class="ms-2 text-gray-700 font-medium">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-lg shadow-indigo-100 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Log in to Account') }}
                    </button>
                </div>

                <!-- Register Redirect -->
                <div class="text-center pt-4 border-t border-gray-100 mt-6">
                    <p class="text-xs text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-500 font-semibold ml-1">Register here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Interactive Scripts: Eye Toggle + Auto-fill Password on Email Input -->
    <script>
        // 1. Password Show / Hide Toggle
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }

        // 2. Remember Me Local Storage Auto-fill Logic
        document.addEventListener('DOMContentLoaded', () => {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const rememberCheckbox = document.getElementById('remember_me');
            const loginForm = document.getElementById('login-form');

            // Check if saved credentials exist
            const savedEmail = localStorage.getItem('remembered_email');
            const savedPassword = localStorage.getItem('remembered_password');

            if (savedEmail) {
                emailInput.value = savedEmail;
                rememberCheckbox.checked = true;
                if (savedPassword) {
                    passwordInput.value = savedPassword;
                }
            }

            // Auto-fill password as the user types their email
            emailInput.addEventListener('input', () => {
                const currentEmail = emailInput.value.trim();
                if (savedEmail && currentEmail.toLowerCase() === savedEmail.toLowerCase()) {
                    passwordInput.value = savedPassword || '';
                }
            });

            // Save or clear credentials on form submission
            loginForm.addEventListener('submit', () => {
                if (rememberCheckbox.checked) {
                    localStorage.setItem('remembered_email', emailInput.value.trim());
                    localStorage.setItem('remembered_password', passwordInput.value);
                } else {
                    localStorage.removeItem('remembered_email');
                    localStorage.removeItem('remembered_password');
                }
            });
        });
    </script>
</x-guest-layout>