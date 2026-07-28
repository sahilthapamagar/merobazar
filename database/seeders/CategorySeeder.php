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
                'image' => 'category/mens-wear.jpg',
            ],
            [
                'name' => "Women's Wear",
                'slug' => 'womens-wear',
                'image' => 'category/womens-wear.jpg',
            ],
            [
                'name' => 'Shoes',
                'slug' => 'shoes',
                'image' => 'category/shoes.jpg',
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'image' => 'category/accessories.jpg',
            ],
            [
                'name' => 'Health & Beauty',
                'slug' => 'health-beauty',
                'image' => 'category/health-beauty.jpg',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
