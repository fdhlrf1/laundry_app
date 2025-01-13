<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pemesanan</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: 'Courier New', monospace;
            margin: 0;
            padding: 10px;
            background-color: #f0f0f0;
        }

        .receipt {
            width: 80mm;
            background-color: white;
            margin: 0 auto;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header,
        .footer {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
        }

        .bawahheader {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            padding: 5px 0;
            border-top: 1px dashed #000;
        }

        .content {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            padding: 10px 0;
        }

        .content:first-of-type {
            border-top: none;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 12px;
        }

        .alamat_detail {
            text-align: right;
            word-wrap: break-word;
            max-width: 200px;
        }

        .catatan_detail {
            text-align: right;
            word-wrap: break-word;
            max-width: 180px;
        }


        .total {
            font-weight: bold;
            font-size: 14px;
            margin-top: 10px;
        }

        .footer {
            font-size: 12px;
            margin-top: 10px;
        }

        .print-btn {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            margin-left: 10px;
        }

        @media print {
            body {
                background-color: white;
            }

            .receipt {
                box-shadow: none;
            }

            .print-btn {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="receipt">
        <div class="header">
            <h2>Struk Pemesanan</h2>
            <p>{{ \Carbon\Carbon::parse($FADHIL_struk->tgl)->format('Y-m-d H:i:s') }}</p>
        </div>
        <div class="bawahheader">
            <p>{{ $FADHIL_kodeStruk }}</p>
        </div>

        <div class="content">
            <div class="row">
                <span>Outlet:</span>
                <span>{{ $FADHIL_struk->detailTransaksi->first()->paket->outlet->nama }}</span>
            </div>
            <div class="row">
                <span>Alamat:</span>
                <div class="alamat_detail">
                    <span>{{ $FADHIL_struk->detailTransaksi->first()->paket->outlet->alamat }}</span>
                </div>
            </div>
            <div class="row">
                <span>Pelanggan:</span>
                <span>{{ $FADHIL_struk->nama_pelanggan }}</span>
            </div>
            {{-- <div class="row">
                <span>Telepon:</span>
                <span>{{ $FADHIL_struk->tlp }}</span>
            </div> --}}
            <div class="row">
                <span>Invoice:</span>
                <span>{{ $FADHIL_struk->kode_invoice }}</span>
            </div>
        </div>

        <div class="content">
            @foreach ($FADHIL_struk->detailTransaksi as $FADHIL_detailTransaksi)
                <div class="row">
                    <span>Nama Paket:</span>
                    <span>{{ $FADHIL_detailTransaksi->paket->nama_paket }}</span>
                </div>
                <div class="row">
                    <span>Harga:</span>
                    <span>Rp {{ number_format($FADHIL_detailTransaksi->paket->harga, 0, ',', '.') }}</span>
                </div>
                <div class="row">
                    <span>{{ $FADHIL_detailTransaksi->paket->nama }} x{{ $FADHIL_detailTransaksi->qty }}
                        @if ($FADHIL_detailTransaksi->paket->jenis == 'kiloan')
                            (Kg)
                        @else
                            Item
                        @endif
                    </span>
                    <span>Rp
                        {{ number_format($FADHIL_detailTransaksi->paket->harga * $FADHIL_detailTransaksi->qty, 0, ',', '.') }}</span>
                </div>
            @endforeach
        </div>

        <div class="content">
            <div class="row">
                <span>Biaya Tambahan:</span>
                <span>Rp {{ number_format($FADHIL_struk->biaya_tambahan, 0, ',', '.') }}</span>
            </div>
            <div class="row">
                <span>Diskon:</span>
                <span>Rp {{ number_format($FADHIL_struk->diskon, 0, ',', '.') }}</span>
            </div>
            <div class="row">
                <span>Pajak:</span>
                <span>Rp {{ number_format($FADHIL_struk->pajak, 0, ',', '.') }}</span>
            </div>
            <div class="row total">
                <span>Total:</span>
                <span>Rp {{ number_format($FADHIL_struk->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="content">
            <div class="row">
                <span>Pengambilan Cucian:</span>
                <span>{{ \Carbon\Carbon::parse($FADHIL_struk->batas_waktu)->format('d-m-Y H:i') }}</span>
            </div>
            <div class="row">
                <span>Catatan:</span>
                <div class="catatan_detail">
                    <span>{{ $FADHIL_struk->detailTransaksi->first()->keterangan ?? 'Tidak ada catatan' }}</span>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>Terima Kasih telah menggunakan layanan kami!</p>
        </div>
    </div>
    <div class="justify" style="text-align: center;">
        <button class="print-btn" onclick="cetakDanRedirect()">Cetak Struk</button>
    </div>

    <script>
        function cetakDanRedirect() {
            window.print();

            setTimeout(function() {
                window.location.href =
                    "{{ route('laporanRedirect') }}";
            }, 1000);
        }
    </script>

</body>

</html>
