<div data-twe-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="modal-bayar{{ $FADHIL_transaksi->id }}" data-twe-backdrop="static" data-twe-keyboard="false" tabindex="-1"
    aria-labelledby="modal-bayarLabel" aria-hidden="true">
    <div data-twe-modal-dialog-ref
        class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
        <div
            class="relative flex flex-col w-full text-current bg-white border-none rounded-md outline-none pointer-events-auto bg-clip-padding shadow-4 dark:bg-surface-dark">
            <div
                class="flex items-center justify-between flex-shrink-0 p-4 border-b-2 rounded-t-md border-neutral-100 dark:border-white/10">
                <!-- Modal title -->
                <h5 class="text-xl font-medium leading-normal text-surface dark:text-white" id="modal-bayarLabel">
                    Transaksi Pembayaran
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

                <div>
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
                </div>

                <div>
                    <label class="block font-medium text-gray-600">Total</label>
                    <p id="total{{ $FADHIL_transaksi->id }}" class="font-semibold text-gray-800">Rp.
                        {{ number_format($FADHIL_transaksi->total, 0, ',', '.') }}</p>
                </div>
                <form action="{{ route('laporan.update', $FADHIL_transaksi->id) }}" method="POST"
                    id="formBayar{{ $FADHIL_transaksi->id }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="total" value="{{ $FADHIL_transaksi->total }}">
                    <div>
                        <label for="bayar" class="block mb-2 font-medium text-gray-600">Bayar</label>
                        <input id="bayar{{ $FADHIL_transaksi->id }}" type="text" name="bayar"
                            class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('bayar') border-red-500 @enderror"
                            placeholder="Masukkan jumlah bayar" oninput="hitungKembalian({{ $FADHIL_transaksi->id }})"
                            required>
                        @error('bayar ')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="kembalian" class="block mb-2 font-medium text-gray-600">Kembalian</label>
                        <input id="kembalian{{ $FADHIL_transaksi->id }}" type="text" name="kembalian"
                            class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-gray-200 bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary cursor-not-allowed"
                            readonly>
                    </div>
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
                <button type="submit" form="formBayar{{ $FADHIL_transaksi->id }}"
                    class="ms-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function hitungKembalian(FADHIL_id_transaksi) {
        // Ambil elemen terkait
        const FADHIL_totalText = document.getElementById(`total${FADHIL_id_transaksi}`);
        const FADHIL_bayarInput = document.getElementById(`bayar${FADHIL_id_transaksi}`);
        const FADHIL_kembalianInput = document.getElementById(`kembalian${FADHIL_id_transaksi}`);

        if (!FADHIL_totalText) {
            console.error(`Elemen total${FADHIL_id_transaksi} tidak ditemukan.`);
            return; // Keluar dari fungsi jika elemen tidak ada
        }

        // Ambil nilai total dari elemen teks
        const FADHIL_total = parseInt(FADHIL_totalText.textContent.replace(/[^\d]/g, '')) || 0;

        // Ambil nilai bayar dari input, hapus format
        const FADHIL_bayar = parseInt(FADHIL_bayarInput.value.replace(/[^\d]/g, '')) || 0;

        // Hitung kembalian
        const FADHIL_kembalian = FADHIL_bayar - FADHIL_total;
        const FADHIL_kembalianText = FADHIL_kembalian > 0 ? `Rp.${FADHIL_kembalian.toLocaleString('id-ID')}` :
            'Rp. 0';

        // Tampilkan kembalian
        FADHIL_kembalianInput.value = FADHIL_kembalianText;

        // Debugging log
        console.log('Total:', FADHIL_total);
        console.log('Bayar:', FADHIL_bayar);
        console.log('Kembalian:', FADHIL_kembalianText);
    }
</script>
