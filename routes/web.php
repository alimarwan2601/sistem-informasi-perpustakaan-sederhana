<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman login hanya bisa dibuka oleh pengguna yang belum login.
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');
});

// Halaman yang hanya bisa dibuka setelah login.
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('categories', CategoryController::class)
        ->except(['show']);

    Route::resource('books', BookController::class);

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::resource('members', MemberController::class);

    // Route pengujian role admin.
    Route::get('/admin-area', function () {
        return 'Berhasil masuk ke halaman khusus Admin.';
    })->middleware('role:admin');

    // Route pengujian role petugas.
    Route::get('/petugas-area', function () {
        return 'Berhasil masuk ke halaman khusus Petugas.';
    })->middleware('role:petugas');
});