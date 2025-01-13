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
                <!-- Search and Add New Button -->
                <div class="flex items-center justify-between mt-4 mb-4">
                    <div class="w-full max-w-lg lg:max-w-xs">
                        <label for="search" class="sr-only">Cari</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input id="search" name="search"
                                class="block w-full py-2 pl-10 pr-3 leading-5 placeholder-gray-500 bg-white border border-gray-300 rounded-md focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm"
                                placeholder="Cari transaksi" type="search">
                        </div>
                    </div>

                    <a href="{{ route('transaksi.form') }}"
                        class="inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-success-3 transition duration-150 ease-in-out hover:bg-success-accent-300 hover:shadow-success-2 focus:bg-success-accent-300 focus:shadow-success-2 focus:outline-none focus:ring-0 active:bg-success-600 active:shadow-success-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">
                        Tambah Transaksi
                    </a>
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
                                    <th
                                        class="px-3 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[10px]">
                                        No
                                    </th>
                                    <th
                                        class="px-3 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[10px]">
                                        Kode Invoice
                                    </th>
                                    <th
                                        class="px-3 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[10px]">
                                        Nama Pelanggan
                                    </th>
                                    <th
                                        class="px-3 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[10px]">
                                        Batas Waktu
                                    </th>
                                    <th
                                        class="px-3 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[10px]">
                                        Status Cucian
                                    </th>
                                    <th
                                        class="px-3 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[10px]">
                                        Status Pembayaran
                                    </th>
                                    <th
                                        class="px-3 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[0px]">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($FADHIL_transaksis as $FADHIL_transaksi)
                                    @include('transaksi.modal.modal-bayar')
                                    @include('transaksi.modal.modal-status')
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
                                            {{ \Carbon\Carbon::parse($FADHIL_transaksi->batas_waktu)->format('Y-m-d') }}
                                        </td>
                                        <td class="px-4 py-6 text-sm text-gray-900 whitespace-nowrap">
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
                                        </td>
                                        <td class="px-4 py-6 text-sm text-gray-900 whitespace-nowrap">
                                            @if ($FADHIL_transaksi->dibayar == 'belum_dibayar')
                                                <div class="flex justify-center">
                                                    <button type="button"
                                                        class="inline-block rounded bg-red-600 px-4 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:bg-red-600 dark:active:bg-red-600 flex items-center gap-2"
                                                        data-twe-toggle="modal"
                                                        data-twe-target="#modal-bayar{{ $FADHIL_transaksi->id }}"
                                                        data-twe-ripple-init data-twe-ripple-color="light">
                                                        <i class="fas fa-wallet"></i> Bayar
                                                    </button>
                                                </div>
                                            @else
                                                <div class="flex justify-center">
                                                    <div
                                                        class="inline-block rounded bg-green-600 px-4 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out flex items-center gap-2">
                                                        <i class="fas fa-check"></i> Dibayar
                                                    </div>
                                                </div>
                                            @endif
                                        </td>


                                        <td class="px-4 py-6 text-sm text-gray-900 whitespace-nowrap">
                                            <!-- Tombol Detail -->
                                            <a href="{{ route('transaksi.detail', ['FADHIL_id' => $FADHIL_transaksi->id]) }}"
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
                                        <td colspan="6" class="px-0 py-0 text-center bg-red-100">
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
