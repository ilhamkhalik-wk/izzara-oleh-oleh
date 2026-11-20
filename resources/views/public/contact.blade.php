@extends('layouts.app')

@section('title', 'Hubungi Kami - IZZARA Oleh-Oleh')

@section('content')
<!-- Header Banner -->
<div class="py-4 border-bottom" style="background: linear-gradient(135deg, #FAF4EB, #F0E6D8);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--brand-primary);"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kontak</li>
            </ol>
        </nav>
        <h1 class="font-serif fw-bold mb-1" style="color: var(--brand-primary);">Hubungi Kami</h1>
        <p class="text-muted mb-0">Ada pertanyaan seputar produk, kemitraan UMKM, atau pesanan grosir? Tim IZZARA siap membantu.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">
        <!-- Contact Information Cards -->
        <div class="col-lg-5">
            <h3 class="font-serif fw-bold mb-4" style="color: var(--brand-primary);">Informasi Kontak</h3>

            <div class="d-flex flex-column gap-3 mb-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center" style="background-color: #FFFFFF;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 50px; height: 50px; background-color: var(--brand-cream); color: var(--brand-primary);">
                        <i class="bi bi-building fs-4 text-warning"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Kantor & Gerai Utama</h6>
                        <small class="text-muted">PT Istana Oleh-Oleh Indonesia<br>Jl. Nusantara Raya No. 88, Sentra Wisata Kuliner</small>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center" style="background-color: #FFFFFF;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 50px; height: 50px; background-color: var(--brand-cream); color: var(--brand-primary);">
                        <i class="bi bi-whatsapp fs-4 text-success"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">WhatsApp Customer Service</h6>
                        <small class="text-muted">+62 812-3456-7890 (Fast Response)</small>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center" style="background-color: #FFFFFF;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 50px; height: 50px; background-color: var(--brand-cream); color: var(--brand-primary);">
                        <i class="bi bi-envelope fs-4 text-primary"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Email Korespondensi</h6>
                        <small class="text-muted">info@izzara.com / order@izzara.com</small>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center" style="background-color: #FFFFFF;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 50px; height: 50px; background-color: var(--brand-cream); color: var(--brand-primary);">
                        <i class="bi bi-clock fs-4 text-warning"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Jam Layanan Operasional</h6>
                        <small class="text-muted">Senin - Minggu: 08.00 - 21.00 WIB</small>
                    </div>
                </div>
            </div>

            <!-- Quick WhatsApp Action Card -->
            <div class="p-4 rounded-4 shadow-sm" style="background: linear-gradient(135deg, #38190B, #220E04); color: #FFF;">
                <h5 class="font-serif text-white mb-2"><i class="bi bi-chat-dots-fill text-warning me-2"></i> Butuh Respon Cepat?</h5>
                <p class="small text-light text-opacity-80 mb-3">Konsultasikan kebutuhan oleh-oleh rombongan atau pesanan suvenir Anda langsung melalui WhatsApp resmi kami.</p>
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20IZZARA,%20saya%20ingin%20berkonsultasi%20mengenai%20produk%20oleh-oleh" target="_blank" class="btn btn-brand-gold w-100">
                    <i class="bi bi-whatsapp me-2"></i> Chat WhatsApp Sekarang
                </a>
            </div>
        </div>

        <!-- Contact Form (Form D) -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5" style="background-color: #FFFFFF;">
                <div class="d-flex align-items-center mb-4">
                    <div class="rounded-circle bg-warning bg-opacity-25 d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                        <i class="bi bi-send-fill text-dark fs-5"></i>
                    </div>
                    <div>
                        <h4 class="font-serif fw-bold mb-0" style="color: var(--brand-primary);">Kirim Pesan / Pertanyaan</h4>
                        <small class="text-muted">Silakan lengkapi formulir di bawah ini dengan valid.</small>
                    </div>
                </div>

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    
                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="bi bi-person"></i></span>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Contoh: Budi Santoso" value="{{ old('name') }}" required maxlength="100">
                        </div>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold small">Alamat Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="email@domain.com" value="{{ old('email') }}" required maxlength="100">
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nomor WhatsApp -->
                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-semibold small">Nomor WhatsApp</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="bi bi-telephone"></i></span>
                                <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}" maxlength="20">
                            </div>
                            @error('phone')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Subjek -->
                    <div class="mb-3">
                        <label for="subject" class="form-label fw-semibold small">Subjek Pesan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="bi bi-tag"></i></span>
                            <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Contoh: Tanya Kerjasama Kemitraan UMKM / Pembelian Grosir" value="{{ old('subject') }}" required maxlength="150">
                        </div>
                        @error('subject')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Isi Pesan -->
                    <div class="mb-4">
                        <label for="message" class="form-label fw-semibold small">Isi Pesan <span class="text-danger">*</span></label>
                        <textarea name="message" id="message" rows="5" class="form-control @error('message') is-invalid @enderror" placeholder="Tuliskan pesan, saran, atau pertanyaan Anda di sini..." required maxlength="1500">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-brand-primary btn-lg w-100 shadow-sm">
                        <i class="bi bi-send-fill me-2"></i> Kirim Pesan Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
