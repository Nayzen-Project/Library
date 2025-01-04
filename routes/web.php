<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PeminjamAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Petugas\PetugasController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CekRole;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User routes
Route::middleware(['auth', CekRole::class.':user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

// Admin routes
Route::middleware(['auth', CekRole::class.':admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Route untuk halaman data user
    Route::get('/users', [UserAdminController::class, 'index'])->name('admin.layout.pages.data-user');
    // Route untuk halaman data peminjam
    Route::get('/peminjam', [PeminjamAdminController::class, 'index'])->name('admin.layouts.pages.data-peminjam');
    // Menyimpan User baru
    Route::post('/users/create', [UserAdminController::class, 'store'])->name('admin.users.store');
    // Menyimpan Peminjam baru
    Route::post('/peminjam/create', [PeminjamAdminController::class, 'store'])->name('admin.peminjam.store');

    // // Route halaman petugas
    // Route::get('/admin/petugas', [])
    
   // Location Routes
   Route::prefix('location')->group(function () {
    Route::get('/get-provinces', [PeminjamAdminController::class, 'getProvinces']);
    Route::get('/get-kabupaten/{provinsiId}', [PeminjamAdminController::class, 'getKabupatenByProvinsi']);
    Route::get('/get-kecamatan/{kabupatenId}', [PeminjamAdminController::class, 'getKecamatanByKabupaten']);
});
    
});


// Petugas routes
Route::middleware(['auth', CekRole::class.':petugas'])->group(function () {
    Route::get('/petugas/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');
});

require __DIR__.'/auth.php';

