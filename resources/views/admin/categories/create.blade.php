@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1" style="color: var(--brand-primary); font-family: 'Playfair Display', serif;">Tambah Kategori Baru</h2>
        <p class="text-muted small mb-0">Form untuk memasukkan kategori produk oleh-oleh baru.</p>
    </div>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Kategori
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card card-custom p-4 p-md-5">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <!-- Nama Kategori -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold small">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Contoh: Makanan Tradisional" value="{{ old('name') }}" required maxlength="100">
                    <small class="text-muted">Maksimal 100 karakter. Slug URL akan dibuat secara otomatis.</small>
                    @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- Icon -->
                <div class="mb-3">
                    <label for="icon" class="form-label fw-semibold small">Bootstrap Icon Class</label>
                    <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" placeholder="bi-box-seam (contoh: bi-cookie, bi-cake2, bi-cup-hot, bi-bag-heart)" value="{{ old('icon', 'bi-box-seam') }}" maxlength="50">
                    @error('icon') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- Deskripsi Kategori -->
                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold small">Deskripsi Kategori</label>
                    <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Penjelasan singkat mengenai kategori produk ini..." maxlength="500">{{ old('description') }}</textarea>
                    @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-brand-primary px-4">
                        <i class="bi bi-save me-1"></i> Simpan Kategori
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
