<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpMutasi extends Model
{
    protected $table ='simp_mutasi';
    protected $fillable = [
        'id_norek', 'no_bukti', 'tanggal', 'no_rek', 'keterangan', 'debet', 'kredit', 'user_id'
    ];

    public function SimpRekening()
    {
        return $this->belongsTo('App\SimpRekening', 'id_norek');
    }

}
