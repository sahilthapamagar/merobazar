<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @laravelPWA
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&family=Montserrat:wght@600;700&family=Playfair+Display:ital,wght@0,700;1,400&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css">
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
            width: 100%;
            max-width: 100%;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        a,
        button,
        [role="button"],
        input[type="submit"],
        input[type="button"],
        select,
        .cursor-pointer {
            cursor: pointer;
        }

        /* ─── NOISE TEXTURE OVERLAY ─── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9980;
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
    </style>
</head>

<body>
    @include('sweetalert::alert')

    <x-navbar />

    {{ $slot }}

    <x-footer />
    <x-chat-widget />

    <style>
        [x-cloak] { display: none !important; }
        
        /* PWA Install Button Style */
        #pwa-install-btn {
            display: none;
            position: fixed;
            bottom: 24px;
            left: 24px;
            z-index: 9999;
            background: var(--primary);
            color: var(--accent);
            border: none;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: transform 0.3s;
        }
        #pwa-install-btn:hover {
            transform: scale(1.05);
        }
    </style>
    
    <button id="pwa-install-btn">
        <i class="fas fa-download"></i> Install App
    </button>

    <script>
        let deferredPrompt;
        const installBtn = document.getElementById('pwa-install-btn');

        window.addEventListener('beforeinstallprompt', (e) => {
            // Prevent the mini-infobar from appearing on mobile
            e.preventDefault();
            // Stash the event so it can be triggered later.
            deferredPrompt = e;
            // Update UI notify the user they can install the PWA
            installBtn.style.display = 'block';
        });

        installBtn.addEventListener('click', async () => {
            // Hide the app provided install promotion
            installBtn.style.display = 'none';
            // Show the install prompt
            deferredPrompt.prompt();
            // Wait for the user to respond to the prompt
            const { outcome } = await deferredPrompt.userChoice;
            console.log(`User response to the install prompt: ${outcome}`);
            // We've used the prompt, and can't use it again, throw it away
            deferredPrompt = null;
        });

        window.addEventListener('appinstalled', () => {
            // Hide the app-provided install promotion
            installBtn.style.display = 'none';
            // Clear the deferredPrompt so it can be garbage collected
            deferredPrompt = null;
            console.log('PWA was installed');
        });
    </script>
</body>

</html>
