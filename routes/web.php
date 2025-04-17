<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpenseController;
USE App\Http\Controllers\KeuanganController;
use App\Http\Controllers\ConsignmentController;
use Illuminate\Support\Facades\Route;
//route ke halaman login
Route::get('/', function () {
    return view('auth.login');
});
//route yang hanya bisa diakses jika sudah login
Route::middleware('auth')->group(function () {
//route ke dashboard, fitur search, dan data chart
    Route::get('/dashboard', [ConsignmentController::class, 'mainpageIndex'])->name('mainpage.index');
    Route::get('/dashboard/search', [ConsignmentController::class, 'mainpageSearch'])->name('mainpage.search');
    Route::get('/dashboard/daily-report', [KeuanganController::class, 'getDailyReport']);
    Route::get('/dashboard/income-percentage', [KeuanganController::class, 'getIncomePercentage']);
//route ke transaksi, dan CRUD kongsi
    Route::get('/transaksi', [ConsignmentController::class, 'laporanIndex'])->name('laporan.index');
    Route::get('/transaksi/tambah', [ConsignmentController::class, 'laporanCreate'])->name('laporan.create');
    Route::post('/transaksi', [ConsignmentController::class, 'laporanStore'])->name('laporan.store');
    Route::post('/transaksi/update/{consignment_id}', [ConsignmentController::class, 'laporanUpdate'])->name('laporan.update');
    Route::get('/transaksi/edit/{consignment_id}', [ConsignmentController::class, 'laporanEdit'])->name('laporan.edit');
    Route::delete('/transaksi/{consignment_id}', [ConsignmentController::class, 'laporanDestroy'])->name('laporan.destroy');
//route yang hanya bisa diakses oleh owner
    Route::middleware('owner')->group(function () {
//route ke manajemen pegawai, search, dan CRUD pegawai
        Route::get('/pegawai', [UserController::class, 'index'])->name('pegawai.index');
        Route::get('/pegawai/create', [UserController::class, 'create'])->name('pegawai.create');
        Route::post('/pegawai', [UserController::class, 'store'])->name('pegawai.store');
        Route::delete('/pegawai/{user_id}', [UserController::class, 'destroy'])->name('pegawai.destroy');
        Route::get('/pegawai/edit/{user_id}', [UserController::class, 'edit'])->name('pegawai.edit');
        Route::post('/pegawai/update/{user_id}', [UserController::class, 'update'])->name('pegawai.update');
        Route::get('/pegawai/search', [UserController::class, 'search'])->name('pegawai.search');
//route ke manajemen barang, dan CRUD barang
        Route::get('/barang', [ExpenseController::class, 'index'])->name('barang.index');
        Route::get('/barang/create', [ExpenseController::class, 'create'])->name('barang.create');
        Route::post('/barang', [ExpenseController::class, 'store'])->name('barang.store');
        Route::delete('/barang/{expense_id}', [ExpenseController::class, 'destroy'])->name('barang.destroy');
        Route::get('/barang/edit/{expense_id}', [ExpenseController::class, 'edit'])->name('barang.edit');
        Route::post('/barang/update/{expense_id}', [ExpenseController::class, 'update'])->name('barang.update');
//route unduh data barang
        Route::get('/barang/unduh', [ExpenseController::class, 'pageunduh'])->name('barang.unduh');
        Route::post('/barang/pdf', [ExpenseController::class, 'download'])->name('downloadPdf');
//route ke data mingguan dan data chart
        Route::get('/mingguan', [KeuanganController::class, 'mingguanIndex'])->name('mingguan.index');
        Route::get('/mingguan/weekly-report', [KeuanganController::class, 'getWeeklyReport']);
//route ke data bulanan dan data chart
        Route::get('/bulanan', [KeuanganController::class, 'bulananIndex'])->name('bulanan.index');
        Route::get('/bulanan/monthly-report', [KeuanganController::class, 'getMonthlyReport']);
//route ke data tahunan dengan omset dan profit, data chart, dan persentasi produk
        Route::get('/riwayat/yearly-report', [KeuanganController::class, 'getYearlyReport']);
        Route::get('/riwayat/product-percentage', [KeuanganController::class, 'getProductsPercentage']);
        Route::get('/riwayat', [KeuanganController::class, 'getOmsetAndProfit']);
    });
});
require __DIR__.'/auth.php';

