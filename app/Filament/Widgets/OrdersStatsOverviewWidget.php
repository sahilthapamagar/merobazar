<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrdersStatsOverviewWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 0;

    protected static bool $isLazy = true;

    protected ?string $heading = 'Platform Overview';

    protected function getStats(): array
    {
        $orders = fn () => Order::query();

        $totalOrders = ($orders())->count();
        $revenue = (float) ($orders())->sum('total_amount');
        $pending = ($orders())->where('status', 'pending')->count();
        $delivered = ($orders())->where('status', 'delivered')->count();
        $cancelled = ($orders())->where('status', 'cancelled')->count();

        return [
            Stat::make('Total Orders', $totalOrders)
                ->description('All sellers, all time')
                ->icon(Heroicon::ShoppingBag)
                ->color('primary'),
            Stat::make('Total Revenue', 'Rs ' . number_format($revenue, 2))
                ->description('Across all orders')
                ->icon(Heroicon::Banknotes)
                ->color('success'),
            Stat::make('Pending', $pending)
                ->description('Awaiting processing')
                ->icon(Heroicon::Clock)
                ->color('warning'),
            Stat::make('Delivered', $delivered)
                ->description($cancelled . ' cancelled')
                ->icon(Heroicon::CheckCircle)
                ->color('success'),
        ];
    }
}
