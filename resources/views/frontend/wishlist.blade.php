<x-layout>
    <style>
        .wishlist-page {
            padding: 120px 5% 80px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .wishlist-header {
            margin-bottom: 2.5rem;
        }
        .section-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.3em;
            color: var(--secondary);
            margin-bottom: 0.6rem;
        }
        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 4vw, 3.2rem);
            color: var(--primary);
        }
        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        .wishlist-card {
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.18);
            overflow: hidden;
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .wishlist-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 40px rgba(73, 54, 40, 0.08);
        }
        .wishlist-image {
            position: relative;
            width: 100%;
            height: 280px;
            background: var(--cream);
            overflow: hidden;
        }
        .wishlist-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .wishlist-body {
            padding: 1.25rem 1.5rem;
        }
        .wishlist-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            color: var(--primary);
            margin-bottom: 0.4rem;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .wishlist-price {
            color: var(--secondary);
            font-weight: 500;
            margin-bottom: 1rem;
        }
        .wishlist-actions {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }
        .wishlist-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.7rem 1rem;
            border: 1px solid var(--primary);
            background: var(--primary);
            color: var(--accent);
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 0.75rem;
            transition: opacity 0.3s ease;
        }
        .wishlist-btn.secondary {
            background: transparent;
            color: var(--primary);
        }
        .wishlist-btn:hover {
            opacity: 0.88;
        }
        .wishlist-remove {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #fff;
            border: 1px solid rgba(171, 136, 109, 0.25);
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            cursor: pointer;
        }
        .wishlist-empty {
            text-align: center;
            padding: 4rem 1rem;
            background: #fff;
            border: 1px dashed rgba(171, 136, 109, 0.35);
        }
        .wishlist-empty p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 0.6rem;
        }
        .wishlist-empty a {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.8rem 2rem;
            border: 1px solid var(--primary);
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-size: 0.8rem;
            text-decoration: none;
        }
    </style>
    <section class="wishlist-page">
        <header class="wishlist-header">
            <p class="section-label">My Collection</p>
            <h1 class="section-title">Your <em>Wishlist</em></h1>
        </header>
        @if (->isEmpty())
            <div class="wishlist-empty">
                <p>Your wishlist is empty</p>
                <span>Save your favourite pieces to revisit them later.</span>
                <a href="{{ route('products') }}">Browse Products</a>
            </div>
        @else
            <div class="wishlist-grid">
                @foreach ( as )
                    @php
                         = ->product;
                    @endphp
                    <article class="wishlist-card">
                        <form action="{{ route('wishlist.destroy', ->id) }}" method="POST" class="wishlist-remove">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: transparent; border: none; cursor: pointer;" aria-label="Remove from wishlist">×</button>
                        </form>
                        <a href="{{ route('product', ->id) }}">
                            <div class="wishlist-image">
                                <img src="{{ ->main_image_url }}" alt="{{ ->name }}">
                            </div>
                        </a>
                        <div class="wishlist-body">
                            <h2 class="wishlist-name">{{ ->name }}</h2>
                            <p class="wishlist-price">Rs. {{ number_format((float) ->effective_price, 2) }}</p>
                            <div class="wishlist-actions">
                                <a class="wishlist-btn" href="{{ route('product', ->id) }}">View Product</a>
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ ->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="wishlist-btn secondary" style="width: 100%;">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
</x-layout>
