@extends('layouts.app')

@section('title', 'Login Pelanggan - IZZARA Oleh-Oleh')

@section('content')
<div class="container py-5 my-md-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background-color: #FFFFFF;">
                <div class="p-4 p-md-5 text-center text-white" style="background: linear-gradient(135deg, #3A1B0D, #532712); border-bottom: 3px solid #D4AF37;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 60px; border-radius: 8px;" class="mb-2 bg-white p-1 shadow-sm">
                    <h3 class="font-serif fw-bold mb-1 text-white">Login Pelanggan</h3>
                    <small class="text-warning">Masuk untuk melihat pesanan & kemudahan checkout</small>
                </div>

                <div class="p-4 p-md-5">
                    <!-- Helper Demo Credentials Box -->
                    <div class="alert alert-warning p-3 small mb-4 rounded-3 border-warning border-opacity-50">
                        <div class="fw-bold mb-1"><i class="bi bi-info-circle-fill me-1"></i> Akun Contoh (Demo Pelanggan):</div>
                        <div>Email: <strong>customer@izzara.com</strong></div>
                        <div>Password: <strong>customer123</strong></div>
                    </div>

                    <form action="{{ route('login.submit') }}" method="POST">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold small">Alamat Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com" value="{{ old('email', 'customer@izzara.com') }}" required autofocus>
                            </div>
                            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold small">Kata Sandi (Password) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" value="customer123" required>
                            </div>
                            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                                <label class="form-check-label small text-muted" for="remember">
                                    Ingat saya
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-brand-primary btn-lg w-100 shadow-sm mb-3">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Masuk Sekarang
                        </button>
                    </form>

                    <div class="text-center pt-3 border-top small text-muted">
                        Belum memiliki akun? 
                        <a href="{{ route('register') }}" class="fw-bold text-decoration-none" style="color: var(--brand-primary);">
                            Daftar Akun Baru <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                    <div class="text-center pt-3 mt-2 border-top small">
                        <span class="text-muted">Administrator Toko?</span>
                        <a href="{{ route('admin.login') }}" class="text-decoration-none text-secondary ms-1">
                            <i class="bi bi-shield-lock me-1"></i> Login Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
