<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to allow truncating products
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $products = [
            // ─── Men's Wear (category_id: 1) ───────────────────────────
            [
                'name'        => 'Premium Oxford Shirt',
                'title'       => 'Classic Fit Premium Cotton Oxford Shirt for Men',
                'description' => '<p>Elevate your wardrobe with this classic-fit Oxford shirt crafted from premium cotton. Features a button-down collar, chest pocket, and adjustable cuffs. Perfect for both casual and semi-formal occasions.</p><p><strong>Key Features:</strong></p><ul><li>100% premium cotton</li><li>Button-down collar</li><li>Chest pocket</li><li>Adjustable barrel cuffs</li><li>Machine washable</li></ul>',
                'price'       => 2499.00,
                'main_image'  => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=600&q=80&auto=format',
                    'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 16,
                'category_id' => 1,
            ],
            [
                'name'        => 'Slim Fit Blazer',
                'title'       => 'Modern Slim Fit Wool Blend Blazer',
                'description' => '<p>Make a statement with this modern slim-fit blazer crafted from a luxurious wool blend. Features a two-button closure, notch lapels, and interior pockets.</p><p><strong>Key Features:</strong></p><ul><li>Wool blend fabric</li><li>Two-button closure</li><li>Notch lapels</li><li>Interior breast pocket</li><li>Dry clean recommended</li></ul>',
                'price'       => 5499.00,
                'main_image'  => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 16,
                'category_id' => 1,
            ],
            [
                'name'        => 'Denim Jacket',
                'title'       => 'Classic Vintage Wash Denim Jacket',
                'description' => '<p>A timeless wardrobe staple — this vintage-wash denim jacket features a classic button-front design with multiple pockets and a comfortable regular fit.</p><p><strong>Key Features:</strong></p><ul><li>100% cotton denim</li><li>Vintage wash finish</li><li>Button-front closure</li><li>Chest flap pockets</li><li>Adjustable waist tabs</li></ul>',
                'price'       => 3499.00,
                'main_image'  => 'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 2,
                'category_id' => 1,
            ],
            [
                'name'        => 'Cashmere Sweater',
                'title'       => 'Luxurious Pure Cashmere Crew Neck Sweater',
                'description' => '<p>Indulge in the unparalleled softness of 100% pure cashmere. This crew neck sweater offers a relaxed fit with ribbed cuffs and hem for a polished look.</p><p><strong>Key Features:</strong></p><ul><li>100% pure cashmere</li><li>Crew neck design</li><li>Ribbed cuffs and hem</li><li>Hand wash recommended</li><li>Available in multiple colors</li></ul>',
                'price'       => 6999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1509631179647-0177331693ae?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1509631179647-0177331693ae?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 2,
                'category_id' => 1,
            ],
            [
                'name'        => 'Chino Pants',
                'title'       => 'Slim Fit Stretch Chino Pants',
                'description' => '<p>Stay comfortable and sharp with these slim-fit chino pants featuring a touch of stretch for added mobility. Perfect for the office or a night out.</p><p><strong>Key Features:</strong></p><ul><li>Cotton-spandex blend</li><li>Slim fit</li><li>Mid-rise waist</li><li>Zip fly with button closure</li><li>Machine washable</li></ul>',
                'price'       => 2199.00,
                'main_image'  => 'https://images.unsplash.com/photo-1473966968600-fa801b869a1a?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1473966968600-fa801b869a1a?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 16,
                'category_id' => 1,
            ],
            [
                'name'        => 'Linen Shirt',
                'title'       => 'Breathable Linen Relaxed Fit Shirt',
                'description' => '<p>Stay cool and stylish in hot weather with this breathable linen shirt. The relaxed fit and natural fabric make it ideal for summer outings.</p><p><strong>Key Features:</strong></p><ul><li>100% pure linen</li><li>Relaxed fit</li><li>Spread collar</li><li>Chest pocket</li><li>Natural wrinkle texture</li></ul>',
                'price'       => 2799.00,
                'main_image'  => 'https://images.unsplash.com/photo-1598033129183-c4f50c736e10?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1598033129183-c4f50c736e10?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 2,
                'category_id' => 1,
            ],
            [
                'name'        => 'Leather Bomber Jacket',
                'title'       => 'Genuine Leather Bomber Jacket with Quilted Lining',
                'description' => '<p>Turn heads with this genuine leather bomber jacket. Features a warm quilted interior lining, ribbed cuffs and hem, and a classic front zip closure.</p><p><strong>Key Features:</strong></p><ul><li>Genuine leather</li><li>Quilted interior lining</li><li>Ribbed cuffs, collar, and hem</li><li>Front zip closure</li><li>Side zip pockets</li></ul>',
                'price'       => 8999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1520975954732-35dd22299614?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1520975954732-35dd22299614?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 16,
                'category_id' => 1,
            ],
            [
                'name'        => 'Graphic Print T-Shirt',
                'title'       => 'Oversized Graphic Print Cotton T-Shirt',
                'description' => '<p>Express yourself with this oversized graphic print tee. Made from soft, breathable cotton with a unique artistic print that stands out.</p><p><strong>Key Features:</strong></p><ul><li>100% ring-spun cotton</li><li>Oversized fit</li><li>Artistic graphic print</li><li>Crew neckline</li><li>Pre-shrunk fabric</li></ul>',
                'price'       => 1299.00,
                'main_image'  => 'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 2,
                'category_id' => 1,
            ],
            [
                'name'        => 'Wool Trousers',
                'title'       => 'Pleated Front Wool Blend Trousers',
                'description' => '<p>Sophisticated and comfortable — these pleated front trousers are crafted from a premium wool blend. Perfect for business attire or formal events.</p><p><strong>Key Features:</strong></p><ul><li>Wool-polyester blend</li><li>Pleated front</li><li>Flat front option available</li><li>Hook and bar closure</li><li>Unfinished hem for custom tailoring</li></ul>',
                'price'       => 3999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 16,
                'category_id' => 1,
            ],
            [
                'name'        => 'Puffer Vest',
                'title'       => 'Insulated Lightweight Puffer Vest',
                'description' => '<p>Layer up with this lightweight puffer vest. Filled with premium synthetic insulation, it provides warmth without the bulk. Features a stand-up collar and zip pockets.</p><p><strong>Key Features:</strong></p><ul><li>Nylon shell with DWR finish</li><li>Synthetic insulation</li><li>Stand-up collar</li><li>Zip closure</li><li>Machine washable</li></ul>',
                'price'       => 3299.00,
                'main_image'  => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 2,
                'category_id' => 1,
            ],

            // ─── Women's Wear (category_id: 2) ─────────────────────────
            [
                'name'        => 'Silk Midi Dress',
                'title'       => 'Elegant Pure Silk Midi Slip Dress',
                'description' => '<p>Radiate elegance in this pure silk midi slip dress. The luxurious fabric drapes beautifully, featuring a cowl neckline and delicate adjustable straps.</p><p><strong>Key Features:</strong></p><ul><li>100% pure silk</li><li>Cowl neckline</li><li>Adjustable spaghetti straps</li><li>Midi length</li><li>Dry clean only</li></ul>',
                'price'       => 7999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 4,
                'category_id' => 2,
            ],
            [
                'name'        => 'Floral Maxi Dress',
                'title'       => 'Bohemian Floral Print Maxi Dress',
                'description' => '<p>Embrace your free spirit with this bohemian floral maxi dress. Features a flowy silhouette, smocked bodice, and adjustable shoulder ties.</p><p><strong>Key Features:</strong></p><ul><li>Lightweight viscose fabric</li><li>All-over floral print</li><li>Smocked bodice</li><li>Adjustable shoulder ties</li><li>Maxi length</li></ul>',
                'price'       => 3999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 18,
                'category_id' => 2,
            ],
            [
                'name'        => 'Tailored Blazer',
                'title'       => 'Womens Structured Single-Breasted Blazer',
                'description' => '<p>Command attention in this structured single-breasted blazer. Tailored for a sharp silhouette with padded shoulders and a flattering peplum waist.</p><p><strong>Key Features:</strong></p><ul><li>Polyester-spandex blend</li><li>Padded shoulders</li><li>Single-breasted with two buttons</li><li>Peplum waist detail</li><li>Interior pockets</li></ul>',
                'price'       => 4999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 4,
                'category_id' => 2,
            ],
            [
                'name'        => 'High-Waist Jeans',
                'title'       => 'High-Waist Stretch Skinny Jeans',
                'description' => '<p>Your new favorite denim — these high-waist stretch skinny jeans offer a flattering fit with just the right amount of stretch for all-day comfort.</p><p><strong>Key Features:</strong></p><ul><li>Cotton-spandex denim</li><li>High-rise waist</li><li>Skinny leg</li><li>5-pocket styling</li><li>Zip fly with button closure</li></ul>',
                'price'       => 2699.00,
                'main_image'  => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 18,
                'category_id' => 2,
            ],
            [
                'name'        => 'Kurti with Dupatta',
                'title'       => 'Embroidered Cotton Kurti with Dupatta',
                'description' => '<p>Celebrate tradition with style in this beautifully embroidered cotton kurti set. Includes a matching dupatta with delicate thread work and mirror accents.</p><p><strong>Key Features:</strong></p><ul><li>Premium cotton fabric</li><li>Thread embroidery with mirror work</li><li>Round neck with keyhole back</li><li>3/4 sleeves</li><li>Includes matching dupatta</li></ul>',
                'price'       => 3299.00,
                'main_image'  => 'https://images.unsplash.com/photo-1583391733956-6c78276477e2?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1583391733956-6c78276477e2?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 4,
                'category_id' => 2,
            ],
            [
                'name'        => 'Cashmere Cardigan',
                'title'       => 'Luxurious Cashmere Open-Front Cardigan',
                'description' => '<p>Wrap yourself in luxury with this open-front cashmere cardigan. Perfect for layering over any outfit, with a relaxed fit and ribbed trim.</p><p><strong>Key Features:</strong></p><ul><li>100% cashmere</li><li>Open-front design</li><li>Ribbed cuffs and hem</li><li>Relaxed fit</li><li>Hand wash recommended</li></ul>',
                'price'       => 6499.00,
                'main_image'  => 'https://images.unsplash.com/photo-1434389677669-e08b4cac3105?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1434389677669-e08b4cac3105?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 18,
                'category_id' => 2,
            ],
            [
                'name'        => 'Leather Tote Bag',
                'title'       => 'Genuine Leather Oversized Tote Bag',
                'description' => '<p>Carry your essentials in style with this genuine leather oversized tote. Features a spacious main compartment, interior zip pocket, and reinforced handles.</p><p><strong>Key Features:</strong></p><ul><li>Genuine leather</li><li>Oversized design</li><li>Top zip closure</li><li>Interior zip pocket</li><li>Reinforced handles with 12" drop</li></ul>',
                'price'       => 5999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1544966503-7cc5ac882d5f?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1544966503-7cc5ac882d5f?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 4,
                'category_id' => 2,
            ],
            [
                'name'        => 'Wrap Top',
                'title'       => 'Chiffon Wrap Top with Ruffled Sleeves',
                'description' => '<p>Add a touch of femininity to your wardrobe with this chiffon wrap top. Features elegant ruffled sleeves and a flattering wrap silhouette.</p><p><strong>Key Features:</strong></p><ul><li>Lightweight chiffon</li><li>Wrap front with tie closure</li><li>Ruffled 3/4 sleeves</li><li>V-neckline</li><li>Hand wash recommended</li></ul>',
                'price'       => 1999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1598554747436-c9293d6a588f?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1598554747436-c9293d6a588f?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 18,
                'category_id' => 2,
            ],
            [
                'name'        => 'Pleated Skirt',
                'title'       => 'High-Waist Pleated Midi Skirt',
                'description' => '<p>Channel timeless elegance with this high-waist pleated midi skirt. The fluid movement and classic pleats make it a versatile piece for any occasion.</p><p><strong>Key Features:</strong></p><ul><li>Polyester-crepe blend</li><li>High-waist with concealed zip</li><li>Knife pleats all around</li><li>Midi length</li><li>Fully lined</li></ul>',
                'price'       => 2999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1583496661160-fb5886a0aaaa?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1583496661160-fb5886a0aaaa?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 4,
                'category_id' => 2,
            ],
            [
                'name'        => 'Denim Shirt Dress',
                'title'       => 'Relaxed Denim Shirt Dress with Belt',
                'description' => '<p>Effortlessly cool — this denim shirt dress features a relaxed silhouette with a self-tie belt to cinch the waist. Button-front design with chest pockets.</p><p><strong>Key Features:</strong></p><ul><li>100% cotton denim</li><li>Button-front closure</li><li>Self-tie belt included</li><li>Chest flap pockets</li><li>Roll-tab sleeves</li></ul>',
                'price'       => 3799.00,
                'main_image'  => 'https://images.unsplash.com/photo-1585487000160-6eb2ce1e4079?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1585487000160-6eb2ce1e4079?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 18,
                'category_id' => 2,
            ],

            // ─── Shoes (category_id: 3) ─────────────────────────────────
            [
                'name'        => 'Canvas Sneakers',
                'title'       => 'Classic Low-Top Canvas Sneakers',
                'description' => '<p>Step out in timeless style with these classic low-top canvas sneakers. Features a vulcanized rubber sole and cushioned insole for all-day comfort.</p><p><strong>Key Features:</strong></p><ul><li>Durable canvas upper</li><li>Vulcanized rubber sole</li><li>Cushioned footbed</li><li>Cotton laces</li><li>Reinforced toe cap</li></ul>',
                'price'       => 1899.00,
                'main_image'  => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 11,
                'category_id' => 3,
            ],
            [
                'name'        => 'Leather Loafers',
                'title'       => 'Italian Leather Penny Loafers',
                'description' => '<p>Sophistication meets comfort with these Italian leather penny loafers. The premium leather upper molds to your foot for a custom fit over time.</p><p><strong>Key Features:</strong></p><ul><li>Genuine Italian leather</li><li>Classic penny loafer styling</li><li>Leather lining</li><li>Rubber outsole</li><li>Stacked leather heel</li></ul>',
                'price'       => 5499.00,
                'main_image'  => 'https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 1,
                'category_id' => 3,
            ],
            [
                'name'        => 'Running Shoes',
                'title'       => 'Performance Mesh Running Shoes',
                'description' => '<p>Hit your stride with these performance running shoes. The breathable mesh upper and responsive cushioning provide maximum comfort and support.</p><p><strong>Key Features:</strong></p><ul><li>Breathable mesh upper</li><li>Responsive EVA midsole</li><li>Rubber outsole with traction pattern</li><li>Padded collar and tongue</li><li>Reflective accents for visibility</li></ul>',
                'price'       => 4999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 11,
                'category_id' => 3,
            ],
            [
                'name'        => 'Ankle Boots',
                'title'       => 'Suede Chelsea Ankle Boots',
                'description' => '<p>Add edge to any outfit with these suede Chelsea ankle boots. Features elastic side panels and a pull tab for easy on-off wear.</p><p><strong>Key Features:</strong></p><ul><li>Premium suede upper</li><li>Elastic side panels</li><li>Pull tab at back</li><li>Cushioned insole</li><li>Rubber lug sole</li></ul>',
                'price'       => 4499.00,
                'main_image'  => 'https://images.unsplash.com/photo-1608256246200-53e635b5b65f?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1608256246200-53e635b5b65f?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 1,
                'category_id' => 3,
            ],
            [
                'name'        => 'Espadrille Sandals',
                'title'       => 'Woven Espadrille Wedge Sandals',
                'description' => '<p>Summer-ready style with these woven espadrille wedge sandals. The natural jute rope midsole and adjustable ankle strap ensure a perfect fit.</p><p><strong>Key Features:</strong></p><ul><li>Woven cotton upper</li><li>Jute rope midsole</li><li>Adjustable ankle strap with buckle</li><li>Padded footbed</li><li>Rubber outsole</li></ul>',
                'price'       => 2499.00,
                'main_image'  => 'https://images.unsplash.com/photo-1603487742131-4e4b5b1f2b3a?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1603487742131-4e4b5b1f2b3a?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 11,
                'category_id' => 3,
            ],
            [
                'name'        => 'Leather Oxfords',
                'title'       => 'Cap-Toe Leather Oxford Dress Shoes',
                'description' => '<p>Exude refinement with these cap-toe Oxford dress shoes. Crafted from polished leather with classic brogue detailing and a durable leather sole.</p><p><strong>Key Features:</strong></p><ul><li>Polished calf leather</li><li>Cap-toe with brogue perforations</li><li>Leather lining and sole</li><li>Lace-up closure</li><li>Goodyear welt construction</li></ul>',
                'price'       => 6499.00,
                'main_image'  => 'https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 1,
                'category_id' => 3,
            ],
            [
                'name'        => 'Slide Sandals',
                'title'       => 'Sporty Cushioned Slide Sandals',
                'description' => '<p>Ultimate comfort for casual days — these sporty slide sandals feature a thick cushioned footbed and durable rubber outsole for easy wear.</p><p><strong>Key Features:</strong></p><ul><li>Synthetic strap upper</li><li>Textured footbed</li><li>Thick EVA cushion midsole</li><li>Rubber outsole</li><li>Water-friendly</li></ul>',
                'price'       => 999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1608236415058-3daadc634dfd?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1608236415058-3daadc634dfd?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 11,
                'category_id' => 3,
            ],
            [
                'name'        => 'Heeled Mules',
                'title'       => 'Block Heel Mules with Pointed Toe',
                'description' => '<p>Chic and effortless — these block heel mules feature a sleek pointed toe and easy slip-on design. Perfect for elevated everyday style.</p><p><strong>Key Features:</strong></p><ul><li>Faux leather upper</li><li>Pointed toe</li><li>Slip-on mule design</li><li>Block heel (2.5")</li><li>Cushioned insole</li></ul>',
                'price'       => 2999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1543168256-418811576931?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1543168256-418811576931?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 1,
                'category_id' => 3,
            ],
            [
                'name'        => 'Hiking Boots',
                'title'       => 'Waterproof Leather Hiking Boots',
                'description' => '<p>Tackle any trail with these rugged waterproof hiking boots. Features a Gore-Tex lining, aggressive tread pattern, and ankle support.</p><p><strong>Key Features:</strong></p><ul><li>Full-grain leather upper</li><li>Gore-Tex waterproof membrane</li><li>Vibram rubber outsole</li><li>Padded ankle collar</li><li>Speed lace hooks</li></ul>',
                'price'       => 7499.00,
                'main_image'  => 'https://images.unsplash.com/photo-1520216188844-3e2f7af8b7c5?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1520216188844-3e2f7af8b7c5?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 11,
                'category_id' => 3,
            ],
            [
                'name'        => 'Ballet Flats',
                'title'       => 'Quilted Leather Ballet Flats',
                'description' => '<p>Classic ballet flats with a touch of luxury. The quilted leather upper and bow detail add feminine charm to these comfortable everyday flats.</p><p><strong>Key Features:</strong></p><ul><li>Quilted leather upper</li><li>Bow detail at vamp</li><li>Flexible rubber sole</li><li>Memory foam footbed</li><li>Foldable — travel-friendly</li></ul>',
                'price'       => 1999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1566150905458-1bf1fc113f0d?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1566150905458-1bf1fc113f0d?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 1,
                'category_id' => 3,
            ],

            // ─── Accessories (category_id: 4) ───────────────────────────
            [
                'name'        => 'Minimalist Watch',
                'title'       => 'Slim Minimalist Quartz Watch',
                'description' => '<p>Understated elegance — this slim minimalist watch features a clean dial, slim leather strap, and precise quartz movement. Suitable for any occasion.</p><p><strong>Key Features:</strong></p><ul><li>Stainless steel case (38mm)</li><li>Genuine leather strap</li><li>Japanese quartz movement</li><li>Mineral crystal glass</li><li>Water resistant (30m)</li></ul>',
                'price'       => 4499.00,
                'main_image'  => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 10,
                'category_id' => 4,
            ],
            [
                'name'        => 'Leather Belt',
                'title'       => 'Full-Grain Leather Reversible Belt',
                'description' => '<p>Double the versatility with this full-grain leather reversible belt. Black on one side and brown on the other — two belts in one.</p><p><strong>Key Features:</strong></p><ul><li>Full-grain leather</li><li>Reversible (black/brown)</li><li>Brushed nickel buckle</li><li>1.25" width</li><li>Hand-stitched edges</li></ul>',
                'price'       => 2499.00,
                'main_image'  => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 5,
                'category_id' => 4,
            ],
            [
                'name'        => 'Aviator Sunglasses',
                'title'       => 'Classic Aviator Sunglasses with Gold Frame',
                'description' => '<p>Timeless aviator sunglasses with a gold-tone metal frame and UV400 protective lenses. Includes a branded hard case and microfiber cleaning cloth.</p><p><strong>Key Features:</strong></p><ul><li>Gold-tone metal frame</li><li>UV400 protective lenses</li><li>Green tinted glass lenses</li><li>Adjustable nose pads</li><li>Includes hard case</li></ul>',
                'price'       => 3299.00,
                'main_image'  => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 10,
                'category_id' => 4,
            ],
            [
                'name'        => 'Leather Backpack',
                'title'       => 'Vintage Distressed Leather Backpack',
                'description' => '<p>Adventure awaits with this vintage distressed leather backpack. Features a waxed canvas lining, multiple compartments, and brass hardware.</p><p><strong>Key Features:</strong></p><ul><li>Distressed full-grain leather</li><li>Waxed canvas interior lining</li><li>Padded laptop compartment (15")</li><li>Brass zippers and hardware</li><li>Adjustable leather shoulder straps</li></ul>',
                'price'       => 6499.00,
                'main_image'  => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 5,
                'category_id' => 4,
            ],
            [
                'name'        => 'Gold Hoop Earrings',
                'title'       => '14K Gold Plated Large Hoop Earrings',
                'description' => '<p>Make a statement with these bold large hoop earrings. Crafted with 14K gold plating over a hypoallergenic base for lasting shine.</p><p><strong>Key Features:</strong></p><ul><li>14K gold plated</li><li>Hypoallergenic — nickel-free</li><li>Large hoop design (2" diameter)</li><li>Hinge closure with lever back</li><li>Lightweight for all-day wear</li></ul>',
                'price'       => 1999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1635767798638-3e25273a8236?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1635767798638-3e25273a8236?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 10,
                'category_id' => 4,
            ],
            [
                'name'        => 'Silk Scarf',
                'title'       => 'Hand-Rolled Pure Silk Scarf',
                'description' => '<p>Add a pop of color with this hand-rolled pure silk scarf. Features an artistic print with hand-rolled edges for a refined finish.</p><p><strong>Key Features:</strong></p><ul><li>100% pure silk</li><li>Hand-rolled edges</li><li>Artistic print design</li><li>Generous 35"x35" size</li><li>Dry clean recommended</li></ul>',
                'price'       => 2999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1601924994987-69e26d50dc26?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1601924994987-69e26d50dc26?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 5,
                'category_id' => 4,
            ],
            [
                'name'        => 'Leather Wallet',
                'title'       => 'RFID-Blocking Bifold Leather Wallet',
                'description' => '<p>Protect your cards and cash in style with this RFID-blocking bifold wallet. Crafted from full-grain leather with multiple card slots.</p><p><strong>Key Features:</strong></p><ul><li>Full-grain leather</li><li>RFID blocking technology</li><li>6 card slots</li><li>ID window</li><li>Currency compartment</li></ul>',
                'price'       => 2299.00,
                'main_image'  => 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1627123424574-724758594e93?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 10,
                'category_id' => 4,
            ],
            [
                'name'        => 'Beaded Bracelet',
                'title'       => 'Natural Stone Beaded Stretch Bracelet',
                'description' => '<p>Embrace natural elegance with this handcrafted beaded bracelet. Features a mix of natural stones including tiger eye, howlite, and jasper.</p><p><strong>Key Features:</strong></p><ul><li>Natural stone beads</li><li>Stretch cord for easy wear</li><li>Adjustable to fit most wrists</li><li>Handcrafted</li><li>Comes in a gift pouch</li></ul>',
                'price'       => 899.00,
                'main_image'  => 'https://images.unsplash.com/photo-1611591437281-460bfbe1220a?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1611591437281-460bfbe1220a?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 5,
                'category_id' => 4,
            ],
            [
                'name'        => 'Leather Gloves',
                'title'       => 'Cashmere-Lined Leather Driving Gloves',
                'description' => '<p>Luxurious warmth meets classic style — these leather driving gloves feature a soft cashmere lining and perforated detailing for breathability.</p><p><strong>Key Features:</strong></p><ul><li>Soft lambskin leather</li><li>Cashmere lining</li><li>Perforated back for breathability</li><li>Snap closure at wrist</li><li>Touchscreen compatible fingertips</li></ul>',
                'price'       => 3999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1609191913078-6100545f2a58?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1609191913078-6100545f2a58?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 10,
                'category_id' => 4,
            ],
            [
                'name'        => 'Silver Chain Necklace',
                'title'       => 'Sterling Silver Figaro Chain Necklace',
                'description' => '<p>Timeless and versatile — this sterling silver Figaro chain necklace features alternating polished links and a secure lobster clasp.</p><p><strong>Key Features:</strong></p><ul><li>925 sterling silver</li><li>Figaro link pattern</li><li>Polished finish</li><li>Lobster clasp closure</li><li>Available in 18", 20", 22" lengths</li></ul>',
                'price'       => 3499.00,
                'main_image'  => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 5,
                'category_id' => 4,
            ],

            // ─── Health & Beauty (category_id: 5) ──────────────────────
            [
                'name'        => 'Rose Perfume',
                'title'       => 'Eau de Parfum — Amber Rose',
                'description' => '<p>A captivating fragrance that blends Bulgarian rose with warm amber and musk. Long-lasting with a sophisticated, romantic scent profile.</p><p><strong>Key Features:</strong></p><ul><li>Eau de Parfum concentration</li><li>Top notes: Bergamot, Pink Pepper</li><li>Heart notes: Bulgarian Rose, Jasmine</li><li>Base notes: Amber, Musk, Sandalwood</li><li>50ml bottle with spray nozzle</li></ul>',
                'price'       => 3999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1585386959984-a4155224a1ad?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1585386959984-a4155224a1ad?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 6,
                'category_id' => 5,
            ],
            [
                'name'        => 'Vitamin C Serum',
                'title'       => 'Brightening Vitamin C Face Serum',
                'description' => '<p>Reveal radiant skin with our concentrated Vitamin C serum. Formulated with 20% Vitamin C, hyaluronic acid, and Vitamin E for brightening and hydration.</p><p><strong>Key Features:</strong></p><ul><li>20% stable Vitamin C (L-Ascorbic Acid)</li><li>Hyaluronic acid for hydration</li><li>Vitamin E for antioxidant protection</li><li>Reduces dark spots and hyperpigmentation</li><li>For all skin types</li></ul>',
                'price'       => 1899.00,
                'main_image'  => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 13,
                'category_id' => 5,
            ],
            [
                'name'        => 'Lipstick Set',
                'title'       => 'Matte Lipstick Collection — Set of 6',
                'description' => '<p>Build your perfect lip wardrobe with this set of 6 richly pigmented matte lipsticks. Includes everyday nudes, bold reds, and trendy pinks.</p><p><strong>Key Features:</strong></p><ul><li>Set of 6 full-size lipsticks</li><li>Velvet matte finish</li><li>Highly pigmented — one-stroke color</li><li>Enriched with shea butter</li><li>Long-wearing (up to 8 hours)</li></ul>',
                'price'       => 2499.00,
                'main_image'  => 'https://images.unsplash.com/photo-1586495777744-4413f21062fa?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1586495777744-4413f21062fa?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 6,
                'category_id' => 5,
            ],
            [
                'name'        => 'Hair Oil',
                'title'       => 'Argan & Coconut Hair Repair Oil',
                'description' => '<p>Nourish and repair your hair with this blend of organic argan oil and virgin coconut oil. Restores shine, reduces frizz, and strengthens from root to tip.</p><p><strong>Key Features:</strong></p><ul><li>Organic argan oil (rich in Vitamin E)</li><li>Virgin coconut oil</li><li>Sulfate and paraben-free</li><li>Suitable for all hair types</li><li>100ml bottle with dropper</li></ul>',
                'price'       => 1299.00,
                'main_image'  => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 13,
                'category_id' => 5,
            ],
            [
                'name'        => 'Face Moisturizer',
                'title'       => 'Hydrating Hyaluronic Acid Face Cream',
                'description' => '<p>Intense hydration meets lightweight texture — this hyaluronic acid face cream delivers 72-hour moisture without feeling greasy. Dermatologist-tested.</p><p><strong>Key Features:</strong></p><ul><li>Triple hyaluronic acid complex</li><li>Ceramides for barrier repair</li><li>Oil-free, non-comedogenic</li><li>Fragrance-free</li><li>50ml jar</li></ul>',
                'price'       => 2199.00,
                'main_image'  => 'https://images.unsplash.com/photo-1570194065650-d99fb4ee8e39?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1570194065650-d99fb4ee8e39?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 6,
                'category_id' => 5,
            ],
            [
                'name'        => 'Natural Soap Set',
                'title'       => 'Handmade Organic Soap Gift Box — 4 Pack',
                'description' => '<p>Pamper yourself with this gift box of 4 handmade organic soaps. Each bar is crafted with natural ingredients and essential oils for a luxurious cleanse.</p><p><strong>Key Features:</strong></p><ul><li>100% natural ingredients</li><li>Essential oil fragrances (Lavender, Tea Tree, Rose, Citrus)</li><li>Shea butter and oatmeal base</li><li>No artificial colors or preservatives</li><li>Vegan and cruelty-free</li></ul>',
                'price'       => 1499.00,
                'main_image'  => 'https://images.unsplash.com/photo-1600850058222-3e1d14eb2b5a?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1600850058222-3e1d14eb2b5a?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 13,
                'category_id' => 5,
            ],
            [
                'name'        => 'Sunscreen SPF 50',
                'title'       => 'Mineral Sunscreen SPF 50 — Zinc Oxide',
                'description' => '<p>Protect your skin with this lightweight mineral sunscreen. Zinc oxide provides broad-spectrum SPF 50 protection without a white cast.</p><p><strong>Key Features:</strong></p><ul><li>Non-nano zinc oxide</li><li>Broad-spectrum SPF 50</li><li>Water resistant (80 minutes)</li><li>No white cast — sheer finish</li><li>Reef-safe</li></ul>',
                'price'       => 1799.00,
                'main_image'  => 'https://images.unsplash.com/photo-1611930022073-b7a4ba5fcccd?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1611930022073-b7a4ba5fcccd?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 6,
                'category_id' => 5,
            ],
            [
                'name'        => 'Eye Shadow Palette',
                'title'       => 'Neutral Matte Eyeshadow Palette — 12 Shades',
                'description' => '<p>Create endless eye looks with this 12-shade neutral matte eyeshadow palette. Silky, blendable pigments from warm nudes to rich earth tones.</p><p><strong>Key Features:</strong></p><ul><li>12 highly pigmented matte shades</li><li>Buttery, blendable formula</li><li>Mix of warm and cool neutrals</li><li>Mirror included in palette</li><li>Vegan and cruelty-free</li></ul>',
                'price'       => 2799.00,
                'main_image'  => 'https://images.unsplash.com/photo-1583241800698-e8ab01830a07?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1583241800698-e8ab01830a07?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 13,
                'category_id' => 5,
            ],
            [
                'name'        => 'Body Lotion',
                'title'       => 'Shea Butter & Cocoa Body Lotion',
                'description' => '<p>Deeply nourish your skin with this rich body lotion enriched with shea butter and cocoa extract. Absorbs quickly leaving skin soft and supple.</p><p><strong>Key Features:</strong></p><ul><li>Shea butter and cocoa extract</li><li>Vitamin E and B5</li><li>Non-greasy formula</li><li>Warm vanilla scent</li><li>400ml pump bottle</li></ul>',
                'price'       => 999.00,
                'main_image'  => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 6,
                'category_id' => 5,
            ],
            [
                'name'        => 'Facial Cleanser',
                'title'       => 'Gentle Foaming Facial Cleanser with Green Tea',
                'description' => '<p>Start your skincare routine right with this gentle foaming cleanser. Green tea extract and aloe vera soothe and refresh while removing impurities.</p><p><strong>Key Features:</strong></p><ul><li>Green tea extract (antioxidant-rich)</li><li>Aloe vera for soothing</li><li>Gentle foaming action</li><li>pH balanced (5.5)</li><li>Suitable for sensitive skin</li></ul>',
                'price'       => 899.00,
                'main_image'  => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=600&q=80&auto=format',
                'images'      => json_encode([
                    'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=600&q=80&auto=format',
                ]),
                'seller_id'   => 13,
                'category_id' => 5,
            ],
        ];

        // Give roughly half the seeded products a sale (discounted) price so the
        // sale display can be previewed. A rotating set of multipliers keeps the
        // discount varied (10%–30% off). Products with an explicit
        // discounted_price key are left untouched.
        $discountMultipliers = [0.85, 0.75, 0.8, 0.9, 0.7];

        foreach ($products as $index => $product) {
            if (! isset($product['discounted_price']) && ($index % 2) === 1) {
                $multiplier = $discountMultipliers[$index % count($discountMultipliers)];
                $product['discounted_price'] = round($product['price'] * $multiplier, 2);
            }

            // Normalize the gallery to a plain array — the model casts 'images'
            // to array, so passing a pre-encoded JSON string would double-encode
            // it and make count($product->images) fail on the frontend.
            $images = is_array($product['images'] ?? null)
                ? $product['images']
                : (json_decode($product['images'] ?? '[]', true) ?: []);

            // Every seeded product must expose at least two gallery images.
            while (count($images) < 2) {
                $images[] = $product['main_image'];
            }

            $product['images'] = $images;

            // Stagger created_at so only some products appear "new" (within the
            // last 7 days) — otherwise every freshly seeded product shows the
            // New badge.
            $createdDaysAgo = [0, 3, 10, 1, 20, 5, 30, 2];
            $product['created_at'] = now()->subDays($createdDaysAgo[$index % count($createdDaysAgo)]);
            $product['updated_at'] = $product['created_at'];

            Product::create($product);
        }
    }
}
