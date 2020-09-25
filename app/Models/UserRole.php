<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserRole extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s.u';
    protected $table = 'role_user';
    protected $fillable = ['user_id', 'role_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function User()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}