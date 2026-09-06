<x-app-layout>
    <x-slot name="title">Profil — KINETIC</x-slot>

    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-extrabold tracking-tight text-zinc-900 dark:text-white mb-6">Profil Saya</h1>

        <div class="space-y-6">
            <div class="rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-6">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
