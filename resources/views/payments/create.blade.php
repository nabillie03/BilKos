<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-semibold text-2xl text-ink">Upload Bukti Pembayaran</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <p class="mb-5 text-sm text-ink-soft">Kamar {{ $booking->room->room_number }} &middot; Rp {{ number_format($booking->room->price, 0, ',', '.') }} / bulan</p>

                <form action="{{ route('payments.store', $booking) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-ink">Jumlah Dibayar (Rp)</label>
                        <input type="number" step="0.01" name="amount" value="{{ $booking->room->price }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-navy focus:ring-navy">
                        @error('amount') <p class="text-clay text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ink">Periode Bulan</label>
                        <input type="text" name="payment_month" placeholder="Contoh: Agustus 2026" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-navy focus:ring-navy">
                        @error('payment_month') <p class="text-clay text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ink">Bukti Transfer</label>
                        <input type="file" name="proof" class="mt-1 block w-full text-sm">
                        @error('proof') <p class="text-clay text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="px-5 py-2.5 bg-gold text-navy-dark rounded-lg text-sm font-semibold hover:bg-gold-dark transition">Kirim Bukti Bayar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
