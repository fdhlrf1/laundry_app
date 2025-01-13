<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi Laundry</title>
    @vite('resources/css/app.css')
    <style>
        /* Aturan umum */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 3px;
            background-color: #ffffff;
            color: #000000;
        }

        .container {
            max-width: 800px;
            /* Ukuran kontainer */
            margin: auto;
            padding: 0;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .header-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .header-info div {
            margin-bottom: 0;
            font-weight: bold;
        }

        .header-info span {
            margin-left: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
            border: 1px solid #000000;
        }

        th {
            background-color: #f0f0f0;
        }

        /* Mengatur lebar kolom Total Pembayaran */
        td:nth-child(4) {
            width: 20%;
            /* Atur lebar kolom Total Pembayaran sesuai kebutuhan */
        }

        .no-data {
            background-color: #fed7e2;
            color: #e53e3e;
            text-align: center;
        }

        .status {
            display: inline-block;
            padding: 5px;
            font-weight: bold;
        }

        /* Media print untuk cetakan */
        @media print {
            body {
                margin: 10mm;
                /* Margin: atas, kanan, bawah, kiri */
            }

            .container {
                border: none;
                width: auto;
                /* Agar lebar otomatis mengikuti margin */
            }

            h1 {
                margin-bottom: 20px;
            }

            table {
                border: 1px solid #000;
                width: 100%;
                /* Pastikan tabel mengisi lebar */
            }

            th,
            td {
                border: 1px solid #000;
            }
        }
    </style>
</head>

<body class="font-sans text-black bg-white">
    <div class="container">
        <!-- Header Laporan -->
        <h1>Laporan Laundry {{ session('nama_outlet') ?? 'Laundry Jaya Pusat' }}</h1>
        <div class="header-info">
            <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
                <div>
                    <span class="font-semibold">Periode:</span>
                    @if (empty($FADHIL_tanggal_mulai) &&
                            empty($FADHIL_tanggal_akhir) &&
                            empty($FADHIL_statusBayar) &&
                            empty($FADHIL_statusCucian))
                        Semua Periode
                    @else
                        {{ \Carbon\Carbon::parse(request('tanggal_mulai'))->format('d M Y') }}
                        -
                        {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->format('d M Y') }}
                    @endif
                </div>
                <div>
                    <span class="font-semibold">Total Cucian:</span>
                    <span>{{ $FADHIL_total }}</span>
                </div>
                <div>
                    <span class="font-semibold">Pendapatan:</span>
                    <span>Rp {{ number_format($FADHIL_pendapatan, 0, ',', '.') }}</span>
                </div>
                {{-- <div>
                <span class="font-semibold">Pertumbuhan:</span>
                <span class="text-green-600">{{ $pertumbuhan }}%</span>
            </div> --}}
            </div>

            <!-- Tabel Laporan FADHIL_transaksi -->
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Invoice</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Pesan</th>
                        <th>Batas Waktu</th>
                        <th>Status Cucian</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($FADHIL_transaksis as $FADHIL_transaksi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $FADHIL_transaksi->kode_invoice }}</td>
                            <td>{{ $FADHIL_transaksi->nama_pelanggan }}</td>
                            <td> {{ \Carbon\Carbon::parse($FADHIL_transaksi->tgl)->format('d M Y') }}</td>
                            <td> {{ \Carbon\Carbon::parse($FADHIL_transaksi->batas_waktu)->format('d M Y') }}</td>
                            </td>
                            <td>
                                @if ($FADHIL_transaksi->status === 'baru')
                                    <span class="font-normak">Baru</span>
                                @elseif ($FADHIL_transaksi->status === 'proses')
                                    <span class="font-normal">Proses</span>
                                @elseif ($FADHIL_transaksi->status === 'selesai')
                                    <span class="font-normal">Selesai</span>
                                @elseif ($FADHIL_transaksi->status === 'diambil')
                                    <span class="font-normal">Diambil</span>
                                @endif
                            </td>
                            <td>
                                @if ($FADHIL_transaksi->dibayar == 'belum_dibayar')
                                    <span class="font-normal">Belum
                                        Dibayar</span>
                                @else
                                    <span class="font-normal">Sudah
                                        Dibayar</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="no-data">Data Transaksi belum Tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
</body>

</html>
