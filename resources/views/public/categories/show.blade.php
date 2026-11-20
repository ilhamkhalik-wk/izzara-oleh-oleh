@extends('layouts.app')

@section('title', 'Kategori: ' . $category->name)

@section('content')
<div class="py-4 border-bottom" style="background: linear-gradient(135deg, #FAF4EB, #F0E6D8);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--brand-primary);"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}" class="text-decoration-none" style="color: var(--brand-primary);">Kategori</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: var(--brand-primary); color: #FFF;">
                <i class="bi {{ $category->icon }} fs-3 text-warning"></i>
            </div>
            <div>
                <h1 class="font-serif fw-bold mb-0" style="color: var(--brand-primary);">{{ $category->name }}</h1>
                <p class="text-muted mb-0 small">{{ $category->description }}</p>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-lg-4 col-md-6">
            <div class="product-card">
                <div class="img-wrapper">
                    @if($product->is_featured)
                        <span class="badge-featured"><i class="bi bi-star-fill me-1"></i> Unggulan</span>
                    @endif
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                </div>
                <div class="p-4 d-flex flex-column flex-grow-1">
                    <h5 class="fw-bold mb-2 font-serif">
                        <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">
                            {{ $product->name }}
                        </a>
                    </h5>
                    <p class="small text-muted mb-3 flex-grow-1">{{ Str::limit($product->description, 90) }}</p>
                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                        <span class="price-tag">{{ $product->formatted_price }}</span>
                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm btn-brand-primary">
                            Detail & Pesan
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Belum ada produk dalam kategori ini.</p>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
