@extends('layouts.app')

@section('title', 'Pengaturan Profil Pelanggan')

@section('content')
<div class="py-4 border-bottom" style="background: linear-gradient(135deg, #FAF4EB, #F0E6D8);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--brand-primary);"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}" class="text-decoration-none" style="color: var(--brand-primary);">Area Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengaturan Profil</li>
            </ol>
        </nav>
        <h2 class="font-serif fw-bold mb-0" style="color: var(--brand-primary);">Pengaturan Profil & Alamat</h2>
        <small class="text-muted">Perbarui informasi kontak dan alamat pengiriman pesanan Anda.</small>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5" style="background-color: #FFFFFF;">
                <form action="{{ route('customer.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <h5 class="font-serif fw-bold mb-3" style="color: var(--brand-primary);"><i class="bi bi-person-circle text-warning me-2"></i> Data Identitas</h5>

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required maxlength="100">
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold small">Alamat Email</label>
                            <input type="email" id="email" class="form-control bg-light" value="{{ $user->email }}" disabled readonly>
                            <small class="text-muted">Email tidak dapat diubah (sebagai identitas akun).</small>
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-semibold small">Nomor WhatsApp / HP <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" required maxlength="20">
                            @error('phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="form-label fw-semibold small">Alamat Pengiriman Utama <span class="text-danger">*</span></label>
                        <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="Alamat lengkap tujuan pengiriman pesanan..." required maxlength="500">{{ old('address', $user->address) }}</textarea>
                        @error('address') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <h5 class="font-serif fw-bold mb-3 pt-3 border-top" style="color: var(--brand-primary);"><i class="bi bi-shield-lock text-warning me-2"></i> Ganti Password (Opsional)</h5>
                    <small class="text-muted d-block mb-3">Biarkan kosong jika tidak ingin mengubah password akun Anda saat ini.</small>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="current_password" class="form-label fw-semibold small">Password Saat Ini</label>
                            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="••••••••">
                            @error('current_password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="new_password" class="form-label fw-semibold small">Password Baru</label>
                            <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="Min. 6 karakter">
                            @error('new_password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="new_password_confirmation" class="form-label fw-semibold small">Ulangi Password Baru</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Konfirmasi password">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-brand-primary px-4">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan Profil
                        </button>
                        <a href="{{ route('customer.dashboard') }}" class="btn btn-outline-secondary">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
