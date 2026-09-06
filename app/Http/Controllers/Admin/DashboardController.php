<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->take(10)->get();

        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'revenue' => Order::where('payment_status', 'paid')->sum('total_amount'),
            'pending_orders' => Order::where('order_status', 'pending')->count(),
            'paid_orders' => Order::where('payment_status', 'paid')->count(),
            'monthly_revenue' => Order::where('payment_status', 'paid')
                ->whereMonth('paid_at', now()->month)
                ->whereYear('paid_at', now()->year)
                ->sum('total_amount'),
        ];

        return view('admin.dashboard', compact('orders', 'stats'));
    }
}
