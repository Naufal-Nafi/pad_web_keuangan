@extends('layout.admin')
@section('title laporan', 'Edit Data Barang')

<head>
    <title>Edit Data Barang</title>
</head>

@section('content')

    <!-- form edit barang -->
    <section class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full rounded-full sm:max-w-md xl:p-0">
            <div
                class="bg-gradient-to-b from-[#CDDAF8] drop-shadow-lg to-[#E5EEFF] px-44 rounded-2xl space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-center font-bold leading-tight tracking-tight text-black md:text-2xl">
                    Edit Barang
                </h1>
                <form class="space-y-4 md:space-y-6 px-10">
                    @csrf
                    <!-- edit tanggal masuknya data barang -->
                    <div class="relative bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute z-10 bottom-3 left-2" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path fill="black"
                                d="M8.5 14a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m0 3.5a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m4.75-4.75a1.25 1.25 0 1 1-2.5 0a1.25 1.25 0 0 1 2.5 0M12 17.5a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m4.75-4.75a1.25 1.25 0 1 1-2.5 0a1.25 1.25 0 0 1 2.5 0" />
                            <path fill="black" fill-rule="evenodd"
                                d="M8 3.25a.75.75 0 0 1 .75.75v.75h6.5V4a.75.75 0 0 1 1.5 0v.758q.228.006.425.022c.38.03.736.098 1.073.27a2.75 2.75 0 0 1 1.202 1.202c.172.337.24.693.27 1.073c.03.365.03.81.03 1.345v7.66c0 .535 0 .98-.03 1.345c-.03.38-.098.736-.27 1.073a2.75 2.75 0 0 1-1.201 1.202c-.338.172-.694.24-1.074.27c-.365.03-.81.03-1.344.03H8.17c-.535 0-.98 0-1.345-.03c-.38-.03-.736-.098-1.073-.27a2.75 2.75 0 0 1-1.202-1.2c-.172-.338-.24-.694-.27-1.074c-.03-.365-.03-.81-.03-1.344V8.67c0-.535 0-.98.03-1.345c.03-.38.098-.736.27-1.073A2.75 2.75 0 0 1 5.752 5.05c.337-.172.693-.24 1.073-.27q.197-.016.425-.022V4A.75.75 0 0 1 8 3.25M7.25 6.5v-.242a6 6 0 0 0-.303.017c-.287.023-.424.065-.514.111a1.25 1.25 0 0 0-.547.547c-.046.09-.088.227-.111.514c-.024.296-.025.68-.025 1.253v.55h12.5V8.7c0-.572 0-.957-.025-1.253c-.023-.287-.065-.424-.111-.514a1.25 1.25 0 0 0-.547-.547c-.09-.046-.227-.088-.515-.111a6 6 0 0 0-.302-.017V6.5a.75.75 0 0 1-1.5 0v-.25h-6.5v.25a.75.75 0 0 1-1.5 0m11 3.75H5.75v6.05c0 .572 0 .957.025 1.252c.023.288.065.425.111.515c.12.236.311.427.547.547c.09.046.227.088.514.111c.296.024.68.025 1.253.025h7.6c.572 0 .957 0 1.252-.025c.288-.023.425-.065.515-.111a1.25 1.25 0 0 0 .547-.547c.046-.09.088-.227.111-.515c.024-.295.025-.68.025-1.252z"
                                clip-rule="evenodd" />
                            <path fill="black" fill-rule="evenodd"
                                d="M9.75 7.75A.75.75 0 0 1 10.5 7h3a.75.75 0 0 1 0 1.5h-3a.75.75 0 0 1-.75-.75"
                                clip-rule="evenodd" />
                        </svg>
                        <input type="date" id="date" name="date"
                            class="bg-gray-50 border pl-10 border-gray-300 text-gray-900 drop-shadow-lg rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required="">
                    </div>
                    <!-- edit data total harga -->
                    <div class="relative bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute z-10 bottom-3 left-2" width="24" height="24"
                            viewBox="0 0 56 56">
                            <path fill="black"
                                d="M28 4c13.255 0 24 10.745 24 24S41.255 52 28 52S4 41.255 4 28S14.745 4 28 4m0 4C16.954 8 8 16.954 8 28s8.954 20 20 20s20-8.954 20-20S39.046 8 28 8m.573 6.286v2.687c3.976.319 6.855 2.704 6.982 6.314h-3.308c-.207-2.004-1.638-3.165-3.674-3.419V26.5l.764.19c4.183.971 6.473 2.689 6.473 6.076c0 3.897-3.181 6.107-7.237 6.394v2.671h-1.797V39.16c-4.04-.303-7.236-2.577-7.347-6.394h3.292c.286 1.861 1.495 3.229 4.055 3.5V29.33l-.652-.16c-4.04-.937-6.218-2.75-6.218-5.979c0-3.563 2.862-5.916 6.87-6.219v-2.687zm0 15.458v6.537c2.72-.207 3.865-1.495 3.865-3.197c0-1.638-.89-2.608-3.865-3.34m-1.797-9.876c-2.29.286-3.499 1.606-3.499 3.054s.955 2.512 3.5 3.149z" />
                        </svg>
                        <input type="number" id="amount" name="amount" step="0.01" min="0"
                            class="bg-gray-50 pl-10 border border-gray-300 text-gray-900 drop-shadow-lg rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Total Harga" required="">
                    </div>
                    <!-- edit description -->
                    <textarea type="text" rows="6" id="description" name="description"
                        class="bg-gray-50 border border-gray-300 text-gray-900 drop-shadow-lg rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Keterangan" required=""></textarea>
                    <!-- button simpan -->
                    <button type="submit"
                        class="bg-[#4C7DE7] hover:bg-blue-800 duration-300 ml-28 shadow-lg text-white bg-primary-600 drop-shadow-lg hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Simpan</button>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const url = window.location.href;
            const id = url.split('/').pop();
            const token = sessionStorage.getItem('auth_token');

            try {
                const response = await fetch(`/api/expense/edit/${id}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Gagal mengambil data');

                const data = await response.json();

                document.getElementById('date').value = data.date;
                document.getElementById('amount').value = data.amount;
                document.getElementById('description').value = data.description;

            } catch (error) {
                console.error(error);
                alert('Terjadi kesalahan saat mengambil data transaksi.');
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('form');
            const token = sessionStorage.getItem('auth_token');
            const url = window.location.href;
            const id = url.split('/').pop(); // ambil consignment_id dari URL

            form.addEventListener('submit', async function (e) {
                e.preventDefault(); // mencegah reload halaman

                const payload = {
                    date: document.getElementById('date').value,
                    amount: document.getElementById('amount').value,
                    description: document.getElementById('description').value
                };

                try {
                    const response = await fetch(`/api/expense/update/${id}`, {
                        method: 'PUT', // atau 'POST' sesuai API kamu
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify(payload)
                    });

                    const result = await response.json();

                    if (response.ok) {
                        alert('Data berhasil diupdate!');
                        window.location.href = '/barang'; // redirect setelah update
                    } else {
                        console.error(result);
                        alert('Gagal mengupdate data: ' + (result.message || 'Unknown error'));
                    }

                } catch (error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat mengirim data.');
                }
            });
        });
    </script>
@endsection