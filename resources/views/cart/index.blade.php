<x-app-layout>
    <x-slot name="title">Keranjang Belanja — KINETIC</x-slot>

    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-10">
        <div class="pb-6 border-b border-zinc-200 dark:border-zinc-800">
            <span class="text-xs font-sans uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Cart Inventory</span>
            <h1 class="mt-1 text-2xl sm:text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white">Keranjang Belanja</h1>
        </div>

        @if(session('success'))
            <div
                class="mt-6 rounded-md bg-emerald-100 dark:bg-emerald-950/80 border border-emerald-300 dark:border-emerald-800/80 px-4 py-3 text-xs font-sans text-emerald-800 dark:text-emerald-300">
                {{ session('success') }}
            </div>
        @endif

        @if($cart->items->isEmpty())
            <div class="mt-12 text-center py-20 rounded-xl border border-dashed border-zinc-200 dark:border-zinc-800">
                <p class="text-xs font-sans uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Keranjang Kosong</p>
                <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">Belum ada unit laptop atau aksesoris yang dimasukkan.</p>
                <a href="{{ route('products.index') }}"
                    class="mt-6 inline-block rounded-md bg-zinc-900 dark:bg-white px-6 py-2.5 text-xs font-sans font-bold uppercase tracking-wider text-white dark:text-zinc-950 hover:bg-zinc-700 dark:hover:bg-zinc-200 transition">
                    Mulai Belanja
                </a>
            </div>
        @else
            <div class="mt-8 space-y-3">
                @foreach($cart->items as $item)
                    <div
                        class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 rounded-xl border border-zinc-200/80 dark:border-zinc-800/80 bg-zinc-100/40 dark:bg-zinc-900/40 p-4">
                        <div class="flex items-center gap-4 min-w-0">
                            {{-- Thumbnail --}}
                            <div
                                class="flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden rounded-lg bg-white dark:bg-zinc-950 p-2 border border-zinc-200 dark:border-zinc-800">
                                @if($item->product->thumbnailUrl())
                                    <img src="{{ $item->product->thumbnailUrl() }}" alt="{{ $item->product->name }}"
                                        class="max-h-full max-w-full object-contain">
                                @else
                                    <span class="font-sans text-xs text-zinc-400 dark:text-zinc-600">N/A</span>
                                @endif
                            </div>

                            <div class="min-w-0">
                                <h3 class="font-bold text-zinc-900 dark:text-white text-sm truncate tracking-tight">{{ $item->product->name }}</h3>
                                <p class="text-xs font-sans text-zinc-500 dark:text-zinc-400 mt-0.5">Rp
                                    {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-between sm:justify-end gap-6 border-t sm:border-t-0 border-zinc-200/60 dark:border-zinc-800/60 pt-3 sm:pt-0">
                            <form method="POST" action="{{ route('cart.items.update', $item) }}"
                                class="flex items-center gap-2">
                                @csrf @method('PATCH')
                                <input name="quantity" type="number" min="1" max="{{ $item->product->stock }}"
                                    value="{{ $item->quantity }}"
                                    class="w-16 rounded-md border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 px-2 py-1.5 text-center font-sans text-xs text-zinc-900 dark:text-white focus:border-zinc-400 dark:focus:border-zinc-500 focus:ring-1 focus:ring-zinc-400 dark:focus:ring-zinc-500">
                                <button type="submit"
                                    class="text-xs font-sans text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white underline">Perbarui</button>
                            </form>

                            <p class="font-sans text-sm font-bold text-zinc-900 dark:text-white w-28 text-right">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </p>

                            <form method="POST" action="{{ route('cart.items.destroy', $item) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-1.5 text-zinc-400 dark:text-zinc-500 hover:text-rose-400 transition" title="Hapus">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-6">
                <div class="flex items-baseline justify-between">
                    <span class="text-xs font-sans uppercase tracking-widest text-zinc-500 dark:text-zinc-400">Total Tagihan
                        ({{ $cart->items->sum('quantity') }} unit)</span>
                    <span class="text-2xl font-sans font-extrabold text-zinc-900 dark:text-white">Rp
                        {{ number_format($cart->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}</span>
                </div>
                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('products.index') }}"
                        class="flex-1 rounded-md border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 py-3 text-center text-xs font-sans font-medium uppercase tracking-wider text-zinc-700 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white transition">
                        Lanjut Belanja
                    </a>
                    <a href="{{ route('checkout.create') }}"
                        class="flex-1 rounded-md bg-zinc-900 dark:bg-white py-3 text-center text-xs font-sans font-bold uppercase tracking-wider text-white dark:text-zinc-950 hover:bg-zinc-700 dark:hover:bg-zinc-200 transition">
                        Lanjut ke Checkout →
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
