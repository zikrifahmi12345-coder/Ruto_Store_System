@extends('layouts.user')

@section('title', 'Pesanan Terkirim')

@section('content')
<div class="rc-success-page">
    <div class="rc-success-confetti" aria-hidden="true">
        <span></span><span></span><span></span><span></span><span></span>
    </div>

    <div class="rc-success-card">
        <div class="rc-success-icon">✓</div>
        <h2 class="rc-success-title">Pesanan Terkirim!</h2>
        <p class="rc-success-sub">Tunjukkan kode ini ke kasir <strong>RUTO COFFEE</strong> saat membayar.</p>

        <div class="rc-success-ticket">
            <p class="rc-success-ticket-label">Kode Pesanan</p>
            <p class="rc-success-ticket-code">{{ $pesanan->kode_pesanan }}</p>
            <div class="rc-success-ticket-divider"></div>
            <p class="rc-success-ticket-meta">{{ $pesanan->label_identitas }}</p>
            <p class="rc-success-ticket-total">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
        </div>

        <ul class="rc-success-items">
            @foreach ($pesanan->details as $detail)
                <li>
                    <span>{{ $detail->produk->nama_produk }} × {{ $detail->qty }}</span>
                    <span>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                </li>
            @endforeach
        </ul>

        <a href="{{ route('pesan.index') }}" class="rc-btn rc-btn-primary rc-btn-block">
            Pesan Lagi
        </a>
    </div>
</div>
@endsection
