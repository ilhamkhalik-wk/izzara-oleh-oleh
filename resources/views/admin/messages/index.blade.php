@extends('layouts.admin')

@section('title', 'Pesan Kontak Masuk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1" style="color: var(--brand-primary); font-family: 'Playfair Display', serif;">Pesan Masuk dari Formulir Kontak</h2>
        <p class="text-muted small mb-0">Daftar pertanyaan dan korespondensi yang dikirim pengunjung website publik.</p>
    </div>
</div>

<div class="card card-custom">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Pengirim</th>
                    <th>Subjek</th>
                    <th>Isi Pesan</th>
                    <th class="text-center" style="width: 120px;">Status</th>
                    <th class="text-end" style="width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $index => $msg)
                <tr class="{{ $msg->is_read ? '' : 'table-warning bg-opacity-25' }}">
                    <td>{{ $messages->firstItem() + $index }}</td>
                    <td>
                        <strong class="d-block text-dark">{{ $msg->name }}</strong>
                        <small class="text-muted d-block">{{ $msg->email }}</small>
                        @if($msg->phone)
                            <small class="text-muted"><i class="bi bi-whatsapp text-success me-1"></i>{{ $msg->phone }}</small>
                        @endif
                    </td>
                    <td>
                        <span class="fw-semibold">{{ $msg->subject }}</span>
                        <small class="d-block text-muted">{{ $msg->created_at->format('d/m/Y H:i') }}</small>
                    </td>
                    <td class="small text-muted" style="max-width: 300px;">
                        {{ $msg->message }}
                    </td>
                    <td class="text-center">
                        @if($msg->is_read)
                            <span class="badge bg-secondary">Sudah Dibaca</span>
                        @else
                            <span class="badge bg-warning text-dark"><i class="bi bi-envelope-fill me-1"></i>Baru</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="d-inline-flex gap-1">
                            <form action="{{ route('admin.messages.toggle', $msg->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-secondary py-1 px-2" title="{{ $msg->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}">
                                    <i class="bi {{ $msg->is_read ? 'bi-envelope' : 'bi-envelope-open' }}"></i>
                                </button>
                            </form>
                            @if($msg->phone)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}" target="_blank" class="btn btn-sm btn-outline-success py-1 px-2" title="Balas via WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            @endif
                            <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus pesan dari {{ $msg->name }}?');">
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
                    <td colspan="6" class="text-center py-5 text-muted">Belum ada pesan kontak masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($messages->hasPages())
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $messages->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
