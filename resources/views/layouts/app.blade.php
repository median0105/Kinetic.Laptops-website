<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'KINETIC · Laptop Store') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body
    class="font-sans antialiased bg-white text-zinc-900 dark:bg-zinc-950 dark:text-zinc-100 selection:bg-zinc-200 dark:selection:bg-zinc-800 selection:text-zinc-900 dark:selection:text-white min-h-screen flex flex-col transition-colors">
    <div class="flex-1 flex flex-col">
        @include('layouts.navigation')

        @if (isset($header))
            <header class="border-b border-zinc-200 dark:border-zinc-800/80 bg-zinc-50 dark:bg-zinc-900/30 backdrop-blur">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main class="flex-1">
            {{ $slot }}
        </main>

        <footer class="border-t border-zinc-200 dark:border-zinc-800/80 bg-white dark:bg-zinc-950 text-zinc-500 dark:text-zinc-400 mt-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-14">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                    <div class="md:col-span-2">
                        <div class="flex items-center gap-2.5">
                            <span
                                class="flex h-7 w-7 items-center justify-center rounded-lg bg-zinc-900 dark:bg-zinc-100 text-white dark:text-zinc-950 font-sans text-xs font-black tracking-tight">K</span>
                            <span class="font-sans text-base font-bold tracking-tight text-zinc-900 dark:text-white uppercase">KINETIC<span
                                    class="text-zinc-400 dark:text-zinc-500">.LAPTOPS</span></span>
                        </div>
                        <p class="mt-3 text-sm text-zinc-500 dark:text-zinc-400 max-w-sm leading-relaxed">
                            Kurasi laptop workstation, ultrabook, dan gaming resmi dengan spesifikasi terverifikasi.
                        </p>
                    </div>

                    <div>
                        <h4 class="text-xs font-sans font-semibold uppercase tracking-widest text-zinc-700 dark:text-zinc-200 mb-4">
                            Navigasi</h4>
                        <ul class="space-y-2.5 text-sm">
                            <li><a href="{{ route('products.index') }}"
                                    class="text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition">Katalog Laptop</a></li>
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <li><a href="{{ route('admin.dashboard') }}"
                                            class="text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition">Admin Panel</a></li>
                                @else
                                    <li><a href="{{ route('cart.index') }}"
                                            class="text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition">Keranjang Belanja</a></li>
                                    <li><a href="{{ route('orders.index') }}"
                                            class="text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition">Daftar Pesanan</a></li>
                                @endif
                            @else
                                <li><a href="{{ route('login') }}" class="text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition">Masuk
                                        Akun</a></li>
                                <li><a href="{{ route('register') }}"
                                        class="text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition">Daftar Baru</a></li>
                            @endauth
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-xs font-sans font-semibold uppercase tracking-widest text-zinc-700 dark:text-zinc-200 mb-4">Standar
                            Layanan</h4>
                        <ul class="space-y-2 text-sm text-zinc-500 dark:text-zinc-400 font-sans">
                            <li class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                Garansi Resmi Distributor
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-zinc-400 dark:bg-zinc-500"></span>
                                Asuransi Pengiriman Aman
                            </li>
                            <li class="pt-2 text-xs text-zinc-400 dark:text-zinc-500">
                                support@kinetic-laptops.local
                            </li>
                        </ul>
                    </div>
                </div>

                <div
                    class="mt-12 border-t border-zinc-200 dark:border-zinc-900 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-zinc-400 dark:text-zinc-500 font-sans">
                    <p>&copy; {{ date('Y') }} KINETIC LAPTOPS. All rights reserved.</p>
                    <p>Designed for Performance & Precision</p>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
