@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
<div class="ruto-card ruto-card-padded ruto-form-card ruto-fade-in">
    @include('produk._form', ['produk' => null])
</div>
@endsection
