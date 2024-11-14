<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoTagihDetail extends Model
{
    protected $table ='tgh_anggota_detail';
    protected $fillable = [
        'periode', 'tanggal', 'id_anggota', 'id_reksimpanan', 'id_rekpinjaman', 'nominal_pokok', 'nominal_jasa', 'angske', 'jenis', 'id_user'
    ];

    public function Anggota()
    {
        return $this->belongsTo('App\MsAnggota', 'id_anggota');
    }

    public function SimpRekening()
    {
        return $this->belongsTo('App\SimpRekening', 'id_reksimpanan');
    }
    public function PbyRekening()
    {
        return $this->belongsTo('App\PbyRekening', 'id_rekpinjaman');
    }
}
