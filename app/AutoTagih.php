<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoTagih extends Model
{
    protected $table ='tgh_anggota';
    protected $fillable = [
        'periode', 'id_anggota', 'simp_pokok', 'simp_wajib', 'simp_sukarela', 'cicilan_barang', 'pinjaman_tunai', 'total_tagihan', 'user_id'
    ];

    public function Anggota()
    {
        return $this->belongsTo('App\MsAnggota', 'id_anggota');
    }

}
