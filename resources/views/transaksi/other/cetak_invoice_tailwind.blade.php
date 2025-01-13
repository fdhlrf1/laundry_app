<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('fontawesome/all.min.css') }}">
</head>

<body class="bg-gray-50">

    <div class="flex items-center justify-center w-full h-full bg-gray-100">
        <div class="flex flex-col w-full h-full max-w-screen-lg bg-white shadow-lg">

            <!-- Invoice Header -->
            <div class="flex items-center justify-between p-6 text-white bg-blue-600">
                <div>
                    <h2 class="text-2xl font-bold">Invoice #LD-0009</h2>
                    <p class="text-sm">Diterbitkan: 20 November 2024</p>
                </div>
                <div class="text-right">
                    <p class="font-semibold">Laundry Bersih</p>
                    <p class="text-sm">Jl. Kebersihan No. 123, Jakarta</p>
                    <p class="text-sm">Telp: (021) 1234-5678</p>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="grid grid-cols-1 gap-4 p-6 md:grid-cols-2">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Informasi Pelanggan</h3>
                    <p class="text-gray-600">Budi Santoso</p>
                    <p class="text-gray-600">Jl. Merdeka No. 45, Jakarta</p>
                    <p class="text-gray-600">Telp: 081234567890</p>
                </div>
                <div class="text-right">
                    <h3 class="text-lg font-semibold text-gray-700">Detail Pesanan</h3>
                    <p class="text-gray-600">Tanggal Pesanan: 20 November 2024</p>
                    <p class="text-gray-600">Batas Waktu: 23 November 2024</p>
                    <p class="text-gray-600">Status:
                        <span class="inline-block px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                            Proses
                        </span>
                    </p>
                </div>
            </div>

            <!-- Invoice Items -->
            <div class="p-6">
                <table class="w-full border-collapse table-auto">
                    <thead>
                        <tr class="text-sm font-medium text-gray-700 border-b">
                            <th class="p-3">No</th>
                            <th class="p-3">Jenis Layanan</th>
                            <th class="p-3">Berat (Kg)</th>
                            <th class="p-3">Harga/Kg</th>
                            <th class="p-3 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-50">
                            <td class="p-3">1</td>
                            <td class="p-3">Cuci + Setrika</td>
                            <td class="p-3">3 Kg</td>
                            <td class="p-3">Rp 7.000</td>
                            <td class="p-3 text-right">Rp 21.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Invoice Summary -->
            <div class="p-6 bg-gray-100 border-t">
                <div class="flex justify-between mb-2">
                    <span class="font-medium text-gray-600">Subtotal:</span>
                    <span class="text-gray-800">Rp 21.000</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="font-medium text-gray-600">Biaya Tambahan:</span>
                    <span class="text-gray-800">Rp 0</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="font-medium text-gray-600">Diskon:</span>
                    <span class="text-gray-800">0%</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="font-medium text-gray-600">Pajak:</span>
                    <span class="text-gray-800">0%</span>
                </div>
                <div class="flex justify-between text-lg font-bold">
                    <span class="text-gray-600">Total:</span>
                    <span class="text-gray-800">Rp 21.000</span>
                </div>
            </div>

            <!-- Payment Status -->
            <div class="px-6 py-4 border-t bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="text-gray-600">
                        Status Pembayaran:
                        <span class="inline-block px-2 py-1 ml-2 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                            Belum Dibayar
                        </span>
                    </div>
                    <button class="px-4 py-2 text-white transition duration-200 bg-blue-600 rounded-md hover:bg-blue-700">
                        Print Invoice
                    </button>
                </div>
            </div>

            <!-- Footer -->
            <div class="p-6 text-sm text-center bg-gray-200">
                Terima kasih telah menggunakan jasa Laundry Bersih. Kami menghargai kepercayaan Anda.
            </div>

        </div>
    </div>

    <script src="{{ asset('sweetalert2/sweetalert2.all.min.js') }}"></script>
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
                    confirmButton: 'bg-sky-600 text-white border-sky-600'
                }
            });
        @elseif ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Data tidak valid',
                html: '{!! implode('<br>', $errors->all()) !!}',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'bg-red-600 text-white'
                }
            });
        @endif
    </script>
</body>

</html>
