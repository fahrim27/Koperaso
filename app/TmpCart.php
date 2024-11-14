<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpCart extends Model
{
    protected $table ='tmp_cart';
    protected $fillable = [
      'id_user', 'id_produk', 'jumlah', 'harga'
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'id_anggota');
    }

    public function Produk()
    {
        return $this->belongsTo('App\MsProduk', 'id_produk');
    }
}
