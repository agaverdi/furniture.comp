<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetails extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table='user_details';
    const CREATED_AT ='created_at';
    const UPDATED_AT ='updated_at';



    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class);
    }
}
