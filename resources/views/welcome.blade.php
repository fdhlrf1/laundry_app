<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Management System</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="hidden w-64 bg-white border-r border-gray-200 lg:block">
            <div class="flex items-center gap-2 px-6 py-4 border-b">
                <svg class="w-8 h-8 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                    </path>
                </svg>
                <span class="text-xl font-semibold text-gray-800">LaundryPro</span>
            </div>

            <nav class="p-4 space-y-2">
                <div class="text-xs font-semibold text-gray-400 uppercase">Menu</div>
                <a href="#"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg text-sky-600 bg-sky-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Dashboard
                </a>
                <a href="#"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                    Outlets
                </a>
                <a href="#"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Packages
                </a>
                <a href="#"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    Members
                </a>
                <a href="#"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                        </path>
                    </svg>
                    Transactions
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Top Navigation -->
            <header class="bg-white border-b border-gray-200">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex items-center">
                            <h1 class="text-2xl font-semibold text-gray-900">Welcome Back, {{ Auth::user()->name }}</h1>
                        </div>
                        <div class="flex items-center gap-4">
                            <button class="p-2 text-gray-400 bg-white rounded-full hover:text-gray-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                    </path>
                                </svg>
                            </button>
                            <div class="relative">
                                <button class="flex items-center gap-2 p-2">
                                    <img class="w-8 h-8 rounded-full"
                                        src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                                        alt="User avatar">
                                    <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Stats -->
                <div class="grid grid-cols-1 gap-6 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="p-6 bg-white rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-sky-100">
                                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-sm font-medium text-gray-600">Total Revenue</h2>
                                <p class="text-2xl font-semibold text-gray-900">Rp 2,480,000</p>
                                <p class="text-sm text-green-600">+2.15% from last month</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-sky-100">
                                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-sm font-medium text-gray-600">Total Orders</h2>
                                <p class="text-2xl font-semibold text-gray-900">230</p>
                                <p class="text-sm text-green-600">+1.25% from last month</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-sky-100">
                                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-sm font-medium text-gray-600">Total Members</h2>
                                <p class="text-2xl font-semibold text-gray-900">1,234</p>
                                <p class="text-sm text-green-600">+3.2% from last month</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-sky-100">
                                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-sm font-medium text-gray-600">Active Outlets</h2>
                                <p class="text-2xl font-semibold text-gray-900">5</p>
                                <p class="text-sm text-gray-500">Total locations</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Recent Transactions</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left bg-gray-50">
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">ID
                                    </th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">
                                        Customer</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">
                                        Package</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">
                                        Amount</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">
                                        Status</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">
                                        Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900">#1234</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">John Doe</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">Regular Wash</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">Rp 50,000</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">2024-01-15</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900">#1235</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">Jane Smith</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">Express Wash</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">Rp 75,000</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">Processing</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">2024-01-15</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
