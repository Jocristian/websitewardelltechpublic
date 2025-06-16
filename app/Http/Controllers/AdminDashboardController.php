<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Service;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{

    public function index()
    {
        // 1. total number of services
        $servicesCount = Service::count();

        // 2. total orders
        $ordersCount = Order::count();

        // 3. total earnings (sum of service prices for all finished orders)
        $earnings = DB::table('orders')
            ->join('services', 'orders.service_id', '=', 'services.service_id')
            ->where('orders.status', 'finished')
            ->sum('services.price');

        // 4. top 5 services by order volume (all sellers)
        $topServices = Order::join('services', 'orders.service_id', '=', 'services.service_id')
            ->selectRaw('services.overview, COUNT(*) as total')
            ->where('orders.status', '!=', 'pending')
            ->groupBy('services.overview')
            ->orderByDesc('total')
            ->take(5)
            ->pluck('total', 'services.overview');

        // 5. monthly earnings across all sellers
        $monthlyEarnings = Order::join('services', 'orders.service_id', '=', 'services.service_id')
            ->selectRaw('MONTH(orders.created_at) as month, SUM(services.price) as total')
            ->where('orders.status', 'finished')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $monthLabels = $monthlyEarnings->keys()->map(fn($m) =>
            \Carbon\Carbon::create()->month($m)->format('M')
        );

        // 6. orders per status (excluding pending)
        $orderStats = Order::whereIn('status', ['on progress', 'finished'])
            ->with('service')
            ->get();


        return view('sections.admindashboard', compact(
            'servicesCount',
            'ordersCount',
            'earnings',
            'topServices',
            'monthlyEarnings',
            'monthLabels',
            'orderStats'
        ));
    }
};

