<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;

// Halaman Utama / Beranda
Route::get('/', [DashboardController::class, 'index'])->name('beranda');
Route::post('/transactions', [DashboardController::class, 'store'])->name('transactions.store');
Route::delete('/transactions/{transaction}', [DashboardController::class, 'destroy'])->name('transactions.destroy');
Route::get('/transactions/export', [DashboardController::class, 'export'])->name('transactions.export');


// Grup untuk Halaman Laporan (Read-Only)
Route::prefix('laporan')->name('report.')->group(function () {
    Route::get('/arus-kas', [ReportController::class, 'arusKas'])->name('arus_kas');
    Route::get('/laba-rugi', [ReportController::class, 'labaRugi'])->name('laba_rugi');
    Route::get('/perubahan-modal', [ReportController::class, 'perubahanModal'])->name('perubahan_modal');
    Route::get('/neraca', [ReportController::class, 'neraca'])->name('neraca');
});