<div data-twe-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="modal-log-detail{{ $FADHIL_log->id }}" data-twe-backdrop="static" data-twe-keyboard="false" tabindex="-1"
    aria-labelledby="modal-log-detailLabel" aria-hidden="true">
    <div data-twe-modal-dialog-ref
        class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
        <div
            class="relative flex flex-col w-full text-current bg-white border-none rounded-md outline-none pointer-events-auto bg-clip-padding shadow-4 dark:bg-surface-dark">
            <div
                class="flex items-center justify-between flex-shrink-0 p-4 border-b-2 rounded-t-md border-neutral-100 dark:border-white/10">
                <!-- Modal title -->
                <h5 class="text-lg font-semibold" id="modal-log-detailLabel">
                    Detail Log Aktivitas
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
            <div class="px-6 py-4 space-y-6">
                <div>
                    <p class="font-medium">Nama Lengkap</p>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ $FADHIL_log->user->nama }}</p>
                </div>
                <div>
                    <p class="font-medium">Nama Outlet</p>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">
                        {{ $FADHIL_log->user->outlet->nama ?? 'Laundry Jaya Pusat' }}
                    </p>
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
            <!-- Modal footer -->
            <div
                class="flex flex-wrap items-center justify-end flex-shrink-0 gap-2 p-4 border-t-2 rounded-b-md border-neutral-100 dark:border-white/10">
                <button type="button"
                    class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-200 focus:bg-primary-accent-200 focus:outline-none focus:ring-0 active:bg-primary-accent-200 dark:bg-primary-300 dark:hover:bg-primary-400 dark:focus:bg-primary-400 dark:active:bg-primary-400"
                    data-twe-modal-dismiss>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
