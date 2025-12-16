<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>McOrder</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/Logo MCorder.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/Logo MCorder.png') }}">
    
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-red-600 min-h-screen flex flex-col">
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
    <main class="flex-1 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md mx-auto">
            <div class="bg-white rounded-2xl shadow-2xl p-8">
                @if(session('status'))
                    <div class="mb-4 text-sm text-green-700 bg-green-50 p-3 rounded">{{ session('status') }}</div>
                @endif

                @if(!empty($show_change_password))
                    <h2 class="text-2xl font-bold text-center mb-1">Reset Password</h2>
                    <p class="text-center text-sm text-neutral-500 mb-6">Masukkan email akun, password lama dan password baru</p>

                    <form method="POST" action="{{ route('password.change.update') }}" class="space-y-4">
                        @csrf

                        <!-- EMAIL (di atas Password Lama) -->
                        <div>
                            <label class="block text-sm font-medium text-neutral-700 mb-2">Email</label>
                            <input
                                name="email"
                                type="email"
                                required
                                value="{{ old('email') }}"
                                placeholder="email@example.com"
                                class="w-full rounded-md border border-gray-300 px-4 py-3 bg-neutral-50 focus:outline-none focus:ring-2 focus:ring-red-500"
                            />
                            @error('email')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
                        </div>

                        <!-- Password Lama dengan toggle (label di luar wrapper relatif) -->
                        <label class="block text-sm font-medium text-neutral-700 mb-2">Password Lama</label>
                        <div class="relative">
                            <input id="current_password" name="current_password" type="password" required
                                class="w-full rounded-md border border-neutral-200 px-4 py-3 bg-neutral-50 pr-12 focus:outline-none" placeholder="••••••" />
                            <button type="button" class="absolute right-3 inset-y-0 flex items-center text-neutral-500 p-1"
                                data-target="current_password" aria-label="toggle current password">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                            </button>
                        </div>
                        @error('current_password')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror

                        <!-- Password Baru dengan toggle -->
                        <label class="block text-sm font-medium text-neutral-700 mb-2 mt-4">Password Baru</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" required
                                class="w-full rounded-md border border-neutral-200 px-4 py-3 bg-neutral-50 pr-12 focus:outline-none" placeholder="••••••" />
                            <button type="button" class="absolute right-3 inset-y-0 flex items-center text-neutral-500 p-1"
                                data-target="password" aria-label="toggle new password">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                            </button>
                        </div>
                        @error('password')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror

                        <!-- Konfirmasi Password Baru dengan toggle -->
                        <label class="block text-sm font-medium text-neutral-700 mb-2 mt-4">Konfirmasi Password Baru</label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                class="w-full rounded-md border border-neutral-200 px-4 py-3 bg-neutral-50 pr-12 focus:outline-none" placeholder="••••••" />
                            <button type="button" class="absolute right-3 inset-y-0 flex items-center text-neutral-500 p-1"
                                data-target="password_confirmation" aria-label="toggle confirm password">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                            </button>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-md font-semibold hover:bg-red-700 transition">
                                Reset
                            </button>
                        </div>

                        <div class="pt-4 text-center text-sm text-neutral-600">
                            <a href="{{ route('login') }}" class="text-red-600 hover:underline">Kembali ke Login</a>
                        </div>
                    </form>

                    <!-- JS toggle simple (inline) -->
                    <script>
                        document.querySelectorAll('.toggle-password').forEach(function(btn){
                            btn.addEventListener('click', function(){
                                var target = btn.getAttribute('data-target');
                                var input = document.getElementById(target);
                                if(!input) return;
                                if(input.type === 'password'){
                                    input.type = 'text';
                                    btn.setAttribute('aria-pressed', 'true');
                                } else {
                                    input.type = 'password';
                                    btn.setAttribute('aria-pressed', 'false');
                                }
                            });
                        });
                    </script>
                @else
                    <!-- existing login form -->
                    <h2 class="text-2xl sm:text-3xl font-bold text-neutral-900 mb-1 text-center">Selamat Datang</h2>
                    <p class="text-neutral-500 text-center mb-6 text-sm">Sistem Pemesanan Bahan Baku Non-HAVI</p>
                    <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-neutral-700 mb-2">Email</label>
                            <input name="email" type="email" required class="w-full rounded-md border px-4 py-3 bg-neutral-50" />
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-neutral-700 mb-2">Password</label>

                                <!-- buat wrapper relatif hanya untuk input agar ikon sejajar vertikal dengan teks •••••• -->
                                <div class="relative">
                                    <input
                                        id="login_password"
                                        name="password"
                                        type="password"
                                        required
                                        placeholder="••••••"
                                        class="w-full rounded-md border px-4 py-3 bg-neutral-50 pr-12 focus:outline-none focus:ring-2 focus:ring-red-500"
                                    />
                                    <button type="button"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 flex items-center text-neutral-500 p-1"
                                        data-target="login_password"
                                        aria-label="Toggle password visibility">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <label class="inline-flex items-center gap-2 text-neutral-700">
                                <input type="checkbox" name="remember" class="rounded" /> Ingat saya
                            </label>
                            <a href="{{ route('password.change') }}" class="text-red-600 hover:underline">Lupa password?</a>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-md font-semibold hover:bg-red-700 transition">
                                Login
                            </button>
                        </div>

                        <!-- Tampilkan link registrasi (hapus Google sign-in) -->
                        <div class="mt-6 text-center text-sm text-neutral-600">
                            Belum punya akun? <a href="{{ route('register') }}" class="text-red-600 font-medium hover:underline">Daftar di sini</a>
                        </div>
                    </form>
                @endif
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

    <!-- compact JS toggle (add once before closing </body>) -->
    <script>
    document.addEventListener('click', function(e){
        var btn = e.target.closest('button[data-target]');
        if (!btn) return;
        var id = btn.getAttribute('data-target');
        var input = document.getElementById(id);
        if (!input) return;
        input.type = input.type === 'password' ? 'text' : 'password';
        btn.setAttribute('aria-pressed', input.type === 'text' ? 'true' : 'false');
    });
    </script>
</body>
</html>
