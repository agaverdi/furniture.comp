<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permissions extends Model
{
    use HasFactory;

    protected $table = "permissions";
    const CREATED_AT ='created_at';
    public $timestamps = false;
    protected $guarded = [];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
