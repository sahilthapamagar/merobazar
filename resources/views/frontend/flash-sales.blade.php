<x-layout>
    <style>
        .flash-sales-page {
            width: 100%;
            overflow-x: hidden;
            padding: 140px 8% 100px;
            min-height: 100vh;
        }

        /* ─── HERO HEADER ─── */
        .fsh-hero {
            text-align: center;
            margin-bottom: 24px;
        }

        .fsh-live-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #e63946;
            color: #fff;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 6px 16px;
            border-radius: 999px;
            box-shadow: 0 0 16px rgba(230, 57, 70, 0.45);
            margin-bottom: 20px;
        }

        .fsh-live-dot {
            width: 7px;
            height: 7px;
            background: #fff;
            border-radius: 50%;
            animation: fshPulse 1.2s ease-in-out infinite;
        }

        @keyframes fshPulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.3;
                transform: scale(0.6);
            }
        }

        .fsh-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.2rem, 5vw, 3.6rem);
            font-weight: 300;
            color: var(--primary);
            line-height: 1.1;
            margin-bottom: 16px;
        }

        .fsh-title em {
            font-style: italic;
            color: var(--secondary);
        }

        .fsh-sub {
            font-size: 0.9rem;
            line-height: 1.8;
            color: #6b5c4e;
            max-width: 560px;
            margin: 0 auto;
        }

        .fsh-sub strong {
            color: #c1121f;
            font-variant-numeric: tabular-nums;
        }

        /* ─── PRODUCT GRID ─── */
        .fsh-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 40px;
        }

        .fsh-card {
            background: #ffffff;
            border: 1px solid rgba(171, 136, 109, 0.2);
            border-radius: 6px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            text-decoration: none !important;
            color: inherit !important;
            transition: transform 0.35s cubic-bezier(0.2, 0, 0.2, 1), box-shadow 0.35s ease, border-color 0.35s ease;
        }

        .fsh-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(73, 54, 40, 0.15);
            border-color: var(--secondary);
        }

        .fsh-img-container {
            position: relative;
            width: 100%;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            background: #f4ede6;
        }

        .fsh-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.2, 0, 0.2, 1);
        }

        .fsh-card:hover .fsh-img-container img {
            transform: scale(1.06);
        }

        .fsh-tag-pill {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(43, 31, 20, 0.85);
            backdrop-filter: blur(4px);
            color: #fff;
            font-size: 0.62rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 3px 8px;
            border-radius: 3px;
            z-index: 2;
        }

        .fsh-time-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(4px);
            color: #493628;
            font-size: 0.65rem;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 3px;
            display: flex;
            align-items: center;
            gap: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            z-index: 2;
            font-variant-numeric: tabular-nums;
        }

        .fsh-card-info {
            padding: 16px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
            background: #ffffff;
        }

        .fsh-vendor-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.72rem;
            color: #8c7361;
            margin-bottom: 6px;
            gap: 8px;
        }

        .fsh-vendor-name {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-weight: 600;
            color: var(--secondary);
            max-width: 140px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .fsh-card-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--primary);
            line-height: 1.25;
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.8em;
        }

        .fsh-card-pricing {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .fsh-price-main {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--primary);
        }

        .fsh-price-old {
            font-size: 0.8rem;
            color: #a89485;
            text-decoration: line-through;
        }

        .fsh-progress-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.68rem;
            color: #7a6858;
            margin-bottom: 3px;
        }

        .fsh-progress-bar {
            width: 100%;
            height: 4px;
            background: rgba(73, 54, 40, 0.1);
            border-radius: 2px;
            overflow: hidden;
        }

        .fsh-progress-fill {
            height: 100%;
            background: #e63946;
            border-radius: 2px;
        }

        .fsh-card-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            margin-top: 12px;
            border-top: 1px solid rgba(171, 136, 109, 0.15);
        }

        .fsh-rating {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .fsh-rating .star {
            color: #c29b40;
            font-size: 0.75rem;
        }

        .fsh-rating-count {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--primary);
        }

        .fsh-btn-add {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--secondary);
            transition: transform 0.2s ease, color 0.2s ease;
        }

        .fsh-card:hover .fsh-btn-add {
            color: var(--primary);
            transform: translateX(3px);
        }

        /* ─── EMPTY STATE ─── */
        .fsh-empty {
            text-align: center;
            padding: 80px 20px;
            background: white;
            border: 1px solid rgba(171, 136, 109, 0.2);
            margin-top: 40px;
        }

        .fsh-empty-icon {
            font-size: 2.6rem;
            margin-bottom: 14px;
        }

        .fsh-empty-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .fsh-empty-text {
            font-size: 0.85rem;
            color: #7a6858;
            margin-bottom: 24px;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 1024px) {
            .fsh-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 16px;
            }
        }

        @media (max-width: 768px) {
            .flash-sales-page {
                padding: 120px 5% 72px;
            }

            .fsh-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 14px;
            }

            .fsh-card-title {
                font-size: 1.05rem;
            }
        }

        @media (max-width: 480px) {
            .flash-sales-page {
                padding: 112px 4% 60px;
            }

            .fsh-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="flash-sales-page">
        <!-- ─── HERO HEADER ─── -->
        <div class="fsh-hero">
            <span class="fsh-live-pill"><span class="fsh-live-dot"></span> ⚡ Flash Sale Live</span>
            <h1 class="fsh-title">Exclusive <em>Flash Sales</em></h1>
            <p class="fsh-sub">
                Special low prices directly from verified merchants — prices automatically revert when the timer
                expires!
                @if ($earliestEnd)
                    Next deal ends in: <strong class="global-flash-countdown"
                        data-countdown="{{ $earliestEnd->toIso8601String() }}">Calculating...</strong>
                @endif
            </p>
        </div>

        @if ($activeFlashSales->count() > 0)
            <!-- ─── ALL FLASH SALE PRODUCTS ─── -->
            <div class="fsh-grid">
                @foreach ($activeFlashSales as $flashSale)
                    @php
                        $item = $flashSale->product;
                        $pctSold = $flashSale->flash_stock > 0
                            ? min(100, round(($flashSale->sold_quantity / $flashSale->flash_stock) * 100))
                            : 0;
                    @endphp
                    <a href="{{ route('product', $item->id) }}" class="fsh-card">
                        <div class="fsh-img-container">
                            <img src="{{ $item->main_image_url }}" alt="{{ $item->name }}" loading="lazy" />
                            <div class="fsh-tag-pill" style="background:#e63946;color:#fff;">
                                ⚡ -{{ $flashSale->discount_percent }}% OFF
                            </div>
                            <div class="fsh-time-badge item-countdown"
                                data-countdown="{{ $flashSale->end_time->toIso8601String() }}">
                                <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M12 6v6l4 2"></path>
                                </svg>
                                <span>Ending soon</span>
                            </div>
                        </div>

                        <div class="fsh-card-info">
                            <div>
                                <div class="fsh-vendor-row">
                                    <span class="fsh-vendor-name"
                                        title="{{ $flashSale->seller->shop_name ?? ($flashSale->seller->name ?? 'Merchant') }}">
                                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="1.8"
                                            viewBox="0 0 24 24">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                        {{ $flashSale->seller->shop_name ?? ($flashSale->seller->name ?? 'Merchant') }}
                                    </span>
                                    @if ($item->category)
                                        <span style="font-size:0.68rem;opacity:0.85;">{{ $item->category->name }}</span>
                                    @endif
                                </div>

                                <div class="fsh-card-title">{{ $item->name }}</div>

                                <div class="fsh-card-pricing">
                                    <span class="fsh-price-main">Rs. {{ number_format($flashSale->flash_price, 2) }}</span>
                                    <span class="fsh-price-old">Rs. {{ number_format($item->price, 2) }}</span>
                                </div>

                                <div>
                                    <div class="fsh-progress-label">
                                        <span>Sold: {{ $flashSale->sold_quantity }}/{{ $flashSale->flash_stock }}</span>
                                        <span>{{ $flashSale->remaining_stock }} left</span>
                                    </div>
                                    <div class="fsh-progress-bar">
                                        <div class="fsh-progress-fill" style="width:{{ $pctSold }}%;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="fsh-card-bottom">
                                <div class="fsh-rating">
                                    <span class="star">★</span>
                                    <span class="fsh-rating-count">{{ number_format($item->reviews_avg_rating ?? 5.0, 1) }}
                                        ({{ $item->reviews_count ?? 0 }})</span>
                                </div>
                                <span class="fsh-btn-add">Grab Deal →</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <!-- ─── EMPTY STATE ─── -->
            <div class="fsh-empty">
                <div class="fsh-empty-icon">⚡</div>
                <div class="fsh-empty-title">No Flash Sales Right Now</div>
                <p class="fsh-empty-text">All deals have ended or sold out. Check back soon — merchants launch new
                    flash sales every day!</p>
                <a href="{{ route('products') }}" class="btn-primary"><span>Browse All Products</span></a>
            </div>
        @endif
    </div>

    <script>
        // ── LIVE FLASH SALE COUNTDOWNS ──
        (function() {
            function updateCountdowns() {
                const now = new Date().getTime();
                document.querySelectorAll('[data-countdown]').forEach(el => {
                    const endTimeStr = el.getAttribute('data-countdown');
                    if (!endTimeStr) return;
                    const endTime = new Date(endTimeStr).getTime();
                    const diff = endTime - now;

                    if (diff <= 0) {
                        const span = el.querySelector('span') || el;
                        span.textContent = 'Sale Ended';
                        return;
                    }

                    const hours = Math.floor(diff / (1000 * 60 * 60));
                    const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const secs = Math.floor((diff % (1000 * 60)) / 1000);

                    const formatted =
                        `${String(hours).padStart(2, '0')}:${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
                    const span = el.querySelector('span') || el;
                    span.textContent = formatted;
                });
            }

            updateCountdowns();
            setInterval(updateCountdowns, 1000);
        })();
    </script>
</x-layout>
