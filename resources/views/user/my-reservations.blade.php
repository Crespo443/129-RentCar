<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reservasi Saya - Rental Mobil</title>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-sec-400">
    <header>
        <nav class="bg-sec-600 border-gray-200 px-4 lg:px-6 py-4 mb-8">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <!-- LOGO -->
                <a href="/home" class="flex items-center">
                    <img loading="lazy" src="/storage/images/logos/loogo2.png" class="mr-3 h-12" alt="Logo" />
                </a>

                <!-- User Menu / Auth Buttons -->
                <div class="flex items-center lg:order-2">
                    @if (!session('user_login'))
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
                    @else
                        {{-- Client Dropdown --}}
                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                            class="text-black bg-pr-400 hover:bg-pr-600 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center"
                            type="button">
                            <img loading="lazy" src="/storage/images/user.png" width="24" alt="user icon"
                                class="mr-3">
                            {{ session('user_name') ?? 'Guest' }}
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdown"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                                <li>
                                    <a href="/profile" class="block px-4 py-2 hover:bg-pr-200">Profile</a>
                                </li>
                                <li>
                                    <a href="{{ route('my-reservations') }}"
                                        class="block px-4 py-2 hover:bg-pr-200">Reservasi Saya</a>
                                </li>
                                <li>
                                    <a class="block px-4 py-2 hover:bg-pr-200" href="/logout"
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
                    @endif
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

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Reservasi Saya</h1>
            <p class="text-gray-600">Kelola dan lihat semua reservasi mobil Anda</p>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Reservations List -->
        @if ($reservations->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($reservations as $reservation)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                        <!-- Car Image -->
                        @if ($reservation->car->image)
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $reservation->car->image }}"
                                    alt="{{ $reservation->car->brand }} {{ $reservation->car->model }}"
                                    class="w-full h-full object-cover">

                                <!-- Status Badge -->
                                @php
                                    $statusConfig = [
                                        'menunggu' => ['bg' => 'bg-yellow-500', 'label' => 'Menunggu'],
                                        'dikonfirmasi' => ['bg' => 'bg-green-500', 'label' => 'Dikonfirmasi'],
                                        'sedang_berlangsung' => ['bg' => 'bg-blue-500', 'label' => 'Berlangsung'],
                                        'selesai' => ['bg' => 'bg-purple-500', 'label' => 'Selesai'],
                                        'dibatalkan' => ['bg' => 'bg-gray-500', 'label' => 'Dibatalkan'],
                                    ];
                                    $status = $statusConfig[$reservation->status] ?? [
                                        'bg' => 'bg-gray-500',
                                        'label' => $reservation->status,
                                    ];
                                @endphp
                                <span
                                    class="absolute top-3 right-3 px-3 py-1 text-sm font-semibold text-white rounded-full {{ $status['bg'] }}">
                                    {{ $status['label'] }}
                                </span>
                            </div>
                        @endif

                        <!-- Card Content -->
                        <div class="p-5">
                            <!-- Car Name -->
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $reservation->car->brand }}
                                {{ $reservation->car->model }}</h3>
                            <p class="text-sm text-gray-500 mb-4">{{ $reservation->car->police_number }}</p>

                            <!-- Reservation Info -->
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($reservation->start_date)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($reservation->end_date)->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>{{ $reservation->total_days }} Hari</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    @php
                                        $paymentConfig = [
                                            'belum_bayar' => ['text' => 'text-red-600', 'label' => 'Belum Bayar'],
                                            'dp' => ['text' => 'text-yellow-600', 'label' => 'DP'],
                                            'lunas' => ['text' => 'text-green-600', 'label' => 'Lunas'],
                                        ];
                                        $payment = $paymentConfig[$reservation->payment_status] ?? [
                                            'text' => 'text-gray-600',
                                            'label' => $reservation->payment_status,
                                        ];
                                    @endphp
                                    <span class="font-semibold {{ $payment['text'] }}">{{ $payment['label'] }}</span>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="border-t border-gray-200 pt-4 mb-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Total Harga</span>
                                    <span class="text-xl font-bold text-orange-600">Rp
                                        {{ number_format($reservation->total_price, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-2">
                                @if ($reservation->status === 'menunggu' && $reservation->payment_status === 'belum_bayar')
                                    <a href="{{ route('payments.show', $reservation->id) }}"
                                        class="w-full bg-green-500 text-white text-center py-2 rounded-lg font-semibold hover:bg-green-600 transition-colors">
                                        Bayar Sekarang
                                    </a>
                                @elseif($reservation->status === 'menunggu')
                                    <form action="{{ route('reservations.cancel', $reservation->id) }}"
                                        method="POST" class="w-full"
                                        onsubmit="return confirm('Apakah Anda yakin ingin membatalkan reservasi ini?')">
                                        @csrf
                                        <button type="submit"
                                            class="w-full bg-red-500 text-white py-2 rounded-lg font-semibold hover:bg-red-600 transition-colors">
                                            Batalkan
                                        </button>
                                    </form>
                                @else
                                    <button disabled
                                        class="w-full bg-gray-300 text-gray-600 py-2 rounded-lg font-semibold cursor-not-allowed">
                                        {{ $status['label'] }}
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $reservations->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Reservasi</h3>
                <p class="text-gray-500 mb-6">Anda belum memiliki reservasi mobil. Mulai jelajahi dan sewa mobil
                    sekarang!</p>
                <a href="/cars"
                    class="inline-block bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-600 transition-colors">
                    Lihat Mobil Tersedia
                </a>
            </div>
        @endif
    </div>
</body>

</html>
