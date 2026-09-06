<x-app-layout>
    <x-slot name="title">Checkout — LAPTOPSTORE</x-slot>

    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8">
            <p class="font-sans text-xs font-semibold tracking-widest text-zinc-400 dark:text-zinc-500 uppercase">Proses Pemesanan</p>
            <h1 class="text-3xl font-black tracking-tight text-zinc-900 dark:text-white mt-1">Konfirmasi & Pembayaran</h1>
        </div>

        @if($errors->any())
            <div class="mb-6 rounded-xl bg-rose-100 dark:bg-rose-950/40 border border-rose-300 dark:border-rose-800/60 px-4 py-3 text-sm text-rose-800 dark:text-rose-300">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid gap-8 lg:grid-cols-12">
            {{-- Form --}}
            <div class="lg:col-span-7">
                <form method="POST" action="{{ route('checkout.store') }}"
                    class="rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 backdrop-blur p-6 sm:p-8">
                    @csrf
                    <div class="flex items-center justify-between border-b border-zinc-200 dark:border-zinc-800 pb-4 mb-6">
                        <h2 class="text-base font-bold tracking-tight text-zinc-900 dark:text-white">Data Pengiriman</h2>
                        <span class="font-sans text-xs text-zinc-400 dark:text-zinc-500">Tahap 1 dari 1</span>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        @foreach(['recipient_name' => 'Nama Penerima', 'phone' => 'Nomor WhatsApp / Telepon'] as $name => $label)
                            <div>
                                <label
                                    class="mb-2 block font-sans text-[11px] font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">{{ $label }}</label>
                                <input name="{{ $name }}" value="{{ old($name, auth()->user()->name ?? '') }}" required
                                    class="w-full rounded-xl border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950/80 px-3.5 py-2.5 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-400 dark:focus:border-zinc-400 focus:ring-1 focus:ring-zinc-400 dark:focus:ring-zinc-400">
                            </div>
                        @endforeach

                        <div class="sm:col-span-2">
                            <label
                                class="mb-2 block font-sans text-[11px] font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Alamat
                                Lengkap Tujuan</label>
                            <textarea name="shipping_address" rows="3" required
                                placeholder="Jalan, No. Rumah, RT/RW, Kelurahan, Kecamatan"
                                class="w-full rounded-xl border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950/80 px-3.5 py-2.5 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-400 dark:focus:border-zinc-400 focus:ring-1 focus:ring-zinc-400 dark:focus:ring-zinc-400">{{ old('shipping_address') }}</textarea>
                        </div>

                        <div>
                            <label
                                class="mb-2 block font-sans text-[11px] font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Kota
                                / Kabupaten</label>
                            <input name="city" value="{{ old('city') }}" required placeholder="Contoh: Jakarta Selatan"
                                class="w-full rounded-xl border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950/80 px-3.5 py-2.5 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-400 dark:focus:border-zinc-400 focus:ring-1 focus:ring-zinc-400 dark:focus:ring-zinc-400">
                        </div>

                        <div>
                            <label
                                class="mb-2 block font-sans text-[11px] font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Provinsi</label>
                            <input name="province" value="{{ old('province') }}" required
                                placeholder="Contoh: DKI Jakarta"
                                class="w-full rounded-xl border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950/80 px-3.5 py-2.5 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-400 dark:focus:border-zinc-400 focus:ring-1 focus:ring-zinc-400 dark:focus:ring-zinc-400">
                        </div>

                        <div class="sm:col-span-2">
                            <label
                                class="mb-2 block font-sans text-[11px] font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Kode
                                Pos</label>
                            <input name="postal_code" value="{{ old('postal_code') }}" required placeholder="12345"
                                class="w-full sm:w-1/2 rounded-xl border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950/80 px-3.5 py-2.5 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-400 dark:focus:border-zinc-400 focus:ring-1 focus:ring-zinc-400 dark:focus:ring-zinc-400">
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-zinc-200 dark:border-zinc-800">
                        <button type="submit"
                            class="w-full rounded-xl bg-zinc-900 dark:bg-white py-3.5 text-sm font-bold text-white dark:text-zinc-950 hover:bg-zinc-700 dark:hover:bg-zinc-200 transition">
                            Lanjut ke Pembayaran Midtrans &rarr;
                        </button>
                        <p class="mt-2 text-center text-xs text-zinc-400 dark:text-zinc-500 font-sans">Transaksi diproses secara aman
                            melalui Midtrans Snap</p>
                    </div>
                </form>
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-5">
                <div
                    class="rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 backdrop-blur p-6 sm:p-7 lg:sticky lg:top-24">
                    <h2 class="text-base font-bold tracking-tight text-zinc-900 dark:text-white mb-5 pb-3 border-b border-zinc-200 dark:border-zinc-800">
                        Ringkasan Pesanan</h2>

                    <div class="space-y-4 max-h-96 overflow-y-auto pr-1">
                        @foreach($cart->items as $item)
                            <div class="flex items-center gap-3.5">
                                <div
                                    class="relative h-14 w-14 shrink-0 rounded-xl bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 p-1 flex items-center justify-center overflow-hidden">
                                    <img src="{{ $item->product->thumbnailUrl() }}" alt="{{ $item->product->name }}"
                                        class="max-h-full max-w-full object-contain">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-zinc-800 dark:text-zinc-200 truncate">{{ $item->product->name }}</p>
                                    <p class="font-sans text-xs text-zinc-400 dark:text-zinc-500 mt-0.5">{{ $item->quantity }} &times; Rp
                                        {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                                <p class="font-sans text-sm font-bold text-zinc-900 dark:text-white shrink-0">Rp
                                    {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 border-t border-zinc-200 dark:border-zinc-800 pt-4 space-y-2.5 font-sans text-xs">
                        <div class="flex justify-between text-zinc-500 dark:text-zinc-400">
                            <span>Subtotal</span>
                            <span class="text-zinc-900 dark:text-white">Rp
                                {{ number_format($cart->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-zinc-500 dark:text-zinc-400">
                            <span>Biaya Pengiriman</span>
                            <span class="text-emerald-600 dark:text-emerald-400">Gratis (Promo Toko)</span>
                        </div>
                        <div class="flex justify-between text-zinc-500 dark:text-zinc-400">
                            <span>Biaya Layanan</span>
                            <span class="text-zinc-900 dark:text-white">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-base pt-3 border-t border-zinc-200 dark:border-zinc-800 font-sans">
                            <span class="font-bold text-zinc-900 dark:text-white">Total Tagihan</span>
                            <span class="font-sans font-black text-zinc-900 dark:text-white">Rp
                                {{ number_format($cart->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
