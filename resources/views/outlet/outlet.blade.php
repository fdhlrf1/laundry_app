<x-layout>
    <div class="py-2 bg-white shadow-[0_1px_3px_rgba(0,0,0,0.15)]">
        <div class="container px-4 mx-auto">
            <div class="flex items-center justify-between">
                <h1 class="text-lg font-bold text-gray-800 uppercase">{{ $title }}</h1>
                {{-- <nav class="text-sm">
                    <ol class="inline-flex p-0 list-none">
                        <li class="flex items-center text-blue-500">
                            <a href="#" class="hover:underline">Dasbor</a>
                            <svg class="w-3 h-3 mx-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </li>
                        <li class="flex items-center text-gray-500">Analitik</li>
                    </ol>
                </nav> --}}
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto">
        <div class="py-2">
            <div class="px-6 mx-auto max-w-7xl sm:px-6 md:px-6">
                <!-- Search and Add New Button -->
                <form action="{{ route('outlet') }}" method="GET">
                    <div class="flex items-center justify-between mt-4 mb-4">
                        @if (Auth()->user()->role == 'super_admin')
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
                                        placeholder="Cari outlet" type="search">
                                </div>

                                <!-- Search Button -->
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-white transition bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50">
                                    Cari
                                </button>
                                <!-- Reset Button -->
                                <a href="{{ route('outlet') }}"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 transition bg-gray-200 border border-transparent rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-opacity-50">
                                    Reset
                                </a>
                            </div>
                        @endif
                </form>

                @if (Auth()->user()->role == 'super_admin')
                    <!-- Button trigger modal -->
                    <button type="button"
                        class="inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-success-3 transition duration-150 ease-in-out hover:bg-success-accent-300 hover:shadow-success-2 focus:bg-success-accent-300 focus:shadow-success-2 focus:outline-none focus:ring-0 active:bg-success-600 active:shadow-success-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                        data-twe-toggle="modal" data-twe-target="#outlet-create" data-twe-ripple-init
                        data-twe-ripple-color="light">
                        Tambah outlet baru
                    </button>
                @endif
            </div>

            @include('outlet.crudoutlet.modal-create')

            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    @if (Auth()->user()->role == 'super_admin')
                        <h2 class="text-lg font-medium text-gray-900">Data Outlet</h2>
                    @elseif (Auth()->user()->role == 'admin')
                        <h2 class="text-lg font-medium text-gray-900">Data Outlet Anda</h2>
                    @endif

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
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[260px]">
                                    Nama Outlet
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[260px]">
                                    Alamat
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[260px]">
                                    Telepon
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase whitespace-nowrap min-w-[100px]">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($FADHIL_outlets as $FADHIL_outlet)
                                @include('outlet.crudoutlet.modal-edit')
                                @include('outlet.crudoutlet.modal-delete')
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ $loop->iteration + $FADHIL_outlets->firstItem() - 1 }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ $FADHIL_outlet->nama }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ $FADHIL_outlet->alamat }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ $FADHIL_outlet->tlp }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        <button type="button"
                                            class="inline-block rounded bg-warning px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-warning-3 transition duration-150 ease-in-out hover:bg-warning-accent-300 hover:shadow-warning-2 focus:bg-warning-accent-300 focus:shadow-warning-2 focus:outline-none focus:ring-0 active:bg-warning-600 active:shadow-warning-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                                            data-twe-toggle="modal"
                                            data-twe-target="#outlet-edit{{ $FADHIL_outlet->id }}" data-twe-ripple-init
                                            data-twe-ripple-color="light">
                                            Edit
                                        </button>
                                        @if (Auth()->user()->role == 'super_admin')
                                            <button type="button"
                                                class="inline-block rounded bg-red-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:bg-red-600 dark:active:bg-red-600"
                                                data-twe-toggle="modal"
                                                data-twe-target="#outlet-hapus{{ $FADHIL_outlet->id }}"
                                                data-twe-ripple-init data-twe-ripple-color="light">
                                                Hapus
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-0 py-0 text-center bg-red-100">
                                        <div class="px-3 py-4 text-red-700 bg-red-100 border border-red-400 rounded-sm">
                                            Data Outlet belum Tersedia.
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
                {{ $FADHIL_outlets->links() }}
            </div>
        </div>
    </div>
    </div>




</x-layout>
