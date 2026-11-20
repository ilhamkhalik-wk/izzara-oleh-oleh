@extends('layouts.admin')

@section('title', 'Kelola Pesanan Pelanggan')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h2 class="fw-bold mb-1" style="color: var(--brand-primary); font-family: 'Playfair Display', serif;">Kelola Pesanan Pelanggan</h2>
        <p class="text-muted small mb-0">Pantau dan perbarui status pesanan yang masuk dari pelanggan toko.</p>
    </div>
    <a href="{{ route('admin.orders.create') }}" class="btn btn-brand-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Pesanan Manual
    </a>
</div>

<!-- Filter Toolbar -->
<div class="card card-custom p-3 mb-4">
    <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-2 align-items-center">
        <div class="col-md-5">
            <div class="input-group">
                <span class="input-group-text bg-light text-muted"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control" placeholder="Cari kode pesanan, nama, no HP..." value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-md-4">
            <select name="status" class="form-select">
                <option value="">Semua Status Pesanan</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi (Pending)</option>
                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Diproses (Processing)</option>
                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Dikirim (Shipped)</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai (Completed)</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan (Cancelled)</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-outline-primary w-100">
                <i class="bi bi-funnel me-1"></i> Filter
            </button>
            @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary" title="Reset">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Orders Table -->
<div class="card card-custom">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Kode & Tanggal</th>
                    <th>Data Pembeli</th>
                    <th>Metode Bayar</th>
                    <th class="text-end">Total Bayar</th>
                    <th class="text-center">Status</th>
                    <th class="text-end" style="width: 170px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $index => $order)
                <tr>
                    <td>{{ $orders->firstItem() + $index }}</td>
                    <td>
                        <strong class="font-monospace text-primary d-block">{{ $order->order_code }}</strong>
                        <small class="text-muted">{{ $order->created_at->format('d/m/Y H:i') }} WIB</small>
                    </td>
                    <td>
                        <div class="fw-bold text-dark">{{ $order->customer_name }}</div>
                        <small class="text-muted d-block"><i class="bi bi-whatsapp text-success me-1"></i>{{ $order->customer_phone }}</small>
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border">{{ $order->payment_method_label }}</span>
                    </td>
                    <td class="text-end fw-bold" style="color: var(--brand-primary);">
                        {{ $order->formatted_total }}
                    </td>
                    <td class="text-center">
                        {!! $order->status_badge !!}
                    </td>
                    <td class="text-end">
                        <div class="d-inline-flex gap-1">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2" title="Detail & Ubah Status">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Hapus pesanan {{ $order->order_code }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">Belum ada data pesanan.</td>
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
@endsection
