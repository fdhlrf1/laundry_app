<x-layout>
    <div class="py-2 bg-white shadow-[0_1px_3px_rgba(0,0,0,0.15)]">
        <div class="container px-4 mx-auto">
            <div class="flex items-center justify-between">
                <h1 class="text-lg font-bold text-gray-800 uppercase">{{ $title }}</h1>
            </div>
        </div>
    </div>
    <div class="p-6">

        <!-- Stats -->
        <div
            class="grid grid-cols-1 gap-6 mb-6 {{ Auth()->user()->role === 'super_admin' || Auth()->user()->role == 'super_owner' ? 'sm:grind-cols-2 lg:grid-cols-2' : 'sm:grid-cols-0 lg:grid-cols-1' }} ">
            @if (Auth()->user()->role == 'super_admin' || Auth()->user()->role == 'super_owner')
                <div class="p-6 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-sky-100">
                            <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-600">Total Pendapatan (Semua Outlet)</h2>
                            <p class="text-2xl font-semibold text-gray-900">Rp
                                {{ number_format($FADHIL_totalPendapatan, 0, ',', '.') }}</p>
                            <p class="mt-1 text-sm text-green-600">+{{ $FADHIL_persentaseKenaikanTransaksi }}% dari
                                bulan
                                lalu</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="p-6 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-sky-100">
                            <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-600">Total Pendapatan</h2>
                            <p class="text-2xl font-semibold text-gray-900">Rp
                                {{ number_format($FADHIL_totalPendapatan, 0, ',', '.') }}</p>
                            <p class="mt-1 text-sm text-green-600">+{{ $FADHIL_persentaseKenaikanTransaksi }}% dari
                                bulan
                                lalu
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if (Auth()->user()->role == 'super_admin' || Auth()->user()->role == 'super_owner')
                <div class="p-6 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-sky-100">
                            <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-600">Total Pesanan (Semua Outlet)</h2>
                            <p class="text-2xl font-semibold text-gray-900">{{ $FADHIL_totalPesanan }}</p>
                            <p class="mt-1 text-sm text-green-600">+{{ $FADHIL_persentaseKenaikanPesanan }}% dari bulan
                                lalu
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="p-6 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-sky-100">
                            <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-600">Total Pesanan</h2>
                            <p class="text-2xl font-semibold text-gray-900">{{ $FADHIL_totalPesanan }}</p>
                            <p class="mt-1 text-sm text-green-600">+{{ $FADHIL_persentaseKenaikanPesanan }}% dari bulan
                                lalu
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if (Auth()->user()->role == 'super_admin' || Auth()->user()->role == 'super_owner')
                <div class="p-6 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-sky-100">
                            <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-600">Total Member</h2>
                            <p class="text-2xl font-semibold text-gray-900">{{ $FADHIL_totalMember }}</p>
                            <p class="mt-1 text-sm text-green-600">Ada {{ $FADHIL_totalMember }} member yang aktif</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (Auth()->user()->role == 'super_admin' || Auth()->user()->role == 'super_owner')
                <div class="p-6 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-sky-100">
                            <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-600">Outlet Aktif</h2>
                            <p class="text-2xl font-semibold text-gray-900">{{ $FADHIL_outletAktif }}</p>
                            <p class="mt-1 text-sm text-green-500">Ada {{ $FADHIL_outletAktif }} outlet yang aktif</p>
                        </div>
                    </div>
                </div>
        </div>
        @endif

        @if (Auth()->user()->role == 'super_admin' ||
                Auth()->user()->role == 'super_owner' ||
                Auth()->user()->role == 'admin' ||
                Auth()->user()->role == 'owner')
            <div class="flex gap-4">
                <div class="w-1/2 p-6 mb-4 bg-white rounded shadow">
                    {!! $FADHIL_laporanChart->container() !!}
                </div>

                <div class="w-1/2 p-6 mb-4 bg-white rounded shadow">
                    {!! $FADHIL_pesananChart->container() !!}</p>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Transaksi Terbaru</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left bg-gray-50">
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Kode
                                Invoice
                            </th>
                            @if (Auth()->user()->role === 'super_admin' || Auth()->user()->role === 'super_owner')
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">
                                    Outlet
                                </th>
                            @endif
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">
                                Pelanggan</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">
                                Paket</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">
                                Total</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">
                                Status</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">
                                Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($FADHIL_transaksiTerbaru as $FADHIL_data)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $FADHIL_data->kode_invoice }}</td>
                                @if (Auth()->user()->role === 'super_admin' || Auth()->user()->role === 'super_owner')
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        @foreach ($FADHIL_data->detailTransaksi as $FADHIL_detail)
                                            {{ $FADHIL_detail->paket->outlet->nama }}<br>
                                        @endforeach
                                    </td>
                                @endif

                                <td class="px-6 py-4 text-sm text-gray-900">{{ $FADHIL_data->nama_pelanggan }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    @foreach ($FADHIL_data->detailTransaksi as $FADHIL_detail)
                                        {{ $FADHIL_detail->paket->nama_paket }}<br>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    Rp {{ number_format($FADHIL_data->total, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    @if ($FADHIL_data->status === 'baru')
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">
                                            Baru - Transaksi Dibuat</span>
                                    @elseif ($FADHIL_data->status === 'proses')
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">
                                            Proses - Sedang Dicuci</span>
                                    @elseif ($FADHIL_data->status === 'selesai')
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                            Selesai - Siap Diambil</span>
                                    @elseif ($FADHIL_data->status === 'diambil')
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-gray-800 bg-gray-100 rounded-full">
                                            Diambil - Telah Diterima</span>
                                    @endif

                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($FADHIL_data->tgl)->format('d-M-y') }}</td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="px-0 py-0 text-center bg-red-100">
                                    <div class="px-3 py-4 text-red-700 bg-red-100 border border-red-400 rounded-sm">
                                        Data Transaksi terbaru belum Tersedia.
                                    </div>
                                </td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>

        @if (Auth()->user()->role == 'super_admin' || Auth()->user()->role == 'super_owner')
            <div class="mt-4 bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Ikhtisar Outlet</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left bg-gray-50">
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">
                                    Nama Outlet</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">
                                    Lokasi</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">
                                    Telepon</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($FADHIL_outlet as $FADHIL_dataoutlet)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $FADHIL_dataoutlet->nama }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $FADHIL_dataoutlet->alamat }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $FADHIL_dataoutlet->tlp }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Aktif</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-0 py-0 text-center bg-red-100">
                                        <div
                                            class="px-3 py-4 text-red-700 bg-red-100 border border-red-400 rounded-sm">
                                            Data Outlet belum Tersedia.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    <script src="{{ $FADHIL_laporanChart->cdn() }}"></script>

    {{ $FADHIL_laporanChart->script() }}

    <script src="{{ $FADHIL_pesananChart->cdn() }}"></script>

    {{ $FADHIL_pesananChart->script() }}
</x-layout>
