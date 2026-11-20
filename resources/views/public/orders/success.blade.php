@extends('layouts.app')

@section('title', 'Pesanan Berhasil - ' . $order->order_code)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Success Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" style="background-color: #FFFFFF;">
                <div class="p-4 p-md-5 text-center text-white" style="background: linear-gradient(135deg, #38190B, #5A2C18);">
                    <div class="rounded-circle bg-warning bg-opacity-25 d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-check2-circle fs-1 text-warning"></i>
                    </div>
                    <h2 class="font-serif fw-bold mb-1">Terima Kasih Atas Pesanan Anda!</h2>
                    <p class="text-light text-opacity-80 mb-0">Pesanan telah berhasil didaftarkan dalam sistem IZZARA Oleh-Oleh.</p>
                </div>

                <div class="p-4 p-md-5">
                    <!-- Invoice Summary -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center pb-3 border-bottom mb-4">
                        <div>
                            <small class="text-muted d-block">Nomor Kode Pesanan</small>
                            <span class="fs-4 fw-bold font-monospace" style="color: var(--brand-primary);">{{ $order->order_code }}</span>
                        </div>
                        <div class="text-end">
                            <small class="text-muted d-block">Tanggal Transaksi</small>
                            <span class="fw-semibold">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold small text-muted text-uppercase mb-2"><i class="bi bi-person me-1"></i> Data Pembeli</h6>
                            <p class="mb-1"><strong>{{ $order->customer_name }}</strong></p>
                            <p class="small text-muted mb-1"><i class="bi bi-whatsapp me-1 text-success"></i> {{ $order->customer_phone }}</p>
                            <p class="small text-muted mb-0"><i class="bi bi-envelope me-1"></i> {{ $order->customer_email }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold small text-muted text-uppercase mb-2"><i class="bi bi-geo-alt me-1"></i> Alamat Pengiriman</h6>
                            <p class="small text-muted mb-0 lh-base">{{ $order->shipping_address }}</p>
                        </div>
                    </div>

                    <!-- Items Table -->
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
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
                                        <strong>{{ $item->product->name ?? 'Produk Dihapus' }}</strong>
                                        <small class="d-block text-muted">Kode: {{ $item->product->product_code ?? '-' }}</small>
                                    </td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">{{ $item->formatted_price }}</td>
                                    <td class="text-end fw-semibold">{{ $item->formatted_subtotal }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Metode Pembayaran:</th>
                                    <th class="text-end">{{ $order->payment_method_label }}</th>
                                </tr>
                                <tr class="table-warning">
                                    <th colspan="3" class="text-end fs-5" style="color: var(--brand-primary);">Total Pembayaran:</th>
                                    <th class="text-end fs-5 fw-bold" style="color: var(--brand-primary);">{{ $order->formatted_total }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Payment Guide Box -->
                    <div class="p-3 rounded-3 mb-4" style="background-color: var(--brand-cream); border: 1px solid var(--brand-border);">
                        <h6 class="fw-bold mb-2" style="color: var(--brand-primary);"><i class="bi bi-info-circle-fill me-1 text-warning"></i> Petunjuk Pembayaran</h6>
                        @if($order->payment_method === 'transfer_bca')
                            <p class="small mb-1">Silakan transfer tepat sebesar <strong>{{ $order->formatted_total }}</strong> ke rekening berikut:</p>
                            <p class="mb-0 fw-bold font-monospace">Bank BCA: 8890-1234-56 a.n. PT Istana Oleh-Oleh Indonesia</p>
                        @elseif($order->payment_method === 'transfer_mandiri')
                            <p class="small mb-1">Silakan transfer tepat sebesar <strong>{{ $order->formatted_total }}</strong> ke rekening berikut:</p>
                            <p class="mb-0 fw-bold font-monospace">Bank Mandiri: 137-00-9876543-2 a.n. PT Istana Oleh-Oleh Indonesia</p>
                        @elseif($order->payment_method === 'transfer_bri')
                            <p class="small mb-1">Silakan transfer tepat sebesar <strong>{{ $order->formatted_total }}</strong> ke rekening berikut:</p>
                            <p class="mb-0 fw-bold font-monospace">Bank BRI: 0341-01-000123-50-8 a.n. PT Istana Oleh-Oleh Indonesia</p>
                        @elseif($order->payment_method === 'qris')
                            <p class="small mb-1">Silakan scan kode QRIS IZZARA melalui aplikasi e-wallet (Gopay, OVO, Dana, ShopeePay) atau mobile banking Anda saat konfirmasi.</p>
                        @else
                            <p class="small mb-0">Pesanan COD akan diproses dan pembayaran dilakukan tunai saat kurir tiba di lokasi Anda.</p>
                        @endif
                    </div>

                    <!-- Direct WhatsApp Confirmation Button -->
                    @php
                        $confirmMessage = "Halo Admin IZZARA, saya telah membuat pesanan di website:\nKode Pesanan: " . $order->order_code . "\nNama: " . $order->customer_name . "\nTotal: " . $order->formatted_total . "\nMetode: " . $order->payment_method_label . "\nMohon konfirmasi dan info nomor resi jika sudah dikirim. Terima kasih.";
                        $waConfirmUrl = "https://wa.me/6281234567890?text=" . urlencode($confirmMessage);
                    @endphp

                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <a href="{{ $waConfirmUrl }}" target="_blank" class="btn btn-success btn-lg flex-grow-1 shadow-sm">
                            <i class="bi bi-whatsapp me-2 fs-5"></i> Konfirmasi Pesanan via WhatsApp
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="bi bi-bag-plus me-1"></i> Belanja Lagi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
