<x-app-layout>
    <x-slot name="title">Kelola Pesanan — Admin</x-slot>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-extrabold tracking-tight text-zinc-900 dark:text-white mb-6">Kelola Pesanan</h1>

        @if(session('success'))
            <div class="mb-4 rounded-xl bg-emerald-100 dark:bg-emerald-950/80 border border-emerald-300 dark:border-emerald-800/80 px-4 py-3 text-sm text-emerald-800 dark:text-emerald-300 font-medium">{{ session('success') }}</div>
        @endif

        {{-- Filters --}}
        <div class="mb-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 p-4">
            <form method="GET" class="flex flex-wrap items-end gap-3">
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide mb-1">Cari</label>
                    <input name="search" value="{{ request('search') }}" placeholder="Nomor / nama..."
                           class="w-48 rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:border-zinc-500 focus:ring-zinc-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide mb-1">Status Pesanan</label>
                    <select name="status" class="w-40 rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-sm text-zinc-900 dark:text-white focus:border-zinc-500 focus:ring-zinc-500">
                        <option value="">Semua</option>
                        @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                            <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide mb-1">Status Bayar</label>
                    <select name="payment_status" class="w-40 rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-sm text-zinc-900 dark:text-white focus:border-zinc-500 focus:ring-zinc-500">
                        <option value="">Semua</option>
                        @foreach(['pending', 'paid', 'failed', 'expired'] as $status)
                            <option value="{{ $status }}" @selected(request('payment_status') === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="rounded-lg bg-zinc-900 dark:bg-white px-4 py-2 text-sm font-semibold text-white dark:text-zinc-950 hover:bg-zinc-700 dark:hover:bg-zinc-200 transition">Filter</button>
                <a href="{{ route('admin.orders.index') }}" class="rounded-lg border border-zinc-300 dark:border-zinc-700 px-4 py-2 text-sm font-medium text-zinc-500 dark:text-zinc-400 hover:bg-zinc-100/50 dark:hover:bg-zinc-800 hover:text-zinc-900 dark:hover:text-white transition">Reset</a>
            </form>
        </div>

        <div class="rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-100/60 dark:bg-zinc-900/60 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="border-b border-zinc-200 dark:border-zinc-800">
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Nomor</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Pelanggan</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Total</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Status Bayar</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Status Pesanan</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Tanggal</th>
                            <th class="px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200/80 dark:divide-zinc-800/80">
                        @forelse($orders as $order)
                            <tr class="hover:bg-zinc-100/50 dark:hover:bg-zinc-800/30 transition">
                                <td class="px-6 py-3 font-semibold text-zinc-900 dark:text-white">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="hover:text-zinc-800 dark:hover:text-zinc-200">{{ $order->order_number }}</a>
                                </td>
                                <td class="px-6 py-3 text-sm text-zinc-700 dark:text-zinc-300">{{ $order->user->name ?? '-' }}</td>
                                <td class="px-6 py-3 text-sm font-bold text-zinc-900 dark:text-white">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-3">
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-semibold
                                        {{ match($order->payment_status) {
                                            'paid' => 'bg-emerald-100 text-emerald-800 border border-emerald-300 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-800/60',
                                            'pending' => 'bg-amber-100 text-amber-800 border border-amber-300 dark:bg-amber-950/40 dark:text-amber-300 dark:border-amber-800/60',
                                            'failed' => 'bg-rose-100 text-rose-800 border border-rose-300 dark:bg-rose-950/40 dark:text-rose-300 dark:border-rose-800/60',
                                            'expired' => 'bg-zinc-200 dark:bg-zinc-800 text-zinc-500 dark:text-zinc-400 border border-zinc-300 dark:border-zinc-700',
                                            default => 'bg-zinc-200 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 border border-zinc-300 dark:border-zinc-700',
                                        } }}">{{ ucfirst($order->payment_status) }}</span>
                                </td>
                                <td class="px-6 py-3">
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-semibold
                                        {{ match($order->order_status) {
                                            'pending' => 'bg-amber-100 text-amber-800 border border-amber-300 dark:bg-amber-950/40 dark:text-amber-300 dark:border-amber-800/60',
                                            'processing' => 'bg-blue-100 text-blue-800 border border-blue-300 dark:bg-blue-950/40 dark:text-blue-300 dark:border-blue-800/60',
                                            'shipped' => 'bg-purple-100 text-purple-800 border border-purple-300 dark:bg-purple-950/40 dark:text-purple-300 dark:border-purple-800/60',
                                            'delivered' => 'bg-emerald-100 text-emerald-800 border border-emerald-300 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-800/60',
                                            'cancelled' => 'bg-rose-100 text-rose-800 border border-rose-300 dark:bg-rose-950/40 dark:text-rose-300 dark:border-rose-800/60',
                                            default => 'bg-zinc-200 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 border border-zinc-300 dark:border-zinc-700',
                                        } }}">{{ ucfirst($order->order_status) }}</span>
                                </td>
                                <td class="px-6 py-3 text-sm text-zinc-500 dark:text-zinc-400">{{ $order->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-3">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="rounded-lg bg-zinc-200 dark:bg-zinc-800 px-3 py-1.5 text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-zinc-300 dark:hover:bg-zinc-700 hover:text-zinc-900 dark:hover:text-white transition">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-6 py-8 text-center text-sm text-zinc-400 dark:text-zinc-500">Belum ada pesanan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4">{{ $orders->links() }}</div>
    </div>
</x-app-layout>
