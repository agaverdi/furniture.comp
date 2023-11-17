<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use mysql_xdevapi\Table;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table='users';

    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'is_admin',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_details() :HasOne
    {
        return $this->hasOne(UserDetails::class);
    }
    public function user_wish_list():HasOne
    {
        return $this->hasOne(WishList::class);
    }

    public function permissions():HasOne
    {
        return $this->hasOne(Permissions::class);
    }
}
