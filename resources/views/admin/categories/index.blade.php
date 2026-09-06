<x-app-layout>
    <x-slot name="title">Kelola Kategori — Admin</x-slot>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-extrabold tracking-tight text-zinc-900 dark:text-white">Kelola Kategori</h1>
            <a href="{{ route('admin.categories.create') }}" class="rounded-xl bg-zinc-900 dark:bg-white px-5 py-2.5 text-sm font-bold text-white dark:text-zinc-950 shadow-sm hover:bg-zinc-700 dark:hover:bg-zinc-200 transition">
                + Tambah Kategori
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
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Nama</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Slug</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Produk</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Status</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200/80 dark:divide-zinc-800/80">
                        @forelse($categories as $category)
                            <tr class="hover:bg-zinc-100/50 dark:hover:bg-zinc-800/30 transition">
                                <td class="px-6 py-3 font-semibold text-zinc-900 dark:text-white">{{ $category->name }}</td>
                                <td class="px-6 py-3 text-sm text-zinc-500 dark:text-zinc-400">{{ $category->slug }}</td>
                                <td class="px-6 py-3 text-sm text-zinc-700 dark:text-zinc-300">{{ $category->products_count }} produk</td>
                                <td class="px-6 py-3">
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-semibold {{ $category->is_active ? 'bg-emerald-100 text-emerald-800 border border-emerald-300 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-800/60' : 'bg-zinc-200 dark:bg-zinc-800 text-zinc-500 dark:text-zinc-400 border border-zinc-300 dark:border-zinc-700' }}">
                                        {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-3">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="rounded-lg bg-zinc-200 dark:bg-zinc-800 px-3 py-1.5 text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-zinc-300 dark:hover:bg-zinc-700 hover:text-zinc-900 dark:hover:text-white transition">Edit</a>
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Hapus kategori ini? Produk di dalamnya juga akan dihapus.')">
                                            @csrf @method('DELETE')
                                            <button class="rounded-lg bg-rose-100 dark:bg-rose-950/40 px-3 py-1.5 text-xs font-semibold text-rose-700 dark:text-rose-400 hover:bg-rose-200 dark:hover:bg-rose-900/40 transition">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-8 text-center text-sm text-zinc-400 dark:text-zinc-500">Belum ada kategori.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4">{{ $categories->links() }}</div>
    </div>
</x-app-layout>
