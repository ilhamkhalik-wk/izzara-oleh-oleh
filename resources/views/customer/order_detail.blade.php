@extends('layouts.app')

@section('title', 'Rincian Pesanan: ' . $order->order_code)

@section('content')
<div class="py-4 border-bottom" style="background: linear-gradient(135deg, #FAF4EB, #F0E6D8);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--brand-primary);"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}" class="text-decoration-none" style="color: var(--brand-primary);">Area Pelanggan</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.orders') }}" class="text-decoration-none" style="color: var(--brand-primary);">Riwayat Pesanan</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $order->order_code }}</li>
            </ol>
        </nav>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h2 class="font-serif fw-bold mb-0" style="color: var(--brand-primary);">Nota Pesanan: {{ $order->order_code }}</h2>
                <small class="text-muted">Tanggal Transaksi: {{ $order->created_at->format('d F Y, H:i') }} WIB</small>
            </div>
            <div>
                {!! $order->status_badge !!}
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-8">
            <!-- Items Table -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" style="background-color: #FFFFFF;">
                <div class="p-4 border-bottom">
                    <h5 class="font-serif fw-bold mb-0" style="color: var(--brand-primary);"><i class="bi bi-box-seam me-2 text-warning"></i> Rincian Barang</h5>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th>Produk</th>
                                <th class="text-center" style="width: 100px;">Jumlah</th>
                                <th class="text-end" style="width: 140px;">Harga Satuan</th>
                                <th class="text-end" style="width: 140px;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($item->product && $item->product->image_url)
                                            <img src="{{ $item->product->image_url }}" alt="" class="rounded me-2" style="width: 45px; height: 40px; object-fit: cover;">
                                        @endif
                                        <div>
                                            <strong class="d-block text-dark">{{ $item->product->name ?? 'Produk Dihapus' }}</strong>
                                            <small class="text-muted">{{ $item->product->product_code ?? '-' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center fw-bold">{{ $item->quantity }}</td>
                                <td class="text-end">{{ $item->formatted_price }}</td>
                                <td class="text-end fw-bold" style="color: var(--brand-primary);">{{ $item->formatted_subtotal }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-warning">
                                <th colspan="3" class="text-end fs-5" style="color: var(--brand-primary);">Total Pembayaran:</th>
                                <th class="text-end fs-5 fw-bold" style="color: var(--brand-primary);">{{ $order->formatted_total }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Customer Shipping Info -->
            <div class="card border-0 shadow-sm rounded-4 p-4" style="background-color: #FFFFFF;">
                <h5 class="font-serif fw-bold mb-3" style="color: var(--brand-primary);"><i class="bi bi-geo-alt-fill text-danger me-2"></i> Tujuan Pengiriman</h5>
                <div class="row g-3 small">
                    <div class="col-md-6">
                        <span class="text-muted d-block">Penerima:</span>
                        <strong>{{ $order->customer_name }}</strong>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted d-block">Nomor WhatsApp:</span>
                        <strong>{{ $order->customer_phone }}</strong>
                    </div>
                    <div class="col-12">
                        <span class="text-muted d-block">Alamat Lengkap:</span>
                        <div class="p-2 bg-light rounded border lh-base">{{ $order->shipping_address }}</div>
                    </div>
                    @if($order->notes)
                    <div class="col-12">
                        <span class="text-muted d-block">Catatan:</span>
                        <div class="p-2 bg-warning bg-opacity-10 rounded border fst-italic">{{ $order->notes }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Payment Info Card -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4" style="background-color: #FFFFFF; border-top: 4px solid var(--brand-gold) !important;">
                <h5 class="font-serif fw-bold mb-3" style="color: var(--brand-primary);"><i class="bi bi-credit-card me-2 text-warning"></i> Metode Bayar</h5>
                <p class="fw-semibold mb-2">{{ $order->payment_method_label }}</p>
                <div class="p-3 rounded-3 bg-light border small mb-3">
                    @if($order->payment_method === 'transfer_bca')
                        Transfer Bank BCA: <strong>8890-1234-56</strong><br>
                        a.n. PT Istana Oleh-Oleh Indonesia
                    @elseif($order->payment_method === 'transfer_mandiri')
                        Transfer Bank Mandiri: <strong>137-00-9876543-2</strong><br>
                        a.n. PT Istana Oleh-Oleh Indonesia
                    @elseif($order->payment_method === 'transfer_bri')
                        Transfer Bank BRI: <strong>0341-01-000123-50-8</strong><br>
                        a.n. PT Istana Oleh-Oleh Indonesia
                    @elseif($order->payment_method === 'qris')
                        QRIS Digital (Scan barcode via Gopay, OVO, Dana, ShopeePay)
                    @else
                        Bayar tunai di tempat saat barang diterima kurir (COD).
                    @endif
                </div>

                @php
                    $waCheckUrl = "https://wa.me/6281234567890?text=" . urlencode("Halo Admin IZZARA, saya ingin mengecek status pesanan saya:\nKode: " . $order->order_code . "\nNama: " . $order->customer_name . "\nTotal: " . $order->formatted_total . "\nTerima kasih.");
                @endphp
                <a href="{{ $waCheckUrl }}" target="_blank" class="btn btn-success w-100 mb-2">
                    <i class="bi bi-whatsapp me-2"></i> Tanya Admin via WA
                </a>
                <a href="{{ route('customer.orders') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
