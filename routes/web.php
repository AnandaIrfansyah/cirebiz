<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ApprovedUmkmController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UmkmController as AuthUmkmController;
use App\Http\Controllers\Auth\UserController as AuthUserController;
use App\Http\Controllers\Umkm\ProductController;
use App\Http\Controllers\Umkm\ProfilController;
use App\Http\Controllers\Umkm\UmkmController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/daftar-umkm', [AuthUmkmController::class, 'index'])->name('umkm.register');
Route::post('/daftar-umkm', [AuthUmkmController::class, 'register'])->name('register.umkm.post');

Route::get('/daftar-user', [AuthUserController::class, 'index'])->name('user.register');
Route::post('/daftar-user', [AuthUserController::class, 'register'])->name('register.user.post');

Route::get('/approved-umkm', function () {
    return view('auth.approved_umkm');
})->name('approved.umkm');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('login')->with('success', 'Email berhasil diverifikasi. Silakan login.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (HttpRequest $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Email verifikasi telah dikirim ulang.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/welcome', [AdminController::class, 'welcome'])->name('pages.admin.welcome');
    Route::resource('approvedumkm', ApprovedUmkmController::class);
    Route::put('/approvedumkm/{id}/update-status', [ApprovedUmkmController::class, 'updateStatus']);
    Route::resource('kategori', KategoriController::class);
});

Route::middleware(['auth', 'verified', 'role:umkm'])->group(function () {
    Route::get('/umkm/welcome', [UmkmController::class, 'welcome'])->name('pages.umkm.welcome');
    Route::resource('profile', ProfilController::class);
    Route::resource('product', ProductController::class);
    Route::put('/product/{id}/update-status', [ProductController::class, 'updateStatus']);
});

Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::resource('home', HomeController::class);
});
