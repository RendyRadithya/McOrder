<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan User - Admin McOrder</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-neutral-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white border-b border-neutral-200 shadow-sm">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-md bg-yellow-400 text-red-600 font-bold text-lg">M</span>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold text-neutral-900">McOrder</span>
                            <span class="text-xs text-neutral-500 -mt-1">Admin Panel</span>
                        </div>
                    </a>
                </div>
                
                <!-- User Info & Logout -->
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <div class="text-sm font-semibold text-neutral-900">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-neutral-500">Administrator</div>
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
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-neutral-900">Permintaan Registrasi User</h1>
            <a href="{{ route('dashboard') }}" class="text-sm text-neutral-600 hover:text-neutral-900">← Kembali ke Dashboard</a>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-neutral-200 overflow-hidden">
            @if($pendingUsers->count() > 0)
                <table class="min-w-full divide-y divide-neutral-200">
                    <thead class="bg-neutral-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Role</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Info Tambahan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Tanggal Daftar</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-neutral-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-neutral-200">
                        @foreach($pendingUsers as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-neutral-900">{{ $user->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-neutral-500">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-neutral-500">
                                        @if($user->store_name)
                                            <div>Store: {{ $user->store_name }}</div>
                                        @endif
                                        @if($user->phone)
                                            <div>Telp: {{ $user->phone }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-neutral-500">{{ $user->created_at->format('d M Y H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <form action="{{ route('admin.approve', $user->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="text-white bg-green-600 hover:bg-green-700 px-3 py-1.5 rounded-md text-xs font-semibold transition">
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.reject', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menolak dan menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1.5 rounded-md text-xs font-semibold transition">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-semibold text-neutral-900">Tidak ada permintaan</h3>
                    <p class="mt-1 text-sm text-neutral-500">Semua user telah disetujui.</p>
                </div>
            @endif
        </div>
    </main>
</body>
</html>
