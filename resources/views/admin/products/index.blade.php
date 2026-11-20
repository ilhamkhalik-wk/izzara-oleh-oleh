@extends('layouts.admin')

@section('title', 'Kelola Produk')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h2 class="fw-bold mb-1" style="color: var(--brand-primary); font-family: 'Playfair Display', serif;">Kelola Data Produk</h2>
        <p class="text-muted small mb-0">Manajemen katalog produk oleh-oleh, harga, stok, dan foto produk.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-brand-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Produk Baru
    </a>
</div>

<!-- Filter Box -->
<div class="card card-custom p-3 mb-4">
    <form action="{{ route('admin.products.index') }}" method="GET" class="row g-2 align-items-center">
        <div class="col-md-5">
            <div class="input-group">
                <span class="input-group-text bg-light text-muted"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau kode produk..." value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-md-4">
            <select name="category_id" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-outline-primary w-100">
                <i class="bi bi-funnel me-1"></i> Filter
            </button>
            @if(request()->hasAny(['search', 'category_id']))
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary" title="Reset">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Products Table -->
<div class="card card-custom">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 70px;">Foto</th>
                    <th>Nama & Kode Produk</th>
                    <th>Kategori</th>
                    <th class="text-end">Harga</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Berat</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Unggulan</th>
                    <th class="text-end" style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $prod)
                <tr>
                    <td>{{ $products->firstItem() + $index }}</td>
                    <td>
                        <img src="{{ $prod->image_url }}" alt="{{ $prod->name }}" class="rounded shadow-sm" style="width: 55px; height: 50px; object-fit: cover;">
                    </td>
                    <td>
                        <strong class="d-block text-dark">{{ $prod->name }}</strong>
                        <span class="badge bg-light text-secondary border font-monospace">{{ $prod->product_code }}</span>
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border">{{ $prod->category->name }}</span>
                    </td>
                    <td class="text-end fw-bold" style="color: var(--brand-primary);">
                        {{ $prod->formatted_price }}
                    </td>
                    <td class="text-center">
                        @if($prod->stock <= 5)
                            <span class="badge bg-danger">{{ $prod->stock }}</span>
                        @elseif($prod->stock <= 15)
                            <span class="badge bg-warning text-dark">{{ $prod->stock }}</span>
                        @else
                            <span class="badge bg-success">{{ $prod->stock }}</span>
                        @endif
                    </td>
                    <td class="text-center small text-muted">{{ $prod->weight }} gr</td>
                    <td class="text-center">
                        @if($prod->is_active)
                            <span class="badge bg-success bg-opacity-75"><i class="bi bi-check-circle me-1"></i>Aktif</span>
                        @else
                            <span class="badge bg-secondary"><i class="bi bi-x-circle me-1"></i>Nonaktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($prod->is_featured)
                            <span class="badge bg-warning text-dark"><i class="bi bi-star-fill text-danger me-1"></i>Ya</span>
                        @else
                            <span class="badge bg-light text-muted border">Tidak</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="d-inline-flex gap-1">
                            <a href="{{ route('products.show', $prod->slug) }}" target="_blank" class="btn btn-sm btn-outline-info py-1 px-2" title="Lihat Publik">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.products.edit', $prod->id) }}" class="btn btn-sm btn-outline-warning text-dark py-1 px-2" title="Ubah Produk">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $prod->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk {{ $prod->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2" title="Hapus Produk">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-5 text-muted">Belum ada produk yang ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
