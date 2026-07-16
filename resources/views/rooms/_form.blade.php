@php $room = $room ?? null; @endphp

<div>
    <label class="block text-sm font-medium text-ink">Nomor Kamar</label>
    <input type="text" name="room_number" value="{{ old('room_number', $room?->room_number) }}"
        class="mt-1 block w-full rounded-lg border-gray-300 focus:border-navy focus:ring-navy">
    @error('room_number') <p class="text-clay text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-ink">Tipe Kamar</label>
    <input type="text" name="type" value="{{ old('type', $room?->type) }}"
        class="mt-1 block w-full rounded-lg border-gray-300 focus:border-navy focus:ring-navy" placeholder="Standar / VIP / Deluxe">
    @error('type') <p class="text-clay text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-ink">Harga per Bulan (Rp)</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $room?->price) }}"
        class="mt-1 block w-full rounded-lg border-gray-300 focus:border-navy focus:ring-navy">
    @error('price') <p class="text-clay text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-ink">Fasilitas</label>
    <textarea name="facilities" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-navy focus:ring-navy">{{ old('facilities', $room?->facilities) }}</textarea>
    @error('facilities') <p class="text-clay text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-ink">Foto Kamar</label>
    <input type="file" name="photo" class="mt-1 block w-full text-sm">
    @if ($room?->photo)
        <img src="{{ Storage::url($room->photo) }}" class="mt-2 h-24 rounded-lg">
    @endif
    @error('photo') <p class="text-clay text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-ink">Status</label>
    <select name="status" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-navy focus:ring-navy">
        <option value="tersedia" @selected(old('status', $room?->status) === 'tersedia')>Tersedia</option>
        <option value="terisi" @selected(old('status', $room?->status) === 'terisi')>Terisi</option>
    </select>
    @error('status') <p class="text-clay text-xs mt-1">{{ $message }}</p> @enderror
</div>
