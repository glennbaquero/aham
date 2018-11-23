<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function requests() {
        return $this->hasMany(RepairServiceRequest::class);
    }

    public function userproducts() {
        return $this->hasMany(UserProduct::class)->with('product');
    }

    public function userdetail() {
        return $this->hasOne(UserDetail::class);
    }

     public function product() {
        return $this->hasMany(Product::class);
    }
}
