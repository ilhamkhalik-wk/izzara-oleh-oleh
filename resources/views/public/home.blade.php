@extends('layouts.app')

@section('title', 'Beranda - Pusat Oleh-Oleh Nusantara')

@section('content')
<!-- Hero Section -->
<section class="position-relative overflow-hidden py-5" style="background: linear-gradient(135deg, #4A2411 0%, #68341A 50%, #30170A 100%); color: #FFF;">
    <div class="container py-lg-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <span class="badge px-3 py-2 rounded-pill mb-3" style="background-color: rgba(212, 175, 55, 0.2); color: #F5D77F; border: 1px solid rgba(212, 175, 55, 0.4); font-size: 0.85rem; letter-spacing: 1px;">
                    <i class="bi bi-award-fill me-1 text-warning"></i> UMKM Resmi &bull; PT Istana Oleh-Oleh Indonesia
                </span>
                <h1 class="display-4 fw-bold text-white mb-3" style="line-height: 1.2;">
                    Bawa Pulang <span style="color: #F5D77F; font-style: italic;">Kenangan Terbaik</span> dari Nusantara
                </h1>
                <p class="lead mb-4 text-light text-opacity-85" style="font-size: 1.15rem;">
                    Selamat datang di <strong>IZZARA Oleh-Oleh</strong>. Kami menghadirkan beragam kuliner tradisional, makanan ringan, kue khas daerah, hingga cinderamata autentik dari pengrajin lokal Indonesia.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('products.index') }}" class="btn btn-brand-gold btn-lg px-4 shadow">
                        <i class="bi bi-grid-fill me-2"></i> Jelajahi Produk
                    </a>
                    <a href="{{ route('orders.create') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="bi bi-cart-check me-2"></i> Pesan Online Sekarang
                    </a>
                </div>

                <!-- Trust Stats -->
                <div class="row g-3 mt-4 pt-3 border-top border-light border-opacity-10">
                    <div class="col-auto">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-patch-check-fill fs-3 text-warning me-2"></i>
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $stats['products'] }}+ Produk</h6>
                                <small class="text-light text-opacity-75">Tersedia Siap Kirim</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto border-start border-light border-opacity-25 ps-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-people-fill fs-3 text-warning me-2"></i>
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $stats['satisfied_customers'] }}+ Pelanggan</h6>
                                <small class="text-light text-opacity-75">Puas di Seluruh Nusantara</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto border-start border-light border-opacity-25 ps-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-shop fs-3 text-warning me-2"></i>
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $stats['local_partners'] }}+ Mitra UMKM</h6>
                                <small class="text-light text-opacity-75">Binaan Daerah</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 text-center">
                <div class="position-relative d-inline-block">
                    <div class="p-4 rounded-4 shadow-lg" style="background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(10px); border: 2px solid rgba(212, 175, 55, 0.4);">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo IZZARA Oleh-Oleh" class="img-fluid rounded-3 mb-3 shadow" style="max-height: 280px; width: auto;">
                        <h4 class="text-white font-serif mb-1">IZZARA Oleh-Oleh</h4>
                        <p class="text-warning small mb-0 fw-semibold">Pusat Oleh-Oleh Nusantara &bull; Cita Rasa Istimewa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values / Keunggulan Kami -->
<section class="py-5" style="background-color: #FFFFFF;">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3 col-6">
                <div class="p-3">
                    <div class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 65px; height: 65px;">
                        <i class="bi bi-shield-check fs-2" style="color: var(--brand-primary);"></i>
                    </div>
                    <h6 class="fw-bold mb-1">100% Kualitas Asli</h6>
                    <small class="text-muted">Bahan pilihan tanpa pengawet kimia berbahaya.</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3">
                    <div class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 65px; height: 65px;">
                        <i class="bi bi-box-seam fs-2" style="color: var(--brand-primary);"></i>
                    </div>
                    <h6 class="fw-bold mb-1">Kemasan Aman</h6>
                    <small class="text-muted">Food-grade packaging menjaga kerenyahan produk.</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3">
                    <div class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 65px; height: 65px;">
                        <i class="bi bi-heart-pulse fs-2" style="color: var(--brand-primary);"></i>
                    </div>
                    <h6 class="fw-bold mb-1">Dukung UMKM Lokal</h6>
                    <small class="text-muted">Memberdayakan petani & pengrajin lokal daerah.</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3">
                    <div class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 65px; height: 65px;">
                        <i class="bi bi-truck fs-2" style="color: var(--brand-primary);"></i>
                    </div>
                    <h6 class="fw-bold mb-1">Kirim Seluruh RI</h6>
                    <small class="text-muted">Pengiriman cepat bekerja sama dengan ekspedisi resmi.</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Kategori Pilihan -->
<section class="py-5" style="background-color: var(--brand-cream);">
    <div class="container">
        <div class="section-header">
            <span class="sub-title">Koleksi Terlengkap</span>
            <h2 class="main-title">Kategori Oleh-Oleh Pilihan</h2>
            <p class="text-muted mt-2">Pilih kategori favorit Anda untuk menemukan sajian khas nusantara terbaik</p>
        </div>

        <div class="row g-4">
            @foreach($categories as $cat)
            <div class="col-lg-3 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden text-center p-4 transition" style="background-color: #FFFFFF; border-bottom: 4px solid var(--brand-gold) !important;">
                    <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; background-color: var(--brand-cream); color: var(--brand-primary);">
                        <i class="bi {{ $cat->icon }} fs-2"></i>
                    </div>
                    <h5 class="fw-bold mb-2 font-serif" style="color: var(--brand-primary);">{{ $cat->name }}</h5>
                    <p class="small text-muted mb-3">{{ Str::limit($cat->description, 80) }}</p>
                    <div class="mt-auto">
                        <span class="badge bg-light text-dark border mb-3">{{ $cat->active_products_count }} Produk</span>
                        <div>
                            <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="btn btn-sm btn-brand-outline w-100">
                                Jelajahi Kategori <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Produk Unggulan -->
<section class="py-5" style="background-color: #FFFFFF;">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
            <div>
                <span class="text-uppercase fw-bold small text-warning" style="letter-spacing: 1px;">Rekomendasi Spesial</span>
                <h2 class="font-serif fw-bold mb-0" style="color: var(--brand-primary);">Produk Paling Diminati</h2>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-outline-dark btn-sm mt-3 mt-md-0">
                Lihat Semua Produk <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @forelse($featuredProducts as $product)
            <div class="col-lg-4 col-md-6">
                <div class="product-card">
                    <div class="img-wrapper">
                        <span class="badge-featured"><i class="bi bi-star-fill me-1"></i> Unggulan</span>
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    </div>
                    <div class="p-3 d-flex flex-column flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge-category">{{ $product->category->name }}</span>
                            <span class="small text-muted"><i class="bi bi-box me-1"></i> {{ $product->weight }} gr</span>
                        </div>
                        <h5 class="fw-bold mb-2 font-serif">
                            <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">
                                {{ $product->name }}
                            </a>
                        </h5>
                        <p class="small text-muted mb-3 flex-grow-1">{{ Str::limit($product->description, 75) }}</p>
                        
                        <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                            <div>
                                <small class="text-muted d-block" style="font-size: 0.75rem;">Harga</small>
                                <span class="price-tag">{{ $product->formatted_price }}</span>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm btn-outline-secondary" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('orders.create', ['product_id' => $product->id]) }}" class="btn btn-sm btn-brand-gold fw-semibold">
                                    <i class="bi bi-cart-plus me-1"></i> Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada produk unggulan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Produk Terbaru -->
<section class="py-5" style="background-color: var(--brand-cream);">
    <div class="container">
        <div class="section-header">
            <span class="sub-title">Cita Rasa Otentik</span>
            <h2 class="main-title">Koleksi Oleh-Oleh Terbaru</h2>
            <p class="text-muted mt-2">Daftar produk oleh-oleh segar yang baru saja ditambahkan</p>
        </div>

        <div class="row g-4">
            @foreach($latestProducts as $prod)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="product-card">
                    <div class="img-wrapper">
                        @if($prod->is_featured)
                            <span class="badge-featured"><i class="bi bi-star-fill me-1"></i> Unggulan</span>
                        @endif
                        <img src="{{ $prod->image_url }}" alt="{{ $prod->name }}">
                    </div>
                    <div class="p-3 d-flex flex-column flex-grow-1">
                        <div class="mb-2">
                            <span class="badge-category">{{ $prod->category->name }}</span>
                        </div>
                        <h6 class="fw-bold mb-1 font-serif text-truncate">
                            <a href="{{ route('products.show', $prod->slug) }}" class="text-decoration-none text-dark">
                                {{ $prod->name }}
                            </a>
                        </h6>
                        <span class="text-muted small mb-2"><i class="bi bi-upc-scan me-1"></i> {{ $prod->product_code }}</span>
                        
                        <div class="mt-auto pt-2 border-top d-flex justify-content-between align-items-center">
                            <span class="fw-bold" style="color: var(--brand-primary);">{{ $prod->formatted_price }}</span>
                            <a href="{{ route('products.show', $prod->slug) }}" class="btn btn-sm btn-brand-outline py-1 px-2" style="font-size: 0.8rem;">
                                Detail & Pesan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('products.index') }}" class="btn btn-brand-primary btn-lg px-5 shadow-sm">
                Lihat Seluruh Katalog Oleh-Oleh <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Profil Singkat & Visi Misi Callout -->
<section class="py-5" style="background: linear-gradient(135deg, #FAF4EB 0%, #F5ECE0 100%);">
    <div class="container py-lg-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="sub-title" style="color: var(--brand-gold); font-weight: 700; text-transform: uppercase;">Mengenal IZZARA</span>
                <h2 class="display-6 fw-bold mb-3 font-serif" style="color: var(--brand-primary);">Membawa Kekayaan Kuliner Lokal ke Hadapan Anda</h2>
                <p class="text-muted">
                    <strong>IZZARA Oleh-Oleh</strong> hadir di bawah naungan <strong>PT Istana Oleh-Oleh Indonesia</strong> untuk memudahkan masyarakat dalam mendapatkan oleh-oleh berkualitas dengan harga terjangkau.
                </p>
                <div class="p-3 bg-white rounded-3 border-start border-4 border-warning shadow-sm mb-3">
                    <h6 class="fw-bold mb-1" style="color: var(--brand-primary);"><i class="bi bi-eye-fill me-2 text-warning"></i> Visi Kami</h6>
                    <p class="small text-muted mb-0">Menjadi pusat oleh-oleh lokal yang terpercaya, berkualitas, dan dikenal oleh masyarakat luas.</p>
                </div>
                <div class="p-3 bg-white rounded-3 border-start border-4 border-primary shadow-sm mb-4">
                    <h6 class="fw-bold mb-1" style="color: var(--brand-primary);"><i class="bi bi-bullseye me-2 text-primary"></i> Misi Kami</h6>
                    <p class="small text-muted mb-0">Menyediakan aneka oleh-oleh higienis, membina UMKM lokal, dan memberikan pelayanan terbaik berbasis teknologi digital.</p>
                </div>
                <a href="{{ route('about') }}" class="btn btn-brand-primary">
                    Baca Profil Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-lg rounded-4 p-4 p-lg-5" style="background-color: #38190B; color: #FFF;">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 65px; border-radius: 8px;" class="mb-2">
                        <h4 class="font-serif text-white mb-0">PT Istana Oleh-Oleh Indonesia</h4>
                        <small class="text-warning fst-italic">"Bawa Pulang Kenangan Terbaik."</small>
                    </div>
                    <ul class="list-unstyled d-flex flex-column gap-3 mb-4">
                        <li class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-warning me-3 fs-5"></i>
                            <span>Bahan baku asli dari petani dan pengrajin lokal Nusantara</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-warning me-3 fs-5"></i>
                            <span>Jaminan kebersihan, higienis, dan sertifikasi halal</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-warning me-3 fs-5"></i>
                            <span>Layanan pemesanan mudah melalui website & WhatsApp</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-warning me-3 fs-5"></i>
                            <span>Pengiriman ekspres dengan garansi barang selamat sampai tujuan</span>
                        </li>
                    </ul>
                    <a href="{{ route('orders.create') }}" class="btn btn-brand-gold w-100 py-2 fs-6">
                        <i class="bi bi-bag-plus-fill me-2"></i> Buat Pesanan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimoni Pelanggan -->
<section class="py-5" style="background-color: #FFFFFF;">
    <div class="container">
        <div class="section-header">
            <span class="sub-title">Kata Mereka</span>
            <h2 class="main-title">Kepuasan Pelanggan IZZARA</h2>
            <p class="text-muted mt-2">Ulasan jujur dari para pecinta kuliner dan oleh-oleh nusantara</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 p-4 rounded-4 shadow-sm" style="background-color: var(--brand-cream);">
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="fst-italic text-muted mb-3">
                        "Keripik pisang dan kue lapis legitnya luar biasa enak! Manisnya pas, teksturnya legit, dan packingnya sangat aman sampai Jakarta tanpa hancur."
                    </p>
                    <div class="d-flex align-items-center mt-auto">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold" style="width: 42px; height: 42px;">
                            DA
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Dian Anggraini</h6>
                            <small class="text-muted">Pelanggan Setia - Jakarta</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 p-4 rounded-4 shadow-sm" style="background-color: var(--brand-cream);">
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="fst-italic text-muted mb-3">
                        "Kopi bubuk robustanya harum banget, benar-benar rasa kopi asli pegunungan. Sangat cocok buat oleh-oleh rekan kantor setelah dinas ke daerah."
                    </p>
                    <div class="d-flex align-items-center mt-auto">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold" style="width: 42px; height: 42px;">
                            RP
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Rizky Pratama</h6>
                            <small class="text-muted">Food Blogger - Bandung</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 p-4 rounded-4 shadow-sm" style="background-color: var(--brand-cream);">
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="fst-italic text-muted mb-3">
                        "Pesan lewat website praktis banget, langsung diproses dan ada tombol konfirmasi WhatsApp yang cepat tanggap. Dompet batik souvenirnya juga cantik."
                    </p>
                    <div class="d-flex align-items-center mt-auto">
                        <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold" style="width: 42px; height: 42px;">
                            MW
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Maya Wulandari</h6>
                            <small class="text-muted">Wisatawan - Surabaya</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
