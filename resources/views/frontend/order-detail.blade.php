<x-layout>
    @php
        $paymentLabels = [
            'cod' => 'Cash on Delivery',
            'khalti' => 'Khalti',
        ];
        $delivery = $order->user?->deliveryAddresses;
    @endphp

    <style>
        .detail-page {
            padding: 108px 5% 72px;
            background: var(--background);
            min-height: 100vh;
        }

        .detail-inner {
            max-width: 980px;
            margin: 0 auto;
        }

        .detail-back {
            display: inline-block;
            font-size: 0.78rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--secondary);
            text-decoration: none;
            margin-bottom: 1.25rem;
            transition: color 0.2s ease;
        }

        .detail-back:hover {
            color: var(--primary);
        }

        .detail-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
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

        .detail-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.9rem, 3vw, 2.5rem);
            font-weight: 400;
            line-height: 1.1;
            color: var(--primary);
            margin: 0;
        }

        .detail-title span {
            color: var(--secondary);
            font-style: italic;
        }

        .detail-placed {
            font-size: 0.78rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(73, 54, 40, 0.55);
            margin-top: 0.4rem;
        }

        .history-badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            font-size: 0.64rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            font-weight: 600;
        }

        .history-badge.is-pending {
            background: rgba(171, 136, 109, 0.18);
            color: var(--secondary);
        }

        .history-badge.is-processing {
            background: rgba(70, 110, 180, 0.12);
            color: #3a5f9c;
        }

        .history-badge.is-delivered {
            background: rgba(106, 154, 91, 0.14);
            color: #3d5a34;
        }

        .history-badge.is-cancelled {
            background: rgba(176, 64, 64, 0.12);
            color: #7a3535;
        }

        .detail-panel {
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
        }

        .detail-panel+.detail-panel {
            margin-top: 1.25rem;
        }

        .panel-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.25rem;
            font-weight: 500;
            color: var(--primary);
            margin: 0;
            padding: 16px 24px;
            background: var(--cream);
            border-bottom: 1px solid rgba(171, 136, 109, 0.15);
        }

        /* ─── Meta grid ─── */
        .detail-meta {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            padding: 1.5rem 24px;
        }

        .detail-meta-cell span {
            display: block;
            font-size: 0.6rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--secondary);
            font-weight: 600;
            margin-bottom: 0.35rem;
        }

        .detail-meta-cell strong {
            font-size: 0.92rem;
            font-weight: 500;
            color: var(--primary);
            word-break: break-word;
        }

        /* ─── Items ─── */
        .detail-items {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .detail-item {
            display: grid;
            grid-template-columns: 72px minmax(0, 1fr) 110px 120px;
            gap: 1rem;
            align-items: center;
            padding: 1rem 24px;
            border-bottom: 1px solid rgba(171, 136, 109, 0.12);
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-item-img {
            display: block;
            width: 72px;
            height: 88px;
            background: var(--background);
            overflow: hidden;
            flex-shrink: 0;
        }

        .detail-item-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .detail-item-details {
            min-width: 0;
        }

        .detail-item-details h3 {
            margin: 0 0 4px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            font-weight: 500;
            line-height: 1.25;
            color: var(--primary);
        }

        .detail-item-details h3 a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .detail-item-details h3 a:hover {
            color: var(--secondary);
        }

        .detail-item-details p {
            margin: 0;
            font-size: 0.78rem;
            color: rgba(73, 54, 40, 0.55);
        }

        .detail-item-qty {
            text-align: center;
            font-size: 0.86rem;
            color: rgba(73, 54, 40, 0.6);
        }

        .detail-item-qty strong {
            color: var(--primary);
            font-weight: 600;
        }

        .detail-item-price {
            text-align: right;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary);
            white-space: nowrap;
        }

        /* ─── Footer / total ─── */
        .detail-foot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            padding: 16px 24px;
            background: var(--cream);
            border-top: 1px solid rgba(171, 136, 109, 0.15);
        }

        .detail-foot p {
            margin: 0;
            font-size: 0.78rem;
            color: rgba(73, 54, 40, 0.65);
        }

        .detail-total {
            display: flex;
            align-items: baseline;
            gap: 0.6rem;
        }

        .detail-total span {
            font-size: 0.72rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: rgba(73, 54, 40, 0.55);
            font-weight: 600;
        }

        .detail-total strong {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--primary);
        }

        /* ─── Address ─── */
        .detail-address {
            padding: 1.5rem 24px;
        }

        .detail-address-line {
            display: flex;
            gap: 0.75rem;
            padding: 0.35rem 0;
            font-size: 0.9rem;
            color: var(--primary);
        }

        .detail-address-line span {
            font-size: 0.62rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--secondary);
            font-weight: 600;
            min-width: 110px;
            padding-top: 2px;
        }

        @media (max-width: 768px) {
            .detail-page {
                padding: 96px 5% 56px;
            }

            .detail-meta {
                grid-template-columns: 1fr 1fr;
                padding: 1.25rem 20px;
            }

            .detail-item {
                grid-template-columns: 64px minmax(0, 1fr) auto;
                gap: 0.75rem;
                padding: 0.85rem 20px;
            }

            .detail-item-img {
                width: 64px;
                height: 78px;
            }

            .detail-item-qty {
                grid-column: 2;
                text-align: left;
            }

            .detail-item-price {
                grid-column: 3;
                grid-row: 1;
            }

            .detail-address {
                padding: 1.25rem 20px;
            }
        }
    </style>

    <section class="detail-page">
        <div class="detail-inner">
            <a href="{{ route('buying-history') }}" class="detail-back">&larr; Back to Buying History</a>

            <header class="detail-header">
                <div>
                    <p class="section-label">Order Details</p>
                    <h1 class="detail-title">Order <span>#{{ $order->id }}</span></h1>
                    <p class="detail-placed">Placed on {{ $order->created_at->format('M d, Y · h:i A') }}</p>
                </div>
                <span class="history-badge is-{{ $order->status ?? 'pending' }}">
                    {{ Str::ucfirst($order->status ?? 'pending') }}
                </span>
            </header>



            <div class="detail-panel">
                <p class="panel-heading">Items</p>
                <ul class="detail-items">
                    @foreach ($order->orderItems as $item)
                        @php
                            $unitPrice = $item->quantity > 0 ? (float) $item->amount / $item->quantity : 0;
                        @endphp
                        <li class="detail-item">
                            <a href="{{ route('product', $item->product_id) }}" class="detail-item-img">
                                @if ($item->product && $item->product->main_image)
                                    <img src="{{ $item->product->main_image }}" alt="{{ $item->product->name }}">
                                @endif
                            </a>
                            <div class="detail-item-details">
                                <h3>
                                    <a href="{{ route('product', $item->product_id) }}">
                                        {{ $item->product?->name ?? 'Product' }}
                                    </a>
                                </h3>
                                <p>Rs. {{ number_format($unitPrice, 2) }} each</p>
                            </div>
                            <span class="detail-item-qty">Qty <strong>{{ $item->quantity }}</strong></span>
                            <span class="detail-item-price">Rs. {{ number_format((float) $item->amount, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="detail-foot">
                    <p>{{ $order->orderItems->sum('quantity') }}
                        {{ Str::plural('item', $order->orderItems->sum('quantity')) }}</p>
                    <div class="detail-total">
                        <span>Total Amount</span>
                        <strong>Rs. {{ number_format((float) $order->total_amount, 2) }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
