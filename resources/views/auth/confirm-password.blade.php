<x-guest-layout>
    <h2 class="text-xl font-extrabold text-zinc-900 dark:text-white mb-1">Konfirmasi Password</h2>
    <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-6">
        {{ __('Ini adalah area aman aplikasi. Silakan konfirmasi password Anda sebelum melanjutkan.') }}
    </p>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1.5 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-primary-button class="w-full justify-center py-2.5">
                {{ __('Konfirmasi') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>