<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model 
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('img', 'name', 'text', 'resturant_id', 'end_at', 'start_at', 'price');

    public function resturant()
    {
        return $this->belongsTo('App\Model\Resturant','resturant_id');
    }

}