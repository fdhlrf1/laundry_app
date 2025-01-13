<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Log Laundry</title>
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
        <h1>Laporan Log {{ session('nama_outlet') ?? 'Laundry Jaya Pusat' }}</h1>
        <div class="header-info">
            <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
                <div>
                    <span class="font-semibold">Periode:</span>
                    @if (empty($FADHIL_tanggal_mulai) && empty($FADHIL_tanggal_akhir) && empty($FADHIL_role))
                        Semua Periode
                    @else
                        {{ \Carbon\Carbon::parse(request('tanggal_mulai'))->format('d M Y') }}
                        -
                        {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->format('d M Y') }}
                    @endif
                </div>
                <div>
                    <span class="font-semibold">Role yang dipilih:</span>
                    <span>{{ $FADHIL_role ?? 'Semua Role' }}</span>
                </div>

            </div>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Lengkap</th>
                        <th>Aktifitas</th>
                        <th>Role</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($FADHIL_logs as $FADHIL_log)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $FADHIL_log->user->nama }}</td>
                            <td>{{ $FADHIL_log->aktifitas }}</td>
                            <td>{{ $FADHIL_log->role }}</td>
                            <td>{{ $FADHIL_log->deskripsi }}</td>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="no-data">Data Log belum Tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
</body>

</html>
