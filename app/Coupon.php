<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

    protected $fillable = [
        'shop_id', 
        'service_id',
        'time_id',
        'discount',
        'display',
        'time_type',
        'discount_type',
        'telephone_reservation',
        'first_time_discount'
    ];

    public function service()
    {
        return $this->belongsTo('App\Service', 'service_id', 'id');
    }

    public function shop()
    {
        return $this->belongsTo('App\Shop', 'shop_id', 'id');
    }

    public function time()
    {
        return $this->belongsTo('App\Time', 'time_type', 'time_type');
    }
    
    public function earnings()
    {
        return $this->hasMany('App\Earnig');
    }
    
}
