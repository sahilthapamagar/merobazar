<x-layout>
    @php
        $order = session('order_response', []);
    @endphp

    <style>
        .order-store-page {
            padding: 1.5rem 5% 3rem;
            background: var(--background);
            min-height: 60vh;
        }

        .order-store-inner {
            max-width: 720px;
            margin: 0 auto;
        }

        .order-store-card {
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
            padding: 1.75rem 1.5rem;
        }

        .section-label {
            font-size: 0.68rem;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--secondary);
            font-weight: 500;
            margin-bottom: 0.35rem;
        }

        .order-store-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.75rem, 3vw, 2.25rem);
            font-weight: 400;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .order-store-seller {
            font-size: 0.86rem;
            color: rgba(73, 54, 40, 0.6);
            margin-bottom: 1.25rem;
        }

        .order-store-json {
            background: var(--background);
            border: 1px solid rgba(171, 136, 109, 0.2);
            padding: 1.25rem;
            font-family: 'DM Sans', monospace;
            font-size: 0.82rem;
            line-height: 1.6;
            color: var(--primary);
            overflow-x: auto;
            white-space: pre-wrap;
            word-break: break-word;
            margin-bottom: 1.5rem;
        }

        .order-store-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .order-store-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.85rem 1.25rem;
            font-size: 0.68rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.25s ease, color 0.2s ease;
        }

        .order-store-btn--primary {
            background: var(--primary);
            color: var(--cream);
        }

        .order-store-btn--primary:hover {
            background: var(--secondary);
        }

        .order-store-btn--secondary {
            background: transparent;
            color: var(--primary);
            border: 1px solid rgba(171, 136, 109, 0.35);
        }

        .order-store-btn--secondary:hover {
            color: var(--secondary);
        }
    </style>

    <section class="order-store-page">
        <div class="order-store-inner">
            <div class="order-store-card">
                <p class="section-label">Order Store</p>
                <h1 class="order-store-title">Order Response</h1>
                <p class="order-store-seller">
                    Seller: <strong>{{ $seller->shop_name }}</strong>
                </p>

                <pre class="order-store-json">{{ json_encode($order, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>

                <div class="order-store-actions">
                    <a href="{{ route('checkout.seller', $seller->id) }}" class="order-store-btn order-store-btn--secondary">
                        Back to Checkout
                    </a>
                    <a href="{{ route('cart.index') }}" class="order-store-btn order-store-btn--primary">
                        Return to Cart
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layout>
