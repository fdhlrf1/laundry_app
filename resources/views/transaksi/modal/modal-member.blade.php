<div data-twe-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="modal-member" tabindex="-1" aria-labelledby="modal-memberLabel" aria-hidden="true">
    <div data-twe-modal-dialog-ref
        class="pointer-events-none relative mx-auto mt-7 max-w-[90%] w-full translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out sm:max-w-[80%] md:max-w-[70%] lg:max-w-[60%]">
        <div
            class="pointer-events-auto relative flex max-h-[90%] w-full flex-col overflow-hidden rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-surface-dark">
            <div
                class="flex items-center justify-between flex-shrink-0 p-4 border-b rounded-t-md border-neutral-300 dark:border-neutral-700">
                <!-- Modal title -->
                <h5 class="text-xl font-medium text-surface dark:text-white" id="modal-memberLabel">
                    Pilih Member
                </h5>
                <!-- Close button -->
                <button type="button"
                    class="box-content border-none rounded-none text-neutral-500 hover:text-neutral-800 focus:text-neutral-800 focus:outline-none dark:text-neutral-400 dark:hover:text-neutral-300"
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
            <div class="relative p-4 overflow-y-auto bg-white shadow-sm rounded-b-md" style="max-height: 500px;">
                <div class="overflow-x-auto">
                    <table class="w-full bg-white border border-gray-200 rounded-sm shadow-sm table-auto">
                        <thead>
                            <tr class="text-left text-gray-500 bg-gray-50">
                                <th class="px-6 py-3 text-sm font-semibold border border-gray-300">No</th>
                                <th class="px-6 py-3 text-sm font-semibold border border-gray-300">Nama</th>
                                <th class="px-6 py-3 text-sm font-semibold border border-gray-300">Alamat</th>
                                <th class="px-6 py-3 text-sm font-semibold border border-gray-300">Jenis Kelamin</th>
                                <th class="px-6 py-3 text-sm font-semibold border border-gray-300">Telepon</th>
                                <th class="px-6 py-3 text-sm font-semibold text-center border border-gray-300">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($FADHIL_members as $index => $FADHIL_member)
                                <tr class="border-b border-gray-300 hover:bg-blue-50">
                                    <td class="px-6 py-4 border border-gray-300">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 border border-gray-300">{{ $FADHIL_member->nama }}</td>
                                    <td class="px-6 py-4 border border-gray-300">{{ $FADHIL_member->alamat }}</td>
                                    <td class="px-6 py-4 border border-gray-300">
                                        @if ($FADHIL_member->jenis_kelamin == 'L')
                                            Laki-Laki
                                        @else
                                            Perempuan
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 border border-gray-300">{{ $FADHIL_member->tlp }}</td>
                                    <td class="px-6 py-4 text-center border border-gray-300">
                                        <button type="button" data-twe-modal-dismiss data-twe-ripple-init
                                            class="inline-block px-4 py-2 text-xs font-medium text-white rounded shadow-md bg-primary hover:bg-primary-accent-300 focus:outline-none select-member"
                                            data-id="{{ $FADHIL_member->id }}" data-nama="{{ $FADHIL_member->nama }}"
                                            data-alamat="{{ $FADHIL_member->alamat }}"
                                            data-jenis_kelamin="{{ $FADHIL_member->jenis_kelamin }}"
                                            data-tlp="{{ $FADHIL_member->tlp }}" data-diskon="{{ '5%' }}"
                                            data-pajak="{{ '8%' }}">
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
</div>
