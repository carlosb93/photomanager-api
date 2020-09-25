<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'businesses';
    

    public function branches()
        {
            return $this->hasMany('App\Models\Branch');
        }
}