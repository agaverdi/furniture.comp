<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WishList extends Model
{
    use HasFactory;

    protected $table='wish_list';

    protected $guarded = [];

    public function wish_user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function wish_product():BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    const CREATED_AT ='created_at';
    const UPDATED_AT ='updated_at';
}
