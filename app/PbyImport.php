<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PbyImport extends Model
{
    protected $table ='pby_import';
    protected $fillable = [
        'id_norek', 'no_rek', 'nama_anggota', 'nama_pinjaman', 'angs_pokok', 'angs_jasa'
    ];
}
