<?php

namespace App;

use App\Notifications\VerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','currency', 'email_verified_at', 'activation_token','isActive','disabled','waiting_api'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'activation_token', 'created_at', 'updated_at'
    ];


    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail); 
    }

    public function role($id) 
    {
        return DB::table('users')
            ->join('role_user', 'user_id', '=', 'users.id')
            ->join('roles', 'role_id', '=', 'roles.id')
            ->where('users.id', $id)
            ->select('roles.name')->first();
    }
    public function branch($id) 
    {
        return DB::table('users')
            ->join('branch_user', 'user_id', '=', 'users.id')
            ->join('branches', 'branch_id', '=', 'branches.id')
            ->where('users.id', $id)
            ->select('branches.id',
                     'branches.name',
                     'branches.description',
                     'branches.code',
                     'branches.categoria_id',
                     'branches.business_id',
                     'branches.disabled',
                     'branches.waiting_api',
                     'branches.created_at',
                     'branches.updated_at')->get();
    }

    public function business($id)
    {
        return DB::table('businesses')->where('id',$id)->get();
    }
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
    public function branches()
    {
        return $this->belongsToMany('App\Models\Branch');
    }

    public function businesses()
    {
        return $this->hasMany('App\Models\Business');
    }

    public function requesthistories()
    {
        return $this->hasMany('App\Models\RequestHistory');
    }

   
}
