<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller

{
    public function register(Request $request){
        $request ->validate ([
        
            'name' => 'required|string|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|numeric',
            'role' => 'required|string'
        ]);

        
        $user = new User();
        $user -> name = $request -> name;
        $user -> email = $request -> email;
        $user -> password = $request -> password;
        $user -> phone_number = $request -> phone_number;
        $user -> role = $request -> role;

        $user -> save();
        return redirect() -> route('login');
    }

}
