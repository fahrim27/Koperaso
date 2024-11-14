<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PbyMutasi extends Model
{
    protected $table ='pby_mutasi';
    protected $fillable = [
        'id_norek', 'no_bukti', 'tanggal', 'angske','no_rek', 'keterangan', 'angs_pokok', 'angs_jasa', 'user_id'
    ];

    public function PbyRekening()
    {
        return $this->belongsTo('App\PbyRekening', 'id_norek');
    }
}
