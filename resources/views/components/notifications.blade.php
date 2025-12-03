<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="relative p-2 text-neutral-600 hover:text-neutral-900 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="absolute top-1 right-1 h-5 w-5 bg-red-600 rounded-full border-2 border-white flex items-center justify-center">
                <span class="text-white text-xs font-bold">{{ auth()->user()->unreadNotifications->count() }}</span>
            </span>
        @endif
    </button>

    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-neutral-100 z-50 py-2" style="display: none;">
        <div class="px-4 py-2 border-b border-neutral-100 flex justify-between items-center">
            <h3 class="font-semibold text-sm">Notifikasi</h3>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="text-xs text-neutral-500">{{ auth()->user()->unreadNotifications->count() }} baru</span>
            @endif
        </div>
        <div class="max-h-96 overflow-y-auto">
            @forelse(auth()->user()->notifications->take(10) as $notification)
                @php
                    $isNewUserRegistration = isset($notification->data['user_id']);
                    $linkUrl = null;
                    
                    if ($isNewUserRegistration && auth()->user()->role === 'admin') {
                        $linkUrl = route('admin.approvals');
                    }
                @endphp
                
                @if($linkUrl)
                    <a href="{{ $linkUrl }}" class="block px-4 py-3 hover:bg-neutral-50 border-b border-neutral-50 last:border-0 {{ $notification->read_at ? 'opacity-60' : 'bg-blue-50/30' }} transition">
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
                @else
                    <div class="px-4 py-3 hover:bg-neutral-50 border-b border-neutral-50 last:border-0 {{ $notification->read_at ? 'opacity-60' : '' }}">
                        <div class="text-sm font-medium text-neutral-900">{{ $notification->data['message'] ?? 'Notifikasi Baru' }}</div>
                        <div class="text-xs text-neutral-500 mt-1">{{ $notification->created_at->diffForHumans() }}</div>
                    </div>
                @endif
            @empty
                <div class="px-4 py-8 text-center text-sm text-neutral-500">
                    <svg class="w-12 h-12 mx-auto mb-2 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    Tidak ada notifikasi
                </div>
            @endforelse
        </div>
        
        @if(auth()->user()->notifications->count() > 0)
            <div class="px-4 py-2 border-t border-neutral-100 flex gap-2">
                @if(auth()->user()->unreadNotifications->count() > 0)
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
        
        @if(auth()->user()->role === 'admin' && auth()->user()->unreadNotifications->count() > 0)
            <div class="px-4 py-2 border-t border-neutral-100">
                <a href="{{ route('admin.approvals') }}" class="block text-center text-sm text-blue-600 hover:text-blue-700 font-medium">
                    Lihat Semua Permintaan →
                </a>
            </div>
        @endif
    </div>
</div>
