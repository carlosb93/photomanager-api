<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';
    // protected $hidden = ['created_at','updated_at'];

    public function businesses()
    {
        return $this->belongsTo('App\Models\Branch');
    }


    public function users_branch()
    {
        return $this->belongsToMany('App\User');
    }
}
