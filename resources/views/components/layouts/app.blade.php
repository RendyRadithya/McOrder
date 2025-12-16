<!DOCTYPE html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ $title ?? 'McOrder' }}</title>
		
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="{{ asset('images/Logo MCorder.png') }}">
		<link rel="apple-touch-icon" href="{{ asset('images/Logo MCorder.png') }}">
		
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
		@vite(['resources/css/app.css','resources/js/app.js'])
	</head>
	<body class="font-sans antialiased bg-white text-neutral-900">
		<header class="sticky top-0 z-30 bg-white border-b border-neutral-200 shadow-sm">
			<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
				<div class="flex h-20 items-center justify-between">
					<a href="{{ url('/') }}" class="flex items-center gap-3">
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
					<nav class="hidden md:flex items-center gap-8">
						<a href="#tentang" class="text-sm font-medium text-neutral-600 hover:text-neutral-900 transition">Tentang Kami</a>
						<a href="#fitur" class="text-sm font-medium text-neutral-600 hover:text-neutral-900 transition">Fitur</a>
						<a href="#kontak" class="text-sm font-medium text-neutral-600 hover:text-neutral-900 transition">Kontak</a>
					</nav>
					<div class="flex items-center gap-3">
                        @auth
                            <!-- Notification Component -->
                            @include('components.notifications')

                            <!-- User Menu -->
                            <div class="relative ml-3">
                                <button id="user-menu-button" type="button" class="flex items-center gap-3 focus:outline-none" onclick="toggleUserMenu(event)">
                                    <div class="text-right hidden md:block">
                                        <div class="font-medium text-neutral-900 truncate max-w-[150px]">{{ Auth::user()->name }}</div>
                                        <div class="text-xs text-neutral-500 truncate">{{ Auth::user()->store_name ?? ucfirst(Auth::user()->role) }}</div>
                                    </div>
                                    <div class="h-10 w-10 rounded-full bg-red-600 text-white flex items-center justify-center font-semibold text-lg">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                </button>

                                <!-- Dropdown Menu -->
                                <div id="user-menu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50">
                                    <!-- Header -->
                                    <div class="px-4 py-3 border-b">
                                        <div class="text-sm font-semibold text-neutral-900">{{ Auth::user()->name }}</div>
                                        <div class="text-xs text-neutral-500 mt-0.5">
                                            {{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                                            @if(Auth::user()->store_name)
                                                <span class="block text-xs text-neutral-400">{{ Auth::user()->store_name }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Menu Items -->
                                    <div class="py-1">
                                        <a href="{{ url('/profile') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span>Profile</span>
                                        </a>

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="flex w-full items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-neutral-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"></path>
                                                </svg>
                                                <span class="font-medium">Logout</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="/login" class="inline-flex items-center gap-2 rounded-md bg-red-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-700 transition">
                                <span>🔐</span>
                                Login
                            </a>
                        @endauth
					</div>
				</div>
			</div>
		</header>
		<main>
			{{ $slot }}
		</main>
		<footer id="kontak" class="bg-white border-t border-neutral-200 mt-20">
			<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
				<div class="grid gap-10 md:grid-cols-4 mb-12">
					<div class="md:col-span-1">
						@php
							$logoFound = false;
							foreach ($logoPaths as $path) {
								if (file_exists(public_path($path))) {
									$logoFound = $path;
									break;
								}
							}
						@endphp
						@if($logoFound)
							<img src="{{ asset($logoFound) }}" alt="McOrder" class="h-12 w-auto mb-4">
						@else
							<div class="flex items-center gap-2 mb-4">
								<span class="inline-flex h-12 w-12 items-center justify-center rounded-md bg-yellow-400 text-red-600 font-bold text-xl">M</span>
								<span class="text-2xl font-bold text-red-600">McOrder</span>
							</div>
						@endif
						<p class="text-sm text-neutral-600 leading-relaxed mb-6">Sistem pemesanan bahan baku non-HAVI untuk McDonald's Citra Garden yang efisien dan terintegrasi.</p>
						<div class="flex gap-3">
							<a href="#" class="h-10 w-10 rounded-lg border border-neutral-300 flex items-center justify-center text-neutral-600 hover:bg-neutral-100 hover:border-neutral-400 transition">f</a>
							<a href="#" class="h-10 w-10 rounded-lg border border-neutral-300 flex items-center justify-center text-neutral-600 hover:bg-neutral-100 hover:border-neutral-400 transition">📷</a>
							<a href="#" class="h-10 w-10 rounded-lg border border-neutral-300 flex items-center justify-center text-neutral-600 hover:bg-neutral-100 hover:border-neutral-400 transition">🐦</a>
							<a href="#" class="h-10 w-10 rounded-lg border border-neutral-300 flex items-center justify-center text-neutral-600 hover:bg-neutral-100 hover:border-neutral-400 transition">▶</a>
						</div>
					</div>
					<div class="text-sm">
						<div class="font-bold text-base text-neutral-900 mb-4">Navigasi Cepat</div>
						<ul class="space-y-3 text-neutral-600">
							<li><a href="#tentang" class="hover:text-neutral-900 transition">Tentang Kami</a></li>
							<li><a href="#fitur" class="hover:text-neutral-900 transition">Fitur</a></li>
							<li><a href="#" class="hover:text-neutral-900 transition">Design System</a></li>
							<li><a href="/login" class="hover:text-neutral-900 transition">Login</a></li>
						</ul>
					</div>
					<div class="text-sm">
						<div class="font-bold text-base text-neutral-900 mb-4">Hubungi Kami</div>
						<ul class="space-y-3 text-neutral-600">
							<li class="flex items-start gap-3">
								<span class="text-red-600 text-lg flex-shrink-0">📍</span>
								<span class="leading-relaxed">Komp. Perum Citra 6, Citra Garden City Blok L3, Tegal Alur, Kalideres, West Jakarta City, Jakarta 11820</span>
							</li>
							<li class="flex items-center gap-3">
								<span class="text-red-600 text-lg flex-shrink-0">📞</span>
								<span>(021) 5439-8888</span>
							</li>
							<li class="flex items-center gap-3">
								<span class="text-red-600 text-lg flex-shrink-0">✉</span>
								<span>mcorder@mcd-citragarden.com</span>
							</li>
						</ul>
					</div>
					<div class="text-sm">
						<div class="font-bold text-base text-neutral-900 mb-4">Link Penting</div>
						<ul class="space-y-3 text-neutral-600">
							<li><a href="#" class="hover:text-neutral-900 transition">McDonald's Indonesia ↗</a></li>
							<li><a href="#" class="hover:text-neutral-900 transition">Dashboard Store</a></li>
							<li><a href="#" class="hover:text-neutral-900 transition">Dashboard Vendor</a></li>
							<li><a href="#" class="hover:text-neutral-900 transition">Dashboard Admin</a></li>
						</ul>
					</div>
				</div>
				<div class="pt-8 border-t border-neutral-200 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-neutral-500">
					<div>© 2025 McDonald's Indonesia. All rights reserved. McOrder System.</div>
					<div class="flex gap-6">
						<a href="#" class="hover:text-neutral-900 transition">Syarat & Ketentuan</a>
						<a href="#" class="hover:text-neutral-900 transition">Kebijakan Privasi</a>
					</div>
				</div>
			</div>
		</footer>
		<script>
            function toggleUserMenu(event) {
                event.stopPropagation();
                const menu = document.getElementById('user-menu');
                menu.classList.toggle('hidden');
            }

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                const menu = document.getElementById('user-menu');
                const button = document.getElementById('user-menu-button');
                if (menu && !menu.classList.contains('hidden') && !menu.contains(event.target) && !button.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });
        </script>
	</body>
</html>
