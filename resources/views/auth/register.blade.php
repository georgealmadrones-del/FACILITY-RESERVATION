<x-guest-layout>
    <div class="min-h-screen flex">
        
        <!-- Left Visual Side -->
        <div class="hidden lg:flex lg:w-1/2 p-12 flex-col justify-between relative border-r border-[#EADCC9] bg-[#221A16] text-[#F3EBE1]">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-[#8C6D58] border border-[#A88870]/40 flex items-center justify-center text-[#FBF8F3] font-serif-title font-bold text-lg shadow-md">
                    📚
                </div>
                <span class="font-serif-title font-bold text-xl tracking-wide text-[#FBF8F3]">The Reserve</span>
            </div>

            <div class="space-y-6 max-w-md">
                <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 text-xs font-semibold bg-[#362A24] text-[#D9C3B0] rounded-full border border-[#4A3B33]">
                    <span>Account Creation</span>
                </div>
                
                <h1 class="font-serif-title text-4xl font-bold tracking-tight leading-tight text-[#FBF8F3]">
                    Join the reservation network.
                </h1>
                
                <p class="text-[#BCA898] text-sm leading-relaxed">
                    Set up your credentials to reserve study spaces, borrow equipment, and handle all your campus approvals smoothly.
                </p>
            </div>

            <div class="text-xs text-[#8A786B]">
                &copy; {{ date('Y') }} Facility Reservation System.
            </div>
        </div>

        <!-- Right Form Side -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 lg:p-16">
            <div class="w-full max-w-md space-y-6 bg-[#FAF6F0] p-8 sm:p-10 rounded-2xl border border-[#E8DCCF] shadow-sm">
                
                <!-- Header -->
                <div class="space-y-1.5">
                    <div class="lg:hidden flex items-center space-x-2.5 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-[#221A16] flex items-center justify-center text-white font-serif-title font-bold text-sm">📚</div>
                        <span class="font-serif-title font-bold text-base text-[#221A16]">The Reserve</span>
                    </div>
                    <h2 class="font-serif-title text-3xl font-bold tracking-tight text-[#221A16]">Create an account</h2>
                    <p class="text-xs text-[#6B5A4E]">Enter your details below to set up your account.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Full Name -->
                    <div class="space-y-1.5">
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#57483E]">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            class="w-full px-3.5 py-2.5 bg-[#F3ECE1] border border-[#D1C2B2] rounded-xl text-sm text-[#221A16] placeholder-[#A8988B] focus:outline-none focus:ring-2 focus:ring-[#8C6D58] focus:bg-white transition-all duration-150"
                            placeholder="Julian Vance">
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-rose-700" />
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#57483E]">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            class="w-full px-3.5 py-2.5 bg-[#F3ECE1] border border-[#D1C2B2] rounded-xl text-sm text-[#221A16] placeholder-[#A8988B] focus:outline-none focus:ring-2 focus:ring-[#8C6D58] focus:bg-white transition-all duration-150"
                            placeholder="julian@domain.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-rose-700" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-1.5" x-data="{ show: false }">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#57483E]">Password</label>
                        <div class="relative">
                            <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="new-password"
                                class="w-full pl-3.5 pr-10 py-2.5 bg-[#F3ECE1] border border-[#D1C2B2] rounded-xl text-sm text-[#221A16] placeholder-[#A8988B] focus:outline-none focus:ring-2 focus:ring-[#8C6D58] focus:bg-white transition-all duration-150"
                                placeholder="••••••••">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#8A786B] hover:text-[#57483E] transition">
                                <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" style="display: none;" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-rose-700" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-[#57483E]">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="w-full px-3.5 py-2.5 bg-[#F3ECE1] border border-[#D1C2B2] rounded-xl text-sm text-[#221A16] placeholder-[#A8988B] focus:outline-none focus:ring-2 focus:ring-[#8C6D58] focus:bg-white transition-all duration-150"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-rose-700" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3 px-4 bg-[#3D2E26] hover:bg-[#221A16] text-[#FAF6F0] font-bold rounded-xl shadow-sm transition-all duration-150 active:scale-[0.99] text-sm mt-2">
                        Create Account
                    </button>

                    <!-- Login Link -->
                    <p class="text-center text-xs text-[#6B5A4E] pt-2">
                        Already registered? 
                        <a href="{{ route('login') }}" class="font-bold text-[#8C6D58] hover:underline">Sign in here</a>
                    </p>
                </form>

            </div>
        </div>

    </div>
</x-guest-layout>