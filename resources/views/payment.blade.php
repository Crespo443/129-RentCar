<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Sewa Mobil</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">
    <div class="min-h-screen py-8">
        <div class="max-w-6xl mx-auto px-4">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="/home"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-orange-500">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('my-reservations') }}"
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-orange-500 md:ml-2">Reservasi</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Pembayaran</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Pembayaran Sewa Mobil</h1>
                <p class="text-gray-600 mt-2">Selesaikan pembayaran untuk melanjutkan reservasi Anda</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column: Payment Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Warning Box -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Detail Pembayaran</h2>
                        <div class="bg-orange-50 border-l-4 border-orange-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-orange-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-orange-700">
                                        <span class="font-semibold">Pembayaran Aman</span><br>
                                        Berbagai metode pembayaran tersedia: Credit Card, Bank Transfer, E-Wallet, dll.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('payment.process', $reservation->id) }}" method="POST"
                            id="payment-form">
                            @csrf
                            <input type="hidden" name="payment_method" value="midtrans" required>

                            <!-- Payment Button -->
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white py-4 rounded-lg font-semibold transition-all shadow-md hover:shadow-lg flex items-center justify-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                    </path>
                                </svg>
                                Bayar Sekarang
                            </button>
                        </form>
                    </div>

                    <!-- Payment Methods Section -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Metode Pembayaran</h2>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <!-- Credit Card -->
                            <div
                                class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-lg hover:border-blue-500 transition-colors cursor-pointer">
                                <div class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm font-bold mb-2">VISA
                                </div>
                                <p class="text-xs text-gray-600 text-center">Credit Card</p>
                            </div>

                            <!-- GoPay -->
                            <div
                                class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-lg hover:border-green-500 transition-colors cursor-pointer">
                                <div class="bg-green-500 text-white px-4 py-2 rounded-md text-sm font-bold mb-2">GO
                                </div>
                                <p class="text-xs text-gray-600 text-center">GoPay</p>
                            </div>

                            <!-- Bank Transfer -->
                            <div
                                class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-lg hover:border-red-500 transition-colors cursor-pointer">
                                <div class="bg-red-500 text-white px-4 py-2 rounded-md text-sm font-bold mb-2">BCA</div>
                                <p class="text-xs text-gray-600 text-center">Bank Transfer</p>
                            </div>

                            <!-- ShopeePay -->
                            <div
                                class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-lg hover:border-orange-500 transition-colors cursor-pointer">
                                <div class="bg-orange-500 text-white px-4 py-2 rounded-md text-sm font-bold mb-2">SP
                                </div>
                                <p class="text-xs text-gray-600 text-center">ShopeePay</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Ringkasan Pesanan</h3>

                        <!-- Car Image & Info -->
                        <div class="mb-6">
                            @if ($reservation->car->image)
                                <img src="{{ $reservation->car->image }}"
                                    alt="{{ $reservation->car->brand }} {{ $reservation->car->model }}"
                                    class="w-full h-40 object-cover rounded-lg mb-4">
                            @endif
                            <div class="flex items-start">
                                <div>
                                    <p class="font-bold text-gray-800">{{ $reservation->car->brand }}
                                        {{ $reservation->car->model }}</p>
                                    <p class="text-sm text-gray-500">{{ $reservation->car->category }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Rental Details -->
                        <div class="space-y-3 mb-6 pb-6 border-b border-gray-200">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tanggal Mulai</span>
                                <span
                                    class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($reservation->start_date)->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tanggal Selesai</span>
                                <span
                                    class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($reservation->end_date)->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Durasi</span>
                                <span class="font-medium text-gray-800">{{ $reservation->total_days }} hari</span>
                            </div>
                        </div>

                        <!-- Price Details -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Harga per hari</span>
                                <span class="text-gray-800">Rp
                                    {{ number_format($reservation->total_price / $reservation->total_days, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Jumlah hari</span>
                                <span class="text-gray-800">{{ $reservation->total_days }} hari</span>
                            </div>
                        </div>

                        <!-- Total Payment -->
                        <div class="pt-4 border-t-2 border-gray-300">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-base font-semibold text-gray-800">Total Pembayaran</span>
                            </div>
                            <div class="text-right">
                                <span class="text-2xl font-bold text-orange-500">Rp
                                    {{ number_format($reservation->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
