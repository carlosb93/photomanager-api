<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifica extends Model
{
    protected $table = 'stacked_notifications';
    protected $fillable = ['user_id','msg','url','type','created_at'];
    protected $dateFormat= 'Y-m-d H:i:s.u';
    protected $hidden = ['created_at','updated_at'];

}
