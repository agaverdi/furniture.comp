<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = "contact";

    const CREATED_AT ='created_at';
    public $timestamps = false;
    protected $guarded = [];
}
