<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name', 'shop_id', 'menu_type', 'price'
    ];
    
    public function shop()
    {
        return $this->belongsTo('App\Shop', 'shop_id', 'id');
    }
}