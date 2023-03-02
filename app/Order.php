<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;

    public function dishes() {
        return $this->belongsToMany('App\Dish');
    }
}
