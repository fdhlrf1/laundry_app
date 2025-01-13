<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Log Laundry</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('fontawesome/all.min.css') }}">
</head>

<body class="bg-gray-100">
    <div class="container px-4 py-8 mx-auto">
        <div class="p-6 mb-8 bg-white rounded-lg shadow-md">
            <div class="flex flex-col items-start justify-between md:flex-row md:items-center">
                <h1 class="mb-4 text-3xl font-bold text-gray-800 md:mb-0">Laporan Log Laundry</h1>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="flex items-center space-x-2">
                        <i class="text-blue-500 fas fa-calendar-alt"></i>
                        <span class="font-medium text-gray-600">Periode:</span>
                        @if (empty($FADHIL_tanggal_mulai) && empty($FADHIL_tanggal_akhir) && empty($FADHIL_role))
                            Semua Periode
                        @else
                            <span
                                class="text-gray-800">{{ \Carbon\Carbon::parse(request('tanggal_mulai'))->format('d M Y') }}
                                -
                                {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->format('d M Y') }}</span>
                        @endif

                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="text-sky-500 fas fa-user-circle"></i>
                        <span class="font-medium text-gray-600">Role yang dipilih:</span>
                        <span class="text-gray-800 capitalize">{{ $FADHIL_role ?? 'Semua Role' }}</span>
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
            <a href="{{ route('log') }}"
                class="inline-flex items-center px-4 py-2 font-bold text-white transition bg-gray-500 rounded hover:bg-gray-800">
                <i class="mr-2 fas fa-arrow-left"></i> Kembali
            </a>
            <div class="flex space-x-2">
                <a href="{{ route('laporanLog.eksporPDF', ['tanggal_mulai' => request('tanggal_mulai'), 'tanggal_akhir' => request('tanggal_akhir'), 'role' => request('role')]) }}"
                    class="inline-flex items-center px-4 py-2 font-bold text-white transition bg-red-500 rounded hover:bg-red-600">
                    <i class="mr-2 fas fa-file-pdf"></i> Ekspor ke PDF
                </a>
                <a href="{{ route('laporanLog.eksporXLS', ['tanggal_mulai' => request('tanggal_mulai'), 'tanggal_akhir' => request('tanggal_akhir'), 'role' => request('role')]) }}"
                    class="inline-flex items-center px-4 py-2 font-bold text-white transition bg-green-500 rounded hover:bg-green-600">
                    <i class="mr-2 fas fa-file-excel"></i> Ekspor ke Excel
                </a>
            </div>
        </div>

        <!-- Tabel Log -->
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
                                Nama Lengkap</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Aktifitas</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Role</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($FADHIL_logs as $FADHIL_log)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">
                                        {{ $FADHIL_log->user->nama }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                    {{ $FADHIL_log->aktifitas }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                    {{ $FADHIL_log->role }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                    {{ $FADHIL_log->deskripsi }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap bg-gray-50">
                                    Data Log belum Tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        {{-- <div class="mt-4">
            {{ $FADHIL_logs->links() }}
        </div> --}}
    </div>
</body>

</html>
