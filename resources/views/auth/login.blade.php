@extends('layout.auth')

@section('content')

    <head>
        <title>Login</title>
    </head>

    <section>
        <div class="bg-[#F4F1E6] flex flex-row items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a class="flex flex-col items-center mr-60 text-2xl font-semibold text-gray-900">
                <img class="w-40 h-40 mr-2 mb-6" src="src/Logo.png" alt="logo">
                <span class="font-bold">Web Pengelola Keuangan</span>
            </a>

            <!-- form login -->
            <div class="bg-[#B0C4DE] drop-shadow-lg w-full rounded-full shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 rounded-3xl space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Login
                    </h1>
                    <div id="errorContainer" class="hidden alert alert-danger p-2 mb-2 text-red-900 bg-red-300 rounded-lg">
                        <ul id="errorList" class="list-disc list-inside"></ul>
                    </div>
                    <form id="loginForm" class="space-y-4 md:space-y-6">
                        @csrf
                        <div>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Email" required="">
                        </div>
                        <div>
                            <input type="password" name="password" id="password" placeholder="Password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start"></div>
                            <a href="{{ route('password.request') }}"
                                class="text-sm font-medium text-primary-600 hover:underline">Lupa
                                password?</a>
                        </div>

                        <button type="submit"
                            class="relative w-full group border-none bg-transparent p-0 outline-none cursor-pointer text-base">
                            <span
                                class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-25 rounded-lg transform translate-y-0.5 transition duration-[600ms] ease-[cubic-bezier(0.3,0.7,0.4,1)] group-hover:translate-y-1 group-hover:duration-[250ms] group-active:translate-y-px"></span>

                            <span
                                class="absolute top-0 left-0 w-full h-full rounded-lg bg-gradient-to-l from-[hsl(217,33%,16%)] via-[hsl(217,33%,32%)] to-[hsl(217,33%,16%)]"></span>

                            <div
                                class="relative flex items-center justify-center py-2 text-lg text-white rounded-lg transform -translate-y-1 bg-gradient-to-r from-[#161D6F] to-[#4854EB] gap-3 transition duration-[600ms] ease-[cubic-bezier(0.3,0.7,0.4,1)] group-hover:-translate-y-1.5 group-hover:duration-[250ms] group-active:-translate-y-0.5 brightness-100 group-hover:brightness-110">
                                <span class="select-none">Login</span>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const errorContainer = document.getElementById('errorContainer');
            const errorList = document.getElementById('errorList');

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();

                if (!response.ok) {
                    errorContainer.classList.remove('hidden');
                    errorList.innerHTML = `<li>${data.error || 'Login failed'}</li>`;
                    return;
                }

                // Simpan token dan user di sessionStorage
                sessionStorage.setItem('auth_token', data.token);
                sessionStorage.setItem('user', JSON.stringify(data.user));
                window.location.href = '/dashboard';
            } catch (error) {
                console.error('Login error:', error);
                errorContainer.classList.remove('hidden');
                errorList.innerHTML = '<li>Failed to connect to server</li>';
            }
        });
    </script>

@endsection