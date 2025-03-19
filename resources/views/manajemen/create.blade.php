@extends('layout.admin')
@section('title laporan', 'Input Data Pegawai')

@section('content')

<section class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <div class="w-full rounded-full sm:max-w-md xl:p-0">
        <!-- form input pegawai -->
        <div class="bg-gradient-to-b from-[#CDDAF8] drop-shadow-lg to-[#E5EEFF] px-44 rounded-2xl space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-center font-bold leading-tight tracking-tight text-black md:text-2xl">
                Input Pegawai
            </h1>
            @if ($errors->any())
                <div class="alert alert-danger p-2 mb-2 text-red-900 bg-red-300 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-4 md:space-y-6 px-10" method="post" action="{{ route('pegawai.store') }}">
                @csrf
                <!-- input nama pegawai -->
                <div class="relative bg-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute z-10 bottom-3 left-2" width="24" height="24" viewBox="0 0 48 48">
                        <g fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="4">
                            <circle cx="24" cy="11" r="7" />
                            <path d="M4 41c0-8.837 8.059-16 18-16m9 17l10-10l-4-4l-10 10v4z" />
                        </g>
                    </svg>
                    <input type="text" id="name" name="name"
                        class="bg-gray-50 pl-10 border border-gray-300 text-gray-900 drop-shadow-lg rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Nama Pegawai" required="">
                </div>
                <!-- input email pegawai -->
                <div class="relative bg-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute z-10 bottom-3 left-2" width="24" height="24" viewBox="0 0 24 24">
                        <g fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.15">
                            <path stroke-dasharray="64" stroke-dashoffset="64" d="M4 5h16c0.55 0 1 0.45 1 1v12c0 0.55 -0.45 1 -1 1h-16c-0.55 0 -1 -0.45 -1 -1v-12c0 -0.55 0.45 -1 1 -1Z">
                                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s" values="64;0" />
                            </path>
                            <path stroke-dasharray="24" stroke-dashoffset="24" d="M3 6.5l9 5.5l9 -5.5">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.6s" dur="0.2s" values="24;0" />
                            </path>
                        </g>
                    </svg>
                    <input type="email" id="email" name="email"
                        class="bg-gray-50 pl-10 border border-gray-300 text-gray-900 drop-shadow-lg rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Email" required="">
                </div>
                <!-- input password -->
                <div class="relative bg-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute z-10 bottom-3 left-2" width="24" height="24" viewBox="0 0 32 32">
                        <path fill="black" d="M21 2a8.998 8.998 0 0 0-8.612 11.612L2 24v6h6l10.388-10.388A9 9 0 1 0 21 2m0 16a7 7 0 0 1-2.032-.302l-1.147-.348l-.847.847l-3.181 3.181L12.414 20L11 21.414l1.379 1.379l-1.586 1.586L9.414 23L8 24.414l1.379 1.379L7.172 28H4v-3.172l9.802-9.802l.848-.847l-.348-1.147A7 7 0 1 1 21 18" />
                        <circle cx="22" cy="10" r="2" fill="black" />
                    </svg>
                    <input type="password" id="password" name="password"
                        class="bg-gray-50 pl-10 border border-gray-300 text-gray-900 drop-shadow-lg rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Password" required="">
                </div>
                <!-- konfirmasi password -->
                <div class="relative bg-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute z-10 bottom-3 left-2" width="24" height="24" viewBox="0 0 32 32">
                        <path fill="black" d="M21 2a8.998 8.998 0 0 0-8.612 11.612L2 24v6h6l10.388-10.388A9 9 0 1 0 21 2m0 16a7 7 0 0 1-2.032-.302l-1.147-.348l-.847.847l-3.181 3.181L12.414 20L11 21.414l1.379 1.379l-1.586 1.586L9.414 23L8 24.414l1.379 1.379L7.172 28H4v-3.172l9.802-9.802l.848-.847l-.348-1.147A7 7 0 1 1 21 18" />
                        <circle cx="22" cy="10" r="2" fill="black" />
                    </svg>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="bg-gray-50 pl-10 border border-gray-300 text-gray-900 drop-shadow-lg rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Confirm Password" required="">
                </div>

                <button type="submit"
                    class="bg-[#4C7DE7] hover:bg-blue-800 duration-300 ml-28 shadow-lg text-white bg-primary-600 drop-shadow-lg hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Simpan</button>
            </form>
        </div>
    </div>
</section>
@endsection