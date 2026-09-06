@if($errors->any())
    <div class="mb-4 rounded-xl bg-rose-100 dark:bg-rose-950/40 border border-rose-300 dark:border-rose-800/60 px-4 py-3 text-sm text-rose-800 dark:text-rose-300">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    {{-- Basic Info --}}
    <div class="rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-6">
        <h2 class="text-lg font-bold text-zinc-900 dark:text-white mb-4">Informasi Dasar</h2>
        <div class="grid gap-4 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label class="mb-1 block text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Gambar Produk</label>
                <div class="flex items-center gap-4">
                    <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-zinc-300 dark:border-zinc-700 bg-zinc-200 dark:bg-zinc-800">
                        @if($product?->thumbnailUrl())
                            <img src="{{ $product->thumbnailUrl() }}" alt="Gambar {{ $product->name }}" class="h-full w-full object-cover">
                        @else
                            <svg class="h-8 w-8 text-zinc-400 dark:text-zinc-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h1.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 6.75v7.875c0 1.242 1.008 2.25 2.25 2.25z" />
                            </svg>
                        @endif
                    </div>
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp"
                           class="block w-full text-sm text-zinc-400 file:mr-3 file:rounded-lg file:border-0 file:bg-zinc-800 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-zinc-200 hover:file:bg-zinc-700">
                </div>
                <p class="mt-1 text-xs text-zinc-400 dark:text-zinc-500">Format: JPG, PNG, WEBP. Maks. 2MB. {{ $product ? 'Kosongkan jika tidak ingin mengubah gambar.' : '' }}</p>
            </div>
            <div class="sm:col-span-2">
                <label class="mb-1 block text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Nama Produk *</label>
                <input name="name" value="{{ old('name', $product?->name) }}" required
                       class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-500 focus:ring-zinc-500">
            </div>
            <div>
                <label class="mb-1 block text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">SKU *</label>
                <input name="sku" value="{{ old('sku', $product?->sku) }}" required
                       class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-500 focus:ring-zinc-500">
            </div>
            <div>
                <label class="mb-1 block text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Kategori *</label>
                <select name="category_id" required class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-sm text-zinc-900 dark:text-white focus:border-zinc-500 focus:ring-zinc-500">
                    <option value="">Pilih kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product?->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-1 block text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Harga (Rp) *</label>
                <input name="price" type="number" min="0" value="{{ old('price', $product?->price) }}" required
                       class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-500 focus:ring-zinc-500">
            </div>
            <div>
                <label class="mb-1 block text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Stok *</label>
                <input name="stock" type="number" min="0" value="{{ old('stock', $product?->stock ?? 0) }}" required
                       class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-500 focus:ring-zinc-500">
            </div>
            <div class="sm:col-span-2">
                <label class="mb-1 block text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Deskripsi</label>
                <textarea name="description" rows="3"
                          class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-500 focus:ring-zinc-500">{{ old('description', $product?->description) }}</textarea>
            </div>
            <div class="flex items-center gap-6 sm:col-span-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product?->is_active ?? true) ? 'checked' : '' }}
                           class="rounded border-zinc-600 bg-zinc-100 dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-zinc-500">
                    <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Aktif</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product?->is_featured) ? 'checked' : '' }}
                           class="rounded border-zinc-600 bg-zinc-100 dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-zinc-500">
                    <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Unggulan</span>
                </label>
            </div>
        </div>
    </div>

    {{-- Specifications --}}
    <div class="rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-6">
        <h2 class="text-lg font-bold text-zinc-900 dark:text-white mb-4">Spesifikasi</h2>
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach(['brand' => 'Brand / Merek', 'processor' => 'Processor', 'ram' => 'RAM', 'storage' => 'Penyimpanan', 'gpu' => 'GPU / Kartu Grafis', 'display' => 'Layar', 'operating_system' => 'Sistem Operasi', 'weight' => 'Berat'] as $key => $label)
                <div>
                    <label class="mb-1 block text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">{{ $label }}</label>
                    <input name="{{ $key }}" value="{{ old($key, $product?->specification?->$key) }}"
                           placeholder="{{ $label }}"
                           class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-500 focus:ring-zinc-500">
                </div>
            @endforeach
        </div>
    </div>

    <button type="submit" class="w-full rounded-xl bg-zinc-900 dark:bg-white py-3 text-sm font-bold text-white dark:text-zinc-950 hover:bg-zinc-700 dark:hover:bg-zinc-200 transition">
        {{ $product ? 'Simpan Perubahan' : 'Buat Produk' }}
    </button>
</form>
