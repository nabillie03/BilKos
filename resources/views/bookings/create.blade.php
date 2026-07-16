<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-semibold text-2xl text-ink">Ajukan Booking</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="font-display font-semibold text-ink mb-1">Kamar {{ $room->room_number }} &middot; {{ $room->type }}</h3>
                <p class="text-navy font-semibold mb-5">Rp {{ number_format($room->price, 0, ',', '.') }} <span class="text-xs font-normal text-ink-soft">/ bulan</span></p>

                <form action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <div>
                        <label class="block text-sm font-medium text-ink">Tanggal Mulai Sewa</label>
                        <input type="date" name="start_date" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-navy focus:ring-navy">
                        @error('start_date') <p class="text-clay text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="px-5 py-2.5 bg-gold text-navy-dark rounded-lg text-sm font-semibold hover:bg-gold-dark transition">Ajukan Booking</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
