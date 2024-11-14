<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsPerusahaan extends Model
{
    protected $table ='ms_perusahaan';
    protected $fillable = [
        'nama', 'inisial'
    ];
}
