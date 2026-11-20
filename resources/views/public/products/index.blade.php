@extends('layouts.app')

@section('title', 'Katalog Oleh-Oleh Khas Daerah')

@section('content')
<!-- Header Banner -->
<div class="py-4 border-bottom" style="background: linear-gradient(135deg, #FAF4EB, #F0E6D8);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--brand-primary);"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Katalog Produk</li>
            </ol>
        </nav>
        <h1 class="font-serif fw-bold mb-1" style="color: var(--brand-primary);">Katalog Produk Oleh-Oleh</h1>
        <p class="text-muted mb-0">Temukan pilihan jajanan, kue tradisional, kopi nusantara, dan souvenir khas daerah terbaik.</p>
    </div>
</div>

<div class="container py-5">
    <!-- Filter & Search Toolbar -->
    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4" style="background-color: #FFFFFF;">
        <form action="{{ route('products.index') }}" method="GET" class="row g-3 align-items-center">
            <!-- Search Input -->
            <div class="col-lg-4 col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-start-0" placeholder="Cari nama atau kode produk..." value="{{ request('search') }}">
                </div>
            </div>

            <!-- Category Filter Dropdown -->
            <div class="col-lg-3 col-md-6">
                <select name="category" class="form-select bg-light">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                            {{ $cat->name }} ({{ $cat->active_products_count }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sort Dropdown -->
            <div class="col-lg-3 col-md-6">
                <select name="sort" class="form-select bg-light">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Urutkan: Terbaru</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Terendah ke Tertinggi</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tertinggi ke Terendah</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama: A - Z</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="col-lg-2 col-md-6 d-flex gap-2">
                <button type="submit" class="btn btn-brand-primary w-100">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                @if(request()->hasAny(['search', 'category', 'sort']))
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary" title="Reset Filter">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Active Filter Badges -->
    @if(request('category') || request('search'))
        <div class="d-flex align-items-center gap-2 mb-4 flex-wrap">
            <span class="small text-muted">Filter aktif:</span>
            @if(request('category'))
                <span class="badge bg-white text-dark border p-2">
                    Kategori: <strong>{{ $selectedCategory->name ?? request('category') }}</strong>
                    <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="text-danger ms-1 text-decoration-none"><i class="bi bi-x-circle-fill"></i></a>
                </span>
            @endif
            @if(request('search'))
                <span class="badge bg-white text-dark border p-2">
                    Pencarian: <strong>"{{ request('search') }}"</strong>
                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="text-danger ms-1 text-decoration-none"><i class="bi bi-x-circle-fill"></i></a>
                </span>
            @endif
        </div>
    @endif

    <!-- Product Grid -->
    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-xl-4 col-md-6">
            <div class="product-card">
                <div class="img-wrapper">
                    @if($product->is_featured)
                        <span class="badge-featured"><i class="bi bi-star-fill me-1"></i> Unggulan</span>
                    @endif
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                </div>
                <div class="p-4 d-flex flex-column flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge-category">{{ $product->category->name }}</span>
                        <span class="small text-muted"><i class="bi bi-upc-scan me-1"></i>{{ $product->product_code }}</span>
                    </div>

                    <h5 class="fw-bold mb-2 font-serif">
                        <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">
                            {{ $product->name }}
                        </a>
                    </h5>

                    <p class="small text-muted mb-3 flex-grow-1">
                        {{ Str::limit($product->description, 95) }}
                    </p>

                    <div class="row g-2 small text-muted mb-3 py-2 border-top border-bottom">
                        <div class="col-6">
                            <i class="bi bi-box me-1"></i> Berat: <strong>{{ $product->weight }} gram</strong>
                        </div>
                        <div class="col-6 text-end">
                            <i class="bi bi-check2-circle me-1 text-success"></i> Stok: <strong>{{ $product->stock }} item</strong>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between pt-1">
                        <div>
                            <small class="text-muted d-block" style="font-size: 0.75rem;">Harga</small>
                            <span class="price-tag">{{ $product->formatted_price }}</span>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-secondary btn-sm" title="Lihat Rincian">
                                <i class="bi bi-info-circle me-1"></i> Detail
                            </a>
                            <a href="{{ route('orders.create', ['product_id' => $product->id]) }}" class="btn btn-brand-gold btn-sm">
                                <i class="bi bi-bag-plus me-1"></i> Pesan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm p-5 text-center rounded-4">
                <i class="bi bi-emoji-neutral fs-1 text-muted mb-3"></i>
                <h4 class="fw-bold font-serif" style="color: var(--brand-primary);">Produk Tidak Ditemukan</h4>
                <p class="text-muted mb-4">Mohon maaf, tidak ada produk oleh-oleh yang sesuai dengan kriteria pencarian Anda.</p>
                <div>
                    <a href="{{ route('products.index') }}" class="btn btn-brand-primary">
                        <i class="bi bi-arrow-left me-1"></i> Reset Pencarian
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
