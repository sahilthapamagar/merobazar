<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&family=Playfair+Display:ital,wght@0,700;1,400&display=swap"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #493628;
            --secondary: #AB886D;
            --accent: #D6C0B3;
            --background: #E4E0E1;
            --cream: #F5F0EB;
            --dark: #2B1F14;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
            width: 100%;
        }

        body {
            background-color: var(--background);
            color: var(--primary);
            font-family: 'DM Sans', sans-serif;
            overflow-x: hidden;
            cursor: none;
            width: 100%;
            max-width: 100%;
        }

        /* ─── CUSTOM CURSOR ─── */
        .cursor-dot {
            width: 8px;
            height: 8px;
            background: var(--primary);
            border-radius: 50%;
            position: fixed;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%);
            transition: transform 0.1s ease;
        }

        .cursor-ring {
            width: 36px;
            height: 36px;
            border: 1.5px solid var(--secondary);
            border-radius: 50%;
            position: fixed;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 9998;
            transform: translate(-50%, -50%);
            transition: all 0.18s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .cursor-ring.hovering {
            width: 60px;
            height: 60px;
            background: rgba(171, 136, 109, 0.08);
            border-color: var(--primary);
        }

        .cursor-dot,
        .cursor-ring {
            opacity: 0;
        }

        .cursor-dot.is-active,
        .cursor-ring.is-active {
            opacity: 1;
        }

        /* ─── NOISE TEXTURE OVERLAY ─── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9990;
            opacity: 0.4;
        }

        /* ─── TYPOGRAPHY ─── */
        .font-display {
            font-family: 'Cormorant Garamond', serif;
        }

        .font-editorial {
            font-family: 'Playfair Display', serif;
        }

        .font-body {
            font-family: 'DM Sans', sans-serif;
        }

        /* ─── SCROLLBAR ─── */
        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-track {
            background: var(--background);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--secondary);
            border-radius: 4px;
        }

        @media (pointer: coarse), (max-width: 768px) {
            body {
                cursor: auto;
            }

            .cursor-dot,
            .cursor-ring {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="cursor-dot" id="cursorDot"></div>
    <div class="cursor-ring" id="cursorRing"></div>
    @include('sweetalert::alert')

    <x-navbar />

    {{ $slot }}

    <x-footer />

    <script>
        (function initCustomCursor() {
            if (window.__customCursorInitialized) {
                return;
            }
            window.__customCursorInitialized = true;

            const dot = document.getElementById('cursorDot');
            const ring = document.getElementById('cursorRing');
            if (!dot || !ring) {
                return;
            }

            if (window.matchMedia('(pointer: coarse)').matches || window.innerWidth <= 768) {
                document.body.style.cursor = 'auto';
                dot.style.display = 'none';
                ring.style.display = 'none';
                return;
            }

            let mouseX = 0;
            let mouseY = 0;
            let ringX = 0;
            let ringY = 0;

            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
                dot.classList.add('is-active');
                ring.classList.add('is-active');
                dot.style.left = mouseX + 'px';
                dot.style.top = mouseY + 'px';
            });

            function animateRing() {
                ringX += (mouseX - ringX) * 0.14;
                ringY += (mouseY - ringY) * 0.14;
                ring.style.left = ringX + 'px';
                ring.style.top = ringY + 'px';
                requestAnimationFrame(animateRing);
            }

            animateRing();

            document.querySelectorAll(
                'a, button, input, label, select, textarea, [role="button"], .product-interactive'
            ).forEach((el) => {
                el.addEventListener('mouseenter', () => ring.classList.add('hovering'));
                el.addEventListener('mouseleave', () => ring.classList.remove('hovering'));
            });
        })();
    </script>

</body>

</html>
