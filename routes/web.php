<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManajerController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LaundryController;

// Auth Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Manajer Routes
Route::middleware(['auth', 'role:Manajer'])->prefix('manajer')->name('manajer.')->group(function () {
    Route::get('/dashboard', [ManajerController::class, 'dashboard'])->name('dashboard');

    // User Management
    Route::get('/users', [ManajerController::class, 'userIndex'])->name('users.index');
    Route::get('/users/create', [ManajerController::class, 'userCreate'])->name('users.create');
    Route::post('/users', [ManajerController::class, 'userStore'])->name('users.store');
    Route::get('/users/{id}/edit', [ManajerController::class, 'userEdit'])->name('users.edit');
    Route::put('/users/{id}', [ManajerController::class, 'userUpdate'])->name('users.update');
    Route::delete('/users/{id}', [ManajerController::class, 'userDestroy'])->name('users.destroy');

    // Hotel Management
    Route::get('/hotels', [ManajerController::class, 'hotelIndex'])->name('hotels.index');
    Route::get('/hotels/create', [ManajerController::class, 'hotelCreate'])->name('hotels.create');
    Route::post('/hotels', [ManajerController::class, 'hotelStore'])->name('hotels.store');
    Route::get('/hotels/{id}/edit', [ManajerController::class, 'hotelEdit'])->name('hotels.edit');
    Route::put('/hotels/{id}', [ManajerController::class, 'hotelUpdate'])->name('hotels.update');
    Route::delete('/hotels/{id}', [ManajerController::class, 'hotelDestroy'])->name('hotels.destroy');

    // Linen Management
    Route::get('/linens', [ManajerController::class, 'linenIndex'])->name('linens.index');
    Route::get('/linens/create', [ManajerController::class, 'linenCreate'])->name('linens.create');
    Route::post('/linens', [ManajerController::class, 'linenStore'])->name('linens.store');
    Route::get('/linens/{id}/edit', [ManajerController::class, 'linenEdit'])->name('linens.edit');
    Route::put('/linens/{id}', [ManajerController::class, 'linenUpdate'])->name('linens.update');
    Route::delete('/linens/{id}', [ManajerController::class, 'linenDestroy'])->name('linens.destroy');

    // Laporan
    Route::get('/laporan', [ManajerController::class, 'laporanIndex'])->name('laporan.index');
    Route::post('/laporan/generate', [ManajerController::class, 'laporanGenerate'])->name('laporan.generate');
    Route::get('/laporan/pdf', [ManajerController::class, 'laporanPdf'])->name('laporan.pdf');
});

// Hotel Routes
Route::middleware(['auth', 'role:Hotel'])->prefix('hotel')->name('hotel.')->group(function () {
    Route::get('/dashboard', [HotelController::class, 'dashboard'])->name('dashboard');
    Route::get('/transactions', [HotelController::class, 'transactionIndex'])->name('transactions.index');
    Route::get('/transactions/create', [HotelController::class, 'transactionCreate'])->name('transactions.create');
    Route::post('/transactions', [HotelController::class, 'transactionStore'])->name('transactions.store');
    Route::get('/transactions/{id}', [HotelController::class, 'transactionShow'])->name('transactions.show');

    // Laporan Hotel (khusus transaksi hotel sendiri)
    Route::get('/laporan', [HotelController::class, 'laporanIndex'])->name('laporan.index');
    Route::post('/laporan/generate', [HotelController::class, 'laporanGenerate'])->name('laporan.generate');
    Route::get('/laporan/pdf', [HotelController::class, 'laporanPdf'])->name('laporan.pdf');
});

// Laundry Routes
Route::middleware(['auth', 'role:Laundry'])->prefix('laundry')->name('laundry.')->group(function () {
    Route::get('/dashboard', [LaundryController::class, 'dashboard'])->name('dashboard');
    Route::get('/queue', [LaundryController::class, 'queueIndex'])->name('queue.index');
    Route::get('/transactions', [LaundryController::class, 'allTransactions'])->name('transactions.index');
    Route::get('/transactions/{id}', [LaundryController::class, 'transactionShow'])->name('transactions.show');
    Route::put('/transactions/{id}/status', [LaundryController::class, 'updateStatus'])->name('transactions.updateStatus');

    // Laporan Laundry (semua transaksi)
    Route::get('/laporan', [LaundryController::class, 'laporanIndex'])->name('laporan.index');
    Route::post('/laporan/generate', [LaundryController::class, 'laporanGenerate'])->name('laporan.generate');
    Route::get('/laporan/pdf', [LaundryController::class, 'laporanPdf'])->name('laporan.pdf');
});
