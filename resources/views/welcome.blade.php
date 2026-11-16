<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Facility & Equipment Booking') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts / Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#F2F0EF] text-[#2C332B] font-['Inter',sans-serif] min-h-screen flex flex-col justify-between selection:bg-[#4B6E48] selection:text-white">

    <!-- Minimal Top Navigation -->
    <header class="w-full max-w-5xl mx-auto px-6 py-6 flex items-center justify-between">
        <div class="flex items-center gap-2.5">
            <div class="w-3.5 h-3.5 rounded-full bg-[#4B6E48]"></div>
            <span class="font-semibold tracking-tight text-lg text-[#2C332B]">
                CampusReserve
            </span>
        </div>

        @if (Route::has('login'))
            <nav class="flex items-center gap-4 text-sm font-medium">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-lg bg-[#4B6E48] text-white hover:bg-[#3d5a3b] transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-[#898989] hover:text-[#2C332B] transition">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-[#4B6E48] text-white hover:bg-[#3d5a3b] transition">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <!-- Centered Main Content -->
    <main class="w-full max-w-2xl mx-auto px-6 text-center my-auto py-16">
        <span class="inline-block px-3 py-1 mb-6 text-xs font-medium tracking-wide uppercase rounded-full bg-[#B2AC88]/25 text-[#4B6E48]">
            School Resource Portal
        </span>

        <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-[#2C332B] leading-tight mb-5">
            Facility & Equipment Reservation Made Simple.
        </h1>

        <p class="text-base sm:text-lg text-[#898989] leading-relaxed mb-10 max-w-xl mx-auto">
            Check real-time availability, reserve campus rooms, and borrow equipment without scheduling conflicts.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-3.5">
            @auth
                <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-7 py-3 rounded-lg bg-[#4B6E48] text-white font-medium hover:bg-[#3d5a3b] transition shadow-sm">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="w-full sm:w-auto px-7 py-3 rounded-lg bg-[#4B6E48] text-white font-medium hover:bg-[#3d5a3b] transition shadow-sm">
                    Sign In to Book
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-7 py-3 rounded-lg bg-white border border-[#B2AC88]/60 text-[#2C332B] font-medium hover:border-[#4B6E48] transition">
                        Create an Account
                    </a>
                @endif
            @endauth
        </div>
    </main>

    <!-- Minimal Footer -->
    <footer class="w-full max-w-5xl mx-auto px-6 py-6 border-t border-[#B2AC88]/30 flex flex-col sm:flex-row items-center justify-between text-xs text-[#898989] gap-2">
        <p>&copy; {{ date('Y') }} School Facility & Equipment Management System.</p>
        <p>Built for seamless campus scheduling.</p>
    </footer>

</body>
</html>