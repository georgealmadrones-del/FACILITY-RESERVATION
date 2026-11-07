<x-guest-layout>
    <div class="min-h-screen bg-[#09090B] text-zinc-100 flex items-center justify-center p-4 sm:p-6 lg:p-12 font-['Plus_Jakarta_Sans',sans-serif] relative overflow-hidden"
         x-data="{ showPassword: false, showConfirmPassword: false }">
        
        <!-- Ambient Green Radial Glow Backgrounds -->
        <div class="absolute -top-32 -left-32 w-[30rem] h-[30rem] bg-emerald-500/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-[24rem] h-[24rem] bg-emerald-900/10 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-12 gap-8 items-center bg-[#121215]/90 backdrop-blur-xl border border-[#27272A] rounded-3xl p-6 sm:p-10 lg:p-12 shadow-2xl relative z-10">
            
            <!-- Left Side: Hero Brand Showcase -->
            <div class="lg:col-span-7 space-y-8 pr-0 lg:pr-8 border-b lg:border-b-0 lg:border-r border-[#27272A] pb-8 lg:pb-0 relative">
                <div class="absolute top-0 left-0 w-48 h-48 bg-emerald-500/15 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 space-y-6">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('images/reserva.jpg') }}" alt="RESERVA Logo" class="w-10 h-10 rounded-xl object-cover border border-emerald-500/30 shadow-lg shadow-emerald-950/50" onerror="this.src='{{ asset('reserva.jpg') }}';">
                            <span class="font-extrabold text-white text-lg tracking-tight">RESERVA</span>
                        </div>
                        <!-- Back to Home Link -->
                        <a href="{{ url('/') }}" class="text-xs font-semibold text-zinc-400 hover:text-white transition flex items-center space-x-1.5 bg-zinc-900/80 px-3 py-1.5 rounded-xl border border-zinc-800">
                            <span>&larr;</span>
                            <span>Back to home</span>
                        </a>
                    </div>

                    <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-zinc-900/90 border border-zinc-800 text-[11px] font-semibold text-emerald-400">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>CAMPUS RESOURCE PLATFORM</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.1]">
                        Shared spaces.<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-zinc-200 to-zinc-400">Smarter access.</span>
                    </h1>

                    <p class="text-xs sm:text-sm text-zinc-400 max-w-md leading-relaxed">
                        Create your account to start scheduling facilities and borrowing technical equipment seamlessly.
                    </p>

                    <div class="pt-4 flex items-center space-x-4">
                        <div class="bg-zinc-900/80 px-4 py-3 rounded-2xl border border-zinc-800 flex items-center space-x-3">
                            <span class="text-2xl font-extrabold text-white">100%</span>
                            <div class="border-l border-zinc-800 pl-3">
                                <span class="text-[10px] text-zinc-400 uppercase font-bold tracking-wider block">Verified Access</span>
                                <span class="text-[9px] text-emerald-400 font-semibold block">● Instant verification</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Register Form Card -->
            <div class="lg:col-span-5 space-y-6 relative z-10">
                <div class="flex space-x-2 bg-zinc-900/90 p-1.5 rounded-2xl border border-zinc-800 text-xs font-bold text-center">
                    <a href="{{ route('login') }}" class="flex-1 py-2.5 rounded-xl text-zinc-400 hover:text-white transition">Sign in</a>
                    <a href="{{ route('register') }}" class="flex-1 py-2.5 rounded-xl bg-zinc-800 text-white shadow-sm transition border border-zinc-700/50">Register</a>
                </div>

                <div>
                    <h3 class="text-xl font-extrabold text-white">Create your account</h3>
                    <p class="text-xs text-zinc-400 mt-1">Enter your details to register for RESERVA.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Full name</label>
                        <!-- John Doe placeholder removed -->
                        <input type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your full name"
                            class="w-full bg-zinc-900/80 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition placeholder-zinc-600">
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-400" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Email address</label>
                        <input type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@domain.com"
                            class="w-full bg-zinc-900/80 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition placeholder-zinc-600">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-400" />
                    </div>

                    <!-- Role Selection (Student or Faculty) -->
                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Select role</label>
                        <select name="role" required class="w-full bg-zinc-900/80 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                            <option value="" disabled selected>Select your role</option>
                            <option value="Student">Student</option>
                            <option value="Faculty">Faculty</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-1 text-xs text-red-400" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Password</label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="new-password" placeholder="••••••••" maxlength="9"
                                class="w-full bg-zinc-900/80 border border-zinc-800 rounded-xl pl-4 pr-10 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition placeholder-zinc-600">
                            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-zinc-400 hover:text-zinc-200 focus:outline-none">
                                <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="showPassword" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                        <span class="text-[10px] text-zinc-500 mt-1 block">Maximum 9 characters</span>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-400" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Confirm password</label>
                        <div class="relative">
                            <input :type="showConfirmPassword ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" maxlength="9"
                                class="w-full bg-zinc-900/80 border border-zinc-800 rounded-xl pl-4 pr-10 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition placeholder-zinc-600">
                            <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-zinc-400 hover:text-zinc-200 focus:outline-none">
                                <svg x-show="!showConfirmPassword" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="showConfirmPassword" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-400" />
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-emerald-500 hover:bg-emerald-400 text-zinc-950 font-bold text-xs rounded-xl transition shadow-lg shadow-emerald-950/40 flex items-center justify-center space-x-2">
                        <span>Create account</span>
                        <span>&rarr;</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-guest-layout>