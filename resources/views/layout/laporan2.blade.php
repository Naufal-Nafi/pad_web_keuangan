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
            <img src="{{ asset('img/lucide--home.svg') }}" class="h-10" alt="Flowbite Logo" />
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
    </div>
</nav>

<body class="bg-[#F4F1E6]">
    @yield('content')
</body>



</html>