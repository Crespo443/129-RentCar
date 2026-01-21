<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil - Rental Mobil</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="max-w-2xl w-full">
            <!-- Success Card -->
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <!-- Success Icon -->
                <div class="mb-6">
                    <div class="mx-auto w-20 h-20 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                </div>

                <!-- Success Message -->
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Pembayaran Berhasil!</h1>
                <p class="text-gray-600 mb-8">Terima kasih telah melakukan pembayaran. Reservasi Anda sedang diproses.
                </p>

                <!-- Reservation Details -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Detail Reservasi</h2>

                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">ID Reservasi</span>
                            <span class="font-semibold text-gray-800">#{{ $reservation->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Mobil</span>
                            <span class="font-semibold text-gray-800">{{ $reservation->car->brand }}
                                {{ $reservation->car->model }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Mulai</span>
                            <span
                                class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($reservation->start_date)->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Selesai</span>
                            <span
                                class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($reservation->end_date)->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Durasi</span>
                            <span class="font-semibold text-gray-800">{{ $reservation->total_days }} hari</span>
                        </div>
                        <div class="flex justify-between pt-3 border-t border-gray-300">
                            <span class="text-gray-800 font-semibold">Total Pembayaran</span>
                            <span class="text-xl font-bold text-green-600">Rp
                                {{ number_format($reservation->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Status Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6 text-left">
                    <div class="flex">
                        <svg class="w-5 h-5 text-blue-600 mr-3 flex-shrink-0 mt-0.5" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="text-sm text-blue-800">
                            <p class="font-semibold mb-1">Langkah Selanjutnya:</p>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Admin akan mengkonfirmasi reservasi Anda dalam waktu 1x24 jam</li>
                                <li>Anda akan dihubungi melalui email atau telepon</li>
                                <li>Siapkan dokumen yang diperlukan (KTP, SIM, dll)</li>
                                <li>Datang ke lokasi sesuai jadwal untuk pengambilan mobil</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/home"
                        class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                        Kembali ke Beranda
                    </a>
                    <a href="{{ route('my-reservations') }}"
                        class="inline-block bg-orange-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-orange-600 transition-colors">
                        Lihat Semua Reservasi
                    </a>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-6 text-center text-sm text-gray-600">
                <p>Butuh bantuan? Hubungi kami di <a href="mailto:support@rental.com"
                        class="text-blue-600 hover:underline">support@rental.com</a></p>
            </div>
        </div>
    </div>
</body>

</html>
