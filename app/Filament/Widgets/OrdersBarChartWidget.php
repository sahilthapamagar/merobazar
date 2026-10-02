<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrdersBarChartWidget extends ChartWidget
{
    protected static ?int $sort = 2;

    protected static bool $isLazy = true;

    protected ?string $heading = 'Orders per Month';

    protected ?string $description = 'Orders by status over the last 6 months';

    protected ?string $maxHeight = '300px';

    /**
     * @var array<string, array{0: string, 1: string}>
     */
    protected array $statusStyles = [
        'pending' => ['Pending', '#F59E0B'],
        'processing' => ['Processing', '#3B82F6'],
        'delivered' => ['Delivered', '#10B981'],
        'cancelled' => ['Cancelled', '#EF4444'],
    ];

    protected function getType(): string
    {
        return 'bar';
    }

    /**
     * @return array<string, mixed>
     */
    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => ['stacked' => true],
                'y' => ['stacked' => true],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getData(): array
    {
        $start = now()->startOfMonth()->subMonths(5);

        $counts = Order::query()
            ->where('created_at', '>=', $start)
            ->get(['created_at', 'status'])
            ->countBy(fn (Order $order) => $order->created_at->format('Y-m') . '|' . $order->status);

        $labels = [];
        $months = [];

        for ($i = 5; $i >= 0; $i--) {
            $period = now()->startOfMonth()->subMonths($i);
            $labels[] = $period->format('M Y');
            $months[] = $period->format('Y-m');
        }

        $datasets = [];

        foreach ($this->statusStyles as $status => [$label, $color]) {
            $datasets[] = [
                'label' => $label,
                'backgroundColor' => $color,
                'borderWidth' => 0,
                'data' => array_map(
                    fn (string $month): int => (int) $counts->get($month . '|' . $status, 0),
                    $months,
                ),
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }
}
