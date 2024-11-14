<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JbOrderDetail extends Model
{
    protected $table ='jb_order_detail';
    protected $fillable = [
        'id_order', 'id_produk', 'hpp', 'harga', 'qty'
    ];

    public function JbOrder()
    {
        return $this->belongsTo('App\JbOrder', 'id_order');
    }

    public function MsProduk()
    {
        return $this->belongsTo('App\MsProduk', 'id_produk');
    }
}
