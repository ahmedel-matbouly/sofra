<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Resturant extends Model 
{

    protected $table = 'resturants';
    public $timestamps = true;
    protected $fillable = array('name', 'city_id', 'email', 'password', 'category_id', 'minimal_demand', 'delivery_fee', 'phone', 'whatsapp_url', 'pin_code', 'img', 'activated', 'api_token', 'availability');

    public function categories()
    {
        return $this->belongsToMany('App\Model\Category');
    }

    public function cities()
    {
        return $this->belongsTo('App\Model\City','city_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Model\Comment');
    }

    public function offers()
    {
        return $this->hasMany('App\Model\Offer');
    }

    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }

    public function orders()
    {
        return $this->hasMany('App\Model\Order');
    }

    public function contacts()
    {
        return $this->morphMany('App\Model\Contact', 'contactable');
    }

    public function notifications()
    {
        return $this->morphMany('App\Model\Notification', 'notificationable');
    }

    public function tokens()
    {
        return $this->morphMany('App\Model\Token', 'tokenable');
    }

}