@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-zinc-800 dark:text-zinc-100 placeholder-zinc-400 dark:placeholder-zinc-500 focus:border-indigo-500 dark:focus:border-zinc-500 focus:ring-indigo-500 dark:focus:ring-zinc-500 rounded-lg shadow-sm text-sm transition']) }}>