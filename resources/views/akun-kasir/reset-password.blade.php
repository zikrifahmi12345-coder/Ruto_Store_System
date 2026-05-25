@extends('layouts.admin')

@section('title', 'Reset Password Kasir')

@section('content')
<div class="ruto-card ruto-card-padded ruto-form-card ruto-fade-in">
    <p class="ruto-page-desc mb-4">
        Reset password untuk <strong>{{ $kasir->name }}</strong> ({{ $kasir->email }}).
    </p>

    <form action="{{ route('akun-kasir.reset-password.update', $kasir) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="ruto-field">
            <label>Password Baru</label>
            <input type="password" name="password" class="ruto-input" required>
            @error('password')<p class="ruto-field-error">{{ $message }}</p>@enderror
        </div>

        <div class="ruto-field">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="ruto-input" required>
        </div>

        <div class="flex gap-2 mt-4">
            <button type="submit" class="ruto-btn-primary ruto-btn-warning">Reset Password</button>
            <a href="{{ route('akun-kasir.index') }}" class="ruto-btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
