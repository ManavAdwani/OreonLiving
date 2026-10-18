<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalRevenue = (float) Order::whereIn('order_status', ['confirmed', 'processing', 'shipped', 'delivered'])->sum('total');
        $ordersCount = Order::count();
        $deliveredCount = Order::where('order_status', 'delivered')->count();
        $pendingOrders = Order::where('order_status', 'pending')->count();
        $totalCustomers = User::where('role', 'customer')->count();
        
        $avgOrderValue = $ordersCount > 0 ? ($totalRevenue / max(1, Order::whereIn('order_status', ['confirmed', 'processing', 'shipped', 'delivered'])->count())) : 0.0;

        $lowStockProducts = Product::whereColumn('stock', '<=', 'low_stock_threshold')
            ->where('status', 'published')
            ->get();

        $recentOrders = Order::latest()->take(6)->get();
        $recentLogs = ActivityLog::latest()->take(8)->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'ordersCount',
            'deliveredCount',
            'pendingOrders',
            'totalCustomers',
            'avgOrderValue',
            'lowStockProducts',
            'recentOrders',
            'recentLogs'
        ));
    }
}
