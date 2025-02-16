<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentalController;

Route::middleware(['auth'])->group(function () {
    Route::get('/rental', [RentalController::class, 'index'])->name('rental.index');
    Route::post('/rental/store', [RentalController::class, 'store'])->name('rental.store');
    Route::get('/rental/search', [RentalController::class, 'search'])->name('rental.search');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/account', [AccountController::class, 'index'])->name('account');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);