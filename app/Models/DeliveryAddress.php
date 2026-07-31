<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $address_detail
 * @property string $contact
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAddress whereAddressDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAddress whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryAddress whereUserId($value)
 * @mixin \Eloquent
 */
class DeliveryAddress extends Model
{
    protected $fillable = [
        'user_id',
        'address_detail',
        'contact',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
