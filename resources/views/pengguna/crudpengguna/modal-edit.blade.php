<div data-twe-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="pengguna-edit{{ $FADHIL_pengguna->id }}" data-twe-backdrop="static" data-twe-keyboard="false" tabindex="-1"
    aria-labelledby="pengguna-editLabel" aria-hidden="true">
    <div data-twe-modal-dialog-ref
        class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
        <div
            class="relative flex flex-col w-full text-current bg-white border-none rounded-md outline-none pointer-events-auto bg-clip-padding shadow-4 dark:bg-surface-dark">
            <div
                class="flex items-center justify-between flex-shrink-0 p-4 border-b-2 rounded-t-md border-neutral-100 dark:border-white/10">
                <!--Modal title-->
                <h5 class="text-xl font-medium leading-normal text-surface dark:text-white" id="exampleModalLabel">
                    Edit Pengguna
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
                <form action="{{ route('pengguna.update', $FADHIL_pengguna->id) }}" method="POST"
                    id="penggunaFormEdit{{ $FADHIL_pengguna->id }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="text-neutral-500 dark:text-neutral-400">Nama Lengkap:</label>
                        <input type="text" name="nama"
                            class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('nama') border-red-500 @enderror"
                            id="nama" value="{{ old('nama', $FADHIL_pengguna->nama) }}" />
                        @error('nama')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="username" class="text-neutral-500 dark:text-neutral-400">Username:</label>
                        <input type="text" name="username"
                            class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('username') border-red-500 @enderror"
                            id="username" value="{{ old('username', $FADHIL_pengguna->username) }}" />
                        @error('username')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="text-neutral-500 dark:text-neutral-400">Password:</label>
                        <input type="password" name="password" maxlength="20"
                            class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('password') border-red-500 @enderror"
                            id="password" placeholder="Password pengguna baru (jika ingin diubah)" />
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    @if (Auth()->user()->role == 'super_admin')
                        <div class="mb-3">
                            <label for="id_outlet" class="text-neutral-500 dark:text-neutral-400">Nama Outlet:</label>
                            <select name="id_outlet" id="id_outlet"
                                class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('id_outlet') border-red-500 @enderror">
                                <option value="" disabled selected>-- Pilih Outlet --</option>
                                @foreach ($FADHIL_outlets as $FADHIL_outlet)
                                    <option value="{{ $FADHIL_outlet->id }}"
                                        {{ $FADHIL_outlet->id == $FADHIL_pengguna->id_outlet ? 'selected' : '' }}>
                                        {{ $FADHIL_outlet->nama }}
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

                    @if (Auth()->user()->role == 'super_admin')
                        <div class="mb-3">
                            <label for="role" class="text-neutral-500 dark:text-neutral-400">Role:</label>
                            <select name="role" id="role"
                                class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('role') border-red-500 @enderror">
                                <option value="" disabled
                                    {{ old('role', $FADHIL_pengguna->role) == '' || !in_array($FADHIL_pengguna, ['admin', 'kasir', 'owner']) ? 'selected' : '' }}>
                                    -- Pilih Role --</option>
                                <option value="admin"
                                    {{ old('role', $FADHIL_pengguna->role) == 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>
                                <option value="kasir"
                                    {{ old('role', $FADHIL_pengguna->role) == 'kasir' ? 'selected' : '' }}>
                                    Kasir
                                </option>
                                <option value="owner"
                                    {{ old('role', $FADHIL_pengguna->role) == 'owner' ? 'selected' : '' }}>
                                    Owner
                                </option>
                            </select>
                            @error('role')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @elseif (Auth()->user()->role == 'admin')
                        <div class="mb-3">
                            <label for="role" class="text-neutral-500 dark:text-neutral-400">Role:</label>
                            <select name="role" id="role"
                                class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('role') border-red-500 @enderror">
                                <option value="" disabled
                                    {{ old('role', $FADHIL_pengguna->role) == '' || !in_array($FADHIL_pengguna, ['kasir', 'owner']) ? 'selected' : '' }}>
                                    -- Pilih Role --</option>
                                <option value="kasir"
                                    {{ old('role', $FADHIL_pengguna->role) == 'kasir' ? 'selected' : '' }}>
                                    Kasir
                                </option>
                                <option value="owner"
                                    {{ old('role', $FADHIL_pengguna->role) == 'owner' ? 'selected' : '' }}>
                                    Owner
                                </option>
                            </select>
                            @error('role')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
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
                <button type="submit" form="penggunaFormEdit{{ $FADHIL_pengguna->id }}"
                    class="ms-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                    data-twe-ripple-init data-twe-ripple-color="light">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>
</div>
