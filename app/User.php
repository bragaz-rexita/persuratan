<?php

namespace App;
use Laravel\Passport\HasApiTokens;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'username', 'password', 'previlage', 'fakultas', 'fakpanjang', 'merangkap', 'nip', 'golongan', 'email', 'spesial', 'tandatangan', 'paraf', 'firebaseid', 'photo', 'klsajar', 'smt', 'tapel', 'id_sekolah', 'nik', 'status', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
    public function profile()
    {
        return $this->hasOne('App\Profile','id');
    }
    public function roles()
    {
        return $this->hasMany('App\Role_User','user_id');
    }
    public function role()
    {
        return $this->hasOne('App\Role_User','user_id')->where('is_default','=', 1);
    }
}
