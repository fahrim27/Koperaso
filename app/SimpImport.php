<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpImport extends Model
{
    protected $table ='simp_import';
    protected $fillable = [
        'id_norek', 'no_rek', 'nama_anggota', 'nama_simpanan', 'jenis','nominal',
    ];
}
