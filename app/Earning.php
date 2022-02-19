<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{

    protected $fillable = [
        'name',
        'service_id',
        'price',
        'discount',
        'discount_type',
        'service_type',
        'user_id',
        'shop_id',
        'bill_type',
        'coupon_id', 
        'time_type', 
        'people'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function shop()
    {
        return $this->belongsTo('App\Shop', 'shop_id', 'id');
    }

    public function services()
    {
        return $this->belongsTo('App\Service', 'service_id', 'id');
    }

    public function coupon()
    {
        return $this->belongsTo('App\Coupon', 'coupon_id', 'id');
    }

}
