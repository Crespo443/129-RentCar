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

    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
        <div class="flex flex-col flex-1 w-full">
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid mb-32">
                    <div class="flex justify-between items-center my-6">
                        <h2 class="text-3xl font-bold text-gray-800">Manajemen Ulasan</h2>
                        <div class="text-sm text-gray-600">
                            Total: <span class="font-semibold">{{ $reviews->total() }}</span> ulasan
                        </div>
                    </div>

                    <!-- Success/Error Messages -->
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <!-- Filter Tabs -->
                    <div class="mb-6">
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex space-x-8">
                                <a href="/admin/reviews"
                                    class="{{ request()->is('admin/reviews') && !request()->has('status') ? 'border-pr-400 text-pr-600' : 'text-gray-500 hover:text-gray-700' }} whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                                    Semua ({{ \App\Models\Review::count() }})
                                </a>
                                <a href="/admin/reviews?status=menunggu"
                                    class="{{ request()->get('status') == 'menunggu' ? 'border-orange-400 text-orange-600' : 'text-gray-500 hover:text-gray-700' }} whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                                    Menunggu Persetujuan ({{ \App\Models\Review::pending()->count() }})
                                </a>
                                <a href="/admin/reviews?status=disetujui"
                                    class="{{ request()->get('status') == 'disetujui' ? 'border-green-400 text-green-600' : 'text-gray-500 hover:text-gray-700' }} whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                                    Disetujui ({{ \App\Models\Review::approved()->count() }})
                                </a>
                            </nav>
                        </div>
                    </div>

                    <!-- Reviews List -->
                    @if ($reviews->count() > 0)
                        <div class="bg-white shadow overflow-hidden sm:rounded-md">
                            <ul class="divide-y divide-gray-200">
                                @foreach ($reviews as $review)
                                    <li class="px-4 py-4 sm:px-6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between mb-2">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                                                            {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
                                                        </div>
                                                        <div class="ml-3">
                                                            <p class="text-sm font-medium text-gray-900">
                                                                {{ $review->user->name ?? 'Unknown User' }}</p>
                                                            <p class="text-sm text-gray-500">
                                                                {{ $review->user->email ?? '-' }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="flex items-center">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <svg class="h-4 w-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }} fill-current"
                                                                viewBox="0 0 20 20">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        @endfor
                                                        <span
                                                            class="ml-1 text-sm text-gray-600">({{ $review->rating }}/5)</span>
                                                    </div>
                                                </div>

                                                <div class="mb-2">
                                                    <span class="text-sm text-gray-500">Untuk mobil:</span>
                                                    <a href="/cars/{{ $review->car->id }}"
                                                        class="text-sm font-medium text-blue-600 hover:text-blue-500">
                                                        {{ $review->car->brand }} {{ $review->car->model }}
                                                        ({{ $review->car->year }})
                                                    </a>
                                                </div>

                                                <div class="mb-3">
                                                    <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded">
                                                        {{ $review->comment }}
                                                    </p>
                                                </div>

                                                <div class="flex items-center justify-between text-xs text-gray-500">
                                                    <div class="flex items-center space-x-4">
                                                        <span>Dikirim:
                                                            {{ $review->created_at->diffForHumans() }}</span>
                                                        @if ($review->status == 'menunggu')
                                                            <span
                                                                class="px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-800">Menunggu</span>
                                                        @elseif($review->status == 'disetujui')
                                                            <span
                                                                class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-800">Disetujui</span>
                                                        @else
                                                            <span
                                                                class="px-2 py-1 rounded-full text-xs bg-red-100 text-red-800">Ditolak</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="ml-4 flex-shrink-0 flex space-x-2">
                                                @if ($review->status == 'menunggu')
                                                    <button onclick="approveReview({{ $review->id }})"
                                                        class="bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-1 rounded transition-colors">
                                                        Setujui
                                                    </button>
                                                @endif

                                                <button onclick="deleteReview({{ $review->id }})"
                                                    class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1 rounded transition-colors">
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Pagination -->
                        @if ($reviews->hasPages())
                            <div class="mt-6">
                                {{ $reviews->links() }}
                            </div>
                        @endif
                    @else
                        <div class="bg-white shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                    </path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada ulasan</h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    @if (request()->get('status'))
                                        Belum ada ulasan dengan status "{{ request()->get('status') }}".
                                    @else
                                        Belum ada ulasan yang masuk.
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function approveReview(reviewId) {
            Swal.fire({
                title: 'Setujui Ulasan?',
                text: 'Ulasan ini akan disetujui dan ditampilkan ke publik.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Setujui',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/reviews/${reviewId}/approve`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Ulasan berhasil disetujui.',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error', data.message || 'Terjadi kesalahan', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'Terjadi kesalahan saat memproses permintaan', 'error');
                        });
                }
            });
        }

        function deleteReview(reviewId) {
            Swal.fire({
                title: 'Hapus Ulasan?',
                text: 'Tindakan ini tidak dapat dibatalkan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/reviews/${reviewId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: 'Ulasan berhasil dihapus.',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error', data.message || 'Terjadi kesalahan', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'Terjadi kesalahan saat memproses permintaan', 'error');
                        });
                }
            });
        }
    </script>

</body>

</html>
