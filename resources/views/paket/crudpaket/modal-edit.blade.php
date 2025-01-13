<div data-twe-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="paket-edit{{ $FADHIL_paket->id }}" data-twe-backdrop="static" data-twe-keyboard="false" tabindex="-1"
    aria-labelledby="paket-editLabel" aria-hidden="true">
    <div data-twe-modal-dialog-ref
        class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
        <div
            class="relative flex flex-col w-full text-current bg-white border-none rounded-md outline-none pointer-events-auto bg-clip-padding shadow-4 dark:bg-surface-dark">
            <div
                class="flex items-center justify-between flex-shrink-0 p-4 border-b-2 rounded-t-md border-neutral-100 dark:border-white/10">
                <!--Modal title-->
                <h5 class="text-xl font-medium leading-normal text-surface dark:text-white" id="exampleModalLabel">
                    Edit Paket Cucian
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
            <div class="p-4" data-twe-modal-body-ref>
                <form action="{{ route('paket.update', $FADHIL_paket->id) }}" method="POST"
                    id="paketFormEdit{{ $FADHIL_paket->id }}">
                    @csrf
                    @method('PUT')
                    @if (Auth()->user()->role == 'super_admin')
                        <div class="mb-3">
                            <label for="id_outlet" class="text-neutral-500 dark:text-neutral-400">Nama Outlet:</label>
                            <select name="id_outlet" id="id_outlet"
                                class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('id_outlet') border-red-500 @enderror">
                                <option value="" disabled selected>-- Pilih Outlet --</option>
                                @foreach ($FADHIL_outlets as $FADHIL_outlet)
                                    <option value="{{ $FADHIL_outlet->id }}"
                                        {{ $FADHIL_outlet->id == $FADHIL_paket->id_outlet ? 'selected' : '' }}>
                                        {{ old('id_outlet', $FADHIL_outlet->nama) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_outlet')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @elseif (Auth()->user()->role == 'admin')
                        <div class="mb-3">
                            <label for="id_outlet" class="text-neutral-500 dark:text-neutral-400">Nama Outlet:</label>
                            <input type="text" name="id_outlet" id="id_outlet"
                                class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-gray-200 px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none cursor-not-allowed @error('id_outlet') border-red-500 @enderror"
                                value="{{ Auth::user()->outlet->nama }}" readonly>
                            </input>

                            @error('id_outlet')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="jenis" class="text-neutral-500 dark:text-neutral-400">Jenis:</label>
                        <select name="jenis" id="jenis"
                            class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('jenis') border-red-500 @enderror">
                            <option value="" disabled
                                {{ old('jenis', $FADHIL_paket->jenis) == '' || !in_array($FADHIL_paket, ['kiloan', 'selimut', 'bed_cover', 'kaos', 'lain']) ? 'selected' : '' }}>
                                -- Pilih Jenis --</option>
                            <option value="kiloan"
                                {{ old('jenis', $FADHIL_paket->jenis) == 'kiloan' ? 'selected' : '' }}>
                                Kiloan
                            </option>
                            <option value="selimut"
                                {{ old('jenis', $FADHIL_paket->jenis) == 'selimut' ? 'selected' : '' }}>
                                Selimut
                            </option>
                            <option value="bed_cover"
                                {{ old('jenis', $FADHIL_paket->jenis) == 'bed_cover' ? 'selected' : '' }}>
                                Bed Cover
                            </option>
                            <option value="kaos"
                                {{ old('jenis', $FADHIL_paket->jenis) == 'kaos' ? 'selected' : '' }}>
                                Kaos
                            </option>
                            <option value="lain"
                                {{ old('jenis', $FADHIL_paket->jenis) == 'lain' ? 'selected' : '' }}>
                                Lainnya
                            </option>
                        </select>
                        @error('jenis')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_paket" class="text-neutral-500 dark:text-neutral-400">Nama Paket:</label>
                        <input type="text" name="nama_paket"
                            class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('nama_paket') border-red-500 @enderror"
                            id="nama_paket" value="{{ old('nama_paket', $FADHIL_paket->nama_paket) }}" />
                        @error('nama_paket')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lama_proses" class="text-neutral-500 dark:text-neutral-400">Lama Proses:</label>
                        <input type="number" name="lama_proses"
                            class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('lama_proses') border-red-500 @enderror"
                            id="lama_proses" value="{{ old('lama_proses', $FADHIL_paket->lama_proses) }}" />
                        @error('lama_proses')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="text-neutral-500 dark:text-neutral-400">Harga:</label>
                        <input type="number" name="harga"
                            class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('harga') border-red-500 @enderror"
                            id="harga" value="{{ old('harga', $FADHIL_paket->harga) }}" />
                        @error('harga')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </form>
            </div>

            <!-- Modal footer -->
            <div
                class="flex flex-wrap items-center justify-end flex-shrink-0 gap-2 p-4 border-t-2 rounded-b-md border-neutral-100 dark:border-white/10">
                <button type="button"
                    class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-200 focus:bg-primary-accent-200 focus:outline-none focus:ring-0 active:bg-primary-accent-200 dark:bg-primary-300 dark:hover:bg-primary-400 dark:focus:bg-primary-400 dark:active:bg-primary-400"
                    data-twe-modal-dismiss data-twe-ripple-init data-twe-ripple-color="light">
                    Batal
                </button>
                <button type="submit" form="paketFormEdit{{ $FADHIL_paket->id }}"
                    class="ms-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                    data-twe-ripple-init data-twe-ripple-color="light">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>
</div>
