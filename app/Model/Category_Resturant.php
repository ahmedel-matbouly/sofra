<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category_Resturant extends Model 
{

    protected $table = 'category_resturant';
    public $timestamps = true;
    protected $fillable = array('category_id', 'resturant_id');

}