<x-layout>
    <style>
        .profile-page {
            padding: 120px 5% 80px;
            background: linear-gradient(180deg, var(--cream) 0%, var(--background) 300px);
            min-height: 100vh;
        }

        .profile-container {
            max-width: 720px;
            margin: 0 auto;
        }

        /* ─── Profile Header ─── */
        .profile-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
            padding: 2rem 2rem 2rem 0;
            border-bottom: 1px solid rgba(171, 136, 109, 0.2);
        }

        .profile-avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: var(--primary);
            color: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.75rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            flex-shrink: 0;
            border: 2px solid var(--accent);
        }

        .profile-header-info h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.75rem;
            font-weight: 500;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }

        .profile-header-info p {
            font-size: 0.85rem;
            color: var(--secondary);
        }

        /* ─── Profile Cards ─── */
        .profile-cards {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .profile-card {
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 12px 32px rgba(73, 54, 40, 0.05);
            transition: border-color 0.3s ease;
        }

        .profile-card:hover {
            border-color: rgba(171, 136, 109, 0.3);
        }

        .profile-card--danger {
            border-color: rgba(190, 80, 80, 0.2);
        }

        .profile-card--danger:hover {
            border-color: rgba(190, 80, 80, 0.35);
        }

        /* ─── Card Headings ─── */
        .profile-card-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.35rem;
            font-weight: 500;
            color: var(--primary);
            margin-bottom: 0.4rem;
        }

        .profile-card-desc {
            font-size: 0.82rem;
            color: var(--secondary);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid rgba(171, 136, 109, 0.1);
        }

        /* ─── Form Fields ─── */
        .profile-field {
            margin-bottom: 1.25rem;
        }

        .profile-field:last-child {
            margin-bottom: 0;
        }

        .profile-field label {
            display: block;
            font-size: 0.68rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 0.45rem;
        }

        .profile-field input {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            background: var(--cream);
            border: 1.5px solid var(--accent);
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--primary);
            outline: none;
            transition: border-color 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
        }

        .profile-field input:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(171, 136, 109, 0.12);
            background: #fff;
        }

        .profile-field input:hover {
            border-color: var(--secondary);
        }

        .profile-field input.has-error {
            border-color: #c0392b;
        }

        .profile-field-error {
            font-size: 0.72rem;
            color: #c0392b;
            margin-top: 0.35rem;
        }

        .profile-success-msg {
            font-size: 0.78rem;
            color: #3d7a3d;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            margin-left: 0.75rem;
        }

        /* ─── Buttons ─── */
        .profile-btn-row {
            display: flex;
            align-items: center;
            margin-top: 1.25rem;
            padding-top: 1.25rem;
            border-top: 1px solid rgba(171, 136, 109, 0.1);
        }

        .profile-btn {
            padding: 0.75rem 1.75rem;
            background: var(--primary);
            color: var(--cream);
            border: none;
            border-radius: 8px;
            font-size: 0.72rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: none;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .profile-btn:hover {
            background: var(--dark);
            transform: translateY(-1px);
        }

        .profile-btn:active {
            transform: translateY(0);
        }

        .profile-btn--danger {
            background: transparent;
            color: #b04040;
            border: 1.5px solid rgba(190, 80, 80, 0.3);
        }

        .profile-btn--danger:hover {
            background: rgba(190, 80, 80, 0.06);
            border-color: rgba(190, 80, 80, 0.5);
            color: #8a2e2e;
        }

        /* ─── Danger Zone ─── */
        .profile-danger-text {
            font-size: 0.82rem;
            color: rgba(73, 54, 40, 0.6);
            line-height: 1.7;
            margin-bottom: 1.25rem;
        }

        /* ─── Verify Email Banner ─── */
        .profile-verify-banner {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 1rem;
            background: rgba(171, 136, 109, 0.08);
            border-left: 3px solid var(--secondary);
            border-radius: 0 8px 8px 0;
            margin-bottom: 1.25rem;
            font-size: 0.82rem;
            color: var(--primary);
        }

        .profile-verify-banner button {
            background: none;
            border: none;
            color: var(--secondary);
            text-decoration: underline;
            text-underline-offset: 3px;
            font-size: 0.82rem;
            cursor: none;
            transition: color 0.2s;
        }

        .profile-verify-banner button:hover {
            color: var(--primary);
        }

        .profile-verify-sent {
            font-size: 0.78rem;
            color: #3d7a3d;
            margin-top: 0.5rem;
        }

        /* ─── Delete Modal Overrides ─── */
        .profile-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(43, 31, 20, 0.5);
            backdrop-filter: blur(4px);
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .profile-modal {
            background: #fff;
            border-radius: 12px;
            max-width: 480px;
            width: 100%;
            padding: 2rem;
            box-shadow: 0 24px 64px rgba(43, 31, 20, 0.2);
            animation: modalIn 0.25s ease;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(8px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .profile-modal-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            font-weight: 500;
            color: var(--primary);
            margin-bottom: 0.75rem;
        }

        .profile-modal-desc {
            font-size: 0.85rem;
            color: rgba(73, 54, 40, 0.65);
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .profile-modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid rgba(171, 136, 109, 0.1);
        }

        .profile-btn--ghost {
            padding: 0.75rem 1.5rem;
            background: transparent;
            color: var(--secondary);
            border: 1px solid var(--accent);
            border-radius: 8px;
            font-size: 0.72rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-weight: 500;
            font-family: 'DM Sans', sans-serif;
            cursor: none;
            transition: all 0.25s ease;
        }

        .profile-btn--ghost:hover {
            background: var(--cream);
            border-color: var(--secondary);
        }

        /* ─── Responsive ─── */
        @media (max-width: 768px) {
            .profile-page {
                padding: 100px 4% 60px;
            }

            .profile-header {
                flex-direction: column;
                align-items: flex-start;
                padding: 1.5rem 0;
                gap: 1rem;
            }

            .profile-card {
                padding: 1.5rem;
            }

            .profile-btn-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .profile-success-msg {
                margin-left: 0;
            }

            .profile-modal {
                padding: 1.5rem;
                margin: 1rem;
            }
        }

        @media (max-width: 480px) {
            .profile-avatar {
                width: 60px;
                height: 60px;
                font-size: 1.4rem;
            }

            .profile-header-info h1 {
                font-size: 1.4rem;
            }
        }
        /* ─── Alpine.js x-cloak ─── */
        [x-cloak] {
            display: none !important;
        }

        .overflow-hidden {
            overflow: hidden;
        }
    </style>

    <section class="profile-page">
        <div class="profile-container">
            {{-- Profile Header --}}
            <div class="profile-header">
                <div class="profile-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="profile-header-info">
                    <h1>{{ $user->name }}</h1>
                    <p>{{ $user->email }}</p>
                </div>
            </div>

            <div class="profile-cards">
                {{-- Profile Information --}}
                <div class="profile-card">
                    @include('profile.partials.update-profile-information-form')
                </div>

                {{-- Update Password --}}
                <div class="profile-card">
                    @include('profile.partials.update-password-form')
                </div>

                {{-- Delete Account --}}
                <div class="profile-card profile-card--danger">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </section>
</x-layout>
