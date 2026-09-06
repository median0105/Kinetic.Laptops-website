<x-app-layout>
    <x-slot name="title">Detail Kategori — Admin</x-slot>

    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-1 text-sm font-medium text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition mb-6">
            Kembali ke kategori
        </a>

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-zinc-900 dark:text-white">{{ $category->name }}</h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">Slug: {{ $category->slug }} / {{ $category->products->count() }} produk</p>
            </div>
            <a href="{{ route('admin.categories.edit', $category) }}" class="rounded-lg bg-zinc-200 dark:bg-zinc-800 px-4 py-2 text-sm font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-zinc-300 dark:hover:bg-zinc-700 hover:text-zinc-900 dark:hover:text-white transition">Edit</a>
        </div>

        @if($category->description)
            <div class="mb-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-5">
                <p class="text-sm text-zinc-700 dark:text-zinc-300">{{ $category->description }}</p>
            </div>
        @endif

        <div class="rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 overflow-hidden">
            <div class="border-b border-zinc-200 dark:border-zinc-800 px-6 py-4">
                <h2 class="font-bold text-zinc-900 dark:text-white">Produk dalam Kategori Ini</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="border-b border-zinc-200 dark:border-zinc-800">
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase">Nama</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase">Harga</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase">Stok</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200/80 dark:divide-zinc-800/80">
                        @forelse($category->products as $product)
                            <tr class="hover:bg-zinc-100/50 dark:hover:bg-zinc-800/30">
                                <td class="px-6 py-3 font-semibold text-zinc-900 dark:text-white">{{ $product->name }}</td>
                                <td class="px-6 py-3 text-sm font-bold text-zinc-900 dark:text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-3 text-sm text-zinc-700 dark:text-zinc-300">{{ $product->stock }}</td>
                                <td class="px-6 py-3">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-sm font-semibold text-zinc-900 dark:text-white hover:text-zinc-800 dark:hover:text-zinc-200">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-8 text-center text-sm text-zinc-400 dark:text-zinc-500">Belum ada produk.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
