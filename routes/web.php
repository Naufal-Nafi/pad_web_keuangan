<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\ConsignmentController;
use Illuminate\Support\Facades\Route;
//route ke halaman login
Route::get('/', function () {
    return view('auth.login');
});
Route::get('forgot-password', function () {
    return view('auth.email');
})->name('password.request');
Route::get('reset-password/{token}', function () {
    return view('auth.reset');
})->name('password.reset');

Route::get('/dashboard', function () {
    return view('home.home');
})->name('dashboard');

Route::prefix('transaksi')->group(function () {
    Route::get('/', function () {
        return view('transaksi.transaksi'); })->name('transaksi');
    Route::get('/tambah', function () {
        return view('transaksi.tambah'); })->name('laporan.create');
    Route::get('/edit/{consignment_id}', function () {
        return view('transaksi.edit'); })->name('laporan.edit');
});

Route::prefix('barang')->group(function () {
    Route::get('/', function () {
        return view('barang.barang'); })->name('barang');
    Route::get('/create', function () {
        return view('barang.create'); })->name('barang.create');
    Route::get('/edit/{expense_id}', function () {
        return view('barang.edit'); })->name('barang.edit');
    Route::get('/unduh', function() {
        return view('barang.unduh'); })->name('barang.unduh');
});


Route::prefix('pegawai')->group(function () {
    Route::get('/', function () {
        return view('manajemen.pegawai');
    })->name('pegawai.index');

    Route::get('/create', function () {
        return view('manajemen.create');
    })->name('pegawai.create');

    Route::get('/edit/{user_id}', function () {
        return view('manajemen.edit');
    })->name('pegawai.edit');

    Route::get('/search', function () {
        return view('manajemen.pegawai');
    })->name('pegawai.search');
});


require __DIR__ . '/auth.php';

