<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-neutral-900">Manajemen Produk</h1>
                <p class="text-sm text-neutral-500">Kelola daftar produk dan stok toko Anda</p>
            </div>
            <button onclick="openModal('add')" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow-sm flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Produk
            </button>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border">
            <div class="overflow-x-auto">
            <table class="min-w-max w-full text-sm text-left">
                <thead class="bg-neutral-50 text-neutral-500 font-medium border-b">
                    <tr>
                        <th class="px-6 py-4">Foto</th>
                        <th class="px-6 py-4">Nama Produk</th>
                        <th class="px-6 py-4">Harga</th>
                        <th class="px-6 py-4">Stok</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse($products as $product)
                        <tr class="hover:bg-neutral-50 transition">
                            <td class="px-6 py-4">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded-md">
                                @else
                                    <div class="w-12 h-12 bg-neutral-100 rounded-md flex items-center justify-center text-neutral-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7z"/></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-neutral-900">{{ $product->name }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $product->stock < 10 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                    {{ $product->stock }} unit
                                </span>
                            </td>
                            <td class="px-6 py-4 text-neutral-500 max-w-xs break-words">{{ $product->description ?? '-' }}</td>
                            <td class="px-6 py-4 text-right flex justify-end gap-2">
                                <button onclick='openModal("edit", @json($product))' class="text-blue-600 hover:text-blue-800 font-medium">Edit</button>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-neutral-500">Belum ada produk. Silakan tambah produk baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="product-modal" class="fixed inset-0 hidden items-center justify-center z-50" style="background-color: rgba(0,0,0,0.5);">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <div class="px-6 py-4 border-b flex justify-between items-center">
                <h3 id="modal-title" class="text-lg font-bold text-neutral-900">Tambah Produk</h3>
                <button onclick="closeModal()" class="text-neutral-400 hover:text-neutral-600">✕</button>
            </div>
            <form id="product-form" method="POST" action="{{ route('products.store') }}" class="p-6" enctype="multipart/form-data">
                @csrf
                <div id="method-field"></div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-neutral-700 mb-1">Nama Produk</label>
                    <input type="text" name="name" id="p-name" class="w-full rounded-lg border-neutral-300 focus:ring-red-500 focus:border-red-500" required>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Harga (Rp)</label>
                        <input type="number" name="price" id="p-price" class="w-full rounded-lg border-neutral-300 focus:ring-red-500 focus:border-red-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Stok</label>
                        <input type="number" name="stock" id="p-stock" class="w-full rounded-lg border-neutral-300 focus:ring-red-500 focus:border-red-500" required>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-neutral-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="p-desc" rows="3" class="w-full rounded-lg border-neutral-300 focus:ring-red-500 focus:border-red-500"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-neutral-700 mb-1">Gambar Produk</label>
                    <div class="flex items-center gap-3">
                        <div id="image-preview" class="w-20 h-20 bg-neutral-100 rounded-md overflow-hidden flex items-center justify-center">
                            <svg class="w-8 h-8 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7z"/></svg>
                        </div>
                        <div class="flex-1">
                            <input type="file" name="image" id="p-image" accept="image/png,image/jpeg,image/gif,image/webp" class="block w-full text-sm text-neutral-700" />
                            <p class="text-xs text-neutral-400 mt-1">Maksimal 10MB. Format: PNG, JPG, GIF, WEBP.</p>
                            <p id="image-error" class="text-xs text-red-600 mt-1 hidden"></p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded-lg hover:bg-neutral-50">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('product-modal');
        const form = document.getElementById('product-form');
        const title = document.getElementById('modal-title');
        const methodField = document.getElementById('method-field');
        const imageInput = document.getElementById('p-image');
        const imagePreview = document.getElementById('image-preview');

        function openModal(mode, data = null) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            if (mode === 'edit' && data) {
                title.textContent = 'Edit Produk';
                form.action = `/products/${data.id}`;
                methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
                
                document.getElementById('p-name').value = data.name;
                document.getElementById('p-price').value = data.price;
                document.getElementById('p-stock').value = data.stock;
                document.getElementById('p-desc').value = data.description || '';
                // show existing image if available
                if (data.image) {
                    imagePreview.innerHTML = `<img src="/storage/${data.image}" alt="${data.name}" class="w-full h-full object-cover">`;
                } else {
                    imagePreview.innerHTML = '<svg class="w-8 h-8 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7z"/></svg>';
                }
            } else {
                title.textContent = 'Tambah Produk';
                form.action = "{{ route('products.store') }}";
                methodField.innerHTML = '';
                form.reset();
                imagePreview.innerHTML = '<svg class="w-8 h-8 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7z"/></svg>';
            }
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Image preview & validation handler
        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                const allowed = ['image/png', 'image/jpeg', 'image/gif', 'image/webp'];
                const maxSize = 10 * 1024 * 1024; // 10MB
                const errorEl = document.getElementById('image-error');
                if (!file) {
                    errorEl.classList.add('hidden');
                    return;
                }

                // validate type
                if (!allowed.includes(file.type)) {
                    errorEl.textContent = 'Tipe file tidak didukung. Gunakan PNG, JPG, GIF, atau WEBP.';
                    errorEl.classList.remove('hidden');
                    imageInput.value = '';
                    imagePreview.innerHTML = '<svg class="w-8 h-8 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7z"/></svg>';
                    return;
                }

                // validate size
                if (file.size > maxSize) {
                    errorEl.textContent = 'Ukuran file terlalu besar. Maks 10MB.';
                    errorEl.classList.remove('hidden');
                    imageInput.value = '';
                    imagePreview.innerHTML = '<svg class="w-8 h-8 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7z"/></svg>';
                    return;
                }

                // clear previous errors
                errorEl.classList.add('hidden');

                const reader = new FileReader();
                reader.onload = function(ev) {
                    imagePreview.innerHTML = `<img src="${ev.target.result}" class="w-full h-full object-cover">`;
                };
                reader.readAsDataURL(file);
            });
        }
    </script>
</x-app-layout>
