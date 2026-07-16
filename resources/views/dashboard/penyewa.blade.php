<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-semibold text-2xl text-ink">Halo, {{ auth()->user()->name }}</h2>
        <p class="text-ink-soft text-sm mt-1">Begini status kamar dan tagihanmu.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-navy p-5">
                    <p class="text-xs uppercase tracking-wide text-ink-soft">Booking Saya</p>
                    <p class="font-display text-3xl font-semibold text-ink mt-1">{{ $myBookings }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-gold p-5">
                    <p class="text-xs uppercase tracking-wide text-ink-soft">Menunggu Verifikasi Bayar</p>
                    <p class="font-display text-3xl font-semibold text-ink mt-1">{{ $myPendingPayments }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-clay p-5">
                    <p class="text-xs uppercase tracking-wide text-ink-soft">Komplain Saya</p>
                    <p class="font-display text-3xl font-semibold text-ink mt-1">{{ $myComplaints }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <p class="font-display font-semibold text-ink mb-4">Menu Cepat</p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('rooms.catalog') }}" class="px-4 py-2.5 bg-gold text-navy-dark rounded-lg text-sm font-semibold hover:bg-gold-dark transition">Cari Kamar</a>
                    <a href="{{ route('bookings.index') }}" class="px-4 py-2.5 bg-paper border border-navy/15 text-ink rounded-lg text-sm font-medium hover:bg-navy/5 transition">Booking Saya</a>
                    <a href="{{ route('payments.index') }}" class="px-4 py-2.5 bg-paper border border-navy/15 text-ink rounded-lg text-sm font-medium hover:bg-navy/5 transition">Pembayaran Saya</a>
                    <a href="{{ route('complaints.create') }}" class="px-4 py-2.5 bg-paper border border-navy/15 text-ink rounded-lg text-sm font-medium hover:bg-navy/5 transition">Ajukan Komplain</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
