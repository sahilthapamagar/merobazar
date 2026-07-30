<x-layout>
    @php
        $savedAddress = Auth::user()->deliveryAddresses;
        $subtotal = $carts->sum('amount');
        $itemCount = $carts->sum('quantity');
    @endphp

    <style>
        .checkout-page {
            padding: 1.5rem 5% 3rem;
            background: var(--background);
        }

        .checkout-inner {
            max-width: 1180px;
            margin: 0 auto;
        }

        .checkout-back {
            display: inline-block;
            font-size: 0.78rem;
            letter-spacing: 0.06em;
            color: var(--secondary);
            text-decoration: none;
            margin-bottom: 0.65rem;
            transition: color 0.2s ease;
        }

        .checkout-back:hover {
            color: var(--primary);
        }

        .checkout-header {
            margin-bottom: 1.25rem;
        }

        .section-label {
            font-size: 0.68rem;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--secondary);
            font-weight: 500;
            margin-bottom: 0.35rem;
        }

        .checkout-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.75rem, 3vw, 2.25rem);
            font-weight: 400;
            line-height: 1.1;
            color: var(--primary);
            margin-bottom: 0.35rem;
        }

        .checkout-seller {
            font-size: 0.86rem;
            color: rgba(73, 54, 40, 0.6);
            margin-bottom: 0;
        }

        .checkout-seller strong {
            color: var(--primary);
            font-weight: 600;
        }

        .checkout-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(300px, 380px);
            gap: 1.5rem;
            align-items: start;
        }

        .checkout-panel {
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
            padding: 1.35rem 1.5rem;
        }

        .checkout-panel+.checkout-panel {
            margin-top: 1rem;
        }

        .checkout-summary {
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
            padding: 1.35rem 1.5rem;
            position: sticky;
            top: 88px;
        }

        .panel-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15rem;
            font-weight: 500;
            color: var(--primary);
            margin-bottom: 1rem;
            padding-bottom: 0.6rem;
            border-bottom: 1px solid rgba(171, 136, 109, 0.15);
        }

        .field {
            margin-bottom: 0.9rem;
        }

        .field:last-child {
            margin-bottom: 0;
        }

        .field label {
            display: block;
            font-size: 0.68rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            font-weight: 600;
            color: rgba(73, 54, 40, 0.55);
            margin-bottom: 0.45rem;
        }

        .field input,
        .field textarea {
            width: 100%;
            padding: 0.75rem 0.9rem;
            border: 1px solid rgba(171, 136, 109, 0.3);
            background: var(--background);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--primary);
            outline: none;
            resize: none;
            transition: border-color 0.2s;
            cursor: none;
        }

        .field input:focus,
        .field textarea:focus {
            border-color: var(--secondary);
        }

        .field.has-error input,
        .field.has-error textarea {
            border-color: #c0392b;
        }

        .field-error {
            font-size: 0.72rem;
            color: #c0392b;
            margin-top: 0.3rem;
        }

        .payment-options {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.1rem;
            border: 1px solid rgba(171, 136, 109, 0.25);
            background: var(--background);
            cursor: none;
            transition: border-color 0.2s, background 0.2s;
        }

        .payment-option:has(input:checked) {
            border-color: var(--primary);
            background: #fff;
        }

        .payment-option input[type="radio"] {
            display: none;
        }

        .payment-radio {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            border: 1.5px solid rgba(171, 136, 109, 0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color 0.2s;
        }

        .payment-option:has(input:checked) .payment-radio {
            border-color: var(--primary);
        }

        .payment-radio::after {
            content: '';
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--primary);
            opacity: 0;
            transition: opacity 0.15s;
        }

        .payment-option:has(input:checked) .payment-radio::after {
            opacity: 1;
        }

        .payment-info {
            flex: 1;
        }

        .payment-name {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 2px;
        }

        .payment-desc {
            font-size: 0.75rem;
            color: rgba(73, 54, 40, 0.5);
        }

        .payment-badge {
            width: 44px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(171, 136, 109, 0.3);
            background: #fff;
            font-size: 0.95rem;
        }

        .khalti-badge {
            background: #5C2D91;
            color: #fff;
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            padding: 3px 7px;
        }

        .checkout-items {
            display: flex;
            flex-direction: column;
        }

        .checkout-item {
            display: grid;
            grid-template-columns: 72px minmax(0, 1fr) auto;
            gap: 0.85rem;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(171, 136, 109, 0.12);
        }

        .checkout-item:last-child {
            border-bottom: none;
        }

        .checkout-item-img {
            width: 72px;
            height: 88px;
            background: var(--background);
            overflow: hidden;
            flex-shrink: 0;
        }

        .checkout-item-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .checkout-item-img--empty {
            background: rgba(171, 136, 109, 0.1);
        }

        .checkout-item-details {
            min-width: 0;
        }

        .checkout-item-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--primary);
            margin: 0 0 4px;
            line-height: 1.25;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .checkout-item-meta {
            font-size: 0.78rem;
            color: rgba(73, 54, 40, 0.5);
            margin: 0;
        }

        .checkout-item-price {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary);
            white-space: nowrap;
            flex-shrink: 0;
        }

        .checkout-divider {
            height: 1px;
            background: rgba(171, 136, 109, 0.2);
            margin: 0.5rem 0 0.75rem;
        }

        .checkout-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.45rem 0;
            font-size: 0.88rem;
            color: rgba(73, 54, 40, 0.65);
        }

        .checkout-row.total {
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--primary);
            padding-top: 0.25rem;
        }

        .checkout-row.total span:last-child {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .checkout-place-btn {
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
            border: none;
            cursor: none;
            transition: background 0.25s ease;
        }

        .checkout-place-btn:hover {
            background: var(--secondary);
        }

        .checkout-empty {
            text-align: center;
            padding: 3rem 2rem;
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
        }

        .checkout-empty p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .checkout-empty span {
            display: block;
            font-size: 0.88rem;
            color: rgba(73, 54, 40, 0.5);
            margin-bottom: 1.5rem;
        }

        .checkout-empty-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.85rem 1.5rem;
            background: var(--primary);
            color: var(--cream);
            font-size: 0.68rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.25s ease;
        }

        .checkout-empty-link:hover {
            background: var(--secondary);
        }

        @media (max-width: 900px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }

            .checkout-summary {
                position: static;
            }
        }

        @media (max-width: 480px) {
            .checkout-page {
                padding: 1.25rem 4% 2.5rem;
            }

            .checkout-item {
                grid-template-columns: 64px minmax(0, 1fr) auto;
                gap: 0.75rem;
            }

            .checkout-item-img {
                width: 64px;
                height: 78px;
            }
        }
    </style>

    <section class="checkout-page">
        <div class="checkout-inner">
            @if ($carts->isEmpty())
                <header class="checkout-header">
                    <a href="{{ route('cart.index') }}" class="checkout-back">&larr; Back to cart</a>
                    <p class="section-label">Checkout</p>
                    <h1 class="checkout-title">Delivery & Payment</h1>
                </header>

                <div class="checkout-empty">
                    <p>No items to checkout</p>
                    <span>Your cart for {{ $seller->shop_name }} is empty.</span>
                    <a href="{{ route('cart.index') }}" class="checkout-empty-link">Return to Cart</a>
                </div>
            @else
                <form action="{{ route('order.store', $seller->id) }}" method="POST">
                    @csrf
                    <div class="checkout-grid">
                        <div>
                            <header class="checkout-header">
                                <a href="{{ route('cart.index') }}" class="checkout-back">&larr; Back to cart</a>
                                <p class="section-label">Checkout</p>
                                <h1 class="checkout-title">Delivery & Payment</h1>
                                <p class="checkout-seller">
                                    Ordering from <strong>{{ $seller->shop_name }}</strong>
                                </p>
                            </header>

                            <div class="checkout-panel">
                                <p class="panel-heading">Delivery Address</p>

                                <div class="field {{ $errors->has('address_detail') ? 'has-error' : '' }}">
                                    <label for="address_detail">Full Address</label>
                                    <textarea name="address_detail" id="address_detail" rows="3" placeholder="Street, ward, tole, municipality…">{{ old('address_detail', $savedAddress?->address_detail) }}</textarea>
                                    @error('address_detail')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="field {{ $errors->has('contact') ? 'has-error' : '' }}">
                                    <label for="contact">Contact Number</label>
                                    <input type="tel" name="contact" id="contact" placeholder="98XXXXXXXX"
                                        maxlength="10" value="{{ old('contact', $savedAddress?->contact) }}">
                                    @error('contact')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="checkout-panel">
                                <p class="panel-heading">Payment Method</p>

                                <div class="payment-options">
                                    <label class="payment-option">
                                        <input type="radio" name="payment_method" value="cod"
                                            {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }}>
                                        <div class="payment-radio"></div>
                                        <div class="payment-info">
                                            <p class="payment-name">Cash on Delivery</p>
                                            <p class="payment-desc">Pay when your order arrives</p>
                                        </div>
                                        <div class="payment-badge">💵</div>
                                    </label>

                                    @if ($seller->khalti_secrect_key)
                                        <label class="payment-option">
                                            <input type="radio" name="payment_method" value="khalti"
                                                {{ old('payment_method') === 'khalti' ? 'checked' : '' }}>
                                            <div class="payment-radio"></div>
                                            <div class="payment-info">
                                                <p class="payment-name">Khalti</p>
                                                <p class="payment-desc">Pay securely via Khalti digital wallet</p>
                                            </div>
                                            <div class="payment-badge">
                                                <span class="khalti-badge">K</span>
                                            </div>
                                        </label>
                                    @endif
                                </div>

                                @error('payment_method')
                                    <p class="field-error" style="margin-top: 0.75rem;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <aside class="checkout-summary">
                            <p class="panel-heading">Order Summary</p>

                            <div class="checkout-items">
                                @foreach ($carts as $cart)
                                    @php
                                        $product = $cart->product;
                                        $image = $product?->main_image;
                                    @endphp
                                    <div class="checkout-item">
                                        <div class="checkout-item-img {{ $image ? '' : 'checkout-item-img--empty' }}">
                                            @if ($image)
                                            <img src="{{ $image }}"
                                                alt="{{ $product?->name ?? 'Product' }}">
                                            @endif
                                        </div>
                                        <div class="checkout-item-details">
                                            <p class="checkout-item-name">{{ $product?->name ?? 'Product' }}</p>
                                            <p class="checkout-item-meta">
                                                Qty: {{ $cart->quantity }}

                                            </p>
                                        </div>
                                        <span class="checkout-item-price">Rs.
                                            {{ number_format((float) $cart->amount, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="checkout-divider"></div>
                            <div class="checkout-row">
                                <span>Items ({{ $itemCount }})</span>
                                <span>Rs. {{ number_format((float) $subtotal, 2) }}</span>
                            </div>
                            <div class="checkout-row">
                                <span>Shipping</span>
                                <span>Calculated later</span>
                            </div>
                            <div class="checkout-divider"></div>
                            <div class="checkout-row total">
                                <span>Total</span>
                                <span>Rs. {{ number_format((float) $subtotal, 2) }}</span>
                            </div>

                            <button type="submit" class="checkout-place-btn">Place Order</button>
                        </aside>
                    </div>
                </form>
            @endif
        </div>
    </section>
</x-layout>
