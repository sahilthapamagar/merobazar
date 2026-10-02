<?php

namespace App\Filament\Seller\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class SellerOrderStatusPieChartWidget extends ChartWidget
{
    protected static ?int $sort = 3;

    protected static bool $isLazy = true;

    protected ?string $heading = 'Order Status';

    protected ?string $description = 'Breakdown of your orders by status';

    protected ?string $maxHeight = '300px';

    protected function getType(): string
    {
        return 'pie';
    }

    /**
     * @return array<string, mixed>
     */
    protected function getData(): array
    {
        $statuses = [
            'pending' => 'Pending',
            'processing' => 'Processing',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
        ];

        $counts = Order::where('seller_id', Auth::guard('vendor')->id())
            ->selectRaw('status, count(*) as aggregate')
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        return [
            'datasets' => [
                [
                    'data' => array_map(
                        fn (string $key): int => (int) ($counts[$key] ?? 0),
                        array_keys($statuses),
                    ),
                    'backgroundColor' => [
                        '#F59E0B', // pending
                        '#3B82F6', // processing
                        '#10B981', // delivered
                        '#EF4444', // cancelled
                    ],
                    'borderWidth' => 0,
                ],
            ],
            'labels' => array_values($statuses),
        ];
    }
}
