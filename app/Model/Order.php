<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('add_notes', 'total', 'delivery_fee', 'state', 'client_id', 'resturant_id', 'commission', 'payment_id', 'net', 'address', 'cost');

    public function products()
    {
        return $this->belongsToMany('App\Model\Product')->withPivot('price','quantity','special_order');;
    }

    public function notifications()
    {
        return $this->hasMany('App\Model\Notification');
    }

    public function payment()
    {
        return $this->belongsTo('App\Model\Payment','payment_id');
    }

    public function resturant()
    {
        return $this->belongsTo('App\Model\Resturant','resturant_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Model\Client','client_id');
    }

}