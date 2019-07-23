<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order_Product extends Model 
{

    protected $table = 'order_product';
    public $timestamps = true;
    protected $fillable = array('product_id', 'order_id', 'price', 'quantity', 'special_order');

}