<?php

namespace App;

use App\Traits\Slugger;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    use Slugger;

    public function dishes() {
        return $this->hasMany('App\Dish');
    }

    public function categories() {
        return $this->belongsToMany('App\Category');
    }




    protected $fillable = [
        'name',
        'email',
        'password',
        'p_iva',
        'address',
        'slug',
        'restaurant_name',
        'image',
        'phone',
        'delivery_cost',
        'opening_hours',
        'closing_hours',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
