<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $table = "app_profile";
    
    protected $guarded = [];

    public $incrementing = false;
    
    public function desc_jurusan()
    {
        return $this->hasOne('App\mst_jur_prodi','kode','jurusan')->where('is_jurusan','=', 1);
    }

    public function desc_prodi()
    {
        return $this->hasOne('App\mst_jur_prodi','kode','prodi')->where('is_jurusan','=', 0);
    }
}
