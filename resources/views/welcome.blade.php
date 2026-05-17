<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MAISON — Curated Living</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&family=Playfair+Display:ital,wght@0,700;1,400&display=swap" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
  <style>
    :root {
      --primary:    #493628;
      --secondary:  #AB886D;
      --accent:     #D6C0B3;
      --background: #E4E0E1;
      --cream:      #F5F0EB;
      --dark:       #2B1F14;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html { scroll-behavior: smooth; }

    body {
      background-color: var(--background);
      color: var(--primary);
      font-family: 'DM Sans', sans-serif;
      overflow-x: hidden;
      cursor: none;
    }

    /* ─── CUSTOM CURSOR ─── */
    .cursor-dot {
      width: 8px; height: 8px;
      background: var(--primary);
      border-radius: 50%;
      position: fixed; top: 0; left: 0;
      pointer-events: none; z-index: 9999;
      transform: translate(-50%, -50%);
      transition: transform 0.1s ease;
    }
    .cursor-ring {
      width: 36px; height: 36px;
      border: 1.5px solid var(--secondary);
      border-radius: 50%;
      position: fixed; top: 0; left: 0;
      pointer-events: none; z-index: 9998;
      transform: translate(-50%, -50%);
      transition: all 0.18s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .cursor-ring.hovering {
      width: 60px; height: 60px;
      background: rgba(171, 136, 109, 0.08);
      border-color: var(--primary);
    }

    /* ─── NOISE TEXTURE OVERLAY ─── */
    body::before {
      content: '';
      position: fixed; inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
      pointer-events: none; z-index: 9990;
      opacity: 0.4;
    }

    /* ─── TYPOGRAPHY ─── */
    .font-display    { font-family: 'Cormorant Garamond', serif; }
    .font-editorial  { font-family: 'Playfair Display', serif; }
    .font-body       { font-family: 'DM Sans', sans-serif; }

    /* ─── SCROLLBAR ─── */
    ::-webkit-scrollbar { width: 4px; }
    ::-webkit-scrollbar-track { background: var(--background); }
    ::-webkit-scrollbar-thumb { background: var(--secondary); border-radius: 4px; }

    /* ─── NAVBAR ─── */
    nav {
      position: fixed; top: 0; left: 0; right: 0;
      z-index: 1000;
      padding: 0 5%;
      height: 72px;
      display: flex; align-items: center; justify-content: space-between;
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
      position: absolute; bottom: 0; left: 0;
      width: 0; height: 1px;
      background: var(--secondary);
      transition: width 0.3s ease;
    }
    .nav-links a:hover::after { width: 100%; }
    .nav-icon { cursor: none; position: relative; }
    .cart-badge {
      position: absolute; top: -6px; right: -8px;
      width: 16px; height: 16px;
      background: var(--secondary);
      border-radius: 50%;
      font-size: 0.6rem;
      display: flex; align-items: center; justify-content: center;
      color: white; font-weight: 600;
    }
    .mobile-menu-btn { display: none; cursor: none; }

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
    .ticker-wrap { display: flex; gap: 80px; animation: ticker 24s linear infinite; white-space: nowrap; }
    @keyframes ticker { from { transform: translateX(0); } to { transform: translateX(-50%); } }

    /* ─── HERO ─── */
    .hero {
      min-height: 100vh;
      padding-top: 72px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      position: relative;
      overflow: hidden;
      background: var(--cream);
    }
    .hero-left {
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 6% 5% 6% 8%;
      position: relative;
      z-index: 2;
    }
    .hero-eyebrow {
      font-size: 0.72rem;
      letter-spacing: 0.28em;
      text-transform: uppercase;
      color: var(--secondary);
      font-weight: 500;
      margin-bottom: 24px;
      opacity: 0;
      transform: translateY(20px);
    }
    .hero-headline {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(3.2rem, 6vw, 6rem);
      line-height: 1.0;
      font-weight: 300;
      color: var(--primary);
      margin-bottom: 28px;
    }
    .hero-headline em {
      font-style: italic;
      color: var(--secondary);
    }
    .hero-sub {
      font-size: 0.88rem;
      line-height: 1.8;
      color: #6b5c4e;
      max-width: 360px;
      margin-bottom: 40px;
    }
    .hero-cta-group { display: flex; gap: 16px; align-items: center; }
    .btn-primary {
      background: var(--primary);
      color: var(--accent);
      padding: 14px 36px;
      font-size: 0.78rem;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      font-weight: 500;
      border: none;
      cursor: none;
      text-decoration: none;
      display: inline-block;
      position: relative;
      overflow: hidden;
      transition: color 0.3s ease;
    }
    .btn-primary::before {
      content: '';
      position: absolute; inset: 0;
      background: var(--secondary);
      transform: translateX(-101%);
      transition: transform 0.4s cubic-bezier(0.77, 0, 0.175, 1);
    }
    .btn-primary:hover::before { transform: translateX(0); }
    .btn-primary span { position: relative; z-index: 1; }
    .btn-ghost {
      color: var(--primary);
      font-size: 0.78rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      font-weight: 500;
      text-decoration: none;
      display: flex; align-items: center; gap: 8px;
      transition: gap 0.3s ease;
    }
    .btn-ghost:hover { gap: 14px; }
    .hero-right {
      position: relative;
      overflow: hidden;
    }
    .hero-img-container {
      width: 100%; height: 100%;
      position: relative;
    }
    .hero-img-container img {
      width: 100%; height: 100%;
      object-fit: cover;
      transform: scale(1.08);
      transition: transform 8s ease;
    }
    .hero-img-container:hover img { transform: scale(1.0); }
    .hero-img-overlay {
      position: absolute; inset: 0;
      background: linear-gradient(135deg, rgba(73,54,40,0.12) 0%, transparent 60%);
    }
    .hero-floating-card {
      position: absolute;
      bottom: 10%;
      left: -40px;
      background: white;
      padding: 18px 24px;
      box-shadow: 0 20px 60px rgba(73,54,40,0.15);
      min-width: 200px;
      opacity: 0;
      transform: translateX(-20px);
    }
    .hero-scroll-hint {
      position: absolute;
      bottom: 32px; left: 50%;
      transform: translateX(-50%);
      display: flex; flex-direction: column; align-items: center; gap: 8px;
      font-size: 0.68rem; letter-spacing: 0.2em; text-transform: uppercase;
      color: var(--secondary);
      animation: float 2.5s ease-in-out infinite;
    }
    .scroll-line {
      width: 1px; height: 40px;
      background: linear-gradient(to bottom, var(--secondary), transparent);
      animation: growLine 2.5s ease-in-out infinite;
    }
    @keyframes float { 0%,100% { transform: translateX(-50%) translateY(0); } 50% { transform: translateX(-50%) translateY(-6px); } }
    @keyframes growLine { 0%,100% { transform: scaleY(0.5); } 50% { transform: scaleY(1); } }

    /* ─── MARQUEE STRIP ─── */
    .marquee-strip {
      background: var(--primary);
      padding: 14px 0;
      overflow: hidden;
    }
    .marquee-inner {
      display: flex;
      gap: 48px;
      animation: marquee 20s linear infinite;
      white-space: nowrap;
    }
    @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
    .marquee-item {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.3rem;
      font-weight: 300;
      letter-spacing: 0.08em;
      color: var(--accent);
      display: flex; align-items: center; gap: 16px;
    }
    .marquee-item .dot {
      width: 5px; height: 5px;
      background: var(--secondary);
      border-radius: 50%;
    }

    /* ─── SECTION LAYOUT ─── */
    .section { padding: 100px 8%; }
    .section-label {
      font-size: 0.7rem;
      letter-spacing: 0.28em;
      text-transform: uppercase;
      color: var(--secondary);
      font-weight: 500;
      margin-bottom: 14px;
      display: flex; align-items: center; gap: 12px;
    }
    .section-label::before {
      content: '';
      display: inline-block;
      width: 28px; height: 1px;
      background: var(--secondary);
    }
    .section-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(2rem, 4vw, 3.4rem);
      font-weight: 300;
      line-height: 1.15;
      color: var(--primary);
    }
    .section-title em { font-style: italic; }

    /* ─── CATEGORIES ─── */
    .categories-grid {
      display: grid;
      grid-template-columns: 1.5fr 1fr 1fr;
      grid-template-rows: 340px 240px;
      gap: 16px;
      margin-top: 48px;
    }
    .cat-card {
      position: relative;
      overflow: hidden;
      cursor: none;
    }
    .cat-card:first-child { grid-row: 1 / 3; }
    .cat-card img {
      width: 100%; height: 100%;
      object-fit: cover;
      transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .cat-card:hover img { transform: scale(1.06); }
    .cat-card-overlay {
      position: absolute; inset: 0;
      background: linear-gradient(to top, rgba(43,31,20,0.75) 0%, transparent 55%);
      display: flex; flex-direction: column; justify-content: flex-end;
      padding: 28px;
      transition: background 0.4s ease;
    }
    .cat-card:hover .cat-card-overlay {
      background: linear-gradient(to top, rgba(43,31,20,0.85) 0%, rgba(43,31,20,0.1) 70%);
    }
    .cat-name {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.5rem;
      font-weight: 400;
      color: white;
      margin-bottom: 6px;
    }
    .cat-count { font-size: 0.72rem; color: var(--accent); letter-spacing: 0.12em; }
    .cat-arrow {
      position: absolute; bottom: 28px; right: 28px;
      width: 38px; height: 38px;
      border: 1px solid rgba(255,255,255,0.4);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      color: white;
      transform: scale(0);
      transition: transform 0.3s ease, background 0.3s ease;
    }
    .cat-card:hover .cat-arrow { transform: scale(1); }
    .cat-card:hover .cat-arrow { background: var(--secondary); border-color: var(--secondary); }

    /* ─── PRODUCTS ─── */
    .products-header {
      display: flex; justify-content: space-between; align-items: flex-end;
      margin-bottom: 48px;
    }
    .product-filter {
      display: flex; gap: 6px;
    }
    .filter-btn {
      padding: 8px 20px;
      font-size: 0.73rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      font-weight: 500;
      background: transparent;
      border: 1px solid var(--accent);
      color: var(--primary);
      cursor: none;
      transition: all 0.3s ease;
    }
    .filter-btn.active, .filter-btn:hover {
      background: var(--primary);
      color: var(--accent);
      border-color: var(--primary);
    }
    .products-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
    }
    .product-card {
      background: white;
      position: relative;
      cursor: none;
      overflow: hidden;
    }
    .product-img-wrap {
      position: relative;
      overflow: hidden;
      aspect-ratio: 3/4;
    }
    .product-img-wrap img {
      width: 100%; height: 100%;
      object-fit: cover;
      transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .product-card:hover .product-img-wrap img { transform: scale(1.05); }
    .product-badge {
      position: absolute; top: 14px; left: 14px;
      background: var(--primary);
      color: var(--accent);
      padding: 4px 10px;
      font-size: 0.65rem;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      font-weight: 500;
    }
    .product-badge.sale { background: #8B4513; }
    .product-actions {
      position: absolute; bottom: -60px; left: 0; right: 0;
      display: flex;
      padding: 0 16px 16px;
      gap: 8px;
      transition: bottom 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .product-card:hover .product-actions { bottom: 0; }
    .add-cart-btn {
      flex: 1;
      padding: 11px;
      background: var(--primary);
      color: var(--accent);
      font-size: 0.72rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      font-weight: 500;
      border: none;
      cursor: none;
      transition: background 0.3s;
    }
    .add-cart-btn:hover { background: var(--secondary); }
    .wishlist-btn {
      width: 42px;
      background: white;
      border: 1px solid var(--accent);
      display: flex; align-items: center; justify-content: center;
      cursor: none;
      transition: all 0.3s;
      flex-shrink: 0;
    }
    .wishlist-btn:hover { background: var(--accent); }
    .wishlist-btn svg { width: 16px; height: 16px; }
    .product-info { padding: 18px 18px 20px; }
    .product-brand {
      font-size: 0.67rem;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      color: var(--secondary);
      margin-bottom: 6px;
    }
    .product-name {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.1rem;
      font-weight: 500;
      color: var(--primary);
      margin-bottom: 10px;
      line-height: 1.3;
    }
    .product-price-row { display: flex; align-items: center; gap: 10px; }
    .product-price {
      font-weight: 500;
      font-size: 0.95rem;
      color: var(--primary);
    }
    .product-price-old {
      font-size: 0.82rem;
      color: #aaa;
      text-decoration: line-through;
    }
    .product-rating {
      display: flex; gap: 2px; margin-top: 8px;
    }
    .star { color: var(--secondary); font-size: 0.75rem; }

    /* ─── BANNER ─── */
    .banner-section {
      padding: 0 8% 100px;
    }
    .banner-inner {
      background: var(--primary);
      display: grid;
      grid-template-columns: 1fr 1fr;
      min-height: 480px;
      position: relative;
      overflow: hidden;
    }
    .banner-left {
      padding: 60px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
      z-index: 2;
    }
    .banner-eyebrow {
      font-size: 0.7rem;
      letter-spacing: 0.28em;
      text-transform: uppercase;
      color: var(--secondary);
      margin-bottom: 20px;
    }
    .banner-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(2.4rem, 4vw, 3.6rem);
      font-weight: 300;
      color: var(--accent);
      line-height: 1.1;
      margin-bottom: 20px;
    }
    .banner-title em { font-style: italic; color: var(--secondary); }
    .banner-text {
      font-size: 0.85rem;
      line-height: 1.9;
      color: rgba(214,192,179,0.7);
      max-width: 340px;
      margin-bottom: 36px;
    }
    .btn-light {
      display: inline-block;
      padding: 13px 32px;
      border: 1px solid var(--accent);
      color: var(--accent);
      font-size: 0.75rem;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      font-weight: 500;
      text-decoration: none;
      position: relative;
      overflow: hidden;
      cursor: none;
      transition: color 0.3s ease;
    }
    .btn-light::before {
      content: '';
      position: absolute; inset: 0;
      background: var(--secondary);
      transform: translateX(-101%);
      transition: transform 0.4s cubic-bezier(0.77, 0, 0.175, 1);
    }
    .btn-light:hover::before { transform: translateX(0); }
    .btn-light:hover { border-color: var(--secondary); color: var(--primary); }
    .btn-light span { position: relative; z-index: 1; }
    .banner-right {
      position: relative;
      overflow: hidden;
    }
    .banner-right img {
      width: 100%; height: 100%;
      object-fit: cover;
      opacity: 0.6;
      mix-blend-mode: luminosity;
      transition: opacity 0.4s ease;
    }
    .banner-inner:hover .banner-right img { opacity: 0.8; }
    .banner-deco {
      position: absolute;
      right: -60px; bottom: -60px;
      width: 320px; height: 320px;
      border: 1px solid rgba(171,136,109,0.15);
      border-radius: 50%;
    }
    .banner-deco-2 {
      position: absolute;
      right: -20px; bottom: -20px;
      width: 200px; height: 200px;
      border: 1px solid rgba(171,136,109,0.25);
      border-radius: 50%;
    }
    .discount-chip {
      position: absolute; top: 40px; right: 40px;
      width: 90px; height: 90px;
      background: var(--secondary);
      border-radius: 50%;
      display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      animation: spin-slow 12s linear infinite;
    }
    .discount-chip span:first-child { font-size: 1.4rem; font-weight: 700; color: white; line-height: 1; }
    .discount-chip span:last-child { font-size: 0.6rem; letter-spacing: 0.1em; color: rgba(255,255,255,0.8); text-transform: uppercase; }
    @keyframes spin-slow { from { transform: rotate(0); } to { transform: rotate(360deg); } }

    /* ─── FLASH SALE COUNTDOWN ─── */
    .countdown-section {
      background: linear-gradient(135deg, #3a2a1c 0%, var(--primary) 50%, #5c4030 100%);
      padding: 72px 8%;
      position: relative;
      overflow: hidden;
    }
    .countdown-section::after {
      content: '';
      position: absolute; inset: 0;
      background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23AB886D' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
      pointer-events: none;
    }
    .countdown-inner {
      display: grid;
      grid-template-columns: 1fr auto;
      align-items: center;
      gap: 48px;
      position: relative;
      z-index: 1;
    }
    .countdown-left { }
    .flash-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(171,136,109,0.2);
      border: 1px solid rgba(171,136,109,0.35);
      padding: 6px 16px;
      border-radius: 100px;
      font-size: 0.68rem;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--secondary);
      font-weight: 500;
      margin-bottom: 20px;
    }
    .flash-dot {
      width: 7px; height: 7px;
      background: #ef4444;
      border-radius: 50%;
      animation: pulse-red 1.4s ease-in-out infinite;
    }
    @keyframes pulse-red {
      0%,100% { box-shadow: 0 0 0 0 rgba(239,68,68,0.5); }
      50%      { box-shadow: 0 0 0 6px rgba(239,68,68,0); }
    }
    .countdown-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(2rem, 3.8vw, 3.2rem);
      font-weight: 300;
      color: var(--accent);
      line-height: 1.15;
      margin-bottom: 10px;
    }
    .countdown-title em { font-style: italic; color: var(--secondary); }
    .countdown-sub {
      font-size: 0.82rem;
      color: rgba(214,192,179,0.55);
      line-height: 1.7;
      max-width: 380px;
      margin-bottom: 28px;
    }
    .countdown-timer {
      display: flex;
      gap: 16px;
      align-items: center;
    }
    .time-block {
      text-align: center;
      min-width: 74px;
    }
    .time-digits {
      font-family: 'Cormorant Garamond', serif;
      font-size: 3.2rem;
      font-weight: 500;
      color: var(--accent);
      line-height: 1;
      display: block;
      background: rgba(255,255,255,0.05);
      border: 1px solid rgba(171,136,109,0.2);
      padding: 14px 12px 10px;
      min-width: 74px;
      transition: transform 0.15s ease;
    }
    .time-digits.flip {
      transform: rotateX(90deg);
    }
    .time-label {
      font-size: 0.62rem;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--secondary);
      margin-top: 8px;
      display: block;
    }
    .time-colon {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.4rem;
      color: var(--secondary);
      opacity: 0.6;
      margin-top: -18px;
      animation: blink 1s step-end infinite;
    }
    @keyframes blink { 0%,100% { opacity: 0.6; } 50% { opacity: 0; } }
    .countdown-products {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }
    .countdown-product-row {
      display: flex;
      align-items: center;
      gap: 14px;
      background: rgba(255,255,255,0.05);
      border: 1px solid rgba(171,136,109,0.15);
      padding: 12px 16px;
      min-width: 300px;
      transition: background 0.3s;
      cursor: none;
    }
    .countdown-product-row:hover { background: rgba(255,255,255,0.09); }
    .cp-img {
      width: 52px; height: 52px;
      object-fit: cover;
      flex-shrink: 0;
    }
    .cp-info { flex: 1; }
    .cp-name { font-size: 0.82rem; color: var(--accent); font-weight: 500; margin-bottom: 3px; }
    .cp-price { font-size: 0.75rem; color: var(--secondary); }
    .cp-price-old { text-decoration: line-through; opacity: 0.5; margin-right: 6px; }
    .cp-bar {
      height: 3px;
      background: rgba(255,255,255,0.08);
      border-radius: 2px;
      margin-top: 6px;
      overflow: hidden;
    }
    .cp-bar-fill {
      height: 100%;
      background: linear-gradient(to right, var(--secondary), var(--accent));
      border-radius: 2px;
      transition: width 1.2s ease;
    }
    .cp-sold { font-size: 0.64rem; color: rgba(214,192,179,0.4); margin-top: 3px; }

    /* ─── BRAND STORY ─── */
    .story-section {
      padding: 110px 8%;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 80px;
      align-items: center;
    }
    .story-img-stack {
      position: relative;
      height: 560px;
    }
    .story-img-main {
      width: 75%;
      height: 100%;
      object-fit: cover;
      position: absolute;
      right: 0; top: 0;
    }
    .story-img-accent {
      width: 52%;
      height: 52%;
      object-fit: cover;
      position: absolute;
      left: 0; bottom: 40px;
      border: 6px solid var(--background);
      box-shadow: 0 20px 60px rgba(73,54,40,0.18);
    }
    .story-year-badge {
      position: absolute;
      top: 30px; left: 0;
      background: var(--secondary);
      padding: 20px 24px;
      text-align: center;
      box-shadow: 0 8px 30px rgba(73,54,40,0.2);
    }
    .story-year { font-family: 'Cormorant Garamond', serif; font-size: 2rem; font-weight: 600; color: white; line-height: 1; }
    .story-year-label { font-size: 0.64rem; letter-spacing: 0.18em; text-transform: uppercase; color: rgba(255,255,255,0.75); margin-top: 4px; }
    .story-right { }
    .story-quote {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.25rem;
      font-style: italic;
      color: var(--secondary);
      line-height: 1.7;
      border-left: 2px solid var(--secondary);
      padding-left: 20px;
      margin-bottom: 28px;
    }
    .story-body {
      font-size: 0.86rem;
      line-height: 1.95;
      color: #6b5c4e;
      margin-bottom: 20px;
    }
    .story-values {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
      margin: 28px 0 36px;
    }
    .story-value-item {
      display: flex;
      align-items: flex-start;
      gap: 12px;
    }
    .sv-icon {
      width: 32px; height: 32px;
      background: var(--accent);
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      margin-top: 2px;
      color: var(--primary);
    }
    .sv-label { font-size: 0.78rem; font-weight: 500; color: var(--primary); }
    .sv-text { font-size: 0.72rem; color: #7a6858; line-height: 1.55; margin-top: 2px; }
    .story-signature {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.6rem;
      font-style: italic;
      color: var(--secondary);
      margin-top: 28px;
    }
    .story-sig-label { font-size: 0.7rem; letter-spacing: 0.12em; text-transform: uppercase; color: #9a8272; }

    /* ─── HORIZONTAL BEST SELLERS ─── */
    .bestsellers-section { padding: 100px 0 100px 8%; overflow: hidden; }
    .bestsellers-header { padding-right: 8%; display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 48px; }
    .bs-scroll-wrap { position: relative; }
    .bs-track {
      display: flex;
      gap: 20px;
      overflow-x: auto;
      scroll-snap-type: x mandatory;
      -webkit-overflow-scrolling: touch;
      padding-right: 8%;
      padding-bottom: 20px;
      cursor: grab;
    }
    .bs-track:active { cursor: grabbing; }
    .bs-track::-webkit-scrollbar { height: 2px; }
    .bs-track::-webkit-scrollbar-track { background: var(--accent); }
    .bs-track::-webkit-scrollbar-thumb { background: var(--secondary); }
    .bs-card {
      flex-shrink: 0;
      width: 280px;
      scroll-snap-align: start;
      background: white;
      cursor: none;
      position: relative;
      overflow: hidden;
    }
    .bs-card-img {
      width: 100%; height: 340px;
      object-fit: cover;
      display: block;
      transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .bs-card:hover .bs-card-img { transform: scale(1.05); }
    .bs-rank {
      position: absolute; top: 14px; left: 14px;
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.4rem;
      font-weight: 600;
      color: white;
      text-shadow: 0 2px 8px rgba(0,0,0,0.4);
    }
    .bs-info { padding: 18px; }
    .bs-brand { font-size: 0.67rem; letter-spacing: 0.14em; text-transform: uppercase; color: var(--secondary); margin-bottom: 5px; }
    .bs-name { font-family: 'Cormorant Garamond', serif; font-size: 1.1rem; color: var(--primary); margin-bottom: 10px; }
    .bs-foot { display: flex; justify-content: space-between; align-items: center; }
    .bs-price { font-weight: 500; font-size: 0.92rem; color: var(--primary); }
    .bs-add {
      width: 36px; height: 36px;
      background: var(--primary);
      border: none;
      display: flex; align-items: center; justify-content: center;
      cursor: none;
      transition: background 0.3s, transform 0.2s;
    }
    .bs-add:hover { background: var(--secondary); transform: scale(1.08); }
    .bs-add svg { width: 15px; height: 15px; stroke: white; stroke-width: 2; }
    .bs-nav-btn {
      position: absolute; top: 50%; transform: translateY(-50%);
      width: 44px; height: 44px;
      background: white;
      border: 1px solid var(--accent);
      display: flex; align-items: center; justify-content: center;
      cursor: none;
      z-index: 10;
      transition: all 0.3s;
      box-shadow: 0 4px 20px rgba(73,54,40,0.12);
    }
    .bs-nav-btn:hover { background: var(--primary); border-color: var(--primary); }
    .bs-nav-btn:hover svg { stroke: white; }
    .bs-nav-btn svg { stroke: var(--primary); width: 16px; height: 16px; stroke-width: 2; }
    .bs-prev { right: calc(8% + 60px); }
    .bs-next { right: 8%; }

    /* ─── LOOKBOOK / INSTAGRAM ─── */
    .lookbook-section { padding: 100px 8%; background: var(--cream); }
    .lookbook-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      grid-template-rows: 240px 240px;
      gap: 10px;
      margin-top: 48px;
    }
    .look-cell {
      position: relative;
      overflow: hidden;
      cursor: none;
    }
    .look-cell:nth-child(1) { grid-column: span 2; grid-row: span 2; }
    .look-cell:nth-child(4) { grid-column: span 2; }
    .look-img {
      width: 100%; height: 100%;
      object-fit: cover;
      transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .look-cell:hover .look-img { transform: scale(1.07); }
    .look-overlay {
      position: absolute; inset: 0;
      background: rgba(43,31,20,0);
      display: flex; align-items: center; justify-content: center;
      transition: background 0.3s;
    }
    .look-cell:hover .look-overlay { background: rgba(43,31,20,0.45); }
    .look-icon {
      opacity: 0;
      transform: scale(0.7);
      transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
      background: white;
      width: 44px; height: 44px;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
    }
    .look-cell:hover .look-icon { opacity: 1; transform: scale(1); }
    .look-icon svg { width: 18px; height: 18px; stroke: var(--primary); stroke-width: 1.8; fill: none; }
    .look-tag {
      position: absolute;
      bottom: 12px; left: 12px;
      background: rgba(255,255,255,0.92);
      padding: 5px 12px;
      font-size: 0.68rem;
      font-weight: 500;
      color: var(--primary);
      letter-spacing: 0.08em;
      opacity: 0;
      transform: translateY(6px);
      transition: all 0.3s ease;
    }
    .look-cell:hover .look-tag { opacity: 1; transform: translateY(0); }
    .look-insta-cta {
      text-align: center;
      margin-top: 36px;
    }
    .insta-handle {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.5rem;
      color: var(--primary);
      display: flex; align-items: center; justify-content: center; gap: 12px;
      margin-bottom: 8px;
    }
    .insta-sub { font-size: 0.8rem; color: #7a6858; }

    /* ─── PRESS / AS SEEN IN ─── */
    .press-section {
      padding: 60px 8%;
      border-top: 1px solid rgba(171,136,109,0.15);
      border-bottom: 1px solid rgba(171,136,109,0.15);
    }
    .press-label {
      text-align: center;
      font-size: 0.68rem;
      letter-spacing: 0.28em;
      text-transform: uppercase;
      color: var(--secondary);
      font-weight: 500;
      margin-bottom: 36px;
    }
    .press-logos {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      flex-wrap: wrap;
    }
    .press-logo-item {
      display: flex;
      align-items: center;
      justify-content: center;
      flex: 1;
      min-width: 120px;
      opacity: 0.35;
      filter: sepia(100%);
      transition: opacity 0.3s, filter 0.3s;
      cursor: none;
    }
    .press-logo-item:hover { opacity: 0.75; filter: none; }
    .press-logo-text {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(1.1rem, 2vw, 1.5rem);
      font-weight: 600;
      letter-spacing: 0.06em;
      color: var(--primary);
      text-transform: uppercase;
      white-space: nowrap;
    }
    .press-logo-text.serif-italic { font-style: italic; font-weight: 400; font-size: clamp(1.2rem, 2vw, 1.7rem); }
    .press-divider { width: 1px; height: 32px; background: rgba(171,136,109,0.2); flex-shrink: 0; }

    /* ─── LOYALTY / MEMBERSHIP ─── */
    .loyalty-section {
      padding: 100px 8%;
      background: var(--cream);
      position: relative;
      overflow: hidden;
    }
    .loyalty-section::before {
      content: '';
      position: absolute;
      right: -200px; top: -200px;
      width: 600px; height: 600px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(171,136,109,0.08) 0%, transparent 70%);
      pointer-events: none;
    }
    .loyalty-header { text-align: center; margin-bottom: 64px; }
    .loyalty-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
    }
    .loyalty-card {
      background: white;
      border: 1px solid rgba(171,136,109,0.15);
      padding: 40px 32px;
      position: relative;
      overflow: hidden;
      transition: transform 0.35s ease, box-shadow 0.35s ease;
    }
    .loyalty-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 24px 60px rgba(73,54,40,0.12);
    }
    .loyalty-card.featured {
      background: var(--primary);
      border-color: var(--primary);
      transform: scale(1.03);
    }
    .loyalty-card.featured:hover {
      transform: scale(1.03) translateY(-8px);
    }
    .loyalty-tier-badge {
      display: inline-block;
      padding: 5px 14px;
      border-radius: 100px;
      font-size: 0.65rem;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      font-weight: 600;
      margin-bottom: 20px;
    }
    .badge-silver { background: rgba(171,136,109,0.12); color: var(--secondary); }
    .badge-gold   { background: var(--secondary); color: white; }
    .badge-plat   { background: rgba(43,31,20,0.08); color: var(--primary); }
    .loyalty-card.featured .badge-gold { background: rgba(255,255,255,0.15); }
    .loyalty-tier-name {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2rem;
      font-weight: 500;
      margin-bottom: 6px;
    }
    .loyalty-card:not(.featured) .loyalty-tier-name { color: var(--primary); }
    .loyalty-card.featured .loyalty-tier-name { color: var(--accent); }
    .loyalty-spend {
      font-size: 0.78rem;
      color: #9a8272;
      margin-bottom: 28px;
    }
    .loyalty-card.featured .loyalty-spend { color: rgba(214,192,179,0.55); }
    .loyalty-divider {
      height: 1px;
      background: rgba(171,136,109,0.15);
      margin-bottom: 24px;
    }
    .loyalty-card.featured .loyalty-divider { background: rgba(255,255,255,0.1); }
    .loyalty-perks { list-style: none; display: flex; flex-direction: column; gap: 12px; }
    .loyalty-perk {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      font-size: 0.8rem;
      line-height: 1.5;
    }
    .loyalty-card:not(.featured) .loyalty-perk { color: #6b5c4e; }
    .loyalty-card.featured .loyalty-perk { color: rgba(214,192,179,0.75); }
    .perk-check {
      width: 18px; height: 18px;
      border-radius: 50%;
      background: rgba(171,136,109,0.15);
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      margin-top: 1px;
    }
    .loyalty-card.featured .perk-check { background: rgba(255,255,255,0.12); }
    .perk-check svg { width: 10px; height: 10px; stroke: var(--secondary); stroke-width: 2.5; }
    .loyalty-card.featured .perk-check svg { stroke: var(--accent); }
    .loyalty-btn {
      display: block;
      margin-top: 32px;
      text-align: center;
      padding: 13px 24px;
      font-size: 0.74rem;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      font-weight: 500;
      text-decoration: none;
      cursor: none;
      transition: all 0.3s;
    }
    .loyalty-btn-outline {
      border: 1px solid rgba(171,136,109,0.35);
      color: var(--primary);
    }
    .loyalty-btn-outline:hover {
      background: var(--primary);
      color: var(--accent);
      border-color: var(--primary);
    }
    .loyalty-btn-filled {
      background: var(--secondary);
      color: white;
      border: 1px solid var(--secondary);
    }
    .loyalty-btn-filled:hover { background: var(--accent); color: var(--primary); border-color: var(--accent); }
    .loyalty-popular-tag {
      position: absolute; top: -1px; right: 28px;
      background: var(--secondary);
      color: white;
      padding: 5px 14px;
      font-size: 0.63rem;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      font-weight: 600;
    }

    /* ─── RECENTLY VIEWED / RECOMMENDATIONS ─── */
    .reco-section { padding: 80px 8% 100px; }
    .reco-strip {
      display: flex;
      gap: 16px;
      margin-top: 40px;
      overflow-x: auto;
      padding-bottom: 12px;
    }
    .reco-strip::-webkit-scrollbar { height: 2px; }
    .reco-strip::-webkit-scrollbar-thumb { background: var(--secondary); }
    .reco-chip {
      flex-shrink: 0;
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 20px 12px 12px;
      background: white;
      border: 1px solid rgba(171,136,109,0.15);
      cursor: none;
      transition: all 0.3s;
      min-width: 200px;
    }
    .reco-chip:hover { border-color: var(--secondary); box-shadow: 0 4px 20px rgba(73,54,40,0.08); }
    .reco-chip img { width: 50px; height: 50px; object-fit: cover; flex-shrink: 0; }
    .reco-name { font-size: 0.78rem; font-weight: 500; color: var(--primary); line-height: 1.3; }
    .reco-price { font-size: 0.72rem; color: var(--secondary); margin-top: 2px; }

    /* ─── BLOG / EDITORIAL ─── */
    .blog-section { padding: 100px 8%; }
    .blog-grid {
      display: grid;
      grid-template-columns: 1.6fr 1fr 1fr;
      gap: 24px;
      margin-top: 48px;
    }
    .blog-card {
      overflow: hidden;
      cursor: none;
      background: white;
    }
    .blog-img-wrap { overflow: hidden; aspect-ratio: 16/10; }
    .blog-img-wrap img {
      width: 100%; height: 100%;
      object-fit: cover;
      transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .blog-card:hover .blog-img-wrap img { transform: scale(1.05); }
    .blog-body { padding: 24px; }
    .blog-cat {
      font-size: 0.65rem;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--secondary);
      font-weight: 500;
      margin-bottom: 10px;
    }
    .blog-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.15rem;
      font-weight: 500;
      color: var(--primary);
      line-height: 1.4;
      margin-bottom: 10px;
    }
    .blog-card:first-child .blog-title { font-size: 1.45rem; }
    .blog-excerpt {
      font-size: 0.78rem;
      color: #7a6858;
      line-height: 1.7;
      margin-bottom: 16px;
    }
    .blog-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 0.7rem;
      color: #9a8272;
    }
    .blog-read-more {
      display: flex; align-items: center; gap: 6px;
      text-decoration: none;
      font-size: 0.7rem;
      color: var(--secondary);
      font-weight: 500;
      transition: gap 0.3s;
    }
    .blog-read-more:hover { gap: 10px; }

    /* ─── RESPONSIVE ADDITIONS ─── */
    @media (max-width: 1024px) {
      .countdown-inner { grid-template-columns: 1fr; }
      .story-section { grid-template-columns: 1fr; gap: 48px; }
      .story-img-stack { height: 380px; }
      .loyalty-grid { grid-template-columns: 1fr; }
      .loyalty-card.featured { transform: none; }
      .blog-grid { grid-template-columns: 1fr 1fr; }
      .blog-card:first-child { grid-column: span 2; }
      .lookbook-grid { grid-template-columns: repeat(3, 1fr); grid-template-rows: auto; }
      .look-cell:nth-child(1) { grid-column: span 2; grid-row: span 1; height: 240px; }
      .look-cell:nth-child(4) { grid-column: span 1; }
    }
    @media (max-width: 768px) {
      .blog-grid { grid-template-columns: 1fr; }
      .blog-card:first-child { grid-column: span 1; }
      .lookbook-grid { grid-template-columns: 1fr 1fr; grid-template-rows: auto; }
      .look-cell:nth-child(1) { grid-column: span 2; height: 200px; }
      .look-cell:nth-child(4) { grid-column: span 2; }
      .bestsellers-section { padding: 60px 0 60px 5%; }
      .bs-track { padding-right: 5%; }
      .countdown-timer { flex-wrap: wrap; }
      .press-logos { justify-content: center; }
      .press-divider { display: none; }
      .story-img-stack { display: none; }
      .story-section { grid-template-columns: 1fr; padding: 60px 5%; }
    }

    /* ─── TESTIMONIALS ─── */
    .testimonials { padding: 100px 8%; background: var(--cream); }
    .testimonials-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
      margin-top: 48px;
    }
    .testimonial-card {
      padding: 36px 32px;
      border: 1px solid rgba(171,136,109,0.2);
      position: relative;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      background: white;
    }
    .testimonial-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 50px rgba(73,54,40,0.1);
    }
    .quote-mark {
      font-family: 'Cormorant Garamond', serif;
      font-size: 5rem;
      line-height: 0.6;
      color: var(--accent);
      margin-bottom: 16px;
      display: block;
    }
    .testimonial-text {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.05rem;
      line-height: 1.75;
      color: var(--primary);
      font-weight: 400;
      margin-bottom: 24px;
      font-style: italic;
    }
    .testimonial-author {
      display: flex; align-items: center; gap: 14px;
    }
    .author-avatar {
      width: 42px; height: 42px;
      border-radius: 50%;
      background: var(--accent);
      display: flex; align-items: center; justify-content: center;
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.1rem;
      color: var(--primary);
      font-weight: 500;
      flex-shrink: 0;
    }
    .author-name {
      font-size: 0.82rem;
      font-weight: 500;
      color: var(--primary);
    }
    .author-role {
      font-size: 0.7rem;
      color: var(--secondary);
      letter-spacing: 0.08em;
    }

    /* ─── NEWSLETTER ─── */
    .newsletter {
      padding: 80px 8%;
      background: var(--primary);
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .newsletter::before {
      content: '';
      position: absolute;
      top: -100px; left: 50%;
      transform: translateX(-50%);
      width: 500px; height: 500px;
      background: radial-gradient(circle, rgba(171,136,109,0.12) 0%, transparent 70%);
      pointer-events: none;
    }
    .newsletter-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(2rem, 4vw, 3rem);
      font-weight: 300;
      color: var(--accent);
      margin-bottom: 12px;
    }
    .newsletter-sub {
      font-size: 0.83rem;
      color: rgba(214,192,179,0.65);
      margin-bottom: 36px;
      line-height: 1.7;
    }
    .newsletter-form {
      display: flex;
      max-width: 480px;
      margin: 0 auto;
      gap: 0;
    }
    .newsletter-form input {
      flex: 1;
      padding: 14px 20px;
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(171,136,109,0.35);
      border-right: none;
      color: var(--accent);
      font-size: 0.82rem;
      font-family: 'DM Sans', sans-serif;
      outline: none;
      transition: border-color 0.3s;
    }
    .newsletter-form input::placeholder { color: rgba(214,192,179,0.35); }
    .newsletter-form input:focus { border-color: var(--secondary); }
    .newsletter-form button {
      padding: 14px 28px;
      background: var(--secondary);
      color: white;
      border: none;
      font-size: 0.75rem;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      font-weight: 500;
      cursor: none;
      transition: background 0.3s ease;
      white-space: nowrap;
    }
    .newsletter-form button:hover { background: var(--accent); color: var(--primary); }

    /* ─── FEATURES ─── */
    .features {
      padding: 64px 8%;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 0;
      border-top: 1px solid rgba(171,136,109,0.2);
      border-bottom: 1px solid rgba(171,136,109,0.2);
    }
    .feature-item {
      padding: 32px 28px;
      display: flex; flex-direction: column; align-items: center;
      text-align: center;
      border-right: 1px solid rgba(171,136,109,0.2);
      transition: background 0.3s;
    }
    .feature-item:last-child { border-right: none; }
    .feature-item:hover { background: var(--cream); }
    .feature-icon {
      width: 44px; height: 44px;
      margin-bottom: 16px;
      color: var(--secondary);
    }
    .feature-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.05rem;
      font-weight: 500;
      color: var(--primary);
      margin-bottom: 6px;
    }
    .feature-text {
      font-size: 0.77rem;
      color: #7a6858;
      line-height: 1.65;
    }

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
      color: rgba(214,192,179,0.5);
      max-width: 280px;
      margin-bottom: 28px;
    }
    .social-links { display: flex; gap: 12px; }
    .social-link {
      width: 36px; height: 36px;
      border: 1px solid rgba(171,136,109,0.3);
      display: flex; align-items: center; justify-content: center;
      color: var(--accent);
      transition: all 0.3s;
      text-decoration: none;
      cursor: none;
    }
    .social-link:hover {
      background: var(--secondary);
      border-color: var(--secondary);
    }
    .social-link svg { width: 15px; height: 15px; }
    .footer-col-title {
      font-size: 0.7rem;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      font-weight: 500;
      color: var(--accent);
      margin-bottom: 22px;
    }
    .footer-links { list-style: none; display: flex; flex-direction: column; gap: 10px; }
    .footer-links a {
      font-size: 0.8rem;
      color: rgba(214,192,179,0.5);
      text-decoration: none;
      transition: color 0.3s, padding-left 0.3s;
      display: block;
    }
    .footer-links a:hover { color: var(--accent); padding-left: 6px; }
    .footer-bottom {
      border-top: 1px solid rgba(171,136,109,0.12);
      padding-top: 28px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .footer-copyright {
      font-size: 0.73rem;
      color: rgba(214,192,179,0.35);
      letter-spacing: 0.06em;
    }
    .footer-legal { display: flex; gap: 20px; }
    .footer-legal a {
      font-size: 0.73rem;
      color: rgba(214,192,179,0.35);
      text-decoration: none;
      transition: color 0.3s;
    }
    .footer-legal a:hover { color: var(--accent); }

    /* ─── MOBILE MENU OVERLAY ─── */
    .mobile-menu {
      position: fixed; inset: 0;
      background: var(--cream);
      z-index: 999;
      display: flex; flex-direction: column;
      padding: 80px 8% 48px;
      transform: translateX(100%);
      transition: transform 0.5s cubic-bezier(0.77, 0, 0.175, 1);
    }
    .mobile-menu.open { transform: translateX(0); }
    .mobile-menu a {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.4rem;
      font-weight: 300;
      color: var(--primary);
      text-decoration: none;
      padding: 14px 0;
      border-bottom: 1px solid rgba(171,136,109,0.15);
      display: block;
      transition: color 0.3s, padding-left 0.3s;
    }
    .mobile-menu a:hover { color: var(--secondary); padding-left: 12px; }

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
    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }
    .reveal-delay-4 { transition-delay: 0.4s; }

    /* ─── QUICK VIEW MODAL ─── */
    .modal-overlay {
      position: fixed; inset: 0;
      background: rgba(43,31,20,0.6);
      backdrop-filter: blur(4px);
      z-index: 2000;
      display: flex; align-items: center; justify-content: center;
      opacity: 0; pointer-events: none;
      transition: opacity 0.35s ease;
    }
    .modal-overlay.open { opacity: 1; pointer-events: all; }
    .modal-box {
      background: white;
      max-width: 800px;
      width: 90%;
      display: grid;
      grid-template-columns: 1fr 1fr;
      overflow: hidden;
      transform: scale(0.93) translateY(20px);
      transition: transform 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
      max-height: 90vh;
    }
    .modal-overlay.open .modal-box { transform: scale(1) translateY(0); }
    .modal-img { width: 100%; height: 100%; object-fit: cover; min-height: 360px; }
    .modal-content { padding: 40px 36px; overflow-y: auto; }
    .modal-close {
      position: absolute; top: 16px; right: 16px;
      width: 36px; height: 36px;
      background: var(--primary);
      border: none; cursor: none;
      display: flex; align-items: center; justify-content: center;
      color: white;
    }
    .size-btns { display: flex; gap: 8px; flex-wrap: wrap; margin: 12px 0; }
    .size-btn {
      width: 40px; height: 40px;
      border: 1px solid var(--accent);
      background: none;
      font-size: 0.75rem; font-weight: 500;
      color: var(--primary);
      cursor: none;
      transition: all 0.2s;
    }
    .size-btn.active, .size-btn:hover {
      background: var(--primary);
      color: white;
      border-color: var(--primary);
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 1024px) {
      .products-grid { grid-template-columns: repeat(3, 1fr); }
      .categories-grid { grid-template-columns: 1fr 1fr; grid-template-rows: auto; }
      .cat-card:first-child { grid-row: auto; }
      .footer-grid { grid-template-columns: 1fr 1fr; gap: 32px; }
    }
    @media (max-width: 768px) {
      .hero { grid-template-columns: 1fr; min-height: auto; }
      .hero-right { height: 55vw; }
      .hero-left { padding: 60px 6% 40px; }
      .hero-floating-card { display: none; }
      .nav-links, .nav-actions .nav-icon:not(.cart-wrap):not(.search-wrap) { display: none; }
      .mobile-menu-btn { display: flex; }
      .products-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
      .categories-grid { grid-template-columns: 1fr; grid-template-rows: auto; }
      .banner-inner { grid-template-columns: 1fr; }
      .banner-right { height: 260px; }
      .testimonials-grid { grid-template-columns: 1fr; }
      .features { grid-template-columns: repeat(2, 1fr); }
      .feature-item:nth-child(2) { border-right: none; }
      .feature-item:nth-child(3) { border-top: 1px solid rgba(171,136,109,0.2); }
      .footer-grid { grid-template-columns: 1fr; }
      .section { padding: 60px 5%; }
      .modal-box { grid-template-columns: 1fr; }
      .modal-img { min-height: 240px; height: 240px; }
    }
    @media (max-width: 480px) {
      .products-grid { grid-template-columns: 1fr; max-width: 320px; margin: 0 auto; }
      .newsletter-form { flex-direction: column; }
      .newsletter-form input { border-right: 1px solid rgba(171,136,109,0.35); border-bottom: none; }
      .footer-bottom { flex-direction: column; gap: 12px; text-align: center; }
    }
  </style>
</head>
<body>

  <!-- ─── CURSOR ─── -->
  <div class="cursor-dot" id="cursorDot"></div>
  <div class="cursor-ring" id="cursorRing"></div>

  <!-- ─── NAVBAR ─── -->
  <nav id="navbar">
    <a href="#" class="nav-logo">Maison</a>

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
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
          <circle cx="11" cy="11" r="7"/><path d="M16.5 16.5L22 22"/>
        </svg>
      </button>
      <!-- Account -->
      <button class="nav-icon" aria-label="Account">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
          <circle cx="12" cy="7" r="4"/><path d="M20 21a8 8 0 10-16 0"/>
        </svg>
      </button>
      <!-- Cart -->
      <button class="nav-icon cart-wrap relative" onclick="openModal()" aria-label="Cart">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
          <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/>
        </svg>
        <span class="cart-badge">3</span>
      </button>
      <!-- Hamburger -->
      <button class="mobile-menu-btn nav-icon items-center" onclick="toggleMobileMenu()" aria-label="Menu">
        <svg id="menuIcon" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
          <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
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
  <div id="searchBar" style="position:fixed;top:0;left:0;right:0;z-index:1100;background:var(--cream);padding:0 8%;height:72px;display:none;align-items:center;gap:16px;border-bottom:1px solid rgba(171,136,109,0.2);animation:slideDown 0.3s ease">
    <svg width="18" height="18" fill="none" stroke="var(--secondary)" stroke-width="1.6" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M16.5 16.5L22 22"/></svg>
    <input type="text" placeholder="Search for products, brands..." style="flex:1;border:none;background:none;font-family:'DM Sans',sans-serif;font-size:0.95rem;color:var(--primary);outline:none;" autofocus id="searchInput">
    <button onclick="toggleSearch()" style="cursor:none;border:none;background:none;font-size:0.8rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--secondary);">Close</button>
  </div>
  <style>@keyframes slideDown { from { transform:translateY(-100%); } to { transform:translateY(0); } }</style>

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

  <!-- ─── HERO ─── -->
  <section class="hero" id="hero">
    <div class="hero-left">
      <span class="hero-eyebrow" id="heroEyebrow">SS 2025 Collection</span>
      <h1 class="hero-headline reveal" id="heroHead">
        Wear <em>Your</em><br>Story With<br>Elegance
      </h1>
      <p class="hero-sub reveal reveal-delay-1">Discover curated pieces that blend timeless craftsmanship with modern sensibility. Every stitch tells a story.</p>
      <div class="hero-cta-group reveal reveal-delay-2">
        <a href="#" class="btn-primary"><span>Explore Collection</span></a>
        <a href="#" class="btn-ghost">
          Our Story
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path d="M5 12h14M13 6l6 6-6 6"/>
          </svg>
        </a>
      </div>

      <!-- Stats -->
      <div class="flex gap-8 mt-12 reveal reveal-delay-3">
        <div>
          <div class="font-display text-3xl" style="color:var(--primary);font-weight:500;">4.8k<span style="color:var(--secondary)">+</span></div>
          <div style="font-size:0.72rem;letter-spacing:0.12em;text-transform:uppercase;color:#7a6858;margin-top:3px;">Happy Clients</div>
        </div>
        <div style="width:1px;background:var(--accent)"></div>
        <div>
          <div class="font-display text-3xl" style="color:var(--primary);font-weight:500;">360<span style="color:var(--secondary)">+</span></div>
          <div style="font-size:0.72rem;letter-spacing:0.12em;text-transform:uppercase;color:#7a6858;margin-top:3px;">Products</div>
        </div>
        <div style="width:1px;background:var(--accent)"></div>
        <div>
          <div class="font-display text-3xl" style="color:var(--primary);font-weight:500;">12<span style="color:var(--secondary)">+</span></div>
          <div style="font-size:0.72rem;letter-spacing:0.12em;text-transform:uppercase;color:#7a6858;margin-top:3px;">Countries</div>
        </div>
      </div>
    </div>

    <div class="hero-right">
      <div class="hero-img-container">
        <img src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=900&q=80&auto=format" alt="Hero fashion" />
        <div class="hero-img-overlay"></div>
      </div>

      <!-- Floating product card -->
      <div class="hero-floating-card" id="heroCard">
        <div style="font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--secondary);margin-bottom:6px;">Trending Now</div>
        <div style="font-family:'Cormorant Garamond',serif;font-size:1rem;color:var(--primary);margin-bottom:4px;">Linen Wrap Dress</div>
        <div style="font-weight:500;font-size:0.9rem;color:var(--primary);">$189.00</div>
        <div style="display:flex;gap:2px;margin-top:6px">
          <span class="star">★★★★★</span>
        </div>
      </div>
    </div>

    <div class="hero-scroll-hint">
      <span>Scroll</span>
      <div class="scroll-line"></div>
    </div>
  </section>

  <!-- ─── MARQUEE ─── -->
  <div class="marquee-strip">
    <div class="marquee-inner">
      <span class="marquee-item">Sustainable Fashion <span class="dot"></span></span>
      <span class="marquee-item">Artisan Crafted <span class="dot"></span></span>
      <span class="marquee-item">Timeless Design <span class="dot"></span></span>
      <span class="marquee-item">Conscious Living <span class="dot"></span></span>
      <span class="marquee-item">Curated Selections <span class="dot"></span></span>
      <span class="marquee-item">Free Returns <span class="dot"></span></span>
      <span class="marquee-item">Sustainable Fashion <span class="dot"></span></span>
      <span class="marquee-item">Artisan Crafted <span class="dot"></span></span>
      <span class="marquee-item">Timeless Design <span class="dot"></span></span>
      <span class="marquee-item">Conscious Living <span class="dot"></span></span>
      <span class="marquee-item">Curated Selections <span class="dot"></span></span>
      <span class="marquee-item">Free Returns <span class="dot"></span></span>
    </div>
  </div>

  <!-- ─── CATEGORIES ─── -->
  <section class="section" id="categories">
    <div class="section-label reveal">Shop by Category</div>
    <div class="flex justify-between items-end">
      <h2 class="section-title reveal reveal-delay-1">Explore Our<br><em>Curated World</em></h2>
      <a href="#" class="btn-ghost reveal reveal-delay-2" style="margin-bottom:4px">
        All Categories
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
          <path d="M5 12h14M13 6l6 6-6 6"/>
        </svg>
      </a>
    </div>

    <div class="categories-grid reveal reveal-delay-1">
      <div class="cat-card">
        <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=700&q=80&auto=format" alt="Women" />
        <div class="cat-card-overlay">
          <div class="cat-name">Women's</div>
          <div class="cat-count">142 products</div>
          <div class="cat-arrow">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </div>
        </div>
      </div>
      <div class="cat-card">
        <img src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?w=600&q=80&auto=format" alt="Men" />
        <div class="cat-card-overlay">
          <div class="cat-name">Men's</div>
          <div class="cat-count">98 products</div>
          <div class="cat-arrow">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </div>
        </div>
      </div>
      <div class="cat-card">
        <img src="https://images.unsplash.com/photo-1484154218962-a197022b5858?w=600&q=80&auto=format" alt="Home" />
        <div class="cat-card-overlay">
          <div class="cat-name">Home & Living</div>
          <div class="cat-count">76 products</div>
          <div class="cat-arrow">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </div>
        </div>
      </div>
      <div class="cat-card">
        <img src="https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=600&q=80&auto=format" alt="Accessories" />
        <div class="cat-card-overlay">
          <div class="cat-name">Accessories</div>
          <div class="cat-count">54 products</div>
          <div class="cat-arrow">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ─── PRODUCTS ─── -->
  <section class="section" style="padding-top:0" id="products">
    <div class="products-header">
      <div>
        <div class="section-label reveal">Handpicked for You</div>
        <h2 class="section-title reveal reveal-delay-1">Featured <em>Products</em></h2>
      </div>
      <div class="product-filter reveal reveal-delay-2">
        <button class="filter-btn active" onclick="filterProducts(this,'all')">All</button>
        <button class="filter-btn" onclick="filterProducts(this,'new')">New In</button>
        <button class="filter-btn" onclick="filterProducts(this,'sale')">Sale</button>
        <button class="filter-btn" onclick="filterProducts(this,'trending')">Trending</button>
      </div>
    </div>

    <div class="products-grid" id="productsGrid">
      <!-- Product 1 -->
      <div class="product-card reveal" data-tag="new trending">
        <div class="product-img-wrap">
          <img src="https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?w=500&q=80&auto=format" alt="Silk Midi Dress" />
          <span class="product-badge">New</span>
          <div class="product-actions">
            <button class="add-cart-btn" onclick="addToCart(this)">Add to Cart</button>
            <button class="wishlist-btn">
              <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="product-info">
          <div class="product-brand">Maison Studio</div>
          <div class="product-name">Silk Midi Slip Dress</div>
          <div class="product-price-row">
            <span class="product-price">$245.00</span>
          </div>
          <div class="product-rating"><span class="star">★★★★★</span> <span style="font-size:0.72rem;color:#7a6858;margin-left:4px">(48)</span></div>
        </div>
      </div>

      <!-- Product 2 -->
      <div class="product-card reveal reveal-delay-1" data-tag="sale trending">
        <div class="product-img-wrap">
          <img src="https://images.unsplash.com/photo-1434389677669-e08b4cac3105?w=500&q=80&auto=format" alt="Linen Blazer" />
          <span class="product-badge sale">Sale</span>
          <div class="product-actions">
            <button class="add-cart-btn" onclick="addToCart(this)">Add to Cart</button>
            <button class="wishlist-btn">
              <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="product-info">
          <div class="product-brand">Artisan Co.</div>
          <div class="product-name">Relaxed Linen Blazer</div>
          <div class="product-price-row">
            <span class="product-price">$178.00</span>
            <span class="product-price-old">$249.00</span>
          </div>
          <div class="product-rating"><span class="star">★★★★</span><span class="star" style="color:#ddd">★</span> <span style="font-size:0.72rem;color:#7a6858;margin-left:4px">(31)</span></div>
        </div>
      </div>

      <!-- Product 3 -->
      <div class="product-card reveal reveal-delay-2" data-tag="new">
        <div class="product-img-wrap">
          <img src="https://images.unsplash.com/photo-1509631179647-0177331693ae?w=500&q=80&auto=format" alt="Cashmere Knit" />
          <span class="product-badge">New</span>
          <div class="product-actions">
            <button class="add-cart-btn" onclick="addToCart(this)">Add to Cart</button>
            <button class="wishlist-btn">
              <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="product-info">
          <div class="product-brand">Pure Knit</div>
          <div class="product-name">Cashmere Ribbed Sweater</div>
          <div class="product-price-row">
            <span class="product-price">$320.00</span>
          </div>
          <div class="product-rating"><span class="star">★★★★★</span> <span style="font-size:0.72rem;color:#7a6858;margin-left:4px">(22)</span></div>
        </div>
      </div>

      <!-- Product 4 -->
      <div class="product-card reveal reveal-delay-3" data-tag="trending sale">
        <div class="product-img-wrap">
          <img src="https://images.unsplash.com/photo-1585386959984-a4155224a1ad?w=500&q=80&auto=format" alt="Perfume" />
          <span class="product-badge sale">Sale</span>
          <div class="product-actions">
            <button class="add-cart-btn" onclick="addToCart(this)">Add to Cart</button>
            <button class="wishlist-btn">
              <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="product-info">
          <div class="product-brand">Essence Paris</div>
          <div class="product-name">Amber Rose Perfume EDP</div>
          <div class="product-price-row">
            <span class="product-price">$145.00</span>
            <span class="product-price-old">$195.00</span>
          </div>
          <div class="product-rating"><span class="star">★★★★★</span> <span style="font-size:0.72rem;color:#7a6858;margin-left:4px">(67)</span></div>
        </div>
      </div>

      <!-- Product 5 -->
      <div class="product-card reveal" data-tag="new trending">
        <div class="product-img-wrap">
          <img src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=500&q=80&auto=format" alt="Jacket" />
          <span class="product-badge">New</span>
          <div class="product-actions">
            <button class="add-cart-btn" onclick="addToCart(this)">Add to Cart</button>
            <button class="wishlist-btn">
              <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="product-info">
          <div class="product-brand">Maison Studio</div>
          <div class="product-name">Oversized Denim Jacket</div>
          <div class="product-price-row">
            <span class="product-price">$215.00</span>
          </div>
          <div class="product-rating"><span class="star">★★★★</span><span class="star" style="color:#ddd">★</span> <span style="font-size:0.72rem;color:#7a6858;margin-left:4px">(19)</span></div>
        </div>
      </div>

      <!-- Product 6 -->
      <div class="product-card reveal reveal-delay-1" data-tag="sale">
        <div class="product-img-wrap">
          <img src="https://images.unsplash.com/photo-1544966503-7cc5ac882d5f?w=500&q=80&auto=format" alt="Bag" />
          <span class="product-badge sale">Sale</span>
          <div class="product-actions">
            <button class="add-cart-btn" onclick="addToCart(this)">Add to Cart</button>
            <button class="wishlist-btn">
              <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="product-info">
          <div class="product-brand">Craft & Co.</div>
          <div class="product-name">Structured Leather Tote</div>
          <div class="product-price-row">
            <span class="product-price">$290.00</span>
            <span class="product-price-old">$380.00</span>
          </div>
          <div class="product-rating"><span class="star">★★★★★</span> <span style="font-size:0.72rem;color:#7a6858;margin-left:4px">(44)</span></div>
        </div>
      </div>

      <!-- Product 7 -->
      <div class="product-card reveal reveal-delay-2" data-tag="trending new">
        <div class="product-img-wrap">
          <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?w=500&q=80&auto=format" alt="Sneakers" />
          <span class="product-badge">New</span>
          <div class="product-actions">
            <button class="add-cart-btn" onclick="addToCart(this)">Add to Cart</button>
            <button class="wishlist-btn">
              <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="product-info">
          <div class="product-brand">Sole Studio</div>
          <div class="product-name">Classic Canvas Sneakers</div>
          <div class="product-price-row">
            <span class="product-price">$138.00</span>
          </div>
          <div class="product-rating"><span class="star">★★★★★</span> <span style="font-size:0.72rem;color:#7a6858;margin-left:4px">(89)</span></div>
        </div>
      </div>

      <!-- Product 8 -->
      <div class="product-card reveal reveal-delay-3" data-tag="trending">
        <div class="product-img-wrap">
          <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&q=80&auto=format" alt="Watch" />
          <div class="product-actions">
            <button class="add-cart-btn" onclick="addToCart(this)">Add to Cart</button>
            <button class="wishlist-btn">
              <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="product-info">
          <div class="product-brand">Tempo Atelier</div>
          <div class="product-name">Minimalist Leather Watch</div>
          <div class="product-price-row">
            <span class="product-price">$425.00</span>
          </div>
          <div class="product-rating"><span class="star">★★★★★</span> <span style="font-size:0.72rem;color:#7a6858;margin-left:4px">(103)</span></div>
        </div>
      </div>
    </div>

    <div style="text-align:center;margin-top:48px" class="reveal">
      <a href="#" class="btn-primary"><span>View All Products</span></a>
    </div>
  </section>

  <!-- ─── PROMO BANNER ─── -->
  <section class="banner-section">
    <div class="banner-inner reveal">
      <div class="banner-left">
        <div class="banner-eyebrow">Limited Time Offer</div>
        <h2 class="banner-title">Summer <em>Sale</em><br>Up to 40% Off</h2>
        <p class="banner-text">Refresh your wardrobe with our curated summer selection. Premium pieces at prices that let you shop more of what you love.</p>
        <a href="#" class="btn-light"><span>Shop the Sale</span></a>
        <div class="discount-chip">
          <span>40%</span>
          <span>Off</span>
        </div>
      </div>
      <div class="banner-right">
        <img src="https://images.unsplash.com/photo-1469334031218-e382a71b716b?w=800&q=80&auto=format" alt="Sale banner" />
        <div class="banner-deco"></div>
        <div class="banner-deco-2"></div>
      </div>
    </div>
  </section>

  <!-- ─── FLASH SALE COUNTDOWN ─── -->
  <section class="countdown-section">
    <div class="countdown-inner">
      <div class="countdown-left reveal">
        <div class="flash-badge">
          <span class="flash-dot"></span>
          Flash Sale Live Now
        </div>
        <h2 class="countdown-title">Ends in — Don't<br>Miss <em>These Deals</em></h2>
        <p class="countdown-sub">Hand-selected pieces at their lowest prices ever. Once the timer hits zero, so do the discounts.</p>
        <div class="countdown-timer">
          <div class="time-block">
            <span class="time-digits" id="cdDays">02</span>
            <span class="time-label">Days</span>
          </div>
          <span class="time-colon">:</span>
          <div class="time-block">
            <span class="time-digits" id="cdHours">14</span>
            <span class="time-label">Hours</span>
          </div>
          <span class="time-colon">:</span>
          <div class="time-block">
            <span class="time-digits" id="cdMins">37</span>
            <span class="time-label">Mins</span>
          </div>
          <span class="time-colon">:</span>
          <div class="time-block">
            <span class="time-digits" id="cdSecs">00</span>
            <span class="time-label">Secs</span>
          </div>
        </div>
        <div style="margin-top:32px">
          <a href="#" class="btn-light"><span>Shop Flash Deals</span></a>
        </div>
      </div>

      <div class="countdown-products reveal reveal-delay-2">
        <div class="countdown-product-row" onclick="addToCart(this)">
          <img class="cp-img" src="https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?w=120&q=80&auto=format" alt="Dress" />
          <div class="cp-info">
            <div class="cp-name">Silk Midi Slip Dress</div>
            <div class="cp-price">
              <span class="cp-price-old">$245</span>
              <span style="color:var(--accent);font-weight:600">$148</span>
            </div>
            <div class="cp-bar"><div class="cp-bar-fill" style="width:78%"></div></div>
            <div class="cp-sold">78% sold · 12 left</div>
          </div>
        </div>
        <div class="countdown-product-row" onclick="addToCart(this)">
          <img class="cp-img" src="https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=120&q=80&auto=format" alt="Bag" />
          <div class="cp-info">
            <div class="cp-name">Structured Leather Tote</div>
            <div class="cp-price">
              <span class="cp-price-old">$380</span>
              <span style="color:var(--accent);font-weight:600">$228</span>
            </div>
            <div class="cp-bar"><div class="cp-bar-fill" style="width:54%"></div></div>
            <div class="cp-sold">54% sold · 8 left</div>
          </div>
        </div>
        <div class="countdown-product-row" onclick="addToCart(this)">
          <img class="cp-img" src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=120&q=80&auto=format" alt="Watch" />
          <div class="cp-info">
            <div class="cp-name">Minimalist Leather Watch</div>
            <div class="cp-price">
              <span class="cp-price-old">$425</span>
              <span style="color:var(--accent);font-weight:600">$255</span>
            </div>
            <div class="cp-bar"><div class="cp-bar-fill" style="width:91%"></div></div>
            <div class="cp-sold">91% sold · 4 left</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ─── BRAND STORY ─── -->
  <section class="story-section">
    <div class="story-img-stack reveal">
      <img class="story-img-main" src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=700&q=80&auto=format" alt="Our Story" />
      <img class="story-img-accent" src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=500&q=80&auto=format" alt="Artisan" />
      <div class="story-year-badge">
        <div class="story-year">2012</div>
        <div class="story-year-label">Founded</div>
      </div>
    </div>
    <div class="story-right">
      <div class="section-label reveal">Our Heritage</div>
      <h2 class="section-title reveal reveal-delay-1">Where Every<br>Thread <em>Matters</em></h2>
      <p class="story-quote reveal reveal-delay-2">"We don't follow trends. We set the standard for what enduring style truly means."</p>
      <p class="story-body reveal reveal-delay-2">Founded in 2012 in the heart of Lyon, Maison began as a single atelier with a singular purpose: to create garments worthy of becoming heirlooms. Today, across 12 countries and with over 4,800 devoted clients, our philosophy remains unchanged — every piece must earn its place in your wardrobe forever.</p>
      <p class="story-body reveal reveal-delay-2">We partner exclusively with small-batch artisans who share our uncompromising standards. From the organic linen farms of Belgium to the silk weavers of Como, every material is chosen with intention.</p>

      <div class="story-values reveal reveal-delay-3">
        <div class="story-value-item">
          <div class="sv-icon">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          </div>
          <div>
            <div class="sv-label">Artisan Quality</div>
            <div class="sv-text">Every item hand-inspected before dispatch.</div>
          </div>
        </div>
        <div class="story-value-item">
          <div class="sv-icon">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/><path d="M9 12l2 2 4-4"/></svg>
          </div>
          <div>
            <div class="sv-label">Certified Sustainable</div>
            <div class="sv-text">Carbon-neutral since 2020.</div>
          </div>
        </div>
        <div class="story-value-item">
          <div class="sv-icon">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
          </div>
          <div>
            <div class="sv-label">Timeless Design</div>
            <div class="sv-text">Collections built to outlast every season.</div>
          </div>
        </div>
        <div class="story-value-item">
          <div class="sv-icon">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
          </div>
          <div>
            <div class="sv-label">Community First</div>
            <div class="sv-text">1% of revenue to artisan cooperatives.</div>
          </div>
        </div>
      </div>

      <a href="#" class="btn-primary reveal reveal-delay-3"><span>Read Our Full Story</span></a>
      <div class="story-signature reveal reveal-delay-4">Élise Moreau</div>
      <div class="story-sig-label reveal reveal-delay-4">Founder & Creative Director</div>
    </div>
  </section>

  <!-- ─── BEST SELLERS HORIZONTAL SCROLL ─── -->
  <section class="bestsellers-section">
    <div class="bestsellers-header">
      <div>
        <div class="section-label reveal">Community Picks</div>
        <h2 class="section-title reveal reveal-delay-1">Best <em>Sellers</em></h2>
      </div>
      <div style="display:flex;gap:8px;align-items:center" class="reveal reveal-delay-2">
        <button class="bs-nav-btn bs-prev-btn" onclick="scrollBs(-1)" aria-label="Previous">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        </button>
        <button class="bs-nav-btn bs-next-btn" onclick="scrollBs(1)" aria-label="Next">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
      </div>
    </div>
    <div class="bs-scroll-wrap">
      <div class="bs-track" id="bsTrack">
        <div class="bs-card reveal">
          <div style="position:relative;overflow:hidden;height:340px">
            <img class="bs-card-img" src="https://images.unsplash.com/photo-1434389677669-e08b4cac3105?w=500&q=80&auto=format" alt="Blazer" style="height:340px" />
            <span class="bs-rank">01</span>
          </div>
          <div class="bs-info">
            <div class="bs-brand">Artisan Co.</div>
            <div class="bs-name">Relaxed Linen Blazer</div>
            <div class="bs-foot">
              <div class="bs-price">$178.00</div>
              <button class="bs-add" onclick="addToCart(this)">
                <svg viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14"/></svg>
              </button>
            </div>
          </div>
        </div>
        <div class="bs-card reveal reveal-delay-1">
          <div style="position:relative;overflow:hidden;height:340px">
            <img class="bs-card-img" src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&q=80&auto=format" alt="Watch" style="height:340px" />
            <span class="bs-rank">02</span>
          </div>
          <div class="bs-info">
            <div class="bs-brand">Tempo Atelier</div>
            <div class="bs-name">Minimalist Leather Watch</div>
            <div class="bs-foot">
              <div class="bs-price">$425.00</div>
              <button class="bs-add" onclick="addToCart(this)">
                <svg viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14"/></svg>
              </button>
            </div>
          </div>
        </div>
        <div class="bs-card reveal reveal-delay-2">
          <div style="position:relative;overflow:hidden;height:340px">
            <img class="bs-card-img" src="https://images.unsplash.com/photo-1549298916-b41d501d3772?w=500&q=80&auto=format" alt="Sneakers" style="height:340px" />
            <span class="bs-rank">03</span>
          </div>
          <div class="bs-info">
            <div class="bs-brand">Sole Studio</div>
            <div class="bs-name">Classic Canvas Sneakers</div>
            <div class="bs-foot">
              <div class="bs-price">$138.00</div>
              <button class="bs-add" onclick="addToCart(this)">
                <svg viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14"/></svg>
              </button>
            </div>
          </div>
        </div>
        <div class="bs-card reveal reveal-delay-3">
          <div style="position:relative;overflow:hidden;height:340px">
            <img class="bs-card-img" src="https://images.unsplash.com/photo-1585386959984-a4155224a1ad?w=500&q=80&auto=format" alt="Perfume" style="height:340px" />
            <span class="bs-rank">04</span>
          </div>
          <div class="bs-info">
            <div class="bs-brand">Essence Paris</div>
            <div class="bs-name">Amber Rose EDP 75ml</div>
            <div class="bs-foot">
              <div class="bs-price">$145.00</div>
              <button class="bs-add" onclick="addToCart(this)">
                <svg viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14"/></svg>
              </button>
            </div>
          </div>
        </div>
        <div class="bs-card reveal reveal-delay-4">
          <div style="position:relative;overflow:hidden;height:340px">
            <img class="bs-card-img" src="https://images.unsplash.com/photo-1509631179647-0177331693ae?w=500&q=80&auto=format" alt="Sweater" style="height:340px" />
            <span class="bs-rank">05</span>
          </div>
          <div class="bs-info">
            <div class="bs-brand">Pure Knit</div>
            <div class="bs-name">Cashmere Ribbed Sweater</div>
            <div class="bs-foot">
              <div class="bs-price">$320.00</div>
              <button class="bs-add" onclick="addToCart(this)">
                <svg viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14"/></svg>
              </button>
            </div>
          </div>
        </div>
        <div class="bs-card">
          <div style="position:relative;overflow:hidden;height:340px">
            <img class="bs-card-img" src="https://images.unsplash.com/photo-1544966503-7cc5ac882d5f?w=500&q=80&auto=format" alt="Bag" style="height:340px" />
            <span class="bs-rank">06</span>
          </div>
          <div class="bs-info">
            <div class="bs-brand">Craft & Co.</div>
            <div class="bs-name">Mini Crossbody Bag</div>
            <div class="bs-foot">
              <div class="bs-price">$195.00</div>
              <button class="bs-add" onclick="addToCart(this)">
                <svg viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14"/></svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ─── LOOKBOOK / INSTAGRAM GRID ─── -->
  <section class="lookbook-section">
    <div style="display:flex;justify-content:space-between;align-items:flex-end">
      <div>
        <div class="section-label reveal">The Maison Life</div>
        <h2 class="section-title reveal reveal-delay-1">Shop the <em>Look</em></h2>
      </div>
      <a href="#" class="btn-ghost reveal reveal-delay-2">
        View Lookbook
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
    <div class="lookbook-grid">
      <div class="look-cell">
        <img class="look-img" src="https://images.unsplash.com/photo-1469334031218-e382a71b716b?w=800&q=80&auto=format" alt="Look 1" />
        <div class="look-overlay">
          <div class="look-icon">
            <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
          </div>
        </div>
        <div class="look-tag">Shop this look →</div>
      </div>
      <div class="look-cell">
        <img class="look-img" src="https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?w=500&q=80&auto=format" alt="Look 2" />
        <div class="look-overlay"><div class="look-icon"><svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg></div></div>
        <div class="look-tag">Silk Midi Dress ↗</div>
      </div>
      <div class="look-cell">
        <img class="look-img" src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=500&q=80&auto=format" alt="Look 3" />
        <div class="look-overlay"><div class="look-icon"><svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg></div></div>
        <div class="look-tag">Summer Edit ↗</div>
      </div>
      <div class="look-cell">
        <img class="look-img" src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?w=700&q=80&auto=format" alt="Look 4" />
        <div class="look-overlay"><div class="look-icon"><svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg></div></div>
        <div class="look-tag">Men's Edit ↗</div>
      </div>
      <div class="look-cell">
        <img class="look-img" src="https://images.unsplash.com/photo-1484154218962-a197022b5858?w=500&q=80&auto=format" alt="Look 5" />
        <div class="look-overlay"><div class="look-icon"><svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg></div></div>
        <div class="look-tag">Home Essentials ↗</div>
      </div>
    </div>
    <div class="look-insta-cta reveal">
      <div class="insta-handle">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/><circle cx="17.5" cy="6.5" r="0.5" fill="currentColor"/></svg>
        @maisonofficial
      </div>
      <div class="insta-sub">Tag your looks for a chance to be featured · 128k followers</div>
    </div>
  </section>

  <!-- ─── PRESS / AS SEEN IN ─── -->
  <section class="press-section">
    <div class="press-label reveal">As Seen In</div>
    <div class="press-logos">
      <div class="press-logo-item reveal"><span class="press-logo-text">Vogue</span></div>
      <div class="press-divider"></div>
      <div class="press-logo-item reveal reveal-delay-1"><span class="press-logo-text serif-italic">Harper's Bazaar</span></div>
      <div class="press-divider"></div>
      <div class="press-logo-item reveal reveal-delay-2"><span class="press-logo-text">Elle</span></div>
      <div class="press-divider"></div>
      <div class="press-logo-item reveal reveal-delay-3"><span class="press-logo-text serif-italic">Forbes</span></div>
      <div class="press-divider"></div>
      <div class="press-logo-item reveal reveal-delay-4"><span class="press-logo-text">Monocle</span></div>
      <div class="press-divider"></div>
      <div class="press-logo-item reveal"><span class="press-logo-text serif-italic">GQ</span></div>
    </div>
  </section>

  <!-- ─── LOYALTY / MEMBERSHIP ─── -->
  <section class="loyalty-section">
    <div class="loyalty-header">
      <div class="section-label reveal" style="justify-content:center">Rewards Program</div>
      <h2 class="section-title reveal reveal-delay-1" style="text-align:center">Join the <em>Maison Circle</em></h2>
      <p style="font-size:0.85rem;color:#7a6858;margin-top:14px;max-width:480px;margin-left:auto;margin-right:auto;line-height:1.75" class="reveal reveal-delay-2">Earn points with every purchase and unlock exclusive privileges crafted for our most devoted members.</p>
    </div>
    <div class="loyalty-grid">
      <!-- Silver -->
      <div class="loyalty-card reveal">
        <div class="loyalty-tier-badge badge-silver">Silver</div>
        <div class="loyalty-tier-name">Atelier</div>
        <div class="loyalty-spend">Spend up to $500 / year</div>
        <div class="loyalty-divider"></div>
        <ul class="loyalty-perks">
          <li class="loyalty-perk">
            <div class="perk-check"><svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg></div>
            1 point per $1 spent on all orders
          </li>
          <li class="loyalty-perk">
            <div class="perk-check"><svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg></div>
            Early access to sale events (24hrs ahead)
          </li>
          <li class="loyalty-perk">
            <div class="perk-check"><svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg></div>
            Free standard shipping on all orders
          </li>
          <li class="loyalty-perk">
            <div class="perk-check"><svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg></div>
            Birthday month 10% discount voucher
          </li>
        </ul>
        <a href="#" class="loyalty-btn loyalty-btn-outline">Join Free</a>
      </div>

      <!-- Gold — Featured -->
      <div class="loyalty-card featured reveal reveal-delay-1">
        <div class="loyalty-popular-tag">Most Popular</div>
        <div class="loyalty-tier-badge badge-gold">Gold</div>
        <div class="loyalty-tier-name">Maison</div>
        <div class="loyalty-spend">Spend $500–$2,000 / year</div>
        <div class="loyalty-divider"></div>
        <ul class="loyalty-perks">
          <li class="loyalty-perk">
            <div class="perk-check"><svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg></div>
            2× points on every purchase, always
          </li>
          <li class="loyalty-perk">
            <div class="perk-check"><svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg></div>
            48-hour early access to new collections
          </li>
          <li class="loyalty-perk">
            <div class="perk-check"><svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg></div>
            Free express shipping & gift wrapping
          </li>
          <li class="loyalty-perk">
            <div class="perk-check"><svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg></div>
            Dedicated style concierge by appointment
          </li>
          <li class="loyalty-perk">
            <div class="perk-check"><svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg></div>
            Invitations to exclusive member events
          </li>
        </ul>
        <a href="#" class="loyalty-btn loyalty-btn-filled">Upgrade Now</a>
      </div>

      <!-- Platinum -->
      <div class="loyalty-card reveal reveal-delay-2">
        <div class="loyalty-tier-badge badge-plat">Platinum</div>
        <div class="loyalty-tier-name">Prestige</div>
        <div class="loyalty-spend">Spend $2,000+ / year</div>
        <div class="loyalty-divider"></div>
        <ul class="loyalty-perks">
          <li class="loyalty-perk">
            <div class="perk-check"><svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg></div>
            3× points — maximum earning power
          </li>
          <li class="loyalty-perk">
            <div class="perk-check"><svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg></div>
            72-hour exclusive preview of new arrivals
          </li>
          <li class="loyalty-perk">
            <div class="perk-check"><svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg></div>
            Annual luxury gift & personalized styling
          </li>
          <li class="loyalty-perk">
            <div class="perk-check"><svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg></div>
            Private atelier visits & trunk shows
          </li>
          <li class="loyalty-perk">
            <div class="perk-check"><svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg></div>
            Complimentary monogramming on all orders
          </li>
        </ul>
        <a href="#" class="loyalty-btn loyalty-btn-outline">Learn More</a>
      </div>
    </div>
  </section>

  <!-- ─── RECENTLY VIEWED / RECOMMENDATIONS ─── -->
  <section class="reco-section">
    <div class="section-label reveal">You May Also Like</div>
    <h2 class="section-title reveal reveal-delay-1" style="margin-bottom:0">Picked <em>For You</em></h2>
    <div class="reco-strip">
      <div class="reco-chip">
        <img src="https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?w=120&q=80&auto=format" alt="" />
        <div><div class="reco-name">Silk Midi Slip Dress</div><div class="reco-price">$245.00</div></div>
      </div>
      <div class="reco-chip">
        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=120&q=80&auto=format" alt="" />
        <div><div class="reco-name">Minimalist Watch</div><div class="reco-price">$425.00</div></div>
      </div>
      <div class="reco-chip">
        <img src="https://images.unsplash.com/photo-1585386959984-a4155224a1ad?w=120&q=80&auto=format" alt="" />
        <div><div class="reco-name">Amber Rose EDP</div><div class="reco-price">$145.00</div></div>
      </div>
      <div class="reco-chip">
        <img src="https://images.unsplash.com/photo-1434389677669-e08b4cac3105?w=120&q=80&auto=format" alt="" />
        <div><div class="reco-name">Linen Blazer</div><div class="reco-price">$178.00</div></div>
      </div>
      <div class="reco-chip">
        <img src="https://images.unsplash.com/photo-1509631179647-0177331693ae?w=120&q=80&auto=format" alt="" />
        <div><div class="reco-name">Cashmere Sweater</div><div class="reco-price">$320.00</div></div>
      </div>
      <div class="reco-chip">
        <img src="https://images.unsplash.com/photo-1544966503-7cc5ac882d5f?w=120&q=80&auto=format" alt="" />
        <div><div class="reco-name">Leather Tote Bag</div><div class="reco-price">$290.00</div></div>
      </div>
      <div class="reco-chip">
        <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?w=120&q=80&auto=format" alt="" />
        <div><div class="reco-name">Canvas Sneakers</div><div class="reco-price">$138.00</div></div>
      </div>
    </div>
  </section>

  <!-- ─── EDITORIAL BLOG ─── -->
  <section class="blog-section">
    <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:0">
      <div>
        <div class="section-label reveal">The Maison Journal</div>
        <h2 class="section-title reveal reveal-delay-1">Style <em>Dispatches</em></h2>
      </div>
      <a href="#" class="btn-ghost reveal reveal-delay-2">
        All Articles
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
    <div class="blog-grid">
      <div class="blog-card reveal">
        <div class="blog-img-wrap">
          <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=800&q=80&auto=format" alt="Blog 1" />
        </div>
        <div class="blog-body">
          <div class="blog-cat">Style Guide</div>
          <div class="blog-title">How to Build a Capsule Wardrobe That Actually Works for Every Season</div>
          <p class="blog-excerpt">The art of owning less but wearing more. We break down the 12 essential pieces that form the foundation of a truly versatile, season-spanning wardrobe.</p>
          <div class="blog-meta">
            <span>May 2025 · 6 min read</span>
            <a href="#" class="blog-read-more">
              Read
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          </div>
        </div>
      </div>
      <div class="blog-card reveal reveal-delay-1">
        <div class="blog-img-wrap">
          <img src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=600&q=80&auto=format" alt="Blog 2" />
        </div>
        <div class="blog-body">
          <div class="blog-cat">Sustainability</div>
          <div class="blog-title">The Quiet Revolution in Slow Fashion</div>
          <p class="blog-excerpt">What does it truly mean to buy better? We visit the artisans behind our most beloved pieces.</p>
          <div class="blog-meta">
            <span>Apr 2025 · 4 min read</span>
            <a href="#" class="blog-read-more">
              Read
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          </div>
        </div>
      </div>
      <div class="blog-card reveal reveal-delay-2">
        <div class="blog-img-wrap">
          <img src="https://images.unsplash.com/photo-1484154218962-a197022b5858?w=600&q=80&auto=format" alt="Blog 3" />
        </div>
        <div class="blog-body">
          <div class="blog-cat">Home & Living</div>
          <div class="blog-title">Dressing Your Home: The Maison Edit</div>
          <p class="blog-excerpt">Our curators' top picks for creating interiors as considered and personal as your wardrobe.</p>
          <div class="blog-meta">
            <span>Mar 2025 · 3 min read</span>
            <a href="#" class="blog-read-more">
              Read
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ─── TESTIMONIALS ─── -->
  <section class="testimonials">
    <div style="text-align:center">
      <div class="section-label reveal" style="justify-content:center">What Clients Say</div>
      <h2 class="section-title reveal reveal-delay-1" style="text-align:center">Loved by <em>Thousands</em></h2>
    </div>
    <div class="testimonials-grid">
      <div class="testimonial-card reveal">
        <span class="quote-mark">"</span>
        <p class="testimonial-text">The quality of every piece I have received has been absolutely exceptional. Maison truly understands what modern elegance means.</p>
        <div class="testimonial-author">
          <div class="author-avatar">S</div>
          <div>
            <div class="author-name">Sophie Laurent</div>
            <div class="author-role">Interior Designer · Paris</div>
          </div>
        </div>
      </div>
      <div class="testimonial-card reveal reveal-delay-1">
        <span class="quote-mark">"</span>
        <p class="testimonial-text">I have never experienced packaging this beautiful. Every detail — from the tissue paper to the hand-written note — feels considered and personal.</p>
        <div class="testimonial-author">
          <div class="author-avatar">J</div>
          <div>
            <div class="author-name">James Whitfield</div>
            <div class="author-role">Creative Director · London</div>
          </div>
        </div>
      </div>
      <div class="testimonial-card reveal reveal-delay-2">
        <span class="quote-mark">"</span>
        <p class="testimonial-text">Their curation is unlike anything I have found elsewhere. Each season feels fresh yet coherent — I always find exactly what I was looking for.</p>
        <div class="testimonial-author">
          <div class="author-avatar">A</div>
          <div>
            <div class="author-name">Aiko Tanaka</div>
            <div class="author-role">Fashion Stylist · Tokyo</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ─── FEATURES ─── -->
  <div class="features">
    <div class="feature-item reveal">
      <svg class="feature-icon" fill="none" stroke="currentColor" stroke-width="1.4" viewBox="0 0 24 24">
        <path d="M5 12h14M12 5l7 7-7 7"/><circle cx="12" cy="12" r="10"/>
      </svg>
      <div class="feature-title">Free Delivery</div>
      <div class="feature-text">Complimentary shipping on all orders above $150 worldwide.</div>
    </div>
    <div class="feature-item reveal reveal-delay-1">
      <svg class="feature-icon" fill="none" stroke="currentColor" stroke-width="1.4" viewBox="0 0 24 24">
        <path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
      </svg>
      <div class="feature-title">Secure Payment</div>
      <div class="feature-text">All transactions are encrypted and fully protected.</div>
    </div>
    <div class="feature-item reveal reveal-delay-2">
      <svg class="feature-icon" fill="none" stroke="currentColor" stroke-width="1.4" viewBox="0 0 24 24">
        <path d="M16 11V7a4 4 0 00-8 0v4"/><rect x="4" y="11" width="16" height="11" rx="2"/>
        <path d="M12 17v-4"/>
      </svg>
      <div class="feature-title">Easy Returns</div>
      <div class="feature-text">Hassle-free 30-day returns on all full-price items.</div>
    </div>
    <div class="feature-item reveal reveal-delay-3">
      <svg class="feature-icon" fill="none" stroke="currentColor" stroke-width="1.4" viewBox="0 0 24 24">
        <path d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
      </svg>
      <div class="feature-title">24/7 Support</div>
      <div class="feature-text">Our team is always here to help you, any time of day.</div>
    </div>
  </div>

  <!-- ─── NEWSLETTER ─── -->
  <section class="newsletter">
    <div class="section-label reveal" style="justify-content:center;color:var(--secondary)">Stay Connected</div>
    <h2 class="newsletter-title reveal reveal-delay-1">The Maison <em style="font-style:italic">Edit</em></h2>
    <p class="newsletter-sub reveal reveal-delay-2">Be the first to know about new arrivals, exclusive offers,<br>and stories from the world of Maison.</p>
    <div class="newsletter-form reveal reveal-delay-3">
      <input type="email" placeholder="Enter your email address" id="emailInput" />
      <button onclick="subscribeNewsletter()">Subscribe</button>
    </div>
    <p style="font-size:0.68rem;color:rgba(214,192,179,0.3);margin-top:14px;letter-spacing:0.08em" class="reveal reveal-delay-4">No spam, ever. Unsubscribe at any time.</p>
  </section>

  <!-- ─── FOOTER ─── -->
  <footer>
    <div class="footer-grid">
      <div>
        <div class="footer-brand-name">Maison</div>
        <p class="footer-desc">Curated fashion and lifestyle for those who seek beauty in the details. From our atelier to your door.</p>
        <div class="social-links">
          <!-- Instagram -->
          <a href="#" class="social-link" aria-label="Instagram">
            <svg fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
              <rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/>
              <circle cx="17.5" cy="6.5" r="0.5" fill="currentColor"/>
            </svg>
          </a>
          <!-- Pinterest -->
          <a href="#" class="social-link" aria-label="Pinterest">
            <svg fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="10"/>
              <path d="M8 12c0-2.2 1.8-4 4-4s4 1.8 4 4c0 2.5-2 4-4 4l-1 4"/>
            </svg>
          </a>
          <!-- Twitter / X -->
          <a href="#" class="social-link" aria-label="Twitter">
            <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
              <path d="M23 3a10.9 10.9 0 01-3.14 1.53A4.48 4.48 0 0012 7.5v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>
            </svg>
          </a>
          <!-- TikTok -->
          <a href="#" class="social-link" aria-label="TikTok">
            <svg fill="currentColor" viewBox="0 0 24 24">
              <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.29 6.29 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.72a8.27 8.27 0 004.83 1.55V6.79a4.85 4.85 0 01-1.06-.1z"/>
            </svg>
          </a>
        </div>
      </div>

      <div>
        <div class="footer-col-title">Shop</div>
        <ul class="footer-links">
          <li><a href="#">New Arrivals</a></li>
          <li><a href="#">Women's</a></li>
          <li><a href="#">Men's</a></li>
          <li><a href="#">Accessories</a></li>
          <li><a href="#">Home & Living</a></li>
          <li><a href="#">Sale</a></li>
        </ul>
      </div>

      <div>
        <div class="footer-col-title">Company</div>
        <ul class="footer-links">
          <li><a href="#">Our Story</a></li>
          <li><a href="#">Sustainability</a></li>
          <li><a href="#">Artisans</a></li>
          <li><a href="#">Press & Media</a></li>
          <li><a href="#">Careers</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>

      <div>
        <div class="footer-col-title">Help</div>
        <ul class="footer-links">
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Shipping & Returns</a></li>
          <li><a href="#">Size Guide</a></li>
          <li><a href="#">Track Order</a></li>
          <li><a href="#">Gift Cards</a></li>
          <li><a href="#">Loyalty Program</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <p class="footer-copyright">© 2025 Maison. All rights reserved.</p>
      <div class="footer-legal">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Cookie Preferences</a>
      </div>
    </div>
  </footer>

  <!-- ─── QUICK VIEW MODAL ─── -->
  <div class="modal-overlay" id="modalOverlay" onclick="closeModal(event)">
    <div class="modal-box" style="position:relative">
      <button class="modal-close" onclick="closeModal()">
        <svg width="14" height="14" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg>
      </button>
      <img class="modal-img" src="https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?w=600&q=80&auto=format" alt="Product" />
      <div class="modal-content">
        <div style="font-size:0.67rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--secondary);margin-bottom:10px">Maison Studio</div>
        <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.8rem;font-weight:400;color:var(--primary);margin-bottom:10px">Silk Midi Slip Dress</h3>
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:18px">
          <span style="font-size:1.15rem;font-weight:500;color:var(--primary)">$245.00</span>
          <div style="display:flex;gap:2px"><span class="star">★★★★★</span></div>
          <span style="font-size:0.72rem;color:#7a6858">(48 reviews)</span>
        </div>
        <p style="font-size:0.82rem;line-height:1.8;color:#6b5c4e;margin-bottom:22px">Crafted from 100% pure silk, this elegant midi dress drapes beautifully and moves with you. A versatile piece for both day and evening.</p>
        <div style="font-size:0.72rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--primary);font-weight:500;margin-bottom:8px">Select Size</div>
        <div class="size-btns">
          <button class="size-btn" onclick="selectSize(this)">XS</button>
          <button class="size-btn active" onclick="selectSize(this)">S</button>
          <button class="size-btn" onclick="selectSize(this)">M</button>
          <button class="size-btn" onclick="selectSize(this)">L</button>
          <button class="size-btn" onclick="selectSize(this)">XL</button>
        </div>
        <div style="display:flex;gap:10px;margin-top:22px">
          <button class="add-cart-btn" style="flex:1;padding:14px;cursor:none" onclick="addToCart(this);closeModal()">Add to Cart</button>
          <button class="wishlist-btn" style="width:50px;cursor:none">
            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- ─── TOAST ─── -->
  <div id="toast" style="position:fixed;bottom:28px;right:28px;background:var(--primary);color:var(--accent);padding:14px 24px;font-size:0.78rem;letter-spacing:0.1em;text-transform:uppercase;font-weight:500;transform:translateY(80px);opacity:0;transition:all 0.4s cubic-bezier(0.25,0.46,0.45,0.94);z-index:9999;display:flex;align-items:center;gap:10px">
    <svg width="16" height="16" fill="none" stroke="var(--secondary)" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
    <span id="toastMsg">Added to cart</span>
  </div>

  <!-- ─── SCRIPTS ─── -->
  <script>
    // ── CURSOR
    const dot  = document.getElementById('cursorDot');
    const ring = document.getElementById('cursorRing');
    let mx = 0, my = 0, rx = 0, ry = 0;
    document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; });
    function animCursor() {
      dot.style.left  = mx + 'px';
      dot.style.top   = my + 'px';
      rx += (mx - rx) * 0.14;
      ry += (my - ry) * 0.14;
      ring.style.left = rx + 'px';
      ring.style.top  = ry + 'px';
      requestAnimationFrame(animCursor);
    }
    animCursor();
    document.querySelectorAll('a,button,[class*="cat-card"],[class*="product-card"]').forEach(el => {
      el.addEventListener('mouseenter', () => ring.classList.add('hovering'));
      el.addEventListener('mouseleave', () => ring.classList.remove('hovering'));
    });

    // ── NAVBAR SCROLL
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('scrolled', window.scrollY > 60);
    });

    // ── REVEAL ON SCROLL
    const reveals = document.querySelectorAll('.reveal');
    const revealObs = new IntersectionObserver((entries) => {
      entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); } });
    }, { threshold: 0.1 });
    reveals.forEach(r => revealObs.observe(r));

    // ── HERO ENTRANCE
    window.addEventListener('load', () => {
      const eyebrow = document.getElementById('heroEyebrow');
      setTimeout(() => {
        eyebrow.style.opacity = '1';
        eyebrow.style.transform = 'translateY(0)';
        eyebrow.style.transition = 'all 0.7s ease';
      }, 300);
      document.querySelectorAll('.hero .reveal').forEach((el, i) => {
        setTimeout(() => el.classList.add('visible'), 500 + i * 180);
      });
      const card = document.getElementById('heroCard');
      setTimeout(() => {
        card.style.opacity = '1';
        card.style.transform = 'translateX(0)';
        card.style.transition = 'all 0.7s cubic-bezier(0.25,0.46,0.45,0.94)';
      }, 1100);
    });

    // ── MOBILE MENU
    let menuOpen = false;
    function toggleMobileMenu() {
      menuOpen = !menuOpen;
      document.getElementById('mobileMenu').classList.toggle('open', menuOpen);
      document.body.style.overflow = menuOpen ? 'hidden' : '';
    }

    // ── SEARCH
    let searchOpen = false;
    function toggleSearch() {
      searchOpen = !searchOpen;
      const bar = document.getElementById('searchBar');
      bar.style.display = searchOpen ? 'flex' : 'none';
      if (searchOpen) document.getElementById('searchInput').focus();
    }

    // ── PRODUCT FILTER
    function filterProducts(btn, tag) {
      document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      document.querySelectorAll('.product-card').forEach(card => {
        if (tag === 'all' || (card.dataset.tag && card.dataset.tag.includes(tag))) {
          card.style.display = '';
          card.style.animation = 'fadeIn 0.4s ease';
        } else {
          card.style.display = 'none';
        }
      });
    }

    // ── CART / TOAST
    let cartCount = 3;
    function showToast(msg) {
      const toast = document.getElementById('toast');
      document.getElementById('toastMsg').textContent = msg;
      toast.style.transform = 'translateY(0)';
      toast.style.opacity = '1';
      setTimeout(() => {
        toast.style.transform = 'translateY(80px)';
        toast.style.opacity = '0';
      }, 2800);
    }
    function addToCart(btn) {
      cartCount++;
      document.querySelector('.cart-badge').textContent = cartCount;
      const badge = document.querySelector('.cart-badge');
      badge.style.transform = 'scale(1.4)';
      setTimeout(() => badge.style.transform = '', 300);
      showToast('Added to cart ✓');
    }

    // ── QUICK VIEW MODAL
    function openModal() {
      document.getElementById('modalOverlay').classList.add('open');
      document.body.style.overflow = 'hidden';
    }
    function closeModal(e) {
      if (!e || e.target === document.getElementById('modalOverlay') || e.currentTarget.tagName === 'BUTTON') {
        document.getElementById('modalOverlay').classList.remove('open');
        document.body.style.overflow = '';
      }
    }
    function selectSize(btn) {
      document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    }

    // ── NEWSLETTER
    function subscribeNewsletter() {
      const val = document.getElementById('emailInput').value.trim();
      if (val && val.includes('@')) {
        showToast('Subscribed! Welcome to Maison ✓');
        document.getElementById('emailInput').value = '';
      } else {
        showToast('Please enter a valid email');
      }
    }
    document.getElementById('emailInput').addEventListener('keydown', e => {
      if (e.key === 'Enter') subscribeNewsletter();
    });

    // ── PARALLAX HERO IMAGE
    window.addEventListener('scroll', () => {
      const hero = document.querySelector('.hero-img-container img');
      if (hero) {
        const sy = window.scrollY;
        hero.style.transform = `scale(1.08) translateY(${sy * 0.06}px)`;
      }
    });

    // ── COUNTDOWN TIMER
    function startCountdown() {
      const target = new Date();
      target.setDate(target.getDate() + 2);
      target.setHours(target.getHours() + 14, target.getMinutes() + 37, 0);

      function pad(n) { return String(n).padStart(2,'0'); }
      function flip(el, val) {
        const cur = el.textContent;
        if (cur !== val) {
          el.classList.add('flip');
          setTimeout(() => { el.textContent = val; el.classList.remove('flip'); }, 150);
        }
      }
      function tick() {
        const now = Date.now();
        let diff = Math.max(0, Math.floor((target - now) / 1000));
        const d = Math.floor(diff / 86400); diff -= d * 86400;
        const h = Math.floor(diff / 3600);  diff -= h * 3600;
        const m = Math.floor(diff / 60);    diff -= m * 60;
        const s = diff;
        flip(document.getElementById('cdDays'),  pad(d));
        flip(document.getElementById('cdHours'), pad(h));
        flip(document.getElementById('cdMins'),  pad(m));
        flip(document.getElementById('cdSecs'),  pad(s));
      }
      tick();
      setInterval(tick, 1000);
    }
    startCountdown();

    // ── BEST SELLERS DRAG SCROLL
    const bsTrack = document.getElementById('bsTrack');
    let isDown = false, startX, scrollLeft;
    bsTrack.addEventListener('mousedown', e => {
      isDown = true;
      bsTrack.style.cursor = 'grabbing';
      startX = e.pageX - bsTrack.offsetLeft;
      scrollLeft = bsTrack.scrollLeft;
    });
    bsTrack.addEventListener('mouseleave', () => { isDown = false; bsTrack.style.cursor = 'grab'; });
    bsTrack.addEventListener('mouseup',    () => { isDown = false; bsTrack.style.cursor = 'grab'; });
    bsTrack.addEventListener('mousemove', e => {
      if (!isDown) return;
      e.preventDefault();
      const x = e.pageX - bsTrack.offsetLeft;
      bsTrack.scrollLeft = scrollLeft - (x - startX) * 1.4;
    });

    function scrollBs(dir) {
      bsTrack.scrollBy({ left: dir * 304, behavior: 'smooth' });
    }

    // ── BAR ANIMATION ON SCROLL
    const barObs = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.querySelectorAll('.cp-bar-fill').forEach(bar => {
            const w = bar.style.width;
            bar.style.width = '0';
            setTimeout(() => { bar.style.width = w; }, 200);
          });
          barObs.unobserve(e.target);
        }
      });
    }, { threshold: 0.3 });
    document.querySelector('.countdown-section') && barObs.observe(document.querySelector('.countdown-section'));

    // ── COUNTER ANIMATION (stats)
    function animateCount(el, target, suffix='') {
      let start = 0;
      const step = target / 60;
      const timer = setInterval(() => {
        start = Math.min(start + step, target);
        el.textContent = Math.round(start) + suffix;
        if (start >= target) clearInterval(timer);
      }, 24);
    }
    const statObs = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          const hero = document.querySelector('.hero');
          if (hero) {
            const nums = hero.querySelectorAll('.font-display');
            if (nums[0]) animateCount(nums[0], 4800, '+');
            if (nums[1]) animateCount(nums[1], 360, '+');
            if (nums[2]) animateCount(nums[2], 12, '+');
          }
          statObs.disconnect();
        }
      });
    }, { threshold: 0.6 });
    const heroStats = document.querySelector('.hero .font-display');
    if (heroStats) statObs.observe(heroStats.closest('.flex') || heroStats);

    // ── LOOKBOOK CELLS STAGGER
    const lookCells = document.querySelectorAll('.look-cell');
    const lookObs = new IntersectionObserver(entries => {
      entries.forEach((e, i) => {
        if (e.isIntersecting) {
          setTimeout(() => {
            e.target.style.opacity = '1';
            e.target.style.transform = 'translateY(0)';
          }, i * 80);
          lookObs.unobserve(e.target);
        }
      });
    }, { threshold: 0.1 });
    lookCells.forEach((c, i) => {
      c.style.opacity = '0';
      c.style.transform = 'translateY(24px)';
      c.style.transition = `opacity 0.55s ease ${i*0.07}s, transform 0.55s ease ${i*0.07}s`;
      lookObs.observe(c);
    });

    // ── LOYALTY CARD HOVER GLOW
    document.querySelectorAll('.loyalty-card').forEach(card => {
      card.addEventListener('mousemove', e => {
        const rect = card.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width * 100).toFixed(1);
        const y = ((e.clientY - rect.top)  / rect.height * 100).toFixed(1);
        card.style.background = card.classList.contains('featured')
          ? `radial-gradient(circle at ${x}% ${y}%, #5c4030, var(--primary))`
          : `radial-gradient(circle at ${x}% ${y}%, rgba(171,136,109,0.07), white)`;
      });
      card.addEventListener('mouseleave', () => {
        card.style.background = card.classList.contains('featured') ? '' : 'white';
      });
    });

    // ── BLOG CARD PARALLAX IMAGES
    window.addEventListener('scroll', () => {
      document.querySelectorAll('.blog-img-wrap img').forEach(img => {
        const rect = img.closest('.blog-card').getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) {
          const pct = (window.innerHeight - rect.top) / (window.innerHeight + rect.height);
          img.style.transform = `scale(1.05) translateY(${(pct - 0.5) * -20}px)`;
        }
      });
    });

    // ── FLIP ANIMATION + FADE-IN keyframes
    const extraStyles = document.createElement('style');
    extraStyles.textContent = `
      @keyframes fadeIn { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }
      @keyframes flipDigit {
        0%   { transform: rotateX(0deg);   opacity: 1; }
        49%  { transform: rotateX(-90deg); opacity: 0; }
        50%  { transform: rotateX(90deg);  opacity: 0; }
        100% { transform: rotateX(0deg);   opacity: 1; }
      }
      .time-digits.flip { animation: flipDigit 0.38s cubic-bezier(0.4,0,0.2,1); }
      .reco-strip { scroll-behavior: smooth; }
    `;
    document.head.appendChild(extraStyles);

    // ── SMOOTH PROGRESS BARS ON SCROLL
    const progressObs = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.querySelectorAll('.cp-bar-fill').forEach(bar => {
            const target = bar.getAttribute('data-width') || bar.style.width;
            bar.setAttribute('data-width', target);
            bar.style.width = '0';
            requestAnimationFrame(() => {
              setTimeout(() => { bar.style.width = target; }, 200);
            });
          });
        }
      });
    }, { threshold: 0.4 });
    document.querySelectorAll('.countdown-product-row').forEach(row => progressObs.observe(row));

    // ── RECO CHIP CLICK
    document.querySelectorAll('.reco-chip').forEach(chip => {
      chip.addEventListener('click', () => addToCart(chip));
    });
  </script>
</body>
</html>
