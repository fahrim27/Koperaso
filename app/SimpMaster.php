<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpMaster extends Model
{
    protected $table ='simp_master';
    protected $fillable = [
        'kode', 'nama', 'akun_produk', 'akun_jasa', 'persen_jasa', 'status',
    ];

    public function RekeningSimp()
    {
        return $this->hasMany('App\SimpRekening', 'id_simpanan');
    }
}
