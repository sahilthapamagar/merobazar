<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed 150 reviews, one per order item from delivered orders.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Review::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $items = OrderItem::with('order')
            ->whereHas('order', fn ($q) => $q->where('status', 'delivered'))
            ->inRandomOrder()
            ->take(150)
            ->get();

        if ($items->isEmpty()) {
            $this->command->warn('ReviewSeeder needs delivered orders. Run OrderSeeder first.');

            return;
        }

        if ($items->count() < 150) {
            $this->command->warn('Only '.$items->count().' delivered order items available; seeded that many reviews.');
        }

        $comments = [
            'Absolutely love it! The quality exceeded my expectations.',
            'Great product, exactly as described. Fast delivery too.',
            'Very comfortable and well made. Worth every rupee.',
            'Beautiful piece, got many compliments already.',
            'Good value for money. Would buy again.',
            'The material feels premium and the fit is perfect.',
            'Delivery was quick and the packaging was neat.',
            'Exactly what I was looking for. Highly recommended.',
            'Decent quality, though shipping took a little longer than expected.',
            'My new favorite item. Can not stop wearing it.',
            'Nice product overall but the color is slightly different from the photo.',
            'Superb craftsmanship. You can tell a lot of care went into this.',
            'Works great and looks even better in person.',
            'Happy with the purchase. Customer support was helpful too.',
            'The size runs a bit small, so consider sizing up. Otherwise great.',
            'Really impressed with the attention to detail.',
            'Average quality for the price. It does the job.',
            'Excellent experience from order to delivery.',
            'Would recommend to friends and family.',
            'Just as pictured. Very satisfied.',
        ];

        foreach ($items as $item) {
            Review::create([
                'user_id' => $item->order->user_id,
                'product_id' => $item->product_id,
                'order_item_id' => $item->id,
                'rating' => $this->randomRating(),
                'comment' => Arr::random($comments),
                'created_at' => $item->order->created_at->copy()->addDays(rand(1, 10)),
            ]);
        }
    }

    /**
     * Rating weighted toward positive reviews (typical for real stores).
     */
    private function randomRating(): int
    {
        $roll = rand(1, 100);

        if ($roll <= 55) {
            return 5;
        }

        if ($roll <= 80) {
            return 4;
        }

        if ($roll <= 90) {
            return 3;
        }

        if ($roll <= 96) {
            return 2;
        }

        return 1;
    }
}
