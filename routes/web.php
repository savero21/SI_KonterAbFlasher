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

//KOMPLAIN
// Route::get('/komplain', [UserController::class, 'formComplain'])->name('user.complain.form');
// Route::post('/komplain', [UserController::class, 'submitComplain'])->name('user.complain.submit');
// Form komplain user
// Route::get('/komplain', [\App\Http\Controllers\UserController::class, 'formKomplain'])->name('user.complain.form');
Route::get('/komplain', [UserController::class, 'formKomplain'])->name('user.complain');
Route::post('/komplain', [\App\Http\Controllers\UserController::class, 'submitKomplain'])->name('user.complain.submit');
Route::post('/komplain', [UserController::class, 'submitComplain'])->name('user.complain.submit');
// Route::delete('/komplain/{id}/hapus', [UserController::class, 'hapusKomplain'])->name('user.complain.delete');


//riwayat kompline
Route::get('/riwayat-komplain', [UserController::class, 'riwayatKomplain'])->name('user.complain.history');




// ✅ (Opsional) Halaman landing user tambahan
Route::get('/user', function () {
    return view('user.landing'); // hanya jika kamu gunakan
})->name('user.landing');

// ✅ Agar akses GET ke /cek-status tidak error
Route::get('/cek-status', function () {
    return redirect()->route('cek.form');
});

 //complain
    // Route::post('/complain/{id}', [\App\Http\Controllers\UserController::class, 'submitComplain'])->name('user.complain');

// Route::get('/home', function () {
//     return redirect('/');
// });

// ✅ Dashboard untuk Superadmin
Route::middleware(['auth', 'isSuperadmin'])->prefix('superadmin')->group(function () {
    Route::get('/dashboard', function () {
        return view('superadmin.dashboard'); // Pastikan view ini ada
    })->name('superadmin.dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('superadmin.users.index');
    Route::post('/users/{id}/approve', [UserController::class, 'approve'])->name('superadmin.users.approve');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('superadmin.users.destroy');
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

    //laporanhapus
    Route::delete('/admin/laporan/{id}', [ReportController::class, 'destroy'])->name('admin.laporan.destroy');

    //komplain 
    // Di dalam middleware auth dan isAdmin
Route::get('/admin/komplain', [\App\Http\Controllers\AdminController::class, 'kelolaKomplain'])->name('admin.komplain');
Route::post('/admin/komplain/{id}/balas', [\App\Http\Controllers\AdminController::class, 'balasKomplain'])->name('admin.komplain.balas');
Route::delete('/admin/komplain/{id}/hapus', [AdminController::class, 'hapusKomplain'])->name('admin.komplain.hapus');





   


    // //superadmin
    // Route::middleware(['auth', 'isSuperadmin'])->prefix('superadmin')->group(function () {
    //     Route::get('/users', [UserController::class, 'index'])->name('superadmin.users.index');
    //     Route::post('/users/{id}/approve', [UserController::class, 'approve'])->name('superadmin.users.approve');
    //     Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('superadmin.users.destroy');
    // });



});
