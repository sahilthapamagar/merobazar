<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SellerSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to allow truncating sellers
        // (products table has a foreign key referencing sellers)
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Seller::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Seller::factory()->count(20)->create();
    }
}
