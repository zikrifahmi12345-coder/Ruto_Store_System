@extends('layouts.admin')

@section('title', 'Stok')

@section('content')
<div class="ruto-grid-2 ruto-fade-in">
    <div class="ruto-card ruto-card-padded">
        <h3 class="ruto-card-title">Tambah Stok Masuk</h3>
        <form action="{{ route('stok.store') }}" method="POST">
            @csrf
            <div class="ruto-field">
                <label>Produk</label>
                <select name="produk_id" class="ruto-select" required>
                    <option value="">Pilih produk</option>
                    @foreach ($produk as $item)
                        <option value="{{ $item->id }}" @selected(old('produk_id') == $item->id)>
                            {{ $item->nama_produk }} (stok: {{ $item->stok }})
                        </option>
                    @endforeach
                </select>
                @error('produk_id')<p class="ruto-field-error">{{ $message }}</p>@enderror
            </div>
            <div class="ruto-field">
                <label>Jumlah</label>
                <input type="number" name="jumlah" value="{{ old('jumlah') }}" min="1" class="ruto-input" required>
                @error('jumlah')<p class="ruto-field-error">{{ $message }}</p>@enderror
            </div>
            <div class="ruto-field">
                <label>Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', today()->format('Y-m-d')) }}" class="ruto-input" required>
                @error('tanggal')<p class="ruto-field-error">{{ $message }}</p>@enderror
            </div>
            <div class="ruto-field">
                <label>Keterangan</label>
                <textarea name="keterangan" rows="2" class="ruto-textarea">{{ old('keterangan') }}</textarea>
            </div>
            <button type="submit" class="ruto-btn-primary">Simpan Stok</button>
        </form>
    </div>

    <div class="ruto-card ruto-card-padded">
        <h3 class="ruto-card-title">Stok Produk Saat Ini</h3>
        <div class="max-h-96 overflow-y-auto">
            @foreach ($produk as $item)
                <div class="ruto-list-item">
                    <span>{{ $item->nama_produk }}</span>
                    @if ($item->stok < 10)
                        <span class="ruto-badge ruto-badge-danger">{{ $item->stok }} unit</span>
                    @else
                        <span>{{ $item->stok }} unit</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="ruto-card ruto-fade-in-delay-1 mt-6">
    <div class="ruto-card-padded pb-0">
        <h3 class="ruto-card-title mb-0">Riwayat Stok Masuk Terbaru</h3>
    </div>
    <div class="ruto-table-wrap">
        <table class="ruto-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th class="text-right">Jumlah</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayat as $row)
                    <tr>
                        <td>{{ $row->tanggal->format('d/m/Y') }}</td>
                        <td>{{ $row->produk->nama_produk }}</td>
                        <td class="text-right"><span class="ruto-badge ruto-badge-success">+{{ $row->jumlah }}</span></td>
                        <td>{{ $row->keterangan ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="ruto-empty">Belum ada riwayat stok masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
