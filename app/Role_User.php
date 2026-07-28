<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_User extends Model
{
    //
    protected $primaryKey = null;
    public $incrementing = false;

    protected $table = "app_role_user";

    protected $guarded = [];

    public $timestamps = false; 
}
