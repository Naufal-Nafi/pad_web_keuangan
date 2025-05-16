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
            <div class="h-1/2">
                <div class="flex gap-2 justify-between mb-4">
                    <h6 class="ms-4 font-bold">Pie chart Pendapatan kotor</h6>
                    <div>
                        <button class="time-filter px-3 py-1 bg-blue-500 text-white rounded" data-target="section7">7
                            Hari</button>
                        <button class="time-filter px-3 py-1 bg-gray-200 text-gray-800 rounded" data-target="section14">14
                            Hari</button>
                        <button class="time-filter px-3 py-1 bg-gray-200 text-gray-800 rounded" data-target="section30">30
                            Hari</button>
                        <button class="time-filter px-3 py-1 bg-gray-200 text-gray-800 rounded" data-target="section365">12
                            Bulan</button>
                    </div>
                </div>
                <!-- Chart dan Tabel untuk masing-masing waktu -->
                @foreach (['7' => 'section7', '14' => 'section14', '30' => 'section30', '365' => 'section365'] as $days => $sectionId)
                    <div id="{{ $sectionId }}"
                        class="time-section {{ $days == '7' ? '' : 'hidden' }} h-1/2 flex gap-4 flex-wrap">
                        <!-- <h2>{{ $days }}</h2> -->
                        <a href="/transaksi" class="flex-1">
                            <canvas id="chart{{ $days }}"></canvas>
                        </a>
                        <div class="flex-1 overflow-auto">
                            <table id="table{{ $days }}"
                                class="min-w-full divide-y divide-gray-200 border rounded-lg text-sm text-left">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 font-medium">Produk</th>
                                        <th class="px-4 py-2 font-medium">Income</th>
                                        <th class="px-4 py-2 font-medium">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
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
                    </div>                   
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
            const chartInstances = {}; // Menyimpan instance chart per waktu
            const chartDataStore = {}; // Menyimpan data yang sudah di-fetch
            timeFrames.forEach(frame => {

            })
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
                                easing: 'easeOutCirc'
                            },
                            hover: {
                                animationDuration: 500
                            },
                            tension: 0.5
                        },
                    });
                })
                .catch(error => console.error('Error loading data:', error));
        });
    </script>

    <script>
        const colors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40',
            '#8BC34A', '#00ACC1', '#FF7043', '#9575CD'
        ];

        const timeFrames = [
            { days: 7, chartId: 'chart7', tableId: 'table7', rendered: false },
            { days: 14, chartId: 'chart14', tableId: 'table14', rendered: false },
            { days: 30, chartId: 'chart30', tableId: 'table30', rendered: false },
            { days: 365, chartId: 'chart365', tableId: 'table365', rendered: false }
        ];



        function renderChart(frame) {
            fetch(`/dashboard/income-percentage/${frame.days}`)
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(item => item.label);
                    const percentages = data.map(item => item.percentage);
                    const incomes = data.map(item => item.income);

                    const ctx = document.getElementById(frame.chartId).getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Persentase Income',
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

                    // Table
                    const tbody = document.querySelector(`#${frame.tableId} tbody`);
                    tbody.innerHTML = ''; // Bersihkan sebelumnya
                    data.forEach((item, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                                    <td class="px-4 py-2 text-gray-800">
                                        <span style="display:inline-block;width:15px;height:15px;background:${colors[index]};border-radius:3px;"></span> 
                                        ${item.label}
                                    </td>
                                    <td class="px-4 py-2 text-gray-800">Rp ${(item.income || 0).toLocaleString()}</td>
                                    <td class="px-4 py-2 text-gray-800">${item.percentage}%</td>
                                `;
                        tbody.appendChild(row);
                    });

                    frame.rendered = true;
                });
        }

    </script>

    <script>
        // Tombol filter
        document.querySelectorAll('.time-filter').forEach(button => {
            button.addEventListener('click', () => {
                const target = button.dataset.target;

                document.querySelectorAll('.time-section').forEach(section => {
                    section.classList.add('hidden');
                });

                document.getElementById(target).classList.remove('hidden');

                document.querySelectorAll('.time-filter').forEach(btn => {
                    btn.classList.remove('bg-blue-500', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-800');
                });

                button.classList.add('bg-blue-500', 'text-white');
                button.classList.remove('bg-gray-200', 'text-gray-800');

                const frame = timeFrames.find(f => target.includes(f.days));
                if (frame && !frame.rendered) {
                    renderChart(frame);
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const defaultFrame = timeFrames.find(f => f.days === 7);
            renderChart(defaultFrame);
        });
    </script>
@endsection