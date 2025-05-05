<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\User;
use App\Models\Order;

class ServiceController extends Controller
{

    public function myServices() {
        $services = Service::where('user_id', auth()->id())->get(); // Fetch services of the authenticated user
        return view('sections.myservices', compact('services')); // Pass 'services' to the view
    }
        public function showAllFreelancerServices(Request $request)
        {
            $query = Service::with('user', 'ordersWithReview')
                ->whereHas('user', function ($q) {
                    $q->where('role', 'freelancer');
                });

            // Search filter
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('overview', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%');
                });
            }

            // Category filter
            if ($request->filled('categories')) {
                $query->whereIn('category', $request->categories);
            }

            // We'll fetch and attach reviews/ratings later
            $services = $query->get();

            // Attach rating info and filter after data is fetched
            $services = $services->filter(function ($service) use ($request) {
                $ratings = $service->ordersWithReview;
                $service->average_rating = $ratings->avg('rating') ?? 0;
                $service->rating_count = $ratings->count();

                // Filter by rating (min value)
                if ($request->filled('min_rating') && $service->average_rating < $request->min_rating) {
                    return false;
                }

                // Filter by minimum review count
                if ($request->filled('min_reviews') && $service->rating_count < $request->min_reviews) {
                    return false;
                }

                return true;
            });

            // Get distinct categories for the filter UI
            $allCategories = Service::distinct()->pluck('category');

            return view('pages.services', compact('services', 'allCategories'));
        }        
        
        public function show($service_id) {
            $services = Service::where('service_id', $service_id)->firstOrFail(); // Get the service by ID
            $user_id = $services->user_id; // Get the user ID from the service
            $user = User::find($user_id); // Get the user by ID
            return view('pages.servicesdetail', compact('services', 'user')); // Pass 'services' and 'user' to the view
        }
    
    //     public function showid($id) {

    //     $service = Service::with('user')->findOrFail($id); // ambil service + relasi user
    //     return view('services.show', compact('service'));
    // }

    public function update(Request $request, $service_id)
        {
            $services = Service::where('service_id', $service_id)->firstOrFail();

            $services->price = $request->price;
            $services->overview = $request->overview;
            $services->description = $request->description;
            $services->category = $request->category;

            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('services', 'public');
                $services->photo = $path; // ✅ Corrected variable
            }

            $services->save();

            return redirect()->back()->with('success', 'Service updated successfully!');
        }





}
