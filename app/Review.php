<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $fillable = [
        'rate', 'sentence', 'shop_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function shop()
    {
        return $this->belongsTo('App\Shop', 'shop_id', 'id');
    }
}
