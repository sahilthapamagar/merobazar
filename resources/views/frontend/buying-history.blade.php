<x-layout>
    <style>
        .history-page {
            padding: 108px 5% 72px;
            background: var(--background);
            min-height: 100vh;
        }

        .history-inner {
            max-width: 1180px;
            margin: 0 auto;
        }

        .history-header {
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

        .history-header-row {
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

        .history-meta {
            font-size: 0.78rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: rgba(73, 54, 40, 0.55);
            font-weight: 500;
        }

        /* ─── Stats ─── */
        .history-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        .history-stat {
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
            padding: 1.25rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .history-stat span {
            font-size: 0.62rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--secondary);
            font-weight: 600;
        }

        .history-stat strong {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.9rem;
            font-weight: 500;
            color: var(--primary);
            line-height: 1.1;
        }

        /* ─── Summary rows ─── */
        .history-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .history-row {
            display: grid;
            grid-template-columns: 120px minmax(0, 1fr) 110px 130px auto;
            gap: 1.5rem;
            align-items: center;
            padding: 1.25rem 24px;
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }

        .history-row:hover {
            border-color: rgba(171, 136, 109, 0.45);
            box-shadow: 0 10px 30px rgba(43, 31, 20, 0.06);
        }

        .cell-label {
            display: block;
            font-size: 0.6rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--secondary);
            font-weight: 600;
            margin-bottom: 0.4rem;
        }

        .history-cell-date strong {
            display: block;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15rem;
            font-weight: 500;
            color: var(--primary);
            line-height: 1.2;
        }

        .history-cell-date small {
            font-size: 0.72rem;
            color: rgba(73, 54, 40, 0.5);
        }

        .history-product-names {
            margin: 0;
            font-size: 0.92rem;
            color: var(--primary);
            line-height: 1.5;
        }

        .history-product-names em {
            font-style: italic;
            color: var(--secondary);
            font-weight: 500;
            white-space: nowrap;
        }

        .history-cell-products small {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.7rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(73, 54, 40, 0.45);
        }

        .history-badge {
            display: inline-block;
            padding: 0.3rem 0.65rem;
            font-size: 0.62rem;
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

        .history-cell-amount strong {
            display: block;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.35rem;
            font-weight: 600;
            color: var(--primary);
            line-height: 1.1;
            white-space: nowrap;
        }

        .history-view-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.25rem;
            background: var(--primary);
            color: var(--cream);
            font-size: 0.66rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            font-weight: 600;
            text-decoration: none;
            border: none;
            
            white-space: nowrap;
            transition: background 0.25s ease, transform 0.2s ease;
        }

        .history-view-btn:hover {
            background: var(--secondary);
            transform: translateY(-1px);
        }

        /* ─── Empty state ─── */
        .history-empty {
            text-align: center;
            padding: 4rem 2rem;
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
        }

        .history-empty p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.75rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .history-empty span {
            display: block;
            font-size: 0.9rem;
            color: rgba(73, 54, 40, 0.5);
            margin-bottom: 1.75rem;
        }

        .history-empty-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.9rem 1.75rem;
            background: var(--primary);
            color: var(--cream);
            font-size: 0.7rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            font-weight: 600;
            text-decoration: none;
            border: none;
            
            transition: background 0.25s ease;
        }

        .history-empty-link:hover {
            background: var(--secondary);
        }

        @media (max-width: 900px) {
            .history-row {
                grid-template-columns: 1fr 1fr;
                gap: 1rem 1.25rem;
            }

            .history-cell-products {
                grid-column: 1 / -1;
                order: -1;
            }

            .history-view-btn {
                grid-column: 1 / -1;
                justify-self: start;
            }
        }

        @media (max-width: 768px) {
            .history-page {
                padding: 96px 5% 56px;
            }

            .history-stats {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .history-stat {
                flex-direction: row;
                align-items: baseline;
                justify-content: space-between;
                padding: 1rem 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .history-row {
                grid-template-columns: 1fr;
                gap: 0.9rem;
                padding: 1.1rem 18px;
            }

            .history-cell-products {
                grid-column: auto;
                order: 0;
            }

            .history-view-btn {
                grid-column: auto;
                justify-self: stretch;
                width: 100%;
            }
        }
    </style>

    <section class="history-page">
        <div class="history-inner">
            <header class="history-header">
                <p class="section-label">Your Orders</p>
                <div class="history-header-row">
                    <h1 class="section-title">Buying <em>History</em></h1>

                </div>
            </header>

            @if ($orders->isEmpty())
                <div class="history-empty">
                    <p>No orders yet</p>
                    <span>Everything you buy will be saved here.</span>
                    <a href="{{ route('products') }}" class="history-empty-link">Browse Products</a>
                </div>
            @else
                <div class="history-list">
                    @foreach ($orders as $order)
                        <article class="history-row">
                            <div class="history-cell-date">
                                <span class="cell-label">Date</span>
                                <strong>{{ $order->created_at->format('M d, Y') }}</strong>
                                <small>{{ $order->created_at->format('h:i A') }}</small>
                            </div>

                            <div class="history-cell-products">
                                <span class="cell-label">Products</span>
                                <p class="history-product-names">
                                    @foreach ($order->orderItems as $item)
                                        {{ $item->product?->name ?? 'Product' }} <em>&times;
                                            {{ $item->quantity }}</em>{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </p>
                                <small>{{ $order->orderItems->sum('quantity') }}
                                    {{ Str::plural('item', $order->orderItems->sum('quantity')) }}</small>
                            </div>

                            <div class="history-cell-status">
                                <span class="cell-label">Status</span>
                                <span class="history-badge is-{{ $order->status ?? 'pending' }}">
                                    {{ Str::ucfirst($order->status ?? 'pending') }}
                                </span>
                            </div>

                            <div class="history-cell-amount">
                                <span class="cell-label">Total Amount</span>
                                <strong>Rs. {{ number_format((float) $order->total_amount, 2) }}</strong>
                            </div>

                            <a href="{{ route('buying-history.show', $order->id) }}" class="history-view-btn">
                                View Detail
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M5 12h14" />
                                    <path d="M12 5l7 7-7 7" />
                                </svg>
                            </a>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-layout>
