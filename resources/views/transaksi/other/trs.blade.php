<!-- resources/views/transaksi/create.blade.php -->

<x-layout>
    <div class="py-12 bg-gray-100">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="mb-6 text-2xl font-semibold">Checkout</h2>
                    <p class="mb-6 text-gray-600">Selesaikan pembayaran untuk barang yang Anda beli</p>

                    <form action="" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Kolom Kiri -->
                            <div class="space-y-6">
                                <div>
                                    <h3 class="mb-2 text-lg font-medium">1. Informasi Kontak</h3>
                                    <div class="flex space-x-4">
                                        <div class="w-1/2">
                                            <label for="nama"
                                                class="block mb-1 text-sm font-medium text-gray-700">Nama</label>
                                            <input type="text" name="nama" id="nama"
                                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                placeholder="Masukkan nama">
                                        </div>
                                        <div class="w-1/2">
                                            <label for="email"
                                                class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                                            <input type="email" name="email" id="email"
                                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                placeholder="Masukkan email">
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="mb-2 text-lg font-medium">2. Metode Pengiriman</h3>
                                    <div class="space-y-2">
                                        <label class="flex items-center">
                                            <input type="radio" name="pengiriman" value="same-day"
                                                class="text-indigo-600 form-radio">
                                            <span class="ml-2">Pengiriman Hari Ini</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="pengiriman" value="express"
                                                class="text-indigo-600 form-radio">
                                            <span class="ml-2">Express</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="pengiriman" value="normal"
                                                class="text-indigo-600 form-radio">
                                            <span class="ml-2">Normal</span>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="mb-2 text-lg font-medium">3. Metode Pembayaran</h3>
                                    <div class="flex space-x-4">
                                        <button type="button"
                                            class="px-4 py-2 border rounded-md hover:bg-gray-50">Apple Pay</button>
                                        <button type="button"
                                            class="px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700">Google
                                            Pay</button>
                                        <button type="button"
                                            class="px-4 py-2 border rounded-md hover:bg-gray-50">Pay</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="p-6 rounded-lg bg-gray-50">
                                <h3 class="mb-4 text-lg font-medium">Ringkasan Pesanan</h3>
                                <div class="mb-4 space-y-2">
                                    <div class="flex justify-between">
                                        <span>36 item</span>
                                        <span>€ 581.00</span>
                                    </div>
                                    <div class="flex justify-between text-gray-600">
                                        <span>Diskon</span>
                                        <span>- € 100 (15%)</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Biaya Pengiriman</span>
                                        <span>€ 18.00</span>
                                    </div>
                                </div>
                                <div class="pt-4 border-t">
                                    <div class="flex justify-between font-semibold">
                                        <span>Total</span>
                                        <span>€ 499.00</span>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="w-full px-4 py-2 mt-6 text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                                    Bayar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
