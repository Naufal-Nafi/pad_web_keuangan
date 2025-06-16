@extends('layout.auth')

@section('content')

<head>
    <title>Reset Password</title>
</head>

<!-- form memasukkan password baru -->
<body>
    <div class="bg-[#F4F1E6] flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
            <img class="w-20 h-20 mr-2" src="{{ asset('src/Logo.png') }}"
                alt="logo">
        </a>
        <div class="bg-white w-full rounded-3xl drop-shadow-lg sm:max-w-md xl:p-0">
            <div class="p-6 rounded-2xl space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Password Baru
                </h1>
                {{-- @if ($errors->any())
                <div class="alert alert-danger p-2 mb-2 text-red-900 bg-red-300 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif --}}
                <div id="api-message"></div>
                <form id="resetPasswordForm" class="space-y-4 md:space-y-6">
                    @csrf
                    <input type="hidden" name="token" id="token" value="{{ request()->token }}">
                    <input type="hidden" name="email" id="email" value="{{ request()->email }}">
                    <div>
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Password Baru" required>
                    </div>
                    <div>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Konfirmasi Password Baru" required>
                    </div>
                    <button type="submit"
                        class="bg-gradient-to-r from-[#161D6F] to-[#4854EB] w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Ubah Password</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

<script>
    document.getElementById('resetPasswordForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const token = document.getElementById('token').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const password_confirmation = document.getElementById('password_confirmation').value;
        const messageDiv = document.getElementById('api-message');
        messageDiv.innerHTML = '';
        console.log(email, token, password, password_confirmation);

        try {
            const response = await fetch('/api/login/reset-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    token,
                    email,
                    password,
                    password_confirmation
                })
            });

            const data = await response.json();
            console.log(data);

            if (response.ok) {
                messageDiv.innerHTML = `<div class="alert alert-success p-2 mb-2 text-green-900 bg-green-300 rounded-lg">${data.message || 'Password berhasil diubah.'}</div>`;
                window.location.href = '/';
            } else {
                let errorMsg = data.errors
                    ? Object.values(data.errors).flat().join('<br>')
                    : (data.message || 'Terjadi kesalahan');
                messageDiv.innerHTML = `<div class="alert alert-danger p-2 mb-2 text-red-900 bg-red-300 rounded-lg">${errorMsg}</div>`;
            }
        } catch (err) {
            messageDiv.innerHTML = err; //`<div class="alert alert-danger p-2 mb-2 text-red-900 bg-red-300 rounded-lg">Gagal mengirim permintaan. Coba lagi.</div>`;
        }
    });
</script>

@endsection