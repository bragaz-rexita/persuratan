<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi_manusia extends Model
{
    //
    protected $table = "transaksi_manusia";

    protected $guarded = [];

    public function anggota()
    {
        return $this->hasMany('App\transaksi_manusia_anggota','id_ref');
    }

    public function peneliti()
    {
        return $this->hasMany('App\transaksi_manusia_peneliti_asing','id_ref');
    }

    public function dokter()
    {
        return $this->hasMany('App\transaksi_manusia_dokter','id_ref');
    }

    public function reviewer()
    {
        return $this->hasMany('App\transaksi_manusia_reviewer','id_transaksi_manusia');
    }
    
    public function log()
    {
        return $this->hasMany('App\log_status_transaksi','id_ref')->where('jenis','=',1);
    }
}
