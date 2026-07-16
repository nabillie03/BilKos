<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-semibold text-2xl text-ink">Tambah Kamar</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm space-y-4">
                @csrf
                @include('rooms._form')
                <button type="submit" class="px-5 py-2.5 bg-navy text-white rounded-lg text-sm font-medium hover:bg-navy-dark transition">Simpan Kamar</button>
            </form>
        </div>
    </div>
</x-app-layout>
