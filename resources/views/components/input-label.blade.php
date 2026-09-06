@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-xs text-zinc-600 dark:text-zinc-400 uppercase tracking-wide']) }}>
    {{ $value ?? $slot }}
</label>