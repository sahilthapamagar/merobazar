<style>
    /* ─── PAGE SHELL ─── */
    .categories-page {
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
    }

    /* ─── HERO ─── */
    .cat-hero {
        padding: 160px 8% 100px;
        background: linear-gradient(135deg, var(--cream) 0%, #ede6dd 100%);
        position: relative;
        overflow: hidden;
        min-height: 50vh;
        display: flex;
        align-items: center;
    }

    .cat-hero::before {
        content: '';
        position: absolute;
        top: -120px;
        right: -120px;
        width: 500px;
        height: 500px;
        border: 1px solid rgba(171, 136, 109, 0.08);
        border-radius: 50%;
    }

    .cat-hero::after {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 340px;
        height: 340px;
        border: 1px solid rgba(171, 136, 109, 0.12);
        border-radius: 50%;
    }

    .cat-hero-content {
        max-width: 720px;
        position: relative;
        z-index: 1;
    }

    .cat-hero-eyebrow {
        font-size: 0.7rem;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--secondary);
        font-weight: 500;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .cat-hero-eyebrow::before {
        content: '';
        display: inline-block;
        width: 28px;
        height: 1.5px;
        background: var(--secondary);
    }

    .cat-hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(3rem, 6vw, 5.2rem);
        font-weight: 300;
        line-height: 1.0;
        color: var(--primary);
        margin-bottom: 20px;
    }

    .cat-hero-title em {
        font-style: italic;
        color: var(--secondary);
    }

    .cat-hero-sub {
        font-size: 0.9rem;
        line-height: 1.8;
        color: #6b5c4e;
        max-width: 480px;
        margin-bottom: 0;
    }

    /* Hero decorative floating elements */
    .hero-deco-circle {
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 300px;
        height: 300px;
        border: 1.5px solid rgba(171, 136, 109, 0.06);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-deco-square {
        position: absolute;
        bottom: 60px;
        right: 12%;
        width: 80px;
        height: 80px;
        border: 1.5px solid rgba(171, 136, 109, 0.1);
        transform: rotate(45deg);
        pointer-events: none;
    }

    /* ─── STATS BAR ─── */
    .cat-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0;
        max-width: 900px;
        margin: -40px auto 0;
        padding: 32px 40px;
        background: white;
        box-shadow: 0 20px 50px rgba(73, 54, 40, 0.06);
        position: relative;
        z-index: 2;
    }

    .cat-stat {
        text-align: center;
        border-right: 1px solid rgba(171, 136, 109, 0.15);
        padding: 0 20px;
    }

    .cat-stat:last-child {
        border-right: none;
    }

    .cat-stat-value {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.2rem;
        font-weight: 500;
        color: var(--primary);
        line-height: 1;
        margin-bottom: 4px;
    }

    .cat-stat-value span {
        color: var(--secondary);
    }

    .cat-stat-label {
        font-size: 0.7rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #7a6858;
    }

    /* ─── SECTION LAYOUT ─── */
    .cat-section {
        padding: 100px 8%;
    }

    .cat-section-label {
        font-size: 0.7rem;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--secondary);
        font-weight: 500;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .cat-section-label::before {
        content: '';
        display: inline-block;
        width: 28px;
        height: 1.5px;
        background: var(--secondary);
    }

    .cat-section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(2rem, 4vw, 3.4rem);
        font-weight: 300;
        line-height: 1.15;
        color: var(--primary);
        margin-bottom: 12px;
    }

    .cat-section-title em {
        font-style: italic;
        color: var(--secondary);
    }

    .cat-section-sub {
        font-size: 0.85rem;
        color: #6b5c4e;
        line-height: 1.7;
        max-width: 560px;
    }

    /* ─── CATEGORY MOSAIC ─── */
    .cat-mosaic {
        display: grid;
        grid-template-columns: 1.6fr 1fr 1fr;
        grid-template-rows: 380px 280px;
        gap: 18px;
        margin-top: 48px;
    }

    .cat-mosaic-card {
        position: relative;
        overflow: hidden;
        cursor: none;
        background: var(--cream);
    }

    .cat-mosaic-card:first-child {
        grid-row: 1 / 3;
    }

    .cat-mosaic-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .cat-mosaic-card:hover img {
        transform: scale(1.06);
    }

    .cat-mosaic-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(43, 31, 20, 0.8) 0%, rgba(43, 31, 20, 0.05) 55%, transparent 75%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 32px;
        transition: background 0.4s ease;
    }

    .cat-mosaic-card:hover .cat-mosaic-overlay {
        background: linear-gradient(to top, rgba(43, 31, 20, 0.9) 0%, rgba(43, 31, 20, 0.15) 60%, transparent 80%);
    }

    .cat-mosaic-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.6rem;
        font-weight: 400;
        color: white;
        margin-bottom: 6px;
        transform: translateY(0);
        transition: transform 0.3s ease;
    }

    .cat-mosaic-card:hover .cat-mosaic-name {
        transform: translateY(-4px);
    }

    .cat-mosaic-count {
        font-size: 0.72rem;
        color: var(--accent);
        letter-spacing: 0.12em;
        opacity: 0.8;
    }

    .cat-mosaic-arrow {
        position: absolute;
        bottom: 32px;
        right: 32px;
        width: 42px;
        height: 42px;
        border: 1px solid rgba(255, 255, 255, 0.35);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        transform: scale(0) rotate(-30deg);
        transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), background 0.3s ease, border-color 0.3s ease;
    }

    .cat-mosaic-card:hover .cat-mosaic-arrow {
        transform: scale(1) rotate(0);
    }

    .cat-mosaic-card:hover .cat-mosaic-arrow {
        background: var(--secondary);
        border-color: var(--secondary);
    }

    .cat-mosaic-arrow svg {
        width: 16px;
        height: 16px;
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 1024px) {
        .cat-mosaic {
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 300px 260px 260px;
        }

        .cat-mosaic-card:first-child {
            grid-row: 1 / 2;
            grid-column: 1 / 3;
        }
    }

    @media (max-width: 768px) {
        .cat-hero {
            padding: 120px 5% 80px;
            min-height: auto;
        }

        .cat-hero-title {
            font-size: clamp(2.4rem, 8vw, 3.4rem);
        }

        .cat-stats {
            grid-template-columns: repeat(3, 1fr);
            padding: 24px 16px;
            margin: -30px 5% 0;
            gap: 0;
        }

        .cat-stat-value {
            font-size: 1.6rem;
        }

        .cat-stat-label {
            font-size: 0.6rem;
        }

        .cat-section {
            padding: 60px 5%;
        }

        .cat-mosaic {
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 260px 220px 220px;
            gap: 12px;
            margin-top: 36px;
        }

        .cat-mosaic-card:first-child {
            grid-row: 1 / 2;
            grid-column: 1 / 3;
        }

        .cat-mosaic-overlay {
            padding: 24px;
        }

        .cat-mosaic-name {
            font-size: 1.2rem;
        }

        .cat-mosaic-arrow {
            bottom: 24px;
            right: 24px;
            width: 36px;
            height: 36px;
        }

        .cat-mosaic-arrow svg {
            width: 13px;
            height: 13px;
        }
    }

    @media (max-width: 480px) {
        .cat-stats {
            grid-template-columns: repeat(3, 1fr);
            padding: 20px 12px;
            gap: 0;
        }

        .cat-stat {
            padding: 0 8px;
        }

        .cat-stat-value {
            font-size: 1.3rem;
        }

        .cat-stat-label {
            font-size: 0.55rem;
        }

        .cat-mosaic {
            grid-template-columns: 1fr;
            grid-template-rows: repeat(5, 200px);
        }

        .cat-mosaic-card:first-child {
            grid-column: 1;
            grid-row: auto;
        }
    }

    /* ─── ANIMATIONS ─── */
    .cat-reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.7s ease, transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .cat-reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .cat-reveal-delay-1 {
        transition-delay: 0.1s;
    }

    .cat-reveal-delay-2 {
        transition-delay: 0.2s;
    }

    .cat-reveal-delay-3 {
        transition-delay: 0.3s;
    }

    .cat-reveal-delay-4 {
        transition-delay: 0.4s;
    }
</style>

<x-layout>
    <div class="categories-page">

        {{-- ─── CATEGORY MOSAIC ─── --}}
        <section class="cat-section" id="cat-mosaic-section">
            <div class="cat-section-label cat-reveal">Explore</div>
            <h2 class="cat-section-title cat-reveal cat-reveal-delay-1">Browse by <em>Category</em></h2>
            <p class="cat-section-sub cat-reveal cat-reveal-delay-2">Find exactly what you're looking for. Each category
                is thoughtfully curated with the finest selections.</p>

            <div class="cat-mosaic">
                @forelse ($categories as $category)
                    <a href="{{ route('products', ['category' => $category->slug]) }}"
                        class="cat-mosaic-card cat-reveal cat-reveal-delay-{{ min($loop->index + 1, 4) }}">
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" />
                        @else
                            <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=700&q=80&auto=format"
                                alt="{{ $category->name }}" />
                        @endif
                        <div class="cat-mosaic-overlay">
                            <div class="cat-mosaic-name">{{ $category->name }}</div>
                            <div class="cat-mosaic-count">{{ $category->products_count ?? 0 }} products</div>
                            <div class="cat-mosaic-arrow">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                </svg>
                            </div>
                        </div>
                    </a>
                @empty
                    <div style="grid-column:1/-1;text-align:center;padding:48px;color:#7a6858;">
                        No categories available yet.
                    </div>
                @endforelse
            </div>
        </section>
    </div>

    <script>
        // ── REVEAL ON SCROLL ──
        const catReveals = document.querySelectorAll('.cat-reveal');
        const catObs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1
        });
        catReveals.forEach(r => catObs.observe(r));

        // ── HERO ENTRANCE ──
        window.addEventListener('load', () => {
            const heroContent = document.querySelector('.cat-hero .cat-reveal');
            if (heroContent) {
                setTimeout(() => {
                    heroContent.classList.add('visible');
                }, 200);
            }
        });
    </script>
</x-layout>
