<style>
    .products-page {
        padding: 120px 5% 80px;
        background: var(--background);
    }

    .products-page-inner {
        max-width: 1280px;
        margin: 0 auto;
    }

    .products-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 1.5rem;
        flex-wrap: wrap;
        margin-bottom: 3rem;
    }

    .section-label {
        font-size: 0.7rem;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--secondary);
        font-weight: 500;
        margin-bottom: 0.85rem;
    }

    .section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(2rem, 4vw, 3.4rem);
        font-weight: 300;
        line-height: 1.15;
        color: var(--primary);
    }

    .section-title em {
        font-style: italic;
    }

    .product-filter {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
    }

    .filter-btn {
        padding: 0.5rem 1.25rem;
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
        gap: 1.5rem;
    }

    .product-card {
        background: #fff;
        position: relative;
        cursor: none;
        overflow: hidden;
        border: 1px solid rgba(171, 136, 109, 0.12);
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }

    .product-card:hover {
        box-shadow: 0 18px 40px rgba(73, 54, 40, 0.08);
        transform: translateY(-3px);
    }

    .product-img-wrap {
        position: relative;
        overflow: hidden;
        aspect-ratio: 3/4;
        background: var(--background);
    }

    .product-img-link {
        display: block;
        width: 100%;
        height: 100%;
    }

    .product-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94), opacity 0.3s ease;
    }

    .product-card:hover .product-img-wrap img {
        transform: scale(1.05);
    }

    .product-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        z-index: 2;
        background: var(--primary);
        color: var(--accent);
        padding: 0.35rem 0.65rem;
        font-size: 0.65rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        font-weight: 500;
    }

    .product-actions {
        position: absolute;
        bottom: -60px;
        left: 0;
        right: 0;
        z-index: 3;
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
        background: #fff;
    }

    .product-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--primary);
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .product-name a {
        color: inherit;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .product-name a:hover {
        color: var(--secondary);
    }

    .product-price-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .product-price {
        font-weight: 600;
        font-size: 0.95rem;
        color: var(--primary);
    }

    .product-rating {
        display: flex;
        align-items: center;
        gap: 4px;
        margin-top: 8px;
    }

    .star {
        color: var(--secondary);
        font-size: 0.75rem;
        letter-spacing: 1px;
    }

    .rating-count {
        font-size: 0.72rem;
        color: #7a6858;
    }

    .products-empty {
        text-align: center;
        padding: 4rem 1rem;
        color: var(--secondary);
    }

    /* ─── Pagination ─── */
    .pagination-wrap {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1.25rem;
        flex-wrap: wrap;
        width: 100%;
        margin-top: 3.5rem;
        padding-top: 1.75rem;
        border-top: 1px solid rgba(171, 136, 109, 0.15);
    }

    .pagination-info {
        font-size: 0.8rem;
        color: var(--secondary);
        letter-spacing: 0.03em;
        font-weight: 400;
        margin-right: auto;
    }

    .pagination-info strong {
        color: var(--primary);
        font-weight: 600;
    }

    .pagination-nav {
        display: flex;
        align-items: center;
        gap: 0.2rem;
        margin-left: auto;
        position: static;
        height: auto;
        padding: 0;
        z-index: auto;
    }

    .products-page-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
        padding: 0 0.4rem;
        font-size: 0.75rem;
        font-weight: 450;
        color: var(--secondary);
        background: transparent;
        border: none;
        text-decoration: none;
        transition: all 0.2s ease;
        cursor: none;
        position: relative;
    }

    .products-page-btn::after {
        content: '';
        position: absolute;
        bottom: 4px;
        left: 50%;
        width: 0;
        height: 1.5px;
        background: var(--primary);
        transform: translateX(-50%);
        transition: width 0.25s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .products-page-btn:hover {
        color: var(--primary);
    }

    .products-page-btn:hover::after {
        width: 50%;
    }

    .products-page-btn--active {
        color: var(--primary);
        font-weight: 600;
        cursor: default;
        background: rgba(73, 54, 40, 0.06);
        border-radius: 4px;
    }

    .products-page-btn--active::after {
        width: 40%;
        background: var(--primary);
    }

    .products-page-btn--active:hover::after {
        width: 40%;
    }

    .products-page-btn--disabled {
        color: #d4c9bf;
        cursor: default;
        pointer-events: none;
        border-color: transparent;
    }

    .products-page-btn--disabled svg {
        stroke: #d4c9bf;
    }

    .products-page-btn--nav {
        min-width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 1px solid rgba(171, 136, 109, 0.2);
    }

    .products-page-btn--nav::after {
        display: none;
    }

    .products-page-btn--nav:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: rgba(73, 54, 40, 0.04);
    }

    .products-page-btn--ellipsis {
        min-width: 22px;
        padding: 0;
        color: #c4b8ac;
        letter-spacing: 3px;
        cursor: default;
        pointer-events: none;
        font-size: 0.85rem;
    }

    .products-page-btn--ellipsis::after {
        display: none;
    }

    @media (max-width: 640px) {
        .pagination-wrap {
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
            gap: 1rem;
        }

        .pagination-info,
        .pagination-nav {
            margin-left: 0;
            margin-right: 0;
        }
    }

    @media (max-width: 1024px) {
        .products-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .products-page {
            padding: 100px 5% 60px;
        }

        .products-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .products-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }
    }

    @media (max-width: 480px) {
        .products-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<x-layout>
    <section class="products-page">
        <div class="products-page-inner">
            <div class="products-header">
                <div>
                    <div class="section-label">Shop Collection</div>
                    <h1 class="section-title">All <em>Products</em></h1>
                </div>
                <div class="product-filter">
                    <a href="{{ route('products') }}" class="filter-btn {{ !request('category') ? 'active' : '' }} product-interactive">All</a>
                    @foreach ($categories as $cat)
                        <a href="{{ route('products', ['category' => $cat->slug]) }}" class="filter-btn {{ request('category') === $cat->slug ? 'active' : '' }} product-interactive">{{ $cat->name }}</a>
                    @endforeach
                </div>
            </div>

            @if ($products->isEmpty())
                <div class="products-empty">
                    <p>No products available at the moment.</p>
                </div>
            @else
                <div class="products-grid" id="productsGrid">
                    @foreach ($products as $product)
                        @php
                            $isNew = $product->created_at && $product->created_at->gt(now()->subDays(30));
                        @endphp
                        <article class="product-card product-interactive" data-tag="{{ $isNew ? 'new' : '' }}">
                            <div class="product-img-wrap">
                                <a href="{{ route('product', $product->id) }}"
                                    class="product-img-link product-interactive">
                                    <img src="{{ $product->main_image }}" alt="{{ $product->name }}" />
                                </a>

                                @if ($isNew)
                                    <span class="product-badge">New In</span>
                                @endif

                                <div class="product-actions">
                                    <button type="button" class="add-cart-btn product-interactive"
                                        onclick="event.preventDefault(); event.stopPropagation();">Add to
                                        Cart</button>
                                    <button type="button" class="wishlist-btn product-interactive"
                                        onclick="event.preventDefault(); event.stopPropagation();"
                                        aria-label="Add to wishlist">
                                        <svg fill="none" stroke="currentColor" stroke-width="1.8"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="product-info">
                                <div class="product-name">
                                    <a href="{{ route('product', $product->id) }}"
                                        class="product-interactive">{{ $product->name }}</a>
                                </div>
                                <div class="product-price-row">
                                    <span class="product-price">Rs. {{ number_format((float) $product->price, 2) }}</span>
                                </div>
                                <div class="product-rating">
                                    <span class="star">★★★★★</span>
                                    <span class="rating-count">(48)</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="pagination-wrap">
                    <div class="pagination-info">
                        Showing <strong>{{ $products->firstItem() }}–{{ $products->lastItem() }}</strong> of <strong>{{ $products->total() }}</strong> products
                    </div>
                    @php
                        $current = $products->currentPage();
                        $last = $products->lastPage();
                        $window = 2;
                        $start = max(1, $current - $window);
                        $end = min($last, $current + $window);
                    @endphp
                    <nav class="pagination-nav" aria-label="Product pagination">
                        {{-- Previous --}}
                        @if ($products->onFirstPage())
                            <span class="products-page-btn products-page-btn--nav products-page-btn--disabled">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                            </span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}" class="products-page-btn products-page-btn--nav" rel="prev">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                            </a>
                        @endif

                        {{-- First page + ellipsis --}}
                        @if ($start > 1)
                            <a href="{{ $products->url(1) }}" class="products-page-btn">1</a>
                            @if ($start > 2)
                                <span class="products-page-btn products-page-btn--ellipsis" aria-hidden="true">…</span>
                            @endif
                        @endif

                        {{-- Page window --}}
                        @foreach ($products->getUrlRange($start, $end) as $page => $url)
                            @if ($page == $current)
                                <span class="products-page-btn products-page-btn--active" aria-current="page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="products-page-btn">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Last page + ellipsis --}}
                        @if ($end < $last)
                            @if ($end < $last - 1)
                                <span class="products-page-btn products-page-btn--ellipsis" aria-hidden="true">…</span>
                            @endif
                            <a href="{{ $products->url($last) }}" class="products-page-btn">{{ $last }}</a>
                        @endif

                        {{-- Next --}}
                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}" class="products-page-btn products-page-btn--nav" rel="next">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                            </a>
                        @else
                            <span class="products-page-btn products-page-btn--nav products-page-btn--disabled">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                            </span>
                        @endif
                    </nav>
                </div>
            @endif
        </div>
    </section>


</x-layout>
