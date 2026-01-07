<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Pos1Controller;
use App\Http\Controllers\CekKendaraanController;
use App\Http\Controllers\HSEController;
use App\Http\Controllers\DoItemController;
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
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.main')->middleware('auth');

// Admin Dashboard
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdministratorController;
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');
Route::get('/admin/users', [AdministratorController::class, 'index'])->name('admin.users')->middleware('auth');
Route::get('/admin/users/{user}/edit', [AdministratorController::class, 'edit'])->name('admin.users.edit')->middleware('auth');
Route::delete('/admin/users/{user}', [AdministratorController::class, 'destroy'])->name('admin.users.destroy')->middleware('auth');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// SCM Routes
Route::prefix('scm')->name('scm.')->group(function () {
    Route::get('/do-item/daftar', [DoItemController::class, 'index'])->name('do-item.index');
    Route::get('/do-item/input', [DoItemController::class, 'create'])->name('do-item.input');
    Route::post('/do-item/store', [DoItemController::class, 'store'])->name('do-item.store');
    Route::get('/do-item/{doItem}/edit', [DoItemController::class, 'edit'])->name('do-item.edit');
    Route::put('/do-item/{doItem}', [DoItemController::class, 'update'])->name('do-item.update');
    Route::delete('/do-item/{doItem}', [DoItemController::class, 'destroy'])->name('do-item.destroy');
});

// Registration Routes
use App\Http\Controllers\Auth\RegisterController;
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Password Reset Routes
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.forgot');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');



use App\Http\Controllers\Pos2Controller; // Import Pos2Controller

// POS 1 Routes
Route::prefix('pos1')->name('pos1.')->group(function () {
    Route::get('/dashboard', [Pos1Controller::class, 'index'])->name('dashboard');
    Route::get('/antrian/input', [Pos1Controller::class, 'create'])->name('antrian.input');
    Route::post('/antrian', [Pos1Controller::class, 'store'])->name('antrian.store');
    Route::get('/antrian/daftar', [Pos1Controller::class, 'daftarAntrian'])->name('antrian.daftar');
    Route::get('/antrian/{id}/edit', [Pos1Controller::class, 'edit'])->name('antrian.edit');
    Route::put('/antrian/{id}', [Pos1Controller::class, 'update'])->name('antrian.update');
    Route::delete('/antrian/{id}', [Pos1Controller::class, 'destroy'])->name('antrian.destroy');
    Route::get('/antrian/{id}/print', [Pos1Controller::class, 'printTicket'])->name('antrian.print');
});

// POS 2 Routes
Route::prefix('pos2')->name('pos2.')->group(function () {
    Route::get('/dashboard', [Pos2Controller::class, 'index'])->name('dashboard');
});

// Cek Kendaraan Routes
Route::get('/cek-kendaraan/input', function () {
    return view('navigasi.input-cek-kendaraan');
})->name('cek-kendaraan.input');

Route::post('/cek-kendaraan', [CekKendaraanController::class, 'store'])->name('cek-kendaraan.store');
Route::get('/history-pemeriksaan', [CekKendaraanController::class, 'index'])->name('cek-kendaraan.daftar');
Route::redirect('/cek-kendaraan/daftar', '/history-pemeriksaan', 301);
Route::redirect('/cek-kendaraan/{id}/edit', '/history-pemeriksaan/{id}/edit', 301);
Route::redirect('/cek-kendaraan/{id}/export-pdf', '/history-pemeriksaan/{id}/export-pdf', 301);
Route::get('/history-pemeriksaan/{cekKendaraan}/edit', [CekKendaraanController::class, 'edit'])->name('cek-kendaraan.edit');
Route::put('/history-pemeriksaan/{cekKendaraan}', [CekKendaraanController::class, 'update'])->name('cek-kendaraan.update');
Route::delete('/history-pemeriksaan/{cekKendaraan}', [CekKendaraanController::class, 'destroy'])->name('cek-kendaraan.destroy');
Route::get('/history-pemeriksaan/{cekKendaraan}/export-pdf', [CekKendaraanController::class, 'exportPdf'])->name('cek-kendaraan.export-pdf');
Route::get('/cek-kendaraan/{cekKendaraan}', [CekKendaraanController::class, 'show'])->name('cek-kendaraan.show');

// HSE Routes
Route::get('/hse/input', [HSEController::class, 'create'])->name('hse.input');
Route::post('/hse', [HSEController::class, 'store'])->name('hse.store');
Route::get('/hse/daftar', [HSEController::class, 'index'])->name('hse.daftar');
Route::get('/hse/{hse}/edit', [HSEController::class, 'edit'])->name('hse.edit');
Route::put('/hse/{hse}', [HSEController::class, 'update'])->name('hse.update');
Route::get('/hse/{hse}/pdf', [HSEController::class, 'exportPdf'])->name('hse.export-pdf');
Route::delete('/hse/{hse}', [HSEController::class, 'destroy'])->name('hse.destroy');
Route::get('/hse/{hse}', [HSEController::class, 'show'])->name('hse.show');

// Cek Barang Routes
use App\Http\Controllers\CekBarangController;
Route::get('/cek-barang', [CekBarangController::class, 'index'])->name('cek-barang.index');
Route::get('/cek-barang/input', [CekBarangController::class, 'create'])->name('cek-barang.create');
Route::post('/cek-barang', [CekBarangController::class, 'store'])->name('cek-barang.store');
Route::get('/cek-barang/{cekBarang}/edit', [CekBarangController::class, 'edit'])->name('cek-barang.edit');
Route::put('/cek-barang/{cekBarang}', [CekBarangController::class, 'update'])->name('cek-barang.update');
Route::delete('/cek-barang/{cekBarang}', [CekBarangController::class, 'destroy'])->name('cek-barang.destroy');
Route::get('/cek-barang/{cekBarang}', [CekBarangController::class, 'show'])->name('cek-barang.show');
Route::get('/cek-barang/{cekBarang}/pdf', [CekBarangController::class, 'exportPdf'])->name('cek-barang.export-pdf');

// Tracking Routes
use App\Http\Controllers\TrackingController;
Route::prefix('tracking')->name('tracking.')->group(function () {
    Route::get('/dashboard', [TrackingController::class, 'dashboard'])->name('dashboard');
    Route::get('/', [TrackingController::class, 'index'])->name('index');
    Route::get('/create', [TrackingController::class, 'create'])->name('create');
    Route::post('/', [TrackingController::class, 'store'])->name('store');
    Route::get('/{tracking}', [TrackingController::class, 'show'])->name('show');
    Route::get('/{tracking}/edit', [TrackingController::class, 'edit'])->name('edit');
    Route::put('/{tracking}', [TrackingController::class, 'update'])->name('update');
    Route::delete('/{tracking}', [TrackingController::class, 'destroy'])->name('destroy');

    // Additional tracking actions
    Route::post('/{tracking}/update-lokasi', [TrackingController::class, 'updateLokasi'])->name('update-lokasi');
    Route::post('/{tracking}/link-antrian', [TrackingController::class, 'linkAntrian'])->name('link-antrian');
    Route::post('/{tracking}/link-cek-kendaraan', [TrackingController::class, 'linkCekKendaraan'])->name('link-cek-kendaraan');
    Route::post('/{tracking}/link-hse', [TrackingController::class, 'linkHse'])->name('link-hse');
    Route::post('/{tracking}/link-cek-do', [TrackingController::class, 'linkCekDo'])->name('link-cek-do');
    Route::post('/{tracking}/link-cek-barang', [TrackingController::class, 'linkCekBarang'])->name('link-cek-barang');
    Route::post('/{tracking}/mark-selesai', [TrackingController::class, 'markSelesai'])->name('mark-selesai');

    // API endpoints
    Route::get('/api/by-nomor-polisi', [TrackingController::class, 'getByNomorPolisi'])->name('api.by-nomor-polisi');
    Route::get('/api/export', [TrackingController::class, 'export'])->name('api.export');
    Route::get('/api/statistics', [TrackingController::class, 'statistics'])->name('api.statistics');
});
