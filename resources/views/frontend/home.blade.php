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
              gap: 1.75rem;
              margin-top: 0;
              padding-top: 1.25rem;
              border-top: 1px solid rgba(171, 136, 109, 0.2);
          }

          .hero-stat-divider {
              width: 1px;
              height: 36px;
              background: rgba(171, 136, 109, 0.3);
              align-self: center;
          }

          .hero-stat-value {
              font-family: 'Cormorant Garamond', serif;
              font-size: 1.65rem;
              font-weight: 600;
              color: var(--primary);
              line-height: 1;
          }

          .hero-stat-value span {
              color: var(--secondary);
          }

          .hero-stat-label {
              font-size: 0.68rem;
              letter-spacing: 0.12em;
              text-transform: uppercase;
              color: #7a6858;
              margin-top: 4px;
          }

          /* ─── HERO ─── */
          .hero {
              height: 100vh;
              min-height: 560px;
              max-height: 820px;
              padding-top: 104px;
              display: grid;
              grid-template-columns: 1.05fr 0.95fr;
              position: relative;
              overflow: hidden;
              background: var(--cream);
              box-sizing: border-box;
          }

          .hero-left {
              display: flex;
              flex-direction: column;
              justify-content: center;
              padding: 1.5rem 5% 1.5rem 7%;
              position: relative;
              z-index: 2;
              height: 100%;
              box-sizing: border-box;
          }

          .hero-eyebrow {
              font-size: 0.72rem;
              letter-spacing: 0.26em;
              text-transform: uppercase;
              color: var(--secondary);
              font-weight: 600;
              margin-bottom: 12px;
              opacity: 0;
              transform: translateY(15px);
          }

          .hero-headline {
              font-family: 'Cormorant Garamond', serif;
              font-size: clamp(2.4rem, 4.2vw, 4.2rem);
              line-height: 1.06;
              font-weight: 300;
              color: var(--primary);
              margin-bottom: 14px;
          }

          .hero-headline em {
              font-style: italic;
              color: var(--secondary);
          }

          .hero-sub {
              font-size: 0.85rem;
              line-height: 1.65;
              color: #6b5c4e;
              max-width: 440px;
              margin-bottom: 22px;
          }

          .hero-cta-group {
              display: flex;
              gap: 14px;
              align-items: center;
              margin-bottom: 24px;
          }

          .btn-primary {
              background: var(--primary);
              color: var(--accent);
              padding: 12px 30px;
              font-size: 0.75rem;
              letter-spacing: 0.12em;
              text-transform: uppercase;
              font-weight: 500;
              border: none;
              cursor: pointer;
              text-decoration: none;
              display: inline-block;
              position: relative;
              overflow: hidden;
              transition: color 0.3s ease;
              border-radius: 2px;
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
              font-size: 0.75rem;
              letter-spacing: 0.1em;
              text-transform: uppercase;
              font-weight: 500;
              text-decoration: none;
              display: flex;
              align-items: center;
              gap: 8px;
              transition: gap 0.3s ease;
              cursor: pointer;
          }

          .btn-ghost:hover {
              gap: 14px;
          }

          .hero-right {
              position: relative;
              overflow: hidden;
              background: #2b1f14;
              height: 100%;
              width: 100%;
          }

          .hero-slider-container {
              position: relative;
              width: 100%;
              height: 100%;
              overflow: hidden;
          }

          .hero-slider-track {
              display: flex;
              width: 100%;
              height: 100%;
              transition: transform 0.65s cubic-bezier(0.25, 1, 0.5, 1);
              will-change: transform;
          }

          .hero-slide {
              flex: 0 0 100%;
              min-width: 100%;
              width: 100%;
              height: 100%;
              position: relative;
              overflow: hidden;
          }

          .hero-slide img {
              width: 100%;
              height: 100%;
              object-fit: cover;
              object-position: center;
              transition: transform 1.2s ease-out;
          }

          .hero-slide.active img {
              animation: kenBurns 4s ease-in-out infinite alternate;
          }

          @keyframes kenBurns {
              0% { transform: scale(1.0); }
              100% { transform: scale(1.06); }
          }

          .hero-slide-overlay {
              position: absolute;
              inset: 0;
              background: linear-gradient(180deg, rgba(43,31,20,0.15) 0%, rgba(43,31,20,0.05) 45%, rgba(43,31,20,0.8) 100%);
              pointer-events: none;
          }

          .hero-slide-card {
              position: absolute;
              bottom: 20px;
              left: 20px;
              right: 20px;
              background: rgba(255, 255, 255, 0.95);
              backdrop-filter: blur(14px);
              -webkit-backdrop-filter: blur(14px);
              border: 1px solid rgba(171, 136, 109, 0.35);
              padding: 13px 18px;
              border-radius: 8px;
              box-shadow: 0 14px 36px rgba(43, 31, 20, 0.24);
              display: flex;
              justify-content: space-between;
              align-items: center;
              gap: 14px;
              transform: translateY(14px);
              opacity: 0;
              transition: all 0.35s ease 0.1s;
              z-index: 5;
          }

          .hero-slide.active .hero-slide-card {
              transform: translateY(0);
              opacity: 1;
          }

          .hero-slide-header {
              display: flex;
              align-items: center;
              gap: 6px;
              margin-bottom: 4px;
              flex-wrap: wrap;
          }

          .hero-slide-tag {
              display: inline-flex;
              align-items: center;
              gap: 4px;
              background: #e63946;
              color: #fff;
              font-size: 0.62rem;
              font-weight: 700;
              letter-spacing: 0.08em;
              text-transform: uppercase;
              padding: 2px 7px;
              border-radius: 3px;
          }

          .hero-slide-discount-badge {
              display: inline-flex;
              align-items: center;
              background: rgba(43, 31, 20, 0.9);
              color: #f5f0eb;
              font-size: 0.62rem;
              font-weight: 700;
              letter-spacing: 0.06em;
              padding: 2px 7px;
              border-radius: 3px;
          }

          .hero-slide-title {
              font-family: 'Cormorant Garamond', serif;
              font-size: 1.18rem;
              font-weight: 600;
              color: var(--primary);
              line-height: 1.2;
              margin-bottom: 2px;
              white-space: nowrap;
              overflow: hidden;
              text-overflow: ellipsis;
              max-width: 270px;
          }

          .hero-slide-vendor {
              font-size: 0.72rem;
              color: #7a6858;
              display: flex;
              align-items: center;
              gap: 5px;
          }

          .hero-slide-vendor strong {
              color: var(--secondary);
              font-weight: 600;
          }

          .hero-slide-pricing {
              display: flex;
              align-items: baseline;
              gap: 8px;
              margin-top: 2px;
          }

          .hero-slide-price {
              font-size: 1.08rem;
              font-weight: 700;
              color: var(--primary);
          }

          .hero-slide-oldprice {
              font-size: 0.8rem;
              color: #a89485;
              text-decoration: line-through;
          }

          .hero-slide-action {
              flex-shrink: 0;
          }

          .hero-slide-btn {
              background: var(--primary);
              color: var(--accent);
              padding: 9px 16px;
              font-size: 0.72rem;
              font-weight: 600;
              letter-spacing: 0.08em;
              text-transform: uppercase;
              text-decoration: none;
              border-radius: 4px;
              display: inline-flex;
              align-items: center;
              gap: 6px;
              transition: background 0.25s ease, color 0.25s ease, transform 0.2s ease;
              white-space: nowrap;
          }

          .hero-slide-btn:hover {
              background: var(--secondary);
              color: #fff;
              transform: translateX(2px);
          }

          .hero-slider-nav {
              position: absolute;
              top: 16px;
              right: 16px;
              display: flex;
              align-items: center;
              gap: 8px;
              z-index: 6;
          }

          .hero-nav-btn {
              width: 34px;
              height: 34px;
              border-radius: 50%;
              background: rgba(255, 255, 255, 0.88);
              backdrop-filter: blur(6px);
              border: 1px solid rgba(171, 136, 109, 0.35);
              color: var(--primary);
              display: flex;
              align-items: center;
              justify-content: center;
              cursor: pointer;
              box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
              transition: all 0.2s ease;
          }

          .hero-nav-btn:hover {
              background: var(--primary);
              color: #fff;
              border-color: var(--primary);
              transform: scale(1.05);
          }

          .hero-slider-dots {
              position: absolute;
              top: 20px;
              left: 20px;
              display: flex;
              align-items: center;
              gap: 6px;
              z-index: 6;
          }

          .hero-dot {
              width: 22px;
              height: 4px;
              background: rgba(255, 255, 255, 0.45);
              border-radius: 2px;
              overflow: hidden;
              position: relative;
              cursor: pointer;
              transition: width 0.3s ease, background 0.3s ease;
          }

          .hero-dot.active {
              width: 36px;
              background: rgba(255, 255, 255, 0.6);
          }

          .hero-dot-progress {
              position: absolute;
              left: 0;
              top: 0;
              bottom: 0;
              width: 0%;
              background: #e63946;
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
              transform: scale(1.05);
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

          /* ─── LIVE FLASH TICKER ─── */
          .flash-ticker-bar {
              background: linear-gradient(90deg, #2b1f14 0%, #493628 50%, #2b1f14 100%);
              color: var(--accent);
              padding: 10px 8%;
              display: flex;
              justify-content: space-between;
              align-items: center;
              border-bottom: 1px solid rgba(171, 136, 109, 0.25);
              font-size: 0.8rem;
              gap: 16px;
              flex-wrap: wrap;
          }

          .flash-ticker-content {
              display: flex;
              align-items: center;
              gap: 12px;
              flex-wrap: wrap;
          }

          .flash-live-pill {
              background: #e63946;
              color: #fff;
              font-size: 0.65rem;
              font-weight: 700;
              letter-spacing: 0.12em;
              text-transform: uppercase;
              padding: 3px 10px;
              border-radius: 999px;
              display: inline-flex;
              align-items: center;
              gap: 6px;
              box-shadow: 0 0 12px rgba(230, 57, 70, 0.5);
          }

          .flash-live-dot {
              width: 6px;
              height: 6px;
              background: #fff;
              border-radius: 50%;
              animation: flashPulse 1.2s ease-in-out infinite;
          }

          @keyframes flashPulse {
              0%, 100% { opacity: 1; transform: scale(1); }
              50% { opacity: 0.3; transform: scale(0.6); }
          }

          .flash-ticker-link {
              color: var(--accent);
              font-size: 0.75rem;
              letter-spacing: 0.1em;
              text-transform: uppercase;
              text-decoration: none;
              font-weight: 600;
              display: inline-flex;
              align-items: center;
              gap: 6px;
              padding: 4px 12px;
              border: 1px solid rgba(214, 192, 179, 0.3);
              border-radius: 4px;
              transition: all 0.25s ease;
          }

          .flash-ticker-link:hover {
              background: var(--secondary);
              color: #fff;
              border-color: var(--secondary);
          }

          /* ─── FLASH SALE / FRESH DROPS SECTION ─── */
          .flash-section {
              padding: 70px 8%;
              background: #faf7f2;
              border-bottom: 1px solid rgba(171, 136, 109, 0.15);
              overflow: hidden;
          }

          .flash-section-header {
              display: flex;
              justify-content: space-between;
              align-items: flex-end;
              margin-bottom: 24px;
              gap: 20px;
              flex-wrap: wrap;
          }

          .flash-header-actions {
              display: flex;
              align-items: center;
              gap: 14px;
          }

          .flash-nav-controls {
              display: flex;
              align-items: center;
              gap: 8px;
          }

          .flash-nav-btn {
              width: 36px;
              height: 36px;
              border-radius: 50%;
              background: #ffffff;
              border: 1px solid rgba(171, 136, 109, 0.35);
              color: var(--primary);
              display: flex;
              align-items: center;
              justify-content: center;
              cursor: pointer;
              transition: all 0.2s ease;
          }

          .flash-nav-btn:hover {
              background: var(--primary);
              color: #ffffff;
              border-color: var(--primary);
          }

          .flash-heading-badge {
              display: inline-flex;
              align-items: center;
              gap: 6px;
              background: rgba(230, 57, 70, 0.1);
              color: #c1121f;
              border: 1px solid rgba(230, 57, 70, 0.25);
              padding: 4px 12px;
              border-radius: 999px;
              font-size: 0.72rem;
              font-weight: 700;
              letter-spacing: 0.08em;
              text-transform: uppercase;
              margin-bottom: 8px;
          }

          .flash-flow-wrapper {
              position: relative;
              width: 100%;
              overflow-x: auto;
              overflow-y: hidden;
              scroll-behavior: smooth;
              scrollbar-width: none;
              -ms-overflow-style: none;
              padding: 10px 2px 24px;
          }

          .flash-flow-wrapper::-webkit-scrollbar {
              display: none;
          }

          .flash-flow-track {
              display: flex;
              gap: 20px;
              width: max-content;
              transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
          }

          .flash-card {
              flex: 0 0 270px;
              width: 270px;
              background: #ffffff;
              border: 1px solid rgba(171, 136, 109, 0.2);
              border-radius: 6px;
              overflow: hidden;
              display: flex;
              flex-direction: column;
              text-decoration: none;
              color: inherit;
              transition: transform 0.35s cubic-bezier(0.2, 0, 0.2, 1), box-shadow 0.35s ease, border-color 0.35s ease;
          }

          .flash-card:hover {
              transform: translateY(-8px);
              box-shadow: 0 20px 40px rgba(73, 54, 40, 0.15);
              border-color: var(--secondary);
          }

          .flash-img-container {
              position: relative;
              width: 100%;
              aspect-ratio: 1 / 1;
              overflow: hidden;
              background: #f4ede6;
          }

          .flash-img-container img {
              width: 100%;
              height: 100%;
              object-fit: cover;
              transition: transform 0.6s cubic-bezier(0.2, 0, 0.2, 1);
          }

          .flash-card:hover .flash-img-container img {
              transform: scale(1.06);
          }

          .flash-tag-pill {
              position: absolute;
              top: 10px;
              left: 10px;
              background: rgba(43, 31, 20, 0.85);
              backdrop-filter: blur(4px);
              color: #fff;
              font-size: 0.62rem;
              font-weight: 600;
              letter-spacing: 0.08em;
              text-transform: uppercase;
              padding: 3px 8px;
              border-radius: 3px;
              z-index: 2;
          }

          .flash-time-badge {
              position: absolute;
              bottom: 10px;
              right: 10px;
              background: rgba(255, 255, 255, 0.92);
              backdrop-filter: blur(4px);
              color: #493628;
              font-size: 0.65rem;
              font-weight: 600;
              padding: 3px 8px;
              border-radius: 3px;
              display: flex;
              align-items: center;
              gap: 4px;
              box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
              z-index: 2;
          }

          .flash-card-info {
              padding: 16px;
              display: flex;
              flex-direction: column;
              justify-content: space-between;
              flex-grow: 1;
              background: #ffffff;
          }

          .flash-vendor-row {
              display: flex;
              justify-content: space-between;
              align-items: center;
              font-size: 0.72rem;
              color: #8c7361;
              margin-bottom: 6px;
          }

          .flash-vendor-name {
              display: inline-flex;
              align-items: center;
              gap: 4px;
              font-weight: 600;
              color: var(--secondary);
              max-width: 140px;
              overflow: hidden;
              text-overflow: ellipsis;
              white-space: nowrap;
          }

          .flash-card-title {
              font-family: 'Cormorant Garamond', serif;
              font-size: 1.15rem;
              font-weight: 600;
              color: var(--primary);
              line-height: 1.25;
              margin-bottom: 10px;
              display: -webkit-box;
              -webkit-line-clamp: 2;
              -webkit-box-orient: vertical;
              overflow: hidden;
              min-height: 2.8em;
          }

          .flash-card-pricing {
              display: flex;
              align-items: baseline;
              gap: 8px;
              margin-bottom: 12px;
          }

          .flash-price-main {
              font-size: 1.05rem;
              font-weight: 700;
              color: var(--primary);
          }

          .flash-price-old {
              font-size: 0.8rem;
              color: #a89485;
              text-decoration: line-through;
          }

          .flash-card-bottom {
              display: flex;
              justify-content: space-between;
              align-items: center;
              padding-top: 10px;
              border-top: 1px solid rgba(171, 136, 109, 0.15);
          }

          .flash-btn-add {
              font-size: 0.72rem;
              font-weight: 600;
              letter-spacing: 0.08em;
              text-transform: uppercase;
              color: var(--secondary);
              transition: transform 0.2s ease, color 0.2s ease;
          }

          .flash-card:hover .flash-btn-add {
              color: var(--primary);
              transform: translateX(3px);
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
              cursor: pointer;
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
              cursor: pointer;
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

          .product-card-link {
              text-decoration: none !important;
              color: inherit !important;
              display: block;
          }

          .product-card-link:hover,
          .product-card-link:focus,
          .product-card-link:visited {
              text-decoration: none !important;
              color: inherit !important;
          }

          .product-card {
              background: white;
              position: relative;
              cursor: pointer;
              overflow: hidden;
              color: var(--primary);
              text-decoration: none;
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
              cursor: pointer;
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
              cursor: pointer;
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
              cursor: pointer;
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
              cursor: pointer;
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
              cursor: pointer;
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
              .hero {
                  height: auto;
                  min-height: calc(100vh - 104px);
                  max-height: none;
                  grid-template-columns: 1fr 1fr;
              }

              .hero-left {
                  padding: 2rem 4%;
              }

              .hero-headline {
                  font-size: clamp(2.2rem, 4vw, 3.4rem);
              }

              .flash-grid {
                  grid-template-columns: repeat(3, 1fr);
                  gap: 18px;
              }

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
                  height: auto;
                  min-height: auto;
                  max-height: none;
                  padding-top: 104px;
              }

              .hero-right {
                  height: 380px;
                  min-height: 320px;
                  order: -1;
              }

              .hero-left {
                  padding: 24px 5% 32px;
              }

              .hero-headline {
                  font-size: clamp(2rem, 8vw, 2.8rem);
                  margin-bottom: 12px;
              }

              .hero-sub {
                  max-width: none;
                  margin-bottom: 18px;
              }

              .hero-cta-group {
                  flex-wrap: wrap;
                  gap: 12px;
                  margin-bottom: 20px;
              }

              .hero-stats {
                  justify-content: space-between;
                  gap: 1rem;
                  padding-top: 1rem;
              }

              .hero-stat-divider {
                  display: none;
              }

              .hero-floating-card {
                  display: none;
              }

              .hero-slide-card {
                  bottom: 12px;
                  left: 12px;
                  right: 12px;
                  padding: 10px 14px;
              }

              .hero-slide-title {
                  max-width: 200px;
                  font-size: 1.1rem;
              }

              .flash-section {
                  padding: 48px 5%;
              }

              .flash-ticker-bar {
                  padding: 10px 5%;
              }

              .flash-grid {
                  grid-template-columns: repeat(2, 1fr);
                  gap: 14px;
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
              .hero {
                  padding-top: 96px;
              }

              .hero-right {
                  height: 310px;
                  min-height: 290px;
              }

              .hero-slide-card {
                  bottom: 8px;
                  left: 8px;
                  right: 8px;
                  padding: 9px 11px;
                  gap: 8px;
              }

              .hero-slide-title {
                  max-width: 160px;
                  font-size: 1rem;
              }

              .hero-slide-btn {
                  padding: 7px 11px;
                  font-size: 0.68rem;
              }

              .flash-grid {
                  grid-template-columns: 1fr;
                  gap: 14px;
              }

              .flash-ticker-bar {
                  flex-direction: column;
                  align-items: flex-start;
                  gap: 8px;
              }

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
                      <a href="{{ route('products') }}" class="btn-primary"><span>Explore Collection</span></a>
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
                          <div class="hero-stat-value">{{ $products->count() }}<span>+</span></div>
                          <div class="hero-stat-label">Products</div>
                      </div>
                      <div class="hero-stat-divider"></div>
                      <div>
                          <div class="hero-stat-value">{{ $sellercount }}<span>+</span></div>
                          <div class="hero-stat-label">Seller</div>
                      </div>
                  </div>
              </div>

              <div class="hero-right">
                  <div class="hero-slider-container" id="heroSlider">
                      @php
                          $slidesToUse = (isset($heroSlides) && $heroSlides->count() > 0) ? $heroSlides : ((isset($flashProducts) && $flashProducts->count() > 0) ? $flashProducts : null);
                      @endphp

                      @if($slidesToUse && $slidesToUse->count() > 0)
                          <div class="hero-slider-dots">
                              @foreach ($slidesToUse as $index => $slide)
                                  <div class="hero-dot {{ $index === 0 ? 'active' : '' }}" onclick="goToHeroSlide({{ $index }})">
                                      <div class="hero-dot-progress"></div>
                                  </div>
                              @endforeach
                          </div>

                          <div class="hero-slider-nav">
                              <button type="button" class="hero-nav-btn" onclick="prevHeroSlide()" aria-label="Previous slide">
                                  <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                      <path d="M15 18l-6-6 6-6" />
                                  </svg>
                              </button>
                              <button type="button" class="hero-nav-btn" onclick="nextHeroSlide()" aria-label="Next slide">
                                  <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                      <path d="M9 18l6-6-6-6" />
                                  </svg>
                              </button>
                          </div>

                          <div class="hero-slider-track" id="heroSliderTrack">
                              @foreach ($slidesToUse as $index => $slide)
                                  <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" data-slide-index="{{ $index }}">
                                      <img src="{{ $slide->main_image_url }}" alt="{{ $slide->name }}" loading="{{ $index === 0 ? 'eager' : 'lazy' }}" />
                                      <div class="hero-slide-overlay"></div>
                                      <div class="hero-slide-card">
                                           <div>
                                               <div class="hero-slide-header">
                                                   <span class="hero-slide-tag">⚡ Flash Sale • Live</span>
                                                   @if ($slide->is_discounted)
                                                       <span class="hero-slide-discount-badge">-{{ $slide->discount_percent }}% OFF</span>
                                                   @endif
                                               </div>
                                               <div class="hero-slide-title" title="{{ $slide->name }}">{{ $slide->name }}</div>
                                               <div class="hero-slide-vendor">
                                                   <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                       <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                       <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                   </svg>
                                                   By <strong>{{ $slide->seller->shop_name ?? $slide->seller->name ?? 'Verified Merchant' }}</strong>
                                               </div>
                                               <div class="hero-slide-pricing">
                                                   <span class="hero-slide-price">Rs. {{ number_format($slide->effective_price, 2) }}</span>
                                                   @if ($slide->is_discounted)
                                                       <span class="hero-slide-oldprice">Rs. {{ number_format($slide->price, 2) }}</span>
                                                   @endif
                                               </div>
                                           </div>
                                           <div class="hero-slide-action">
                                               <a href="{{ route('product', $slide->id) }}" class="hero-slide-btn">
                                                   View Drop
                                                   <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                       <path d="M5 12h14M13 6l6 6-6 6" />
                                                   </svg>
                                               </a>
                                           </div>
                                       </div>
                                  </div>
                              @endforeach
                          </div>
                      @else
                          <div class="hero-img-container">
                              <img src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=900&q=80&auto=format"
                                  alt="Hero fashion" />
                              <div class="hero-img-overlay"></div>
                          </div>
                      @endif
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

          {{-- ⚡ LIVE FLASH DROPS & FLASH SALES FROM VENDORS --}}
          @if(isset($activeFlashSales) && $activeFlashSales->count() > 0)
              @php
                  $earliestEnd = $activeFlashSales->min('end_time');
              @endphp
              <div class="flash-ticker-bar">
                  <div class="flash-ticker-content">
                      <span class="flash-live-pill"><span class="flash-live-dot"></span> ⚡ FLASH SALE LIVE</span>
                      <span>
                          <strong>Limited Time Offers!</strong>
                          Special discounted prices from approved merchants. Next deal ends in: <strong class="global-flash-countdown" data-countdown="{{ $earliestEnd ? $earliestEnd->toIso8601String() : '' }}">Calculating...</strong>
                      </span>
                  </div>
                  <a href="#flash-deals" class="flash-ticker-link">
                      View All Deals
                      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                          <path d="M5 12h14M13 6l6 6-6 6" />
                      </svg>
                  </a>
              </div>

              <section class="flash-section" id="flash-deals">
                  <div class="flash-section-header">
                      <div>
                          <div class="flash-heading-badge reveal">
                              <span>⚡ Limited Time • Flash Deals</span>
                          </div>
                          <h2 class="section-title reveal reveal-delay-1" style="margin-bottom:4px">
                              Exclusive <em>Flash Sales</em>
                          </h2>
                          <p style="font-size:0.85rem;color:#7a6858;" class="reveal reveal-delay-2">
                              Special low prices directly from verified merchants. Prices automatically revert when timer expires!
                          </p>
                      </div>
                      <div class="flash-header-actions reveal reveal-delay-2">
                          <div class="flash-nav-controls">
                              <button type="button" class="flash-nav-btn" onclick="scrollFlashFlow(-1)" aria-label="Scroll left">
                                  <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                      <path d="M15 18l-6-6 6-6" />
                                  </svg>
                              </button>
                              <button type="button" class="flash-nav-btn" onclick="scrollFlashFlow(1)" aria-label="Scroll right">
                                  <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                      <path d="M9 18l6-6-6-6" />
                                  </svg>
                              </button>
                          </div>
                          <a href="{{ route('products') }}" class="btn-ghost" style="margin-bottom:2px">
                              All Products
                              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                  <path d="M5 12h14M13 6l6 6-6 6" />
                              </svg>
                          </a>
                      </div>
                  </div>

                  <div class="flash-flow-wrapper" id="flashFlowWrapper">
                      <div class="flash-flow-track" id="flashFlowTrack">
                          @foreach ($activeFlashSales as $flashSale)
                              @php
                                  $item = $flashSale->product;
                                  $pctSold = $flashSale->flash_stock > 0 ? min(100, round(($flashSale->sold_quantity / $flashSale->flash_stock) * 100)) : 0;
                              @endphp
                              <a href="{{ route('product', $item->id) }}" class="flash-card reveal product-card-link">
                                  <div class="flash-img-container">
                                      <img src="{{ $item->main_image_url }}" alt="{{ $item->name }}" loading="lazy" />
                                      <div class="flash-tag-pill" style="background:#e63946;color:#fff;">
                                          ⚡ -{{ $flashSale->discount_percent }}% OFF
                                      </div>
                                      <div class="flash-time-badge item-countdown" data-countdown="{{ $flashSale->end_time->toIso8601String() }}">
                                          <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                              <circle cx="12" cy="12" r="10"></circle>
                                              <path d="M12 6v6l4 2"></path>
                                          </svg>
                                          <span>Ending soon</span>
                                      </div>
                                  </div>

                                  <div class="flash-card-info">
                                      <div>
                                          <div class="flash-vendor-row">
                                              <span class="flash-vendor-name" title="{{ $flashSale->seller->store_name ?? $flashSale->seller->name ?? 'Merchant' }}">
                                                  <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                      <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                      <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                  </svg>
                                                  {{ $flashSale->seller->store_name ?? $flashSale->seller->name ?? 'Merchant' }}
                                              </span>
                                              @if($item->category)
                                                  <span style="font-size:0.68rem;opacity:0.85;">{{ $item->category->name }}</span>
                                              @endif
                                          </div>

                                          <div class="flash-card-title">{{ $item->name }}</div>

                                          <div class="flash-card-pricing">
                                              <span class="flash-price-main">Rs. {{ number_format($flashSale->flash_price, 2) }}</span>
                                              <span class="flash-price-old">Rs. {{ number_format($item->price, 2) }}</span>
                                          </div>

                                          <div style="margin-top:8px;">
                                              <div style="display:flex; justify-content:space-between; font-size:0.68rem; color:#7a6858; margin-bottom:3px;">
                                                  <span>Sold: {{ $flashSale->sold_quantity }}/{{ $flashSale->flash_stock }}</span>
                                                  <span>{{ $flashSale->remaining_stock }} left</span>
                                              </div>
                                              <div style="width:100%; height:4px; background:rgba(73,54,40,0.1); border-radius:2px; overflow:hidden;">
                                                  <div style="width:{{ $pctSold }}%; height:100%; background:#e63946; border-radius:2px;"></div>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="flash-card-bottom" style="margin-top:10px;">
                                          <div class="product-rating" style="margin-bottom:0;">
                                              <span class="stars" style="font-size:0.75rem;">★</span>
                                              <span style="font-size:0.72rem;font-weight:600;">{{ number_format($item->reviews_avg_rating ?? 5.0, 1) }}</span>
                                          </div>
                                          <span class="flash-btn-add">Grab Deal →</span>
                                      </div>
                                  </div>
                              </a>
                          @endforeach
                      </div>
                  </div>
              </section>
          @elseif(isset($flashProducts) && $flashProducts->count() > 0)

              <section class="flash-section" id="flash-arrivals">
                  <div class="flash-section-header">
                      <div>
                          <div class="flash-heading-badge reveal">
                              <span>⚡ Just In • Live Flow</span>
                          </div>
                          <h2 class="section-title reveal reveal-delay-1" style="margin-bottom:4px">
                              Vendor <em>Fresh Drops</em>
                          </h2>
                          <p style="font-size:0.85rem;color:#7a6858;" class="reveal reveal-delay-2">
                              Newly listed items by approved artisans and independent merchants across Nepal.
                          </p>
                      </div>
                      <div class="flash-header-actions reveal reveal-delay-2">
                          <div class="flash-nav-controls">
                              <button type="button" class="flash-nav-btn" onclick="scrollFlashFlow(-1)" aria-label="Scroll left">
                                  <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                      <path d="M15 18l-6-6 6-6" />
                                  </svg>
                              </button>
                              <button type="button" class="flash-nav-btn" onclick="scrollFlashFlow(1)" aria-label="Scroll right">
                                  <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                      <path d="M9 18l6-6-6-6" />
                                  </svg>
                              </button>
                          </div>
                          <a href="{{ route('products') }}" class="btn-ghost" style="margin-bottom:2px">
                              Explore All
                              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                  <path d="M5 12h14M13 6l6 6-6 6" />
                              </svg>
                          </a>
                      </div>
                  </div>

                  <div class="flash-flow-wrapper" id="flashFlowWrapper">
                      <div class="flash-flow-track" id="flashFlowTrack">
                          @foreach ($flashProducts as $flashItem)
                              <a href="{{ route('product', $flashItem->id) }}" class="flash-card reveal product-card-link">
                                  <div class="flash-img-container">
                                      <img src="{{ $flashItem->main_image_url }}" alt="{{ $flashItem->name }}" loading="lazy" />
                                      <div class="flash-tag-pill">
                                          ⚡ Fresh Drop
                                      </div>
                                      <div class="flash-time-badge">
                                          <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                              <circle cx="12" cy="12" r="10"></circle>
                                              <path d="M12 6v6l4 2"></path>
                                          </svg>
                                          {{ $flashItem->created_at ? $flashItem->created_at->diffForHumans() : 'Recent' }}
                                      </div>
                                  </div>

                                  <div class="flash-card-info">
                                      <div>
                                          <div class="flash-vendor-row">
                                              <span class="flash-vendor-name" title="{{ $flashItem->seller->store_name ?? $flashItem->seller->name ?? 'Vendor' }}">
                                                  <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                      <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                      <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                  </svg>
                                                  {{ $flashItem->seller->store_name ?? $flashItem->seller->name ?? 'Vendor' }}
                                              </span>
                                              @if($flashItem->category)
                                                  <span style="font-size:0.68rem;opacity:0.85;">{{ $flashItem->category->name }}</span>
                                              @endif
                                          </div>

                                          <div class="flash-card-title">{{ $flashItem->name }}</div>

                                          <div class="flash-card-pricing">
                                              <span class="flash-price-main">Rs. {{ number_format($flashItem->effective_price, 2) }}</span>
                                              @if ($flashItem->is_discounted)
                                                  <span class="flash-price-old">Rs. {{ number_format($flashItem->price, 2) }}</span>
                                              @endif
                                          </div>
                                      </div>

                                      <div class="flash-card-bottom">
                                          <div class="product-rating" style="margin-bottom:0;">
                                              <span class="stars" style="font-size:0.75rem;">★</span>
                                              <span style="font-size:0.72rem;font-weight:600;">{{ number_format($flashItem->reviews_avg_rating ?? 5.0, 1) }}</span>
                                          </div>
                                          <span class="flash-btn-add">View Item →</span>
                                      </div>
                                  </div>
                              </a>
                          @endforeach
                      </div>
                  </div>
              </section>
          @endif

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
                          <img src="{{ $category->image_url }}" alt="{{ $category->name }}" loading="lazy" onerror="this.onerror=null; this.src='{{ $category->fallback_image_url }}';" />
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
                      <a href="{{ route('product', $product->id) }}" class="product-card-link">
                          <div class="product-card reveal" data-tag="new trending">
                              <div class="product-img-wrap">
                                  <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" />
                                  @if ($product->is_new)
                                      <span class="product-badge">New</span>
                                  @endif
                                  <div class="product-actions">
                                      <button class="add-cart-btn"
                                          onclick="event.preventDefault(); event.stopPropagation(); submitAddToCart({{ $product->id }})">Add
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
                          <a href="{{ route('product', $product->id) }}" class="product-card-link">
                              <div class="product-card reveal" data-tag="new trending">
                                  <div class="product-img-wrap">
                                      <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" />
                                      @if ($product->is_new)
                                          <span class="product-badge">New</span>
                                      @endif
                                      <div class="product-actions">
                                          <button class="add-cart-btn"
                                              onclick="event.preventDefault(); event.stopPropagation(); submitAddToCart({{ $product->id }})">Add
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
                  if (card) {
                      setTimeout(() => {
                          card.style.opacity = '1';
                          card.style.transform = 'translateX(0)';
                          card.style.transition = 'all 0.7s cubic-bezier(0.25,0.46,0.45,0.94)';
                      }, 1100);
                  }
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

              function submitAddToCart(productId) {
                  const form = document.createElement('form');
                  form.method = 'POST';
                  form.action = '{{ route("cart.store") }}';

                  const csrf = document.createElement('input');
                  csrf.type = 'hidden';
                  csrf.name = '_token';
                  csrf.value = '{{ csrf_token() }}';
                  form.appendChild(csrf);

                  const pid = document.createElement('input');
                  pid.type = 'hidden';
                  pid.name = 'product_id';
                  pid.value = productId;
                  form.appendChild(pid);

                  const qty = document.createElement('input');
                  qty.type = 'hidden';
                  qty.name = 'quantity';
                  qty.value = '1';
                  form.appendChild(qty);

                  document.body.appendChild(form);
                  form.submit();
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

              // ── HERO 2-SECOND HORIZONTAL SLIDING FLOW ──
              (function() {
                  let currentHeroSlide = 0;
                  const track = document.getElementById('heroSliderTrack');
                  const heroSlides = document.querySelectorAll('.hero-slide');
                  const heroDots = document.querySelectorAll('.hero-dot');
                  const totalHeroSlides = heroSlides.length;
                  let heroSlideTimer = null;

                  if (totalHeroSlides <= 1) return;

                  function updateHeroDots() {
                      heroDots.forEach((dot, idx) => {
                          const bar = dot.querySelector('.hero-dot-progress');
                          if (bar) {
                              bar.style.transition = 'none';
                              bar.style.width = '0%';
                          }
                          dot.classList.toggle('active', idx === currentHeroSlide);
                      });

                      const activeDot = heroDots[currentHeroSlide];
                      if (activeDot) {
                          const activeBar = activeDot.querySelector('.hero-dot-progress');
                          if (activeBar) {
                              void activeBar.offsetWidth; // Force reflow
                              activeBar.style.transition = 'width 2s linear';
                              activeBar.style.width = '100%';
                          }
                      }
                  }

                  function showHeroSlide(index) {
                      currentHeroSlide = (index + totalHeroSlides) % totalHeroSlides;
                      if (track) {
                          track.style.transform = `translateX(-${currentHeroSlide * 100}%)`;
                      }
                      heroSlides.forEach((slide, idx) => {
                          slide.classList.toggle('active', idx === currentHeroSlide);
                      });
                      updateHeroDots();
                  }

                  window.nextHeroSlide = function() {
                      showHeroSlide(currentHeroSlide + 1);
                      startHeroAutoTimer();
                  };

                  window.prevHeroSlide = function() {
                      showHeroSlide(currentHeroSlide - 1);
                      startHeroAutoTimer();
                  };

                  window.goToHeroSlide = function(index) {
                      showHeroSlide(index);
                      startHeroAutoTimer();
                  };

                  function startHeroAutoTimer() {
                      if (heroSlideTimer) clearInterval(heroSlideTimer);
                      heroSlideTimer = setInterval(() => {
                          showHeroSlide(currentHeroSlide + 1);
                      }, 2000); // ⚡ Auto-slides horizontally every 2 seconds in infinite loop
                  }

                  // Initial setup
                  showHeroSlide(0);
                  startHeroAutoTimer();

                  // Pause on hover
                  const sliderWrap = document.getElementById('heroSlider');
                  if (sliderWrap) {
                      sliderWrap.addEventListener('mouseenter', () => {
                          if (heroSlideTimer) clearInterval(heroSlideTimer);
                          const activeDot = heroDots[currentHeroSlide];
                          if (activeDot) {
                              const activeBar = activeDot.querySelector('.hero-dot-progress');
                              if (activeBar) {
                                  const computedWidth = window.getComputedStyle(activeBar).width;
                                  activeBar.style.transition = 'none';
                                  activeBar.style.width = computedWidth;
                              }
                          }
                      });
                      sliderWrap.addEventListener('mouseleave', () => {
                          startHeroAutoTimer();
                          const activeDot = heroDots[currentHeroSlide];
                          if (activeDot) {
                              const activeBar = activeDot.querySelector('.hero-dot-progress');
                              if (activeBar) {
                                  activeBar.style.transition = 'width 2s linear';
                                  activeBar.style.width = '100%';
                              }
                          }
                      });

                      // Touch swipe support for mobile
                      let touchStartX = 0;
                      let touchEndX = 0;

                      sliderWrap.addEventListener('touchstart', (e) => {
                          touchStartX = e.changedTouches[0].screenX;
                      }, { passive: true });

                      sliderWrap.addEventListener('touchend', (e) => {
                          touchEndX = e.changedTouches[0].screenX;
                          if (touchStartX - touchEndX > 45) {
                              nextHeroSlide();
                          } else if (touchEndX - touchStartX > 45) {
                              prevHeroSlide();
                          }
                      }, { passive: true });
                  }

                  // Pause when tab is not visible
                  document.addEventListener('visibilitychange', () => {
                      if (document.hidden) {
                          if (heroSlideTimer) clearInterval(heroSlideTimer);
                      } else {
                          startHeroAutoTimer();
                      }
                  });
              })();

              // ── VENDOR FRESH DROPS FLOWING CAROUSEL ──
              (function() {
                  const flowWrapper = document.getElementById('flashFlowWrapper');
                  if (!flowWrapper) return;

                  let flowTimer = null;
                  const scrollStep = 290; // Card width + gap

                  window.scrollFlashFlow = function(dir) {
                      flowWrapper.scrollBy({
                          left: dir * scrollStep,
                          behavior: 'smooth'
                      });
                      startFlashAutoFlow();
                  };

                  function autoFlow() {
                      const maxScroll = flowWrapper.scrollWidth - flowWrapper.clientWidth;
                      if (flowWrapper.scrollLeft >= maxScroll - 10) {
                          flowWrapper.scrollTo({ left: 0, behavior: 'smooth' });
                      } else {
                          flowWrapper.scrollBy({ left: scrollStep, behavior: 'smooth' });
                      }
                  }

                  function startFlashAutoFlow() {
                      if (flowTimer) clearInterval(flowTimer);
                      flowTimer = setInterval(autoFlow, 2500); // Auto-advances every 2.5s
                  }

                  startFlashAutoFlow();

                  flowWrapper.addEventListener('mouseenter', () => {
                      if (flowTimer) clearInterval(flowTimer);
                  });

                  flowWrapper.addEventListener('mouseleave', () => {
                      startFlashAutoFlow();
                  });
              })();

              // ── LIVE FLASH SALE COUNTDOWNS ──
              (function() {
                  function updateCountdowns() {
                      const now = new Date().getTime();
                      document.querySelectorAll('[data-countdown]').forEach(el => {
                          const endTimeStr = el.getAttribute('data-countdown');
                          if (!endTimeStr) return;
                          const endTime = new Date(endTimeStr).getTime();
                          const diff = endTime - now;

                          if (diff <= 0) {
                              const span = el.querySelector('span') || el;
                              span.textContent = 'Sale Ended';
                              return;
                          }

                          const hours = Math.floor(diff / (1000 * 60 * 60));
                          const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                          const secs = Math.floor((diff % (1000 * 60)) / 1000);

                          const formatted = `${String(hours).padStart(2, '0')}:${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
                          const span = el.querySelector('span') || el;
                          span.textContent = formatted;
                      });
                  }

                  updateCountdowns();
                  setInterval(updateCountdowns, 1000);
              })();
          </script>
      </div>
  </x-layout>
