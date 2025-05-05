<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function listFreelancers()
        {
            $freelancers = User::where('role', 'freelancer')->get();
            return view('pages.freelancers', compact('freelancers'));
        }
    public function index($id)
        {
            $user = User::find($id);
            return view('pages/my-profile', compact('user'));
        }

}