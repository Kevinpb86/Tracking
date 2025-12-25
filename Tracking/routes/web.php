<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HseController;
use Illuminate\Support\Facades\Auth;

// Redirect root to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Guest-only routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.forgot');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.forgot.send');

    Route::get('/reset-password', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.reset.submit');
});

// Authenticated routes
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/main-dashboard', function () {
        $pos1Queues = session('pos1_queues', []);
        $pos2Queues = session('pos2_queues', []);
        return view('main.main', compact('pos1Queues', 'pos2Queues'));
    })->name('dashboard.main');

    Route::get('/pos1', function () {
        $pos1Queues = session('pos1_queues', []);
        return view('navigasi.pos1', compact('pos1Queues'));
    })->name('pos1.dashboard');

    Route::get('/hse/input', function () {
        return view('navigasi.input-hse');
    })->name('hse.input');

    Route::post('/hse/store', function (\Illuminate\Http\Request $request) {
        // Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'nama_petugas' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kondisi_apd' => 'required|string',
            'temuan' => 'nullable|string',
            'tindak_lanjut' => 'nullable|string',
            'penanggung_jawab' => 'nullable|string|max:255',
        ]);

        // Simpan data ke session sebagai array
        $hseData = [
            'id' => uniqid('hse_', true),
            'tanggal' => $validated['tanggal'],
            'waktu' => $validated['waktu'],
            'nama_petugas' => $validated['nama_petugas'],
            'lokasi' => $validated['lokasi'],
            'kondisi_apd' => $validated['kondisi_apd'],
            'temuan' => $validated['temuan'] ?? '',
            'tindak_lanjut' => $validated['tindak_lanjut'] ?? '',
            'penanggung_jawab' => $validated['penanggung_jawab'] ?? '',
            'created_at' => now()->toDateTimeString(),
        ];

        // Ambil data HSE yang sudah ada
        $hseList = session('hse_list', []);
        // Tambahkan data baru di awal array
        array_unshift($hseList, $hseData);
        // Simpan kembali ke session
        session(['hse_list' => $hseList]);

        return redirect()->route('hse.list')->with('success', 'Data HSE berhasil disimpan!');
    })->name('hse.store');
    Route::get('/hse/daftar', [HseController::class, 'index'])->name('hse.daftar');

    Route::get('/hse/list', function () {
        $hseList = session('hse_list', []);
        return view('navigasi.daftar-hse', compact('hseList'));
    })->name('hse.list');

    Route::get('/dashboard', function () {
        $queues = session('queues', []);
        return view('dashboard', compact('queues'));
    })->name('dashboard');
});
