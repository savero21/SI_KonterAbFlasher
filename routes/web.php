<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ Halaman awal sistem langsung ke form cek status user
Route::get('/', [UserController::class, 'beranda'])->name('beranda');

Route::get('/cek', [UserController::class, 'cekForm'])->name('cek.form');

//layanan
Route::get('/layanan', [UserController::class, 'layanan'])->name('user.layanan');

//kontak
Route::get('/kontak', [UserController::class, 'kontak'])->name('kontak');



// ✅ Proses form cek status (POST)
Route::post('/cek-status', [UserController::class, 'cekProses'])->name('cek.proses');

// ✅ (Opsional) Halaman landing user tambahan
Route::get('/user', function () {
    return view('user.landing'); // hanya jika kamu gunakan
})->name('user.landing');

// ✅ Agar akses GET ke /cek-status tidak error
Route::get('/cek-status', function () {
    return redirect()->route('cek.form');
});

// ✅ Autentikasi admin
Auth::routes();

// ✅ Semua route untuk ADMIN (wajib login + role admin)
Route::middleware(['auth', 'isAdmin'])->group(function () {

    // 🏠 Dashboard admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // 📦 Data Servis
    Route::resource('/services', ServiceController::class);

    // 💳 Transaksi servis
    Route::get('/admin/transaksi', [AdminController::class, 'transaksi'])->name('admin.transaksi');

    // 📄 Laporan admin
    Route::get('/admin/laporan', [ReportController::class, 'laporan'])->name('admin.laporan');

    // 🧾 Export laporan
    Route::get('/admin/laporan/pdf', [ReportController::class, 'exportPdf'])->name('admin.laporan.pdf');
    Route::get('/admin/laporan/excel', [ReportController::class, 'exportExcel'])->name('admin.laporan.excel');
});
