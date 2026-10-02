<style>
    /* ─── HEADER CONTAINER & ANNOUNCEMENT BAR ─── */
    .header-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        transition: transform 0.35s ease;
    }

    .announcement-bar {
        background: var(--primary);
        color: var(--accent);
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 5%;
        font-size: 0.7rem;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        overflow: hidden;
    }

    .announcement-ticker {
        display: flex;
        align-items: center;
        gap: 24px;
        white-space: nowrap;
        animation: announcementScroll 28s linear infinite;
    }

    .announcement-ticker span {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #f5f0eb;
    }

    .announcement-ticker .dot {
        color: var(--secondary);
    }

    .announcement-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--accent);
        text-decoration: none;
        font-size: 0.68rem;
        font-weight: 500;
        letter-spacing: 0.12em;
        transition: color 0.25s ease;
        flex-shrink: 0;
        margin-left: 16px;
    }

    .announcement-link:hover {
        color: #ffffff;
    }

    @keyframes announcementScroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* ─── MAIN NAVBAR ─── */
    #navbar {
        height: 72px;
        padding: 0 5%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: rgba(245, 240, 235, 0.94);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(171, 136, 109, 0.22);
        box-shadow: 0 4px 25px rgba(73, 54, 40, 0.04);
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    #navbar.scrolled {
        height: 62px;
        background: rgba(245, 240, 235, 0.98);
        box-shadow: 0 8px 30px rgba(73, 54, 40, 0.08);
        border-bottom-color: rgba(171, 136, 109, 0.3);
    }

    /* ─── BRAND LOGO ─── */
    .nav-brand {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        flex-shrink: 0;
        cursor: pointer;
    }

    .nav-logo-icon {
        width: 44px;
        height: 44px;
        object-fit: contain;
        border-radius: 4px;
        transition: transform 0.3s ease;
    }

    .nav-brand:hover .nav-logo-icon {
        transform: rotate(-6deg) scale(1.05);
    }

    .nav-logo-text {
        display: flex;
        flex-direction: column;
    }

    .nav-logo-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 0.02em;
        color: var(--primary);
        line-height: 1;
    }

    .logo-mero {
        color: #1a2538;
    }

    .logo-bazar {
        color: #f47920;
    }

    /* ─── NAVIGATION LINKS ─── */
    .nav-links {
        display: flex;
        align-items: center;
        gap: 2.2rem;
    }

    .nav-link {
        font-size: 0.78rem;
        font-weight: 500;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #5c4738;
        text-decoration: none;
        position: relative;
        padding: 6px 0;
        transition: color 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: var(--primary);
        border-radius: 2px;
        transition: width 0.3s cubic-bezier(0.16, 1, 0.3, 1), left 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .nav-link:hover,
    .nav-link.active {
        color: var(--primary);
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
        left: 0;
    }

    .nav-badge-pill {
        font-size: 0.6rem;
        font-weight: 700;
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
        padding: 1px 6px;
        border-radius: 999px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    /* ─── ACTION BUTTONS ─── */
    .nav-actions {
        display: flex;
        align-items: center;
        gap: 1.1rem;
    }

    .nav-btn-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1px solid rgba(171, 136, 109, 0.25);
        background: rgba(255, 255, 255, 0.75);
        color: var(--primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        position: relative;
        transition: all 0.25s ease;
        text-decoration: none;
    }

    .nav-btn-icon:hover {
        background: var(--primary);
        color: var(--accent);
        border-color: var(--primary);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(73, 54, 40, 0.15);
    }

    .cart-counter-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        min-width: 19px;
        height: 19px;
        padding: 0 4px;
        background: linear-gradient(135deg, #b91c1c 0%, #dc2626 100%);
        color: #ffffff;
        border-radius: 999px;
        font-size: 0.64rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #ffffff;
        box-shadow: 0 2px 8px rgba(220, 38, 38, 0.35);
    }

    /* ─── USER PILL / LOGIN ─── */
    .nav-signin-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 18px;
        border-radius: 999px;
        background: var(--primary);
        color: var(--accent);
        font-size: 0.74rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(73, 54, 40, 0.18);
    }

    .nav-signin-btn:hover {
        background: var(--secondary);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(73, 54, 40, 0.24);
    }

    .account-dropdown {
        position: relative;
    }

    .account-trigger-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 4px 12px 4px 4px;
        border-radius: 999px;
        border: 1px solid rgba(171, 136, 109, 0.3);
        background: rgba(255, 255, 255, 0.85);
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .account-trigger-btn:hover {
        border-color: var(--primary);
        background: #ffffff;
        box-shadow: 0 4px 14px rgba(73, 54, 40, 0.1);
    }

    .account-avatar-circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .account-user-name {
        font-size: 0.76rem;
        font-weight: 600;
        color: var(--primary);
        max-width: 90px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* ─── ACCOUNT DROPDOWN MENU ─── */
    .account-menu {
        position: absolute;
        top: calc(100% + 14px);
        right: 0;
        min-width: 240px;
        background: #ffffff;
        border: 1px solid rgba(171, 136, 109, 0.28);
        border-radius: 12px;
        box-shadow: 0 16px 48px rgba(73, 54, 40, 0.14);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px) scale(0.96);
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: 1101;
        overflow: hidden;
        pointer-events: none;
    }

    .account-dropdown.is-open .account-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0) scale(1);
        pointer-events: auto;
    }

    .account-menu-header {
        padding: 16px 18px;
        background: linear-gradient(180deg, #F5F0EB 0%, #ffffff 100%);
        border-bottom: 1px solid rgba(171, 136, 109, 0.18);
    }

    .account-menu-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--primary);
        line-height: 1.2;
    }

    .account-menu-email {
        font-size: 0.72rem;
        color: #7a6858;
        margin-top: 2px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .account-menu-body {
        padding: 8px 0;
    }

    .account-menu-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 11px 18px;
        font-size: 0.76rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--primary);
        text-decoration: none;
        transition: all 0.2s ease;
        background: transparent;
        border: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
    }

    .account-menu-item:hover {
        background: rgba(171, 136, 109, 0.12);
        color: var(--secondary);
        padding-left: 22px;
    }

    .account-menu-item--logout {
        color: #b91c1c;
        border-top: 1px solid rgba(171, 136, 109, 0.14);
        margin-top: 4px;
        padding-top: 12px;
    }

    .account-menu-item--logout:hover {
        background: #fef2f2;
        color: #991b1b;
    }

    /* ─── SEARCH DRAWER OVERLAY ─── */
    #searchBarOverlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1200;
        background: rgba(245, 240, 235, 0.98);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border-bottom: 1px solid rgba(171, 136, 109, 0.3);
        box-shadow: 0 16px 40px rgba(73, 54, 40, 0.12);
        padding: 24px 5% 28px;
        transform: translateY(-100%);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    #searchBarOverlay.is-open {
        transform: translateY(0);
    }

    .search-input-wrap {
        display: flex;
        align-items: center;
        gap: 14px;
        background: #ffffff;
        border: 1.5px solid rgba(171, 136, 109, 0.35);
        border-radius: 999px;
        padding: 12px 24px;
        box-shadow: 0 4px 16px rgba(73, 54, 40, 0.06);
    }

    .search-input-wrap input {
        flex: 1;
        border: none;
        background: none;
        font-family: 'DM Sans', sans-serif;
        font-size: 1rem;
        color: var(--primary);
        outline: none;
    }

    .search-input-wrap input::placeholder {
        color: #a18a7a;
    }

    .search-quick-tags {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        font-size: 0.74rem;
        color: #7a6858;
    }

    .search-tag-pill {
        background: rgba(171, 136, 109, 0.14);
        color: var(--primary);
        padding: 4px 12px;
        border-radius: 999px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .search-tag-pill:hover {
        background: var(--primary);
        color: var(--accent);
    }

    .search-close-trigger {
        background: none;
        border: none;
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--secondary);
        cursor: pointer;
        padding: 4px 8px;
    }

    .search-close-trigger:hover {
        color: var(--primary);
    }

    /* ─── MOBILE DRAWER MENU ─── */
    .mobile-menu-drawer {
        position: fixed;
        inset: 0;
        background: rgba(43, 31, 20, 0.45);
        backdrop-filter: blur(6px);
        z-index: 1300;
        opacity: 0;
        visibility: hidden;
        transition: all 0.35s ease;
    }

    .mobile-menu-drawer.open {
        opacity: 1;
        visibility: visible;
    }

    .mobile-menu-panel {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        width: 85%;
        max-width: 380px;
        background: #F5F0EB;
        display: flex;
        flex-direction: column;
        padding: 24px 28px 36px;
        transform: translateX(100%);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        overflow-y: auto;
    }

    .mobile-menu-drawer.open .mobile-menu-panel {
        transform: translateX(0);
    }

    .mobile-menu-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid rgba(171, 136, 109, 0.2);
    }

    .mobile-menu-links {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 24px;
    }

    .mobile-nav-link {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.85rem;
        font-weight: 400;
        color: var(--primary);
        text-decoration: none;
        padding: 10px 0;
        border-bottom: 1px solid rgba(171, 136, 109, 0.12);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.25s ease;
    }

    .mobile-nav-link:hover {
        color: var(--secondary);
        padding-left: 8px;
    }

    .mobile-menu-btn {
        display: none;
    }

    /* ─── RESPONSIVE BREAKPOINTS ─── */
    @media (max-width: 1024px) {
        .nav-links {
            gap: 1.4rem;
        }
        .nav-link {
            font-size: 0.74rem;
        }
    }

    @media (max-width: 860px) {
        .announcement-bar {
            padding: 0 4%;
            font-size: 0.64rem;
        }
        .announcement-link {
            display: none;
        }

        #navbar {
            padding: 0 4%;
            height: 64px;
        }
        #navbar.scrolled {
            height: 58px;
        }

        .nav-links {
            display: none;
        }

        .mobile-menu-btn {
            display: inline-flex;
        }

        .account-user-name {
            display: none;
        }
        .account-trigger-btn {
            padding: 4px;
        }
    }
</style>

<header class="header-wrapper" id="headerWrapper">
    <!-- ─── TOP ANNOUNCEMENT TICKER ─── -->
    <div class="announcement-bar">
        <div class="announcement-ticker">
            <span>✦ Free Delivery on Orders Over Rs. 2,500</span>
            <span class="dot">•</span>
            <span>⚡ 100% Authentic Handcrafted Pieces</span>
            <span class="dot">•</span>
            <span>✦ Verified Local Artisans & Merchants Across Nepal</span>
            <span class="dot">•</span>
            <span>✨ New Seasonal Fresh Drops Daily</span>
            <span class="dot">•</span>
            <span>✦ Free Delivery on Orders Over Rs. 2,500</span>
            <span class="dot">•</span>
            <span>⚡ 100% Authentic Handcrafted Pieces</span>
        </div>

        <a href="{{ route('seller.index') }}" class="announcement-link">
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <span>Become a Seller</span>
        </a>
    </div>

    <!-- ─── MAIN NAVIGATION BAR ─── -->
    <nav id="navbar">
        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="nav-brand" aria-label="MeroBazar Home">
            <img src="/images/logo.png" class="nav-logo-icon" alt="MeroBazar icon">
            <span class="nav-logo-title"><span class="logo-mero">Mero</span><span class="logo-bazar">Bazar</span></span>
        </a>

        <!-- Central Nav Links -->
        <div class="nav-links">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                Home
            </a>
            <a href="{{ route('categories') }}" class="nav-link {{ request()->routeIs('categories*') ? 'active' : '' }}">
                Categories
            </a>
            <a href="{{ route('products') }}" class="nav-link {{ request()->routeIs('products*') ? 'active' : '' }}">
                Shop All
            </a>
            <a href="{{ route('seller.index') }}" class="nav-link {{ request()->routeIs('seller*') ? 'active' : '' }}">
                <span>Sell With Us</span>
                <span class="nav-badge-pill">Join</span>
            </a>
        </div>

        <!-- Right Actions Area -->
        <div class="nav-actions">
            <!-- Search Trigger -->
            <button type="button" class="nav-btn-icon" onclick="toggleSearchOverlay()" aria-label="Search items" title="Search items">
                <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>

            <!-- User Account / Sign In -->
            @if ($user = Auth::guard('web')->user())
                <div class="account-dropdown" id="accountDropdown">
                    <button type="button" class="account-trigger-btn" id="accountMenuBtn" aria-label="Account menu" aria-expanded="false" onclick="toggleAccountMenu(event)">
                        <div class="account-avatar-circle">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <span class="account-user-name">{{ $user->name }}</span>
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color:var(--secondary)">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>

                    <div class="account-menu" id="accountMenu" role="menu">
                        <div class="account-menu-header">
                            <div class="account-menu-name">{{ $user->name }}</div>
                            <div class="account-menu-email">{{ $user->email }}</div>
                        </div>
                        <div class="account-menu-body">
                            <a href="{{ route('dashboard') }}" class="account-menu-item" role="menuitem">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('buying-history') }}" class="account-menu-item" role="menuitem">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                </svg>
                                <span>Buying History</span>
                            </a>
                            <a href="{{ route('cart.index') }}" class="account-menu-item" role="menuitem">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                                <span>My Cart</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" role="none">
                                @csrf
                                <button type="submit" class="account-menu-item account-menu-item--logout" role="menuitem">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span>Sign Out</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="nav-signin-btn">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span>Sign In</span>
                </a>
            @endif

            <!-- Cart Trigger -->
            @php
                $cartCount = Auth::guard('web')->check() ? Auth::guard('web')->user()->carts()->count() : 0;
            @endphp
            <a href="{{ $cartCount > 0 ? route('cart.index') : route('products') }}" class="nav-btn-icon" aria-label="Shopping Cart" title="View Cart">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 01-8 0"></path>
                </svg>
                @if ($cartCount > 0)
                    <span class="cart-counter-badge">{{ $cartCount }}</span>
                @endif
            </a>

            <!-- Mobile Menu Toggle Button -->
            <button type="button" class="nav-btn-icon mobile-menu-btn" onclick="toggleMobileDrawer()" aria-label="Open Mobile Menu">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>
    </nav>
</header>

<!-- ─── INTERACTIVE SEARCH OVERLAY ─── -->
<div id="searchBarOverlay">
    <form action="{{ route('products') }}" method="GET" class="search-input-wrap">
        <svg width="20" height="20" fill="none" stroke="var(--secondary)" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" name="search" placeholder="Search curated dresses, artisan crafts, jewelry, footwear..." id="searchInputMain" autocomplete="off" />
        <button type="button" class="search-close-trigger" onclick="toggleSearchOverlay()">Esc / Close</button>
    </form>

    <div class="search-quick-tags">
        <span style="font-weight:600;text-transform:uppercase;letter-spacing:0.08em;font-size:0.68rem;">Popular Categories:</span>
        <a href="{{ route('products', ['category' => 'mens-wear']) }}" class="search-tag-pill">Men's Wear</a>
        <a href="{{ route('products', ['category' => 'womens-wear']) }}" class="search-tag-pill">Women's Wear</a>
        <a href="{{ route('products', ['category' => 'shoes']) }}" class="search-tag-pill">Shoes</a>
        <a href="{{ route('products', ['category' => 'accessories']) }}" class="search-tag-pill">Accessories</a>
        <a href="{{ route('products', ['category' => 'health-beauty']) }}" class="search-tag-pill">Health & Beauty</a>
    </div>
</div>

<!-- ─── MOBILE DRAWER MENU ─── -->
<div class="mobile-menu-drawer" id="mobileDrawer" onclick="handleDrawerBackdrop(event)">
    <div class="mobile-menu-panel">
        <div class="mobile-menu-header">
            <div class="nav-brand">
                <img src="/images/logo.png" class="nav-logo-icon" alt="MeroBazar icon" style="width:34px;height:34px">
                <span class="nav-logo-title" style="font-size:1.35rem"><span class="logo-mero">Mero</span><span class="logo-bazar">Bazar</span></span>
            </div>
            <button type="button" class="nav-btn-icon" onclick="toggleMobileDrawer()" aria-label="Close Menu">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <div class="mobile-menu-links">
            <a href="{{ route('home') }}" class="mobile-nav-link" onclick="toggleMobileDrawer()">
                <span>Home</span>
                <span style="font-size:0.9rem;color:var(--secondary)">01</span>
            </a>
            <a href="{{ route('categories') }}" class="mobile-nav-link" onclick="toggleMobileDrawer()">
                <span>Categories</span>
                <span style="font-size:0.9rem;color:var(--secondary)">02</span>
            </a>
            <a href="{{ route('products') }}" class="mobile-nav-link" onclick="toggleMobileDrawer()">
                <span>Shop All</span>
                <span style="font-size:0.9rem;color:var(--secondary)">03</span>
            </a>
            <a href="{{ route('seller.index') }}" class="mobile-nav-link" onclick="toggleMobileDrawer()">
                <span>Sell With Us</span>
                <span class="nav-badge-pill">Join</span>
            </a>
            <a href="{{ route('cart.index') }}" class="mobile-nav-link" onclick="toggleMobileDrawer()">
                <span>My Cart</span>
                <span style="font-size:0.9rem;color:var(--secondary)">({{ $cartCount }})</span>
            </a>
        </div>

        <div style="margin-top:auto;padding-top:20px;border-top:1px solid rgba(171, 136, 109, 0.2);">
            @if ($user = Auth::guard('web')->user())
                <div style="margin-bottom:14px;">
                    <div style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;font-weight:600;color:var(--primary);">{{ $user->name }}</div>
                    <div style="font-size:0.72rem;color:#7a6858;">{{ $user->email }}</div>
                </div>
                <div style="display:flex;flex-direction:column;gap:8px;">
                    <a href="{{ route('buying-history') }}" class="btn-primary" style="padding:10px 18px;font-size:0.72rem;text-align:center;">
                        <span>Buying History</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="width:100%;padding:10px;background:none;border:1px solid #b91c1c;color:#b91c1c;border-radius:4px;font-size:0.72rem;font-weight:600;text-transform:uppercase;cursor:pointer;">
                            Sign Out
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-primary" style="display:block;text-align:center;padding:12px;">
                    <span>Sign In to Account</span>
                </a>
            @endif
        </div>
    </div>
</div>

<script>
    (function initModernNavbar() {
        if (window.__modernNavbarInitialized) return;
        window.__modernNavbarInitialized = true;

        const navbar = document.getElementById('navbar');
        const searchOverlay = document.getElementById('searchBarOverlay');
        const searchInput = document.getElementById('searchInputMain');
        const accountDropdown = document.getElementById('accountDropdown');
        const mobileDrawer = document.getElementById('mobileDrawer');

        // Scroll glassmorphism trigger
        window.addEventListener('scroll', () => {
            if (navbar) {
                navbar.classList.toggle('scrolled', window.scrollY > 40);
            }
        }, { passive: true });

        // Search Overlay toggle
        window.toggleSearchOverlay = function() {
            if (!searchOverlay) return;
            const isOpen = searchOverlay.classList.toggle('is-open');
            if (isOpen && searchInput) {
                setTimeout(() => searchInput.focus(), 150);
            }
        };

        // Account Dropdown toggle
        window.toggleAccountMenu = function(e) {
            if (e) e.stopPropagation();
            if (!accountDropdown) return;
            const isOpen = accountDropdown.classList.toggle('is-open');
            const btn = document.getElementById('accountMenuBtn');
            if (btn) btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        };

        // Mobile Drawer toggle
        window.toggleMobileDrawer = function() {
            if (!mobileDrawer) return;
            const isOpen = mobileDrawer.classList.toggle('open');
            document.body.style.overflow = isOpen ? 'hidden' : '';
        };

        window.handleDrawerBackdrop = function(e) {
            if (e.target === mobileDrawer) {
                toggleMobileDrawer();
            }
        };

        // Close popups on escape key or outside click
        document.addEventListener('click', (e) => {
            if (accountDropdown && !accountDropdown.contains(e.target)) {
                accountDropdown.classList.remove('is-open');
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                if (searchOverlay && searchOverlay.classList.contains('is-open')) {
                    searchOverlay.classList.remove('is-open');
                }
                if (accountDropdown) {
                    accountDropdown.classList.remove('is-open');
                }
                if (mobileDrawer && mobileDrawer.classList.contains('open')) {
                    toggleMobileDrawer();
                }
            }
        });
    })();
</script>f (window.innerWidth > 768) {
                window.closeAccountMenu();
            }
        });
    })();
</script>
