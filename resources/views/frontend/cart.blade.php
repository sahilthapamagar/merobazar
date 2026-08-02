<x-layout>
    <style>
        .cart-page {
            padding: 108px 5% 72px;
            background: var(--background);
            min-height: 100vh;
        }

        .cart-page-inner {
            max-width: 1180px;
            margin: 0 auto;
        }

        .cart-header {
            margin-bottom: 1.75rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(171, 136, 109, 0.2);
        }

        .section-label {
            font-size: 0.68rem;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--secondary);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .cart-header-row {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 3.5vw, 2.75rem);
            font-weight: 400;
            line-height: 1.1;
            color: var(--primary);
        }

        .section-title em {
            font-style: italic;
            color: var(--secondary);
        }

        .cart-header-meta {
            font-size: 0.78rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: rgba(73, 54, 40, 0.55);
            font-weight: 500;
        }

        .cart-success-banner {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            margin-bottom: 1.5rem;
            background: rgba(106, 154, 91, 0.1);
            border-left: 3px solid #6a9a5b;
            color: #3d5a34;
            font-size: 0.86rem;
        }

        .cart-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(300px, 360px);
            gap: 2rem;
            align-items: start;
        }

        .cart-seller-groups {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* ─── Seller group ─── */
        .cart-seller-group {
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
        }

        .cart-seller-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            padding: 14px 24px;
            background: var(--cream);
            border-bottom: 1px solid rgba(171, 136, 109, 0.15);
        }

        .cart-seller-label {
            font-size: 0.62rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--secondary);
            font-weight: 600;
            margin-bottom: 3px;
        }

        .cart-seller-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            font-weight: 500;
            color: var(--primary);
            margin: 0;
        }

        .cart-seller-meta {
            font-size: 0.72rem;
            letter-spacing: 0.08em;
            color: rgba(73, 54, 40, 0.5);
            text-transform: uppercase;
        }

        .cart-seller-foot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            padding: 14px 24px;
            background: var(--cream);
            border-top: 1px solid rgba(171, 136, 109, 0.15);
        }

        .cart-seller-subtotal {
            font-size: 0.82rem;
            color: rgba(73, 54, 40, 0.65);
        }

        .cart-seller-subtotal strong {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            color: var(--primary);
            font-weight: 600;
            margin-left: 6px;
        }

        .cart-seller-checkout {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.25rem;
            background: var(--primary);
            color: var(--cream);
            font-size: 0.68rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: none;
            transition: background 0.25s ease;
        }

        .cart-seller-checkout:hover {
            background: var(--secondary);
        }

        /* ─── Items panel ─── */
        .cart-items-panel {
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
        }

        .cart-list-head {
            display: grid;
            grid-template-columns: 100px minmax(0, 1fr) 130px 120px;
            gap: 1.5rem;
            padding: 14px 24px;
            background: var(--cream);
            border-bottom: 1px solid rgba(171, 136, 109, 0.15);
            font-size: 0.65rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--secondary);
            font-weight: 600;
        }

        .cart-list-head span:nth-child(3) {
            text-align: center;
        }

        .cart-list-head span:last-child {
            text-align: right;
        }

        .cart-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .cart-row {
            display: grid;
            grid-template-columns: 100px minmax(0, 1fr) 130px 120px;
            gap: 1.5rem;
            align-items: center;
            padding: 1.25rem 24px;
            border-bottom: 1px solid rgba(171, 136, 109, 0.12);
        }

        .cart-row:last-child {
            border-bottom: none;
        }

        .cart-row-img {
            display: block;
            width: 100px;
            height: 120px;
            background: var(--background);
            overflow: hidden;
            flex-shrink: 0;
        }

        .cart-row-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .cart-row-img:hover img {
            transform: scale(1.04);
        }

        .cart-row-details {
            min-width: 0;
        }

        .cart-row-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.35rem;
            font-weight: 500;
            color: var(--primary);
            margin: 0 0 4px;
            line-height: 1.25;
        }

        .cart-row-name a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .cart-row-name a:hover {
            color: var(--secondary);
        }

        .cart-row-variant {
            font-size: 0.8rem;
            color: rgba(73, 54, 40, 0.5);
            margin: 0 0 10px;
        }

        .cart-row-discount {
            display: inline-block;
            font-size: 0.62rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            background: var(--primary);
            color: var(--accent);
            padding: 0.2rem 0.45rem;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .cart-row-remove {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 0;
            border: none;
            background: none;
            font-size: 0.72rem;
            letter-spacing: 0.06em;
            color: rgba(154, 74, 74, 0.85);
            cursor: none;
            text-decoration: underline;
            text-underline-offset: 3px;
            transition: color 0.2s ease;
        }

        .cart-row-remove:hover {
            color: #7a3535;
        }

        .cart-row-qty-cell {
            display: flex;
            justify-content: center;
        }

        .cart-row-price-cell {
            text-align: right;
        }

        .cart-qty-form {
            display: block;
        }

        .cart-qty {
            display: inline-flex;
            align-items: stretch;
            border: 1px solid rgba(171, 136, 109, 0.35);
            background: #fff;
        }

        .cart-qty-btn {
            width: 2.5rem;
            border: none;
            background: transparent;
            color: var(--primary);
            font-size: 1rem;
            cursor: none;
            transition: background 0.2s ease;
        }

        .cart-qty-btn:hover:not(:disabled) {
            background: var(--cream);
        }

        .cart-qty-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .cart-qty-input {
            width: 3rem;
            text-align: center;
            border: none;
            border-left: 1px solid rgba(171, 136, 109, 0.25);
            border-right: 1px solid rgba(171, 136, 109, 0.25);
            font-size: 0.88rem;
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
            color: var(--primary);
            background: transparent;
            padding: 0.5rem 0;
            -moz-appearance: textfield;
        }

        .cart-qty-input::-webkit-outer-spin-button,
        .cart-qty-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .cart-qty-input:focus {
            outline: none;
        }

        .cart-row-price-block {
            min-width: 110px;
        }

        .cart-row-unit {
            display: block;
            font-size: 0.72rem;
            color: rgba(73, 54, 40, 0.45);
            margin-bottom: 2px;
        }

        .cart-row-price {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.35rem;
            font-weight: 600;
            color: var(--primary);
            line-height: 1;
        }

        /* ─── Summary ─── */
        .cart-summary {
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
            padding: 1.75rem 1.5rem;
            position: sticky;
            top: 96px;
        }

        .cart-summary-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.45rem;
            font-weight: 500;
            color: var(--primary);
            margin: 0 0 1.25rem;
        }

        .cart-summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            font-size: 0.88rem;
            color: rgba(73, 54, 40, 0.65);
        }

        .cart-summary-divider {
            height: 1px;
            background: rgba(171, 136, 109, 0.2);
            margin: 0.75rem 0 1rem;
        }

        .cart-summary-row.total {
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--primary);
            padding-top: 0;
        }

        .cart-summary-row.total span:last-child {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .cart-checkout-btn {
            display: block;
            width: 100%;
            margin-top: 1.25rem;
            padding: 1rem 1.25rem;
            background: var(--primary);
            color: var(--cream);
            font-size: 0.72rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            border: none;
            cursor: none;
            transition: background 0.25s ease;
        }

        .cart-checkout-btn:hover {
            background: var(--secondary);
        }

        .cart-continue-btn {
            display: block;
            width: 100%;
            margin-top: 0.65rem;
            padding: 0.9rem;
            background: transparent;
            color: var(--primary);
            font-size: 0.7rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 500;
            text-align: center;
            text-decoration: none;
            border: none;
            cursor: none;
            transition: color 0.2s ease;
        }

        .cart-continue-btn:hover {
            color: var(--secondary);
        }

        .cart-trust {
            margin-top: 1.25rem;
            padding-top: 1.25rem;
            border-top: 1px solid rgba(171, 136, 109, 0.15);
            font-size: 0.72rem;
            color: rgba(73, 54, 40, 0.45);
            line-height: 1.6;
            letter-spacing: 0.02em;
        }

        .cart-seller-summary-item {
            display: flex;
            justify-content: space-between;
            gap: 0.75rem;
            padding: 0.45rem 0;
            font-size: 0.82rem;
            color: rgba(73, 54, 40, 0.65);
        }

        .cart-seller-summary-item span:first-child {
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .cart-seller-summary-item span:last-child {
            flex-shrink: 0;
            font-weight: 500;
            color: var(--primary);
        }

        .cart-empty {
            text-align: center;
            padding: 4rem 2rem;
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
        }

        .cart-empty p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.75rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .cart-empty span {
            display: block;
            font-size: 0.9rem;
            color: rgba(73, 54, 40, 0.5);
            margin-bottom: 1.75rem;
        }

        @media (max-width: 900px) {
            .cart-layout {
                grid-template-columns: 1fr;
            }

            .cart-summary {
                position: static;
            }

            .cart-list-head {
                display: none;
            }

            .cart-row {
                grid-template-columns: 88px minmax(0, 1fr) auto;
                grid-template-rows: auto auto;
                gap: 0.75rem 1rem;
            }

            .cart-row-img {
                width: 88px;
                height: 108px;
                grid-row: 1 / 3;
            }

            .cart-row-details {
                grid-column: 2 / 4;
            }

            .cart-row-qty-cell {
                grid-column: 2;
                grid-row: 2;
                justify-content: flex-start;
            }

            .cart-row-price-cell {
                grid-column: 3;
                grid-row: 2;
                justify-content: flex-end;
            }
        }

        @media (max-width: 480px) {
            .cart-page {
                padding: 96px 4% 48px;
            }

            .cart-row {
                padding: 1rem 16px;
                gap: 1rem;
            }

            .cart-list-head {
                padding: 12px 16px;
            }
        }
    </style>

    <section class="cart-page">
        <div class="cart-page-inner">
            <header class="cart-header">
                <p class="section-label">Your Bag</p>
                <div class="cart-header-row">
                    <h1 class="section-title">Shopping <em>Cart</em></h1>
                    @if ($cartItems->isNotEmpty())
                        <p class="cart-header-meta">
                            {{ $cartItems->sum('quantity') }} {{ Str::plural('piece', $cartItems->sum('quantity')) }}
                            &middot; {{ $cartGroups->count() }} {{ Str::plural('seller', $cartGroups->count()) }}
                        </p>
                    @endif
                </div>
            </header>

            @if (session('cart_added'))
                <div class="cart-success-banner" role="status">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M20 6L9 17l-5-5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Added to your bag successfully.</span>
                </div>
            @endif

            @if ($cartItems->isEmpty())
                <div class="cart-empty">
                    <p>Your bag is empty</p>
                    <span>Explore our collection and find something you love.</span>
                    <a href="{{ route('products') }}" class="cart-checkout-btn"
                        style="max-width: 260px; margin: 0 auto;">Browse Products</a>
                </div>
            @else
                <div class="cart-layout">
                    <div class="cart-seller-groups">
                        @foreach ($cartGroups as $group)
                            @php
                                $seller = $group['seller'];
                            @endphp
                            <section class="cart-seller-group">
                                <header class="cart-seller-head">
                                    <div>
                                        <p class="cart-seller-label">Sold by</p>
                                        <h2 class="cart-seller-name">
                                            {{ $seller?->shop_name ?? 'Unknown Seller' }}
                                        </h2>
                                    </div>
                                    <span class="cart-seller-meta">
                                        {{ $group['quantity'] }} {{ Str::plural('item', $group['quantity']) }}
                                    </span>
                                </header>

                                <div class="cart-list-head" aria-hidden="true">
                                    <span></span>
                                    <span>Product</span>
                                    <span>Quantity</span>
                                    <span>Total</span>
                                </div>
                                <ul class="cart-list">
                                    @foreach ($group['items'] as $item)
                                        @php
                                            $product = $item->product;
                                            $image = $product?->main_image;
                                            $unitPrice = $item->quantity > 0 ? (float) $item->amount / $item->quantity : 0;
                                        @endphp
                                        <li class="cart-row">
                                            <a href="{{ route('product', $product->id) }}" class="cart-row-img">
                                                @if ($image)
                                                    <img src="{{ $image }}"
                                                        alt="{{ $product->name }}">
                                                @endif
                                            </a>

                                            <div class="cart-row-details">
                                                @if ($product->is_discounted)
                                                    <span class="cart-row-discount">-{{ $product->discount_percent }}% off</span>
                                                @endif
                                                <h3 class="cart-row-name">
                                                    <a href="{{ route('product', $product->id) }}">{{ $product->name }}</a>
                                                </h3>

                                                <form action="{{ route('cart.destroy', $item) }}" method="POST"
                                                    class="cart-remove-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="cart-row-remove">Remove</button>
                                                </form>
                                            </div>

                                            <div class="cart-row-qty-cell">
                                                <form action="{{ route('cart.update', $item) }}" method="POST"
                                                    class="cart-qty-form" data-cart-qty-form>
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="cart-qty">
                                                        <button type="button" class="cart-qty-btn" data-qty-decrease
                                                            aria-label="Decrease"
                                                            {{ $item->quantity <= 1 ? 'disabled' : '' }}>−</button>
                                                        <input type="number" name="quantity" class="cart-qty-input"
                                                            value="{{ $item->quantity }}" min="1"
                                                            max="99" aria-label="Quantity">
                                                        <button type="button" class="cart-qty-btn" data-qty-increase
                                                            aria-label="Increase"
                                                            {{ $item->quantity >= 99 ? 'disabled' : '' }}>+</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="cart-row-price-cell">
                                                @if ($item->quantity > 1)
                                                    <div>
                                                        <span class="cart-row-unit">Rs.
                                                            {{ number_format($unitPrice, 2) }} each</span>
                                                        <span class="cart-row-price">Rs.
                                                            {{ number_format((float) $item->amount, 2) }}</span>
                                                    </div>
                                                @else
                                                    <span class="cart-row-price">Rs.
                                                        {{ number_format((float) $item->amount, 2) }}</span>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                                <footer class="cart-seller-foot">
                                    <p class="cart-seller-subtotal">
                                        Seller subtotal
                                        <strong>Rs. {{ number_format((float) $group['subtotal'], 2) }}</strong>
                                    </p>
                                    @if ($seller)
                                        <a href="{{ route('checkout.seller', $seller->id) }}" class="cart-seller-checkout">
                                            Checkout from {{ $seller->shop_name }}
                                        </a>
                                    @endif
                                </footer>
                            </section>
                        @endforeach
                    </div>

                    <aside class="cart-summary">
                        <h2 class="cart-summary-title">Bag Summary</h2>
                        @foreach ($cartGroups as $group)
                            <div class="cart-seller-summary-item">
                                <span>{{ $group['seller']?->shop_name ?? 'Seller' }}
                                    ({{ $group['quantity'] }})</span>
                                <span>Rs. {{ number_format((float) $group['subtotal'], 2) }}</span>
                            </div>
                        @endforeach
                        <div class="cart-summary-divider"></div>
                        <div class="cart-summary-row">
                            <span>Sellers</span>
                            <span>{{ $cartGroups->count() }}</span>
                        </div>
                        <div class="cart-summary-row">
                            <span>Shipping</span>
                            <span>Per seller at checkout</span>
                        </div>
                        <div class="cart-summary-divider"></div>
                        <div class="cart-summary-row total">
                            <span>Bag Total</span>
                            <span>Rs. {{ number_format((float) $subtotal, 2) }}</span>
                        </div>
                        <a href="{{ route('products') }}" class="cart-continue-btn">&larr; Continue Shopping</a>
                        <p class="cart-trust">
                            Items from different sellers are checked out separately. Use the checkout button on each
                            seller section above.
                        </p>
                    </aside>
                </div>
            @endif
        </div>
    </section>

    <script>
        document.querySelectorAll('[data-cart-qty-form]').forEach((form) => {
            const input = form.querySelector('.cart-qty-input');
            const decreaseBtn = form.querySelector('[data-qty-decrease]');
            const increaseBtn = form.querySelector('[data-qty-increase]');
            const min = parseInt(input.min, 10) || 1;
            const max = parseInt(input.max, 10) || 99;

            const syncButtons = () => {
                const value = parseInt(input.value, 10) || min;
                decreaseBtn.disabled = value <= min;
                increaseBtn.disabled = value >= max;
            };

            const submitQty = (nextValue) => {
                input.value = Math.min(max, Math.max(min, nextValue));
                syncButtons();
                form.submit();
            };

            decreaseBtn.addEventListener('click', () => submitQty((parseInt(input.value, 10) || min) - 1));
            increaseBtn.addEventListener('click', () => submitQty((parseInt(input.value, 10) || min) + 1));
            input.addEventListener('change', () => submitQty(parseInt(input.value, 10) || min));
            syncButtons();
        });
    </script>
</x-layout>
