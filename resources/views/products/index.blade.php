<x-app-layout>
    <x-slot name="title">Katalog Laptop — KINETIC</x-slot>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-3 pb-6 border-b border-zinc-200 dark:border-zinc-800">
            <div>
                <span class="text-xs font-sans uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Hardware Catalog</span>
                <h1 class="mt-1 text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white">Daftar Laptop & Aksesoris</h1>
            </div>
            <p class="text-xs font-sans text-zinc-500 dark:text-zinc-400">
                <span class="text-zinc-900 dark:text-white font-semibold">{{ $products->total() }}</span> unit terdaftar
            </p>
        </div>

        <div class="mt-8 flex flex-col lg:flex-row gap-8">
            {{-- Sidebar Filter --}}
            <aside class="w-full lg:w-64 shrink-0">
                <form method="GET" action="{{ route('products.index') }}" class="space-y-6 lg:sticky lg:top-24">
                    <div class="rounded-xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/40 dark:bg-zinc-900/40 p-5">
                        <div class="flex items-center justify-between pb-3 border-b border-zinc-200 dark:border-zinc-800">
                            <h3 class="text-xs font-sans font-bold uppercase tracking-wider text-zinc-800 dark:text-zinc-200">Filter Unit
                            </h3>
                            @if(request()->anyFilled(['search', 'category', 'brand', 'ram', 'min_price', 'max_price']))
                                <a href="{{ route('products.index') }}"
                                    class="text-[11px] font-sans text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white underline">Reset</a>
                            @endif
                        </div>

                        {{-- Search --}}
                        <div class="mt-4">
                            <label
                                class="block text-[11px] font-sans uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-1.5">Pencarian</label>
                            <input name="search" value="{{ request('search') }}" placeholder="Model atau seri..."
                                class="w-full rounded-md border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 px-3 py-2 text-xs font-sans text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-400 dark:focus:border-zinc-500 focus:ring-1 focus:ring-zinc-400 dark:focus:ring-zinc-500">
                        </div>

                        {{-- Category --}}
                        <div class="mt-4">
                            <label
                                class="block text-[11px] font-sans uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-1.5">Kategori</label>
                            <select name="category"
                                class="w-full rounded-md border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 px-3 py-2 text-xs font-sans text-zinc-900 dark:text-white focus:border-zinc-400 dark:focus:border-zinc-500 focus:ring-1 focus:ring-zinc-400 dark:focus:ring-zinc-500">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->slug }}" @selected(request('category') === $cat->slug)>
                                        {{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Brand --}}
                        <div class="mt-4">
                            <label
                                class="block text-[11px] font-sans uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-1.5">Brand
                                / Prinsipal</label>
                            <select name="brand"
                                class="w-full rounded-md border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 px-3 py-2 text-xs font-sans text-zinc-900 dark:text-white focus:border-zinc-400 dark:focus:border-zinc-500 focus:ring-1 focus:ring-zinc-400 dark:focus:ring-zinc-500">
                                <option value="">Semua Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand }}" @selected(request('brand') === $brand)>{{ $brand }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- RAM --}}
                        <div class="mt-4">
                            <label
                                class="block text-[11px] font-sans uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-1.5">Kapasitas
                                RAM</label>
                            <select name="ram"
                                class="w-full rounded-md border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 px-3 py-2 text-xs font-sans text-zinc-900 dark:text-white focus:border-zinc-400 dark:focus:border-zinc-500 focus:ring-1 focus:ring-zinc-400 dark:focus:ring-zinc-500">
                                <option value="">Semua RAM</option>
                                @foreach($rams as $ram)
                                    <option value="{{ $ram }}" @selected(request('ram') === $ram)>{{ $ram }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Price Range --}}
                        <div class="mt-4">
                            <label
                                class="block text-[11px] font-sans uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-1.5">Rentang
                                Harga (Rp)</label>
                            <div class="flex gap-2">
                                <input name="min_price" value="{{ request('min_price') }}" placeholder="Min"
                                    type="number"
                                    class="w-1/2 rounded-md border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 px-2.5 py-1.5 text-xs font-sans text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-400 dark:focus:border-zinc-500 focus:ring-1 focus:ring-zinc-400 dark:focus:ring-zinc-500">
                                <input name="max_price" value="{{ request('max_price') }}" placeholder="Max"
                                    type="number"
                                    class="w-1/2 rounded-md border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 px-2.5 py-1.5 text-xs font-sans text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-400 dark:focus:border-zinc-500 focus:ring-1 focus:ring-zinc-400 dark:focus:ring-zinc-500">
                            </div>
                        </div>

                        <div class="mt-6 flex gap-2">
                            <button type="submit"
                                class="flex-1 rounded-md bg-zinc-900 dark:bg-white py-2 text-xs font-sans font-bold uppercase tracking-wider text-white dark:text-zinc-950 hover:bg-zinc-700 dark:hover:bg-zinc-200 transition">
                                Terapkan
                            </button>
                            <a href="{{ route('products.index') }}"
                                class="rounded-md border border-zinc-200 dark:border-zinc-800 bg-zinc-100 dark:bg-zinc-900 px-3 py-2 text-xs font-sans text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </aside>

            {{-- Product Grid --}}
            <div class="flex-1">
                <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    @forelse($products as $product)
                        <a href="{{ route('products.show', $product) }}"
                            class="group flex flex-col rounded-xl border border-zinc-200/90 dark:border-zinc-800/90 bg-zinc-100/40 dark:bg-zinc-900/40 p-4 hover:border-zinc-300 dark:hover:border-zinc-700 hover:bg-zinc-100/70 dark:hover:bg-zinc-900/70 transition duration-200 {{ $product->stock <= 0 ? 'opacity-50' : '' }}">

                            {{-- Image Canvas --}}
                            <div
                                class="relative flex aspect-[4/3] w-full items-center justify-center overflow-hidden rounded-lg bg-white dark:bg-zinc-950 p-4 border border-zinc-200/60 dark:border-zinc-800/60">
                                @if($product->thumbnailUrl())
                                    <img src="{{ $product->thumbnailUrl() }}" alt="{{ $product->name }}"
                                        class="max-h-full max-w-full object-contain filter group-hover:scale-105 transition duration-300 {{ $product->stock <= 0 ? 'grayscale' : '' }}">
                                @else
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded bg-zinc-100 dark:bg-zinc-900 text-zinc-400 dark:text-zinc-600 font-sans text-xs">
                                        N/A
                                    </div>
                                @endif

                                @if($product->stock <= 0)
                                    <span
                                        class="absolute top-2.5 left-2.5 rounded bg-rose-950/90 border border-rose-800 px-2 py-0.5 text-[9px] font-sans font-semibold uppercase text-rose-300">Habis</span>
                                @elseif($product->is_featured)
                                    <span
                                        class="absolute top-2.5 left-2.5 rounded bg-zinc-200/90 dark:bg-zinc-800/90 border border-zinc-300 dark:border-zinc-700 px-2 py-0.5 text-[9px] font-sans font-medium text-zinc-700 dark:text-zinc-300">Unggulan</span>
                                @endif
                            </div>

                            {{-- Details --}}
                            <div class="mt-4 flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between text-[11px] font-sans text-zinc-500 dark:text-zinc-400">
                                        <span>{{ $product->category->name }}</span>
                                        @if($product->specification?->brand)
                                            <span class="text-zinc-400 dark:text-zinc-500">{{ $product->specification->brand }}</span>
                                        @endif
                                    </div>

                                    <h3
                                        class="mt-1.5 text-sm font-bold text-zinc-900 dark:text-white tracking-tight group-hover:text-zinc-800 dark:group-hover:text-zinc-200 transition">
                                        {{ $product->name }}
                                    </h3>

                                    @if($product->specification)
                                        <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400 font-sans line-clamp-1">
                                            {{ $product->specification->processor }} · {{ $product->specification->ram }}
                                        </p>
                                    @endif
                                </div>

                                <div class="mt-4 pt-3 border-t border-zinc-200/60 dark:border-zinc-800/60 flex items-baseline justify-between">
                                    <div>
                                        <p class="text-sm font-sans font-bold text-zinc-900 dark:text-white">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}</p>
                                        <p
                                            class="text-[10px] font-sans {{ $product->stock > 0 ? 'text-zinc-500 dark:text-zinc-400' : 'text-rose-400' }}">
                                            {{ $product->stock > 0 ? "Stok: {$product->stock}" : 'Stok habis' }}
                                        </p>
                                    </div>

                                    @if($product->reviewCount() > 0)
                                        <div class="flex items-center gap-1 text-[11px] font-sans text-zinc-500 dark:text-zinc-400">
                                            <svg class="h-3 w-3 fill-amber-400 text-amber-400" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span>{{ $product->averageRating() }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full py-16 text-center rounded-xl border border-dashed border-zinc-200 dark:border-zinc-800">
                            <p class="text-xs font-sans text-zinc-400 dark:text-zinc-500 uppercase tracking-widest">Pencarian Nihil</p>
                            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Tidak ada laptop atau produk yang cocok dengan filter.</p>
                            <a href="{{ route('products.index') }}"
                                class="mt-4 inline-block text-xs font-sans text-zinc-900 dark:text-white underline underline-offset-4">Reset
                                filter</a>
                        </div>
                    @endforelse
                </div>

                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
</x-app-layout>
