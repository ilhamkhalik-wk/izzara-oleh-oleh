<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Show order form for customers
     */
    public function create(Request $request)
    {
        $products = Product::active()->where('stock', '>', 0)->orderBy('name')->get();
        $selectedProductId = $request->query('product_id');

        $currentUser = Auth::user();

        return view('public.orders.create', compact('products', 'selectedProductId', 'currentUser'));
    }

    /**
     * Store new customer order with server-side validations (min 3 rules)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'required|email|max:100',
            'shipping_address' => 'required|string|max:500',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:100',
            'payment_method' => 'required|string|in:transfer_bca,transfer_mandiri,transfer_bri,qris,cod',
            'notes' => 'nullable|string|max:500',
        ], [
            'customer_name.required' => 'Nama lengkap wajib diisi.',
            'customer_name.max' => 'Nama lengkap maksimal 100 karakter.',
            'customer_phone.required' => 'Nomor WhatsApp wajib diisi.',
            'customer_email.required' => 'Alamat email wajib diisi.',
            'customer_email.email' => 'Format email harus valid.',
            'shipping_address.required' => 'Alamat pengiriman lengkap wajib diisi.',
            'shipping_address.max' => 'Alamat pengiriman maksimal 500 karakter.',
            'product_id.required' => 'Silakan pilih produk yang ingin dipesan.',
            'product_id.exists' => 'Produk yang dipilih tidak ditemukan.',
            'quantity.required' => 'Jumlah pembelian wajib diisi.',
            'quantity.integer' => 'Jumlah pembelian harus berupa angka bulat.',
            'quantity.min' => 'Jumlah pembelian minimal 1 item.',
            'payment_method.required' => 'Silakan pilih metode pembayaran.',
            'payment_method.in' => 'Metode pembayaran tidak valid.',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->stock < $validated['quantity']) {
            return back()->withInput()->withErrors([
                'quantity' => "Maaf, stok produk {$product->name} tersisa {$product->stock} item.",
            ]);
        }

        // Generate Order Code
        $orderCode = 'IZR-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        $subtotal = $product->price * $validated['quantity'];
        $totalAmount = $subtotal;

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_code' => $orderCode,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'],
            'shipping_address' => $validated['shipping_address'],
            'payment_method' => $validated['payment_method'],
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'unit_price' => $product->price,
            'subtotal' => $subtotal,
        ]);

        // Decrement stock
        $product->decrement('stock', $validated['quantity']);

        return redirect()->route('orders.success', $order->order_code)
            ->with('success', 'Pesanan Anda telah berhasil dibuat!');
    }

    /**
     * Show order confirmation/success page
     */
    public function success($order_code)
    {
        $order = Order::with('items.product')->where('order_code', $order_code)->firstOrFail();
        return view('public.orders.success', compact('order'));
    }
}
