@php
    $pageTitle = trim($__env->yieldContent('title')) ?: 'Halaman';
    $home = ['label' => 'Beranda', 'url' => route('dashboard')];

    $crumbs = [$home];

    if (request()->routeIs('dashboard')) {
        $crumbs[] = ['label' => 'Dashboard', 'current' => true];
    } elseif (request()->routeIs('kategori.index')) {
        $crumbs[] = ['label' => 'Inventori'];
        $crumbs[] = ['label' => 'Kategori', 'current' => true];
    } elseif (request()->routeIs('kategori.create')) {
        $crumbs[] = ['label' => 'Inventori'];
        $crumbs[] = ['label' => 'Kategori', 'url' => route('kategori.index')];
        $crumbs[] = ['label' => 'Tambah', 'current' => true];
    } elseif (request()->routeIs('kategori.edit')) {
        $crumbs[] = ['label' => 'Inventori'];
        $crumbs[] = ['label' => 'Kategori', 'url' => route('kategori.index')];
        $crumbs[] = ['label' => 'Edit', 'current' => true];
    } elseif (request()->routeIs('produk.index')) {
        $crumbs[] = ['label' => 'Inventori'];
        $crumbs[] = ['label' => 'Produk', 'current' => true];
    } elseif (request()->routeIs('produk.create')) {
        $crumbs[] = ['label' => 'Inventori'];
        $crumbs[] = ['label' => 'Produk', 'url' => route('produk.index')];
        $crumbs[] = ['label' => 'Tambah', 'current' => true];
    } elseif (request()->routeIs('produk.edit')) {
        $crumbs[] = ['label' => 'Inventori'];
        $crumbs[] = ['label' => 'Produk', 'url' => route('produk.index')];
        $crumbs[] = ['label' => 'Edit', 'current' => true];
    } elseif (request()->routeIs('stok.*')) {
        $crumbs[] = ['label' => 'Inventori'];
        $crumbs[] = ['label' => 'Stok', 'current' => true];
    } elseif (request()->routeIs('laporan.show')) {
        $crumbs[] = ['label' => 'Insight'];
        $crumbs[] = ['label' => 'Laporan', 'url' => route('laporan.index')];
        $crumbs[] = ['label' => 'Detail', 'current' => true];
    } elseif (request()->routeIs('laporan.*')) {
        $crumbs[] = ['label' => 'Insight'];
        $crumbs[] = ['label' => 'Laporan', 'current' => true];
    } elseif (request()->routeIs('grafik.*')) {
        $crumbs[] = ['label' => 'Insight'];
        $crumbs[] = ['label' => 'Grafik', 'current' => true];
    } elseif (request()->routeIs('akun-kasir.index')) {
        $crumbs[] = ['label' => 'Tim'];
        $crumbs[] = ['label' => 'Akun Kasir', 'current' => true];
    } elseif (request()->routeIs('akun-kasir.create')) {
        $crumbs[] = ['label' => 'Tim'];
        $crumbs[] = ['label' => 'Akun Kasir', 'url' => route('akun-kasir.index')];
        $crumbs[] = ['label' => 'Tambah', 'current' => true];
    } elseif (request()->routeIs('akun-kasir.edit')) {
        $crumbs[] = ['label' => 'Tim'];
        $crumbs[] = ['label' => 'Akun Kasir', 'url' => route('akun-kasir.index')];
        $crumbs[] = ['label' => 'Edit', 'current' => true];
    } elseif (request()->routeIs('akun-kasir.reset-password')) {
        $crumbs[] = ['label' => 'Tim'];
        $crumbs[] = ['label' => 'Akun Kasir', 'url' => route('akun-kasir.index')];
        $crumbs[] = ['label' => 'Reset Password', 'current' => true];
    } else {
        $crumbs[] = ['label' => $pageTitle, 'current' => true];
    }

    if (isset($override) && is_array($override)) {
        $crumbs = $override;
    }
@endphp

<nav class="ruto-breadcrumb" aria-label="Breadcrumb">
    <ol class="ruto-breadcrumb-list">
        @foreach ($crumbs as $index => $crumb)
            <li class="ruto-breadcrumb-item{{ !empty($crumb['current']) ? ' is-current' : '' }}">
                @if (!empty($crumb['current']))
                    <span class="ruto-breadcrumb-current" aria-current="page">{{ $crumb['label'] }}</span>
                @elseif (!empty($crumb['url']))
                    <a href="{{ $crumb['url'] }}" class="ruto-breadcrumb-link">{{ $crumb['label'] }}</a>
                @else
                    <span class="ruto-breadcrumb-section">{{ $crumb['label'] }}</span>
                @endif
                @if ($index < count($crumbs) - 1)
                    <span class="ruto-breadcrumb-sep" aria-hidden="true">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
