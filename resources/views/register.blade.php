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
                <!-- LOGO -->
                <a href="/home" class="flex items-center">
                    <img loading="lazy" src="/storage/images/logos/loogo2.png" class="mr-3 h-12" alt="Logo" />
                </a>

                <!-- login & Register buttons -->
                <div class="flex items-center lg:order-2">
                    <a href="/">
                        <button type="button"
                            class="px-4 lg:px-5 py-2 lg:py-2.5 mr-2 text-white bg-gradient-to-br from-orange-400 to-orange-500 hover:bg-gradient-to-bl font-medium rounded-lg text-sm">
                            Masuk
                        </button>
                    </a>
                    <a href="/register">
                        <button
                            class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-200 via-red-300 to-yellow-200 group-hover:from-red-200 group-hover:via-red-300 group-hover:to-yellow-200">
                            <span
                                class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white text-black rounded-md group-hover:bg-opacity-0">
                                Daftar Sekarang
                            </span>
                        </button>
                    </a>


                </div>

                <!-- Menu -->
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="/home" class="block py-2 pr-4 pl-3 text-gray-700 hover:text-orange-500 lg:p-0">
                                <div class="group text-center">
                                    <div class="group-hover:cursor-pointer">Beranda</div>
                                    <div
                                        class="block invisible bg-orange-500 w-12 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/cars" class="block py-2 pr-4 pl-3 text-gray-700 hover:text-orange-500 lg:p-0">
                                <div class="group text-center">
                                    <div class="group-hover:cursor-pointer">Mobil</div>
                                    <div
                                        class="block invisible bg-orange-500 w-8 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


    </header>

    <div class="grid place-items-center min-h-screen py-8">
        <div class="border shadow-xl rounded-lg p-8 lg:w-1/3 md:w-2/3 w-11/12 bg-white">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <!-- Icon -->
                <div
                    class="mx-auto w-14 h-14 bg-gradient-to-br from-pr-400 to-pr-600 rounded-full flex items-center justify-center mb-4 shadow-lg border-2 border-pr-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>

                <!-- Heading -->
                <h1 class="text-3xl font-bold text-gray-900 mb-3 font-car">Daftar Akun Baru</h1>

                <!-- Description Paragraph -->
                <p class="text-gray-600 text-sm max-w-sm mx-auto leading-relaxed">
                    Buat akun untuk menikmati layanan rental mobil
                </p>
            </div>

            <form method="POST" action="/register" enctype="multipart/form-data">
                @csrf

                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama
                        :</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="bg-pr-100 border text-gray-900 text-sm rounded-lg focus:ring-pr-500 focus:border-pr-500 block w-full p-2.5 @error('name') border-red-500 @else border-gray-300 @enderror"
                        placeholder="Masukkan nama lengkap Anda">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email :
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="bg-pr-100 border text-gray-900 text-sm rounded-lg focus:ring-pr-500 focus:border-pr-500 block w-full p-2.5 @error('email') border-red-500 @else border-gray-300 @enderror"
                        placeholder="Masukkan email Anda">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Avatar Selection Section -->

                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">
                        Password :</label>
                    <input type="password" id="password"
                        class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-pr-400 focus:border-pr-400 block w-full p-2.5 @error('password') border-red-500 @else border-gray-300 @enderror"
                        name="password" placeholder="Masukkan password">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">
                        Konfirmasi Password :</label>
                    <input type="password" id="password-confirm"
                        class="bg-pr-100 border text-gray-900 text-sm rounded-lg focus:ring-pr-500 focus:border-pr-500 block w-full p-2.5 @error('password_confirmation') border-red-500 @else border-gray-300 @enderror"
                        name="password_confirmation" placeholder="Ulangi password Anda">
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-start mb-6">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" value=""
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-pr-300 "
                            name="remember" {{ old('remember') ? 'checked' : '' }}>
                    </div>
                    <label for="remember2" class="ml-2 text-sm font-medium text-gray-700">Ingat Saya</label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-pr-400 hover:bg-pr-500 focus:ring-4 focus:outline-none focus:ring-pr-300 font-semibold rounded-lg text-sm px-5 py-3 text-center text-white transition-colors duration-200 mb-4">
                    Daftar
                </button>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="/" class="text-pr-400 hover:text-pr-500 font-medium hover:underline">
                            Masuk di sini
                        </a>
                    </p>
                </div>


            </form>
        </div>

    </div>
</body>

</html>
