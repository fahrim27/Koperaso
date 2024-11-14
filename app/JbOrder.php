<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JbOrder extends Model
{
    protected $table ='jb_order';
    protected $fillable = [
        'no_trx', 'tanggal', 'id_anggota', 'total', 'diskon', 'jangka', 'pembayaran', 'notes', 'status_order', 'notes', 'ket_batal'
    ];

    public function JbOrderDetail()
    {
        return $this->hasMany('App\JbOrderDetail', 'id_order');
    }

    public function MsProduk()
    {
        return $this->belongsTo('App\MsProduk', 'id_produk');
    }

    public function PbyPengajuan()
    {
        return $this->belongsTo('App\PbyPengajuan', 'id_order');
    }

    public function Anggota()
    {
        return $this->belongsTo('App\MsAnggota', 'id_anggota');
    }
}
