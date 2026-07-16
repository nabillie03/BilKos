<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-semibold text-2xl text-ink">Kamar Tersedia</h2>
        <p class="text-ink-soft text-sm mt-1">Pilih kamar yang cocok, lalu ajukan booking.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-forest-light text-forest rounded-lg text-sm">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse ($rooms as $room)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border-l-4 border-forest hover:shadow-md transition">
                        @if ($room->photo)
                            <img src="{{ Storage::url($room->photo) }}" class="h-40 w-full object-cover">
                        @else
                            <div class="h-40 bg-paper flex items-center justify-center text-ink-soft text-sm">Tanpa foto</div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-display font-semibold text-ink">Kamar {{ $room->room_number }} &middot; {{ $room->type }}</h3>
                            <p class="text-sm text-ink-soft mt-1">{{ Str::limit($room->facilities, 60) }}</p>
                            <p class="text-navy font-semibold mt-2">Rp {{ number_format($room->price, 0, ',', '.') }} <span class="text-xs font-normal text-ink-soft">/ bulan</span></p>
                            <a href="{{ route('bookings.create', $room) }}" class="mt-4 inline-block w-full text-center px-4 py-2.5 bg-gold text-navy-dark rounded-lg text-sm font-semibold hover:bg-gold-dark transition">Booking Sekarang</a>
                        </div>
                    </div>
                @empty
                    <p class="text-ink-soft col-span-full text-center py-10">Tidak ada kamar tersedia saat ini. Coba cek lagi nanti.</p>
                @endforelse
            </div>

            <div class="mt-6">{{ $rooms->links() }}</div>
        </div>
    </div>
</x-app-layout>
