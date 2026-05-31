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
            height: 500px;
            object-fit: cover;
            transition: transform 0.7s ease, opacity 0.3s ease;
        }

        .product-gallery-main:hover img {
            transform: scale(1.05);
        }

        .product-badge-oos {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: rgba(153, 27, 27, 0.9);
            color: #fff;
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        .product-thumbs {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .product-thumb {
            position: relative;
            overflow: hidden;
            border-radius: 2px;
            border: 2px solid transparent;
            padding: 0;
            background: none;
            cursor: none;
            transition: border-color 0.3s ease;
        }

        .product-thumb.is-active,
        .product-thumb:hover {
            border-color: var(--primary);
        }

        .product-thumb img {
            width: 100%;
            height: 7rem;
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

        .product-compare {
            color: var(--secondary);
            text-decoration: line-through;
        }

        .product-discount {
            font-size: 0.75rem;
            color: #15803d;
            background: #dcfce7;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
        }

        .product-field-label {
            display: block;
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 0.75rem;
        }

        .product-variants {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .variant-btn {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.85rem 1rem;
            border: 1px solid rgba(171, 136, 109, 0.22);
            background: #fff;
            border-radius: 8px;
            text-align: left;
            cursor: none;
            transition: border-color 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
        }

        .variant-btn-thumb {
            width: 52px;
            height: 52px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid rgba(171, 136, 109, 0.25);
            flex-shrink: 0;
            background: #f5f0eb;
        }

        .variant-btn-body {
            flex: 1;
            min-width: 0;
        }

        .variant-btn:hover {
            border-color: var(--secondary);
        }

        .variant-btn.is-active {
            border-color: var(--primary);
            background: var(--cream);
            box-shadow: 0 0 0 1px var(--primary);
        }

        .variant-btn-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.125rem;
            color: var(--primary);
        }

        .variant-btn-price {
            font-size: 0.875rem;
            color: var(--secondary);
            margin-top: 0.25rem;
        }

        .variant-stock-badge {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            font-size: 0.65rem;
            color: #c2410c;
            background: #ffedd5;
            padding: 0.15rem 0.45rem;
            border-radius: 4px;
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

        .product-tabs-wrap {
            max-width: 760px;
            margin: 4rem auto 0;
            padding-top: 2.5rem;
            border-top: 1px solid #d1d5db;
            text-align: center;
        }

        .product-tabs {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2.5rem;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 1.5rem;
        }

        .product-tab-btn {
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            padding: 0 0 0.75rem;
            margin-bottom: -1px;
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--secondary);
            cursor: none;
            transition: color 0.2s ease, border-color 0.2s ease;
        }

        .product-tab-btn:hover,
        .product-tab-btn.is-active {
            color: var(--primary);
        }

        .product-tab-btn.is-active {
            border-bottom-color: var(--primary);
        }

        .product-tab-panel {
            display: none;
            animation: productTabIn 0.3s ease;
        }

        .product-tab-panel.is-active {
            display: block;
        }

        @keyframes productTabIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-description {
            color: var(--primary);
            line-height: 1.8;
            font-size: 0.95rem;
            text-align: center;
        }

        .product-description h1,
        .product-description h2,
        .product-description h3,
        .product-description h4 {
            font-family: 'Cormorant Garamond', serif;
            color: var(--primary);
            margin: 1rem 0 0.5rem;
        }

        .product-description p {
            margin-bottom: 0.75rem;
        }

        .product-description ul,
        .product-description ol {
            margin: 0.75rem auto;
            display: inline-block;
            text-align: left;
        }

        .product-related {
            margin-top: 6rem;
            padding-top: 4rem;
            border-top: 1px solid #d1d5db;
        }

        .product-related-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .product-related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 280px));
            justify-content: center;
            gap: 2rem;
        }

        .product-related-card {
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
            border-radius: 8px;
            margin-bottom: 1rem;
            background: var(--cream);
        }

        .product-related-card img {
            width: 100%;
            height: 18rem;
            object-fit: cover;
            display: block;
            transition: transform 0.7s ease;
        }

        .product-related-card:hover img {
            transform: scale(1.05);
        }

        .product-related-card h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.25rem;
            color: var(--primary);
            transition: color 0.3s ease;
        }

        .product-related-card:hover h3 {
            color: var(--secondary);
        }

        .product-related-card p {
            color: var(--secondary);
            margin-top: 0.35rem;
            font-size: 0.95rem;
            font-weight: 500;
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
                height: 360px;
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

            .product-variants {
                grid-template-columns: 1fr;
            }

            .variant-btn {
                text-align: left;
                justify-content: flex-start;
            }

            .variant-btn-body {
                text-align: left;
            }

            .product-tabs-wrap {
                margin-top: 2.5rem;
                padding-top: 2rem;
            }

            .product-related {
                margin-top: 4rem;
                padding-top: 3rem;
            }
        }

        @media (max-width: 480px) {
            .product-gallery-main img {
                height: 300px;
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
        }
    </style>

    <section class="product-page">

        <div class="product-container">
            @php
                $firstVariant = $product->productVarient->first();
                $mainImage =
                    $firstVariant && isset($firstVariant->images[0]) ? $firstVariant->images[0] : 'placeholder.jpg';
                $formatPrice = fn($amount) => 'Rs. ' . number_format((float) $amount, 2);
            @endphp

            {{-- Breadcrumb --}}
            <nav class="product-breadcrumb" aria-label="Breadcrumb">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('home') }}#categories">Products</a></li>
                    <li class="sep">/</li>
                    <li class="current">{{ $product->name }}</li>
                </ol>
            </nav>

            <div class="product-grid">
                {{-- Left: Product Images --}}
                <div class="product-gallery-panel">
                    <div class="product-gallery-main" id="main-image-container">
                        <img id="main-image" src="{{ asset('storage/' . $mainImage) }}" alt="{{ $product->name }}">

                        @if (!$product->stock)
                            <div class="product-badge-oos">Out of Stock</div>
                        @endif
                    </div>

                    @if ($firstVariant && count($firstVariant->images) > 1)
                        <div class="product-thumbs" id="thumbnail-gallery">
                            @foreach ($firstVariant->images as $index => $image)
                                <button type="button"
                                    onclick="changeMainImage('{{ asset('storage/' . $image) }}', this)"
                                    class="product-thumb product-interactive {{ $index === 0 ? 'is-active' : '' }}">
                                    <img src="{{ asset('storage/' . $image) }}"
                                        alt="{{ $product->name }} - {{ $index + 1 }}">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Right: Product Details --}}
                <div class="product-info">
                    <span class="product-eyebrow">Premium Collection</span>
                    <h1 class="product-title">{{ $product->name }}</h1>

                    @if ($product->seller)
                        <p class="product-seller">by {{ $product->seller->name }}</p>
                    @endif

                    <div class="product-price-row">
                        @if ($firstVariant)
                            <span class="product-price" id="variant-price">
                                {{ $formatPrice($firstVariant->price) }}
                            </span>
                        @endif

                        @if ($firstVariant && $firstVariant->compare_price)
                            <span class="product-compare">
                                {{ $formatPrice($firstVariant->compare_price) }}
                            </span>
                            <span class="product-discount">
                                {{ round((($firstVariant->compare_price - $firstVariant->price) / $firstVariant->compare_price) * 100) }}%
                                OFF
                            </span>
                        @endif
                    </div>

                    @if ($product->productVarient->count() > 1)
                        <div>
                            <span class="product-field-label">Select Variant</span>
                            <div class="product-variants" id="variant-selector">
                                @foreach ($product->productVarient as $variant)
                                    @php
                                        $variantImage = $variant->images[0] ?? 'placeholder.jpg';
                                    @endphp
                                    <button type="button"
                                        onclick="selectVariant('{{ $variant->id }}', '{{ $variant->price }}', '{{ asset('storage/' . $variantImage) }}', this)"
                                        data-variant-id="{{ $variant->id }}"
                                        class="variant-btn product-interactive {{ $loop->first ? 'is-active' : '' }}">
                                        <img src="{{ asset('storage/' . $variantImage) }}"
                                            alt="{{ $variant->name ?? 'Variant ' . $loop->iteration }}"
                                            class="variant-btn-thumb">
                                        <div class="variant-btn-body">
                                            <p class="variant-btn-name">
                                                {{ $variant->name ?? 'Variant ' . $loop->iteration }}
                                            </p>
                                            <p class="variant-btn-price">{{ $formatPrice($variant->price) }}</p>
                                        </div>

                                        @if ($variant->stock < 5 && $variant->stock > 0)
                                            <span class="variant-stock-badge">Only {{ $variant->stock }} left</span>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="product-purchase-box">
                        <div class="product-qty-wrap">
                            <span class="product-field-label">Quantity</span>
                            <div class="product-qty">
                                <button type="button" class="product-interactive" onclick="updateQuantity(-1)"
                                    aria-label="Decrease quantity">−</button>
                                <input type="number" id="quantity" value="1" min="1"
                                    max="{{ $firstVariant ? $firstVariant->stock : 1 }}">
                                <button type="button" class="product-interactive" onclick="updateQuantity(1)"
                                    aria-label="Increase quantity">+</button>
                            </div>
                        </div>

                        <form action="" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="variant_id" id="selected-variant-id"
                                value="{{ $firstVariant ? $firstVariant->id : '' }}">
                            <input type="hidden" name="quantity" id="form-quantity" value="1">

                            <button type="submit" class="product-add-btn product-interactive"
                                {{ !$product->stock ? 'disabled' : '' }}>
                                {{ $product->stock ? 'Add to Cart' : 'Out of Stock' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Product Tabs (centered, full width) --}}
            <div class="product-tabs-wrap">
                <div class="product-tabs" role="tablist">
                    <button type="button" class="product-tab-btn product-interactive is-active" data-tab="description"
                        role="tab" aria-selected="true">Description</button>
                    @if ($product->seller)
                        <button type="button" class="product-tab-btn product-interactive" data-tab="seller"
                            role="tab" aria-selected="false">Seller</button>
                    @endif
                </div>

                <div class="product-tab-panel is-active" id="tab-description" role="tabpanel">
                    <div class="product-description">
                        @if ($product->description)
                            {!! $product->description !!}
                        @else
                            <p>No description available.</p>
                        @endif
                    </div>
                </div>

                @if ($product->seller)
                    <div class="product-tab-panel" id="tab-seller" role="tabpanel">
                        <div class="product-description">
                            <h3>{{ $product->seller->name }}</h3>
                            <p>{{ $product->seller->description ?? 'No seller information available.' }}</p>
                        </div>
                    </div>
                @endif
            </div>

            @if (isset($relatedProducts) && $relatedProducts->count() > 0)
                <div class="product-related">
                    <h2 class="product-related-title">You May Also Like</h2>
                    <div class="product-related-grid">
                        @foreach ($relatedProducts as $related)
                            <a href="{{ route('product', $related->id) }}"
                                class="product-related-card product-interactive">
                                @php
                                    $relatedImage = $related->productVarient->first()->images[0] ?? 'placeholder.jpg';
                                @endphp
                                <div class="product-related-card-image">
                                    <img src="{{ asset('storage/' . $relatedImage) }}" alt="{{ $related->name }}">
                                </div>
                                <h3>{{ $related->name }}</h3>
                                <p>{{ $formatPrice($related->productVarient->first()->price ?? 0) }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
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

            document.querySelectorAll('.product-interactive, .product-breadcrumb a, .product-tab-btn').forEach(el => {
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

        // Tabs
        document.querySelectorAll('.product-tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const tab = btn.dataset.tab;

                document.querySelectorAll('.product-tab-btn').forEach(b => {
                    b.classList.remove('is-active');
                    b.setAttribute('aria-selected', 'false');
                });
                document.querySelectorAll('.product-tab-panel').forEach(panel => {
                    panel.classList.remove('is-active');
                });

                btn.classList.add('is-active');
                btn.setAttribute('aria-selected', 'true');
                document.getElementById('tab-' + tab)?.classList.add('is-active');
            });
        });

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

        function formatRs(price) {
            return 'Rs. ' + parseFloat(price).toLocaleString('en-IN', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function selectVariant(variantId, price, imageSrc, trigger) {
            document.getElementById('selected-variant-id').value = variantId;
            document.getElementById('variant-price').textContent = formatRs(price);
            changeMainImage(imageSrc, null);

            document.querySelectorAll('.variant-btn').forEach(btn => {
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
            const maxStock = parseInt(this.max, 10);
            let value = parseInt(this.value, 10);

            if (Number.isNaN(value) || value < 1) value = 1;
            if (value > maxStock) value = maxStock;

            this.value = value;
            document.getElementById('form-quantity').value = value;
        });
    </script>
</x-layout>
