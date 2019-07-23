<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'body', 'notificationable_type', 'notificationable_id', 'order_id');

    public function notificationable()
    {
        return $this->morphTo();
    }


    public function order()
    {
        return $this->belongsTo('App\Model\Order');
    }

}