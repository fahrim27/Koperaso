<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoTagihNew extends Model
{
    protected $table ='tgh_anggota_new';
    protected $fillable = [
        'periode', 'id_anggota', 'simp_pokok', 'simp_wajib', 'simp_sukarela', 'cicilan_barang', 'pinjaman_tunai', 'total_tagihan', 'user_id', 'tenor_cicil', 'angske_cicil', 'tenor_tunai', 'angske_tunai'
    ];

    public function Anggota()
    {
        return $this->belongsTo('App\MsAnggota', 'id_anggota');
    }

}
