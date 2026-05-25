@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
<form method="GET" class="ruto-card ruto-card-padded mb-4 flex flex-wrap gap-4 items-end ruto-fade-in">
    <div class="ruto-field mb-0">
        <label>Dari</label>
        <input type="date" name="dari" value="{{ $dari }}" class="ruto-input">
    </div>
    <div class="ruto-field mb-0">
        <label>Sampai</label>
        <input type="date" name="sampai" value="{{ $sampai }}" class="ruto-input">
    </div>
    <button type="submit" class="ruto-btn-primary">Filter</button>
</form>

<div class="ruto-stat-grid" style="grid-template-columns: repeat(2, 1fr);">
    <div class="ruto-stat-card ruto-fade-in-delay-1">
        <p class="ruto-stat-label">Total Transaksi</p>
        <p class="ruto-stat-value">{{ $totalTransaksi }}</p>
    </div>
    <div class="ruto-stat-card ruto-fade-in-delay-2">
        <p class="ruto-stat-label">Total Penjualan</p>
        <p class="ruto-stat-value highlight">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
    </div>
</div>

<div class="ruto-card ruto-fade-in-delay-3">
    <div class="ruto-table-wrap">
        <table class="ruto-table">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Kasir</th>
                    <th class="text-right">Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi as $trx)
                    <tr>
                        <td>{{ $trx->kode_transaksi }}</td>
                        <td>{{ $trx->tanggal->format('d/m/Y') }}</td>
                        <td>{{ $trx->user->name }}</td>
                        <td class="text-right">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('laporan.show', $trx) }}" class="ruto-link">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="ruto-empty">Tidak ada data pada periode ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
