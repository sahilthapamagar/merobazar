<style>
    /* ─── FOOTER ─── */
    footer {
        background: var(--dark);
        padding: 72px 8% 32px;
        color: var(--accent);
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1.8fr 1fr 1fr 1fr;
        gap: 48px;
        margin-bottom: 56px;
    }

    .footer-brand-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        font-weight: 600;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 16px;
    }

    .footer-desc {
        font-size: 0.8rem;
        line-height: 1.85;
        color: rgba(214, 192, 179, 0.5);
        max-width: 280px;
        margin-bottom: 28px;
    }

    .social-links {
        display: flex;
        gap: 12px;
    }

    .social-link {
        width: 36px;
        height: 36px;
        border: 1px solid rgba(171, 136, 109, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        transition: all 0.3s;
        text-decoration: none;
    }

    .social-link:hover {
        background: var(--secondary);
        border-color: var(--secondary);
    }

    .social-link svg {
        width: 15px;
        height: 15px;
    }

    .footer-col-title {
        font-size: 0.7rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        font-weight: 500;
        color: var(--accent);
        margin-bottom: 22px;
    }

    .footer-links {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .footer-links a {
        font-size: 0.8rem;
        color: rgba(214, 192, 179, 0.5);
        text-decoration: none;
        transition: color 0.3s, padding-left 0.3s;
        display: block;
    }

    .footer-links a:hover {
        color: var(--accent);
        padding-left: 6px;
    }

    .footer-bottom {
        border-top: 1px solid rgba(171, 136, 109, 0.12);
        padding-top: 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .footer-copyright {
        font-size: 0.73rem;
        color: rgba(214, 192, 179, 0.35);
        letter-spacing: 0.06em;
    }

    .footer-legal {
        display: flex;
        gap: 20px;
    }

    .footer-legal a {
        font-size: 0.73rem;
        color: rgba(214, 192, 179, 0.35);
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer-legal a:hover {
        color: var(--accent);
    }

    /* ─── REVEAL ANIMATIONS ─── */
    .reveal {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.7s ease, transform 0.7s ease;
    }

    .reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .reveal-delay-1 {
        transition-delay: 0.1s;
    }

    .reveal-delay-2 {
        transition-delay: 0.2s;
    }

    .reveal-delay-3 {
        transition-delay: 0.3s;
    }

    .reveal-delay-4 {
        transition-delay: 0.4s;
    }

    @media (max-width: 768px) {
        footer {
            padding: 48px 5% 24px;
        }

        .footer-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .footer-brand-name,
        .footer-desc,
        .footer-col-title,
        .footer-links {
            text-align: center;
        }

        .footer-desc {
            max-width: none;
            margin-left: auto;
            margin-right: auto;
        }

        .social-links {
            justify-content: center;
        }

        .footer-links {
            align-items: center;
        }

        .footer-bottom {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .footer-legal {
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.75rem 1.25rem;
        }
    }
</style>
<!-- ─── FOOTER ─── -->
<footer>
    <div class="footer-grid">
        <div>
            <div class="footer-brand-name">MeroBazar</div>
            <p class="footer-desc">Curated fashion and lifestyle for those who seek beauty in the details.
                From
                our
                atelier to your door.</p>
            <div class="social-links">
                <!-- Instagram -->
                <a href="#" class="social-link" aria-label="Instagram">
                    <svg fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                        <rect x="2" y="2" width="20" height="20" rx="5" />
                        <circle cx="12" cy="12" r="5" />
                        <circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" />
                    </svg>
                </a>
                <!-- Pinterest -->
                <a href="#" class="social-link" aria-label="Pinterest">
                    <svg fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M8 12c0-2.2 1.8-4 4-4s4 1.8 4 4c0 2.5-2 4-4 4l-1 4" />
                    </svg>
                </a>
                <!-- Twitter / X -->
                <a href="#" class="social-link" aria-label="Twitter">
                    <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                        <path
                            d="M23 3a10.9 10.9 0 01-3.14 1.53A4.48 4.48 0 0012 7.5v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" />
                    </svg>
                </a>
                <!-- TikTok -->
                <a href="#" class="social-link" aria-label="TikTok">
                    <svg fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.29 6.29 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.72a8.27 8.27 0 004.83 1.55V6.79a4.85 4.85 0 01-1.06-.1z" />
                    </svg>
                </a>
            </div>
        </div>

        <div>
            <div class="footer-col-title">Category</div>
            <ul class="footer-links">
                @foreach ($categories as $category)
                    <li><a href="{{ route('products', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <div class="footer-col-title">Company</div>
            <ul class="footer-links">
                <li><a href="{{ route('our-story') }}">Our Story</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="{{ route('seller.index') }}">Become a Vendor</a></li>

            </ul>
        </div>

        <div>
            <div class="footer-col-title">Customer Service</div>
            <ul class="footer-links">
                <li><a href="{{ route('faq') }}">FAQ</a></li>
                <li><a href="#">Shipping & Returns</a></li>
                <li><a href="#">Track Order</a></li>
                <li><a href="#">Sell on MeroBazar</a></li>
                <li><a href="#">Gift Cards</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p class="footer-copyright">© 2026 MeroBazar. All rights reserved.</p>
        <div class="footer-legal">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Cookie Preferences</a>
        </div>
    </div>
</footer>
