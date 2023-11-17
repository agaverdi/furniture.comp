<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    use HasFactory;

    protected $table = "product_comment";


    protected $guarded = [];

    const CREATED_AT ='created_at';
    const UPDATED_AT ='updated_at';

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
