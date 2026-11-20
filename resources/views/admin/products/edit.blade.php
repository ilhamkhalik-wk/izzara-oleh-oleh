@extends('layouts.admin')

@section('title', 'Edit Produk: ' . $product->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1" style="color: var(--brand-primary); font-family: 'Playfair Display', serif;">Edit Produk: {{ $product->name }}</h2>
        <p class="text-muted small mb-0">Ubah informasi produk, perbarui harga, stok, atau ganti foto.</p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Produk
    </a>
</div>

<div class="card card-custom p-4 p-md-5">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- 1. Nama Produk -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold small">Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required maxlength="150">
                    @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="row g-3 mb-3">
                    <!-- 2. Kode Produk -->
                    <div class="col-md-6">
                        <label for="product_code" class="form-label fw-semibold small">Kode Produk <span class="text-danger">*</span></label>
                        <input type="text" name="product_code" id="product_code" class="form-control @error('product_code') is-invalid @enderror font-monospace text-uppercase" value="{{ old('product_code', $product->product_code) }}" required maxlength="50">
                        @error('product_code') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- 3. Kategori -->
                    <div class="col-md-6">
                        <label for="category_id" class="form-label fw-semibold small">Kategori Produk <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <!-- 4. Harga -->
                    <div class="col-md-4">
                        <label for="price" class="form-label fw-semibold small">Harga Satuan (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">Rp</span>
                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" min="0" step="500" value="{{ old('price', (int)$product->price) }}" required>
                        </div>
                        @error('price') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- 5. Stok -->
                    <div class="col-md-4">
                        <label for="stock" class="form-label fw-semibold small">Stok Produk <span class="text-danger">*</span></label>
                        <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" min="0" value="{{ old('stock', $product->stock) }}" required>
                        @error('stock') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- 6. Berat Produk -->
                    <div class="col-md-4">
                        <label for="weight" class="form-label fw-semibold small">Berat Bersih (gram) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" min="1" value="{{ old('weight', $product->weight) }}" required>
                            <span class="input-group-text bg-light">gr</span>
                        </div>
                        @error('weight') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- 7. Deskripsi -->
                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold small">Deskripsi Lengkap Produk <span class="text-danger">*</span></label>
                    <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror" required maxlength="3000">{{ old('description', $product->description) }}</textarea>
                    @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <!-- 8. Foto Produk -->
                <div class="card p-3 mb-3 bg-light border">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label fw-semibold small mb-0"><i class="bi bi-image me-1"></i> Foto Produk</label>
                        <span class="badge bg-success bg-opacity-75 small"><i class="bi bi-check2-circle me-1"></i>Tersimpan di DB</span>
                    </div>
                    <div class="text-center mb-2">
                        <img id="imagePreview" src="{{ $product->image_url }}" alt="Preview" class="rounded shadow-sm border bg-white" style="width: 100%; height: 200px; object-fit: contain;">
                    </div>
                    <div class="p-2 mb-2 bg-white rounded border small text-muted">
                        <span class="d-block" style="font-size: 0.72rem;">Path Database:</span>
                        <code class="font-monospace text-primary text-truncate d-block" style="font-size: 0.78rem;">{{ $product->image ?? 'Tidak ada foto' }}</code>
                    </div>
                    <label class="form-label fw-semibold small mb-1">Ganti Foto Baru (Opsional)</label>
                    <input type="file" name="image" id="imageInput" class="form-control form-control-sm @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/webp">
                    <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                        <i class="bi bi-info-circle text-primary me-1"></i>Foto yang ada akan tetap tersimpan aman di database jika Anda tidak memilih file baru.
                    </small>
                    @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- 9. Status Produk -->
                <div class="card p-3 mb-3 bg-light border">
                    <label class="form-label fw-semibold small mb-2"><i class="bi bi-toggle-on me-1"></i> Status Produk <span class="text-danger">*</span></label>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="is_active" id="active1" value="1" {{ old('is_active', $product->is_active ? '1' : '0') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label small" for="active1">
                            <span class="badge bg-success me-1">Aktif</span> Tampilkan di katalog publik
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_active" id="active0" value="0" {{ old('is_active', $product->is_active ? '1' : '0') == '0' ? 'checked' : '' }}>
                        <label class="form-check-label small" for="active0">
                            <span class="badge bg-secondary me-1">Tidak Aktif</span> Sembunyikan dari katalog
                        </label>
                    </div>
                    @error('is_active') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- 10. Produk Unggulan -->
                <div class="card p-3 mb-4 bg-light border">
                    <label class="form-label fw-semibold small mb-2"><i class="bi bi-star-fill text-warning me-1"></i> Produk Unggulan <span class="text-danger">*</span></label>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="is_featured" id="feat1" value="1" {{ old('is_featured', $product->is_featured ? '1' : '0') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label small" for="feat1">
                            <strong>Ya</strong>, tampilkan di bagian unggulan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_featured" id="feat0" value="0" {{ old('is_featured', $product->is_featured ? '1' : '0') == '0' ? 'checked' : '' }}>
                        <label class="form-check-label small" for="feat0">
                            <strong>Tidak</strong>, produk reguler
                        </label>
                    </div>
                    @error('is_featured') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="d-flex gap-2 pt-3 border-top">
            <button type="submit" class="btn btn-brand-primary px-5 py-2">
                <i class="bi bi-check-circle-fill me-2"></i> Perbarui Data Produk
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary py-2 px-4">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('imageInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('imagePreview').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
