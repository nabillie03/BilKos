<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-semibold text-2xl text-ink">Kelola Kamar</h2>
        <p class="text-ink-soft text-sm mt-1">Semua unit kamar kos dalam satu tempat.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-forest-light text-forest rounded-lg text-sm">{{ session('success') }}</div>
            @endif

            <a href="{{ route('rooms.create') }}" class="inline-block mb-6 px-4 py-2.5 bg-gold text-navy-dark rounded-lg text-sm font-semibold hover:bg-gold-dark transition">+ Tambah Kamar</a>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse ($rooms as $room)
                    @php $isFilled = $room->status === 'terisi'; @endphp
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border-l-4 {{ $isFilled ? 'border-clay' : 'border-forest' }}">
                        @if ($room->photo)
                            <img src="{{ Storage::url($room->photo) }}" class="h-36 w-full object-cover">
                        @else
                            <div class="h-36 bg-paper flex items-center justify-center text-ink-soft text-sm">Tanpa foto</div>
                        @endif
                        <div class="p-4">
                            <div class="flex items-center justify-between">
                                <h3 class="font-display font-semibold text-ink">Kamar {{ $room->room_number }}</h3>
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium {{ $isFilled ? 'bg-clay-light text-clay' : 'bg-forest-light text-forest' }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $isFilled ? 'bg-clay' : 'bg-forest' }}"></span>
                                    {{ ucfirst($room->status) }}
                                </span>
                            </div>
                            <p class="text-sm text-ink-soft mt-1">{{ $room->type }}</p>
                            <p class="text-navy font-semibold mt-2">Rp {{ number_format($room->price, 0, ',', '.') }} <span class="text-xs font-normal text-ink-soft">/ bulan</span></p>
                            <div class="mt-4 flex gap-3 text-sm">
                                <a href="{{ route('rooms.edit', $room) }}" class="text-navy font-medium hover:underline">Edit</a>
                                <form action="{{ route('rooms.destroy', $room) }}" method="POST" onsubmit="return confirm('Hapus kamar ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-clay font-medium hover:underline">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-ink-soft col-span-full text-center py-10">Belum ada data kamar. Klik "Tambah Kamar" untuk mulai.</p>
                @endforelse
            </div>

            <div class="mt-6">{{ $rooms->links() }}</div>
        </div>
    </div>
</x-app-layout>
