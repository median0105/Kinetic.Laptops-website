<x-app-layout>
    <x-slot name="title">Pesanan {{ $order->order_number }} — LAPTOPSTORE</x-slot>

    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-10">
        <a href="{{ route('orders.index') }}"
            class="inline-flex items-center gap-1.5 font-sans text-xs font-semibold text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition mb-6">
            &larr; KEMBALI KE RIWAYAT PESANAN
        </a>

        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-zinc-200 dark:border-zinc-800 pb-6">
            <div>
                <p class="font-sans text-xs uppercase tracking-wider text-zinc-400 dark:text-zinc-500">ID Pesanan</p>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-zinc-900 dark:text-white font-sans mt-0.5">
                    {{ $order->order_number }}
                </h1>
                <p class="font-sans text-xs text-zinc-400 dark:text-zinc-500 mt-1">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
            </div>
            <div class="flex items-center gap-2 font-sans text-xs">
                <span class="inline-flex items-center rounded-full px-3 py-1 font-semibold uppercase tracking-wider border
                    {{ match ($order->order_status) {
                        'pending' => 'bg-amber-100 text-amber-800 border-amber-300 dark:bg-amber-950/40 dark:text-amber-300 dark:border-amber-800/60',
                        'processing' => 'bg-blue-100 text-blue-800 border-blue-300 dark:bg-blue-950/40 dark:text-blue-300 dark:border-blue-800/60',
                        'shipped' => 'bg-violet-100 text-violet-800 border-violet-300 dark:bg-violet-950/40 dark:text-violet-300 dark:border-violet-800/60',
                        'delivered' => 'bg-emerald-100 text-emerald-800 border-emerald-300 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-800/60',
                        'cancelled' => 'bg-rose-100 text-rose-800 border-rose-300 dark:bg-rose-950/40 dark:text-rose-300 dark:border-rose-800/60',
                        default => 'bg-zinc-200 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 border-zinc-300 dark:border-zinc-700',
                    } }}">
                    Status: {{ ucfirst($order->order_status) }}
                </span>
                <span class="inline-flex items-center rounded-full px-3 py-1 font-semibold uppercase tracking-wider border
                    {{ match ($order->payment_status) {
                        'paid' => 'bg-emerald-100 text-emerald-800 border-emerald-300 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-800/60',
                        'pending' => 'bg-amber-100 text-amber-800 border-amber-300 dark:bg-amber-950/40 dark:text-amber-300 dark:border-amber-800/60',
                        'failed' => 'bg-rose-100 text-rose-800 border-rose-300 dark:bg-rose-950/40 dark:text-rose-300 dark:border-rose-800/60',
                        default => 'bg-zinc-200 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 border-zinc-300 dark:border-zinc-700',
                    } }}">
                    Pembayaran: {{ ucfirst($order->payment_status) }}
                </span>
            </div>
        </div>

        @if(session('success'))
            <div
                class="mt-6 rounded-xl bg-emerald-100 dark:bg-emerald-950/40 border border-emerald-300 dark:border-emerald-800/60 px-4 py-3 text-sm text-emerald-800 dark:text-emerald-300 font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Items --}}
        <div class="mt-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 backdrop-blur p-6">
            <h2 class="text-base font-bold text-zinc-900 dark:text-white mb-4">Item yang Dipesan</h2>
            <div class="divide-y divide-zinc-200/80 dark:divide-zinc-800/80">
                @foreach($order->items as $item)
                    <div class="flex items-center gap-4 py-4 first:pt-0 last:pb-0">
                        <div
                            class="relative h-14 w-14 shrink-0 rounded-xl bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 p-1 flex items-center justify-center overflow-hidden">
                            @if($item->product)
                                <img src="{{ $item->product->thumbnailUrl() }}" alt="{{ $item->product_name }}"
                                    class="max-h-full max-w-full object-contain">
                            @else
                                <svg class="h-6 w-6 text-zinc-400 dark:text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-zinc-800 dark:text-zinc-200">{{ $item->product_name }}</p>
                            <p class="font-sans text-xs text-zinc-400 dark:text-zinc-500 mt-0.5">SKU: {{ $item->sku }} &middot; Qty:
                                {{ $item->quantity }} &times; Rp {{ number_format($item->price, 0, ',', '.') }}
                            </p>
                        </div>
                        <p class="font-sans font-bold text-zinc-900 dark:text-white shrink-0">Rp
                            {{ number_format($item->subtotal, 0, ',', '.') }}
                        </p>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 border-t border-zinc-200 dark:border-zinc-800 pt-4 space-y-2 font-sans text-xs">
                <div class="flex justify-between text-zinc-500 dark:text-zinc-400">
                    <span>Subtotal</span>
                    <span class="text-zinc-900 dark:text-white">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-zinc-500 dark:text-zinc-400">
                    <span>Biaya Pengiriman</span>
                    <span
                        class="text-emerald-600 dark:text-emerald-400">{{ $order->shipping_cost > 0 ? 'Rp ' . number_format($order->shipping_cost, 0, ',', '.') : 'Gratis' }}</span>
                </div>
                <div class="flex justify-between text-base pt-3 border-t border-zinc-200 dark:border-zinc-800 font-sans">
                    <span class="font-bold text-zinc-900 dark:text-white">Total Pembayaran</span>
                    <span class="font-sans font-black text-zinc-900 dark:text-white">Rp
                        {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Shipping Info --}}
        <div class="mt-4 rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 backdrop-blur p-6">
            <h2 class="text-base font-bold text-zinc-900 dark:text-white mb-3">Informasi Pengiriman</h2>
            <div class="grid gap-3 sm:grid-cols-2 text-sm text-zinc-700 dark:text-zinc-300">
                <div><span class="font-sans text-xs text-zinc-400 dark:text-zinc-500 block mb-0.5">Penerima</span> <span
                        class="font-medium text-zinc-900 dark:text-white">{{ $order->recipient_name }}</span></div>
                <div><span class="font-sans text-xs text-zinc-400 dark:text-zinc-500 block mb-0.5">Nomor Telepon</span> <span
                        class="font-sans font-medium text-zinc-900 dark:text-white">{{ $order->phone }}</span></div>
                <div class="sm:col-span-2"><span class="font-sans text-xs text-zinc-400 dark:text-zinc-500 block mb-0.5">Alamat
                        Pengiriman</span> <span class="font-medium text-zinc-800 dark:text-zinc-200">{{ $order->shipping_address }},
                        {{ $order->city }}, {{ $order->province }} {{ $order->postal_code }}</span></div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="mt-6 flex flex-wrap gap-3">
            @if($order->payment_status === 'paid')
                <a href="{{ route('orders.invoice', $order) }}"
                    class="rounded-xl border border-zinc-300 dark:border-zinc-700 bg-zinc-200 dark:bg-zinc-800 px-6 py-3 text-xs font-sans font-bold uppercase tracking-wider text-zinc-900 dark:text-white hover:bg-zinc-300 dark:hover:bg-zinc-700 transition">
                    Download Invoice PDF &darr;
                </a>
            @endif
            @if($order->payment_status === 'pending' && ($order->payment_token || session('snap_token')))
                @php $snapToken = $order->payment_token ?: session('snap_token'); @endphp
                <script
                    src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
                    data-client-key="{{ config('services.midtrans.client_key') }}"></script>
                <button onclick="window.laptopSnap()" id="pay-now"
                    class="rounded-xl bg-zinc-900 dark:bg-white px-6 py-3 text-xs font-sans font-bold uppercase tracking-wider text-white dark:text-zinc-950 hover:bg-zinc-700 dark:hover:bg-zinc-200 transition shadow-lg shadow-zinc-900/10 dark:shadow-white/10">
                    Selesaikan Pembayaran &rarr;
                </button>
                <script>
                    window.laptopSnap = function () {
                        snap.pay('{{ $snapToken }}', {
                            onSuccess: function (result) {
                                fetch('{{ route('orders.payment-success', $order) }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json',
                                        'Accept': 'application/json',
                                    },
                                })
                                    .then(function (r) { return r.json(); })
                                    .then(function (data) {
                                        if (data.success) {
                                            alert('Pembayaran berhasil dikonfirmasi! Pesanan Anda segera disiapkan.');
                                            window.location.href = '{{ route('orders.show', $order) }}';
                                        } else {
                                            window.location.reload();
                                        }
                                    })
                                    .catch(function () { window.location.reload(); });
                            },
                            onPending: function () { window.location.reload(); },
                            onClose: function () { window.location.reload(); },
                        });
                    };
                </script>
            @endif
        </div>
    </div>
</x-app-layout>
