<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller {// Menampilkan form login

    // Proses login
    public function login(Request $request)
        {
            // Validasi data login
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            // Coba login
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                // Cek apakah user dibanned
                if (Auth::user()->is_banned) {
                    Auth::logout(); // Logout langsung
                    return redirect('/login')->withErrors([
                        'email' => 'Akun Anda telah dibanned.',
                    ]);
                }

                // Jika tidak dibanned, lanjut ke halaman tujuan
                return redirect()->intended('/');
            }

            // Kalau gagal login
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }


    // Proses logout
    public function logout(Request $request)
    {
        auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
