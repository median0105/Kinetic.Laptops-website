<x-app-layout>
    <x-slot name="title">KINETIC · Precision Laptops & Workstations</x-slot>

    {{-- Hero Section (Asymmetrical 50/50 Split, Tight Copy, Real Hero Product) --}}
    <section class="relative overflow-hidden border-b border-zinc-200 dark:border-zinc-800/80 bg-white dark:bg-zinc-950">
        {{-- Subtle architectural grid backdrop --}}
        <div
            class="absolute inset-0 bg-[linear-gradient(to_right,#27272a15_1px,transparent_1px),linear-gradient(to_bottom,#27272a15_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]">
        </div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-16 pb-20 lg:pt-24 lg:pb-28">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                {{-- Left: Text & CTA --}}
                <div class="lg:col-span-7">
                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-zinc-200 dark:border-zinc-800 bg-zinc-100/80 dark:bg-zinc-900/80 px-3 py-1 text-[11px] font-sans uppercase tracking-widest text-zinc-700 dark:text-zinc-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Katalog 2026 Ready Stock
                    </div>

                    <h1
                        class="mt-6 text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-zinc-900 dark:text-white leading-[1.08]">
                        Laptop performa tinggi untuk engineer, kreator, dan gamer.
                    </h1>

                    <p class="mt-6 text-base sm:text-lg text-zinc-500 dark:text-zinc-400 max-w-xl leading-relaxed font-normal">
                        Kurasi hardware resmi dengan benchmark teruji, sistem pendingin optimal, dan garansi distributor
                        Indonesia.
                    </p>

                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="{{ route('products.index') }}"
                            class="inline-flex items-center justify-center rounded-md bg-zinc-900 dark:bg-white px-6 py-3 text-xs font-sans font-bold uppercase tracking-wider text-white dark:text-zinc-950 hover:bg-zinc-700 dark:hover:bg-zinc-200 active:scale-[0.98] transition">
                            Jelajahi Katalog
                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <a href="#featured"
                            class="inline-flex items-center justify-center rounded-md border border-zinc-200 dark:border-zinc-800 bg-zinc-100/50 dark:bg-zinc-900/50 px-6 py-3 text-xs font-sans font-medium uppercase tracking-wider text-zinc-700 dark:text-zinc-300 hover:border-zinc-300 dark:hover:border-zinc-700 hover:text-zinc-900 dark:hover:text-white transition">
                            Lihat Unit Unggulan
                        </a>
                    </div>

                    <div class="mt-12 pt-8 border-t border-zinc-200 dark:border-zinc-900 grid grid-cols-3 gap-6 font-sans">
                        <div>
                            <p class="text-xs text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">Verifikasi</p>
                            <p class="mt-1 text-sm font-semibold text-zinc-800 dark:text-zinc-200">100% Resmi</p>
                        </div>
                        <div>
                            <p class="text-xs text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">Garansi</p>
                            <p class="mt-1 text-sm font-semibold text-zinc-800 dark:text-zinc-200">Hingga 3 Tahun</p>
                        </div>
                        <div>
                            <p class="text-xs text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">Pengiriman</p>
                            <p class="mt-1 text-sm font-semibold text-zinc-800 dark:text-zinc-200">Asuransi Penuh</p>
                        </div>
                    </div>
                </div>

                {{-- Right: Clean Product Stage Visual (ASUS ROG Strix G16 Showcase) --}}
                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <div
                            class="relative rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-gradient-to-b from-zinc-100/60 dark:from-zinc-900/60 to-white dark:to-zinc-950 p-6 shadow-2xl backdrop-blur">
                            <div
                                class="flex items-center justify-between pb-4 border-b border-zinc-200 dark:border-zinc-800/80 text-[11px] font-sans text-zinc-500 dark:text-zinc-400">
                                <span>FLAGSHIP GAMING</span>
                                <span class="rounded bg-zinc-200 dark:bg-zinc-800 px-2 py-0.5 text-zinc-700 dark:text-zinc-300 font-semibold">RTX
                                    4060</span>
                            </div>

                            <div
                                class="relative aspect-[4/3] w-full my-4 flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('images/products/rog.png') }}"
                                    alt="ASUS ROG Strix G16"
                                    class="max-h-full max-w-full object-contain filter drop-shadow-[0_20px_25px_rgba(0,0,0,0.8)] hover:scale-105 transition duration-500">
                            </div>

                            <div class="pt-4 border-t border-zinc-200 dark:border-zinc-800/80">
                                <div class="flex items-baseline justify-between">
                                    <h3 class="font-bold text-zinc-900 dark:text-white tracking-tight text-base">ASUS ROG Strix G16</h3>
                                    <span class="font-sans text-xs text-zinc-500 dark:text-zinc-400">i7-13650HX · 16GB</span>
                                </div>
                                <div class="mt-2 flex items-center justify-between">
                                    <span class="font-sans text-sm font-semibold text-zinc-800 dark:text-zinc-200">Rp 18.999.000</span>
                                    <a href="{{ route('products.index', ['brand' => 'ASUS']) }}"
                                        class="text-xs font-sans text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white underline underline-offset-4">Lihat
                                        Detail →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Brand Category Strip (Zero Emoji, Clean Pills) --}}
    <section class="border-b border-zinc-200 dark:border-zinc-800/60 bg-white dark:bg-zinc-950 py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-none">
                <span
                    class="text-xs font-sans uppercase tracking-widest text-zinc-400 dark:text-zinc-500 whitespace-nowrap mr-2">Kategori:</span>
                <a href="{{ route('products.index') }}"
                    class="rounded-full border border-zinc-200 dark:border-zinc-800 bg-zinc-100 dark:bg-zinc-900 px-3.5 py-1 text-xs font-sans text-zinc-700 dark:text-zinc-300 hover:border-zinc-300 dark:hover:border-zinc-700 hover:text-zinc-900 dark:hover:text-white transition whitespace-nowrap">
                    Semua Unit
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
                        class="rounded-full border border-zinc-200/70 dark:border-zinc-800/70 bg-white dark:bg-zinc-950 px-3.5 py-1 text-xs font-sans text-zinc-500 dark:text-zinc-400 hover:border-zinc-300 dark:hover:border-zinc-700 hover:text-zinc-800 dark:hover:text-zinc-200 transition whitespace-nowrap">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Featured Products Section --}}
    <section id="featured" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-8 border-b border-zinc-200 dark:border-zinc-800/80">
            <div>
                <p class="text-xs font-sans font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">Pilihan Terkurasi</p>
                <h2 class="mt-2 text-2xl sm:text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white">Produk Unggulan</h2>
            </div>
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center gap-1.5 text-xs font-sans uppercase tracking-wider text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition">
                <span>Lihat Seluruh Katalog</span>
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>

        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($products as $product)
                <a href="{{ route('products.show', $product) }}"
                    class="group flex flex-col rounded-xl border border-zinc-200/90 dark:border-zinc-800/90 bg-zinc-100/40 dark:bg-zinc-900/40 p-5 hover:border-zinc-300 dark:hover:border-zinc-700 hover:bg-zinc-100/80 dark:hover:bg-zinc-900/80 transition duration-200 {{ $product->stock <= 0 ? 'opacity-50' : '' }}">

                    {{-- Image Canvas --}}
                    <div
                        class="relative flex aspect-[4/3] w-full items-center justify-center overflow-hidden rounded-lg bg-white dark:bg-zinc-950 p-4 border border-zinc-200/50 dark:border-zinc-800/50">
                        @if($product->thumbnailUrl())
                            <img src="{{ $product->thumbnailUrl() }}" alt="{{ $product->name }}"
                                class="max-h-full max-w-full object-contain filter group-hover:scale-105 transition duration-300 {{ $product->stock <= 0 ? 'grayscale' : '' }}">
                        @else
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-900 text-zinc-400 dark:text-zinc-500 font-sans text-xs">
                                N/A
                            </div>
                        @endif

                        @if($product->stock <= 0)
                            <span
                                class="absolute top-3 left-3 rounded bg-rose-950/90 border border-rose-800 px-2 py-0.5 text-[10px] font-sans font-semibold uppercase text-rose-300">Stok
                                Habis</span>
                        @elseif($product->is_featured)
                            <span
                                class="absolute top-3 left-3 rounded bg-zinc-200/90 dark:bg-zinc-800/90 border border-zinc-300 dark:border-zinc-700 px-2 py-0.5 text-[10px] font-sans font-medium text-zinc-700 dark:text-zinc-300">Unggulan</span>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="mt-4 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-[11px] font-sans text-zinc-500 dark:text-zinc-400">
                                <span>{{ $product->category->name }}</span>
                                @if($product->specification?->brand)
                                    <span class="text-zinc-400 dark:text-zinc-500">{{ $product->specification->brand }}</span>
                                @endif
                            </div>

                            <h3
                                class="mt-2 text-base font-bold text-zinc-900 dark:text-white tracking-tight group-hover:text-zinc-800 dark:group-hover:text-zinc-200 transition">
                                {{ $product->name }}
                            </h3>

                            @if($product->specification)
                                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400 font-sans line-clamp-1">
                                    {{ $product->specification->processor }} · {{ $product->specification->ram }}
                                </p>
                            @endif
                        </div>

                        <div class="mt-5 pt-3 border-t border-zinc-200/60 dark:border-zinc-800/60 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-sans font-bold text-zinc-900 dark:text-white">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p
                                    class="text-[11px] font-sans {{ $product->stock > 0 ? 'text-zinc-500 dark:text-zinc-400' : 'text-rose-400' }}">
                                    {{ $product->stock > 0 ? "Stok: {$product->stock} unit" : 'Habis' }}
                                </p>
                            </div>

                            <span
                                class="flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 dark:border-zinc-800 bg-zinc-100 dark:bg-zinc-900 text-zinc-500 dark:text-zinc-400 group-hover:border-zinc-300 dark:group-hover:border-zinc-700 group-hover:text-zinc-900 dark:group-hover:text-white transition">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-16 text-center border border-dashed border-zinc-200 dark:border-zinc-800 rounded-xl">
                    <p class="text-sm text-zinc-400 dark:text-zinc-500 font-sans">Tidak ada produk ditemukan.</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- Specs & Reliability Matrix (Replacing Cliché Banners) --}}
    <section class="border-t border-zinc-200 dark:border-zinc-800/80 bg-zinc-100/30 dark:bg-zinc-900/30 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="rounded-xl border border-zinc-200/80 dark:border-zinc-800/80 bg-white dark:bg-zinc-950 p-6">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-md bg-zinc-100 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 text-zinc-700 dark:text-zinc-300 font-sans text-xs font-bold">
                        01</div>
                    <h3 class="mt-4 text-base font-bold text-zinc-900 dark:text-white">Hardware Original</h3>
                    <p class="mt-2 text-xs text-zinc-500 dark:text-zinc-400 leading-relaxed">
                        Seluruh unit berasal langsung dari prinsipal resmi di Indonesia (ASUS, Lenovo, Apple, Dell,
                        MSI).
                    </p>
                </div>
                <div class="rounded-xl border border-zinc-200/80 dark:border-zinc-800/80 bg-white dark:bg-zinc-950 p-6">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-md bg-zinc-100 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 text-zinc-700 dark:text-zinc-300 font-sans text-xs font-bold">
                        02</div>
                    <h3 class="mt-4 text-base font-bold text-zinc-900 dark:text-white">Inspeksi Sebelum Kirim</h3>
                    <p class="mt-2 text-xs text-zinc-500 dark:text-zinc-400 leading-relaxed">
                        Pemeriksaan layar (dead pixel), keyboard response, dan pengujian thermal sebelum proses packing.
                    </p>
                </div>
                <div class="rounded-xl border border-zinc-200/80 dark:border-zinc-800/80 bg-white dark:bg-zinc-950 p-6">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-md bg-zinc-100 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 text-zinc-700 dark:text-zinc-300 font-sans text-xs font-bold">
                        03</div>
                    <h3 class="mt-4 text-base font-bold text-zinc-900 dark:text-white">Pengiriman Berasuransi</h3>
                    <p class="mt-2 text-xs text-zinc-500 dark:text-zinc-400 leading-relaxed">
                        Kemasan ganda berbahan protektif dengan jaminan ganti rugi 100% jika terjadi kerusakan logistik.
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
