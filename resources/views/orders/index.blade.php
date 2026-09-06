<x-app-layout>
    <x-slot name="title">Riwayat Pesanan — LAPTOPSTORE</x-slot>

    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8">
            <p class="font-sans text-xs font-semibold tracking-widest text-zinc-400 dark:text-zinc-500 uppercase">Akun Pengguna</p>
            <h1 class="text-3xl font-black tracking-tight text-zinc-900 dark:text-white mt-1">Riwayat Pesanan</h1>
        </div>

        @if($orders->isEmpty())
            <div class="mt-12 text-center py-20 rounded-2xl border border-dashed border-zinc-200 dark:border-zinc-800 bg-zinc-100/30 dark:bg-zinc-900/30">
                <div class="mx-auto h-12 w-12 rounded-xl bg-zinc-200/80 dark:bg-zinc-800/80 border border-zinc-300 dark:border-zinc-700 flex items-center justify-center text-zinc-500 dark:text-zinc-400 mb-4">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <h3 class="text-base font-bold text-zinc-900 dark:text-white">Belum Ada Riwayat Pesanan</h3>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1 max-w-xs mx-auto">Semua pesanan laptop dan aksesoris Anda akan tercatat secara otomatis di halaman ini.</p>
                <a href="{{ route('products.index') }}" class="mt-6 inline-flex items-center gap-2 rounded-xl bg-zinc-900 dark:bg-white px-6 py-2.5 text-xs font-sans font-bold uppercase tracking-wider text-white dark:text-zinc-950 hover:bg-zinc-700 dark:hover:bg-zinc-200 transition">
                    Jelajahi Katalog &rarr;
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($orders as $order)
                    <a href="{{ route('orders.show', $order) }}" class="group block rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-6 backdrop-blur hover:border-zinc-300 dark:hover:border-zinc-700 transition">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <div>
                                <p class="font-sans text-sm font-bold text-zinc-900 dark:text-white group-hover:text-zinc-700 dark:group-hover:text-zinc-300 transition">{{ $order->order_number }}</p>
                                <p class="font-sans text-xs text-zinc-400 dark:text-zinc-500 mt-1">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                            </div>
                            <div class="flex items-center gap-2 font-sans text-xs">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 font-semibold uppercase tracking-wider border
                                    {{ match($order->order_status) {
                                        'pending' => 'bg-amber-100 text-amber-800 border-amber-300 dark:bg-amber-950/40 dark:text-amber-300 dark:border-amber-800/60',
                                        'processing' => 'bg-blue-100 text-blue-800 border-blue-300 dark:bg-blue-950/40 dark:text-blue-300 dark:border-blue-800/60',
                                        'shipped' => 'bg-violet-100 text-violet-800 border-violet-300 dark:bg-violet-950/40 dark:text-violet-300 dark:border-violet-800/60',
                                        'delivered' => 'bg-emerald-100 text-emerald-800 border-emerald-300 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-800/60',
                                        'cancelled' => 'bg-rose-100 text-rose-800 border-rose-300 dark:bg-rose-950/40 dark:text-rose-300 dark:border-rose-800/60',
                                        default => 'bg-zinc-200 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 border-zinc-300 dark:border-zinc-700',
                                    } }}">
                                    {{ ucfirst($order->order_status) }}
                                </span>
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 font-semibold uppercase tracking-wider border
                                    {{ match($order->payment_status) {
                                        'paid' => 'bg-emerald-100 text-emerald-800 border-emerald-300 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-800/60',
                                        'pending' => 'bg-amber-100 text-amber-800 border-amber-300 dark:bg-amber-950/40 dark:text-amber-300 dark:border-amber-800/60',
                                        'failed' => 'bg-rose-100 text-rose-800 border-rose-300 dark:bg-rose-950/40 dark:text-rose-300 dark:border-rose-800/60',
                                        default => 'bg-zinc-200 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 border-zinc-300 dark:border-zinc-700',
                                    } }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-zinc-200/80 dark:border-zinc-800/80 flex items-center justify-between">
                            <span class="font-sans text-xs text-zinc-400 dark:text-zinc-500">Total Pembayaran:</span>
                            <p class="font-sans text-base font-black text-zinc-900 dark:text-white">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-8">{{ $orders->links() }}</div>
        @endif
    </div>
</x-app-layout>
