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

    Route::get('/hse/daftar', [HseController::class, 'index'])->name('hse.daftar');

    Route::post('/hse/store', [HseController::class, 'store'])->name('hse.store');

    Route::get('/hse/cetak', function () {
        return view('navigasi.cetak-hse');
    })->name('hse.cetak');

    Route::get('/dashboard', function () {
        $queues = session('queues', []);
        return view('dashboard', compact('queues'));
    })->name('dashboard');
});
