<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shipping extends Model
{
    use HasFactory;


    protected $table = "shipping";

    protected $guarded = [];
    const CREATED_AT ='created_at';
    const UPDATED_AT ='updated_at';

    public function products(): HasMany
    {
        return  $this->hasMany(Checkout::class)->with('shipping');
    }
    public function sub_shippings() : HasMany
    {
        return $this->hasMany(Shipping::class, 'parent_shipping_id');
    }

    public  function shipping() : BelongsTo
    {
        return $this->belongsTo(Shipping::class, 'parent_shipping_id');
    }
    public static function getShippingsWithSubshippings()
    {
        return Shipping::join('shipping AS s', 'shipping.id', '=', 's.parent_shipping_id')
            ->select(
                'shipping.*',
                's.shipping_name AS sub_shipping_name',
                's.slug AS sub_slug',
                's.postal_code AS sub_postal_code',
                's.shipping_price AS sub_shipping_price',
                's.is_work AS sub_is_work'
            )->get();
    }

    public function checkout():BelongsTo
    {
        return $this->belongsTo(Checkout::class);
    }
}
