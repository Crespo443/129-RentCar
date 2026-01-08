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
    <header>
        <nav class="bg-sec-600 border-gray-200 px-4 lg:px-6 py-4 mb-8">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                {{-- LOGO --}}
                <a href="#" class="flex items-center">
                    <img loading="lazy" src="/storage/images/logos/loogo2.png" class="mr-3 h-12" alt="Flowbite Logo" />
                </a>
                <div class="hidden justify-between mb-6 items-center w-full lg:flex lg:w-auto" id="mobile-menu-2">
                    <ul class="flex flex-col  font-medium lg:flex-row lg:space-x-8 lg:mt-0 ">
                        <li>
                            <a href='/admin/dashboard'>
                                <div class="group text-center">
                                    <div class="group-hover:cursor-pointer">Dasbor</div>
                                    <div
                                        class="block invisible bg-pr-400 w-20 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                    </div>
                            </a>

                        </li>

                        <li class=' '>
                            <a href="/admin/cars">
                                <div class="group text-center">
                                    <div class="group-hover:cursor-pointer ">Cars</div>
                                    <div
                                        class="block invisible bg-pr-400 w-8 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                    </div>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/reviews">
                                <div class="group text-center">
                                    <div class="group-hover:cursor-pointer">Ulasan</div>
                                    <div
                                        class="block invisible bg-pr-400 w-12 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                    </div>
                            </a>
                        </li>

                    </ul>
                </div>
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                    class="text-black bg-pr-400 hover:bg-pr-600 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center "
                    type="button">
                    <img loading="lazy" src="/storage/images/user.png" width="24" alt="user icon" class="mr-3">
                    <p> Admin</p>
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>

                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="/admin/dashboard" class="block px-4 py-2 hover:bg-pr-200">Admin</a>
                        </li>
                        <li>
                            <a class="block px-4 py-2 hover:bg-pr-200 " href="/logout"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="/logout" method="POST" class="hidden">
                                @csrf
                            </form>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="my-20 flex flex-col justify-center items-center mx-auto max-w-screen-xl">
        <a href="/admin/cars/create">
            <button
                class="mb-6 bg-orange-500 p-2 text-white drop-shadow-lg hover:bg-orange-600 hover:cursor-pointer rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8 inline">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Tambah Mobil
            </button>
        </a>
        <div class=" relative overflow-x-auto shadow-md sm:rounded-lg w-full  ">
            <table class="w-full text-sm text-left text-gray-500 mx-2">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Gambar
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Merek
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Model
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Mesin
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Harga per Hari
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nomor Polisi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tahun
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mobil 1: Toyota Avanza -->
                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="w-16 h-16 rounded-lg border-2 border-orange-500 overflow-hidden">
                                <img loading="lazy"
                                    src="https://tse2.mm.bing.net/th/id/OIP.8NigPGR5EtQOGZPAn_gpPgHaEo?cb=ucfimgc2&rs=1&pid=ImgDetMain&o=7&rm=3"
                                    alt="Toyota Avanza" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Toyota
                        </th>
                        <td class="px-6 py-4">
                            Avanza
                        </td>
                        <td class="px-6 py-4">
                            1.5L
                        </td>
                        <td class="px-6 py-4">
                            Rp 350.000
                        </td>
                        <td class="px-6 py-4 font-semibold text-blue-600">
                            B 1234 XYZ
                        </td>
                        <td class="px-6 py-4">
                            2023
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                Tersedia
                            </span>
                        </td>
                        <td class="flex my-4 py-3 px-6 space-x-3">
                            <a href="/admin/cars/1/edit" class="font-medium text-blue-600 hover:underline">Edit</a>
                            <button onclick="hapusMobil(1, 'Toyota Avanza')"
                                class="font-medium text-red-600 hover:underline">Hapus</button>
                        </td>
                    </tr>

                    <!-- Mobil 2: Honda CR-V -->
                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="w-16 h-16 rounded-lg border-2 border-orange-500 overflow-hidden">
                                <img loading="lazy"
                                    src="https://tse2.mm.bing.net/th/id/OIP.8NigPGR5EtQOGZPAn_gpPgHaEo?cb=ucfimgc2&rs=1&pid=ImgDetMain&o=7&rm=3"
                                    alt="Honda CR-V" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Honda
                        </th>
                        <td class="px-6 py-4">
                            CR-V
                        </td>
                        <td class="px-6 py-4">
                            2.0L Turbo
                        </td>
                        <td class="px-6 py-4">
                            Rp 750.000
                        </td>
                        <td class="px-6 py-4 font-semibold text-blue-600">
                            DD 5678 ABC
                        </td>
                        <td class="px-6 py-4">
                            2024
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                Disewa
                            </span>
                        </td>
                        <td class="flex my-4 py-3 px-6 space-x-3">
                            <a href="/admin/cars/2/edit" class="font-medium text-blue-600 hover:underline">Edit</a>
                            <button onclick="hapusMobil(2, 'Honda CR-V')"
                                class="font-medium text-red-600 hover:underline">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Fungsi hapus mobil dengan konfirmasi
        function hapusMobil(id, namaMobil) {
            Swal.fire({
                title: 'Hapus Mobil?',
                text: 'Apakah Anda yakin ingin menghapus ' + namaMobil + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data ' + namaMobil + ' berhasil dihapus',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        }
    </script>
</body>

</html>
