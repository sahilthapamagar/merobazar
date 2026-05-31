{{-- <style>
    /* ─── PRODUCTS ─── */
    .products-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 48px;
        z-index: 4;
    }

    .product-filter {
        display: flex;
        gap: 6px;
    }

    .filter-btn {
        padding: 8px 20px;
        font-size: 0.73rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        font-weight: 500;
        background: transparent;
        border: 1px solid var(--accent);
        color: var(--primary);
        cursor: none;
        transition: all 0.3s ease;
    }

    .filter-btn.active,
    .filter-btn:hover {
        background: var(--primary);
        color: var(--accent);
        border-color: var(--primary);
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }

    .product-card {
        background: white;
        position: relative;
        cursor: none;
        overflow: hidden;
    }

    .product-img-wrap {
        position: relative;
        overflow: hidden;
        aspect-ratio: 3/4;
    }

    .product-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .product-card:hover .product-img-wrap img {
        transform: scale(1.05);
    }

    .product-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        background: var(--primary);
        color: var(--accent);
        padding: 4px 10px;
        font-size: 0.65rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        font-weight: 500;
    }

    .product-badge.sale {
        background: #8B4513;
    }

    .product-actions {
        position: absolute;
        bottom: -60px;
        left: 0;
        right: 0;
        display: flex;
        padding: 0 16px 16px;
        gap: 8px;
        transition: bottom 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .product-card:hover .product-actions {
        bottom: 0;
    }

    .add-cart-btn {
        flex: 1;
        padding: 11px;
        background: var(--primary);
        color: var(--accent);
        font-size: 0.72rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        font-weight: 500;
        border: none;
        cursor: none;
        transition: background 0.3s;
    }

    .add-cart-btn:hover {
        background: var(--secondary);
    }

    .wishlist-btn {
        width: 42px;
        background: white;
        border: 1px solid var(--accent);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: none;
        transition: all 0.3s;
        flex-shrink: 0;
    }

    .wishlist-btn:hover {
        background: var(--accent);
    }

    .wishlist-btn svg {
        width: 16px;
        height: 16px;
    }

    .product-info {
        padding: 18px 18px 20px;
    }

    .product-brand {
        font-size: 0.67rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--secondary);
        margin-bottom: 6px;
    }

    .product-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--primary);
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .product-price-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .product-price {
        font-weight: 500;
        font-size: 0.95rem;
        color: var(--primary);
    }

    .product-price-old {
        font-size: 0.82rem;
        color: #aaa;
        text-decoration: line-through;
    }

    .product-rating {
        display: flex;
        gap: 2px;
        margin-top: 8px;
    }

    .star {
        color: var(--secondary);
        font-size: 0.75rem;
    }

    @media (max-width: 1024px) {
        .products-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            max-width: none;
            margin: 0;
        }
    }

    @media (max-width: 480px) {
        .products-grid {
            grid-template-columns: 1fr;
            width: 100%;
            max-width: none;
            margin: 0;
        }
    }
</style>
<x-layout>
    <section>
        <div class="products-grid" id="productsGrid">
            <!-- Product -->
            @foreach ($products as $product)
                <a href="{{ route('product', $product->id) }}">
                    <div class="product-card reveal" data-tag="new trending">
                        <div class="product-img-wrap">
                            <img src="{{ asset(Storage::url($product->productVarient()->first()->images[0])) }}"
                                alt="Silk Midi Dress" />
                            <span class="product-badge">Discount {{ $product->discount }}%</span>
                            <div class="product-actions">
                                <button class="add-cart-btn" onclick="addToCart(this)">Add to Cart</button>
                                <button class="wishlist-btn">
                                    <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path
                                            d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="product-info">
                            {{-- <div class="product-brand">Mero Bazar Studio</div> --}}
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-price-row">
                                <span class="product-price">Rs.
                                    {{ $product->productVarient()->first()->price }}</span>
                            </div>
                            <div class="product-rating"><span class="star">★★★★★</span> <span
                                    style="font-size:0.72rem;color:#7a6858;margin-left:4px">(48)</span></div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </section>

    <style>

    </style>
</x-layout> --}}
