<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{

    // public function show($service_id) {
    //     $services = Service::where('service_id', $service_id)->firstOrFail();
    //     return view('pages.orderdetail', compact('services'));
    // }
    
//     public function submitRequirements(Request $request, $id)
// {
//     $order = Order::findOrFail($id);
//     $order->requirements = $request->input('requirements');
//     $order->status = 'on progress';
//     $order->save(); 

//     return redirect()->back()->with('success', 'Requirements submitted successfully!');
// }

    public function submit(Request $request, $serviceId)
{
    // Validate input
    $request->validate([
        'requirements' => 'required|string|max:2500',
    ]);

    // Insert into database
    $order = new Order();
    $order->buyer_id = auth()->id(); // assuming you're using auth
    $order->seller_id = $request->seller_id;
    $order->deadline = Carbon::now()->addDays(7);
    $order->service_id = $request->service_id;
    $order->details = $request->requirements;
    $order->status = 'on progress'; // or whatever status
    $order->save();

    // Redirect back to the same page but with success message
    return redirect()->route('service.show', ['service_id' => $serviceId])
                     ->with('success', 'Order submitted successfully.');
}


    public function show($service_id)
{
    $service = Service::with('user')->where('service_id', $service_id)->firstOrFail();
    return view('pages.orderdetail', compact('service'));
}

public function mytransactions()
{
    $user = Auth::user();

    if ($user->role === 'freelancer') {
        // Seller's orders
        $order = Order::with(['service', 'service.user'])
                    ->where('seller_id', $user->id)
                    ->get();

        return view('sections.mytransactions', compact('order'));
    }

    if ($user->role === 'customer') {
        // Buyer's orders
        $order = Order::with(['service', 'service.user'])
                    ->where('buyer_id', $user->id)
                    ->get();

        return view('sections.mytransactions', compact('order'));
    }

    abort(403, 'Unauthorized');
}
    


    public function updateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $order->status = $request->input('status');
    $order->save();

    return back()->with('success', 'Order status updated.');
}


public function submitReview(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $order->rating = $request->input('rating');
    $order->review = $request->input('review');
    $order->save();

    return back()->with('success', 'Thank you for your review!');
}



    public function showid($id) {

    $service = Service::with('user')->where('service_id', $id)->firstOrFail(); // ambil service + relasi user
    return view('pages.orderdetail', compact('service'));
}

    

    

}
