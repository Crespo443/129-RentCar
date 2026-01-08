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
    <div class="my-20 flex flex-col justify-center items-center mx-auto max-w-screen-xl">
        <form class="w-full" method='post' action='/admin/cars/1'>
            @csrf
            <div
                class="md:w-2/3 w-5/6 md:px-24 px-4 pb-8 mx-auto mt-2 space-y-12 bg-white border-2 border-gray-300 rounded-md shadow-lg">
                <div class="border-b border-gray-300 pb-12">
                    <h2 class="mt-2 text-center font-bold text-2xl leading-7 text-gray-900">Memperbarui mobil: <span
                            class="text-orange-500">Toyota Avanza 1.5L</span></h2>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="brand"
                                class="block text-sm font-medium leading-6 text-gray-900">Merek</label>
                            <div class="mt-2">
                                <input type="text" name="brand" id="brand" value="Toyota"
                                    class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="model"
                                class="block text-sm font-medium leading-6 text-gray-900">Model</label>
                            <div class="mt-2">
                                <input type="text" name="model" id="model" value="Avanza"
                                    class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-2 sm:col-start-1">
                            <label for="engine"
                                class="block text-sm font-medium leading-6 text-gray-900">Mesin</label>
                            <div class="mt-2">
                                <input type="text" name="engine" id="engine" value="1.5L"
                                    class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="police_number" class="block text-sm font-medium leading-6 text-gray-900">Nomor
                                Polisi</label>
                            <div class="mt-2">
                                <input type="text" name="police_number" id="police_number" value="B 1234 XYZ"
                                    placeholder="Contoh: B 1234 ABC"
                                    class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="price_per_day" class="block text-sm font-medium leading-6 text-gray-900">Harga
                                per Hari (Rp)</label>
                            <div class="mt-2">
                                <input type="number" name="price_per_day" id="price_per_day" value="350000"
                                    placeholder="Contoh: 500000"
                                    class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="reduce" class="block text-sm font-medium leading-6 text-gray-900">Diskon
                                %</label>
                            <div class="mt-2">
                                <input type="number" name="reduce" id="reduce" value="15"
                                    class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="stars" class="block text-sm font-medium leading-6 text-gray-900">Rating
                                Mobil</label>
                            <div class="mt-2">
                                <select id="stars" name="stars"
                                    class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option value="1">1/5</option>
                                    <option value="2">2/5</option>
                                    <option value="3">3/5</option>
                                    <option value="4">4/5</option>
                                    <option value="5" selected>5/5 ⭐⭐⭐⭐⭐</option>
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="year"
                                class="block text-sm font-medium leading-6 text-gray-900">Tahun</label>
                            <div class="mt-2">
                                <select id="year" name="year"
                                    class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023" selected>2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="fuel_type" class="block text-sm font-medium leading-6 text-gray-900">Jenis
                                Bahan Bakar</label>
                            <div class="mt-2">
                                <select id="fuel_type" name="fuel_type"
                                    class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                                    <option value="">Pilih jenis bahan bakar</option>
                                    <option value="Gasoline" selected>Bensin</option>
                                    <option value="Diesel">Solar</option>
                                    <option value="Hybrid">Hybrid</option>
                                    <option value="Electric">Listrik</option>
                                    <option value="Plug-in Hybrid">Plug-in Hybrid</option>
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="transmission"
                                class="block text-sm font-medium leading-6 text-gray-900">Transmisi</label>
                            <div class="mt-2">
                                <select id="transmission" name="transmission"
                                    class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                                    <option value="">Pilih transmisi</option>
                                    <option value="Manual">Manual</option>
                                    <option value="Automatic" selected>Otomatis</option>
                                    <option value="CVT">CVT (Continuously Variable)</option>
                                    <option value="Semi-Automatic">Semi-Otomatis</option>
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="seats" class="block text-sm font-medium leading-6 text-gray-900">Jumlah
                                Kursi</label>
                            <div class="mt-2">
                                <select id="seats" name="seats"
                                    class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                                    <option value="">Pilih jumlah kursi</option>
                                    <option value="2">2 kursi</option>
                                    <option value="4">4 kursi</option>
                                    <option value="5">5 kursi</option>
                                    <option value="7" selected>7 kursi</option>
                                    <option value="8">8 kursi</option>
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="color"
                                class="block text-sm font-medium leading-6 text-gray-900">Warna</label>
                            <div class="mt-2">
                                <input type="text" name="color" id="color" value="Silver"
                                    placeholder="Contoh: Hitam, Putih, Merah, Biru"
                                    class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="mileage" class="block text-sm font-medium leading-6 text-gray-900">Jarak
                                Tempuh (km)</label>
                            <div class="mt-2">
                                <input type="number" name="mileage" id="mileage" value="25000"
                                    placeholder="Contoh: 50000"
                                    class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="features"
                                class="block text-sm font-medium leading-6 text-gray-900">Fitur</label>
                            <div class="mt-2">
                                <textarea id="features" name="features" rows="3"
                                    placeholder="Contoh: AC, GPS Navigasi, Bluetooth, Jok Kulit, Sunroof"
                                    class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">AC, Bluetooth, GPS, USB Charging</textarea>
                            </div>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Daftar fitur utama mobil ini, pisahkan
                                dengan koma.</p>
                        </div>

                        <div class="col-span-full">
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</h4>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <div class="relative">
                                        <img src="https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800&h=600&fit=crop"
                                            alt="Main image" class="w-full h-24 object-cover rounded border">
                                        <span
                                            class="absolute top-1 left-1 bg-blue-600 text-white text-xs px-1 rounded">Main</span>
                                    </div>
                                    <div class="relative">
                                        <img src="https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=400&h=300&fit=crop"
                                            alt="Gallery image 1" class="w-full h-24 object-cover rounded border">
                                        <span
                                            class="absolute top-1 left-1 bg-green-600 text-white text-xs px-1 rounded">Gallery
                                            1</span>
                                    </div>
                                    <div class="relative">
                                        <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=400&h=300&fit=crop"
                                            alt="Gallery image 2" class="w-full h-24 object-cover rounded border">
                                        <span
                                            class="absolute top-1 left-1 bg-green-600 text-white text-xs px-1 rounded">Gallery
                                            2</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-2">
                                <!-- Multiple Image Upload -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Main Image -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Perbarui Gambar
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
                                                    <label for="main-image-update"
                                                        class="relative font-semibold bg-white rounded-md cursor-pointer text-pr-400 focus-within:outline-none focus-within:ring-2 focus-within:ring-pr-400 focus-within:ring-offset-2 hover:text-pr-400">
                                                        <span>Upload gambar utama baru</span>
                                                        <input id="main-image-update" name="main_image"
                                                            type="file" accept="image/*" class="sr-only"
                                                            onchange="previewImage(this, 'main-preview-update')">
                                                    </label>
                                                </div>
                                                <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                            </div>
                                        </div>
                                        <div id="main-preview-update" class="mt-2" style="display: none;">
                                            <img class="w-full h-40 object-cover rounded-lg" alt="Main image preview">
                                        </div>
                                    </div>

                                    <!-- Gallery Images -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Update Gallery
                                        </label>
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
                                                    <label for="gallery-images-update"
                                                        class="relative font-semibold bg-white rounded-md cursor-pointer text-pr-400 focus-within:outline-none focus-within:ring-2 focus-within:ring-pr-400 focus-within:ring-offset-2 hover:text-pr-400">
                                                        <span>Upload Gambar Baru</span>
                                                        <input id="gallery-images-update" name="gallery_images[]"
                                                            type="file" accept="image/*" multiple class="sr-only"
                                                            onchange="previewMultipleImages(this, 'gallery-preview-update')">
                                                    </label>
                                                </div>
                                                <p class="text-xs leading-5 text-gray-600">Upload Beberapa Gambar</p>
                                            </div>
                                        </div>
                                        <div id="gallery-preview-update" class="mt-2 grid grid-cols-2 gap-2"
                                            style="display: none;">
                                            <!-- Gallery previews will be inserted here -->
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <h4 class="text-sm font-medium text-gray-700 mb-3">Atau Tambahkan URL</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="image_url"
                                                class="block text-sm font-medium text-gray-700 mb-1">URL Gambar
                                                Utama</label>
                                            <input type="text" name="image_url" id="image_url"
                                                value="https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800&h=600&fit=crop"
                                                placeholder="https://example.com/car-image.jpg"
                                                class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                                        </div>
                                        <div>
                                            <label for="gallery_urls"
                                                class="block text-sm font-medium text-gray-700 mb-1">Gallery
                                                URLs</label>
                                            <textarea name="gallery_urls" id="gallery_urls" rows="2"
                                                placeholder="https://example.com/image1.jpg, https://example.com/image2.jpg"
                                                class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=400&h=300&fit=crop, https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=400&h=300&fit=crop</textarea>
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
                                    class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option value="Tersedia" selected>Tersedia</option>
                                    <option value="Disewa">Disewa</option>
                                    <option value="Perbaikan">Perbaikan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-x-6 mb-6">
                    <a href='/admin/cars'
                        class="text-sm font-semibold leading-6 text-gray-900 border border-orange-400 px-4 py-2 rounded-md hover:bg-orange-50">Batal</a>
                    <button type="submit" onclick="alert('Berhasil Update Mobil')"
                        class="w-1/3 rounded-md bg-orange-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-600">Simpan
                        Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
