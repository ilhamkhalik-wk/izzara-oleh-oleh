@extends('layouts.app')

@section('title', 'Form Pemesanan Pelanggan - IZZARA Oleh-Oleh')

@section('content')
<!-- Header Banner -->
<div class="py-4 border-bottom" style="background: linear-gradient(135deg, #FAF4EB, #F0E6D8);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--brand-primary);"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none" style="color: var(--brand-primary);">Katalog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Pemesanan Pelanggan</li>
            </ol>
        </nav>
        <h1 class="font-serif fw-bold mb-1" style="color: var(--brand-primary);">Formulir Pemesanan Online</h1>
        <p class="text-muted mb-0">Silakan isi rincian pesanan Anda. Kami melayani pengiriman ke seluruh wilayah Indonesia.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">
        <!-- Order Form (Form C) -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5" style="background-color: #FFFFFF;">
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; background-color: var(--brand-cream); color: var(--brand-primary);">
                        <i class="bi bi-bag-check-fill fs-4 text-warning"></i>
                    </div>
                    <div>
                        <h4 class="font-serif fw-bold mb-0" style="color: var(--brand-primary);">Data Pemesan & Produk</h4>
                        <small class="text-muted">Lengkapi 8 data pemesanan di bawah ini dengan tepat.</small>
                    </div>
                </div>

                @auth
                    <div class="alert alert-info d-flex align-items-center mb-4 py-2 border-0 shadow-sm" role="alert">
                        <i class="bi bi-person-check-fill fs-5 me-2 text-info"></i>
                        <small>Anda login sebagai <strong>{{ Auth::user()->name }}</strong>. Data pemesan telah diisi otomatis dari profil akun Anda.</small>
                    </div>
                @else
                    <div class="alert alert-warning d-flex align-items-center justify-content-between mb-4 py-2 border-0 shadow-sm" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle-fill me-2 text-warning"></i>
                            <small>Sudah punya akun pelanggan?</small>
                        </div>
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-dark py-0 px-2 small">Masuk Akun</a>
                    </div>
                @endauth

                <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                    @csrf

                    <!-- 1. Data Pemesan -->
                    <h6 class="fw-bold text-uppercase small text-warning mb-3" style="letter-spacing: 1px;">
                        <i class="bi bi-person-badge me-1"></i> 1. Identitas Pembeli
                    </h6>

                    <div class="mb-3">
                        <label for="customer_name" class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control @error('customer_name') is-invalid @enderror" placeholder="Contoh: Budi Santoso" value="{{ old('customer_name', $currentUser->name ?? '') }}" required maxlength="100">
                        @error('customer_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="customer_phone" class="form-label fw-semibold small">Nomor WhatsApp <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="bi bi-whatsapp"></i></span>
                                <input type="tel" name="customer_phone" id="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" placeholder="081234567890" value="{{ old('customer_phone', $currentUser->phone ?? '') }}" required maxlength="20">
                            </div>
                            @error('customer_phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="customer_email" class="form-label fw-semibold small">Alamat Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="customer_email" id="customer_email" class="form-control @error('customer_email') is-invalid @enderror" placeholder="nama@email.com" value="{{ old('customer_email', $currentUser->email ?? '') }}" required maxlength="100">
                            </div>
                            @error('customer_email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="shipping_address" class="form-label fw-semibold small">Alamat Pengiriman Lengkap <span class="text-danger">*</span></label>
                        <textarea name="shipping_address" id="shipping_address" rows="3" class="form-control @error('shipping_address') is-invalid @enderror" placeholder="Jalan, No. Rumah, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten, Kode Pos" required maxlength="500">{{ old('shipping_address', $currentUser->address ?? '') }}</textarea>
                        @error('shipping_address') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- 2. Pemilihan Produk & Jumlah -->
                    <h6 class="fw-bold text-uppercase small text-warning mb-3 pt-3 border-top" style="letter-spacing: 1px;">
                        <i class="bi bi-box-seam me-1"></i> 2. Pemilihan Produk Oleh-Oleh
                    </h6>

                    <div class="row g-3 mb-4">
                        <div class="col-md-8">
                            <label for="product_id" class="form-label fw-semibold small">Pilih Produk <span class="text-danger">*</span></label>
                            <select name="product_id" id="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Produk Oleh-Oleh --</option>
                                @foreach($products as $prod)
                                    <option value="{{ $prod->id }}" 
                                            data-price="{{ $prod->price }}"
                                            data-stock="{{ $prod->stock }}"
                                            data-weight="{{ $prod->weight }}"
                                            data-name="{{ $prod->name }}"
                                            {{ (old('product_id', $selectedProductId) == $prod->id) ? 'selected' : '' }}>
                                        {{ $prod->name }} ({{ $prod->product_code }}) — {{ $prod->formatted_price }} (Stok: {{ $prod->stock }})
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="quantity" class="form-label fw-semibold small">Jumlah Pembelian <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" min="1" max="100" value="{{ old('quantity', 1) }}" required>
                            @error('quantity') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- 3. Metode Pembayaran & Catatan -->
                    <h6 class="fw-bold text-uppercase small text-warning mb-3 pt-3 border-top" style="letter-spacing: 1px;">
                        <i class="bi bi-credit-card me-1"></i> 3. Metode Pembayaran & Catatan
                    </h6>

                    <div class="mb-3">
                        <label for="payment_method" class="form-label fw-semibold small">Metode Pembayaran <span class="text-danger">*</span></label>
                        <select name="payment_method" id="payment_method" class="form-select @error('payment_method') is-invalid @enderror" required>
                            <option value="">-- Pilih Cara Pembayaran --</option>
                            <option value="transfer_bca" {{ old('payment_method') == 'transfer_bca' ? 'selected' : '' }}>Transfer Bank BCA (Otomatis & Terverifikasi)</option>
                            <option value="transfer_mandiri" {{ old('payment_method') == 'transfer_mandiri' ? 'selected' : '' }}>Transfer Bank Mandiri</option>
                            <option value="transfer_bri" {{ old('payment_method') == 'transfer_bri' ? 'selected' : '' }}>Transfer Bank BRI</option>
                            <option value="qris" {{ old('payment_method') == 'qris' ? 'selected' : '' }}>QRIS (Gopay / OVO / Dana / ShopeePay / Mobile Banking)</option>
                            <option value="cod" {{ old('payment_method') == 'cod' ? 'selected' : '' }}>Bayar di Tempat (COD / Khusus Area Sekitar Gerai)</option>
                        </select>
                        @error('payment_method') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="notes" class="form-label fw-semibold small">Catatan Pesanan (Opsional)</label>
                        <textarea name="notes" id="notes" rows="2" class="form-control @error('notes') is-invalid @enderror" placeholder="Contoh: Mohon bungkus bubble wrap tebal, untuk hadiah rekan kerja.">{{ old('notes') }}</textarea>
                        @error('notes') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-brand-gold btn-lg w-100 shadow fw-bold">
                        <i class="bi bi-check-circle-fill me-2"></i> Konfirmasi & Selesaikan Pesanan
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Summary Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 90px; background-color: #FFFFFF; border-top: 4px solid var(--brand-primary) !important;">
                <h5 class="font-serif fw-bold mb-3" style="color: var(--brand-primary);"><i class="bi bi-receipt me-2 text-warning"></i> Ringkasan Pesanan</h5>

                <div class="p-3 rounded-3 mb-3 bg-light border">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Produk Dipilih:</span>
                        <strong class="small text-end" id="summaryProductName" style="max-width: 170px;">- Belum dipilih -</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Harga Satuan:</span>
                        <span class="small fw-semibold" id="summaryPrice">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Jumlah:</span>
                        <span class="small fw-semibold" id="summaryQty">1 item</span>
                    </div>
                    <div class="d-flex justify-content-between pt-2 border-top">
                        <span class="fw-bold" style="color: var(--brand-primary);">Total Bayar:</span>
                        <span class="fw-bold fs-5" style="color: var(--brand-primary);" id="summaryTotal">Rp 0</span>
                    </div>
                </div>

                <div class="small text-muted mb-3">
                    <i class="bi bi-truck text-primary me-1"></i> Biaya ongkos kirim akan dikonfirmasi oleh admin saat verifikasi WhatsApp.
                </div>

                <div class="p-3 rounded-3" style="background-color: var(--brand-cream); border: 1px dashed var(--brand-gold);">
                    <div class="d-flex align-items-center mb-1">
                        <i class="bi bi-shield-lock-fill text-warning fs-5 me-2"></i>
                        <span class="fw-bold small" style="color: var(--brand-primary);">Jaminan Transaksi Aman</span>
                    </div>
                    <small class="text-muted d-block">Data Anda dilindungi dan produk dikirim langsung dari gudang resmi PT Istana Oleh-Oleh Indonesia.</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function updateSummary() {
        const productSelect = document.getElementById('product_id');
        const qtyInput = document.getElementById('quantity');
        const selectedOption = productSelect.options[productSelect.selectedIndex];

        if (selectedOption && selectedOption.value) {
            const name = selectedOption.getAttribute('data-name');
            const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
            const qty = parseInt(qtyInput.value) || 1;
            const total = price * qty;

            document.getElementById('summaryProductName').textContent = name;
            document.getElementById('summaryPrice').textContent = 'Rp ' + price.toLocaleString('id-ID');
            document.getElementById('summaryQty').textContent = qty + ' item';
            document.getElementById('summaryTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
        } else {
            document.getElementById('summaryProductName').textContent = '- Belum dipilih -';
            document.getElementById('summaryPrice').textContent = 'Rp 0';
            document.getElementById('summaryQty').textContent = (qtyInput.value || 1) + ' item';
            document.getElementById('summaryTotal').textContent = 'Rp 0';
        }
    }

    document.getElementById('product_id')?.addEventListener('change', updateSummary);
    document.getElementById('quantity')?.addEventListener('input', updateSummary);
    updateSummary();
</script>
@endsection
