<x-guest-layout>
    <h2 class="text-xl font-extrabold text-zinc-900 dark:text-white mb-1">Verifikasi Email</h2>
    <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-6">
        {{ __('Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan. Jika tidak menerima email, kami akan dengan senang hati mengirimkan lagi.') }}
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-emerald-600 dark:text-emerald-400">
            {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm font-medium text-indigo-600 dark:text-zinc-300 hover:text-indigo-700 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-zinc-500 focus:ring-offset-white dark:focus:ring-offset-zinc-900 transition">
                {{ __('Keluar') }}
            </button>
        </form>
    </div>
</x-guest-layout>