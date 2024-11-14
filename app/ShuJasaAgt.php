<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShuJasaAgt extends Model
{
    protected $table ='shu_jasaagt';
    protected $fillable = [
        'id_anggota', 'tanggal', 'no_trx', 'nominal', 'hpp', 'harga_jual'
    ];

    public function Anggota()
    {
        return $this->belongsTo('App\MsAnggota', 'id_anggota');
    }
}
