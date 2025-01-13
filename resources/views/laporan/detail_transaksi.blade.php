<x-layout>
    <div class="py-2 bg-white shadow-[0_1px_3px_rgba(0,0,0,0.15)]">
        <div class="container px-4 mx-auto">
            <div class="flex items-center justify-between">
                <h1 class="text-lg font-bold text-gray-800 uppercase">Detail Transaksi</h1>
                <!-- Breadcrumbs -->
                <nav class="text-sm text-gray-600">
                    <ol class="flex space-x-2">
                        <li>
                            <a href="{{ route('laporan') }}" class="hover:text-gray-800">Laporan</a>
                        </li>
                        <li>
                            <span>/</span>
                        </li>
                        <li class="font-medium text-gray-900">Detail Transaksi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <div class="py-6 bg-gray-50">
        <div class="container px-4 mx-auto">
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                <!-- Header Card -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-bold text-gray-800">{{ $FADHIL_details->kode_invoice }}</h2>
                        @if ($FADHIL_details->status === 'baru')
                            <span class="px-3 py-1 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full">
                                Baru
                            </span>
                        @elseif ($FADHIL_details->status === 'proses')
                            <span class="px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                Proses
                            </span>
                        @elseif ($FADHIL_details->status === 'selesai')
                            <span class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">
                                Selesai
                            </span>
                        @elseif ($FADHIL_details->status === 'diambil')
                            <span class="px-3 py-1 text-sm font-semibold text-gray-800 bg-gray-100 rounded-full">
                                Diambil
                            </span>
                        @endif

                    </div>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <div>
                                <span class="text-sm font-medium text-gray-500">Tanggal Transaksi:</span>
                                <p class="text-gray-800">
                                    {{ \Carbon\Carbon::parse($FADHIL_details->tgl)->format('d F Y') }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Nama Pelanggan:</span>
                                <p class="text-gray-800">{{ $FADHIL_details->nama_pelanggan }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Alamat:</span>
                                <p class="text-gray-800">{{ $FADHIL_details->alamat }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">No. Telepon:</span>
                                <p class="text-gray-800">{{ $FADHIL_details->tlp }}</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div>
                                <span class="text-sm font-medium text-gray-500">Batas Waktu:</span>
                                <p class="text-gray-800">
                                    {{ \Carbon\Carbon::parse($FADHIL_details->batas_waktu)->format('d F Y') }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Status Pembayaran:</span>
                                @if ($FADHIL_details->dibayar == 'dibayar')
                                    <span
                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                        Dibayar
                                    </span>
                                @else
                                    <span
                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                        Belum Dibayar
                                    </span>
                                @endif

                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Status Pesanan:</span>
                                @if ($FADHIL_details->status === 'baru')
                                    <span
                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">
                                        Baru
                                    </span>
                                @elseif ($FADHIL_details->status === 'proses')
                                    <span
                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">
                                        Proses
                                    </span>
                                @elseif ($FADHIL_details->status === 'selesai')
                                    <span
                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                        Selesai
                                    </span>
                                @elseif ($FADHIL_details->status === 'diambil')
                                    <span
                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-gray-800 bg-gray-100 rounded-full">
                                        Diambil
                                    </span>
                                @endif

                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Petugas:</span>
                                <p class="text-gray-800">{{ $FADHIL_details->user->nama }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Items Card -->
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold text-gray-800">Detail Item</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Id Transaksi</th>
                                    <th scope="col" class="px-6 py-3">Nama Paket</th>
                                    <th scope="col" class="px-6 py-3">Jumlah</th>
                                    <th scope="col" class="px-6 py-3">Harga</th>
                                    <th scope="col" class="px-6 py-3">Catatan</th>
                                    <th scope="col" class="px-6 py-3">Total</th>
                                </tr>
                            </thead>
                            @foreach ($FADHIL_details_trs as $FADHIL_detail_trs)
                                <tbody>
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4">{{ $FADHIL_detail_trs->id_transaksi }}</td>
                                        <td class="px-6 py-4">{{ $FADHIL_detail_trs->paket->nama_paket }}</td>
                                        <td class="px-6 py-4">{{ $FADHIL_detail_trs->qty }}</td>
                                        <td class="px-6 py-4">
                                            {{ number_format($FADHIL_detail_trs->paket->harga, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            @if ($FADHIL_detail_trs->keterangan == !null)
                                                {{ $FADHIL_detail_trs->keterangan }}
                                            @else
                                                Tidak ada keterangan
                                            @endif

                                        </td>
                                        <td class="px-6 py-4">
                                            {{ number_format($FADHIL_details->total, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    {{-- <tr class="font-semibold text-gray-900 bg-gray-50">
                                        <td colspan="5" class="px-6 py-3 text-right">Subtotal</td>
                                        <td class="px-6 py-3">Rp 21.000</td>
                                    </tr> --}}
                                    <tr class="font-semibold text-gray-900 bg-gray-50">
                                        <td colspan="5" class="px-2 py-3 text-right">Biaya Tambahan</td>
                                        <td class="px-2 py-3">Rp.
                                            {{ number_format($FADHIL_details->biaya_tambahan, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr class="font-semibold text-gray-900 bg-gray-50">
                                        <td colspan="5" class="px-2 py-3 text-right">Diskon</td>
                                        <td class="px-2 py-3">Rp.
                                            {{ number_format($FADHIL_details->diskon, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr class="font-semibold text-gray-900 bg-gray-50">
                                        <td colspan="5" class="px-2 py-3 text-right">Pajak</td>
                                        <td class="px-2 py-3">Rp.
                                            {{ number_format($FADHIL_details->pajak, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr class="font-bold text-gray-900 bg-gray-50">
                                        <td colspan="5" class="px-2 py-3 text-right">Total</td>
                                        <td class="px-2 py-3">Rp.
                                            {{ number_format($FADHIL_details->total, 0, ',', '.') }}</td>
                                    </tr>
                                </tfoot>
                        </table>
                        @endforeach
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="p-6 border-t border-gray-200 bg-gray-50">
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('laporan.faktur', ['FADHIL_id' => $FADHIL_details->id]) }}"
                            class="px-4 py-2 text-white transition-colors duration-200 bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Cetak
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
