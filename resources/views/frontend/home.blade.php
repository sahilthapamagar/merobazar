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
              color: var(--secondary);
              font-size: 0.75rem;
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
              <div class="hero-left">
                  <span class="hero-eyebrow" id="heroEyebrow">SS 2025 Collection</span>
                  <h1 class="hero-headline reveal" id="heroHead">
                      Wear <em>Your</em><br>Story With<br>Elegance
                  </h1>
                  <p class="hero-sub reveal reveal-delay-1">Discover curated pieces that blend timeless craftsmanship
                      with
                      modern sensibility. Every stitch tells a story.</p>
                  <div class="hero-cta-group reveal reveal-delay-2">
                      <a href="#" class="btn-primary"><span>Explore Collection</span></a>
                      <a href="#" class="btn-ghost">
                          Our Story
                          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5"
                              viewBox="0 0 24 24">
                              <path d="M5 12h14M13 6l6 6-6 6" />
                          </svg>
                      </a>
                  </div>

                  <div class="hero-stats reveal reveal-delay-3">
                      <div>
                          <div class="hero-stat-value">4.8k<span>+</span></div>
                          <div class="hero-stat-label">Happy Clients</div>
                      </div>
                      <div class="hero-stat-divider"></div>
                      <div>
                          <div class="hero-stat-value">360<span>+</span></div>
                          <div class="hero-stat-label">Products</div>
                      </div>
                      <div class="hero-stat-divider"></div>
                      <div>
                          <div class="hero-stat-value">12<span>+</span></div>
                          <div class="hero-stat-label">Countries</div>
                      </div>
                  </div>
              </div>

              <div class="hero-right">
                  <div class="hero-img-container">
                      <img src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=900&q=80&auto=format"
                          alt="Hero fashion" />
                      <div class="hero-img-overlay"></div>
                  </div>
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
                      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5"
                          viewBox="0 0 24 24">
                          <path d="M5 12h14M13 6l6 6-6 6" />
                      </svg>
                  </a>
              </div>

              <div class="categories-grid reveal reveal-delay-1">
                  <div class="cat-card">
                      <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=700&q=80&auto=format"
                          alt="Women" />
                      <div class="cat-card-overlay">
                          <div class="cat-name">Women's</div>
                          <div class="cat-count">142 products</div>
                          <div class="cat-arrow">
                              <svg width="14" height="14" fill="none" stroke="currentColor"
                                  stroke-width="2" viewBox="0 0 24 24">
                                  <path d="M5 12h14M13 6l6 6-6 6" />
                              </svg>
                          </div>
                      </div>
                  </div>
                  <div class="cat-card">
                      <img src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?w=600&q=80&auto=format"
                          alt="Men" />
                      <div class="cat-card-overlay">
                          <div class="cat-name">Men's</div>
                          <div class="cat-count">98 products</div>
                          <div class="cat-arrow">
                              <svg width="14" height="14" fill="none" stroke="currentColor"
                                  stroke-width="2" viewBox="0 0 24 24">
                                  <path d="M5 12h14M13 6l6 6-6 6" />
                              </svg>
                          </div>
                      </div>
                  </div>
                  <div class="cat-card">
                      <img src="https://images.unsplash.com/photo-1484154218962-a197022b5858?w=600&q=80&auto=format"
                          alt="Home" />
                      <div class="cat-card-overlay">
                          <div class="cat-name">Home & Living</div>
                          <div class="cat-count">76 products</div>
                          <div class="cat-arrow">
                              <svg width="14" height="14" fill="none" stroke="currentColor"
                                  stroke-width="2" viewBox="0 0 24 24">
                                  <path d="M5 12h14M13 6l6 6-6 6" />
                              </svg>
                          </div>
                      </div>
                  </div>
                  <div class="cat-card">
                      <img src="https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=600&q=80&auto=format"
                          alt="Accessories" />
                      <div class="cat-card-overlay">
                          <div class="cat-name">Accessories</div>
                          <div class="cat-count">54 products</div>
                          <div class="cat-arrow">
                              <svg width="14" height="14" fill="none" stroke="currentColor"
                                  stroke-width="2" viewBox="0 0 24 24">
                                  <path d="M5 12h14M13 6l6 6-6 6" />
                              </svg>
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
                  <!-- Product -->
                  @foreach ($products as $product)
                      <a href="{{ route('product', $product->id) }}">
                          <div class="product-card reveal" data-tag="new trending">
                              <div class="product-img-wrap">
                                  <img src="{{ asset(Storage::url($product->productVarient()->first()->images[0])) }}"
                                      alt="Silk Midi Dress" />
                                  <span class="product-badge">Discount {{ $product->discount }}%</span>
                                  <div class="product-actions">
                                      <button class="add-cart-btn" onclick="addToCart(this)">Add to Cart</button>
                                      <button class="wishlist-btn">
                                          <svg fill="none" stroke="currentColor" stroke-width="1.8"
                                              viewBox="0 0 24 24">
                                              <path
                                                  d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                                          </svg>
                                      </button>
                                  </div>
                              </div>
                              <div class="product-info">
                                  {{-- <div class="product-brand">Mero Bazar Studio</div> --}}
                                  <div class="product-name">{{ $product->name }}</div>
                                  <div class="product-price-row">
                                      <span class="product-price">Rs.
                                          {{ $product->productVarient()->first()->price }}</span>
                                  </div>
                                  <div class="product-rating"><span class="star">★★★★★</span> <span
                                          style="font-size:0.72rem;color:#7a6858;margin-left:4px">(48)</span></div>
                              </div>
                          </div>
                      </a>
                  @endforeach
              </div>

              <div style="text-align:center;margin-top:48px" class="reveal">
                  <a href="{{ route('products') }}" class="btn-primary"><span>View All Products</span></a>
              </div>
          </section>

          <!-- ─── PROMO BANNER ─── -->
          <section class="banner-section">
              <div class="banner-inner reveal">
                  <div class="banner-left">
                      <div class="banner-eyebrow">Limited Time Offer</div>
                      <h2 class="banner-title">Summer <em>Sale</em><br>Up to 40% Off</h2>
                      <p class="banner-text">Refresh your wardrobe with our curated summer selection. Premium pieces at
                          prices
                          that let you shop more of what you love.</p>
                      <a href="#" class="btn-light"><span>Shop the Sale</span></a>
                      <div class="discount-chip">
                          <span>40%</span>
                          <span>Off</span>
                      </div>
                  </div>
                  <div class="banner-right">
                      <img src="https://images.unsplash.com/photo-1469334031218-e382a71b716b?w=800&q=80&auto=format"
                          alt="Sale banner" />
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
                      <p class="countdown-sub">Hand-selected pieces at their lowest prices ever. Once the timer hits
                          zero,
                          so
                          do the discounts.</p>
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
                          <img class="cp-img"
                              src="https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?w=120&q=80&auto=format"
                              alt="Dress" />
                          <div class="cp-info">
                              <div class="cp-name">Silk Midi Slip Dress</div>
                              <div class="cp-price">
                                  <span class="cp-price-old">$245</span>
                                  <span style="color:var(--accent);font-weight:600">$148</span>
                              </div>
                              <div class="cp-bar">
                                  <div class="cp-bar-fill" style="width:78%"></div>
                              </div>
                              <div class="cp-sold">78% sold · 12 left</div>
                          </div>
                      </div>
                      <div class="countdown-product-row" onclick="addToCart(this)">
                          <img class="cp-img"
                              src="https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=120&q=80&auto=format"
                              alt="Bag" />
                          <div class="cp-info">
                              <div class="cp-name">Structured Leather Tote</div>
                              <div class="cp-price">
                                  <span class="cp-price-old">$380</span>
                                  <span style="color:var(--accent);font-weight:600">$228</span>
                              </div>
                              <div class="cp-bar">
                                  <div class="cp-bar-fill" style="width:54%"></div>
                              </div>
                              <div class="cp-sold">54% sold · 8 left</div>
                          </div>
                      </div>
                      <div class="countdown-product-row" onclick="addToCart(this)">
                          <img class="cp-img"
                              src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=120&q=80&auto=format"
                              alt="Watch" />
                          <div class="cp-info">
                              <div class="cp-name">Minimalist Leather Watch</div>
                              <div class="cp-price">
                                  <span class="cp-price-old">$425</span>
                                  <span style="color:var(--accent);font-weight:600">$255</span>
                              </div>
                              <div class="cp-bar">
                                  <div class="cp-bar-fill" style="width:91%"></div>
                              </div>
                              <div class="cp-sold">91% sold · 4 left</div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>


          <!-- ─── Seller Contact Information ─── -->
          <section class="seller-contact-section">
              <div class="seller-contact-inner animate-fade-in">
                  <!-- Section header -->
                  <div class="seller-contact-header animate-slide-up">
                      <span class="badge mb-4">
                          <svg width="7" height="7" viewBox="0 0 7 7" fill="none">
                              <circle cx="3.5" cy="3.5" r="3.5" fill="#AB886D" />
                          </svg>
                          New Membership
                      </span>

                      <h2 class="font-display text-4xl font-bold mt-3 mb-2"
                          style="color: var(--dark); line-height:1.2;">
                          Register Your<br />
                          <span style="color: var(--secondary); font-style: italic;">Shop</span>
                      </h2>

                      <p class="seller-contact-sub">
                          Join our curated community of artisan shop owners and start your journey today.
                      </p>
                  </div>

                  <!-- Card -->
                  <div class="seller-contact-card animate-slide-up delay-200">

                      <!-- Form title inside card -->
                      <p class="seller-contact-card-title animate-slide-up delay-300">Personal &amp; Shop Details</p>

                      <form action="{{ route('seller.request') }}" method="POST" novalidate
                          class="seller-contact-form">
                          @csrf

                          <!-- Name -->
                          <div class="input-group animate-slide-up delay-300">
                              <input type="text" name="name" id="name" placeholder="Full Name"
                                  autocomplete="name" class="custom-input pr-10" required />
                              <label for="name">Full Name</label>
                              <span class="icon-wrap">
                                  <svg width="18" height="18" fill="none" stroke="currentColor"
                                      stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.118
                     a7.5 7.5 0 0 1 15 0A17.933 17.933 0 0 1 12 21.75c-2.676
                     0-5.216-.584-7.5-1.632Z" />
                                  </svg>
                              </span>
                              @error('name')
                                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                              @enderror
                          </div>

                          <!-- Email -->
                          <div class="input-group animate-slide-up delay-400">
                              <input type="email" name="email" id="email" placeholder="Email Address"
                                  autocomplete="email" class="custom-input pr-10" required />
                              <label for="email">Email Address</label>
                              <span class="icon-wrap">
                                  <svg width="18" height="18" fill="none" stroke="currentColor"
                                      stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15
                     a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0
                     19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243
                     a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0
                     1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                  </svg>
                              </span>
                              @error('email')
                                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                              @enderror
                          </div>

                          <!-- Two-column row: Shop Name + Contact -->
                          <div class="seller-contact-form-row">

                              <!-- Shop Name -->
                              <div class="input-group animate-slide-up delay-500">
                                  <input type="text" name="shop_name" id="shop_name" placeholder="Shop Name"
                                      autocomplete="organization" class="custom-input pr-10" required />
                                  <label for="shop_name">Shop Name</label>
                                  <span class="icon-wrap">
                                      <svg width="18" height="18" fill="none" stroke="currentColor"
                                          stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0
                       1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39
                       0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0
                       3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0
                       1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016
                       c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0
                       3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72
                       L4.318 3.44A1.5 1.5 0 0 1 5.378 3h13.243a1.5
                       1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621
                       4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75
                       0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0
                       .414.336.75.75.75Z" />
                                      </svg>
                                  </span>
                                  @error('shop_name')
                                      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                  @enderror
                              </div>

                              <!-- Contact -->
                              <div class="input-group animate-slide-up delay-500">
                                  <input type="tel" name="contact" id="contact" placeholder="Contact Number"
                                      autocomplete="tel" class="custom-input pr-10" required />
                                  <label for="contact">Contact Number</label>
                                  <span class="icon-wrap">
                                      <svg width="18" height="18" fill="none" stroke="currentColor"
                                          stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25
                       0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091
                       l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97
                       1.293c-.282.376-.769.542-1.21.38a12.035 12.035
                       0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97
                       c.363-.271.527-.734.417-1.173L6.963 3.102a1.125
                       1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0
                       2.25 4.5v2.25Z" />
                                      </svg>
                                  </span>
                                  @error('contact')
                                      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                  @enderror
                              </div>
                          </div>

                          <!-- Submit -->
                          <div class="pt-2 animate-slide-up delay-600">
                              <button type="submit" class="btn-submit">
                                  <span class="flex items-center justify-center gap-2">
                                      Register Shop
                                      <svg width="16" height="16" fill="none" stroke="currentColor"
                                          stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                      </svg>
                                  </span>
                              </button>
                          </div>

                      </form>
                  </div>
                  <!-- Bottom caption -->
                  <p class="seller-contact-footer animate-fade-in delay-600">
                      🔒 Your information is encrypted &amp; secure.
                  </p>
              </div>
          </section>


          <!-- ─── NEWSLETTER ─── -->
          <section class="newsletter">
              <div class="section-label reveal" style="justify-content:center;color:var(--secondary)">Stay Connected
              </div>
              <h2 class="newsletter-title reveal reveal-delay-1">The Mero Bazar <em style="font-style:italic">Edit</em>
              </h2>
              <p class="newsletter-sub reveal reveal-delay-2">Be the first to know about new arrivals, exclusive
                  offers,<br>and
                  stories from the world of Mero Bazar.</p>
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

              // ── NEWSLETTER
              function subscribeNewsletter() {
                  const val = document.getElementById('emailInput').value.trim();
                  if (val && val.includes('@')) {
                      showToast('Subscribed! Welcome to Mero Bazar ✓');
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

                  function pad(n) {
                      return String(n).padStart(2, '0');
                  }

                  function flip(el, val) {
                      const cur = el.textContent;
                      if (cur !== val) {
                          el.classList.add('flip');
                          setTimeout(() => {
                              el.textContent = val;
                              el.classList.remove('flip');
                          }, 150);
                      }
                  }

                  function tick() {
                      const now = Date.now();
                      let diff = Math.max(0, Math.floor((target - now) / 1000));
                      const d = Math.floor(diff / 86400);
                      diff -= d * 86400;
                      const h = Math.floor(diff / 3600);
                      diff -= h * 3600;
                      const m = Math.floor(diff / 60);
                      diff -= m * 60;
                      const s = diff;
                      flip(document.getElementById('cdDays'), pad(d));
                      flip(document.getElementById('cdHours'), pad(h));
                      flip(document.getElementById('cdMins'), pad(m));
                      flip(document.getElementById('cdSecs'), pad(s));
                  }
                  tick();
                  setInterval(tick, 1000);
              }
              startCountdown();


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

              // ── COUNTER ANIMATION (stats)
              function animateCount(el, target, suffix = '') {
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
              }, {
                  threshold: 0.6
              });
              const heroStats = document.querySelector('.hero .font-display');
              if (heroStats) statObs.observe(heroStats.closest('.flex') || heroStats);

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
