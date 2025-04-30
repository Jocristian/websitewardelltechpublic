<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

        public function myServices() {
            $services = Service::where('user_id', auth()->id())->get(); // jika hanya milik user aktif
            return view('sections.myservices', compact('services'));
}
        public function showAllFreelancerServices()
        {
            $services = Service::with('user') // eager load related user
                ->whereHas('user', function ($query) {
                    $query->where('role', 'freelancer');
                })
                ->get();

            return view('pages.services', compact('services'));
}

}
