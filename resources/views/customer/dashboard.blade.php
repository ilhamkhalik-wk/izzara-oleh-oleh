@extends('layouts.app')

@section('title', 'Dashboard Pelanggan - ' . $user->name)

@section('content')
<!-- Header Banner -->
<div class="py-4 border-bottom" style="background: linear-gradient(135deg, #FAF4EB, #F0E6D8);">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1 small">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--brand-primary);"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Area Pelanggan</li>
                    </ol>
                </nav>
                <h2 class="font-serif fw-bold mb-0" style="color: var(--brand-primary);">Halo, {{ $user->name }}! 👋</h2>
                <small class="text-muted">Selamat datang di portal akun pelanggan IZZARA Oleh-Oleh.</small>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('orders.create') }}" class="btn btn-brand-gold btn-sm">
                    <i class="bi bi-bag-plus-fill me-1"></i> Belanja Produk Baru
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <!-- Sidebar Navigation -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 sticky-top" style="top: 90px; background-color: #FFFFFF;">
                <div class="text-center p-3 border-bottom mb-3">
                    <div class="rounded-circle bg-warning bg-opacity-25 d-inline-flex align-items-center justify-content-center mb-2 fw-bold fs-3 text-dark" style="width: 70px; height: 70px;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h6 class="fw-bold mb-0 text-truncate">{{ $user->name }}</h6>
                    <small class="text-muted">{{ $user->email }}</small>
                </div>

                <div class="list-group list-group-flush small">
                    <a href="{{ route('customer.dashboard') }}" class="list-group-item list-group-item-action py-2 border-0 rounded-3 mb-1 {{ request()->routeIs('customer.dashboard') ? 'active fw-bold' : '' }}" style="{{ request()->routeIs('customer.dashboard') ? 'background-color: var(--brand-primary); color: #FFF;' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Ringkasan Akun
                    </a>
                    <a href="{{ route('customer.orders') }}" class="list-group-item list-group-item-action py-2 border-0 rounded-3 mb-1 {{ request()->routeIs('customer.orders*') ? 'active fw-bold' : '' }}" style="{{ request()->routeIs('customer.orders*') ? 'background-color: var(--brand-primary); color: #FFF;' : '' }}">
                        <i class="bi bi-bag-check me-2"></i> Riwayat Pesanan Saya
                    </a>
                    <a href="{{ route('customer.profile') }}" class="list-group-item list-group-item-action py-2 border-0 rounded-3 mb-1 {{ request()->routeIs('customer.profile') ? 'active fw-bold' : '' }}" style="{{ request()->routeIs('customer.profile') ? 'background-color: var(--brand-primary); color: #FFF;' : '' }}">
                        <i class="bi bi-person-gear me-2"></i> Pengaturan Profil
                    </a>
                    <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action py-2 border-0 rounded-3 mb-1">
                        <i class="bi bi-grid me-2"></i> Katalog Lengkap
                    </a>
                </div>

                <div class="pt-3 border-top mt-3">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100 text-start d-flex align-items-center justify-content-center">
                            <i class="bi bi-box-arrow-left me-2"></i> Keluar (Logout)
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content Column -->
        <div class="col-lg-9">
            <!-- 4 Metric Cards -->
            <div class="row g-3 mb-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 p-3 h-100" style="background-color: #FFFFFF; border-left: 4px solid #0d6efd !important;">
                        <span class="text-muted small">Total Pesanan</span>
                        <h3 class="fw-bold mb-0 mt-1" style="color: var(--brand-primary);">{{ $totalOrders }}</h3>
                        <small class="text-muted">Semua Transaksi</small>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 p-3 h-100" style="background-color: #FFFFFF; border-left: 4px solid #ffc107 !important;">
                        <span class="text-muted small">Sedang Berjalan</span>
                        <h3 class="fw-bold mb-0 mt-1" style="color: var(--brand-primary);">{{ $processingOrders }}</h3>
                        <small class="text-warning">Diproses / Dikirim</small>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 p-3 h-100" style="background-color: #FFFFFF; border-left: 4px solid #198754 !important;">
                        <span class="text-muted small">Pesanan Selesai</span>
                        <h3 class="fw-bold mb-0 mt-1" style="color: var(--brand-primary);">{{ $completedOrders }}</h3>
                        <small class="text-success">Telah Diterima</small>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 p-3 h-100" style="background-color: #FFFFFF; border-left: 4px solid #dc3545 !important;">
                        <span class="text-muted small">Total Belanja</span>
                        <h4 class="fw-bold mb-0 mt-1 text-truncate" style="color: var(--brand-primary);">Rp {{ number_format($totalSpent, 0, ',', '.') }}</h4>
                        <small class="text-muted">Akumulasi Belanja</small>
                    </div>
                </div>
            </div>

            <!-- Profile Overview & Recent Orders -->
            <div class="card border-0 shadow-sm rounded-4 mb-4" style="background-color: #FFFFFF;">
                <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="font-serif fw-bold mb-0" style="color: var(--brand-primary);"><i class="bi bi-clock-history me-2 text-warning"></i> 5 Pesanan Terakhir Anda</h5>
                    <a href="{{ route('customer.orders') }}" class="btn btn-outline-secondary btn-sm">Lihat Semua</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th>Kode Pesanan</th>
                                <th>Tanggal</th>
                                <th>Total Bayar</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td>
                                    <strong class="font-monospace text-primary">{{ $order->order_code }}</strong>
                                </td>
                                <td class="small text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="fw-bold" style="color: var(--brand-primary);">{{ $order->formatted_total }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $order->payment_method_label }}</span></td>
                                <td>{!! $order->status_badge !!}</td>
                                <td class="text-end">
                                    <a href="{{ route('customer.orders.detail', $order->order_code) }}" class="btn btn-sm btn-outline-primary py-1 px-2">
                                        <i class="bi bi-receipt"></i> Nota
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-bag-x fs-1 d-block mb-2 text-muted"></i>
                                    Anda belum memiliki riwayat pesanan.
                                    <div class="mt-2">
                                        <a href="{{ route('products.index') }}" class="btn btn-brand-primary btn-sm">Mulai Belanja Oleh-Oleh</a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Default Delivery Address Card -->
            <div class="card border-0 shadow-sm rounded-4 p-4" style="background-color: #FFFFFF;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="font-serif fw-bold mb-0" style="color: var(--brand-primary);"><i class="bi bi-geo-alt-fill text-danger me-2"></i> Data Pengiriman Anda</h5>
                    <a href="{{ route('customer.profile') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-pencil-square me-1"></i> Ubah Data
                    </a>
                </div>
                <div class="row g-3 small">
                    <div class="col-md-4">
                        <span class="text-muted d-block">Nama Lengkap:</span>
                        <strong>{{ $user->name }}</strong>
                    </div>
                    <div class="col-md-4">
                        <span class="text-muted d-block">WhatsApp / HP:</span>
                        <strong>{{ $user->phone ?? '-' }}</strong>
                    </div>
                    <div class="col-md-4">
                        <span class="text-muted d-block">Alamat Email:</span>
                        <strong>{{ $user->email }}</strong>
                    </div>
                    <div class="col-12">
                        <span class="text-muted d-block">Alamat Pengiriman Utama:</span>
                        <div class="p-2 bg-light rounded border">{{ $user->address ?? 'Belum diisi. Silakan lengkapi di menu Pengaturan Profil.' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
