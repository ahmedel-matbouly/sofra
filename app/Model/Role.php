<?php namespace App\Model;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = array('name', 'display_name', 'description');

    public function permissions()
    {
        return $this->belongsToMany('App\Model\Permission');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }


}