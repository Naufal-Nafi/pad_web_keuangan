<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="src/Logo.png">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<!-- navbar -->
<nav class="bg-gradient-to-r from-[#161D6F] to-[#4854EB] max-w-screen flex flex-row flex-wrap items-center justify-between p-2">
    <div class="flex">
        <a href="/dashboard" class="block items-center space-x-3 rtl:space-x-reverse mr-auto">
            <img src="img/lucide--home.svg" class="h-10" alt="Flowbite Logo" />
        </a>
    </div>
    <div class="items-center justify-between hidden w-full md:flex md:w-auto" id="navbar-sticky">
        <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
            <li>
                <p class="flex flex-row py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                    @yield('title laporan')</p>
            </li>
        </ul>
    </div>
    <div>
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-gray-900 bg-white drop-shadow-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-5 py-1 text-center inline-flex items-center" type="button">@yield('dropdown') <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
            </svg>
        </button>
        <!-- Dropdown menu -->
        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 drop-shadow-lg w-48">
            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                <li>
                    <a href="/mingguan" class="block px-4 py-2 hover:bg-gray-100">Mingguan</a>
                </li>
                <li>
                    <a href="/bulanan" class="block px-4 py-2 hover:bg-gray-100">Bulanan</a>
                </li>
                <li>
                    <a href="/riwayat" class="block px-4 py-2 hover:bg-gray-100">Riwayat Penghasilan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<body class="bg-[#F4F1E6]">
    @yield('content')
</body>



</html>