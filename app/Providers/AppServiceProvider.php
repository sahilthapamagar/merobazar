<?php

namespace App\Providers;

use App\Models\FlashSale;
use App\Models\Order;
use App\Models\Seller;
use App\Observers\OrderObserver;
use App\Observers\SellerObserver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Seller::observe(SellerObserver::class);
        Order::observe(OrderObserver::class);

        Model::unguard();

        // Share the earliest ending active flash sale with all views (navbar live badge).
        View::share('navFlashSaleEnd', function () {
            // min() is a raw SQL aggregate, so parse it into a Carbon instance.
            $end = FlashSale::active()->min('end_time');

            return $end ? Carbon::parse($end) : null;
        });
    }
}
