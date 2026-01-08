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
     <div class="flex flex-col items-center justify-center max-w-screen-xl mx-auto my-20 ">
         <form class="w-full " action="/admin/cars" method="POST" enctype="multipart/form-data">
             @csrf
             <div
                 class="md:w-2/3 w-5/6 md:px-24 px-4 pb-8 mx-auto mt-2 space-y-12 bg-white border-2 border-gray-600 rounded-md">
                 <div class="pb-12 border-b border-gray-900/10">
                     <h2 class="mt-2 text-lg font-bold leading-7 text-center text-gray-900">Isi detail mobil baru</h2>

                     <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">

                         <div class="sm:col-span-3">
                             <label for="brand"
                                 class="block text-sm font-medium leading-6 text-gray-900">Merek</label>
                             <div class="mt-2">
                                 <input type="text" name="brand" id="brand"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                             </div>

                         </div>



                         <div class="sm:col-span-3">
                             <label for="model"
                                 class="block text-sm font-medium leading-6 text-gray-900">Model</label>
                             <div class="mt-2">
                                 <input type="text" name="model" id="model"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                             </div>

                         </div>

                         <div class="sm:col-span-2 sm:col-start-1">
                             <label for="engine"
                                 class="block text-sm font-medium leading-6 text-gray-900">Mesin</label>
                             <div class="mt-2">
                                 <input type="text" name="engine" id="engine"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                             </div>

                         </div>

                         <div class="sm:col-span-2">
                             <label for="police_number" class="block text-sm font-medium leading-6 text-gray-900">Nomor
                                 Polisi</label>
                             <div class="mt-2">
                                 <input type="text" name="police_number" id="police_number"
                                     placeholder="e.g., B 1234 ABC"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                             </div>

                         </div>

                         <div class="sm:col-span-2">
                             <label for="price_per_day"
                                 class="block text-sm font-medium leading-6 text-gray-900">Harga per
                                 Hari (Rp)</label>
                             <div class="mt-2">
                                 <input type="number" name="price_per_day" id="price_per_day"
                                     placeholder="Contoh: 500000"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                             </div>

                         </div>

                         <div class="sm:col-span-3">
                             <label for="" class="block text-sm font-medium leading-6 text-gray-900">Diskon %
                             </label>
                             <div class="mt-2">
                                 <input type="number" name="reduce" id="reduce"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                             </div>

                         </div>

                         <div class="sm:col-span-3">
                             <label for="stars" class="block text-sm font-medium leading-6 text-gray-900">Rating
                                 Mobil</label>
                             <div class="mt-2">
                                 <select id="stars" name="stars"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:max-w-xs sm:text-sm sm:leading-6">
                                     <option disabled selected value="1">
                                         ⭐⭐⭐⭐⭐
                                     </option>
                                     <option value="1">1/5</option>
                                     <option value="2">2/5</option>
                                     <option value="3">3/5</option>
                                     <option value="4">4/5</option>
                                     <option value="5">5/5</option>
                                 </select>
                             </div>

                         </div>

                         <!-- New Car Attributes -->
                         <div class="sm:col-span-3">
                             <label for="transmission"
                                 class="block text-sm font-medium leading-6 text-gray-900">Transmisi</label>
                             <div class="mt-2">
                                 <select id="transmission" name="transmission"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                     <option value="Manual">Manual</option>
                                     <option value="Automatic" selected>Otomatis</option>
                                 </select>
                             </div>

                         </div>

                         <div class="sm:col-span-3">
                             <label for="fuel_type" class="block text-sm font-medium leading-6 text-gray-900">Jenis
                                 Bahan
                                 Bakar</label>
                             <div class="mt-2">
                                 <select id="fuel_type" name="fuel_type"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                     <option value="Petrol" selected>Bensin</option>
                                     <option value="Diesel">Solar</option>
                                     <option value="Electric">Listrik</option>
                                     <option value="Hybrid">Hybrid</option>
                                 </select>
                             </div>

                         </div>

                         <div class="sm:col-span-2">
                             <label for="seats" class="block text-sm font-medium leading-6 text-gray-900">Jumlah
                                 Kursi</label>
                             <div class="mt-2">
                                 <select id="seats" name="seats"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                     <option value="2">2 Kursi</option>
                                     <option value="4">4 Kursi</option>
                                     <option value="5" selected>5 Kursi</option>
                                     <option value="7">7 Kursi</option>
                                     <option value="8">8 Kursi</option>
                                 </select>
                             </div>

                         </div>

                         <div class="sm:col-span-2">
                             <label for="category"
                                 class="block text-sm font-medium leading-6 text-gray-900">Kategori</label>
                             <div class="mt-2">
                                 <select id="category" name="category"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                     <option value="Economy" selected>Ekonomi</option>
                                     <option value="Compact">Kompak</option>
                                     <option value="Luxury">Mewah</option>
                                     <option value="SUV">SUV</option>
                                     <option value="Sports">Sport</option>
                                     <option value="Electric">Listrik</option>
                                 </select>
                             </div>

                         </div>

                         <div class="sm:col-span-2">
                             <label for="year"
                                 class="block text-sm font-medium leading-6 text-gray-900">Tahun</label>
                             <div class="mt-2">
                                 <input type="number" name="year" id="year" min="2000" max="2025"
                                     value="2023"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                             </div>

                         </div>

                         <div class="sm:col-span-2">
                             <label for="color"
                                 class="block text-sm font-medium leading-6 text-gray-900">Color</label>
                             <div class="mt-2">
                                 <input type="text" name="color" id="color"
                                     placeholder="e.g. Red, Blue, Black"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                             </div>

                         </div>

                         <div class="sm:col-span-2">
                             <label for="mileage" class="block text-sm font-medium leading-6 text-gray-900">Jarak
                                 Tempuh
                                 (km)</label>
                             <div class="mt-2">
                                 <input type="number" name="mileage" id="mileage" step="1"
                                     placeholder="Contoh: 50000"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                             </div>

                         </div>

                         <div class="sm:col-span-2">
                             <label for="minimum_rental_days"
                                 class="block text-sm font-medium leading-6 text-gray-900">Minimum Hari Sewa</label>
                             <div class="mt-2">
                                 <input type="number" name="minimum_rental_days" id="minimum_rental_days"
                                     min="1" value="1"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                             </div>

                         </div>

                         <div class="sm:col-span-6">
                             <label for="available_for_long_term" class="flex items-center">
                                 <input type="checkbox" name="available_for_long_term" id="available_for_long_term"
                                     value="1"
                                     class="rounded border-gray-300 text-pr-400 focus:ring-pr-400 focus:ring-2">
                                 <span class="ml-2 text-sm text-gray-900">Tersedia untuk sewa jangka panjang</span>
                             </label>

                         </div>

                         <div class="col-span-full">
                             <label for="features"
                                 class="block text-sm font-medium leading-6 text-gray-900">Fitur</label>
                             <div class="mt-2">
                                 <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                     <label class="flex items-center">
                                         <input type="checkbox" name="features[]" value="AC"
                                             class="rounded border-gray-300 text-pr-400 focus:ring-pr-400">
                                         <span class="ml-2 text-sm">AC</span>
                                     </label>
                                     <label class="flex items-center">
                                         <input type="checkbox" name="features[]" value="Bluetooth"
                                             class="rounded border-gray-300 text-pr-400 focus:ring-pr-400">
                                         <span class="ml-2 text-sm">Bluetooth</span>
                                     </label>
                                     <label class="flex items-center">
                                         <input type="checkbox" name="features[]" value="GPS"
                                             class="rounded border-gray-300 text-pr-400 focus:ring-pr-400">
                                         <span class="ml-2 text-sm">GPS Navigasi</span>
                                     </label>
                                     <label class="flex items-center">
                                         <input type="checkbox" name="features[]" value="USB Charging"
                                             class="rounded border-gray-300 text-pr-400 focus:ring-pr-400">
                                         <span class="ml-2 text-sm">Charger USB</span>
                                     </label>
                                     <label class="flex items-center">
                                         <input type="checkbox" name="features[]" value="Premium Sound"
                                             class="rounded border-gray-300 text-pr-400 focus:ring-pr-400">
                                         <span class="ml-2 text-sm">Audio Premium</span>
                                     </label>
                                     <label class="flex items-center">
                                         <input type="checkbox" name="features[]" value="Leather Seats"
                                             class="rounded border-gray-300 text-pr-400 focus:ring-pr-400">
                                         <span class="ml-2 text-sm">Jok Kulit</span>
                                     </label>
                                     <label class="flex items-center">
                                         <input type="checkbox" name="features[]" value="Sunroof"
                                             class="rounded border-gray-300 text-pr-400 focus:ring-pr-400">
                                         <span class="ml-2 text-sm">Sunroof</span>
                                     </label>
                                     <label class="flex items-center">
                                         <input type="checkbox" name="features[]" value="Parking Sensors"
                                             class="rounded border-gray-300 text-pr-400 focus:ring-pr-400">
                                         <span class="ml-2 text-sm">Parking Sensors</span>
                                     </label>
                                     <label class="flex items-center">
                                         <input type="checkbox" name="features[]" value="Heated Seats"
                                             class="rounded border-gray-300 text-pr-400 focus:ring-pr-400">
                                         <span class="ml-2 text-sm">Heated Seats</span>
                                     </label>
                                 </div>
                             </div>

                         </div>

                         <div class="col-span-full">
                             <label for="description"
                                 class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                             <div class="mt-2">
                                 <textarea name="description" id="description" rows="3" placeholder="Describe the car features and benefits..."
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6"></textarea>
                             </div>

                         </div>




                         <div class="col-span-full">
                             <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Gambar
                                 Mobil</label>
                             <div class="mt-2">
                                 <!-- Multiple Image Upload -->
                                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                     <!-- Main Image -->
                                     <div>
                                         <label class="block text-sm font-medium text-gray-700 mb-2">Gambar
                                             Utama</label>
                                         <div
                                             class="flex justify-center px-6 py-10 border border-dashed rounded-lg border-gray-900/25">
                                             <div class="text-center">
                                                 <svg class="w-12 h-12 mx-auto text-gray-300" viewBox="0 0 24 24"
                                                     fill="currentColor" aria-hidden="true">
                                                     <path fill-rule="evenodd"
                                                         d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                                         clip-rule="evenodd" />
                                                 </svg>
                                                 <div class="flex mt-4 text-sm leading-6 text-gray-600">
                                                     <label for="main-image"
                                                         class="relative font-semibold bg-white rounded-md cursor-pointer text-pr-400 focus-within:outline-none focus-within:ring-2 focus-within:ring-pr-400 focus-within:ring-offset-2 hover:text-pr-400">
                                                         <span>Upload gambar utama</span>
                                                         <input id="main-image" name="main_image" type="file"
                                                             accept="image/*" class="sr-only"
                                                             onchange="previewImage(this, 'main-preview')">
                                                     </label>
                                                 </div>
                                                 <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB
                                                 </p>
                                             </div>
                                         </div>
                                         <div id="main-preview" class="mt-2" style="display: none;">
                                             <img class="w-full h-40 object-cover rounded-lg"
                                                 alt="Main image preview">
                                         </div>

                                     </div>

                                     <!-- Gallery Images -->
                                     <div>
                                         <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Galeri
                                             (Opsional)</label>
                                         <div
                                             class="flex justify-center px-6 py-10 border border-dashed rounded-lg border-gray-900/25">
                                             <div class="text-center">
                                                 <svg class="w-12 h-12 mx-auto text-gray-300" viewBox="0 0 24 24"
                                                     fill="currentColor" aria-hidden="true">
                                                     <path fill-rule="evenodd"
                                                         d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                                         clip-rule="evenodd" />
                                                 </svg>
                                                 <div class="flex mt-4 text-sm leading-6 text-gray-600">
                                                     <label for="gallery-images"
                                                         class="relative font-semibold bg-white rounded-md cursor-pointer text-pr-400 focus-within:outline-none focus-within:ring-2 focus-within:ring-pr-400 focus-within:ring-offset-2 hover:text-pr-400">
                                                         <span>Upload gallery images</span>
                                                         <input id="gallery-images" name="gallery_images[]"
                                                             type="file" accept="image/*" multiple class="sr-only"
                                                             onchange="previewMultipleImages(this, 'gallery-preview')">
                                                     </label>
                                                 </div>
                                                 <p class="text-xs leading-5 text-gray-600">Select multiple images</p>
                                             </div>
                                         </div>
                                         <div id="gallery-preview" class="mt-2 grid grid-cols-2 gap-2"
                                             style="display: none;">
                                             <!-- Gallery previews will be inserted here -->
                                         </div>

                                     </div>
                                 </div>

                                 <!-- Image URL Inputs (fallback) -->
                                 <div class="mt-4 pt-4 border-t border-gray-200">
                                     <h4 class="text-sm font-medium text-gray-700 mb-3">Atau Tambahkan URL</h4>
                                     <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                         <div>
                                             <label for="image_url"
                                                 class="block text-sm font-medium text-gray-700 mb-1">Gambar
                                                 Utama</label>
                                             <input type="url" name="image_url" id="image_url"
                                                 placeholder="https://example.com/car-image.jpg"
                                                 class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                         </div>

                                         <div>
                                             <label for="gallery_urls"
                                                 class="block text-sm font-medium text-gray-700 mb-1">Galery</label>
                                             <textarea name="gallery_urls" id="gallery_urls" rows="2"
                                                 placeholder="https://example.com/image1.jpg, https://example.com/image2.jpg"
                                                 class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6"></textarea>
                                         </div>
                                     </div>
                                 </div>
                             </div>

                         </div>

                         <div class="sm:col-span-3">
                             <label for="status"
                                 class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                             <div class="mt-2">
                                 <select id="status" name="status"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:max-w-xs sm:text-sm sm:leading-6">
                                     <option value="Tersedia">Tersedia</option>
                                     <option value="Disewa">Disewa</option>
                                     <option value="Perbaikan">Perbaikan</option>
                                 </select>
                             </div>

                         </div>


                     </div>
                 </div>


                 <div class="flex items-center justify-center mb-6 gap-x-6">
                     <a href="/admin/cars"
                         class="w-20 p-1 text-sm font-semibold leading-6 text-center text-gray-900 border-2 rounded-md border-pr-200 hover:bg-white bg-sec-300">Cancel</a>
                     <button type="submit" onclick="alert('Berhasil Tambahkan Mobil')"
                         class="w-1/3 px-3 py-2 text-sm font-semibold text-white rounded-md shadow-sm bg-pr-400 hover:bg-pr-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pr-400">Save</button>
                 </div>

             </div>


         </form>

     </div>



 </body>

 </html>
