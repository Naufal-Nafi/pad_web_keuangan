@extends('layout.admin')
@section('title laporan', 'RIWAYAT PENGHASILAN')
@section('dropdown', 'Riwayat Penghasilan')

<head>
    <title>Riwayat</title>
</head>

@section('content')
<section class="flex flex-col p-20">
    <div class="grid grid-cols-2 gap-2 p-5 bg-[#F4F1E6] mx-auto w-full mb-10">
        <div class="grid grid-rows-2 gap-2 bg-[#F4F1E6] mr-3">
            <!-- profit -->
            <div class="bg-gradient-to-r from-[#77D670] to-[#A0EB9B] h-auto max-w-full py-3 mb-3 rounded-xl drop-shadow-lg col-span-1 text-center">
                <h1 class="text-4xl text-white font-semibold py-3">Profit</h2>
                    <p class="text-6xl text-white font-bold py-3">{{ 'Rp ' . number_format($total_profit, 0, ',', '.') }}</p>
            </div>
            <!-- omset -->
            <div class="bg-gradient-to-r from-[#E87676] to-[#EBAEAE] h-auto max-w-full py-3 mt-3 rounded-xl drop-shadow-lg col-span-1 text-center">
                <h1 class="text-4xl text-white font-semibold py-3">Omset</h2>
                    <p class="text-6xl text-white font-bold py-3">{{ 'Rp ' . number_format($total_omset, 0, ',', '.') }}</p>
            </div>
        </div>
        <!-- pie chart -->
        <div class="bg-[#98E493] h-auto max-w-full rounded-xl ml-3 drop-shadow-lg col-span-1 p-3">
            <h2 class="text-5xl text-white/75 drop-shadow-lg font-semibold text-center mb-4">Presentase Penjualan</h2>
            <div class="flex justify-center bg-[#98E493]">
                <div class="bg-[#98E493]"><canvas id="productsPercentage"></canvas></div>
            </div>
        </div>
    </div>
    <!-- line chart -->
    <div class="drop-shadow-lg"><canvas id="yearlyReportChart"></canvas></div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('yearlyReportChart').getContext('2d');
        fetch('/riwayat/yearly-report')
            .then(response => response.json())
            .then(data_tahunan => {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data_tahunan.map(row => row.year),
                        datasets: [{
                                label: 'Masuk',
                                data: data_tahunan.map(row => row.masuk),
                                borderColor: '#20BB14',
                                fill: false
                            },
                            {
                                label: 'Keluar',
                                data: data_tahunan.map(row => row.keluar),
                                borderColor: '#E21F03',
                                fill: false
                            }
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

    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('productsPercentage').getContext('2d');
        fetch('/riwayat/product-percentage')
            .then(response => response.json())
            .then(data_product => {
                const colors = generateRandomColors(data_product.length);
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: data_product.map(row => row.barang),
                        datasets: [{
                            data: data_product.map(row => row.jual),
                            backgroundColor: colors,
                        }],
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const value = context.raw || 0;
                                        return `${value}%`;
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error loading data:', error));
    });


    function generateRandomColors(count) {
        const colors = [];
        for (let i = 0; i < count; i++) {
            const color = `#${Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0')}`;
            colors.push(color);
        }
        return colors;
    }
</script>
@endsection