@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="ruto-card ruto-card-padded ruto-form-card ruto-fade-in">
    @include('produk._form', ['produk' => $produk])
</div>
@endsection
