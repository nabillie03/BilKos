{{--
  GANTI ISI file resources/views/layouts/navigation.blade.php kamu dengan ini.
--}}
<nav class="bg-navy">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center gap-2">
                    <span class="text-gold text-xl">&#128273;</span>
                    <span class="font-display font-semibold text-white text-lg tracking-wide">BilKos</span>
                </div>

                <div class="hidden space-x-1 sm:-my-px sm:ml-8 sm:flex">
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition
                              {{ request()->routeIs('dashboard') ? 'bg-navy-light text-white' : 'text-white/70 hover:text-white hover:bg-navy-light' }}">
                        Dashboard
                    </a>

                    @auth
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('rooms.index') }}"
                               class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition
                                      {{ request()->routeIs('rooms.*') ? 'bg-navy-light text-white' : 'text-white/70 hover:text-white hover:bg-navy-light' }}">
                                Kamar
                            </a>
                        @else
                            <a href="{{ route('rooms.catalog') }}"
                               class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition
                                      {{ request()->routeIs('rooms.catalog') ? 'bg-navy-light text-white' : 'text-white/70 hover:text-white hover:bg-navy-light' }}">
                                Cari Kamar
                            </a>
                        @endif

                        <a href="{{ route('bookings.index') }}"
                           class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition
                                  {{ request()->routeIs('bookings.*') ? 'bg-navy-light text-white' : 'text-white/70 hover:text-white hover:bg-navy-light' }}">
                            Booking
                        </a>
                        <a href="{{ route('payments.index') }}"
                           class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition
                                  {{ request()->routeIs('payments.*') ? 'bg-navy-light text-white' : 'text-white/70 hover:text-white hover:bg-navy-light' }}">
                            Pembayaran
                        </a>
                        <a href="{{ route('complaints.index') }}"
                           class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition
                                  {{ request()->routeIs('complaints.*') ? 'bg-navy-light text-white' : 'text-white/70 hover:text-white hover:bg-navy-light' }}">
                            Komplain
                        </a>
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center gap-3">
                @auth
                    <span class="text-white/70 text-sm">{{ auth()->user()->name }}
                        <span class="ml-1 text-[10px] uppercase tracking-wide bg-gold text-navy-dark px-2 py-0.5 rounded-full font-semibold">{{ auth()->user()->role }}</span>
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-white/80 hover:text-gold transition">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>
