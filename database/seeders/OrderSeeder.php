<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed 100 orders with their order items.
     */
    public function run(): void
    {
        // Disable foreign key checks so the chain reviews → order_items → orders can be truncated.
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Review::truncate();
        OrderItem::truncate();
        Order::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Make sure we have enough users so orders are spread across different buyers.
        if (User::count() < 20) {
            User::factory()->count(20 - User::count())->create();
        }

        $users = User::pluck('id')->all();
        $products = Product::all();
        $sellersWithProducts = $products->pluck('seller_id')->unique()->values()->all();

        if (empty($users) || empty($sellersWithProducts)) {
            $this->command->warn('OrderSeeder needs users and products. Run User, Seller and Product seeders first.');

            return;
        }

        for ($i = 0; $i < 100; $i++) {
            $sellerId = Arr::random($sellersWithProducts);
            $pool = $products->where('seller_id', $sellerId);

            $itemCount = rand(1, 4);
            $chosen = $pool->random(min($itemCount, $pool->count()));

            $totalAmount = 0.0;
            $items = [];
            foreach ($chosen as $product) {
                $quantity = rand(1, 3);
                $amount = round((float) $product->effective_price * $quantity, 2);
                $totalAmount += $amount;
                $items[] = [
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'amount' => $amount,
                ];
            }

            $paymentMethod = Arr::random(['cod', 'khalti']);

            $order = Order::create([
                'user_id' => Arr::random($users),
                'seller_id' => $sellerId,
                'status' => $this->randomStatus(),
                'total_amount' => round($totalAmount, 2),
                'payment_method' => $paymentMethod,
                'payment_status' => $paymentMethod === 'khalti'
                    ? (rand(1, 10) <= 8 ? 'Completed' : 'Expired')
                    : 'pending',
                'created_at' => now()->subDays(rand(1, 120))->subHours(rand(0, 23)),
            ]);

            foreach ($items as $item) {
                $order->orderItems()->create($item);
            }
        }
    }

    /**
     * Weighted status: ~65% delivered so the ReviewSeeder has enough items to review.
     */
    private function randomStatus(): string
    {
        $roll = rand(1, 100);

        if ($roll <= 65) {
            return 'delivered';
        }

        if ($roll <= 80) {
            return 'pending';
        }

        if ($roll <= 92) {
            return 'processing';
        }

        return 'cancelled';
    }
}
