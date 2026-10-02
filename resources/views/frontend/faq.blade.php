<x-layout>
    <style>
        .faq-page {
            width: 100%;
            overflow-x: hidden;
            padding: 140px 8% 100px;
            min-height: 100vh;
            max-width: 900px;
            margin: 0 auto;
        }

        .faq-hero {
            text-align: center;
            margin-bottom: 64px;
        }

        .faq-eyebrow {
            font-size: 0.7rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--secondary);
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .faq-eyebrow::before,
        .faq-eyebrow::after {
            content: '';
            width: 28px;
            height: 1px;
            background: var(--secondary);
        }

        .faq-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.2rem, 5vw, 3.6rem);
            font-weight: 300;
            color: var(--primary);
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .faq-title em {
            font-style: italic;
            color: var(--secondary);
        }

        .faq-sub {
            font-size: 0.9rem;
            line-height: 1.8;
            color: #6b5c4e;
            max-width: 520px;
            margin: 0 auto;
        }

        .faq-section {
            margin-bottom: 40px;
        }

        .faq-section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 500;
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(171, 136, 109, 0.3);
        }

        .faq-item {
            border: 1px solid rgba(73, 54, 40, 0.1);
            background: white;
            margin-bottom: 12px;
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }

        .faq-item.open {
            box-shadow: 0 12px 40px rgba(73, 54, 40, 0.08);
            border-color: var(--accent);
        }

        .faq-question {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 18px 24px;
            background: none;
            border: none;
            cursor: pointer;
            text-align: left;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.92rem;
            font-weight: 500;
            color: var(--primary);
            letter-spacing: 0.02em;
        }

        .faq-icon {
            flex-shrink: 0;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary);
            transition: transform 0.3s ease;
        }

        .faq-item.open .faq-icon {
            transform: rotate(45deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease;
        }

        .faq-answer p {
            padding: 0 24px 20px;
            font-size: 0.85rem;
            line-height: 1.85;
            color: #6b5c4e;
        }

        .faq-contact {
            margin-top: 64px;
            background: var(--cream);
            border: 1px solid rgba(171, 136, 109, 0.3);
            padding: 40px;
            text-align: center;
        }

        .faq-contact-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 500;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .faq-contact-text {
            font-size: 0.85rem;
            color: #6b5c4e;
            margin-bottom: 24px;
        }

        .faq-contact-btn {
            display: inline-block;
            background: var(--primary);
            color: var(--accent);
            padding: 14px 36px;
            font-size: 0.78rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .faq-contact-btn:hover {
            background: var(--secondary);
        }

        @media (max-width: 600px) {
            .faq-page {
                padding: 120px 5% 70px;
            }

            .faq-question {
                padding: 16px 18px;
                font-size: 0.86rem;
            }

            .faq-answer p {
                padding: 0 18px 18px;
            }
        }
    </style>

    <div class="faq-page">
        <div class="faq-hero">
            <div class="faq-eyebrow">Help Center</div>
            <h1 class="faq-title">Frequently Asked <em>Questions</em></h1>
            <p class="faq-sub">Everything you need to know about shopping, delivery, payments, returns and selling on
                MeroBazar.</p>
        </div>

        <div class="faq-section">
            <div class="faq-section-title">Orders & Payment</div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    How do I place an order on MeroBazar?
                    <span class="faq-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                </button>
                <div class="faq-answer"><p>Add the items you want to your cart, then go to checkout, enter your delivery
                        address and contact number, and choose a payment method — Cash on Delivery or Khalti. Once the
                        order is placed, the seller will process and ship it to you.</p></div>
            </div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    What payment methods do you accept?
                    <span class="faq-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                </button>
                <div class="faq-answer"><p>We currently support two payment methods: Cash on Delivery (COD) and online
                        payments through Khalti. Khalti lets you pay securely using your e-wallet, bank account or
                        cards.</p></div>
            </div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    Is it safe to pay online through Khalti?
                    <span class="faq-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                </button>
                <div class="faq-answer"><p>Yes. All Khalti transactions are processed securely by Khalti's own payment
                        gateway. We never store your payment or card details on our servers.</p></div>
            </div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    How do I know my order was successful?
                    <span class="faq-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                </button>
                <div class="faq-answer"><p>After a successful order, you'll be shown a confirmation message and receive a
                        confirmation email. You can also view all your orders under Buying History in your account.</p>
                </div>
            </div>
        </div>

        <div class="faq-section">
            <div class="faq-section-title">Shipping & Delivery</div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    How long does delivery take?
                    <span class="faq-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                </button>
                <div class="faq-answer"><p>Delivery time depends on the seller's location and the delivery area.
                        Typically orders within Kathmandu valley arrive in 1–3 days, while orders outside the valley may
                        take 3–7 days. Express delivery may be available for select sellers.</p></div>
            </div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    How can I track my order?
                    <span class="faq-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                </button>
                <div class="faq-answer"><p>Open Buying History from your account to see the latest status of every
                        order. You can also contact the seller directly for more specific updates on your shipment.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    Do you offer free shipping?
                    <span class="faq-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                </button>
                <div class="faq-answer"><p>Shipping fees are set by each seller. Many sellers offer free delivery on
                        orders above a certain amount — check the product or checkout page for the delivery charges
                        before confirming your order.</p></div>
            </div>
        </div>

        <div class="faq-section">
            <div class="faq-section-title">Returns & Refunds</div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    What is your return policy?
                    <span class="faq-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                </button>
                <div class="faq-answer"><p>If your item is damaged, defective, or not what you ordered, you can request
                        a return within 7 days of delivery. Please contact the seller with your order details and photos
                        of the issue.</p></div>
            </div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    I received a damaged or wrong item. What should I do?
                    <span class="faq-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                </button>
                <div class="faq-answer"><p>Contact the seller as soon as possible with your order ID, a description of
                        the problem, and clear photos. The seller will arrange a replacement or a refund as per their
                        policy.</p></div>
            </div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    How do refunds work?
                    <span class="faq-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                </button>
                <div class="faq-answer"><p>Refunds are processed by the seller. If you paid with Khalti, the amount is
                        returned to your Khalti account. If you paid by Cash on Delivery, the seller will arrange the
                        refund through a method you agree on.</p></div>
            </div>
        </div>

        <div class="faq-section">
            <div class="faq-section-title">Accounts & Sellers</div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    How do I become a seller on MeroBazar?
                    <span class="faq-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                </button>
                <div class="faq-answer"><p>Go to the "Become a Vendor" section, fill out the seller registration form
                        with your shop details and required documents, and submit it. Our team will review your
                        application and you'll be notified once it's approved.</p></div>
            </div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    How are sellers verified?
                    <span class="faq-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                </button>
                <div class="faq-answer"><p>Every seller must provide valid business information and documents during
                        registration. Our team verifies each application before the shop goes live, so you can shop with
                        confidence.</p></div>
            </div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    Do I need an account to place an order?
                    <span class="faq-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                </button>
                <div class="faq-answer"><p>Yes. You need to be logged in to place an order and to track your orders from
                        Buying History. Creating an account takes less than a minute.</p></div>
            </div>
        </div>

        <div class="faq-section">
            <div class="faq-section-title">Shopping</div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    What categories can I shop on MeroBazar?
                    <span class="faq-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                </button>
                <div class="faq-answer"><p>MeroBazar is a multi-vendor marketplace. You'll find electronics, fashion,
                        packaged food, home & kitchen items, cosmetics, toys, musical instruments, and much more — all
                        from trusted local sellers.</p></div>
            </div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    Are the products genuine and of good quality?
                    <span class="faq-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                </button>
                <div class="faq-answer"><p>We verify all sellers before they can list products. You can also check
                        product reviews and ratings from other customers before making a purchase.</p></div>
            </div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    Can I review a product I bought?
                    <span class="faq-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                </button>
                <div class="faq-answer"><p>Yes. Go to your order in Buying History and you'll find the option to write a
                        review and rate the product. Your review helps other customers make better decisions.</p></div>
            </div>
        </div>

        <div class="faq-contact">
            <div class="faq-contact-title">Still have questions?</div>
            <p class="faq-contact-text">Can't find the answer you're looking for? We're happy to help.</p>
            <a href="{{ route('seller.index') }}" class="faq-contact-btn">Contact Us</a>
        </div>
    </div>

    <script>
        (function initFaq() {
            if (window.__faqInitialized) return;
            window.__faqInitialized = true;
            document.querySelectorAll('.faq-question').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const item = btn.closest('.faq-item');
                    const answer = item.querySelector('.faq-answer');
                    const isOpen = item.classList.contains('open');

                    document.querySelectorAll('.faq-item.open').forEach((other) => {
                        if (other !== item) {
                            other.classList.remove('open');
                            other.querySelector('.faq-answer').style.maxHeight = null;
                        }
                    });

                    if (isOpen) {
                        item.classList.remove('open');
                        answer.style.maxHeight = null;
                    } else {
                        item.classList.add('open');
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                    }
                });
            });
        })();
    </script>
</x-layout>
