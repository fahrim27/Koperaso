<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgtTransaksi extends Model
{
    protected $table ='agt_transaksi';
    protected $fillable = [
      'tanggal', 'id_norek', 'id_anggota', 'keterangan', 'nominal', 'lampiran', 'jenis', 'status'
    ];

    public function SimpRekening()
    {
        return $this->belongsTo('App\SimpRekening', 'id_norek');
    }

    public function Anggota()
    {
        return $this->belongsTo('App\MsAnggota', 'id_anggota');
    }
}
