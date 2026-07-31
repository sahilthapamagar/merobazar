<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $password
 * @property string|null $shop_name
 * @property string|null $registration_number
 * @property string|null $khalti_secrect_key
 * @property string $status
 * @property string|null $expired_date
 * @property string|null $contact
 * @property string|null $citizenship_photo
 * @property string|null $image
 * @property string|null $rejected_reason
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cart> $carts
 * @property-read int|null $carts_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\SellerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereCitizenshipPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereExpiredDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereKhaltiSecrectKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereRegistrationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereRejectedReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereUpdatedAt($value)
 * @mixin \Eloquent
 */
#[Fillable(['name', 'email', 'password', 'shop_name', 'contact', 'khalti_secrect_key', 'status', 'expired_date', 'registration_number', 'citizenship_photo', 'image', 'rejected_reason'])]
#[Hidden(['password', 'remember_token'])]
class Seller extends Authenticatable
{
    // /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
