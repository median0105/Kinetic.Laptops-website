<x-app-layout>
    <x-slot name="title">{{ $product ? 'Edit' : 'Tambah' }} Produk — Admin</x-slot>

    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-1 text-sm font-medium text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition mb-6">
            Kembali ke produk
        </a>

        <h1 class="text-2xl font-extrabold tracking-tight text-zinc-900 dark:text-white mb-6">{{ $product ? 'Edit Produk' : 'Tambah Produk' }}</h1>

        @include('admin.products.form', [
            'action' => $product ? route('admin.products.update', $product) : route('admin.products.store'),
            'method' => $product ? 'PUT' : 'POST',
        ])
    </div>
</x-app-layout>
