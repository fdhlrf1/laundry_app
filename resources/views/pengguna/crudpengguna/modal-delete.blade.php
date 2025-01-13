<!-- Modal -->
<div data-twe-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="pengguna-hapus{{ $FADHIL_pengguna->id }}" data-twe-backdrop="static" data-twe-keyboard="false" tabindex="-1"
    aria-labelledby="pengguna-hapusLabel" aria-hidden="true">
    <div data-twe-modal-dialog-ref
        class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
        <div
            class="relative flex flex-col w-full text-current bg-white border-none rounded-md outline-none pointer-events-auto bg-clip-padding shadow-4 dark:bg-surface-dark">
            <div
                class="flex items-center justify-between flex-shrink-0 p-4 border-b-2 rounded-t-md border-neutral-100 dark:border-white/10">
                <!--Modal title-->
                <h5 class="text-xl font-medium leading-normal text-surface dark:text-white" id="exampleModalLabel">
                    Hapus Pengguna
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

            <!-- Modal Body -->
            <div class="p-4 text-center">
                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-neutral-500 dark:text-neutral-400">
                    Apakah Anda yakin ingin menghapus data ini? <br>
                    Nama <span class="capitalize">{{ $FADHIL_pengguna->role }}</span> :
                    <strong class="capitalize">{{ $FADHIL_pengguna->nama }}</strong>
                </h3>
                </h3>
                <form action="{{ route('pengguna.destroy', $FADHIL_pengguna->id) }}" method="POST"
                    id="penggunaFormHapus{{ $FADHIL_pengguna->id }}">
                    @csrf
                    @method('DELETE')
                </form>
            </div>

            <!-- Modal footer -->
            <div
                class="flex flex-wrap items-center justify-center flex-shrink-0 gap-4 p-4 border-t-2 rounded-b-md border-neutral-100 dark:border-white/10">
                <button type="submit" form="penggunaFormHapus{{ $FADHIL_pengguna->id }}"
                    class="inline-block rounded bg-red-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:bg-red-600 dark:active:bg-red-600"
                    data-twe-ripple-init data-twe-ripple-color="light">
                    Ya, saya yakin
                </button>
                <!-- No Button -->
                <button type="button"
                    class="inline-block rounded bg-gray-300 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-gray-700 transition duration-150 ease-in-out hover:bg-gray-400 focus:bg-gray-400 focus:outline-none focus:ring-0 active:bg-gray-500 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:bg-gray-700 dark:active:bg-gray-700"
                    data-twe-modal-dismiss data-twe-ripple-init data-twe-ripple-color="light">
                    Tidak, batal
                </button>
            </div>
        </div>
    </div>
</div>
