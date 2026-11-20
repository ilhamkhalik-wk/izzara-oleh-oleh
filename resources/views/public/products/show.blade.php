@extends('layouts.app')

@section('title', $product->name . ' - Detail Produk')

@section('content')
<!-- Breadcrumbs -->
<div class="py-3 border-bottom" style="background-color: #FAF4EB;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--brand-primary);"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none" style="color: var(--brand-primary);">Katalog Produk</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="text-decoration-none" style="color: var(--brand-primary);">{{ $product->category->name }}</a></li>
                <li class="breadcrumb-item active text-truncate" style="max-width: 250px;" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-5">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5" style="background-color: #FFFFFF;">
        <div class="row g-0">
            <!-- Product Photo -->
            <div class="col-lg-6 border-end">
                <div class="p-4 p-md-5 d-flex align-items-center justify-content-center h-100" style="background-color: #FAF6F0; min-height: 420px;">
                    <div class="position-relative text-center w-100">
                        @if($product->is_featured)
                            <span class="badge-featured" style="top: 0; left: 0;"><i class="bi bi-star-fill me-1"></i> Produk Unggulan</span>
                        @endif
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded-4 shadow-sm" style="max-height: 380px; width: 100%; object-fit: cover;">
                        <div class="mt-3 text-muted small">
                            <i class="bi bi-shield-check text-success me-1"></i> 100% Produk Asli &bull; Disimpan di Storage Resmi
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Info Details -->
            <div class="col-lg-6">
                <div class="p-4 p-md-5 d-flex flex-column h-100">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="badge-category text-decoration-none">
                            <i class="bi {{ $product->category->icon }} me-1"></i> {{ $product->category->name }}
                        </a>
                        <span class="badge bg-light text-secondary border">Kode: {{ $product->product_code }}</span>
                    </div>

                    <h1 class="font-serif fw-bold mb-3" style="color: var(--brand-primary); font-size: 2.2rem;">
                        {{ $product->name }}
                    </h1>

                    <!-- Price Box -->
                    <div class="p-3 rounded-3 mb-4 d-flex align-items-center justify-content-between" style="background-color: #FAF4EB; border-left: 4px solid var(--brand-gold);">
                        <div>
                            <small class="text-muted d-block">Harga Satuan</small>
                            <span class="price-tag fs-2">{{ $product->formatted_price }}</span>
                        </div>
                        <div class="text-end">
                            @if($product->stock > 0)
                                <span class="badge bg-success px-3 py-2 fs-6"><i class="bi bi-check-circle me-1"></i> Stok: {{ $product->stock }} item</span>
                            @else
                                <span class="badge bg-danger px-3 py-2 fs-6"><i class="bi bi-x-circle me-1"></i> Stok Habis</span>
                            @endif
                        </div>
                    </div>

                    <!-- Specs Table -->
                    <div class="row g-2 mb-4 small">
                        <div class="col-sm-6">
                            <div class="p-2 border rounded bg-light">
                                <span class="text-muted d-block">Berat Bersih:</span>
                                <strong>{{ $product->weight }} gram</strong>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-2 border rounded bg-light">
                                <span class="text-muted d-block">Produsen / UMKM:</span>
                                <strong>PT Istana Oleh-Oleh</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4 flex-grow-1">
                        <h6 class="fw-bold mb-2" style="color: var(--brand-primary);"><i class="bi bi-file-text me-1 text-warning"></i> Deskripsi Produk</h6>
                        <div class="text-muted lh-base" style="white-space: pre-line;">
                            {{ $product->description }}
                        </div>
                    </div>

                    <!-- Order Action CTAs -->
                    <div class="d-flex flex-column flex-sm-row gap-3 pt-3 border-top">
                        <a href="{{ route('orders.create', ['product_id' => $product->id]) }}" class="btn btn-brand-gold btn-lg flex-grow-1 shadow-sm d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart-check-fill me-2 fs-5"></i> Pesan via Form Online
                        </a>
                        
                        @php
                            $waMessage = "Halo Admin IZZARA Oleh-Oleh, saya tertarik untuk memesan:\nProduk: " . $product->name . " (" . $product->product_code . ")\nHarga: " . $product->formatted_price . "\nMohon info ketersediaan stok & cara pemesanan. Terima kasih.";
                            $waUrl = "https://wa.me/6281234567890?text=" . urlencode($waMessage);
                        @endphp
                        <a href="{{ $waUrl }}" target="_blank" class="btn btn-success btn-lg d-flex align-items-center justify-content-center">
                            <i class="bi bi-whatsapp me-2 fs-5"></i> Pesan Cepat via WA
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <span class="text-uppercase fw-bold small text-warning">Satu Kategori</span>
                <h3 class="font-serif fw-bold mb-0" style="color: var(--brand-primary);">Produk Terkait Lainnya</h3>
            </div>
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="btn btn-outline-secondary btn-sm">
                Lihat Kategori Ini <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($relatedProducts as $rel)
            <div class="col-lg-3 col-md-6">
                <div class="product-card">
                    <div class="img-wrapper">
                        <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}">
                    </div>
                    <div class="p-3 d-flex flex-column flex-grow-1">
                        <span class="badge-category mb-2">{{ $rel->category->name }}</span>
                        <h6 class="fw-bold mb-1 font-serif text-truncate">
                            <a href="{{ route('products.show', $rel->slug) }}" class="text-decoration-none text-dark">
                                {{ $rel->name }}
                            </a>
                        </h6>
                        <div class="mt-auto pt-2 border-top d-flex justify-content-between align-items-center">
                            <span class="fw-bold" style="color: var(--brand-primary);">{{ $rel->formatted_price }}</span>
                            <a href="{{ route('products.show', $rel->slug) }}" class="btn btn-sm btn-brand-outline py-1 px-2" style="font-size: 0.8rem;">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
