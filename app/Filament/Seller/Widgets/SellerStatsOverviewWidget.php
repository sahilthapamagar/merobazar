<?php

namespace App\Filament\Seller\Widgets;

use App\Models\Order;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class SellerStatsOverviewWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected static bool $isLazy = true;

    protected ?string $heading = 'Store Overview';

    protected function getStats(): array
    {
        $sellerId = Auth::guard('vendor')->id();

        $orders = fn () => Order::where('seller_id', $sellerId);

        $totalOrders = ($orders())->count();
        $revenue = (float) ($orders())->sum('total_amount');
        $pending = ($orders())->where('status', 'pending')->count();
        $delivered = ($orders())->where('status', 'delivered')->count();
        $cancelled = ($orders())->where('status', 'cancelled')->count();

        return [
            Stat::make('Total Orders', $totalOrders)
                ->description('All time orders')
                ->icon(Heroicon::ShoppingBag)
                ->color('primary'),
            Stat::make('Total Revenue', 'Rs '.number_format($revenue, 2))
                ->description('Across all orders')
                ->icon(Heroicon::Banknotes)
                ->color('success'),
            Stat::make('Pending', $pending)
                ->description('Awaiting processing')
                ->icon(Heroicon::Clock)
                ->color('warning'),
            Stat::make('Delivered', $delivered)
                ->description($cancelled.' cancelled')
                ->icon(Heroicon::CheckCircle)
                ->color('success'),
        ];
    }
}
