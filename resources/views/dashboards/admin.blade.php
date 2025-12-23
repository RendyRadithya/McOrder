<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>McOrder</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/Logo MCorder.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/Logo MCorder.png') }}">
    
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
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-md bg-yellow-400 text-red-600 font-bold text-lg">M</span>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold text-neutral-900">McOrder</span>
                            <span class="text-xs text-neutral-500 -mt-1">McDonald's Citra Garden</span>
                        </div>
                    @endif 
                </div>
                
                <!-- User Info & Logout -->
                <div class="flex items-center gap-4">
                    <!-- Notification Bell -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="relative p-2 text-neutral-600 hover:text-neutral-900 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            @if($unreadNotifications->count() > 0)
                                <span class="absolute top-1 right-1 h-5 w-5 bg-red-600 rounded-full border-2 border-white flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">{{ $unreadNotifications->count() }}</span>
                                </span>
                            @endif
                        </button>

                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-neutral-100 z-50 py-2" style="display: none;">
                            <div class="px-4 py-2 border-b border-neutral-100 flex justify-between items-center">
                                <h3 class="font-semibold text-sm">Notifikasi</h3>
                                @if($unreadNotifications->count() > 0)
                                    <span class="text-xs text-neutral-500">{{ $unreadNotifications->count() }} baru</span>
                                @endif
                            </div>
                            <div class="max-h-96 overflow-y-auto">
                                @forelse($unreadNotifications->take(10) as $notification)
                                    <a href="{{ route('admin.approvals') }}" class="block px-4 py-3 hover:bg-neutral-50 border-b border-neutral-50 last:border-0 {{ $notification->read_at ? 'opacity-60' : 'bg-blue-50/30' }} transition">
                                        <div class="flex items-start gap-2">
                                            <div class="flex-1">
                                                <div class="text-sm font-medium text-neutral-900">{{ $notification->data['message'] ?? 'Notifikasi Baru' }}</div>
                                                @if(isset($notification->data['user_email']))
                                                    <div class="text-xs text-neutral-600 mt-0.5">{{ $notification->data['user_email'] }}</div>
                                                @endif
                                                <div class="text-xs text-neutral-500 mt-1">{{ $notification->created_at->diffForHumans() }}</div>
                                            </div>
                                            @if(!$notification->read_at)
                                                <div class="w-2 h-2 bg-blue-600 rounded-full mt-1 flex-shrink-0"></div>
                                            @endif
                                        </div>
                                    </a>
                                @empty
                                    <div class="px-4 py-8 text-center text-sm text-neutral-500">
                                        <svg class="w-12 h-12 mx-auto mb-2 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                        </svg>
                                        Tidak ada notifikasi
                                    </div>
                                @endforelse
                            </div>
                            
                            @if($unreadNotifications->count() > 0 || Auth::user()->notifications->count() > 0)
                                <div class="px-4 py-2 border-t border-neutral-100 flex gap-2">
                                    @if($unreadNotifications->count() > 0)
                                        <form action="{{ route('notifications.markAllRead') }}" method="POST" class="flex-1">
                                            @csrf
                                            <button type="submit" class="w-full text-center text-xs text-blue-600 hover:text-blue-700 font-medium py-1 hover:bg-blue-50 rounded transition">
                                                Tandai Dibaca
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('notifications.clearAll') }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus semua notifikasi?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full text-center text-xs text-red-600 hover:text-red-700 font-medium py-1 hover:bg-red-50 rounded transition">
                                            Hapus Semua
                                        </button>
                                    </form>
                                </div>
                            @endif
                            
                            @if($unreadNotifications->count() > 0)
                                <div class="px-4 py-2 border-t border-neutral-100">
                                    <a href="{{ route('admin.approvals') }}" class="block text-center text-sm text-blue-600 hover:text-blue-700 font-medium">
                                        Lihat Semua Permintaan →
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="relative ml-3">
                        <button id="user-menu-button" type="button" class="flex items-center gap-3 focus:outline-none" onclick="toggleUserMenu(event)">
                            <div class="text-right hidden md:block">
                                <div class="font-medium text-neutral-900 truncate max-w-[150px]">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-neutral-500 truncate">{{ Auth::user()->role ? ucfirst(Auth::user()->role) : 'Administrator' }}</div>
                                @if(Auth::user()->store_name)
                                    <div class="text-[11px] text-neutral-400 truncate">{{ Auth::user()->store_name }}</div>
                                @endif
                            </div>
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="h-10 w-10 rounded-full object-cover border-2 border-gray-200">
                            @else
                                <div class="h-10 w-10 rounded-full bg-red-600 text-white flex items-center justify-center font-semibold text-lg">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            @endif
                        </button>

                        <div id="user-menu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50">
                            <div class="px-4 py-3 border-b">
                                <div class="text-sm font-semibold text-neutral-900">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-neutral-500 mt-0.5">{{ Auth::user()->role ? ucfirst(Auth::user()->role) : 'Administrator' }}</div>
                                @if(Auth::user()->store_name)
                                    <div class="text-xs text-neutral-400 mt-0.5">{{ Auth::user()->store_name }}</div>
                                @endif
                            </div>
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-100">
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
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        <!-- Welcome Card -->
        <div class="bg-white rounded-2xl shadow-md p-8 mb-8">
            <h1 class="text-4xl font-bold text-neutral-900 mb-2">Dashboard Admin</h1>
            <p class="text-lg text-neutral-600">Selamat datang, <span class="font-semibold text-red-600">{{ Auth::user()->name }}</span></p>
            <p class="text-sm text-neutral-500 mt-2">Administrator McOrder System</p>
        </div>

        <!-- Info -->
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Approvals Card -->
            <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    @if($pendingUsersCount > 0)
                        <span class="bg-red-100 text-red-700 text-xs font-bold px-2.5 py-1 rounded-full">{{ $pendingUsersCount }} Pending</span>
                    @else
                        <span class="bg-green-100 text-green-700 text-xs font-bold px-2.5 py-1 rounded-full">All Clear</span>
                    @endif
                </div>
                <h3 class="text-lg font-bold text-neutral-900">Registrasi User</h3>
                <p class="text-sm text-neutral-500 mb-4">Kelola permintaan pendaftaran user baru.</p>
                <a href="{{ route('admin.approvals') }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                    Lihat Permintaan
                </a>
            </div>
        </div>


    </main>
</main>
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
