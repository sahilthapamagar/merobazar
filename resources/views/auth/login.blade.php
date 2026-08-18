<x-layout>
    <style>
        /* ─── PAGE LAYOUT ─── */
        .login-page {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
            width: 100vw;
        }

        /* ─── LEFT PANEL ─── */
        .left-panel {
            position: relative;
            background: var(--dark);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 52px;
            overflow: hidden;
        }

        /* ambient glow */
        .left-panel::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 28% 62%, rgba(171, 136, 109, 0.2) 0%, transparent 60%);
            pointer-events: none;
        }

        /* decorative rings */
        .deco-ring {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(171, 136, 109, 0.1);
            pointer-events: none;
        }

        .deco-ring-1 {
            width: 480px;
            height: 480px;
            right: -180px;
            top: 50%;
            transform: translateY(-50%);
        }

        .deco-ring-2 {
            width: 300px;
            height: 300px;
            right: -60px;
            top: 50%;
            transform: translateY(-50%);
        }

        .deco-ring-3 {
            width: 140px;
            height: 140px;
            right: 40px;
            top: 50%;
            transform: translateY(-50%);
            border-color: rgba(171, 136, 109, 0.06);
        }

        /* brand */
        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            z-index: 2;
            opacity: 0;
            animation: fadeUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.1s forwards;
        }

        .brand-mark {
            width: 38px;
            height: 38px;
            border: 1.5px solid var(--secondary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .brand-mark span {
            font-family: 'Cormorant Garamond', serif;
            color: var(--secondary);
            font-size: 17px;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .brand-name {
            font-family: 'Cormorant Garamond', serif;
            color: var(--cream);
            font-size: 17px;
            font-weight: 300;
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        /* left main text */
        .left-content {
            position: relative;
            z-index: 2;
            opacity: 0;
            animation: fadeUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.3s forwards;
        }

        .left-eyebrow {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--secondary);
            margin-bottom: 20px;
        }

        .left-eyebrow::before {
            content: '';
            display: block;
            width: 28px;
            height: 1px;
            background: var(--secondary);
            opacity: 0.5;
        }

        .left-headline {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(38px, 4.2vw, 62px);
            font-weight: 300;
            color: var(--cream);
            line-height: 1.08;
            margin-bottom: 28px;
            letter-spacing: -0.5px;
        }

        .left-headline em {
            font-style: italic;
            color: var(--accent);
        }

        .left-body {
            font-size: 13px;
            font-weight: 300;
            color: rgba(245, 240, 235, 0.42);
            letter-spacing: 0.4px;
            line-height: 1.75;
            max-width: 260px;
        }

        /* left footer */
        .left-footer {
            position: relative;
            z-index: 2;
            opacity: 0;
            animation: fadeUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.5s forwards;
        }

        .left-footer-rule {
            width: 36px;
            height: 1px;
            background: var(--secondary);
            opacity: 0.4;
            margin-bottom: 14px;
        }

        .left-footer p {
            font-size: 10px;
            color: rgba(245, 240, 235, 0.25);
            letter-spacing: 2.5px;
            text-transform: uppercase;
        }

        /* ─── RIGHT PANEL ─── */
        .right-panel {
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 52px;
            position: relative;
        }

        /* corner brackets */
        .bracket {
            position: absolute;
            width: 52px;
            height: 52px;
            pointer-events: none;
        }

        .bracket-tl {
            top: 36px;
            left: 36px;
            border-top: 1px solid rgba(171, 136, 109, 0.3);
            border-left: 1px solid rgba(171, 136, 109, 0.3);
        }

        .bracket-br {
            bottom: 36px;
            right: 36px;
            border-bottom: 1px solid rgba(171, 136, 109, 0.3);
            border-right: 1px solid rgba(171, 136, 109, 0.3);
        }

        /* login card */
        .login-card {
            width: 100%;
            max-width: 390px;
            opacity: 0;
            animation: fadeUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.45s forwards;
        }

        .card-eyebrow {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 3.5px;
            text-transform: uppercase;
            color: var(--secondary);
            margin-bottom: 16px;
        }

        .card-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 40px;
            font-weight: 400;
            color: var(--dark);
            line-height: 1.08;
            margin-bottom: 10px;
        }

        .card-subtitle {
            font-size: 13px;
            color: rgba(73, 54, 40, 0.48);
            font-weight: 300;
            margin-bottom: 36px;
            line-height: 1.65;
        }

        .card-rule {
            width: 36px;
            height: 1.5px;
            background: var(--secondary);
            opacity: 0.45;
            margin-bottom: 36px;
        }

        /* ─── FORM ─── */
        .form-group {
            position: relative;
            margin-bottom: 30px;
        }

        .form-label {
            display: block;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--secondary);
            margin-bottom: 10px;
            transition: color 0.25s ease;
        }

        .form-group:focus-within .form-label {
            color: var(--primary);
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 1.5px solid rgba(171, 136, 109, 0.32);
            transition: border-color 0.3s ease;
        }

        .input-group:focus-within {
            border-bottom-color: rgba(171, 136, 109, 0.5);
        }

        .form-input {
            flex: 1;
            min-width: 0;
            width: 100%;
            background: transparent;
            border: none;
            padding: 10px 0;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 300;
            color: var(--dark);
            outline: none;
            box-shadow: none;
            appearance: none;
            -webkit-appearance: none;
            
        }

        .form-input::placeholder {
            color: rgba(73, 54, 40, 0.22);
        }

        .form-input:focus,
        .form-input:focus-visible {
            outline: none;
            box-shadow: none;
        }

        .form-input:-webkit-autofill,
        .form-input:-webkit-autofill:hover,
        .form-input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 1000px var(--cream) inset;
            -webkit-text-fill-color: var(--dark);
            caret-color: var(--dark);
            transition: background-color 5000s ease-in-out 0s;
        }

        /* animated underline */
        .input-group-line {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 1.5px;
            background: var(--primary);
            transition: width 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            pointer-events: none;
        }

        .input-group:focus-within .input-group-line {
            width: 100%;
        }

        /* toggle password icon */
        .input-group-btn {
            flex-shrink: 0;
            background: none;
            border: none;
            padding: 4px;
            margin: 0;
            line-height: 0;
            
            color: rgba(73, 54, 40, 0.35);
            transition: color 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-group-btn:hover {
            color: var(--secondary);
        }

        /* ─── OPTIONS ROW ─── */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 36px;
        }

        .check-group {
            display: flex;
            align-items: center;
            gap: 10px;
            
        }

        .custom-checkbox {
            width: 16px;
            height: 16px;
            border: 1.5px solid rgba(171, 136, 109, 0.45);
            border-radius: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background 0.2s ease, border-color 0.2s ease;
        }

        .custom-checkbox.checked {
            background: var(--primary);
            border-color: var(--primary);
        }

        .custom-checkbox svg {
            display: none;
        }

        .custom-checkbox.checked svg {
            display: block;
        }

        .check-label {
            font-size: 12px;
            font-weight: 300;
            color: rgba(73, 54, 40, 0.55);
            user-select: none;
        }

        .forgot-link {
            font-size: 12px;
            font-weight: 300;
            color: var(--secondary);
            text-decoration: none;
            letter-spacing: 0.3px;
            transition: color 0.2s ease;
            
        }

        .forgot-link:hover {
            color: var(--primary);
        }

        /* ─── SUBMIT BUTTON ─── */
        .btn-submit {
            width: 100%;
            background: var(--primary);
            color: var(--cream);
            border: none;
            padding: 17px 32px;
            font-family: 'DM Sans', sans-serif;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 3.5px;
            text-transform: uppercase;
            
            position: relative;
            overflow: hidden;
            transition: letter-spacing 0.35s ease, transform 0.15s ease;
            margin-bottom: 28px;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--secondary);
            transform: translateX(-101%);
            transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .btn-submit:hover::before {
            transform: translateX(0);
        }

        .btn-submit:hover {
            letter-spacing: 4.5px;
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        .btn-submit span {
            position: relative;
            z-index: 1;
        }

        /* ─── DIVIDER WITH TEXT ─── */
        .or-divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 28px;
        }

        .or-divider::before,
        .or-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(171, 136, 109, 0.22);
        }

        .or-divider span {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(73, 54, 40, 0.35);
        }

        /* ─── SOCIAL LOGIN ─── */
        .social-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 28px;
        }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 16px;
            background: transparent;
            border: 1.5px solid rgba(171, 136, 109, 0.28);
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 400;
            color: var(--primary);
            
            transition: border-color 0.25s ease, background 0.25s ease;
            letter-spacing: 0.3px;
        }

        .btn-social:hover {
            border-color: var(--secondary);
            background: rgba(171, 136, 109, 0.05);
        }

        .btn-social svg {
            flex-shrink: 0;
        }

        /* ─── SIGN UP ROW ─── */
        .signup-row {
            text-align: center;
            font-size: 12px;
            font-weight: 300;
            color: rgba(73, 54, 40, 0.48);
        }

        .signup-row a {
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
            
            transition: color 0.2s ease;
        }

        .signup-row a:hover {
            color: var(--primary);
        }

        /* ─── ANIMATIONS ─── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(22px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ─── ERROR / SUCCESS STATE ─── */
        .form-error {
            font-size: 11px;
            color: #b04040;
            margin-top: 7px;
            letter-spacing: 0.3px;
            display: none;
        }

        .form-group.has-error .input-group {
            border-bottom-color: rgba(176, 64, 64, 0.4);
        }

        .form-group.has-error .input-group-line {
            background: #b04040;
        }

        .form-group.has-error .form-error {
            display: block;
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

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            body {
                cursor: auto;
                overflow: auto;
            }

            .cursor-dot,
            .cursor-ring {
                display: none;
            }

            .login-page {
                grid-template-columns: 1fr;
                min-height: 100vh;
            }

            .left-panel {
                display: none;
            }

            .right-panel {
                padding: 40px 28px;
                align-items: flex-start;
                padding-top: 80px;
            }
        }
    </style>
    <section class="login-page">

        <!-- LEFT PANEL -->
        <div class="left-panel">
            <div class="deco-ring deco-ring-1"></div>
            <div class="deco-ring deco-ring-2"></div>
            <div class="deco-ring deco-ring-3"></div>

            <div class="brand">
                <div class="brand-mark"><span>M</span></div>
                <span class="brand-name">MeroBazar</span>
            </div>

            <div class="left-content">
                <p class="left-eyebrow">Est. 2026</p>
                <h1 class="left-headline">Where craft<br>meets <em>intention.</em></h1>
                <p class="left-body">A refined digital space built for those who demand more from every interaction and
                    every detail.</p>
            </div>

            <div class="left-footer">
                <div class="left-footer-rule"></div>
                <p>&copy; 2026 MeroBazar &mdash; All rights reserved</p>
            </div>
        </div>

        <!-- RIGHT PANEL -->
        <div class="right-panel">
            <div class="bracket bracket-tl"></div>
            <div class="bracket bracket-br"></div>

            <div class="login-card">
                <p class="card-eyebrow">Welcome back</p>
                <h2 class="card-title">Sign in to<br>your account</h2>
                <p class="card-subtitle">Enter your credentials below to continue your journey with us.</p>
                <div class="card-rule"></div>

                <!-- Breeze Form -->
                <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
                    @csrf

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Email -->
                    <div class="form-group" id="emailGroup">
                        <label class="form-label" for="email">Email Address</label>
                        <div class="input-group">
                            <input class="form-input" type="email" id="email" name="email"
                                placeholder="you@example.com" autocomplete="email" value="{{ old('email') }}" required
                                autofocus>
                            <div class="input-group-line"></div>
                        </div>
                        <p class="form-error" id="emailError">Please enter a valid email address.</p>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Password -->
                    <div class="form-group" id="passwordGroup">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group">
                            <input class="form-input" type="password" id="password" name="password"
                                placeholder="••••••••" autocomplete="current-password" required>
                            <button type="button" class="input-group-btn" id="togglePw"
                                aria-label="Toggle password visibility">
                                <svg id="eyeIcon" width="17" height="17" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                <svg id="eyeOffIcon" width="17" height="17" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" style="display:none">
                                    <path
                                        d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                    <line x1="1" y1="1" x2="23" y2="23" />
                                </svg>
                            </button>
                            <div class="input-group-line"></div>
                        </div>
                        <p class="form-error" id="passwordError">Password is required.</p>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- Remember Me + Forgot Password -->
                    <div class="form-options">
                        <div class="check-group" id="rememberGroup">
                            <div class="custom-checkbox" id="rememberBox">
                                <svg width="10" height="8" viewBox="0 0 10 8" fill="none">
                                    <path d="M1 4L3.5 6.5L9 1" stroke="#E4E0E1" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <input type="checkbox" name="remember" id="rememberInput" style="display:none">
                            <span class="check-label">Remember me</span>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                        @endif
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <span>Sign In</span>
                    </button>
                </form>

                <!-- Divider -->
                <div class="or-divider"><span>or continue with</span></div>

                <!-- Social Login -->
                <div class="social-row">
                    <a href="{{ route('auth.google') }}" class="btn-social">
                        <svg width="16" height="16" viewBox="0 0 24 24">
                            <path fill="#4285F4"
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                            <path fill="#34A853"
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                            <path fill="#FBBC05"
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                            <path fill="#EA4335"
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                        </svg>
                        Google
                    </a>
                </div>

                <!-- Sign Up -->
                <p class="signup-row">
                    Don't have an account?
                    <a href="{{ route('register') }}">Create one &rarr;</a>
                </p>
            </div>
        </div>
    </section>

    <script>
        // ─── TOGGLE PASSWORD ───
        const togglePw = document.getElementById('togglePw');
        const pwInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

        togglePw.addEventListener('click', () => {
            const isText = pwInput.type === 'text';
            pwInput.type = isText ? 'password' : 'text';
            eyeIcon.style.display = isText ? 'block' : 'none';
            eyeOffIcon.style.display = isText ? 'none' : 'block';
        });

        // ─── CUSTOM CHECKBOX ───
        const rememberBox = document.getElementById('rememberBox');
        const rememberInput = document.getElementById('rememberInput');
        const rememberGroup = document.getElementById('rememberGroup');

        rememberGroup.addEventListener('click', () => {
            rememberBox.classList.toggle('checked');
            rememberInput.checked = rememberBox.classList.contains('checked');
        });

        // ─── CLIENT-SIDE VALIDATION ───
        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const emailGroup = document.getElementById('emailGroup');
        const passwordInput = document.getElementById('password');
        const passwordGroup = document.getElementById('passwordGroup');

        function validateEmail(val) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
        }

        loginForm.addEventListener('submit', (e) => {
            let valid = true;

            // Email check
            if (!emailInput.value.trim() || !validateEmail(emailInput.value.trim())) {
                emailGroup.classList.add('has-error');
                valid = false;
            } else {
                emailGroup.classList.remove('has-error');
            }

            // Password check
            if (!passwordInput.value) {
                passwordGroup.classList.add('has-error');
                valid = false;
            } else {
                passwordGroup.classList.remove('has-error');
            }

            if (!valid) e.preventDefault();
        });

        // Clear errors on input
        emailInput.addEventListener('input', () => emailGroup.classList.remove('has-error'));
        passwordInput.addEventListener('input', () => passwordGroup.classList.remove('has-error'));
    </script>
</x-layout>
