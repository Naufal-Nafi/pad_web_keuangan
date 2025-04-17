<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consignment;
use App\Models\Expense;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    // fungsi untuk menampilkan halaman laporan mingguan
    public function mingguanIndex()
    {
        return view('laporan.mingguan');
    }
    // fungsi untuk menampilkan halaman laporan bulanan
    public function bulananIndex()
    {
        return view('laporan.bulanan');
    }
    // fungsi untuk mendapatkan data laporan harian (pemasukan dan pengeluaran) selama satu minggu
    public function getDailyReport()
    {
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        $incomes = Consignment::whereBetween('entry_date', [$startOfWeek, $endOfWeek])
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->entry_date)->format('Y-m-d');
            });

        $expenses = Expense::whereBetween('date', [$startOfWeek, $endOfWeek])
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->date)->format('Y-m-d');
            });

        $dataHarian = [];
        for ($date = $startOfWeek; $date->lte($endOfWeek); $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
            $dataHarian[] = [
                'day' => $date->format('l'),
                'masuk' => isset($incomes[$formattedDate])
                    ? $incomes[$formattedDate]->sum('income')
                    : 0,
                'keluar' => isset($expenses[$formattedDate])
                    ? $expenses[$formattedDate]->sum('amount')
                    : 0,
            ];
        }

        return response()->json($dataHarian);
    }

    // fungsi untuk mendapatkan data laporan mingguan (pemasukan dan pengeluaran) selama satu bulan
    public function getWeeklyReport()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $incomes = Consignment::selectRaw('FLOOR((DAY(entry_date) - 1) / 7) + 1 as week, SUM(income) as total_income')
            ->whereBetween('entry_date', [$startOfMonth, $endOfMonth])
            ->groupBy('week')
            ->get();

        $expenses = Expense::selectRaw('FLOOR((DAY(date) - 1) / 7) + 1 as week, SUM(amount) as total_expense')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->groupBy('week')
            ->get();

        $dataMingguan = [];
        for ($week = 1; $week <= 4; $week++) {
            $incomeData = $incomes->firstWhere('week', $week);
            $expenseData = $expenses->firstWhere('week', $week);

            $dataMingguan[] = [
                'week' => $week,
                'masuk' => $incomeData ? $incomeData->total_income : 0,
                'keluar' => $expenseData ? $expenseData->total_expense : 0,
            ];
        }

        return response()->json($dataMingguan);
    }

    // fungsi untuk mendapatkan data laporan bulanan (pemasukan dan pengeluaran) selama satu tahun
    public function getMonthlyReport()
    {
        $currentYear = Carbon::now()->year;

        $incomes = Consignment::selectRaw('MONTH(entry_date) as month, SUM(income) as total_income')
            ->whereYear('entry_date', $currentYear)
            ->groupBy('month')
            ->get();

        $expenses = Expense::selectRaw('MONTH(date) as month, SUM(amount) as total_expense')
            ->whereYear('date', $currentYear)
            ->groupBy('month')
            ->get();

        $dataBulanan = [];
        for ($month = 1; $month <= 12; $month++) {
            $incomeData = $incomes->firstWhere('month', $month);
            $expenseData = $expenses->firstWhere('month', $month);

            $dataBulanan[] = [
                'month' => Carbon::create()->month($month)->format('F'),
                'masuk' => $incomeData ? $incomeData->total_income : 0,
                'keluar' => $expenseData ? $expenseData->total_expense : 0,
            ];
        }

        return response()->json($dataBulanan);
    }

    // fungsi untuk mendapatkan data laporan tahunan (pemasukan dan pengeluaran)
    public function getYearlyReport()
    {
        $firstYearConsignment = Consignment::min('entry_date') ? Carbon::parse(Consignment::min('entry_date'))->year : now()->year;
        $firstYearExpense = Expense::min('date') ? Carbon::parse(Expense::min('date'))->year : now()->year;
        $firstYear = min($firstYearConsignment, $firstYearExpense);

        $lastYearConsignment = Consignment::max('entry_date') ? Carbon::parse(Consignment::max('entry_date'))->year : now()->year;
        $lastYearExpense = Expense::max('date') ? Carbon::parse(Expense::max('date'))->year : now()->year;
        $lastYear = max($lastYearConsignment, $lastYearExpense);

        $incomes = Consignment::selectRaw('YEAR(entry_date) as year, SUM(income) as total_income')
            ->groupBy('year')
            ->get();

        $expenses = Expense::selectRaw('YEAR(date) as year, SUM(amount) as total_expense')
            ->groupBy('year')
            ->get();

        $dataTahunan = [];
        for ($year = $firstYear; $year <= $lastYear; $year++) {
            $incomeData = $incomes->firstWhere('year', $year);
            $expenseData = $expenses->firstWhere('year', $year);

            $dataTahunan[] = [
                'year' => $year,
                'masuk' => $incomeData ? $incomeData->total_income : 0,
                'keluar' => $expenseData ? $expenseData->total_expense : 0,
            ];
        }

        return response()->json($dataTahunan);
    }

    // fungsi untuk mendapatkan data laporan produk yang terjual
    public function getProductsPercentage()
    {
        $dataProduk = Product::withSum('consignments as total_sold', 'sold')
            ->get(['product_name', 'total_sold']);

        $totalSales = $dataProduk->sum('total_sold');

        $salesPercentage = $dataProduk->map(function ($item) use ($totalSales) {
            return [
                'barang' => $item->product_name,
                'jual' => $totalSales > 0 ? round(($item->total_sold / $totalSales) * 100, 2) : 0,
            ];
        });

        return response()->json($salesPercentage);
    }

    // fungsi untuk mendapatkan data omset dan profit
    public function getOmsetAndProfit()
    {
        $total_omset = Consignment::sum('income');

        $totalPengeluaran = Expense::sum('amount');

        $total_profit = $total_omset - $totalPengeluaran;

        return view('laporan.riwayat', compact('total_omset', 'total_profit'));
    }

    public function getIncomePercentage()
    {
        $data = Consignment::select(
            'products.product_name',
            DB::raw('SUM(consignments.income) as total_income')
        )
            ->join('products', 'products.product_id', '=', 'consignments.product_id')
            ->groupBy('products.product_name')
            ->get();

        $totalIncome = $data->sum('total_income');

        $chartData = $data->map(function ($item) use ($totalIncome) {
            $percentage = $totalIncome > 0 ? round(($item->total_income / $totalIncome) * 100, 2) : 0;
            return [
                'label' => $item->product_name,
                'percentage' => $percentage,
                'income' => $item->total_income,
            ];
        });

        return response()->json($chartData);
    }


}
