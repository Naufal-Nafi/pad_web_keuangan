@extends('layout.admin')

@section('content')

    <head>
        <title>Home</title>
    </head>

    <section class="w-full min-h-screen flex">
        <div class="w-2/5 flex flex-col">
            <div class="my-12">
                <div class="flex gap-2 justify-between mb-4">
                    <h6 class="ms-4 font-bold">Line Chart Laporan Transaksi</h6>
                    <div>
                        <button class="report-filter px-3 py-1 bg-blue-500 text-white rounded"
                            data-target="dailySection">7-Hari</button>
                        <button class="report-filter px-3 py-1 bg-gray-200 text-gray-800 rounded"
                            data-target="fortnightlySection">14-Hari</button>
                        <button class="report-filter px-3 py-1 bg-gray-200 text-gray-800 rounded"
                            data-target="weeklySection">30-Hari</button>
                        <button class="report-filter px-3 py-1 bg-gray-200 text-gray-800 rounded"
                            data-target="monthlySection">12-Bulan</button>
                    </div>
                </div>

                <!-- Section per chart -->
                <div id="dailySection" class="report-section">
                    <a href="/transaksi"><canvas id="dailyReportChart"></canvas></a>
                </div>
                <div id="fortnightlySection" class="report-section hidden">
                    <a href="/transaksi"><canvas class="min-h-[350px]" id="fortnightlyReportChart"></canvas></a>
                </div>
                <div id="weeklySection" class="report-section hidden">
                    <a href="/transaksi"><canvas class="min-h-[350px]" id="weeklyReportChart"></canvas></a>
                </div>
                <div id="monthlySection" class="report-section hidden">
                    <a href="/transaksi"><canvas class="min-h-[350px]" id="monthlyReportChart"></canvas></a>
                </div>
            </div>

            <div class="flex gap-2">
                <button id="toggleGross" class="toggle-chart px-4 py-2 bg-blue-600 text-white rounded">Tampilkan Pendapatan
                    Kotor</button>
                <button id="toggleStore" class="toggle-chart px-4 py-2 bg-gray-200 text-gray-800 rounded">Tampilkan Per
                    Toko</button>
            </div>

            <div id="grossIncomeSection" class="my-12 min-h-[400px]">
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
                        <a href="/transaksi">
                            <canvas id="chart{{ $days }}" class="size-[250px]"></canvas>
                        </a>
                        <div class="flex-1 overflow-x-auto">
                            <div id="tableContainer{{ $days }}" class="flex gap-4"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="storeIncomeSection" class="block gap-2 my-12 min-h-[350px]">
                <h6 class="ms-4 mb-4 font-bold">Pie chart Per Toko</h6>
                <div class="flex gap-4 flex-wrap">
                    <div>
                        <canvas id="storeIncomesChart" class="size-[250px]"></canvas>
                    </div>
                    <div class="flex-1 overflow-x-auto">
                        <div id="storeTableContainer" class="flex gap-4">
                            <!-- Tabel-tabel akan di-generate di sini -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-3/5 flex flex-col min-h-screen">
            <div class="flex-none flex justify-between items-center font-bold mx-8 py-12">
                <div class="px-16 py-6 rounded-xl bg-green-400 flex flex-col items-center">
                    <p>Profit</p>
                    <p id="profit" >Loading...</p>
                </div>
                <div class="px-16 py-6 rounded-xl bg-blue-400 flex flex-col items-center">
                    <p>Income</p>
                    <p id="income" >Loading...</p>
                </div>
                <div class="px-16 py-6 rounded-xl bg-red-400 flex flex-col items-center">
                    <p>Outcome</p>
                    <p id="expense" >Loading...</p>
                </div>
            </div>

            <div class="flex-grow overflow-auto">
                <div class="relative overflow-x-auto drop-shadow-md sm:rounded-lg mx-4">
                    <div class="flex items-center justify-between" style="background:#EEF0F4">
                        <span class="col p-6 items-center" style="color: #161D6F;font-weight:bold; font-size:16px">Tabel
                            Detail Pendapatan</span>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-white uppercase bg-[#161D6F]">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama Toko</th>
                                <th scope="col" class="px-6 py-3">Nama Barang</th>
                                <th scope="col" class="px-6 py-3">Pendapatan</th>
                                <th scope="col" class="px-6 py-3">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody id="consignmentsTable">
                            <tr>
                                <td colspan="4">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
                    <div id="pagination" class="p-4">
                        <!-- Paginasi akan diisi oleh JavaScript -->
                    </div>
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

        async function fetchDashboardData(page = 1) {
            try {
                const token = localStorage.getItem('auth_token');

                if (!token) {
                    window.location.href = '/';
                    return;
                }

                const response = await fetch(`/api/dashboard?page=${page}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    if (response.status === 401) {
                        localStorage.removeItem('auth_token');
                        window.location.href = '/';
                    }
                    throw new Error('Failed to fetch data');
                }

                const data = await response.json();                

                const totalIncome = Number(data.totalIncome);
                const totalExpense = Number(data.totalExpense);
                // Update counters
                document.getElementById('profit').textContent = `Rp ${(data.totalIncome - data.totalExpense).toLocaleString('id-ID')}`;
                document.getElementById('income').textContent = `Rp ${totalIncome.toLocaleString('id-ID')}`;
                document.getElementById('expense').textContent = `Rp ${totalExpense.toLocaleString('id-ID')}`;

                // Update table
                const tableBody = document.getElementById('consignmentsTable');
                tableBody.innerHTML = '';
                data.consignments.data.forEach(item => {
                    const row = document.createElement('tr');
                    row.className = 'bg-white border-b hover:bg-gray-50';
                    row.innerHTML = `
                            <td class="px-6 py-4">${item.store_name}</td>
                            <td class="px-6 py-4">${item.product_name}</td>
                            <td class="px-6 py-4">${item.income}</td>
                            <td class="px-6 py-4">${item.exit_date}</td>
                        `;
                    tableBody.appendChild(row);
                });

                // Update pagination
                const pagination = document.getElementById('pagination');
                pagination.innerHTML = '';
                if (data.consignments.last_page > 1) {
                    for (let i = 1; i <= data.consignments.last_page; i++) {
                        const link = document.createElement('a');
                        link.href = '#';
                        link.textContent = i;
                        link.className = 'px-2 py-1 mx-1 ' + (i === data.consignments.current_page ? 'font-bold' : '');
                        link.addEventListener('click', () => fetchDashboardData(i));
                        pagination.appendChild(link);
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to load dashboard data');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchDashboardData();
        });
    </script>

    <script>
        const reportFrames = [
            { id: 'dailyReportChart', sectionId: 'dailySection', url: '/api/dashboard/daily-report', rendered: false },
            { id: 'fortnightlyReportChart', sectionId: 'fortnightlySection', url: '/api/dashboard/fortnightly-report', rendered: false },
            { id: 'weeklyReportChart', sectionId: 'weeklySection', url: '/api/dashboard/weekly-report', rendered: false },
            { id: 'monthlyReportChart', sectionId: 'monthlySection', url: '/api/dashboard/monthly-report', rendered: false }
        ];

        async function renderLineChart(frame) {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(frame.url, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
                if (!response.ok) throw new Error('Failed to fetch chart data');
                const data = await response.json();

                const ctx = document.getElementById(frame.id).getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.map(row => row.label),
                        datasets: [
                            {
                                label: 'Masuk',
                                data: data.map(row => row.masuk),
                                backgroundColor: 'rgba(51, 160, 44, 1)',
                                borderColor: 'rgba(51, 160, 44, 0.8)',
                                fill: false
                            },
                            {
                                label: 'Keluar',
                                data: data.map(row => row.keluar),
                                backgroundColor: 'rgba(227, 26, 28, 1)',
                                borderColor: 'rgba(227, 26, 28, 0.8)',
                                fill: false
                            }
                        ]
                    },
                    options: {
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { boxWidth: 30, boxHeight: 2 }
                            }
                        },
                        animation: { duration: 1000, easing: 'easeOutCirc' },
                        hover: { animationDuration: 500 },
                        tension: 0.3,
                        scales: { y: { min: 0 } }
                    }
                });
                frame.rendered = true;
            } catch (error) {
                console.error(`Error loading chart for ${frame.id}:`, error);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const defaultFrame = reportFrames.find(f => f.id === 'dailyReportChart');
            renderLineChart(defaultFrame);

            document.querySelectorAll('.report-filter').forEach(button => {
                button.addEventListener('click', () => {
                    const targetSection = button.dataset.target;
                    document.querySelectorAll('.report-section').forEach(section => {
                        section.classList.add('hidden');
                    });
                    document.getElementById(targetSection).classList.remove('hidden');

                    document.querySelectorAll('.report-filter').forEach(btn => {
                        btn.classList.remove('bg-blue-500', 'text-white');
                        btn.classList.add('bg-gray-200', 'text-gray-800');
                    });
                    button.classList.remove('bg-gray-200', 'text-gray-800');
                    button.classList.add('bg-blue-500', 'text-white');

                    const frame = reportFrames.find(f => f.sectionId === targetSection);
                    if (frame && !frame.rendered) {
                        renderLineChart(frame);
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btnGross = document.getElementById('toggleGross');
            const btnStore = document.getElementById('toggleStore');
            const grossSection = document.getElementById('grossIncomeSection');
            const storeSection = document.getElementById('storeIncomeSection');

            btnGross.addEventListener('click', () => {
                grossSection.classList.remove('hidden');
                storeSection.classList.add('hidden');
                btnGross.classList.remove('bg-gray-200', 'text-gray-800');
                btnGross.classList.add('bg-blue-600', 'text-white');
                btnStore.classList.remove('bg-blue-600', 'text-white');
                btnStore.classList.add('bg-gray-200', 'text-gray-800');
            });

            btnStore.addEventListener('click', () => {
                storeSection.classList.remove('hidden');
                grossSection.classList.add('hidden');
                btnStore.classList.remove('bg-gray-200', 'text-gray-800');
                btnStore.classList.add('bg-blue-600', 'text-white');
                btnGross.classList.remove('bg-blue-600', 'text-white');
                btnGross.classList.add('bg-gray-200', 'text-gray-800');
            });
        });
    </script>

    <script>
        function generateColors(count) {
            const colors = [];
            for (let i = 0; i < count; i++) {
                const hue = Math.floor((360 / count) * i);
                colors.push(`hsl(${hue}, 70%, 60%)`);
            }
            return colors;
        }
    </script>

    <script>
        const timeFrames = [
            { days: 7, chartId: 'chart7', tableContainerId: 'tableContainer7', rendered: false },
            { days: 14, chartId: 'chart14', tableContainerId: 'tableContainer14', rendered: false },
            { days: 30, chartId: 'chart30', tableContainerId: 'tableContainer30', rendered: false },
            { days: 365, chartId: 'chart365', tableContainerId: 'tableContainer365', rendered: false }
        ];

        function chunkArray(array, size) {
            const chunks = [];
            for (let i = 0; i < array.length; i += size) {
                chunks.push(array.slice(i, i + size));
            }
            return chunks;
        }

        async function renderPaginatedTables(data, colors, containerId) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';

            const chunks = chunkArray(data, 5);
            chunks.forEach((chunk, chunkIndex) => {
                const table = document.createElement('table');
                table.className = "min-w-[250px] table-auto divide-y divide-gray-200 border rounded-lg text-sm text-left bg-white shadow";
                table.innerHTML = `
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 font-medium">Produk</th>
                                <th class="px-4 py-2 font-medium">Income</th>
                                <th class="px-4 py-2 font-medium">Persentase</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    `;

                const tbody = table.querySelector('tbody');
                chunk.forEach((item, i) => {
                    const colorIndex = chunkIndex * 5 + i;
                    const color = colors[colorIndex] || '#ccc';
                    const row = document.createElement('tr');
                    row.innerHTML = `
                            <td class="px-4 py-2 text-gray-800">
                                <span style="display:inline-block;width:15px;height:15px;background:${color};border-radius:3px;"></span>
                                ${item.label}
                            </td>
                            <td class="px-4 py-2 text-gray-800">Rp ${(item.income || 0).toLocaleString()}</td>
                            <td class="px-4 py-2 text-gray-800">${item.percentage}%</td>
                        `;
                    tbody.appendChild(row);
                });
                container.appendChild(table);
            });
        }

        async function renderChart(frame) {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`/api/dashboard/income-percentage/${frame.days}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
                if (!response.ok) throw new Error('Failed to fetch chart data');
                const data = await response.json();

                const colors = generateColors(data.length);
                const labels = data.map(item => item.label);
                const percentages = data.map(item => item.percentage);

                const ctx = document.getElementById(frame.chartId).getContext('2d');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Persentase Income',
                            data: percentages,
                            backgroundColor: colors,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        rotation: 270,
                        plugins: {
                            legend: { display: false },
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

                renderPaginatedTables(data, colors, frame.tableContainerId);
                frame.rendered = true;
            } catch (error) {
                console.error(`Error loading chart for ${frame.chartId}:`, error);
            }
        }

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

    <script>
        async function renderStoreIncomeChart() {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch('/api/dashboard/store-income-percentage', {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
                if (!response.ok) throw new Error('Failed to fetch chart data');
                const data = await response.json();

                const colors = generateColors(data.length);
                const labels = data.map(item => item.store_name);
                const percentages = data.map(item => item.percentage);

                const ctx = document.getElementById('storeIncomesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: percentages,
                            backgroundColor: colors
                        }]
                    },
                    options: {
                        responsive: true,
                        rotation: 270,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        const percentage = data[context.dataIndex].percentage;
                                        return `${context.label}: ${percentage}%`;
                                    }
                                }
                            }
                        }
                    }
                });

                const container = document.getElementById('storeTableContainer');
                container.innerHTML = '';
                const chunks = chunkArray(data, 5);
                chunks.forEach((chunk, chunkIndex) => {
                    const table = document.createElement('table');
                    table.className = "min-w-[250px] table-auto divide-y divide-gray-200 border rounded-lg text-sm text-left bg-white shadow";
                    table.innerHTML = `
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 font-medium">Store Name</th>
                                    <th class="px-4 py-2 font-medium">Total Income</th>
                                    <th class="px-4 py-2 font-medium">Percentage</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        `;
                    const tbody = table.querySelector('tbody');
                    chunk.forEach((item, i) => {
                        const colorIndex = chunkIndex * 5 + i;
                        const row = document.createElement('tr');
                        row.innerHTML = `
                                <td class="px-4 py-2 text-gray-800">
                                    <span style="display:inline-block;width:15px;height:15px;background:${colors[colorIndex]};border-radius:3px;margin-right:4px;"></span>
                                    ${item.store_name}
                                </td>
                                <td class="px-4 py-2 text-gray-800">Rp ${item.total_income.toLocaleString()}</td>
                                <td class="px-4 py-2 text-gray-800">${item.percentage}%</td>
                            `;
                        tbody.appendChild(row);
                    });
                    container.appendChild(table);
                });
            } catch (error) {
                console.error('Error loading store income chart:', error);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderStoreIncomeChart();
        });
    </script>

@endsection