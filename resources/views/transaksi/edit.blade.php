@extends('layout.admin')
@section('title laporan', 'Edit Data')

@section('content')

    <section class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full rounded-full sm:max-w-md xl:p-0">
            <div
                class="bg-gradient-to-b drop-shadow-lg from-[#CDDAF8] to-[#E5EEFF] px-44 rounded-2xl space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-center font-bold leading-tight tracking-tight text-black md:text-2xl">
                    Edit Transaksi
                </h1>

                <form class="space-y-4 md:space-y-6 px-10" method="POST">
                    @csrf

                    <div class="relative bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute z-10 bottom-3 left-2" width="24" height="24"
                            viewBox="0 0 24 24">
                            <g fill="none" stroke="black">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.5 21v-5a1 1 0 0 0-1-1h-3a1 1 0 0 0-1 1v5" />
                                <path
                                    d="M5 11v6c0 1.886 0 2.828.586 3.414S7.114 21 9 21h6c1.886 0 2.828 0 3.414-.586S19 18.886 19 17v-6M4.621 4.515c.182-.728.273-1.091.544-1.303C5.437 3 5.812 3 6.562 3h10.876c.75 0 1.125 0 1.397.212c.27.212.362.575.544 1.303l1.203 4.814c.097.388.146.581.135.739a1 1 0 0 1-.69.883c-.15.049-.354.049-.763.049c-.533 0-.8 0-1.023-.052a2 2 0 0 1-1.393-1.18c-.089-.212-.132-.47-.217-.983c-.024-.144-.036-.216-.05-.235a.1.1 0 0 0-.162 0c-.014.019-.026.09-.05.235l-.081.489l-.018.1A2 2 0 0 1 14.352 11h-.204a2 2 0 0 1-1.936-1.726l-.081-.49c-.024-.143-.036-.215-.05-.234a.1.1 0 0 0-.162 0c-.014.019-.026.09-.05.235l-.081.489l-.018.1A2 2 0 0 1 9.852 11h-.204A2 2 0 0 1 7.73 9.374l-.018-.1l-.081-.49c-.024-.143-.036-.215-.05-.234a.1.1 0 0 0-.162 0c-.014.019-.026.09-.05.235c-.085.514-.128.77-.217.983a2 2 0 0 1-1.392 1.18C5.536 11 5.27 11 4.736 11c-.409 0-.613 0-.763-.049a1 1 0 0 1-.69-.883c-.01-.158.038-.351.135-.739z" />
                            </g>
                        </svg>
                        <input type="text" name="store_name" id="store_name"
                            class="pl-10 bg-gray-50 border border-gray-300 text-gray-900 drop-shadow-lg rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Store" required="">
                    </div>

                    <div class="relative bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute z-10 bottom-3 left-2" width="24" height="24"
                            viewBox="0 0 24 24">
                            <g fill="none">
                                <path stroke="black" stroke-linejoin="round" stroke-width="2.15"
                                    d="M12 13v7.098c0 .399 0 .598-.129.67c-.129.071-.298-.035-.636-.246L4.94 16.588c-.46-.288-.69-.431-.815-.658C4 15.705 4 15.434 4 14.893V8m8 5L4 8m8 5l5.286-3.304c1.218-.761 1.827-1.142 1.827-1.696s-.609-.935-1.827-1.696L13.06 3.663c-.516-.323-.773-.484-1.06-.484s-.544.161-1.06.484L4 8" />
                                <path fill="black"
                                    d="M19 12a1 1 0 1 0 2 0zm.875-3.93L19 8.553zM19 9.107V12h2V9.108zm.59-2.544l-3.06-1.912l-1.06 1.696l3.06 1.913zM21 9.109c0-.252.001-.51-.02-.733a2 2 0 0 0-.23-.79l-1.75.97c-.027-.05-.02-.073-.011.01c.01.106.011.254.011.543zm-2.47-.848c.246.154.37.233.454.298c.067.05.043.045.016-.004l1.75-.97a2 2 0 0 0-.549-.614c-.177-.136-.397-.272-.611-.405z" />
                                <circle cx="17.5" cy="16.5" r="2.5" stroke="black" stroke-width="2.15" />
                                <path stroke="black" stroke-linecap="round" stroke-width="2.15" d="m21 20l-1.5-1.5" />
                                <path fill="black"
                                    d="M14.53 20.598a1 1 0 0 0-1.06-1.696zM11 20.375l-.53.848zm.937.444l-.063.998zm.126 0L12 19.82zm-.533-1.292l-3-1.875l-1.06 1.696l3 1.875zm1.94-.625l-.5.313l1.06 1.695l.5-.312zm-.5.313l-.5.312l1.06 1.696l.5-.312zm-2.5 2.008c.213.133.429.27.625.368c.214.108.47.206.779.226L12 19.82c.056.003.072.022-.005-.016a7 7 0 0 1-.465-.278zm2-1.696a7 7 0 0 1-.465.278c-.077.038-.061.02-.005.016l.126 1.996c.31-.02.565-.118.779-.226c.196-.099.412-.235.625-.368zm-.596 2.29q.126.008.252 0L12 19.82z" />
                            </g>
                        </svg>
                        <input type="text" name="product_name" id="product_name"
                            class="pl-10 bg-gray-50 border border-gray-300 text-gray-900 drop-shadow-lg rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Product" required="">
                    </div>

                    <div class="relative bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute z-10 bottom-3 left-2" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path fill="green"
                                d="M8.5 14a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m0 3.5a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m4.75-4.75a1.25 1.25 0 1 1-2.5 0a1.25 1.25 0 0 1 2.5 0M12 17.5a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m4.75-4.75a1.25 1.25 0 1 1-2.5 0a1.25 1.25 0 0 1 2.5 0" />
                            <path fill="green" fill-rule="evenodd"
                                d="M8 3.25a.75.75 0 0 1 .75.75v.75h6.5V4a.75.75 0 0 1 1.5 0v.758q.228.006.425.022c.38.03.736.098 1.073.27a2.75 2.75 0 0 1 1.202 1.202c.172.337.24.693.27 1.073c.03.365.03.81.03 1.345v7.66c0 .535 0 .98-.03 1.345c-.03.38-.098.736-.27 1.073a2.75 2.75 0 0 1-1.201 1.202c-.338.172-.694.24-1.074.27c-.365.03-.81.03-1.344.03H8.17c-.535 0-.98 0-1.345-.03c-.38-.03-.736-.098-1.073-.27a2.75 2.75 0 0 1-1.202-1.2c-.172-.338-.24-.694-.27-1.074c-.03-.365-.03-.81-.03-1.344V8.67c0-.535 0-.98.03-1.345c.03-.38.098-.736.27-1.073A2.75 2.75 0 0 1 5.752 5.05c.337-.172.693-.24 1.073-.27q.197-.016.425-.022V4A.75.75 0 0 1 8 3.25M7.25 6.5v-.242a6 6 0 0 0-.303.017c-.287.023-.424.065-.514.111a1.25 1.25 0 0 0-.547.547c-.046.09-.088.227-.111.514c-.024.296-.025.68-.025 1.253v.55h12.5V8.7c0-.572 0-.957-.025-1.253c-.023-.287-.065-.424-.111-.514a1.25 1.25 0 0 0-.547-.547c-.09-.046-.227-.088-.515-.111a6 6 0 0 0-.302-.017V6.5a.75.75 0 0 1-1.5 0v-.25h-6.5v.25a.75.75 0 0 1-1.5 0m11 3.75H5.75v6.05c0 .572 0 .957.025 1.252c.023.288.065.425.111.515c.12.236.311.427.547.547c.09.046.227.088.514.111c.296.024.68.025 1.253.025h7.6c.572 0 .957 0 1.252-.025c.288-.023.425-.065.515-.111a1.25 1.25 0 0 0 .547-.547c.046-.09.088-.227.111-.515c.024-.295.025-.68.025-1.252z"
                                clip-rule="evenodd" />
                            <path fill="green" fill-rule="evenodd"
                                d="M9.75 7.75A.75.75 0 0 1 10.5 7h3a.75.75 0 0 1 0 1.5h-3a.75.75 0 0 1-.75-.75"
                                clip-rule="evenodd" />
                        </svg>
                        <input type="date" name="entry_date" id="entry_date"
                            class="pl-10 bg-gray-50 border border-gray-300 text-gray-900 drop-shadow-lg rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Entry Date" required="">
                    </div>

                    <div class="relative bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute z-10 bottom-3 left-2" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path fill="red"
                                d="M8.5 14a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m0 3.5a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m4.75-4.75a1.25 1.25 0 1 1-2.5 0a1.25 1.25 0 0 1 2.5 0M12 17.5a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m4.75-4.75a1.25 1.25 0 1 1-2.5 0a1.25 1.25 0 0 1 2.5 0" />
                            <path fill="red" fill-rule="evenodd"
                                d="M8 3.25a.75.75 0 0 1 .75.75v.75h6.5V4a.75.75 0 0 1 1.5 0v.758q.228.006.425.022c.38.03.736.098 1.073.27a2.75 2.75 0 0 1 1.202 1.202c.172.337.24.693.27 1.073c.03.365.03.81.03 1.345v7.66c0 .535 0 .98-.03 1.345c-.03.38-.098.736-.27 1.073a2.75 2.75 0 0 1-1.201 1.202c-.338.172-.694.24-1.074.27c-.365.03-.81.03-1.344.03H8.17c-.535 0-.98 0-1.345-.03c-.38-.03-.736-.098-1.073-.27a2.75 2.75 0 0 1-1.202-1.2c-.172-.338-.24-.694-.27-1.074c-.03-.365-.03-.81-.03-1.344V8.67c0-.535 0-.98.03-1.345c.03-.38.098-.736.27-1.073A2.75 2.75 0 0 1 5.752 5.05c.337-.172.693-.24 1.073-.27q.197-.016.425-.022V4A.75.75 0 0 1 8 3.25M7.25 6.5v-.242a6 6 0 0 0-.303.017c-.287.023-.424.065-.514.111a1.25 1.25 0 0 0-.547.547c-.046.09-.088.227-.111.514c-.024.296-.025.68-.025 1.253v.55h12.5V8.7c0-.572 0-.957-.025-1.253c-.023-.287-.065-.424-.111-.514a1.25 1.25 0 0 0-.547-.547c-.09-.046-.227-.088-.515-.111a6 6 0 0 0-.302-.017V6.5a.75.75 0 0 1-1.5 0v-.25h-6.5v.25a.75.75 0 0 1-1.5 0m11 3.75H5.75v6.05c0 .572 0 .957.025 1.252c.023.288.065.425.111.515c.12.236.311.427.547.547c.09.046.227.088.514.111c.296.024.68.025 1.253.025h7.6c.572 0 .957 0 1.252-.025c.288-.023.425-.065.515-.111a1.25 1.25 0 0 0 .547-.547c.046-.09.088-.227.111-.515c.024-.295.025-.68.025-1.252z"
                                clip-rule="evenodd" />
                            <path fill="red" fill-rule="evenodd"
                                d="M9.75 7.75A.75.75 0 0 1 10.5 7h3a.75.75 0 0 1 0 1.5h-3a.75.75 0 0 1-.75-.75"
                                clip-rule="evenodd" />
                        </svg>
                        <input type="date" name="exit_date" id="exit_date"
                            class="pl-10 bg-gray-50 border border-gray-300 text-gray-900 drop-shadow-lg rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Exit Date">
                    </div>

                    <div class="relative bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute z-10 bottom-3 left-3" width="20" height="20"
                            viewBox="0 0 512 512">
                            <path fill="black"
                                d="M0 64c0-17.7 14.3-32 32-32h80c79.5 0 144 64.5 144 144c0 58.8-35.2 109.3-85.7 131.7l51.4 128.4c6.6 16.4-1.4 35-17.8 41.6s-35-1.4-41.6-17.8l-56-139.9H64v128c0 17.7-14.3 32-32 32S0 465.7 0 448zm64 192h48c44.2 0 80-35.8 80-80s-35.8-80-80-80H64zm256-96h80c61.9 0 112 50.1 112 112s-50.1 112-112 112h-48v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V192c0-17.7 14.3-32 32-32m80 160c26.5 0 48-21.5 48-48s-21.5-48-48-48h-48v96z" />
                        </svg>
                        <input type="number" name="price" id="price"
                            class="pl-10 bg-gray-50 border border-gray-300 text-gray-900 drop-shadow-lg rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Price" required="">
                    </div>

                    <div class="relative bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute z-10 bottom-3 left-2" width="24" height="24"
                            viewBox="0 0 256 256">
                            <path fill="black"
                                d="m225.6 62.64l-88-48.17a19.91 19.91 0 0 0-19.2 0l-88 48.17A20 20 0 0 0 20 80.19v95.62a20 20 0 0 0 10.4 17.55l88 48.17a19.89 19.89 0 0 0 19.2 0l88-48.17a20 20 0 0 0 10.4-17.55V80.19a20 20 0 0 0-10.4-17.55M128 36.57L200 76l-21.43 11.73l-72-39.42Zm0 78.83L56 76l25.56-14l72 39.41ZM44 96.79l72 39.4v76.67l-72-39.42Zm96 116.07v-76.67l24-13.13V152a12 12 0 0 0 24 0v-42.08l24-13.13v76.65Z" />
                        </svg>
                        <input type="number" name="sold" id="sold"
                            class="pl-10 bg-gray-50 border border-gray-300 text-gray-900 drop-shadow-lg rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Sold" required="">
                    </div>

                    <div class="relative bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute z-10 bottom-3 left-2" width="24" height="24"
                            viewBox="0 0 256 256">
                            <path fill="black"
                                d="m225.6 62.64l-88-48.17a19.91 19.91 0 0 0-19.2 0l-88 48.17A20 20 0 0 0 20 80.19v95.62a20 20 0 0 0 10.4 17.55l88 48.17a19.89 19.89 0 0 0 19.2 0l88-48.17a20 20 0 0 0 10.4-17.55V80.19a20 20 0 0 0-10.4-17.55M128 36.57L200 76l-21.43 11.73l-72-39.42Zm0 78.83L56 76l25.56-14l72 39.41ZM44 96.79l72 39.4v76.67l-72-39.42Zm96 116.07v-76.67l24-13.13V152a12 12 0 0 0 24 0v-42.08l24-13.13v76.65Z" />
                        </svg>
                        <input type="number" name="stock" id="stock"
                            class="pl-10 bg-gray-50 border border-gray-300 text-gray-900 drop-shadow-lg rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Stock" required="">
                    </div>

                    <button type="submit"
                        class="bg-[#4C7DE7] hover:bg-blue-800 duration-300 ml-28 drop-shadow-lg text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Simpan
                    </button>
                </form>

            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const url = window.location.href;
            const id = url.split('/').pop(); // ambil id dari URL            
            const token = localStorage.getItem('auth_token'); // jika pakai auth token

            try {
                const response = await fetch(`/api/consignment/edit/${id}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`, // jika pakai Sanctum API token
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Gagal mengambil data');

                const data = await response.json();

                // Isi form input
                document.getElementById('store_name').value = data.store.store_name;
                document.getElementById('product_name').value = data.product.product_name;
                document.getElementById('entry_date').value = data.entry_date;
                document.getElementById('exit_date').value = data.exit_date;
                document.getElementById('price').value = data.product.price;
                document.getElementById('sold').value = data.sold;
                document.getElementById('stock').value = data.stock;

                // Set nilai min dan max
                document.getElementById('entry_date').setAttribute('min', data.exit_date);
                document.getElementById('sold').setAttribute('max', data.stock);
                document.getElementById('sold').setAttribute('min', 1);

            } catch (error) {
                console.error(error);
                alert('Terjadi kesalahan saat mengambil data transaksi.');
            }

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('form');
            const token = localStorage.getItem('auth_token');
            const url = window.location.href;
            const id = url.split('/').pop(); // ambil consignment_id dari URL

            form.addEventListener('submit', async function (e) {
                e.preventDefault(); // mencegah reload halaman

                const payload = {
                    store_name: document.getElementById('store_name').value,
                    product_name: document.getElementById('product_name').value,
                    entry_date: document.getElementById('entry_date').value,
                    exit_date: document.getElementById('exit_date').value,
                    price: document.getElementById('price').value,
                    sold: document.getElementById('sold').value,
                    stock: document.getElementById('stock').value,
                };

                try {
                    const response = await fetch(`/api/consignment/update/${id}`, {
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
                        window.location.href = '/transaksi'; // redirect setelah update
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