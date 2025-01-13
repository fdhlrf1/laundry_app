<div data-twe-modal-init class="fixed inset-0 z-[1055] hidden h-full w-full overflow-y-auto bg-black/50 backdrop-blur-sm"
    id="modal-log-detail{{ $FADHIL_log->id }}" data-twe-backdrop="static" data-twe-keyboard="false" tabindex="-1"
    aria-labelledby="modal-log-detailLabel" aria-hidden="true">
    <div data-twe-modal-dialog-ref
        class="relative mx-auto mt-16 w-full max-w-lg translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out">
        <div
            class="relative flex flex-col w-full bg-white border rounded-lg shadow-lg text-neutral-700 border-neutral-200 dark:bg-neutral-800 dark:text-white dark:border-neutral-600">
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-neutral-200 dark:border-neutral-700">
                <h5 class="text-lg font-semibold" id="modal-log-detailLabel">
                    Detail Log Aktivitas
                </h5>
                <button type="button"
                    class="text-neutral-400 hover:text-neutral-800 focus:outline-none dark:text-neutral-500 dark:hover:text-neutral-300"
                    data-twe-modal-dismiss aria-label="Close">
                    <span
                        class="inline-flex items-center justify-center w-6 h-6 rounded-full hover:bg-neutral-200 dark:hover:bg-neutral-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-4 space-y-6">
                <div>
                    <p class="font-medium">Nama Pengguna</p>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ $FADHIL_log->user->nama }}</p>
                </div>
                <div>
                    <p class="font-medium">IP Address</p>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ $FADHIL_log->ip_address }}</p>
                </div>
                <div>
                    <p class="font-medium">Browser yang Digunakan</p>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ $FADHIL_log->user_agent }}</p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div
                class="flex justify-end gap-4 px-6 py-4 border-t bg-neutral-50 border-neutral-200 dark:bg-neutral-900 dark:border-neutral-700">
                <button type="button"
                    class="px-4 py-2 text-sm font-medium bg-white border rounded-lg text-neutral-700 border-neutral-300 hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-neutral-400 dark:bg-neutral-800 dark:text-neutral-300 dark:border-neutral-600 dark:hover:bg-neutral-700 dark:focus:ring-neutral-500"
                    data-twe-modal-dismiss>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
