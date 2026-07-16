<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-semibold text-2xl text-ink">Ajukan Komplain</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('complaints.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow-sm space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-ink">Kamar Terkait (opsional)</label>
                    <select name="room_id" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-navy focus:ring-navy">
                        <option value="">-- Pilih Kamar --</option>
                        @foreach (\App\Models\Room::all() as $room)
                            <option value="{{ $room->id }}">{{ $room->room_number }} &middot; {{ $room->type }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-ink">Judul Komplain</label>
                    <input type="text" name="title" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-navy focus:ring-navy">
                    @error('title') <p class="text-clay text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-ink">Deskripsi</label>
                    <textarea name="description" rows="4" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-navy focus:ring-navy"></textarea>
                    @error('description') <p class="text-clay text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="px-5 py-2.5 bg-navy text-white rounded-lg text-sm font-medium hover:bg-navy-dark transition">Kirim Komplain</button>
            </form>
        </div>
    </div>
</x-app-layout>
