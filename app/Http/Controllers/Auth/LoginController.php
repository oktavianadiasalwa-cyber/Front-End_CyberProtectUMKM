<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Memproses data login (Simulasi Semi-Nyata)
     */
    public function login(Request $request)
    {
        // 1. Validasi input tetap jalan
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Set akun "Bohongan" buat uji coba Admin Frontend
        $dummyEmail = 'admin@gmail.com';
        $dummyPassword = 'password123';

        // 3. Cek apakah input sesuai dengan akun bohongan
        if ($request->email === $dummyEmail && $request->password === $dummyPassword) {
            
            /* * TRIK BIAR SINKRON: 
             * Kita cari atau buatkan user dummy di sistem Laravel secara otomatis.
             * Jadi Auth::user() di dashboard kamu gak bakal kosong/error.
             */
            $user = User::firstOrCreate(
                ['email' => $dummyEmail],
                [
                    'name' => 'Nadia Admin', 
                    'password' => bcrypt($dummyPassword)
                ]
            );

            // Login-kan user dummy tersebut ke dalam sistem Laravel
            Auth::login($user);
            $request->session()->regenerate();

            return redirect('/dashboard');
        }

        // 4. Jika salah, kembalikan ke login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah. (Gunakan: admin@gmail.com / password123)',
        ])->onlyInput('email');
    }

    /**
     * Memproses Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/'); // Keluar langsung balik ke landing utama
    }
}