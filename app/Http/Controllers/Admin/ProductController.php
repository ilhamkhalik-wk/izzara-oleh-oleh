<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display product list
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('product_code', 'like', "%{$search}%");
            });
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show create product form
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store new product with strict server-side validation (wajib diisi, tipe data, maksimal karakter)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'product_code' => 'required|string|max:50|unique:products,product_code',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'weight' => 'required|integer|min:1|max:100000',
            'description' => 'required|string|max:3000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'required|boolean',
            'is_featured' => 'required|boolean',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'name.string' => 'Nama produk harus berupa karakter teks.',
            'name.max' => 'Nama produk maksimal 150 karakter.',
            'product_code.required' => 'Kode produk wajib diisi.',
            'product_code.string' => 'Kode produk harus berupa karakter teks.',
            'product_code.max' => 'Kode produk maksimal 50 karakter.',
            'product_code.unique' => 'Kode produk ini sudah digunakan.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus bertipe angka (numerik).',
            'price.min' => 'Harga produk tidak boleh bernilai negatif.',
            'stock.required' => 'Jumlah stok produk wajib diisi.',
            'stock.integer' => 'Stok produk harus bertipe bilangan bulat (integer).',
            'stock.min' => 'Stok produk minimal 0.',
            'weight.required' => 'Berat produk wajib diisi.',
            'weight.integer' => 'Berat produk harus bertipe angka bulat dalam gram.',
            'weight.min' => 'Berat produk minimal 1 gram.',
            'description.required' => 'Deskripsi produk wajib diisi.',
            'description.string' => 'Deskripsi produk harus berupa karakter teks.',
            'description.max' => 'Deskripsi produk maksimal 3000 karakter.',
            'image.image' => 'File yang diupload harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diperbolehkan adalah jpeg, png, jpg, atau webp.',
            'image.max' => 'Ukuran file gambar maksimal 2048 KB (2 MB).',
            'is_active.required' => 'Status keaktifan produk wajib ditentukan.',
            'is_featured.required' => 'Status produk unggulan wajib ditentukan.',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::lower(Str::random(4));

        // Handle image upload to storage/public
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk baru berhasil ditambahkan!');
    }

    /**
     * Show edit product form
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update product
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'product_code' => 'required|string|max:50|unique:products,product_code,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'weight' => 'required|integer|min:1|max:100000',
            'description' => 'required|string|max:3000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'required|boolean',
            'is_featured' => 'required|boolean',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'name.string' => 'Nama produk harus berupa teks.',
            'name.max' => 'Nama produk maksimal 150 karakter.',
            'product_code.required' => 'Kode produk wajib diisi.',
            'product_code.unique' => 'Kode produk ini sudah digunakan.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga harus bertipe angka.',
            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok harus berupa bilangan bulat.',
            'weight.required' => 'Berat produk wajib diisi.',
            'description.required' => 'Deskripsi produk wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 2048 KB.',
        ]);

        if ($product->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']) . '-' . Str::lower(Str::random(4));
        }

        // Handle image replacement or retention
        if ($request->hasFile('image')) {
            $defaultSeedImages = [
                'products/keripik-pisang.jpg',
                'products/lapis-legit.jpg',
                'products/kopi-lokal.jpg',
                'products/sambal-khas.jpg',
                'products/sale-pisang.jpg',
                'products/keripik-singkong.jpg',
                'products/dodol-garut.jpg',
                'products/dompet-batik.jpg',
                'products/gantungan-kunci.jpg',
            ];

            // Delete old custom image if exists and not one of the default seeders
            if ($product->image && !in_array($product->image, $defaultSeedImages) && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        } else {
            // CRITICAL: Do NOT overwrite image with null when no new file is uploaded!
            // Retain the existing image in the database.
            unset($validated['image']);
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Data produk berhasil diperbarui!');
    }

    /**
     * Delete product
     */
    public function destroy(Product $product)
    {
        // Check order history
        if ($product->orderItems()->count() > 0) {
            return back()->with('error', 'Produk tidak dapat dihapus karena telah memiliki riwayat transaksi/pesanan. Anda dapat mengubah statusnya menjadi Tidak Aktif.');
        }

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
