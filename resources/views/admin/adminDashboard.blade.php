<!DOCTYPE html>
<html lang="in">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'FunCar') }} - Admin Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
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

    <main class="max-w-screen-2xl mx-auto px-4 py-8">
        <!-- Page Title -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
            <p class="text-gray-600 mt-1">Selamat datang di panel admin RentCar</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid gap-6 mb-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
            <!-- Total Pendapatan -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-white bg-opacity-30">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium opacity-90">Total Pendapatan</p>
                        <p class="text-2xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Pemesanan -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-white bg-opacity-30">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium opacity-90">Total Pemesanan</p>
                        <p class="text-2xl font-bold">{{ $totalReservations }}</p>
                    </div>
                </div>
            </div>

            <!-- Pesanan Aktif -->
            <div class="bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-white bg-opacity-30">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium opacity-90">Pesanan Aktif</p>
                        <p class="text-2xl font-bold">{{ $activeReservations }}</p>
                    </div>
                </div>
            </div>

            <!-- Ulasan -->
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-white bg-opacity-30">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium opacity-90">Rating Rata-rata</p>
                        <p class="text-2xl font-bold">{{ number_format($averageRating, 1) }}/5</p>
                        <p class="text-xs opacity-75">{{ $pendingReviews }} ulasan baru</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid gap-6 mb-8 lg:grid-cols-3">
            <!-- Pendapatan Harian (Full Width on Mobile) -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Pendapatan Harian</h3>
                <div class="space-y-3">
                    @forelse($dailyRevenue as $daily)
                        <div
                            class="flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-lg border-l-4 border-green-500 hover:shadow-md transition">
                            <div>
                                <p class="text-sm font-medium text-gray-700">
                                    {{ \Carbon\Carbon::parse($daily->date)->format('d F Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $daily->count }} Pemesanan</p>
                            </div>
                            <p class="text-lg font-bold text-green-700">Rp
                                {{ number_format($daily->revenue, 0, ',', '.') }}</p>
                        </div>
                    @empty
                        <div class="text-center py-12 text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            <p class="font-medium">Belum ada pendapatan</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Statistik Pemesanan -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Statistik Pemesanan</h3>
                <div class="space-y-4">
                    <div
                        class="flex items-center justify-between p-4 bg-green-50 rounded-lg border-l-4 border-green-500">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Active</p>
                                <p class="text-xs text-gray-600">Sedang Berlangsung</p>
                            </div>
                        </div>
                        <p class="text-2xl font-bold text-green-600">{{ $activeReservations }}</p>
                    </div>

                    <div
                        class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border-l-4 border-gray-400">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-gray-500 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Ended</p>
                                <p class="text-xs text-gray-600">Telah Selesai</p>
                            </div>
                        </div>
                        <p class="text-2xl font-bold text-gray-600">{{ $completedReservations }}</p>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg border-l-4 border-red-500">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-red-500 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Canceled</p>
                                <p class="text-xs text-gray-600">Dibatalkan</p>
                            </div>
                        </div>
                        <p class="text-2xl font-bold text-red-600">{{ $canceledReservations }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Three Column Grid -->
        <div class="grid gap-6 mb-8 md:grid-cols-2 lg:grid-cols-3">
            <!-- Mobil Terpopuler -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Mobil Terpopuler</h3>
                <div class="space-y-3">
                    @forelse($popularCars as $car)
                        <div class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <p class="font-semibold text-sm text-gray-800">{{ $car->brand }}
                                        {{ $car->model }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $car->reservations_count }} Pemesanan</p>
                                </div>
                                <div class="flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-3 h-3 {{ $i <= $car->stars ? 'text-yellow-400' : 'text-gray-300' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-sm font-bold text-green-600">Rp
                                {{ number_format($car->reservations_sum_total_price ?? 0, 0, ',', '.') }}</p>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-400">
                            <p class="text-sm">Belum ada data pemesanan</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Pendapatan per Kategori -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Pendapatan per Kategori</h3>
                <div class="space-y-3">
                    @php
                        $categoryColors = [
                            'Luxury' => ['bg' => 'purple-50', 'border' => 'purple-500', 'text' => 'purple-700'],
                            'SUV' => ['bg' => 'blue-50', 'border' => 'blue-500', 'text' => 'blue-700'],
                            'Sedan' => ['bg' => 'green-50', 'border' => 'green-500', 'text' => 'green-700'],
                            'MPV' => ['bg' => 'yellow-50', 'border' => 'yellow-500', 'text' => 'yellow-700'],
                            'Hatchback' => ['bg' => 'red-50', 'border' => 'red-500', 'text' => 'red-700'],
                            'City Car' => ['bg' => 'pink-50', 'border' => 'pink-500', 'text' => 'pink-700'],
                            'Crossover' => ['bg' => 'indigo-50', 'border' => 'indigo-500', 'text' => 'indigo-700'],
                            'Double Cabin' => [
                                'bg' => 'orange-50',
                                'border' => 'orange-500',
                                'text' => 'orange-700',
                            ],
                        ];
                    @endphp
                    @forelse($categoryRevenue as $cat)
                        @php
                            $color = $categoryColors[$cat->category] ?? [
                                'bg' => 'gray-50',
                                'border' => 'gray-500',
                                'text' => 'gray-700',
                            ];
                        @endphp
                        <div
                            class="p-4 bg-{{ $color['bg'] }} rounded-lg border-l-4 border-{{ $color['border'] }} hover:shadow-md transition">
                            <div class="flex justify-between items-center">
                                <p class="font-semibold text-sm text-gray-800">{{ $cat->category }}</p>
                                <p class="text-sm font-bold text-{{ $color['text'] }}">Rp
                                    {{ number_format($cat->total, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-400">
                            <p class="text-sm">Belum ada data pendapatan</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Ulasan -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Ulasan</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Total Ulasan</span>
                        <span class="font-bold text-gray-800">{{ $totalReviews }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Rata-rata</span>
                        <span class="font-bold text-gray-800">{{ number_format($averageRating, 1) }}/5</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Disetujui</span>
                        <span class="font-bold text-green-600">{{ $approvedReviews }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-yellow-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Menunggu</span>
                        <span class="font-bold text-yellow-600">{{ $pendingReviewsCount }}</span>
                    </div>

                    <div class="mt-4 pt-4 border-t">
                        <p class="text-sm font-semibold text-gray-700 mb-3">Distribusi Rating</p>
                        @for ($rating = 5; $rating >= 1; $rating--)
                            @php
                                $count = $ratingDistribution[$rating] ?? 0;
                                $percentage = $approvedReviews > 0 ? ($count / $approvedReviews) * 100 : 0;
                            @endphp
                            <div class="flex items-center mb-2">
                                <span class="text-xs w-8 font-medium">{{ $rating }}★</span>
                                <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-yellow-400 h-2.5 rounded-full transition-all duration-300"
                                        style="width: {{ $percentage }}%"></div>
                                </div>
                                <span class="text-xs text-gray-600 w-8 text-right">{{ $count }}</span>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        <!-- Reservations Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800">Reservasi Terbaru</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pengguna</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mobil</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mulai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Selesai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Durasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sisa Hari</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status Pembayaran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status Pengembalian</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Pengembalian</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reservations ?? [] as $reservation)
                            @php
                                // Hitung sisa hari menggunakan helper
                                $remainingDays = \App\Helpers\DateHelper::calculateRemainingDays(
                                    $reservation->end_date,
                                );
                                $sisaHariText = $remainingDays['text'];
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div
                                                class="h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center">
                                                <span
                                                    class="text-orange-600 font-semibold">{{ substr($reservation->user->name ?? 'U', 0, 1) }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $reservation->user->name ?? 'N/A' }}</div>
                                            <div class="text-sm text-gray-500">{{ $reservation->user->email ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $reservation->car->brand ?? '' }} {{ $reservation->car->model ?? '' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($reservation->start_date)->format('y-m-d') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($reservation->end_date)->format('y-m-d') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $reservation->total_days }} days
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $sisaHariText }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    Rp {{ number_format($reservation->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $paymentColors = [
                                            'belum_bayar' => 'bg-gray-100 text-gray-800',
                                            'dp' => 'bg-yellow-100 text-yellow-800',
                                            'lunas' => 'bg-green-100 text-green-800',
                                        ];
                                        $paymentLabels = [
                                            'belum_bayar' => 'Belum Bayar',
                                            'dp' => 'DP',
                                            'lunas' => 'Lunas',
                                        ];
                                        $paymentColor =
                                            $paymentColors[$reservation->payment_status] ?? 'bg-gray-100 text-gray-800';
                                        $paymentLabel =
                                            $paymentLabels[$reservation->payment_status] ??
                                            $reservation->payment_status;
                                    @endphp
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $paymentColor }}">
                                        {{ $paymentLabel }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'menunggu' => 'bg-gray-100 text-gray-800',
                                            'dikonfirmasi' => 'bg-blue-100 text-blue-800',
                                            'sedang_berlangsung' => 'bg-green-100 text-green-800',
                                            'selesai' => 'bg-gray-100 text-gray-800',
                                            'dibatalkan' => 'bg-red-100 text-red-800',
                                        ];
                                        $statusLabels = [
                                            'menunggu' => 'Menunggu',
                                            'dikonfirmasi' => 'Dikonfirmasi',
                                            'sedang_berlangsung' => 'Aktif',
                                            'selesai' => 'Selesai',
                                            'dibatalkan' => 'Dibatalkan',
                                        ];
                                        $statusColor =
                                            $statusColors[$reservation->status] ?? 'bg-gray-100 text-gray-800';
                                        $statusLabel = $statusLabels[$reservation->status] ?? $reservation->status;
                                    @endphp
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $returnStatus = 'Belum Kembali';
                                        $returnColor = 'bg-yellow-100 text-yellow-800';
                                        if ($reservation->status == 'selesai') {
                                            $returnStatus = 'Sudah Kembali';
                                            $returnColor = 'bg-green-100 text-green-800';
                                        } elseif ($reservation->status == 'dibatalkan') {
                                            $returnStatus = 'Dibatalkan';
                                            $returnColor = 'bg-red-100 text-red-800';
                                        }
                                    @endphp
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $returnColor }}">
                                        {{ $returnStatus }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $reservation->status == 'selesai' ? \Carbon\Carbon::parse($reservation->updated_at)->format('Y-m-d') : 'Belum Kembali' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button
                                        onclick="openActionsModal({{ $reservation->id }}, '{{ $reservation->car->brand ?? '' }} {{ $reservation->car->model ?? '' }}', '{{ $paymentLabel }}', '{{ $statusLabel }}')"
                                        class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                            </path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="px-6 py-12 text-center text-gray-400">
                                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                    <p class="font-medium">Belum ada reservasi</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Actions Modal -->
    <div id="actionsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div class="relative mx-auto p-6 border w-full max-w-md shadow-2xl rounded-lg bg-white">
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Reservation Actions</h3>
                    <p id="actionsCarName" class="text-sm text-gray-600 mb-6"></p>

                    <div class="space-y-3">
                        <button type="button" id="editStatusLink"
                            class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Edit Status
                        </button>

                        <button type="button" id="editPaymentLink"
                            class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-md shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
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

    <!-- Return Modal -->
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
                        <input type="date" id="actual_return_date" name="actual_return_date"
                            value="{{ date('Y-m-d') }}" required
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

    <!-- Status Modal -->
    <div id="statusModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div class="relative mx-auto p-6 border w-full max-w-md shadow-2xl rounded-lg bg-white">
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Update Status Reservasi</h3>
                    <p id="statusCarName" class="text-sm text-gray-600 mb-4"></p>
                    <p class="text-sm text-gray-500 mb-6">Status Sekarang: <span id="currentStatus"
                            class="font-semibold text-gray-800"></span></p>

                    <form id="statusForm">
                        <div class="mb-6">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status
                                Reservasi</label>
                            <select id="status" name="status"
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-400">
                                <option value="menunggu">Menunggu</option>
                                <option value="dikonfirmasi">Dikonfirmasi</option>
                                <option value="sedang_berlangsung">Aktif</option>
                                <option value="selesai">Selesai</option>
                                <option value="dibatalkan">Dibatalkan</option>
                            </select>
                        </div>

                        <div class="flex justify-center space-x-4">
                            <button type="button" onclick="closeStatusModal()"
                                class="px-6 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
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
                            <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-2">Status
                                Pembayaran</label>
                            <select id="payment_status" name="payment_status"
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-purple-400">
                                <option value="belum_bayar">Belum Bayar</option>
                                <option value="dp">DP</option>
                                <option value="lunas">Lunas</option>
                            </select>
                        </div>

                        <div class="flex justify-center space-x-4">
                            <button type="button" onclick="closePaymentModal()"
                                class="px-6 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-6 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors">
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
