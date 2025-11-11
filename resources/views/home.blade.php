<x-layouts.app :title="'Beranda - McOrder'">
	<!-- Hero Section -->
	<section class="relative overflow-hidden bg-red-600">
		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
			<div class="grid gap-12 lg:grid-cols-2 items-center">
				<div class="text-white">
					<div class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 mb-6">
						<span class="text-lg">🛒</span>
						<span class="text-sm font-medium text-neutral-700">Sistem Pemesanan Digital</span>
					</div>
					<h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold leading-tight mb-6 text-white">
						McOrder.
					</h1>
					<p class="text-xl sm:text-2xl mb-3 text-white font-medium">
						Solusi Digital Pemesanan Non-Bahan Baku untuk McDonald's Citra Garden
					</p>
					<p class="text-base sm:text-lg mb-8 text-white/90">
						Efisiensi pemesanan Gas, CO₂, Translite, dan Akrilik dalam satu platform terintegrasi.
					</p>
					<div class="flex flex-wrap gap-4 mb-10">
						<a href="#mulai" class="inline-flex items-center gap-2 rounded-md bg-yellow-400 px-6 py-3 text-base font-semibold text-neutral-900 hover:bg-yellow-500 transition">
							Mulai Sekarang
							<span>→</span>
						</a>
						<a href="#tentang" class="inline-flex items-center gap-2 rounded-md bg-red-600 border-2 border-white px-6 py-3 text-base font-semibold text-white hover:bg-red-700 transition">
							Pelajari Lebih Lanjut
							<span>→</span>
						</a>
					</div>
				</div>
				<div class="relative lg:mt-0 mt-8">
					@php
						$imagePaths = [
							'images/Mcdonald Citra Garden.jpg',
							'images/Mcdonald Citra Garden.jpeg',
							'images/mcd-store.jpg',
							'images/mcd-store.jpeg',
						];
						$imageFound = false;
						foreach ($imagePaths as $path) {
							if (file_exists(public_path($path))) {
								$imageFound = $path;
								break;
							}
						}
					@endphp
					@if($imageFound)
						<div class="rounded-2xl overflow-hidden border-4 border-white shadow-2xl mb-6">
							<img src="{{ asset($imageFound) }}" alt="McDonald's Citra Garden" class="w-full h-[450px] lg:h-[550px] object-cover object-top">
						</div>
						<div class="flex flex-wrap gap-4 justify-center lg:justify-start">
							<div class="bg-white rounded-lg px-5 py-4 min-w-[140px] shadow-lg">
								<div class="text-3xl font-bold text-red-600 mb-1">4</div>
								<div class="text-sm text-neutral-600 font-medium">Vendor</div>
							</div>
							<div class="bg-white rounded-lg px-5 py-4 min-w-[140px] shadow-lg">
								<div class="text-3xl font-bold text-red-600 mb-1">24/7</div>
								<div class="text-sm text-neutral-600 font-medium">Akses</div>
							</div>
							<div class="bg-white rounded-lg px-5 py-4 min-w-[140px] shadow-lg">
								<div class="text-3xl font-bold text-red-600 mb-1">100%</div>
								<div class="text-sm text-neutral-600 font-medium">Digital</div>
							</div>
						</div>
					@else
						<div class="rounded-2xl border-4 border-white bg-red-700/50 aspect-[4/3] grid place-items-center mb-6">
							<div class="text-white text-center">
								<div class="text-4xl mb-2">🍔</div>
								<p class="text-sm">Gambar restoran McDonald's</p>
							</div>
						</div>
						<div class="flex flex-wrap gap-4 justify-center lg:justify-start">
							<div class="bg-white rounded-lg px-5 py-4 min-w-[140px] shadow-lg">
								<div class="text-3xl font-bold text-red-600 mb-1">4</div>
								<div class="text-sm text-neutral-600 font-medium">Vendor</div>
							</div>
							<div class="bg-white rounded-lg px-5 py-4 min-w-[140px] shadow-lg">
								<div class="text-3xl font-bold text-red-600 mb-1">24/7</div>
								<div class="text-sm text-neutral-600 font-medium">Akses</div>
							</div>
							<div class="bg-white rounded-lg px-5 py-4 min-w-[140px] shadow-lg">
								<div class="text-3xl font-bold text-red-600 mb-1">100%</div>
								<div class="text-sm text-neutral-600 font-medium">Digital</div>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</section>

	<!-- Tentang Kami Section -->
	<section id="tentang" class="bg-[#F5F5F5] py-20">
		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="grid gap-8 lg:grid-cols-3">
				<div class="lg:col-span-2">
					<div class="inline-flex items-center gap-2 rounded-lg bg-red-100 px-4 py-2 mb-6">
						<span class="text-sm font-semibold text-red-700">Tentang Kami</span>
					</div>
					<h2 class="text-4xl sm:text-5xl font-bold text-neutral-900 mb-3 leading-tight">
						Transformasi Digital<br>Pemesanan Bahan Baku
					</h2>
					<p class="text-xl font-semibold text-neutral-700 mb-6">McDonald's Citra Garden</p>
					<p class="text-base text-neutral-600 mb-4 leading-relaxed">
						McOrder adalah solusi digital inovatif yang dirancang khusus untuk mengelola pemesanan non-bahan baku. Sebelumnya, proses pemesanan dilakukan secara manual melalui WhatsApp dan email, yang memakan waktu dan rentan terhadap kesalahan.
					</p>
					<p class="text-base text-neutral-600 mb-8 leading-relaxed">
						McOrder menghadirkan platform terintegrasi yang memudahkan koordinasi antara store staff, vendor, dan admin pusat.
					</p>
					<div class="space-y-5">
						<div class="flex gap-4 items-start">
							<div class="flex-shrink-0 w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white text-sm font-bold">✓</div>
							<div>
								<div class="font-bold text-lg text-neutral-900 mb-1">Efisiensi Operasional</div>
								<p class="text-sm text-neutral-600 leading-relaxed">Mengurangi waktu pemesanan dari 30 menit menjadi 5 menit</p>
							</div>
						</div>
						<div class="flex gap-4 items-start">
							<div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm">🛡</div>
							<div>
								<div class="font-bold text-lg text-neutral-900 mb-1">Akurasi Data</div>
								<p class="text-sm text-neutral-600 leading-relaxed">Minimalisir kesalahan pencatatan dan duplikasi pesanan</p>
							</div>
						</div>
						<div class="flex gap-4 items-start">
							<div class="flex-shrink-0 w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center text-white text-sm">📈</div>
							<div>
								<div class="font-bold text-lg text-neutral-900 mb-1">Transparansi Real-time</div>
								<p class="text-sm text-neutral-600 leading-relaxed">Tracking status pesanan dari pengajuan hingga selesai</p>
							</div>
						</div>
					</div>
				</div>
				<div class="space-y-5">
					<div class="bg-white rounded-lg border border-red-200 shadow-sm p-5">
						<div class="flex items-start gap-3">
							<span class="text-red-600 text-2xl flex-shrink-0">📍</span>
							<div>
								<div class="font-bold text-lg text-neutral-900 mb-2">Lokasi</div>
								<div class="text-sm font-semibold text-neutral-700 mb-2">McDonald's Citra Garden</div>
								<div class="text-xs text-neutral-600 leading-relaxed">Jl. Taman Permata Buana, Pegadungan, Kec. Kalideres, Jakarta Barat</div>
							</div>
						</div>
					</div>
					<div class="bg-white rounded-lg border border-neutral-200 shadow-sm p-5">
						<div class="font-bold text-lg text-neutral-900 mb-2">Kategori Produk Non-HAVI</div>
						<div class="text-xs text-neutral-600 mb-4">Bahan baku yang dikelola melalui McOrder</div>
						<div class="grid grid-cols-2 gap-3">
							<div class="bg-white border border-neutral-200 rounded-lg p-3 text-center hover:shadow-md transition">
								<div class="text-red-600 text-2xl mb-2">🔥</div>
								<div class="text-xs font-bold text-neutral-900 mb-1">Gas LPG</div>
								<div class="text-xs text-neutral-600">Sadikun</div>
							</div>
							<div class="bg-white border border-neutral-200 rounded-lg p-3 text-center hover:shadow-md transition">
								<div class="text-blue-600 text-xl font-bold mb-2">CO₂</div>
								<div class="text-xs font-bold text-neutral-900 mb-1">CO₂</div>
								<div class="text-xs text-neutral-600">Kencana Emas</div>
							</div>
							<div class="bg-white border border-neutral-200 rounded-lg p-3 text-center hover:shadow-md transition">
								<div class="text-yellow-600 text-2xl mb-2">📄</div>
								<div class="text-xs font-bold text-neutral-900 mb-1">Translite</div>
								<div class="text-xs text-neutral-600">Menu Board</div>
							</div>
							<div class="bg-white border border-neutral-200 rounded-lg p-3 text-center hover:shadow-md transition">
								<div class="text-green-600 text-2xl mb-2">⬜</div>
								<div class="text-xs font-bold text-neutral-900 mb-1">Akrilik</div>
								<div class="text-xs text-neutral-600">Display</div>
							</div>
						</div>
					</div>
					<div class="bg-red-600 rounded-lg p-8 text-white text-center shadow-lg">
						<div class="text-6xl font-bold mb-3">3</div>
						<div class="text-sm mb-6 font-medium">Peran Pengguna Terintegrasi</div>
						<div class="flex gap-2 justify-center">
							<span class="bg-red-700 rounded-md px-4 py-2 text-xs font-semibold">Store</span>
							<span class="bg-red-700 rounded-md px-4 py-2 text-xs font-semibold">Vendor</span>
							<span class="bg-red-700 rounded-md px-4 py-2 text-xs font-semibold">Admin</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Fitur Section -->
	<section id="fitur" class="bg-neutral-50 py-20">
		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="text-center mb-16">
				<div class="inline-flex items-center gap-2 rounded-full bg-yellow-100 px-4 py-2 mb-6">
					<span class="text-sm font-semibold text-yellow-700">Fitur Unggulan</span>
				</div>
				<h2 class="text-4xl sm:text-5xl font-bold text-neutral-900 mb-4">
					Fitur-Fitur McOrder
				</h2>
				<p class="text-lg text-neutral-600 max-w-3xl mx-auto leading-relaxed">
					Platform lengkap untuk mengelola seluruh proses pemesanan bahan baku dengan mudah dan efisien
				</p>
			</div>
			<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 mb-12">
				@php
					$features = [
						['icon' => '🛒', 'bgClass' => 'bg-red-100', 'title' => 'Pemesanan Cepat', 'desc' => 'Store Staff dapat membuat pesanan dalam hitungan menit', 'points' => ['Form pemesanan sederhana dan intuitif', 'Pilihan vendor otomatis berdasarkan kategori', 'Estimasi harga real-time']],
						['icon' => '🔔', 'bgClass' => 'bg-blue-100', 'title' => 'Notifikasi Real-time', 'desc' => 'Update status pesanan langsung ke semua pihak terkait', 'points' => ['Notifikasi pesanan baru untuk vendor', 'Update status pengiriman ke store', 'Alert untuk admin monitoring']],
						['icon' => '⏱', 'bgClass' => 'bg-green-100', 'title' => 'Tracking Status', 'desc' => 'Pantau pesanan dari pembuatan hingga selesai', 'points' => ['Timeline status yang jelas', 'History pesanan lengkap', 'Filter dan pencarian advanced']],
						['icon' => '📦', 'bgClass' => 'bg-yellow-100', 'title' => 'Manajemen Vendor', 'desc' => 'Dashboard khusus untuk vendor memproses pesanan', 'points' => ['Terima atau tolak pesanan masuk', 'Update status pengiriman', 'Statistik performa vendor']],
						['icon' => '⚙', 'bgClass' => 'bg-red-100', 'title' => 'Admin Dashboard', 'desc' => 'Monitoring dan kontrol penuh untuk admin pusat', 'points' => ['Overview semua transaksi', 'Analytics dan reporting', 'Manajemen user dan vendor']],
						['icon' => '📊', 'bgClass' => 'bg-orange-100', 'title' => 'Laporan & Analitik', 'desc' => 'Data insights untuk decision making yang lebih baik', 'points' => ['Grafik tren pemesanan', 'Laporan pengeluaran bulanan', 'Export data ke Excel/PDF']],
					];
				@endphp
				@foreach($features as $feature)
					<div class="bg-white rounded-xl border border-neutral-200 shadow-sm p-6 hover:shadow-md transition">
						<div class="flex items-start gap-4 mb-5">
							<div class="w-14 h-14 rounded-lg {{ $feature['bgClass'] }} flex items-center justify-center text-3xl flex-shrink-0">
								{{ $feature['icon'] }}
							</div>
							<div class="flex-1">
								<h3 class="font-bold text-lg text-neutral-900 mb-2">{{ $feature['title'] }}</h3>
								<p class="text-sm text-neutral-600 leading-relaxed">{{ $feature['desc'] }}</p>
							</div>
						</div>
						<ul class="space-y-2.5">
							@foreach($feature['points'] as $point)
								<li class="flex items-start gap-2.5 text-sm text-neutral-600">
									<span class="text-green-500 text-base flex-shrink-0">✓</span>
									<span class="leading-relaxed">{{ $point }}</span>
								</li>
							@endforeach
						</ul>
					</div>
				@endforeach
			</div>
			<div class="grid gap-5 md:grid-cols-3">
				@php
					$highlights = [
						['icon' => '🛡', 'bgClass' => 'bg-blue-100', 'title' => 'Keamanan Data', 'desc' => 'Enkripsi dan proteksi data tingkat tinggi'],
						['icon' => '👥', 'bgClass' => 'bg-purple-100', 'title' => 'Multi-Role Access', 'desc' => '3 peran dengan akses berbeda'],
						['icon' => '📱', 'bgClass' => 'bg-green-100', 'title' => 'Responsive Design', 'desc' => 'Mobile, tablet, dan desktop ready'],
					];
				@endphp
				@foreach($highlights as $highlight)
					<div class="bg-white rounded-xl border border-neutral-200 shadow-sm p-5 text-center hover:shadow-md transition">
						<div class="w-14 h-14 rounded-lg {{ $highlight['bgClass'] }} mx-auto mb-4 flex items-center justify-center text-2xl">
							{{ $highlight['icon'] }}
						</div>
						<h4 class="font-bold text-base text-neutral-900 mb-2">{{ $highlight['title'] }}</h4>
						<p class="text-xs text-neutral-600 leading-relaxed">{{ $highlight['desc'] }}</p>
					</div>
				@endforeach
			</div>
		</div>
	</section>
</x-layouts.app>
