@extends('layouts.app')

@section('title', 'Daftar Akun Pelanggan - IZZARA Oleh-Oleh')

@section('content')
<div class="container py-5 my-md-3">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-7">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background-color: #FFFFFF;">
                <div class="p-4 p-md-5 text-center text-white" style="background: linear-gradient(135deg, #3A1B0D, #532712); border-bottom: 3px solid #D4AF37;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 60px; border-radius: 8px;" class="mb-2 bg-white p-1 shadow-sm">
                    <h3 class="font-serif fw-bold mb-1 text-white">Daftar Akun Pelanggan</h3>
                    <small class="text-warning">Bergabung untuk kemudahan belanja oleh-oleh nusantara terlengkap</small>
                </div>

                <div class="p-4 p-md-5">
                    <form action="{{ route('register.submit') }}" method="POST">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="bi bi-person"></i></span>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Contoh: Rina Melati" value="{{ old('name') }}" required maxlength="100">
                            </div>
                            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold small">Alamat Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com" value="{{ old('email') }}" required maxlength="100">
                                </div>
                                @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-semibold small">Nomor WhatsApp / HP <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-whatsapp"></i></span>
                                    <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}" required maxlength="20">
                                </div>
                                @error('phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Alamat Lengkap -->
                        <div class="mb-3">
                            <label for="address" class="form-label fw-semibold small">Alamat Pengiriman Lengkap <span class="text-danger">*</span></label>
                            <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="Nama jalan, nomor rumah, RT/RW, kecamatan, kota/kabupaten..." required maxlength="500">{{ old('address') }}</textarea>
                            @error('address') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="row g-3 mb-4">
                            <!-- Password -->
                            <div class="col-md-6">
                                <label for="password" class="form-label fw-semibold small">Kata Sandi (Password) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Min. 6 karakter" required>
                                </div>
                                @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label fw-semibold small">Ulangi Kata Sandi <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi password" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-brand-primary btn-lg w-100 shadow-sm mb-3">
                            <i class="bi bi-person-check-fill me-2"></i> Daftar Akun Sekarang
                        </button>
                    </form>

                    <div class="text-center pt-3 border-top small text-muted">
                        Sudah memiliki akun? 
                        <a href="{{ route('login') }}" class="fw-bold text-decoration-none" style="color: var(--brand-primary);">
                            Masuk di Sini <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
