@extends('layout.admin')
@section('title laporan', 'Transaksi')

@section('content')
    <section class="p-10">
        <!-- line chart -->
        <!-- <div class="mx-auto drop-shadow-lg"><canvas id="dailyReportChart"></canvas></div> -->

        <!-- tabel barang -->
        <div class="relative overflow-x-auto drop-shadow-lg sm:rounded-lg mx-auto mt-4">
            <div style="background:#EEF0F4">
                <a href="{{ route('laporan.create') }}" class="flex items-center group w-1/12">
                    <button title="Add New" class="cursor-pointer outline-none group-hover:rotate-90 duration-300 ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24"
                            class="stroke-blue-600 fill-none group-active:stroke-blue-600 group-active:duration-0 duration-300">
                            <path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z"
                                stroke-width="1.5"></path>
                            <path d="M8 12H16" stroke-width="1.5"></path>
                            <path d="M12 16V8" stroke-width="1.5"></path>
                        </svg>
                    </button>
                    <p class="col px-2 py-4 items-center text-blue-600 group-hover:underline"
                        style="font-weight:bold; font-size:13px">
                        Tambah</p>
                </a>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-white uppercase bg-[#324150]">
                    <tr>
                        <th scope="col" class="px-3 py-3">
                            Store
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Product
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Sell Time
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Entry Date
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Exit Date
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Stock
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Sold
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Total Price
                        </th>
                        <th scope="col" class="px-3 py-3">
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($consignments as $consignment)
                        <tr class="bg-[#E3ECFF] border-b">
                            <td class="px-3 py-1">
                                {{ $consignment['store_name'] }}
                            </td>
                            <td class="px-3 py-1">
                                {{ $consignment['product_name'] }}
                            </td>
                            <td
                                class="px-3 py-1 {{ $consignment['status'] == 'Open' ? 'text-green-500' : ($consignment['status'] == 'Close' ? 'text-red-500' : '') }}">
                                {{ $consignment['status'] }}
                            </td>

                            <td class="px-3 py-1">
                                {{ $consignment['circulation_duration'] }}
                            </td>
                            <td class="px-3 py-1">
                                {{ $consignment['entry_date'] }}
                            </td>
                            <td class="px-3 py-1">
                                {{ $consignment['exit_date'] }}
                            </td>
                            <td class="px-3 py-1">
                                {{ 'Rp ' . number_format($consignment['price'], 2, ',', '.') }}
                            </td>
                            <td class="px-3 py-1">
                                {{ $consignment['stock'] }}
                            </td>
                            <td class="px-3 py-1">
                                {{ $consignment['sold'] }}
                            </td>
                            <td class="px-3 py-1">
                                {{ 'Rp ' . number_format($consignment['total_price'], 2, ',', '.') }}
                            </td>
                            <td class="flex items-center px-3 py-1 justify-end relative">
                                <!-- Tombol Edit -->
                                <a href="{{ route('laporan.edit', $consignment['consignment_id']) }}"
                                    class="bg-white border-2 border-[#A3A3A3] rounded p-1 hover:bg-green-100 my-3 relative group">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="#B6BE1A" fill-rule="evenodd"
                                            d="M17.204 10.796L19 9c.545-.545.818-.818.964-1.112a2 2 0 0 0 0-1.776C19.818 5.818 19.545 5.545 19 5s-.818-.818-1.112-.964a2 2 0 0 0-1.776 0c-.294.146-.567.419-1.112.964l-1.819 1.819a10.9 10.9 0 0 0 4.023 3.977m-5.477-2.523l-6.87 6.87c-.426.426-.638.638-.778.9c-.14.26-.199.555-.316 1.145l-.616 3.077c-.066.332-.1.498-.005.593s.26.061.593-.005l3.077-.616c.59-.117.885-.176 1.146-.316s.473-.352.898-.777l6.89-6.89a12.9 12.9 0 0 1-4.02-3.98"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 hidden group-hover:block bg-[#B6BE1A] text-white text-xs rounded py-1 px-2 shadow-md">
                                        Edit
                                    </span>
                                </a>

                                <!-- Tombol Delete -->
                                <form action="{{ route('laporan.destroy', $consignment['consignment_id']) }}" method="POST"
                                    onsubmit="return confirmDelete();" class="relative group">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-white border-2 border-[#A3A3A3] rounded p-1 hover:bg-red-100 mx-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <g fill="none">
                                                <path fill="#C50505" fill-rule="evenodd"
                                                    d="M21 6H3v3a2 2 0 0 1 2 2v4c0 2.828 0 4.243.879 5.121C6.757 21 8.172 21 11 21h2c2.829 0 4.243 0 5.121-.879c.88-.878.88-2.293.88-5.121v-4a2 2 0 0 1 2-2zm-10.5 5a1 1 0 0 0-2 0v5a1 1 0 1 0 2 0zm5 0a1 1 0 0 0-2 0v5a1 1 0 1 0 2 0z"
                                                    clip-rule="evenodd" />
                                                <path stroke="#C50505" stroke-linecap="round" stroke-width="2"
                                                    d="M10.068 3.37c.114-.106.365-.2.715-.267A6.7 6.7 0 0 1 12 3c.44 0 .868.036 1.217.103s.6.161.715.268" />
                                            </g>
                                        </svg>
                                    </button>
                                    <span
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 hidden group-hover:block bg-red-800 text-white text-xs rounded py-1 px-2 shadow-md">
                                        Hapus
                                    </span>
                                </form>

                                <!-- Tombol Print -->
                                <a href="{{ route('laporan.print', $consignment['consignment_id']) }}"
                                    class="bg-white border-2 border-[#A3A3A3] rounded p-1 hover:bg-green-100 my-3 relative group">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                        <path d="M6 18H4a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-2">
                                        </path>
                                        <rect x="6" y="14" width="12" height="8"></rect>
                                    </svg>

                                    <span
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 hidden group-hover:block bg-gray-700 text-white text-xs rounded py-1 px-2 shadow-md">
                                        Print
                                    </span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- pagination -->
            <div class="flex justify-between">
                <form method="GET" action="{{ route('laporan.index') }}" class="flex items-center my-2 ml-2">
                    <label for="per_page" class="block text-sm font-medium text-gray-700 pr-2">Items per page:</label>
                    <select name="per_page" id="per_page"
                        class="mt-1 block cursor-pointer text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                        onchange="this.form.submit()">
                        <option value="1" {{ request('per_page') == 1 ? 'selected' : '' }}>1</option>
                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                        <option value="35" {{ request('per_page') == 35 ? 'selected' : '' }}>35</option>
                        <option value="40" {{ request('per_page') == 40 ? 'selected' : '' }}>40</option>
                        <option value="45" {{ request('per_page') == 45 ? 'selected' : '' }}>45</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </form>

                <div class="mt-2 mr-2">
                    {{ $consignments->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </section>

    <!-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('dailyReportChart').getContext('2d');
            fetch('/dashboard/daily-report')
                .then(response => response.json())
                .then(data => {
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.map(row => ` ${row.day}`),
                            datasets: [{
                                label: 'Masuk',
                                data: data.map(row => row.masuk),
                                borderColor: '#20BB14',
                                fill: false,
                            },
                            {
                                label: 'Keluar',
                                data: data.map(row => row.keluar),
                                borderColor: '#E21F03',
                                fill: false,
                            },
                            ],
                        },
                        options: {
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            animation: {
                                duration: 1000,
                                easing: 'easeOutBounce'
                            },
                            hover: {
                                animationDuration: 500
                            }
                        },
                    });
                })
                .catch(error => console.error('Error loading data:', error));
        });
    </script> -->

    <script>
        function confirmDelete() {
            const confirmed = confirm('Delete this data?');
            if (!confirmed) return false;

            console.log('Delete confirmed. Submitting form.');
            return true;
        }
    </script>
@endsection