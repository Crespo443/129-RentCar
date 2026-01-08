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


      <div class="bg-gray-200 mx-auto max-w-screen-xl mt-10 p-6 rounded-md shadow-xl">
          <form action="/cars/search" method="GET">
              <!-- First Row -->
              <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Merek</label>
                      <input type="text" placeholder="Toyota" name="brand"
                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                  </div>
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Model</label>
                      <input type="text" placeholder="Camry" name="model"
                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                  </div>
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                      <select name="category"
                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                          <option value="">Semua Kategori</option>
                          <option value="Sedan">Sedan</option>
                          <option value="City Car">City Car</option>
                          <option value="SUV">SUV</option>
                          <option value="Crossover">Crossover</option>
                          <option value="Double Cabin">Double Cabin</option>
                          <option value="MPV">MPV</option>
                          <option value="Hatchback">Hatchback</option>
                      </select>
                  </div>
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Transmisi</label>
                      <select name="transmission"
                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                          <option value="">Semua</option>
                          <option value="Otomatis">Otomatis</option>
                          <option value="Manual">Manual</option>
                      </select>
                  </div>
              </div>

              <!-- Second Row -->
              <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Bahan Bakar</label>
                      <select name="fuel_type"
                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                          <option value="">Semua</option>
                          <option value="Bensin">Bensin</option>
                          <option value="Solar">Solar</option>
                          <option value="Listrik">Listrik</option>
                      </select>
                  </div>
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Kursi Minimum</label>
                      <select name="seats"
                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                          <option value="">Semua</option>
                          <option value="2">2+ Kursi</option>
                          <option value="4">4+ Kursi</option>
                          <option value="5">5+ Kursi</option>
                          <option value="7">7+ Kursi</option>
                      </select>
                  </div>
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Harga Minimum</label>
                      <input type="number" placeholder="0" name="min_price" value=""
                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                  </div>
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Harga Maksimum</label>
                      <input type="number" placeholder="1000000" name="max_price" value=""
                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                  </div>
              </div>

              <!-- Search and Clear Buttons -->
              <div class="flex justify-between items-center">
                  <div class="flex space-x-3">
                      <button type="button" onclick="alert('Mencari Mobil')"
                          class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-6 rounded-md transition-colors">
                          Cari Mobil
                      </button>
                      <a href="/cars" onclick="alret('Hapus Filter')"
                          class="bg-gray-400 hover:bg-gray-500 text-white font-medium py-2 px-6 rounded-md transition-colors">
                          Hapus Filter
                      </a>
                  </div>
                  <div class="text-sm text-gray-600">
                      Gunakan filter untuk mencari mobil yang sesuai
                  </div>
              </div>
          </form>
      </div>
      <div class="mt-6 mb-2 grid md:grid-cols-3 justify-center items-center mx-auto max-w-screen-xl">
          <!-- Mobil 1: Toyota Camry -->
          <div
              class="relative md:m-10 m-4 flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md">
              <a class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl" href="/cars/1">
                  <img loading="lazy" class="object-cover"
                      src="https://tse2.mm.bing.net/th/id/OIP.8NigPGR5EtQOGZPAn_gpPgHaEo?cb=ucfimgc2&rs=1&pid=ImgDetMain&o=7&rm=3"
                      alt="Toyota Camry" />
                  <span
                      class="absolute top-0 left-0 m-2 rounded-full bg-orange-500 px-2 text-center text-sm font-medium text-white">15%
                      OFF</span>
              </a>
              <div class="mt-4 px-5 pb-5">
                  <div>
                      <a href="/cars/1">
                          <h5
                              class="font-bold text-xl tracking-tight text-slate-900 hover:text-orange-500 transition-colors">
                              Toyota Camry 2.5L</h5>
                      </a>
                  </div>
                  <div class="mt-2 mb-5 flex items-center justify-between">
                      <p>
                          <span class="text-xl font-bold text-slate-900">Rp 425.000</span>
                          <br>
                          <span class="text-sm text-slate-900 line-through">Rp 500.000</span>
                      </p>
                      <div class="flex items-center ml-1">
                          <svg aria-hidden="true" class="h-5 w-5 text-orange-400" fill="currentColor"
                              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                              </path>
                          </svg>
                          <svg aria-hidden="true" class="h-5 w-5 text-orange-400" fill="currentColor"
                              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                              </path>
                          </svg>
                          <svg aria-hidden="true" class="h-5 w-5 text-orange-400" fill="currentColor"
                              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                              </path>
                          </svg>
                          <svg aria-hidden="true" class="h-5 w-5 text-orange-400" fill="currentColor"
                              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                              </path>
                          </svg>
                          <svg aria-hidden="true" class="h-5 w-5 text-orange-400" fill="currentColor"
                              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                              </path>
                          </svg>
                          <span class="mr-2 ml-3 rounded bg-orange-300 px-2.5 py-0.5 text-xs font-semibold">5.0</span>
                      </div>
                  </div>
                  <a href="/cars/1"
                      class="flex items-center justify-center rounded-md bg-slate-900 hover:bg-orange-500 px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4 focus:ring-blue-300">
                      <svg class="mr-4 h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                          <path fill-rule="evenodd"
                              d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                              clip-rule="evenodd" />
                      </svg>
                      Lihat Detail</a>
              </div>
          </div>

          <!-- Mobil 2: Honda Civic -->
          <div
              class="relative md:m-10 m-4 flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md">
              <a class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl" href="/cars/2">
                  <img loading="lazy" class="object-cover"
                      src="https://tse2.mm.bing.net/th/id/OIP.8NigPGR5EtQOGZPAn_gpPgHaEo?cb=ucfimgc2&rs=1&pid=ImgDetMain&o=7&rm=3"
                      alt="Honda Civic" />
                  <span
                      class="absolute top-0 left-0 m-2 rounded-full bg-orange-500 px-2 text-center text-sm font-medium text-white">10%
                      OFF</span>
              </a>
              <div class="mt-4 px-5 pb-5">
                  <div>
                      <a href="/cars/2">
                          <h5
                              class="font-bold text-xl tracking-tight text-slate-900 hover:text-orange-500 transition-colors">
                              Honda Civic 1.8L</h5>
                      </a>
                  </div>
                  <div class="mt-2 mb-5 flex items-center justify-between">
                      <p>
                          <span class="text-xl font-bold text-slate-900">Rp 405.000</span>
                          <br>
                          <span class="text-sm text-slate-900 line-through">Rp 450.000</span>
                      </p>
                      <div class="flex items-center ml-1">
                          <svg aria-hidden="true" class="h-5 w-5 text-orange-400" fill="currentColor"
                              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                              </path>
                          </svg>
                          <svg aria-hidden="true" class="h-5 w-5 text-orange-400" fill="currentColor"
                              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                              </path>
                          </svg>
                          <svg aria-hidden="true" class="h-5 w-5 text-orange-400" fill="currentColor"
                              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                              </path>
                          </svg>
                          <svg aria-hidden="true" class="h-5 w-5 text-orange-400" fill="currentColor"
                              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                              </path>
                          </svg>
                          <span class="mr-2 ml-3 rounded bg-orange-300 px-2.5 py-0.5 text-xs font-semibold">4.0</span>
                      </div>
                  </div>
                  <a href="/cars/2"
                      class="flex items-center justify-center rounded-md bg-slate-900 hover:bg-orange-500 px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4 focus:ring-blue-300">
                      <svg class="mr-4 h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                          <path fill-rule="evenodd"
                              d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                              clip-rule="evenodd" />
                      </svg>
                      Lihat Detail</a>
              </div>
          </div>

          <!-- Mobil 3: BMW X5 -->
          <div
              class="relative md:m-10 m-4 flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md">
              <a class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl" href="/cars/3">
                  <img loading="lazy" class="object-cover"
                      src="https://tse2.mm.bing.net/th/id/OIP.8NigPGR5EtQOGZPAn_gpPgHaEo?cb=ucfimgc2&rs=1&pid=ImgDetMain&o=7&rm=3"
                      alt="BMW X5" />
                  <span
                      class="absolute top-0 left-0 m-2 rounded-full bg-orange-500 px-2 text-center text-sm font-medium text-white">20%
                      OFF</span>
              </a>
              <div class="mt-4 px-5 pb-5">
                  <div>
                      <a href="/cars/3">
                          <h5
                              class="font-bold text-xl tracking-tight text-slate-900 hover:text-orange-500 transition-colors">
                              BMW X5 3.0L</h5>
                      </a>
                  </div>
                  <div class="mt-2 mb-5 flex items-center justify-between">
                      <p>
                          <span class="text-xl font-bold text-slate-900">Rp 960.000</span>
                          <br>
                          <span class="text-sm text-slate-900 line-through">Rp 1.200.000</span>
                      </p>
                      <div class="flex items-center ml-1">
                          <svg aria-hidden="true" class="h-5 w-5 text-orange-400" fill="currentColor"
                              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                              </path>
                          </svg>
                          <svg aria-hidden="true" class="h-5 w-5 text-orange-400" fill="currentColor"
                              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                              </path>
                          </svg>
                          <svg aria-hidden="true" class="h-5 w-5 text-orange-400" fill="currentColor"
                              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                              </path>
                          </svg>
                          <svg aria-hidden="true" class="h-5 w-5 text-orange-400" fill="currentColor"
                              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                              </path>
                          </svg>
                          <svg aria-hidden="true" class="h-5 w-5 text-orange-400" fill="currentColor"
                              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                              </path>
                          </svg>
                          <span class="mr-2 ml-3 rounded bg-orange-300 px-2.5 py-0.5 text-xs font-semibold">5.0</span>
                      </div>
                  </div>
                  <a href="/cars/3"
                      class="flex items-center justify-center rounded-md bg-slate-900 hover:bg-orange-500 px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4 focus:ring-blue-300">
                      <svg class="mr-4 h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                          <path fill-rule="evenodd"
                              d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                              clip-rule="evenodd" />
                      </svg>
                      Lihat Detail</a>
              </div>
          </div>
      </div>
      <footer role="navigation" aria-label="Pagination Navigation"
          class="flex items-center justify-center mt-6 mb-8">
          <div class="flex flex-col justify-center items-center">
              <div>
                  <span class="relative z-0 inline-flex shadow-sm rounded-md">
                      <!-- Tombol Previous (disabled) -->
                      <span aria-disabled="true">
                          <span
                              class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-l-md leading-5"
                              aria-hidden="true">
                              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                  <path fill-rule="evenodd"
                                      d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                      clip-rule="evenodd" />
                              </svg>
                          </span>
                      </span>

                      <!-- Nomor halaman -->
                      <a href="/cars"
                          class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-orange-500 bg-white border border-gray-300 cursor-default leading-5">1</a>
                      <a href="/cars"
                          class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-orange-500 transition">2</a>
                      <a href="/cars"
                          class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-orange-500 transition">3</a>
                      <span
                          class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default leading-5">...</span>
                      <a href="/cars"
                          class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-orange-500 transition">10</a>

                      <!-- Tombol Next -->
                      <a href="/cars"
                          class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-orange-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 transition">
                          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd"
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd" />
                          </svg>
                      </a>
                  </span>
              </div>

              <!-- Info halaman -->
              <div class="mt-2">
                  <p class="text-sm text-gray-700 leading-5">
                      Menampilkan <span class="font-medium">1</span> hingga <span class="font-medium">3</span> dari
                      <span class="font-medium">3</span> hasil
                  </p>
              </div>
          </div>
      </footer>

      <script>
          // Fungsi pencarian mobil
          function cariMobil() {
              Swal.fire({
                  icon: 'info',
                  title: 'Mencari Mobil',
                  text: 'Fitur pencarian sedang diproses...',
                  showConfirmButton: false,
                  timer: 1500
              });
          }

          // Fungsi hapus filter
          function hapusFilter(event) {
              event.preventDefault();
              Swal.fire({
                  icon: 'success',
                  title: 'Filter Dihapus',
                  text: 'Semua filter telah dihapus',
                  showConfirmButton: false,
                  timer: 1500
              }).then(() => {
                  window.location.href = '/cars';
              });
          }
      </script>
  </body>

  </html>
