<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<Seller>
 */
class SellerFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    protected static int $index = 0;

    protected static array $sellers = [
        [
            'name' => 'Rajesh Hamal',
            'email' => 'rajesh.hamal@example.com',
            'shop_name' => 'Hamal Electronics',
            'contact' => '9841234567',
            'registration_number' => 'REG-2024-001',
            'status' => 'active',
            'expired_date' => '2027-12-31',
        ],
        [
            'name' => 'Sita Sharma',
            'email' => 'sita.sharma@example.com',
            'shop_name' => 'Sharma Fashion House',
            'contact' => '9851234567',
            'registration_number' => 'REG-2024-002',
            'status' => 'active',
            'expired_date' => '2026-06-30',
        ],
        [
            'name' => 'Krishna Thapa',
            'email' => 'krishna.thapa@example.com',
            'shop_name' => 'Thapa Handicrafts',
            'contact' => '9861234567',
            'registration_number' => 'REG-2024-003',
            'status' => 'active',
            'expired_date' => '2026-09-15',
        ],
        [
            'name' => 'Anita Gurung',
            'email' => 'anita.gurung@example.com',
            'shop_name' => 'Gurung Boutique',
            'contact' => '9871234567',
            'registration_number' => 'REG-2025-001',
            'status' => 'pending',
            'expired_date' => null,
        ],
        [
            'name' => 'Binod Chaudhary',
            'email' => 'binod.chaudhary@example.com',
            'shop_name' => 'Chaudhary General Store',
            'contact' => '9881234567',
            'registration_number' => 'REG-2024-004',
            'status' => 'active',
            'expired_date' => '2026-03-20',
        ],
        [
            'name' => 'Deepa Karki',
            'email' => 'deepa.karki@example.com',
            'shop_name' => 'Karki Beauty & Cosmetics',
            'contact' => '9891234567',
            'registration_number' => 'REG-2025-002',
            'status' => 'rejected',
            'expired_date' => null,
            'rejected_reason' => 'Required documents are incomplete. Please submit valid citizenship and PAN registration.',
        ],
        [
            'name' => 'Mohan Poudel',
            'email' => 'mohan.poudel@example.com',
            'shop_name' => 'Poudel Book Center',
            'contact' => '9811234567',
            'registration_number' => 'REG-2023-001',
            'status' => 'active',
            'expired_date' => '2025-12-31',
        ],
        [
            'name' => 'Radha Adhikari',
            'email' => 'radha.adhikari@example.com',
            'shop_name' => 'Adhikari Organic Farm',
            'contact' => '9821234567',
            'registration_number' => 'REG-2025-003',
            'status' => 'pending',
            'expired_date' => null,
        ],
        [
            'name' => 'Sanjay Basnet',
            'email' => 'sanjay.basnet@example.com',
            'shop_name' => 'Basnet Mobile Zone',
            'contact' => '9831234567',
            'registration_number' => 'REG-2024-005',
            'status' => 'inactive',
            'expired_date' => '2025-01-15',
        ],
        [
            'name' => 'Pooja Rai',
            'email' => 'pooja.rai@example.com',
            'shop_name' => 'Rai Jewelry Collection',
            'contact' => '9841234568',
            'registration_number' => 'REG-2025-004',
            'status' => 'active',
            'expired_date' => '2027-03-01',
        ],
        [
            'name' => 'Sagar Shrestha',
            'email' => 'sagar.shrestha@example.com',
            'shop_name' => 'Shrestha Sports Hub',
            'contact' => '9851234568',
            'registration_number' => 'REG-2024-006',
            'status' => 'active',
            'expired_date' => '2026-11-30',
        ],
        [
            'name' => 'Maya Tamang',
            'email' => 'maya.tamang@example.com',
            'shop_name' => 'Tamang Handloom',
            'contact' => '9861234568',
            'registration_number' => 'REG-2025-005',
            'status' => 'pending',
            'expired_date' => null,
        ],
        [
            'name' => 'Hari Nepal',
            'email' => 'hari.nepal@example.com',
            'shop_name' => 'Nepal Grocery & Supplies',
            'contact' => '9871234568',
            'registration_number' => 'REG-2023-002',
            'status' => 'active',
            'expired_date' => '2026-04-01',
        ],
        [
            'name' => 'Sunita Maharjan',
            'email' => 'sunita.maharjan@example.com',
            'shop_name' => 'Maharjan Pottery Works',
            'contact' => '9881234568',
            'registration_number' => 'REG-2025-006',
            'status' => 'rejected',
            'expired_date' => null,
            'rejected_reason' => 'Shop name does not match registered business name. Please update and resubmit.',
        ],
        [
            'name' => 'Arun Bhandari',
            'email' => 'arun.bhandari@example.com',
            'shop_name' => 'Bhandari Hardware',
            'contact' => '9891234568',
            'registration_number' => 'REG-2024-007',
            'status' => 'active',
            'expired_date' => '2026-08-15',
        ],
        [
            'name' => 'Priya Khadka',
            'email' => 'priya.khadka@example.com',
            'shop_name' => 'Khadka Clothing Store',
            'contact' => '9811234568',
            'registration_number' => 'REG-2025-007',
            'status' => 'active',
            'expired_date' => '2027-01-01',
        ],
        [
            'name' => 'Gopal Subedi',
            'email' => 'gopal.subedi@example.com',
            'shop_name' => 'Subedi Agro Products',
            'contact' => '9821234568',
            'registration_number' => 'REG-2024-008',
            'status' => 'inactive',
            'expired_date' => '2024-12-01',
        ],
        [
            'name' => 'Rita Singh',
            'email' => 'rita.singh@example.com',
            'shop_name' => 'Singh Tailoring Center',
            'contact' => '9831234568',
            'registration_number' => 'REG-2025-008',
            'status' => 'pending',
            'expired_date' => null,
        ],
        [
            'name' => 'Dipak Bhattarai',
            'email' => 'dipak.bhattarai@example.com',
            'shop_name' => 'Bhattarai Photo Studio',
            'contact' => '9841234569',
            'registration_number' => 'REG-2024-009',
            'status' => 'active',
            'expired_date' => '2026-10-10',
        ],
        [
            'name' => 'Kabita Pandey',
            'email' => 'kabita.pandey@example.com',
            'shop_name' => 'Pandey Spice Corner',
            'contact' => '9851234569',
            'registration_number' => 'REG-2025-009',
            'status' => 'pending',
            'expired_date' => null,
        ],
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $seller = static::$sellers[static::$index % count(static::$sellers)];
        static::$index++;

        return [
            'name' => $seller['name'],
            'email' => $seller['email'],
            'password' => static::$password ??= Hash::make('password'),
            'shop_name' => $seller['shop_name'],
            'contact' => $seller['contact'],
            'registration_number' => $seller['registration_number'],
            'khalti_secrect_key' => 'khalti_' . Str::random(24),
            'status' => $seller['status'],
            'expired_date' => $seller['expired_date'],
            'citizenship_photo' => 'seed/citizenship/' . Str::slug($seller['name']) . '.jpg',
            'image' => 'seed/registration/' . Str::slug($seller['name']) . '.jpg',
            'rejected_reason' => $seller['rejected_reason'] ?? null,
            'remember_token' => Str::random(10),
        ];
    }
}
