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
                                    <div class="group-hover:cursor-pointer ">Mobil</div>
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
                            <a href="/admin/dashboard" class="block px-4 py-2 hover:bg-pr-200">Dasbor</a>
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
            </div>
        </nav>
    </header>

    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
        <div class="flex flex-col flex-1 w-full">
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid mb-32">
                    <div class="flex justify-between items-center my-6">
                        <h2 class="text-3xl font-bold text-gray-800">Manajemen Ulasan</h2>
                    </div>

                    <!-- Filter Tabs -->
                    <div class="mb-6">
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex space-x-8">
                                <a href="#"
                                    class="border-pr-400 text-pr-600 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">Semua</a>
                                <a href="#"
                                    class="text-gray-500 hover:text-gray-700 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">Menunggu
                                    Persetujuan</a>
                                <a href="#"
                                    class="text-gray-500 hover:text-gray-700 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">Disetujui</a>
                            </nav>
                        </div>
                    </div>

                    <!-- Reviews List -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-md">
                        <ul class="divide-y divide-gray-200">

                            <!-- Review 1 -->
                            <li class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                                                    A</div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900">Ahmad Wijaya</p>
                                                    <p class="text-sm text-gray-500">ahmad.wijaya@email.com</p>
                                                </div>
                                            </div>

                                            <div class="flex items-center">

                                                <svg class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                <svg class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                <svg class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                <svg class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                <svg class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>

                                                <span class="ml-1 text-sm text-gray-600">(5/5)</span>
                                            </div>
                                        </div>

                                        <div class="mb-2">
                                            <span class="text-sm text-gray-500">Untuk mobil:</span>
                                            <a href="#"
                                                class="text-sm font-medium text-blue-600 hover:text-blue-500">Toyota
                                                Avanza
                                                (2023)</a>
                                        </div>

                                        <div class="mb-3">
                                            <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded">
                                                Mobil sangat bersih dan nyaman. Pelayanan sangat memuaskan!
                                            </p>
                                        </div>

                                        <div class="flex items-center justify-between text-xs text-gray-500">
                                            <div class="flex items-center space-x-4">
                                                <span>Dikirim: 2 hari lalu</span>
                                                <span>Reservasi #101</span>
                                                <span
                                                    class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-800">Disetujui</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ml-4 flex-shrink-0 flex space-x-2">
                                        <form method="POST" action="/admin/reviews/1">
                                            @csrf

                                            <button type="submit" onclick="alert('Berhasil Hapus Review')"
                                                class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1 rounded transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>

                            <!-- Review 2 -->
                            <li class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                                                    S</div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900">Siti Nurhaliza</p>
                                                    <p class="text-sm text-gray-500">siti.nur@email.com</p>
                                                </div>
                                            </div>

                                            <div class="flex items-center">

                                                <svg class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                <svg class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>

                                                <svg class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                <svg class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                <svg class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>


                                                <span class="ml-1 text-sm text-gray-600">(5/5)</span>
                                            </div>

                                        </div>

                                        <div class="mb-2">
                                            <span class="text-sm text-gray-500">Untuk mobil:</span>
                                            <a href="#"
                                                class="text-sm font-medium text-blue-600 hover:text-blue-500">Honda
                                                CR-V
                                                (2024)</a>
                                        </div>

                                        <div class="mb-3">
                                            <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded">
                                                Pengalaman sewa yang baik. Proses booking mudah dan cepat.
                                            </p>
                                        </div>

                                        <div class="flex items-center justify-between text-xs text-gray-500">
                                            <div class="flex items-center space-x-4">
                                                <span>Dikirim: 1 hari lalu</span>
                                                <span>Reservasi #102</span>
                                                <span
                                                    class="px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-800">Menunggu</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-shrink-0 flex space-x-2">
                                        <form method="POST" action="/admin/reviews/2/approve">
                                            @csrf
                                            <button type="submit" onclick="alert('Review Disetujui')"
                                                class="bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-1 rounded transition-colors">
                                                Setujui
                                            </button>
                                        </form>
                                        <form method="POST" action="/admin/reviews/2">
                                            @csrf
                                            <button type="submit" onclick="alert('Berhasil Hapus Review')"
                                                class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1 rounded transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </main>
        </div>
    </div>


</body>

</html>
