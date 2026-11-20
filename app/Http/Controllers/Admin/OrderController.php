<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display order list
     */
    public function index(Request $request)
    {
        $query = Order::with('items.product');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_code', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show create order form (manual order by admin)
     */
    public function create()
    {
        $products = Product::active()->where('stock', '>', 0)->orderBy('name')->get();
        return view('admin.orders.create', compact('products'));
    }

    /**
     * Store order created by admin
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'required|email|max:100',
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'required|string',
            'status' => 'required|string|in:pending,processing,shipped,completed,cancelled',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->stock < $validated['quantity']) {
            return back()->withInput()->withErrors([
                'quantity' => "Stok produk tidak mencukupi (sisa: {$product->stock}).",
            ]);
        }

        $orderCode = 'IZR-' . date('Ymd') . '-' . strtoupper(Str::random(4));
        $subtotal = $product->price * $validated['quantity'];

        $order = Order::create([
            'order_code' => $orderCode,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'],
            'shipping_address' => $validated['shipping_address'],
            'payment_method' => $validated['payment_method'],
            'total_amount' => $subtotal,
            'status' => $validated['status'],
            'notes' => $validated['notes'] ?? null,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'unit_price' => $product->price,
            'subtotal' => $subtotal,
        ]);

        $product->decrement('stock', $validated['quantity']);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Pesanan berhasil dibuat secara manual!');
    }

    /**
     * Show order details
     */
    public function show(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
        ]);

        $oldStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        // If cancelled, restore stock
        if ($request->status === 'cancelled' && $oldStatus !== 'cancelled') {
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->increment('stock', $item->quantity);
                }
            }
        }

        return back()->with('success', 'Status pesanan ' . $order->order_code . ' berhasil diubah menjadi ' . ucfirst($request->status) . '!');
    }

    /**
     * Delete order
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')
            ->with('success', 'Pesanan berhasil dihapus!');
    }
}
