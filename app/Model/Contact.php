<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model 
{

    protected $table = 'contacts';
    public $timestamps = true;
    protected $fillable = array('text', 'name', 'email', 'phone', 'content', 'type', 'contactable_type', 'contactable_id');

    public function contactable()
    {
        return $this->morphTo();
    }

   

}