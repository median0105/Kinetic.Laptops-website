@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-zinc-500 text-start text-base font-medium text-zinc-900 dark:text-white bg-zinc-100 dark:bg-zinc-800 focus:outline-none focus:text-zinc-900 dark:focus:text-white focus:bg-zinc-100 dark:focus:bg-zinc-800 focus:border-zinc-400 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800 hover:border-zinc-300 dark:hover:border-zinc-700 focus:outline-none focus:text-zinc-900 dark:focus:text-white focus:bg-zinc-100 dark:focus:bg-zinc-800 focus:border-zinc-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
