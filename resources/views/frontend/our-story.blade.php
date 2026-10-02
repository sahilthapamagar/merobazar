<x-layout>
    <style>
        .our-story-page {
            width: 100%;
            overflow-x: hidden;
        }

        /* ─── STORY HERO ─── */
        .story-hero {
            position: relative;
            height: 70vh;
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: linear-gradient(135deg, var(--dark) 0%, var(--primary) 100%);
            overflow: hidden;
        }

        .story-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.06'/%3E%3C/svg%3E");
            pointer-events: none;
        }

        .story-hero-content {
            position: relative;
            z-index: 2;
            padding: 0 5%;
        }

        .story-hero-label {
            font-size: 0.7rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 24px;
        }

        .story-hero-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.5rem, 6vw, 5rem);
            font-weight: 300;
            color: white;
            line-height: 1.15;
            margin-bottom: 24px;
        }

        .story-hero-title em {
            font-style: italic;
            color: var(--accent);
        }

        .story-hero-sub {
            font-size: 1rem;
            color: rgba(255,255,255,0.7);
            max-width: 540px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .story-hero-img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.2;
        }

        /* ─── BRAND STORY SECTION ─── */
        .os-section {
            padding: 100px 8%;
        }

        .os-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .os-img-stack {
            position: relative;
            height: 520px;
        }

        .os-img-main {
            width: 75%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            right: 0;
            top: 0;
        }

        .os-img-accent {
            width: 50%;
            height: 50%;
            object-fit: cover;
            position: absolute;
            left: 0;
            bottom: 40px;
            border: 6px solid var(--background);
            box-shadow: 0 20px 60px rgba(73,54,40,0.18);
        }

        .os-year-badge {
            position: absolute;
            top: 30px;
            left: 0;
            background: var(--secondary);
            padding: 20px 24px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(73,54,40,0.2);
        }

        .os-year {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 600;
            color: white;
            line-height: 1;
        }

        .os-year-label {
            font-size: 0.64rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.75);
            margin-top: 4px;
        }

        .os-section-label {
            font-size: 0.7rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--secondary);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .os-section-label::before {
            content: '';
            width: 24px;
            height: 1px;
            background: var(--secondary);
        }

        .os-section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            font-weight: 300;
            color: var(--primary);
            line-height: 1.2;
            margin-bottom: 24px;
        }

        .os-section-title em {
            font-style: italic;
        }

        .os-quote {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            font-style: italic;
            color: var(--secondary);
            line-height: 1.7;
            border-left: 2px solid var(--secondary);
            padding-left: 20px;
            margin-bottom: 28px;
        }

        .os-body {
            font-size: 0.86rem;
            line-height: 1.95;
            color: #6b5c4e;
            margin-bottom: 20px;
        }

        .os-signature {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-style: italic;
            color: var(--secondary);
            margin-top: 32px;
        }

        .os-sig-label {
            font-size: 0.7rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #9a8272;
        }

        /* ─── VALUES SECTION ─── */
        .os-values-section {
            background: var(--cream);
            padding: 100px 8%;
        }

        .os-values-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .os-values-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .os-value-card {
            background: white;
            padding: 40px 28px;
            text-align: center;
            border: 1px solid rgba(73,54,40,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .os-value-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(73,54,40,0.1);
        }

        .os-value-icon {
            width: 56px;
            height: 56px;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--primary);
        }

        .os-value-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            font-weight: 500;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .os-value-text {
            font-size: 0.82rem;
            line-height: 1.7;
            color: #6b5c4e;
        }

        /* ─── TIMELINE SECTION ─── */
        .os-timeline-section {
            padding: 100px 8%;
        }

        .os-timeline-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .os-timeline {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px 0;
        }

        .os-timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--accent);
        }

        .os-timeline-item {
            position: relative;
            width: 50%;
            padding: 20px 40px;
        }

        .os-timeline-item:nth-child(odd) {
            left: 0;
            text-align: right;
        }

        .os-timeline-item:nth-child(even) {
            left: 50%;
        }

        .os-timeline-dot {
            position: absolute;
            top: 28px;
            width: 14px;
            height: 14px;
            background: var(--secondary);
            border: 3px solid var(--background);
            border-radius: 50%;
        }

        .os-timeline-item:nth-child(odd) .os-timeline-dot {
            right: -7px;
        }

        .os-timeline-item:nth-child(even) .os-timeline-dot {
            left: -7px;
        }

        .os-timeline-year {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 6px;
        }

        .os-timeline-title {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--primary);
            margin-bottom: 6px;
        }

        .os-timeline-text {
            font-size: 0.78rem;
            line-height: 1.65;
            color: #6b5c4e;
        }

        /* ─── CTA SECTION ─── */
        .os-cta-section {
            background: var(--primary);
            padding: 80px 8%;
            text-align: center;
        }

        .os-cta-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.6rem, 3vw, 2.4rem);
            font-weight: 300;
            color: white;
            margin-bottom: 16px;
        }

        .os-cta-text {
            font-size: 0.86rem;
            color: rgba(255,255,255,0.7);
            margin-bottom: 32px;
        }

        .os-cta-btn {
            display: inline-block;
            padding: 14px 40px;
            background: var(--secondary);
            color: white;
            font-size: 0.78rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .os-cta-btn:hover {
            background: var(--accent);
            color: var(--primary);
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 968px) {
            .os-grid {
                grid-template-columns: 1fr;
                gap: 48px;
            }
            .os-img-stack {
                height: 380px;
            }
            .os-values-grid {
                grid-template-columns: 1fr 1fr;
            }
            .os-timeline::before {
                left: 20px;
            }
            .os-timeline-item {
                width: 100%;
                left: 0 !important;
                text-align: left !important;
                padding-left: 50px;
                padding-right: 20px;
            }
            .os-timeline-dot {
                left: 13px !important;
                right: auto !important;
            }
        }

        @media (max-width: 600px) {
            .os-section,
            .os-values-section,
            .os-timeline-section {
                padding: 60px 5%;
            }
            .os-img-stack {
                display: none;
            }
            .os-values-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <!-- ─── HERO ─── -->
    <section class="story-hero">
        <img class="story-hero-img" src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1400&q=80&auto=format" alt="Our Story" />
        <div class="story-hero-content">
            <div class="story-hero-label">Nepal's Multi-Vendor Marketplace</div>
            <h1 class="story-hero-title">Connecting<br>Buyers & <em>Sellers</em></h1>
            <p class="story-hero-sub">A marketplace built for everyone — from local shops to customers across Nepal.</p>
        </div>
    </section>

    <!-- ─── BRAND STORY ─── -->
    <section class="os-section">
        <div class="os-grid">
            <div class="os-img-stack">
                <img class="os-img-main" src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=700&q=80&auto=format" alt="Marketplace" />
                <img class="os-img-accent" src="https://images.unsplash.com/photo-1556742111-a301076d9d18?w=500&q=80&auto=format" alt="Shopping" />
                <div class="os-year-badge">
                    <div class="os-year">2024</div>
                    <div class="os-year-label">Launched</div>
                </div>
            </div>
            <div>
                <div class="os-section-label">The Beginning</div>
                <h2 class="os-section-title">One Platform,<br>Every <em>Category</em></h2>
                <p class="os-quote">"We believe everyone deserves access to quality products from trusted local sellers."</p>
                <p class="os-body">MeroBazar was created to bring Nepal's best sellers and buyers together in one place. What started as a simple idea — making it easy for anyone to shop or sell online — quickly grew into a thriving multi-vendor marketplace.</p>
                <p class="os-body">Today, thousands of sellers list their products across electronics, fashion, food, home goods, cosmetics, toys, musical instruments, and more. Our mission is simple: connect buyers with sellers they can trust, and empower businesses of every size to grow.</p>
                <div class="os-signature">The MeroBazar Team</div>
                <div class="os-sig-label">Founded in Kathmandu, Nepal</div>
            </div>
        </div>
    </section>

    <!-- ─── VALUES ─── -->
    <section class="os-values-section">
        <div class="os-values-header">
            <div class="os-section-label" style="justify-content:center;">What We Stand For</div>
            <h2 class="os-section-title" style="text-align:center;">Our Core <em>Values</em></h2>
        </div>
        <div class="os-values-grid">
            <div class="os-value-card">
                <div class="os-value-icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>
                <div class="os-value-title">Trusted Sellers</div>
                <div class="os-value-text">Every seller is verified. We ensure quality and reliability across all categories.</div>
            </div>
            <div class="os-value-card">
                <div class="os-value-icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/><path d="M9 12l2 2 4-4"/></svg>
                </div>
                <div class="os-value-title">Secure Payments</div>
                <div class="os-value-text">Safe checkout with Khalti and Cash on Delivery options available.</div>
            </div>
            <div class="os-value-card">
                <div class="os-value-icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                </div>
                <div class="os-value-title">Fast Delivery</div>
                <div class="os-value-text">Quick shipping from sellers near you, across all of Nepal.</div>
            </div>
            <div class="os-value-card">
                <div class="os-value-icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                </div>
                <div class="os-value-title">Support Local</div>
                <div class="os-value-text">Helping Nepali businesses of all sizes reach more customers every day.</div>
            </div>
        </div>
    </section>

    <!-- ─── TIMELINE ─── -->
    <section class="os-timeline-section">
        <div class="os-timeline-header">
            <div class="os-section-label" style="justify-content:center;">Milestones</div>
            <h2 class="os-section-title" style="text-align:center;">Our <em>Journey</em></h2>
        </div>
        <div class="os-timeline">
            <div class="os-timeline-item">
                <div class="os-timeline-dot"></div>
                <div class="os-timeline-year">2024</div>
                <div class="os-timeline-title">The Idea</div>
                <div class="os-timeline-text">MeroBazar was conceived to create Nepal's first true multi-vendor marketplace.</div>
            </div>
            <div class="os-timeline-item">
                <div class="os-timeline-dot"></div>
                <div class="os-timeline-year">2024</div>
                <div class="os-timeline-title">Platform Launch</div>
                <div class="os-timeline-text">Launched with our first sellers across electronics, fashion, and home goods categories.</div>
            </div>
            <div class="os-timeline-item">
                <div class="os-timeline-dot"></div>
                <div class="os-timeline-year">2025</div>
                <div class="os-timeline-title">Growing Categories</div>
                <div class="os-timeline-text">Expanded to include food, cosmetics, kitchen items, toys, musical instruments, and more.</div>
            </div>
            <div class="os-timeline-item">
                <div class="os-timeline-dot"></div>
                <div class="os-timeline-year">2025</div>
                <div class="os-timeline-title">Khalti Integration</div>
                <div class="os-text">Added secure online payments with Khalti alongside Cash on Delivery.</div>
            </div>
            <div class="os-timeline-item">
                <div class="os-timeline-dot"></div>
                <div class="os-timeline-year">2026</div>
                <div class="os-timeline-title">Community Growing</div>
                <div class="os-timeline-text">Hundreds of sellers and thousands of happy customers across Nepal.</div>
            </div>
        </div>
    </section>

    <!-- ─── CTA ─── -->
    <section class="os-cta-section">
        <h2 class="os-cta-title">Become Part of Our Story</h2>
        <p class="os-cta-text">Shop from thousands of products or start selling on MeroBazar today.</p>
        <a href="{{ route('products') }}" class="os-cta-btn">Shop Now</a>
    </section>
</x-layout>
