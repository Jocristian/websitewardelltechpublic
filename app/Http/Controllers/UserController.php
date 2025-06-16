<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function listFreelancers()
    {
        $freelancers = User::where('role', 'freelancer')
                            ->whereNotNull('email_verified_at') // only verified users
                            ->get();

        return view('pages.freelancers', compact('freelancers'));
    }

    // In UserController.php
    public function listFreelancersIndex()
        {
            $freelancers = User::where('role', 'freelancer')
                            ->whereNotNull('email_verified_at') // only verified users
                            ->get();

            return view('pages.home', compact('freelancers'));
        }




    public function index($id)
        {
            $user = User::find($id);
            return view('pages/my-profile', compact('user'));
        }

}