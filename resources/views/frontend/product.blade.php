{{-- resources/views/frontend/product.blade.php --}}
<x-layout>
    <style>
        .product-page {
            padding: 32px 5% 80px;
            background: linear-gradient(180deg, var(--cream) 0%, var(--background) 220px);
        }

        .product-container {
            max-width: 1280px;
            margin: 0 auto;
        }

        .product-breadcrumb {
            position: sticky;
            top: 72px;
            z-index: 900;
            margin: 0 0 2rem;
            padding: 0.85rem 1.25rem;
            font-size: 0.875rem;
            background: rgba(245, 240, 235, 0.96);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(171, 136, 109, 0.18);
            border-radius: 999px;
            width: fit-content;
            max-width: 100%;
        }

        .product-breadcrumb ol {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.5rem;
            list-style: none;
        }

        .product-breadcrumb a {
            color: var(--secondary);
            text-decoration: none;
            transition: color 0.3s ease;
            cursor: none;
        }

        .product-breadcrumb a:hover {
            color: var(--primary);
        }

        .product-breadcrumb .sep {
            color: var(--secondary);
        }

        .product-breadcrumb .current {
            color: var(--primary);
            font-weight: 500;
            max-width: 220px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .product-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 3rem;
        }

        @media (min-width: 1024px) {
            .product-grid {
                grid-template-columns: 1fr 1fr;
                gap: 5rem;
            }
        }

        .product-gallery-panel {
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 18px 40px rgba(73, 54, 40, 0.06);
        }

        .product-gallery-main {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            background: var(--cream);
        }

        .product-gallery-main img {
            width: 100%;
            aspect-ratio: 4 / 5;
            object-fit: cover;
            transition: transform 0.7s ease, opacity 0.3s ease;
        }

        .product-gallery-main:hover img {
            transform: scale(1.05);
        }



        .product-thumbs {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.85rem;
            margin-top: 1.25rem;
        }

        .product-thumb {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            border: 2px solid transparent;
            padding: 0;
            background: none;
            cursor: none;
            transition: border-color 0.3s ease, transform 0.25s ease;
        }

        .product-thumb.is-active,
        .product-thumb:hover {
            border-color: var(--primary);
        }

        .product-thumb:hover {
            transform: translateY(-2px);
        }

        .product-thumb img {
            width: 100%;
            aspect-ratio: 4 / 5;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .product-thumb:hover img {
            transform: scale(1.08);
        }

        .product-info {
            position: sticky;
            top: 6rem;
            height: fit-content;
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 18px 40px rgba(73, 54, 40, 0.06);
        }

        .product-eyebrow {
            display: inline-block;
            font-size: 0.68rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--secondary);
            margin-bottom: 0.85rem;
        }

        .product-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            color: var(--primary);
            line-height: 1.15;
            margin-bottom: 0.5rem;
        }

        .product-seller {
            color: var(--secondary);
            font-size: 0.95rem;
            margin-bottom: 1.25rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid rgba(171, 136, 109, 0.15);
        }

        .product-price-row {
            display: flex;
            flex-wrap: wrap;
            align-items: baseline;
            gap: 0.75rem;
            margin-bottom: 1.75rem;
            padding: 1rem 1.15rem;
            background: var(--cream);
            border-radius: 8px;
            border: 1px solid rgba(171, 136, 109, 0.12);
        }

        .product-price {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.15rem;
            color: var(--primary);
            font-weight: 600;
        }

        .product-price-old {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.35rem;
            color: #aaa;
            text-decoration: line-through;
        }

        .product-new-badge {
            display: inline-block;
            background: var(--primary);
            color: var(--accent);
            padding: 0.25rem 0.6rem;
            font-size: 0.65rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 500;
            margin-left: 0.75rem;
            vertical-align: middle;
        }

        .product-discount-tag {
            display: inline-block;
            background: var(--secondary);
            color: #fff;
            padding: 0.25rem 0.6rem;
            font-size: 0.65rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 500;
        }

        .product-field-label {
            display: block;
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 0.75rem;
        }

        .product-purchase-box {
            margin-top: 0.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(171, 136, 109, 0.15);
        }

        .product-qty {
            display: inline-flex;
            align-items: stretch;
            border: 1px solid rgba(171, 136, 109, 0.22);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 1.25rem;
            background: #fff;
        }

        .product-qty button {
            width: 3rem;
            border: none;
            background: transparent;
            color: var(--primary);
            font-size: 1.25rem;
            cursor: none;
            transition: background 0.2s ease;
        }

        .product-qty button:hover {
            background: var(--cream);
        }

        .product-qty input {
            width: 4rem;
            text-align: center;
            border: none;
            border-left: 1px solid #d1d5db;
            border-right: 1px solid #d1d5db;
            font-size: 1rem;
            background: transparent;
            color: var(--primary);
            padding: 0.85rem 0;
            -moz-appearance: textfield;
        }

        .product-qty input::-webkit-outer-spin-button,
        .product-qty input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .product-qty input:focus {
            outline: none;
        }

        .product-add-btn {
            width: 100%;
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 1.25rem 2rem;
            font-size: 0.8rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            cursor: none;
            border-radius: 8px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .product-add-btn:hover:not(:disabled) {
            background: var(--dark);
            transform: translateY(-1px);
        }

        .product-add-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* ─── Trust / benefits strip ─── */
        .product-benefits {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid rgba(171, 136, 109, 0.15);
        }

        .product-benefit {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.35rem;
            text-align: center;
            font-size: 0.66rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: rgba(73, 54, 40, 0.55);
        }

        .product-benefit svg {
            width: 20px;
            height: 20px;
            color: var(--secondary);
        }

        /* Lower section: Description (full row) + Related Products (full row) */
        .product-lower {
            margin-top: 4rem;
            padding-top: 2.5rem;
            border-top: 1px solid #d1d5db;
        }

        .product-description-section {
            min-width: 0;
        }

        .product-description-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.75rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .product-description-content {
            color: var(--primary);
            line-height: 1.8;
            font-size: 0.95rem;
            text-align: left;
        }

        .product-description-content h1,
        .product-description-content h2,
        .product-description-content h3,
        .product-description-content h4 {
            font-family: 'Cormorant Garamond', serif;
            color: var(--primary);
            margin: 1rem 0 0.5rem;
        }

        .product-description-content p {
            margin-bottom: 0.75rem;
        }

        .product-description-content ul,
        .product-description-content ol {
            margin: 0.75rem 0;
            padding-left: 1.25rem;
        }

        .product-seller-block {
            margin-top: 2.5rem;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.6rem;
        }

        .product-seller-block-line {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .product-seller-block-label {
            color: var(--secondary);
            font-weight: 600;
            font-size: 1.2rem;
            letter-spacing: 0.05em;
        }

        .product-seller-block-value {
            color: var(--primary);
            font-weight: 600;
        }

        .product-related {
            position: relative;
            margin-top: 3.5rem;
            padding-top: 2.5rem;
            border-top: 1px solid rgba(171, 136, 109, 0.2);
        }

        .product-related-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.75rem;
            color: var(--primary);
            margin-bottom: 2rem;
            text-align: center;
        }

        .product-related-arrows {
            position: absolute;
            top: 2.75rem;
            right: 0;
            display: flex;
            gap: 0.6rem;
        }

        .product-related-arrow {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid rgba(171, 136, 109, 0.25);
            background: #fff;
            color: var(--primary);
            display: grid;
            place-items: center;
            cursor: none;
            transition: background 0.3s ease, color 0.3s ease, border-color 0.3s ease, opacity 0.3s ease;
        }

        .product-related-arrow:hover:not(:disabled) {
            background: var(--primary);
            color: var(--accent);
            border-color: var(--primary);
        }

        .product-related-arrow:disabled {
            opacity: 0.35;
            cursor: not-allowed;
        }

        .product-related-viewport {
            overflow-x: auto;
            scroll-behavior: smooth;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .product-related-viewport::-webkit-scrollbar {
            display: none;
        }

        .product-related-grid {
            display: flex;
            gap: 1.5rem;
        }

        .product-related-card {
            flex: 0 0 calc(25% - 18px);
            min-width: 0;
            display: block;
            text-decoration: none;
            color: inherit;
            cursor: none;
            text-align: center;
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
            border-radius: 12px;
            padding: 1rem 1rem 1.25rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .product-related-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px rgba(73, 54, 40, 0.08);
            border-color: rgba(171, 136, 109, 0.35);
        }

        .product-related-card-image {
            overflow: hidden;
            border-radius: 10px;
            aspect-ratio: 4 / 5;
            background: var(--cream);
        }

        .product-related-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.7s ease;
        }

        .product-related-card:hover img {
            transform: scale(1.05);
        }

        .product-related-card-info {
            margin-top: 0.75rem;
        }

        .product-related-card h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15rem;
            color: var(--primary);
            line-height: 1.25;
            margin-bottom: 0.3rem;
            transition: color 0.3s ease;
        }

        .product-related-card:hover h3 {
            color: var(--secondary);
        }

        .product-related-card p {
            color: var(--secondary);
            font-size: 0.9rem;
            font-weight: 500;
        }

        @media (max-width: 1024px) {
            .product-related-card {
                flex-basis: calc(33.333% - 16px);
            }
        }

        @media (max-width: 768px) {
            .product-page {
                padding: 20px 5% 60px;
            }

            .product-breadcrumb {
                display: none;
            }

            .product-grid {
                gap: 2rem;
            }

            .product-gallery-main img {
                aspect-ratio: 4 / 5;
            }

            .product-info {
                position: static;
                text-align: center;
                padding: 1.5rem;
            }

            .product-breadcrumb {
                margin-left: auto;
                margin-right: auto;
            }

            .product-price-row {
                justify-content: center;
            }

            .product-field-label {
                text-align: center;
            }

            .product-qty-wrap {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .product-qty {
                margin-left: auto;
                margin-right: auto;
            }

            .product-related-card {
                flex-basis: calc(50% - 12px);
            }

            .product-description-section {
                margin-top: 2.5rem;
                padding-top: 2rem;
            }
        }

        @media (max-width: 480px) {
            .product-gallery-main img {
                aspect-ratio: 4 / 5;
            }

            .product-title {
                font-size: 1.85rem;
            }

            .product-price {
                font-size: 1.65rem;
            }

            .product-thumbs {
                grid-template-columns: repeat(3, 1fr);
            }

            .product-related-card {
                flex-basis: 100%;
            }
        }
    </style>

    <section class="product-page">

        <div class="product-container">
            @php
                $galleryImages = is_array($product->images) ? $product->images : [];
                $formatPrice = fn($amount) => 'Rs. ' . number_format((float) $amount, 2);
                $hasRelated = isset($relatedProducts) && $relatedProducts->count() > 0;
            @endphp

            {{-- Breadcrumb --}}
            <nav class="product-breadcrumb" aria-label="Breadcrumb">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('products') }}#categories">Products</a></li>
                    <li class="sep">/</li>
                    <li class="current">{{ $product->name }}</li>
                </ol>
            </nav>

            <div class="product-grid">
                {{-- Left: Product Images --}}
                <div class="product-gallery-panel">
                    <div class="product-gallery-main" id="main-image-container">
                        <img id="main-image" src="{{ $product->main_image }}" alt="{{ $product->name }}">
                        @if ($product->is_new)
                            <span class="product-discount-tag"
                                style="position:absolute;top:14px;left:14px;z-index:2;background:var(--primary);color:var(--accent);">New</span>
                        @endif
                        @if ($product->is_discounted)
                            <span class="product-discount-tag"
                                style="position:absolute;top:14px;right:14px;z-index:2;">-{{ $product->discount_percent }}%</span>
                        @endif
                    </div>

                    @if (count($galleryImages) > 0)
                        <div class="product-thumbs" id="thumbnail-gallery">
                            <button type="button" onclick="changeMainImage('{{ $product->main_image }}', this)"
                                class="product-thumb product-interactive is-active" data-main-thumb>
                                <img src="{{ $product->main_image }}" alt="{{ $product->name }}">
                            </button>
                            @foreach ($galleryImages as $index => $image)
                                <button type="button" onclick="changeMainImage('{{ $image }}', this)"
                                    class="product-thumb product-interactive">
                                    <img src="{{ $image }}" alt="{{ $product->name }} - {{ $index + 1 }}">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Right: Product Details --}}
                <div class="product-info">
                    <span class="product-eyebrow">Premium Collection</span>
                    <h1 class="product-title">
                        {{ $product->name }}
                        @if ($product->is_new)
                            <span class="product-new-badge">New</span>
                        @endif
                    </h1>

                    {{-- @if ($product->seller)
                        <p class="product-seller">by {{ $product->seller->name }}</p>
                    @endif --}}

                    <div class="product-price-row">
                        <span class="product-price" id="product-price">
                            {{ $formatPrice($product->effective_price) }}
                        </span>
                        @if ($product->is_discounted)
                            <span class="product-price-old" id="product-price-old">
                                {{ $formatPrice($product->price) }}
                            </span>
                            <span class="product-discount-tag">-{{ $product->discount_percent }}%</span>
                        @endif
                    </div>

                    <div class="product-purchase-box">
                        <div class="product-qty-wrap">
                            <span class="product-field-label">Quantity</span>
                            <div class="product-qty">
                                <button type="button" class="product-interactive" onclick="updateQuantity(-1)"
                                    aria-label="Decrease quantity">−</button>
                                <input type="number" id="quantity" value="1" min="1" max="99">
                                <button type="button" class="product-interactive" onclick="updateQuantity(1)"
                                    aria-label="Increase quantity">+</button>
                            </div>
                        </div>

                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" id="form-quantity" value="1">

                            <button type="submit" class="product-add-btn product-interactive">
                                Add to Cart
                            </button>
                        </form>
                    </div>

                    <div class="product-benefits">
                        <div class="product-benefit">
                            <svg fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                <path d="M5 12h14" />
                                <path d="M12 5l7 7-7 7" />
                            </svg>
                            Free Delivery
                        </div>
                        <div class="product-benefit">
                            <svg fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" />
                                <path d="M7 11V7a5 5 0 0110 0v4" />
                            </svg>
                            Secure Payment
                        </div>
                        <div class="product-benefit">
                            <svg fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                <path d="M3 12a9 9 0 109-9 9.75 9.75 0 00-6.74 2.74L3 8" />
                                <path d="M3 3v5h5" />
                            </svg>
                            Easy Returns
                        </div>
                    </div>
                </div>
            </div>

            {{-- Product Description row + Related Products row --}}
            <div class="product-lower">
                <div class="product-description-section">
                    <h2 class="product-description-heading">Description</h2>

                    <div class="product-description-content">
                        @if ($product->description)
                            {!! $product->description !!}
                        @else
                            <p>No description available.</p>
                        @endif
                    </div>

                    @if ($product->seller)
                        <div class="product-seller-block">
                            <div class="product-seller-block-line">
                                <span class="product-seller-block-label">Seller:</span>
                                <span class="product-seller-block-value">{{ $product->seller->name }}</span>
                            </div>
                            <div class="product-seller-block-line">
                                <span class="product-seller-block-label">Shop:</span>
                                <span
                                    class="product-seller-block-value">{{ $product->seller->shop_name ?? 'N/A' }}</span>
                            </div>
                        </div>
                    @endif
                </div>

                @if ($hasRelated)
                    <aside class="product-related">
                        <h2 class="product-related-title">You May Also Like</h2>
                        <div class="product-related-arrows">
                            <button type="button" class="product-related-arrow prev product-interactive"
                                aria-label="Previous products" disabled>
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                    width="18" height="18">
                                    <path d="M15 18l-6-6 6-6" />
                                </svg>
                            </button>
                            <button type="button" class="product-related-arrow next product-interactive"
                                aria-label="Next products">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                    width="18" height="18">
                                    <path d="M9 18l6-6-6-6" />
                                </svg>
                            </button>
                        </div>
                        <div class="product-related-viewport">
                            <div class="product-related-grid">
                                @foreach ($relatedProducts as $related)
                                    <a href="{{ route('product', $related->id) }}"
                                        class="product-related-card product-interactive">
                                        <div class="product-related-card-image">
                                            <img src="{{ $related->main_image }}" alt="{{ $related->name }}">
                                        </div>
                                        <div class="product-related-card-info">
                                            <h3>{{ $related->name }}</h3>
                                            <p>
                                                {{ $formatPrice($related->effective_price ?? 0) }}
                                                @if ($related->is_discounted)
                                                    <span
                                                        style="text-decoration:line-through;opacity:0.55;margin-left:6px;font-size:0.82rem;">{{ $formatPrice($related->price) }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                @endif
            </div>
        </div>
    </section>

    <script>
        // Custom cursor
        (function initCursor() {
            const dot = document.getElementById('cursorDot');
            const ring = document.getElementById('cursorRing');
            if (!dot || !ring) return;

            let mx = 0,
                my = 0,
                rx = 0,
                ry = 0,
                cursorReady = false;

            document.addEventListener('mousemove', e => {
                mx = e.clientX;
                my = e.clientY;

                if (!cursorReady) {
                    cursorReady = true;
                    dot.classList.add('is-active');
                    ring.classList.add('is-active');
                }
            });

            function animCursor() {
                dot.style.left = mx + 'px';
                dot.style.top = my + 'px';
                rx += (mx - rx) * 0.14;
                ry += (my - ry) * 0.14;
                ring.style.left = rx + 'px';
                ring.style.top = ry + 'px';
                requestAnimationFrame(animCursor);
            }

            animCursor();

            document.querySelectorAll('.product-interactive, .product-breadcrumb a').forEach(el => {
                el.addEventListener('mouseenter', () => ring.classList.add('hovering'));
                el.addEventListener('mouseleave', () => ring.classList.remove('hovering'));
            });
        })();

        // Navbar scroll state
        (function initNavbar() {
            const navbar = document.getElementById('navbar');
            if (!navbar) return;
            window.addEventListener('scroll', () => {
                navbar.classList.toggle('scrolled', window.scrollY > 60);
            });
        })();

        // Keep breadcrumb below navbar when sticky
        (function syncBreadcrumbOffset() {
            const navbar = document.getElementById('navbar');
            const breadcrumb = document.querySelector('.product-breadcrumb');
            if (!navbar || !breadcrumb) return;

            const update = () => {
                breadcrumb.style.top = navbar.classList.contains('scrolled') ? '60px' : '72px';
            };

            window.addEventListener('scroll', update, {
                passive: true
            });
            update();
        })();

        function changeMainImage(imageSrc, trigger) {
            const mainImage = document.getElementById('main-image');
            mainImage.style.opacity = '0';

            setTimeout(() => {
                mainImage.src = imageSrc;
                mainImage.style.opacity = '1';
            }, 200);

            document.querySelectorAll('#thumbnail-gallery .product-thumb').forEach(btn => {
                btn.classList.remove('is-active');
            });

            if (trigger) {
                trigger.classList.add('is-active');
            }
        }

        function updateQuantity(change) {
            const input = document.getElementById('quantity');
            const formQuantity = document.getElementById('form-quantity');
            let newValue = parseInt(input.value, 10) + change;
            const maxStock = parseInt(input.max, 10);

            if (newValue >= 1 && newValue <= maxStock) {
                input.value = newValue;
                formQuantity.value = newValue;
            }
        }

        document.getElementById('quantity').addEventListener('change', function() {
            let value = parseInt(this.value, 10);
            if (Number.isNaN(value) || value < 1) value = 1;
            this.value = value;
            document.getElementById('form-quantity').value = value;
        });

        // Related products carousel (4 visible at a time, arrows slide the rest)
        (function initRelatedCarousel() {
            const viewport = document.querySelector('.product-related-viewport');
            const track = document.querySelector('.product-related-grid');
            const arrows = document.querySelector('.product-related-arrows');
            const prevBtn = document.querySelector('.product-related-arrow.prev');
            const nextBtn = document.querySelector('.product-related-arrow.next');
            if (!viewport || !track || !arrows || !prevBtn || !nextBtn) return;

            const gap = () => parseFloat(getComputedStyle(track).columnGap) || 24;

            const updateArrows = () => {
                const maxScroll = viewport.scrollWidth - viewport.clientWidth;
                arrows.style.display = maxScroll <= 1 ? 'none' : 'flex';
                prevBtn.disabled = viewport.scrollLeft <= 1;
                nextBtn.disabled = viewport.scrollLeft >= maxScroll - 1;
            };

            const step = () => {
                const card = track.querySelector('.product-related-card');
                return card ? card.getBoundingClientRect().width + gap() : viewport.clientWidth;
            };

            prevBtn.addEventListener('click', () => {
                viewport.scrollBy({
                    left: -step(),
                    behavior: 'smooth'
                });
            });

            nextBtn.addEventListener('click', () => {
                viewport.scrollBy({
                    left: step(),
                    behavior: 'smooth'
                });
            });

            viewport.addEventListener('scroll', updateArrows, {
                passive: true
            });
            window.addEventListener('resize', updateArrows, {
                passive: true
            });
            updateArrows();
        })();
    </script>
</x-layout>
