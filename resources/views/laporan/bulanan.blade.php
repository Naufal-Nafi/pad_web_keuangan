@extends('layout.admin')
@section('title laporan', 'LAPORAN KEUANGAN BULANAN')
@section('dropdown', 'Bulanan')

<head>
    <title>Bulanan</title>
</head>

<!-- line chart bulanan -->
@section('content')
    <section class="p-20 drop-shadow-lg">
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
            class="text-gray-900 bg-white drop-shadow-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-5 py-1 text-center inline-flex items-center"
            type="button">@yield('dropdown') <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true
             " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
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
        <div class="mx-auto"><canvas id="monthlyReportChart"></canvas></div>
    </section>

    <script>
        // logic untuk isi data pada line chart bulanan
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('monthlyReportChart').getContext('2d');
            fetch('/bulanan/monthly-report')
                .then(response => response.json())
                .then(data_bulanan => {
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data_bulanan.map(row => `${row.month}`),
                            datasets: [{
                                label: 'Masuk',
                                data: data_bulanan.map(row => row.masuk),
                                borderColor: '#20BB14',
                                fill: false
                            },
                            {
                                label: 'Keluar',
                                data: data_bulanan.map(row => row.keluar),
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
                            }
                        }
                    });
                })
                .catch(error => console.error('Error loading data:', error));
        });
    </script>

@endsection