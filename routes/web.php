<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ApprovedUmkmController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UmkmController as AuthUmkmController;
use App\Http\Controllers\Umkm\ProductController;
use App\Http\Controllers\Umkm\ProfilController;
use App\Http\Controllers\Umkm\UmkmController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/daftar-umkm', [AuthUmkmController::class, 'index'])->name('umkm.register');
Route::post('/daftar-umkm', [AuthUmkmController::class, 'register'])->name('register.umkm.post');
Route::get('/verification-notice', function () {
    return view('auth.verification_notice');
})->name('verification.notice');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/welcome', [AdminController::class, 'welcome'])->name('pages.admin.welcome');
    Route::resource('approvedumkm', ApprovedUmkmController::class);
    Route::put('/approvedumkm/{id}/update-status', [ApprovedUmkmController::class, 'updateStatus']);
    Route::resource('kategori', KategoriController::class);
});

Route::middleware(['auth', 'role:umkm'])->group(function () {
    Route::get('/umkm/welcome', [UmkmController::class, 'welcome'])->name('pages.umkm.welcome');
    Route::resource('profile', ProfilController::class);
    Route::resource('product', ProductController::class);
    Route::put('/product/{id}/update-status', [ProductController::class, 'updateStatus']);
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/welcome', [UserController::class, 'welcome'])->name('pages.user.welcome');
});
