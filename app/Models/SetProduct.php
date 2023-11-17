<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SetProduct extends Model
{
    use HasFactory;
    protected $table = "set_product";

    protected $guarded = [];

    const CREATED_AT ='created_at';
    const UPDATED_AT ='updated_at';

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function getProductsWithSetProduct()
    {
        return self::join('product', 'set_product.set_product_id', '=', 'product.id')
            ->select('set_product.*', 'product.name')
            ->get();
    }

}
