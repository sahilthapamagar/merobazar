<x-layout>
    <style>
        .cart-page {
            padding: 120px 5% 80px;
            background: var(--background);
            min-height: 100vh;
        }

        .cart-page-inner {
            max-width: 1280px;
            margin: 0 auto;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
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

        .cart-success-banner {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            margin-bottom: 2rem;
            background: rgba(106, 154, 91, 0.12);
            border: 1px solid rgba(106, 154, 91, 0.35);
            color: #3d5a34;
            font-size: 0.88rem;
            letter-spacing: 0.02em;
        }

        .cart-success-banner svg {
            flex-shrink: 0;
        }

        .cart-layout {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 2.5rem;
            align-items: start;
        }

        .cart-items-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .cart-item-card {
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.12);
            overflow: hidden;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .cart-item-card:hover {
            box-shadow: 0 18px 40px rgba(73, 54, 40, 0.08);
            transform: translateY(-2px);
        }

        .cart-item-img-wrap {
            position: relative;
            aspect-ratio: 4/3;
            overflow: hidden;
            background: var(--background);
        }

        .cart-item-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cart-item-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            background: var(--primary);
            color: var(--accent);
            padding: 0.35rem 0.65rem;
            font-size: 0.65rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 500;
        }

        .cart-item-body {
            padding: 18px;
        }

        .cart-item-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15rem;
            font-weight: 500;
            color: var(--primary);
            margin-bottom: 6px;
            line-height: 1.3;
        }

        .cart-item-name a {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .cart-item-name a:hover {
            color: var(--secondary);
        }

        .cart-item-variant {
            font-size: 0.78rem;
            color: rgba(73, 54, 40, 0.55);
            margin-bottom: 14px;
            letter-spacing: 0.04em;
        }

        .cart-item-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 14px;
            padding-top: 12px;
            border-top: 1px solid rgba(171, 136, 109, 0.15);
        }

        .cart-item-qty {
            font-size: 0.75rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--secondary);
            font-weight: 500;
        }

        .cart-item-price {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--primary);
        }

        .cart-item-actions {
            display: flex;
            gap: 8px;
        }

        .cart-item-link {
            flex: 1;
            padding: 10px;
            text-align: center;
            font-size: 0.72rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 500;
            text-decoration: none;
            border: 1px solid var(--accent);
            color: var(--primary);
            transition: all 0.3s ease;
            cursor: none;
        }

        .cart-item-link:hover {
            background: var(--primary);
            color: var(--accent);
            border-color: var(--primary);
        }

        .cart-remove-btn {
            padding: 10px 14px;
            font-size: 0.72rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 500;
            background: transparent;
            border: 1px solid rgba(176, 64, 64, 0.35);
            color: #9a4a4a;
            cursor: none;
            transition: all 0.3s ease;
        }

        .cart-remove-btn:hover {
            background: rgba(176, 64, 64, 0.08);
            border-color: #9a4a4a;
        }

        .cart-summary {
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.12);
            padding: 28px 24px;
            position: sticky;
            top: 100px;
        }

        .cart-summary-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            font-weight: 500;
            color: var(--primary);
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(171, 136, 109, 0.15);
        }

        .cart-summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 0.88rem;
            color: rgba(73, 54, 40, 0.7);
        }

        .cart-summary-row.total {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid rgba(171, 136, 109, 0.2);
            font-size: 1rem;
            font-weight: 600;
            color: var(--primary);
        }

        .cart-summary-row.total span:last-child {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.35rem;
        }

        .cart-checkout-btn {
            display: block;
            width: 100%;
            margin-top: 1.5rem;
            padding: 16px;
            background: var(--primary);
            color: var(--accent);
            font-size: 0.75rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            font-weight: 500;
            text-align: center;
            text-decoration: none;
            border: none;
            cursor: none;
            transition: background 0.3s ease;
        }

        .cart-checkout-btn:hover {
            background: var(--secondary);
        }

        .cart-continue-btn {
            display: block;
            width: 100%;
            margin-top: 10px;
            padding: 14px;
            background: transparent;
            color: var(--primary);
            font-size: 0.72rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 500;
            text-align: center;
            text-decoration: none;
            border: 1px solid var(--accent);
            cursor: none;
            transition: all 0.3s ease;
        }

        .cart-continue-btn:hover {
            border-color: var(--secondary);
            color: var(--secondary);
        }

        .cart-empty {
            text-align: center;
            padding: 5rem 1.5rem;
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.12);
        }

        .cart-empty p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .cart-empty span {
            display: block;
            font-size: 0.9rem;
            color: rgba(73, 54, 40, 0.55);
            margin-bottom: 2rem;
        }

        .cart-item-count {
            font-size: 0.78rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--secondary);
            font-weight: 500;
        }

        @media (max-width: 1024px) {
            .cart-layout {
                grid-template-columns: 1fr;
            }

            .cart-summary {
                position: static;
            }

            .cart-items-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .cart-page {
                padding: 100px 5% 60px;
            }

            .cart-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .cart-items-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="cart-page">
        <div class="cart-page-inner">
            <div class="cart-header">
                <div>
                    <div class="section-label">Your Bag</div>
                    <h1 class="section-title">Shopping <em>Cart</em></h1>
                </div>
                @if ($cartItems->isNotEmpty())
                    <span class="cart-item-count">{{ $cartItems->count() }}
                        {{ Str::plural('item', $cartItems->count()) }}</span>
                @endif
            </div>

            @if (session('cart_added'))
                <div class="cart-success-banner" role="status">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M20 6L9 17l-5-5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Product added to cart successfully. Review your items below.</span>
                </div>
            @endif

            @if ($cartItems->isEmpty())
                <div class="cart-empty">
                    <p>Your cart is empty</p>
                    <span>Discover our collection and add something you love.</span>
                    <a href="{{ route('products') }}" class="cart-checkout-btn" style="max-width: 280px; margin: 0 auto;">
                        Browse Products
                    </a>
                </div>
            @else
                <div class="cart-layout">
                    <div class="cart-items-grid">
                        @foreach ($cartItems as $item)
                            @php
                                $variant = $item->productVarient;
                                $product = $item->product;
                                $image = $variant && ! empty($variant->images[0])
                                    ? $variant->images[0]
                                    : null;
                            @endphp

                            <article class="cart-item-card">
                                <div class="cart-item-img-wrap">
                                    @if ($image)
                                        <a href="{{ route('product', $product->id) }}">
                                            <img src="{{ asset('storage/' . $image) }}"
                                                alt="{{ $product->name }}">
                                        </a>
                                    @endif
                                    @if ($product->discount)
                                        <span class="cart-item-badge">-{{ $product->discount }}%</span>
                                    @endif
                                </div>

                                <div class="cart-item-body">
                                    <h2 class="cart-item-name">
                                        <a href="{{ route('product', $product->id) }}">{{ $product->name }}</a>
                                    </h2>
                                    @if ($variant?->name)
                                        <p class="cart-item-variant">{{ $variant->name }}</p>
                                    @endif

                                    <div class="cart-item-meta">
                                        <span class="cart-item-qty">Qty: {{ $item->quantity }}</span>
                                        <span class="cart-item-price">Rs.
                                            {{ number_format((float) $item->amount, 2) }}</span>
                                    </div>

                                    <div class="cart-item-actions">
                                        <a href="{{ route('product', $product->id) }}"
                                            class="cart-item-link">View Product</a>
                                        <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="cart-remove-btn">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <aside class="cart-summary">
                        <h2 class="cart-summary-title">Order Summary</h2>
                        <div class="cart-summary-row">
                            <span>Items ({{ $cartItems->sum('quantity') }})</span>
                            <span>{{ $cartItems->count() }} products</span>
                        </div>
                        <div class="cart-summary-row total">
                            <span>Subtotal</span>
                            <span>Rs. {{ number_format((float) $subtotal, 2) }}</span>
                        </div>
                        <a href="#" class="cart-checkout-btn">Proceed to Checkout</a>
                        <a href="{{ route('products') }}" class="cart-continue-btn">Continue Shopping</a>
                    </aside>
                </div>
            @endif
        </div>
    </section>
</x-layout>
