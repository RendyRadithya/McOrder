<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - McOrder</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-neutral-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white border-b border-neutral-200 shadow-sm">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center gap-3">
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
                </div>
                
                <!-- User Info & Logout -->
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <div class="text-sm font-semibold text-neutral-900">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-neutral-500">{{ ucfirst(Auth::user()->role) }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 transition">
                            <span>🚪</span>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">✅</span>
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Welcome Card -->
        <div class="bg-white rounded-2xl shadow-md p-8 mb-8">
            <h1 class="text-4xl font-bold text-neutral-900 mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
            <p class="text-lg text-neutral-600">Anda login sebagai <span class="font-semibold text-red-600">{{ ucfirst(Auth::user()->role) }}</span></p>
        </div>

        <!-- User Info Grid -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 mb-8">
            <!-- Email Card -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                <div class="flex items-center gap-3 mb-2">
                    <span class="text-2xl">📧</span>
                    <h3 class="font-bold text-lg text-neutral-900">Email</h3>
                </div>
                <p class="text-neutral-600">{{ Auth::user()->email }}</p>
            </div>

            <!-- Phone Card -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                <div class="flex items-center gap-3 mb-2">
                    <span class="text-2xl">📱</span>
                    <h3 class="font-bold text-lg text-neutral-900">No. Telepon</h3>
                </div>
                <p class="text-neutral-600">{{ Auth::user()->phone ?? '-' }}</p>
            </div>

            <!-- Store Card -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
                <div class="flex items-center gap-3 mb-2">
                    <span class="text-2xl">🏪</span>
                    <h3 class="font-bold text-lg text-neutral-900">Nama Store</h3>
                </div>
                <p class="text-neutral-600">{{ Auth::user()->store_name ?? '-' }}</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-gradient-to-br from-red-600 to-red-700 rounded-2xl shadow-lg p-8 text-white">
            <h2 class="text-2xl font-bold mb-4">Dashboard McOrder</h2>
            <p class="text-white/90 mb-6">Sistem Pemesanan Bahan Baku Non-HAVI untuk McDonald's Citra Garden</p>
            <div class="grid gap-4 md:grid-cols-3">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 hover:bg-white/20 transition">
                    <div class="text-3xl mb-2">📦</div>
                    <div class="font-semibold">Kelola Pesanan</div>
                    <div class="text-sm text-white/80">Buat dan kelola pesanan</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 hover:bg-white/20 transition">
                    <div class="text-3xl mb-2">📊</div>
                    <div class="font-semibold">Laporan</div>
                    <div class="text-sm text-white/80">Lihat laporan transaksi</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 hover:bg-white/20 transition">
                    <div class="text-3xl mb-2">⚙️</div>
                    <div class="font-semibold">Pengaturan</div>
                    <div class="text-sm text-white/80">Kelola profil Anda</div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-neutral-200 mt-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-sm text-neutral-500">
                © 2025 McDonald's Citra Garden - McOrder System
            </p>
        </div>
    </footer>
</body>
</html>
