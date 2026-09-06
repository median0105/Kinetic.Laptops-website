<nav x-data="{ mobileOpen: false, theme: document.documentElement.classList.contains('dark') ? 'dark' : 'light' }"
    class="bg-white/80 dark:bg-zinc-950/80 backdrop-blur-md border-b border-zinc-200 dark:border-zinc-800/80 sticky top-0 z-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="/" class="flex items-center gap-2.5 group">
                    <span
                        class="flex h-7 w-7 items-center justify-center rounded bg-zinc-900 dark:bg-white text-white dark:text-zinc-950 font-sans text-xs font-black tracking-tight group-hover:bg-zinc-700 dark:group-hover:bg-zinc-200 transition">K</span>
                    <span class="font-sans text-sm font-bold tracking-tight text-zinc-900 dark:text-white uppercase">KINETIC<span
                            class="text-zinc-400 dark:text-zinc-500">.LAPTOPS</span></span>
                </a>
                <div class="hidden md:flex items-center gap-1">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="px-3 py-1.5 rounded-md text-xs font-medium uppercase tracking-wider {{ request()->routeIs('admin.dashboard') ? 'bg-zinc-200 dark:bg-zinc-800 text-zinc-900 dark:text-white' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-900' }} transition">
                                Dashboard
                            </a>
                            <a href="{{ route('admin.products.index') }}"
                                class="px-3 py-1.5 rounded-md text-xs font-medium uppercase tracking-wider {{ request()->routeIs('admin.products.*') ? 'bg-zinc-200 dark:bg-zinc-800 text-zinc-900 dark:text-white' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-900' }} transition">
                                Produk
                            </a>
                            <a href="{{ route('admin.categories.index') }}"
                                class="px-3 py-1.5 rounded-md text-xs font-medium uppercase tracking-wider {{ request()->routeIs('admin.categories.*') ? 'bg-zinc-200 dark:bg-zinc-800 text-zinc-900 dark:text-white' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-900' }} transition">
                                Kategori
                            </a>
                            <a href="{{ route('admin.orders.index') }}"
                                class="px-3 py-1.5 rounded-md text-xs font-medium uppercase tracking-wider {{ request()->routeIs('admin.orders.*') ? 'bg-zinc-200 dark:bg-zinc-800 text-zinc-900 dark:text-white' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-900' }} transition">
                                Pesanan
                            </a>
                        @else
                            <a href="{{ route('products.index') }}"
                                class="px-3 py-1.5 rounded-md text-xs font-medium uppercase tracking-wider {{ request()->routeIs('products.*') ? 'bg-zinc-200 dark:bg-zinc-800 text-zinc-900 dark:text-white' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-900' }} transition">
                                Katalog
                            </a>
                            <a href="{{ route('cart.index') }}"
                                class="relative flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-medium uppercase tracking-wider {{ request()->routeIs('cart.*') ? 'bg-zinc-200 dark:bg-zinc-800 text-zinc-900 dark:text-white' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-900' }} transition">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <span>Keranjang</span>
                                @php
                                    $cartCount = \App\Models\Cart::where('user_id', auth()->id())->withCount('items')->first()?->items_count ?? 0;
                                @endphp
                                @if($cartCount > 0)
                                    <span
                                        class="flex h-4 min-w-[1rem] items-center justify-center rounded-full bg-zinc-900 dark:bg-white px-1 text-[10px] font-sans font-bold text-white dark:text-zinc-950">{{ $cartCount }}</span>
                                @endif
                            </a>
                            <a href="{{ route('orders.index') }}"
                                class="px-3 py-1.5 rounded-md text-xs font-medium uppercase tracking-wider {{ request()->routeIs('orders.*') ? 'bg-zinc-200 dark:bg-zinc-800 text-zinc-900 dark:text-white' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-900' }} transition">
                                Pesanan
                            </a>
                        @endif
                    @else
                    <a href="{{ route('products.index') }}"
                        class="px-3 py-1.5 rounded-md text-xs font-medium uppercase tracking-wider {{ request()->routeIs('products.*') ? 'bg-zinc-200 dark:bg-zinc-800 text-zinc-900 dark:text-white' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-900' }} transition">
                        Katalog Laptop
                    </a>
                    @endguest
                </div>
            </div>

            <div class="hidden md:flex items-center gap-3">
                <button @click="theme = theme === 'dark' ? 'light' : 'dark'; localStorage.setItem('theme', theme); document.documentElement.classList.toggle('dark', theme === 'dark')"
                    class="p-2 rounded-md text-zinc-400 dark:text-zinc-500 hover:bg-zinc-100 dark:hover:bg-zinc-900 hover:text-zinc-700 dark:hover:text-zinc-300 transition">
                    <svg x-show="theme === 'dark'" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg x-show="theme === 'light'" x-cloak class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
                @guest
                    <a href="{{ route('login') }}"
                        class="px-3 py-1.5 text-xs font-sans uppercase tracking-wider text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="px-3.5 py-1.5 rounded-md bg-zinc-900 dark:bg-white text-xs font-sans font-semibold uppercase tracking-wider text-white dark:text-zinc-950 hover:bg-zinc-700 dark:hover:bg-zinc-200 transition shadow-sm">Daftar</a>
                @else
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center gap-2 rounded-md border border-zinc-200 dark:border-zinc-800 bg-zinc-100 dark:bg-zinc-900/60 px-3 py-1.5 text-xs font-medium text-zinc-700 dark:text-zinc-300 hover:border-zinc-300 dark:hover:border-zinc-700 hover:text-zinc-900 dark:hover:text-white transition">
                                <span
                                    class="flex h-5 w-5 items-center justify-center rounded bg-zinc-200 dark:bg-zinc-800 font-sans text-[10px] text-zinc-700 dark:text-zinc-300">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="h-3 w-3 text-zinc-400 dark:text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="px-3 py-2 border-b border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-900">
                                <p class="text-[10px] font-sans uppercase text-zinc-400 dark:text-zinc-500">Akun Terdaftar</p>
                                <p class="text-xs font-medium text-zinc-700 dark:text-zinc-200 truncate">{{ Auth::user()->email }}</p>
                                @if(auth()->user()->role === 'admin')
                                    <span
                                        class="inline-block mt-1 rounded bg-zinc-200 dark:bg-zinc-800 px-1.5 py-0.5 text-[9px] font-sans font-semibold text-zinc-700 dark:text-zinc-300">ADMINISTRATOR</span>
                                @endif
                            </div>
                            @if(auth()->user()->role === 'admin')
                                <x-dropdown-link :href="route('admin.dashboard')"
                                    class="text-xs text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800">Admin Panel</x-dropdown-link>
                            @endif
                            <x-dropdown-link :href="route('profile.edit')"
                                class="text-xs text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800">Profil</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-xs text-rose-600 dark:text-rose-400 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                                    Keluar
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endguest
            </div>

            <div class="flex items-center gap-3 md:hidden">
                <button @click="theme = theme === 'dark' ? 'light' : 'dark'; localStorage.setItem('theme', theme); document.documentElement.classList.toggle('dark', theme === 'dark')"
                    class="p-2 rounded-md text-zinc-400 dark:text-zinc-500 hover:bg-zinc-100 dark:hover:bg-zinc-900 hover:text-zinc-700 dark:hover:text-zinc-300 transition">
                    <svg x-show="theme === 'dark'" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg x-show="theme === 'light'" x-cloak class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
                <button @click="mobileOpen = !mobileOpen"
                    class="p-2 rounded-md text-zinc-400 dark:text-zinc-500 hover:bg-zinc-100 dark:hover:bg-zinc-900 hover:text-zinc-700 dark:hover:text-zinc-300">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileOpen" x-cloak x-transition
        class="md:hidden border-t border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 px-4 py-3 space-y-1">
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-3 py-2 rounded-md text-xs font-sans uppercase text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-900">Dashboard</a>
                <a href="{{ route('admin.products.index') }}"
                    class="block px-3 py-2 rounded-md text-xs font-sans uppercase text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-900">Produk</a>
                <a href="{{ route('admin.categories.index') }}"
                    class="block px-3 py-2 rounded-md text-xs font-sans uppercase text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-900">Kategori</a>
                <a href="{{ route('admin.orders.index') }}"
                    class="block px-3 py-2 rounded-md text-xs font-sans uppercase text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-900">Pesanan</a>
            @else
                <a href="{{ route('products.index') }}"
                    class="block px-3 py-2 rounded-md text-xs font-sans uppercase text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-900">Katalog</a>
                <a href="{{ route('cart.index') }}"
                    class="block px-3 py-2 rounded-md text-xs font-sans uppercase text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-900">Keranjang</a>
                <a href="{{ route('orders.index') }}"
                    class="block px-3 py-2 rounded-md text-xs font-sans uppercase text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-900">Pesanan</a>
            @endif
            <a href="{{ route('profile.edit') }}"
                class="block px-3 py-2 rounded-md text-xs font-sans uppercase text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-900">Profil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left px-3 py-2 rounded-md text-xs font-sans uppercase text-rose-600 dark:text-rose-400 hover:bg-zinc-100 dark:hover:bg-zinc-900">Keluar</button>
            </form>
        @else
        <a href="{{ route('products.index') }}"
            class="block px-3 py-2 rounded-md text-xs font-sans uppercase text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-900">Katalog</a>
        <a href="{{ route('login') }}"
            class="block px-3 py-2 rounded-md text-xs font-sans uppercase text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-900">Masuk</a>
        <a href="{{ route('register') }}"
            class="block px-3 py-2 rounded-md text-xs font-sans uppercase text-white dark:text-white bg-zinc-900 dark:bg-zinc-800 hover:bg-zinc-700 dark:hover:bg-zinc-700">Daftar</a>
        @endguest
    </div>
</nav>
