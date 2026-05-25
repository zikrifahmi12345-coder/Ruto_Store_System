@extends('layouts.admin')

@section('title', 'Kategori')

@section('content')
<div class="ruto-page-header ruto-fade-in">
    <p class="ruto-page-desc">Kelola kategori produk</p>
    <a href="{{ route('kategori.create') }}" class="ruto-btn-primary">+ Tambah Kategori</a>
</div>

<div class="ruto-card ruto-fade-in-delay-1">
    <div class="ruto-table-wrap">
        <table class="ruto-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Produk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategori as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_kategori }}</td>
                        <td>{{ $item->produk_count }}</td>
                        <td class="space-x-2">
                            <a href="{{ route('kategori.edit', $item) }}" class="ruto-link">Edit</a>
                            <form action="{{ route('kategori.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ruto-link-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="ruto-empty">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
