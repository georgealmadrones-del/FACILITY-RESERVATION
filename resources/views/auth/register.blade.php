<x-guest-layout>
    <div class="min-h-screen bg-[#09090B] text-zinc-100 flex items-center justify-center p-6 lg:p-12 font-['Plus_Jakarta_Sans',sans-serif]">
        <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-12 gap-8 items-center bg-[#121215] border border-[#27272A] rounded-3xl p-8 lg:p-12 shadow-2xl">
            
            <!-- Left Side: Hero Brand Showcase -->
            <div class="lg:col-span-7 space-y-6 pr-0 lg:pr-8 border-b lg:border-b-0 lg:border-r border-[#27272A] pb-8 lg:pb-0">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('reserva.jpg') }}" alt="RESERVA Logo" class="w-10 h-10 rounded-xl object-cover border border-zinc-700 shadow-md" onerror="this.style.display='none';">
                    <span class="font-extrabold text-white text-lg tracking-tight">RESERVA</span>
                </div>

                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-zinc-900 border border-zinc-800 text-[11px] font-semibold text-emerald-400">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>SECURE PORTAL ACCESS</span>
                </div>

                <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">
                    Shared spaces.<br>Smarter access.
                </h1>

                <p class="text-sm text-zinc-400 max-w-md leading-relaxed">
                    Create your account to start scheduling facilities and borrowing technical equipment seamlessly.
                </p>

                <div class="pt-4 flex items-center space-x-4">
                    <div class="bg-zinc-900/80 px-4 py-3 rounded-2xl border border-zinc-800">
                        <span class="text-lg font-extrabold text-white block">100%</span>
                        <span class="text-[10px] text-zinc-500 uppercase tracking-wider block">Verified Access</span>
                    </div>
                </div>
            </div>

            <!-- Right Side: Register Form Card -->
            <div class="lg:col-span-5 space-y-6">
                <div class="flex space-x-2 bg-zinc-900 p-1.5 rounded-2xl border border-zinc-800 text-xs font-bold text-center">
                    <a href="{{ route('login') }}" class="flex-1 py-2 rounded-xl text-zinc-400 hover:text-white transition">Sign in</a>
                    <a href="{{ route('register') }}" class="flex-1 py-2 rounded-xl bg-zinc-800 text-white shadow-sm transition">Register</a>
                </div>

                <div>
                    <h3 class="text-xl font-extrabold text-white">Create your account</h3>
                    <p class="text-xs text-zinc-400 mt-1">Enter your details to register for RESERVA.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Full name</label>
                        <input type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe"
                            class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 transition placeholder-zinc-600">
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-400" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Email address</label>
                        <input type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@domain.com"
                            class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 transition placeholder-zinc-600">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-400" />
                    </div>

                    <!-- Role Selection (Student or Faculty) -->
                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Select role</label>
                        <select name="role" required class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 transition">
                            <option value="" disabled selected>Select your role</option>
                            <option value="Student">Student</option>
                            <option value="Faculty">Faculty</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-1 text-xs text-red-400" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Password</label>
                        <input type="password" name="password" required autocomplete="new-password" placeholder="••••••••"
                            class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 transition placeholder-zinc-600">
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-400" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1.5">Confirm password</label>
                        <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••"
                            class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-100 focus:outline-none focus:border-emerald-500 transition placeholder-zinc-600">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-400" />
                    </div>

                    <button type="submit" class="w-full py-3 bg-emerald-500 hover:bg-emerald-400 text-zinc-950 font-bold text-xs rounded-xl transition shadow-lg flex items-center justify-center space-x-2">
                        <span>Create account</span>
                        <span>&rarr;</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-guest-layout>