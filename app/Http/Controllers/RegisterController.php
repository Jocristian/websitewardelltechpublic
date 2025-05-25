<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
        {
            $request->validate([
                'name'         => 'required|string|max:20',
                'email'        => 'required|email|unique:users',
                'password'     => 'required|string|min:8',
                'phone_number' => 'required|numeric',
                'role'         => 'required|string'
            ]);

            $user = new User();
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->password     = Hash::make($request->password);
            $user->phone_number = $request->phone_number;
            $user->role         = $request->role;
            $user->save();

            // Kirim email verifikasi
            event(new Registered($user));

            Auth::login($user);

            // lalu kirim email verifikasi
            event(new Registered($user));

            // redirect ke halaman verifikasi
            return redirect()->route('verification.notice');

            // Tidak login langsung (kamu sengaja menonaktifkan login otomatis)

            // Redirect ke halaman verifikasi email (ini akan error kalau tidak login)
            return redirect()->route('login')->with('message', 'Registration successful. Please check your email and verify your account.');
        }
}


