<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-semibold text-2xl text-ink">
            {{ auth()->user()->isAdmin() ? 'Tangani Komplain' : 'Komplain Saya' }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="px-4 py-3 bg-forest-light text-forest rounded-lg text-sm">{{ session('success') }}</div>
            @endif

            @unless (auth()->user()->isAdmin())
                <a href="{{ route('complaints.create') }}" class="inline-block px-4 py-2.5 bg-gold text-navy-dark rounded-lg text-sm font-semibold hover:bg-gold-dark transition">+ Ajukan Komplain</a>
            @endunless

            @forelse ($complaints as $complaint)
                @php
                    $statusStyle = match($complaint->status) {
                        'selesai' => ['bg-forest-light', 'text-forest', 'bg-forest'],
                        'diproses' => ['bg-gold-light', 'text-gold-dark', 'bg-gold'],
                        default => ['bg-navy/10', 'text-navy', 'bg-navy'],
                    };
                @endphp
                <div class="bg-white rounded-xl shadow-sm p-5">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <p class="font-display font-semibold text-ink">{{ $complaint->title }}</p>
                            @if (auth()->user()->isAdmin())
                                <p class="text-sm text-ink-soft">Dari: {{ $complaint->user->name }}</p>
                            @endif
                            <p class="text-sm text-ink-soft mt-1">{{ Str::limit($complaint->description, 100) }}</p>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium shrink-0 {{ $statusStyle[0] }} {{ $statusStyle[1] }}">
                            <span class="h-1.5 w-1.5 rounded-full {{ $statusStyle[2] }}"></span>
                            {{ ucfirst($complaint->status) }}
                        </span>
                    </div>

                    @if (auth()->user()->isAdmin())
                        <form action="{{ route('complaints.updateStatus', $complaint) }}" method="POST" class="flex gap-2 mt-4">
                            @csrf @method('PATCH')
                            <select name="status" class="text-xs rounded-lg border-gray-300 focus:border-navy focus:ring-navy">
                                <option value="open" @selected($complaint->status === 'open')>Open</option>
                                <option value="diproses" @selected($complaint->status === 'diproses')>Diproses</option>
                                <option value="selesai" @selected($complaint->status === 'selesai')>Selesai</option>
                            </select>
                            <button class="text-navy text-xs font-medium hover:underline">Update Status</button>
                        </form>
                    @endif
                </div>
            @empty
                <p class="text-ink-soft text-center py-10">Belum ada komplain.</p>
            @endforelse

            <div class="mt-4">{{ $complaints->links() }}</div>
        </div>
    </div>
</x-app-layout>
