<x-app-layout>
    <x-slot name="title">Edit Produk — Admin</x-slot>

    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-1 text-sm font-medium text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition mb-6">
            Kembali ke produk
        </a>

        <h1 class="text-2xl font-extrabold tracking-tight text-zinc-900 dark:text-white mb-6">Edit: {{ $product->name }}</h1>

        @include('admin.products.form', [
            'action' => route('admin.products.update', $product),
            'method' => 'PUT',
        ])
    </div>
</x-app-layout>
