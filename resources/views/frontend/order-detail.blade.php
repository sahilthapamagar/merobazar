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

        /* ─── Review link ─── */
        .detail-item-review {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            margin-top: 0.6rem;
            padding: 0.32rem 0.8rem;
            background: transparent;
            border: 1px solid rgba(171, 136, 109, 0.45);
            color: var(--secondary);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.6rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.25s ease, color 0.25s ease, border-color 0.25s ease, transform 0.2s ease;
        }

        .detail-item-review:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--cream);
            transform: translateY(-1px);
        }

        .detail-item-reviewed {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            margin-top: 0.6rem;
            font-size: 0.6rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            font-weight: 600;
            color: #3d5a34;
        }

        .detail-item-reviewed em {
            font-style: italic;
            color: #6d8f63;
        }

        /* ─── Review modal ─── */
        .review-modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 9996;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            background: rgba(43, 31, 20, 0.55);
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
        }

        .review-modal-overlay[hidden] {
            display: none;
        }

        .review-modal {
            position: relative;
            width: 100%;
            max-width: 460px;
            background: var(--cream);
            border: 1px solid rgba(171, 136, 109, 0.25);
            box-shadow: 0 24px 60px rgba(43, 31, 20, 0.35);
            animation: reviewPop 0.28s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        @keyframes reviewPop {
            from {
                opacity: 0;
                transform: translateY(16px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .review-modal-close {
            position: absolute;
            top: 0.7rem;
            right: 0.9rem;
            background: none;
            border: none;
            font-size: 1.7rem;
            line-height: 1;
            color: var(--secondary);
            cursor: pointer;
            transition: color 0.2s ease, transform 0.25s ease;
        }

        .review-modal-close:hover {
            color: var(--primary);
            transform: rotate(90deg);
        }

        .review-modal-head {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.4rem 1.5rem 1.1rem;
            border-bottom: 1px solid rgba(171, 136, 109, 0.15);
        }

        .review-modal-head img {
            width: 52px;
            height: 64px;
            object-fit: cover;
            background: var(--background);
            flex-shrink: 0;
        }

        .review-modal-label {
            font-size: 0.6rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--secondary);
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .review-modal-head h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.25rem;
            font-weight: 500;
            color: var(--primary);
            line-height: 1.25;
        }

        .review-modal form {
            padding: 1.25rem 1.5rem 1.5rem;
        }

        .review-stars {
            display: flex;
            justify-content: center;
            gap: 0.4rem;
            margin-bottom: 1.1rem;
        }

        .review-star {
            background: none;
            border: none;
            padding: 0.1rem;
            font-size: 1.8rem;
            line-height: 1;
            color: rgba(171, 136, 109, 0.35);
            cursor: pointer;
            transition: color 0.15s ease, transform 0.15s ease;
        }

        .review-star:hover,
        .review-star.is-hover,
        .review-star.is-active {
            color: #c29b40;
            transform: scale(1.08);
        }

        .review-stars.is-error .review-star {
            color: rgba(176, 64, 64, 0.55);
            animation: reviewShake 0.4s ease;
        }

        @keyframes reviewShake {
            0%,
            100% {
                transform: translateX(0);
            }
            25% {
                transform: translateX(-4px);
            }
            75% {
                transform: translateX(4px);
            }
        }

        .review-rating-hint {
            display: block;
            text-align: center;
            font-size: 0.68rem;
            letter-spacing: 0.08em;
            color: #7a3535;
            margin: -0.6rem 0 0.9rem;
        }

        .review-modal textarea {
            width: 100%;
            min-height: 110px;
            border: 1px solid rgba(171, 136, 109, 0.35);
            background: #fff;
            color: var(--primary);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            line-height: 1.55;
            padding: 0.75rem 0.9rem;
            resize: vertical;
            outline: none;
            transition: border-color 0.2s ease;
        }

        .review-modal textarea:focus {
            border-color: var(--primary);
        }

        .review-modal textarea::placeholder {
            color: rgba(73, 54, 40, 0.4);
        }

        .review-submit {
            display: block;
            width: 100%;
            margin-top: 1rem;
            padding: 0.85rem 1rem;
            background: var(--primary);
            border: none;
            color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.68rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.25s ease, transform 0.2s ease;
        }

        .review-submit:hover {
            background: var(--secondary);
            transform: translateY(-1px);
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
                                @if ($item->product && $item->product->main_image_url)
                                    <img src="{{ $item->product->main_image_url }}" alt="{{ $item->product->name }}">
                                @endif
                            </a>
                            <div class="detail-item-details">
                                <h3>
                                    <a href="{{ route('product', $item->product_id) }}">
                                        {{ $item->product?->name ?? 'Product' }}
                                    </a>
                                </h3>
                                <p>Rs. {{ number_format($unitPrice, 2) }} each</p>
                                @if ($order->status === 'delivered')
                                    @if ($item->review)
                                        <span class="detail-item-reviewed">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2.5">
                                                <path d="M20 6L9 17l-5-5" />
                                            </svg>
                                            Reviewed
                                            <em>&starf; {{ $item->review->rating }}/5</em>
                                        </span>
                                    @else
                                        <button type="button" class="detail-item-review" data-review-open
                                            data-action="{{ route('review.store', [$order->id, $item->id]) }}"
                                            data-product-name="{{ $item->product?->name ?? 'Product' }}"
                                            data-product-image="{{ $item->product?->main_image_url ?? '' }}">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M12 2l2.9 6.26 6.6.56-5 4.33 1.5 6.45L12 16.9l-5.9 3.7 1.5-6.45-5-4.33 6.6-.56L12 2z" />
                                            </svg>
                                            Write a Review
                                        </button>
                                    @endif
                                @endif
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

            <!-- ─── Review modal ─── -->
            <div class="review-modal-overlay" id="reviewModal" hidden>
                <div class="review-modal" role="dialog" aria-modal="true" aria-labelledby="reviewModalTitle">
                    <button type="button" class="review-modal-close" data-review-close aria-label="Close">&times;</button>

                    <div class="review-modal-head">
                        <img id="reviewModalImage" src="" alt="">
                        <div>
                            <p class="review-modal-label">Write a Review</p>
                            <h3 id="reviewModalTitle"></h3>
                        </div>
                    </div>

                    <form id="reviewForm" method="POST">
                        @csrf
                        <div class="review-stars" id="reviewStars">
                            @for ($i = 1; $i <= 5; $i++)
                                <button type="button" class="review-star" data-star="{{ $i }}"
                                    aria-label="{{ $i }} star{{ $i > 1 ? 's' : '' }}">&starf;</button>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="reviewRating" value="0">
                        <span class="review-rating-hint" id="reviewRatingHint" hidden>Please select a rating</span>

                        <textarea name="comment" id="reviewComment" rows="4" required maxlength="1000"
                            placeholder="Share your experience with this product..."></textarea>

                        <button type="submit" class="review-submit">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        (function () {
            const overlay = document.getElementById('reviewModal');
            if (!overlay) return;

            const form = document.getElementById('reviewForm');
            const starsWrap = document.getElementById('reviewStars');
            const stars = Array.from(document.querySelectorAll('.review-star'));
            const ratingInput = document.getElementById('reviewRating');
            const hint = document.getElementById('reviewRatingHint');
            const titleEl = document.getElementById('reviewModalTitle');
            const imageEl = document.getElementById('reviewModalImage');
            const commentEl = document.getElementById('reviewComment');

            let selectedRating = 0;

            function paint() {
                stars.forEach((s) => s.classList.toggle('is-active', Number(s.dataset.star) <= selectedRating));
            }

            function close() {
                overlay.hidden = true;
                document.body.style.overflow = '';
            }

            function open(btn) {
                form.action = btn.dataset.action;
                titleEl.textContent = btn.dataset.productName;
                const imgSrc = btn.dataset.productImage;
                if (imgSrc) {
                    imageEl.src = imgSrc;
                    imageEl.style.display = '';
                } else {
                    imageEl.removeAttribute('src');
                    imageEl.style.display = 'none';
                }
                selectedRating = 0;
                ratingInput.value = '0';
                commentEl.value = '';
                hint.hidden = true;
                starsWrap.classList.remove('is-error');
                paint();
                overlay.hidden = false;
                document.body.style.overflow = 'hidden';
            }

            stars.forEach((star) => {
                star.addEventListener('click', () => {
                    selectedRating = Number(star.dataset.star);
                    ratingInput.value = String(selectedRating);
                    hint.hidden = true;
                    starsWrap.classList.remove('is-error');
                    paint();
                });
                star.addEventListener('mouseenter', () => {
                    const v = Number(star.dataset.star);
                    stars.forEach((s) => s.classList.toggle('is-hover', Number(s.dataset.star) <= v));
                });
            });

            starsWrap.addEventListener('mouseleave', () => {
                stars.forEach((s) => s.classList.remove('is-hover'));
            });

            document.querySelectorAll('[data-review-open]').forEach((btn) => {
                btn.addEventListener('click', () => open(btn));
            });

            overlay.querySelectorAll('[data-review-close]').forEach((el) => el.addEventListener('click', close));

            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) close();
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') close();
            });

            form.addEventListener('submit', (e) => {
                if (selectedRating === 0) {
                    e.preventDefault();
                    hint.hidden = false;
                    starsWrap.classList.add('is-error');
                    setTimeout(() => starsWrap.classList.remove('is-error'), 500);
                }
            });
        })();
    </script>
</x-layout>
