<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('name', 'phone', 'email', 'text', 'facebook_url', 'twitter_url', 'instagram_url', 'commission');

}