<x-layout>
    <style>
        .contact-page {
            width: 100%;
            overflow-x: hidden;
            padding: 140px 8% 100px;
            min-height: 100vh;
            max-width: 960px;
            margin: 0 auto;
        }

        .contact-hero {
            text-align: center;
            margin-bottom: 64px;
        }

        .contact-eyebrow {
            font-size: 0.7rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--secondary);
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .contact-eyebrow::before,
        .contact-eyebrow::after {
            content: '';
            width: 28px;
            height: 1px;
            background: var(--secondary);
        }

        .contact-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.2rem, 5vw, 3.6rem);
            font-weight: 300;
            color: var(--primary);
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .contact-title em {
            font-style: italic;
            color: var(--secondary);
        }

        .contact-sub {
            font-size: 0.9rem;
            line-height: 1.8;
            color: #6b5c4e;
            max-width: 520px;
            margin: 0 auto;
        }

        .contact-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 64px;
        }

        .contact-card {
            background: white;
            border: 1px solid rgba(73, 54, 40, 0.1);
            padding: 28px 24px;
            text-align: center;
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .contact-card:hover {
            border-color: var(--accent);
            box-shadow: 0 12px 40px rgba(73, 54, 40, 0.08);
        }

        .contact-card-icon {
            width: 44px;
            height: 44px;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(171, 136, 109, 0.12);
            border-radius: 50%;
            color: var(--secondary);
        }

        .contact-card-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 6px;
        }

        .contact-card-text {
            font-size: 0.82rem;
            line-height: 1.6;
            color: #7a6858;
        }

        .contact-card-text a {
            color: var(--secondary);
            font-weight: 500;
        }

        .contact-form-wrap {
            background: white;
            border: 1px solid rgba(73, 54, 40, 0.1);
            padding: 40px;
        }

        .contact-form-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            font-weight: 500;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .contact-form-sub {
            font-size: 0.85rem;
            color: #7a6858;
            margin-bottom: 28px;
        }

        .contact-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .contact-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .contact-field--full {
            grid-column: 1 / -1;
        }

        .contact-label {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--primary);
        }

        .contact-label span {
            color: #c1121f;
        }

        .contact-input,
        .contact-textarea {
            width: 100%;
            padding: 12px 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--primary);
            background: var(--cream);
            border: 1px solid rgba(171, 136, 109, 0.35);
            outline: none;
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }

        .contact-input:focus,
        .contact-textarea:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(171, 136, 109, 0.15);
        }

        .contact-textarea {
            min-height: 140px;
            resize: vertical;
        }

        .contact-submit {
            grid-column: 1 / -1;
            justify-self: start;
            background: var(--primary);
            color: var(--accent);
            padding: 13px 34px;
            font-size: 0.75rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .contact-submit:hover {
            background: var(--secondary);
            color: #fff;
        }

        .contact-error {
            font-size: 0.75rem;
            color: #c1121f;
        }

        @media (max-width: 768px) {
            .contact-page {
                padding: 120px 5% 72px;
            }

            .contact-cards {
                grid-template-columns: 1fr;
            }

            .contact-form-wrap {
                padding: 28px 20px;
            }

            .contact-form {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="contact-page">
        <div class="contact-hero">
            <span class="contact-eyebrow">Get In Touch</span>
            <h1 class="contact-title">We'd Love To <em>Hear</em> From You</h1>
            <p class="contact-sub">Questions about an order, selling on MeroBazar, or anything else — our team is
                here to help and usually responds within one business day.</p>
        </div>

        <div class="contact-cards">
            <div class="contact-card">
                <div class="contact-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,13 2,6" />
                    </svg>
                </div>
                <div class="contact-card-title">Email Us</div>
                <p class="contact-card-text">
                    <a href="mailto:merobazar@gmail.com">merobazar@gmail.com</a><br>
                    For order &amp; seller support
                </p>
            </div>

            <div class="contact-card">
                <div class="contact-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                </div>
                <div class="contact-card-title">Call Us</div>
                <p class="contact-card-text">
                    <a href="tel:+9779811982070">+977 9811982070</a><br>
                    Sun – Fri, 9AM – 6PM NPT
                </p>
            </div>

            <div class="contact-card">
                <div class="contact-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                </div>
                <div class="contact-card-title">Visit Us</div>
                <p class="contact-card-text">
                    Kathmandu, Nepal<br>
                    MeroBazar Headquarters
                </p>
            </div>
        </div>

        <div class="contact-form-wrap">
            <h2 class="contact-form-title">Send Us a Message</h2>
            <p class="contact-form-sub">Fill out the form below and we'll get back to you as soon as possible.</p>

            <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                @csrf
                <div class="contact-field">
                    <label class="contact-label" for="contact-name">Your Name <span>*</span></label>
                    <input class="contact-input" type="text" id="contact-name" name="name" required
                        placeholder="Full name" value="{{ old('name') }}">
                    @error('name')<span class="contact-error">{{ $message }}</span>@enderror
                </div>

                <div class="contact-field">
                    <label class="contact-label" for="contact-email">Email Address <span>*</span></label>
                    <input class="contact-input" type="email" id="contact-email" name="email" required
                        placeholder="you@example.com" value="{{ old('email') }}">
                    @error('email')<span class="contact-error">{{ $message }}</span>@enderror
                </div>

                <div class="contact-field contact-field--full">
                    <label class="contact-label" for="contact-subject">Subject <span>*</span></label>
                    <input class="contact-input" name="subject" id="contact-subject" required
                        placeholder="What's this about?" value="{{ old('subject') }}">
                    @error('subject')<span class="contact-error">{{ $message }}</span>@enderror
                </div>

                <div class="contact-field contact-field--full">
                    <label class="contact-label" for="contact-message">Message <span>*</span>
                    </label>
                    <textarea class="contact-textarea" id="contact-message" name="message" required
                        placeholder="Tell us how we can help...">{{ old('message') }}</textarea>
                    @error('message')<span class="contact-error">{{ $message }}</span>@enderror
                </div>

                <button type="submit" class="contact-submit">Send Message</button>
            </form>
        </div>
    </div>
</x-layout>
