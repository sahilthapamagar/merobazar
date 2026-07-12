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

    .product-variant-swatches {
        position: absolute;
        top: 3.25rem;
        left: 14px;
        z-index: 2;
        display: flex;
        gap: 0.45rem;
        opacity: 0;
        transform: translateY(6px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .product-card:hover .product-variant-swatches {
        opacity: 1;
        transform: translateY(0);
    }

    .variant-swatch {
        width: 34px;
        height: 34px;
        padding: 0;
        border-radius: 50%;
        border: 2px solid #fff;
        overflow: hidden;
        background: #fff;
        cursor: none;
        box-shadow: 0 2px 8px rgba(73, 54, 40, 0.15);
        transition: transform 0.2s ease, border-color 0.2s ease;
    }

    .variant-swatch:hover,
    .variant-swatch.is-active {
        transform: scale(1.08);
        border-color: var(--primary);
    }

    .variant-swatch img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: none !important;
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

        .product-variant-swatches {
            opacity: 1;
            transform: none;
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
                    <button type="button" class="filter-btn active product-interactive" data-filter="all">All</button>
                    <button type="button" class="filter-btn product-interactive" data-filter="new">New In</button>
                    <button type="button" class="filter-btn product-interactive" data-filter="sale">Sale</button>
                    <button type="button" class="filter-btn product-interactive"
                        data-filter="trending">Trending</button>
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
                            $variants = $product->productVarient;
                            $firstVariant = $variants->first();
                            $mainImage =
                                $firstVariant && !empty($firstVariant->images[0]) ? $firstVariant->images[0] : null;
                            $price = $firstVariant?->price ?? 0;
                        @endphp

                        @if ($mainImage)
                            <article class="product-card product-interactive" data-tag="new trending sale">
                                <div class="product-img-wrap">
                                    <a href="{{ route('product', $product->id) }}"
                                        class="product-img-link product-interactive">
                                        <img src="{{ asset('storage/' . $mainImage) }}" alt="{{ $product->name }}"
                                            data-product-image>
                                    </a>

                                    @if ($product->discount)
                                        <span class="product-badge">Discount {{ $product->discount }}%</span>
                                    @endif

                                    @if ($variants->count() > 1)
                                        <div class="product-variant-swatches">
                                            @foreach ($variants->take(4) as $index => $variant)
                                                @php
                                                    $variantImage = $variant->images[0] ?? $mainImage;
                                                @endphp
                                                <button type="button"
                                                    class="variant-swatch product-interactive {{ $index === 0 ? 'is-active' : '' }}"
                                                    data-image="{{ asset('storage/' . $variantImage) }}"
                                                    aria-label="View {{ $variant->name ?? 'variant ' . ($index + 1) }}">
                                                    <img src="{{ asset('storage/' . $variantImage) }}"
                                                        alt="{{ $variant->name ?? 'Variant ' . ($index + 1) }}">
                                                </button>
                                            @endforeach
                                        </div>
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
                                        <span class="product-price">Rs. {{ number_format((float) $price, 2) }}</span>
                                    </div>
                                    <div class="product-rating">
                                        <span class="star">★★★★★</span>
                                        <span class="rating-count">(48)</span>
                                    </div>
                                </div>
                            </article>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <script>
        document.querySelectorAll('.variant-swatch').forEach(swatch => {
            swatch.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();

                const card = this.closest('.product-card');
                const image = card?.querySelector('[data-product-image]');
                const swatches = card?.querySelectorAll('.variant-swatch') ?? [];

                if (image && this.dataset.image) {
                    image.src = this.dataset.image;
                }

                swatches.forEach(btn => btn.classList.remove('is-active'));
                this.classList.add('is-active');
            });
        });

        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const tag = btn.dataset.filter;

                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                document.querySelectorAll('.product-card').forEach(card => {
                    if (tag === 'all' || (card.dataset.tag && card.dataset.tag.includes(tag))) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
</x-layout>
