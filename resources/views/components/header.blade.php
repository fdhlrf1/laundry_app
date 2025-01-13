<header class="bg-white shadow-sm">
    <div class="container px-4 py-[12px] mx-auto">
        <div class="flex items-center justify-between">
            <!-- Bagian Kiri -->
            <div class="flex items-center space-x-4">
                {{-- <button class="text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button> --}}


            </div>

            <!-- Bagian Kanan -->

            <div class="flex items-center space-x-6">
                <div class="text-center">
                    <p class="text-sm font-normal opacity-75">Welcome</p>
                    <p class="text-md font-semibold">{{ Auth()->user()->nama }}</p>
                </div>
                <div class="text-center">
                    <p class="text-sm font-normal opacity-75">Role</p>
                    <p class="text-md font-semibold">{{ Auth()->user()->role }}</p>
                </div>
                <div class="text-center">
                    <p class="text-sm font-normal opacity-75">Outlet</p>
                    <p class="text-md font-semibold">{{ session('nama_outlet') ?? 'Laundry Jaya Pusat' }}</p>
                </div>
                {{-- <button
                    class="bg-white text-blue-600 hover:bg-blue-100 px-4 py-2 rounded-full font-medium transition duration-300 ease-in-out">
                    Logout
                </button> --}}
            </div>
        </div>
    </div>
</header>

{{-- Border sebagai pemisah --}}
<div class="border-b border-gray-200"></div>
