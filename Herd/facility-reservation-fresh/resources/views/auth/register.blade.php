<x-guest-layout>
    <!-- System Branding Header -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">
            Create an Account
        </h2>
        <p class="text-sm text-gray-600 mt-1">
            Register to access the Facility Reservation System
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
            <input id="name" 
                   style="width: 100%; padding: 0.75rem 1rem; border-radius: 0.5rem; border: 1px solid #d1d5db; font-size: 1rem; outline: none; background-color: #ffffff;"
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name" 
                   placeholder="e.g. Alex Santos" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Institutional Email / Username</label>
            <input id="email" 
                   style="width: 100%; padding: 0.75rem 1rem; border-radius: 0.5rem; border: 1px solid #d1d5db; font-size: 1rem; outline: none; background-color: #ffffff;"
                   type="text" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="username" 
                   placeholder="e.g. alex.santos or student@school.edu.ph" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Account Role Selection -->
        <div>
            <label for="role" class="block text-sm font-semibold text-gray-700 mb-1">Account Role</label>
            <select id="role" 
                    name="role" 
                    style="width: 100%; padding: 0.75rem 1rem; border-radius: 0.5rem; border: 1px solid #d1d5db; font-size: 1rem; outline: none; background-color: #ffffff; color: #374151;" 
                    required>
                <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select your account role...</option>
                <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student</option>
                <option value="faculty" {{ old('role') === 'faculty' ? 'selected' : '' }}>Faculty Member</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
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
                       autocomplete="new-password" 
                       placeholder="••••••••" />

                <!-- Eye Button Locked Inside -->
                <button type="button" 
                        @click="showPassword = !showPassword" 
                        style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: transparent; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; padding: 0; color: #9ca3af;"
                        class="focus:outline-none hover:text-gray-600">
                    
                    <!-- Eye Open -->
                    <svg x-show="!showPassword" style="width: 1.35rem; height: 1.35rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <!-- Eye Closed -->
                    <svg x-show="showPassword" style="width: 1.35rem; height: 1.35rem; display: none;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.027 10.027 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div x-data="{ showConfirmPassword: false }">
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Confirm Password</label>

            <div style="position: relative;">
                <input id="password_confirmation" 
                       style="width: 100%; padding: 0.75rem 3rem 0.75rem 1rem; border-radius: 0.5rem; border: 1px solid #d1d5db; font-size: 1rem; outline: none; background-color: #ffffff;"
                       :type="showConfirmPassword ? 'text' : 'password'" 
                       name="password_confirmation" 
                       required 
                       autocomplete="new-password" 
                       placeholder="••••••••" />

                <!-- Eye Button Locked Inside -->
                <button type="button" 
                        @click="showConfirmPassword = !showConfirmPassword" 
                        style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: transparent; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; padding: 0; color: #9ca3af;"
                        class="focus:outline-none hover:text-gray-600">
                    
                    <!-- Eye Open -->
                    <svg x-show="!showConfirmPassword" style="width: 1.35rem; height: 1.35rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <!-- Eye Closed -->
                    <svg x-show="showConfirmPassword" style="width: 1.35rem; height: 1.35rem; display: none;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.027 10.027 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit & Login Link -->
        <div class="flex items-center justify-between pt-2">
            <a class="text-sm font-medium text-indigo-600 hover:text-indigo-500" href="{{ route('login') }}">
                Already registered?
            </a>

            <button type="submit" style="padding: 0.75rem 1.5rem; border-radius: 0.5rem; background-color: #4f46e5; color: #ffffff; font-weight: 600; font-size: 0.95rem; border: none; cursor: pointer; transition: background-color 0.2s;" class="hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                {{ __('Register Account') }}
            </button>
        </div>
    </form>
</x-guest-layout>