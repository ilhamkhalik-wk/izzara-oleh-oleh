@extends('layouts.admin')

@section('title', 'Kelola Kategori')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1" style="color: var(--brand-primary); font-family: 'Playfair Display', serif;">Kelola Kategori Produk</h2>
        <p class="text-muted small mb-0">Daftar kategori produk oleh-oleh yang terdaftar di website.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-brand-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Kategori Baru
    </a>
</div>

<div class="card card-custom">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small">
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Nama Kategori</th>
                    <th>Slug URL</th>
                    <th>Deskripsi</th>
                    <th class="text-center" style="width: 140px;">Jumlah Produk</th>
                    <th class="text-end" style="width: 160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $category)
                <tr>
                    <td>{{ $categories->firstItem() + $index }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px; color: var(--brand-primary);">
                                <i class="bi {{ $category->icon }} fs-5"></i>
                            </div>
                            <strong style="color: var(--brand-primary);">{{ $category->name }}</strong>
                        </div>
                    </td>
                    <td><code class="small text-muted">{{ $category->slug }}</code></td>
                    <td class="small text-muted">{{ Str::limit($category->description, 80) }}</td>
                    <td class="text-center">
                        <span class="badge bg-secondary rounded-pill px-3 py-1">{{ $category->products_count }} Produk</span>
                    </td>
                    <td class="text-end">
                        <div class="d-inline-flex gap-1">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-warning text-dark py-1 px-2" title="Ubah Kategori">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $category->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2" title="Hapus Kategori">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Belum ada kategori yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($categories->hasPages())
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
