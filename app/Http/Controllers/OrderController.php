<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Midtrans\Snap;
use Midtrans\Transaction;
use Midtrans\Config;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

\Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
\Midtrans\Config::$clientKey = env('MIDTRANS_CLIENT_KEY'); // optional
\Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

class OrderController extends Controller
{

    public function quickCreate(Request $request, $service_id)
{
    $service = Service::with('user')->where('service_id', $service_id)->firstOrFail();

    $order = new Order();
    $order->buyer_id = auth()->id();
    $order->seller_id = $service->user_id;
    $order->service_id = $service_id;
    $order->deadline = Carbon::now()->addDays(7);
    $order->status = 'pending';
    $order->details = '';
    $order->save();

        return redirect()->route('order.showid', [
        'service_id' => $service_id,
        'order_id' => $order->id
    ]);

}


   public function payWithMidtrans($service_id, $order_id)
{
    $order = Order::with('service', 'buyer')
        ->where('id', $order_id)
        ->where('service_id', $service_id)
        ->firstOrFail();

    $params = [
        'transaction_details' => [
            'order_id' => 'ORDER-' . $order->id,
            'gross_amount' => $order->service->price,
        ],
        'customer_details' => [
            'first_name' => $order->buyer->name,
            'email' => $order->buyer->email,
        ],
        
    ];

    $snapToken = Snap::getSnapToken($params);

    return response()->json(['snapToken' => $snapToken]);
}

    public function submit(Request $request, $serviceId)
{
    $request->validate([
        'requirements' => 'required|string|max:2500',
    ]);

    // Cari service berdasarkan ID
    $service = Service::with('user')->where('service_id', $serviceId)->firstOrFail();

    $order = new Order();
    $order->buyer_id = auth()->id();
    $order->seller_id = $service->user_id; // ← Ambil dari relasi
    $order->deadline = Carbon::now()->addDays(7);
    $order->service_id = $serviceId;
    $order->details = $request->requirements;
    $order->status = 'on progress';
    $order->save();

    return redirect()->route('service.show', ['service_id' => $serviceId])
                     ->with('success', 'Order berhasil dikirim.');
}




    public function show($service_id)
{
    $service = Service::with('user')->where('service_id', $service_id)->firstOrFail();
    return view('pages.orderdetail', compact('service'));
}

 public function showquick($service_id)
{
    $service = Service::with('user')->where('service_id', $service_id)->firstOrFail();
    return view('order.quickCreate', compact('service'));
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

    // Pastikan hanya pemilik order yang bisa update

    if ($request->has('delete_review')) {
        $order->rating = null;
        $order->review = null;
        $order->save();

        return redirect()->back()->with('success', 'Review deleted.');
    }

    // Validasi jika tidak menghapus
    $validated = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'required|string|max:1000',
    ]);

    $order->rating = $validated['rating'];
    $order->review = $validated['review'];
    $order->save();

    return redirect()->back()->with('success', 'Review updated.');
}



public function submitReview(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $order->rating = $request->input('rating');
    $order->review = $request->input('review');
    $order->save();

    return back()->with('success', 'Thank you for your review!');
}



    public function showid($service_id, $order_id)
{
    // Find the order that matches both the order_id and belongs to the given service_id
    $order = Order::with(['service.user', 'buyer'])
        ->where('id', $order_id)
        ->where('service_id', $service_id)
        ->firstOrFail();

    return view('pages.orderdetail', compact('order'));
}

public function deleteReview($id)
{
    $order = Order::findOrFail($id);

    // Pastikan user hanya bisa menghapus review miliknya
    

    $order->rating = null;
    $order->review = null;
    $order->save();

    return redirect()->back()->with('success', 'Review deleted successfully.');
}


    

    

    

}
