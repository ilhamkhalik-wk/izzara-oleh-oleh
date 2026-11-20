<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard overview
     */
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_amount');
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        $recentOrders = Order::with('items.product')->latest()->take(5)->get();
        $lowStockProducts = Product::where('stock', '<=', 15)->latest()->take(5)->get();
        $recentMessages = ContactMessage::latest()->take(4)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalOrders',
            'totalRevenue',
            'unreadMessages',
            'recentOrders',
            'lowStockProducts',
            'recentMessages'
        ));
    }
}
