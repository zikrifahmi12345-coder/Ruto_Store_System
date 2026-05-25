@extends('layouts.admin')

@section('title', 'Tambah Akun Kasir')

@section('content')
<div class="ruto-card ruto-card-padded ruto-form-card ruto-fade-in">
    <form action="{{ route('akun-kasir.store') }}" method="POST">
        @csrf
        @include('akun-kasir._form', ['kasir' => null, 'showPassword' => true, 'showAktif' => false])
        <x-admin.form-actions :cancel="route('akun-kasir.index')" />
    </form>
</div>
@endsection
