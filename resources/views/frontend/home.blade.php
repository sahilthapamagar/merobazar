  <x-layout>
      <style>
          /* ─── HOME PAGE SHELL ─── */
          .home-page {
              width: 100%;
              max-width: 100%;
              overflow-x: hidden;
          }

          .hero-stats {
              display: flex;
              flex-wrap: wrap;
              align-items: center;
              gap: 2rem;
              margin-top: 3rem;
          }

          .hero-stat-divider {
              width: 1px;
              background: var(--accent);
              align-self: stretch;
          }

          .hero-stat-value {
              font-family: 'Cormorant Garamond', serif;
              font-size: 1.875rem;
              font-weight: 500;
              color: var(--primary);
          }

          .hero-stat-value span {
              color: var(--secondary);
          }

          .hero-stat-label {
              font-size: 0.72rem;
              letter-spacing: 0.12em;
              text-transform: uppercase;
              color: #7a6858;
              margin-top: 3px;
          }

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

          .hero-cta-group {
              display: flex;
              gap: 16px;
              align-items: center;
          }

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
              position: absolute;
              inset: 0;
              background: var(--secondary);
              transform: translateX(-101%);
              transition: transform 0.4s cubic-bezier(0.77, 0, 0.175, 1);
          }

          .btn-primary:hover::before {
              transform: translateX(0);
          }

          .btn-primary span {
              position: relative;
              z-index: 1;
          }

          .btn-ghost {
              color: var(--primary);
              font-size: 0.78rem;
              letter-spacing: 0.1em;
              text-transform: uppercase;
              font-weight: 500;
              text-decoration: none;
              display: flex;
              align-items: center;
              gap: 8px;
              transition: gap 0.3s ease;
          }

          .btn-ghost:hover {
              gap: 14px;
          }

          .hero-right {
              position: relative;
              overflow: hidden;
          }

          .hero-img-container {
              width: 100%;
              height: 100%;
              position: relative;
          }

          .hero-img-container img {
              width: 100%;
              height: 100%;
              object-fit: cover;
              transform: scale(1.08);
              transition: transform 8s ease;
          }

          .hero-img-container:hover img {
              transform: scale(1.0);
          }

          .hero-img-overlay {
              position: absolute;
              inset: 0;
              background: linear-gradient(135deg, rgba(73, 54, 40, 0.12) 0%, transparent 60%);
          }

          .hero-floating-card {
              position: absolute;
              bottom: 10%;
              left: -40px;
              background: white;
              padding: 18px 24px;
              box-shadow: 0 20px 60px rgba(73, 54, 40, 0.15);
              min-width: 200px;
              opacity: 0;
              transform: translateX(-20px);
          }

          .hero-scroll-hint {
              position: absolute;
              bottom: 32px;
              left: 50%;
              transform: translateX(-50%);
              display: flex;
              flex-direction: column;
              align-items: center;
              gap: 8px;
              font-size: 0.68rem;
              letter-spacing: 0.2em;
              text-transform: uppercase;
              color: var(--secondary);
              animation: float 2.5s ease-in-out infinite;
          }

          .scroll-line {
              width: 1px;
              height: 40px;
              background: linear-gradient(to bottom, var(--secondary), transparent);
              animation: growLine 2.5s ease-in-out infinite;
          }

          @keyframes float {

              0%,
              100% {
                  transform: translateX(-50%) translateY(0);
              }

              50% {
                  transform: translateX(-50%) translateY(-6px);
              }
          }

          @keyframes growLine {

              0%,
              100% {
                  transform: scaleY(0.5);
              }

              50% {
                  transform: scaleY(1);
              }
          }

          /* ─── HERO SLIDESHOW ─── */
          .hero-slides {
              position: absolute;
              inset: 0;
              grid-column: 1 / -1;
          }

          .hero-slide {
              position: absolute;
              inset: 0;
              display: grid;
              grid-template-columns: 1fr 1fr;
              opacity: 0;
              visibility: hidden;
              pointer-events: none;
              transition: opacity 0.9s ease, visibility 0.9s ease;
          }

          .hero-slide.active {
              opacity: 1;
              visibility: visible;
              pointer-events: auto;
              z-index: 2;
          }

          .hero-slide .hero-left {
              transition: opacity 0.8s ease, transform 0.8s ease;
              opacity: 0;
              transform: translateY(24px);
          }

          .hero-slide.active .hero-left {
              opacity: 1;
              transform: translateY(0);
          }

          .hero-slide .hero-img-container img {
              transform: scale(1.15);
              opacity: 0;
              transition: transform 7s ease, opacity 1.2s ease;
          }

          .hero-slide.active .hero-img-container img {
              opacity: 1;
              transform: scale(1.08);
          }

          .hero-slide.active .hero-img-container:hover img {
              transform: scale(1.0);
          }

          .hero-slide .hero-eyebrow,
          .hero-slide .hero-headline,
          .hero-slide .hero-sub,
          .hero-slide .hero-cta-group,
          .hero-slide .hero-stats {
              opacity: 0;
              transform: translateY(20px);
          }

          .hero-slide.active .hero-eyebrow {
              opacity: 1;
              transform: translateY(0);
              transition: all 0.7s ease 0.15s;
          }

          .hero-slide.active .hero-headline {
              opacity: 1;
              transform: translateY(0);
              transition: all 0.7s ease 0.3s;
          }

          .hero-slide.active .hero-sub {
              opacity: 1;
              transform: translateY(0);
              transition: all 0.7s ease 0.45s;
          }

          .hero-slide.active .hero-cta-group {
              opacity: 1;
              transform: translateY(0);
              transition: all 0.7s ease 0.6s;
          }

          .hero-slide.active .hero-stats {
              opacity: 1;
              transform: translateY(0);
              transition: all 0.7s ease 0.75s;
          }

          .hero-arrow {
              position: absolute;
              top: 50%;
              transform: translateY(-50%);
              z-index: 20;
              width: 44px;
              height: 44px;
              border: 1px solid rgba(171, 136, 109, 0.5);
              background: rgba(255, 255, 255, 0.7);
              backdrop-filter: blur(6px);
              color: var(--primary);
              display: flex;
              align-items: center;
              justify-content: center;
              cursor: pointer;
              transition: all 0.3s ease;
          }

          .hero-arrow:hover {
              background: var(--primary);
              color: var(--accent);
          }

          .hero-arrow.prev {
              left: 20px;
          }

          .hero-arrow.next {
              right: 20px;
          }

          .hero-dots {
              position: absolute;
              bottom: 28px;
              left: 50%;
              transform: translateX(-50%);
              display: flex;
              gap: 10px;
              z-index: 20;
          }

          .hero-dot {
              width: 8px;
              height: 8px;
              border-radius: 50%;
              border: none;
              background: rgba(73, 54, 40, 0.25);
              cursor: pointer;
              padding: 0;
              transition: all 0.3s ease;
          }

          .hero-dot.active {
              width: 28px;
              border-radius: 6px;
              background: var(--secondary);
          }

          @media (max-width: 768px) {
              .hero-slide {
                  grid-template-columns: 1fr;
              }

              .hero-arrow {
                  width: 36px;
                  height: 36px;
              }

              .hero-arrow.prev {
                  left: 10px;
              }

              .hero-arrow.next {
                  right: 10px;
              }

              .hero-dots {
                  bottom: 12px;
              }
          }

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

          @keyframes marquee {
              from {
                  transform: translateX(0);
              }

              to {
                  transform: translateX(-50%);
              }
          }

          .marquee-item {
              font-family: 'Cormorant Garamond', serif;
              font-size: 1.3rem;
              font-weight: 300;
              letter-spacing: 0.08em;
              color: var(--accent);
              display: flex;
              align-items: center;
              gap: 16px;
          }

          .marquee-item .dot {
              width: 5px;
              height: 5px;
              background: var(--secondary);
              border-radius: 50%;
          }

          /* ─── SECTION LAYOUT ─── */
          .section {
              padding: 100px 8%;
          }

          .section-label {
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

          .section-label::before {
              content: '';
              display: inline-block;
              width: 28px;
              height: 1px;
              background: var(--secondary);
          }

          .section-title {
              font-family: 'Cormorant Garamond', serif;
              font-size: clamp(2rem, 4vw, 3.4rem);
              font-weight: 300;
              line-height: 1.15;
              color: var(--primary);
          }

          .section-title em {
              font-style: italic;
          }

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

          .cat-card:first-child {
              grid-row: 1 / 3;
          }

          .cat-card img {
              width: 100%;
              height: 100%;
              object-fit: cover;
              transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
          }

          .cat-card:hover img {
              transform: scale(1.06);
          }

          .cat-card-overlay {
              position: absolute;
              inset: 0;
              background: linear-gradient(to top, rgba(43, 31, 20, 0.75) 0%, transparent 55%);
              display: flex;
              flex-direction: column;
              justify-content: flex-end;
              padding: 28px;
              transition: background 0.4s ease;
          }

          .cat-card:hover .cat-card-overlay {
              background: linear-gradient(to top, rgba(43, 31, 20, 0.85) 0%, rgba(43, 31, 20, 0.1) 70%);
          }

          .cat-name {
              font-family: 'Cormorant Garamond', serif;
              font-size: 1.5rem;
              font-weight: 400;
              color: white;
              margin-bottom: 6px;
          }

          .cat-count {
              font-size: 0.72rem;
              color: var(--accent);
              letter-spacing: 0.12em;
          }

          .cat-arrow {
              position: absolute;
              bottom: 28px;
              right: 28px;
              width: 38px;
              height: 38px;
              border: 1px solid rgba(255, 255, 255, 0.4);
              border-radius: 50%;
              display: flex;
              align-items: center;
              justify-content: center;
              color: white;
              transform: scale(0);
              transition: transform 0.3s ease, background 0.3s ease;
          }

          .cat-card:hover .cat-arrow {
              transform: scale(1);
          }

          .cat-card:hover .cat-arrow {
              background: var(--secondary);
              border-color: var(--secondary);
          }

          /* ─── PRODUCTS ─── */
          .products-header {
              display: flex;
              justify-content: space-between;
              align-items: flex-end;
              margin-bottom: 48px;
          }

          .product-filter {
              display: flex;
              gap: 6px;
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

          .filter-btn.active,
          .filter-btn:hover {
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
              width: 100%;
              height: 100%;
              object-fit: cover;
              transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
          }

          .product-card:hover .product-img-wrap img {
              transform: scale(1.05);
          }

          .product-badge {
              position: absolute;
              top: 14px;
              left: 14px;
              background: var(--primary);
              color: var(--accent);
              padding: 4px 10px;
              font-size: 0.65rem;
              letter-spacing: 0.12em;
              text-transform: uppercase;
              font-weight: 500;
          }

          .product-badge.sale {
              background: #8B4513;
          }

          .product-actions {
              position: absolute;
              bottom: -60px;
              left: 0;
              right: 0;
              display: flex;
              padding: 0 16px 16px;
              gap: 8px;
              transition: bottom 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
          }

          .product-card:hover .product-actions {
              bottom: 0;
          }

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

          .add-cart-btn:hover {
              background: var(--secondary);
          }

          .wishlist-btn {
              width: 42px;
              background: white;
              border: 1px solid var(--accent);
              display: flex;
              align-items: center;
              justify-content: center;
              cursor: none;
              transition: all 0.3s;
              flex-shrink: 0;
          }

          .wishlist-btn:hover {
              background: var(--accent);
          }

          .wishlist-btn svg {
              width: 16px;
              height: 16px;
          }

          .product-info {
              padding: 18px 18px 20px;
          }

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

          .product-price-row {
              display: flex;
              align-items: center;
              gap: 10px;
          }

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
              display: flex;
              gap: 2px;
              margin-top: 8px;
          }

          .star {
              color: rgba(171, 136, 109, 0.35);
              font-size: 0.75rem;
          }

          .star.is-fill {
              color: #c29b40;
          }

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

          .banner-title em {
              font-style: italic;
              color: var(--secondary);
          }

          .banner-text {
              font-size: 0.85rem;
              line-height: 1.9;
              color: rgba(214, 192, 179, 0.7);
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
              position: absolute;
              inset: 0;
              background: var(--secondary);
              transform: translateX(-101%);
              transition: transform 0.4s cubic-bezier(0.77, 0, 0.175, 1);
          }

          .btn-light:hover::before {
              transform: translateX(0);
          }

          .btn-light:hover {
              border-color: var(--secondary);
              color: var(--primary);
          }

          .btn-light span {
              position: relative;
              z-index: 1;
          }

          .banner-right {
              position: relative;
              overflow: hidden;
          }

          .banner-right img {
              width: 100%;
              height: 100%;
              object-fit: cover;
              opacity: 0.6;
              mix-blend-mode: luminosity;
              transition: opacity 0.4s ease;
          }

          .banner-inner:hover .banner-right img {
              opacity: 0.8;
          }

          .banner-deco {
              position: absolute;
              right: -60px;
              bottom: -60px;
              width: 320px;
              height: 320px;
              border: 1px solid rgba(171, 136, 109, 0.15);
              border-radius: 50%;
          }

          .banner-deco-2 {
              position: absolute;
              right: -20px;
              bottom: -20px;
              width: 200px;
              height: 200px;
              border: 1px solid rgba(171, 136, 109, 0.25);
              border-radius: 50%;
          }

          .discount-chip {
              position: absolute;
              top: 40px;
              right: 40px;
              width: 90px;
              height: 90px;
              background: var(--secondary);
              border-radius: 50%;
              display: flex;
              flex-direction: column;
              align-items: center;
              justify-content: center;
              animation: spin-slow 12s linear infinite;
          }

          .discount-chip span:first-child {
              font-size: 1.4rem;
              font-weight: 700;
              color: white;
              line-height: 1;
          }

          .discount-chip span:last-child {
              font-size: 0.6rem;
              letter-spacing: 0.1em;
              color: rgba(255, 255, 255, 0.8);
              text-transform: uppercase;
          }

          @keyframes spin-slow {
              from {
                  transform: rotate(0);
              }

              to {
                  transform: rotate(360deg);
              }
          }

          /* ─── FLASH SALE COUNTDOWN ─── */
          .countdown-section {
              background: linear-gradient(135deg, #3a2a1c 0%, var(--primary) 50%, #5c4030 100%);
              padding: 72px 8%;
              position: relative;
              overflow: hidden;
          }

          .countdown-section::after {
              content: '';
              position: absolute;
              inset: 0;
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

          .countdown-left {}

          .flash-badge {
              display: inline-flex;
              align-items: center;
              gap: 8px;
              background: rgba(171, 136, 109, 0.2);
              border: 1px solid rgba(171, 136, 109, 0.35);
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
              width: 7px;
              height: 7px;
              background: #ef4444;
              border-radius: 50%;
              animation: pulse-red 1.4s ease-in-out infinite;
          }

          @keyframes pulse-red {

              0%,
              100% {
                  box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.5);
              }

              50% {
                  box-shadow: 0 0 0 6px rgba(239, 68, 68, 0);
              }
          }

          .countdown-title {
              font-family: 'Cormorant Garamond', serif;
              font-size: clamp(2rem, 3.8vw, 3.2rem);
              font-weight: 300;
              color: var(--accent);
              line-height: 1.15;
              margin-bottom: 10px;
          }

          .countdown-title em {
              font-style: italic;
              color: var(--secondary);
          }

          .countdown-sub {
              font-size: 0.82rem;
              color: rgba(214, 192, 179, 0.55);
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
              background: rgba(255, 255, 255, 0.05);
              border: 1px solid rgba(171, 136, 109, 0.2);
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

          @keyframes blink {

              0%,
              100% {
                  opacity: 0.6;
              }

              50% {
                  opacity: 0;
              }
          }

          .countdown-products {
              display: flex;
              flex-direction: column;
              gap: 12px;
          }

          .countdown-product-row {
              display: flex;
              align-items: center;
              gap: 14px;
              background: rgba(255, 255, 255, 0.05);
              border: 1px solid rgba(171, 136, 109, 0.15);
              padding: 12px 16px;
              min-width: 300px;
              transition: background 0.3s;
              cursor: none;
          }

          .countdown-product-row:hover {
              background: rgba(255, 255, 255, 0.09);
          }

          .cp-img {
              width: 52px;
              height: 52px;
              object-fit: cover;
              flex-shrink: 0;
          }

          .cp-info {
              flex: 1;
          }

          .cp-name {
              font-size: 0.82rem;
              color: var(--accent);
              font-weight: 500;
              margin-bottom: 3px;
          }

          .cp-price {
              font-size: 0.75rem;
              color: var(--secondary);
          }

          .cp-price-old {
              text-decoration: line-through;
              opacity: 0.5;
              margin-right: 6px;
          }

          .cp-bar {
              height: 3px;
              background: rgba(255, 255, 255, 0.08);
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

          .cp-sold {
              font-size: 0.64rem;
              color: rgba(214, 192, 179, 0.4);
              margin-top: 3px;
          }



          /* ─── seller / MEMBERSHIP ─── */
          .seller-contact-section {
              width: 100%;
              padding: 80px 1.5rem;
              text-align: center;
              display: flex;
              flex-direction: column;
              align-items: center;
          }

          .seller-contact-inner {
              width: 100%;
              max-width: 42rem;
              margin-left: auto;
              margin-right: auto;
              display: flex;
              flex-direction: column;
              align-items: center;
          }

          .seller-contact-header {
              width: 100%;
              text-align: center;
              margin-bottom: 2.5rem;
          }

          .seller-contact-sub {
              font-size: 0.875rem;
              font-weight: 300;
              margin-top: 0.75rem;
              max-width: 20rem;
              margin-left: auto;
              margin-right: auto;
              line-height: 1.625;
              color: var(--secondary);
          }

          .seller-contact-form {
              display: flex;
              flex-direction: column;
              gap: 1.25rem;
          }

          .seller-contact-form-row {
              display: grid;
              grid-template-columns: 1fr 1fr;
              gap: 1.25rem;
          }

          @media (max-width: 767px) {
              .seller-contact-form-row {
                  grid-template-columns: 1fr;
              }
          }

          .seller-contact-card {
              width: 100%;
              padding: 2rem 1.5rem;
              position: relative;
              border-radius: 1rem;
              box-shadow: 0 20px 25px -5px rgba(73, 54, 40, 0.08), 0 8px 10px -6px rgba(73, 54, 40, 0.06);
              background: var(--cream);
              border: 1px solid var(--accent);
          }

          .seller-contact-card-title {
              font-size: 0.75rem;
              font-family: 'DM Sans', sans-serif;
              font-weight: 500;
              text-transform: uppercase;
              letter-spacing: 0.1em;
              text-align: center;
              margin-bottom: 1.5rem;
              color: var(--secondary);
          }

          .seller-contact-footer {
              text-align: center;
              font-size: 0.75rem;
              margin-top: 1.5rem;
              color: var(--secondary);
          }

          .input-group {
              position: relative;
          }

          .input-group input,
          .input-group textarea {
              transition: border-color 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
          }

          .input-group label {
              position: absolute;
              left: 1rem;
              top: 50%;
              transform: translateY(-50%);
              font-size: 0.875rem;
              color: var(--secondary);
              pointer-events: none;
              transition: all 0.25s cubic-bezier(.4, 0, .2, 1);
              background: transparent;
              padding: 0 0.25rem;
          }

          .input-group.textarea-group label {
              top: 1.1rem;
              transform: none;
          }

          .input-group input:focus~label,
          .input-group input:not(:placeholder-shown)~label,
          .input-group textarea:focus~label,
          .input-group textarea:not(:placeholder-shown)~label {
              top: -0.55rem;
              font-size: 0.72rem;
              color: var(--primary);
              background: var(--cream);
              font-weight: 500;
              letter-spacing: 0.04em;
          }

          /* Input focus ring */
          .custom-input:focus {
              outline: none;
              border-color: var(--secondary);
              box-shadow: 0 0 0 3px rgba(171, 136, 109, 0.18);
              background: #fff;
          }

          .custom-input {
              border: 1.5px solid var(--accent);
              background: var(--cream);
              color: var(--dark);
              border-radius: 0.625rem;
              width: 100%;
              padding: 0.85rem 1rem;
              font-family: 'DM Sans', sans-serif;
              font-size: 0.95rem;
              transition: border-color 0.3s, box-shadow 0.3s, background 0.3s;
          }

          .custom-input::placeholder {
              color: transparent;
          }

          .custom-input:hover {
              border-color: var(--secondary);
          }

          /* Icon pulse on focus */
          .input-group:focus-within .icon-wrap {
              color: var(--primary);
              transform: scale(1.15);
          }

          .icon-wrap {
              position: absolute;
              right: 0.9rem;
              top: 50%;
              transform: translateY(-50%);
              color: var(--secondary);
              transition: color 0.25s, transform 0.25s;
              pointer-events: none;
          }

          .textarea-group .icon-wrap {
              top: 1.05rem;
              transform: none;
          }

          .textarea-group:focus-within .icon-wrap {
              transform: none;
          }

          /* Submit button shimmer */
          .btn-submit {
              position: relative;
              overflow: hidden;
              background: var(--primary);
              color: var(--cream);
              font-family: 'DM Sans', sans-serif;
              font-weight: 500;
              letter-spacing: 0.08em;
              text-transform: uppercase;
              font-size: 0.82rem;
              padding: 0.95rem 2.5rem;
              border-radius: 0.625rem;
              border: none;
              cursor: pointer;
              transition: background 0.3s, transform 0.18s;
              width: 100%;
          }

          .btn-submit::after {
              content: '';
              position: absolute;
              top: 0;
              left: -100%;
              width: 60%;
              height: 100%;
              background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.13), transparent);
              transition: left 0.55s ease;
          }

          .btn-submit:hover::after {
              left: 160%;
          }

          .btn-submit:hover {
              background: var(--dark);
              transform: translateY(-1px);
          }

          .btn-submit:active {
              transform: translateY(1px);
          }

          /* Card entrance */
          @keyframes slideUp {
              from {
                  opacity: 0;
                  transform: translateY(32px);
              }

              to {
                  opacity: 1;
                  transform: translateY(0);
              }
          }

          @keyframes fadeIn {
              from {
                  opacity: 0;
              }

              to {
                  opacity: 1;
              }
          }

          .animate-slide-up {
              animation: slideUp 0.65s cubic-bezier(.22, 1, .36, 1) both;
          }

          .animate-fade-in {
              animation: fadeIn 0.5s ease both;
          }

          .delay-100 {
              animation-delay: 0.10s;
          }

          .delay-200 {
              animation-delay: 0.20s;
          }

          .delay-300 {
              animation-delay: 0.30s;
          }

          .delay-400 {
              animation-delay: 0.40s;
          }

          .delay-500 {
              animation-delay: 0.50s;
          }

          .delay-600 {
              animation-delay: 0.60s;
          }



          /* Scrollbar hide for textarea */
          textarea.custom-input {
              resize: none;
          }

          /* Subtle pattern bg on section */
          .section-bg {
              background-color: var(--background);
              background-image:
                  radial-gradient(circle at 20% 20%, rgba(171, 136, 109, 0.10) 0%, transparent 50%),
                  radial-gradient(circle at 80% 80%, rgba(73, 54, 40, 0.08) 0%, transparent 50%);
          }

          /* Corner ornament */
          .ornament {
              width: 48px;
              height: 48px;
              border-top: 2px solid var(--secondary);
              border-left: 2px solid var(--secondary);
              border-radius: 4px 0 0 0;
          }

          .ornament-br {
              border-top: none;
              border-left: none;
              border-bottom: 2px solid var(--secondary);
              border-right: 2px solid var(--secondary);
              border-radius: 0 0 4px 0;
          }

          /* Badge pill */
          .badge {
              display: inline-flex;
              align-items: center;
              gap: 0.35rem;
              font-size: 0.7rem;
              font-family: 'DM Sans', sans-serif;
              letter-spacing: 0.1em;
              text-transform: uppercase;
              background: rgba(171, 136, 109, 0.15);
              color: var(--primary);
              border: 1px solid rgba(171, 136, 109, 0.35);
              padding: 0.3rem 0.9rem;
              border-radius: 999px;
          }

          /* Select input */
          select.custom-input {
              appearance: none;
              -webkit-appearance: none;
              cursor: pointer;
          }

          /* Checkbox style */
          .custom-check {
              accent-color: var(--primary);
              width: 1rem;
              height: 1rem;
              cursor: pointer;
          }

          /* Step indicator dots */
          .step-dot {
              width: 8px;
              height: 8px;
              border-radius: 50%;
              background: var(--accent);
              transition: background 0.3s, transform 0.3s;
          }

          .step-dot.active {
              background: var(--primary);
              transform: scale(1.35);
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
              top: -100px;
              left: 50%;
              transform: translateX(-50%);
              width: 500px;
              height: 500px;
              background: radial-gradient(circle, rgba(171, 136, 109, 0.12) 0%, transparent 70%);
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
              color: rgba(214, 192, 179, 0.65);
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
              background: rgba(255, 255, 255, 0.06);
              border: 1px solid rgba(171, 136, 109, 0.35);
              border-right: none;
              color: var(--accent);
              font-size: 0.82rem;
              font-family: 'DM Sans', sans-serif;
              outline: none;
              transition: border-color 0.3s;
          }

          .newsletter-form input::placeholder {
              color: rgba(214, 192, 179, 0.35);
          }

          .newsletter-form input:focus {
              border-color: var(--secondary);
          }

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

          .newsletter-form button:hover {
              background: var(--accent);
              color: var(--primary);
          }

          /* ─── FEATURES ─── */
          .features {
              padding: 64px 8%;
              display: grid;
              grid-template-columns: repeat(4, 1fr);
              gap: 0;
              border-top: 1px solid rgba(171, 136, 109, 0.2);
              border-bottom: 1px solid rgba(171, 136, 109, 0.2);
          }

          .feature-item {
              padding: 32px 28px;
              display: flex;
              flex-direction: column;
              align-items: center;
              text-align: center;
              border-right: 1px solid rgba(171, 136, 109, 0.2);
              transition: background 0.3s;
          }

          .feature-item:last-child {
              border-right: none;
          }

          .feature-item:hover {
              background: var(--cream);
          }

          .feature-icon {
              width: 44px;
              height: 44px;
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


          /* ─── RESPONSIVE ─── */
          @media (max-width: 1024px) {
              .products-grid {
                  grid-template-columns: repeat(3, 1fr);
              }

              .categories-grid {
                  grid-template-columns: 1fr 1fr;
                  grid-template-rows: auto;
              }

              .cat-card:first-child {
                  grid-row: auto;
              }

              .footer-grid {
                  grid-template-columns: 1fr 1fr;
                  gap: 32px;
              }
          }

          @media (max-width: 768px) {
              .hero {
                  grid-template-columns: 1fr;
                  min-height: auto;
                  padding-top: 0;
              }

              .hero-right {
                  height: 55vw;
              }

              .hero-left {
                  padding: 40px 5%;
              }

              .hero-headline {
                  font-size: clamp(2.4rem, 10vw, 3.4rem);
              }

              .hero-sub {
                  max-width: none;
              }

              .hero-cta-group {
                  flex-wrap: wrap;
              }

              .hero-stats {
                  justify-content: space-between;
                  gap: 1rem;
              }

              .hero-stat-divider {
                  display: none;
              }

              .hero-floating-card {
                  display: none;
              }

              .products-grid {
                  grid-template-columns: repeat(2, 1fr);
                  gap: 14px;
                  max-width: none;
                  margin: 0;
              }

              .categories-grid {
                  grid-template-columns: 1fr;
                  grid-template-rows: auto;
              }

              .banner-inner {
                  grid-template-columns: 1fr;
              }

              .banner-right {
                  height: 260px;
              }

              .testimonials-grid {
                  grid-template-columns: 1fr;
              }

              .features {
                  grid-template-columns: repeat(2, 1fr);
              }

              .feature-item:nth-child(2) {
                  border-right: none;
              }

              .feature-item:nth-child(3) {
                  border-top: 1px solid rgba(171, 136, 109, 0.2);
              }

              .footer-grid {
                  grid-template-columns: 1fr;
              }

              .section {
                  padding: 60px 5%;
              }

              .modal-box {
                  grid-template-columns: 1fr;
              }

              .modal-img {
                  min-height: 240px;
                  height: 240px;
              }

              .countdown-product-row {
                  min-width: 0;
              }

              .banner-left {
                  padding: 40px 5%;
              }

              .newsletter {
                  padding: 60px 5%;
              }

              .newsletter-form {
                  width: 100%;
                  max-width: none;
              }

              .newsletter-form input,
              .newsletter-form button {
                  width: 100%;
              }

              .newsletter-form {
                  flex-direction: column;
              }

              .newsletter-form input {
                  border-right: 1px solid rgba(171, 136, 109, 0.35);
              }
          }

          @media (max-width: 480px) {
              .products-grid {
                  grid-template-columns: 1fr;
                  width: 100%;
                  max-width: none;
                  margin: 0;
              }

              .hero-stats {
                  display: grid;
                  grid-template-columns: repeat(3, 1fr);
                  gap: 0.75rem;
              }

              .hero-stat-value {
                  font-size: 1.35rem;
              }

              .hero-stat-label {
                  font-size: 0.62rem;
              }

              .newsletter-form {
                  flex-direction: column;
              }

              .newsletter-form input {
                  border-right: 1px solid rgba(171, 136, 109, 0.35);
                  border-bottom: none;
              }

              .footer-bottom {
                  flex-direction: column;
                  gap: 12px;
                  text-align: center;
              }
          }
      </style>

      <div class="home-page">
          {{-- <div class="cursor-dot" id="cursorDot"></div>
          <div class="cursor-ring" id="cursorRing"></div> --}}
          <!-- ─── HERO ─── -->
          <section class="hero" id="hero">
              <div class="hero-slides" id="heroSlides">

                  <!-- Slide 1 : Marketplace Intro -->
                  <div class="hero-slide active" data-index="0">
                      <div class="hero-left">
                          <span class="hero-eyebrow">Nepal's Multi-Vendor Marketplace</span>
                          <h1 class="hero-headline">
                              Everything <em>You</em><br>Need, All in<br>One Place
                          </h1>
                          <p class="hero-sub">From electronics and fashion to food, home essentials and
                              more — discover thousands of products from trusted local sellers.</p>
                          <div class="hero-cta-group">
                              <a href="{{ route('products') }}" class="btn-primary"><span>Explore Collection</span></a>
                              <a href="{{ route('our-story') }}" class="btn-ghost">
                                  Our Story
                                  <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5"
                                      viewBox="0 0 24 24">
                                      <path d="M5 12h14M13 6l6 6-6 6" />
                                  </svg>
                              </a>
                          </div>

                          <div class="hero-stats">
                              <div>
                                  <div class="hero-stat-value" data-count="4800" data-suffix="k+">4.8k+</div>
                                  <div class="hero-stat-label">Happy Clients</div>
                              </div>
                              <div class="hero-stat-divider"></div>
                              <div>
                                  <div class="hero-stat-value" data-count="{{ $products->count() }}" data-suffix="+">{{ $products->count() }}+</div>
                                  <div class="hero-stat-label">Products</div>
                              </div>
                              <div class="hero-stat-divider"></div>
                              <div>
                                  <div class="hero-stat-value" data-count="{{ $sellercount }}" data-suffix="+">{{ $sellercount }}+</div>
                                  <div class="hero-stat-label">Seller</div>
                              </div>
                          </div>
                      </div>

                      <div class="hero-right">
                          <div class="hero-img-container">
                              <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=900&q=80&auto=format"
                                  alt="Marketplace" />
                              <div class="hero-img-overlay"></div>
                          </div>
                      </div>
                  </div>

                  <!-- Slide 2 : Electronics -->
                  <div class="hero-slide" data-index="1">
                      <div class="hero-left">
                          <span class="hero-eyebrow">Electronics</span>
                          <h1 class="hero-headline">
                              Smart Living,<br>Easy <em>Shopping</em>
                          </h1>
                          <p class="hero-sub">Phones, laptops, audio and gadgets — discover the latest tech from
                              verified local sellers at the best prices.</p>
                          <div class="hero-cta-group">
                              <a href="{{ route('products') }}" class="btn-primary"><span>Shop Electronics</span></a>
                              <a href="{{ route('categories') }}" class="btn-ghost">
                                  All Categories
                                  <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5"
                                      viewBox="0 0 24 24">
                                      <path d="M5 12h14M13 6l6 6-6 6" />
                                  </svg>
                              </a>
                          </div>

                          <div class="hero-stats">
                              <div>
                                  <div class="hero-stat-value" data-count="300" data-suffix="+">300+</div>
                                  <div class="hero-stat-label">Gadgets</div>
                              </div>
                              <div class="hero-stat-divider"></div>
                              <div>
                                  <div class="hero-stat-value" data-count="40" data-suffix="+">40+</div>
                                  <div class="hero-stat-label">Brands</div>
                              </div>
                              <div class="hero-stat-divider"></div>
                              <div>
                                  <div class="hero-stat-value" data-count="24" data-suffix="h">24h</div>
                                  <div class="hero-stat-label">Express Delivery</div>
                              </div>
                          </div>
                      </div>

                      <div class="hero-right">
                          <div class="hero-img-container">
                              <img src="https://images.unsplash.com/photo-1526738549149-8e07eca6c147?w=900&q=80&auto=format"
                                  alt="Electronics" />
                              <div class="hero-img-overlay"></div>
                          </div>
                      </div>
                  </div>

                  <!-- Slide 3 : Fashion -->
                  <div class="hero-slide" data-index="2">
                      <div class="hero-left">
                          <span class="hero-eyebrow">Fashion</span>
                          <h1 class="hero-headline">
                              Style That<br>Tells Your <em>Story</em>
                          </h1>
                          <p class="hero-sub">Men's and women's wear, shoes and accessories — curated looks from
                              fashion brands you can trust.</p>
                          <div class="hero-cta-group">
                              <a href="{{ route('products', ['category' => 'mens-wear']) }}" class="btn-primary"><span>Shop Fashion</span></a>
                              <a href="{{ route('products', ['category' => 'accessories']) }}" class="btn-ghost">
                                  Accessories
                                  <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5"
                                      viewBox="0 0 24 24">
                                      <path d="M5 12h14M13 6l6 6-6 6" />
                                  </svg>
                              </a>
                          </div>

                          <div class="hero-stats">
                              <div>
                                  <div class="hero-stat-value" data-count="500" data-suffix="+">500+</div>
                                  <div class="hero-stat-label">Styles</div>
                              </div>
                              <div class="hero-stat-divider"></div>
                              <div>
                                  <div class="hero-stat-value" data-count="80" data-suffix="+">80+</div>
                                  <div class="hero-stat-label">Brands</div>
                              </div>
                              <div class="hero-stat-divider"></div>
                              <div>
                                  <div class="hero-stat-value" data-count="7" data-suffix="d">7d</div>
                                  <div class="hero-stat-label">New Drops</div>
                              </div>
                          </div>
                      </div>

                      <div class="hero-right">
                          <div class="hero-img-container">
                              <img src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=900&q=80&auto=format"
                                  alt="Fashion" />
                              <div class="hero-img-overlay"></div>
                          </div>
                      </div>
                  </div>

                  <!-- Slide 4 : Food & Groceries -->
                  <div class="hero-slide" data-index="3">
                      <div class="hero-left">
                          <span class="hero-eyebrow">Food & Groceries</span>
                          <h1 class="hero-headline">
                              Fresh, Delivered<br>to Your <em>Door</em>
                          </h1>
                          <p class="hero-sub">Everyday essentials, snacks and fresh produce — from local grocers to
                              your home, fast.</p>
                          <div class="hero-cta-group">
                              <a href="{{ route('products') }}" class="btn-primary"><span>Shop Food</span></a>
                              <a href="{{ route('our-story') }}" class="btn-ghost">
                                  Our Story
                                  <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5"
                                      viewBox="0 0 24 24">
                                      <path d="M5 12h14M13 6l6 6-6 6" />
                                  </svg>
                              </a>
                          </div>

                          <div class="hero-stats">
                              <div>
                                  <div class="hero-stat-value" data-count="1200" data-suffix="+">1.2k+</div>
                                  <div class="hero-stat-label">Items</div>
                              </div>
                              <div class="hero-stat-divider"></div>
                              <div>
                                  <div class="hero-stat-value" data-count="100" data-suffix="%">100%</div>
                                  <div class="hero-stat-label">Fresh</div>
                              </div>
                              <div class="hero-stat-divider"></div>
                              <div>
                                  <div class="hero-stat-value" data-count="2" data-suffix="h">2h</div>
                                  <div class="hero-stat-label">Express Delivery</div>
                              </div>
                          </div>
                      </div>

                      <div class="hero-right">
                          <div class="hero-img-container">
                              <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=900&q=80&auto=format"
                                  alt="Food & Groceries" />
                              <div class="hero-img-overlay"></div>
                          </div>
                      </div>
                  </div>

                  <!-- Slide 5 : Home & Kitchen -->
                  <div class="hero-slide" data-index="4">
                      <div class="hero-left">
                          <span class="hero-eyebrow">Home & Kitchen</span>
                          <h1 class="hero-headline">
                              Make Every<br>Corner <em>Count</em>
                          </h1>
                          <p class="hero-sub">Cookware, decor and appliances — everything you need to make your home
                              feel like you.</p>
                          <div class="hero-cta-group">
                              <a href="{{ route('products') }}" class="btn-primary"><span>Shop Home & Kitchen</span></a>
                              <a href="{{ route('categories') }}" class="btn-ghost">
                                  All Categories
                                  <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5"
                                      viewBox="0 0 24 24">
                                      <path d="M5 12h14M13 6l6 6-6 6" />
                                  </svg>
                              </a>
                          </div>

                          <div class="hero-stats">
                              <div>
                                  <div class="hero-stat-value" data-count="400" data-suffix="+">400+</div>
                                  <div class="hero-stat-label">Items</div>
                              </div>
                              <div class="hero-stat-divider"></div>
                              <div>
                                  <div class="hero-stat-value" data-count="30" data-suffix="+">30+</div>
                                  <div class="hero-stat-label">Brands</div>
                              </div>
                              <div class="hero-stat-divider"></div>
                              <div>
                                  <div class="hero-stat-value" data-count="30" data-suffix="d">30d</div>
                                  <div class="hero-stat-label">Easy Returns</div>
                              </div>
                          </div>
                      </div>

                      <div class="hero-right">
                          <div class="hero-img-container">
                              <img src="https://images.unsplash.com/photo-1556911220-bff31c812dba?w=900&q=80&auto=format"
                                  alt="Home & Kitchen" />
                              <div class="hero-img-overlay"></div>
                          </div>
                      </div>
                  </div>

                  <!-- Slide 6 : Cosmetics -->
                  <div class="hero-slide" data-index="5">
                      <div class="hero-left">
                          <span class="hero-eyebrow">Beauty & Cosmetics</span>
                          <h1 class="hero-headline">
                              Beauty From<br>Local <em>Brands</em>
                          </h1>
                          <p class="hero-sub">Skincare, makeup and wellness — shop safe, cruelty-free beauty from
                              Nepal's own makers.</p>
                          <div class="hero-cta-group">
                              <a href="{{ route('products', ['category' => 'health-beauty']) }}" class="btn-primary"><span>Shop Cosmetics</span></a>
                              <a href="{{ route('our-story') }}" class="btn-ghost">
                                  Our Story
                                  <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5"
                                      viewBox="0 0 24 24">
                                      <path d="M5 12h14M13 6l6 6-6 6" />
                                  </svg>
                              </a>
                          </div>

                          <div class="hero-stats">
                              <div>
                                  <div class="hero-stat-value" data-count="200" data-suffix="+">200+</div>
                                  <div class="hero-stat-label">Products</div>
                              </div>
                              <div class="hero-stat-divider"></div>
                              <div>
                                  <div class="hero-stat-value" data-count="25" data-suffix="+">25+</div>
                                  <div class="hero-stat-label">Brands</div>
                              </div>
                              <div class="hero-stat-divider"></div>
                              <div>
                                  <div class="hero-stat-value" data-count="100" data-suffix="%">100%</div>
                                  <div class="hero-stat-label">Cruelty-free</div>
                              </div>
                          </div>
                      </div>

                      <div class="hero-right">
                          <div class="hero-img-container">
                              <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=900&q=80&auto=format"
                                  alt="Beauty & Cosmetics" />
                              <div class="hero-img-overlay"></div>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Controls -->
              <button class="hero-arrow prev" onclick="moveHeroSlide(-1)" aria-label="Previous">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                      <path d="M19 12H5M12 19l-7-7 7-7" />
                  </svg>
              </button>
              <button class="hero-arrow next" onclick="moveHeroSlide(1)" aria-label="Next">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                      <path d="M5 12h14M12 5l7 7-7 7" />
                  </svg>
              </button>
              <div class="hero-dots" id="heroDots"></div>
          </section>

          <!-- ─── MARQUEE ─── -->
          <div class="marquee-strip">
              <div class="marquee-inner">
                  <span class="marquee-item">Thousands of Products <span class="dot"></span></span>
                  <span class="marquee-item">Trusted Local Sellers <span class="dot"></span></span>
                  <span class="marquee-item">Secure Payments <span class="dot"></span></span>
                  <span class="marquee-item">Fast Delivery <span class="dot"></span></span>
                  <span class="marquee-item">Easy Returns <span class="dot"></span></span>
                  <span class="marquee-item">Every Category Covered <span class="dot"></span></span>
                  <span class="marquee-item">Thousands of Products <span class="dot"></span></span>
                  <span class="marquee-item">Trusted Local Sellers <span class="dot"></span></span>
                  <span class="marquee-item">Secure Payments <span class="dot"></span></span>
                  <span class="marquee-item">Fast Delivery <span class="dot"></span></span>
                  <span class="marquee-item">Easy Returns <span class="dot"></span></span>
                  <span class="marquee-item">Every Category Covered <span class="dot"></span></span>
              </div>
          </div>

          <!-- ─── CATEGORIES ─── -->
          <section class="section" id="categories">
              <div class="section-label reveal">Shop by Category</div>
              <div class="flex justify-between items-end">
                  <h2 class="section-title reveal reveal-delay-1">Explore Our<br><em>Curated World</em></h2>
                  <a href="{{ route('categories') }}" class="btn-ghost reveal reveal-delay-2" style="margin-bottom:4px">
                      All Categories
                      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5"
                          viewBox="0 0 24 24">
                          <path d="M5 12h14M13 6l6 6-6 6" />
                      </svg>
                  </a>
              </div>

              <div class="categories-grid reveal reveal-delay-1">
                  @forelse ($categories->take(5) as $category)
                      <a href="{{ route('products', ['category' => $category->slug]) }}" class="cat-card">
                          @if ($category->image)
                              <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" />
                          @else
                              <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=700&q=80&auto=format"
                                  alt="{{ $category->name }}" />
                          @endif
                          <div class="cat-card-overlay">
                              <div class="cat-name">{{ $category->name }}</div>
                              <div class="cat-count">{{ $category->products_count ?? 0 }} products</div>
                              <div class="cat-arrow">
                                  <svg width="14" height="14" fill="none" stroke="currentColor"
                                      stroke-width="2" viewBox="0 0 24 24">
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

          <!-- ─── PRODUCTS ─── -->
          <section class="section" style="padding-top:0" id="products">
              <div class="products-header">
                  <div>
                      <div class="section-label reveal">Handpicked for You</div>
                      <h2 class="section-title reveal reveal-delay-1">Featured <em>Products</em></h2>
                  </div>
                  <div class="product-filter reveal reveal-delay-2">
                      <a href="{{ route('products') }}">
                          <button class="filter-btn active" onclick="filterProducts(this,'all')"> View All</button>
                      </a>
                  </div>
              </div>

              <div class="products-grid" id="productsGrid">
                  @foreach ($products->take(4) as $product)
                      <a href="{{ route('product', $product->id) }}">
                          <div class="product-card reveal" data-tag="new trending">
                              <div class="product-img-wrap">
                                  <img src="{{ $product->main_image }}" alt="{{ $product->name }}" />
                                  @if ($product->is_new)
                                      <span class="product-badge">New</span>
                                  @endif
                                  <div class="product-actions">
                                      <button class="add-cart-btn"
                                          onclick="event.preventDefault(); event.stopPropagation(); addToCart(this)">Add
                                          to Cart</button>
                                      <button class="wishlist-btn"
                                          onclick="event.preventDefault(); event.stopPropagation();">
                                          <svg fill="none" stroke="currentColor" stroke-width="1.8"
                                              viewBox="0 0 24 24">
                                              <path
                                                  d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                                          </svg>
                                      </button>
                                  </div>
                              </div>
                              <div class="product-info">
                                  <div class="product-name">{{ $product->name }}</div>
                                  <div class="product-price-row">
                                      <span class="product-price">Rs.
                                          {{ number_format($product->effective_price, 2) }}</span>
                                      @if ($product->is_discounted)
                                          <span class="product-price-old">Rs.
                                              {{ number_format($product->price, 2) }}</span>
                                      @endif
                                  </div>
                                  <div class="product-rating">
                                      @for ($i = 1; $i <= 5; $i++)
                                          <span
                                              class="star{{ $i <= (int) round($product->reviews_avg_rating ?? 0) ? ' is-fill' : '' }}">&starf;</span>
                                      @endfor
                                      <span style="font-size:0.72rem;color:#7a6858;margin-left:4px">{{ $product->reviews_count ? '(' . $product->reviews_count . ')' : 'No reviews yet' }}</span>
                                  </div>
                              </div>
                          </div>
                      </a>
                  @endforeach
              </div>

              <div style="text-align:center;margin-top:48px" class="reveal">
                  <a href="{{ route('products') }}" class="btn-primary"><span>View All Products</span></a>
              </div>
          </section>

          {{-- Category Product --}}
          @foreach ($categories->take(3) as $category)
              <!-- ─── PRODUCTS ─── -->
              <section class="section" style="padding-top:0" id="products">
                  <div class="products-header">
                      <div>
                          <h2 class="section-title reveal reveal-delay-1">{{ $category->name }}</h2>
                      </div>
                  </div>

                  <div class="products-grid" id="productsGrid">
                      @foreach ($category->products->take(4) as $product)
                          <a href="{{ route('product', $product->id) }}">
                              <div class="product-card reveal" data-tag="new trending">
                                  <div class="product-img-wrap">
                                      <img src="{{ $product->main_image }}" alt="{{ $product->name }}" />
                                      @if ($product->is_new)
                                          <span class="product-badge">New</span>
                                      @endif
                                      <div class="product-actions">
                                          <button class="add-cart-btn"
                                              onclick="event.preventDefault(); event.stopPropagation(); addToCart(this)">Add
                                              to Cart</button>
                                          <button class="wishlist-btn"
                                              onclick="event.preventDefault(); event.stopPropagation();">
                                              <svg fill="none" stroke="currentColor" stroke-width="1.8"
                                                  viewBox="0 0 24 24">
                                                  <path
                                                      d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                                              </svg>
                                          </button>
                                      </div>
                                  </div>
                                  <div class="product-info">
                                      <div class="product-name">{{ $product->name }}</div>
                                      <div class="product-price-row">
                                          <span class="product-price">Rs.
                                              {{ number_format($product->effective_price, 2) }}</span>
                                          @if ($product->is_discounted)
                                              <span class="product-price-old">Rs.
                                                  {{ number_format($product->price, 2) }}</span>
                                          @endif
                                      </div>
                                      <div class="product-rating">
                                          @for ($i = 1; $i <= 5; $i++)
                                              <span
                                                  class="star{{ $i <= (int) round($product->reviews_avg_rating ?? 0) ? ' is-fill' : '' }}">&starf;</span>
                                          @endfor
                                          <span
                                              style="font-size:0.72rem;color:#7a6858;margin-left:4px">{{ $product->reviews_count ? '(' . $product->reviews_count . ')' : 'No reviews yet' }}</span>
                                      </div>
                                  </div>
                              </div>
                          </a>
                      @endforeach
                  </div>

                  <div style="text-align:center;margin-top:48px" class="reveal">
                      <a href="{{ route('products', ['category' => $category->slug]) }}"
                          class="btn-primary"><span>View All {{ $category->name }}</span></a>
                  </div>
              </section>
          @endforeach


          <!-- ─── NEWSLETTER ─── -->
          <section class="newsletter">
              <div class="section-label reveal" style="justify-content:center;color:var(--secondary)">Stay Connected
              </div>
              <h2 class="newsletter-title reveal reveal-delay-1">The MeroBazar <em style="font-style:italic">Edit</em>
              </h2>
              <p class="newsletter-sub reveal reveal-delay-2">Be the first to know about new arrivals, exclusive
                  offers,<br>and
                  stories from the world of MeroBazar.</p>
              <div class="newsletter-form reveal reveal-delay-3">
                  <input type="email" placeholder="Enter your email address" id="emailInput" />
                  <button onclick="subscribeNewsletter()">Subscribe</button>
              </div>
              <p style="font-size:0.68rem;color:rgba(214,192,179,0.3);margin-top:14px;letter-spacing:0.08em"
                  class="reveal reveal-delay-4">No spam, ever. Unsubscribe at any time.</p>
          </section>
          <!-- ─── SCRIPTS ─── -->
          <script>
              // ── NAVBAR SCROLL
              const navbar = document.getElementById('navbar');
              window.addEventListener('scroll', () => {
                  navbar.classList.toggle('scrolled', window.scrollY > 60);
              });

              // ── REVEAL ON SCROLL
              const reveals = document.querySelectorAll('.reveal');
              const revealObs = new IntersectionObserver((entries) => {
                  entries.forEach(e => {
                      if (e.isIntersecting) {
                          e.target.classList.add('visible');
                      }
                  });
              }, {
                  threshold: 0.1
              });
              reveals.forEach(r => revealObs.observe(r));

              // ── HERO SLIDESHOW
              const heroSlides = document.querySelectorAll('.hero-slide');
              const heroDotsWrap = document.getElementById('heroDots');
              const heroWrap = document.getElementById('hero');
              let currentSlide = 0;
              let heroTimer = null;
              let slideLock = false;

              heroSlides.forEach((_, i) => {
                  const dot = document.createElement('button');
                  dot.className = 'hero-dot' + (i === 0 ? ' active' : '');
                  dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));
                  dot.onclick = () => goToSlide(i);
                  heroDotsWrap.appendChild(dot);
              });

              const heroDots = heroDotsWrap.querySelectorAll('.hero-dot');

              function goToSlide(index) {
                  if (slideLock) return;
                  slideLock = true;
                  currentSlide = (index + heroSlides.length) % heroSlides.length;
                  heroSlides.forEach((s, i) => s.classList.toggle('active', i === currentSlide));
                  heroDots.forEach((d, i) => d.classList.toggle('active', i === currentSlide));
                  setTimeout(() => { slideLock = false; }, 950);
              }

              window.moveHeroSlide = function (dir) {
                  goToSlide(currentSlide + dir);
                  restartHeroTimer();
              };

              function restartHeroTimer() {
                  if (heroTimer) clearInterval(heroTimer);
                  heroTimer = setInterval(() => goToSlide(currentSlide + 1), 6000);
              }

              if (heroWrap && heroSlides.length > 1) {
                  heroWrap.addEventListener('mouseenter', () => {
                      if (heroTimer) clearInterval(heroTimer);
                  });
                  heroWrap.addEventListener('mouseleave', restartHeroTimer);
                  restartHeroTimer();
              }

              // ── HERO STAT COUNTER (per-slide)
              function animateCount(el, target, suffix = '') {
                  let start = 0;
                  const step = Math.max(target / 40, 1);
                  const timer = setInterval(() => {
                      start = Math.min(start + step, target);
                      el.textContent = Math.round(start) + suffix;
                      if (start >= target) clearInterval(timer);
                  }, 28);
              }

              function runSlideCounters(slide) {
                  slide.querySelectorAll('.hero-stat-value[data-count]').forEach((el, i) => {
                      const target = parseInt(el.dataset.count, 10) || 0;
                      const suffix = el.dataset.suffix || '+';
                      setTimeout(() => animateCount(el, target, suffix), 200 + i * 120);
                  });
              }

              window.addEventListener('load', () => {
                  runSlideCounters(heroSlides[0]);
              });
              const heroSlideObs = new MutationObserver(() => {
                  const active = document.querySelector('.hero-slide.active');
                  if (active) runSlideCounters(active);
              });
              if (heroSlides.length) {
                  heroSlideObs.observe(document.getElementById('heroSlides'), { attributes: true, attributeFilter: ['class'] });
              }

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

              //   // ── QUICK VIEW MODAL
              //   function openModal() {
              //       document.getElementById('modalOverlay').classList.add('open');
              //       document.body.style.overflow = 'hidden';
              //   }

              //   function closeModal(e) {
              //       if (!e || e.target === document.getElementById('modalOverlay') || e.currentTarget.tagName === 'BUTTON') {
              //           document.getElementById('modalOverlay').classList.remove('open');
              //           document.body.style.overflow = '';
              //       }
              //   }

              //   function selectSize(btn) {
              //       document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
              //       btn.classList.add('active');
              //   }




              // ── BAR ANIMATION ON SCROLL
              const barObs = new IntersectionObserver(entries => {
                  entries.forEach(e => {
                      if (e.isIntersecting) {
                          e.target.querySelectorAll('.cp-bar-fill').forEach(bar => {
                              const w = bar.style.width;
                              bar.style.width = '0';
                              setTimeout(() => {
                                  bar.style.width = w;
                              }, 200);
                          });
                          barObs.unobserve(e.target);
                      }
                  });
              }, {
                  threshold: 0.3
              });
              document.querySelector('.countdown-section') && barObs.observe(document.querySelector('.countdown-section'));

              // ── seller CARD HOVER GLOW
              document.querySelectorAll('.seller-card').forEach(card => {
                  card.addEventListener('mousemove', e => {
                      const rect = card.getBoundingClientRect();
                      const x = ((e.clientX - rect.left) / rect.width * 100).toFixed(1);
                      const y = ((e.clientY - rect.top) / rect.height * 100).toFixed(1);
                      card.style.background = card.classList.contains('featured') ?
                          `radial-gradient(circle at ${x}% ${y}%, #5c4030, var(--primary))` :
                          `radial-gradient(circle at ${x}% ${y}%, rgba(171,136,109,0.07), white)`;
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
                                  setTimeout(() => {
                                      bar.style.width = target;
                                  }, 200);
                              });
                          });
                      }
                  });
              }, {
                  threshold: 0.4
              });
              document.querySelectorAll('.countdown-product-row').forEach(row => progressObs.observe(row));

              // ── RECO CHIP CLICK
              document.querySelectorAll('.reco-chip').forEach(chip => {
                  chip.addEventListener('click', () => addToCart(chip));
              });
          </script>
      </div>
  </x-layout>
