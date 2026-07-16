<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-semibold text-2xl text-ink">
            {{ auth()->user()->isAdmin() ? 'Verifikasi Pembayaran' : 'Pembayaran Saya' }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="px-4 py-3 bg-forest-light text-forest rounded-lg text-sm">{{ session('success') }}</div>
            @endif

            @forelse ($payments as $payment)
                @php
                    $statusStyle = match($payment->status) {
                        'lunas' => ['bg-forest-light', 'text-forest', 'bg-forest'],
                        'ditolak' => ['bg-clay-light', 'text-clay', 'bg-clay'],
                        default => ['bg-gold-light', 'text-gold-dark', 'bg-gold'],
                    };
                @endphp
                <div class="bg-white rounded-xl shadow-sm p-5 flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="font-display font-semibold text-ink">Kamar {{ $payment->booking->room->room_number }} &middot; {{ $payment->payment_month }}</p>
                        @if (auth()->user()->isAdmin())
                            <p class="text-sm text-ink-soft">Penyewa: {{ $payment->booking->user->name }}</p>
                        @endif
                        <p class="text-sm text-ink-soft">Rp {{ number_format($payment->amount, 0, ',', '.') }} &middot;
                            <a href="{{ Storage::url($payment->proof) }}" target="_blank" class="text-navy hover:underline">Lihat bukti transfer</a>
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium {{ $statusStyle[0] }} {{ $statusStyle[1] }}">
                            <span class="h-1.5 w-1.5 rounded-full {{ $statusStyle[2] }}"></span>
                            {{ ucfirst($payment->status) }}
                        </span>

                        @if (auth()->user()->isAdmin() && $payment->status === 'menunggu')
                            <form action="{{ route('payments.verify', $payment) }}" method="POST">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="lunas">
                                <button class="text-sm text-forest font-medium hover:underline">Verifikasi Lunas</button>
                            </form>
                            <form action="{{ route('payments.verify', $payment) }}" method="POST">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="ditolak">
                                <button class="text-sm text-clay font-medium hover:underline">Tolak</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-ink-soft text-center py-10">Belum ada data pembayaran.</p>
            @endforelse

            <div class="mt-4">{{ $payments->links() }}</div>
        </div>
    </div>
</x-app-layout>
