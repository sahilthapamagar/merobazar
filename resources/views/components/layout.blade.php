<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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

</body>

</html>
