<style>
    nav {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        padding: 0 5%;
        height: 72px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.4s ease;
    }

    nav.scrolled {
        background: rgba(228, 224, 225, 0.92);
        backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(171, 136, 109, 0.2);
        height: 60px;
    }

    .nav-logo {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.6rem;
        font-weight: 600;
        letter-spacing: 0.3em;
        color: var(--primary);
        text-transform: uppercase;
    }

    .nav-links a {
        font-size: 0.78rem;
        font-weight: 500;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--primary);
        text-decoration: none;
        position: relative;
        padding-bottom: 3px;
    }

    .nav-links a::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 1px;
        background: var(--secondary);
        transition: width 0.3s ease;
    }

    .nav-links a:hover::after {
        width: 100%;
    }

    .nav-icon {
        cursor: none;
        position: relative;
    }

    .cart-badge {
        position: absolute;
        top: -6px;
        right: -8px;
        width: 16px;
        height: 16px;
        background: var(--secondary);
        border-radius: 50%;
        font-size: 0.6rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
    }

    .mobile-menu-btn {
        display: none;
        cursor: none;
    }

    /* ─── ANNOUNCEMENT BAR ─── */
    .announcement {
        background: var(--primary);
        color: var(--accent);
        text-align: center;
        padding: 8px;
        font-size: 0.72rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        overflow: hidden;
    }

    .ticker-wrap {
        display: flex;
        gap: 80px;
        animation: ticker 24s linear infinite;
        white-space: nowrap;
    }

    @keyframes ticker {
        from {
            transform: translateX(0);
        }

        to {
            transform: translateX(-50%);
        }
    }
</style>


<section>
    <!-- ─── NAVBAR ─── -->
    <nav id="navbar">
        <a href="#" class="nav-logo">Big Bazar</a>

        <div class="nav-links flex gap-8">
            <a href="#">New In</a>
            <a href="#">Women</a>
            <a href="#">Men</a>
            <a href="#">Home</a>
            <a href="#">Collections</a>
            <a href="#">Sale</a>
        </div>

        <div class="nav-actions flex items-center gap-5">
            <!-- Search -->
            <button class="nav-icon search-wrap" onclick="toggleSearch()" aria-label="Search">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"
                    viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7" />
                    <path d="M16.5 16.5L22 22" />
                </svg>
            </button>
            <!-- Account -->
            <button class="nav-icon" aria-label="Account">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"
                    viewBox="0 0 24 24">
                    <circle cx="12" cy="7" r="4" />
                    <path d="M20 21a8 8 0 10-16 0" />
                </svg>
            </button>
            <!-- Cart -->
            <button class="nav-icon cart-wrap relative" onclick="openModal()" aria-label="Cart">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"
                    viewBox="0 0 24 24">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <path d="M16 10a4 4 0 01-8 0" />
                </svg>
                <span class="cart-badge">3</span>
            </button>
            <!-- Hamburger -->
            <button class="mobile-menu-btn nav-icon items-center" onclick="toggleMobileMenu()" aria-label="Menu">
                <svg id="menuIcon" width="22" height="22" fill="none" stroke="currentColor"
                    stroke-width="1.8" viewBox="0 0 24 24">
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <line x1="3" y1="12" x2="21" y2="12" />
                    <line x1="3" y1="18" x2="21" y2="18" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- ─── MOBILE MENU ─── -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="#" onclick="toggleMobileMenu()">New In</a>
        <a href="#" onclick="toggleMobileMenu()">Women</a>
        <a href="#" onclick="toggleMobileMenu()">Men</a>
        <a href="#" onclick="toggleMobileMenu()">Home & Living</a>
        <a href="#" onclick="toggleMobileMenu()">Collections</a>
        <a href="#" onclick="toggleMobileMenu()">Sale</a>
    </div>

    <!-- ─── SEARCH BAR ─── -->
    <div id="searchBar"
        style="position:fixed;top:0;left:0;right:0;z-index:1100;background:var(--cream);padding:0 8%;height:72px;display:none;align-items:center;gap:16px;border-bottom:1px solid rgba(171,136,109,0.2);animation:slideDown 0.3s ease">
        <svg width="18" height="18" fill="none" stroke="var(--secondary)" stroke-width="1.6"
            viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7" />
            <path d="M16.5 16.5L22 22" />
        </svg>
        <input type="text" placeholder="Search for products, brands..."
            style="flex:1;border:none;background:none;font-family:'DM Sans',sans-serif;font-size:0.95rem;color:var(--primary);outline:none;"
            autofocus id="searchInput">
        <button onclick="toggleSearch()"
            style="cursor:none;border:none;background:none;font-size:0.8rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--secondary);">Close</button>
    </div>
    <style>
        @keyframes slideDown {
            from {
                transform: translateY(-100%);
            }

            to {
                transform: translateY(0);
            }
        }
    </style>

    <!-- ─── ANNOUNCEMENT BAR ─── -->
    <div class="announcement" style="margin-top:72px">
        <div class="ticker-wrap">
            <span>✦ Free shipping on orders over $150</span>
            <span>✦ New Summer Collection — Shop Now</span>
            <span>✦ Members earn 2× points this week</span>
            <span>✦ Crafted with care. Delivered with love.</span>
            <span>✦ Free shipping on orders over $150</span>
            <span>✦ New Summer Collection — Shop Now</span>
            <span>✦ Members earn 2× points this week</span>
            <span>✦ Crafted with care. Delivered with love.</span>
        </div>
    </div>
</section>
