@extends('layouts.app')

@section('title', 'Kategori Oleh-Oleh Khas Daerah')

@section('content')
<div class="py-4 border-bottom" style="background: linear-gradient(135deg, #FAF4EB, #F0E6D8);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--brand-primary);"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kategori Produk</li>
            </ol>
        </nav>
        <h1 class="font-serif fw-bold mb-1" style="color: var(--brand-primary);">Kategori Oleh-Oleh</h1>
        <p class="text-muted mb-0">Eksplorasi ragam kekayaan kuliner dan cinderamata daerah berdasarkan kategori favorit Anda.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        @foreach($categories as $category)
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 transition" style="background-color: #FFFFFF; border-left: 5px solid var(--brand-primary) !important;">
                <div class="d-flex align-items-start gap-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 75px; height: 75px; background-color: var(--brand-cream); color: var(--brand-primary);">
                        <i class="bi {{ $category->icon }} fs-1"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4 class="font-serif fw-bold mb-0" style="color: var(--brand-primary);">{{ $category->name }}</h4>
                            <span class="badge bg-warning bg-opacity-25 text-dark fw-bold px-3 py-1 rounded-pill">
                                {{ $category->active_products_count }} Produk
                            </span>
                        </div>
                        <p class="text-muted small mb-3">
                            {{ $category->description }}
                        </p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="btn btn-brand-primary btn-sm px-3">
                                <i class="bi bi-grid me-1"></i> Lihat Semua Produk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
