<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsJabatan extends Model
{
    protected $table ='ms_jabatan';
    protected $fillable = [
        'nama', 'simp_pokok', 'simp_wajib'
    ];
}
