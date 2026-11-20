@extends('layouts.app')

@section('title', 'Riwayat Pesanan Saya - IZZARA Oleh-Oleh')

@section('content')
<div class="py-4 border-bottom" style="background: linear-gradient(135deg, #FAF4EB, #F0E6D8);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--brand-primary);"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}" class="text-decoration-none" style="color: var(--brand-primary);">Area Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Riwayat Pesanan</li>
            </ol>
        </nav>
        <h2 class="font-serif fw-bold mb-0" style="color: var(--brand-primary);">Riwayat Pesanan Saya</h2>
        <small class="text-muted">Pantau status pengiriman dan riwayat pembelian oleh-oleh Anda.</small>
    </div>
</div>

<div class="container py-5">
    <!-- Filter Status Tabs -->
    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4" style="background-color: #FFFFFF;">
        <div class="d-flex flex-wrap gap-2 align-items-center">
            <span class="small text-muted me-2">Status:</span>
            <a href="{{ route('customer.orders') }}" class="btn btn-sm {{ !request('status') ? 'btn-brand-primary' : 'btn-outline-secondary' }}">
                Semua
            </a>
            <a href="{{ route('customer.orders', ['status' => 'pending']) }}" class="btn btn-sm {{ request('status') == 'pending' ? 'btn-warning text-dark fw-bold' : 'btn-outline-secondary' }}">
                Menunggu Konfirmasi
            </a>
            <a href="{{ route('customer.orders', ['status' => 'processing']) }}" class="btn btn-sm {{ request('status') == 'processing' ? 'btn-info text-dark fw-bold' : 'btn-outline-secondary' }}">
                Diproses
            </a>
            <a href="{{ route('customer.orders', ['status' => 'shipped']) }}" class="btn btn-sm {{ request('status') == 'shipped' ? 'btn-primary' : 'btn-outline-secondary' }}">
                Dikirim
            </a>
            <a href="{{ route('customer.orders', ['status' => 'completed']) }}" class="btn btn-sm {{ request('status') == 'completed' ? 'btn-success' : 'btn-outline-secondary' }}">
                Selesai
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="background-color: #FFFFFF;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Kode Pesanan</th>
                        <th>Tanggal Pesan</th>
                        <th>Item Produk</th>
                        <th class="text-end">Total Pembayaran</th>
                        <th class="text-center">Status</th>
                        <th class="text-end" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $index => $order)
                    <tr>
                        <td>{{ $orders->firstItem() + $index }}</td>
                        <td>
                            <strong class="font-monospace text-primary d-block">{{ $order->order_code }}</strong>
                            <small class="text-muted">{{ $order->payment_method_label }}</small>
                        </td>
                        <td class="small text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $order->items->count() }} Jenis Produk</span>
                            <small class="d-block text-muted text-truncate" style="max-width: 250px;">
                                {{ $order->items->first()->product->name ?? 'Produk' }}
                                @if($order->items->count() > 1)
                                    (+{{ $order->items->count() - 1 }} lainnya)
                                @endif
                            </small>
                        </td>
                        <td class="text-end fw-bold" style="color: var(--brand-primary);">
                            {{ $order->formatted_total }}
                        </td>
                        <td class="text-center">{!! $order->status_badge !!}</td>
                        <td class="text-end">
                            <a href="{{ route('customer.orders.detail', $order->order_code) }}" class="btn btn-sm btn-outline-primary py-1 px-3">
                                <i class="bi bi-eye me-1"></i> Rincian
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-muted"></i>
                            Tidak ada pesanan dengan status ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="p-3 border-top d-flex justify-content-center">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection
