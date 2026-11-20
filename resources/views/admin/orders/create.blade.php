@extends('layouts.admin')

@section('title', 'Tambah Pesanan Manual')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1" style="color: var(--brand-primary); font-family: 'Playfair Display', serif;">Tambah Pesanan Manual</h2>
        <p class="text-muted small mb-0">Input data transaksi pesanan pelanggan secara manual oleh admin.</p>
    </div>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Pesanan
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card card-custom p-4 p-md-5">
            <form action="{{ route('admin.orders.store') }}" method="POST">
                @csrf

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="customer_name" class="form-label fw-semibold small">Nama Pelanggan <span class="text-danger">*</span></label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name') }}" required maxlength="100">
                        @error('customer_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="customer_phone" class="form-label fw-semibold small">Nomor WhatsApp <span class="text-danger">*</span></label>
                        <input type="tel" name="customer_phone" id="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" value="{{ old('customer_phone') }}" required maxlength="20">
                        @error('customer_phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="customer_email" class="form-label fw-semibold small">Email Pelanggan <span class="text-danger">*</span></label>
                        <input type="email" name="customer_email" id="customer_email" class="form-control @error('customer_email') is-invalid @enderror" value="{{ old('customer_email') }}" required maxlength="100">
                        @error('customer_email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="payment_method" class="form-label fw-semibold small">Metode Pembayaran <span class="text-danger">*</span></label>
                        <select name="payment_method" id="payment_method" class="form-select" required>
                            <option value="transfer_bca">Transfer Bank BCA</option>
                            <option value="transfer_mandiri">Transfer Bank Mandiri</option>
                            <option value="transfer_bri">Transfer Bank BRI</option>
                            <option value="qris">QRIS E-Wallet</option>
                            <option value="cod">Bayar di Tempat (COD)</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="shipping_address" class="form-label fw-semibold small">Alamat Pengiriman <span class="text-danger">*</span></label>
                    <textarea name="shipping_address" id="shipping_address" rows="3" class="form-control @error('shipping_address') is-invalid @enderror" required maxlength="500">{{ old('shipping_address') }}</textarea>
                    @error('shipping_address') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="product_id" class="form-label fw-semibold small">Pilih Produk <span class="text-danger">*</span></label>
                        <select name="product_id" id="product_id" class="form-select" required>
                            @foreach($products as $prod)
                                <option value="{{ $prod->id }}">
                                    {{ $prod->name }} — {{ $prod->formatted_price }} (Stok: {{ $prod->stock }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="quantity" class="form-label fw-semibold small">Jumlah <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1" required>
                    </div>

                    <div class="col-md-3">
                        <label for="status" class="form-label fw-semibold small">Status Awal <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="pending">Menunggu Konfirmasi</option>
                            <option value="processing" selected>Diproses</option>
                            <option value="shipped">Dikirim</option>
                            <option value="completed">Selesai</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="notes" class="form-label fw-semibold small">Catatan Tambahan</label>
                    <textarea name="notes" id="notes" rows="2" class="form-control">{{ old('notes') }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-brand-primary px-4">
                        <i class="bi bi-save me-1"></i> Simpan Pesanan
                    </button>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
