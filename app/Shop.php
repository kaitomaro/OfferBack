<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\VerifyEmail;
use App\Notifications\StorePasswordResetNotification;

// class Shop extends Authenticatable implements MustVerifyEmail
class Shop extends Authenticatable 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'phone', 'sentence', 'address',
        'first_start_time', 'first_end_time',
        'second_start_time', 'second_end_time', 
        'zip_code','sns','hp','payment_options', 'number_of_seats',
        'is_vip','category_1','category_2',
        'lunch_estimated_amount', 'dinner_estimated_amount',
        'holiday', 'twitter', 'facebook', 'instagram'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new StorePasswordResetNotification($token));
    }

    public function services() {
        return $this->hasMany('App\Service');
    }

    public function coupons()
    {
        return $this->hasMany('App\Coupon');
    }
    public function times()
    {
        return $this->hasMany('App\Time');
    }

    public function imgs()
    {
        return $this->hasMany('App\Img');
    }
    
    public function earnings()
    {
        return $this->hasMany('App\Earnig');
    }
    
}
