<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;

class DashboardController extends Controller
{
    /**
     * Customer Dashboard Overview
     */
    public function index()
    {
        $user = Auth::user();

        // Get user's orders (by user_id or matching customer_email)
        $ordersQuery = Order::with('items.product')
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere('customer_email', $user->email);
            });

        $totalOrders = (clone $ordersQuery)->count();
        $processingOrders = (clone $ordersQuery)->whereIn('status', ['pending', 'processing', 'shipped'])->count();
        $completedOrders = (clone $ordersQuery)->where('status', 'completed')->count();
        $totalSpent = (clone $ordersQuery)->where('status', '!=', 'cancelled')->sum('total_amount');

        $recentOrders = (clone $ordersQuery)->latest()->take(5)->get();

        return view('customer.dashboard', compact(
            'user',
            'totalOrders',
            'processingOrders',
            'completedOrders',
            'totalSpent',
            'recentOrders'
        ));
    }

    /**
     * Customer Orders History
     */
    public function orders(Request $request)
    {
        $user = Auth::user();

        $query = Order::with('items.product')
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere('customer_email', $user->email);
            });

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        return view('customer.orders', compact('orders'));
    }

    /**
     * Customer Order Detail
     */
    public function orderDetail($order_code)
    {
        $user = Auth::user();

        $order = Order::with('items.product')
            ->where('order_code', $order_code)
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere('customer_email', $user->email);
            })
            ->firstOrFail();

        return view('customer.order_detail', compact('order'));
    }

    /**
     * Customer Profile Form
     */
    public function profile()
    {
        $user = Auth::user();
        return view('customer.profile', compact('user'));
    }

    /**
     * Update Customer Profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'address.required' => 'Alamat pengiriman wajib diisi.',
            'new_password.min' => 'Password baru minimal 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
        ]);

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->name = $validated['name'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->save();

        return back()->with('success', 'Profil dan informasi akun Anda berhasil diperbarui!');
    }
}
