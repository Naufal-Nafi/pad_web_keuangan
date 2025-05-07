@extends('layout.admin')

@section('content')

    <head>
        <title>Home</title>
    </head>
    


    <section class="w-full min-h-screen flex">
        <div class="w-2/5 flex flex-col">
            <div class="h-1/2">
                <a href="/transaksi"> <canvas id="dailyReportChart"></canvas>
                </a>
            </div>
            <div class="h-1/2 flex">

                <a href="/transaksi" class=""> <canvas id="reportPieChart"></canvas>
                </a>
                <div>
                    <table id="incomeTable" class="min-w-full divide-y divide-gray-200 border rounded-lg text-sm text-left">
                        <thead class="bg-gray-100">
                            <th class="px-4 py-2 font-medium">Produk</th>
                            <th class="px-4 py-2 font-medium">Income</th>
                            <th class="px-4 py-2 font-medium">Persentase</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="w-3/5 flex flex-col">
            <div class="h-1/4 flex justify-between items-center font-bold mx-8">
                <div class="px-16 py-6 rounded-xl bg-green-400 flex flex-col items-center">
                    <p>Profit</p>
                    <p id="profit" data-val="{{ $totalIncome - $totalExpense }}"></p>
                </div>
                <div class="px-16 py-6 rounded-xl bg-blue-400 flex flex-col items-center">
                    <p>Income</p>
                    <p id="income" data-val="{{ $totalIncome }}"></p>
                </div>
                <div class="px-16 py-6 rounded-xl bg-red-400 flex flex-col items-center">
                    <p>Outcome</p>
                    <p id="expense" data-val="{{ $totalExpense }}"></p>
                </div>
            </div>

            <div class="h-3/4">
                <div class="relative overflow-x-auto drop-shadow-md sm:rounded-lg mx-4">
                    <div class="flex items-center justify-between" style="background:#EEF0F4">
                        <span class="col p-6 items-center" style="color: #161D6F;font-weight:bold; font-size:16px">Tabel
                            Detail Pendapatan</span>
                        <!-- fungsi searching -->
                        <!-- <div class="relative mr-5">
                                                                    <div
                                                                        class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                                                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 20 20">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                                                        </svg>
                                                                    </div>
                                                                    <form action="{{ route('mainpage.search') }}" method="GET">
                                                                        <input type="text" name="search" id="table-search"
                                                                            class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-56 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                                                            placeholder="Search">
                                                                    </form>
                                                                </div> -->
                    </div>
                    <!-- @if (!empty($search))
                                                                @if (count($consignments) > 0)
                                                                    <div class="alert alert-success">
                                                                        Ditemukan <strong>{{ count($consignments) }}</strong> Data:
                                                                    </div>
                                                                @else
                                                                    <div class="alert alert-warning">
                                                                        <h4>Data {{ $search }} tidak ditemukan</h4>
                                                                    </div>
                                                                @endif
                                                            @endif -->
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
                                    Pendapatan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
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
                                        {{ $consignment['income'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $consignment['exit_date'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        const options = {
            decimal: ",",
            separator: ".",
            prefix: "Rp. ",
            duration: 2
        };

        const profit = new CountUp('profit', document.getElementById('profit').dataset.val, options);
        const income = new CountUp('income', document.getElementById('income').dataset.val, options);
        const expense = new CountUp('expense', document.getElementById('expense').dataset.val, options);
        const kontol = new Count

        if (!profit.error) profit.start();
        if (!income.error) income.start();
        if (!expense.error) expense.start();
    </script>


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
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            fetch('/dashboard/income-percentage') // sesuaikan dengan rute
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(item => item.label);
                    const percentages = data.map(item => item.percentage);
                    const incomes = data.map(item => item.income);

                    const colors = [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                    ];

                    const ctx = document.getElementById('reportPieChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Persentase Income per Produk',
                                data: percentages,
                                backgroundColor: colors.slice(0, data.length),
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            return `${context.label}: ${context.raw}%`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                    const tbody = document.querySelector('#incomeTable tbody');
                    data.forEach((item, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `        
                          <td class="px-4 py-2 text-gray-800"><span style="display:inline-block;width:15px;height:15px;background:${colors[index]};border-radius:3px;"></span> ${item.label}</td>
                          <td class="px-4 py-2 text-gray-800">Rp ${(item.income || 0).toLocaleString()}</td>
                          <td class="px-4 py-2 text-gray-800">${item.percentage}%</td>
                        `;
                        tbody.appendChild(row);
                    });
                });
        });
    </script>
@endsection