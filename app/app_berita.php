<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class app_berita extends Model
{
    //
    protected $table = "app_berita";
    protected $primaryKey = 'id_app_berita';

    protected $guarded = [];

    public function files()
    {
        return $this->hasMany('App\app_berita_file','id_app_berita','id_app_berita');
    }
}
