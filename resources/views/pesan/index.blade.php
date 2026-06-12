@extends('layouts.user')

@section('title', 'Menu')

@section('content')
<div x-data="pesanApp()" x-init="init()" class="rc-app">
    {{-- Toast --}}
    <div x-show="toast.show" x-transition.opacity.duration.300ms
         class="rc-toast" x-text="toast.message" role="status"></div>

    {{-- Undo bar --}}
    <div x-show="undoVisible" x-transition
         class="rc-undo-bar" role="status">
        <span class="rc-undo-text" x-text="undoAction?.label"></span>
        <button type="button" @click="batalkanAksi()" class="rc-undo-btn">Undo</button>
    </div>

    {{-- Top navbar (gaya kasir) --}}
    <nav class="rc-top-nav" aria-label="Menu utama">
        <button type="button" @click="pilihTab('beranda')" class="rc-top-tab"
            :class="{ 'is-active': tab === 'beranda' }">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span>Beranda</span>
        </button>
        <button type="button" @click="pilihTab('favorit')" class="rc-top-tab"
            :class="{ 'is-active': tab === 'favorit' }">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            <span>Favorit</span>
        </button>
        <button type="button" @click="pilihTab('kategori')" class="rc-top-tab"
            :class="{ 'is-active': tab === 'kategori' }">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            <span>Kategori</span>
        </button>
        <button type="button" @click="pilihTab('keranjang')" class="rc-top-tab rc-top-tab-cart"
            :class="{ 'is-active': tab === 'keranjang' || cartOpen }">
            <span class="rc-top-cart-wrap">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <span class="rc-nav-badge" x-show="cartCount > 0" x-text="cartCount"></span>
            </span>
            <span>Keranjang</span>
        </button>
    </nav>

    <div class="rc-layout">
        <div class="rc-layout-main">
            {{-- Beranda: meja + rekomendasi --}}
            <section x-show="tab === 'beranda'" x-transition class="rc-section">
                {{-- Hero Banner Slider (ala Contoh 1234) ─── --}}
                <div class="contoh-hero-banner" x-data="{ 
                    heroSlide: 0, 
                    heroSlides: [
                        {
                            subtitle: 'Ruto Coffee & Store',
                            title: 'Nikmati Aroma Kopi Premium',
                            desc: ''
                        },
                        {
                            subtitle: 'Ruto Coffee & Store',
                            title: 'Tempat Nongkrong dengan Rasa Istimewa',
                            desc: ''
                        },
                        {
                            subtitle: 'Ruto Coffee & Store',
                            title: 'Pesan Mudah, Nikmati Lebih Cepat',
                            desc: ''
                        }
                    ],
                    typewriterText: '',
                    typewriterIndex: 0,
                    isDeleting: false,
                    typeSpeed: 80,
                    deleteSpeed: 40,
                    pauseTime: 2000
                }" 
                x-init="
                    const typewriter = () => {
                        const currentSlide = heroSlides[heroSlide];
                        const fullText = currentSlide.title;
                        
                        if (!isDeleting) {
                            if (typewriterIndex < fullText.length) {
                                typewriterText = fullText.substring(0, typewriterIndex + 1);
                                typewriterIndex++;
                                setTimeout(typewriter, typeSpeed);
                            } else {
                                setTimeout(() => {
                                    isDeleting = true;
                                    typewriter();
                                }, pauseTime);
                            }
                        } else {
                            if (typewriterIndex > 0) {
                                typewriterText = fullText.substring(0, typewriterIndex - 1);
                                typewriterIndex--;
                                setTimeout(typewriter, deleteSpeed);
                            } else {
                                isDeleting = false;
                                heroSlide = (heroSlide + 1) % heroSlides.length;
                                setTimeout(typewriter, 500);
                            }
                        }
                    };
                    typewriter();
                ">
                    
                    <div class="contoh-hero-slides-container">
                        <template x-for="(slide, index) in heroSlides" :key="index">
                            <div x-show="heroSlide === index" 
                                 x-transition:enter="transition-opacity ease-out duration-500"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100"
                                 x-transition:leave="transition-opacity ease-in duration-300"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0"
                                 class="contoh-hero-text-col">
                                <span class="contoh-hero-subtitle" x-text="slide.subtitle"></span>
                                <h1 class="contoh-hero-title">
                                    <span x-text="typewriterText"></span>
                                    <span class="typewriter-cursor">|</span>
                                </h1>
                                <p class="contoh-hero-desc" x-text="slide.desc"></p>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="rc-beranda-menu">
                    <div class="rc-search-wrap">
                        <svg class="rc-search-icon" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="search" x-model="search" @input.debounce.300ms="filterProduk()"
                            class="rc-input rc-search-input" placeholder="Cari menu...">
                    </div>

                    <div class="rc-menu-section rc-menu-section--populer" x-show="top10Populer.length > 0">
                        <h2 class="rc-menu-heading">
                            <span>🔥 Top 10 Menu Populer</span>
                            <span class="rc-menu-count rc-menu-count--live" x-show="top10Populer.length > populerPerSlide">
                                <span class="rc-live-dot" aria-hidden="true"></span>
                                <span x-text="'Halaman ' + (populerSlideIndex + 1) + '/' + populerSlideCount"></span>
                            </span>
                        </h2>

                        <div class="rc-populer-carousel"
                            @mouseenter="populerPaused = true"
                            @mouseleave="populerPaused = false"
                            @touchstart.passive="populerPaused = true"
                            @touchend.passive="populerPaused = false">
                            <div class="rc-populer-viewport">
                                <div class="rc-populer-slide"
                                    :class="{
                                        'is-fade-out': populerFade === 'out',
                                        'is-fade-in': populerFade === 'in'
                                    }"
                                    x-show="populerSlideCurrent.length > 0">
                                    <template x-for="(item, idx) in populerSlideCurrent" :key="'pop-'+populerSlideEpoch+'-'+item.id+'-'+idx">
                                        @include('pesan.partials.menu-card-populer')
                                    </template>
                                </div>
                            </div>

                            <div class="rc-populer-controls" x-show="populerSlideCount > 1">
                                <button type="button" class="rc-populer-arrow" @click="prevPopulerSlide()" aria-label="Sebelumnya">‹</button>
                                <div class="rc-populer-dots" role="tablist" aria-label="Halaman populer">
                                    <template x-for="(off, i) in populerOffsets" :key="'dot-'+off">
                                        <button type="button" class="rc-populer-dot"
                                            :class="{ 'is-active': populerOffset === off }"
                                            @click="goToPopulerSlide(i)"
                                            :aria-label="'Halaman ' + (i + 1)"></button>
                                    </template>
                                </div>
                                <button type="button" class="rc-populer-arrow" @click="nextPopulerSlide()" aria-label="Berikutnya">›</button>
                            </div>
                        </div>
                    </div>

                    <div class="rc-menu-section rc-menu-section--all">
                        <h2 class="rc-menu-heading">
                            <span>Semua Menu</span>
                            <span class="rc-menu-count" x-text="produkFiltered.length + ' item'"></span>
                        </h2>
                        <div class="rc-menu-grid rc-menu-grid--static">
                            <template x-for="item in produkFiltered" :key="item.id">
                                @include('pesan.partials.menu-card')
                            </template>
                        </div>
                        <p x-show="produkFiltered.length === 0" class="rc-empty">Menu tidak ditemukan.</p>
                    </div>
                </div>
            </section>

            {{-- Favorit: like + trafik --}}
            <section x-show="tab === 'favorit'" x-cloak x-transition class="rc-section">
                <div class="rc-page-intro">
                    <h2 class="rc-page-title">Menu Favorit</h2>
                    <p class="rc-page-desc">Berdasarkan ❤️ Anda &amp; trafik pembelian di toko</p>
                </div>

                <p x-show="favoritList.length === 0" class="rc-empty">
                    Belum ada favorit. Tekan ❤️ pada menu atau tunggu data penjualan terkumpul.
                </p>
                <div class="rc-menu-grid" x-show="favoritList.length > 0">
                    <template x-for="item in favoritList" :key="'fav-'+item.id">
                        @include('pesan.partials.menu-card')
                    </template>
                </div>
            </section>

            {{-- Kategori --}}
            <section x-show="tab === 'kategori'" x-cloak x-transition class="rc-section">
                <div class="rc-page-intro">
                    <h2 class="rc-page-title">Kategori Makanan</h2>
                    <p class="rc-page-desc">Pilih kategori untuk melihat menu</p>
                </div>

                <div class="rc-cat-grid">
                    <button type="button" @click="kategoriAktif = 'semua'; filterProduk()"
                        class="rc-cat-tile" :class="{ 'is-active': kategoriAktif === 'semua' }">
                        <span class="rc-cat-tile-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/>
                                <path d="M7 2v20"/>
                                <path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>
                            </svg>
                        </span>
                        <span>Semua</span>
                    </button>
                    <template x-for="kat in kategoriList" :key="kat.id">
                        <button type="button" @click="kategoriAktif = String(kat.id); filterProduk()"
                            class="rc-cat-tile" :class="{ 'is-active': kategoriAktif === String(kat.id) }">
                            <span class="rc-cat-tile-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/>
                                    <path d="M7 2v20"/>
                                    <path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>
                                </svg>
                            </span>
                            <span x-text="kat.nama_kategori"></span>
                        </button>
                    </template>
                </div>

                <div class="rc-search-wrap rc-search-wrap--sm">
                    <svg class="rc-search-icon" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="search" x-model="search" @input.debounce.300ms="filterProduk()"
                        class="rc-input rc-search-input" placeholder="Cari dalam kategori...">
                </div>

                <h3 class="rc-menu-heading rc-menu-heading--sm">
                    <span x-text="kategoriAktif === 'semua' ? 'Semua Menu' : namaKategoriAktif"></span>
                    <span class="rc-menu-count" x-text="produkFiltered.length + ' item'"></span>
                </h3>

                <div class="rc-menu-grid">
                    <template x-for="item in produkFiltered" :key="'kat-'+item.id">
                        @include('pesan.partials.menu-card')
                    </template>
                </div>
                <p x-show="produkFiltered.length === 0" class="rc-empty">Tidak ada menu di kategori ini.</p>
            </section>
        </div>

        {{-- Keranjang: sidebar desktop / drawer mobile --}}
        @include('pesan.partials.cart-panel')
    </div>
</div>

<script>
    const produkAwal = @json($produk);
    const kategoriAwal = @json($kategori);
    const terlarisAwal = @json($terlaris);
    const LIKES_KEY = 'ruto-caffee-likes';

    function pesanApp() {
        return {
            tab: 'beranda',
            cartOpen: false,
            nomorMeja: '',
            search: '',
            kategoriAktif: 'semua',
            kategoriList: kategoriAwal,
            produkList: produkAwal,
            produkFiltered: produkAwal,
            rekomendasiList: (terlarisAwal.length ? terlarisAwal : produkAwal).slice(0, 10),
            top10Populer: (terlarisAwal.length ? terlarisAwal : produkAwal).slice(0, 10),
            populerOffset: 0,
            populerPerSlide: 4,
            populerSlideCurrent: [],
            populerSlideEpoch: 0,
            populerAnimating: false,
            populerFade: null,
            populerFadeMs: 480,
            populerPaused: false,
            _populerTimer: null,
            likes: [],
            cart: [],
            catatan: '',
            toast: { show: false, message: '' },
            undoVisible: false,
            undoAction: null,
            _undoTimer: null,

            get labelMeja() {
                return `Meja ${this.nomorMeja}`;
            },

            get populerOffsets() {
                const n = this.top10Populer.length;
                const step = this.populerPerSlide;
                if (n <= step) return [0];
                const offsets = [0];
                let o = step % n;
                while (o !== 0) {
                    offsets.push(o);
                    o = (o + step) % n;
                }
                return offsets;
            },

            get populerSlideCount() {
                return this.populerOffsets.length;
            },

            get populerSlideIndex() {
                const i = this.populerOffsets.indexOf(this.populerOffset);
                return i >= 0 ? i : 0;
            },

            get namaKategoriAktif() {
                const kat = this.kategoriList.find(k => String(k.id) === this.kategoriAktif);
                return kat ? kat.nama_kategori : 'Menu';
            },

            get favoritList() {
                const liked = new Set(this.likes.map(Number));
                return [...this.produkList]
                    .map(p => ({
                        ...p,
                        score: (p.total_terjual || 0) + (liked.has(p.id) ? 10000 : 0),
                    }))
                    .filter(p => liked.has(p.id) || (p.total_terjual || 0) > 0)
                    .sort((a, b) => b.score - a.score);
            },

            get total() {
                return this.cart.reduce((sum, item) => sum + (item.harga_jual * item.qty), 0);
            },

            get cartCount() {
                return this.cart.reduce((sum, item) => sum + item.qty, 0);
            },

            init() {
                try {
                    const raw = localStorage.getItem(LIKES_KEY);
                    this.likes = raw ? JSON.parse(raw) : [];
                } catch (e) {
                    this.likes = [];
                }
                this.$watch('kategoriAktif', () => this.filterProduk());
                this.syncPopulerPerSlide();
                this.populerSlideCurrent = this.itemsAtOffset(this.populerOffset);
                window.addEventListener('resize', () => this.syncPopulerPerSlide());
                this.startPopulerAutoplay();
                this.$watch('tab', (t) => {
                    if (t === 'beranda') this.startPopulerAutoplay();
                    else this.stopPopulerAutoplay();
                });
            },

            syncPopulerPerSlide() {
                this.populerPerSlide = window.innerWidth < 640 ? 2 : 4;
                if (!this.populerOffsets.includes(this.populerOffset)) {
                    this.populerOffset = 0;
                }
            },

            startPopulerAutoplay() {
                this.stopPopulerAutoplay();
                if (this.populerSlideCount <= 1) return;
                this._populerTimer = setInterval(() => {
                    if (!this.populerPaused && this.tab === 'beranda' && !this.populerAnimating) {
                        this.nextPopulerSlide();
                    }
                }, 5800);
            },

            stopPopulerAutoplay() {
                if (this._populerTimer) {
                    clearInterval(this._populerTimer);
                    this._populerTimer = null;
                }
            },

            itemsAtOffset(offset) {
                const list = this.top10Populer;
                if (!list.length) return [];
                const n = list.length;
                const take = Math.min(this.populerPerSlide, n);
                const out = [];
                for (let i = 0; i < take; i++) {
                    out.push(list[(offset + i) % n]);
                }
                return out;
            },

            transitionPopuler(newOffset) {
                if (this.populerAnimating) return;
                const next = this.itemsAtOffset(newOffset);
                const curIds = this.populerSlideCurrent.map(p => p.id).join(',');
                const nextIds = next.map(p => p.id).join(',');
                if (curIds === nextIds) return;

                this.populerAnimating = true;
                this.populerFade = 'out';

                setTimeout(() => {
                    this.populerOffset = newOffset;
                    this.populerSlideCurrent = next;
                    this.populerSlideEpoch++;

                    this.$nextTick(() => {
                        requestAnimationFrame(() => {
                            this.populerFade = 'in';
                            setTimeout(() => {
                                this.populerFade = null;
                                this.populerAnimating = false;
                            }, this.populerFadeMs);
                        });
                    });
                }, this.populerFadeMs);
            },

            nextPopulerSlide() {
                const n = this.top10Populer.length;
                if (n <= this.populerPerSlide) return;
                const newOff = (this.populerOffset + this.populerPerSlide) % n;
                this.transitionPopuler(newOff);
            },

            prevPopulerSlide() {
                const n = this.top10Populer.length;
                if (n <= this.populerPerSlide) return;
                const newOff = (this.populerOffset - this.populerPerSlide + n) % n;
                this.transitionPopuler(newOff);
            },

            goToPopulerSlide(index) {
                if (this.populerOffsets[index] === undefined) return;
                this.transitionPopuler(this.populerOffsets[index]);
            },

            pilihTab(name) {
                if (name === 'keranjang') {
                    this.tab = 'keranjang';
                    this.cartOpen = true;
                    return;
                }
                this.tab = name;
                this.cartOpen = false;
            },

            simpanMeja() {
                if (!this.nomorMeja.trim()) {
                    this.showToast('Isi nomor meja dulu');
                    return;
                }
                this.showToast('✓ ' + this.labelMeja + ' tersimpan');
            },

            isLiked(produkId) {
                return this.likes.includes(Number(produkId));
            },

            toggleLike(produk, e) {
                e?.stopPropagation();
                const id = Number(produk.id);
                const idx = this.likes.indexOf(id);
                if (idx >= 0) {
                    this.likes.splice(idx, 1);
                    this.showToast('Dihapus dari favorit');
                } else {
                    this.likes.push(id);
                    this.showToast('❤️ ' + produk.nama_produk + ' disukai');
                }
                try {
                    localStorage.setItem(LIKES_KEY, JSON.stringify(this.likes));
                } catch (err) {}
            },

            formatRupiah(n) {
                return 'Rp ' + new Intl.NumberFormat('id-ID').format(n);
            },

            qtyInCart(produkId) {
                const item = this.cart.find(c => c.produk_id === produkId);
                return item ? item.qty : 0;
            },

            showToast(msg) {
                this.toast.message = msg;
                this.toast.show = true;
                clearTimeout(this._toastTimer);
                this._toastTimer = setTimeout(() => { this.toast.show = false; }, 2200);
            },

            filterProduk() {
                const q = this.search.toLowerCase().trim();
                this.produkFiltered = this.produkList.filter(item => {
                    const matchKat = this.kategoriAktif === 'semua'
                        || String(item.kategori_id) === this.kategoriAktif;
                    const matchSearch = !q
                        || item.nama_produk.toLowerCase().includes(q)
                        || (item.kategori?.nama_kategori || '').toLowerCase().includes(q);
                    return matchKat && matchSearch;
                });
            },

            pushUndo(action) {
                clearTimeout(this._undoTimer);
                this.undoAction = action;
                this.undoVisible = true;
                this._undoTimer = setTimeout(() => { this.undoVisible = false; }, 6000);
            },

            batalkanAksi() {
                const a = this.undoAction;
                if (!a) return;
                const idx = this.cart.findIndex(c => c.produk_id === a.produk_id);
                if (a.prevQty <= 0) {
                    if (idx >= 0) this.cart.splice(idx, 1);
                } else if (idx >= 0) {
                    this.cart[idx].qty = a.prevQty;
                }
                this.undoVisible = false;
                this.undoAction = null;
                this.showToast('↩ Dibatalkan');
            },

            tambahKeKeranjang(produk) {
                const existing = this.cart.find(c => c.produk_id === produk.id);
                const prevQty = existing ? existing.qty : 0;

                if (existing) {
                    if (existing.qty >= produk.stok) {
                        this.showToast('Stok habis');
                        return;
                    }
                    existing.qty++;
                } else {
                    this.cart.push({
                        produk_id: produk.id,
                        nama_produk: produk.nama_produk,
                        harga_jual: parseFloat(produk.harga_jual),
                        stok: produk.stok,
                        qty: 1,
                    });
                }

                this.pushUndo({
                    produk_id: produk.id,
                    prevQty,
                    label: prevQty > 0
                        ? `+1 ${produk.nama_produk} — ketuk Undo jika salah`
                        : `${produk.nama_produk} ditambahkan — ketuk Undo jika salah`,
                });
                this.showToast('✓ ' + produk.nama_produk);
                if (window.innerWidth < 1024) {
                    /* keep on current tab; optional mini feedback */
                }
            },

            ubahQty(index, delta) {
                const item = this.cart[index];
                const prevQty = item.qty;
                const baru = item.qty + delta;
                if (baru <= 0) {
                    this.cart.splice(index, 1);
                    this.pushUndo({
                        produk_id: item.produk_id,
                        prevQty,
                        label: `${item.nama_produk} dihapus — Undo`,
                    });
                } else if (baru > item.stok) {
                    this.showToast('Stok tidak cukup');
                } else {
                    item.qty = baru;
                }
            },

            prepareSubmit(e) {
                if (!this.nomorMeja.trim()) {
                    e.preventDefault();
                    this.showToast('Silakan isi nomor meja Anda terlebih dahulu');
                    return;
                }
                if (this.cart.length === 0) {
                    e.preventDefault();
                    this.showToast('Keranjang masih kosong');
                    return;
                }
                const container = document.getElementById('pesan-form-fields');
                container.innerHTML = '';
                container.innerHTML += `<input type="hidden" name="nomor_meja" value="${this.nomorMeja.trim().replace(/"/g, '&quot;')}">`;
                if (this.catatan) {
                    container.innerHTML += `<input type="hidden" name="catatan" value="${this.catatan.replace(/"/g, '&quot;')}">`;
                }
                this.cart.forEach((item, i) => {
                    container.innerHTML += `<input type="hidden" name="items[${i}][produk_id]" value="${item.produk_id}">`;
                    container.innerHTML += `<input type="hidden" name="items[${i}][qty]" value="${item.qty}">`;
                });
                this.undoVisible = false;
            },
        };
    }
</script>
@endsection
