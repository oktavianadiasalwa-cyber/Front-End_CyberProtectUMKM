<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| 1. HALAMAN UTAMA & GERBANG MASUK
|--------------------------------------------------------------------------
*/

// Halaman Landing Utama (Pilihan masuk Admin / User)
Route::get('/', function () {
    return view('landing'); 
});


/*
|--------------------------------------------------------------------------
| 2. JALUR AUTENTIKASI & FITUR ADMIN (BAGIAN ADMIN - NADIA FE)
|--------------------------------------------------------------------------
*/

// Login Admin
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Register Admin
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:5'],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    // FIX: Admin dilempar ke halaman admin-dashboard milikmu
    return redirect('/admin-dashboard'); 
});

// Halaman-Halaman Admin UI milikmu
Route::get('/admin-dashboard', function () {
    return view('admin-dashboard'); // Sesuai dengan file admin-dashboard.blade.php kamu
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


/*
|--------------------------------------------------------------------------
| 3. JALUR AUTENTIKASI & FITUR USER / KASIR (BAGIAN USER - DHEA FE)
|--------------------------------------------------------------------------
*/

// Login User
Route::get('/login-user', function () {
    return view('login-user');
})->name('login.user');

Route::post('/login-user', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        // FIX: User diarahkan ke halaman POS (Fitur utama User), bukan dashboard Admin
        return redirect()->intended('/pos'); 
    }

    return back()->withErrors([
        'email' => 'Email atau Kata Sandi yang Anda masukkan salah.',
    ]);
});

// Halaman Fitur User
Route::get('/pos', function () {
    if (!Auth::check()) { return redirect('/login-user'); }
    return view('pos');
})->name('pos');

Route::get('/history', function () {
    if (!Auth::check()) { return redirect('/login-user'); }
    return view('history');
})->name('history');

Route::get('/profile', function () {
    if (!Auth::check()) { return redirect('/login-user'); }
    return view('profile'); 
})->name('profile');

Route::post('/profile/update', function (Request $request) {
    return back()->with('success', 'Profil berhasil diperbarui!');
})->name('profile.update');


/*
|--------------------------------------------------------------------------
| 4. LOGOUT (PROSES KELUAR SISTEM)
|--------------------------------------------------------------------------
*/
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/'); 
})->name('logout');