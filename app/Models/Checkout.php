<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Checkout extends Model
{
    use HasFactory;

    protected $table = "checkout";

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
    ];
    public $timestamps = false;

    public function subShipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class, 'sub_shipping_id');
    }
}
