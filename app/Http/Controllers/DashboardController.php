<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Service;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // In App\Models\Order.php
    public function scopeWithoutPending($query)
    {
        return $query->where('status', '!=', 'pending');
    }

    public function index()
{
    $user = Auth::user();

    // Example metrics
    $servicesCount = Service::where('user_id', $user->id)->count();
    $ordersAsBuyer = Order::where('buyer_id', $user->id)->count();
    $ordersAsSeller = Order::where('seller_id', $user->id)
    ->where('status', '!=', 'pending')
    ->count();

    

    $earnings = DB::table('orders')
        ->join('services', 'orders.service_id', '=', 'services.service_id')
        ->where('orders.seller_id', $user->id)
        ->where('orders.status', 'finished')
        ->sum('services.price');

    $topServices = Order::join('services', 'orders.service_id', '=', 'services.service_id')
    ->selectRaw('services.overview, COUNT(*) as total')
    ->where('orders.seller_id', auth()->id())
    ->where('orders.status', '!=', 'pending')
    ->groupBy('services.overview')
    ->orderByDesc('total')
    ->take(5)
    ->pluck('total', 'services.overview');

    $monthlyEarnings = Order::join('services', 'orders.service_id', '=', 'services.service_id')
    ->selectRaw('MONTH(orders.created_at) as month, SUM(services.price) as total')
    ->where('orders.seller_id', auth()->id())
    ->where('orders.status', 'finished')
    ->groupBy('month')
    ->orderBy('month')
    ->pluck('total', 'month');

    $monthlyEarnings = Order::join('services', 'orders.service_id', '=', 'services.service_id')
    ->selectRaw('MONTH(orders.created_at) as month, SUM(services.price) as total')
    ->where('orders.seller_id', auth()->id())
    ->where('orders.status', 'finished')
    ->groupBy('month')
    ->orderBy('month')
    ->pluck('total', 'month');

    // Format labels like "Jan", "Feb"
    $monthLabels = $monthlyEarnings->keys()->map(function ($m) {
        return \Carbon\Carbon::create()->month($m)->format('M');
    });

    // Orders per status for pie/bar chart
    $orderStats = Order::selectRaw('status, COUNT(*) as count')
    ->where('seller_id', $user->id)
    ->where('status', '!=', 'pending')
    ->groupBy('status')
    ->pluck('count', 'status');


    return view('sections.dashboard', compact(
        'servicesCount',
        'ordersAsBuyer',
        'ordersAsSeller',
        'earnings',
        'orderStats',
        'topServices',
        'monthlyEarnings',
        'monthLabels',
    ));
}
}

