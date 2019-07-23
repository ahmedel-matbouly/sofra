<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'price', 'time', 'img', 'resturant_id', 'disable');

    public function orders()
    {
        return $this->belongsToMany('App\Model\Order');
    }

    public function resturants()
    {
        return $this->belongsTo('App\Model\Resturant');
    }

}