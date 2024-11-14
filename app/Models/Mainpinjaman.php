<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Mainpinjaman extends Model
{
    protected $table = 'pinjaman';

    protected $fillable = [
        'tanggal_pengajuan',
        'keterangan',
        'cair_pada',
        'jumlah_cicilan',
        'nominal',
        'no_rekening_id',
        'tanggal_angsuran',
        'status',
        'jumlah_bulan',

    ];


    public function norekening()
    {
        return $this->belongsTo('App\Models\Norekening', 'no_rekening_id');
    }
}
