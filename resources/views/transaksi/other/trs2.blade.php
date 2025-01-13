    <!-- Form Transaksi -->
    <form action="" method="POST">
        @csrf

        <!-- Kode Invoice -->
        {{-- <div class="mb-4">
                    <label for="kode_invoice" class="block font-medium text-gray-700">Kode Invoice:</label>
                    <input type="text" name="kode_invoice" id="kode_invoice"
                        class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('id_outlet') border-red-500 @enderror bg-gray-200 cursor-not-allowed"
                        value="{{ old('kode_invoice') }}" readonly>
                </div> --}}

        <!-- Opsi Pilih Pelanggan -->
        <div class="mb-4">
            <label for="pelanggan" class="block font-medium text-gray-700">Pilih Pelanggan:</label>
            <select id="pelanggan" name="pelanggan"
                class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('jenis') border-red-500 @enderror">
                <option value="member">Member</option>
                <option value="biasa">Pelanggan Biasa</option>
            </select>
        </div>

        <!-- Data Member (Trigger Modal) -->
        <div id="member-options" class="hidden mb-4">
            <button type="button" class="text-blue-600 underline" onclick="showMemberModal()">Pilih
                Member</button>
        </div>

        <!-- Data Pelanggan Biasa -->
        <div id="biasa-options" class="hidden">
            <div class="mb-4">
                <label for="nama_pelanggan" class="block font-medium text-gray-700">Nama Pelanggan:</label>
                <input type="text" name="nama_pelanggan" id="nama_pelanggan"
                    class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('jenis') border-red-500 @enderror">
            </div>
            <div class="mb-4">
                <label for="alamat" class="block font-medium text-gray-700">Alamat:</label>
                <textarea name="alamat" id="alamat"
                    class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('jenis') border-red-500 @enderror"></textarea>
            </div>
            <div class="mb-4">
                <label for="tlp" class="block font-medium text-gray-700">Telepon:</label>
                <input type="text" name="tlp" id="tlp" maxlength="15"
                    class="mt-2 relative m-0 -me-0.5 block w-full flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-inset focus:outline-none dark:border-neutral-500 dark:bg-body-dark dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary @error('jenis') border-red-500 @enderror">
            </div>
        </div>

        <!-- Paket Laundry -->
        <div class="mb-4">
            <label for="id_paket" class="block font-medium text-gray-700">Jenis Paket:</label>
            <select id="id_paket" name="id_paket"
                class="block w-full mt-1 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                <option value="">Pilih Paket</option>
                <!-- Options Paket Laundry -->
            </select>
        </div>

        <!-- Tarif (Hari) -->
        <div class="mb-4">
            <label for="tarif" class="block font-medium text-gray-700">Tarif (Hari):</label>
            <input type="number" name="tarif" id="tarif"
                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        </div>

        <!-- Tanggal Selesai -->
        <div class="mb-4">
            <label for="tgl_selesai" class="block font-medium text-gray-700">Tanggal Selesai:</label>
            <input type="date" name="tgl_selesai" id="tgl_selesai"
                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        </div>

        <!-- Jumlah (Kg) -->
        <div class="mb-4">
            <label for="jumlah" class="block font-medium text-gray-700">Jumlah (Kg):</label>
            <input type="number" name="jumlah" id="jumlah" step="0.1"
                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        </div>

        <!-- Catatan -->
        <div class="mb-4">
            <label for="catatan" class="block font-medium text-gray-700">Catatan:</label>
            <textarea name="catatan" id="catatan"
                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">Simpan
                Transaksi</button>
        </div>
    </form>
    </div>
    </div>

    <!-- Modal Member -->
    <div id="memberModal"
        class="fixed top-0 left-0 flex items-center justify-center hidden w-full h-full bg-black bg-opacity-50">
        <div class="w-1/2 p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-lg font-bold text-gray-800">Pilih Member</h2>
            <!-- Content untuk memilih member -->
            <button onclick="closeMemberModal()" class="mt-4 text-blue-500">Tutup</button>
        </div>
    </div>

    <script>
        // Tampilkan opsi berdasarkan pilihan pelanggan
        document.getElementById('pelanggan').addEventListener('change', function() {
            const memberOptions = document.getElementById('member-options');
            const biasaOptions = document.getElementById('biasa-options');
            if (this.value === 'member') {
                memberOptions.classList.remove('hidden');
                biasaOptions.classList.add('hidden');
            } else {
                memberOptions.classList.add('hidden');
                biasaOptions.classList.remove('hidden');
            }
        });

        // Fungsi untuk membuka dan menutup modal member
        function showMemberModal() {
            document.getElementById('memberModal').classList.remove('hidden');
        }

        function closeMemberModal() {
            document.getElementById('memberModal').classList.add('hidden');
        }
    </script>
