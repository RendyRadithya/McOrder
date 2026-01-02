@extends('layouts.app')

@section('title', 'Riwayat Pesanan - McOrder')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-2xl font-semibold text-neutral-900">Riwayat Pesanan</h1>
                <p class="text-sm text-neutral-500 mt-1">Semua pesanan yang diterima</p>
            </div>
                    <!-- Export moved to Laporan page -->
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="flex-1 min-w-0 bg-white rounded-xl p-5 h-44 flex flex-col justify-between transition-transform transform hover:-translate-y-1 hover:shadow-lg duration-200 ease-out">
                <div class="flex items-start justify-between mb-3">
                    <div class="text-sm text-neutral-600">Total Pesanan</div>
                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-neutral-900">{{ number_format($stats['total']) }}</div>
                <div class="text-xs text-neutral-500 mt-1">Semua pesanan</div>
            </div>

            <div class="flex-1 min-w-0 bg-white rounded-xl p-5 h-44 flex flex-col justify-between transition-transform transform hover:-translate-y-1 hover:shadow-lg duration-200 ease-out">
                <div class="flex items-start justify-between mb-3">
                    <div class="text-sm text-neutral-600">Pesanan Selesai</div>
                    <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-neutral-900">{{ number_format($stats['completed']) }}</div>
                <div class="text-xs text-neutral-500 mt-1">Berhasil diterima</div>
            </div>

            <div class="flex-1 min-w-0 bg-white rounded-xl p-5 h-44 flex flex-col justify-between transition-transform transform hover:-translate-y-1 hover:shadow-lg duration-200 ease-out">
                <div class="flex items-start justify-between mb-3">
                    <div class="text-sm text-neutral-600">Pesanan Ditolak</div>
                    <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-neutral-900">{{ number_format($stats['rejected']) }}</div>
                <div class="text-xs text-neutral-500 mt-1">Ditolak vendor</div>
            </div>

            <div class="flex-1 min-w-0 bg-white rounded-xl p-5 h-44 flex flex-col justify-between transition-transform transform hover:-translate-y-1 hover:shadow-lg duration-200 ease-out">
                <div class="flex items-start justify-between mb-3">
                    <div class="text-sm text-neutral-600">Total Pendapatan</div>
                    <div class="w-10 h-10 bg-yellow-50 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-2xl font-bold text-neutral-900">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
                <div class="text-xs text-neutral-500 mt-1">Dari pesanan selesai</div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <form method="GET" action="{{ route('vendor.history') }}" class="flex items-end gap-3 flex-wrap">
                <div class="flex-1 min-w-[140px]">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="No. pesanan, produk..." 
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                </div>
                <div class="w-40">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <div class="relative">
                        <select name="status" class="w-full pl-4 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 appearance-none">
                            <option value="">Semua</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Diterima</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-40">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                </div>
                <div class="w-full sm:w-40">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                </div>
                <div class="flex items-end gap-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">&nbsp;</label>
                    <button type="submit" class="flex-1 sm:flex-none px-5 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition font-medium">
                        Cari
                    </button>
                    <a href="{{ route('vendor.history') }}" class="px-4 py-2.5 bg-neutral-200 text-neutral-700 rounded-lg hover:bg-neutral-300 transition font-medium">Reset</a>
                </div>
            </form>
        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            @if($orders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-max w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">No. Pesanan</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Toko</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Produk</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Qty</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">Total</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Status</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($orders as $order)
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'confirmed' => 'bg-blue-100 text-blue-700',
                                        'rejected' => 'bg-red-100 text-red-700',
                                        'in_progress' => 'bg-purple-100 text-purple-700',
                                        'shipped' => 'bg-cyan-100 text-cyan-700',
                                        'completed' => 'bg-green-100 text-green-700',
                                    ];
                                    $statusLabels = [
                                        'pending' => 'Menunggu',
                                        'confirmed' => 'Dikonfirmasi',
                                        'rejected' => 'Ditolak',
                                        'in_progress' => 'Diproses',
                                        'shipped' => 'Dikirim',
                                        'completed' => 'Selesai',
                                    ];
                                @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3">
                                        <span class="font-medium text-gray-800">{{ $order->order_number }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $order->created_at->format('d/m/Y') }}
                                        <br>
                                        <span class="text-xs text-gray-400">{{ $order->created_at->format('H:i') }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $order->user->store_name ?? '-' }}</p>
                                            <p class="text-xs text-gray-500">{{ $order->user->name ?? '-' }}</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-800">{{ $order->product_name }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800">{{ number_format($order->quantity) }}</td>
                                    <td class="px-4 py-3 text-right font-semibold text-gray-800">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                                            {{ $statusLabels[$order->status] ?? $order->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="inline-flex items-center">
                                            <button onclick="showOrderDetail({{ $order->id }})" 
                                                    class="text-blue-600 hover:text-blue-800 transition" title="Lihat Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </button>
                                            <a href="{{ route('orders.invoice.download', $order->id) }}" target="_blank" class="ml-3 text-neutral-500 hover:text-green-600 hover:bg-green-50 inline-flex items-center justify-center w-9 h-9 rounded-md transition" title="Download Invoice">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v12m0 0l4-4m-4 4l-4-4" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <div class="mx-auto mb-4 w-16 h-16 rounded-full bg-neutral-100 flex items-center justify-center">
                        <svg class="w-8 h-8 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-gray-500 text-lg">Belum ada riwayat pesanan</p>
                    <p class="text-gray-400">Pesanan yang diterima akan muncul di sini</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Order Detail Modal -->
<div id="orderDetailModal" class="fixed inset-0 bg-white/30 backdrop-blur-sm z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-bold text-gray-800">Detail Pesanan</h3>
            <div class="ml-3">
                <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7"/>
                </svg>
            </div>
            <button onclick="closeOrderDetail()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div id="orderDetailContent" class="p-6">
            <div class="flex items-center justify-center py-8">
                <svg class="animate-spin h-8 w-8 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<script>
    // Order data for modal
    const ordersData = @json($orders->items());
    
    function showOrderDetail(orderId) {
        const order = ordersData.find(o => o.id === orderId);
        if (!order) return;
        
        const statusLabels = {
            'pending': 'Menunggu',
            'confirmed': 'Dikonfirmasi',
            'rejected': 'Ditolak',
            'in_progress': 'Diproses',
            'shipped': 'Dikirim',
            'completed': 'Selesai',
        };
        
        const statusColors = {
            'pending': 'bg-yellow-100 text-yellow-700',
            'confirmed': 'bg-blue-100 text-blue-700',
            'rejected': 'bg-red-100 text-red-700',
            'in_progress': 'bg-purple-100 text-purple-700',
            'shipped': 'bg-cyan-100 text-cyan-700',
            'completed': 'bg-green-100 text-green-700',
        };
        
        const content = `
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Nomor Pesanan</p>
                        <p class="text-lg font-bold text-gray-800">${order.order_number}</p>
                    </div>
                    <span class="px-4 py-2 rounded-full text-sm font-semibold ${statusColors[order.status] || 'bg-gray-100 text-gray-700'}">
                        ${statusLabels[order.status] || order.status}
                    </span>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-500">Toko</p>
                        <p class="font-semibold text-gray-800">${order.user?.store_name || '-'}</p>
                        <p class="text-sm text-gray-600">${order.user?.name || '-'}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-500">Tanggal Pesanan</p>
                        <p class="font-semibold text-gray-800">${new Date(order.created_at).toLocaleDateString('id-ID')}</p>
                        <p class="text-sm text-gray-600">${new Date(order.created_at).toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'})}</p>
                    </div>
                </div>
                
                <div class="bg-yellow-50 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-800 mb-3">🍔 Detail Produk</h4>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-800">${order.product_name}</p>
                            <p class="text-sm text-gray-500">Jumlah: ${order.quantity}</p>
                        </div>
                        <p class="font-bold text-lg text-green-600">Rp ${Number(order.total_price).toLocaleString('id-ID')}</p>
                    </div>
                </div>
                
                ${order.notes ? `
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-800 mb-2">📝 Catatan</h4>
                        <p class="text-gray-600">${order.notes}</p>
                    </div>
                ` : ''}
                
                ${order.tracking_number ? `
                    <div class="bg-blue-50 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-800 mb-2">🚚 Nomor Resi</h4>
                        <p class="font-mono text-blue-600">${order.tracking_number}</p>
                    </div>
                ` : ''}
            </div>
        `;
        
        document.getElementById('orderDetailContent').innerHTML = content;
        document.getElementById('orderDetailModal').classList.remove('hidden');
        document.getElementById('orderDetailModal').classList.add('flex');
    }
    
    function closeOrderDetail() {
        document.getElementById('orderDetailModal').classList.add('hidden');
        document.getElementById('orderDetailModal').classList.remove('flex');
    }
    
    // Close modal on backdrop click
    document.getElementById('orderDetailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeOrderDetail();
        }
    });
    
    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeOrderDetail();
        }
    });
</script>
@endsection
