<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-semibold text-2xl text-ink">
            {{ auth()->user()->isAdmin() ? 'Kelola Booking' : 'Booking Saya' }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="px-4 py-3 bg-forest-light text-forest rounded-lg text-sm">{{ session('success') }}</div>
            @endif

            @forelse ($bookings as $booking)
                @php
                    $statusStyle = match($booking->status) {
                        'approved' => ['bg-forest-light', 'text-forest', 'bg-forest'],
                        'rejected' => ['bg-clay-light', 'text-clay', 'bg-clay'],
                        default => ['bg-gold-light', 'text-gold-dark', 'bg-gold'],
                    };
                @endphp
                <div class="bg-white rounded-xl shadow-sm p-5 flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="font-display font-semibold text-ink">Kamar {{ $booking->room->room_number }} &middot; {{ $booking->room->type }}</p>
                        @if (auth()->user()->isAdmin())
                            <p class="text-sm text-ink-soft">Penyewa: {{ $booking->user->name }}</p>
                        @endif
                        <p class="text-sm text-ink-soft">Mulai sewa: {{ $booking->start_date }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium {{ $statusStyle[0] }} {{ $statusStyle[1] }}">
                            <span class="h-1.5 w-1.5 rounded-full {{ $statusStyle[2] }}"></span>
                            {{ ucfirst($booking->status) }}
                        </span>

                        @if (auth()->user()->isAdmin() && $booking->status === 'pending')
                            <form action="{{ route('bookings.approve', $booking) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="text-sm text-forest font-medium hover:underline">Setujui</button>
                            </form>
                            <form action="{{ route('bookings.reject', $booking) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="text-sm text-clay font-medium hover:underline">Tolak</button>
                            </form>
                        @endif
                        @if (!auth()->user()->isAdmin() && $booking->status === 'approved')
                            <a href="{{ route('payments.create', $booking) }}" class="text-sm text-navy font-medium hover:underline">Bayar Sewa</a>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-ink-soft text-center py-10">Belum ada data booking.</p>
            @endforelse

            <div class="mt-4">{{ $bookings->links() }}</div>
        </div>
    </div>
</x-app-layout>
