<?php

namespace App;

use App\Traits\Slugger;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use Slugger;

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function orders() {
        return $this->belongsToMany('App\Order');
    }
}
