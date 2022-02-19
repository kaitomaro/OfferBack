<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'shop_id', 'service_type', 'price', 'image_path', 'bill_type'
    ];

    public function coupons()
    {
        return $this->hasMany('App\Coupon');
    }
    public function shop()
    {
        return $this->belongsTo('App\Shop', 'shop_id', 'id');
    }
}
