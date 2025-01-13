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
                    <form action="{{ route('laporanLog.filter') }}" method="GET">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                            <!-- Input Tanggal Mulai -->
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
                            </div>

                            <!-- Input Tanggal Akhir -->
                            <div class="space-y-2">
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

                            <!-- Input Status Pembayaran -->
                            <div class="space-y-2">
                                <div class="relative">
                                    <label for="dibayar"
                                        class="block mb-1 text-sm font-medium text-gray-700">Role</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 11c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-3.313 0-6 2.239-6 5v1h12v-1c0-2.761-2.687-5-6-5z">
                                                </path>
                                            </svg>

                                        </div>
                                        <select id="role" name="role"
                                            class="block w-full py-2 pl-10 pr-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                                            <option value="" disabled selected>Pilih role</option>
                                            @if (Auth()->user()->role == 'super_admin')
                                                <option value="super_admin"
                                                    {{ request()->get('super_admin') == 'super_admin' ? 'selected' : '' }}>
                                                    Super Admin
                                                </option>
                                                <option value="super_owner"
                                                    {{ request()->get('super_owner') == 'super_owner' ? 'selected' : '' }}>
                                                    Super Owner
                                                </option>
                                            @endif
                                            <option value="admin"
                                                {{ request()->get('admin') == 'admin' ? 'selected' : '' }}>
                                                Admin
                                            </option>
                                            <option value="kasir"
                                                {{ request()->get('kasir') == 'kasir' ? 'selected' : '' }}>
                                                Kasir
                                            </option>
                                            <option value="owner"
                                                {{ request()->get('owner') == 'owner' ? 'selected' : '' }}>
                                                Owner
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Filter, Reset, Ekspor -->
                        <div class="flex justify-between mt-6 space-x-4">
                            <!-- Tombol Filter dan Reset -->
                            <div class="flex space-x-4">
                                <a href="{{ route('log') }}" data-twe-ripple-init data-twe-ripple-color="light"
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
                                <a href="{{ route('laporanLog.show', ['tanggal_mulai' => request('tanggal_mulai'), 'tanggal_akhir' => request('tanggal_akhir'), 'role' => request('role')]) }}"
                                    data-twe-ripple-init data-twe-ripple-color="light"
                                    class="px-4 py-2 text-sm font-medium text-white transition border border-transparent rounded-md shadow-sm bg-slate-600 hover:bg-slate-700 focus:outline-none focus:ring-slate-500">
                                    <i class="mr-2 fas fa-file-export"></i> Ekspor
                                </a>

                            </div>
                        </div>
                    </form>
                </div>

                <!-- Search and Add New Button -->
                <form action="{{ route('log') }}" method="GET">
                    <div class="flex items-center justify-between mt-4 mb-4">
                        {{-- @if (Auth()->user()->role == 'super_admin') --}}
                        <div class="flex items-center w-full max-w-2xl space-x-2">
                            <!-- Input Search -->
                            <div class="relative flex-grow">
                                <label for="search" class="sr-only">Cari</label>
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input id="search" name="search"
                                    class="block w-full py-2 pl-10 pr-3 leading-5 placeholder-gray-500 bg-white border border-gray-300 rounded-md focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm"
                                    placeholder="Cari log" type="search">
                            </div>
                            <!-- Search Button -->
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white transition bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50">
                                Cari
                            </button>
                            <!-- Reset Button -->
                            <button type="{{ route('log') }}"
                                class="px-4 py-2 text-sm font-medium text-gray-700 transition bg-gray-200 border border-transparent rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-opacity-50">
                                Reset
                            </button>
                        </div>

                        {{-- <a href="{{ route('laporanLog.eksporPDF') }}"
                            class="inline-flex items-center px-4 py-2 ml-auto font-bold text-white transition bg-red-500 rounded hover:bg-red-600">
                            <i class="mr-2 fas fa-file-pdf"></i> Ekspor ke PDF
                        </a> --}}

                        {{-- @endif --}}
                    </div>
                </form>


                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Data log aktifitas</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="text-left bg-gray-50">
                                    <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[30px]">
                                        No
                                    </th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[100px]">
                                        Nama Lengkap
                                    </th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[100px]">
                                        Aktifitas
                                    </th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[100px]">
                                        Role
                                    </th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[100px]">
                                        Deskripsi
                                    </th>
                                    {{-- <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[100px]">
                                        IP Address
                                    </th> --}}
                                    {{-- <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[100px]">
                                        Browser
                                    </th> --}}
                                    <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[100px]">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($FADHIL_logs as $FADHIL_log)
                                    @include('log.modal.modal-log-detail')
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ $loop->iteration + $FADHIL_logs->firstItem() - 1 }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ $FADHIL_log->user->nama }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ $FADHIL_log->aktifitas }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ $FADHIL_log->role }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ $FADHIL_log->deskripsi }}</td>
                                        {{-- <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ $FADHIL_log->ip_address }}</td> --}}
                                        {{-- <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ $FADHIL_log->user_agent }}</td> --}}
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            <button type="button"
                                                class="inline-block rounded-full bg-sky-100 px-4 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-sky-600 transition duration-150 ease-in-out hover:bg-sky-200 focus:bg-sky-200 focus:outline-none focus:ring-0 active:bg-sky-300 dark:bg-sky-700/20 dark:hover:bg-sky-700/30 dark:focus:bg-sky-700/30 dark:active:bg-sky-700/40"
                                                data-twe-toggle="modal"
                                                data-twe-target="#modal-log-detail{{ $FADHIL_log->id }}"
                                                data-twe-ripple-init data-twe-ripple-color="light">
                                                <i class="fas fa-info-circle me-2"></i> Detail
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-0 py-0 text-center bg-red-100">
                                            <div
                                                class="px-3 py-4 text-red-700 bg-red-100 border border-red-400 rounded-sm">
                                                Data log belum Tersedia.
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
                    {{ $FADHIL_logs->links() }}
                </div>
            </div>
        </div>
    </div>


</x-layout>
