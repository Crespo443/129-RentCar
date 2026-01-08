<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'RentCar') }}</title>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- flatpickr JS --}}
    @include('flatpickr::components.style')
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-sec-400">
    <!-- Navigation -->
    <header>
        <nav class="bg-sec-600 border-gray-200 px-4 lg:px-6 py-4">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                {{-- LOGO --}}
                <a href="/home" class="flex items-center">
                    <img loading="lazy" src="/storage/images/logos/logo2.png" class="mr-3 h-12" alt="Flowbite Logo" />
                </a>

                {{-- Client Menu --}}
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="/home">
                                <div class="group text-center">
                                    <div class="group-hover:cursor-pointer">Beranda</div>
                                    <div
                                        class="block invisible bg-pr-400 w-12 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/cars">
                                <div class="group text-center">
                                    <div class="group-hover:cursor-pointer">Mobil</div>
                                    <div
                                        class="block invisible bg-pr-400 w-8 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Client Dropdown --}}
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                    class="text-black bg-pr-400 hover:bg-pr-600 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center "
                    type="button">
                    <img loading="lazy" src="/storage/images/user.png" width="24" alt="user icon" class="mr-3">
                    Test User
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="/profile" class="block px-4 py-2 hover:bg-pr-200">Profil</a>
                        </li>
                        <li>
                            <a class="block px-4 py-2 hover:bg-pr-200 " href="/logout"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                Keluar
                            </a>
                            <form id="logout-form" action="/logout" method="POST" class="hidden">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>

                {{-- Mobile menu toggle --}}
                <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Buka menu utama</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </nav>
    </header>


    <div class="flex flex-wrap justify-between items-start mx-auto max-w-screen-xl py-8">
        <div class="flex flex-col flex-1 w-full">
            <main class="h-full">
                <div class="container px-6 mx-auto">
                    <!-- Header -->
                    <div class="mb-8">
                        <nav class="flex" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                                <li class="inline-flex items-center">
                                    <a href="/"
                                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-orange-600">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-3a1 1 0 011-1h2a1 1 0 011 1v3a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                            </path>
                                        </svg>
                                        Beranda
                                    </a>
                                </li>
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Pembayaran</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>

                        <h1 class="text-3xl font-bold text-gray-800 mt-4">Pembayaran Sewa Mobil</h1>
                        <p class="text-gray-600 mt-2">Selesaikan pembayaran untuk melanjutkan reservasi Anda</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Payment Form -->
                        <div class="lg:col-span-2">
                            <div class="bg-white rounded-xl shadow-lg p-6">
                                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Detail Pembayaran</h2>


                                <!-- Payment Button -->

                                <div class="space-y-4">
                                    <div class="p-4 bg-orange-50 rounded-lg border border-orange-200">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-orange-600 mr-2" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z">
                                                </path>
                                            </svg>
                                            <span class="text-orange-800 font-medium">Pembayaran Aman dengan
                                                Midtrans</span>
                                        </div>
                                        <p class="text-orange-700 text-sm mt-1">Berbagai metode pembayaran
                                            tersedia:
                                            Credit
                                            Card, Bank Transfer, E-Wallet, dll.</p>
                                    </div>

                                    <button id="payButton" onclick="processPayment()"
                                        class="w-full flex justify-center items-center px-6 py-4 border border-transparent text-lg font-medium rounded-lg text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 transition-all duration-200 shadow-lg hover:shadow-xl">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                            </path>
                                        </svg>
                                        Bayar Sekarang
                                    </button>
                                </div>

                            </div>

                            <!-- Payment Methods Info -->
                            <div class="mt-8 bg-white rounded-xl shadow-lg p-6">
                                <h3 class="text-xl font-semibold text-gray-800 mb-4">Metode Pembayaran</h3>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <!-- Cash -->
                                    <div
                                        class="group text-center p-4 border-2 border-gray-200 rounded-lg hover:border-blue-500 hover:shadow-md transition-all duration-200 cursor-pointer hover:bg-blue-50">
                                        <div
                                            class="w-16 h-12 mx-auto mb-3 bg-blue-600 rounded-lg flex items-center justify-center shadow-md group-hover:shadow-lg transition-shadow">
                                            <span class="text-white text-lg font-bold">💳</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">Cash</span>
                                    </div>
                                    <!-- GoPay -->
                                    <div
                                        class="group text-center p-4 border-2 border-gray-200 rounded-lg hover:border-green-500 hover:shadow-md transition-all duration-200 cursor-pointer hover:bg-green-50">
                                        <div
                                            class="w-16 h-12 mx-auto mb-3 bg-green-600 rounded-lg flex items-center justify-center shadow-md group-hover:shadow-lg transition-shadow">
                                            <span class="text-white text-lg font-bold">🏪</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">GoPay</span>
                                    </div>
                                    <!-- Bank Transfer -->
                                    <div
                                        class="group text-center p-4 border-2 border-gray-200 rounded-lg hover:border-red-500 hover:shadow-md transition-all duration-200 cursor-pointer hover:bg-red-50">
                                        <div
                                            class="w-16 h-12 mx-auto mb-3 bg-red-600 rounded-lg flex items-center justify-center shadow-md group-hover:shadow-lg transition-shadow">
                                            <span class="text-white text-lg font-bold">🏦</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">Bank BCA</span>
                                    </div>
                                    <!-- ShopeePay -->
                                    <div
                                        class="group text-center p-4 border-2 border-gray-200 rounded-lg hover:border-orange-500 hover:shadow-md transition-all duration-200 cursor-pointer hover:bg-orange-50">
                                        <div
                                            class="w-16 h-12 mx-auto mb-3 bg-orange-600 rounded-lg flex items-center justify-center shadow-md group-hover:shadow-lg transition-shadow">
                                            <span class="text-white text-lg font-bold">🛍️</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">ShopeePay</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reservation Summary -->
                        <div class="lg:col-span-1">
                            <div class="bg-white rounded-xl shadow-lg p-6 sticky top-8">
                                <h3 class="text-xl font-semibold text-gray-800 mb-4">Ringkasan Pesanan</h3>

                                <!-- Car Info -->
                                <div class="flex items-center space-x-4 mb-6">
                                    <img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?w=400"
                                        alt="BMW X5" class="w-16 h-12 object-cover rounded-lg">
                                    <div>
                                        <h4 class="font-semibold text-gray-800">BMW X5</h4>
                                        <p class="text-sm text-gray-600">Luxury SUV</p>
                                    </div>
                                </div>

                                <!-- Booking Details -->
                                <div class="space-y-3 mb-6">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Tanggal Mulai</span>
                                        <span class="font-medium">12/11/2025</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Tanggal Selesai</span>
                                        <span class="font-medium">15/11/2025</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Durasi</span>
                                        <span class="font-medium">3 hari</span>
                                    </div>
                                </div>

                                <!-- Price Breakdown -->
                                <div class="border-t pt-4">
                                    <div class="space-y-2 mb-4">
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-600">Harga per hari</span>
                                            <span>Rp 960.000</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-600">Jumlah hari</span>
                                            <span>3 hari</span>
                                        </div>
                                    </div>
                                    <div class="border-t pt-3">
                                        <div class="flex justify-between items-center">
                                            <span class="text-lg font-semibold text-gray-800">Total
                                                Pembayaran</span>
                                            <span class="text-xl font-bold text-orange-600">Rp 2.880.000</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    </div>

    <script>
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function processPayment() {
            // Show success alert
            Swal.fire({
                title: 'Pembayaran Berhasil!',
                text: 'Terima kasih telah melakukan pembayaran.',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#f97316',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to home after alert is confirmed
                    window.location.href = '/home';
                }
            });
        }
    </script>
</body>

</html>
