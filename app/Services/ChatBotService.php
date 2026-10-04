<?php

namespace App\Services;

use App\Models\Category;
use App\Models\ChatSession;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChatBotService
{
    /**
     * Analyse a user message and produce the assistant's reply.
     *
     * @return array{reply: string, escalate: bool}
     */
    public function reply(string $message, ?ChatSession $session = null): array
    {
        $text = $this->normalize($message);

        if ($text === '') {
            return $this->replyWith($this->fallbackMessage());
        }

        return match ($this->detectIntent($text)) {
            'escalate' => ['reply' => $this->handoffMessage(), 'escalate' => true],
            'greeting' => $this->replyWith($this->greetingMessage()),
            'thanks' => $this->replyWith($this->thanksMessage()),
            'goodbye' => $this->replyWith($this->goodbyeMessage()),
            'order' => $this->replyWith($this->orderMessage($text, $session)),
            'returns' => $this->replyWith($this->returnsMessage()),
            'shipping' => $this->replyWith($this->shippingMessage()),
            'payment' => $this->replyWith($this->paymentMessage()),
            'sell' => $this->replyWith($this->sellMessage()),
            'contact' => $this->replyWith($this->contactMessage()),
            'price' => $this->replyWith($this->priceMessage()),
            'category' => $this->replyWith($this->categoryMessage($text)),
            'product' => $this->replyWith($this->productMessage($text)),
            default => $this->replyWith($this->fallbackMessage()),
        };
    }

    /**
     * The welcome message shown when a conversation starts.
     */
    public function welcomeMessage(): string
    {
        return "Hi there! I'm MeroBazar's virtual assistant. How can I help you today?\n\n"
            ."You can ask me about:\n"
            ."- Shipping & delivery\n"
            ."- Returns & refunds\n"
            ."- Order tracking\n"
            ."- Products & categories\n"
            ."- Payment methods\n\n"
            ."Or type **'human'** to talk to a live agent.";
    }

    /**
     * Message shown after a hand-off to a human agent has been triggered.
     */
    public function handoffMessage(): string
    {
        return "I've connected you with our support team. An agent will respond shortly. "
            .'You can keep typing your message below and a team member will pick it up.';
    }

    /**
     * Detect the highest-priority intent for a normalized message.
     *
     * Rules are evaluated top-to-bottom: the first match wins. Order matters —
     * specific intents (order tracking, escalation) must come before generic
     * ones (products) so a message is never swallowed by a broad keyword.
     */
    protected function detectIntent(string $text): string
    {
        $rules = [
            // A live human is requested explicitly.
            'escalate' => '/\b(human|agent|real person|representative|operator|customer (care|service)|talk to (a )?(human|person|someone|agent|staff)|speak to (a )?(human|person|someone|agent|staff)|connect me)\b/',

            // Order tracking — requires an order-ish signal, not a bare "where"/"status".
            'order' => '/\b(order|orders|ordered|track|tracking|parcel|package|shipment|order status|delivery status|where is my (order|parcel|package|stuff))\b|\b#\d+\b/',

            'returns' => '/\b(return|returns|refund|refunds|exchange|replace|replacement|cancel|cancellation|money back)\b/',

            'shipping' => '/\b(shipping|delivery|deliver|shipped|ship|courier|dispatch|how long|when will (it|my order) arrive|arrive)\b/',

            'payment' => '/\b(payment|pay|paid|paying|khalti|e-?sewa|esewa|cod|cash on delivery|card|transaction|invoice)\b/',

            'sell' => '/\b(sell|selling|seller|vendor|merchant|become a seller|open a shop|register (my )?shop)\b/',

            'contact' => '/\b(contact|phone|call|email|address|location|reach|whatsapp|viber)\b/',

            'price' => '/\b(price|prices|cost|costs|cheap|cheapest|affordable|discount|discounts|sale|offer|offers|deal|deals|promo|coupon)\b/',

            // Explicitly about the category taxonomy — kept ahead of "product"
            // because "categories" also reads like a product query.
            'category' => '/\b(categor(y|ies)|department|collection|section|browse by)\b/',

            'product' => '/\b(product|products|item|items|shop|shopping|browse|buy|purchase|stock|available|looking for|search for)\b/',
        ];

        foreach ($rules as $intent => $pattern) {
            if (preg_match($pattern, $text)) {
                return $intent;
            }
        }

        // No keyword matched: check whether the message names a real category
        // or product (e.g. "what headphones do you have?").
        if ($this->matchNamedCategory($text)) {
            return 'category';
        }

        if ($this->hasMatchingProduct($text)) {
            return 'product';
        }

        // Pure greetings are matched last so "hi, where is my order?" tracks the
        // order instead of being treated as a hello.
        if ($this->isGreeting($text)) {
            return 'greeting';
        }

        if (preg_match('/\b(thank|thanks|thank you|thx|dhanyabad|dhanyawad|shukriya|appreciate it)\b/', $text)) {
            return 'thanks';
        }

        if (preg_match('/\b(bye|goodbye|see you|see ya|alvida|huss|tata|good night)\b/', $text)) {
            return 'goodbye';
        }

        return 'unknown';
    }

    /**
     * A message is a greeting when it starts with a greeting and carries no
     * other recognisable request (kept short on purpose).
     */
    protected function isGreeting(string $text): bool
    {
        $starts = preg_match('/^(hi+|hey+|hello+|yo|hola|namaste|namaskar|good\s*(morning|afternoon|evening)|sup)\b/', $text);

        return (bool) $starts && str_word_count($text) <= 5;
    }

    /* ────────────────────────────── Intents ────────────────────────────── */

    protected function orderMessage(string $text, ?ChatSession $session = null): string
    {
        $user = Auth::guard('web')->user() ?? $session?->user;

        if (! $user) {
            return 'Please log in to check your order status. You can log in from the top-right corner of the page.';
        }

        $orderId = $this->extractOrderId($text);

        $order = null;
        if ($orderId !== null) {
            $order = Order::query()
                ->where('user_id', $user->id)
                ->notAbandonedPayment()
                ->find($orderId);
        }

        if ($orderId !== null && ! $order) {
            return "I couldn't find order **#{$orderId}** on your account. Please double-check the number or visit your [Buying History](/buying-history).";
        }

        $order ??= Order::query()
            ->where('user_id', $user->id)
            ->notAbandonedPayment()
            ->latest()
            ->first();

        if (! $order) {
            return "You don't have any orders yet. Browse our [products](/products) to get started!";
        }

        $items = $order->orderItems()->with('product')->get();

        $reply = "📋 **Order #{$order->id}**\n\n"
            .'Status: **'.ucfirst($order->status)."**\n"
            .'Payment: '.ucfirst((string) $order->payment_status).' ('.strtoupper((string) $order->payment_method).")\n"
            .'Total: Rs. '.number_format((float) $order->total_amount);

        if ($items->isNotEmpty()) {
            $reply .= "\n\nItems:\n".$items->map(function ($item) {
                $name = $item->product->name ?? 'Product';

                return "- {$name} × {$item->quantity}";
            })->join("\n");
        }

        return $reply."\n\nSee full details in your [Buying History](/buying-history).";
    }

    protected function productMessage(string $text): string
    {
        $products = $this->searchProducts($text);

        if ($products->isEmpty()) {
            $products = Product::query()->latest()->take(3)->get();
        }

        if ($products->isEmpty()) {
            return 'Check out our latest products at [Products](/products)! We have a wide range of categories to choose from.';
        }

        $heading = $this->searchTerm($text) ? 'Products matching your search' : 'Popular Products';

        return "🛍️ **{$heading}**\n\n"
            .$products->map(fn (Product $p) => $this->formatProductLine($p))->join("\n")
            ."\n\nVisit [Products](/products) to see all items!";
    }

    protected function categoryMessage(string $text): string
    {
        // If the message names a specific category, show its products.
        if ($category = $this->matchNamedCategory($text)) {
            $products = $category->products()->latest()->take(3)->get();

            if ($products->isNotEmpty()) {
                return "📂 **{$category->name}**\n\n"
                    .$products->map(fn (Product $p) => $this->formatProductLine($p))->join("\n")
                    ."\n\nBrowse all of [{$category->name}](/products?category={$category->slug}).";
            }

            return "📂 **{$category->name}**\n\nBrowse everything in [{$category->name}](/products?category={$category->slug}).";
        }

        $categories = Category::take(6)->get();

        if ($categories->isEmpty()) {
            return 'We have many categories! Visit [Categories](/categories) to explore.';
        }

        return "📂 **Our Categories**\n\n"
            .$categories->map(fn (Category $c) => "- [{$c->name}](/products?category={$c->slug})")->join("\n")
            ."\n\nSee all at [Categories](/categories)!";
    }

    protected function shippingMessage(): string
    {
        return "📦 **Shipping Information**\n\n"
            ."- Free shipping on orders over Rs. 1500\n"
            ."- Standard delivery: 3-5 business days\n"
            ."- Express delivery: 1-2 business days\n"
            ."- We ship across Nepal\n\n"
            .'Need more details? Ask me anything!';
    }

    protected function returnsMessage(): string
    {
        return "🔄 **Returns & Refunds**\n\n"
            ."- 7-day return policy from delivery date\n"
            ."- Items must be unused with tags attached\n"
            ."- Refund processed within 5-7 business days\n"
            ."- Free returns for defective items\n\n"
            ."Would you like to initiate a return? Type **'human'** and our team will help.";
    }

    protected function paymentMessage(): string
    {
        return "💳 **Payment Methods**\n\n"
            ."- Khalti (online)\n"
            ."- eSewa (online)\n"
            ."- Cash on Delivery (COD)\n\n"
            .'All transactions are secure and encrypted.';
    }

    protected function sellMessage(): string
    {
        return "🏪 **Sell on MeroBazar**\n\n"
            .'Interested in becoming a seller? Fill out our [Vendor Application](/seller-form) and our team will review your request within 48 hours.';
    }

    protected function contactMessage(): string
    {
        return "📞 **Contact Us**\n\n"
            ."- Email: support@merobazar.com\n"
            ."- Phone: +977-XXXXXXXXXX\n"
            ."- Address: Kathmandu, Nepal\n\n"
            .'Or use this chat to reach us anytime!';
    }

    protected function priceMessage(): string
    {
        return "💰 **Pricing & Offers**\n\n"
            ."- We offer competitive prices on all products\n"
            ."- Free shipping on orders over Rs. 1500\n"
            ."- Check out our [Flash Sales](/flash-sales) for limited-time deals\n\n"
            .'Looking for a specific item? Tell me its name.';
    }

    protected function greetingMessage(): string
    {
        return 'Hello! Welcome to MeroBazar. How can I assist you today?';
    }

    protected function thanksMessage(): string
    {
        return "You're welcome! Is there anything else I can help you with?";
    }

    protected function goodbyeMessage(): string
    {
        return 'Goodbye! Have a great day! Feel free to come back anytime. 😊';
    }

    protected function fallbackMessage(): string
    {
        return "I'm not sure I understand that. Could you try rephrasing?\n\n"
            ."I can help with:\n"
            ."- Shipping & delivery\n"
            ."- Returns & refunds\n"
            ."- Order tracking\n"
            ."- Products & categories\n"
            ."- Payment methods\n\n"
            ."Or type **'human'** to talk to a live agent.";
    }

    /* ───────────────────────────── Helpers ─────────────────────────────── */

    /**
     * @return array{reply: string, escalate: bool}
     */
    protected function replyWith(string $message): array
    {
        return ['reply' => $message, 'escalate' => false];
    }

    /**
     * Lowercase, collapse whitespace and repair a few common typos so keyword
     * matching stays forgiving without a full spell-checker.
     */
    protected function normalize(string $message): string
    {
        $text = Str::lower(trim($message));
        $text = preg_replace('/\s+/', ' ', $text) ?? $text;

        $typos = [
            'shipsing' => 'shipping',
            'shiping' => 'shipping',
            'delivary' => 'delivery',
            'dilivery' => 'delivery',
            'refud' => 'refund',
            'retun' => 'return',
            'tracking' => 'tracking',
            'prodct' => 'product',
            'produts' => 'products',
            'orderr' => 'order',
            'payement' => 'payment',
            'custmer' => 'customer',
            'humaan' => 'human',
        ];

        foreach ($typos as $wrong => $right) {
            $text = str_replace($wrong, $right, $text);
        }

        return $text;
    }

    /**
     * Extract a numeric order reference such as "order 42", "order #42" or "#42".
     */
    protected function extractOrderId(string $text): ?int
    {
        if (preg_match('/(?:order\s*#?\s*|#)(\d{1,10})/', $text, $matches)) {
            return (int) $matches[1];
        }

        return null;
    }

    /**
     * The free-text search phrase left after structural keywords are removed.
     */
    protected function searchTerm(string $text): ?string
    {
        $terms = $this->searchKeywords($text);

        return $terms === [] ? null : implode(' ', $terms);
    }

    /**
     * Words from the message worth matching against product names.
     *
     * @return array<int, string>
     */
    protected function searchKeywords(string $text): array
    {
        $stopWords = [
            'i', 'me', 'my', 'we', 'our', 'you', 'your', 'do', 'does', 'did', 'can', 'could',
            'would', 'should', 'is', 'are', 'am', 'was', 'were', 'be', 'been', 'being', 'have',
            'has', 'had', 'the', 'a', 'an', 'of', 'to', 'in', 'on', 'for', 'with', 'about',
            'and', 'or', 'but', 'if', 'so', 'this', 'that', 'these', 'those', 'it', 'its',
            'show', 'find', 'search', 'searching', 'looking', 'look', 'want', 'need', 'buy',
            'purchase', 'get', 'any', 'some', 'there', 'here', 'what', 'which', 'where', 'how',
            'please', 'pls', 'hi', 'hello', 'hey', 'product', 'products', 'item', 'items',
            'shop', 'shopping', 'browse', 'price', 'cost', 'available', 'stock', 'good', 'best',
        ];

        $words = preg_split('/[^a-z0-9]+/', $text) ?: [];

        return array_values(array_filter($words, function (string $word) use ($stopWords) {
            return strlen($word) > 2 && ! in_array($word, $stopWords, true);
        }));
    }

    /**
     * Match the message against product names, falling back to nothing when
     * no meaningful keyword remains.
     *
     * @return Collection<int, Product>
     */
    protected function searchProducts(string $text): Collection
    {
        $terms = $this->searchKeywords($text);

        if ($terms === []) {
            return collect();
        }

        return Product::query()
            ->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->orWhere('name', 'like', "%{$term}%");
                }
            })
            ->latest()
            ->take(3)
            ->get();
    }

    /**
     * Whether the message contains a keyword that matches a product name.
     */
    protected function hasMatchingProduct(string $text): bool
    {
        $terms = $this->searchKeywords($text);

        if ($terms === []) {
            return false;
        }

        return Product::query()
            ->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->orWhere('name', 'like', "%{$term}%");
                }
            })
            ->exists();
    }

    /**
     * If the message names a real category, return it.
     */
    protected function matchNamedCategory(string $text): ?Category
    {
        return Category::query()
            ->get()
            ->first(function (Category $category) use ($text) {
                $name = Str::lower($category->name);
                $slug = Str::lower((string) $category->slug);

                return ($name !== '' && str_contains($text, $name))
                    || ($slug !== '' && str_contains($text, str_replace('-', ' ', $slug)));
            });
    }

    protected function formatProductLine(Product $product): string
    {
        $price = 'Rs. '.number_format($product->effective_price);

        if ($product->is_discounted) {
            $price .= ' ('.$product->discount_percent.'% off)';
        }

        return "- [{$product->name}](/product/{$product->id}) — {$price}";
    }
}
