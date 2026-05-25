@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="ruto-welcome-banner">
    <h2>Selamat datang, {{ auth()->user()->name }}</h2>
    <p>Ringkasan operasional RUTO Coffee Shop hari ini.</p>
</div>

<div class="ruto-stat-grid">
    <div class="ruto-stat-card ruto-fade-in-delay-1">
        <svg class="ruto-stat-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        <p class="ruto-stat-label">Total Produk</p>
        <p class="ruto-stat-value">{{ $totalProduk }}</p>
    </div>
    <div class="ruto-stat-card ruto-fade-in-delay-2">
        <svg class="ruto-stat-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
        <p class="ruto-stat-label">Total Kategori</p>
        <p class="ruto-stat-value">{{ $totalKategori }}</p>
    </div>
    <div class="ruto-stat-card ruto-fade-in-delay-3">
        <svg class="ruto-stat-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        <p class="ruto-stat-label">Transaksi Hari Ini</p>
        <p class="ruto-stat-value">{{ $jumlahTransaksiHariIni }}</p>
    </div>
    <div class="ruto-stat-card ruto-fade-in-delay-4">
        <svg class="ruto-stat-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="ruto-stat-label">Penjualan Hari Ini</p>
        <p class="ruto-stat-value highlight">Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</p>
    </div>
</div>

<div class="ruto-grid-2">
    <div class="ruto-card ruto-card-padded ruto-fade-in-delay-5">
        <h3 class="ruto-card-title">Stok Rendah (&lt; 10)</h3>
        @forelse ($stokRendah as $item)
            <div class="ruto-list-item">
                <span>{{ $item->nama_produk }}</span>
                <span class="ruto-badge ruto-badge-danger">{{ $item->stok }} unit</span>
            </div>
        @empty
            <p class="ruto-empty">Semua stok aman.</p>
        @endforelse
    </div>

    <div class="ruto-card ruto-card-padded ruto-fade-in-delay-6">
        <h3 class="ruto-card-title">Penjualan Terbaru</h3>
        @forelse ($penjualanTerbaru as $trx)
            <div class="ruto-list-item">
                <span>{{ $trx->kode_transaksi }} <span class="text-gray-400">—</span> {{ $trx->user->name }}</span>
                <span class="font-medium" style="color: var(--ruto-brand-dark)">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</span>
            </div>
        @empty
            <p class="ruto-empty">Belum ada transaksi.</p>
        @endforelse
    </div>
</div>
@endsection
