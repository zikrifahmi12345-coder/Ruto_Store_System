<div class="ruto-field">
    <label>Nama</label>
    <input type="text" name="name" value="{{ old('name', $kasir?->name) }}" class="ruto-input" required>
    @error('name')<p class="ruto-field-error">{{ $message }}</p>@enderror
</div>

<div class="ruto-field">
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $kasir?->email) }}" class="ruto-input" required>
    @error('email')<p class="ruto-field-error">{{ $message }}</p>@enderror
</div>

@if ($showPassword ?? false)
    <div class="ruto-field">
        <label>Password</label>
        <input type="password" name="password" class="ruto-input" required>
        @error('password')<p class="ruto-field-error">{{ $message }}</p>@enderror
    </div>
    <div class="ruto-field">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="ruto-input" required>
    </div>
@endif

@if ($showAktif ?? false)
    <div class="ruto-field">
        <label>Status Akun</label>
        <select name="aktif" class="ruto-select" required>
            <option value="1" @selected((string) old('aktif', $kasir?->aktif ? 1 : 0) === '1')>Aktif — bisa login</option>
            <option value="0" @selected((string) old('aktif', $kasir?->aktif ? 1 : 0) === '0')>Nonaktif — resign / berhenti</option>
        </select>
        <p class="text-xs mt-1" style="color:var(--ruto-text-muted);">Kasir nonaktif tidak bisa masuk ke sistem.</p>
        @error('aktif')<p class="ruto-field-error">{{ $message }}</p>@enderror
    </div>
@endif
