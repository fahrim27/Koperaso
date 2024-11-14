<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PbyJadwal extends Model
{
    protected $table ='pby_jadwal';
    protected $fillable = [
        'id_norek', 'tanggal', 'angske', 'angs_pokok', 'angs_jasa', 'tag_pokok', 'tag_jasa', 'status'
    ];

    public function PbyRekening()
    {
        return $this->belongsTo('App\PbyRekening', 'id_norek');
    }
}
