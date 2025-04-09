<x-layout>
    <div class="py-2 bg-white shadow-[0_1px_3px_rgba(0,0,0,0.15)]">
        <div class="container px-4 mx-auto">
            <div class="flex items-center justify-between">
                <h1 class="text-lg font-bold text-gray-800 uppercase">{{ $title }}</h1>
            </div>
        </div>
    </div>

    @include('transaksi.modal.modal-member')
    @include('transaksi.modal.modal-paket')
    <div class="p-6">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="mb-6 text-2xl font-semibold">Tambah Transaksi</h2>
                {{-- <p class="mb-6 text-gray-600">Isi formulir untuk memulai transaksi laundry</p> --}}
                <form action="{{ route('transaksi.store') }}" method="POST" id="form-transaksi" class="space-y-6">
                    @csrf
                    <div class="space-y-6">
                        {{-- Kode Invoice --}}
                        <div class="mb-4">
                            <label for="kode_invoice" class="text-neutral-500 dark:text-neutral-400">Kode
                                Invoice:</label>
                            <input type="text" name="kode_invoice" id="kode_invoice"
                                class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-gray-200 bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary"
                                value="{{ old('FADHIL_kode_invoice', $FADHIL_kode_invoice) }}" readonly>
                        </div>
                        {{-- Pilih Pelanggan --}}
                        <div>
                            <h3 class="mb-2 text-lg font-medium">1. Pilih Jenis Pelanggan</h3>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_pelanggan" value="member" id="radio-member"
                                        class="text-indigo-600 form-radio" onchange="toggleCustomerForm()" required>
                                    <span class="ml-2 text-neutral-500 dark:text-neutral-400">Member</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_pelanggan" value="non_member"
                                        id="radio-non-member" class="text-indigo-600 form-radio"
                                        onchange="toggleCustomerForm()" required>
                                    <span class="ml-2 text-neutral-500 dark:text-neutral-400">Pelanggan Biasa</span>
                                </label>
                            </div>
                        </div>
                        {{-- Member --}}
                        <div id="memberSelection" class="hidden">
                            <button type="button" id="pilih-member-btn"
                                class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                                data-twe-toggle="modal" data-twe-target="#modal-member" data-twe-ripple-init
                                data-twe-ripple-color="light">
                                Pilih Member
                            </button>
                            <button type="button"
                                class="inline-block rounded bg-gray-500 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:bg-gray-400 focus:bg-gray-400 focus:outline-none focus:ring-0 active:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:bg-gray-500 dark:active:bg-gray-700"
                                onclick="resetRadioButtons()">
                                Reset
                            </button>


                            <div id="memberCard" class="w-[50%] p-6 mt-6 rounded-lg bg-gray-50">
                                <h3 class="mb-4 text-lg font-medium">Informasi Member</h3>
                                <div class="space-y-2">
                                    <input type="hidden" name="id_member" id="id_member">
                                    <div class="flex justify-between">
                                        <span>Nama</span>
                                        <span id="nama">-</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Alamat</span>
                                        <span id="alamat">-</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Jenis Kelamin</span>
                                        <span id="jenis_kelamin">-</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Telepon</span>
                                        <span id="tlp">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Non Member --}}
                        <div id="nonMemberForm" class="hidden space-y-4">
                            <div class="flex gap-4 space-x-4">
                                <div class="w-1/2">
                                    <label for="nama_pelanggan" class="text-neutral-500 dark:text-neutral-400">Nama
                                        Pelanggan</label>
                                    <input type="text" name="nama_pelanggan" id="nama_pelanggan"
                                        class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('nama_pelanggan') border-red-500 @enderror">
                                    @error('nama_pelanggan')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-1/2">
                                    <label for="telepon" class="text-neutral-500 dark:text-neutral-400">Telepon</label>
                                    <input type="number" name="telepon" id="telepon"
                                        class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('telepon') border-red-500 @enderror">
                                    @error('telepon')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="alamat" class="text-neutral-500 dark:text-neutral-400">Alamat</label>
                                <textarea name="alamat" id="alamat" rows="3"
                                    class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('alamat') border-red-500 @enderror"></textarea>
                                @error('alamat')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="reset"
                                class="inline-block rounded bg-gray-500 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:bg-gray-400 focus:bg-gray-400 focus:outline-none focus:ring-0 active:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:bg-gray-500 dark:active:bg-gray-700"
                                onclick="resetRadioButtons()">
                                Reset
                            </button>
                        </div>
                        {{-- Informasi --}}
                        <div>
                            <h3 class="mb-2 text-lg font-medium">2. Informasi Laundry</h3>
                            <input type="hidden" name="id_paket" id="id_paket">
                            <div class="flex space-x-4">
                                <div>
                                    <label for="pilih_paket_cucian"
                                        class="block mb-2 text-neutral-500 dark:text-neutral-400">Pilih Paket
                                        Cucian</label>
                                    <button type="button" id="pilih-paket-btn"
                                        class="w-32 mb-4 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                                        data-twe-toggle="modal" data-twe-target="#modal-paket" data-twe-ripple-init
                                        data-twe-ripple-color="light">
                                        Pilih Paket
                                    </button>
                                </div>
                                <div class="w-1/3">
                                    <label for="nama_paket" class="text-neutral-500 dark:text-neutral-400">Nama
                                        Paket</label>
                                    <input type="text" name="nama_paket" id="nama_paket"
                                        class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-gray-200 bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('nama_paket') border-red-500 @enderror"
                                        readonly>
                                    @error('nama_paket')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-1/3">
                                    <label for="jenis" class="text-neutral-500 dark:text-neutral-400">Jenis
                                    </label>
                                    <input type="text" name="jenis" id="jenis"
                                        class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-gray-200 bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('jenis') border-red-500 @enderror"
                                        readonly>
                                    @error('jenis')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-1/3">
                                    <label for="harga" class="text-neutral-500 dark:text-neutral-400">Harga</label>
                                    <input type="text" name="harga" id="harga"
                                        class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-gray-200 bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('harga') border-red-500 @enderror"
                                        readonly>
                                    @error('harga')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <!-- Harga dan kuantitas -->
                            <div class="flex space-x-4">
                                <div class="w-1/2">
                                    <label for="kuantitas" class="text-neutral-500 dark:text-neutral-400">Kuantitas
                                    </label>
                                    <input type="number" name="kuantitas" id="kuantitas"
                                        placeholder="Masukkan kuantitas (kg)/(item)" min="1"
                                        class="mb-2 mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('kuantitas') border-red-500 @enderror"
                                        required>
                                    @error('kuantitas')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-1/2">
                                    <label for="biaya_tambahan" class="text-neutral-500 dark:text-neutral-400">Biaya
                                        Tambahan</label>
                                    <input type="number" name="biaya_tambahan" id="biaya_tambahan"
                                        placeholder="Tambahkan biaya tambahan jika ada" min="1"
                                        class="mb-2 mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('biaya_tambahan') border-red-500 @enderror">
                                    @error('biaya_tambahan')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <!-- Catatan -->
                            <div>
                                <label for="keterangan" class="text-neutral-500 dark:text-neutral-400">Catatan</label>
                                <textarea name="keterangan" id="keterangan" rows="3" placeholder="Tambahkan keterangan"
                                    class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('keterangan') border-red-500 @enderror"></textarea>
                                @error('keterangan')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="p-6 rounded-lg bg-gray-50">
                        <h3 class="mb-4 text-lg font-medium">Ringkasan Transaksi</h3>
                        <div class="mb-4 space-y-2">
                            <input type="hidden" name="diskon" id="diskon">
                            <input type="hidden" name="pajak" id="pajak">
                            <input type="hidden" name="batas_waktu" id="batas_waktu">
                            <input type="hidden" name="total" id="total">
                            <!-- Nama Paket -->
                            <div class="flex justify-between">
                                <span>Nama Paket</span>
                                <span id="nama_paketSpan"></span>
                            </div>
                            <!-- qty -->
                            <div class="flex justify-between">
                                <span>Kuantitas</span>
                                <span id="kuantitasSpan"></span>
                            </div>
                            <!-- Harga -->
                            <div class="flex justify-between">
                                <span>Harga</span>
                                <span id="hargaSpan"></span>
                            </div>
                            <!-- Diskon -->
                            <div class="flex justify-between">
                                <span>Diskon</span>
                                <span id="diskonSpan"></span>
                            </div>
                            <!-- Pajak -->
                            <div class="flex justify-between">
                                <span>Pajak</span>
                                <span id="pajakSpan"></span>
                            </div>
                            <div class="flex justify-between">
                                <span>Biaya Tambahan</span>
                                <span id="biaya_tambahanSpan"></span>
                            </div>
                            <!-- Pajak -->
                            <div class="flex justify-between">
                                <span>Batas Waktu</span>
                                <span id="batas_waktuSpan"></span>
                            </div>
                            <!-- Total -->
                            <div class="flex justify-between font-semibold">
                                <span>Total</span>
                                <span id="totalSpan"></span>
                            </div>
                            <!-- Kolom Bayar -->
                            {{-- <div class="flex justify-between">
                                <span>Bayar</span>
                                <div class="flex items-center w-1/2">
                                    <span class="px-2">Rp</span>
                                    <input type="text" id="bayar" name="bayar"
                                        placeholder="Masukkan jumlah bayar"
                                        class="relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.10rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('kuantitas') border-red-500 @enderror"">
                                </div>
                            </div> --}}
                            <!-- Kolom Kembalian -->
                            {{-- <div class="flex justify-between font-semibold">
                                <span>Kembalian</span>
                                <span id="kembalianSpan"></span>
                            </div> --}}
                        </div>

                        <button type="submit" id="submitBtn"
                            class="w-full px-4 py-2 text-white rounded-md bg-sky-600 hover:bg-sky-700">
                            Proses Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleCustomerForm() {
            const FADHIL_memberSelection = document.getElementById('memberSelection');
            const FADHIL_nonMemberForm = document.getElementById('nonMemberForm');
            const FADHIL_jenisPelanggan = document.querySelector('input[name="jenis_pelanggan"]:checked').value;

            if (FADHIL_jenisPelanggan === 'member') {
                FADHIL_memberSelection.classList.remove('hidden');
                FADHIL_nonMemberForm.classList.add('hidden');
            } else {
                FADHIL_memberSelection.classList.add('hidden');
                FADHIL_nonMemberForm.classList.remove('hidden');
            }
        }

        // Inisialisasi form
        document.addEventListener('DOMContentLoaded', function() {
            toggleCustomerForm();
        });


        document.getElementById('submitBtn').addEventListener('click', function(event) {
            var FADHIL_jenisPelanggan = document.querySelector('input[name="jenis_pelanggan"]:checked');
            var FADHIL_namaPelanggan = document.getElementById('nama_pelanggan').value;
            var FADHIL_telepon = document.getElementById('telepon').value;
            var FADHIL_alamat = document.getElementById('alamat').value;
            var FADHIL_paket = document.getElementById('nama_paket').value;
            var FADHIL_pesanError = '';

            // Validasi jika jenis pelanggan adalah 'member'
            if (FADHIL_jenisPelanggan && FADHIL_jenisPelanggan.value === 'member') {
                var FADHIL_id_member = document.getElementById('id_member').value;
                if (FADHIL_id_member === '') {
                    FADHIL_pesanError = 'Harap pilih member terlebih dahulu!';
                }
            } else if (FADHIL_jenisPelanggan && FADHIL_jenisPelanggan.value === 'non_member') {
                // Validasi untuk pelanggan biasa (non_member)
                if (FADHIL_namaPelanggan === '' || FADHIL_telepon === '' || FADHIL_alamat === '') {
                    FADHIL_pesanError = 'Harap isikan nama, alamat, dan telepon pelanggan biasa!';
                }
            }

            // Validasi paket
            if (FADHIL_paket === '') {
                FADHIL_pesanError = 'Harap pilih paket terlebih dahulu!';
            }

            if (FADHIL_pesanError) {
                event.preventDefault();
                alert(FADHIL_pesanError);
            }
        });
    </script>

    <script>
        function resetRadioButtons() {
            const FADHIL_radioButtons = document.querySelectorAll('input[name="jenis_pelanggan"]');
            FADHIL_radioButtons.forEach(FADHIL_radio => {
                FADHIL_radio.checked = false;
                document.getElementById('radio-member').disabled = false;
                document.getElementById('radio-non-member').disabled = false;
            });
        }
    </script>

</x-layout>
