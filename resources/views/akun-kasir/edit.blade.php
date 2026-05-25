@extends('layouts.admin')

@section('title', 'Edit Akun Kasir')

@section('content')
<div class="ruto-card ruto-card-padded ruto-form-card ruto-fade-in">
    <form action="{{ route('akun-kasir.update', $kasir) }}" method="POST">
        @csrf
        @method('PUT')
        @include('akun-kasir._form', ['kasir' => $kasir, 'showPassword' => false, 'showAktif' => true])
        <x-admin.form-actions submit="Update" :cancel="route('akun-kasir.index')" />
    </form>
</div>
@endsection
