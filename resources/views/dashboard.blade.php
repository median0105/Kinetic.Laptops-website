<x-app-layout>
    <x-slot name="title">Dashboard — LAPTOPSTORE</x-slot>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8">
            <p class="font-sans text-xs font-semibold tracking-widest text-zinc-400 dark:text-zinc-500 uppercase">Ikhtisar Akun</p>
            <h1 class="text-3xl font-black tracking-tight text-zinc-900 dark:text-white mt-1">Halo, {{ auth()->user()->name }}</h1>
            <p class="font-sans text-xs text-zinc-400 dark:text-zinc-500 mt-1">Terdaftar sebagai {{ auth()->user()->role ?? 'Pelanggan' }}
            </p>
        </div>

        <div class="grid gap-5 sm:grid-cols-3">
            <a href="{{ route('products.index') }}"
                class="group rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-6 backdrop-blur hover:border-zinc-300 dark:hover:border-zinc-700 transition">
                <div
                    class="h-10 w-10 rounded-xl bg-zinc-200 dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 flex items-center justify-center text-zinc-700 dark:text-zinc-300 group-hover:text-zinc-900 dark:group-hover:text-white group-hover:border-zinc-400 dark:group-hover:border-zinc-500 transition mb-4">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-zinc-900 dark:text-white group-hover:text-zinc-800 dark:group-hover:text-zinc-200">Katalog Laptop</h3>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Eksplorasi laptop gaming, ultrabook, workstation, dan aksesoris
                    resmi.</p>
                <div
                    class="mt-4 flex items-center gap-1 font-sans text-xs font-semibold text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-white transition">
                    <span>Lihat Produk</span> &rarr;
                </div>
            </a>

            <a href="{{ route('cart.index') }}"
                class="group rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-6 backdrop-blur hover:border-zinc-300 dark:hover:border-zinc-700 transition">
                <div
                    class="h-10 w-10 rounded-xl bg-zinc-200 dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 flex items-center justify-center text-zinc-700 dark:text-zinc-300 group-hover:text-zinc-900 dark:group-hover:text-white group-hover:border-zinc-400 dark:group-hover:border-zinc-500 transition mb-4">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-zinc-900 dark:text-white group-hover:text-zinc-800 dark:group-hover:text-zinc-200">Keranjang Belanja</h3>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Cek item yang tersimpan dan lakukan proses checkout pesanan.</p>
                <div
                    class="mt-4 flex items-center gap-1 font-sans text-xs font-semibold text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-white transition">
                    <span>Buka Keranjang</span> &rarr;
                </div>
            </a>

            <a href="{{ route('orders.index') }}"
                class="group rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-6 backdrop-blur hover:border-zinc-300 dark:hover:border-zinc-700 transition">
                <div
                    class="h-10 w-10 rounded-xl bg-zinc-200 dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 flex items-center justify-center text-zinc-700 dark:text-zinc-300 group-hover:text-zinc-900 dark:group-hover:text-white group-hover:border-zinc-400 dark:group-hover:border-zinc-500 transition mb-4">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-zinc-900 dark:text-white group-hover:text-zinc-800 dark:group-hover:text-zinc-200">Riwayat Pesanan</h3>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Lacak status pengiriman dan unduh faktur pesanan Anda.</p>
                <div
                    class="mt-4 flex items-center gap-1 font-sans text-xs font-semibold text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-white transition">
                    <span>Lihat Riwayat</span> &rarr;
                </div>
            </a>
        </div>

        @if(auth()->user()->role === 'admin')
            <div
                class="mt-8 rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/40 dark:bg-zinc-900/40 p-6 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <span class="font-sans text-xs font-semibold text-amber-400 uppercase tracking-widest">Akses Khusus
                        Pengelola</span>
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white mt-0.5">Admin Management Console</h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Kelola data master produk, spesifikasi teknis, inventori, dan
                        transaksi masuk.</p>
                </div>
                <a href="{{ route('admin.dashboard') }}"
                    class="rounded-xl bg-zinc-900 dark:bg-white px-5 py-2.5 text-xs font-sans font-bold uppercase tracking-wider text-white dark:text-zinc-950 hover:bg-zinc-700 dark:hover:bg-zinc-200 transition shadow-sm">
                    Akses Admin Panel &rarr;
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
