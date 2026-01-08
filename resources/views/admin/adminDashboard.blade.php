 <!DOCTYPE html>
 <html lang="in">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>{{ config('app.name', 'FunCar') }}</title>
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
     <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
         <div class="flex flex-col flex-1 w-full">
             <main class="h-full overflow-y-auto">
                 <div class="container px-6 mx-auto grid mb-32">
                     <div class="flex justify-between items-center my-6 mb-6">
                         <h2 class="text-3xl font-bold text-gray-800">
                             Dasbor Admin
                         </h2>
                     </div>
                     <div class="grid gap-6 mb-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                         <div class="rounded-xl shadow-2xl p-6 text-white transform hover:scale-105 transition duration-300"
                             style="background: linear-gradient(to bottom right, #10b981, #15803d);">
                             <div class="flex items-center">
                                 <div class="p-3 rounded-full shadow-lg" style="background: rgba(255, 255, 255, 0.3);">
                                     <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                         <path
                                             d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                         <path fill-rule="evenodd"
                                             d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                             clip-rule="evenodd" />
                                     </svg>
                                 </div>
                                 <div class="ml-4">
                                     <h3 class="text-lg font-semibold">Total Pendapatan</h3>
                                     <p class="text-2xl font-bold">Rp
                                         25.500.000</p>

                                 </div>
                             </div>
                         </div>

                         <div class="rounded-xl shadow-2xl p-6 text-white transform hover:scale-105 transition duration-300"
                             style="background: linear-gradient(to bottom right, #3b82f6, #4338ca);">
                             <div class="flex items-center">
                                 <div class="p-3 rounded-full shadow-lg" style="background: rgba(255, 255, 255, 0.3);">
                                     <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                         <path fill-rule="evenodd"
                                             d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002 2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                             clip-rule="evenodd" />
                                     </svg>
                                 </div>
                                 <div class="ml-4">
                                     <h3 class="text-lg font-semibold">Total Pemesanan</h3>
                                     <p class="text-5xl font-bold">
                                         48</p>
                                 </div>
                             </div>
                         </div>

                         <div class="rounded-xl shadow-2xl p-6 text-white transform hover:scale-105 transition duration-300"
                             style="background: linear-gradient(to bottom right, #a855f7, #db2777);">
                             <div class="flex items-center">
                                 <div class="p-3 rounded-full shadow-lg"
                                     style="background: rgba(255, 255, 255, 0.3);">
                                     <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                         <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                     </svg>
                                 </div>
                                 <div class="ml-4">
                                     <h3 class="text-lg font-semibold">Pesanan Aktif</h3>
                                     <p class="text-5xl font-bold">12</p>
                                 </div>
                             </div>
                         </div>

                         <div class="rounded-xl shadow-2xl p-6 text-white transform hover:scale-105 transition duration-300"
                             style="background: linear-gradient(to bottom right, #f59e0b, #ea580c);">
                             <div class="flex items-center">
                                 <div class="p-3 rounded-full shadow-lg"
                                     style="background: rgba(255, 255, 255, 0.3);">
                                     <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                         <path
                                             d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                     </svg>
                                 </div>
                                 <div class="ml-4">
                                     <h3 class="text-lg font-semibold">Ulasan</h3>
                                     <p class="text-3xl font-bold">4.6/5
                                     </p>
                                     <p class="text-sm opacity-75">Ulasan Baru :
                                         5</p>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <div class="grid gap-6 mb-8 md:grid-cols-2">
                         <div class="bg-white rounded-xl shadow-lg p-6">
                             <h3 class="text-lg font-semibold text-gray-800 mb-4">Pendapatan Harian
                             </h3>
                             <div class="space-y-3">
                                 <div
                                     class="flex items-center justify-between p-3 bg-gradient-to-r from-green-50 to-green-100 rounded-lg border-l-4 border-green-500">
                                     <div>
                                         <p class="text-sm text-gray-600">10 Oktober 2025</p>
                                         <p class="text-xs text-gray-500">3 Pemesanan</p>
                                     </div>
                                     <p class="text-lg font-bold text-green-700">Rp 3.200.000</p>
                                 </div>
                                 <div
                                     class="flex items-center justify-between p-3 bg-gradient-to-r from-green-50 to-green-100 rounded-lg border-l-4 border-green-500">
                                     <div>
                                         <p class="text-sm text-gray-600">11 Oktober 2025</p>
                                         <p class="text-xs text-gray-500">4 Pemesanan</p>
                                     </div>
                                     <p class="text-lg font-bold text-green-700">Rp 4.100.000</p>
                                 </div>
                                 <div
                                     class="flex items-center justify-between p-3 bg-gradient-to-r from-green-50 to-green-100 rounded-lg border-l-4 border-green-500">
                                     <div>
                                         <p class="text-sm text-gray-600">12 Oktober 2025</p>
                                         <p class="text-xs text-gray-500">2 Pemesanan</p>
                                     </div>
                                     <p class="text-lg font-bold text-green-700">Rp 2.800.000</p>
                                 </div>


                             </div>
                         </div>

                         <div class="bg-white rounded-xl shadow-lg p-6">
                             <h3 class="text-lg font-semibold text-gray-800 mb-4">Pemesanan</h3>
                             <div class="space-y-4">
                                 <div
                                     class="flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-lg">
                                     <div class="flex items-center space-x-3">
                                         <div
                                             class="w-12 h-12 rounded-full bg-green-500 flex items-center justify-center">
                                             <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                 <path stroke-linecap="round" stroke-linejoin="round"
                                                     stroke-width="2" d="M5 13l4 4L19 7"></path>
                                             </svg>
                                         </div>
                                         <div>
                                             <p class="font-semibold text-gray-800">Active</p>
                                             <p class="text-xs text-gray-600">Sedang Berlangsung</p>
                                         </div>
                                     </div>
                                     <div class="text-right">
                                         <p class="text-2xl font-bold text-green-600">12</p>
                                     </div>
                                 </div>
                                 <div
                                     class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg">
                                     <div class="flex items-center space-x-3">
                                         <div
                                             class="w-12 h-12 rounded-full bg-gray-500 flex items-center justify-center">
                                             <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                 <path stroke-linecap="round" stroke-linejoin="round"
                                                     stroke-width="2"
                                                     d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                             </svg>
                                         </div>
                                         <div>
                                             <p class="font-semibold text-gray-800">Ended</p>
                                             <p class="text-xs text-gray-600">Telah Selesai</p>
                                         </div>
                                     </div>
                                     <div class="text-right">
                                         <p class="text-2xl font-bold text-gray-600">15</p>

                                     </div>
                                 </div>

                                 <div
                                     class="flex items-center justify-between p-4 bg-gradient-to-r from-red-50 to-red-100 rounded-lg">
                                     <div class="flex items-center space-x-3">
                                         <div
                                             class="w-12 h-12 rounded-full bg-red-500 flex items-center justify-center">
                                             <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                 <path stroke-linecap="round" stroke-linejoin="round"
                                                     stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                             </svg>
                                         </div>
                                         <div>
                                             <p class="font-semibold text-gray-800">Canceled</p>
                                             <p class="text-xs text-gray-600">Dibatalkan</p>
                                         </div>
                                     </div>
                                     <div class="text-right">
                                         <p class="text-2xl font-bold text-red-600">3</p>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="grid gap-6 mb-8 md:grid-cols-3">
                         <div class="bg-white rounded-xl shadow-lg p-6">
                             <h3 class="text-lg font-semibold text-gray-800 mb-4">Mobil Terpopuler</h3>
                             <div class="space-y-3">
                                 <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                     <div>
                                         <p class="font-medium text-sm">BMW X5</p>
                                         <p class="text-xs text-gray-600">15
                                             Pemesanan
                                     </div>
                                     <div class="text-right">
                                         <p class="font-semibold text-sm text-green-600">Rp
                                             28.500.000</p>
                                         <div class="flex items-center">
                                             <svg class="w-3 h-3 text-yellow-400" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                 <path
                                                     d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                             </svg>
                                             <svg class="w-3 h-3 text-yellow-400" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                 <path
                                                     d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                             </svg>
                                             <svg class="w-3 h-3 text-yellow-400" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                 <path
                                                     d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                             </svg>
                                             <svg class="w-3 h-3 text-yellow-400" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                 <path
                                                     d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                             </svg>
                                             <svg class="w-3 h-3 text-yellow-400" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                 <path
                                                     d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                             </svg>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                     <div>
                                         <p class="font-medium text-sm">Mercedes C-Class</p>
                                         <p class="text-xs text-gray-600">12
                                             Pemesanan</p>
                                     </div>
                                     <div class="text-right">
                                         <p class="font-semibold text-sm text-green-600">Rp
                                             22.400.000</p>
                                         <div class="flex items-center">
                                             <svg class="w-3 h-3 text-yellow-400" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                 <path
                                                     d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                             </svg>
                                             <svg class="w-3 h-3 text-yellow-400" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                 <path
                                                     d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                             </svg>
                                             <svg class="w-3 h-3 text-yellow-400" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                 <path
                                                     d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                             </svg>
                                             <svg class="w-3 h-3 text-yellow-400" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                 <path
                                                     d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                             </svg>
                                             <svg class="w-3 h-3 text-yellow-400" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                 <path
                                                     d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                             </svg>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                     <div>
                                         <p class="font-medium text-sm">Toyota Camry</p>
                                         <p class="text-xs text-gray-600">10
                                             Pemesanan</p>
                                     </div>
                                     <div class="text-right">
                                         <p class="font-semibold text-sm text-green-600">Rp
                                             15.000.000</p>
                                         <div class="flex items-center">
                                             <svg class="w-3 h-3 text-yellow-400" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                 <path
                                                     d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                             </svg>
                                             <svg class="w-3 h-3 text-yellow-400" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                 <path
                                                     d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                             </svg>
                                             <svg class="w-3 h-3 text-yellow-400" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                 <path
                                                     d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                             </svg>
                                             <svg class="w-3 h-3 text-yellow-400" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                 <path
                                                     d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                             </svg>
                                             <svg class="w-3 h-3 text-gray-300" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                 <path
                                                     d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                             </svg>
                                         </div>
                                     </div>
                                 </div>

                             </div>
                         </div>

                         <div class="bg-white rounded-xl shadow-lg p-6">
                             <h3 class="text-lg font-semibold text-gray-800 mb-4">Pendapatan per Kategori</h3>
                             <div class="space-y-3">
                                 <!-- Luxury -->
                                 <div
                                     class="p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg border-l-4 border-purple-500">
                                     <div class="flex justify-between items-center mb-2">
                                         <div class="flex items-center space-x-3">

                                             <div>
                                                 <p class="font-semibold text-gray-800">Luxury</p>
                                             </div>
                                         </div>
                                         <p class="text-lg font-bold text-purple-700">Rp 45.000.000</p>
                                     </div>

                                 </div>

                                 <!-- SUV -->
                                 <div
                                     class="p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg border-l-4 border-blue-500">
                                     <div class="flex justify-between items-center mb-2">
                                         <div class="flex items-center space-x-3">

                                             <div>
                                                 <p class="font-semibold text-gray-800">SUV</p>

                                             </div>
                                         </div>
                                         <p class="text-lg font-bold text-blue-700">Rp 38.000.000</p>
                                     </div>

                                 </div>

                                 <!-- Sedan -->
                                 <div
                                     class="p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-lg border-l-4 border-green-500">
                                     <div class="flex justify-between items-center mb-2">
                                         <div class="flex items-center space-x-3">

                                             <div>
                                                 <p class="font-semibold text-gray-800">Sedan</p>
                                             </div>
                                         </div>
                                         <p class="text-lg font-bold text-green-700">Rp 25.000.000</p>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="bg-white rounded-xl shadow-lg p-6">
                             <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                 Ulasan</h3>
                             <div class="space-y-4">
                                 <div class="flex justify-between items-center">
                                     <span class="text-sm text-gray-600">Total Ulasan</span>
                                     <span class="font-semibold">85</span>
                                 </div>
                                 <div class="flex justify-between items-center">
                                     <span class="text-sm text-gray-600">Rata Rata</span>
                                     <span class="font-semibold">4.6/5</span>
                                 </div>
                                 <div class="flex justify-between items-center">
                                     <span class="text-sm text-gray-600">Disetujui</span>
                                     <span class="font-semibold text-green-600">80</span>
                                 </div>
                                 <div class="flex justify-between items-center">
                                     <span class="text-sm text-gray-600">Menunggu</span>
                                     <span class="font-semibold text-yellow-600">5</span>
                                 </div>

                                 <div class="mt-4">
                                     <p class="text-sm font-medium text-gray-700 mb-2">
                                         Distribusi Rating</p>
                                     <div class="flex items-center mb-1">
                                         <span class="text-xs w-4">5★</span>
                                         <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                                             <div class="bg-yellow-400 h-2 rounded-full"
                                                 style="width: 61.1764705882353%">
                                             </div>
                                         </div>
                                         <span class="text-xs text-gray-600">52</span>
                                     </div>
                                     <div class="flex items-center mb-1">
                                         <span class="text-xs w-4">4★</span>
                                         <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                                             <div class="bg-yellow-400 h-2 rounded-full"
                                                 style="width: 27.058823529411768%">
                                             </div>
                                         </div>
                                         <span class="text-xs text-gray-600">23</span>
                                     </div>
                                     <div class="flex items-center mb-1">
                                         <span class="text-xs w-4">3★</span>
                                         <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                                             <div class="bg-yellow-400 h-2 rounded-full"
                                                 style="width: 8.235294117647058%">
                                             </div>
                                         </div>
                                         <span class="text-xs text-gray-600">7</span>
                                     </div>
                                     <div class="flex items-center mb-1">
                                         <span class="text-xs w-4">2★</span>
                                         <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                                             <div class="bg-yellow-400 h-2 rounded-full"
                                                 style="width: 2.352941176470588%">
                                             </div>
                                         </div>
                                         <span class="text-xs text-gray-600">2</span>
                                     </div>
                                     <div class="flex items-center mb-1">
                                         <span class="text-xs w-4">1★</span>
                                         <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                                             <div class="bg-yellow-400 h-2 rounded-full"
                                                 style="width: 1.1764705882352942%">
                                             </div>
                                         </div>
                                         <span class="text-xs text-gray-600">1</span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="mt-12">
                         <div class="flex align-middle justify-center">
                             <hr class=" mt-8 h-0.5 w-1/2 bg-pr-500">
                             <p class="my-2 mx-8  p-2 font-car font-bold text-gray-600 text-lg uppercase">
                                 Reservasi</p>
                             <hr class=" mt-8 h-0.5 w-1/2 bg-pr-500">
                             <hr>
                         </div>

                     </div>
                     <div class="w-full overflow-hidden rounded-lg shadow-xs">
                         <div class="w-full overflow-x-auto">
                             <table class="w-full whitespace-no-wrap overflow-scroll table-auto">
                                 <thead>
                                     <tr
                                         class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b  bg-gray-50">
                                         <th class="px-4 py-3">User</th>
                                         <th class="px-4 py-3 w-48">Mobil</th>
                                         <th class="px-4 py-3 w-24">Tanggal Mulai
                                         </th>
                                         <th class="px-4 py-3 w-24">Tanggal Selesai</th>
                                         <th class="px-4 py-3">Durasi</th>
                                         <th class="px-4 py-3 w-26">
                                             Sisa Hari</th>
                                         <th class="px-4 py-3">Harga</th>
                                         <th class="px-4 py-3">Status Bayar
                                         </th>
                                         <th class="px-4 py-3">Status</th>
                                         <th class="px-4 py-3">Status Kembali</th>
                                         <th class="px-4 py-3">Tanggal Kembali</th>
                                         <th class="px-4 py-3 ">Aksi</th>
                                     </tr>
                                 </thead>
                                 <tbody class="bg-white divide-y">

                                     <tr class="text-gray-700 ">
                                         <td class="px-4 py-3">
                                             <div class="flex items-center text-sm">
                                                 <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                     <div
                                                         class="w-full h-full rounded-full bg-gray-300 flex items-center justify-center">
                                                         <span class="text-gray-600 font-semibold text-xs">J</span>
                                                     </div>
                                                     <div class="absolute inset-0 rounded-full shadow-inner"
                                                         aria-hidden="true"></div>
                                                 </div>
                                                 <div>
                                                     <p class="font-semibold">John Doe</p>
                                                     <p class="text-xs text-gray-600">
                                                         john@example.com
                                                     </p>
                                                 </div>
                                             </div>
                                         </td>
                                         <td class="px-4 py-3 text-sm">
                                             BMW X5
                                         </td>
                                         <td class="px-4 py-3  text-sm">
                                             25-11-01
                                         </td>
                                         <td class="px-4 py-3  text-sm">
                                             25-11-04
                                         </td>
                                         <td class=" text-xs">
                                             <p class="px-4 py-3 text-sm">
                                                 3
                                                 days </p>
                                         </td>
                                         <td class="px-4 py-3 text-xs">
                                             <span class="px-4 py-3 text-sm">
                                                 0
                                                 days
                                             </span>
                                         </td>
                                         <td class="px-4 py-3 text-sm">
                                             Rp
                                             3.600.000
                                         </td>
                                         <td class="px-4 py-3 text-sm">
                                             <span
                                                 class="px-3 py-2 text-gray-800 rounded-md bg-gray-200 text-xs font-semibold">Paid</span>
                                         </td>
                                         <td class="px-4 py-3 text-sm">
                                             <span
                                                 class="px-3 py-2 text-white rounded-md bg-green-600 text-xs font-semibold">Active</span>
                                         </td>
                                         <td class="px-4 py-3 text-sm">
                                             <span class="p-2 text-white rounded-md bg-red-500">Overdue</span>
                                         </td>
                                         <td class="px-4 py-3 text-sm">
                                             <span class="text-gray-400">Not returned</span>
                                         </td>
                                         <td class="px-4 py-3 text-sm relative">
                                             <div class="relative inline-block text-left">
                                                 <button onclick="openActionsModal(1, 'BMW X5', 'Pending', 'Active')"
                                                     class="inline-flex justify-center w-full px-2 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                     id="menu-button-1" aria-expanded="true" aria-haspopup="true">
                                                     <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                         fill="currentColor" viewBox="0 0 16 16">
                                                         <path
                                                             d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                                     </svg>
                                                 </button>
                                             </div>
                                         </td>
                                     </tr>
                                     <tr class="text-gray-700 ">
                                         <td class="px-4 py-3">
                                             <div class="flex items-center text-sm">
                                                 <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                     <div
                                                         class="w-full h-full rounded-full bg-gray-300 flex items-center justify-center">
                                                         <span class="text-gray-600 font-semibold text-xs">J</span>
                                                     </div>
                                                     <div class="absolute inset-0 rounded-full shadow-inner"
                                                         aria-hidden="true"></div>
                                                 </div>
                                                 <div>
                                                     <p class="font-semibold">Jane Smith</p>
                                                     <p class="text-xs text-gray-600">
                                                         jane@example.com
                                                     </p>
                                                 </div>
                                             </div>
                                         </td>
                                         <td class="px-4 py-3 text-sm">
                                             Mercedes C-Class
                                         </td>
                                         <td class="px-4 py-3  text-sm">
                                             25-11-05
                                         </td>
                                         <td class="px-4 py-3  text-sm">
                                             25-11-08
                                         </td>
                                         <td class=" text-xs">
                                             <p class="px-4 py-3 text-sm">
                                                 3
                                                 days </p>
                                         </td>
                                         <td class="px-4 py-3 text-xs">
                                             <span class="px-4 py-3 text-sm">
                                                 0
                                                 days
                                             </span>
                                         </td>
                                         <td class="px-4 py-3 text-sm">
                                             Rp
                                             2.940.000
                                         </td>
                                         <td class="px-4 py-3 text-sm">
                                             <span
                                                 class="px-3 py-2 text-gray-800 rounded-md bg-gray-200 text-xs font-semibold">pending</span>
                                         </td>
                                         <td class="px-4 py-3 text-sm">
                                             <span
                                                 class="px-3 py-2 text-white rounded-md bg-green-600 text-xs font-semibold">Active</span>
                                         </td>
                                         <td class="px-4 py-3 text-sm">
                                             <span class="p-2 text-white rounded-md bg-red-500">Overdue</span>
                                         </td>
                                         <td class="px-4 py-3 text-sm">
                                             <span class="text-gray-400">Not returned</span>
                                         </td>
                                         <td class="px-4 py-3 text-sm relative">
                                             <div class="relative inline-block text-left">
                                                 <button
                                                     onclick="openActionsModal(2, 'Mercedes C-Class', 'Pending', 'Active')"
                                                     class="inline-flex justify-center w-full px-2 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                     id="menu-button-2" aria-expanded="true" aria-haspopup="true">
                                                     <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                         fill="currentColor" viewBox="0 0 16 16">
                                                         <path
                                                             d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                                     </svg>
                                                 </button>
                                             </div>
                                         </td>
                                     </tr>

                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </main>
         </div>
     </div>

     <div id="actionsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
         <div class="flex items-center justify-center min-h-screen px-4 py-8">
             <div class="relative mx-auto p-6 border w-full max-w-md shadow-2xl rounded-lg bg-white">
                 <div class="text-center">
                     <h3 class="text-lg font-medium text-gray-900 mb-4">Reservation Actions
                     </h3>
                     <p id="actionsCarName" class="text-sm text-gray-600 mb-6"></p>

                     <div class="space-y-3">
                         <button type="button" id="editStatusLink"
                             class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white bg-pr-600 border border-transparent rounded-md shadow-sm hover:bg-pr-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pr-500 transition-colors">
                             <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                 </path>
                             </svg>
                             Edit Status
                         </button>

                         <button type="button" id="editPaymentLink"
                             class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white bg-sec-800 border border-transparent rounded-md shadow-sm hover:bg-sec-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sec-500 transition-colors">
                             <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                 </path>
                             </svg>
                             Edit Pembayaran
                         </button>

                         <button id="markReturnedBtn"
                             class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                             <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                             </svg>
                             <span id="returnBtnText">Tandai Sudah Kembali</span>
                         </button>

                         <button id="cancelReservationBtn" onclick="cancelReservation()"
                             class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                             <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M6 18L18 6M6 6l12 12"></path>
                             </svg>
                             <span id="cancelBtnText">Batalkan Reservasi</span>
                         </button>
                     </div>
                     <div class="mt-6">
                         <button type="button" onclick="closeActionsModal()"
                             class="w-full px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                             Cancel
                         </button>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <div id="returnModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
         <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
             <div class="mt-3">
                 <h3 class="text-lg font-medium text-gray-900 mb-4" id="modalTitle">
                     Tandai Sebagai Telah Dikembalikan
                 </h3>

                 <form id="returnForm">

                     <div class="mb-4">
                         <label for="actual_return_date" class="block text-sm font-medium text-gray-700 mb-2">
                             Tanggal Pengembalian:
                         </label>
                         <input type="date" id="actual_return_date" name="actual_return_date" value="2025-11-12"
                             required
                             class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                     </div>

                     <div class="mb-4">
                         <label for="return_notes" class="block text-sm font-medium text-gray-700 mb-2">
                             Catatan Pengembalian:
                         </label>
                         <textarea id="return_notes" name="return_notes" rows="3"
                             placeholder="Tuliskan catatan mengenai kondisi mobil atau proses pengembalian..."
                             class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                     </div>

                     <div class="flex justify-center space-x-4">
                         <button type="button" onclick="closeReturnModal()"
                             class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                             Batal
                         </button>
                         <button type="submit"
                             class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                             Tandai Sebagai Dikembalikan
                         </button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
     <div id="statusModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
         <div class="flex items-center justify-center min-h-screen px-4 py-8">
             <div class="relative mx-auto p-6 border w-full max-w-md shadow-2xl rounded-lg bg-white">
                 <div class="text-center">
                     <h3 class="text-lg font-medium text-gray-900 mb-4">Update Status Reservasi </h3>
                     <p id="statusCarName" class="text-sm text-gray-600 mb-4"></p>
                     <p class="text-sm text-gray-500 mb-6">Status Sekarang: <span id="currentStatus"
                             class="font-semibold text-gray-800"></span></p>

                     <form id="statusForm">

                         <div class="mb-6">
                             <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status
                                 Reservasi
                             </label>
                             <select id="status" name="status"
                                 class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400">
                                 <option value="Active">Active</option>
                                 <option value="Pending">Pending</option>
                                 <option value="Ended">Ended</option>
                                 <option value="Canceled">Canceled</option>
                             </select>
                         </div>

                         <div class="flex justify-center space-x-4">
                             <button type="button" onclick="closeStatusModal()"
                                 class="px-6 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                                 Cancel
                             </button>
                             <button type="submit"
                                 class="px-6 py-2 bg-pr-600 text-white rounded-md hover:bg-pr-700 transition-colors">
                                 Save
                             </button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>

     <div id="paymentModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
         <div class="flex items-center justify-center min-h-screen px-4 py-8">
             <div class="relative mx-auto p-6 border w-full max-w-md shadow-2xl rounded-lg bg-white">
                 <div class="text-center">
                     <h3 class="text-lg font-medium text-gray-900 mb-4">Update Status Pembayaran</h3>
                     <p id="paymentCarName" class="text-sm text-gray-600 mb-4"></p>
                     <p class="text-sm text-gray-500 mb-6">Status Sekarang: <span id="currentPayment"
                             class="font-semibold text-gray-800"></span></p>

                     <form id="paymentForm">

                         <div class="mb-6">
                             <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-2">Payment
                                 Status:</label>
                             <select id="payment_status" name="payment_status"
                                 class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400">
                                 <option value="pending">Pending</option>
                                 <option value="paid">Paid</option>
                                 <option value="canceled">Canceled</option>
                             </select>
                         </div>

                         <div class="flex justify-center space-x-4">
                             <button type="button" onclick="closePaymentModal()"
                                 class="px-6 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                                 Cancel
                             </button>
                             <button type="submit"
                                 class="px-6 py-2 bg-pr-800 text-white rounded-md hover:bg-sec-700 transition-colors">
                                 Save
                             </button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>

     <script src="/js/admin-dashboard.js"></script>
 </body>

 </html>
