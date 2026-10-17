<section>
    <header>
        <h2 class="text-lg font-bold text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Full Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="font-medium text-gray-700" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email / Username')" class="font-medium text-gray-700" />
            <x-text-input id="email" name="email" type="text" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Role Display Badge -->
        <div>
            <x-input-label :value="__('Account Role')" class="font-medium text-gray-700" />
            <div class="mt-1 inline-flex items-center px-3 py-1.5 rounded-lg bg-gray-100 text-xs font-semibold text-gray-800 capitalize border border-gray-200">
                <span class="w-2 h-2 rounded-full bg-blue-600 mr-2"></span>
                {{ $user->role ?? 'Student' }}
            </div>
            <p class="text-xs text-gray-500 mt-1">Role assignment is managed by system administrators.</p>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 rounded-xl px-5 py-2.5 shadow-sm">
                {{ __('Save Changes') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-semibold text-green-600"
                >{{ __('Saved successfully!') }}</p>
            @endif
        </div>
    </form>
</section>