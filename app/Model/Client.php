<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'phone', 'city_id', 'password', 'email', 'activated', 'api_token', 'address', 'img');

    public function cities()
    {
        return $this->belongsTo('App\Model\City');
    }

    public function orders()
    {
        return $this->hasMany('App\Model\Order');
    }

    public function comments()
    {
        return $this->hasMany('App\Model\Comment');
    }

    public function notifications()
    {
        return $this->morphMany('App\Model\Notification', 'notificationable');
    }

    public function tokens()
    {
        return $this->morphMany('App\Model\Token', 'tokenable');
    }

    public function contacts()
    {
        return $this->morphMany('App\Model\Contact', 'contactable');
    }

}