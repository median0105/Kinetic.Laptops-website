<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'KINETIC — Masuk / Daftar' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
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
<body x-data="{ theme: document.documentElement.classList.contains('dark') ? 'dark' : 'light' }"
    class="font-sans antialiased">
    <button @click="theme = theme === 'dark' ? 'light' : 'dark'; localStorage.setItem('theme', theme); document.documentElement.classList.toggle('dark', theme === 'dark')"
        class="fixed top-4 right-4 z-50 p-2.5 rounded-full border border-zinc-200 dark:border-zinc-800 bg-white/80 dark:bg-zinc-900/80 text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white shadow-sm backdrop-blur transition"
        x-cloak>
        <svg x-show="theme === 'dark'" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        <svg x-show="theme === 'light'" x-cloak class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
        </svg>
    </button>
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10 relative overflow-hidden bg-zinc-50 dark:bg-zinc-950 transition-colors">
        <div class="pointer-events-none absolute -top-40 -left-40 h-96 w-96 rounded-full bg-indigo-200/40 dark:bg-indigo-900/20 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-40 -right-40 h-96 w-96 rounded-full bg-emerald-200/40 dark:bg-emerald-900/20 blur-3xl"></div>
        <div class="pointer-events-none absolute top-1/3 right-1/4 h-64 w-64 rounded-full bg-sky-200/30 dark:bg-sky-900/10 blur-3xl"></div>

        <a href="/" class="relative flex items-center gap-2.5 mb-8 group">
            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-zinc-900 dark:bg-white text-white dark:text-zinc-950 font-sans text-sm font-black tracking-tight shadow-lg shadow-zinc-900/10 dark:shadow-black/40 group-hover:scale-105 transition">K</span>
            <span class="text-xl font-extrabold text-zinc-900 dark:text-white tracking-tight">KINETIC<span class="text-zinc-400 dark:text-zinc-500">.LAPTOPS</span></span>
        </a>

        <div class="relative w-full max-w-md">
            <div class="rounded-2xl border border-zinc-200/80 dark:border-zinc-800 bg-white/90 dark:bg-zinc-900/70 p-8 shadow-xl shadow-zinc-900/5 dark:shadow-black/40 backdrop-blur-sm transition-colors">
                {{ $slot }}
            </div>
            <p class="mt-6 text-center text-xs text-zinc-400 dark:text-zinc-600">Kurasi laptop resmi dengan garansi distributor.</p>
        </div>
    </div>
</body>
</html>