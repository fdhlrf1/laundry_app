<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Laundry</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('fontawesome/all.min.css') }}">
</head>

<body class="bg-gray-100">
    <div class="container px-4 py-8 mx-auto">
        <div class="p-6 mb-8 bg-white rounded-lg shadow-md">
            <div class="flex flex-col items-start justify-between md:flex-row md:items-center">
                <h1 class="mb-4 text-3xl font-bold text-gray-800 md:mb-0">Laporan Transaksi Laundry</h1>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="flex items-center space-x-2">
                        <i class="text-blue-500 fas fa-calendar-alt"></i>
                        <span class="font-medium text-gray-600">Periode:</span>
                        @if (empty($FADHIL_tanggal_mulai) &&
                                empty($FADHIL_tanggal_akhir) &&
                                empty($FADHIL_statusBayar) &&
                                empty($FADHIL_statusCucian))
                            Semua Periode
                        @else
                            <span
                                class="text-gray-800">{{ \Carbon\Carbon::parse(request('tanggal_mulai'))->format('d M Y') }}
                                -
                                {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->format('d M Y') }}</span>
                        @endif

                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="text-green-500 fas fa-tshirt"></i>
                        <span class="font-medium text-gray-600">Total Cucian:</span>
                        <span class="text-gray-800">{{ $FADHIL_total }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="text-yellow-500 fas fa-money-bill-wave"></i>
                        <span class="font-medium text-gray-600">Pendapatan:</span>
                        <span class="text-gray-800">Rp. {{ number_format($FADHIL_pendapatan, 0, ',', '.') }}</span>
                    </div>
                    {{-- <div class="flex items-center space-x-2">
                        <i class="text-purple-500 fas fa-chart-line"></i>
                        <span class="font-medium text-gray-600">Pertumbuhan:</span>
                        <span class="text-green-600">+15%</span>
                    </div> --}}
                </div>
            </div>
        </div>

        <!-- Tombol Kembali dan Ekspor -->
        <div class="flex items-center justify-between mt-6 mb-6">
            <a href="{{ route('laporan') }}"
                class="inline-flex items-center px-4 py-2 font-bold text-white transition bg-gray-500 rounded hover:bg-gray-800">
                <i class="mr-2 fas fa-arrow-left"></i> Kembali
            </a>
            <div class="flex space-x-2">
                <a href="{{ route('laporan.eksporPDF', ['tanggal_mulai' => request('tanggal_mulai'), 'tanggal_akhir' => request('tanggal_akhir'), 'dibayar' => request('dibayar'), 'status' => request('status')]) }}"
                    class="inline-flex items-center px-4 py-2 font-bold text-white transition bg-red-500 rounded hover:bg-red-600">
                    <i class="mr-2 fas fa-file-pdf"></i> Ekspor ke PDF
                </a>
                <a href="{{ route('laporan.eksporXLS', ['tanggal_mulai' => request('tanggal_mulai'), 'tanggal_akhir' => request('tanggal_akhir'), 'dibayar' => request('dibayar'), 'status' => request('status')]) }}"
                    class="inline-flex items-center px-4 py-2 font-bold text-white transition bg-green-500 rounded hover:bg-green-600">
                    <i class="mr-2 fas fa-file-excel"></i> Ekspor ke Excel
                </a>
            </div>
        </div>

        <!-- Tabel Transaksi -->
        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                No</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Kode Invoice</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Nama Pelanggan</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Tanggal Pesan</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Batas Waktu</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Status Cucian</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($FADHIL_transaksis as $FADHIL_transaksi)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">
                                        {{ $FADHIL_transaksi->kode_invoice }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                    {{ $FADHIL_transaksi->nama_pelanggan }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($FADHIL_transaksi->tgl)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($FADHIL_transaksi->batas_waktu)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($FADHIL_transaksi->status === 'baru')
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">
                                            Baru
                                        </span>
                                    @elseif ($FADHIL_transaksi->status === 'proses')
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">
                                            Proses
                                        </span>
                                    @elseif ($FADHIL_transaksi->status === 'selesai')
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                            Selesai
                                        </span>
                                    @elseif ($FADHIL_transaksi->status === 'diambil')
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-gray-800 bg-gray-100 rounded-full">
                                            Diambil
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($FADHIL_transaksi->dibayar == 'belum_dibayar')
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                            Belum Dibayar
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                            Sudah Dibayar
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap bg-gray-50">
                                    Data Transaksi belum Tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        {{-- <div class="mt-4">
            {{ $FADHIL_transaksis->links() }}
        </div> --}}
    </div>
</body>

</html>
