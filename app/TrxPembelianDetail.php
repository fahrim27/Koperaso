<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxPembelianDetail extends Model
{
    protected $table ='trx_pembelian_detail';
    protected $fillable = [
        'id_pembelian','id_produk', 'harga_beli', 'qty', 'subtotal'
    ];

    public function TrxPembelian()
    {
        return $this->belongsTo('App\TrxPembelian', 'id_pembelian');
    }

    public function MsProduk()
    {
        return $this->belongsTo('App\MsProduk', 'id_produk');
    }

}
