<!-- Sidebar -->
<aside class="z-10 flex flex-col hidden w-64 h-screen bg-white border-r border-gray-200 lg:block">
    <div class="flex items-center gap-2 px-6 py-[19px] border-b">
        <svg class="w-8 h-8 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
            </path>
        </svg>
        <span class="text-xl font-semibold text-gray-800">LaundryPro</span>
    </div>

    <nav class="flex-grow p-4 space-y-2">
        <div class="text-xs font-semibold text-gray-400 uppercase">Menu</div>
        <x-side-link href="{{ route('beranda') }}" :active="request()->is('beranda')">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
            Beranda
        </x-side-link>
        @if (Auth()->user()->role == 'admin' || Auth()->user()->role == 'kasir' || Auth()->user()->role == 'super_admin')
            <x-side-parent-link href="#" id="toggle-data" :active="request()->is('data-outlet') ||
                request()->is('data-paket') ||
                request()->is('data-pengguna') ||
                request()->is('data-member')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
                Data Utama
                <svg id="icon-data"
                    class="ml-[62px] w-4 h-4 transition-transform transform {{ request()->is('data-outlet') || request()->is('data-paket') ? 'rotate-90' : 'rotate-0' }}"
                    viewBox="0 0 24 24" fill="none">
                    <path d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
            </x-side-parent-link>

            <div id="sub-links-data"
                class="pl-0 {{ request()->is('data-outlet') ||
                request()->is('data-paket') ||
                request()->is('data-pengguna') ||
                request()->is('data-member')
                    ? ''
                    : 'hidden' }}">
                @if (Auth()->user()->role == 'admin' || Auth()->user()->role == 'super_admin')
                    <a href="{{ route('outlet') }}"
                        class="flex items-center w-full px-12 py-2 text-sm font-normal text-gray-600 rounded-lg hover:bg-sky-500 hover:text-white">Data
                        Outlet</a>
                    <a href="{{ route('paket') }}"
                        class="flex items-center w-full px-12 py-2 text-sm font-normal text-gray-600 rounded-lg hover:bg-sky-500 hover:text-white">Data
                        Paket</a>
                    <a href="{{ route('kelolapengguna') }}"
                        class="flex items-center w-full px-12 py-2 text-sm font-normal text-gray-600 rounded-lg hover:bg-sky-500 hover:text-white">Data
                        Pengguna</a>
                @endif
                <a href="{{ route('member') }}"
                    class="flex items-center w-full px-12 py-2 text-sm font-normal text-gray-600 rounded-lg hover:bg-sky-500 hover:text-white">Data
                    Member</a>
            </div>
            @if (Auth()->user()->role == 'admin' || Auth()->user()->role == 'super_admin')
                <x-side-link href="{{ route('log') }}" :active="request()->is('log*')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4h16v16H4V4zm4 4h8M8 12h8M8 16h4" />
                    </svg>
                    Log Aktifitas
                </x-side-link>
            @endif

            <x-side-link href="{{ route('transaksi') }}" :active="request()->is('transaksi*') || request()->is('transaksi/form')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                    </path>
                </svg>
                Transaksi Laundry
            </x-side-link>
        @endif
        <x-side-link href="{{ route('laporan') }}" :active="request()->is('laporan*')">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 4h16v16H4V4zm4 4h8M8 12h8M8 16h4" />
            </svg>
            @if (Auth()->user()->role == 'super_admin' || Auth()->user()->role == 'admin' || Auth()->user()->role == 'kasir')
                Laporan dan Transaksi
            @elseif (Auth()->user()->role == 'owner' || Auth()->user()->role == 'super_owner')
                Laporan
            @endif

        </x-side-link>
    </nav>

    <div class="p-4 mt-auto">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center w-full gap-2 px-4 py-3 text-sm font-medium text-gray-600 transition duration-150 ease-in-out rounded-lg hover:bg-gray-50 hover:text-gray-900">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
                Keluar
            </button>
        </form>
    </div>
</aside>
