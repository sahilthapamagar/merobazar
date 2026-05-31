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
        text-decoration: none;
        position: relative;
        z-index: 1001;
        flex-shrink: 0;
        cursor: none;
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 2rem;
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
        cursor: none;
        white-space: nowrap;
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

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 1.25rem;
    }

    .nav-icon {
        cursor: none;
        position: relative;
        border: none;
        background: none;
        color: var(--primary);
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .account-dropdown {
        position: relative;
    }

    .account-menu {
        position: absolute;
        top: calc(100% + 12px);
        right: 0;
        min-width: 220px;
        background: var(--cream);
        border: 1px solid rgba(171, 136, 109, 0.28);
        box-shadow: 0 12px 40px rgba(43, 31, 20, 0.12);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-8px);
        transition: opacity 0.25s ease, transform 0.25s ease, visibility 0.25s ease;
        z-index: 1101;
        pointer-events: none;
    }

    .account-dropdown.is-open .account-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
        pointer-events: auto;
    }

    .account-menu-header {
        padding: 14px 16px 12px;
        border-bottom: 1px solid rgba(171, 136, 109, 0.18);
    }

    .account-menu-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.05rem;
        font-weight: 500;
        color: var(--primary);
        line-height: 1.3;
        word-break: break-word;
    }

    .account-menu-email {
        margin-top: 4px;
        font-size: 0.72rem;
        font-weight: 300;
        color: rgba(73, 54, 40, 0.55);
        letter-spacing: 0.02em;
        word-break: break-all;
    }

    .account-menu-body {
        padding: 6px 0;
    }

    .account-menu-item {
        display: block;
        width: 100%;
        padding: 10px 16px;
        font-size: 0.78rem;
        font-weight: 500;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--primary);
        text-decoration: none;
        text-align: left;
        background: none;
        border: none;
        cursor: none;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .account-menu-item:hover {
        background: rgba(171, 136, 109, 0.1);
        color: var(--secondary);
    }

    .account-menu-item--logout {
        color: #9a4a4a;
        border-top: 1px solid rgba(171, 136, 109, 0.15);
        margin-top: 4px;
        padding-top: 12px;
    }

    .account-menu-item--logout:hover {
        background: rgba(176, 64, 64, 0.08);
        color: #7a3535;
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
        align-items: center;
        justify-content: center;
    }

    /* ─── MOBILE MENU OVERLAY ─── */
    .mobile-menu {
        position: fixed;
        inset: 0;
        background: var(--cream);
        z-index: 999;
        display: flex;
        flex-direction: column;
        padding: 80px 8% 48px;
        transform: translateX(100%);
        transition: transform 0.5s cubic-bezier(0.77, 0, 0.175, 1);
    }

    .mobile-menu.open {
        transform: translateX(0);
    }

    .mobile-menu a {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.4rem;
        font-weight: 300;
        color: var(--primary);
        text-decoration: none;
        padding: 14px 0;
        border-bottom: 1px solid rgba(171, 136, 109, 0.15);
        display: block;
        transition: color 0.3s, padding-left 0.3s;
        cursor: none;
    }

    .mobile-menu a:hover {
        color: var(--secondary);
        padding-left: 12px;
    }

    /* ─── SEARCH BAR ─── */
    #searchBar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1100;
        background: var(--cream);
        padding: 0 8%;
        height: 72px;
        display: none;
        align-items: center;
        gap: 16px;
        border-bottom: 1px solid rgba(171, 136, 109, 0.2);
        animation: navSlideDown 0.3s ease;
    }

    #searchBar.is-open {
        display: flex;
    }

    #searchInput {
        flex: 1;
        border: none;
        background: none;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.95rem;
        color: var(--primary);
        outline: none;
    }

    .search-close-btn {
        cursor: none;
        border: none;
        background: none;
        font-size: 0.8rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--secondary);
    }

    @keyframes navSlideDown {
        from {
            transform: translateY(-100%);
        }

        to {
            transform: translateY(0);
        }
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
        margin-top: 72px;
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

    /* ─── RESPONSIVE ─── */
    @media (max-width: 1024px) {
        .nav-links {
            gap: 1.25rem;
        }

        .nav-links a {
            font-size: 0.72rem;
        }
    }

    @media (max-width: 768px) {
        nav {
            padding: 0 4%;
            height: 64px;
            background: rgba(228, 224, 225, 0.96);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(171, 136, 109, 0.15);
        }

        nav.scrolled {
            height: 56px;
        }

        .nav-logo {
            font-size: 1.25rem;
            letter-spacing: 0.18em;
        }

        .nav-links,
        .nav-actions .nav-icon:not(.cart-wrap):not(.search-wrap):not(.account-wrap):not(.mobile-menu-btn) {
            display: none;
        }

        .mobile-menu-btn {
            display: inline-flex;
        }

        .announcement {
            font-size: 0.65rem;
            letter-spacing: 0.12em;
            margin-top: 64px;
        }
    }

    @media (max-width: 480px) {
        .nav-logo {
            font-size: 1.05rem;
            letter-spacing: 0.12em;
        }

        .nav-actions {
            gap: 0.85rem;
        }

        .mobile-menu a {
            font-size: 2rem;
        }
    }

    .mobile-logout-form button {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.4rem;
        font-weight: 300;
        color: #9a4a4a;
        background: none;
        border: none;
        border-bottom: 1px solid rgba(171, 136, 109, 0.15);
        padding: 14px 0;
        width: 100%;
        text-align: left;
        cursor: none;
        transition: color 0.3s, padding-left 0.3s;
    }

    .mobile-logout-form button:hover {
        color: #7a3535;
        padding-left: 12px;
    }
</style>

<section>
    <!-- ─── NAVBAR ─── -->
    <nav id="navbar">
        <a href="{{ route('home') }}" class="nav-logo">Mero Bazar</a>

        <div class="nav-links">
            <a href="#">New In</a>
            <a href="#">Women</a>
            <a href="#">Men</a>
            <a href="#">Home</a>
            <a href="#">Collections</a>
            <a href="#">Sale</a>
        </div>

        <div class="nav-actions">
            <button type="button" class="nav-icon search-wrap" onclick="toggleSearch()" aria-label="Search">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"
                    viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7" />
                    <path d="M16.5 16.5L22 22" />
                </svg>
            </button>
            @if ($user = Auth::guard('web')->user())
                <div class="account-dropdown" id="accountDropdown">
                    <button type="button" class="nav-icon account-wrap" id="accountMenuBtn"
                        aria-label="Account menu" aria-expanded="false" aria-haspopup="true"
                        onclick="toggleAccountMenu(event)">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"
                            viewBox="0 0 24 24">
                            <circle cx="12" cy="7" r="4" />
                            <path d="M5.5 21a8.38 8.38 0 0113 0" />
                        </svg>
                    </button>
                    <div class="account-menu" id="accountMenu" role="menu" aria-labelledby="accountMenuBtn">
                        <div class="account-menu-header">
                            <p class="account-menu-name">{{ $user->name }}</p>
                            <p class="account-menu-email">{{ $user->email }}</p>
                        </div>
                        <div class="account-menu-body">
                            <a href="{{ route('profile.edit') }}" class="account-menu-item" role="menuitem">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}" role="none">
                                @csrf
                                <button type="submit" class="account-menu-item account-menu-item--logout"
                                    role="menuitem">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="nav-icon" aria-label="Login">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"
                        viewBox="0 0 24 24">
                        <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4" />
                        <polyline points="10 17 15 12 10 7" />
                        <line x1="15" y1="12" x2="3" y2="12" />
                    </svg>
                </a>
            @endif
            <button type="button" class="nav-icon cart-wrap" onclick="typeof openModal === 'function' && openModal()"
                aria-label="Cart">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"
                    viewBox="0 0 24 24">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <path d="M16 10a4 4 0 01-8 0" />
                </svg>
                <span class="cart-badge">3</span>
            </button>
            <button type="button" class="mobile-menu-btn nav-icon" onclick="toggleMobileMenu()" aria-label="Menu">
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
    <div class="mobile-menu" id="mobileMenu" aria-hidden="true">
        <a href="#" onclick="toggleMobileMenu()">New In</a>
        <a href="#" onclick="toggleMobileMenu()">Women</a>
        <a href="#" onclick="toggleMobileMenu()">Men</a>
        <a href="#" onclick="toggleMobileMenu()">Home &amp; Living</a>
        <a href="#" onclick="toggleMobileMenu()">Collections</a>
        <a href="#" onclick="toggleMobileMenu()">Sale</a>
        @if ($user = Auth::guard('web')->user())
            <a href="{{ route('profile.edit') }}" onclick="toggleMobileMenu()">Profile</a>
            <form method="POST" action="{{ route('logout') }}" class="mobile-logout-form">
                @csrf
                <button type="submit" onclick="toggleMobileMenu()">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" onclick="toggleMobileMenu()">Sign In</a>
        @endif
    </div>

    <!-- ─── SEARCH BAR ─── -->
    <div id="searchBar">
        <svg width="18" height="18" fill="none" stroke="var(--secondary)" stroke-width="1.6"
            viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7" />
            <path d="M16.5 16.5L22 22" />
        </svg>
        <input type="text" placeholder="Search for products, brands..." id="searchInput">
        <button type="button" class="search-close-btn" onclick="toggleSearch()">Close</button>
    </div>

    <!-- ─── ANNOUNCEMENT BAR ─── -->
    <div class="announcement">
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

<script>
    (function initNavbar() {
        if (window.__navbarInitialized) {
            return;
        }
        window.__navbarInitialized = true;

        let menuOpen = false;
        let searchOpen = false;

        window.toggleMobileMenu = function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            if (!menu) {
                return;
            }

            menuOpen = !menuOpen;
            menu.classList.toggle('open', menuOpen);
            menu.setAttribute('aria-hidden', menuOpen ? 'false' : 'true');
            document.body.style.overflow = menuOpen ? 'hidden' : '';
        };

        window.toggleAccountMenu = function toggleAccountMenu(event) {
            if (event) {
                event.stopPropagation();
            }

            const dropdown = document.getElementById('accountDropdown');
            const btn = document.getElementById('accountMenuBtn');
            if (!dropdown || !btn) {
                return;
            }

            const isOpen = dropdown.classList.toggle('is-open');
            btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        };

        window.closeAccountMenu = function closeAccountMenu() {
            const dropdown = document.getElementById('accountDropdown');
            const btn = document.getElementById('accountMenuBtn');
            if (!dropdown || !btn) {
                return;
            }

            dropdown.classList.remove('is-open');
            btn.setAttribute('aria-expanded', 'false');
        };

        document.addEventListener('click', (event) => {
            if (!event.target.closest('#accountDropdown')) {
                window.closeAccountMenu();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                window.closeAccountMenu();
            }
        });

        window.toggleSearch = function toggleSearch() {
            const bar = document.getElementById('searchBar');
            const input = document.getElementById('searchInput');
            if (!bar) {
                return;
            }

            searchOpen = !searchOpen;
            bar.classList.toggle('is-open', searchOpen);

            if (searchOpen && input) {
                input.focus();
            }
        };

        const navbar = document.getElementById('navbar');
        if (navbar) {
            window.addEventListener('scroll', () => {
                navbar.classList.toggle('scrolled', window.scrollY > 60);
            }, {
                passive: true
            });
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth > 768 && menuOpen) {
                window.toggleMobileMenu();
            }
            if (window.innerWidth > 768) {
                window.closeAccountMenu();
            }
        });
    })();
</script>
