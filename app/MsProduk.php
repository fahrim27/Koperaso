<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsProduk extends Model
{
    protected $table ='ms_produk';
    protected $fillable = [
        'id_kategori', 'nama_barang', 'deskripsi', 'harga_beli', 'harga_jual', 'status', 'foto', 'cicilan', 'bayar_penuh', 'estimasi', 'stok_awal', 'stok'
    ];

    public function Kategori()
    {
        return $this->belongsTo('App\MsKategori', 'id_kategori');
    }

    public function JbOrder()
    {
        return $this->hasMany('App\JbOrder', 'id_produk');
    }
    
    public function JbOrderDetail()
    {
        return $this->hasMany('App\JbOrderDetail', 'id_produk');
    }
    
    public function AgtCart()
    {
        return $this->hasMany('App\AgtCart', 'id_produk');
    }

    public function TrxPembelianDetail()
    {
        return $this->hasMany('App\TrxPembelianDetail', 'id_produk');
    }

    public function JbMutasiStok()
    {
        return $this->hasMany('App\JbMutasiStok', 'id_produk');
    }

    public function TmpCart()
    {
        return $this->hasMany('App\TmpCart', 'id_produk');
    }
}
