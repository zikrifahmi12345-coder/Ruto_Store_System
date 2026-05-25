@extends('layouts.admin')

@section('title', 'Detail Transaksi')

@section('content')
<a href="{{ route('laporan.index') }}" class="ruto-link ruto-fade-in" style="display:inline-block;margin-bottom:1rem;">&larr; Kembali ke laporan</a>

<div class="ruto-card ruto-card-padded ruto-fade-in-delay-1" style="max-width:42rem;">
    <div class="mb-4 text-sm space-y-1" style="color:var(--ruto-text-muted);">
        <p><strong style="color:var(--ruto-text)">Kode:</strong> {{ $transaksi->kode_transaksi }}</p>
        <p><strong style="color:var(--ruto-text)">Tanggal:</strong> {{ $transaksi->tanggal->format('d/m/Y') }}</p>
        <p><strong style="color:var(--ruto-text)">Kasir:</strong> {{ $transaksi->user->name }}</p>
    </div>

    <div class="ruto-table-wrap">
        <table class="ruto-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->details as $detail)
                    <tr>
                        <td>{{ $detail->produk->nama_produk }}</td>
                        <td class="text-right">{{ $detail->qty }}</td>
                        <td class="text-right">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="background:var(--ruto-cream);font-weight:600;">
                    <td colspan="3" class="text-right">Total</td>
                    <td class="text-right">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                </tr>
                <tr style="background:var(--ruto-cream);">
                    <td colspan="3" class="text-right">Bayar / Kembalian</td>
                    <td class="text-right">
                        Rp {{ number_format($transaksi->bayar, 0, ',', '.') }} /
                        Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
