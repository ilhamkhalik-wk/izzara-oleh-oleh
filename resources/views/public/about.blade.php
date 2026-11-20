@extends('layouts.app')

@section('title', 'Tentang Kami - PT Istana Oleh-Oleh Indonesia')

@section('content')
<!-- Header Banner -->
<div class="py-5 text-center text-white" style="background: linear-gradient(135deg, #4A2411, #68341A); border-bottom: 4px solid var(--brand-gold);">
    <div class="container">
        <span class="badge px-3 py-2 rounded-pill mb-3" style="background-color: rgba(212, 175, 55, 0.2); color: #F5D77F; border: 1px solid rgba(212, 175, 55, 0.4);">
            Profil Perusahaan & Inisiatif UMKM
        </span>
        <h1 class="display-5 font-serif fw-bold mb-2">Tentang IZZARA Oleh-Oleh</h1>
        <p class="lead text-light text-opacity-85 mb-0" style="max-width: 700px; margin: auto;">
            Dikelola oleh <strong>PT Istana Oleh-Oleh Indonesia</strong> &bull; "Bawa Pulang Kenangan Terbaik."
        </p>
    </div>
</div>

<div class="container py-5">
    <!-- Story & Overview -->
    <div class="row align-items-center g-5 mb-5">
        <div class="col-lg-6">
            <span class="text-uppercase fw-bold small text-warning" style="letter-spacing: 1.5px;">Cita Rasa Asli Nusantara</span>
            <h2 class="font-serif fw-bold mb-4" style="color: var(--brand-primary); font-size: 2.2rem;">
                Dedikasi untuk Kekayaan Kuliner dan Budaya Lokal
            </h2>
            <div class="text-muted lh-lg">
                <p>
                    <strong>IZZARA Oleh-Oleh</strong> merupakan UMKM yang bergerak di bidang penjualan berbagai macam produk oleh-oleh khas daerah. Kami menyediakan beragam pilihan produk, mulai dari makanan tradisional, makanan ringan, keripik, kue khas daerah, hingga produk kerajinan dan souvenir tangan bernilai estetika tinggi.
                </p>
                <p>
                    <strong>IZZARA</strong> hadir untuk memudahkan masyarakat dalam mendapatkan oleh-oleh berkualitas dengan harga terjangkau. Kami juga berkomitmen kuat untuk mendukung UMKM lokal dan memperkenalkan kekayaan kuliner serta budaya Indonesia kepada masyarakat luas baik wisatawan domestik maupun mancanegara.
                </p>
            </div>
            <div class="p-3 bg-white border rounded-3 shadow-sm d-flex align-items-center mt-3">
                <i class="bi bi-shield-check fs-2 text-warning me-3"></i>
                <div>
                    <h6 class="fw-bold mb-0" style="color: var(--brand-primary);">Legalitas & Integritas Bisnis</h6>
                    <small class="text-muted">Beroperasi di bawah payung hukum <strong>PT Istana Oleh-Oleh Indonesia</strong>.</small>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5 text-center" style="background: linear-gradient(135deg, #38190B, #200D04); color: #FFF;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo IZZARA" class="mx-auto rounded-3 mb-4 shadow" style="max-height: 180px;">
                <h3 class="font-serif text-white mb-2">IZZARA Oleh-Oleh</h3>
                <h6 class="text-warning mb-3">PT Istana Oleh-Oleh Indonesia</h6>
                <div class="p-3 rounded-3" style="background: rgba(255, 255, 255, 0.08); border: 1px dashed rgba(212, 175, 55, 0.5);">
                    <p class="fst-italic text-warning mb-0 fs-5">
                        <i class="bi bi-quote"></i> Bawa Pulang Kenangan Terbaik. <i class="bi bi-quote"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Visi & Misi Section -->
    <div class="row g-4 mb-5">
        <!-- Visi -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100" style="background-color: #FFFFFF; border-top: 4px solid var(--brand-gold) !important;">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background-color: var(--brand-cream); color: var(--brand-primary);">
                        <i class="bi bi-eye-fill fs-3 text-warning"></i>
                    </div>
                    <h3 class="font-serif fw-bold mb-0" style="color: var(--brand-primary);">Visi Kami</h3>
                </div>
                <div class="p-3 rounded-3 bg-light border-start border-4 border-warning my-auto">
                    <p class="fs-5 fw-semibold mb-0" style="color: var(--brand-primary); line-height: 1.6;">
                        "Menjadi pusat oleh-oleh lokal yang terpercaya, berkualitas, dan dikenal oleh masyarakat luas."
                    </p>
                </div>
            </div>
        </div>

        <!-- Misi -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100" style="background-color: #FFFFFF; border-top: 4px solid var(--brand-primary) !important;">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background-color: var(--brand-cream); color: var(--brand-primary);">
                        <i class="bi bi-bullseye fs-3 text-primary"></i>
                    </div>
                    <h3 class="font-serif fw-bold mb-0" style="color: var(--brand-primary);">Misi Kami</h3>
                </div>
                <ul class="list-unstyled d-flex flex-column gap-3 mb-0">
                    <li class="d-flex align-items-start">
                        <span class="badge bg-warning text-dark rounded-circle me-3 mt-1 fw-bold" style="width: 24px; height: 24px; line-height: 18px; text-align: center;">1</span>
                        <span class="text-muted">Menyediakan berbagai pilihan oleh-oleh khas daerah yang beragam dan autentik.</span>
                    </li>
                    <li class="d-flex align-items-start">
                        <span class="badge bg-warning text-dark rounded-circle me-3 mt-1 fw-bold" style="width: 24px; height: 24px; line-height: 18px; text-align: center;">2</span>
                        <span class="text-muted">Menjaga kualitas, kesegaran, kebersihan, dan higienitas setiap produk secara konsisten.</span>
                    </li>
                    <li class="d-flex align-items-start">
                        <span class="badge bg-warning text-dark rounded-circle me-3 mt-1 fw-bold" style="width: 24px; height: 24px; line-height: 18px; text-align: center;">3</span>
                        <span class="text-muted">Mendukung dan memfasilitasi perkembangan UMKM serta pengrajin produk lokal di berbagai sentra daerah.</span>
                    </li>
                    <li class="d-flex align-items-start">
                        <span class="badge bg-warning text-dark rounded-circle me-3 mt-1 fw-bold" style="width: 24px; height: 24px; line-height: 18px; text-align: center;">4</span>
                        <span class="text-muted">Memberikan pelayanan terbaik, ramah, dan solutif kepada seluruh pelanggan.</span>
                    </li>
                    <li class="d-flex align-items-start">
                        <span class="badge bg-warning text-dark rounded-circle me-3 mt-1 fw-bold" style="width: 24px; height: 24px; line-height: 18px; text-align: center;">5</span>
                        <span class="text-muted">Memanfaatkan teknologi digital untuk memperluas jangkauan pemasaran dan efisiensi rantai pasok.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 4 Pilar Kategori Kami -->
    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-5" style="background-color: var(--brand-cream);">
        <div class="text-center mb-4">
            <span class="text-uppercase fw-bold small text-warning">Ragam Koleksi</span>
            <h3 class="font-serif fw-bold" style="color: var(--brand-primary);">Empat Pilar Produk IZZARA</h3>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-6 text-center">
                <div class="p-3 bg-white rounded-3 shadow-sm h-100">
                    <i class="bi bi-cookie fs-1 text-warning mb-2 d-block"></i>
                    <h6 class="fw-bold mb-1">Makanan Ringan</h6>
                    <small class="text-muted">Keripik pisang, keripik singkong, sale pisang.</small>
                </div>
            </div>
            <div class="col-md-3 col-6 text-center">
                <div class="p-3 bg-white rounded-3 shadow-sm h-100">
                    <i class="bi bi-cake2 fs-1 text-warning mb-2 d-block"></i>
                    <h6 class="fw-bold mb-1">Kue Tradisional</h6>
                    <small class="text-muted">Lapis legit, kue kering, dodol asli.</small>
                </div>
            </div>
            <div class="col-md-3 col-6 text-center">
                <div class="p-3 bg-white rounded-3 shadow-sm h-100">
                    <i class="bi bi-cup-hot fs-1 text-warning mb-2 d-block"></i>
                    <h6 class="fw-bold mb-1">Makanan & Minuman</h6>
                    <small class="text-muted">Kopi lokal, sambal, kuliner khas daerah.</small>
                </div>
            </div>
            <div class="col-md-3 col-6 text-center">
                <div class="p-3 bg-white rounded-3 shadow-sm h-100">
                    <i class="bi bi-bag-heart fs-1 text-warning mb-2 d-block"></i>
                    <h6 class="fw-bold mb-1">Souvenir Daerah</h6>
                    <small class="text-muted">Dompet batik, gantungan kunci, kerajinan etnik.</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
