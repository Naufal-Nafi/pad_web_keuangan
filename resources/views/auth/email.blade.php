@extends('layout.auth')

@section('content')

<head>
    <title>Reset Password</title>
</head>

<!-- form masukkan email untuk mengirimkan pesan dari gmail -->
<section>
    <div class="bg-[#F4F1E6] flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
            <img class="w-20 h-20 mr-2" src="src/Logo.png"
                alt="logo">
        </a>
        <div class="w-full rounded-3xl drop-shadow-lg sm:max-w-md xl:p-0">
            <div class="p-6 rounded-2xl space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Masukkan Email
                </h1>
                {{-- @if (session('status'))
                <div class="alert alert-success p-2 mb-2 text-green-900 bg-green-300 rounded-lg">
                    {{ session('status') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger p-2 mb-2 text-red-900 bg-red-300 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif --}}
                <div id="api-message"></div>
                <form id="forgotPasswordForm" class="space-y-4 md:space-y-6">
                    @csrf
                    <input type="hidden" name="token">
                    <div>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Email" required>
                    </div>
                    <button type="submit"
                        class="bg-gradient-to-r from-[#161D6F] to-[#4854EB] w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Kirim Link Ubah Password</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('forgotPasswordForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const email = document.getElementById('email').value;
        const messageDiv = document.getElementById('api-message');
        messageDiv.innerHTML = '';

        try {
            const response = await fetch('/api/login/forgot-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email })
            });

            const data = await response.json();

            if (response.ok) {
                messageDiv.innerHTML = `<div class="alert alert-success p-2 mb-2 text-green-900 bg-green-300 rounded-lg">${data.message}</div>`;
            } else {
                let errorMsg = data.errors && data.errors.email ? data.errors.email[0] : 'Terjadi kesalahan';
                messageDiv.innerHTML = `<div class="alert alert-danger p-2 mb-2 text-red-900 bg-red-300 rounded-lg">${errorMsg}</div>`;
            }
        } catch (err) {
            messageDiv.innerHTML = `<div class="alert alert-danger p-2 mb-2 text-red-900 bg-red-300 rounded-lg">Gagal mengirim permintaan. Coba lagi.</div>`;
        }
    });
</script>

@endsection