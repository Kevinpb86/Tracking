<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Pos1Controller;
use App\Http\Controllers\CekKendaraanController;
use App\Http\Controllers\HSEController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Auth\LoginController;

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

// Main Dashboard
// Main Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.main');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



// POS 1 Routes
Route::prefix('pos1')->name('pos1.')->group(function () {
    Route::get('/dashboard', [Pos1Controller::class, 'index'])->name('dashboard');
});

// Cek Kendaraan Routes
Route::get('/cek-kendaraan/input', function () {
    return view('navigasi.input-cek-kendaraan');
})->name('cek-kendaraan.input');

Route::post('/cek-kendaraan', [CekKendaraanController::class, 'store'])->name('cek-kendaraan.store');
Route::get('/cek-kendaraan/daftar', [CekKendaraanController::class, 'index'])->name('cek-kendaraan.daftar');
Route::get('/cek-kendaraan/{cekKendaraan}/edit', [CekKendaraanController::class, 'edit'])->name('cek-kendaraan.edit');
Route::put('/cek-kendaraan/{cekKendaraan}', [CekKendaraanController::class, 'update'])->name('cek-kendaraan.update');
Route::get('/cek-kendaraan/{cekKendaraan}/pdf', [CekKendaraanController::class, 'exportPdf'])->name('cek-kendaraan.pdf');
Route::get('/cek-kendaraan/{cekKendaraan}', [CekKendaraanController::class, 'show'])->name('cek-kendaraan.show');

// HSE Routes
Route::get('/hse/input', [HSEController::class, 'create'])->name('hse.input');
Route::post('/hse', [HSEController::class, 'store'])->name('hse.store');
Route::get('/hse/daftar', [HSEController::class, 'index'])->name('hse.daftar');
Route::get('/hse/{hse}/edit', [HSEController::class, 'edit'])->name('hse.edit');
Route::put('/hse/{hse}', [HSEController::class, 'update'])->name('hse.update');
Route::get('/hse/{hse}', [HSEController::class, 'show'])->name('hse.show');
