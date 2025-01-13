<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Faktur</title>
    <link rel="stylesheet" href="{{ asset('tw_elements/tw-elements.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/all.min.css') }}">

    @vite('resources/css/app.css')

    <style>
        @media print {

            /* Hide print button and body when printing */
            button,
            .kembali,
            .print {
                display: none;
            }

            .kode_invoice,
            .diterbitkan,
            .namaoutlet,
            .alamatoutlet,
            .tlpoutlet {
                color: gray;

            }

        }

        /* Fullscreen styles */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f7fafc;
        }

        .invoice-container {
            width: 100vw;
            /* Full width of the viewport */
            height: 100vh;
            /* Full height of the viewport */
            background-color: white;
            /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
            display: flex;
            flex-direction: column;
        }

        .invoice-header {
            background-color: #3B82F6;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .invoice-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .invoice-header p {
            margin: 0;
            font-size: 14px;
        }

        .invoice-body {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .invoice-footer {
            padding: 20px;
            background-color: #f1f5f9;
            text-align: center;
            font-size: 14px;
        }

        .invoice-summary {
            background-color: #f8fafc;
            padding: 20px;
            border-top: 1px solid #e5e7eb;
            margin-top: 20px;
        }

        .invoice-summary div {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        /* Button and other styling */
        .swal2-confirm.blue-button {
            color: white;
            background-color: #3F83F8;
            border: none;
        }

        .swal2-confirm.blue-button:hover {
            transition: 1s;
            background-color: #1C64F2;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .invoice-table td.text-right {
            text-align: right;
        }
    </style>

</head>

<body>
    <div class="invoice-container">
        <!-- Invoice Header -->
        <div class="invoice-header">
            <div>
                <h2 class="kode_invoice">#LD-{{ $FADHIL_details->kode_invoice }}</h2>
                <p class="diterbitkan">Diterbitkan: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d-F-Y') }}
                </p>
            </div>
            @foreach ($FADHIL_details_trs as $FADHIL_detail_trs)
                <div class="text-right">
                    <p class="font-semibold namaoutlet">{{ $FADHIL_detail_trs->paket->outlet->nama }}</p>
                    <p class="text-sm alamatoutlet">{{ $FADHIL_detail_trs->paket->outlet->alamat }}</p>
                    <p class="text-sm tlpoutlet">Telp: {{ $FADHIL_detail_trs->paket->outlet->tlp }}</p>
                </div>

        </div>

        <!-- Customer Info -->
        <div class="invoice-body">
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-700">Informasi Pelanggan</h3>
                    <p class="text-gray-600">{{ $FADHIL_details->nama_pelanggan }}</p>
                    <p class="text-gray-600">{{ $FADHIL_details->alamat }}</p>
                    <p class="text-gray-600">Telp: {{ $FADHIL_details->tlp }}</p>
                </div>
                <div class="md:text-right">
                    <h3 class="mb-2 text-lg font-semibold text-gray-700">Detail Pesanan</h3>
                    <p class="text-gray-600">Tanggal Pesanan:
                        {{ \Carbon\Carbon::parse($FADHIL_details->tgl)->format('d F Y') }}</p>
                    <p class="text-gray-600">Batas Waktu:
                        {{ \Carbon\Carbon::parse($FADHIL_details->batas_waktu)->format('d F Y') }}</p>
                    <p class="text-gray-600">Status:
                        @if ($FADHIL_details->status === 'baru')
                            <span
                                class="inline-block px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                                Baru
                            </span>
                        @elseif ($FADHIL_details->status === 'proses')
                            <span
                                class="inline-block px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                Proses
                            </span>
                        @elseif ($FADHIL_details->status === 'selesai')
                            <span
                                class="inline-block px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                Selesai
                            </span>
                        @elseif ($FADHIL_details->status === 'diambil')
                            <span
                                class="inline-block px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-full">
                                Diambil
                            </span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- Invoice Items -->
            <div>
                <table class="w-full text-left invoice-table">
                    <thead>
                        <tr class="text-sm font-medium text-gray-700">
                            <th>No</th>
                            <th>Nama Paket</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Catatan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-50">
                            <td>1</td>
                            <td>{{ $FADHIL_detail_trs->paket->nama_paket }}</td>
                            <td>{{ $FADHIL_detail_trs->qty }}</td>
                            <td>{{ number_format($FADHIL_detail_trs->paket->harga, 0, ',', '.') }}</td>
                            <td>
                                @if ($FADHIL_detail_trs->keterangan === !null)
                                    {{ $FADHIL_detail_trs->keterangan }}
                                @else
                                    Tidak ada keterangan
                                @endif
                            </td>
                            <td>{{ number_format($FADHIL_details->total, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endforeach
            <!-- Invoice Summary -->
            <div class="invoice-summary">
                {{-- <div class="flex justify-between mb-2">
                    <span class="font-medium text-gray-600">Subtotal:</span>
                    <span class="text-gray-800">Rp 21.000</span>
                </div> --}}
                <div class="flex justify-between mb-2">
                    <span class="font-medium text-gray-600">Biaya Tambahan:</span>
                    <span class="text-gray-800">Rp.
                        {{ number_format($FADHIL_details->biaya_tambahan, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="font-medium text-gray-600">Diskon:</span>
                    <span class="text-gray-800">Rp.
                        {{ number_format($FADHIL_details->diskon, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="font-medium text-gray-600">Pajak:</span>
                    <span class="text-gray-800">Rp.
                        {{ number_format($FADHIL_details->pajak, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-lg font-bold">
                    <span class="text-gray-600">Total:</span>
                    <span class="text-gray-800">Rp.
                        {{ number_format($FADHIL_details->total, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- New Fields for Keterangan -->
            <div class="mt-4">
                <h3 class="mb-2 text-lg font-semibold text-gray-700">Keterangan</h3>
                <p class="pl-4 text-gray-600">1. Pengambilan cucian harus membawa nota</p>
                <p class="pl-4 text-gray-600">2. Cucian luntur bukan tanggung jawab kami</p>
                <p class="pl-4 text-gray-600">3. Hitung dan periksa sebelum pergi</p>
                <p class="pl-4 text-gray-600">4. Cucian yang rusak/mengkerut karena sifat kain tidak dapat kami ganti
                </p>
                <p class="pl-4 text-gray-600">5. Cucian yang tidak diambil lebih dari 1 bulan bukan tanggung jawab kami
                </p>
            </div>

            {{-- <div class="mt-4">
                <h3 class="mb-2 text-lg font-semibold text-gray-700">Keterangan Member/Non-Member</h3>
                <p class="text-gray-600">Member</p>
            </div> --}}
        </div>

        <!-- Payment Status -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            <div class="flex items-center justify-between">
                <!-- Status Pembayaran di kiri -->
                <div class="text-gray-600">
                    Status Pembayaran:
                    @if ($FADHIL_details->dibayar == 'dibayar')
                        <span
                            class="inline-block px-2 py-1 ml-2 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                            Dibayar
                        </span>
                    @else
                        <span
                            class="inline-block px-2 py-1 ml-2 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                            Belum Dibayar
                        </span>
                    @endif

                </div>

                <!-- Tombol Print dan Kembali di kanan -->
                <div class="flex space-x-2">
                    <button onclick="window.print()"
                        class="px-4 py-2 text-white transition-colors duration-200 bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Print
                    </button>
                    <a href="{{ route('laporan.detail', ['FADHIL_id' => $FADHIL_details->id]) }}"
                        class="px-4 py-2 text-gray-800 transition-colors duration-200 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 kembali">
                        Kembali
                    </a>
                </div>
            </div>
        </div>


        <!-- Footer -->
        <div class="invoice-footer">
            Terima kasih telah menggunakan jasa {{ $FADHIL_detail_trs->paket->outlet->nama ?? 'Laundry Jaya Pusat' }}.
            Kami menghargai
            kepercayaan Anda.
        </div>
    </div>
</body>

<script src="{{ asset('sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('tw_elements/tw-elements.umd.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

<script>
    @if ($message = Session::get('success'))
        Swal.fire({
            icon: "success",
            title: "Berhasil",
            text: '{{ $message }}',
            showConfirmButton: false,
            timer: 2000
        });
    @elseif ($message = Session::get('error'))
        Swal.fire({
            icon: "error",
            title: "Gagal",
            text: '{{ $message }}',
            customClass: {
                confirmButton: 'bg-sky-600 text-white border-sky-600' // Background, teks, dan border tombol
            }
        });
    @elseif ($errors->any())
        Swal.fire({
            icon: "error",
            title: "Ada Kesalahan",
            text: 'Harap periksa form input Anda.',
            showConfirmButton: true,
            customClass: {
                confirmButton: 'bg-sky-600 text-white border-sky-600'
            }
        });
    @endif
</script>

</html>
