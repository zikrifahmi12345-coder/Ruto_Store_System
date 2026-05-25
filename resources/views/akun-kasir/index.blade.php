@extends('layouts.admin')

@section('title', 'Akun Kasir')

@section('content')
<div class="ruto-page-header ruto-fade-in">
    <p class="ruto-page-desc">Kelola akun kasir — tambah, reset password, nonaktifkan, atau hapus</p>
    <a href="{{ route('akun-kasir.create') }}" class="ruto-btn-primary">+ Tambah Kasir</a>
</div>

<div class="ruto-alert ruto-alert-info ruto-fade-in-delay-1">
    <strong>Catatan:</strong> Kasir yang sudah punya riwayat transaksi tidak bisa dihapus — nonaktifkan saja agar laporan tetap aman.
</div>

<div class="ruto-card ruto-fade-in-delay-2">
    <div class="ruto-table-wrap">
        <table class="ruto-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th class="text-right">Transaksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kasir as $item)
                    <tr>
                        <td class="font-medium">{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            @if ($item->aktif)
                                <span class="ruto-badge ruto-badge-success">Aktif</span>
                            @else
                                <span class="ruto-badge ruto-badge-muted">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-right">{{ $item->transaksi_count }}</td>
                        <td class="space-x-2 whitespace-nowrap">
                            <a href="{{ route('akun-kasir.edit', $item) }}" class="ruto-link">Edit</a>
                            <a href="{{ route('akun-kasir.reset-password', $item) }}" class="ruto-link" style="color:#b45309;">Reset PW</a>
                            @if ($item->transaksi_count === 0)
                                <form action="{{ route('akun-kasir.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus akun {{ $item->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ruto-link-danger">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="ruto-empty">Belum ada akun kasir.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
