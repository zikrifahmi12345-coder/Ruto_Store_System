<article class="rc-menu-card rc-menu-card--populer"
    :class="{ 'rc-menu-card--in-cart': qtyInCart(item.id) > 0, 'rc-menu-card--liked': isLiked(item.id) }"
    @click="tambahKeKeranjang(item)">
    <div class="rc-menu-card-img">
        <template x-if="item.gambar_url">
            <img :src="item.gambar_url" :alt="item.nama_produk" loading="lazy"
                 x-on:error="item.gambar_url = null">
        </template>
        <template x-if="!item.gambar_url">
            <div class="rc-menu-card-placeholder">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/>
                    <path d="M7 2v20"/>
                    <path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>
                </svg>
            </div>
        </template>
        <span class="rc-populer-badge">Populer</span>
        <span class="rc-menu-card-qty" x-show="qtyInCart(item.id) > 0" x-text="qtyInCart(item.id)"></span>
    </div>
    <div class="rc-menu-card-body rc-menu-card-body--compact">
        <h3 class="rc-menu-card-name" x-text="item.nama_produk"></h3>
        <span class="rc-menu-card-price" x-text="formatRupiah(item.harga_jual)"></span>
    </div>
</article>
