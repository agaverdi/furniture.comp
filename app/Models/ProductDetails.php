<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductDetails extends Model
{
    use HasFactory;
    protected $table = "product_details";

    protected $guarded = [];

    public $timestamps = false;



    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


}
