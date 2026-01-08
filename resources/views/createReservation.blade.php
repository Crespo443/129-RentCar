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
    <div class="mx-auto max-w-screen-xl bg-white rounded-md p-6 m-8 ">
        <div class="flex justify-between md:flex-row flex-col ">
            <!-- Left Section -->
            <div class="md:w-2/3  md:border-r border-gray-800 p-2">

                <h2 class=" ms-4 max-w-full font-bold md:text-6xl text-4xl">BMW X5 3.0L Turbo</h2>

                <div class=" flex items-end mt-8 ms-4">
                    <h3 class="text-gray-500 text-2xl">Harga:</h3>
                    <p>
                        <span
                            class=" text-3xl font-bold text-orange-500 ms-3 me-1 border border-orange-500 p-2 rounded-md">Rp
                            960.000</span>
                        <span class="text-lg font-medium text-red-500 line-through">Rp 1.200.000</span>
                    </p>
                </div>

                <div class=" flex items-center justify-around mt-10 me-10">
                    <div class="w-1/5 md:w-1/3 h-[0.25px] bg-gray-500 "> </div>
                    <p>Buat Reservasi</p>
                    <div class="w-1/5 md:w-1/3 h-[0.25px] bg-gray-500 "> </div>
                </div>

                <!-- Reservation Status Info -->
                <div class="px-6 me-8 mt-4">
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Status Reservasi Aktif</span>
                            </div>
                            <div class="text-right">
                                <span class="text-lg font-bold text-blue-600">0/2</span>
                                <p class="text-xs text-gray-500">reservasi aktif</p>
                            </div>
                        </div>

                        <div class="mt-3 p-3 bg-green-50 border border-green-200 rounded-md">
                            <p class="text-sm text-green-700">
                                Anda belum memiliki reservasi aktif. Anda bisa membuat hingga 2 reservasi aktif.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="px-6 md:me-8">
                    <form id="reservation_form" method="POST" action="/reservations/1">
                        @csrf
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                            <div class="sm:col-span-3">
                                <label for="full-name" class="block text-sm font-medium leading-6 text-gray-900">Nama
                                    Lengkap</label>
                                <div class="mt-2">
                                    <input type="text" name="full-name" id="full-name" value=""
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="email"
                                    class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                                <div class="mt-2">
                                    <input type="text" name="email" id="email" value=""
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            {{-- Custom Date Range Picker --}}
                            <div class="sm:col-span-full">
                                <label for="reservation_dates"
                                    class="block text-sm font-medium leading-6 text-gray-900 mb-2">Tanggal
                                    Reservasi</label>

                                <div class="relative">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Start Date -->
                                        <div class="date-input-container">
                                            <label
                                                class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Tanggal
                                                Mulai</label>
                                            <input type="date" id="start_date" name="start_date"
                                                class="block w-full rounded-lg border-2 border-gray-200 py-3 px-4 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 hover:border-gray-300 bg-white"
                                                min="2025-11-12">
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none mt-8">
                                                <svg class="w-5 h-5 text-gray-400" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>

                                        <!-- End Date -->
                                        <div class="date-input-container">
                                            <label
                                                class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Tanggal
                                                Selesai</label>
                                            <input type="date" id="end_date" name="end_date"
                                                class="block w-full rounded-lg border-2 border-gray-200 py-3 px-4 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 hover:border-gray-300 bg-white"
                                                min="2025-11-12">
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none mt-8">
                                                <svg class="w-5 h-5 text-gray-400" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hidden field for the range format -->
                                    <input type="hidden" id="reservation_dates" name="reservation_dates"
                                        value="">

                                    <!-- Debug Info (can be removed later) -->
                                    <div id="debug-info" class="mt-3 p-2 bg-gray-100 rounded text-xs text-gray-600"
                                        style="display: none;">
                                        <strong>Debug Info:</strong><br>
                                        Start Date: <span id="debug-start">-</span><br>
                                        End Date: <span id="debug-end">-</span><br>
                                        Hidden Field: <span id="debug-hidden">-</span>
                                    </div>

                                    <!-- Date Range Display -->
                                    <div id="date-range-display"
                                        class="mt-4 p-4 date-range-info border border-blue-200 rounded-xl hidden shadow-sm">
                                        <div class="flex items-center space-x-2 mb-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-sm font-semibold text-blue-800">📅 Periode
                                                Reservasi:</span>
                                            <span id="selected-range" class="text-sm text-blue-700 font-bold"></span>
                                        </div>
                                        <div class="grid grid-cols-2 gap-4 text-sm">
                                            <div class="bg-white/60 p-2 rounded-lg">
                                                <span class="text-blue-600 font-medium">⏱️ Durasi:</span>
                                                <span id="duration-days" class="font-bold text-blue-800 ml-1">0
                                                    hari</span>
                                            </div>
                                            <div class="bg-white/60 p-2 rounded-lg">
                                                <span class="text-blue-600 font-medium">💰 Total Estimasi:</span>
                                                <span id="total-estimate"
                                                    class="font-bold text-green-600 ml-1">$0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="mt-12 md:block hidden  ">
                            <button type="submit" id="submit-btn" onclick="alert('Berhasil Membuat Pesanan')"
                                class="text-white p-3 w-full rounded-lg font-bold shadow-xl transition-all duration-200 bg-orange-500 hover:bg-black hover:shadow-none">
                                Buat Reservasi
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            <!-- Right Section -->

            <div class="md:w-1/3 flex flex-col justify-start items-center">
                <div class="relative mx-3 mt-3 flex h-[200px] w-3/4   overflow-hidden rounded-xl shadow-lg">
                    <img loading="lazy" class="h-full w-full object-cover"
                        src="https://images.unsplash.com/photo-1555215695-3004980ad54e?w=400" alt="BMW X5" />
                    <span
                        class="absolute w-24 h-8 py-1 top-0 left-0 m-2 rounded-full bg-orange-500 px-2 text-center text-sm font-medium text-white">20%
                        OFF</span>
                </div>
                <p class=" ms-4 max-w-full text-xl mt-3 md:block hidden font-semibold">BMW X5 3.0L Turbo</p>
                <div class="mt-3 ms-4 md:block hidden">
                    <div class="flex items-center">
                        <svg aria-hidden="true" class="h-4 w-4 text-orange-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        <svg aria-hidden="true" class="h-4 w-4 text-orange-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        <svg aria-hidden="true" class="h-4 w-4 text-orange-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        <svg aria-hidden="true" class="h-4 w-4 text-orange-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        <svg aria-hidden="true" class="h-4 w-4 text-orange-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        <span
                            class="mr-2 ml-3 rounded bg-orange-400 px-2.5 py-0.5 text-sm font-semibold text-white">5.0</span>
                    </div>
                </div>

                <div class=" w-full   mt-8 ms-8">
                    <p id="duration" class="text-gray-600 text-lg ms-2">Durasi: <span
                            class="mx-2 text-md font-medium text-gray-700 border border-orange-500 p-2 rounded-md ">
                            2 Hari</span>
                    </p>
                </div>

                <div class=" w-full   mt-8 ms-8">
                    <p id="total-price" class="text-gray-600 text-lg ms-2">Harga: <span
                            class="mx-2 text-md font-medium text-gray-700 border border-orange-500 p-2 rounded-md ">
                            Rp 1.920.000
                        </span>
                    </p>
                </div>
                <div id="mobile_submit_button" class="mt-12 w-full md:hidden  ">
                    <button type="submit" onclick="submitReservation(event)"
                        class="text-white p-3 w-full rounded-lg font-bold shadow-xl transition-all duration-200 bg-orange-500 hover:bg-black hover:shadow-none">
                        Buat Reservasi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const pricePerDay = 960000;

        // Calculate duration and total price when dates change
        document.getElementById('start_date').addEventListener('change', updateCalculations);
        document.getElementById('end_date').addEventListener('change', updateCalculations);

        function updateCalculations() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (diffDays > 0 && end >= start) {
                    // Update duration display
                    document.getElementById('duration').innerHTML =
                        `Durasi: <span class="mx-2 text-md font-medium text-gray-700 border border-orange-500 p-2 rounded-md">${diffDays} Hari</span>`;

                    // Calculate and update total price
                    const totalPrice = diffDays * pricePerDay;
                    document.getElementById('total-price').innerHTML =
                        `Harga: <span class="mx-2 text-md font-medium text-gray-700 border border-orange-500 p-2 rounded-md">Rp ${totalPrice.toLocaleString('id-ID')}</span>`;

                    // Update date range display
                    const rangeDisplay = document.getElementById('date-range-display');
                    if (rangeDisplay) {
                        rangeDisplay.classList.remove('hidden');
                        document.getElementById('selected-range').textContent =
                            `${formatDate(start)} - ${formatDate(end)}`;
                        document.getElementById('duration-days').textContent = `${diffDays} hari`;
                        document.getElementById('total-estimate').textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
                    }

                    // Update hidden field
                    document.getElementById('reservation_dates').value = `${startDate} to ${endDate}`;
                } else {
                    alert('Tanggal selesai harus setelah tanggal mulai');
                    document.getElementById('end_date').value = '';
                }
            }
        }

        function formatDate(date) {
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            return date.toLocaleDateString('id-ID', options);
        }

        function submitReservation(event) {
            event.preventDefault();

            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const fullName = document.getElementById('full-name').value;
            const email = document.getElementById('email').value;

            if (!startDate || !endDate) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Mohon pilih tanggal mulai dan selesai!',
                    confirmButtonColor: '#f97316'
                });
                return false;
            }

            if (!fullName || !email) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Mohon lengkapi nama dan email!',
                    confirmButtonColor: '#f97316'
                });
                return false;
            }
            document.getElementById('reservation_form').submit();
        }
    </script>
</body>

</html>
