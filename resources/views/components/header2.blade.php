<header class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <!-- Left Section -->
            <div class="flex items-center space-x-4">
                <button class="text-white hover:bg-blue-600 rounded-full p-2 transition duration-300 ease-in-out">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="text-2xl font-bold tracking-wider">LaundryPro</div>
            </div>

            <!-- Right Section -->
            <div class="flex items-center space-x-6">
                <div class="text-center">
                    <p class="text-sm font-medium opacity-75">Welcome</p>
                    <p class="text-lg font-semibold">{{ Auth()->user()->nama }}</p>
                </div>
                <div class="text-center">
                    <p class="text-sm font-medium opacity-75">Role</p>
                    <p class="text-lg font-semibold">{{ Auth()->user()->role }}</p>
                </div>
                <div class="text-center">
                    <p class="text-sm font-medium opacity-75">Outlet</p>
                    <p class="text-lg font-semibold">{{ session('nama_outlet') ?? 'Laundry Jaya Pusat' }}</p>
                </div>
                <button
                    class="bg-white text-blue-600 hover:bg-blue-100 px-4 py-2 rounded-full font-medium transition duration-300 ease-in-out">
                    Logout
                </button>
            </div>
        </div>
    </div>
</header>

{{-- Separator --}}
<div class="h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
