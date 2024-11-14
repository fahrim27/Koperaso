<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PbyMaster extends Model
{
    protected $table ='pby_master';
    protected $fillable = [
        'kode', 'nama', 'akun_produk', 'akun_jasa', 'akun_adm', 'persen_jasa', 'bya_adm', 'status', 'jenis_pinjaman'
    ];

    public function PbyPengajuan()
    {
        return $this->hasMany('App\PbyPengajuan', 'id_pinjaman');
    }
}
