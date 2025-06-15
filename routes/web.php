<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/zis/{record}/invoice', [InvoiceController::class, 'printZisInvoice'])
    ->middleware('auth') // Pastikan hanya user yang login bisa akses
    ->name('zis.invoice'); // Memberi nama pada rute

    // Rute untuk Laporan Bulanan & Donatur
Route::get('/laporan/bulanan/{tipe}', [InvoiceController::class, 'laporanBulanan'])
    ->middleware('auth')
    ->name('laporan.bulanan');

// Rute untuk Laporan Bulanan & Donatur
Route::get('/laporan/tahunan/{tipe}', [InvoiceController::class, 'laporanTahunan'])
    ->middleware('auth')
    ->name('laporan.tahunan');