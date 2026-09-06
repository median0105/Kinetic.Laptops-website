<x-app-layout>
    <x-slot name="title">Kelola Produk — Admin</x-slot>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-extrabold tracking-tight text-zinc-900 dark:text-white">Kelola Produk</h1>
            <a href="{{ route('admin.products.create') }}" class="rounded-xl bg-zinc-900 dark:bg-white px-5 py-2.5 text-sm font-bold text-white dark:text-zinc-950 shadow-sm hover:bg-zinc-700 dark:hover:bg-zinc-200 transition">
                + Tambah Produk
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-xl bg-emerald-100 dark:bg-emerald-950/80 border border-emerald-300 dark:border-emerald-800/80 px-4 py-3 text-sm text-emerald-800 dark:text-emerald-300 font-medium">{{ session('success') }}</div>
        @endif

        <div class="rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="border-b border-zinc-200 dark:border-zinc-800">
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Produk</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Kategori</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">SKU</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Harga</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Stok</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Status</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200/80 dark:divide-zinc-800/80">
                        @forelse($products as $product)
                            <tr class="hover:bg-zinc-100/50 dark:hover:bg-zinc-800/30 transition">
                                <td class="px-6 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-lg bg-zinc-200 dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700">
                                            @if($product->thumbnailUrl())
                                                <img src="{{ $product->thumbnailUrl() }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                            @else
                                                <svg class="h-5 w-5 text-zinc-400 dark:text-zinc-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h1.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 6.75v7.875c0 1.242 1.008 2.25 2.25 2.25z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-semibold text-zinc-900 dark:text-white">{{ $product->name }}</p>
                                            <p class="text-xs text-zinc-400 dark:text-zinc-500">{{ $product->slug }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-sm text-zinc-700 dark:text-zinc-300">{{ $product->category->name }}</td>
                                <td class="px-6 py-3 text-sm text-zinc-500 dark:text-zinc-400">{{ $product->sku }}</td>
                                <td class="px-6 py-3 text-sm font-bold text-zinc-900 dark:text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-3 text-sm {{ $product->stock > 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }} font-medium">{{ $product->stock }}</td>
                                <td class="px-6 py-3">
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-semibold {{ $product->is_active ? 'bg-emerald-100 text-emerald-800 border border-emerald-300 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-800/60' : 'bg-zinc-200 dark:bg-zinc-800 text-zinc-500 dark:text-zinc-400 border border-zinc-300 dark:border-zinc-700' }}">
                                        {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-3">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="rounded-lg bg-zinc-200 dark:bg-zinc-800 px-3 py-1.5 text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-zinc-300 dark:hover:bg-zinc-700 hover:text-zinc-900 dark:hover:text-white transition">Edit</a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Hapus produk ini?')">
                                            @csrf @method('DELETE')
                                            <button class="rounded-lg bg-rose-100 dark:bg-rose-950/40 px-3 py-1.5 text-xs font-semibold text-rose-700 dark:text-rose-400 hover:bg-rose-200 dark:hover:bg-rose-900/40 transition">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-6 py-8 text-center text-sm text-zinc-400 dark:text-zinc-500">Belum ada produk.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4">{{ $products->links() }}</div>
    </div>
</x-app-layout>
