<x-layout>
    <div class="py-2 bg-white shadow-[0_1px_3px_rgba(0,0,0,0.15)]">
        <div class="container px-4 mx-auto">
            <div class="flex items-center justify-between">
                <h1 class="text-lg font-bold text-gray-800 uppercase">{{ $title }}</h1>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="mb-6 text-2xl font-semibold">Transaksi Laundry</h2>
                {{-- <p class="mb-6 text-gray-600">Isi formulir untuk memulai transaksi laundry</p> --}}
                <form action="" method="POST" id="transactionForm" class="space-y-6">
                    @csrf
                    <div class="space-y-6">
                        <div class="mb-4">
                            <label for="kode_invoice" class="block font-medium text-gray-700">Kode
                                Invoice:</label>
                            <input type="text" name="kode_invoice" id="kode_invoice"
                                class="block w-full px-3 py-2 mt-2 bg-gray-200 border border-gray-300 rounded-md shadow-sm cursor-not-allowed focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                value="{{ old('kode_invoice', 'INV-' . date('Ymd') . '-' . rand(1000, 9999)) }}"
                                readonly>
                        </div>

                        <div>
                            <h3 class="mb-2 text-lg font-medium">1. Pilih Jenis Pelanggan</h3>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_pelanggan" value="member"
                                        class="text-indigo-600 form-radio" onchange="toggleCustomerForm()">
                                    <span class="ml-2">Member</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_pelanggan" value="non_member"
                                        class="text-indigo-600 form-radio" onchange="toggleCustomerForm()">
                                    <span class="ml-2">Pelanggan Biasa</span>
                                </label>
                            </div>
                        </div>

                        <div id="memberSelection" class="hidden">
                            <button type="button" onclick="openMemberModal()"
                                class="px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                                Pilih Member
                            </button>
                        </div>

                        <div id="nonMemberForm" class="hidden space-y-4">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                                <input type="text" name="nama" id="nama"
                                    class="block w-full px-3 py-2 mt-2 bg-white border border-white rounded-sm focus:outline-none focus:ring-white focus:border-white sm:text-sm">
                                <hr class="mt-1 border-gray-300">
                            </div>

                            <div>
                                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                                <textarea name="alamat" id="alamat" rows="3"
                                    class="block w-full px-3 py-2 mt-2 bg-white border border-white rounded-sm focus:outline-none focus:ring-white focus:border-white sm:text-sm"></textarea>
                                <hr class="mt-1 border-gray-300">
                            </div>

                            <div>
                                <label for="telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
                                <input type="tel" name="telepon" id="telepon"
                                    class="block w-full px-3 py-2 mt-2 bg-white border border-white rounded-sm focus:outline-none focus:ring-white focus:border-white sm:text-sm">
                                <hr class="mt-1 border-gray-300">
                            </div>


                        </div>

                        <div>
                            <h3 class="mb-2 text-lg font-medium">2. Informasi Laundry</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="jenis_paket" class="block text-sm font-medium text-gray-700">Jenis
                                        Paket</label>
                                    <select name="jenis_paket" id="jenis_paket"
                                        class="block w-full px-3 py-2 mt-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="">Pilih Jenis Paket</option>
                                        <option value="kilat">Cuci Kilat</option>
                                        <option value="regular">Cuci Regular</option>
                                        <option value="dry_clean">Dry Clean</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="tarif" class="block text-sm font-medium text-gray-700">Tarif
                                        per Hari</label>
                                    <input type="number" name="tarif" id="tarif"
                                        class="block w-full px-3 py-2 mt-0 bg-white border border-white rounded-sm focus:outline-none focus:ring-white focus:border-white sm:text-sm">
                                    <hr class="mt-1 border-gray-300">
                                </div>
                                <div>
                                    <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah
                                        (Kg)</label>
                                    <input type="number" name="jumlah" id="jumlah"
                                        class="block w-full px-3 py-2 mt-0 bg-white border border-white rounded-sm focus:outline-none focus:ring-white focus:border-white sm:text-sm">
                                    <hr class="mt-1 border-gray-300">
                                </div>
                                <div>
                                    <label for="catatan"
                                        class="block text-sm font-medium text-gray-700">Catatan</label>
                                    <textarea name="catatan" id="catatan" rows="3"
                                        class="block w-full px-3 py-2 mt-0 bg-white border border-white rounded-sm focus:outline-none focus:ring-white focus:border-white sm:text-sm"></textarea>
                                    <hr class="mt-1 border-gray-300">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="p-6 rounded-lg bg-gray-50">
                        <h3 class="mb-4 text-lg font-medium">Ringkasan Transaksi</h3>
                        <div class="mb-4 space-y-2">
                            <div class="flex justify-between">
                                <span>Total Berat</span>
                                <span id="totalBerat">0 Kg</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Tarif per Hari</span>
                                <span id="tarifPerHari">Rp 0</span>
                            </div>
                            <div class="flex justify-between font-semibold">
                                <span>Total</span>
                                <span id="totalHarga">Rp 0</span>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                            Proses Transaksi
                        </button>
                    </div>

                </form>
            </div>
        </div>
        {{-- </div> --}}
    </div>


    <!-- Modal untuk memilih member -->
    <div id="memberModal" class="fixed inset-0 z-10 hidden overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Pilih Member</h3>
                    <div class="mt-2">
                        <!-- Isi dengan daftar member atau form pencarian -->
                        <p>Daftar member akan ditampilkan di sini.</p>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
                        onclick="closeMemberModal()">
                        Pilih
                    </button>
                    <button type="button"
                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        onclick="closeMemberModal()">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleCustomerForm() {
            const memberSelection = document.getElementById('memberSelection');
            const nonMemberForm = document.getElementById('nonMemberForm');
            const jenisPelanggan = document.querySelector('input[name="jenis_pelanggan"]:checked').value;

            if (jenisPelanggan === 'member') {
                memberSelection.classList.remove('hidden');
                nonMemberForm.classList.add('hidden');
            } else {
                memberSelection.classList.add('hidden');
                nonMemberForm.classList.remove('hidden');
            }
        }

        function openMemberModal() {
            document.getElementById('memberModal').classList.remove('hidden');
        }

        function closeMemberModal() {
            document.getElementById('memberModal').classList.add('hidden');
        }

        // Fungsi untuk menghitung total harga
        function hitungTotal() {
            const jumlah = parseFloat(document.getElementById('jumlah').value) || 0;
            const tarif = parseFloat(document.getElementById('tarif').value) || 0;
            const total = jumlah * tarif;

            document.getElementById('totalBerat').textContent = jumlah + ' Kg';
            document.getElementById('tarifPerHari').textContent = 'Rp ' + tarif.toLocaleString('id-ID');
            document.getElementById('totalHarga').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Event listener untuk input jumlah dan tarif
        document.getElementById('jumlah').addEventListener('input', hitungTotal);
        document.getElementById('tarif').addEventListener('input', hitungTotal);

        // Inisialisasi form
        document.addEventListener('DOMContentLoaded', function() {
            toggleCustomerForm();
        });
    </script>
</x-layout>
