<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Halaman Landing
Route::get('/', function () {
    return view('landing');
});

// Halaman Login & Proses Login Dummy
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Halaman Register
Route::get('/register', function () {
    return view('register');
})->name('register');

// Halaman-halaman setelah Login (Bisa diakses langsung untuk tes UI)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/ringkasan-keamanan', function () {
    return view('ringkasan-keamanan');
})->name('ringkasan-keamanan');

Route::get('/manajemen-karyawan', function () {
    return view('manajemen-karyawan');
})->name('manajemen-karyawan');

Route::get('/rule-based', function () {
    return view('rule-based');
})->name('rule-based');

Route::get('/profil', function () {
    return view('profil');
})->name('profil');

// Logout dummy balik ke landing
Route::post('/logout', function () {
    return redirect('/');
})->name('logout');