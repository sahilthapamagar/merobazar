<x-layout>

    <style>
        .register-page {
            --navbar-height: 64px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: calc(100vh - var(--navbar-height));
            width: 100%;
            position: relative;
        }

        /* ─── LEFT PANEL ─── */
        .reg-left {
            position: relative;
            background: var(--dark);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 52px;
            overflow: hidden;
        }

        .reg-left::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 72% 38%, rgba(171, 136, 109, 0.18) 0%, transparent 60%);
            pointer-events: none;
        }

        .reg-deco {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(171, 136, 109, 0.1);
            pointer-events: none;
        }

        .reg-deco-1 {
            width: 480px;
            height: 480px;
            left: -180px;
            top: 50%;
            transform: translateY(-50%);
        }

        .reg-deco-2 {
            width: 300px;
            height: 300px;
            left: -60px;
            top: 50%;
            transform: translateY(-50%);
        }

        .reg-deco-3 {
            width: 140px;
            height: 140px;
            left: 40px;
            top: 50%;
            transform: translateY(-50%);
            border-color: rgba(171, 136, 109, 0.06);
        }

        .reg-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            z-index: 2;
            opacity: 0;
            animation: regFadeUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.1s forwards;
        }

        .reg-brand-mark {
            width: 38px;
            height: 38px;
            border: 1.5px solid var(--secondary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .reg-brand-mark span {
            font-family: 'Cormorant Garamond', serif;
            color: var(--secondary);
            font-size: 17px;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .reg-brand-name {
            font-family: 'Cormorant Garamond', serif;
            color: var(--cream);
            font-size: 17px;
            font-weight: 300;
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        .reg-left-content {
            position: relative;
            z-index: 2;
            opacity: 0;
            animation: regFadeUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.3s forwards;
        }

        .reg-eyebrow {
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

        .reg-eyebrow::before {
            content: '';
            display: block;
            width: 28px;
            height: 1px;
            background: var(--secondary);
            opacity: 0.5;
        }

        .reg-headline {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(36px, 3.8vw, 58px);
            font-weight: 300;
            color: var(--cream);
            line-height: 1.08;
            margin-bottom: 28px;
            letter-spacing: -0.5px;
        }

        .reg-headline em {
            font-style: italic;
            color: var(--accent);
        }

        .reg-body {
            font-size: 13px;
            font-weight: 300;
            color: rgba(245, 240, 235, 0.42);
            letter-spacing: 0.4px;
            line-height: 1.75;
            max-width: 260px;
        }

        .reg-features {
            list-style: none;
            margin-top: 32px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .reg-features li {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 12px;
            font-weight: 300;
            color: rgba(245, 240, 235, 0.5);
            letter-spacing: 0.3px;
        }

        .reg-features li::before {
            content: '';
            width: 18px;
            height: 1px;
            background: var(--secondary);
            opacity: 0.6;
            flex-shrink: 0;
        }

        .reg-left-footer {
            position: relative;
            z-index: 2;
            opacity: 0;
            animation: regFadeUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.5s forwards;
        }

        .reg-footer-rule {
            width: 36px;
            height: 1px;
            background: var(--secondary);
            opacity: 0.4;
            margin-bottom: 14px;
        }

        .reg-left-footer p {
            font-size: 10px;
            color: rgba(245, 240, 235, 0.25);
            letter-spacing: 2.5px;
            text-transform: uppercase;
        }

        /* ─── RIGHT PANEL ─── */
        .reg-right {
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 52px;
            position: relative;
            overflow-y: auto;
        }

        .reg-bracket {
            position: absolute;
            width: 52px;
            height: 52px;
            pointer-events: none;
        }

        .reg-bracket-tl {
            top: 36px;
            left: 36px;
            border-top: 1px solid rgba(171, 136, 109, 0.3);
            border-left: 1px solid rgba(171, 136, 109, 0.3);
        }

        .reg-bracket-br {
            bottom: 36px;
            right: 36px;
            border-bottom: 1px solid rgba(171, 136, 109, 0.3);
            border-right: 1px solid rgba(171, 136, 109, 0.3);
        }

        .reg-card {
            width: 100%;
            max-width: 420px;
            opacity: 0;
            animation: regFadeUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.45s forwards;
        }

        .reg-card-eyebrow {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 3.5px;
            text-transform: uppercase;
            color: var(--secondary);
            margin-bottom: 16px;
        }

        .reg-card-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 40px;
            font-weight: 400;
            color: var(--dark);
            line-height: 1.08;
            margin-bottom: 10px;
        }

        .reg-card-subtitle {
            font-size: 13px;
            color: rgba(73, 54, 40, 0.48);
            font-weight: 300;
            margin-bottom: 36px;
            line-height: 1.65;
        }

        .reg-card-rule {
            width: 36px;
            height: 1.5px;
            background: var(--secondary);
            opacity: 0.45;
            margin-bottom: 36px;
        }

        .reg-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* ─── FORM ─── */
        .rg-group {
            position: relative;
            margin-bottom: 28px;
        }

        .rg-label {
            display: block;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--secondary);
            margin-bottom: 10px;
            transition: color 0.25s ease;
        }

        .rg-group:focus-within .rg-label {
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

        .rg-input {
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
            cursor: none;
        }

        .rg-input::placeholder {
            color: rgba(73, 54, 40, 0.22);
        }

        .rg-input:focus,
        .rg-input:focus-visible {
            outline: none;
            box-shadow: none;
        }

        .rg-input:-webkit-autofill,
        .rg-input:-webkit-autofill:hover,
        .rg-input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 1000px var(--cream) inset;
            -webkit-text-fill-color: var(--dark);
            caret-color: var(--dark);
            transition: background-color 5000s ease-in-out 0s;
        }

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

        /* strength bar */
        .strength-wrap {
            margin-top: 8px;
            display: flex;
            gap: 4px;
            align-items: center;
        }

        .strength-bar {
            height: 2px;
            flex: 1;
            border-radius: 2px;
            background: rgba(171, 136, 109, 0.2);
            transition: background 0.35s ease;
        }

        .strength-bar.weak {
            background: #b04040;
        }

        .strength-bar.fair {
            background: #c47a2a;
        }

        .strength-bar.good {
            background: #6a9a5b;
        }

        .strength-bar.strong {
            background: #3d7a5b;
        }

        .strength-label {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(73, 54, 40, 0.4);
            min-width: 46px;
            text-align: right;
            transition: color 0.3s ease;
        }

        .input-group-btn {
            flex-shrink: 0;
            background: none;
            border: none;
            padding: 4px;
            margin: 0;
            line-height: 0;
            cursor: none;
            color: rgba(73, 54, 40, 0.35);
            transition: color 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-group-btn:hover {
            color: var(--secondary);
        }

        /* terms */
        .reg-terms-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 30px;
            cursor: none;
        }

        .reg-checkbox {
            width: 16px;
            height: 16px;
            margin-top: 1px;
            border: 1.5px solid rgba(171, 136, 109, 0.45);
            border-radius: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background 0.2s ease, border-color 0.2s ease;
        }

        .reg-checkbox.checked {
            background: var(--primary);
            border-color: var(--primary);
        }

        .reg-checkbox svg {
            display: none;
        }

        .reg-checkbox.checked svg {
            display: block;
        }

        .reg-terms-text {
            font-size: 12px;
            font-weight: 300;
            color: rgba(73, 54, 40, 0.55);
            line-height: 1.6;
        }

        .reg-terms-text a {
            color: var(--secondary);
            text-decoration: none;
            transition: color 0.2s ease;
            cursor: none;
        }

        .reg-terms-text a:hover {
            color: var(--primary);
        }

        /* submit */
        .reg-btn-submit {
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
            cursor: none;
            position: relative;
            overflow: hidden;
            transition: letter-spacing 0.35s ease, transform 0.15s ease;
            margin-bottom: 28px;
        }

        .reg-btn-submit::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--secondary);
            transform: translateX(-101%);
            transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reg-btn-submit:hover::before {
            transform: translateX(0);
        }

        .reg-btn-submit:hover {
            letter-spacing: 4.5px;
        }

        .reg-btn-submit:active {
            transform: scale(0.98);
        }

        .reg-btn-submit span {
            position: relative;
            z-index: 1;
        }

        .reg-btn-submit:disabled {
            opacity: 0.5;
            pointer-events: none;
        }

        /* or divider */
        .reg-or {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 28px;
        }

        .reg-or::before,
        .reg-or::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(171, 136, 109, 0.22);
        }

        .reg-or span {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(73, 54, 40, 0.35);
        }

        /* google button — single, full width */
        .reg-btn-google {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 13px 20px;
            background: transparent;
            border: 1.5px solid rgba(171, 136, 109, 0.28);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 400;
            color: var(--primary);
            cursor: none;
            margin-bottom: 28px;
            transition: border-color 0.25s ease, background 0.25s ease;
            letter-spacing: 0.3px;
        }

        .reg-btn-google:hover {
            border-color: var(--secondary);
            background: rgba(171, 136, 109, 0.05);
        }

        /* sign in row */
        .reg-signin-row {
            text-align: center;
            font-size: 12px;
            font-weight: 300;
            color: rgba(73, 54, 40, 0.48);
        }

        .reg-signin-row a {
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
            cursor: none;
            transition: color 0.2s ease;
        }

        .reg-signin-row a:hover {
            color: var(--primary);
        }

        /* errors */
        .rg-error {
            font-size: 11px;
            color: #b04040;
            margin-top: 7px;
            letter-spacing: 0.3px;
            display: none;
        }

        .rg-group.has-error .input-group {
            border-bottom-color: rgba(176, 64, 64, 0.4);
        }

        .rg-group.has-error .input-group-line {
            background: #b04040;
        }

        .rg-group.has-error .rg-error {
            display: block;
        }

        @keyframes regFadeUp {
            from {
                opacity: 0;
                transform: translateY(22px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .register-page {
                grid-template-columns: 1fr;
            }

            .reg-left {
                display: none;
            }

            .reg-right {
                padding: 40px 28px;
                align-items: flex-start;
                padding-top: 40px;
                overflow-y: visible;
            }

            .reg-grid-2 {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>

    <div class="register-page">

        <!-- ═══ LEFT PANEL ═══ -->
        <div class="reg-left">
            <div class="reg-deco reg-deco-1"></div>
            <div class="reg-deco reg-deco-2"></div>
            <div class="reg-deco reg-deco-3"></div>

            <div class="reg-brand">
                <div class="reg-brand-mark"><span>M</span></div>
                <span class="reg-brand-name">Mero Bazar</span>
            </div>

            <div class="reg-left-content">
                <p class="reg-eyebrow">Join us today</p>
                <h1 class="reg-headline">Begin your<br><em>refined</em><br>journey.</h1>
                <p class="reg-body">Create your account and step into a world crafted with intention, detail, and
                    purpose.</p>
                <ul class="reg-features">
                    <li>Curated experience from day one</li>
                    <li>Full access to all premium features</li>
                    <li>Secure &amp; private by design</li>
                </ul>
            </div>

            <div class="reg-left-footer">
                <div class="reg-footer-rule"></div>
                <p>&copy; 2024 Mero Bazar &mdash; All rights reserved</p>
            </div>
        </div>

        <!-- ═══ RIGHT PANEL ═══ -->
        <div class="reg-right">
            <div class="reg-bracket reg-bracket-tl"></div>
            <div class="reg-bracket reg-bracket-br"></div>

            <div class="reg-card">
                <p class="reg-card-eyebrow">Get started</p>
                <h2 class="reg-card-title">Create your<br>account</h2>
                <p class="reg-card-subtitle">Fill in your details below to join the Mero Bazar community.</p>
                <div class="reg-card-rule"></div>

                <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
                    @csrf


                        <div class="rg-group" id="nameGroup">
                            <label class="rg-label" for="name">Username</label>
                            <div class="input-group">
                                <input class="rg-input" type="text" id="name" name="name"
                                    placeholder="jane_doe" value="{{ old('name') }}" autocomplete="name">
                                <div class="input-group-line"></div>
                            </div>
                            @error('name')
                                <p class="rg-error" style="display:block;">{{ $message }}</p>
                            @enderror
                        </div>

                    <!-- Email -->
                    <div class="rg-group" id="emailGroup">
                        <label class="rg-label" for="email">Email Address</label>
                        <div class="input-group">
                            <input class="rg-input" type="email" id="email" name="email"
                                placeholder="you@example.com" value="{{ old('email') }}" autocomplete="email" required>
                            <div class="input-group-line"></div>
                        </div>
                        <p class="rg-error">Please enter a valid email address.</p>
                        @error('email')
                            <p class="rg-error" style="display:block;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="rg-group" id="passwordGroup">
                        <label class="rg-label" for="password">Password</label>
                        <div class="input-group">
                            <input class="rg-input" type="password" id="password" name="password"
                                placeholder="Min. 8 characters" autocomplete="new-password" required>
                            <button type="button" class="input-group-btn" id="togglePw1" aria-label="Toggle password">
                                <svg id="eyeIcon1" width="17" height="17" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                <svg id="eyeOffIcon1" width="17" height="17" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" style="display:none">
                                    <path
                                        d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                    <line x1="1" y1="1" x2="23" y2="23" />
                                </svg>
                            </button>
                            <div class="input-group-line"></div>
                        </div>
                        <div class="strength-wrap" id="strengthWrap" style="display:none">
                            <div class="strength-bar" id="sb1"></div>
                            <div class="strength-bar" id="sb2"></div>
                            <div class="strength-bar" id="sb3"></div>
                            <div class="strength-bar" id="sb4"></div>
                            <span class="strength-label" id="strengthLabel"></span>
                        </div>
                        <p class="rg-error">Password must be at least 8 characters.</p>
                        @error('password')
                            <p class="rg-error" style="display:block;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="rg-group" id="confirmGroup">
                        <label class="rg-label" for="password_confirmation">Confirm Password</label>
                        <div class="input-group">
                            <input class="rg-input" type="password" id="password_confirmation"
                                name="password_confirmation" placeholder="Re-enter your password"
                                autocomplete="new-password" required>
                            <button type="button" class="input-group-btn" id="togglePw2"
                                aria-label="Toggle confirm password">
                                <svg id="eyeIcon2" width="17" height="17" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                <svg id="eyeOffIcon2" width="17" height="17" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" style="display:none">
                                    <path
                                        d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                    <line x1="1" y1="1" x2="23" y2="23" />
                                </svg>
                            </button>
                            <div class="input-group-line"></div>
                        </div>
                        <p class="rg-error">Passwords do not match.</p>
                        @error('password_confirmation')
                            <p class="rg-error" style="display:block;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Terms -->
                    <div class="reg-terms-row" id="termsRow">
                        <div class="reg-checkbox" id="termsBox">
                            <svg width="10" height="8" viewBox="0 0 10 8" fill="none">
                                <path d="M1 4L3.5 6.5L9 1" stroke="#E4E0E1" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <input type="checkbox" name="terms" id="termsInput" style="display:none">
                        <p class="reg-terms-text">
                            I agree to the <a href="/terms">Terms of Service</a> and
                            <a href="/privacy">Privacy Policy</a>
                        </p>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="reg-btn-submit" id="regSubmitBtn" disabled>
                        <span>Create Account</span>
                    </button>

                </form>

                <!-- OR + Google only -->
                <div class="reg-or"><span>or sign up with</span></div>

                <button class="reg-btn-google" type="button">
                    <svg width="18" height="18" viewBox="0 0 24 24">
                        <path fill="#4285F4"
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                        <path fill="#34A853"
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05"
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#EA4335"
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    Continue with Google
                </button>

                <p class="reg-signin-row">
                    Already have an account? <a href="{{ route('login') }}">&larr; Sign in</a>
                </p>
            </div>
        </div>

    </div>{{-- /.register-page --}}
    <script>
        // ─── PASSWORD TOGGLES ───
        function makeToggle(btnId, inputId, onId, offId) {
            const btn = document.getElementById(btnId);
            const inp = document.getElementById(inputId);
            const on = document.getElementById(onId);
            const off = document.getElementById(offId);
            btn.addEventListener('click', () => {
                const show = inp.type === 'password';
                inp.type = show ? 'text' : 'password';
                on.style.display = show ? 'none' : 'block';
                off.style.display = show ? 'block' : 'none';
            });
        }
        makeToggle('togglePw1', 'password', 'eyeIcon1', 'eyeOffIcon1');
        makeToggle('togglePw2', 'password_confirmation', 'eyeIcon2', 'eyeOffIcon2');

        // ─── PASSWORD STRENGTH ───
        const pwInput = document.getElementById('password');
        const strengthWrap = document.getElementById('strengthWrap');
        const strengthLbl = document.getElementById('strengthLabel');
        const bars = ['sb1', 'sb2', 'sb3', 'sb4'].map(id => document.getElementById(id));
        const levels = ['', 'weak', 'fair', 'good', 'strong'];
        const labels = ['', 'Weak', 'Fair', 'Good', 'Strong'];
        const lblColors = ['', '#b04040', '#c47a2a', '#6a9a5b', '#3d7a5b'];

        function calcStrength(pw) {
            let s = 0;
            if (pw.length >= 8) s++;
            if (pw.length >= 12) s++;
            if (/[A-Z]/.test(pw) && /[a-z]/.test(pw)) s++;
            if (/[0-9]/.test(pw)) s++;
            if (/[^A-Za-z0-9]/.test(pw)) s++;
            return Math.min(4, s);
        }
        pwInput.addEventListener('input', () => {
            const pw = pwInput.value;
            if (!pw) {
                strengthWrap.style.display = 'none';
                return;
            }
            strengthWrap.style.display = 'flex';
            const s = calcStrength(pw);
            bars.forEach((b, i) => {
                b.className = 'strength-bar';
                if (i < s) b.classList.add(levels[s]);
            });
            strengthLbl.textContent = labels[s];
            strengthLbl.style.color = lblColors[s];
        });

        // ─── TERMS CHECKBOX ───
        const termsBox = document.getElementById('termsBox');
        const termsInput = document.getElementById('termsInput');
        const submitBtn = document.getElementById('regSubmitBtn');
        document.getElementById('termsRow').addEventListener('click', () => {
            termsBox.classList.toggle('checked');
            termsInput.checked = termsBox.classList.contains('checked');
            submitBtn.disabled = !termsInput.checked;
        });

        // ─── VALIDATION ───
        const form = document.getElementById('registerForm');
        const nameInp = document.getElementById('name');
        const emailInp = document.getElementById('email');
        const confInp = document.getElementById('password_confirmation');
        const nameGrp = document.getElementById('nameGroup');
        const emailGrp = document.getElementById('emailGroup');
        const pwGrp = document.getElementById('passwordGroup');
        const confGrp = document.getElementById('confirmGroup');

        form.addEventListener('submit', (e) => {
            let valid = true;
            if (!nameInp.value.trim()) {
                nameGrp.classList.add('has-error');
                valid = false;
            } else nameGrp.classList.remove('has-error');
            const emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInp.value.trim());
            if (!emailOk) {
                emailGrp.classList.add('has-error');
                valid = false;
            } else emailGrp.classList.remove('has-error');
            if (pwInput.value.length < 8) {
                pwGrp.classList.add('has-error');
                valid = false;
            } else pwGrp.classList.remove('has-error');
            if (!confInp.value || confInp.value !== pwInput.value) {
                confGrp.classList.add('has-error');
                valid = false;
            } else confGrp.classList.remove('has-error');
            if (!valid) e.preventDefault();
        });

        nameInp.addEventListener('input', () => nameGrp.classList.remove('has-error'));
        emailInp.addEventListener('input', () => emailGrp.classList.remove('has-error'));
        pwInput.addEventListener('input', () => pwGrp.classList.remove('has-error'));
        confInp.addEventListener('input', () => confGrp.classList.remove('has-error'));
    </script>


</x-layout>
