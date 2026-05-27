<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman form login.
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Memproses data login (Murni untuk Prototype Frontend)
     */
    public function login(Request $request)
    {
        // Langsung lempar ke halaman dashboard tanpa cek database
        return redirect('/dashboard');
    }
}