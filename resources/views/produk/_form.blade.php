<form action="{{ $produk ? route('produk.update', $produk) : route('produk.store') }}" method="POST">
    @csrf
    @if ($produk) @method('PUT') @endif

    <div class="ruto-field">
        <label>Kategori</label>
        <select name="kategori_id" class="ruto-select" required>
            <option value="">Pilih kategori</option>
            @foreach ($kategori as $kat)
                <option value="{{ $kat->id }}" @selected(old('kategori_id', $produk?->kategori_id) == $kat->id)>{{ $kat->nama_kategori }}</option>
            @endforeach
        </select>
        @error('kategori_id')<p class="ruto-field-error">{{ $message }}</p>@enderror
    </div>

    <div class="ruto-field">
        <label>Nama Produk</label>
        <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk?->nama_produk) }}" class="ruto-input" required>
        @error('nama_produk')<p class="ruto-field-error">{{ $message }}</p>@enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="ruto-field">
            <label>Harga Modal</label>
            <input type="number" name="harga_modal" value="{{ old('harga_modal', $produk?->harga_modal) }}" min="0" step="0.01" class="ruto-input" required>
            @error('harga_modal')<p class="ruto-field-error">{{ $message }}</p>@enderror
        </div>
        <div class="ruto-field">
            <label>Harga Jual</label>
            <input type="number" name="harga_jual" value="{{ old('harga_jual', $produk?->harga_jual) }}" min="0" step="0.01" class="ruto-input" required>
            @error('harga_jual')<p class="ruto-field-error">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="ruto-field">
            <label>Stok</label>
            <input type="number" name="stok" value="{{ old('stok', $produk?->stok ?? 0) }}" min="0" class="ruto-input" required>
            @error('stok')<p class="ruto-field-error">{{ $message }}</p>@enderror
        </div>
        <div class="ruto-field">
            <label>Status</label>
            <select name="status" class="ruto-select" required>
                <option value="aktif" @selected(old('status', $produk?->status ?? 'aktif') === 'aktif')>Aktif</option>
                <option value="nonaktif" @selected(old('status', $produk?->status) === 'nonaktif')>Nonaktif</option>
            </select>
            @error('status')<p class="ruto-field-error">{{ $message }}</p>@enderror
        </div>
    </div>

    <x-admin.form-actions :cancel="route('produk.index')" />
</form>
