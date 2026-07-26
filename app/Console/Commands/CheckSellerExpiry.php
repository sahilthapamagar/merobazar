<?php

namespace App\Console\Commands;

use App\Models\Seller;
use Illuminate\Console\Command;

class CheckSellerExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sellers:check-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set sellers to inactive when their expired_date matches or passes today';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = Seller::where('expired_date', '<=', now()->toDateString())
            ->where('status', '!=', 'inactive')
            ->whereNotNull('expired_date')
            ->update(['status' => 'inactive']);

        $this->info("{$count} seller(s) have been set to inactive.");
    }
}
