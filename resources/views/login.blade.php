<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - McOrder</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-neutral-50 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white border-b border-neutral-200 shadow-sm">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-3">
                    @php
                        $logoPaths = [
                            'images/Logo MCorder.png',
                            'images/Logo MCorder.jpg',
                            'images/logo-mcorder.png',
                            'images/logo-mcorder.jpg',
                        ];
                        $logoFound = false;
                        foreach ($logoPaths as $path) {
                            if (file_exists(public_path($path))) {
                                $logoFound = $path;
                                break;
                            }
                        }
                    @endphp
                    @if($logoFound)
                        <img src="{{ asset($logoFound) }}" alt="McOrder" class="h-10 w-auto">
                    @else
                        <div class="flex items-center gap-2">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-md bg-yellow-400 text-red-600 font-bold text-lg">M</span>
                            <div class="flex flex-col">
                                <span class="text-lg font-bold text-neutral-900">McOrder</span>
                                <span class="text-xs text-neutral-500 -mt-1">McDonald's Citra Garden</span>
                            </div>
                        </div>
                    @endif
                </a>
                <!-- Mulai Sekarang Button -->
                <a href="/" class="inline-flex items-center gap-2 rounded-md bg-red-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-700 transition">
                    <span>→</span>
                    Mulai Sekarang
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center bg-red-600 px-4 py-12">
        <div class="w-full max-w-md">
            <!-- Login Card -->
            <div class="bg-white rounded-2xl shadow-2xl p-8">
                <h2 class="text-3xl font-bold text-neutral-900 mb-2 text-center">Selamat Datang</h2>
                <p class="text-neutral-500 text-center mb-8 text-sm">Sistem Pemesanan Bahan Baku Non-HAVI</p>

                <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-neutral-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="w-full pl-10 pr-4 py-2.5 border border-neutral-300 rounded-lg focus:border-red-500 focus:ring-1 focus:ring-red-500 focus:outline-none transition"
                                placeholder="email@example.com"
                                required
                            >
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-neutral-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="w-full pl-10 pr-4 py-2.5 border border-neutral-300 rounded-lg focus:border-red-500 focus:ring-1 focus:ring-red-500 focus:outline-none transition"
                                placeholder="••••••••"
                                required
                            >
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-red-600 border-neutral-300 rounded focus:ring-red-500">
                            <span class="text-neutral-600">Ingat saya</span>
                        </label>
                        <a href="#" class="text-red-600 hover:text-red-700 font-medium hover:underline">Lupa password?</a>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="w-full rounded-lg bg-rose-400 px-7 py-3 text-base font-semibold text-white hover:bg-rose-500 transition shadow-md">
                        Login
                    </button>

                    <!-- Register Link -->
                    <div class="text-center text-sm">
                        <span class="text-neutral-600">Belum punya akun?</span>
                        <a href="/register" class="text-red-600 hover:text-red-700 font-semibold hover:underline ml-1">Daftar di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-red-600 py-4">
        <div class="text-center">
            <p class="text-white text-sm">
                © 2025 McDonald's Citra Garden - McOrder System
            </p>
        </div>
    </footer>
</body>
</html>
