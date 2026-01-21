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
     {{-- flatpickr CSS --}}
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
     <div class="my-20 flex flex-col justify-center items-center mx-auto max-w-screen-xl">
         <form class="w-full" method='POST' action='/admin/cars' id="createCarForm" enctype="multipart/form-data">
             @csrf
             <div
                 class="md:w-2/3 w-5/6 md:px-24 px-4 pb-8 mx-auto mt-2 space-y-12 bg-white border-2 border-gray-300 rounded-md shadow-lg">
                 <div class="border-b border-gray-300 pb-12">
                     <h2 class="mt-2 text-center font-bold text-2xl leading-7 text-gray-900">Tambah Mobil Baru</h2>

                     <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                         <div class="sm:col-span-3">
                             <label for="brand"
                                 class="block text-sm font-medium leading-6 text-gray-900">Merek</label>
                             <div class="mt-2">
                                 <input type="text" name="brand" id="brand" required
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                             </div>
                         </div>

                         <div class="sm:col-span-3">
                             <label for="model"
                                 class="block text-sm font-medium leading-6 text-gray-900">Model</label>
                             <div class="mt-2">
                                 <input type="text" name="model" id="model" required
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                             </div>
                         </div>

                         <div class="sm:col-span-2 sm:col-start-1">
                             <label for="engine"
                                 class="block text-sm font-medium leading-6 text-gray-900">Mesin</label>
                             <div class="mt-2">
                                 <input type="text" name="engine" id="engine" required
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                             </div>
                         </div>

                         <div class="sm:col-span-2">
                             <label for="police_number"
                                 class="block text-sm font-medium leading-6 text-gray-900">Nomor
                                 Polisi</label>
                             <div class="mt-2">
                                 <input type="text" name="police_number" id="police_number" required
                                     placeholder="Contoh: B 1234 ABC"
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                             </div>
                         </div>

                         <div class="sm:col-span-2">
                             <label for="price_per_day"
                                 class="block text-sm font-medium leading-6 text-gray-900">Harga
                                 per Hari (Rp)</label>
                             <div class="mt-2">
                                 <input type="number" name="price_per_day" id="price_per_day" required
                                     placeholder="Contoh: 500000"
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                             </div>
                         </div>

                         <div class="sm:col-span-3">
                             <label for="reduce" class="block text-sm font-medium leading-6 text-gray-900">Diskon
                                 %</label>
                             <div class="mt-2">
                                 <input type="number" name="reduce" id="reduce" placeholder="0"
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                             </div>
                         </div>

                         <div class="sm:col-span-3">
                             <label for="stars" class="block text-sm font-medium leading-6 text-gray-900">Rating
                                 Mobil</label>
                             <div class="mt-2">
                                 <select id="stars" name="stars"
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:max-w-xs sm:text-sm sm:leading-6">
                                     <option value="">Pilih rating</option>
                                     <option value="1">1/5</option>
                                     <option value="2">2/5</option>
                                     <option value="3">3/5</option>
                                     <option value="4">4/5</option>
                                     <option value="5">5/5 ⭐⭐⭐⭐⭐</option>
                                 </select>
                             </div>
                         </div>

                         <div class="sm:col-span-3">
                             <label for="year"
                                 class="block text-sm font-medium leading-6 text-gray-900">Tahun</label>
                             <div class="mt-2">
                                 <select id="year" name="year" required
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:max-w-xs sm:text-sm sm:leading-6">
                                     <option value="">Pilih tahun</option>
                                     @for ($y = 2020; $y <= 2026; $y++)
                                         <option value="{{ $y }}">
                                             {{ $y }}</option>
                                     @endfor
                                 </select>
                             </div>
                         </div>

                         <div class="sm:col-span-3">
                             <label for="fuel_type" class="block text-sm font-medium leading-6 text-gray-900">Jenis
                                 Bahan Bakar</label>
                             <div class="mt-2">
                                 <select id="fuel_type" name="fuel_type" required
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                                     <option value="">Pilih jenis bahan bakar</option>
                                     <option value="bensin">Bensin</option>
                                     <option value="diesel">Solar</option>
                                     <option value="hybrid">Hybrid</option>
                                     <option value="electric">Listrik</option>
                                 </select>
                             </div>
                         </div>

                         <div class="sm:col-span-3">
                             <label for="transmission"
                                 class="block text-sm font-medium leading-6 text-gray-900">Transmisi</label>
                             <div class="mt-2">
                                 <select id="transmission" name="transmission" required
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                                     <option value="">Pilih transmisi</option>
                                     <option value="manual">Manual</option>
                                     <option value="automatic">Otomatis</option>
                                     <option value="cvt">CVT</option>
                                 </select>
                             </div>
                         </div>

                         <div class="sm:col-span-3">
                             <label for="seats" class="block text-sm font-medium leading-6 text-gray-900">Jumlah
                                 Kursi</label>
                             <div class="mt-2">
                                 <select id="seats" name="seats" required
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                                     <option value="">Pilih jumlah kursi</option>
                                     @for ($s = 2; $s <= 8; $s++)
                                         <option value="{{ $s }}">
                                             {{ $s }} kursi</option>
                                     @endfor
                                 </select>
                             </div>
                         </div>

                         <div class="sm:col-span-3">
                             <label for="color"
                                 class="block text-sm font-medium leading-6 text-gray-900">Warna</label>
                             <div class="mt-2">
                                 <input type="text" name="color" id="color" required
                                     placeholder="Contoh: Hitam, Putih, Merah, Biru"
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                             </div>
                         </div>

                         <div class="sm:col-span-3">
                             <label for="category"
                                 class="block text-sm font-medium leading-6 text-gray-900">Kategori</label>
                             <div class="mt-2">
                                 <select id="category" name="category" required
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                                     <option value="">Pilih kategori</option>
                                     <option value="Sedan">Sedan</option>
                                     <option value="SUV">SUV</option>
                                     <option value="MPV">MPV</option>
                                     <option value="Hatchback">Hatchback</option>
                                     <option value="Sport">Sport</option>
                                     <option value="Van">Van</option>
                                 </select>
                             </div>
                         </div>

                         <div class="sm:col-span-3">
                             <label for="status"
                                 class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                             <div class="mt-2">
                                 <select id="status" name="status" required
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                                     <option value="">Pilih status</option>
                                     <option value="tersedia">Tersedia</option>
                                     <option value="disewa">Disewa</option>
                                     <option value="perbaikan">Perbaikan</option>
                                 </select>
                             </div>
                         </div>

                         <div class="sm:col-span-3">
                             <label for="doors" class="block text-sm font-medium leading-6 text-gray-900">Jumlah
                                 Pintu</label>
                             <div class="mt-2">
                                 <select id="doors" name="doors"
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                                     <option value="">Pilih jumlah pintu</option>
                                     @for ($d = 2; $d <= 6; $d++)
                                         <option value="{{ $d }}">
                                             {{ $d }} pintu</option>
                                     @endfor
                                 </select>
                             </div>
                         </div>

                         <div class="sm:col-span-3">
                             <label for="mileage" class="block text-sm font-medium leading-6 text-gray-900">Jarak
                                 Tempuh (km)</label>
                             <div class="mt-2">
                                 <input type="number" name="mileage" id="mileage" placeholder="Contoh: 50000"
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                             </div>
                         </div>

                         <div class="col-span-full">
                             <label for="description"
                                 class="block text-sm font-medium leading-6 text-gray-900">Deskripsi</label>
                             <div class="mt-2">
                                 <textarea name="description" id="description" rows="3" placeholder="Deskripsi mobil..."
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6"></textarea>
                             </div>
                         </div>

                         <div class="col-span-full">
                             <label for="features"
                                 class="block text-sm font-medium leading-6 text-gray-900">Fitur</label>
                             <div class="mt-2">
                                 <textarea id="features" name="features" rows="3"
                                     placeholder="Contoh: AC, GPS Navigasi, Bluetooth, Jok Kulit, Sunroof"
                                     class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6"></textarea>
                             </div>
                             <p class="mt-1 text-sm leading-6 text-gray-600">Daftar fitur utama mobil ini, pisahkan
                                 dengan koma.</p>
                         </div>

                         <div class="col-span-full">
                             <div class="mt-2">
                                 <label class="block text-sm font-medium leading-6 text-gray-900 mb-3">Gambar
                                     Mobil</label>

                                 <!-- Two Column Layout for Images -->
                                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                     <!-- Upload Gambar Utama -->
                                     <div>
                                         <label class="block text-sm font-medium text-gray-700 mb-2">Gambar
                                             Utama</label>

                                         <div
                                             class="flex items-center justify-center px-4 py-6 border-2 border-dashed rounded border-gray-300 bg-white">
                                             <div class="text-center">
                                                 <svg class="w-8 h-8 mx-auto text-gray-300 mb-1" fill="none"
                                                     stroke="currentColor" viewBox="0 0 24 24">
                                                     <path stroke-linecap="round" stroke-linejoin="round"
                                                         stroke-width="2"
                                                         d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                     </path>
                                                 </svg>
                                                 <label for="main-image" class="cursor-pointer block">
                                                     <span class="text-sm text-orange-500 hover:text-orange-600">Upload
                                                         gambar utama</span>
                                                     <input id="main-image" name="image" type="file"
                                                         accept="image/*" class="sr-only"
                                                         onchange="previewImage(this, 'main-preview')">
                                                 </label>
                                                 <p class="text-xs text-gray-400 mt-0.5">PNG, JPG, GIF up to 2MB</p>
                                             </div>
                                         </div>
                                         <div id="main-preview" class="mt-2" style="display: none;">
                                             <img class="w-full h-24 object-cover rounded border border-gray-200"
                                                 alt="Main image preview">
                                         </div>
                                     </div>

                                     <!-- Upload Gallery Images -->
                                     <div>
                                         <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Galeri
                                             (Opsional)</label>

                                         <div
                                             class="flex items-center justify-center px-4 py-6 border-2 border-dashed rounded border-gray-300 bg-white">
                                             <div class="text-center">
                                                 <svg class="w-8 h-8 mx-auto text-gray-300 mb-1" fill="none"
                                                     stroke="currentColor" viewBox="0 0 24 24">
                                                     <path stroke-linecap="round" stroke-linejoin="round"
                                                         stroke-width="2"
                                                         d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                     </path>
                                                 </svg>
                                                 <label for="gallery-images" class="cursor-pointer block">
                                                     <span class="text-sm text-orange-500 hover:text-orange-600">Upload
                                                         gallery images</span>
                                                     <input id="gallery-images" name="gallery_images[]"
                                                         type="file" accept="image/*" multiple class="sr-only"
                                                         onchange="previewMultipleImages(this, 'gallery-preview')">
                                                 </label>
                                                 <p class="text-xs text-gray-400 mt-0.5">Select multiple images</p>
                                             </div>
                                         </div>
                                         <div id="gallery-preview" class="mt-2 grid grid-cols-2 gap-2"
                                             style="display: none;">
                                             <!-- Gallery previews will be inserted here -->
                                         </div>
                                     </div>
                                 </div>

                             </div>
                         </div>
                     </div>
                 </div>

                 <div class="flex items-center justify-center gap-x-6 mb-6">
                     <a href='/admin/cars'
                         class="text-sm font-semibold leading-6 text-gray-900 border border-orange-400 px-4 py-2 rounded-md hover:bg-orange-50">Batal</a>
                     <button type="submit" id="submitBtn"
                         class="w-1/3 rounded-md bg-orange-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-600">Tambah
                         Mobil</button>
                 </div>
             </div>
         </form>
     </div>

     <script>
         function previewImage(input, previewId) {
             const preview = document.getElementById(previewId);
             if (input.files && input.files[0]) {
                 const reader = new FileReader();
                 reader.onload = function(e) {
                     preview.querySelector('img').src = e.target.result;
                     preview.style.display = 'block';
                 }
                 reader.readAsDataURL(input.files[0]);
             }
         }

         function previewMultipleImages(input, previewId) {
             const preview = document.getElementById(previewId);
             preview.innerHTML = '';

             if (input.files) {
                 Array.from(input.files).forEach((file, index) => {
                     const reader = new FileReader();
                     reader.onload = function(e) {
                         const div = document.createElement('div');
                         div.className = 'relative';
                         div.innerHTML = `
                             <img src="${e.target.result}" class="w-full h-24 object-cover rounded border border-gray-200">
                             <span class="absolute top-1 left-1 bg-green-500 text-white text-xs px-2 py-0.5 rounded font-medium">Gallery ${index + 1}</span>
                         `;
                         preview.appendChild(div);
                     }
                     reader.readAsDataURL(file);
                 });
                 preview.style.display = 'grid';
             }
         }

         document.getElementById('createCarForm').addEventListener('submit', function(e) {
             e.preventDefault();

             const form = this;
             const formData = new FormData(form);
             const submitBtn = document.getElementById('submitBtn');
             const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

             // Debug: Log form data
             console.log('=== FORM SUBMIT DEBUG ===');
             console.log('Form Action:', form.action);
             console.log('Form Data:');
             for (let [key, value] of formData.entries()) {
                 console.log(`  ${key}: ${value}`);
             }

             // Disable button
             submitBtn.disabled = true;
             submitBtn.textContent = 'Menyimpan...';

             // Show loading
             Swal.fire({
                 title: 'Memproses...',
                 text: 'Mohon tunggu, sedang menambahkan mobil baru',
                 allowOutsideClick: false,
                 didOpen: () => {
                     Swal.showLoading();
                 }
             });

             // Send request
             fetch(form.action, {
                     method: 'POST',
                     body: formData,
                     headers: {
                         'X-CSRF-TOKEN': csrfToken,
                         'Accept': 'application/json'
                     }
                 })
                 .then(response => {
                     console.log('Response Status:', response.status);
                     return response.json();
                 })
                 .then(data => {
                     console.log('Response Data:', data);
                     if (data.success) {
                         Swal.fire({
                             icon: 'success',
                             title: 'Berhasil!',
                             text: data.message,
                             showConfirmButton: false,
                             timer: 2000
                         }).then(() => {
                             window.location.href = '/admin/cars';
                         });
                     } else {
                         // Handle validation errors
                         let errorMessage = 'Gagal menambahkan mobil';
                         if (data.errors) {
                             errorMessage = Object.values(data.errors).flat().join('\n');
                         } else if (data.message) {
                             errorMessage = data.message;
                         }

                         Swal.fire({
                             icon: 'error',
                             title: 'Gagal!',
                             text: errorMessage,
                             confirmButtonColor: '#3085d6'
                         });

                         // Re-enable button
                         submitBtn.disabled = false;
                         submitBtn.textContent = 'Tambah Mobil';
                     }
                 })
                 .catch(error => {
                     console.error('Error:', error);
                     Swal.fire({
                         icon: 'error',
                         title: 'Error!',
                         text: 'Terjadi kesalahan saat menambahkan data: ' + error.message,
                         confirmButtonColor: '#3085d6'
                     });

                     // Re-enable button
                     submitBtn.disabled = false;
                     submitBtn.textContent = 'Tambah Mobil';
                 });
         });
     </script>
 </body>

 </html>
