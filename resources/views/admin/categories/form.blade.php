<x-app-layout>
    <x-slot name="title">{{ $category ? 'Edit' : 'Tambah' }} Kategori — Admin</x-slot>

    <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-1 text-sm font-medium text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition mb-6">
            Kembali ke kategori
        </a>

        <h1 class="text-2xl font-extrabold tracking-tight text-zinc-900 dark:text-white mb-6">{{ $category ? 'Edit Kategori' : 'Tambah Kategori' }}</h1>

        @if($errors->any())
            <div class="mb-4 rounded-xl bg-rose-100 dark:bg-rose-950/40 border border-rose-300 dark:border-rose-800/60 px-4 py-3 text-sm text-rose-800 dark:text-rose-300">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ $category ? route('admin.categories.update', $category) : route('admin.categories.store') }}" class="space-y-4 rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-6">
            @csrf
            @if($category)
                @method('PUT')
            @endif

            <div>
                <label class="mb-1 block text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Nama Kategori *</label>
                <input name="name" value="{{ old('name', $category?->name) }}" required
                       class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-500 focus:ring-zinc-500"
                       placeholder="Contoh: Laptop Gaming">
            </div>

            <div>
                <label class="mb-1 block text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Deskripsi</label>
                <textarea name="description" rows="3"
                          class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-500 focus:ring-zinc-500">{{ old('description', $category?->description) }}</textarea>
            </div>

            @if($category)
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                           class="rounded border-zinc-600 bg-zinc-100 dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-zinc-500">
                    <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Aktif</span>
                </label>
            @endif

            <button type="submit" class="w-full rounded-xl bg-zinc-900 dark:bg-white py-3 text-sm font-bold text-white dark:text-zinc-950 hover:bg-zinc-700 dark:hover:bg-zinc-200 transition">
                {{ $category ? 'Simpan Perubahan' : 'Buat Kategori' }}
            </button>
        </form>
    </div>
</x-app-layout>