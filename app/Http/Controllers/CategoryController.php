<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display list of categories
     */
    public function index()
    {
        $categories = Category::withCount('activeProducts')->get();
        return view('public.categories.index', compact('categories'));
    }

    /**
     * Display single category and its products
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->activeProducts()->latest()->paginate(9);

        return view('public.categories.show', compact('category', 'products'));
    }
}
