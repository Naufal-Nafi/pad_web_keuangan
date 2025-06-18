<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="src/Logo.png">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/countup.js@2.6.2/dist/countUp.umd.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- navbar -->
<nav class="bg-gradient-to-r sticky top-0 z-10 from-[#161D6F] to-[#4854EB] max-w-screen flex flex-row flex-wrap items-center justify-between p-4"
    x-data="{ user: JSON.parse(sessionStorage.getItem('user') || '{}') }">
    <div class="flex">
        <a href="/dashboard" class="flex items-center space-x-3 rtl:space-x-reverse mr-auto">
            <img src="{{ asset('src/Logo.png') }}" class="h-10" />
            <span class="text-white self-center text-2xl font-semibold whitespace-nowrap">Web Pengelola Keuangan</span>
        </a>
    </div>
    <div class="flex items-center justify-between w-full md:flex md:w-auto" id="navbar-sticky">
        <ul
            class="flex flex-col p-4 md:p-0 mt-4 font-medium border md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
            @php
                $currentRoute = Request::path();
            @endphp

            <li>
                <a href="/dashboard" @class([
                    "flex flex-row items-center py-2 px-3 text-white rounded md:p-0 relative group",
                    "opacity-70 hover:opacity-100" => $currentRoute !== "dashboard",
                    "opacity-100" => $currentRoute == "dashboard"
                ])>
                    <img src="{{ asset('img/lucide--home.svg') }}" alt="Dashboard" class="w-9 h-6 mr-2">
                    Dashboard
                    <span
                        class="absolute -bottom-3 left-1 w-full h-0.5 bg-white transition-transform scale-x-0 group-hover:scale-x-100 {{ $currentRoute == 'dashboard' ? 'scale-x-100' : '' }}"></span>
                </a>
            </li>
            <li>
                <a href="/transaksi" @class([
                    "flex flex-row items-center py-2 px-3 text-white rounded md:p-0 relative group",
                    "opacity-70 hover:opacity-100" => $currentRoute !== "transaksi",
                    "opacity-100" => $currentRoute == "transaksi"
                ])>
                    <img src="{{ asset('img/transaksi.svg') }}" alt="Transaksi" class="w-9 h-6 mr-2">
                    Transaksi
                    <span
                        class="absolute -bottom-3 left-1 w-full h-0.5 bg-white transition-transform scale-x-0 group-hover:scale-x-100 {{ $currentRoute == 'transaksi' ? 'scale-x-100' : '' }}"></span>
                </a>
            </li>
            <li>
                <a href="/barang" @class([
                    "flex flex-row items-center py-2 px-3 text-white rounded md:p-0 relative group",
                    "opacity-70 hover:opacity-100" => $currentRoute !== "barang",
                    "opacity-100 disabled" => $currentRoute == "barang"
                ])>
                    <img src="{{ asset('img/search.svg') }}" alt="Daftar Barang" class="w-9 h-6 mr-2">
                    Daftar Pengeluaran
                    <span
                        class="absolute -bottom-3 left-1 w-full h-0.5 bg-white transition-transform scale-x-0 group-hover:scale-x-100 {{ $currentRoute == 'barang' ? 'scale-x-100' : '' }}"></span>
                </a>
            </li>

            <li x-show="user.role === 'owner'">
                <a href="/pegawai" @class([
                    "flex flex-row items-center py-2 px-3 text-white rounded md:p-0 relative group",
                    "opacity-70 hover:opacity-100" => $currentRoute !== "pegawai",
                    "opacity-100" => $currentRoute == "pegawai"
                ])>
                    <img src="{{ asset('img/profile.svg') }}" alt="Manajemen Pegawai" class="w-9 h-6 mr-2">
                    Manajemen Pegawai
                    <span
                        class="absolute -bottom-3 left-1 w-full h-0.5 bg-white transition-transform scale-x-0 group-hover:scale-x-100 {{ $currentRoute == 'pegawai' ? 'scale-x-100' : '' }}"></span>
                </a>
            </li>
        </ul>
    </div>

    <!-- logout -->
    <div x-data="{ showModal: false }">
        <!-- Tombol Logout -->
        <button @click="showModal = true"
            class="relative transition duration-500 rounded-md px-2 py-2 bg-white isolation-auto z-10 
            border-2 border-red-700 before:absolute before:w-full before:transition-all before:duration-700 
            before:hover:w-full hover:text-white before:-right-full before:hover:right-0 before:rounded-full
            before:bg-red-700 before:-z-10 before:aspect-square before:hover:scale-150 overflow-hidden 
            before:hover:duration-700 inline-flex items-center justify-center text-sm font-semibold text-red-700 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50">
            Logout
        </button>

        <!-- Modal Konfirmasi Logout -->
        <div x-show="showModal" x-cloak class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                <h2 class="text-lg font-semibold text-gray-800">Konfirmasi Logout</h2>
                <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin logout?</p>
                <div class="mt-4 flex justify-end space-x-2">
                    <button @click="showModal = false"
                        class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100">Batal</button>
                    <button @click="logout"
                        class="px-4 py-2 text-sm font-semibold text-white bg-red-700 rounded-lg hover:bg-red-800">Logout</button>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<body class="bg-[#F4F1E6]">
    @yield('content')

    <script>
        async function logout() {
            try {
                const token = sessionStorage.getItem('auth_token');
                if (!token) {
                    window.location.href = '/';
                    return;
                }

                const response = await fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    sessionStorage.removeItem('auth_token');
                    sessionStorage.removeItem('user');
                    window.location.href = '/';
                } else {
                    console.error('Logout failed');
                }
            } catch (error) {
                console.error('Logout error:', error);
            }
        }
    </script>
</body>

</html>