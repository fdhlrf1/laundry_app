<!-- Modal -->
<div data-twe-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="modal-paket" tabindex="-1" aria-labelledby="modal-paketLabel" aria-hidden="true">
    <div data-twe-modal-dialog-ref
        class="pointer-events-none relative h-auto w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out mx-auto my-7 max-w-[90%]">
        <div
            class="relative flex flex-col w-full overflow-hidden text-current bg-white border border-gray-300 rounded-md shadow-md outline-none pointer-events-auto dark:bg-surface-dark">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between flex-shrink-0 p-4 border-b-2 rounded-t-md border-neutral-100 dark:border-white/10">
                <h5 class="text-xl font-medium leading-normal text-surface dark:text-white" id="modal-paketLabel">
                    Pilih Paket
                </h5>
                <button type="button"
                    class="box-content border-none rounded-none text-neutral-500 hover:text-neutral-800 hover:no-underline focus:text-neutral-800 focus:opacity-100 focus:shadow-none focus:outline-none dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                    data-twe-modal-dismiss aria-label="Close">
                    <span class="[&>svg]:h-6 [&>svg]:w-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="relative p-4 overflow-y-auto bg-white shadow-sm rounded-b-md">
                <table class="w-full bg-white border border-gray-200 rounded-sm shadow-sm table-auto">
                    <thead>
                        <tr class="text-left text-gray-500 bg-gray-50">
                            <th class="px-6 py-3 text-sm font-semibold border border-gray-300">No</th>
                            <th class="px-6 py-3 text-sm font-semibold border border-gray-300">Nama Outlet</th>
                            <th class="px-6 py-3 text-sm font-semibold border border-gray-300">Jenis</th>
                            <th class="px-6 py-3 text-sm font-semibold border border-gray-300">Nama Paket</th>
                            <th class="px-6 py-3 text-sm font-semibold border border-gray-300">Lama Proses</th>
                            <th class="px-6 py-3 text-sm font-semibold border border-gray-300">Harga</th>
                            <th class="px-6 py-3 text-sm font-semibold text-center border border-gray-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 bg-white">
                        @foreach ($FADHIL_pakets as $index => $FADHIL_paket)
                            <tr class="hover:bg-blue-50">
                                <td class="px-6 py-4 border border-gray-300">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 border border-gray-300">{{ $FADHIL_paket->outlet->nama }}</td>
                                <td class="px-6 py-4 border border-gray-300">{{ $FADHIL_paket->jenis }}</td>
                                <td class="px-6 py-4 border border-gray-300">{{ $FADHIL_paket->nama_paket }}</td>
                                <td class="px-6 py-4 border border-gray-300">{{ $FADHIL_paket->lama_proses }}</td>
                                <td class="px-6 py-4 border border-gray-300">{{ $FADHIL_paket->harga }}</td>
                                <td class="px-6 py-4 text-center border border-gray-300">
                                    <button type="button"
                                        class="ms-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong select-paket"
                                        data-twe-modal-dismiss data-twe-ripple-init data-twe-ripple-color="light"
                                        data-id_paket="{{ $FADHIL_paket->id }}" data-jenis="{{ $FADHIL_paket->jenis }}"
                                        data-nama_paket="{{ $FADHIL_paket->nama_paket }}"
                                        data-harga="{{ $FADHIL_paket->harga }}"
                                        data-lama_proses="{{ $FADHIL_paket->lama_proses }}">
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
