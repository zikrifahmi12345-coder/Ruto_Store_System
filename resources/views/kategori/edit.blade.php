@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
<div class="ruto-card ruto-card-padded ruto-form-card ruto-fade-in">
    <form action="{{ route('kategori.update', $kategori) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="ruto-field">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" class="ruto-input" required>
            @error('nama_kategori')<p class="ruto-field-error">{{ $message }}</p>@enderror
        </div>
        <x-admin.form-actions submit="Update" :cancel="route('kategori.index')" />
    </form>
</div>
@endsection
