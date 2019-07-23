<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model 
{

    protected $table = 'comments';
    public $timestamps = true;
    protected $fillable = array('text', 'clients_id', 'resturant_id', 'rating');

    public function resturants()
    {
        return $this->belongsTo('App\Model\Resturant');
    }

    public function clients()
    {
        return $this->belongsTo('App\Model\Client');
    }

}