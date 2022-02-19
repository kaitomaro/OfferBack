<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $fillable = [
        'shop_id', 'start_time', 'end_time', 'monday', 'tsuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'time_type'
    ];

    public function shop()
    {
        return $this->belongsTo('App\Shop', 'shop_id', 'id');
    }
    
    public function coupons()
    {
        return $this->hasMany('App\Coupon');
    }
}
