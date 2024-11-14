<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxPembelian extends Model
{
    protected $table ='trx_pembelian';
    protected $fillable = [
        'tanggal', 'id_suplier', 'pembayaran', 'keterangan', 'subtotal', 'diskon', 'total', 'id_user', 'status'
    ];
    
    public function TrxPembelianDetail()
    {
        return $this->hasMany('App\TrxPembelianDetail', 'id_pembelian');
    }

    public function MsSuplier()
    {
        return $this->belongsTo('App\MsSuplier', 'id_suplier');
    }



}
