<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgtCart extends Model
{
    protected $table ='agt_cart';
    protected $fillable = [
      'id_anggota', 'id_produk', 'keterangan', 'jumlah', 'tgl_checkout', 'is_checkout'
    ];

    public function Anggota()
    {
        return $this->belongsTo('App\MsAnggota', 'id_anggota');
    }

    public function Produk()
    {
        return $this->belongsTo('App\MsProduk', 'id_produk');
    }
}
