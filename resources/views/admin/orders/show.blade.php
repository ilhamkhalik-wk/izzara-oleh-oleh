@extends('layouts.admin')

@section('title', 'Detail Pesanan: ' . $order->order_code)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1" style="color: var(--brand-primary); font-family: 'Playfair Display', serif;">Rincian Pesanan: {{ $order->order_code }}</h2>
        <p class="text-muted small mb-0">Informasi lengkap rincian barang, data pembeli, dan pembaruan status pesanan.</p>
    </div>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Pesanan
    </a>
</div>

<div class="row g-4">
    <!-- Left Column: Order Items & Delivery Info -->
    <div class="col-lg-8">
        <!-- Order Items -->
        <div class="card card-custom mb-4">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <span><i class="bi bi-bag-check me-2 text-warning"></i> Produk yang Dipesan</span>
                <span class="badge bg-light text-dark border">{{ $order->items->count() }} Jenis Item</span>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light small">
                        <tr>
                            <th>Item Produk</th>
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
                        <tr class="table-light">
                            <th colspan="3" class="text-end fs-5">Total Pembayaran:</th>
                            <th class="text-end fs-5 fw-bold" style="color: var(--brand-primary);">{{ $order->formatted_total }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Customer & Shipping Detail -->
        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-3" style="color: var(--brand-primary);"><i class="bi bi-geo-alt-fill me-2 text-danger"></i> Informasi Pengiriman & Pelanggan</h5>
            <div class="row g-3 small">
                <div class="col-md-6">
                    <label class="text-muted d-block">Nama Pembeli:</label>
                    <strong class="fs-6">{{ $order->customer_name }}</strong>
                </div>
                <div class="col-md-6">
                    <label class="text-muted d-block">Nomor WhatsApp:</label>
                    <strong><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}" target="_blank" class="text-success text-decoration-none"><i class="bi bi-whatsapp me-1"></i>{{ $order->customer_phone }}</a></strong>
                </div>
                <div class="col-md-6">
                    <label class="text-muted d-block">Alamat Email:</label>
                    <strong>{{ $order->customer_email }}</strong>
                </div>
                <div class="col-md-6">
                    <label class="text-muted d-block">Metode Pembayaran:</label>
                    <span class="badge bg-light text-dark border">{{ $order->payment_method_label }}</span>
                </div>
                <div class="col-12">
                    <label class="text-muted d-block">Alamat Pengiriman Lengkap:</label>
                    <div class="p-3 bg-light rounded border lh-base">{{ $order->shipping_address }}</div>
                </div>
                @if($order->notes)
                <div class="col-12">
                    <label class="text-muted d-block">Catatan Tambahan:</label>
                    <div class="p-2 bg-warning bg-opacity-10 border rounded fst-italic">{{ $order->notes }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Right Column: Status Update Card (Form A - No. 7 Edit Status Pesanan) -->
    <div class="col-lg-4">
        <div class="card card-custom p-4 mb-4 border-top border-4 border-warning">
            <h5 class="fw-bold mb-3" style="color: var(--brand-primary);"><i class="bi bi-pencil-square me-2 text-warning"></i> Edit Status Pesanan</h5>
            
            <div class="mb-3">
                <span class="text-muted small d-block mb-1">Status Saat Ini:</span>
                <div>{!! $order->status_badge !!}</div>
            </div>

            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="status" class="form-label fw-semibold small">Pilih Status Baru <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-select">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi (Pending)</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Diproses (Processing)</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Dikirim (Shipped)</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai (Completed)</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan (Cancelled)</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-brand-primary w-100 mb-2">
                    <i class="bi bi-check-circle me-1"></i> Perbarui Status
                </button>
            </form>
        </div>

        <!-- WhatsApp Customer Contact Action -->
        @php
            $waContactUrl = "https://wa.me/" . preg_replace('/[^0-9]/', '', $order->customer_phone) . "?text=" . urlencode("Halo Bapak/Ibu " . $order->customer_name . ", kami dari Admin IZZARA Oleh-Oleh mengonfirmasi pesanan Anda dengan Kode: " . $order->order_code . ". Status pesanan Anda saat ini: " . ucfirst($order->status) . ".");
        @endphp
        <div class="card card-custom p-3 bg-light text-center">
            <h6 class="fw-bold mb-2 small"><i class="bi bi-chat-dots me-1 text-success"></i> Hubungi Pembeli Langsung</h6>
            <a href="{{ $waContactUrl }}" target="_blank" class="btn btn-success btn-sm w-100">
                <i class="bi bi-whatsapp me-1"></i> Kirim Chat WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection
