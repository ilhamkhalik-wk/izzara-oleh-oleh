@extends('layouts.admin')

@section('title', 'Dashboard Administrator')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1" style="color: var(--brand-primary); font-family: 'Playfair Display', serif;">Dashboard Ringkasan</h2>
        <p class="text-muted small mb-0">Selamat datang, <strong>{{ Auth::user()->name }}</strong>. Pantau kinerja UMKM IZZARA secara real-time.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.products.create') }}" class="btn btn-brand-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Produk
        </a>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-tag me-1"></i> Tambah Kategori
        </a>
    </div>
</div>

<!-- 4 Metrics Counter Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card card-custom p-3 border-start border-4 border-primary h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small text-uppercase fw-bold">Total Produk</span>
                    <h3 class="fw-bold mb-0 mt-1" style="color: var(--brand-primary);">{{ $totalProducts }}</h3>
                    <small class="text-success"><i class="bi bi-check-circle me-1"></i> Aktif di Katalog</small>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #EBF3FC; color: #0d6efd;">
                    <i class="bi bi-box-seam fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card card-custom p-3 border-start border-4 border-warning h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small text-uppercase fw-bold">Total Kategori</span>
                    <h3 class="fw-bold mb-0 mt-1" style="color: var(--brand-primary);">{{ $totalCategories }}</h3>
                    <small class="text-muted"><i class="bi bi-folder me-1"></i> 4 Kategori Utama</small>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #FFF8E6; color: #c59b27;">
                    <i class="bi bi-tags fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card card-custom p-3 border-start border-4 border-success h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small text-uppercase fw-bold">Total Pesanan</span>
                    <h3 class="fw-bold mb-0 mt-1" style="color: var(--brand-primary);">{{ $totalOrders }}</h3>
                    <small class="text-muted"><i class="bi bi-cart-check me-1"></i> Transaksi Masuk</small>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #EAF7EE; color: #198754;">
                    <i class="bi bi-bag-check fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card card-custom p-3 border-start border-4 border-danger h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small text-uppercase fw-bold">Total Pendapatan</span>
                    <h4 class="fw-bold mb-0 mt-1" style="color: var(--brand-primary);">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                    <small class="text-muted"><i class="bi bi-cash-coin me-1"></i> Pesanan Terverifikasi</small>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #FDF2F2; color: #dc3545;">
                    <i class="bi bi-wallet2 fs-3"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Orders Table -->
    <div class="col-lg-8">
        <div class="card card-custom h-100">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <span><i class="bi bi-clock-history me-2 text-warning"></i> Pesanan Terbaru</span>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small">
                        <tr>
                            <th>Kode Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td>
                                <strong class="font-monospace text-primary">{{ $order->order_code }}</strong>
                                <small class="d-block text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</small>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $order->customer_name }}</div>
                                <small class="text-muted">{{ $order->customer_phone }}</small>
                            </td>
                            <td><strong>{{ $order->formatted_total }}</strong></td>
                            <td>{!! $order->status_badge !!}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada pesanan masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Low Stock Alert -->
    <div class="col-lg-4">
        <div class="card card-custom mb-4">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <span><i class="bi bi-exclamation-triangle-fill me-2 text-danger"></i> Peringatan Stok Menipis</span>
                <span class="badge bg-danger">{{ $lowStockProducts->count() }}</span>
            </div>
            <div class="p-3">
                <div class="d-flex flex-column gap-2">
                    @forelse($lowStockProducts as $low)
                    <div class="p-2 border rounded d-flex justify-content-between align-items-center bg-light">
                        <div class="overflow-hidden me-2">
                            <span class="fw-bold d-block text-truncate small">{{ $low->name }}</span>
                            <small class="text-muted">{{ $low->product_code }}</small>
                        </div>
                        <div class="text-end">
                            <span class="badge {{ $low->stock <= 5 ? 'bg-danger' : 'bg-warning text-dark' }} mb-1">
                                Sisa: {{ $low->stock }}
                            </span>
                            <div>
                                <a href="{{ route('admin.products.edit', $low->id) }}" class="small text-decoration-none">
                                    Restock <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="small text-muted mb-0 text-center py-2">Semua stok produk dalam kondisi aman.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Contact Messages -->
        <div class="card card-custom">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <span><i class="bi bi-envelope-open me-2 text-primary"></i> Pesan Kontak Masuk</span>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-secondary">Semua</a>
            </div>
            <div class="p-3">
                <div class="d-flex flex-column gap-2">
                    @forelse($recentMessages as $msg)
                    <div class="p-2 border rounded {{ $msg->is_read ? 'bg-light' : 'bg-warning bg-opacity-10' }}">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong class="small">{{ $msg->name }}</strong>
                            <small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="small text-muted mb-0 text-truncate">{{ $msg->subject }}</p>
                    </div>
                    @empty
                    <p class="small text-muted mb-0 text-center py-2">Belum ada pesan kontak masuk.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
