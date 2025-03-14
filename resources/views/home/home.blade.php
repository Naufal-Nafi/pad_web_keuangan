@extends('layout.admin')

@section('content')

<head>
    <title>Home</title>
</head>

<!-- line chart harian -->
<div class="flex items-center justify-center">
    <div style="width: 60%; margin: 3em" class="bg-white m-5 rounded-5 transition-transform duration-300 ease-in-out hover:scale-105">
        <a href="/transaksi"> <canvas id="dailyReportChart"></canvas>
        </a>
    </div>
</div>

<!-- tabel barang titipan -->
<div style="width: 60%;" class="relative overflow-x-auto drop-shadow-md sm:rounded-lg mx-auto mt-4 mb-10">
    <div class="flex items-center justify-between" style="background:#EEF0F4">
        <span class="col p-6 items-center" style="color: #161D6F;font-weight:bold; font-size:16px">Monitoring Barang</span>
        <!-- fungsi searching -->
        <div class="relative mr-5">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <form action="{{ route('mainpage.search') }}" method="GET">
                <input type="text" name="search" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-56 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search">
            </form>
        </div>
    </div>
    @if (!empty($search))
    @if (count($consignments) > 0)
    <div class="alert alert-success">
        Ditemukan <strong>{{ count($consignments) }}</strong> Data:
    </div>
    @else
    <div class="alert alert-warning">
        <h4>Data {{ $search }} tidak ditemukan</h4>
    </div>
    @endif
    @endif
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-white uppercase bg-[#161D6F]">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nama Toko
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Barang
                </th>
                <th scope="col" class="px-6 py-3">
                    Jumlah
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($consignments as $consignment)
            <tr class="bg-white border-b hover:bg-gray-50">
                <td class="px-6 py-4">
                    {{ $consignment['store_name'] }}
                </td>
                <td class="px-6 py-4">
                    {{ $consignment['product_name'] }}
                </td>
                <td class="px-6 py-4">
                    {{ $consignment['quantity'] }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    // logic untuk isi data pada line chart harian
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
                                fill: false
                            },
                            {
                                label: 'Keluar',
                                data: data.map(row => row.keluar),
                                borderColor: '#E21F03',
                                fill: false
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
</script>
@endsection