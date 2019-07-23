<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name');

    public function regions()
    {
        return $this->hasMany('App\Model\Region');
    }

    public function clients()
    {
        return $this->hasMany('App\Model\Client');
    }

    public function resturants()
    {
        return $this->hasMany('App\Model\Resturant');
    }

}