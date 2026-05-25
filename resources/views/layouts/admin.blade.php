<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — RUTO</title>
    <script>
        (function () {
            try {
                var t = localStorage.getItem('ruto-admin-theme');
                if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.setAttribute('data-theme', 'dark');
                }
            } catch (e) {}
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/css/ruto-admin.css', 'resources/js/app.js', 'resources/js/ruto-admin.js'])
    @stack('styles')
</head>
<body class="ruto-admin-body">
    <div class="ruto-admin-shell">
        <aside class="ruto-sidebar" aria-label="Navigasi utama">
            <div class="ruto-sidebar-orb ruto-sidebar-orb--1" aria-hidden="true"></div>
            <div class="ruto-sidebar-orb ruto-sidebar-orb--2" aria-hidden="true"></div>

            <a href="{{ route('dashboard') }}" class="ruto-sidebar-brand">
                <div class="ruto-sidebar-logo-ring">
                    <x-ruto-logo class="ruto-sidebar-logo" />
                </div>
                <div class="ruto-sidebar-brand-text">
                    <span class="ruto-sidebar-title">RUTO</span>
                    <span class="ruto-sidebar-sub">Coffee · Store OS</span>
                </div>
            </a>

            <nav class="ruto-sidebar-nav">
                <x-admin.nav-group label="Ringkasan">
                    <x-admin.nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="dashboard" :delay="0">Dashboard</x-admin.nav-link>
                </x-admin.nav-group>

                <x-admin.nav-group label="Inventori">
                    <x-admin.nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.*')" icon="kategori" :delay="50">Kategori</x-admin.nav-link>
                    <x-admin.nav-link :href="route('produk.index')" :active="request()->routeIs('produk.*')" icon="produk" :delay="100">Produk</x-admin.nav-link>
                    <x-admin.nav-link :href="route('stok.index')" :active="request()->routeIs('stok.*')" icon="stok" :delay="150">Stok</x-admin.nav-link>
                </x-admin.nav-group>

                <x-admin.nav-group label="Insight">
                    <x-admin.nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.*')" icon="laporan" :delay="200">Laporan</x-admin.nav-link>
                    <x-admin.nav-link :href="route('grafik.index')" :active="request()->routeIs('grafik.*')" icon="grafik" :delay="250">Grafik</x-admin.nav-link>
                </x-admin.nav-group>

                <x-admin.nav-group label="Tim">
                    <x-admin.nav-link :href="route('akun-kasir.index')" :active="request()->routeIs('akun-kasir.*')" icon="kasir" :delay="300">Akun Kasir</x-admin.nav-link>
                </x-admin.nav-group>
            </nav>

            <div class="ruto-sidebar-footer">
                <div class="ruto-user-card">
                    <div class="ruto-user-avatar" aria-hidden="true">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="ruto-user-meta">
                        <p class="ruto-user-name">{{ auth()->user()->name }}</p>
                        <p class="ruto-user-role">
                            <span class="ruto-user-dot"></span>
                            Administrator
                        </p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="ruto-user-logout-form">
                        @csrf
                        <button type="submit" class="ruto-user-logout" title="Keluar">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="ruto-main">
            <header class="ruto-topbar">
                <div class="ruto-topbar-start">
                    @hasSection('breadcrumb')
                        @yield('breadcrumb')
                    @else
                        <x-admin.breadcrumb />
                    @endif
                    <h1 class="ruto-topbar-title">@yield('title')</h1>
                </div>
                <div class="ruto-topbar-actions">
                    <span class="ruto-topbar-date">{{ now()->format('l, d F Y') }}</span>
                    <button
                        type="button"
                        id="ruto-theme-toggle"
                        class="ruto-theme-toggle"
                        aria-pressed="false"
                        aria-label="Ganti tema tampilan"
                    >
                        <span class="ruto-theme-track" aria-hidden="true">
                            <span class="ruto-theme-thumb"></span>
                        </span>
                        <span class="ruto-theme-icon ruto-theme-icon--sun" aria-hidden="true">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </span>
                        <span class="ruto-theme-icon ruto-theme-icon--moon" aria-hidden="true">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        </span>
                    </button>
                </div>
            </header>

            <main class="ruto-content">
                @if (session('success'))
                    <div class="ruto-alert ruto-alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="ruto-alert ruto-alert-error">{{ session('error') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
