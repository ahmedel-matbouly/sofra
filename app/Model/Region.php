<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Region extends Model 
{

    protected $table = 'regions';
    public $timestamps = true;
    protected $fillable = array('name','city_id');

    public function city()
    {
        return $this->belongsTo('App\Model\City');
    }

}