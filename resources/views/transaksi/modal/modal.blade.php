<!-- Modal -->
<div data-twe-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="modal-member" tabindex="-1" aria-labelledby="modal-memberLabel" aria-hidden="true">
    <div data-twe-modal-dialog-ref
        class="pointer-events-none relative h-[calc(100%-1rem)] w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:h-[calc(100%-3.5rem)] min-[576px]:max-w-[90%]">
        <div
            class="pointer-events-auto relative flex max-h-[100%] w-full flex-col overflow-hidden rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none dark:bg-surface-dark">
            <div
                class="flex items-center justify-between flex-shrink-0 p-4 border-b-2 rounded-t-md border-neutral-100 dark:border-white/10">
                <!-- Modal title -->
                <h5 class="text-xl font-medium leading-normal text-surface dark:text-white" id="modal-memberLabel">
                    Pilih Member
                </h5>
                <!-- Close button -->
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
            <div class="relative p-6 overflow-y-auto bg-gray-100 rounded-lg shadow-lg" style="height: 600px;">
                <table class="w-full overflow-hidden bg-white border-collapse rounded-lg shadow-lg table-auto">
                    <thead>
                        <tr class="text-left text-white bg-blue-600">
                            <th class="px-6 py-3 text-sm font-semibold">No</th>
                            <th class="px-6 py-3 text-sm font-semibold">Nama</th>
                            <th class="px-6 py-3 text-sm font-semibold">Alamat</th>
                            <th class="px-6 py-3 text-sm font-semibold">Jenis Kelamin</th>
                            <th class="px-6 py-3 text-sm font-semibold">Telepon</th>
                            <th class="px-6 py-3 text-sm font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($FADHIL_members as $index => $FADHIL_member)
                            <tr class="border-b hover:bg-blue-50">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $FADHIL_member->nama }}</td>
                                <td class="px-6 py-4">{{ $FADHIL_member->alamat }}</td>
                                <td class="px-6 py-4">{{ $FADHIL_member->jenis_kelamin }}</td>
                                <td class="px-6 py-4">{{ $FADHIL_member->tlp }}</td>
                                <td class="px-6 py-4 text-center">
                                    <button
                                        class="px-4 py-1 font-semibold text-white transition-transform duration-300 transform bg-green-500 rounded-lg shadow-md hover:bg-green-600 hover:scale-105"
                                        onclick="selectMember({{ $FADHIL_member->id }})">
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="height:800px;"></div>
                <p class="mt-4 text-center text-gray-500">This content should appear at the bottom after you scroll.</p>
            </div>

            <script>
                function selectMember(memberId) {
                    // Implementasi fungsi untuk menangani member yang dipilih
                    alert("Member dengan ID " + memberId + " telah dipilih.");
                }
            </script>

            <!-- Modal footer -->
            <div
                class="flex flex-wrap items-center justify-end flex-shrink-0 p-4 border-t-2 rounded-b-md border-neutral-100 dark:border-white/10">
                <button type="button"
                    class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-200 focus:bg-primary-accent-200 focus:outline-none focus:ring-0 active:bg-primary-accent-200 dark:bg-primary-300 dark:hover:bg-primary-400 dark:focus:bg-primary-400 dark:active:bg-primary-400"
                    data-twe-modal-dismiss data-twe-ripple-init data-twe-ripple-color="light">
                    Close
                </button>
                <button type="button"
                    class="ms-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                    data-twe-ripple-init data-twe-ripple-color="light">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>
