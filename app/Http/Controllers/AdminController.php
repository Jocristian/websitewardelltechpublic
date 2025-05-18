<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get(); // tampilkan semua user non-admin
        return view('sections.users', compact('users'));
    }

    public function ban($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = true;
        $user->save();

        return redirect()->route('sections.users')->with('success', 'User berhasil diban.');
    }
}

