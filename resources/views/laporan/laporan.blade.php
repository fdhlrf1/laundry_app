<x-layout>
    <div class="py-2 bg-white shadow-[0_1px_3px_rgba(0,0,0,0.15)]">
        <div class="container px-4 mx-auto">
            <div class="flex items-center justify-between">
                <h1 class="text-lg font-bold text-gray-800 uppercase">{{ $title }}</h1>
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto">
        <div class="py-2">
            <div class="px-6 mx-auto max-w-7xl sm:px-6 md:px-6">
                <div class="mt-2 mb-4 bg-gray-100">
                    <form action="{{ route('laporan.filter') }}" method="GET">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="space-y-2">
                                <div class="relative">
                                    <label for="tanggal_mulai"
                                        class="block mb-1 text-sm font-medium text-gray-700">Tanggal Mulai</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                            class="block w-full py-2 pl-10 pr-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm"
                                            placeholder="Pilih tanggal mulai"
                                            value="{{ request()->get('tanggal_mulai') }}">
                                    </div>
                                </div>
                                <div class="relative">
                                    <label for="tanggal_akhir"
                                        class="block mb-1 text-sm font-medium text-gray-700">Tanggal Akhir</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="date" id="tanggal_akhir" name="tanggal_akhir"
                                            class="block w-full py-2 pl-10 pr-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm"
                                            placeholder="Pilih tanggal akhir"
                                            value="{{ request()->get('tanggal_akhir') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="relative">
                                    <label for="dibayar" class="block mb-1 text-sm font-medium text-gray-700">Status
                                        Pembayaran</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                </path>
                                            </svg>
                                        </div>
                                        <select id="dibayar" name="dibayar"
                                            class="block w-full py-2 pl-10 pr-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                                            <option value="" disabled selected>Pilih status pembayaran</option>
                                            <option value="dibayar"
                                                {{ request()->get('dibayar') == 'dibayar' ? 'selected' : '' }}>
                                                Dibayar</option>
                                            <option value="belum_dibayar"
                                                {{ request()->get('belum_dibayar') == 'belum_dibayar' ? 'selected' : '' }}>
                                                Belum Dibayar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="relative">
                                    <label for="status" class="block mb-1 text-sm font-medium text-gray-700">Status
                                        Cucian</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <select id="status" name="status"
                                            class="block w-full py-2 pl-10 pr-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                                            <option value="" disabled selected>Pilih status cucian</option>
                                            <option value="baru"
                                                {{ request()->get('status') == 'baru' ? 'selected' : '' }}>Baru</option>
                                            <option value="proses"
                                                {{ request()->get('status') == 'proses' ? 'selected' : '' }}>
                                                Proses</option>
                                            <option value="selesai"
                                                {{ request()->get('status') == 'selesai' ? 'selected' : '' }}>
                                                Selesai</option>
                                            <option value="diambil"
                                                {{ request()->get('status') == 'diambil' ? 'selected' : '' }}>
                                                Diambil</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Filter, Reset, Ekspor -->
                        <div class="flex justify-between mt-6 space-x-4">
                            <!-- Tombol Filter dan Reset -->
                            <div class="flex space-x-4">
                                <a href="{{ route('laporan') }}" data-twe-ripple-init data-twe-ripple-color="light"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 transition border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-sky-500">
                                    Reset
                                </a>
                                <button type="submit" data-twe-ripple-init data-twe-ripple-color="light"
                                    class="px-4 py-2 text-sm font-medium text-white transition border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-sky-500">
                                    Filter
                                </button>
                            </div>
                            <!-- Tombol Ekspor -->
                            <div class="flex space-x-4">
                                <a href="{{ route('laporan.show', ['tanggal_mulai' => request('tanggal_mulai'), 'tanggal_akhir' => request('tanggal_akhir'), 'dibayar' => request('dibayar'), 'status' => request('status')]) }}"
                                    data-twe-ripple-init data-twe-ripple-color="light"
                                    class="px-4 py-2 text-sm font-medium text-white transition border border-transparent rounded-md shadow-sm bg-slate-600 hover:bg-slate-700 focus:outline-none focus:ring-slate-500">
                                    <i class="mr-2 fas fa-file-export"></i> Ekspor
                                </a>
                                {{-- <button type="button"
                                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-red-500">
                                    Ekspor ke PDF
                                </button> --}}
                            </div>
                        </div>
                    </form>
                </div>



                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Data Transaksi</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="text-left bg-gray-50">
                                    {{-- <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[20px]">
                                        ID TRANSAKSI
                                    </th> --}}
                                    {{-- <th
                                        class="px-3 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap">
                                        ID TRS
                                    </th> --}}
                                    <th
                                        class="px-3 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap">
                                        No
                                    </th>
                                    <th
                                        class="px-3 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap">
                                        Kode Invoice
                                    </th>
                                    <th
                                        class="px-3 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap">
                                        Nama Pelanggan
                                    </th>
                                    <th
                                        class="px-6 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap">
                                        Tanggal Pesan
                                    </th>
                                    <th
                                        class="px-3 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap">
                                        Batas Waktu
                                    </th>
                                    <th
                                        class="px-10 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap">
                                        Status Cucian
                                    </th>
                                    <th
                                        class="px-3 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap">
                                        Status Pembayaran
                                    </th>
                                    <th
                                        class="px-12 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($FADHIL_transaksis as $FADHIL_transaksi)
                                    @include('laporan.modal.modal-bayar')
                                    @include('laporan.modal.modal-status')
                                    <tr>
                                        {{-- <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ $FADHIL_transaksi->id }}</td> --}}
                                        <td class="px-4 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ $loop->iteration + $FADHIL_transaksis->firstItem() - 1 }}</td>
                                        <td class="px-4 py-6 text-sm text-gray-900 whitespace-nowrap">
                                            {{ $FADHIL_transaksi->kode_invoice }}</td>
                                        <td class="px-4 py-6 text-sm text-gray-900 whitespace-nowrap">
                                            {{ $FADHIL_transaksi->nama_pelanggan }}</td>
                                        <td class="px-4 py-6 text-sm text-gray-900 whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($FADHIL_transaksi->tgl)->format('Y-m-d H:i:s') }}
                                        </td>
                                        <td class="px-4 py-6 text-sm text-gray-900 whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($FADHIL_transaksi->batas_waktu)->format('Y-m-d H:i:s') }}
                                        </td>
                                        <td class="px-4 py-6 text-sm text-gray-900 whitespace-nowrap">
                                            @if (Auth()->user()->role == 'super_owner' || Auth()->user()->role == 'owner')
                                                @if ($FADHIL_transaksi->status === 'baru')
                                                    <span
                                                        class="inline-block px-3 py-2 text-xs font-medium text-blue-600 transition bg-blue-100 rounded-full">
                                                        Baru - Transaksi Dibuat
                                                    </span>
                                                @elseif ($FADHIL_transaksi->status === 'proses')
                                                    <span
                                                        class="inline-block px-3 py-2 text-xs font-medium text-yellow-600 transition bg-yellow-100 rounded-full">
                                                        Proses - Sedang Dicuci
                                                    </span>
                                                @elseif ($FADHIL_transaksi->status === 'selesai')
                                                    <span
                                                        class="inline-block px-3 py-2 text-xs font-medium text-green-600 transition bg-green-100 rounded-full">
                                                        Selesai - Siap Diambil
                                                    </span>
                                                @elseif ($FADHIL_transaksi->status === 'diambil')
                                                    <span
                                                        class="inline-block px-3 py-2 text-xs font-medium text-gray-600 bg-gray-100 rounded-full">
                                                        Diambil - Telah Diterima
                                                    </span>
                                                @endif
                                            @elseif (Auth()->user()->role == 'super_admin' || Auth()->user()->role == 'admin' || Auth()->user()->role == 'kasir')
                                                @if ($FADHIL_transaksi->status === 'baru')
                                                    <button data-twe-toggle="modal"
                                                        data-twe-target="#modal-status{{ $FADHIL_transaksi->id }}"
                                                        data-twe-ripple-init data-twe-ripple-color="light"
                                                        class="inline-block px-3 py-2 text-xs font-medium text-blue-600 transition bg-blue-100 rounded-full cursor-pointer hover:bg-blue-200">
                                                        Baru - Transaksi Dibuat
                                                    </button>
                                                @elseif ($FADHIL_transaksi->status === 'proses')
                                                    <button data-twe-toggle="modal"
                                                        data-twe-target="#modal-status{{ $FADHIL_transaksi->id }}"
                                                        data-twe-ripple-init data-twe-ripple-color="light"
                                                        class="inline-block px-3 py-2 text-xs font-medium text-yellow-600 transition bg-yellow-100 rounded-full cursor-pointer hover:bg-yellow-200">
                                                        Proses - Sedang Dicuci
                                                    </button>
                                                @elseif ($FADHIL_transaksi->status === 'selesai')
                                                    <button data-twe-toggle="modal"
                                                        data-twe-target="#modal-status{{ $FADHIL_transaksi->id }}"
                                                        data-twe-ripple-init data-twe-ripple-color="light"
                                                        class="inline-block px-3 py-2 text-xs font-medium text-green-600 transition bg-green-100 rounded-full cursor-pointer hover:bg-green-200">
                                                        Selesai - Siap Diambil
                                                    </button>
                                                @elseif ($FADHIL_transaksi->status === 'diambil')
                                                    <span
                                                        class="inline-block px-3 py-2 text-xs font-medium text-gray-600 bg-gray-100 rounded-full">
                                                        Diambil - Telah Diterima
                                                    </span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="px-4 py-6 text-sm text-gray-900 whitespace-nowrap">
                                            @if (Auth()->user()->role == 'super_owner' || Auth()->user()->role == 'owner')
                                                @if ($FADHIL_transaksi->dibayar == 'belum_dibayar')
                                                    {{-- <div class="flex justify-center"> --}}
                                                    <div type="button"
                                                        class="inline-block rounded bg-red-600 px-4 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out items-center gap-2">
                                                        Belum dibayar
                                                    </div>
                                                    {{-- </div> --}}
                                                @else
                                                    {{-- <div class="flex justify-center"> --}}
                                                    <div
                                                        class="inline-block rounded bg-green-600 px-4 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out items-center gap-2">
                                                        Dibayar
                                                    </div>
                                                    {{-- </div> --}}
                                                @endif
                                            @elseif (Auth()->user()->role == 'super_admin' || Auth()->user()->role == 'admin' || Auth()->user()->role == 'kasir')
                                                @if ($FADHIL_transaksi->dibayar == 'belum_dibayar')
                                                    {{-- <div class="flex justify-center"> --}}
                                                    <button type="button"
                                                        class="inline-block rounded bg-red-600 px-4 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:bg-red-600 dark:active:bg-red-600 items-center gap-2"
                                                        data-twe-toggle="modal"
                                                        data-twe-target="#modal-bayar{{ $FADHIL_transaksi->id }}"
                                                        data-twe-ripple-init data-twe-ripple-color="light">
                                                        <i class="fas fa-wallet"></i> Bayar
                                                    </button>
                                                    {{-- </div> --}}
                                                @else
                                                    {{-- <div class="flex justify-center"> --}}
                                                    <div
                                                        class="inline-block rounded bg-green-600 px-4 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out items-center gap-2">
                                                        <i class="fas fa-check"></i> Dibayar
                                                    </div>
                                                    {{-- </div> --}}
                                                @endif
                                            @endif


                                        </td>


                                        <td class="px-4 py-6 text-sm text-gray-900 whitespace-nowrap">
                                            <!-- Tombol Detail -->
                                            <a href="{{ route('laporan.detail', ['FADHIL_id' => $FADHIL_transaksi->id]) }}"
                                                class="inline-block rounded-full bg-sky-100 px-4 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-sky-600 transition duration-150 ease-in-out hover:bg-sky-200 focus:bg-sky-200 focus:outline-none focus:ring-0 active:bg-sky-300 dark:bg-sky-700/20 dark:hover:bg-sky-700/30 dark:focus:bg-sky-700/30 dark:active:bg-sky-700/40">
                                                <i class="fas fa-info-circle me-2"></i> Detail
                                            </a>

                                            <!-- Tombol Edit -->
                                            {{-- <button type="button"
                                                class="inline-block rounded-full bg-yellow-100 px-4 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-yellow-600 transition duration-150 ease-in-out hover:bg-yellow-200 focus:bg-yellow-200 focus:outline-none focus:ring-0 active:bg-yellow-300 dark:bg-yellow-700/20 dark:hover:bg-yellow-700/30 dark:focus:bg-yellow-700/30 dark:active:bg-yellow-700/40"
                                                data-twe-toggle="modal"
                                                data-twe-target="#paket-edit{{ $FADHIL_transaksi->id }}"
                                                data-twe-ripple-init data-twe-ripple-color="light">
                                                <i class="fas fa-edit me-2"></i> Edit
                                            </button> --}}

                                            <!-- Tombol Batal -->
                                            {{-- <button type="button"
                                                class="inline-block rounded-full bg-red-100 px-4 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-red-600 transition duration-150 ease-in-out hover:bg-red-200 focus:bg-red-200 focus:outline-none focus:ring-0 active:bg-red-300 dark:bg-red-700/20 dark:hover:bg-red-700/30 dark:focus:bg-red-700/30 dark:active:bg-red-700/40"
                                                data-twe-toggle="modal"
                                                data-twe-target="#paket-hapus{{ $FADHIL_transaksi->id }}"
                                                data-twe-ripple-init data-twe-ripple-color="light">
                                                <i class="fas fa-times-circle me-2"></i> Batal
                                            </button> --}}

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-0 py-0 text-center bg-red-100">
                                            <div
                                                class="px-3 py-4 text-red-700 bg-red-100 border border-red-400 rounded-sm">
                                                Data Transaksi belum Tersedia.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>


                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $FADHIL_transaksis->links() }}
                </div>
            </div>
        </div>
    </div>


</x-layout>
