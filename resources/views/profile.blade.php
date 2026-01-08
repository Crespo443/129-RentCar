<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil - FunCar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</head>

<body class="bg-gray-50">

    {{-- Navbar --}}
    <header>
        <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 shadow-md">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="/home" class="flex items-center">
                    <span class="self-center text-xl font-semibold whitespace-nowrap">FunCar</span>
                </a>

                {{-- Menu --}}
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="/home">
                                <div class="group text-center">
                                    <div class="group-hover:cursor-pointer">Beranda</div>
                                    <div
                                        class="block invisible bg-pr-400 w-12 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/cars">
                                <div class="group text-center">
                                    <div class="group-hover:cursor-pointer">Mobil</div>
                                    <div
                                        class="block invisible bg-pr-400 w-8 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Dropdown --}}
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                    class="text-black bg-pr-400 hover:bg-pr-600 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center "
                    type="button">
                    <img loading="lazy" src="/storage/images/user.png" width="24" alt="user icon" class="mr-3">
                    {{ session('user_name', 'User') }}
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>

                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="/profile" class="block px-4 py-2 hover:bg-pr-200">Profil</a>
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

    {{-- Main Content --}}
    <main class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Profil Saya</h1>
                <p class="text-gray-600">Kelola informasi profil Anda</p>
            </div>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Profile Form --}}
            <form action="/profile" method="POST" class="space-y-6">
                @csrf

                <div class="border-b border-gray-200 pb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                    <input type="text" name="name" id="name"
                        value="{{ old('name', session('user_name', '')) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pr-400 focus:border-transparent @error('name') border-red-500 @enderror"
                        required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                
                <div class="border-b border-gray-200 pb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email"
                        value="{{ old('email', session('user_email', '')) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pr-400 focus:border-transparent @error('email') border-red-500 @enderror"
                        required>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password (Disabled) --}}
                <div class="border-b border-gray-200 pb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" value="••••••••"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed"
                        disabled>
                    <p class="text-sm text-gray-500 mt-1">Password tidak dapat diubah di halaman ini</p>
                </div>

                {{-- Role (Disabled) --}}
                <div class="border-b border-gray-200 pb-6">
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <input type="text" id="role" value="{{ session('user_role', 'user') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed capitalize"
                        disabled>
                    <p class="text-sm text-gray-500 mt-1">Role tidak dapat diubah</p>
                </div>

                {{-- Action Buttons --}}
                <div class="flex space-x-4 pt-4">
                    <button type="submit"
                        class="px-6 py-3 bg-pr-400 hover:bg-pr-600 text-white font-medium rounded-lg transition-colors duration-200">
                        Simpan Perubahan
                    </button>
                    <a href="{{ session('user_role') === 'admin' ? '/admin/dashboard' : '/home' }}"
                        class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </main>

</body>

</html>
