<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ContactMessage;

class HomeController extends Controller
{
    /**
     * Display landing page
     */
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->active()
            ->featured()
            ->latest()
            ->take(6)
            ->get();

        $latestProducts = Product::with('category')
            ->active()
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::withCount('activeProducts')
            ->get();

        $stats = [
            'products' => Product::active()->count(),
            'categories' => Category::count(),
            'satisfied_customers' => 1500,
            'local_partners' => 25,
        ];

        return view('public.home', compact('featuredProducts', 'latestProducts', 'categories', 'stats'));
    }

    /**
     * Display about page
     */
    public function about()
    {
        return view('public.about');
    }

    /**
     * Display contact page
     */
    public function contact()
    {
        return view('public.contact');
    }

    /**
     * Handle contact form submission with server-side validation
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:1500',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap maksimal 100 karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'subject.required' => 'Subjek pesan wajib diisi.',
            'subject.max' => 'Subjek maksimal 150 karakter.',
            'message.required' => 'Isi pesan wajib diisi.',
            'message.max' => 'Isi pesan maksimal 1500 karakter.',
        ]);

        ContactMessage::create($validated);

        return redirect()->route('contact')->with('success', 'Terima kasih! Pesan Anda telah berhasil dikirim. Tim IZZARA akan segera menghubungi Anda.');
    }
}
