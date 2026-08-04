<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi_hewan extends Model
{
    //
    protected $table = "transaksi_hewan";

    protected $guarded = [];

    public function anggota()
    {
        return $this->hasMany('App\transaksi_hewan_anggota','id_ref');
    }

    public function peneliti()
    {
        return $this->hasMany('App\transaksi_hewan_peneliti_asing','id_ref');
    }

    public function reviewer()
    {
        return $this->hasMany('App\transaksi_hewan_reviewer','id_transaksi_hewan');
    }

    public function log()
    {
        return $this->hasMany('App\log_status_transaksi','id_ref')->where('jenis','=',2);
    }
}
