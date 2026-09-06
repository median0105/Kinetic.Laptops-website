<x-app-layout>
    <x-slot name="title">Detail Pesanan {{ $order->order_number }} — Admin</x-slot>

    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1 text-sm font-medium text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition mb-6">
            Kembali ke pesanan
        </a>

        @if(session('success'))
            <div class="mb-4 rounded-xl bg-emerald-100 dark:bg-emerald-950/80 border border-emerald-300 dark:border-emerald-800/80 px-4 py-3 text-sm text-emerald-800 dark:text-emerald-300 font-medium">{{ session('success') }}</div>
        @endif

        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-extrabold tracking-tight text-zinc-900 dark:text-white">{{ $order->order_number }}</h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">{{ $order->created_at->format('d M Y, H:i') }} / Pelanggan: {{ $order->user->name ?? '-' }}</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                    {{ match($order->order_status) {
                        'pending' => 'bg-amber-100 text-amber-800 ring-1 ring-inset ring-amber-300 dark:bg-amber-950/40 dark:text-amber-300 dark:ring-amber-800/60',
                        'processing' => 'bg-blue-100 text-blue-800 ring-1 ring-inset ring-blue-300 dark:bg-blue-950/40 dark:text-blue-300 dark:ring-blue-800/60',
                        'shipped' => 'bg-purple-100 text-purple-800 ring-1 ring-inset ring-purple-300 dark:bg-purple-950/40 dark:text-purple-300 dark:ring-purple-800/60',
                        'delivered' => 'bg-emerald-100 text-emerald-800 ring-1 ring-inset ring-emerald-300 dark:bg-emerald-950/40 dark:text-emerald-300 dark:ring-emerald-800/60',
                        'cancelled' => 'bg-rose-100 text-rose-800 ring-1 ring-inset ring-rose-300 dark:bg-rose-950/40 dark:text-rose-300 dark:ring-rose-800/60',
                        default => 'bg-zinc-200 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 ring-1 ring-inset ring-zinc-300 dark:ring-zinc-700',
                    } }}">{{ ucfirst($order->order_status) }}</span>
                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                    {{ match($order->payment_status) {
                        'paid' => 'bg-emerald-100 text-emerald-800 ring-1 ring-inset ring-emerald-300 dark:bg-emerald-950/40 dark:text-emerald-300 dark:ring-emerald-800/60',
                        'pending' => 'bg-amber-100 text-amber-800 ring-1 ring-inset ring-amber-300 dark:bg-amber-950/40 dark:text-amber-300 dark:ring-amber-800/60',
                        'failed' => 'bg-rose-100 text-rose-800 ring-1 ring-inset ring-rose-300 dark:bg-rose-950/40 dark:text-rose-300 dark:ring-rose-800/60',
                        default => 'bg-zinc-200 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 ring-1 ring-inset ring-zinc-300 dark:ring-zinc-700',
                    } }}">{{ ucfirst($order->payment_status) }}</span>
            </div>
        </div>

        {{-- Update Status --}}
        <div class="mb-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-5">
            <h2 class="font-bold text-zinc-900 dark:text-white mb-3">Ubah Status Pesanan</h2>
            <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="flex flex-wrap items-end gap-3">
                @csrf @method('PATCH')
                <div class="flex-1 min-w-[200px]">
                    <select name="order_status" class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-sm text-zinc-900 dark:text-white focus:border-zinc-500 focus:ring-zinc-500">
                        @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                            <option value="{{ $status }}" @selected($order->order_status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="rounded-lg bg-zinc-900 dark:bg-white px-5 py-2 text-sm font-semibold text-white dark:text-zinc-950 hover:bg-zinc-700 dark:hover:bg-zinc-200 transition">Simpan</button>
            </form>
        </div>

        {{-- Items --}}
        <div class="rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-6">
            <h2 class="font-bold text-zinc-900 dark:text-white mb-4">Item Pesanan</h2>
            <div class="divide-y divide-zinc-200/80 dark:divide-zinc-800/80">
                @foreach($order->items as $item)
                    <div class="flex items-center gap-4 py-4 first:pt-0 last:pb-0">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-zinc-200 dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700">
                            <svg class="h-6 w-6 text-zinc-400 dark:text-zinc-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h1.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 6.75v7.875c0 1.242 1.008 2.25 2.25 2.25z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-zinc-800 dark:text-zinc-200">{{ $item->product_name }}</p>
                            <p class="text-xs text-zinc-400 dark:text-zinc-500">SKU: {{ $item->sku }} / Qty: {{ $item->quantity }} / Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-bold text-zinc-900 dark:text-white">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 border-t border-zinc-200 dark:border-zinc-800 pt-4 space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-zinc-500 dark:text-zinc-400">Subtotal</span>
                    <span class="font-semibold text-zinc-900 dark:text-white">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-zinc-500 dark:text-zinc-400">Ongkir</span>
                    <span class="font-semibold text-zinc-900 dark:text-white">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-lg pt-2 border-t border-zinc-200 dark:border-zinc-800">
                    <span class="font-bold text-zinc-900 dark:text-white">Total</span>
                    <span class="font-extrabold text-zinc-900 dark:text-white">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Shipping --}}
        <div class="mt-4 rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-6">
            <h2 class="font-bold text-zinc-900 dark:text-white mb-3">Informasi Pengiriman</h2>
            <div class="grid gap-3 sm:grid-cols-2 text-sm">
                <div><span class="text-zinc-500 dark:text-zinc-400">Penerima:</span> <span class="font-medium text-zinc-800 dark:text-zinc-200">{{ $order->recipient_name }}</span></div>
                <div><span class="text-zinc-500 dark:text-zinc-400">Telepon:</span> <span class="font-medium text-zinc-800 dark:text-zinc-200">{{ $order->phone }}</span></div>
                <div class="sm:col-span-2"><span class="text-zinc-500 dark:text-zinc-400">Alamat:</span> <span class="font-medium text-zinc-800 dark:text-zinc-200">{{ $order->shipping_address }}, {{ $order->city }}, {{ $order->province }} {{ $order->postal_code }}</span></div>
            </div>
        </div>

        {{-- Midtrans Info --}}
        @if($order->midtrans_transaction_id)
            <div class="mt-4 rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-6">
                <h2 class="font-bold text-zinc-900 dark:text-white mb-3">Info Pembayaran Midtrans</h2>
                <div class="grid gap-2 text-sm">
                    <div><span class="text-zinc-500 dark:text-zinc-400">Transaction ID:</span> <span class="text-zinc-800 dark:text-zinc-200">{{ $order->midtrans_transaction_id }}</span></div>
                    @if($order->paid_at)
                        <div><span class="text-zinc-500 dark:text-zinc-400">Dibayar:</span> <span class="text-zinc-800 dark:text-zinc-200">{{ $order->paid_at->format('d M Y, H:i') }}</span></div>
                    @endif
                    @if($order->expired_at)
                        <div><span class="text-zinc-500 dark:text-zinc-400">Kadaluarsa:</span> <span class="text-zinc-800 dark:text-zinc-200">{{ $order->expired_at->format('d M Y, H:i') }}</span></div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
