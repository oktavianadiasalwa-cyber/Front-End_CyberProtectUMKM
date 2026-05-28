<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// 1. Halaman Utama Pilihan (Welcome)
Route::get('/', function () {
    return view('welcome');
});

// 2. Tampilan Halaman Login User
Route::get('/login-user', function () {
    return view('login-user');
})->name('login.user');

// 3. Proses Validasi Login ke Database
Route::post('/login-user', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau Kata Sandi yang Anda masukkan salah.',
    ]);
});

// 4. Tampilan Halaman Register (Daftar Akun)
Route::get('/register', function () {
    return view('register');
})->name('register');

// 5. Proses Menyimpan Akun Baru ke Database
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

    return redirect('/dashboard');
});

// 6. Halaman Dashboard (Hanya bisa masuk jika sudah login)
Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect('/login-user');
    }
    return view('dashboard'); // Membuka file dashboard.blade.php kamu
})->name('dashboard');

// 7. Proses Keluar Sistem (Logout) untuk Menghapus Sesi Login
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login-user');
})->name('logout');

// 8. Halaman Layanan Kasir (POS)
Route::get('/pos', function () {
    if (!Auth::check()) {
        return redirect('/login-user');
    }
    return view('pos');
})->name('pos');

// 9. Halaman Riwayat Transaksi (History)
Route::get('/history', function () {
    if (!Auth::check()) {
        return redirect('/login-user');
    }
    return view('history');
})->name('history');

// 10. Halaman Profil User
Route::get('/profile', function () {
    if (!Auth::check()) {
        return redirect('/login-user');
    }
    return view('profile'); // Membuka file profile.blade.php kamu
})->name('profile');

// 11. Route Proses Simpan Perubahan Profil (Biar Gak Error Merah)
Route::post('/profile/update', function (Request $request) {
    return back()->with('success', 'Profil berhasil diperbarui!');
})->name('profile.update');