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

        .wishlist-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.3em;
            color: var(--secondary);
            margin-bottom: 0.6rem;
        }

        .wishlist-title {
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
            width: 100%;
            height: 280px;
            background: var(--cream);
            overflow: hidden;
        }

        .wishlist-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .wishlist-body {
            padding: 1.25rem 1.5rem;
        }

        .wishlist-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            color: var(--primary);
            margin: 0 0 0.4rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .wishlist-price {
            color: var(--secondary);
            font-weight: 500;
            margin: 0 0 1rem;
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
            padding: 0.7rem 1rem;
            border: 1px solid var(--primary);
            background: var(--primary);
            color: var(--accent);
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 0.72rem;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        .wishlist-btn.is-secondary {
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
            z-index: 2;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 1px solid rgba(171, 136, 109, 0.25);
            background: #fff;
            display: grid;
            place-items: center;
            cursor: pointer;
        }

        .wishlist-remove button {
            background: transparent;
            border: none;
            font-size: 1.15rem;
            line-height: 1;
            color: var(--primary);
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
            margin: 0 0 0.5rem;
        }

        .wishlist-empty span {
            display: block;
            font-size: 0.88rem;
            color: rgba(73, 54, 40, 0.5);
            margin-bottom: 1.5rem;
        }

        .wishlist-empty a {
            display: inline-block;
            padding: 0.8rem 2rem;
            border: 1px solid var(--primary);
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-size: 0.78rem;
            text-decoration: none;
        }
    </style>

    <section class="wishlist-page">
        <header class="wishlist-header">
            <p class="wishlist-label">My Collection</p>
            <h1 class="wishlist-title">Your <em>Wishlist</em></h1>
        </header>

        @if ($wishlists->isEmpty())
            <div class="wishlist-empty">
                <p>Your wishlist is empty</p>
                <span>Save your favourite pieces to revisit them later.</span>
                <a href="{{ route('products') }}">Browse Products</a>
            </div>
        @else
            <div class="wishlist-grid">
                @foreach ($wishlists as $wishlist)
                    @php
                        $product = $wishlist->product;
                    @endphp

                    <article class="wishlist-card">
                        <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST" class="wishlist-remove">
                            @csrf
                            @method('DELETE')
                            <button type="submit" aria-label="Remove from wishlist">&times;</button>
                        </form>

                        <a href="{{ route('product', $product->id) }}">
                            <div class="wishlist-image">
                                <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}">
                            </div>
                        </a>

                        <div class="wishlist-body">
                            <h2 class="wishlist-name">{{ $product->name }}</h2>
                            <p class="wishlist-price">Rs. {{ number_format((float) $product->effective_price, 2) }}</p>

                            <div class="wishlist-actions">
                                <a class="wishlist-btn" href="{{ route('product', $product->id) }}">View Product</a>

                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="wishlist-btn is-secondary">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
</x-layout>