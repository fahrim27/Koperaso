<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JbMutasiStok extends Model
{
    protected $table ='jb_mutasi_stok';
    protected $fillable = [
        'id_pembelian', 'id_produk', 'tanggal', 'keterangan', 'masuk', 'keluar', 'user_id'
    ];

    public function MsProduk()
    {
        return $this->belongsTo('App\MsProduk', 'id_produk');
    }
}
