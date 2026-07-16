<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-semibold text-2xl text-ink">Selamat datang kembali, {{ auth()->user()->name }}</h2>
        <p class="text-ink-soft text-sm mt-1">Ringkasan operasional kos hari ini.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-navy p-5">
                    <p class="text-xs uppercase tracking-wide text-ink-soft">Total Kamar</p>
                    <p class="font-display text-3xl font-semibold text-ink mt-1">{{ $totalRooms }}</p>
                    <p class="text-xs text-ink-soft mt-2">{{ $roomsAvailable }} kosong &middot; {{ $roomsFilled }} terisi</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-gold p-5">
                    <p class="text-xs uppercase tracking-wide text-ink-soft">Booking Menunggu</p>
                    <p class="font-display text-3xl font-semibold text-ink mt-1">{{ $pendingBookings }}</p>
                    <p class="text-xs text-ink-soft mt-2">Perlu diverifikasi</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-forest p-5">
                    <p class="text-xs uppercase tracking-wide text-ink-soft">Pendapatan Bulan Ini</p>
                    <p class="font-display text-3xl font-semibold text-forest mt-1">Rp {{ number_format($monthlyIncome, 0, ',', '.') }}</p>
                    <p class="text-xs text-ink-soft mt-2">Dari pembayaran lunas</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-clay p-5">
                    <p class="text-xs uppercase tracking-wide text-ink-soft">Komplain Aktif</p>
                    <p class="font-display text-3xl font-semibold text-clay mt-1">{{ $openComplaints }}</p>
                    <p class="text-xs text-ink-soft mt-2">Belum selesai</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <p class="font-display font-semibold text-ink mb-4">Menu Cepat</p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('rooms.index') }}" class="px-4 py-2.5 bg-navy text-white rounded-lg text-sm font-medium hover:bg-navy-dark transition">Kelola Kamar</a>
                    <a href="{{ route('bookings.index') }}" class="px-4 py-2.5 bg-paper border border-navy/15 text-ink rounded-lg text-sm font-medium hover:bg-navy/5 transition">Kelola Booking</a>
                    <a href="{{ route('payments.index') }}" class="px-4 py-2.5 bg-paper border border-navy/15 text-ink rounded-lg text-sm font-medium hover:bg-navy/5 transition">Verifikasi Pembayaran</a>
                    <a href="{{ route('complaints.index') }}" class="px-4 py-2.5 bg-paper border border-navy/15 text-ink rounded-lg text-sm font-medium hover:bg-navy/5 transition">Tangani Komplain</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
