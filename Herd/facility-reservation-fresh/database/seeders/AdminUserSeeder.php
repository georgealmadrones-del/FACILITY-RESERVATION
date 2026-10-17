<x-guest-layout>
    <!-- System Branding Header -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">
            Reset Password
        </h2>
        <p class="text-sm text-gray-600 mt-2 px-4 leading-relaxed">
            Enter the email address associated with your account, and we'll send you a secure link to reset your password.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
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
                   placeholder="name@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Action Buttons & Links -->
        <div class="flex items-center justify-between pt-2">
            <a class="text-sm font-medium text-indigo-600 hover:text-indigo-500" href="{{ route('login') }}">
                &larr; Back to login
            </a>

            <button type="submit" style="padding: 0.75rem 1.5rem; border-radius: 0.5rem; background-color: #4f46e5; color: #ffffff; font-weight: 600; font-size: 0.95rem; border: none; cursor: pointer; transition: background-color 0.2s;" class="hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                {{ __('Send Reset Link') }}
            </button>
        </div>
    </form>
</x-guest-layout>