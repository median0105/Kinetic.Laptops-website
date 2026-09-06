<x-app-layout>
    <x-slot name="title">{{ $product->name }} — KINETIC</x-slot>

    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-10">
        {{-- Breadcrumb --}}
        <a href="{{ route('products.index') }}"
            class="inline-flex items-center gap-2 text-xs font-sans uppercase tracking-wider text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition mb-8">
            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali ke Katalog</span>
        </a>

        <div class="grid gap-12 lg:grid-cols-12 items-start">
            {{-- Product Stage (Left: 5 cols) --}}
            <div class="lg:col-span-5">
                <div
                    class="relative flex aspect-square w-full items-center justify-center overflow-hidden rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-8 shadow-2xl backdrop-blur">
                    @if($product->thumbnailUrl())
                        <img src="{{ $product->thumbnailUrl() }}" alt="{{ $product->name }}"
                            class="max-h-full max-w-full object-contain filter drop-shadow-[0_20px_25px_rgba(0,0,0,0.8)] {{ $product->stock <= 0 ? 'grayscale opacity-60' : '' }}">
                    @else
                        <div
                            class="flex h-16 w-16 items-center justify-center rounded-xl bg-zinc-200 dark:bg-zinc-800 text-zinc-400 dark:text-zinc-500 font-sans text-xs">
                            No Visual
                        </div>
                    @endif

                    @if($product->stock <= 0)
                        <span
                            class="absolute top-4 left-4 rounded bg-rose-950/90 border border-rose-800 px-3 py-1 text-xs font-sans font-semibold uppercase text-rose-300">
                            Stok Habis
                        </span>
                    @elseif($product->is_featured)
                        <span
                            class="absolute top-4 left-4 rounded bg-zinc-200/90 dark:bg-zinc-800/90 border border-zinc-300 dark:border-zinc-700 px-3 py-1 text-xs font-sans font-medium text-zinc-700 dark:text-zinc-300">
                            Unit Unggulan
                        </span>
                    @endif
                </div>

                {{-- Guarantee badges --}}
                <div class="mt-4 grid grid-cols-2 gap-3 text-[11px] font-sans text-zinc-500 dark:text-zinc-400">
                    <div class="flex items-center gap-2 rounded-lg border border-zinc-200/80 dark:border-zinc-800/80 bg-white dark:bg-zinc-950 p-3">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        <span>Garansi Resmi 100%</span>
                    </div>
                    <div class="flex items-center gap-2 rounded-lg border border-zinc-200/80 dark:border-zinc-800/80 bg-white dark:bg-zinc-950 p-3">
                        <span class="h-1.5 w-1.5 rounded-full bg-zinc-400 dark:bg-zinc-500"></span>
                        <span>Asuransi Pengiriman</span>
                    </div>
                </div>
            </div>

            {{-- Product Info & Action (Right: 7 cols) --}}
            <div class="lg:col-span-7">
                <div class="flex items-center gap-2 text-xs font-sans uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                    <span>{{ $product->category->name }}</span>
                    @if($product->specification?->brand)
                        <span>·</span>
                        <span class="text-zinc-400 dark:text-zinc-500">{{ $product->specification->brand }}</span>
                    @endif
                    <span>·</span>
                    <span class="text-zinc-400 dark:text-zinc-500">SKU: {{ $product->sku }}</span>
                </div>

                <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold tracking-tight text-zinc-900 dark:text-white leading-tight">
                    {{ $product->name }}
                </h1>

                {{-- Rating Summary --}}
                @if($product->reviewCount() > 0)
                    <div class="mt-3 flex items-center gap-2 text-xs font-sans">
                        <div class="flex text-amber-400">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="h-4 w-4 {{ $i <= $product->averageRating() ? 'fill-current' : 'text-zinc-200 dark:text-zinc-800' }}"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                        <span class="font-bold text-zinc-900 dark:text-white">{{ $product->averageRating() }}</span>
                        <span class="text-zinc-400 dark:text-zinc-500">({{ $product->reviewCount() }} ulasan pembeli)</span>
                    </div>
                @endif

                {{-- Price & Stock --}}
                <div class="mt-6 flex items-baseline gap-4 pb-6 border-b border-zinc-200 dark:border-zinc-800">
                    <span class="text-3xl sm:text-4xl font-sans font-black tracking-tight text-zinc-900 dark:text-white">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                    <span class="text-xs font-sans {{ $product->stock > 0 ? 'text-emerald-400' : 'text-rose-400' }}">
                        {{ $product->stock > 0 ? "Stok Tersedia: {$product->stock} unit" : 'Habis' }}
                    </span>
                </div>

                {{-- Description --}}
                <div class="mt-6">
                    <p class="text-sm text-zinc-700 dark:text-zinc-300 leading-relaxed max-w-2xl">
                        {{ $product->description ?: 'Unit laptop terverifikasi dengan komponen orisinal, garansi resmi distributor, dan pengujian kualitas komprehensif.' }}
                    </p>
                </div>

                {{-- Purchasing Action --}}
                @auth
                    @if(auth()->user()->role !== 'admin' && $product->stock > 0)
                        <form method="POST" action="{{ route('cart.items.store') }}"
                            class="mt-8 flex flex-col sm:flex-row sm:items-end gap-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div>
                                <label for="quantity"
                                    class="mb-1.5 block text-[11px] font-sans uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Jumlah
                                    Unit</label>
                                <input id="quantity" name="quantity" type="number" min="1" max="{{ $product->stock }}" value="1"
                                    class="w-24 rounded-md border-zinc-200 dark:border-zinc-800 bg-zinc-100 dark:bg-zinc-900 px-3 py-2.5 text-center font-sans text-sm text-zinc-900 dark:text-white focus:border-zinc-400 dark:focus:border-zinc-500 focus:ring-1 focus:ring-zinc-400 dark:focus:ring-zinc-500">
                            </div>

                            <div class="flex-1 flex gap-3">
                                <button type="submit" name="action" value="cart"
                                    class="flex-1 rounded-md border border-zinc-300 dark:border-zinc-700 bg-zinc-100 dark:bg-zinc-900 py-3 text-xs font-sans font-bold uppercase tracking-wider text-zinc-900 dark:text-white hover:bg-zinc-200 dark:hover:bg-zinc-800 active:scale-[0.98] transition">
                                    Tambah Keranjang
                                </button>

                                <button type="submit" name="action" value="buy_now"
                                    class="flex-1 rounded-md bg-zinc-900 dark:bg-white py-3 text-xs font-sans font-bold uppercase tracking-wider text-white dark:text-zinc-950 hover:bg-zinc-700 dark:hover:bg-zinc-200 active:scale-[0.98] transition shadow-lg">
                                    Beli Sekarang
                                </button>
                            </div>
                        </form>
                    @endif
                @else
                    <div
                        class="mt-8 p-4 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/40 dark:bg-zinc-900/40 flex items-center justify-between">
                        <span class="text-xs font-sans text-zinc-500 dark:text-zinc-400">Masuk untuk memesan unit ini.</span>
                        <a href="{{ route('login') }}"
                            class="rounded-md bg-zinc-900 dark:bg-white px-5 py-2 text-xs font-sans font-bold uppercase tracking-wider text-white dark:text-zinc-950 hover:bg-zinc-700 dark:hover:bg-zinc-200 transition">
                            Masuk Akun
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        {{-- Specifications Matrix (Clean 2-Column Grid) --}}
        @if($product->specification)
            <div class="mt-20 pt-10 border-t border-zinc-200 dark:border-zinc-800">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <span class="text-xs font-sans uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Technical Data</span>
                        <h2 class="mt-1 text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">Spesifikasi Lengkap</h2>
                    </div>
                </div>

                <div class="grid gap-3 sm:grid-cols-2">
                    @foreach(['brand' => 'Brand / Merek', 'processor' => 'Processor', 'ram' => 'Memori (RAM)', 'storage' => 'Penyimpanan', 'gpu' => 'Kartu Grafis (GPU)', 'display' => 'Layar & Resolusi', 'operating_system' => 'Sistem Operasi', 'weight' => 'Bobot'] as $key => $label)
                        @if($product->specification->$key)
                            <div
                                class="flex items-baseline justify-between rounded-lg border border-zinc-200/80 dark:border-zinc-800/80 bg-zinc-100/30 dark:bg-zinc-900/30 px-4 py-3.5">
                                <span class="text-xs font-sans uppercase text-zinc-400 dark:text-zinc-500 w-36 shrink-0">{{ $label }}</span>
                                <span
                                    class="text-xs font-sans font-semibold text-zinc-800 dark:text-zinc-200 text-right">{{ $product->specification->$key }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Reviews Section --}}
        <div class="mt-20 pt-10 border-t border-zinc-200 dark:border-zinc-800">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <span class="text-xs font-sans uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Feedback</span>
                    <h2 class="mt-1 text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">Ulasan Pembeli
                        ({{ $product->reviewCount() }})</h2>
                </div>
            </div>

            @auth
                <form method="POST" action="{{ route('reviews.store', $product) }}"
                    class="rounded-xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/40 dark:bg-zinc-900/40 p-6 mb-8">
                    @csrf
                    <div class="flex items-center gap-2" x-data="{ rating: {{ old('rating', 5) }} }">
                        <label class="text-xs font-sans uppercase text-zinc-500 dark:text-zinc-400 mr-2">Beri Penilaian:</label>
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button" @click="rating = {{ $i }}" class="text-xl transition hover:scale-110"
                                :class="rating >= {{ $i }} ? 'text-amber-400' : 'text-zinc-300 dark:text-zinc-700'">★</button>
                        @endfor
                        <input type="hidden" name="rating" :value="rating" x-model="rating">
                    </div>
                    <textarea name="comment" rows="3" placeholder="Tuliskan ulasan performa laptop ini..."
                        class="mt-4 w-full rounded-md border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 p-3 text-xs font-sans text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-400 dark:focus:border-zinc-500 focus:ring-1 focus:ring-zinc-400 dark:focus:ring-zinc-500">{{ old('comment') }}</textarea>
                    <button type="submit"
                        class="mt-3 rounded-md bg-zinc-900 dark:bg-white px-5 py-2 text-xs font-sans font-bold uppercase tracking-wider text-white dark:text-zinc-950 hover:bg-zinc-700 dark:hover:bg-zinc-200 transition">
                        Kirim Ulasan
                    </button>
                </form>
            @else
                <p class="text-xs font-sans text-zinc-400 dark:text-zinc-500 mb-6">
                    <a href="{{ route('login') }}" class="text-zinc-900 dark:text-white underline">Masuk ke akun</a> untuk menuliskan ulasan.
                </p>
            @endauth

            <div class="space-y-3">
                @forelse($product->reviews as $review)
                    <div class="rounded-lg border border-zinc-200/80 dark:border-zinc-800/80 bg-zinc-100/20 dark:bg-zinc-900/20 p-4">
                        <div class="flex items-center justify-between text-xs font-sans">
                            <div class="flex items-center gap-2">
                                <span
                                    class="flex h-6 w-6 items-center justify-center rounded bg-zinc-200 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 text-[10px] font-bold">
                                    {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                </span>
                                <span class="font-semibold text-zinc-800 dark:text-zinc-200">{{ $review->user->name }}</span>
                                <div class="flex text-amber-400 text-xs">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="{{ $i <= $review->rating ? '' : 'text-zinc-200 dark:text-zinc-800' }}">★</span>
                                    @endfor
                                </div>
                            </div>
                            <span class="text-zinc-400 dark:text-zinc-500">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        @if($review->comment)
                            <p class="mt-2.5 text-xs text-zinc-700 dark:text-zinc-300 leading-relaxed">{{ $review->comment }}</p>
                        @endif
                    </div>
                @empty
                    <div
                        class="py-10 text-center text-xs font-sans text-zinc-400 dark:text-zinc-500 border border-dashed border-zinc-200 dark:border-zinc-800 rounded-xl">
                        Belum ada ulasan untuk produk ini.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
