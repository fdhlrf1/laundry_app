<div data-twe-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="modal-status{{ $FADHIL_transaksi->id }}" data-twe-backdrop="static" data-twe-keyboard="false" tabindex="-1"
    aria-labelledby="modal-statusLabel" aria-hidden="true">
    <div data-twe-modal-dialog-ref
        class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
        <div
            class="relative flex flex-col w-full text-current bg-white border-none rounded-md outline-none pointer-events-auto bg-clip-padding shadow-4 dark:bg-surface-dark">
            <div
                class="flex items-center justify-between flex-shrink-0 p-4 border-b-2 rounded-t-md border-neutral-100 dark:border-white/10">
                <!-- Modal title -->
                <h5 class="text-xl font-medium leading-normal text-surface dark:text-white" id="modal-statusLabel">
                    Update Status Cucian
                    <span class="text-sky-500">{{ $FADHIL_transaksi->kode_invoice }}</span>
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
            <div class="p-4 space-y-4" data-twe-modal-body-ref>
                <div>
                    <label class="block font-medium text-gray-600">Nama Pelanggan</label>
                    <p class="font-semibold text-gray-800">{{ $FADHIL_transaksi->nama_pelanggan }}</p>
                </div>

                {{-- <div>
                    <label class="block mb-2 font-medium text-gray-600">Status Member</label>
                    <p class="font-semibold text-gray-800">
                        @if ($FADHIL_transaksi->id_member != null)
                            <span
                                class="inline-flex items-center px-3 py-1.5 text-white bg-green-600 rounded-full shadow-md">
                                <i class="mr-2 pt-[2px] fas fa-check"></i>
                                <span>Member</span>
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-3 py-1.5 text-white bg-red-600 rounded-full shadow-md">
                                <i class="mr-2 pt-[2px] fa-solid fa-x"></i>
                                <span>Non-Member</span>
                            </span>
                        @endif
                    </p>
                </div> --}}

                <form action="{{ route('laporan.status', $FADHIL_transaksi->id) }}" method="POST"
                    id="formStatus{{ $FADHIL_transaksi->id }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="status" class="text-neutral-500 dark:text-neutral-400">Status</label>
                        <select name="status" id="status"
                            class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('status') border-red-500 @enderror">
                            <option value="" disabled
                                {{ old('status', $FADHIL_transaksi->status) == '' || !in_array($FADHIL_transaksi, ['baru', 'proses', 'selesai', 'diambil']) ? 'selected' : '' }}>
                                -- Pilih status --</option>
                            <option value="baru"
                                {{ old('status', $FADHIL_transaksi->status) == 'baru' ? 'selected' : '' }}
                                {{ $FADHIL_transaksi->status === 'selesai' ? 'disabled style=color:gray;' : '' }}
                                {{ $FADHIL_transaksi->status === 'proses' ? 'disabled style=color:gray;' : '' }}>
                                Baru
                            </option>
                            <option value="proses"
                                {{ old('status', $FADHIL_transaksi->status) == 'proses' ? 'selected' : '' }}
                                {{ $FADHIL_transaksi->status === 'selesai' ? 'disabled style=color:gray;' : '' }}>
                                Proses
                            </option>
                            <option value="selesai"
                                {{ old('status', $FADHIL_transaksi->status) == 'selesai' ? 'selected' : '' }}
                                {{ $FADHIL_transaksi->status === 'diambil' ? 'disabled style=color:gray;' : '' }}>
                                Selesai
                            </option>
                            <option value="diambil"
                                {{ old('status', $FADHIL_transaksi->status) == 'diambil' ? 'selected' : '' }}
                                {{ $FADHIL_transaksi->dibayar === 'belum_dibayar' ? 'disabled style=color:gray;' : '' }}>
                                Diambil
                            </option>

                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                </form>
            </div>
            <!-- Modal footer -->
            <div
                class="flex flex-wrap items-center justify-end flex-shrink-0 gap-2 p-4 border-t-2 rounded-b-md border-neutral-100 dark:border-white/10">
                <button type="button"
                    class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-200 focus:bg-primary-accent-200 focus:outline-none focus:ring-0 active:bg-primary-accent-200 dark:bg-primary-300 dark:hover:bg-primary-400 dark:focus:bg-primary-400 dark:active:bg-primary-400"
                    data-twe-modal-dismiss>
                    Batal
                </button>
                <button type="submit" form="formStatus{{ $FADHIL_transaksi->id }}"
                    class="ms-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>
