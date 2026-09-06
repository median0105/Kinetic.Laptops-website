<x-guest-layout>
    <h2 class="text-xl font-extrabold text-zinc-900 dark:text-white mb-1">Masuk Akun</h2>
    <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-6">Selamat datang kembali di KINETIC.</p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1.5 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-indigo-600 dark:text-zinc-100 shadow-sm focus:ring-indigo-500 dark:focus:ring-zinc-500" name="remember">
                <span class="ms-2 text-sm text-zinc-600 dark:text-zinc-400">{{ __('Ingat Saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-indigo-600 dark:text-zinc-400 hover:text-indigo-700 dark:hover:text-white transition rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-zinc-500 focus:ring-offset-white dark:focus:ring-offset-zinc-900" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div>
            <x-primary-button class="w-full justify-center py-2.5">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>

    <p class="mt-6 text-center text-sm text-zinc-500 dark:text-zinc-400">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-semibold text-indigo-600 dark:text-zinc-300 hover:text-indigo-700 dark:hover:text-white transition">Daftar sekarang</a>
    </p>
</x-guest-layout>