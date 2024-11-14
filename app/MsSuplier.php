<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsSuplier extends Model
{
    protected $table ='ms_suplier';
    protected $fillable = [
        'nama_suplier','alamat', 'kontak'
    ];

    public function TrxPembelian()
    {
        return $this->hasMany('App\TrxPembelian', 'id_suplier');
    }
}
