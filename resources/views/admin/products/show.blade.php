<x-app-layout>
    <x-slot name="title">Detail Produk — Admin</x-slot>

    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-1 text-sm font-medium text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition mb-6">
            Kembali ke produk
        </a>

        <div class="rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-6">
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-extrabold text-zinc-900 dark:text-white">{{ $product->name }}</h1>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">SKU: {{ $product->sku }} / {{ $product->category->name }}</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="rounded-lg bg-zinc-200 dark:bg-zinc-800 px-4 py-2 text-sm font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-zinc-300 dark:hover:bg-zinc-700 hover:text-zinc-900 dark:hover:text-white transition">Edit</a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Hapus produk ini?')">
                        @csrf @method('DELETE')
                        <button class="rounded-lg bg-rose-100 dark:bg-rose-950/40 px-4 py-2 text-sm font-semibold text-rose-700 dark:text-rose-400 hover:bg-rose-200 dark:hover:bg-rose-900/40 transition">Hapus</button>
                    </form>
                </div>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="rounded-xl bg-zinc-100 dark:bg-zinc-800/50 border border-zinc-300 dark:border-zinc-700 p-4">
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Harga</p>
                    <p class="text-xl font-extrabold text-zinc-900 dark:text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                <div class="rounded-xl bg-zinc-100 dark:bg-zinc-800/50 border border-zinc-300 dark:border-zinc-700 p-4">
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Stok</p>
                    <p class="text-xl font-extrabold {{ $product->stock > 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">{{ $product->stock }}</p>
                </div>
            </div>

            @if($product->description)
                <div class="mt-4">
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 uppercase tracking-wide font-semibold mb-1">Deskripsi</p>
                    <p class="text-sm text-zinc-700 dark:text-zinc-300">{{ $product->description }}</p>
                </div>
            @endif

            @if($product->specification)
                <div class="mt-6">
                    <h2 class="font-bold text-zinc-900 dark:text-white mb-3">Spesifikasi</h2>
                    <div class="grid gap-2 sm:grid-cols-2">
                        @foreach(['brand' => 'Brand', 'processor' => 'Processor', 'ram' => 'RAM', 'storage' => 'Storage', 'gpu' => 'GPU', 'display' => 'Display', 'operating_system' => 'OS', 'weight' => 'Berat'] as $key => $label)
                            @if($product->specification->$key)
                                <div class="flex justify-between rounded-lg bg-zinc-100 dark:bg-zinc-800/50 border border-zinc-300 dark:border-zinc-700 px-3 py-2 text-sm">
                                    <span class="text-zinc-500 dark:text-zinc-400">{{ $label }}</span>
                                    <span class="font-medium text-zinc-800 dark:text-zinc-200">{{ $product->specification->$key }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            @if($product->reviews->isNotEmpty())
                <div class="mt-6">
                    <h2 class="font-bold text-zinc-900 dark:text-white mb-3">Ulasan ({{ $product->reviews->count() }})</h2>
                    <div class="space-y-2">
                        @foreach($product->reviews as $review)
                            <div class="rounded-lg bg-zinc-100 dark:bg-zinc-800/50 border border-zinc-300 dark:border-zinc-700 p-3">
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="font-semibold text-zinc-800 dark:text-zinc-200">{{ $review->user->name }}</span>
                                    <span class="text-amber-400">{{ str_repeat('*', $review->rating) }}{{ str_repeat('-', 5 - $review->rating) }}</span>
                                    <span class="text-xs text-zinc-400 dark:text-zinc-500">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                                @if($review->comment)
                                    <p class="mt-1 text-sm text-zinc-700 dark:text-zinc-300">{{ $review->comment }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
