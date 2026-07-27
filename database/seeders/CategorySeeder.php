<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => "Men's Wear",
                'slug' => 'mens-wear',
                'image' => 'https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?w=600&q=80&auto=format',
            ],
            [
                'name' => "Women's Wear",
                'slug' => 'womens-wear',
                'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=600&q=80&auto=format',
            ],
            [
                'name' => 'Shoes',
                'slug' => 'shoes',
                'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=600&q=80&auto=format',
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'image' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=600&q=80&auto=format',
            ],
            [
                'name' => 'Health & Beauty',
                'slug' => 'health-beauty',
                'image' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=600&q=80&auto=format',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
